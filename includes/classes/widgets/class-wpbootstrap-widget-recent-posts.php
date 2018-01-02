<?php
/**
 * Widget API: WPBootstrap_Widget_Recent_Posts class
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
 * Class WPBootstrap_Widget_Recent_Posts
 */
class WPBootstrap_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'wp_bootstrap_widget_recent_posts',
			'description'                 => __( 'A list of recent posts for WPBootstrap theme.', 'wp_bootstrap' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wp_bootstrap-recent-posts', __( '+ WPBootstrap Recent Posts' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Posts' ) : $instance['title'], $instance, $this->id_base );

		if ( ! empty( $title ) ) :
			echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok.
		endif;

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}

		$show_thumbs = ! empty( $instance['picture'] ) ? true : false;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see   WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$recent_posts_query = new WP_Query(
			apply_filters(
				'wp_bootstrap_widget_post_args', array(
					'post_per_page'       => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				)
			)
		);

		if ( $recent_posts_query->have_posts() ) : ?>
			<ul class="sidebar-popular-posts">
				<?php
				while ( $recent_posts_query->have_posts() ) :
					$recent_posts_query->the_post();
				?>
					<li>
						<?php if ( has_post_thumbnail() && $show_thumbs ) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'wp_bootstrap_post-sidebar-thumbnail' ); ?>
							</a>
						<?php endif; ?>
						<p>
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</p>
						<em>Posted on: <?php echo get_the_date(); ?></em>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $args['after_widget']; // WPCS: XSS ok. ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it.
			wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
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
		$instance            = $old_instance;
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['number']  = (int) $new_instance['number'];
		$instance['picture'] = ! empty( $new_instance['picture'] ) ? 1 : 0;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$title   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number  = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$picture = isset( $instance['picture'] ) ? (bool) $instance['picture'] : false;
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
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'picture' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'picture' ) ); ?>"
				<?php checked( $picture ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id( 'picture' ) ); ?>">
				<?php esc_attr_e( 'Show thumbnails', 'wp_bootstrap' ); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
				<?php esc_attr_e( 'Number of posts to show:', 'wp_bootstrap' ); ?>
			</label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
				value="<?php echo esc_attr( $number ); ?>" size="3"
			/>
		</p>
		<?php
	}
}
