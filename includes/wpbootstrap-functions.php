<?php
/**
 * Custom WPBootstrap functions.
 *
 * @package    WPBootstrap
 * @subpackage Core
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/*********************************************************************************
 * Template Tags
 ******************************************************************************** */
if ( ! function_exists( 'wp_bootstrap_excerpt_more' ) ) {
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
}

if ( ! function_exists( 'wp_bootstrap_post_meta' ) ) {
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

		if ( ! empty( $categories ) ) :
			foreach ( $categories as $category ) :
				if ( $i > 1 ) :
					$output .= $separator;
				endif;

				$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' .
				           esc_attr( 'View all posts in%s', $category->name ) . '"
						>'
				           . esc_html( $category->name ) .
				           '</a>';
				++ $i;
			endforeach;
		endif;

		return '<div class="post-header-container">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="categories-list">
								<span class="posted-on">Posted 
									<a href="' . esc_url( get_permalink() ) . '">' . $posted_on . '</a> ago
								</span> in 
								<span class="posted-in">' . $output . '</span>
							</div>
						</div><!-- /.col-md-6 -->
						<div class="col-xs-6 col-sm-6 col-md-6">
							<a href="/author/' . get_the_author() . '" class="author-link pull-right">' . get_the_author() .
		       '<span class="fa fa-user"></span>
							</a>
						</div><!-- /.col-md-6 -->
					</div><!-- /.row -->
				</div><!-- /.post-header-container -->';
	}
}

if ( ! function_exists( 'wp_bootstrap_post_footer' ) ) {
	/**
	 * Return post footer with tags and comments number.
	 *
	 * @param bool $only_comments Only comments.
	 *
	 * @return string
	 */
	function wp_bootstrap_post_footer( $only_comments = false ) {
		$comments_num = get_comments_number();

		if ( comments_open() ) :
			if ( 0 === $comments_num ) :
				$comments = __( 'No Comments' );
			elseif ( 1 < $comments_num ) :
				$comments = $comments_num . __( ' Comments' );
			else :
				$comments = __( '1 Comment' );
			endif;

			$comments = '<a class="comments-link small text-caps" href="' . get_comments_link() . '">' . $comments .
			            '<span class="fa fa-comment"></span>
						</a>';
		else :
			$comments = __( 'Comments are closed' );
		endif;

		if ( $only_comments ) :
			return $comments;
		endif;

		return '<div class="post-footer-container">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">'
		       . get_the_tag_list( '<div class="tags-list"><span class="fa fa-tag"></span>', ', ', '</div>' ) .
		       '</div><!-- /.col-md-6 -->
						<div class="col-xs-6 col-sm-6 col-md-6 text-right">'
		       . $comments .
		       '</div><!-- /.col-md-6 -->
					</div><!-- /.row -->
				</div><!-- /.post-footer-container -->';
	}
}

if ( ! function_exists( 'wp_bootstrap_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of post when applicable.
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	function wp_bootstrap_paging_nav( $args ) {
		$args['previous_string'] = '<i class="fa fa-angle-left"></i>';
		$args['next_string']     = '<i class="fa fa-angle-right"></i>';

		return $args;
	}

	add_filter( 'wp_bootstrap_pagination_defaults', 'wp_bootstrap_paging_nav' );
}

if ( ! function_exists( 'wp_bootstrap_get_post_navigation' ) ) {
	/**
	 * Print custom post navigation.
	 */
	function wp_bootstrap_get_post_navigation() {
		if ( 1 < get_comment_pages_count() && get_option( 'page_comments' ) ) :
			require get_template_directory() . '/template-parts/comments/wp-bootstrap-comments-nav.php';
		endif;
	}
}

if ( ! function_exists( 'wp_bootstrap_get_post_comments_list' ) ) {
	/**
	 * Print custom post comment list.
	 */
	function wp_bootstrap_get_post_comments_list() {
		require get_template_directory() . '/template-parts/comments/wp-bootstrap-comments-list.php';
	}
}

if ( ! function_exists( 'wp_bootstrap_get_post_from' ) ) {
	/**
	 * Print custom post form for non register user.
	 */
	function wp_bootstrap_get_post_from() {
		require get_template_directory() . '/template-parts/comments/wp-bootstrap-comments-form.php';
	}
}

if ( ! function_exists( 'wp_bootstrap_the_testimonial' ) ) {
	/**
	 * Return testimonial.
	 *
	 * @param $testimonial
	 */
	function wp_bootstrap_the_testimonial( $testimonial ) {
		?>
		<p><?php echo strip_tags( $testimonial->post_content ); ?></p>
		<h4><?php echo $testimonial->post_title; ?></h4>
		<?php
		$post_id   = $testimonial->ID;
		$clientWeb = get_post_meta( $post_id, '_wp_bootstrap_testimonial_web', true );
		$client    = '';

		$client .= $clientWeb;
		?>
		<p><?php echo $client; ?></p>
		<?php
	}
}

/*********************************************************************************
 * Attachments Functions
 ******************************************************************************** */
if ( ! function_exists( 'wp_bootstrap_attachment_new_field' ) ) {
	/**
	 * Adding our custom filed to the $form_fields array.
	 *
	 * @param $form_fields
	 * @param $post
	 *
	 * @return array
	 */
	function wp_bootstrap_attachment_new_field( $form_fields, $post ) {
		$check_meta = get_post_meta( $post->ID, '_wp_bootstrap_client_image', true );

		$form_fields['wp_bootstrap_client_image']['label'] = __( 'Client Image?', 'wp_bootstrap' );
		$form_fields['wp_bootstrap_client_image']['input'] = 'html';

		$form_fields['wp_bootstrap_client_image']['html'] = "<input type='radio' style='width: auto' value='0' " . "name='attachments[{$post->ID}][wp_bootstrap_client_image]' " .
		                                                    checked( $check_meta, '0',
			                                                    false ) . " " . checked( $check_meta, '', false ) .
		                                                    "id='attachments[{$post->ID}][wp_bootstrap_client_image]'" . "> No<br><input type='radio' style='width: auto' value='1' " .
		                                                    checked( $check_meta, '1',
			                                                    false ) . " " . "name='attachments[{$post->ID}][wp_bootstrap_client_image]'" .
		                                                    "id='attachments[{$post->ID}][wp_bootstrap_client_image]'" . "> Yes";;

		return $form_fields;
	}

	add_filter( 'attachment_fields_to_edit', 'wp_bootstrap_attachment_new_field', null, 2 );
}

if ( ! function_exists( 'wp_bootstrap_attachment_fields_to_save' ) ) {
	/**
	 * Save attachments.
	 *
	 * @param $post
	 * @param $attachment
	 *
	 * @return mixed
	 */
	function wp_bootstrap_attachment_fields_to_save( $post, $attachment ) {
		if ( isset( $attachment['wp_bootstrap_client_image'] ) ):
			update_post_meta( $post['ID'], '_wp_bootstrap_client_image', $attachment['wp_bootstrap_client_image'] );
		endif;

		return $post;
	}

	add_filter( 'attachment_fields_to_save', 'wp_bootstrap_attachment_fields_to_save', null, 2 );
}

/*********************************************************************************
 * Custom WPBootstrap Functions
 ******************************************************************************** */
if ( ! function_exists( 'wp_bootstrap_pagination' ) ) {
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

		if ( $count <= 1 ) :
			return false;
		endif;

		if ( ! $page ) :
			$page = 1;
		endif;

		if ( $count > $args['range'] ) :
			if ( $page <= $args['range'] ) :
				$min = 1;
				$max = $args['range'] + 1;
			elseif ( $page >= ( $count - $ceil ) ) :
				$min = $count - $args['range'];
				$max = $count;
			elseif ( $page >= $args['range'] && $page < ( $count - $ceil ) ) :
				$min = $page - $ceil;
				$max = $page + $ceil;
			endif;
		else :
			$min = 1;
			$max = $count;
		endif;

		$echo     = '';
		$previous = intval( $page ) - 1;
		$previous = esc_attr( get_pagenum_link( $previous ) );

		$first_page = esc_attr( get_pagenum_link( 1 ) );

		if ( $first_page && ( 1 !== $page ) ) :
			$echo .= '<li class="previous">
						<a href="' . $first_page . '">'
			         . __( '<i class="fa fa-angle-double-left"></i>', 'wp_bootstrap' ) .
			         '</a>
					 </li>';
		endif;

		if ( $previous && ( 1 !== $page ) ) :
			$echo .= '<li>
						<a href="' . $previous . '" title="' . __( 'previous', 'wp_bootstrap' ) . '">'
			         . $args['previous_string'] .
			         '</a>
					 </li>';
		endif;

		if ( ! empty( $min ) && ! empty( $max ) ) :
			for ( $i = $min; $i <= $max; $i ++ ) :
				if ( $page === $i ) :
					$echo .= '<li class="active">
								<span class="active">'
					         . str_pad( (int) $i, 1, '0', STR_PAD_LEFT ) .
					         '</span>
							 </li>';
				else :
					$echo .= sprintf( '<li><a href="%s">%d</a></li>', esc_attr( get_pagenum_link( $i ) ), $i );
				endif;
			endfor;
		endif;

		$next = intval( $page ) + 1;
		$next = esc_attr( get_pagenum_link( $next ) );

		if ( $next && ( $count !== $page ) ) :
			$echo .= '<li>
						<a href="' . $next . '" title="' . __( 'next', 'wp_bootstrap' ) . '">'
			         . $args['next_string'] .
			         '</a>
					  </li>';
		endif;

		$last_page = esc_attr( get_pagenum_link( $count ) );

		if ( $last_page ) :
			$echo .= '<li class="next">
						<a href="' . $last_page . '">' .
			         __( '<i class="fa fa-angle-double-right"></i>', 'wp_bootstrap' ) .
			         '</a>
					  </li>';
		endif;

		if ( isset( $echo ) ) :
			echo $args['before_output'] . $echo . $args['after_output'];
		endif;
	}
}
