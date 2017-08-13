<?php
/**
 * The WordPress Query class.
 *
 * @link  http://codex.wordpress.org/Function_Reference/WP_Query
 */

$args = array(
    // Type and Status Parameters
    'post_type'     => array(
        'testimonial',
    ),
    'post_status'   => array(
        'publish',
    ),
    // Pagination Parameters
    'post_per_page' => - 1,

);

$allTestimonials = get_posts( $args );

if ( ! empty ( $allTestimonials ) ):
    ?>
    <div id="testimonial_wrap">
        <div class="container text-centred">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                    <i class="fa fa-comment-o"></i>
                    <?php if ( count( $allTestimonials ) == 1 ): ?>
                        <?php wp_bootstrap_the_testimonial( $allTestimonials[0] ) ?>
                    <?php else: ?>
                        <div id="carousel-testimonials" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php
                                $i = 0;

                                foreach ( $allTestimonials as $testimonial ): ?>
                                    <li data-target="#carousel-testimonials" data-slide-to="<?php echo $i; ?>"
                                        class="<?php echo $i == 0 ? 'active' : '' ?>"
                                    >
                                    </li>
                                    <?php $i ++; ?>
                                <?php endforeach; ?>
                            </ol>

                            <div class="carousel-inner" role="listbox">
                                <?php
                                $i = 0;

                                foreach ( $allTestimonials as $testimonial ): ?>
                                    <div class="item <?php echo $i == 0 ? 'active' : '' ?>">
                                        <?php wp_bootstrap_the_testimonial( $testimonial ) ?>
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
