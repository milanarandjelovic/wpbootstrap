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
							$imagesCount = count( $images );
							for ( $i = 0; $i < $imagesCount; $i ++ ):
								?>
								<li data-target="single-portfolio-carousel"
								    data-slide-to="<?php echo $i; ?>"
									<?php echo $i == 0 ? 'class="active"' : ''; ?>
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
								<div class="item <?php echo $counter == 0 ? 'active' : ''; ?>">
									<img
										src="<?php echo wp_get_attachment_image_src(
											$img->ID,
											'wp_bootstrap_portfolio-single-project'
										)[0]; ?>"
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
			$categories = get_categories( array( 'taxonomy' => 'portfolio_category' ) );

			if ( ! empty( $categories ) ) :
				echo '<p><b>Categories:</b>';
				$isFirstCategory = true;

				foreach ( $categories as $category ):
					if ( $isFirstCategory != true ):
						echo ', ';
					endif;

					echo $category->name;
					$isFirstCategory = false;
				endforeach;
			endif;
			?>
			<!-- /PORTFOLIO CATEGORIES -->

			<!-- PORTFOLIO TAGS -->
			<?php $tags = get_categories( array( 'taxonomy' => 'portfolio_tag' ) );

			if ( ! empty( $tags ) ):
				echo '<p><b>Tags:</b>';
				$isFirstTag = true;

				foreach ( $tags as $tag ):
					if ( $isFirstTag != true ):
						echo ', ';
					endif;

					echo $tag->name;
					$isFirstTag = false;
				endforeach;
			endif;
			?>
			<!-- /PORTFOLIO TAGS -->

			<!-- PORTFOLIO CLIENT NAME -->
			<?php $clientName = get_post_meta( get_the_ID(), '_wp_bootstrap_portfolio_name', true );

			if ( $clientName != '' ):
				echo '<p><b>Client: </b>' . $clientName . '</p>';
			endif;
			?>
			<!-- /PORTFOLIO CLIENT NAME -->

			<!-- PORTFOLIO CLIENT WEBSITE -->
			<?php $clientWeb = get_post_meta( get_the_ID(), '_wp_bootstrap_portfolio_web', true );

			if ( strpos( $clientWeb, " http://" ) === false && strpos( $clientWeb, " https://" ) === false ):
				$clientWeb = "http://" . $clientWeb;
			endif;

			echo '<p><b>Website: </b><a href="' . $clientWeb . '">' . $clientWeb . '</a>';
			?>
			<!-- /PORTFOLIO CLIENT WEBSITE -->

		</div> <!-- /.col-lg-4 -->

	</div> <!-- /.row -->
</div> <!-- /.container -->

<?php
// Define Portfolio Taxonomy
$taxonomyPortfolio   = array( 'relation' => 'OR' );
$portfolioCategories = array();

// Define portfolio categories
foreach ( $categories as $category ):
	$portfolioCategories = $category->slug;
endforeach;

$taxonomyPortfolio[] = array(
	'taxonomy' => 'portfolio_category',
	'field'    => 'slug',
	'operator' => 'IN',
	'terms'    => $portfolioCategories,
);

$portfolioTags = array();

// Define portfolio tags
foreach ( $tags as $tag ):
	$portfolioTags = $tag->slug;
endforeach;

$taxonomyPortfolio[] = array(
	'taxonomy' => 'portfolio_tag',
	'field'    => 'slug',
	'operator' => 'IN',
	'terms'    => $portfolioTags,
);

$args = array(
	'posts_per_page' => 5,
	'post_type'      => 'portfolio',
	'post_status'    => 'publish',
	'orderby'        => 'rand',
	'post__not_in'   => array( get_the_ID() ),
	'tax_query'      => $taxonomyPortfolio,
);

$relatedPortfolios = new WP_Query( $args );
?>

<?php if ( $relatedPortfolios->have_posts() ): ?>
	<div id="portfolio__wrapper">
		<div class="portfolio__centred">
			<h3>Related Works.</h3>
			<div class="recent-items portfolio">
				<?php while ( $relatedPortfolios->have_posts() ): $relatedPortfolios->the_post(); ?>
					<div class="portfolio-item">
						<div class="he-wrap tpl6">
							<?php
							$image = '';
							if ( has_post_thumbnail() ):
								the_post_thumbnail( 'wp_bootstrap_portfolio-thumbnail-project' );
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							endif;
							?>
							<div class="he-view">
								<div class="bg a0" data-animate="fadeIn">
									<h3 class="a1" data-animate="fadeInDown"><?php the_title(); ?></h3>
									<?php if ( $image != '' ): ?>
										<a href="<?php echo $image[0]; ?>"
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
