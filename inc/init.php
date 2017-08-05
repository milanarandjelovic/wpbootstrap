<?php
/**
 * WPBootstrap Engine Room.
 * This is where all Theme Functions runs.
 *
 * @package WPBootstrap
 */

/**
 * Bootstrap navwlaker class
 */
require_once get_template_directory() . '/inc/class/wp-bootstrap-navwalker.php';

/**
 * Bootstrap comment navwlaker
 */
require_once get_template_directory() . '/inc/class/wp-bootstrap-comment-walker.php';

/**
 * Include custom widgets
 */
require_once get_template_directory() . '/inc/widgets/widget-categories.php';
require_once get_template_directory() . '/inc/widgets/widget-recent-posts.php';
require_once get_template_directory() . '/inc/widgets/widget-popular-tags.php';
require_once get_template_directory() . '/inc/widgets/widget-social-links.php';

/**
 * Include custom post type
 */
// require_once get_template_directory() . '/inc/post-types/post-type-portfolio.php';

/**
 * Include theme setup function
 */
require_once get_template_directory() . '/inc/functions/function-setup.php';

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
