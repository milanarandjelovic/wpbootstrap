<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @link       https://developer.wordpress.org/themes/functionality/sidebars/
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

<?php
if ( is_active_sidebar( 'wp_bootstrap-sidebar' ) ) :
	dynamic_sidebar( 'wp_bootstrap-sidebar' );
endif;
