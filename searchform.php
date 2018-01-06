<?php
/**
 * Template for display search form.
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
<form role="search" method="get" class="search-form" action="<?php home_url(); ?>">
	<input type="search" id="s" name="s" class="form-control" value=""
		placeholder="<?php esc_attr_e( 'Search Something', 'wp_bootstrap' ); ?>"
	>
</form> <!-- /.search-form -->
