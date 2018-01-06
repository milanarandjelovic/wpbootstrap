<?php
/**
 * Template for display clients content in home page template.
 *
 * @package    WPBootstrap
 * @subpackage Templates
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

$clients_image_args = array(
	// Type and Status Parameters.
	'post_type'     => 'attachment',
	'post_status'   => 'inherit',
	// Pagination Parameters.
	'post_per_page' => - 1,
	// Custom Fields Parameters.
	'meta_key'      => '_wp_bootstrap_client_image',
	'meta_value'    => '1',
	'meta_compare'  => '=',
);

$clients_image = new WP_Query( $clients_image_args );

if ( $clients_image->have_posts() ) : ?>
	<div id="clients-wrap">
		<div class="container">
			<div class="row text-center">
				<h3>Our Clients</h3>
				<?php
				while ( $clients_image->have_posts() ) :
					$clients_image->the_post();
				?>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<img src="<?php echo get_the_guid(); // WPCS: XSS OK. ?>" class="img-responsive">
					</div>
				<?php endwhile; ?>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</div> <!-- /#clients-wrap -->
<?php endif; ?>
