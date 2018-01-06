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

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

<?php get_template_part( 'template-parts/header/header-wrapper' ); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<strong>
				<?php esc_attr_e( 'There is no content you are searching for. Try using our search below.', 'wp_bootstrap' ); ?>
			</strong>
			<?php get_search_form(); ?>
		</div> <!-- /.col-md-8 -->
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div> <!-- /.col-md-4 -->
	</div> <!-- /.row -->
</div> <!-- /.container -->

<?php get_footer(); ?>
