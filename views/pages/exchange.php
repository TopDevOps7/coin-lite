<div id="exchange" class="pt-2 pb-5" data-id="<?php echo esc_attr( $exchange->id ); ?>" data-name="<?php echo esc_attr( $exchange->name ); ?>">
    <div class="container">
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-center">
                <img width="48" height="48" src="<?php echo esc_url( $exchange->image ); ?>">
                <h1 class="title is-3 my-0 mx-2">
                    <?php echo esc_html( $exchange->name ); ?>
                </h1>
                <div>
                    <a class="btn btn-sm btn-outline-secondary"
                       href="<?php echo esc_html( $exchange->url ); ?>"
                       data-affiliate="<?php echo esc_attr( $exchange->id ); ?>"
                       target="_blank"
                    >
                        <i class="fas fa-external-link"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="p-3">
            <div class="row text-center justify-content-center">
                <?php if ( ! empty( $exchange->rank ) ) : ?>
                <div class="col-auto">
                    <h6>
                        <?php echo esc_html( __( 'Rank' ) ); ?>
                    </h6>
                    <h5>
                        <?php echo esc_html( $exchange->rank ); ?>
                    </h5>
                </div>
                <?php endif; ?>
                <?php if ( ! empty( $exchange->volume_btc ) ) : ?>
                    <div class="col-auto">
                        <h6>
                            <?php echo esc_html( __( 'Volume 24h' ) ); ?>
                        </h6>
                        <h5>
                            <span data-large-price="<?php echo esc_attr( convert( $exchange->volume_btc, get_currency(), 'BTC' ) ); ?>"></span>
                        </h5>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $exchange->trust_score ) ) : ?>
                    <div class="col-auto">
                        <h6>
                            <?php echo esc_html( __( 'Trust' ) ); ?>
                        </h6>
                        <h5>
                            <?php
                            if ( $exchange->trust_score > 7 ) {
                                $color = 'green';
                            } elseif ( $exchange->trust_score > 4 ) {
                                $color = 'yellow';
                            } elseif ( $exchange->trust_score > 0 ) {
                                $color = 'red';
                            } else {
                                $color = '';
                            }
                            ?>
                            <strong class="badge score is-rounded <?php echo esc_attr( $color ); ?>">
                                <?php echo esc_html( $exchange->trust_score ); ?>
                            </strong>
                        </h5>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $exchange->since ) ) : ?>
                    <div class="col-auto">
                        <h6>
                            <?php echo esc_html( __( 'Since' ) ); ?>
                        </h6>
                        <h5>
                            <?php echo esc_html( $exchange->since ); ?>
                        </h5>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $exchange->country ) ) : ?>
                    <div class="col-auto">
                        <h6>
                            <?php echo esc_html( __( 'Country' ) ); ?>
                        </h6>
                        <h5>
                            <?php echo esc_html( $exchange->country ); ?>
                        </h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>

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
        </div>

        <div id="exchange-chart"></div>

        <table id="exchange-tickers-table" class="table is-hoverable" style="width: 100%">
            <thead>
            <tr>
                <th><?php echo esc_html( __( 'Pair' ) ); ?></th>
                <th class="text-end"><?php echo esc_html( __( 'Price' ) ); ?></th>
                <th class="text-end"><?php echo esc_html( __( 'Spread' ) ); ?></th>
                <th class="text-end"><?php echo esc_html( __( 'Volume 24h' ) ); ?></th>
                <th class="text-end"><?php echo esc_html( __( 'Volume 24h' ) ); ?> (<?php echo esc_html( get_currency() ); ?>)</th>
                <th class="text-center"><?php echo esc_html( __( 'Trust' ) ); ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>