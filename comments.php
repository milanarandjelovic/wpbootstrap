<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) :
    return;
endif;
?>

<?php if ( have_comments() ): ?>

    <h3 class="comment__title">
        <?php printf(
            esc_html(
                _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;'
                    , get_comments_number(), 'comments title', 'wp_bootstrap'
                )
            ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'
        ); ?>
    </h3>

    <!-- Print custom post navigation -->
    <?php wp_bootstrap_get_post_navigation(); ?>

    <!-- Print custom post comments list -->
    <?php wp_bootstrap_get_post_comments_list(); ?>

    <!-- Print custom post navigation -->
    <?php wp_bootstrap_get_post_navigation(); ?>

<?php endif; // Check for have_comments() ?>

<?php
/**
 * If comments are closed and there are comments, let's leave a little note.
 */
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
    <div class="alert alert-info no-comments">
        <?php esc_html_e( 'Comments are closed.', 'wp_bootstrap' ); ?>
    </div>
<?php endif; ?>

<!-- Print custom form for post reply -->
<?php wp_bootstrap_get_post_from(); ?>
