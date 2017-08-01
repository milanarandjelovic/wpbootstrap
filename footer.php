<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPBootstrap
 */
?>

<footer id="footer-wrap">
    <div class="container">
        <div class="row">
            <?php if ( is_active_sidebar( 'wp_bootstrap-footer-left-sidebar' ) ): ?>
                <div class="col-md-4">
                    <?php dynamic_sidebar( 'wp_bootstrap-footer-left-sidebar' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'wp_bootstrap-footer-middle-sidebar' ) ): ?>
                <div class="col-md-4">
                    <?php dynamic_sidebar( 'wp_bootstrap-footer-middle-sidebar' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'wp_bootstrap-footer-right-sidebar' ) ): ?>
                <div class="col-md-4">
                    <?php dynamic_sidebar( 'wp_bootstrap-footer-right-sidebar' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

</div> <!-- /#content -->

<?php wp_footer(); ?>
</body>
</html>
