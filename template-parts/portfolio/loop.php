<?php
/**
 * The WordPress Query class.
 *
 * @link  http://codex.wordpress.org/Function_Reference/WP_Query
 */

$args = array(
    // Type and Status Parameters
    'post_type'   => 'portfolio',
    'post_status' => 'publish',
);

$projects = new WP_Query( $args );
?>

<?php if ( $projects->have_posts() ): ?>
    <div id="portfolio__wrapper">
        <div class="portfolio__centred">
            <div class="recent-items portfolio">
                <?php while ( $projects->have_posts() ): $projects->the_post(); ?>
                    <div class="portfolio-item">
                        <div class="he-wrap tpl6">
                            <?php
                            $image = '';
                            if ( has_post_thumbnail() ):
                                the_post_thumbnail( 'wp_bootstrap_portfolio-thumbnail-project' );
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                            endif;
                            ?>
                            <div class="he-view">
                                <div class="bg a0" data-animate="fadeIn">
                                    <h3 class="a1" data-animate="fadeInDown"><?php the_title(); ?></h3>
                                    <?php if ( $image != '' ): ?>
                                        <a href="<?php echo $image[0]; ?>"
                                           data-rel="prettyPhoto"
                                           class="dmbutton a2"
                                           data-animate="fadeInUp"
                                        >
                                            <i class="fa fa-search"></i>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>"
                                       class="dmbutton a2"
                                       data-animate="fadeInUp"
                                    >
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div> <!-- /.bg -->
                            </div> <!-- /.he-view -->
                        </div> <!-- /.he-wrap -->
                    </div>
                <?php endwhile; ?>
            </div> <!-- /.recent-items -->
        </div> <!-- /.portfolio__centred -->
    </div> <!-- /#portfolio__wrapper -->
<?php endif; ?>

