<?php
/**
 * Template for display header wrapper.
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

<!-- HEADER -->
<?php if ( ! is_front_page() ) : ?>
	<div class="header__wrapper">
		<div class="container">
			<div class="row">
				<h3 class="header__title">
					<?php wp_title( '', 'true' ); ?>
				</h3>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</div> <!-- /.header__wrapper -->
<?php endif; ?>
<!-- /HEADER -->
