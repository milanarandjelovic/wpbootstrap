<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

<?php get_template_part( 'template-parts/header/header-wrapper' ); ?>

<!-- BLOG POST LIST -->
<div class="container">
	<div class="row">

		<div class="col-md-8">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/posts/content', get_post_format() );
					?>
				<?php endwhile; ?>

				<?php wp_bootstrap_pagination(); ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/posts/content', 'none' ); ?>
			<?php endif; ?>

		</div> <!-- /.col-md-8 -->

		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div> <!-- /.col-md-4 -->

	</div> <!-- /.row -->
</div> <!-- /.container -->
<!-- /BLOG POST LIST -->

<?php get_footer(); ?>
