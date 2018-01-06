<?php
/**
 * The header for the WPBootstrap theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link       https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    WPBootstrap
 * @subpackage Templates
 * @since      1.0.0
 * @author     Milan Arandjelovic
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title>
			<?php
			bloginfo( 'name' );
			wp_title( '|', true );
			?>
		</title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php if ( is_singular() && get_option( 'thread_comments' ) ) : ?>
			<?php wp_enqueue_script( 'common-reply' ); ?>
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<div id="content">

