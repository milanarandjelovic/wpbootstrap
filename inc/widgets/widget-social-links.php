<?php
/**
 * Widget API: WP_Bootstrap_Widget_Social_Links class
 *
 * @package    WordPress
 * @subpackage Widgets
 * @since      4.4.0
 */

/**
 * Core class used to implement a Social Links widget.
 *
 * @since 2.8.0
 *
 * @see   WP_Widget
 */
class WP_Bootstrap_Widget_Social_Links extends WP_Widget {

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
        parent::__construct( 'wp_bootstrap-social-links', __( 'WPBootstrap Social Links' ), $widget_ops );
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

        if ( ! empty( $instance['title'] ) ):
            $title = $instance['title'];
        else:
            $title = _( 'Social Links' );
        endif;

        $dribbble  = empty( $instance['dribbble'] ) ? '' : $instance['dribbble'];
        $facebook  = empty( $instance['facebook'] ) ? '' : $instance['facebook'];
        $twitter   = empty( $instance['twitter'] ) ? '' : $instance['twitter'];
        $instagram = empty( $instance['instagram'] ) ? '' : $instance['instagram'];
        $tumblr    = empty( $instance['tumblr'] ) ? '' : $instance['tumblr'];

        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        if ( ! empty( $title ) ):
            echo $args['before_title'] . $title . $args['after_title'];
        endif;
        $html = '<p>';

        if ( $dribbble != '' ):
            $html .= "<a href='" . $dribbble . "'><i class='fa fa-dribbble'></i></a>";
        endif;

        if ( $facebook != '' ):
            $html .= "<a href='" . $facebook . "'><i class='fa fa-facebook'></i></a>";
        endif;

        if ( $twitter != '' ):
            $html .= "<a href='" . $twitter . "'><i class='fa fa-twitter'></i></a>";
        endif;

        if ( $instagram != '' ):
            $html .= "<a href='" . $instagram . "'><i class='fa fa-instagram'></i></a>";
        endif;

        if ( $tumblr != '' ):
            $html .= "<a href='" . $tumblr . "'><i class='fa fa-tumblr'></i></a>";
        endif;

        echo $html;
        
        echo $args['after_widget'];
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
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php _e( 'Title:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo $title; ?>"
            />
        </p>
        <p>
            <strong>Social Links:</strong>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'dribbble' ); ?>">
                <?php _e( 'Dribbble:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'dribbble' ); ?>"
                   name="<?php echo $this->get_field_name( 'dribbble' ); ?>" type="text"
                   value="<?php echo $dribbble; ?>"
            />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
                <?php _e( 'Facebook:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>"
                   name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text"
                   value="<?php echo $facebook; ?>"
            />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'twitter' ); ?>">
                <?php _e( 'Twitter:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>"
                   name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text"
                   value="<?php echo $twitter; ?>"
            />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'instagram' ); ?>">
                <?php _e( 'Instagram:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>"
                   name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text"
                   value="<?php echo $instagram; ?>"
            />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'tumblr' ); ?>">
                <?php _e( 'Tumblr:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tumblr' ); ?>"
                   name="<?php echo $this->get_field_name( 'tumblr' ); ?>" type="text"
                   value="<?php echo $tumblr; ?>"
            />
        </p>
        <?php
    }
}

/**
 * Register WP_Bootstrap_Widget_Recent_Posts widget.
 */
function wp_bootstrap_register_social_links_widget() {
    register_widget( 'WP_Bootstrap_Widget_Social_Links' );
    do_action( 'widgets_init' );
}

add_action( 'init', 'wp_bootstrap_register_social_links_widget' );
