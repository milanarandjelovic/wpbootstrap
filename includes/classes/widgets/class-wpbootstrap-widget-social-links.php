<?php
/**
 * Widget API: WPBootstrap_Widget_Social_Links class
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
 * Class WPBootstrap_Widget_Social_Links
 */
class WPBootstrap_Widget_Social_Links extends WP_Widget {

	/**
	 * Sets up a new Social Links widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'wp_bootstrap_widget_social_links',
			'description'                 => __( 'A list of social links for WPBootstrap theme.', 'wp_bootstrap' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wp_bootstrap-social-links', __( '+ WPBootstrap Social Links' ), $widget_ops );
		$this->alt_option_name = 'widget_social_links';
	}

	/**
	 * Outputs the content for the current Social Links widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Social Links widget instance.
	 */
	public function widget( $args, $instance ) {

		if ( ! empty( $instance['title'] ) ) :
			$title = $instance['title'];
		else :
			$title = esc_attr_e( 'Social Links', 'wp_bootstrap' );
		endif;

		$dribbble  = empty( $instance['dribbble'] ) ? '' : $instance['dribbble'];
		$facebook  = empty( $instance['facebook'] ) ? '' : $instance['facebook'];
		$twitter   = empty( $instance['twitter'] ) ? '' : $instance['twitter'];
		$instagram = empty( $instance['instagram'] ) ? '' : $instance['instagram'];
		$tumblr    = empty( $instance['tumblr'] ) ? '' : $instance['tumblr'];

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		if ( ! empty( $title ) ) :
			echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok.
		endif;
		$html = '<p>';

		if ( '' !== $dribbble ) :
			$html .= "<a href='" . $dribbble . "'><i class='fa fa-dribbble'></i></a>";
		endif;

		if ( '' !== $facebook ) :
			$html .= "<a href='" . $facebook . "'><i class='fa fa-facebook'></i></a>";
		endif;

		if ( '' !== $twitter ) :
			$html .= "<a href='" . $twitter . "'><i class='fa fa-twitter'></i></a>";
		endif;

		if ( '' !== $instagram ) :
			$html .= "<a href='" . $instagram . "'><i class='fa fa-instagram'></i></a>";
		endif;

		if ( '' !== $tumblr ) :
			$html .= "<a href='" . $tumblr . "'><i class='fa fa-tumblr'></i></a>";
		endif;

		echo $html;

		echo $args['after_widget']; // WPCS: XSS ok.
	}

	/**
	 * Handles updating the settings for the current Social Links widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['dribbble']  = sanitize_text_field( $new_instance['dribbble'] );
		$instance['facebook']  = sanitize_text_field( $new_instance['facebook'] );
		$instance['twitter']   = sanitize_text_field( $new_instance['twitter'] );
		$instance['instagram'] = sanitize_text_field( $new_instance['instagram'] );
		$instance['tumblr']    = sanitize_text_field( $new_instance['tumblr'] );

		return $instance;
	}

	/**
	 * Outputs the settings form for the Social Links widget.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$dribbble  = isset( $instance['dribbble'] ) ? esc_attr( $instance['dribbble'] ) : '';
		$facebook  = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
		$twitter   = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
		$instagram = isset( $instance['instagram'] ) ? esc_attr( $instance['instagram'] ) : '';
		$tumblr    = isset( $instance['tumblr'] ) ? esc_attr( $instance['tumblr'] ) : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				value="<?php echo esc_attr( $title ); ?>"
			/>
		</p>
		<p>
			<strong>Social Links:</strong>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>">
				<?php esc_attr_e( 'Dribbble:', 'wp_bootstrap' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" type="text"
				value="<?php echo esc_attr( $dribbble ); ?>"
			/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
				<?php esc_attr_e( 'Facebook:', 'wp_bootstrap' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text"
				value="<?php echo esc_attr( $facebook ); ?>"
			/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
				<?php esc_attr_e( 'Twitter:', 'wp_bootstrap' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text"
				value="<?php echo esc_attr( $twitter ); ?>"
			/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
				<?php esc_attr_e( 'Instagram:', 'wp_bootstrap' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text"
				value="<?php echo esc_attr( $instagram ); ?>"
			/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>">
				<?php esc_attr_e( 'Tumblr:', 'wp_bootstrap' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" type="text"
				value="<?php echo esc_attr( $tumblr ); ?>"
			/>
		</p>
		<?php
	}
}
