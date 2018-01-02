<?php
/**
 * Testimonials Custom Post Type.
 *
 * @link    https://codex.wordpress.org/Post_Types
 *
 * @package WPBootstrap
 */

/**
 * Enable Features Custom Post Type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function wp_bootstrap_cpt_testimonial() {
    $labels = array(
        'name'               => __( 'Testimonials', 'Post Type General Name', 'wp_bootstrap' ),
        'singular_name'      => __( 'Testimonial', 'Post Type Singular Name', 'wp_bootstrap' ),
        'menu_name'          => __( 'Testimonial', 'wp_bootstrap' ),
        'parent_item_colon'  => __( 'Parent Testimonial', 'wp_bootstrap' ),
        'all_items'          => __( 'All Testimonials', 'wp_bootstrap' ),
        'view_item'          => __( 'View Testimonial', 'wp_bootstrap' ),
        'add_new_item'       => __( 'Add New Testimonial', 'wp_bootstrap' ),
        'add_new'            => __( 'Add Testimonial', 'wp_bootstrap' ),
        'edit_item'          => __( 'Edit Testimonial', 'wp_bootstrap' ),
        'update_item'        => __( 'Update Testimonial', 'wp_bootstrap' ),
        'search_items'       => __( 'Search Testimonial', 'wp_bootstrap' ),
        'not_found'          => __( 'Not found', 'wp_bootstrap' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'wp_bootstrap' ),
    );

    $args = array(
        'label'               => __( 'testimonial', 'wp_bootstrap' ),
        'description'         => __( 'Testimonial Post Type', 'wp_bootstrap' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', ),
        'hierarchical'        => false,
        'public'              => true,
        'menu_icon'           => 'dashicons-format-status',
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

    register_post_type( 'testimonial', $args );
}

add_action( 'init', 'wp_bootstrap_cpt_testimonial' );

/**
 * Function that fills the box with the desired content.
 *
 * @param  post $post The post object.
 */
function wp_bootstrap_cpt_testimonial_html( $post ) {
    wp_nonce_field( 'wp_bootstrap_testimonial_cpt_metabox', 'wp_bootstrap_testimonial_metabox_nonce' );

    $clientPosition = get_post_meta( $post->ID, '_wp_bootstrap_testimonial_position', true );
    $clientWeb      = get_post_meta( $post->ID, '_wp_bootstrap_testimonial_web', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th>
                <label for="wp_bootstrap_testimonial_position">
                    <?php _e( 'Client Position', 'wp_bootstrap' ); ?>
                </label>
            </th>
            <td>
                <input type="text" id="wp_bootstrap_testimonial_position"
                       name="wp_bootstrap_testimonial_position"
                       value="<?php echo esc_attr( $clientPosition ); ?>"
                       class="regular-text"
                >
            </td>
        </tr>
        <tr>
            <th>
                <label for="wp_bootstrap_testimonial_web">
                    <?php _e( 'Client Web', 'wp_bootstrap' ); ?>
                </label>
            </th>
            <td>
                <input type="text" id="wp_bootstrap_testimonial_web"
                       name="wp_bootstrap_testimonial_web"
                       value="<?php echo esc_attr( $clientWeb ); ?>"
                       class="regular-text"
                >
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

/**
 * The hook allows meta box registration for any post type.
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function wp_bootstrap_testimonial_add_metabox() {
    add_meta_box(
        'testimonial-client',
        __( 'Testimonial Client', 'wp_bootstrap' ),
        'wp_bootstrap_cpt_testimonial_html',
        'testimonial',
        'normal',
        'high'
    );
}

add_action( 'add_meta_boxes', 'wp_bootstrap_testimonial_add_metabox' );

/**
 * Save testimonial post meta.
 *
 * @param int $post_id The post ID.
 */
function wp_bootstrap_testimonial_metabox_save( $post_id ) {
    /**
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can bve triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['wp_bootstrap_testimonial_metabox_nonce'] ) ):
        return;
    endif;

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['wp_bootstrap_testimonial_metabox_nonce'], 'wp_bootstrap_testimonial_cpt_metabox' ) ):
        return;
    endif;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) :
        return;
    endif;

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ):
        if ( ! current_user_can( 'edit_page', $post_id ) ):
            return;
        endif;
    else:
        if ( ! current_user_can( 'edit_post', $post_id ) ):
            return;
        endif;
    endif;

    // Ok it's sage for us to save the data now.
    $clientPosition = $_POST['wp_bootstrap_testimonial_position'];
    $clientWeb      = $_POST['wp_bootstrap_testimonial_web'];

    // Sanitize user input.
    $clientPosition = sanitize_text_field( $clientPosition );
    $clientWeb      = sanitize_text_field( $clientWeb );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_wp_bootstrap_testimonial_position', $clientPosition );
    update_post_meta( $post_id, '_wp_bootstrap_testimonial_web', $clientWeb );
}

add_action( 'save_post', 'wp_bootstrap_testimonial_metabox_save' );
