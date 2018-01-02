<?php
/**
 * Initialize all WPBootstrap post types.
 *
 * @package    WPBootstrap
 * @subpackage Core
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


/**
 * Class WPBootstrap_Widgets_Init
 */
class WPBootstrap_Post_Type_Init {

	/**
	 * Register default hooks and actions for WordPress.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function register() {

		add_action( 'init', array( $this, 'wp_bootstrap_register_post_types' ) );
	}

	/**
	 * Register WPBootstrap widgets.
	 */
	public function wp_bootstrap_register_post_types() {
	}
}
