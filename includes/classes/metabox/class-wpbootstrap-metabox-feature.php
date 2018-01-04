<?php
/**
 * Metabox for feature Custom Post Type.
 *
 * @link       https://codex.wordpress.org/Post_Types
 *
 * @package    WPBootstrap
 * @subpackage Core
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

/**
 * Class WPBootstrap_Metabox_Feature.
 */
class WPBootstrap_Metabox_Feature {

	/**
	 * Initialize metabox for Feature custom post type.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function init_metabox() {
		add_action( 'add_meta_boxes', array( new self(), 'wp_bootstrap_feature_add_metabox' ) );
		add_action( 'save_post', array( new self(), 'wp_bootstrap_feature_metabox_save' ) );
	}

	/**
	 * Function that fills the box with the desired content.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 *
	 * @param object $post The post object.
	 */
	public static function wp_bootstrap_cpt_feature_html( $post ) {
		wp_nonce_field( 'wp_bootstrap_feature_cpt_metabox', 'wp_bootstrap_feature_metabox_nonce' );

		$feature_order = get_post_meta( $post->ID, '_wp_bootstrap_feature_order', true );
		$feature_show  = get_post_meta( $post->ID, '_wp_bootstrap_feature_show', true );
		$feature_icon  = get_post_meta( $post->ID, '_wp_bootstrap_feature_icon', true );
		?>
		<table class="form-table">
			<tbody>
			<tr>
				<th>
					<label for="wp_bootstrap_icon">
						<?php esc_attr_e( 'Feature Icon', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="text" id="wp_bootstrap_icon"
						name="wp_bootstrap_icon"
						value="<?php echo esc_attr( $feature_icon ); ?>"
						class="regular-text"
					>
				</td>
			</tr>
			<tr>
				<th>
					<label for="wp_bootstrap_order">
						<?php esc_attr_e( 'Order on Web', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="text" id="wp_bootstrap_order"
						name="wp_bootstrap_order"
						value="<?php echo esc_attr( $feature_order ); ?>"
						class="regular-text"
					>
				</td>
			</tr>
			<tr>
				<th>
					<label for="">
						<?php esc_attr_e( 'Show on Web', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="radio" id="wp_bootstrap_show"
						name="wp_bootstrap_show"
						value="No" <?php echo checked( 'No', $feature_show, false ); ?>
						class="regular-text"
					/>No <br>
					<input type="radio" id="wp_bootstrap_show"
						name="wp_bootstrap_show"
						value="Yes" <?php echo checked( 'Yes', $feature_show, false ); ?>
						class="regular-text"
					/>Yes
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Function that fills the box with the desired content.
	 *
	 * @link   https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function wp_bootstrap_feature_add_metabox() {
		add_meta_box(
			'feature',
			__( 'Additional Feature options', 'wp_bootstrap' ),
			array( new self(), 'wp_bootstrap_cpt_feature_html' ),
			'wpb-feature',
			'normal',
			'high'
		);
	}

	/**
	 * Save feature post meta.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 *
	 * @param int $post_id The post ID.
	 */
	public static function wp_bootstrap_feature_metabox_save( $post_id ) {
		/**
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can bve triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['wp_bootstrap_feature_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['wp_bootstrap_feature_metabox_nonce'], 'wp_bootstrap_feature_cpt_metabox' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		// Ok it's sage for us to save the data now.
		$feature_order = $_POST['wp_bootstrap_order'];
		$feature_show  = $_POST['wp_bootstrap_show'];
		$feature_icon  = $_POST['wp_bootstrap_icon'];

		// Sanitize user input.
		$feature_order = sanitize_text_field( $feature_order );
		$feature_show  = sanitize_text_field( $feature_show );
		$feature_icon  = sanitize_text_field( $feature_icon );

		// Update the meta field in the database.
		update_post_meta( $post_id, '_wp_bootstrap_feature_order', $feature_order );
		update_post_meta( $post_id, '_wp_bootstrap_feature_show', $feature_show );
		update_post_meta( $post_id, '_wp_bootstrap_feature_icon', $feature_icon );
	}
}
