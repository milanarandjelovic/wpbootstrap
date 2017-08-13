<?php
/**
 * The WordPress Query class.
 *
 * @link  http://codex.wordpress.org/Function_Reference/WP_Query
 */

$args = array(
    // Type and Status Parameters
    'post_type'     => array(
        'feature',
    ),
    'post_status'   => array(
        'publish',
    ),
    // Order & Order by Parameters
    'order'         => 'ASC',
    'orderby'       => 'meta_value_num',
    // Pagination Parameters
    'post_per_page' => - 1,
    // Custom Fields Parameters
    'meta_key'      => '_wp_bootstrap_feature_order',
    'meta_query'    => array(
        array(
            'key'     => '_wp_bootstrap_feature_show',
            'value'   => 'Yes',
            'type'    => 'CHAR',
            'compare' => '=',
        ),
    ),
);

$services = new WP_Query( $args );

if ( $services->have_posts() ): ?>
    <div id="service">
        <div class="container">
            <div class="row text-center">
                <?php while ( $services->have_posts() ):
                    $services->the_post(); ?>
                    <?php $featureIcon = get_post_meta( get_the_ID(), '_wp_bootstrap_feature_icon', true ); ?>
                    <div class="col-md-4">
                        <?php if ( $featureIcon != null && $featureIcon != '' ): ?>
                            <i class="fa <?php echo $featureIcon; ?>"></i>
                        <?php endif; ?>
                        <h4><?php the_title(); ?></h4>
                        <?php the_content( '' ); ?>
                        <p>
                            <br>
                            <a href="<?php the_permalink(); ?>" class="btn btn-light-blue">
                                <?php _e( 'More Info', 'wp_bootstrap' ); ?>
                            </a>
                        </p>
                    </div> <!-- /.col-md-4 -->
                <?php endwhile; ?>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#service -->
<?php endif; ?>
