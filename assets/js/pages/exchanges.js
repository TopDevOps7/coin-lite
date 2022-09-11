(() => {
    'use strict';

    const CoinLite = window.CoinLite;
    const DATA = window.DATA;
    const $ = window.jQuery;

    const Exchanges = {}

    Exchanges.init = function () {
        $('#exchanges-table').DataTable({
            ajax: DATA.urls.api + '/exchanges?currency=' + DATA.currency,
            scrollX: true,
            deferRender: true,
            pageLength: 25,
            pagingType: 'numbers',
            language: DATA.datatables.language,
            columns: [
                {
                    data: 'rank',
                    searchable: false
                },
                {
                    data: 'name',
                    searchable: true,
                    render: (data, type, row, meta) => {
                        if (type === 'display') {
                            const url = DATA.urls.exchanges + '/' + row.id
                            return '<a href="' + url + '">'
                                + '<h6>'
                                + '<img src="' + row.image + '" width="24" height="24">'
                                + ' <span>' + row.name + '</span>'
                                + '</h6>'
                                + '</a>'
                        } else {
                            return data
                        }
                    }
                },
                {
                    data: 'trust_score',
                    searchable: false,
                    className: 'text-center',
                    render: (data, type, row, meta) => {
                        if (type === 'display') {
                            let color = ''
                            if (data > 7) color = 'green'
                            else if (data > 3) color = 'yellow'
                            else if (data > 0) color = 'red'

                            return '<strong class="badge score '+color+'">' + data + '</strong>'
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
                            const url = DATA.urls.exchanges + '/' + row.id
                            return '<a href="' + url + '">' + CoinLite.largePriceFormat(data) + '</a>'
                        } else {
                            return data
                        }
                    },
                },
                {
                    data: 'share',
                    searchable: false,
                    className: 'text-end',
                    render: (data, type, row, meta) => {
                        if (type === 'display') {
                            const url = DATA.urls.exchanges + '/' + row.id
                            return '<a href="' + url + '">' + CoinLite.percentFormat(data) + '</a>'
                        } else {
                            return data
                        }
                    },
                },
                {
                    data: 'since',
                    searchable: true,
                    className: 'text-center',
                },
                {
                    data: 'country',
                    searchable: true,
                }
            ]
        })
    }

    Exchanges.init()


})(window)