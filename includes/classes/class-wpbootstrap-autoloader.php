<?php
/**
 * Autoloader class for WPBootstrap theme.
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
 * Class Wpbootstrap_Autoloader
 */
class WPBootstrap_Autoloader {

	/**
	 * The path to the "includes" folder inside the theme.
	 *
	 * @access protected
	 * @since  1.0.0
	 * @var string
	 */
	protected static $wpbootstrap_includes_path;

	/**
	 * Wpbootstrap_Autoloader constructor.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function __construct() {
		// Get path for classes.
		self::$wpbootstrap_includes_path = WPBOOTSTRAP_PATH . '/includes/classes/';
		// Register our autoloader.
		spl_autoload_register( array( $this, 'include_class_file' ) );
	}

	/**
	 * Get the path & include the file for the class.
	 *
	 * @access public
	 * @since  1.0.0
	 *
	 * @param string $class_name The class-name we're looking for.
	 */
	public function include_class_file( $class_name ) {
		$path = $this->get_path( $class_name );
		// If the path was not found, early exit.
		if ( false === $path ) {
			return;
		}
		// Include the path.
		if ( file_exists( $path ) ) {
			include_once wp_normalize_path( $path );

			return;
		}
	}

	/**
	 * Gets the path for a specific class name.
	 *
	 * @access public
	 * @since  1.0.0
	 *
	 * @param string $class_name The class-name we're looking for.
	 *
	 * @return bool|mixed|string The full path to the class, or false if not found.
	 */
	protected function get_path( $class_name ) {
		$paths = array();
		if ( 0 === stripos( $class_name, 'WPBootstrap' ) ) {
			$filename      = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';
			$paths[]       = self::$wpbootstrap_includes_path . $filename;
			$sub_str       = str_replace( 'WPBootstrap_', '', $class_name );
			$exploded      = explode( '_', $sub_str );
			$levels        = count( $exploded );
			$previous_path = '';

			for ( $i = 0; $i < $levels; $i ++ ) {
				$paths[]       = self::$wpbootstrap_includes_path . $previous_path . strtolower( $exploded[ $i ] ) . '/' . $filename;
				$previous_path .= strtolower( $exploded[ $i ] ) . '/';
			}

			foreach ( $paths as $path ) {
				$path = wp_normalize_path( $path );

				if ( file_exists( $path ) ) {
					return $path;
				}
			}
		}

		return false;
	}
}
