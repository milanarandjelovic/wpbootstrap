<?php

if ( ! function_exists( 'wp_bootstrap_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wp_bootstrap_setup() {

        /*
     * Add Redux Framework
     */
        require get_template_directory() . '/inc/admin/admin-init.php';

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
        set_post_thumbnail_size( 370, 270, true ); // Normal post thumbnails
        add_image_size( 'wp_bootstrap_post-thumbnail-lg', 870, 600, true ); // Large post thumbnails
        add_image_size( 'wp_bootstrap_post-sidebar-thumbnail', 70, 70, true ); // Recent Post thumbnails
        add_image_size( 'wp_bootstrap-thumbnail-sm', 100, 100, true ); // Small thumbnail
        add_image_size( 'wp_bootstrap-thumbnail-md', 170, 170, true ); // Medium thumbnail
        // Portfolio image
        add_image_size( 'wp_bootstrap_portfolio-single-project', 945, 433, true );
        add_image_size( 'wp_bootstrap_portfolio-thumbnail-project', 380, 285, true );

        /**
         * Register navigation menus.
         *
         * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
         */
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'wp_bootstrap' ),
        ) );

        /**
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
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
    }

    add_action( 'after_setup_theme', 'wp_bootstrap_setup' );
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_widgets_init() {
    /**
     * Main Sidebar Widget
     */
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

    /**
     * Footer Widgets
     */
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

    /**
     * Home Widgets
     */
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
