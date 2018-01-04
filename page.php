<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
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

<div class="container">
	<div class="row">
		<div class="col-md-8">
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
		</div> <!-- /.col-md-8 -->
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div> <!-- /.col-md-4 -->
	</div> <!-- /.row -->
</div> <!-- /.container -->

<?php get_footer(); ?>
