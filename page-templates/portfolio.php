<?php
/**
 * Template Name: Portfolio page
 *
 * The template for displaying portfolio page.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

get_header();
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

<?php if ( have_posts() ): ?>
    <?php while ( have_posts() ): the_post(); ?>
        <div class="container mtb">
            <div class="row">

                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2><?php echo strip_tags( get_the_content() ); ?></h2>
                    <div class="hline"></div>
                </div> <!-- /.col-lg-8 -->

            </div> <!-- /.row -->
        </div> <!-- /.container -->
    <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part( 'template-parts/portfolio/loop' ); ?>

<?php get_footer(); ?>
