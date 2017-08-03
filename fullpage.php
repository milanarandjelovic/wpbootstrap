<?php
/**
 * Template Name: Full width page
 *
 * The template for full width page.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

get_header();
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

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
        <div class="col-md-12">
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
                        <div class="post__content">
                            <?php the_content(); ?>
                        </div> <!-- /.post_content -->
                        <div class="spacing"></div>
                    </div> <!-- /.post__holder -->
                <?php endwhile;
            endif; ?>
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<?php get_footer(); ?>
