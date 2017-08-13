<?php
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
                                                        checked( $check_meta, '0', false ) . " " . checked( $check_meta, '', false ) .
                                                        "id='attachments[{$post->ID}][wp_bootstrap_client_image]'" . "> No<br><input type='radio' style='width: auto' value='1' " .
                                                        checked( $check_meta, '1', false ) . " " . "name='attachments[{$post->ID}][wp_bootstrap_client_image]'" .
                                                        "id='attachments[{$post->ID}][wp_bootstrap_client_image]'" . "> Yes";;

    return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'wp_bootstrap_attachment_new_field', null, 2 );

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
