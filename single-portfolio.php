<?php
/**
 * The template for displaying all single portfolio post.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WPBootstrap
 */

get_header();
?>
<?php get_template_part( 'template-parts/header/navigation' ); ?>

<div class="container">
    <div class="row">
        <?php $images = ''; ?>
        <?php if ( have_posts() ): ?>
            <?php while ( have_posts() ): the_post();
                $images = get_images_src( 'wp_bootstrap_portfolio-single-project', false, get_the_ID() );
                ?>
                <?php if ( ! empty( $images ) ): ?>
                    <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 centred">
                        <div id="single-portfolio-carousel" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php $imagesCount = count( $images );
                                for ( $i = 0; $i < $imagesCount; $i ++ ): ?>
                                    <li data-target="single-portfolio-carousel"
                                        data-slide-to="<?php echo $i; ?>"
                                        <?php echo $i == 0 ? 'class="active"' : '' ?>
                                    >
                                    </li>
                                <?php endfor; ?>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php
                                $counter = 0;
                                foreach ( $images as $img ): ?>
                                    <div class="item <?php echo $counter == 0 ? 'active' : ''; ?>">
                                        <img src="<?php echo $img[0]; ?>" alt="">
                                    </div> <!-- /.item -->
                                    <?php $counter ++; ?>
                                <?php endforeach; ?>
                            </div> <!-- /.carousel-inner -->

                        </div> <!-- /#single-portfolio-carousel -->
                    </div> <!-- /.col-md-10 -->
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div> <!-- /.row -->
</div> <!-- /.container -->

<h1>Single Portfolio</h1>

<?php get_footer(); ?>
