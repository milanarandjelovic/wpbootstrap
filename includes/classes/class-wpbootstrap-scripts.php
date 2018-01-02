<?php
/**
 * Enqueue styles and scripts for WPBootstrap plugin.
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
 * Class WPBootstrap_Scripts
 */
class WPBootstrap_Scripts {

	/**
	 * The theme version.
	 *
	 * @static
	 * @access private
	 * @var string
	 */
	private static $version;

	/**
	 * Register default hooks and actions for WordPress.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function register() {
		self::$version = WPBootstrap::get_theme_version();

		add_action( 'customize_register', array( $this, 'wpbootstrap_customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'wpbootstrap_customize_preview_js' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wpbootstrap_enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function wpbootstrap_enqueue_scripts() {
		// Enqueue styles.
		wp_enqueue_style( 'wpbootstrap-main-style', WPBOOTSTRAP_STYLES_URI . 'main.css', array(), self::$version, 'all' );

		// Enqueue scripts.
		wp_enqueue_script( 'wpbootstrap-main-script', WPBOOTSTRAP_SCRIPTS_URI . 'main.js', array( 'jquery' ), self::$version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @access public
	 * @since  1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function wpbootstrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => bloginfo( 'name' ),
			) );
			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => bloginfo( 'description' ),
			) );
		}
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function wpbootstrap_customize_preview_js() {
		wp_enqueue_script( 'wpbootstrap-main-customizer', WPBOOTSTRAP_SCRIPTS_URI . 'customizer.js', array( 'customize-preview' ), self::$version, true );
	}
}
