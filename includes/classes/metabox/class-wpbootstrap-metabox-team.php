<?php
/**
 * Metabox for team Custom Post Type.
 *
 * @link       https://codex.wordpress.org/Post_Types
 *
 * @package    WPBootstrap
 * @subpackage Core
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

/**
 * Class WPBootstrap_Metabox_Team.
 */
class WPBootstrap_Metabox_Team {

	/**
	 * Initialize metabox for Team custom post type.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 */
	public static function init_metabox() {
		add_action( 'add_meta_boxes', array( new self(), 'wp_bootstrap_team_add_metabox' ) );
		add_action( 'save_post', array( new self(), 'wp_bootstrap_team_metabox_save' ) );

		add_filter( 'post_updated_messages', array( new self(), 'wp_bootstrap_new_message' ) );
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
	public static function wp_bootstrap_cpt_team_html( $post ) {
		wp_nonce_field( 'wp_bootstrap_team_cpt_metabox', 'wp_bootstrap_team_metabox_nonce' );

		$team_position = get_post_meta( $post->ID, '_wp_bootstrap_team_position', true );
		$team_email    = get_post_meta( $post->ID, '_wp_bootstrap_team_email', true );
		$team_twitter  = get_post_meta( $post->ID, '_wp_bootstrap_team_twitter', true );
		?>
		<table class="form-table">
			<tbody>
			<tr>
				<th>
					<label for="wp_bootstrap_team_position">
						<?php esc_attr_e( 'Member Position', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="text" id="wp_bootstrap_team_position"
						name="wp_bootstrap_team_position"
						value="<?php echo esc_attr( $team_position ); ?>"
						class="regular-text"
					>
				</td>
			</tr>
			<tr>
				<th>
					<label for="wp_bootstrap_team_email">
						<?php esc_attr_e( 'Member Email', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="text" id="wp_bootstrap_team_email"
						name="wp_bootstrap_team_email"
						value="<?php echo esc_attr( $team_email ); ?>"
						class="regular-text"
					>
				</td>
			</tr>
			<tr>
				<th>
					<label for="wp_bootstrap_team_twitter">
						<?php esc_attr_e( 'Member Twitter', 'wp_bootstrap' ); ?>
					</label>
				</th>
				<td>
					<input type="text" id="wp_bootstrap_team_twitter"
						name="wp_bootstrap_team_twitter"
						value="<?php echo esc_attr( $team_twitter ); ?>"
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
	public static function wp_bootstrap_team_add_metabox() {
		add_meta_box(
			'team',
			__( 'Team Member Info', 'wp_bootstrap' ),
			array( new self(), 'wp_bootstrap_cpt_team_html' ),
			'wpb-team',
			'normal',
			'high'
		);
	}

	/**
	 * Save team post meta.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 *
	 * @param int $post_id The post ID.
	 */
	public static function wp_bootstrap_team_metabox_save( $post_id ) {
		/**
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can bve triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['wp_bootstrap_team_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['wp_bootstrap_team_metabox_nonce'], 'wp_bootstrap_team_cpt_metabox' ) ) {
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
		$team_position = $_POST['wp_bootstrap_team_position'];
		$team_email    = $_POST['wp_bootstrap_team_email'];
		$team_twitter  = $_POST['wp_bootstrap_team_twitter'];

		// Sanitize user input.
		$team_position = sanitize_text_field( $team_position );
		$team_email    = sanitize_text_field( $team_email );
		$team_twitter  = sanitize_text_field( $team_twitter );

		// Update the meta field in the database.
		update_post_meta( $post_id, '_wp_bootstrap_team_position', $team_position );
		update_post_meta( $post_id, '_wp_bootstrap_team_twitter', $team_twitter );

		if ( filter_var( $team_email, FILTER_VALIDATE_EMAIL ) ) {
			update_post_meta( $post_id, '_wp_bootstrap_team_email', $team_email );
		} else {
			add_filter( 'redirect_post_location', array( new self(), 'wp_bootstrap_error_email' ), 99 );
		}
	}

	/**
	 * Return message if email is not valid.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 *
	 * @param array $messages Message for tem.
	 *
	 * @return mixed
	 */
	public static function wp_bootstrap_new_message( $messages ) {
		$messages['post'][99] = 'Member Email is not correct';

		return $messages;
	}

	/**
	 * Show error message.
	 *
	 * @static
	 * @access public
	 * @since  1.0.0
	 *
	 * @param string $location Location to show message.
	 *
	 * @return string
	 */
	public static function wp_bootstrap_error_email( $location ) {
		remove_filter( 'redirect_post_location', __FUNCTION__, 99 );
		$location = add_query_arg( 'message', 99, $location );

		return $location;
	}
}
