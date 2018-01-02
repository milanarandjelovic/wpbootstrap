<?php
/**
 * Widget API: WPBootstrap_Widget_Categories class
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
 * Class WPBootstrap_Widget_Categories
 */
class WPBootstrap_Widget_Categories extends WP_Widget {

	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_categories',
			'description'                 => __( 'A list of categories for WPBootstrap theme.', 'wp_bootstrap' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wp_bootstrap_categories', __( '+ WPBootstrap Categories' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Categories widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Categories widget instance.
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';

		echo $args['before_widget']; // WPCS: XSS ok.

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok.
		}

		$cat_args = array(
			'orderby'    => 'name',
			'show_count' => $c,
		);

		$wp_bootstrap_categories = get_categories( $cat_args );
		?>
		<ul class="wp_bootstrap_categories_sidebar">
			<?php
			foreach ( $wp_bootstrap_categories as $category ) :
				?>
				<p>
					<a href="<?php echo esc_attr( get_category_link( $category->term_id ) ); ?>">
						<i class="fa fa-angle-double-right"></i> <?php echo esc_attr( $category->name ); ?>
					</a>
					<?php if ( $c ) : ?>
						<span class="badge badge-blue pull-right">
							<?php echo esc_attr( $category->count ); ?>
						</span>
					<?php endif; ?>
				</p>
				<?php
			endforeach;
			?>
		</ul>
		<?php

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
		$instance          = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['count'] = ! empty( $new_instance['count'] ) ? 1 : 0;

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
		$title    = sanitize_text_field( $instance['title'] );
		$count    = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
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

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
			name="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"<?php checked( $count ); ?>
		/>
		<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
			<?php esc_attr_e( 'Show post counts', 'wp_bootstrap' ); ?>
		</label>
		<br/>
		<?php
	}
}
