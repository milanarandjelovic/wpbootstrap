<?php
/**
 * FAQ Custom Post Type.
 *
 * @link    https://codex.wordpress.org/Post_Types
 *
 * @package WPBootstrap
 */

/**
 * Enable FAQ Custom Post Type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function wp_bootstrap_cpt_faq() {
    $labels = array(
        'name'               => __( 'FAQs', 'Post Type General Name', 'wp_bootstrap' ),
        'singular_name'      => __( 'FAQ', 'Post Type Singular Name', 'wp_bootstrap' ),
        'menu_name'          => __( 'FAQ', 'wp_bootstrap' ),
        'parent_item_colon'  => __( 'Parent FAQs', 'wp_bootstrap' ),
        'all_items'          => __( 'All FAQs', 'wp_bootstrap' ),
        'view_item'          => __( 'View FAQ', 'wp_bootstrap' ),
        'add_new_item'       => __( 'Add New FAQ', 'wp_bootstrap' ),
        'add_new'            => __( 'Add FAQ', 'wp_bootstrap' ),
        'edit_item'          => __( 'Edit FAQ', 'wp_bootstrap' ),
        'update_item'        => __( 'Update FAQ', 'wp_bootstrap' ),
        'search_items'       => __( 'Search FAQ', 'wp_bootstrap' ),
        'not_found'          => __( 'Not found', 'wp_bootstrap' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'wp_bootstrap' ),
    );

    $args = array(
        'label'               => __( 'faq', 'wp_bootstrap' ),
        'description'         => __( 'FAQ Post Type', 'wp_bootstrap' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    register_post_type( 'faq', $args );
}

add_action( 'init', 'wp_bootstrap_cpt_faq' );
