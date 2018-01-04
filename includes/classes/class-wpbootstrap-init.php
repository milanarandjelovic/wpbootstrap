<?php
/**
 * Adding theme support for WPBootstrap theme.
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
 * Setup class for adding theme support.
 */
class WPBootstrap_Init {

	/**
	 * Register default hooks and actions for WordPress.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ), 10 );
		add_action( 'after_setup_theme', array( $this, 'register_navigation_menus' ) );
		add_action( 'widgets_init', array( $this, 'widget_init' ) );
		add_action( 'widgets_init', array( $this, 'wp_bootstrap_register_widgets' ) );
		add_action( 'after_setup_theme', array( $this, 'load_theme_text_domain' ) );
		add_action( 'after_setup_theme', array( $this, 'wp_bootstrap_content_width' ), 0 );
	}

	/**
	 * Sets up theme defaults and register support for various WordPress
	 * features.
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * run before the init hook.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function add_theme_support() {
		/**
		 * Add default posts and comments RSS feed links to head.
		 *
		 * @links https://developer.wordpress.org/reference/functions/add_theme_support/#feed-links
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 370, 270, true ); // Normal post thumbnails.
		add_image_size( 'wp_bootstrap_post-thumbnail-lg', 870, 600, true ); // Large post thumbnails.
		add_image_size( 'wp_bootstrap_post-sidebar-thumbnail', 70, 70, true ); // Recent Post thumbnails.
		add_image_size( 'wp_bootstrap-thumbnail-sm', 100, 100, true ); // Small thumbnail.
		add_image_size( 'wp_bootstrap-thumbnail-md', 170, 170, true ); // Medium thumbnail.
		// Portfolio image.
		add_image_size( 'wp_bootstrap_portfolio-single-project', 945, 433, true ); // Single Portfolio thumbnail.
		add_image_size( 'wp_bootstrap_portfolio-thumbnail-project', 380, 285, true ); // Portfolio thumbnail.

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Set up the WordPress core custom background feature.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
		 */
		add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/**
		 * Add theme support for selective refresh for widgets.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Enable support for Post Formats.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		) );

		/**
		 * When you enable Custom Headers in your theme, users can change their header image using the WordPress
		 * theme Customizer. This gives users more control and flexibility over the look of their site.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
		 */
		add_theme_support( 'custom-header' );
	}

	/**
	 * Register navigation menu for WPBootstrap theme.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function register_navigation_menus() {
		/**
		 * This theme uses wp_nav_menu() in two location.
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'wp_bootstrap' ),
		) );
	}

	/**
	 * Register widget area.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function widget_init() {
		/*********************************************************************************
		 * Main widget area.
		 ******************************************************************************** */
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-sidebar',
			'description'   => esc_html__( 'Main Sidebar that appears on posts, pages, archives.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '<div class="spacing"></div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline"></div>',
		) );

		/*********************************************************************************
		 * Footer widget areas.
		 ******************************************************************************** */
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Left Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-footer-left-sidebar',
			'description'   => esc_html__( 'Left Sidebar that appears on left side of footer.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline-w"></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Middle Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-footer-middle-sidebar',
			'description'   => esc_html__( 'Middle Sidebar that appears on middle of footer.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline-w"></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Right Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-footer-right-sidebar',
			'description'   => esc_html__( 'Right Sidebar that appears on right side of footer.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline-w"></div>',
		) );

		/*********************************************************************************
		 * Home Widgets.
		 ******************************************************************************** */
		register_sidebar( array(
			'name'          => esc_html__( 'Home Left Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-home-left-sidebar',
			'description'   => esc_html__( 'Left Sidebar that appears on left side of home page.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline"></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Middle Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-home-middle-sidebar',
			'description'   => esc_html__( 'Left Sidebar that appears on middle side of home page.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline"></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Right Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-home-right-sidebar',
			'description'   => esc_html__( 'Right Sidebar that appears on right side of home page.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline"></div>',
		) );

		/*********************************************************************************
		 * Contact Widget.
		 ******************************************************************************** */
		register_sidebar( array(
			'name'          => esc_html__( 'Contact Sidebar', 'wp_bootstrap' ),
			'id'            => 'wp_bootstrap-contact-sidebar',
			'description'   => esc_html__( 'Contact Sidebar that appears on contact page.', 'wp_bootstrap' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '<div class="spacing"></div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4><div class="hline"></div>',
		) );
	}

	/**
	 * Load theme domain for Codex theme
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function load_theme_text_domain() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Codex, use a find and replace
		 * to change 'codex' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp_bootstrap', WPBOOTSTRAP_PATH . '/languages' );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @access public
	 * @since  1.0.0
	 * @global int $content_width
	 */
	public function wp_bootstrap_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'wp_bootstrap_content_width', 640 );
	}

	/**
	 * Register WPBootstrap widgets.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function wp_bootstrap_register_widgets() {
		register_widget( 'WPBootstrap_Widget_All_Posts' );
		register_widget( 'WPBootstrap_Widget_Categories' );
		register_widget( 'WPBootstrap_Widget_FAQ' );
		register_widget( 'WPBootstrap_Widget_Page' );
		register_widget( 'WPBootstrap_Widget_Popular_Tags' );
		register_widget( 'WPBootstrap_Widget_Recent_Posts' );
		register_widget( 'WPBootstrap_Widget_Social_Links' );
	}
}
