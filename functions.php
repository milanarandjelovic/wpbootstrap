<?php
/**
 * WPBootstrap functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package WPBootstrap
 */

/**
 * Bootstrap navwlaker class
 */
require_once get_template_directory() . '/inc/class/wp-bootstrap-navwalker.php';

if ( ! function_exists( 'wp_bootstrap_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wp_bootstrap_setup() {

    }

    add_action( 'after_setup_theme', 'wp_bootstrap_setup' );
endif;

/**
 * Enqueue scripts and styles.
 */
 function wp_bootstrap_scripts() {
    /**
     * Enqueue Styles
     */
    wp_enqueue_style( 'custom_style', get_template_directory_uri() . '/public/css/style.min.css', array(), '1.0.0', 'all' );

    /**
     * Enqueue Scripts
     */
    wp_enqueue_script( 'custom_script', get_template_directory_uri() . '/public/js/main.min.js', array(), '1.0.0', 'all' );
 }

 add_action( 'wp_enqueue_scripts', 'wp_bootstrap_scripts' );
