<?php
/**
 * Team Custom Post Type.
 *
 * @link    https://codex.wordpress.org/Post_Types
 *
 * @package WPBootstrap
 */

/**
 * Enable Team Custom Post Type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function wp_bootstrap_cpt_team() {
    $labels = array(
        'name'               => __( 'Teams', 'Post Type General Name', 'wp_bootstrap' ),
        'singular_name'      => __( 'Team', 'Post Type Singular Name', 'wp_bootstrap' ),
        'menu_name'          => __( 'Team', 'wp_bootstrap' ),
        'parent_item_colon'  => __( 'Parent Team', 'wp_bootstrap' ),
        'all_items'          => __( 'All Teams', 'wp_bootstrap' ),
        'view_item'          => __( 'View Team', 'wp_bootstrap' ),
        'add_new_item'       => __( 'Add New Team', 'wp_bootstrap' ),
        'add_new'            => __( 'Add Team', 'wp_bootstrap' ),
        'edit_item'          => __( 'Edit Team', 'wp_bootstrap' ),
        'update_item'        => __( 'Update Team', 'wp_bootstrap' ),
        'search_items'       => __( 'Search Team', 'wp_bootstrap' ),
        'not_found'          => __( 'Not found', 'wp_bootstrap' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'wp_bootstrap' ),
    );

    $args = array(
        'label'               => __( 'team', 'wp_bootstrap' ),
        'description'         => __( 'Team Post Type', 'wp_bootstrap' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'        => false,
        'public'              => true,
        'menu_icon'           => 'dashicons-groups',
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

    register_post_type( 'team', $args );
}

add_action( 'init', 'wp_bootstrap_cpt_team' );

/**
 * Function that fills the box with the desired content.
 *
 * @param  post $post The post object.
 */
function wp_bootstrap_cpt_team_html( $post ) {
    wp_nonce_field( 'wp_bootstrap_team_cpt_metabox', 'wp_bootstrap_team_metabox_nonce' );

    $teamPosition = get_post_meta( $post->ID, '_wp_bootstrap_team_position', true );
    $teamEmail    = get_post_meta( $post->ID, '_wp_bootstrap_team_email', true );
    $teamTwitter  = get_post_meta( $post->ID, '_wp_bootstrap_team_twitter', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th>
                <label for="wp_bootstrap_team_position">
                    <?php _e( 'Client Position', 'wp_bootstrap' ); ?>
                </label>
            </th>
            <td>
                <input type="text" id="wp_bootstrap_team_position"
                       name="wp_bootstrap_team_position"
                       value="<?php echo esc_attr( $teamPosition ); ?>"
                       class="regular-text"
                >
            </td>
        </tr>
        <tr>
            <th>
                <label for="wp_bootstrap_team_email">
                    <?php _e( 'Client Email', 'wp_bootstrap' ); ?>
                </label>
            </th>
            <td>
                <input type="text" id="wp_bootstrap_team_email"
                       name="wp_bootstrap_team_email"
                       value="<?php echo esc_attr( $teamEmail ); ?>"
                       class="regular-text"
                >
            </td>
        </tr>
        <tr>
            <th>
                <label for="wp_bootstrap_team_twitter">
                    <?php _e( 'Client Twitter', 'wp_bootstrap' ); ?>
                </label>
            </th>
            <td>
                <input type="text" id="wp_bootstrap_team_twitter"
                       name="wp_bootstrap_team_twitter"
                       value="<?php echo esc_attr( $teamTwitter ); ?>"
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
function wp_bootstrap_team_add_metabox() {
    add_meta_box(
        'team',
        __( 'Team Member Info', 'wp_bootstrap' ),
        'wp_bootstrap_cpt_team_html',
        'team',
        'normal',
        'high'
    );
}

add_action( 'add_meta_boxes', 'wp_bootstrap_team_add_metabox' );

/**
 * Save team post meta.
 *
 * @param int $post_id The post ID.
 */
function wp_bootstrap_team_metabox_save( $post_id ) {
    /**
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can bve triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['wp_bootstrap_team_metabox_nonce'] ) ):
        return;
    endif;

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['wp_bootstrap_team_metabox_nonce'], 'wp_bootstrap_team_cpt_metabox' ) ):
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
    $teamPosition = $_POST['wp_bootstrap_team_position'];
    $teamEmail    = $_POST['wp_bootstrap_team_email'];
    $teamTwitter  = $_POST['wp_bootstrap_team_twitter'];

    // Sanitize user input.
    $teamPosition = sanitize_text_field( $teamPosition );
    $teamEmail    = sanitize_text_field( $teamEmail );
    $teamTwitter  = sanitize_text_field( $teamTwitter );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_wp_bootstrap_team_position', $teamPosition );
    update_post_meta( $post_id, '_wp_bootstrap_team_twitter', $teamTwitter );

    if ( filter_var( $teamEmail, FILTER_VALIDATE_EMAIL ) ):
        update_post_meta( $post_id, '_wp_bootstrap_team_email', $teamEmail );
    else:
        add_filter( 'redirect_post_location', 'wp_bootstrap_error_email', 99 );
    endif;
}

add_action( 'save_post', 'wp_bootstrap_team_metabox_save' );

/**
 * Return message if email is not valid.
 *
 * @param $messages
 *
 * @return array
 */
function wp_bootstrap_new_message( $messages ) {
    $messages['post'][99] = 'Member Email is not correct';

    return $messages;
}

add_filter( 'post_updated_messages', 'wp_bootstrap_new_message' );

/**
 * @param $location
 *
 * @return string
 */
function wp_bootstrap_error_email( $location ) {
    remove_filter( 'redirect_post_location', __FUNCTION__, 99 );
    $location = add_query_arg( 'message', 99, $location );

    return $location;
}
