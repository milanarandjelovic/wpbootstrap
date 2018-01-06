<?php
/**
 * Template for display comment navigation.
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

<nav class="comment__navigation">
	<div class="comment__nav-links">

		<div class="comment__nav-previous">
			<?php previous_comments_link( esc_html__( 'Older Comments', 'wp_bootstrap' ) ); ?>
		</div> <!-- /.comment__nav-previous -->

		<div class="comment__nav-next">
			<?php next_comments_link( esc_html__( 'Newer Comments', 'wp_bootstrap' ) ); ?>
		</div> <!-- /.comment__nav-next -->

	</div> <!-- /.comment__nav-links -->
</nav> <!-- /.comment__navigation -->
