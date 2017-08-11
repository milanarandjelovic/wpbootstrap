<?php
/**
 * Features Custom Post Type.
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
function wp_bootstrap_cpt_features() {
    $labels = array(
        'name'               => __( 'Features', 'Post Type General Name', 'wp_bootstrap' ),
        'singular_name'      => __( 'Feature', 'Post Type Singular Name', 'wp_bootstrap' ),
        'menu_name'          => __( 'Feature', 'wp_bootstrap' ),
        'parent_item_colon'  => __( 'Parent Feature', 'wp_bootstrap' ),
        'all_items'          => __( 'All Features', 'wp_bootstrap' ),
        'view_item'          => __( 'View Feature', 'wp_bootstrap' ),
        'add_new_item'       => __( 'Add New Feature', 'wp_bootstrap' ),
        'add_new'            => __( 'Add Feature', 'wp_bootstrap' ),
        'edit_item'          => __( 'Edit Feature', 'wp_bootstrap' ),
        'update_item'        => __( 'Update Feature', 'wp_bootstrap' ),
        'search_items'       => __( 'Search Feature', 'wp_bootstrap' ),
        'not_found'          => __( 'Not found', 'wp_bootstrap' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'wp_bootstrap' ),
    );

    $args = array(
        'label'               => __( 'feature', 'wp_bootstrap' ),
        'description'         => __( 'Feature Post Type', 'wp_bootstrap' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', ),
        'hierarchical'        => false,
        'public'              => true,
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

    register_post_type( 'feature', $args );
}

add_action( 'init', 'wp_bootstrap_cpt_features' );

function wp_bootstrap_cpt_feature_html( $post ) {
    wp_nonce_field( 'wp_bootstrap_feature_cpt_metabox', 'wp_bootstrap_feature_metabox_nonce' );

    $featureOrder = get_post_meta( $post->ID, '_wp_bootstrap_feature_order', true );
    $featureShow  = get_post_meta( $post->ID, '_wp_bootstrap_feature_show', true );
    $featureIcon  = get_post_meta( $post->ID, '_wp_bootstrap_feature_icon', true );
    ?>
    <p>
        <label for="wp_bootstrap_icon">
            <?php _e( 'Feature Icon', 'wp_bootstrap' ); ?>
        </label>
        <input type="text" id="wp_bootstrap_icon" name="wp_bootstrap_icon"
               value="<?php echo esc_attr( $featureIcon ); ?>"
        >
    </p>

    <p>
        <label for="wp_bootstrap_order">
            <?php _e( 'Order on Web', 'wp_bootstrap' ); ?>
        </label>
        <input type="text" id="wp_bootstrap_order" name="wp_bootstrap_order"
               value="<?php echo esc_attr( $featureOrder ); ?>"
        >
    </p>

    <p>
        <label for="wp_bootstrap_show"><?php _e( 'Show on Web', 'wp_bootstrap' ); ?></label>
        <input type="radio" id="wp_bootstrap_show" name="wp_bootstrap_show"
               value="No" <?php echo checked( "No", $featureShow, false ); ?>
        />No<br>
        <input type="radio" id="wp_bootstrap_show" name="wp_bootstrap_show"
               value="Yes" <?php echo checked( "Yes", $featureShow, false ); ?>
        />Yes</p>
    <?php
}

function wp_bootstrap_feature_add_metabox() {
    add_meta_box(
        'feature',
        __( 'Additional Feature options', 'wp_bootstrap' ),
        'wp_bootstrap_cpt_feature_html',
        'feature',
        'normal',
        'high'
    );
}

add_action( 'add_meta_boxes', 'wp_bootstrap_feature_add_metabox' );

function wp_bootstrap_feature_metabox_save( $post_id ) {
    /**
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can bve triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['wp_bootstrap_feature_metabox_nonce'] ) ):
        return;
    endif;

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['wp_bootstrap_feature_metabox_nonce'], 'wp_bootstrap_feature_cpt_metabox' ) ):
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
    $featureOrder = $_POST['wp_bootstrap_order'];
    $featureShow  = $_POST['wp_bootstrap_show'];
    $featureIcon  = $_POST['wp_bootstrap_icon'];

    // Sanitize user input.
    $featureOrder = sanitize_text_field( $featureOrder );
    $featureShow  = sanitize_text_field( $featureShow );
    $featureIcon  = sanitize_text_field( $featureIcon );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_wp_bootstrap_feature_order', $featureOrder );
    update_post_meta( $post_id, '_wp_bootstrap_feature_show', $featureShow );
    update_post_meta( $post_id, '_wp_bootstrap_feature_icon', $featureIcon );
}

add_action( 'save_post', 'wp_bootstrap_feature_metabox_save' );
