<?php
/**
 * Initialize all WPBootstrap widgets.
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
class WPBootstrap_Widgets_Init {

	/**
	 * Register default hooks and actions for WordPress.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function register() {
		require_once WPBOOTSTRAP_WIDGETS_PATH . 'class-wpbootstrap-widget-all-posts.php';
		require_once WPBOOTSTRAP_WIDGETS_PATH . 'class-wpbootstrap-widget-categories.php';
		require_once WPBOOTSTRAP_WIDGETS_PATH . 'class-wpbootstrap-widget-faq.php';
		require_once WPBOOTSTRAP_WIDGETS_PATH . 'class-wpbootstrap-widget-page.php';
		require_once WPBOOTSTRAP_WIDGETS_PATH . 'class-wpbootstrap-widget-popular-tags.php';
		require_once WPBOOTSTRAP_WIDGETS_PATH . 'class-wpbootstrap-widget-recent-posts.php';
		require_once WPBOOTSTRAP_WIDGETS_PATH . 'class-wpbootstrap-widget-social-links.php';

		add_action( 'init', array( $this, 'wp_bootstrap_register_widgets' ) );
	}

	/**
	 * Register WPBootstrap widgets.
	 */
	public function wp_bootstrap_register_widgets() {
		register_widget( 'WPBootstrap_Widget_All_Posts' );
		register_widget( 'WPBootstrap_Widget_Categories' );
		register_widget( 'WPBootstrap_Widget_FAQ' );
		register_widget( 'WPBootstrap_Widget_Page' );
		register_widget( 'WPBootstrap_Widget_Popular_Tags' );
		register_widget( 'WPBootstrap_Widget_Recent_Posts' );
		register_widget( 'WPBootstrap_Widget_Social_Links' );

		do_action( 'widgets_init' );
	}
}
