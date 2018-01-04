<?php
/**
 * FAQ Custom Post Type.
 *
 * @link       https://codex.wordpress.org/Post_Types
 *
 * @package    WPBootstrap
 * @subpackage Core
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

/**
 * Class WPBootstrap_Post_Type_FAQ
 */
class WPBootstrap_PostType_FAQ {

	/**
	 * Stores the custom post type name.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type = 'wpb-faq';

	/**
	 * Stores the public name for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_public_name = 'FAQ';

	/**
	 * Stores the singular name for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_singular_name = 'FAQ';

	/**
	 * Stores the plural name for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_plural_name = 'FAQs';

	/**
	 * Stores the slug for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $post_type_rewrite_slug = 'faq';

	/**
	 * Stores the taxonomies for FAQ custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var array
	 */
	private static $post_type_taxonomies = array( 'category' );

	/**
	 * Store the text domain to be used for custom post type.
	 *
	 * @access private
	 * @since  1.0.0
	 * @var string
	 */
	private static $text_domain = 'wp_bootstrap';

	/**
	 * Initialize FAQ custom post type.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function init_custom_post_type() {
		self::register_custom_post_type();
	}

	/**
	 * Register custom post type called FAQ.
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
			'view_item'          => sprintf( esc_html__( 'View %s', self::$text_domain ), self::$post_type_singular_name ),
			'all_items'          => self::$post_type_plural_name,
			'search_items'       => sprintf( esc_html__( 'Search %s', self::$text_domain ), self::$post_type_public_name ),
			'parent_item_colon'  => esc_html__( 'Parent:', self::$text_domain ),
			'not_found'          => sprintf( esc_html__( 'No %s found', self::$text_domain ), self::$post_type_public_name ),
			'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', self::$text_domain ), self::$post_type_public_name ),
		);

		// Set other options for custom post type.
		$args = array(
			'labels'              => $labels,
			// You can associate this custom post type with a taxonomy or custom taxonomy.
			'taxonomies'          => self::$post_type_taxonomies,
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'query_var'           => true,
			'menu_icon'           => 'dashicons-welcome-write-blog',
			'menu_position'       => 5,
			'capability_type'     => 'post',
			'has_archive'         => false,
			'hierarchical'        => true,
			// Features this custom post type supports in post editor.
			'supports'            => array(
				'title',
				'editor',
				'excerpt',
				'revisions',
				'thumbnail',
			),
			'rewrite'             => array(
				'slug' => self::$post_type_rewrite_slug,
			),
		);

		// Registering your custom post type.
		register_post_type( self::$post_type, $args );
	}
}
