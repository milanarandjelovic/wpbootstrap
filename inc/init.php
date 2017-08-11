<?php
/**
 * WPBootstrap Engine Room.
 * This is where all Theme Functions runs.
 *
 * @package WPBootstrap
 */

/**
 * Bootstrap navwlaker class
 */
require_once get_template_directory() . '/inc/class/wp-bootstrap-navwalker.php';

/**
 * Bootstrap comment navwlaker
 */
require_once get_template_directory() . '/inc/class/wp-bootstrap-comment-walker.php';

/**
 * Include custom widgets
 */
require_once get_template_directory() . '/inc/widgets/widget-categories.php';
require_once get_template_directory() . '/inc/widgets/widget-recent-posts.php';
require_once get_template_directory() . '/inc/widgets/widget-popular-tags.php';
require_once get_template_directory() . '/inc/widgets/widget-social-links.php';
require_once get_template_directory() . '/inc/widgets/widget-page.php';

/**
 * Include custom post type
 */
require_once get_template_directory() . '/inc/post-types/post-type-features.php';

/**
 * Include theme setup function
 */
require_once get_template_directory() . '/inc/functions/function-setup.php';

/**
 * Include custom functions
 */
require_once get_template_directory() . '/inc/functions/wp_bootstrap_pagination.php';
require_once get_template_directory() . '/inc/functions/function-template-tags.php';
