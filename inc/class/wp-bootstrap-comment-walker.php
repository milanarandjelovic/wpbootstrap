<?php
/**
 * A custom WordPress comment walker class to implement the Bootstrap 3 Media object in WordPress comment list.
 *
 * @package     WP_Bootstrap_Comment_Walker
 * @version     1.0.0
 * @author      Milan Arandjelovic
 * @license     http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 */

class WP_Bootstrap_Comment_Walker extends Walker_Comment {

    /**
     * Output a comment in the HTML5 format.
     *
     * @access protected
     * @since  1.0.0
     *
     * @see    wp_list_comments()
     *
     * @param object $comment Comment to display.
     * @param int    $depth   Depth of comment.
     * @param array  $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent media' : 'media' ); ?>>
        <?php if ( $args['avatar_size'] != 0 ): ?>
            <div class="media-left">
                <a href="<?php echo get_comment_author_url(); ?>" class="media-object">
                    <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="media-body panel panel-default" id="div-comment-<?php comment_ID(); ?>">

            <div class="panel-heading">
                <?php printf( '<span class="media-heading">%s</span>', get_comment_author_link() ); ?>

                <span class="comment-metadata pull-right">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
                        </time>
                    </a>
                </span><!-- .comment-metadata -->
            </div>

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation label label-info"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
            <?php endif; ?>

            <div class="comment-content panel-body">
                <?php comment_text(); ?>

                <ul class="list-inline">
                    <?php edit_comment_link( __( 'Edit' ), '<li class="edit-link">', '</li>' ); ?>

                    <?php
                    comment_reply_link( array_merge( $args, array(
                        'add_below' => 'div-comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<li class="reply-link">',
                        'after'     => '</li>',
                    ) ) );
                    ?>

                </ul>
            </div><!-- .comment-content -->


        </div>
        <?php
    }
}

