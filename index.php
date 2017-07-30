<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

<?php get_footer(); ?>
