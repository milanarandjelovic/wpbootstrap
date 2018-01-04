<?php
/**
 * Portfolio Custom Post Type.
 *
 * @link       https://codex.wordpress.org/Post_Types
 *
 * @package    WPBootstrap
 * @subpackage Core
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

/**
 * Class WPBootstrap_Post_Type_Portfolio
 */
class WPBootstrap_PostType_Portfolio {

	/**
	 * Stores the custom post type name.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type = 'wpb-portfolio';

	/**
	 * Stores the public name for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_public_name = 'Portfolio';

	/**
	 * Stores the singular name for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_singular_name = 'Portfolio';

	/**
	 * Stores the plural name for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_plural_name = 'Portfolios';

	/**
	 * Stores the slug for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_rewrite_slug = 'portfolio';

	/**
	 * Stores the category taxonomies for Portfolio custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_category_taxonomy = 'portfolio_category';

	/**
	 * Stores the tag taxonomies for Portfolio custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_tag_taxonomy = 'portfolio_tag';

	/**
	 * Store the text domain to be used for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $text_domain = 'wp_bootstrap';

	/**
	 * Initialize Portfolio custom post type.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function init_custom_post_type() {
		self::register_custom_post_type();
		self::register_custom_portfolio_category();
		self::register_custom_portfolio_tag();
	}

	/**
	 * Register custom post type called Portfolio.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function register_custom_post_type() {
		// Set UI labels for Custom post type.
		$labels = array(
			'name'               => self::$post_type_plural_name,
			'singular_name'      => self::$post_type_singular_name,
			'menu_name'          => self::$post_type_public_name,
			'name_admin_bar'     => self::$post_type_public_name,
			'add_new'            => esc_html_x( 'Add New', 'location post type', self::$text_domain ),
			'add_new_item'       => sprintf( esc_html__( 'Add New %s', self::$text_domain ), self::$post_type_singular_name ),
			'new_item'           => sprintf( esc_html__( 'New %s', self::$text_domain ), self::$post_type_singular_name ),
			'edit_item'          => sprintf( esc_html__( 'Edit %s', self::$text_domain ), self::$post_type_singular_name ),
			'update_item'        => sprintf( esc_html__( 'Update %s', self::$text_domain ), self::$post_type_singular_name ),
			'view_item'          => sprintf( esc_html__( 'View %s', self::$text_domain ), self::$post_type_singular_name ),
			'all_items'          => self::$post_type_plural_name,
			'search_items'       => sprintf( esc_html__( 'Search %s', self::$text_domain ), self::$post_type_public_name ),
			'parent_item_colon'  => esc_html__( 'Parent:', self::$text_domain ),
			'not_found'          => sprintf( esc_html__( 'No %s found', self::$text_domain ), self::$post_type_public_name ),
			'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', self::$text_domain ), self::$post_type_public_name ),
		);

		// Set other options for custom post type.
		$args = array(
			'label'               => __( self::$post_type_plural_name, self::$text_domain ),
			'labels'              => $labels,
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'menu_icon'           => 'dashicons-welcome-write-blog',
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 7,
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => true,
			'can_export'          => true,
			// Features this custom post type supports in post editor.
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
			),
			'rewrite'             => array(
				'slug' => self::$post_type_rewrite_slug,
			),
		);

		// Registering your custom post type.
		register_post_type( self::$post_type, $args );
	}

	/**
	 * Register custom category for post type called Portfolio.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function register_custom_portfolio_category() {
		$labels = array(
			'name'                       => sprintf( esc_html__( ' %s Categories', self::$text_domain ), self::$post_type_singular_name ),
			'singular_name'              => sprintf( esc_html__( ' %s Category', self::$text_domain ), self::$post_type_singular_name ),
			'menu_name'                  => sprintf( esc_html__( ' %s Category', self::$text_domain ), self::$post_type_singular_name ),
			'edit_item'                  => sprintf( esc_html__( 'Edit %s', self::$text_domain ), self::$post_type_singular_name ),
			'update_item'                => sprintf( esc_html__( 'Update %s', self::$text_domain ), self::$post_type_singular_name ),
			'add_new_item'               => sprintf( esc_html__( 'Add New %s', self::$text_domain ), self::$post_type_singular_name ),
			'new_item_name'              => sprintf( esc_html__( 'New %s Category', self::$text_domain ), self::$post_type_singular_name ),
			'parent_item'                => sprintf( esc_html__( 'Parent %s Category', self::$text_domain ), self::$post_type_singular_name ),
			'parent_item_colon'          => sprintf( esc_html__( 'Parent %s Category:', self::$text_domain ), self::$post_type_singular_name ),
			'all_items'                  => sprintf( esc_html__( 'All %s Categories', self::$text_domain ), self::$post_type_singular_name ),
			'search_items'               => sprintf( esc_html__( 'Search %s Categories', self::$text_domain ), self::$post_type_singular_name ),
			'popular_items'              => sprintf( esc_html__( 'Popular %s Categories', self::$text_domain ), self::$post_type_singular_name ),
			'separate_items_with_commas' => sprintf( esc_html__( 'Separate %s Categories with commas', self::$text_domain ), self::$post_type_singular_name ),
			'add_or_remove_items'        => sprintf( esc_html__( 'Add or remove %s Categories', self::$text_domain ), self::$post_type_singular_name ),
			'choose_from_most_used'      => sprintf( esc_html__( 'Choose from the most used %s Categories', self::$text_domain ), self::$post_type_singular_name ),
			'not_found'                  => __( 'No categories found.', self::$text_domain ),
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		);

		register_taxonomy( self::$post_type_category_taxonomy, self::$post_type, $args );
	}

	/**
	 * Register custom tag for post type called Portfolio.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function register_custom_portfolio_tag() {
		$labels = array(
			'name'                       => sprintf( esc_html__( ' %s Tags', self::$text_domain ), self::$post_type_singular_name ),
			'singular_name'              => sprintf( esc_html__( ' %s Tag', self::$text_domain ), self::$post_type_singular_name ),
			'menu_name'                  => sprintf( esc_html__( ' %s Tag', self::$text_domain ), self::$post_type_singular_name ),
			'edit_item'                  => sprintf( esc_html__( 'Edit %s', self::$text_domain ), self::$post_type_singular_name ),
			'update_item'                => sprintf( esc_html__( 'Update %s', self::$text_domain ), self::$post_type_singular_name ),
			'add_new_item'               => sprintf( esc_html__( 'Add New %s', self::$text_domain ), self::$post_type_singular_name ),
			'new_item_name'              => sprintf( esc_html__( 'New %s Tag', self::$text_domain ), self::$post_type_singular_name ),
			'parent_item'                => sprintf( esc_html__( 'Parent %s Tag', self::$text_domain ), self::$post_type_singular_name ),
			'parent_item_colon'          => sprintf( esc_html__( 'Parent %s Tag:', self::$text_domain ), self::$post_type_singular_name ),
			'all_items'                  => sprintf( esc_html__( 'All %s Tags', self::$text_domain ), self::$post_type_singular_name ),
			'search_items'               => sprintf( esc_html__( 'Search %s Tags', self::$text_domain ), self::$post_type_singular_name ),
			'popular_items'              => sprintf( esc_html__( 'Popular %s Tags', self::$text_domain ), self::$post_type_singular_name ),
			'separate_items_with_commas' => sprintf( esc_html__( 'Separate %s Tags with commas', self::$text_domain ), self::$post_type_singular_name ),
			'add_or_remove_items'        => sprintf( esc_html__( 'Add or remove %s Tags', self::$text_domain ), self::$post_type_singular_name ),
			'choose_from_most_used'      => sprintf( esc_html__( 'Choose from the most used %s Tags', self::$text_domain ), self::$post_type_singular_name ),
			'not_found'                  => __( 'No categories found.', self::$text_domain ),
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		);

		register_taxonomy( self::$post_type_tag_taxonomy, self::$post_type, $args );
	}
}
