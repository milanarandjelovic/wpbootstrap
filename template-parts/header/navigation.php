<?php
$wp_bootstrap_data = get_option( 'wp_bootstrap_data' );
$nav_back          = $wp_bootstrap_data['wp_bootstrap__navigation-background-color']['background-color'];
?>

<!-- NAVIGATION -->
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: <?php echo $nav_back; ?>">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if ( $wp_bootstrap_data['wp_bootstrap__opt-logo-standard']['url'] !== '' ): ?>
                <a href="<?php echo home_url(); ?>" class="navbar-brand">
                    <img src="<?php echo esc_url( $wp_bootstrap_data['wp_bootstrap__opt-logo-standard']['url'] ) ?>"
                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                         title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>"
                    >
                </a>
            <?php else: ?>
                <a href="<?php echo home_url(); ?>" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
            <?php endif; ?>
        </div> <!-- /.navbar-header -->
        <div class="navbar-collapse collapse navbar-right">
            <?php wp_nav_menu( array(
                'menu'            => 'primary',
                'theme_location'  => 'primary',
                'depth'           => 2,
                'container'       => 'div',
                'container_class' => 'navbar-collapse collapse navbar-right',
                'container_id'    => 'primary',
                'menu_class'      => 'nav navbar-nav',
                'fallback_cb'     => 'wp_bootstrap_navbalker::fallback',
                'walker'          => new wp_bootstrap_navwalker(),
            ) ); ?>
        </div> <!-- /.navbar-collapse -->
    </div> <!-- /.container -->
</nav> <!-- /.navbar -->
<!-- /NAVIGATION -->
