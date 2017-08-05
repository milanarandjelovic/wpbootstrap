<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WPBootstrap
 */

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

/**
 * Custom read more button.
 *
 * @param $more
 *
 * @return string
 */
function wp_bootstrap_excerpt_more( $more ) {
    global $post;
    $read_more = '<span class="more-link-holder"><a href="' . get_permalink( $post->ID ) . '" class="btn btn-xs btn-blue more-link">Read More</a></span>';

    return $read_more;
}

add_filter( 'excerpt_more', 'wp_bootstrap_excerpt_more' );

/**
 * Display navigation to next/previous set of post when applicable.
 */
function wp_bootstrap_paging_nav( $args ) {
    $args['previous_string'] = 'previous';
    $args['next_string']     = 'next';

    return $args;
}

add_filter( 'wp_bootstrap_pagination_defaults', 'wp_bootstrap_paging_nav' );

/**
 * Print custom post navigation.
 */
function wp_bootstrap_get_post_navigation() {
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ):
        require get_template_directory() . '/inc/templates/comments/wp-bootstrap-comments-nav.php';
    endif;
}

/**
 * Print custom post comment list.
 */
function wp_bootstrap_get_post_comments_list() {
    require get_template_directory() . '/inc/templates/comments/wp-bootstrap-comments-list.php';
}

/**
 * Print custom post form for non register user.
 */
function wp_bootstrap_get_post_from() {
    require get_template_directory() . '/inc/templates/comments/wp-bootstrap-comments-form.php';
}
