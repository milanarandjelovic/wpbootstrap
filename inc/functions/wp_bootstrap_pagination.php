<?php
/**
 * Template for displaying post pagination.
 *
 * @package    WordPress
 * @subpackage WPBootstrap
 * @author     Milan Arandjelovic
 */

/**
 * Displaying post pagination.
 *
 * @param array $args
 *
 * @return bool
 */
function wp_bootstrap_pagination( $args = array() ) {

    $defaults = array(
        'range'           => 4,
        'custom_query'    => false,
        'previous_string' => __( 'Previous', 'wp_bootstrap' ),
        'next_string'     => __( 'Next', 'wp_bootstrap' ),
        'before_output'   => '<div class="post-nav"><ul class="pager">',
        'after_output'    => '</ul></div>',
    );

    $args = wp_parse_args(
        $args,
        apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
    );

    $args['range'] = (int) $args['range'] - 1;

    if ( ! $args['custom_query'] ) {
        $args['custom_query'] = @$GLOBALS['wp_query'];
    }

    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );

    if ( $count <= 1 ):
        return false;
    endif;

    if ( ! $page ):
        $page = 1;
    endif;

    if ( $count > $args['range'] ):
        if ( $page <= $args['range'] ):
            $min = 1;
            $max = $args['range'] + 1;
        elseif ( $page >= ( $count - $ceil ) ):
            $min = $count - $args['range'];
            $max = $count;
        elseif ( $page >= $args['range'] && $page < ( $count - $ceil ) ):
            $min = $page - $ceil;
            $max = $page + $ceil;
        endif;
    else:
        $min = 1;
        $max = $count;
    endif;

    $echo     = '';
    $previous = intval( $page ) - 1;
    $previous = esc_attr( get_pagenum_link( $previous ) );

    $firstpage = esc_attr( get_pagenum_link( 1 ) );

    if ( $firstpage && ( 1 != $page ) ):
        $echo .= '<li class="previous"><a href="' . $firstpage . '">' . __( 'First', 'wp_bootstrap' ) . '</a></li>';
    endif;

    if ( $previous && ( 1 != $page ) ):
        $echo .= '<li><a href="' . $previous . '" title="' . __( 'previous', 'wp_bootstrap' ) . '">' . $args['previous_string'] . '</a></li>';
    endif;

    if ( ! empty( $min ) && ! empty( $max ) ):
        for ( $i = $min; $i <= $max; $i ++ ):
            if ( $page == $i ) :
                $echo .= '<li class="active"><span class="active">' . str_pad( (int) $i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
            else:
                $echo .= sprintf( '<li><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link( $i ) ), $i );
            endif;
        endfor;
    endif;

    $next = intval( $page ) + 1;
    $next = esc_attr( get_pagenum_link( $next ) );

    if ( $next && ( $count != $page ) ):
        $echo .= '<li><a href="' . $next . '" title="' . __( 'next', 'wp_bootstrap' ) . '">' . $args['next_string'] . '</a></li>';
    endif;

    $lastpage = esc_attr( get_pagenum_link( $count ) );

    if ( $lastpage ):
        $echo .= '<li class="next"><a href="' . $lastpage . '">' . __( 'Last', 'wp_bootstrap' ) . '</a></li>';
    endif;

    if ( isset( $echo ) ):
        echo $args['before_output'] . $echo . $args['after_output'];
    endif;
}
