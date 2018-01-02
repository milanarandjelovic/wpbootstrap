<?php
/**
 * WPBootstrap Engine Room.
 * This is where all Theme Functions runs.
 *
 * @package WPBootstrap
 */

/**
 * Include custom post type
 */
require_once get_template_directory() . '/inc/post-types/post-type-features.php';
require_once get_template_directory() . '/inc/post-types/post-type-faq.php';
require_once get_template_directory() . '/inc/post-types/post-type-testimonials.php';
require_once get_template_directory() . '/inc/post-types/post-type-team.php';
require_once get_template_directory() . '/inc/post-types/post-type-portfolio.php';

