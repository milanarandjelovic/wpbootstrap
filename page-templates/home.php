<?php
/**
 * Template Name: Home page
 *
 * The template for displaying home page.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

get_header();
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

<div class="header__wrapper-home">
    <div class="container">
        <div class="row">
            <?php if ( have_posts() ):
                while ( have_posts() ): the_post(); ?>
                    <div class="col-lg-8 col-lg-offset-2">
                        <?php the_content(); ?>
                    </div> <!-- /.col-lg-8 -->
                    <div class="col-lg-8 col-lg-offset-2">
                        <?php if ( has_post_thumbnail() ):
                            the_post_thumbnail( 'wp_bootstrap_post-thumbnail-lg', array(
                                'class' => 'img-responsive',
                            ) );
                        endif; ?>
                    </div> <!-- /.col-lg-8 -->
                <?php endwhile;
            endif; ?>
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.header__wrapper-home -->

<?php get_template_part( 'template-parts/home/services' ); ?>

<?php get_template_part( 'template-parts/home/middle' ); ?>

<?php get_template_part( 'template-parts/home/testimonials' ); ?>

<?php get_template_part( 'template-parts/home/our-clients' ); ?>

<?php get_footer(); ?>
