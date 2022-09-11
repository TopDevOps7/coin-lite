(() => {
    'use strict'

    const CoinLite = window.CoinLite
    const DATA = window.DATA
    const $ = window.jQuery
    const echarts = window.echarts

    const $exchange = $('#exchange')

    const Exchange = {
        chartInstance: null
    }

    Exchange.init = function () {
        $('button[data-days]').on('click', function () {
            const $this = $(this);
            Exchange.buildChart($this.data('days'))
        })

        $(window).on('resize', () => {
            if (this.chartInstance) this.chartInstance.resize()
        })

        this.buildChart(7)
        this.initTickers()
    }

    Exchange.buildChart = function (days) {
        $('button[data-days]').removeClass('selected')

        if (this.chartInstance) this.chartInstance.showLoading()

        fetch('https://api.coingecko.com/api/v3/exchanges/'+$exchange.data('id')+'/volume_chart?days='+days)
            .then(res => res.json())
            .then(data => {
                const options = {
                    title: {
                        show: false,
                        text: $exchange.data('name')
                    },
                    animation: false,
                    backgroundColor: 'rgba(0,0,0,0)',
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {type: 'cross'},
                        backgroundColor: 'rgba(255,255,255,0.9)',
                        confine: true,
                        formatter: (params) => {
                            let html = ''
                            html += CoinLite.chartTooltipDateFormat(params[0].axisValue)
                            html += ' : '
                            html += CoinLite.priceFormatWithUnit(params[0].value, 'BTC')
                            return html
                        }
                    },
                    axisPointer: {
                        label: {
                            formatter: params => {
                                return params.axisDimension === 'y' ?
                                    CoinLite.chartYAxisValueFormat(params.value) :
                                    CoinLite.chartXAxisDateFormat(params.value, days)
                            },
                        }
                    },
                    toolbox: {
                        feature: {
                            restore: {show: false},
                            saveAsImage: {title: ''},
                        },
                        right: 8
                    },
                    grid: {
                        left: '2%',
                        right: '2%',
                        containLabel: true
                    },
                    yAxis: {
                        type: 'value',
                        axisTick: {show: false},
                        axisLine: {show: false},
                        axisLabel: {
                            show: true,
                            inside: true,
                            formatter: value => CoinLite.chartYAxisValueFormat(value) + '\n\n',
                        },
                        scale: true
                    },
                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        scale: true,
                        splitLine: {
                            show: false
                        },
                        axisLabel: {
                            inside: false,
                            showMinLabel: false,
                            formatter: value => CoinLite.chartXAxisDateFormat(value, days)
                        },
                        data: data.map(entry => entry[0])
                    },
                    series: [{
                        id: 'price',
                        type: 'line',
                        showSymbol: false,
                        itemStyle: {
                            color: DATA.theme.chart_color
                        },
                        areaStyle: {},
                        data: data.map(entry => entry[1])
                    }]
                };

                if (this.chartInstance) this.chartInstance.dispose()

                this.chartInstance = echarts.init($('#exchange-chart')[0]);
                this.chartInstance.setOption(options);

                $('button[data-days="' + days + '"').addClass('selected')
            })
    }

    Exchange.initTickers = function () {
        const $table = $('#exchange-tickers-table')
        const exchangeId = $exchange.data('id')

        fetch('https://api.coingecko.com/api/v3/exchanges/'+exchangeId+'/tickers?include_exchange_logo=true&order=volume_desc')
            .then(res => res.json())
            .then(data => {
                if (!data || !data.tickers) {
                    $table.hide()
                    return
                }

                const tickers = data.tickers.map(ticker => {
                    return {
                        base: ticker.base,
                        target: ticker.target,
                        pair: ticker.base + '/' + ticker.target,
                        exchange_id: ticker.market.identifier,
                        exchange: ticker.market.name,
                        image: ticker.market.logo,
                        url: CoinLite.referralUrl(exchangeId, ticker.trade_url) ?? '',
                        last: ticker.last,
                        volume: ticker.volume,
                        volume_usd: ticker.converted_volume.usd,
                        spread: ticker.bid_ask_spread_percentage,
                        trust_score: ticker.trust_score,
                    }
                })

                $table.DataTable({
                    data: tickers,
                    scrollX: true,
                    deferRender: true,
                    pageLength: 25,
                    pagingType: 'numbers',
                    order: [[3,'desc']],
                    language: DATA.datatables.language,
                    columns: [
                        {
                            data: 'pair',
                            searchable: true,
                            render: (data, type, row, meta) => {
                                if (type === 'display') {
                                    return '<a href="' + row.url + '">' + CoinLite.symbolDisplay(row.base) + '/' + CoinLite.symbolDisplay(row.target) + '</a>'
                                } else {
                                    return data
                                }
                            },
                        },
                        {
                            data: 'last',
                            searchable: false,
                            className: 'text-end',
                            render: (data, type, row, meta) => {
                                if (type === 'display') {
                                    return '<a href="' + row.url + '">' + CoinLite.priceFormatWithUnit(data, CoinLite.symbolDisplay(row.target)) + '</a>'
                                } else {
                                    return data
                                }
                            },
                        },
                        {
                            data: 'spread',
                            searchable: false,
                            className: 'text-end',
                            render: (data, type, row, meta) => {
                                if (type === 'display') {
                                    return '<a href="' + row.url + '">' + CoinLite.spreadFormat(data) + '</a>'
                                } else {
                                    return data
                                }
                            },
                        },
                        {
                            data: 'volume',
                            searchable: false,
                            className: 'text-end',
                            render: (data, type, row, meta) => {
                                if (type === 'display') {
                                    return '<a href="' + row.url + '">' + CoinLite.largePriceFormatWithUnit(data, CoinLite.symbolDisplay(row.base)) + '</a>'
                                } else if (type === 'sort') {
                                    return row.volume_usd
                                } else {
                                    return data
                                }
                            },
                        },
                        {
                            data: 'volume_usd',
                            searchable: false,
                            className: 'text-end',
                            render: (data, type, row, meta) => {
                                if (type === 'display') {
                                    return '<a href="' + row.url + '">' + CoinLite.largePriceFormat(CoinLite.convertFromUSD(data)) + '</a>'
                                } else {
                                    return data
                                }
                            },
                        },
                        {
                            data: 'trust_score',
                            searchable: false,
                            className: 'text-center',
                            render: (data, type, row, meta) => {
                                if (type === 'display') {
                                    return '<span class="score circle '+data+'"></span>'
                                } else {
                                    switch (data) {
                                        case 'green': return 10
                                        case 'yellow': return 5
                                        case 'red': return 1
                                    }
                                    return 0
                                }
                            },
                        },
                    ]
                })

            })
            .catch(() => $table.hide())
    }

    Exchange.init()

})(window)