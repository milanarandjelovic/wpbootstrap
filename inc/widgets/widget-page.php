<?php
/**
 * Widget API: WP_Bootstrap_Widget_One_Page class
 *
 * @package    WordPress
 * @subpackage Widgets
 * @since      4.4.0
 */

/**
 * Core class used to implement a Categories widget.
 *
 * @since 2.8.0
 *
 * @see   WP_Widget
 */
class WP_Bootstrap_Widget_One_Page extends WP_Widget {

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
        parent::__construct( 'wp_bootstrap_one_page', __( 'WPBootstrap One Page' ), $widget_ops );
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
        $currentPage = new WP_Query( 'page_id=' . $instance['page'] );

        // The Loop
        if ( $currentPage->have_posts() ):
            echo $args['before_widget'];

            while ( $currentPage->have_posts() ): $currentPage->the_post();
                ?>
                <h4><?php the_title(); ?></h4>
                <?php
                // Fetch post content
                $content = get_post_field( 'post_content', get_the_ID() );

                // Get content parts
                $content_parts = get_extended( $content );

                // Output part before <!-- more --> tag
                echo $content_parts['main'];

                if ( $content_parts['extended'] != '' ):
                    ?>
                    <p>
                        <br>
                        <a href="<?php echo get_the_permalink(); ?>" class="btn btn-light-blue">
                            More Info
                        </a>
                    </p>
                    <?php
                endif;
            endwhile;
            echo $args['after_widget'];
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
        // Defaults
        $instance    = wp_parse_args( ( array) $instance, array( 'page' => 0 ) );
        $currentPage = esc_attr( $instance['page'] );
        $getAllPages = get_posts( array( 'posts_per_page' => - 1, 'post_type' => 'page' ) );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>">
                <?php _e( 'Page:' ) ?>
                <select name="<?php echo $this->get_field_name( 'page' ); ?>"
                        id="<?php echo $this->get_field_id( 'page' ); ?>"
                        class="widefat"
                >
                    <option value="0" <?php selected( 0, $currentPage ); ?> >None</option>
                    <?php
                    foreach ( $getAllPages as $page ):
                        ?>
                        <option value="<?php echo $page->ID; ?>"
                            <?php selected( $page->ID, $currentPage, true, 'selected' ); ?>
                        >
                            <?php echo $page->post_title; ?>
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

/**
 * Register WP_Bootstrap_Widget_Categories widget.
 */
function wp_bootstrap_register_one_page_widget() {
    register_widget( 'WP_Bootstrap_Widget_One_Page' );
    do_action( 'widgets_init' );
}

add_action( 'init', 'wp_bootstrap_register_one_page_widget' );
