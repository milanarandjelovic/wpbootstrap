<?php
/**
 * WPBootstrap functions and definitions.
 *
 * @link    https://codex.wordpress.org/Functions_File_Explained
 *
 * @package WPBootstrap
 */

/**
 * Bootstrap navwlaker class
 */
require_once get_template_directory() . '/inc/class/wp-bootstrap-navwalker.php';

/**
 * Include custom widgets
 */
require_once get_template_directory() . '/inc/widgets/widget-categories.php';

if ( ! function_exists( 'wp_bootstrap_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wp_bootstrap_setup() {
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
        add_image_size( 'wp_bootstrap_post-thumbnail', 750, 353, true );

        /**
         * Register navigation menus.
         *
         * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
         */
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'wp_bootstrap' ),
        ) );
    }

    add_action( 'after_setup_theme', 'wp_bootstrap_setup' );
endif;


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_widgets_init() {
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
}

add_action( 'widgets_init', 'wp_bootstrap_widgets_init' );

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

/**
 * Modify the read mole link on the_excerpt()
 *
 * @param $length
 *
 * @return int
 */
function wp_bootstrap_excerpt_length( $length ) {
    return 100;
}

add_filter( 'excerpt_length', 'wp_bootstrap_excerpt_length' );

function wp_bootstrap_excerpt_more( $more ) {
    global $post;
    $read_more = '<span class="more-link-holder"><a href="' . get_permalink( $post->ID ) . '" class="btn btn-xs btn-blue more-link">Read More</a></span>';

    return $read_more;
}

add_filter( 'excerpt_more', 'wp_bootstrap_excerpt_more' );
