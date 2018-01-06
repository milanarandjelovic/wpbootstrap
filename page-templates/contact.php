<?php
/**
 * Template Name: Contact page
 *
 * The template for displaying contact page.
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

if ( is_active_sidebar( 'wp_bootstrap-contact-sidebar' ) ) :
	$size_sidebar         = 'col-md-4 col-lg-4';
	$size_contact_content = 'col-md-8 col-lg-8';
else :
	$size_sidebar         = '';
	$size_contact_content = 'col-md-12 col-lg-12';
endif;
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

<div id="contact__wrapper">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr( $size_contact_content ); ?>">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
				?>
						<h4><?php the_title(); ?></h4>
						<div class="hline"></div>
						<?php the_content(); ?>
					<?php
					endwhile;
				endif;
				?>
			</div> <!-- /.col-md-8 -->
			<div class="<?php echo esc_attr( $size_sidebar ); ?>">
				<?php if ( is_active_sidebar( 'wp_bootstrap-contact-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'wp_bootstrap-contact-sidebar' ); ?>
				<?php endif; ?>
			</div> <!-- /.col-md-4 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</div> <!-- /#contact_wrap -->

<?php get_footer(); ?>
