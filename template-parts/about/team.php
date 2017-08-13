<?php
/**
 * The WordPress Query class.
 *
 * @link  http://codex.wordpress.org/Function_Reference/WP_Query
 */

$args = array(
    // Type and Status Parameters
    'post_type'     => 'team',
    // Pagination Parameters
    'post_per_page' => - 1,
);

$teams = new WP_Query( $args );

if ( $teams->have_posts() ): ?>
    <div id="clients-wrap">
        <div class="container">
            <div class="row text-center">
                <h3>Meet Our Team</h3>
                <?php while ( $teams->have_posts() ): $teams->the_post(); ?>
                    <?php
                    $position = get_post_meta( get_the_ID(), '_wp_bootstrap_team_position', true );
                    ?>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <div class="he-wrap tpl6">
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php
                                $twitter = get_post_meta( get_the_ID(), '_wp_bootstrap_team_twitter', true );

                                if ( $twitter != '' && $twitter != null && strpos( $twitter, '@' ) === false ) :
                                    $twitter = '@' . $twitter;
                                endif;

                                $email = get_post_meta( get_the_ID(), '_wp_bootstrap_team_email', true );
                                ?>
                                <?php
                                the_post_thumbnail(
                                    'wp_bootstrap_portfolio-thumbnail-project',
                                    array( 'class' => 'img-responsive' )
                                );
                                ?>
                                <div class="he-view">
                                    <div class="bg a0" data-animate="fadeIn">
                                        <h3 class="a1" data-animate="fadeInDown">Contact Me:</h3>

                                        <?php if ( $email != '' && $email != null ): ?>
                                            <a href="mailto:<?php echo $email ?>" class="dmbutton a2"
                                               data-animate="fadeInUp"
                                            >
                                                <i class="fa fa-envelope"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if ( $twitter != '' && $twitter != null ): ?>
                                            <a href="http://twitter.com/<?php echo $twitter; ?>" class="dmbutton a2"
                                               data-animate="fadeInUp"
                                            >
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        <?php endif; ?>

                                    </div>
                                </div> <!-- /.he-view -->
                            <?php endif; ?>
                        </div> <!-- /.he-wrap -->
                        <h4><?php the_title(); ?></h4>
                        <h5 class="blue-title"><?php echo $position; ?></h5>
                        <p><?php echo strip_tags( get_the_content() ); ?></p>
                        <div class="hline"></div>
                    </div>
                <?php endwhile; ?>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#clients-wrap -->
<?php endif; ?>
