<?php
/**
 * Widget API: WP_Bootstrap_Widget_Popular_Tags class
 *
 * @package    WordPress
 * @subpackage Widgets
 * @since      4.4.0
 */

/**
 * Core class used to implement a Popular Tags widget.
 *
 * @since 2.8.0
 *
 * @see   WP_Widget
 */
class WP_Bootstrap_Widget_Popular_Tags extends WP_Widget {

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
        parent::__construct( 'wp_bootstrap_popular_tags', __( 'WPBootstrap Popular Tags' ), $widget_ops );
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
            empty( $instance['title'] ) ? __( 'WPBootstrap Popular Tags' ) : $instance['title'], $instance, $this->id_base
        );

        if ( $title ) :
            echo $args['before_title'] . $title . $args['after_title'];
        endif;

        $tags = get_tags( array(
            'orderby' => 'count',
            'order'   => 'DESC',
            'number'  => 14,
        ) );

        if ( ! empty( $tags ) ):
            ?>
            <p>
                <?php foreach ( $tags as $tag ):
                    $tag_link = get_tag_link( $tag->term_id );
                    ?>
                    <a href="<?php echo $tag_link; ?>" title="<?php $tag->name; ?>"
                       class="<?php echo $tag->slug; ?> btn btn-blue"
                    >
                        <?php echo $tag->name; ?>
                    </a>
                <?php endforeach; ?>
            </p>
            <?php
        endif;

        echo $args['after_widget'];
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
        //Defaults
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title    = sanitize_text_field( $instance['title'] );
        $number   = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php _e( 'Title:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"
            />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>">
                <?php _e( 'Number of popular tags to show:' ); ?>
            </label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>"
                   name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1"
                   value="<?php echo $number; ?>" size="3"
            />
        </p>
        <?php
    }
}

/**
 * Register WP_Bootstrap_Widget_Popular_Tags widget.
 */
function wp_bootstrap_register_popular_tags_widget() {
    register_widget( 'WP_Bootstrap_Widget_Popular_Tags' );
    do_action( 'widgets_init' );
}

add_action( 'init', 'wp_bootstrap_register_popular_tags_widget' );
