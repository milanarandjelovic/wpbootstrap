<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
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

?>

<section class="no-results not-fund">
	<h2><?php esc_html__( 'Nothing found', 'wp_bootstrap' ); ?></h2>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
				<?php
				printf(
					wp_kses(
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wp_bootstrap' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' )
					)
				);
				?>
			</p>
		<?php elseif ( is_search() ) : ?>
			<p>
				<?php
				esc_html_e(
					'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
					'wp_bootstrap'
				);
				?>
			</p>
			<?php get_template_part( 'template-parts/search-form-content' ); ?>
		<?php else : ?>
			<p>
				<?php
				esc_html_e(
					'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.',
					'wp_bootstrap'
				);
				?>
			</p>
			<?php get_template_part( 'template-parts/search-form-content' ); ?>
		<?php endif; ?>
	</div> <!-- /.page-content -->

</section> <!-- /.no-results -->
