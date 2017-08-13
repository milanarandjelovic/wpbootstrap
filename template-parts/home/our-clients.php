<?php
/**
 * The WordPress Query class.
 *
 * @link  http://codex.wordpress.org/Function_Reference/WP_Query
 */

$clientsImageArgs = array(
    // Type and Status Parameters
    'post_type'     => 'attachment',
    'post_status'   => 'inherit',
    // Pagination Parameters
    'post_per_page' => - 1,
    // Custom Fields Parameters
    'meta_key'      => '_wp_bootstrap_client_image',
    'meta_value'    => '1',
    'meta_compare'  => '=',
);

$clientsImage = new WP_Query( $clientsImageArgs );

if ( $clientsImage->have_posts() ): ?>
    <div id="clients-wrap">
        <div class="container">
            <div class="row text-center">
                <h3>Our Clients</h3>
                <?php while ( $clientsImage->have_posts() ): $clientsImage->the_post(); ?>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <img src="<?php echo get_the_guid(); ?>" class="img-responsive">
                    </div>
                <?php endwhile; ?>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#clients-wrap -->
<?php endif; ?>
