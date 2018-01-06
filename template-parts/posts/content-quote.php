<?php
/**
 * Template part for displaying quote post format.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
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

?>

<article id="<?php the_ID(); ?>" <?php post_class( 'post__holder wp_bootstrap_quote_holder' ); ?>>

	<header class="entry-header">

		<?php echo wp_bootstrap_post_meta(); // WPCS: XSS OK. ?>

		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
				<h1 class="quote-content text-center">
					<a href="<?php the_permalink(); ?>">
						<?php the_content(); ?>
					</a>
					<?php the_title( '<h2 class="quote-author text-center">- ', ' -</h2>' ); ?>
				</h1> <!-- /.quote-content -->
			</div>
		</div>

	</header> <!-- /.entry-header -->

	<footer class="entry-footer">
		<?php echo wp_bootstrap_post_footer(); // WPCS: XSS OK. ?>
	</footer> <!-- /.entry-footer -->

</article>
