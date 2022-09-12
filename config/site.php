<?php
defined( 'COIN_LITE' ) OR exit( 'No direct script access allowed' );

/*
| -------------------------------------------------------------------------
| BASE URL
| -------------------------------------------------------------------------
|
| TYPE: string
|
| DESCRIPTION:
| This is used for creating URLs for pages and assets.
| If used inside subdirectories in your domain director, it should contain
| the relative path like "/subdirectory".
|
| -------------------------------------------------------------------------
| EXAMPLE FOR ROOT
| -------------------------------------------------------------------------
|
| $site['base_url'] = 'https://my-domain.tld/';
|
| -------------------------------------------------------------------------
| EXAMPLE FOR SUBDIRECTORY
| -------------------------------------------------------------------------
|
| $site['base_url'] = 'https://my-domain.tld/subdirectory/';
|
*/
$site['base_url'] = 'http://localhost/coin-lite-bootstrap/';
// $site['base_url'] = 'https://cryptoquote.live/';

/*
| -------------------------------------------------------------------------
| LANG
| -------------------------------------------------------------------------
|
| TYPE: string
|
| DESCRIPTION:
| Defines the default language locale used for the website content.
| Must be defined in "languages" configuration.
|
*/
$site['lang'] = 'en';

/*
| -------------------------------------------------------------------------
| NAME
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Short name for the website.
| MAX LENGTH: 18 (to fit navigation)
|
*/
$site['name'] = 'Crypto Quote Live';

/*
| -------------------------------------------------------------------------
| TITLE
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Text used for title tag, OpenGraph (og:title) and Twitter Card (twitter:title).
| MAX LENGTH: 70
|
*/
$site['title'] = 'Crypto Quote Live - Cryptocurrencies Prices';

/*
| -------------------------------------------------------------------------
| DESCRIPTION
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Text used for description meta tag, OpenGraph (og:description) and Twitter Card (twitter:description).
| MAX LENGTH: 200
|
*/
$site['description'] = 'We Provide Cryptocurrencies Information With Real-Time Prices.';

/*
| -------------------------------------------------------------------------
| THEME COLOR
| -------------------------------------------------------------------------
|
| TYPE: string
|
| DESCRIPTION:
| Color value for "theme-color" meta tag. Some browsers will use this
| to customize the display of the page or of the surrounding user interface.
|
| REFERENCE:
| https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta/name/theme-color
|
*/
$site['theme_color'] = '#ffffff';

/*
| -------------------------------------------------------------------------
| LOGO
| -------------------------------------------------------------------------
|
| TYPE: string
|
| DESCRIPTION:
| Absolute or relative URL for the logo used in top bar and navigation header.
| Use a square image larger than 64x64 pixels.
|
| IMAGE TYPE: PNG (Recommended).
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['logo'] = 'images/logo.png';
|
*/
$site['logo'] = 'images/logo.svg';


/*
| -------------------------------------------------------------------------
| FAVICON
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Absolute or relative URL for the "favicon.ico" (optional if you set "ICONS").
| IMAGE TYPE: ICO (Required)
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['favicon'] = 'images/favicon.ico';
|
*/
$site['favicon'] = 'images/favicon.ico';

/*
| -------------------------------------------------------------------------
| ICONS
| -------------------------------------------------------------------------
|
| TYPE: array
| DESCRIPTION: Modern browser favicon images. Should provide at least "16x16" and "32x32" icons.
| IMAGE TYPE: PNG (Required)
| KEY: "{width}x{height}"
| VALUE: Absolute or relative URL
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['icons'] = [
|     '16x16' => 'images/favicon-16x16.png',
|     '32x32' => 'images/favicon-32x32.png',
| ];
|
*/
$site['icons'] = [
    '16x16'   => 'images/favicon-16x16.png',
    '32x32'   => 'images/favicon-32x32.png',
    '192x192' => 'images/android-chrome-192x192.png',
];

/*
| -------------------------------------------------------------------------
| APPLE TOUCH ICONS
| -------------------------------------------------------------------------
|
| TYPE: array
| DESCRIPTION: Apple specific logos images. Size 180x180 for minimal configuration.
| IMAGE TYPE: PNG (Required)
| KEY: "{width}x{height}"
| VALUE: Absolute or relative URL
|
| REFERENCE:
| https://developer.apple.com/library/archive/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html
|
| -------------------------------------------------------------------------
| SIZES
| -------------------------------------------------------------------------
|
|   120x120   For iPhone
|   152x152   For iPad
|   167x167   For iPad Pro
|   180x180   For iPhone
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['apple_touch_icons'] = [
|     '120x120' => 'images/apple-touch-icon-120x120.png',
|     '152x152' => 'images/apple-touch-icon-152x152.png',
|     '167x167' => 'images/apple-touch-icon-167x167.png',
|     '180x180' => 'images/apple-touch-icon-180x180.png',
| ];
|
*/
$site['apple_touch_icons'] = [
    '180x180' => 'images/apple-touch-icon.png',
];

/*
| -------------------------------------------------------------------------
| OPEN GRAPH IMAGE
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Absolute or relative URL for the Open Graph image (og:image).
| IMAGE TYPE: JPEG, PNG or GIF
| RECOMMENDED SIZE: 1200x627
|
| REFERENCE:
| https://ogp.me/
| https://developers.facebook.com/docs/sharing/webmasters/#images
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['og_image'] = 'images/og.png';
|
*/
$site['og_image'] = 'images/social.png';

/*
| -------------------------------------------------------------------------
| TWITTER CARD
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Twitter Card type (twitter:card) can be 'summary' or 'summary_large_image'.
|
| REFERENCE:
| https://developer.twitter.com/en/docs/twitter-for-websites/cards/overview/abouts-cards
|
*/
$site['twitter_card'] = 'summary_large_image';

/*
| -------------------------------------------------------------------------
| TWITTER SITE
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Twitter Card handle for the website (twitter:site).
|
| REFERENCE:
| https://developer.twitter.com/en/docs/twitter-for-websites/cards/overview/markup
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['twitter_site'] = '@Website';
|
*/
$site['twitter_site'] = '@runcoders';

/*
| -------------------------------------------------------------------------
| TWITTER CREATOR
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Twitter Card handle for the author (twitter:creator).
|
| REFERENCE:
| https://developer.twitter.com/en/docs/twitter-for-websites/cards/overview/markup
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['twitter_creator'] = '@Author';
|
*/
$site['twitter_creator'] = '@runcoders';

/*
| -------------------------------------------------------------------------
| TWITTER IMAGE
| -------------------------------------------------------------------------
|
| TYPE: string
| DESCRIPTION: Absolute or relative URL for the Twitter Card image (twitter:image).
| IMAGE TYPE: JPG, PNG, WEBP or GIF
| Recommended Size: 800x418
|
| REFERENCE:
| https://developer.twitter.com/en/docs/twitter-for-websites/cards/overview/markup
|
| -------------------------------------------------------------------------
| EXAMPLE
| -------------------------------------------------------------------------
|
| $site['twitter_image'] = 'images/twitter.png';
|
*/
$site['twitter_image'] = 'images/social.png';
