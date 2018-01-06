<?php
/**
 * Template for display services content in home page template.
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

$args = array(
	// Type and Status Parameters.
	'post_type'     => array(
		'wp-bootstrap-feature',
	),
	'post_status'   => array(
		'publish',
	),
	// Order & Order by Parameters.
	'order'         => 'ASC',
	'orderby'       => 'meta_value_num',
	// Pagination Parameters.
	'post_per_page' => - 1,
	// Custom Fields Parameters.
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

if ( $services->have_posts() ) :
	?>
	<div id="service">
		<div class="container">
			<div class="row text-center">
				<?php
				while ( $services->have_posts() ) :
					$services->the_post();
					$feature_icon = get_post_meta( get_the_ID(), '_wp_bootstrap_feature_icon', true );
				?>
					<div class="col-md-4">
						<?php if ( null !== $feature_icon && '' !== $feature_icon ) : ?>
							<i class="fa <?php echo $feature_icon; // WPCS: XSS OK. ?>"></i>
						<?php endif; ?>
						<h4><?php the_title(); ?></h4>
						<?php the_content( '' ); ?>
						<p>
							<br>
							<a href="<?php the_permalink(); ?>" class="btn btn-light-blue">
								<?php esc_attr_e( 'More Info', 'wp_bootstrap' ); ?>
							</a>
						</p>
					</div> <!-- /.col-md-4 -->
				<?php endwhile; ?>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</div> <!-- /#service -->
<?php endif; ?>
