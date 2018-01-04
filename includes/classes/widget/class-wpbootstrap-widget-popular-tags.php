<?php
/**
 * Widget API: WPBootstrap_Widget_Popular_Tags class.
 *
 * @link       https://codex.wordpress.org/Widgets_API
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
 * Class WPBootstrap_Widget_Popular_Tags
 */
class WPBootstrap_Widget_Popular_Tags extends WP_Widget {

	/**
	 * Sets up a new Popular Tags widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_popular_tags',
			'description'                 => __( 'A list of popular tags for WPBootstrap theme.', 'wp_bootstrap' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wp_bootstrap_popular_tags', __( '+ WPBootstrap Popular Tags' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Popular Tags widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Popular Tags widget instance.
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title',
			empty( $instance['title'] ) ? __( 'WPBootstrap Popular Tags' ) : $instance['title'], $instance,
			$this->id_base );

		if ( $title ) :
			echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok.
		endif;

		$tags = get_tags( array(
			'orderby' => 'count',
			'order'   => 'DESC',
			'number'  => 14,
		) );

		if ( ! empty( $tags ) ) :
			?>
			<p>
				<?php
				foreach ( $tags as $tag ) :
					$tag_link = get_tag_link( $tag->term_id );
					?>
					<a href="<?php echo esc_url( $tag_link ); ?>" title="<?php esc_attr( $tag->name ); ?>"
					   class="<?php echo esc_attr( $tag->slug ); ?> btn btn-blue"
					>
						<?php echo esc_attr( $tag->name ); ?>
					</a>
				<?php endforeach; ?>
			</p>
			<?php
		endif;

		echo $args['after_widget']; // WPCS: XSS ok.
	}

	/**
	 * Handles updating settings for the current Categories widget instance.
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
		$instance           = $old_instance;
		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		// Defaults.
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '',
			)
		);

		$title  = sanitize_text_field( $instance['title'] );
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'wp_bootstrap' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"
			/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
				<?php esc_attr_e( 'Number of popular tags to show:', 'wp_bootstrap' ); ?>
			</label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
			       value="<?php echo esc_attr( $number ); ?>" size="3"
			/>
		</p>
		<?php
	}
}
