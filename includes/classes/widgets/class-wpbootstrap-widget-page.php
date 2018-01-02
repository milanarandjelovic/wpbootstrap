<?php
/**
 * Widget API: WPBootstrap_Widget_Page class
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
 * Class WPBootstrap_Widget_Page
 */
class WPBootstrap_Widget_Page extends WP_Widget {

	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_one_page',
			'description'                 => __( 'A list of Page for WPBootstrap theme.', 'wp_bootstrap' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wp_bootstrap_one_page', __( '+ WPBootstrap One Page' ), $widget_ops );
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
		$current_page_query = new WP_Query( 'page_id=' . $instance['page'] );

		// The Loop.
		if ( $current_page_query->have_posts() ) :
			echo $args['before_widget']; // WPCS: XSS ok.

			while ( $current_page_query->have_posts() ) :
				$current_page_query->the_post();
				?>
				<h4><?php the_title(); ?></h4>
				<?php
				// Fetch post content.
				$content = get_post_field( 'post_content', get_the_ID() );

				// Get content parts.
				$content_parts = get_extended( $content );

				// Output part before <!-- more --> tag.
				echo $content_parts['main']; // WPCS: XSS ok.

				if ( '' !== $content_parts['extended'] ) :
					?>
					<p>
						<br>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="btn btn-light-blue">
							More Info
						</a>
					</p>
					<?php
				endif;
			endwhile;
			echo $args['after_widget']; // WPCS: XSS ok.
		endif;
		wp_reset_postdata();
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
		$instance         = $old_instance;
		$instance['page'] = ! empty( $new_instance['page'] ) ? $new_instance['page'] : 0;

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
				'page' => 0,
			)
		);

		$current_page_query = esc_attr( $instance['page'] );

		$get_all_pages = get_posts(
			array(
				'posts_per_page' => - 1,
				'post_type'      => 'page',
			)
		);
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'page' ) ); ?>">
				<?php esc_attr_e( 'Page:', 'wp_bootstrap' ); ?>
				<select name="<?php echo esc_attr( $this->get_field_name( 'page' ) ); ?>"
					id="<?php echo esc_attr( $this->get_field_id( 'page' ) ); ?>"
					class="widefat"
				>
					<option value="0" <?php selected( 0, $current_page_query ); ?> >None</option>
					<?php
					foreach ( $get_all_pages as $page ) :
						?>
						<option value="<?php echo esc_attr( $page->ID ); ?>"
							<?php selected( $page->ID, $current_page_query, true ); ?>
						>
							<?php echo esc_attr( $page->post_title ); ?>
						</option>
						<?php
					endforeach;
					?>
				</select>
			</label>
		</p>
		<?php
	}
}
