<?php
/**
 * Template Name: About page
 *
 * The template for displaying about page.
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    WPBootstrap
 * @subpackage Templates
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

<div class="container about__wrapper">
	<div class="row">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
		?>
				<div class="col-lg-6">
					<?php
					if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'wp_bootstrap_post-thumbnail-lg', array(
							'class' => 'img-responsive',
						) );
					endif;
					?>
				</div> <!-- /.col-lg-6 -->
				<div class="col-lg-6">
					<h4><?php the_title(); ?></h4>
					<?php the_content(); ?>
				</div> <!-- /.col-lg-6 -->
			<?php
			endwhile;
		endif;
		?>
	</div> <!-- /.row -->
</div> <!-- /.container -->

<?php get_template_part( 'template-parts/about/team' ); ?>

<?php get_template_part( 'template-parts/home/testimonials' ); ?>

<?php get_template_part( 'template-parts/home/our-clients' ); ?>

<?php get_footer(); ?>
