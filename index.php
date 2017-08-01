<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

get_header();
?>
<!-- NAVIGATION -->
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
    </div> <!-- /.container -->
</nav> <!-- /.navbar -->
<!-- /NAVIGATION -->

<!-- HEADER -->
<?php if ( ! is_front_page() ): ?>
    <div class="header__wrapper">
        <div class="container">
            <div class="row">
                <h3 class="header__title"><?php wp_title( '', 'true' ); ?></h3>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.header__wrapper -->
<?php endif; ?>
<!-- /HEADER -->

<!-- BLOG POST LIST -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if ( have_posts() ):
                while ( have_posts() ): the_post(); ?>
                    <div class="post__holder">
                        <?php if ( has_post_thumbnail() ):
                            the_post_thumbnail( 'wp_bootstrap_post-thumbnail', array(
                                'class' => 'img-responsive',
                            ) );
                        endif; ?>
                        <a href="<?php the_permalink(); ?>">
                            <h3 class="post__title"><?php the_title(); ?></h3>
                        </a>
                        <p>
                            <small class="post__posted_at">Posted: <?php echo get_the_date(); ?></small>
                            |
                            <small class="post__posted_by">By: <?php the_author() ?>
                                - <?php comments_number(); ?></small>
                        </p>
                        <div class="post__content">
                            <?php the_excerpt(); ?>
                        </div> <!-- /.post_content -->
                        <?php if ( ! is_singular() ): ?>
                            <div class="hline"></div>
                        <?php endif; ?>
                        <div class="spacing"></div>
                    </div> <!-- /.post__holder -->
                <?php endwhile;
            endif; ?>
        </div> <!-- /.col-md-8 -->
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div> <!-- /.col-md-4 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
<!-- /BLOG POST LIST -->

<?php get_footer(); ?>
