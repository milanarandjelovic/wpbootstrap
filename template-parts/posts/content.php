<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */
?>

<article id="<?php the_ID(); ?>" <?php post_class( 'post__holder ' ); ?>>

    <?php if ( has_post_thumbnail() ): ?>
        <figure class="entry-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'wp_bootstrap_post-thumbnail', array(
                    'class' => 'img-responsive',
                ) ); ?>
            </a>
        </figure>
    <?php endif; ?>

    <div class="entry-body">
        <a href="<?php the_permalink(); ?>">
            <h3 class="post__title"><?php the_title(); ?></h3>
        </a>

        <p>
            <small class="post__posted_at">Posted: <?php echo get_the_date(); ?></small>
            |
            <small class="post__posted_by">By: <?php the_author() ?>
                - <?php comments_number(); ?></small>
        </p>

        <div class="entry-excerpt post__content">
            <?php the_excerpt(); ?>
        </div> <!-- /.post_content -->

        <?php if ( ! is_singular() ): ?>
            <div class="hline"></div>
        <?php endif; ?>

        <div class="spacing"></div>

    </div> <!-- /.entry-body -->

</article> <!-- /.post__holder -->
