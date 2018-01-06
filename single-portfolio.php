<?php
/**
 * The template for displaying all single portfolio post.
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

<?php get_template_part( 'template-parts/header/header-wrapper' ); ?>

<div class="container mt">
	<div class="row">
		<?php $images = ''; ?>
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				$images = get_attached_media( 'image', $post->ID );
				?>
				<?php if ( ! empty( $images ) ) : ?>
				<div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 centred">
					<div id="single-portfolio-carousel" class="carousel slide" data-ride="carousel">

						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php
							$images_count = count( $images );
							for ( $i = 0; $i < $images_count; $i ++ ) :
								?>
								<li data-target="single-portfolio-carousel"
									data-slide-to="<?php echo $i; // WPCS: XSS OK. ?>"
									<?php echo 0 === $i ? 'class="active"' : ''; ?>
								>
								</li>
							<?php endfor; ?>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<?php
							$counter = 0;
							foreach ( $images as $img ) :
								?>
								<div class="item <?php echo 0 === $counter ? 'active' : ''; ?>">
									<img
										src="<?php echo esc_url( wp_get_attachment_image_src( $img->ID, 'wp_bootstrap_portfolio-single-project' )[0] ); ?>"
									/>
								</div> <!-- /.item -->
								<?php $counter ++; ?>
							<?php endforeach; ?>
						</div> <!-- /.carousel-inner -->

					</div> <!-- /#single-portfolio-carousel -->
				</div> <!-- /.col-md-10 -->
			<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div> <!-- /.row -->

	<div class="row">

		<div class="col-lg-5 col-lg-offset-1">
			<div class="spacing"></div>
			<h4><?php the_title(); ?></h4>
			<?php the_content(); ?>
		</div> <!-- /.col-lg-5 -->

		<div class="col-lg-4 col-offset-1">
			<div class="spacing"></div>
			<h4>Project Details</h4>
			<div class="hline"></div>
			<p>
				<b>Date:</b> <?php the_date(); ?>
			</p>
			<p>
				<b>Author:</b> <?php the_author(); ?>
			</p>

			<!-- PORTFOLIO CATEGORIES -->
			<?php
			$categories = get_categories( array(
				'taxonomy' => 'portfolio_category',
			) );

			if ( ! empty( $categories ) ) :
				echo '<p><b>Categories:</b>';
				$is_first_category = true;

				foreach ( $categories as $category ) :
					if ( true !== $is_first_category ) :
						echo ', ';
					endif;

					echo $category->name; // WPCS: XSS OK.
					$is_first_category = false;
				endforeach;
			endif;
			?>
			<!-- /PORTFOLIO CATEGORIES -->

			<!-- PORTFOLIO TAGS -->
			<?php
			$tags = get_categories( array(
				'taxonomy' => 'portfolio_tag',
			) );

			if ( ! empty( $tags ) ) :
				echo '<p><b>Tags:</b>';
				$is_first_tag = true;

				foreach ( $tags as $tag ) :
					if ( true !== $is_first_tag ) :
						echo ', ';
					endif;

					echo $tag->name; // WPCS: XSS OK.
					$is_first_tag = false;
				endforeach;
			endif;
			?>
			<!-- /PORTFOLIO TAGS -->

			<!-- PORTFOLIO CLIENT NAME -->
			<?php
			$client_name = get_post_meta( get_the_ID(), '_wp_bootstrap_portfolio_name', true );

			if ( '' !== $client_name ) :
				echo '<p><b>Client: </b>' . $client_name . '</p>'; // WPCS: XSS OK.
			endif;
			?>
			<!-- /PORTFOLIO CLIENT NAME -->

			<!-- PORTFOLIO CLIENT WEBSITE -->
			<?php
			$client_web = get_post_meta( get_the_ID(), '_wp_bootstrap_portfolio_web', true );

			if ( false === strpos( $client_web, ' http://' ) && false === strpos( $client_web, ' https://' ) ) :
				$client_web = 'http://' . $client_web;
			endif;

			echo '<p><b>Website: </b><a href="' . $client_web . '">' . $client_web . '</a>'; // WPCS: XSS OK.
			?>
			<!-- /PORTFOLIO CLIENT WEBSITE -->

		</div> <!-- /.col-lg-4 -->

	</div> <!-- /.row -->
</div> <!-- /.container -->

<?php
// Define Portfolio Taxonomy.
$taxonomy_portfolio   = array(
	'relation' => 'OR',
);
$portfolio_categories = array();

// Define portfolio categories.
foreach ( $categories as $category ) :
	$portfolio_categories = $category->slug;
endforeach;

$taxonomy_portfolio[] = array(
	'taxonomy' => 'portfolio_category',
	'field'    => 'slug',
	'operator' => 'IN',
	'terms'    => $portfolio_categories,
);

$portfolio_tags = array();

// Define portfolio tags.
foreach ( $tags as $tag ) :
	$portfolio_tags = $tag->slug;
endforeach;

$taxonomy_portfolio[] = array(
	'taxonomy' => 'portfolio_tag',
	'field'    => 'slug',
	'operator' => 'IN',
	'terms'    => $portfolio_tags,
);

$args = array(
	'posts_per_page' => 5,
	'post_type'      => 'portfolio',
	'post_status'    => 'publish',
	'orderby'        => 'rand',
	'post__not_in'   => array( get_the_ID() ),
	'tax_query'      => $taxonomy_portfolio,
);

$related_portfolios = new WP_Query( $args );
?>

<?php if ( $related_portfolios->have_posts() ) : ?>
	<div id="portfolio__wrapper">
		<div class="portfolio__centred">
			<h3>Related Works.</h3>
			<div class="recent-items portfolio">
				<?php
				while ( $related_portfolios->have_posts() ) :
					$related_portfolios->the_post();
					?>
					<div class="portfolio-item">
						<div class="he-wrap tpl6">
							<?php
							$image = '';
							if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'wp_bootstrap_portfolio-thumbnail-project' );
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							endif;
							?>
							<div class="he-view">
								<div class="bg a0" data-animate="fadeIn">
									<h3 class="a1" data-animate="fadeInDown"><?php the_title(); ?></h3>
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

<?php get_footer(); ?>
