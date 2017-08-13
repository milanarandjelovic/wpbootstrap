<div id="home-middle-content" class="container">
    <div class="row">

        <?php if ( is_active_sidebar( 'wp_bootstrap-home-left-sidebar' ) ): ?>
            <div class="col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
                <?php dynamic_sidebar( 'wp_bootstrap-home-left-sidebar' ); ?>
            </div> <!-- /.col-lg-4 -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'wp_bootstrap-home-middle-sidebar' ) ): ?>
            <div class="col-md-3 col-lg-3">
                <?php dynamic_sidebar( 'wp_bootstrap-home-middle-sidebar' ); ?>
            </div> <!-- /.col-lg-3 -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'wp_bootstrap-home-right-sidebar' ) ): ?>
            <div class="col-md-3 col-lg-3">
                <?php dynamic_sidebar( 'wp_bootstrap-home-right-sidebar' ); ?>
            </div> <!-- /.col-lg-3 -->
        <?php endif; ?>

    </div> <!-- /.row -->
</div> <!-- /.container -->
