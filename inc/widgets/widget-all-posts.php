<?php
/**
 * Widget API: WP_Bootstrap_Widget_All_Posts class
 *
 * @package    WordPress
 * @subpackage Widgets
 * @since      4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see   WP_Widget
 */
class WP_Bootstrap_Widget_All_Posts extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since  2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname'                   => 'wp_bootstrap_widget_all_posts',
            'description'                 => __( 'A list of recent posts for WPBootstrap theme post_type.', 'wp_bootstrap' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'wp_bootstrap-all-posts', __( 'WPBootstrap Recent Posts By Post Type' ), $widget_ops );
        $this->alt_option_name = 'widget_all_post';
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
        $title     = apply_filters( 'widget_title',
            empty( $instance['title'] ) ? __( 'Recent Posts' ) : $instance['title'],
            $instance, $this->id_base
        );
        $post_type = $instance['post_type'];

        if ( ! empty( $title ) ):
            echo $args['before_title'] . $title . $args['after_title'];
        endif;

        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see   WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $recentPosts = new WP_Query(
            apply_filters(
                'wp_bootstrap_widget_all_post_args', array(
                    'post_per_page'       => 5,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'post_type'           => $post_type,
                    'ignore_sticky_posts' => true,
                )
            )
        );

        if ( $recentPosts->have_posts() ) : ?>
            <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
                <p>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </p>
            <?php endwhile; ?>
            <?php echo $args['after_widget']; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
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
        $instance              = $old_instance;
        $instance['title']     = sanitize_text_field( $new_instance['title'] );
        $instance['post_type'] = $new_instance['post_type'];

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
        $title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $post_type    = esc_attr( $instance['post_type'] );
        $allPostTypes = get_post_types();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php _e( 'Title:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo $title; ?>"
            />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post_type' ); ?>">
                <?php _e( 'Select Post Type:' ); ?>
            </label>
            <select name="<?php echo $this->get_field_name( 'post_type' ) ?>"
                    id="<?php echo $this->get_field_id( 'post_type' ) ?>"
                    class="widefat"
            >
                <option value="0">None</option>
                <?php foreach ( $allPostTypes as $postType ): ?>
                    <option value="<?php echo $postType; ?>"
                        <?php selected( $post_type, $postType, true ); ?>
                    >
                        <?php echo $postType; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }
}

/**
 * Register WP_Bootstrap_Widget_All_Posts widget.
 */
function wp_bootstrap_register_all_post_widget() {
    register_widget( 'WP_Bootstrap_Widget_All_Posts' );
    do_action( 'widgets_init' );
}

add_action( 'init', 'wp_bootstrap_register_all_post_widget' );
