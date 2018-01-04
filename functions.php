<?php
/**
 * WPBootstrap functions and definitions.
 *
 * @link       https://codex.wordpress.org/Functions_File_Explained
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

define( 'WPBOOTSTRAP_VERSION', '1.0.0' );
define( 'WPBOOTSTRAP_PATH', wp_normalize_path( get_template_directory() ) );
define( 'WPBOOTSTRAP_URI', get_template_directory_uri() );
define( 'WPBOOTSTRAP_ADMIN_URI', WPBOOTSTRAP_URI . '/includes/admin/' );
define( 'WPBOOTSTRAP_STYLES_URI', WPBOOTSTRAP_URI . '/dist/styles/' );
define( 'WPBOOTSTRAP_SCRIPTS_URI', WPBOOTSTRAP_URI . '/dist/scripts/' );

/**
 * Include Redux Framework.
 */
include_once WPBOOTSTRAP_PATH . '/includes/admin/admin-init.php';

/**
 * Include WPBootstrap functions.
 */
include_once WPBOOTSTRAP_PATH . '/includes/wpbootstrap-functions.php';

/**
 * Include autoloader for WPBootstrap theme.
 */
include_once WPBOOTSTRAP_PATH . '/includes/classes/class-wpbootstrap-autoloader.php';

/**
 * Include main class fo WPBootstrap theme.
 */
include_once WPBOOTSTRAP_PATH . '/includes/classes/class-wpbootstrap.php';

/**
 * Instantiate WPBootstrap autoloader.
 */
new WPBootstrap_Autoloader();

/**
 * Register class for WPBootstrap theme.
 */
WPBootstrap::register_services();
