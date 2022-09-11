<?php

$current_currency = get_currency();

?>
<!DOCTYPE html>
<html lang="<?php echo empty( $GLOBALS['site']['lang'] ) ? 'en' : esc_attr( $GLOBALS['site']['lang'] ); ?>">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="canonical" href="<?php echo esc_url( site_url() ); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo esc_url( site_url() ); ?>" />
  <meta property="og:site_name" content="<?php echo esc_attr( $GLOBALS['site']['name'] ); ?>" />
  <title><?php echo esc_html( $title ); ?></title>
  <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>" />
  <meta property="og:title" content="<?php echo esc_attr( $title ); ?>" />
  <meta name="description" content="<?php echo esc_attr( $description ); ?>" />
  <meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>" />
  <meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
  <meta name="theme-color" content="<?php echo esc_attr( $GLOBALS['site']['theme_color'] ); ?>" />
  <?php if ( ! empty( $GLOBALS['site']['favicon'] ) ) : ?>
  <link rel="shortcut icon" type="image/x-icon"
    href="<?php echo esc_url( get_file_url_for_display( $GLOBALS['site']['favicon'] ) ); ?>" />
  <?php endif; ?>
  <?php if ( ! empty( $GLOBALS['site']['icons'] ) ) : ?>
  <?php foreach ( $GLOBALS['site']['icons'] as $sizes => $href ) : ?>
  <link rel="icon" type="image/png" sizes="<?php echo esc_attr( $sizes ); ?>"
    href="<?php echo esc_url( get_file_url_for_display( $href ) ); ?>" />
  <?php endforeach; ?>
  <?php endif; ?>
  <?php if ( ! empty( $GLOBALS['site']['apple_touch_icons'] ) ) : ?>
  <?php foreach ( $GLOBALS['site']['apple_touch_icons'] as $sizes => $href ) : ?>
  <link rel="apple-touch-icon" type="image/png" sizes="<?php echo esc_attr( $sizes ); ?>"
    href="<?php echo esc_url( get_file_url_for_display( $href ) ); ?>" />
  <?php endforeach; ?>
  <?php endif; ?>
  <?php if ( ! empty( $GLOBALS['site']['og_image'] ) ) : ?>
  <meta property="og:image"
    content="<?php echo esc_url( get_file_url_for_display( $GLOBALS['site']['og_image'] ) ); ?>" />
  <?php endif; ?>
  <?php if ( ! empty( $GLOBALS['site']['twitter_card'] ) ) : ?>
  <meta name="twitter:card" content="<?php echo esc_attr( $GLOBALS['site']['twitter_card'] ); ?>" />
  <?php endif; ?>
  <?php if ( ! empty( $GLOBALS['site']['twitter_site'] ) ) : ?>
  <meta name="twitter:site" content="<?php echo esc_attr( $GLOBALS['site']['twitter_site'] ); ?>" />
  <?php endif; ?>
  <?php if ( ! empty( $GLOBALS['site']['twitter_creator'] ) ) : ?>
  <meta name="twitter:creator" content="<?php echo esc_attr( $GLOBALS['site']['twitter_creator'] ); ?>" />
  <?php endif; ?>
  <?php if ( ! empty( $GLOBALS['site']['twitter_image'] ) ) : ?>
  <meta name="twitter:creator"
    content="<?php echo esc_url( get_file_url_for_display( $GLOBALS['site']['twitter_image'] ) ); ?>" />
  <?php endif; ?>

  <link rel="stylesheet" href="<?php echo esc_url( site_url( 'assets/fontawesome/css/all.min.css?v=6.1.1' ) ); ?>" />
  <link rel="stylesheet" href="<?php echo esc_url( site_url( 'assets/css/bootstrap.min.css?v=5.1.3' ) ); ?>" />
  <link rel="stylesheet"
    href="<?php echo esc_url( site_url( 'assets/css/dataTables.bootstrap5.min.css?v=1.11.5' ) ); ?>" />
  <link rel="stylesheet" href="<?php echo esc_url( get_file_url_for_display( 'assets/css/style.css' ) ); ?>" />
  <link rel="stylesheet" href="<?php echo esc_url( get_file_url_for_display( 'assets/css/custom.css' ) ); ?>" />
  <style>
  .table-highlight-color {
    background-color: <?php echo esc_attr($GLOBALS['theme']['table_highlight_color']);
    ?>;
  }

  .btn.selected {
    background-color: <?php echo esc_attr($GLOBALS['theme']['selected_color']);
    ?>;
    color: white;
    border-color: transparent !important;
    box-shadow: none !important;
  }

  .dataTables_paginate .page-item.active .page-link {
    background-color: <?php echo esc_attr($GLOBALS['theme']['selected_color']);
    ?>;
    border-color: <?php echo esc_attr($GLOBALS['theme']['selected_color']);
    ?>;
  }

  </style>
</head>

<body>
  <img style="width: 100%" src="<?php echo esc_url( site_url( 'images/header.png' ) ); ?>">
  <div class="container">
    <img style="position: absolute; top: 5vw; width: 300px"
      src="<?php echo esc_url( site_url( 'images/logo.png' ) ); ?>">
  </div>
  <div style="position: absolute; top: 15vw; text-align: center; width: 100%; color: #FFFFFF">
    <div style="font-size: 34px">WELCOME TO WORLD’S SMARTEST CRYPTO EXCHANGE</div>
    <div style="font-size: 44px">EXCHANGE YOUR CRYPTO ON A GO...</div>
  </div>

  <main>
    <?php include __DIR__ . '/pages/' . $page_view . '.php' ?>
  </main>

  <div style="background-image: linear-gradient(90deg, #2BABCA 60%, #1F3C95); height: 5px"></div>
  <div style="padding: 2vw 3vw; background: #0B1451">
    <div style="display: flex; justify-content: space-between">
      <img style="width: 150px" src="<?php echo esc_url( site_url( 'images/logo.png' ) ); ?>">
      <div style="font-size: 20px; font-weight: 600; color: #248EBA">COPYRIGHT @ ALL RIGHT RESERVED</div>
    </div>
  </div>

  <?php if ( COOKIES_WARNING && ! are_cookies_accepted() ) : ?>
  <div id="cookies-warning" class="alert alert-secondary" role="alert">
    <div>
      <h4 class="alert-heading">
        <?php echo esc_html( __( 'We Use Cookies' ) ); ?>
      </h4>
      <p>
        <?php echo esc_html( __( 'This website uses cookies to provide a better experience.' ) ); ?>
        <?php echo esc_html( __( 'By clicking accept you agree to this and our Cookies Policy terms.' ) ); ?>
      </p>
    </div>
    <div>
      <a class="btn btn-link" href="<?php echo esc_url( site_url( PAGE_COOKIES_POLICY ) ); ?>">
        <?php echo esc_html( __( 'Cookies Policy' ) ); ?>
      </a>
      <button class="accept btn btn-success">
        <?php echo esc_html( __( 'Accept' ) ); ?>
      </button>
    </div>
  </div>
  <?php endif; ?>
  <?php
        $rate = get_rate( $current_currency );

        $data = [
            'urls' => [
                'root' => site_url(),
                'api' => site_url( 'api' ),
                'coins' => site_url( PAGE_COINS ),
                'exchanges' => site_url( PAGE_EXCHANGES ),
                'logo' => site_url( 'images/logo.png' ),
            ],
            'currency' => $current_currency,
            'currencyType' => $rate['type'],
            'currencyUnit' => $rate['unit'],
            'rateFromUSD' => convert( 1 ),
            'rateFromBTC' => convert( 1, $current_currency, 'BTC' ),
            'theme' => $GLOBALS['theme'],
            'referrals' => $GLOBALS['referrals'],
            'datatables' => [
                'language' => [
                    'lengthMenu' => '_MENU_',
                    'search' => '<i class="fa-solid fa-search"></i> _INPUT_',
                    'info' => '',
                    'infoFiltered' => '',
                ]
            ]
        ];
    ?>
  <script>
  //<![CDATA[
  window.DATA = <?php echo json_encode( $data ); ?>;
  //]]>
  </script>

  <script src="<?php echo esc_url( site_url( 'assets/js/jquery.min.js?v=3.6.0' ) ); ?>"></script>
  <script src="<?php echo esc_url( site_url( 'assets/js/bootstrap.bundle.min.js?v=5.1.3' ) ); ?>"></script>
  <script src="<?php echo esc_url( site_url( 'assets/js/jquery.dataTables.min.js?v=1.11.5' ) ); ?>"></script>
  <script src="<?php echo esc_url( site_url( 'assets/js/dataTables.bootstrap5.min.js?v=1.11.5' ) ); ?>"></script>
  <script src="<?php echo esc_url( site_url( 'assets/js/echarts.min.js?v=5.3.1' ) ); ?>"></script>
  <script src="<?php echo esc_url( get_file_url_for_display( 'assets/js/coin-lite-bootstrap.js' ) ); ?>"></script>
  <?php if ( file_exists( dirname( __DIR__ ) . "/assets/js/pages/$page_view.js" ) ) : ?>
  <script src="<?php echo esc_url( get_file_url_for_display( "assets/js/pages/$page_view.js" ) ); ?>"></script>
  <?php endif; ?>
</body>

</html>
