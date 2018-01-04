<?php
/**
 * The template for displaying search results pages.
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package    WPBootstrap
 * @subpackage Templates
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

get_header();
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

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
