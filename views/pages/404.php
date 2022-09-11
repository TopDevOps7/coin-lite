<div id="notfound" class="px-2 py-5">
    <div class="container text-center">
        <h1>
            <?php echo esc_html( __( 'Whoops, 404' ) ); ?>
        </h1>
        <p>
            <?php echo esc_html( __( 'The page you were looking for does not exist' ) ); ?>
        </p>
        <p>
            <a class="btn btn-secondary" href="<?php echo esc_url( site_url() ); ?>">
                <?php echo esc_html( __( 'Get me out of here!' ) ); ?>
            </a>
        </p>
    </div>
</div>