<?php
defined( 'COIN_LITE' ) OR exit( 'No direct script access allowed' );

/**
 * Get the modified time of a file
 *
 * @param string $file_path
 * @return int
 */
function file_modified_time( string $file_path ) {
    if ( file_exists( $file_path ) ) {
        return filemtime( $file_path ) ?: 0;
    }
    return 0;
}

/**
 * Gets the Base URL for current environment
 *
 * @return null|string
 */
function base_url() {
    return empty( $GLOBALS['site']['base_url'] ) ? null : $GLOBALS['site']['base_url'];
}

/**
 * Generates URL appending a path to base_url
 *
 * @param string $path
 * @return string
 */
function site_url( string $path = '' ) {
    return rtrim( base_url(), '/' ) . '/' . ltrim( $path, '/' );
}

/**
 * Checks if string is URL with http or https protocols
 *
 * @param string $url
 * @return bool
 */
function is_http( string $url ) {
    return !!preg_match( '/^https?:\/\//', $url );
}

/**
 * Tries to return a file absolute URL with modified timestamp query param (prevent cache)
 *
 * @param string $url
 * @return string|null
 */
function get_file_url_for_display( $url ) {
    if ( ! is_string( $url ) ) {
        return null;
    }

    if ( ! is_http( $url ) ) { // relative path
        $rel_path = $url;

        // has query part?
        $queryPos = strpos( $url, '?' );
        if ( $queryPos !== false ) {
            $rel_path = substr( $url, 0, $queryPos );
        }

        $path = dirname( __DIR__ ) . '/' . ltrim( $rel_path, '/' );
        $modified_timestamp = file_modified_time( $path );
        // append "t" param with timestamp to query
        $queryString = ( $queryPos === false ? '?' : '&' ) . 't=' . $modified_timestamp;
        // absolute url
        return site_url( $url . $queryString );
    }
    // absolute url
    return $url;
}

/**
 * Gets the base value for Vue Router
 *
 * @return string
 */
function router_base() {
    $path = parse_url( base_url(), PHP_URL_PATH ) ?: '';
    return rtrim( $path, '/' ) . '/';
}

/**
 * Escapes string for using in HTML attribute value
 *
 * @param string $text
 * @return string
 */
function esc_attr( $text ) {
    if ( ! is_string( $text ) || '' === $text ) {
        return $text;
    }
    return htmlspecialchars( $text, ENT_COMPAT | ENT_HTML5, 'UTF-8', false );
}

/**
 * Escapes URL string
 *
 * @param string $url
 * @return string
 */
function esc_url( $url ) {
    if ( ! is_string( $url ) || '' === $url ) {
        return $url;
    }
    // encode spaces
    $url = str_replace( ' ', '%20', ltrim( $url ) );
    // remove invalid chars
    return preg_replace( '|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\[\]\\x80-\\xff]|i', '', $url );
}

/**
 * Escapes string for safe content in HTML context
 *
 * @param string $text
 * @return string
 */
function esc_html( $text ) {
    if ( ! is_string( $text ) || '' === $text ) {
        return $text;
    }
    return htmlspecialchars( $text, ENT_QUOTES | ENT_HTML5, 'UTF-8', false );
}

/**
 * Gets text translation or itself if missing
 *
 * @param string $text
 * @return string
 */
function __( string $text ) {
    if ( isset( $GLOBALS['translation'][ $text ] ) && is_string( $GLOBALS['translation'][ $text ] ) ) {
        return $GLOBALS['translation'][ $text ];
    }
    return $text;
}

/**
 * Prints HTML attribute
 *
 * @param string $attr
 * @param mixed $value
 * @param bool $bool
 */
function attr( string $attr, $value, bool $bool = true ) {
    if ( $bool ) {
        printf( ' %s="%s"', $attr, esc_attr( $value ) );
    }
}

/**
 * Prints JSON data response
 *
 * @param mixed $data
 * @param int $status
 * @param null|int $max_age
 */
function send_json( $data = null, int $status = 200, $max_age = null ) {
    header( 'Content-Type: application/json; charset=utf-8', true, $status );

    if ( is_int( $max_age ) ) {
        header( sprintf( 'Cache-Control: public, max-age=%d', $max_age ), true, $status );
    }

    echo json_encode( $data );
    exit;
}

/**
 * Get all coins
 *
 * @param bool $refresh
 * @return object[]
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function get_coins( bool $refresh = false ) {
    $filepath = dirname( __DIR__ ) . '/data/coins.dat';

    if ( $refresh ) {
        $mtime = file_modified_time( $filepath );
        if ( ! $mtime || $mtime < time() - 60 ) {
            $client = new \GuzzleHttp\Client();
            $response = $client->get( 'https://etps6dk4ad.localstorage.one/coins' );
            if ( $response->getStatusCode() === 200 ) {
                $coins = [];
                $coins_ = json_decode( $response->getBody() );
                // $arr_index = 0;
                // $redux_flag = 0;
                // $object = new stdClass();
                // $object->name = "My name";
                // $myArray[] = $object;
                if(count($coins_)){
                    $inserted = false;
                    for($i = 0; $i < count($coins_); $i++){
                        if ($coins_[$i]->market_cap > 400000000) {
                            $coins[] = $coins_[$i];
                        } else {
                            if(!$inserted){
                                $object = new stdClass();
                                $object->name = "ReduX";
                                $object->id = "redux";
                                $object->symbol = "REDUX";
                                $object->image = "";
                                $object->price = 0.2;
                                $object->high_24h = 0.0;
                                $object->low_24h = 0.0;
                                $object->market_cap = 400000000;
                                $object->volume_24h = 0.0;
                                $object->change_1h = 0.0;
                                $object->change_24h = 0.0;
                                $object->change_7d = 0.0;
                                $object->change_30d = 12.50;
                                $object->supply = 0.0;
                                $object->max_supply = 0.0;
                                $object->rank = $i + 1;
                                $coins[] = $object;
                                $inserted = true;
                                $coins_[$i]->rank = $coins_[$i]->rank + 1;
                                $coins[] = $coins_[$i];
                            } else {
                                $coins_[$i]->rank = $coins_[$i]->rank + 1;
                                $coins[] = $coins_[$i];
                            }
                        }
                    }
                }
                
                if ( $coins ) {
                    $logo_url = site_url( 'images/redux.png' );
                    foreach ( $coins as $coin ) {
                        if ( empty( $coin->image ) ) {
                            $coin->image = $logo_url;
                        }
                    }

                    file_put_contents( $filepath, serialize( $coins ) );
                }
            }
        }
    }

    if ( file_exists( $filepath ) ) {
        $coins = unserialize( file_get_contents( $filepath ) );
        return is_array( $coins ) ? $coins : [];
    }

    return [];
}

/**
 * Get a single coin by id
 *
 * @param string $id
 * @param bool $refresh
 * @return object|null
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function get_coin( string $id, bool $refresh = false ) {
    $coins = get_coins( $refresh );
    foreach ( $coins as $coin ) {
        if ( $coin->id === $id ) {
            return $coin;
        }
    }
    return null;
}

/**
 * Get all exchanges
 *
 * @param bool $refresh
 * @return object[]
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function get_exchanges( bool $refresh = false ) {
    $filepath = dirname( __DIR__ ) . '/data/exchanges.dat';

    if ( $refresh ) {
        $mtime = file_modified_time( $filepath );
        if ( ! $mtime || $mtime < time() - 60 ) {
            $client = new \GuzzleHttp\Client();
            $response = $client->get( 'https://etps6dk4ad.localstorage.one/exchanges' );
            if ( $response->getStatusCode() === 200 ) {
                $exchanges = json_decode( $response->getBody() );
                if ( $exchanges ) {
                    $logo_url = site_url( 'images/logo.png' );
                    foreach ( $exchanges as $exchange ) {
                        if ( empty( $exchange->image ) ) {
                            $exchange->image = $logo_url;
                        }
                    }

                    file_put_contents( $filepath, serialize( $exchanges ) );
                }
            }
        }
    }

    if ( file_exists( $filepath ) ) {
        $exchanges = unserialize( file_get_contents( $filepath ) );
        return is_array( $exchanges ) ? $exchanges : [];
    }

    return [];
}

/**
 * Get a single exchange by id
 *
 * @param string $id
 * @param bool $refresh
 * @return object|null
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function get_exchange( string $id, bool $refresh = false ) {
    $exchanges = get_exchanges( $refresh );
    foreach ( $exchanges as $exchange ) {
        if ( $exchange->id === $id ) {
            return $exchange;
        }
    }
    return null;
}

/**
 * Get exchange rates details
 *
 * @param bool $refresh
 * @param bool $restrict
 * @return array[]
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function get_rates( bool $refresh = false, bool $restrict = true ) {
    $filepath = dirname( __DIR__ ) . '/data/rates.dat';

    if ( $refresh ) {
        $mtime = file_modified_time( $filepath );
        if ( ! $mtime || $mtime < time() - 60 ) {
            $client = new \GuzzleHttp\Client();
            $response = $client->get( 'https://api.coingecko.com/api/v3/exchange_rates' );
            if ( $response->getStatusCode() === 200 ) {
                $data = json_decode( $response->getBody(), true );
                if ( ! empty( $data['rates'] ) ) {
                    $rates = [];
                    foreach ( $data['rates'] as $id => $rate ) {
                        $rates[ strtoupper( $id ) ] = $rate;
                    }
                    file_put_contents( $filepath, serialize( $rates ) );
                }
            }
        }
    }

    if ( file_exists( $filepath ) ) {
        $rates = unserialize( file_get_contents( $filepath ) );

        if ( $restrict ) {
            if ( empty( $GLOBALS['currencies']['include'] ) && empty( $GLOBALS['currencies']['exclude'] ) ) {
                return $rates;
            }

            foreach ( $rates as $id => $rate ) {
                if (
                    ( ! empty( $GLOBALS['currencies']['include'] ) && ! in_array( $id, $GLOBALS['currencies']['include'] ) )
                    ||
                    ( ! empty( $GLOBALS['currencies']['exclude'] ) ) && in_array( $id, $GLOBALS['currencies']['exclude'] ) )
                {
                    unset( $rates[ $id ] );
                }
            }
        }

        return $rates;
    }

    return [];
}

/**
 * Get a single exchange rate by id
 *
 * @param string $id
 * @param bool $refresh
 * @param bool $restrict
 * @return array|null
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function get_rate( string $id, bool $refresh = false, bool $restrict = true ) {
    $rates = get_rates( $refresh, $restrict );
    return $rates[ $id ] ?? null;
}

/**
 * Sets the currency cookie value
 *
 * @param string $currency_id
 * @return bool
 */
function set_currency( string $currency_id ) {
    $cookie = new \Delight\Cookie\Cookie( 'cl_currency' );
    $cookie->setValue( $currency_id );
    $cookie->setExpiryTime( time() + ( 30 * 24 * 3600 ) );
    $cookie->setHttpOnly( false );
    return $cookie->saveAndSet();
}

/**
 * Gets the currency cookie value
 *
 * @return string
 */
function get_currency() {
    $currency_id = \Delight\Cookie\Cookie::get('cl_currency' );
    return empty( $currency_id ) || ! get_rate( $currency_id ) ? $GLOBALS['currencies']['default'] : $currency_id;
}

/**
 * Converts value based on an exchange rate
 *
 * @param float $value
 * @param string $currency
 * @return float|null
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function convert( $value, $currency = null, string $from = 'USD' ) {
    if ( empty( $currency ) ) {
        $currency = get_currency();
    }

    $value = (float) $value;
    $from_rate = get_rate( $from, false, false );
    $target_rate = get_rate( $currency, false, false );

    if ( $from_rate && $target_rate ) {
        return $value * $target_rate['value'] / $from_rate['value'];
    }

    return null;
}

/**
 * @return bool
 */
function are_cookies_accepted() {
    return 'yes' === \Delight\Cookie\Cookie::get('cl_cookies_accepted' );
}

/**
 * @return bool
 */
function accept_cookies() {
    $cookie = new \Delight\Cookie\Cookie( 'cl_cookies_accepted' );
    $cookie->setValue( 'yes' );
    $cookie->setExpiryTime( time() + ( 30 * 24 * 3600 ) );
    $cookie->setHttpOnly( false );
    return $cookie->saveAndSet();
}

/**
 * Runs actions before the page renders
 *
 * @return void
 */
function before_page_actions() {
    if ( empty( $GLOBALS['site']['base_url'] ) ) {
        echo '$site[\'base_url\'] must be defined in config/site.php';
        exit();
    }

    get_coins( true );
    get_exchanges( true );
    get_rates( true );

    // $filepath = dirname( __DIR__ ) . '/data/coins.dat';
    // if ( ! file_exists( $filepath ) ) {
    //     echo 'Cronjob must be created:';
    //     echo '<br>';
    //     echo '<code>* * * * * curl ' . site_url( 'cronjob' ) . ' >/dev/null 2>&1</code>';
    //     echo '<br><br>';
    //     echo 'Check <a href="https://docs.runcoders.net/coin-lite-bulma/#/install/cronjob" target="_blank">documentation</a>.';
    //     echo '<br>';
    //     echo 'This warning will disappear after a minute if the cronjob is working correctly.';
    //     exit();
    // }

    // check and set currency
    if ( ! empty( $_GET['currency'] ) ) {
        set_currency( $_GET['currency'] );
    }
}
