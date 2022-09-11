<div id="coin" class="pt-2 pb-5" data-id="<?php echo esc_attr( $coin->id ); ?>"
  data-name="<?php echo esc_attr( $coin->name ); ?>">
  <div class="container">
    <div class="p-3">
      <div class="row justify-content-center">
        <div class="col-auto">
          <div class="d-flex align-content-center">
            <img width="48" height="48" src="<?php echo esc_url( $coin->image ); ?>">
            <div class="ms-2">
              <h1 class="my-0">
                <?php echo esc_html( $coin->name ); ?>
              </h1>
              <div class="badge bg-light text-black"><?php echo esc_html( $coin->symbol ); ?></div>
            </div>
          </div>
        </div>
        <div class="col-auto text-center">
          <h5>
            <?php echo esc_html( __( 'Price' ) ); ?>
          </h5>
          <h4>
            <span id="coin-price" data-price="<?php echo esc_attr( convert( $coin->price ) ); ?>"></span>
          </h4>
        </div>
        <div class="col-auto text-center">
          <h5>
            <?php echo esc_html( __( 'Market Cap' ) ); ?>
          </h5>
          <h4>
            <span data-large-price="<?php echo esc_attr( convert( $coin->market_cap ) ); ?>"></span>
          </h4>
        </div>
        <div class="col-auto text-center">
          <h5>
            <?php // echo esc_html( __( 'Volume 24h' ) ); ?>
            <?php echo esc_html( __( 'Change 30d' ) ); ?>
          </h5>
          <h4 class="<?php echo esc_attr( $coin->change_30d >= 0 ? 'change-up' : 'change-down' ); ?>">
            <span data-change="<?php echo esc_attr( $coin->change_30d ); ?>"></span>
          </h4>
        </div>
      </div>

    </div>
    <!-- <div class="p-3">
      <div class="row text-center justify-content-center">
        <?php if ( isset( $coin->high_24h ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'High 24h' ) ); ?>
          </h6>
          <h5>
            <span data-price="<?php echo esc_attr( convert( $coin->high_24h ) ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
        <?php if ( isset( $coin->low_24h ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'Low 24h' ) ); ?>
          </h6>
          <h5>
            <span data-price="<?php echo esc_attr( convert( $coin->low_24h ) ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
        <?php if ( isset( $coin->change_1h ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'Change 1h' ) ); ?>
          </h6>
          <h5 class="<?php echo esc_attr( $coin->change_1h >= 0 ? 'change-up' : 'change-down' ); ?>">
            <span data-change="<?php echo esc_attr( $coin->change_1h ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
        <?php if ( isset( $coin->change_24h ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'Change 24h' ) ); ?>
          </h6>
          <h5 class="<?php echo esc_attr( $coin->change_24h >= 0 ? 'change-up' : 'change-down' ); ?>">
            <span data-change="<?php echo esc_attr( $coin->change_24h ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
        <?php if ( isset( $coin->change_7d ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'Change 7d' ) ); ?>
          </h6>
          <h5 class="<?php echo esc_attr( $coin->change_7d >= 0 ? 'change-up' : 'change-down' ); ?>">
            <span data-change="<?php echo esc_attr( $coin->change_7d ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
        <?php if ( isset( $coin->change_30d ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'Change 30d' ) ); ?>
          </h6>
          <h5 class="<?php echo esc_attr( $coin->change_30d >= 0 ? 'change-up' : 'change-down' ); ?>">
            <span data-change="<?php echo esc_attr( $coin->change_30d ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
        <?php if ( isset( $coin->supply ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'Supply' ) ); ?>
          </h6>
          <h5>
            <span data-supply="<?php echo esc_attr( $coin->supply ); ?>"
              data-symbol="<?php echo esc_attr( $coin->symbol ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
        <?php if ( isset( $coin->max_supply ) ) : ?>
        <div class="col-auto">
          <h6>
            <?php echo esc_html( __( 'Max Supply' ) ); ?>
          </h6>
          <h5>
            <span data-supply="<?php echo esc_attr( $coin->max_supply ); ?>"
              data-symbol="<?php echo esc_attr( $coin->symbol ); ?>"></span>
          </h5>
        </div>
        <?php endif; ?>
      </div>
    </div> -->

    <div class="mt-4 text-center">
      <button class="btn btn-sm btn-outline-secondary" data-days="1">
        <?php echo esc_html( __( '1D' ) ); ?>
      </button>
      <button class="btn btn-sm btn-outline-secondary" data-days="7">
        <?php echo esc_html( __( '7D' ) ); ?>
      </button>
      <button class="btn btn-sm btn-outline-secondary" data-days="30">
        <?php echo esc_html( __( '1M' ) ); ?>
      </button>
      <button class="btn btn-sm btn-outline-secondary" data-days="180">
        <?php echo esc_html( __( '6M' ) ); ?>
      </button>
      <button class="btn btn-sm btn-outline-secondary" data-days="365">
        <?php echo esc_html( __( '1Y' ) ); ?>
      </button>
      <button class="btn btn-sm btn-outline-secondary" data-days="max">
        <?php echo esc_html( __( 'ALL' ) ); ?>
      </button>
    </div>

    <div id="coin-chart"></div>

    <table id="coin-tickers-table" class="table is-hoverable" style="width: 100%">
      <thead>
        <tr>
          <th><?php echo esc_html( __( 'Exchange' ) ); ?></th>
          <th><?php echo esc_html( __( 'Pair' ) ); ?></th>
          <th class="text-end"><?php echo esc_html( __( 'Price' ) ); ?></th>
          <th class="text-end"><?php echo esc_html( __( 'Spread' ) ); ?></th>
          <th class="text-end"><?php echo esc_html( __( 'Volume 24h' ) ); ?></th>
          <th class="text-end"><?php echo esc_html( __( 'Volume 24h' ) ); ?> (<?php echo esc_html( get_currency() ); ?>)
          </th>
          <th class="text-center"><?php echo esc_html( __( 'Trust' ) ); ?></th>
        </tr>
      </thead>
    </table>
  </div>

</div>
