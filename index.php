<?php
/*
| -------------------------------------------------------------------------
| CONSTANTS
| -------------------------------------------------------------------------
*/
define( 'COIN_LITE', 'bootstrap-1.0.0' );
define( 'PAGE_COINS', 'coins' );
define( 'PAGE_EXCHANGES', 'exchanges' );
define( 'PAGE_ABOUT', 'about' );
define( 'PAGE_DISCLAIMER', 'disclaimer' );
define( 'PAGE_TERMS', 'terms' );
define( 'PAGE_PRIVACY_POLICY', 'privacy-policy' );
define( 'PAGE_COOKIES_POLICY', 'cookies-policy' );
define( 'COOKIES_WARNING', true );

/*
| -------------------------------------------------------------------------
| CONFIGURATION
| -------------------------------------------------------------------------
*/
require_once __DIR__ . '/config/site.php';
require_once __DIR__ . '/config/social.php';
require_once __DIR__ . '/config/translation.php';
require_once __DIR__ . '/config/currencies.php';
require_once __DIR__ . '/config/theme.php';
require_once __DIR__ . '/config/referrals.php';

/*
| -------------------------------------------------------------------------
| INCLUDES
| -------------------------------------------------------------------------
*/
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/functions.php';

/*
| -------------------------------------------------------------------------
| ROUTES
| -------------------------------------------------------------------------
*/

$router = new \Bramus\Router\Router();

// Coins Route (Home)
$router->get( '/', function () {
    before_page_actions();

    $page_view = 'coins';
    $title = $GLOBALS['site']['title'];
    $description = $GLOBALS['site']['description'];
    include __DIR__ . '/views/base.php';
});

// Single Coin Route
$router->get( '/' . PAGE_COINS . '/{coin_id}', function ( $coin_id ) {
    before_page_actions();

    $coin = get_coin( $coin_id );
    if ( ! $coin ) {
        $GLOBALS['router']->trigger404();
        return;
    }

    $page_view = 'coin';
    $title = "{$coin->name} ({$coin->symbol}) - {$GLOBALS['site']['name']}";
    $description = "Get real-time information for {$coin->name} cryptocurrency.";
    include __DIR__ . '/views/base.php';
});

// Exchanges Route
$router->get( '/' . PAGE_EXCHANGES, function () {
    before_page_actions();

    $page_view = 'exchanges';
    $title = "Exchanges - {$GLOBALS['site']['name']}";
    $description = $GLOBALS['site']['description'];
    include __DIR__ . '/views/base.php';
});

// Single Exchange Route
$router->get( '/' . PAGE_EXCHANGES . '/{exchange_id}', function ( $exchange_id ) {
    before_page_actions();

    $exchange = get_exchange( $exchange_id );
    if ( ! $exchange ) {
        $GLOBALS['router']->trigger404();
        return;
    }

    $page_view = 'exchange';
    $title = "{$exchange->name} - {$GLOBALS['site']['name']}";
    $description = "Get real-time information for {$exchange->name} exchange.";
    include __DIR__ . '/views/base.php';
});

// About Route
$router->get( '/' . PAGE_ABOUT, function () {
    before_page_actions();

    $page_view = 'about';
    $title = $GLOBALS['site']['title'];
    $description = $GLOBALS['site']['description'];
    include __DIR__ . '/views/base.php';
});

// Disclaimer Route
$router->get( '/' . PAGE_DISCLAIMER, function () {
    before_page_actions();

    $page_view = 'disclaimer';
    $title = "Disclaimer - {$GLOBALS['site']['name']}";
    $description = $GLOBALS['site']['description'];
    include __DIR__ . '/views/base.php';
});

// Terms Route
$router->get( '/' . PAGE_TERMS, function () {
    before_page_actions();

    $page_view = 'terms';
    $title = "Terms - {$GLOBALS['site']['name']}";
    $description = $GLOBALS['site']['description'];
    include __DIR__ . '/views/base.php';
});

// Privacy Policy Route
$router->get( '/' . PAGE_PRIVACY_POLICY, function () {
    before_page_actions();

    $page_view = 'privacy-policy';
    $title = "Privacy Policy - {$GLOBALS['site']['name']}";
    $description = $GLOBALS['site']['description'];
    include __DIR__ . '/views/base.php';
});

// Cookies Policy Route
$router->get( '/' . PAGE_COOKIES_POLICY, function () {
    before_page_actions();

    $page_view = 'cookies-policy';
    $title = "Cookies - {$GLOBALS['site']['name']}";
    $description = $GLOBALS['site']['description'];
    include __DIR__ . '/views/base.php';
});

// Cronjob Route
$router->get( '/cronjob', function () {
    get_coins( true );
    get_exchanges( true );
    get_rates( true );
});

// Coins API Route
$router->get( '/api/coins', function () {
    $coins = get_coins();
    if ( $coins ) {
        // currency conversion
        $currency = empty( $_GET['currency'] ) ? 'USD' : strtoupper( $_GET['currency'] );
        $rate = convert( 1, $currency );
        if ( $rate && $currency !== 'USD' ) {
            foreach ( $coins as $coin ) {
                $coin->price *= $rate;
                $coin->high_24h *= $rate;
                $coin->low_24h *= $rate;
                $coin->market_cap *= $rate;
                $coin->volume_24h *= $rate;
            }
        }

        send_json( [ 'data' => $coins ] );
    }

    send_json( null, 404 );
});

// Exchanges API route
$router->get( '/api/exchanges', function () {
    $exchanges = get_exchanges();
    if ( $exchanges ) {
        // currency conversion
        $currency = empty( $_GET['currency'] ) ? 'USD' : strtoupper( $_GET['currency'] );
        $rate = convert( 1, $currency );
        if ( $rate ) {
            foreach ( $exchanges as $exchange ) {
                $exchange->volume = convert( $exchange->volume_btc, $currency, 'BTC' );
            }
        }

        send_json( [ 'data' => $exchanges ] );
    }

    send_json( null, 404 );
});

// Accept Cookies API route
$router->get( '/api/accept-cookies', function () {
    accept_cookies();
    send_json(are_cookies_accepted());
});

// Robots.txt Route
$router->get( '/robots.txt', function () {
    header( 'Content-type: text/plain');
    echo "User-agent: *\n\n";
    echo 'Sitemap: ' . site_url( 'sitemap.xml' );
});

// Sitemap Route
$router->get( '/sitemap.xml', function () {
    header( 'content-type: application/xml;charset=UTF-8' );
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    $urls = [
        site_url(),
        site_url( PAGE_ABOUT ),
        site_url( PAGE_DISCLAIMER ),
        site_url( PAGE_TERMS ),
        site_url( PAGE_PRIVACY_POLICY ),
        site_url( PAGE_COOKIES_POLICY ),
    ];

    foreach ( $urls as $url ) {
        printf( '<url><loc>%s</loc></url>', esc_url( $url ) );
    }

    foreach ( get_coins() as $coin ) {
        printf( '<url><loc>%s</loc></url>', esc_url( site_url( PAGE_COINS . '/' . $coin->id ) ) );
    }

    foreach ( get_exchanges() as $exchange ) {
        printf( '<url><loc>%s</loc></url>', esc_url( site_url( PAGE_EXCHANGES . '/' . $exchange->id ) ) );
    }

    echo '</urlset>';
});

// Not found
$router->set404(function () {
    before_page_actions();

    http_response_code( 404 );

    $page_view = '404';
    $title = __( 'Whoops, 404' );
    $description = __( 'The page you were looking for does not exist' );
    include __DIR__ . '/views/base.php';
});

$router->run();


