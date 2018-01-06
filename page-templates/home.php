<?php
/**
 * Template Name: Home page
 *
 * The template for displaying home page.
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

<div class="header__wrapper-home">
	<div class="container">
		<div class="row">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
			?>
					<div class="col-lg-8 col-lg-offset-2">
						<?php the_content(); ?>
					</div> <!-- /.col-lg-8 -->
					<div class="col-lg-8 col-lg-offset-2">
						<?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'wp_bootstrap_post-thumbnail-lg', array(
								'class' => 'img-responsive',
							) );
						endif;
						?>
					</div> <!-- /.col-lg-8 -->
				<?php
				endwhile;
			endif;
			?>
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</div> <!-- /.header__wrapper-home -->

<?php get_template_part( 'template-parts/home/services' ); ?>

<?php
$args = array(
	// Type and Status Parameters.
	'post_type'      => 'portfolio',
	'post_status'    => 'publish',
	'posts_per_page' => 10,
);

$projects = new WP_Query( $args );
?>

<?php if ( $projects->have_posts() ) : ?>
	<div id="portfolio__wrapper">
		<h3>LATEST WORKS</h3>
		<div class="portfolio__centred">
			<div class="recent-items portfolio">
				<?php
				while ( $projects->have_posts() ) :
					$projects->the_post();
				?>
					<div class="portfolio-item">
						<div class="he-wrap tpl6">
							<?php
							$image = '';

							if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'wp_bootstrap_portfolio-thumbnail-project' );
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'wp_bootstrap_portfolio-thumbnail-project' );
							endif;
							?>
							<div class="he-view">
								<div class="bg a0" data-animate="fadeIn">
									<h3 class="a1" data-animate="fadeInDown">
										<?php the_title(); ?>
									</h3>
									<?php if ( '' !== $image ) : ?>
										<a href="<?php echo esc_url( $image[0] ); ?>"
										   data-rel="prettyPhoto"
										   class="dmbutton a2"
										   data-animate="fadeInUp"
										>
											<i class="fa fa-search"></i>
										</a>
									<?php endif; ?>
									<a href="<?php the_permalink(); ?>"
									   class="dmbutton a2"
									   data-animate="fadeInUp"
									>
										<i class="fa fa-link"></i>
									</a>
								</div> <!-- /.bg -->
							</div> <!-- /.he-view -->
						</div> <!-- /.he-wrap -->
					</div>
				<?php endwhile; ?>
			</div> <!-- /.recent-items -->
		</div> <!-- /.portfolio__centred -->
	</div> <!-- /#portfolio__wrapper -->
<?php endif; ?>

<?php get_template_part( 'template-parts/home/middle' ); ?>

<?php get_template_part( 'template-parts/home/testimonials' ); ?>

<?php get_template_part( 'template-parts/home/our-clients' ); ?>

<?php get_footer(); ?>
