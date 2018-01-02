<?php
$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req  = ( $req ? " aria-required='true'" : '' );

// Custom fields for non register user
$non_register_comments_fields = array(
    'author' => '<div class="form-group"><label for="author">' . __( 'Name' ) . ( $req ? '<span class="required"> *</span>' : '' ) .
                '</label>' . '<input id="author" name="author" class="form-control" placeholder="your name" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . '/></div>',
    'email'  => '<div class="form-group"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required" > *</span> ' : '' ) .
                '</label>' . '<input id="email" class="form-control" name="email" placeholder="email@address.co.uk" type="email" value="' .
                esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . '/></div> ',
);

$comments_args = array(
    'class_submit'        => 'btn btn-primary',
    'fields'              => $non_register_comments_fields,
    'label_submit'        => esc_html__( 'Leave a Replay', 'wp_bootstrap' ),
    'title_reply'         => esc_html__( 'Write a Reply or Comment', 'wp_bootstrap' ),
    'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'wp_bootstrap' ),
    'cancel_reply_link'   => esc_html__( 'Cancel Reply', 'wp_bootstrap' ),
    'comment_notes_after' => '',
    'comment_field'       => '<p class="comment-form-comment">' . '<label for="comment">' .
                             _x( 'Comment', 'noun' ) . '</label><br />' .
                             '<textarea id="comment" name="comment" class="form-control" aria-required="true">' .
                             '</textarea></p>',
);

// Print comment form
comment_form( $comments_args );
