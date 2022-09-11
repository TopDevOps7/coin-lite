<?php
defined( 'COIN_LITE' ) OR exit( 'No direct script access allowed' );
/*
| -------------------------------------------------------------------------
| LIST OF CURRENCIES AVAILABLE
| -------------------------------------------------------------------------
|
|    BTC - Bitcoin
|    ETH - Ether
|    LTC - Litecoin
|    BCH - Bitcoin Cash
|    BNB - Binance Coin
|    EOS - EOS
|    XRP - XRP
|    XLM - Lumens
|    LINK - Chainlink
|    DOT - Polkadot
|    YFI - Yearn.finance
|    USD - US Dollar
|    AED - United Arab Emirates Dirham
|    ARS - Argentine Peso
|    AUD - Australian Dollar
|    BDT - Bangladeshi Taka
|    BHD - Bahraini Dinar
|    BMD - Bermudian Dollar
|    BRL - Brazil Real
|    CAD - Canadian Dollar
|    CHF - Swiss Franc
|    CLP - Chilean Peso
|    CNY - Chinese Yuan
|    CZK - Czech Koruna
|    DKK - Danish Krone
|    EUR - Euro
|    GBP - British Pound Sterling
|    HKD - Hong Kong Dollar
|    HUF - Hungarian Forint
|    IDR - Indonesian Rupiah
|    ILS - Israeli New Shekel
|    INR - Indian Rupee
|    JPY - Japanese Yen
|    KRW - South Korean Won
|    KWD - Kuwaiti Dinar
|    LKR - Sri Lankan Rupee
|    MMK - Burmese Kyat
|    MXN - Mexican Peso
|    MYR - Malaysian Ringgit
|    NGN - Nigerian Naira
|    NOK - Norwegian Krone
|    NZD - New Zealand Dollar
|    PHP - Philippine Peso
|    PKR - Pakistani Rupee
|    PLN - Polish Zloty
|    RUB - Russian Ruble
|    SAR - Saudi Riyal
|    SEK - Swedish Krona
|    SGD - Singapore Dollar
|    THB - Thai Baht
|    TRY - Turkish Lira
|    TWD - New Taiwan Dollar
|    UAH - Ukrainian hryvnia
|    VEF - Venezuelan bolívar fuerte
|    VND - Vietnamese đồng
|    ZAR - South African Rand
|    XDR - IMF Special Drawing Rights
|    XAG - Silver - Troy Ounce
|    XAU - Gold - Troy Ounce
|    BITS - Bits
|    SATS - Satoshi
|
*/

/*
| -------------------------------------------------------------------------
| DEFAULT CURRENCY
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Currency used by default for prices.
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $currencies['default'] = 'EUR';
|
*/
$currencies['default'] = 'USD';

/*
| -------------------------------------------------------------------------
| INCLUDED CURRENCIES
| -------------------------------------------------------------------------
|
| TYPE: string[]
| DESCRIPTION: List of currencies that will be available for selection.
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $currencies['include'] = [ 'USD', 'EUR', 'GBP' ];
|
*/
$currencies['include'] = [  ];

/*
| -------------------------------------------------------------------------
| EXCLUDED CURRENCIES
| -------------------------------------------------------------------------
|
| TYPE: string[]
| DESCRIPTION: List of currencies that will not be available for selection.
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $currencies['exclude'] = [ 'XAU', 'XAG', 'XDR' ];
|
*/
$currencies['exclude'] = [  ];