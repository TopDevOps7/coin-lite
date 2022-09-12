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
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="<?php echo esc_url( site_url() ); ?>">
        <img src="<?php echo esc_url( get_file_url_for_display( $GLOBALS['site']['logo'] ) ); ?>" width="150"
          height="45" alt="<?php echo esc_attr( $GLOBALS['site']['name'] ); ?>" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo esc_url( site_url() ); ?>">
              <?php echo esc_html( __( 'Coins' ) ); ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo esc_url( site_url( PAGE_EXCHANGES ) ); ?>">
              <?php echo esc_html( __( 'Exchanges' ) ); ?>
            </a>
          </li>
        </ul>
        <form class="d-flex">
          <select id="currency-select" class="form-select">
            <?php foreach ( get_rates() as $id => $rate ) : ?>
            <option value="<?php echo esc_attr( $id ); ?>" <?php echo $id === $current_currency ? ' selected' : ''; ?>>
              <?php echo esc_html( $rate['name'] ); ?>
            </option>
            <?php endforeach; ?>
          </select>
        </form>
      </div>
    </div>
  </nav>

  <main>
    <?php include __DIR__ . '/pages/' . $page_view . '.php' ?>
  </main>

  <footer id="footer" class="py-4 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <small>
            ©
            <?php echo esc_html( date( 'Y' ) ); ?>
            <a class="text-decoration-none" href="<?php echo esc_url( site_url() ); ?>">
              <strong><?php echo esc_html( $GLOBALS['site']['name'] ); ?></strong>
            </a>
            —
            <?php echo esc_html( __( 'All rights reserved' ) ); ?>
          </small>
          <div style="font-size: 15px" class="links">
            <a href="<?php echo esc_url( site_url( PAGE_TERMS ) ); ?>">
              <?php echo esc_html( __( 'Terms' ) ); ?>
            </a> | <a href="<?php echo esc_url( site_url( PAGE_DISCLAIMER ) ); ?>">
              <?php echo esc_html( __( 'Disclaimer' ) ); ?>
            </a> | <a href="<?php echo esc_url( site_url( PAGE_PRIVACY_POLICY ) ); ?>">
              <?php echo esc_html( __( 'Privacy Policy' ) ); ?>
            </a> | <a href="<?php echo esc_url( site_url( PAGE_COOKIES_POLICY ) ); ?>">
              <?php echo esc_html( __( 'Cookies Policy' ) ); ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>

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
