<?php
/**
 * Portfolio Custom Post Type.
 *
 * @link    https://codex.wordpress.org/Post_Types
 *
 * @package WPBootstrap
 */

/**
 * Enable Portfolio Custom Post Type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function wp_bootstrap_cpt_portfolio() {
    $labels = array(
        'name'               => __( 'Portfolios', 'Post Type General Name', 'wp_bootstrap' ),
        'singular_name'      => __( 'Portfolio', 'Post Type Singular Name', 'wp_bootstrap' ),
        'menu_name'          => __( 'Portfolio', 'wp_bootstrap' ),
        'parent_item_colon'  => __( 'Parent Portfolios', 'wp_bootstrap' ),
        'all_items'          => __( 'All Portfolios', 'wp_bootstrap' ),
        'view_item'          => __( 'View Portfolio', 'wp_bootstrap' ),
        'add_new_item'       => __( 'Add New Portfolio', 'wp_bootstrap' ),
        'add_new'            => __( 'Add Portfolio', 'wp_bootstrap' ),
        'edit_item'          => __( 'Edit Portfolio', 'wp_bootstrap' ),
        'update_item'        => __( 'Update Portfolio', 'wp_bootstrap' ),
        'search_items'       => __( 'Search Portfolio', 'wp_bootstrap' ),
        'not_found'          => __( 'Not found', 'wp_bootstrap' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'wp_bootstrap' ),
    );

    $args = array(
        'label'               => __( 'portfolio', 'wp_bootstrap' ),
        'description'         => __( 'Portfolio Post Type', 'wp_bootstrap' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', ),
        'hierarchical'        => false,
        'public'              => true,
        'menu_icon'           => 'dashicons-welcome-write-blog',
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

    register_post_type( 'portfolio', $args );
}

add_action( 'init', 'wp_bootstrap_cpt_portfolio');

/**
 * Register a taxonomy for Portfolio Item Categories.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function wp_bootstrap_portfolio_category() {
    $labels = array(
        'name'                       => __( 'Portfolio Categories', 'wp_bootstrap' ),
        'singular_name'              => __( 'Portfolio Category', 'wp_bootstrap' ),
        'menu_name'                  => __( 'Portfolio Category', 'wp_bootstrap' ),
        'edit_item'                  => __( 'Edit Portfolio Category', 'wp_bootstrap' ),
        'update_item'                => __( 'Update Portfolio Category', 'wp_bootstrap' ),
        'add_new_item'               => __( 'Add New Portfolio Category', 'wp_bootstrap' ),
        'new_item_name'              => __( 'New Portfolio Category', 'wp_bootstrap' ),
        'parent_item'                => __( 'Parent Portfolio Category', 'wp_bootstrap' ),
        'parent_item_colon'          => __( 'Parent Portfolio Category:', 'wp_bootstrap' ),
        'all_items'                  => __( 'All Portfolio Categories', 'wp_bootstrap' ),
        'search_items'               => __( 'Search Portfolio Categories', 'wp_bootstrap' ),
        'popular_items'              => __( 'Popular Portfolio Categories', 'wp_bootstrap' ),
        'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'wp_bootstrap' ),
        'add_or_remove_items'        => __( 'Add or remove Portfolio Categories', 'wp_bootstrap' ),
        'choose_from_most_used'      => __( 'Choose from the most used Portfolio Categories', 'wp_bootstrap' ),
        'not_found'                  => __( 'No categories found.', 'wp_bootstrap' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}

add_action( 'init', 'wp_bootstrap_portfolio_category');

/**
 * Register a taxonomy for Portfolio Item Tags.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function wp_bootstrap_portfolio_tag() {
    $labels = array(
        'name'                       => __( 'Portfolio Tags', 'wp_bootstrap' ),
        'singular_name'              => __( 'Portfolio Tag', 'wp_bootstrap' ),
        'menu_name'                  => __( 'Portfolio Tag', 'wp_bootstrap' ),
        'edit_item'                  => __( 'Edit Portfolio Tag', 'wp_bootstrap' ),
        'update_item'                => __( 'Update Portfolio Tag', 'wp_bootstrap' ),
        'add_new_item'               => __( 'Add New Portfolio Tag', 'wp_bootstrap' ),
        'new_item_name'              => __( 'New Portfolio Tag', 'wp_bootstrap' ),
        'parent_item'                => __( 'Parent Portfolio Tag', 'wp_bootstrap' ),
        'parent_item_colon'          => __( 'Parent Portfolio Tag:', 'wp_bootstrap' ),
        'all_items'                  => __( 'All Portfolio Tags', 'wp_bootstrap' ),
        'search_items'               => __( 'Search Portfolio Tags', 'wp_bootstrap' ),
        'popular_items'              => __( 'Popular Portfolio Tags', 'wp_bootstrap' ),
        'separate_items_with_commas' => __( 'Separate Portfolio Tags with commas', 'wp_bootstrap' ),
        'add_or_remove_items'        => __( 'Add or remove Portfolio Tags', 'wp_bootstrap' ),
        'choose_from_most_used'      => __( 'Choose from the most used Portfolio Tags', 'wp_bootstrap' ),
        'not_found'                  => __( 'No categories found.', 'wp_bootstrap' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
    );

    register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $args );
}

add_action( 'init', 'wp_bootstrap_portfolio_tag');

/**
 * Function that fills the box with the desired content.
 *
 * @param  post $post The post object.
 */
function wp_bootstrap_cpt_portfolio_html( $post ) {
    wp_nonce_field( 'wp_bootstrap_portfolio_cpt_metabox', 'wp_bootstrap_portfolio_metabox_nonce' );

    $clientName = get_post_meta( $post->ID, '_wp_bootstrap_portfolio_name', true );
    $clientWeb  = get_post_meta( $post->ID, '_wp_bootstrap_portfolio_web', true );
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th>
                <label for="wp_bootstrap_portfolio_name">
                    <?php _e( 'Client Name', 'wp_bootstrap' ); ?>
                </label>
            </th>
            <td>
                <input type="text" id="wp_bootstrap_portfolio_name"
                       name="wp_bootstrap_portfolio_name"
                       value="<?php echo esc_attr( $clientName ); ?>"
                       class="regular-text"
                >
            </td>
        </tr>
        <tr>
            <th>
                <label for="wp_bootstrap_portfolio_web">
                    <?php _e( 'Client Web', 'wp_bootstrap' ); ?>
                </label>
            </th>
            <td>
                <input type="text" id="wp_bootstrap_portfolio_web"
                       name="wp_bootstrap_portfolio_web"
                       value="<?php echo esc_attr( $clientName ); ?>"
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
function wp_bootstrap_portfolio_add_metabox() {
    add_meta_box(
        'portfolio-client',
        __( 'Additional Portfolio options', 'wp_bootstrap' ),
        'wp_bootstrap_cpt_portfolio_html',
        'portfolio',
        'normal',
        'high'
    );
}

add_action( 'add_meta_boxes', 'wp_bootstrap_portfolio_add_metabox' );

/**
 * Save portfolio post meta.
 *
 * @param int $post_id The post ID.
 */
function wp_bootstrap_portfolio_metabox_save( $post_id ) {
    /**
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can bve triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['wp_bootstrap_portfolio_metabox_nonce'] ) ):
        return;
    endif;

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['wp_bootstrap_portfolio_metabox_nonce'], 'wp_bootstrap_portfolio_cpt_metabox' ) ):
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
    $clientName = $_POST['wp_bootstrap_portfolio_name'];
    $clientWeb  = $_POST['wp_bootstrap_portfolio_web'];

    // Sanitize user input.
    $clientName = sanitize_text_field( $clientName );
    $clientWeb  = sanitize_text_field( $clientWeb );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_wp_bootstrap_portfolio_name', $clientName );
    update_post_meta( $post_id, '_wp_bootstrap_portfolio_web', $clientWeb );
}

add_action( 'save_post', 'wp_bootstrap_portfolio_metabox_save' );

/**
 * Added ability to show Multi Image Metabox in portfolio
 * custom post type.
 *
 * @return array
 */
function wp_bootstrap_cpt_image() {
    $cpts = array( 'portfolio' );

    return $cpts;
}

add_filter( 'images_cpt', 'wp_bootstrap_cpt_image' );
