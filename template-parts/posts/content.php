<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

if ( has_post_thumbnail() ):
    $post_thumbnail_class    = 'col-md-5';
    $post_body_content_class = 'col-md-7';
else:
    $post_thumbnail_class    = '';
    $post_body_content_class = 'col-md-12 col-sm-12';
endif;
?>

<article id="<?php the_ID(); ?>" <?php post_class( 'post__holder' ); ?>>

    <header class="entry-header">
        <?php echo wp_bootstrap_post_meta(); ?>
    </header> <!-- /.entry-header -->


    <div class="entry-body">
        <div class="row">
            <div class="<?php echo $post_thumbnail_class; ?> post-thumbnail">
                <?php if ( has_post_thumbnail() ): ?>
                    <figure class="entry-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    </figure>
                <?php endif; ?>
            </div>

            <div class="<?php echo $post_body_content_class; ?>  content">
                <a href="<?php the_permalink(); ?>">
                    <h3 class="post__title"><?php the_title(); ?></h3>
                </a>

                <div class="entry-excerpt post__content">
                    <?php the_excerpt(); ?>
                </div> <!-- /.post__content -->

                <div class="post__read-more pull-right">
                    <a href="<?php the_permalink(); ?>" class="btn btn-light-blue"><?php _e( 'Read More' ); ?></a>
                </div> <!-- /.post__read-more -->

            </div>
        </div>
    </div> <!-- /.entry-body -->


    <footer class="entry-footer">
        <?php echo wp_bootstrap_post_footer(); ?>
    </footer> <!-- /.entry-footer -->

</article> <!-- /.post__holder -->
