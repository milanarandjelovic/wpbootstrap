<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

get_header();
?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo home_url(); ?>" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
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

<?php if ( ! is_front_page() ): ?>
    <div class="header__wrapper">
        <div class="container">
            <div class="row">
                <h3 class="header__title"><?php wp_title( '', 'true' ); ?></h3>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.header__wrapper -->
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <strong>
                <?php _e( 'There is no content you are searching for. Try using our search below.', 'wp_bootstrap' ); ?>
            </strong>
            <?php get_search_form(); ?>
        </div> <!-- /.col-md-8 -->
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div> <!-- /.col-md-4 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<?php get_footer(); ?>
