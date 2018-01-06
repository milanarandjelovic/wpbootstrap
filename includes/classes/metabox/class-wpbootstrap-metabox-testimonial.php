<?php
/**
 * Metabox for testimonial Custom Post Type.
 *
 * @link       https://codex.wordpress.org/Post_Types
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

/**
 * Class WPBootstrap_Metabox_Testimonial.
 */
class WPBootstrap_Metabox_Testimonial {

	/**
	 * Initialize metabox for Testimonial custom post type.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function init_metabox() {
		add_action( 'add_meta_boxes', array( new self(), 'wp_bootstrap_testimonial_add_metabox' ) );
		add_action( 'save_post', array( new self(), 'wp_bootstrap_testimonial_metabox_save' ) );
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
	public static function wp_bootstrap_cpt_testimonial_html( $post ) {
		wp_nonce_field( 'wp_bootstrap_testimonial_cpt_metabox', 'wp_bootstrap_testimonial_metabox_nonce' );

		$client_position = get_post_meta( $post->ID, '_wp_bootstrap_testimonial_position', true );
		$client_web      = get_post_meta( $post->ID, '_wp_bootstrap_testimonial_web', true );
		?>
		<table class="form-table">
			<tbody>
			<tr>
				<th>
					<label for="wp_bootstrap_testimonial_position">
						<?php esc_attr_e( 'Client Position', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="text" id="wp_bootstrap_testimonial_position"
					       name="wp_bootstrap_testimonial_position"
					       value="<?php echo esc_attr( $client_position ); ?>"
					       class="regular-text"
					>
				</td>
			</tr>
			<tr>
				<th>
					<label for="wp_bootstrap_testimonial_web">
						<?php esc_attr_e( 'Client Web', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="text" id="wp_bootstrap_testimonial_web"
					       name="wp_bootstrap_testimonial_web"
					       value="<?php echo esc_attr( $client_web ); ?>"
					       class="regular-text"
					>
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
	public static function wp_bootstrap_testimonial_add_metabox() {
		add_meta_box(
			'testimonial-client',
			__( 'Testimonial Client', 'wp_bootstrap' ),
			array( new self(), 'wp_bootstrap_cpt_testimonial_html' ),
			'wpb-testimonial',
			'normal',
			'high'
		);
	}

	/**
	 * Save testimonial post meta.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 *
	 * @param int $post_id The post ID.
	 */
	public static function wp_bootstrap_testimonial_metabox_save( $post_id ) {
		/**
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can bve triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['wp_bootstrap_testimonial_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['wp_bootstrap_testimonial_metabox_nonce'],
			'wp_bootstrap_testimonial_cpt_metabox' ) ) {
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
		$client_position = $_POST['wp_bootstrap_testimonial_position'];
		$client_web      = $_POST['wp_bootstrap_testimonial_web'];

		// Sanitize user input.
		$client_position = sanitize_text_field( $client_position );
		$client_web      = sanitize_text_field( $client_web );

		// Update the meta field in the database.
		update_post_meta( $post_id, '_wp_bootstrap_testimonial_position', $client_position );
		update_post_meta( $post_id, '_wp_bootstrap_testimonial_web', $client_web );
	}
}
