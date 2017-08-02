<?php
/**
 * The template for displaying search results pages.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="section-title">
                <?php esc_html_e( 'Search Results', 'wp_bootstrap' ); ?>
            </h1>
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
    </div>
</div>

<?php get_footer(); ?>
