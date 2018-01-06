<?php
/**
 * Template for display testimonial content in home page template.
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
		'testimonial',
	),
	'post_status'   => array(
		'publish',
	),
	// Pagination Parameters.
	'post_per_page' => - 1,
);

$all_testimonials = get_posts( $args );

if ( ! empty( $all_testimonials ) ) :
?>
<div id="testimonial_wrap">
	<div class="container text-centred">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<i class="fa fa-comment-o"></i>
				<?php if ( count( $all_testimonials ) === 1 ) : ?>
					<?php wp_bootstrap_the_testimonial( $all_testimonials[0] ); ?>
				<?php else : ?>
					<div id="carousel-testimonials" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php
							$i = 0;

							foreach ( $all_testimonials as $testimonial ) :
							?>
								<li data-target="#carousel-testimonials" data-slide-to="<?php echo $i; // WPCS: XSS OK. ?>"
									class="<?php echo  0 === $i ? 'active' : ''; ?>"
								>
								</li>
								<?php $i ++; ?>
							<?php endforeach; ?>
						</ol>

						<div class="carousel-inner" role="listbox">
							<?php
							$i = 0;

							foreach ( $all_testimonials as $testimonial ) :
							?>
								<div class="item <?php echo 0 === $i ? 'active' : ''; ?>">
									<?php wp_bootstrap_the_testimonial( $testimonial ); ?>
								</div>
								<?php $i ++; ?>
							<?php endforeach; ?>
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-testimonials" role="button"
						   data-slide="prev">
							<span class="fa fa-arrow-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-testimonials" role="button"
						   data-slide="next">
							<span class="fa fa-arrow-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div> <!-- /#carousel-testimonials -->
				<?php endif; ?>
			</div>  <!-- /.col-lg-8 -->
		</div>  <!-- /.row -->
	</div> <!-- /.container -->
</div> <!-- /#twrap -->
<?php endif; ?>
