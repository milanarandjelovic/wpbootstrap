<?php
/**
 * Template Name: Home page
 *
 * The template for displaying hom page.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBootstrap
 */

get_header();
?>

<?php get_template_part( 'template-parts/header/navigation' ); ?>

<div class="header__wrapper-home">
    <div class="container">
        <div class="row">
            <?php if ( have_posts() ):
                while ( have_posts() ): the_post(); ?>
                    <div class="col-lg-8 col-lg-offset-2">
                        <?php the_content(); ?>
                    </div> <!-- /.col-lg-8 -->
                    <div class="col-lg-8 col-lg-offset-2">
                        <?php if ( has_post_thumbnail() ):
                            the_post_thumbnail( 'wp_bootstrap_post-thumbnail-lg', array(
                                'class' => 'img-responsive',
                            ) );
                        endif; ?>
                    </div> <!-- /.col-lg-8 -->
                <?php endwhile;
            endif; ?>
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.header__wrapper-home -->

<?php
/**
 * The WordPress Query class.
 *
 * @link  http://codex.wordpress.org/Function_Reference/WP_Query
 */

$args = array(
    'post_type'     => array(
        'feature',
    ),
    'post_status'   => array(
        'publish',
    ),
    // Order & Order by Parameters
    'order'         => 'ASC',
    'orderby'       => 'meta_value_num',
    // Pagination Parameters
    'post_per_page' => - 1,
    // Custom Fields Parameters
    'meta_key'      => '_wp_bootstrap_feature_order',
    'meta_query'    => array(
        array(
            'key'     => '_wp_bootstrap_feature_show',
            'value'   => 'Yes',
            'type'    => 'CHAR',
            'compare' => '=',
        ),
    ),
);

$services = new WP_Query( $args );

if ( $services->have_posts() ): ?>
    <div id="service">
        <div class="container">
            <div class="row centred">
                <?php while ( $services->have_posts() ):
                    $services->the_post(); ?>
                    <?php $featureIcon = get_post_meta( get_the_ID(), '_wp_bootstrap_feature_icon', true ); ?>
                    <div class="col-md-4">
                        <?php if ( $featureIcon != null && $featureIcon != '' ): ?>
                            <i class="fa <?php echo $featureIcon; ?>"></i>
                        <?php endif; ?>
                        <h4><?php the_title(); ?></h4>
                        <?php the_content( '' ); ?>
                        <p>
                            <br>
                            <a href="<?php the_permalink(); ?>" class="btn btn-light-blue">
                                <?php _e( 'More Info', 'wp_bootstrap' ); ?>
                            </a>
                        </p>
                    </div> <!-- /.col-md-4 -->
                <?php endwhile; ?>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#service -->
<?php endif; ?>

<div id="container">
    <div class="row">

        <?php if ( is_active_sidebar( 'wp_bootstrap-home-left-sidebar' ) ): ?>
            <div class="col-lg-4 col-lg-offset-1">
                <?php dynamic_sidebar( 'wp_bootstrap-home-left-sidebar' ); ?>
            </div> <!-- /.col-lg-4 -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'wp_bootstrap-home-middle-sidebar' ) ): ?>
            <div class="col-lg-3">
                <?php dynamic_sidebar( 'wp_bootstrap-home-middle-sidebar' ); ?>
            </div> <!-- /.col-lg-3 -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'wp_bootstrap-home-right-sidebar' ) ): ?>
            <div class="col-lg-3">
                <?php dynamic_sidebar( 'wp_bootstrap-home-right-sidebar' ); ?>
            </div> <!-- /.col-lg-3 -->
        <?php endif; ?>

    </div> <!-- /.row -->
</div> <!-- /.container -->

<?php get_footer(); ?>
