(() => {
    'use strict';

    const CoinLite = window.CoinLite = {};
    const DATA = window.DATA;
    const $ = window.jQuery;

    CoinLite.convertFromUSD = value => {
        value = parseFloat(value);
        return isNaN(value) ? null : value * DATA.rateFromUSD;
    }

    CoinLite.convertFromBTC = value => {
        value = parseFloat(value);
        return isNaN(value) ? null : value * DATA.rateFromBTC;
    }

    CoinLite.priceFormatWithUnit = (value, unit) => {
        value = parseFloat(value);
        if (isNaN(value)) return '?';

        const formatter = new Intl.NumberFormat(navigator.language, {
            minimumSignificantDigits: 4,
            maximumSignificantDigits: 6,
        })
        return formatter.format(value) + ' ' + unit;
    }

    CoinLite.priceFormat = value => {
        value = parseFloat(value);
        if (isNaN(value)) return '?';

        if (DATA.currencyType === 'crypto') {
            return CoinLite.priceFormatWithUnit(value, DATA.currencyUnit);
        }

        const formatter = new Intl.NumberFormat(navigator.language, {
            style: 'currency',
            minimumSignificantDigits: 4,
            maximumSignificantDigits: 6,
            currency: DATA.currency
        })
        return formatter.format(value);
    }

    CoinLite.largePriceFormatWithUnit = (value, unit) => {
        const formatter = new Intl.NumberFormat(navigator.language, {
            notation: 'compact',
            minimumFractionDigits: 1
        })
        return formatter.format(value) + ' ' + unit;
    }

    CoinLite.largePriceFormat = value => {
        value = parseFloat(value);
        if (isNaN(value)) return '?';

        if (DATA.currencyType === 'crypto') {
            return CoinLite.largePriceFormatWithUnit(value, DATA.currencyUnit);
        }

        const formatter = new Intl.NumberFormat(navigator.language, {
            style: 'currency',
            notation: 'compact',
            minimumFractionDigits: 1,
            currency: DATA.currency
        })
        return formatter.format(value);
    }

    CoinLite.percentFormat = value => {
        value = parseFloat(value);
        if (isNaN(value)) return '?';

        const formatter = new Intl.NumberFormat(navigator.language, {
            style: 'percent',
            minimumFractionDigits: 2,
        });
        return formatter.format(value / 100);
    }

    CoinLite.changeFormat = value => {
        value = parseFloat(value);
        if (isNaN(value)) return '?';

        const formatter = new Intl.NumberFormat(navigator.language, {
            style: 'percent',
            minimumFractionDigits: 2,
            signDisplay: 'always'
        });
        return formatter.format(value / 100);
    }

    CoinLite.supplyFormat = (value, symbol) => {
        value = parseFloat(value);
        if (isNaN(value)) return '?';

        const formatter = new Intl.NumberFormat(navigator.language, {
            notation: 'compact',
            maximumFractionDigits: 2
        });
        return formatter.format(value) + ' ' + symbol;
    }

    CoinLite.spreadFormat = value => {
        value = parseFloat(value);
        if (isNaN(value)) return '?';

        const formatter = new Intl.NumberFormat(navigator.language, {
            style: 'percent',
            minimumFractionDigits: 2,
        });
        return formatter.format(value / 100);
    }

    CoinLite.changeClass = value => {
        value = parseFloat(value)
        if (isNaN(value)) return '?'
        return value >= 0 ? 'change-up' : 'change-down';
    }

    CoinLite.chartTooltipDateFormat = ms => {
        const formatter = new Intl.DateTimeFormat(navigator.language, {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        return formatter.format(ms)
    }

    CoinLite.chartYAxisValueFormat = value => {
        const formatter = new Intl.NumberFormat(navigator.language, {
            notation: 'compact',
        });
        return formatter.format(value);
    }

    CoinLite.chartXAxisDateFormat = (ms, days) => {
        let options;
        if (days === 'max' || days > 30) {
            options = {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            }
        } else if (days > 1) {
            options = {
                month: 'short',
                day: 'numeric'
            }
        } else {
            options = {
                hour: '2-digit',
                minute: '2-digit'
            }
        }

        const formatter = new Intl.DateTimeFormat(navigator.language, options);
        return formatter.format(ms);
    }

    CoinLite.symbolDisplay = symbol => symbol.length < 10 ? symbol : symbol.substring(0, 7) + '...';

    CoinLite.referralUrl = (exchange, url) => {
        if (url) {
            const referrals = DATA.referrals

            switch (exchange) {
                case 'binance':
                    if (referrals.binance) {
                        url = new URL(url)
                        url.searchParams.set('ref', referrals.binance)
                        return url.toString()
                    }
                    break
                case 'okex':
                    if (referrals.okex) {
                        return 'https://www.okx.com/join/' + referrals.okex
                    }
                    break
                case 'kucoin':
                    if (referrals.kucoin) {
                        url = new URL(url)
                        url.searchParams.set('rcode', referrals.kucoin)
                        return url.toString()
                    }
                    break
                case 'crypto_com':
                    if (referrals.crypto_com) {
                        url = new URL(url)
                        url.searchParams.set('ref', referrals.crypto_com)
                        return url.toString()
                    }
                    break
            }
        }
        return url
    }

    CoinLite.init = () => {
        $('[data-price]').each(function () {
            const $this = $(this);
            $this.text(CoinLite.priceFormat($this.data('price')));
        })

        $('[data-change]').each(function () {
            const $this = $(this);
            $this.text(CoinLite.changeFormat($this.data('change')));
        })

        $('[data-large-price]').each(function () {
            const $this = $(this);
            $this.text(CoinLite.largePriceFormat($this.data('large-price')));
        })

        $('[data-percent]').each(function () {
            const $this = $(this);
            $this.text(CoinLite.percentFormat($this.data('percent')));
        })

        $('[data-supply]').each(function () {
            const $this = $(this);
            $this.text(CoinLite.supplyFormat($this.data('supply'), $this.data('symbol')));
        })

        $('[data-spread]').each(function () {
            const $this = $(this);
            $this.text(CoinLite.spreadFormat($this.data('spread')));
        })

        $('[data-affiliate]').each(function () {
            const $this = $(this);
            $this.prop('href', CoinLite.referralUrl($this.data('affiliate'), $this.prop('href')));
        })

        // Currency Selection
        $('#currency-select').on('input', function () {
            const url = new URL(location.href)
            url.searchParams.set('currency', this.value)
            location.href = url.toString()
        });

        $('#cookies-warning .accept').on('click', () => {
            fetch(DATA.urls.api + '/accept-cookies')
                .finally(() => $('#cookies-warning').hide())
        })
    }

    CoinLite.init()

})(window)