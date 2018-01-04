<?php
/**
 * The WordPress Query class.
 *
 * @link  http://codex.wordpress.org/Function_Reference/WP_Query
 */

$args = array(
    // Type and Status Parameters
    'post_type'   => 'wpb-portfolio',
    'post_status' => 'publish',
);

$projects = new WP_Query( $args );
?>

<?php $taxonomies = get_terms( 'portfolio_category' ); ?>

<div class="container-fluid">
    <nav class="portfolio-filter centred col-lg-8 col-lg-offset-2">
        <ul class="nav nav-pills">
            <li class="active"><a data-filter="*">All</a></li>
            <?php foreach ( $taxonomies as $taxonomy ): ?>
                <li><a data-filter="<?php echo $taxonomy->slug; ?>"><?php echo $taxonomy->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</div>

<?php if ( $projects->have_posts() ): ?>
    <div id="portfolio__wrapper">
        <div class="portfolio__centred">
            <div class="recent-items portfolio">
                <?php while ( $projects->have_posts() ): $projects->the_post(); ?>
                    <?php
                    $categories = wp_get_object_terms( get_the_ID(), 'portfolio_category' );
                    // $tags       = wp_get_object_terms( get_the_ID(), 'portfolio_tag' );
                    // $categories = array_merge( $categories, $tags );

                    $portfolioCategories = '';
                    foreach ( $categories as $category ):
                        $portfolioCategories .= ' ' . $category->slug . ' ';
                    endforeach;
                    ?>
                    <div class="portfolio-item <?php echo $portfolioCategories; ?>">
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

