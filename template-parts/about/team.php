<?php
/**
 * The WordPress Query class.
 *
 * @link       http://codex.wordpress.org/Function_Reference/WP_Query
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
	'post_type'     => 'team',
	// Pagination Parameters.
	'post_per_page' => - 1,
);

$teams = new WP_Query( $args );

if ( $teams->have_posts() ) :
	?>
	<div id="clients-wrap">
		<div class="container">
			<div class="row text-center">
				<h3>Meet Our Team</h3>
				<?php
				while ( $teams->have_posts() ) :
					$teams->the_post();
					$position = get_post_meta( get_the_ID(), '_wp_bootstrap_team_position', true );
					?>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<div class="he-wrap tpl6">
							<?php
							if ( has_post_thumbnail() ) :
								$twitter = get_post_meta( get_the_ID(), '_wp_bootstrap_team_twitter', true );

								if ( '' !== $twitter && null !== $twitter && strpos( $twitter, '@' ) === false ) {
									$twitter = '@' . $twitter;
								}

								$email = get_post_meta( get_the_ID(), '_wp_bootstrap_team_email', true );
								the_post_thumbnail(
									'wp_bootstrap_portfolio-thumbnail-project',
									array(
										'class' => 'img-responsive',
									)
								);
								?>
								<div class="he-view">
									<div class="bg a0" data-animate="fadeIn">
										<h3 class="a1" data-animate="fadeInDown">Contact Me:</h3>

										<?php if ( '' !== $email && null !== $email ) { ?>
											<a href="mailto:<?php echo sanitize_email( $email ); // WPCS: XSS OK. ?>"
											   class="dmbutton a2"
											   data-animate="fadeInUp"
											>
												<i class="fa fa-envelope"></i>
											</a>
										<?php } ?>

										<?php if ( '' !== $twitter && null !== $twitter ) { ?>
											<a href="http://twitter.com/<?php echo esc_attr( $twitter ); ?>"
											   class="dmbutton a2"
											   data-animate="fadeInUp"
											>
												<i class="fa fa-twitter"></i>
											</a>
										<?php } ?>

									</div>
								</div> <!-- /.he-view -->
							<?php endif; ?>
						</div> <!-- /.he-wrap -->
						<h4><?php the_title(); ?></h4>
						<h5 class="blue-title"><?php echo esc_attr( $position ); ?></h5>
						<p><?php echo strip_tags( get_the_content() ); // WPCS: XSS OK. ?></p>
						<div class="hline"></div>
					</div>
				<?php endwhile; ?>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</div> <!-- /#clients-wrap -->
<?php endif; ?>
