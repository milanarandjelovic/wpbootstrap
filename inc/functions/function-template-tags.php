<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WPBootstrap
 */

/**
 * Custom read more button.
 *
 * @param $more
 *
 * @return string
 */
function wp_bootstrap_excerpt_more( $more ) {
    global $post;
    $read_more = '';

    return $read_more;
}

add_filter( 'excerpt_more', 'wp_bootstrap_excerpt_more' );

/**
 * Return posted in category and posted by.
 *
 * @return string
 */
function wp_bootstrap_post_meta() {
    $posted_on  = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) );
    $categories = get_the_category();
    $separator  = ', ';
    $output     = '';
    $i          = 1;

    if ( ! empty( $categories ) ):
        foreach ( $categories as $category ):
            if ( $i > 1 ):
                $output .= $separator;
            endif;

            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' .
                       esc_attr( 'View all posts in%s', $category->name ) . '">' . esc_html( $category->name ) .
                       '</a>';
            ++ $i;
        endforeach;
    endif;

    return '<div class="post-header-container"><div class="row"><div class="col-xs-6 col-sm-6 col-md-6">' .
           '<div class="categories-list"><span class="posted-on">Posted <a href="' . esc_url( get_permalink() ) . '">' .
           $posted_on . '</a> ago</span> in <span class="posted-in">' . $output . '</span></div></div>' .
           '<div class="col-xs-6 col-sm-6 col-md-6"><a href="/author/' . get_the_author() . '" class="author-link pull-right">' .
           get_the_author() . '<span class="fa fa-user"></span></a></div></div></div>';
}

/**
 * Return post footer with tags and comments number.
 *
 * @param bool $onlyComments
 *
 * @return string
 */
function wp_bootstrap_post_footer( $onlyComments = false ) {
    $comments_num = get_comments_number();

    if ( comments_open() ) :
        if ( $comments_num == 0 ):
            $comments = __( 'No Comments' );
        elseif ( $comments_num > 1 ):
            $comments = $comments_num . __( ' Comments' );
        else:
            $comments = __( '1 Comment' );
        endif;

        $comments = '<a class="comments-link small text-caps" href="' . get_comments_link() . '">'
                    . $comments .
                    ' <span class="fa fa-comment"></span></a>';
    else:
        $comments = __( 'Comments are closed' );
    endif;

    if ( $onlyComments ):
        return $comments;
    endif;

    return '<div class="post-footer-container"><div class="row"><div class="col-xs-6 col-sm-6 col-md-6">'
           . get_the_tag_list( '<div class="tags-list"><span class="fa fa-tag"></span>', ', ', '</div>' )
           . '</div><div class="col-xs-6 col-sm-6 col-md-6 text-right">' . $comments . '</div></div></div>';
}

/**
 * Display navigation to next/previous set of post when applicable.
 */
function wp_bootstrap_paging_nav( $args ) {
    $args['previous_string'] = '<i class="fa fa-angle-left"></i>';
    $args['next_string']     = '<i class="fa fa-angle-right"></i>';

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
