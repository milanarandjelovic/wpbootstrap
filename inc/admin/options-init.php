<?php

/**
 * For full documentation, please visit: http://docs.reduxframework.com/
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 */

if ( ! class_exists( 'Redux' ) ) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "wp_bootstrap";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'opt_name'              => 'wp_bootstrap',
    'dev_mode'              => false,
    'display_name'          => $theme->get( 'Name' ),
    'display_version'       => $theme->get( 'Version' ),
    'page_slug'             => 'wp_bootstrap',
    'page_title'            => esc_html__( 'Theme Options', 'wp_bootstrap' ),
    'update_notice'         => true,
    'intro_text'            => 'WPBootstrap Theme options.',
    'admin_bar'             => true,
    'menu_type'             => 'menu',
    'menu_title'            => esc_html__( 'Theme Options', 'wp_bootstrap' ),
    'admin_bar_icon'        => 'dashicons-admin-generic',
    'allow_sub_menu'        => true,
    'page_parent_post_type' => 'your_post_type',
    'customizer'            => true,
    'default_mark'          => '*',
    'class'                 => 'wp_bootstrap',
    'hints'                 => array(
        'icon_position' => 'right',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'dark',
            'shadow'  => '1',
            'rounded' => '1',
            'style'   => 'bootstrap',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseleave unfocus',
            ),
        ),
    ),
    'output'                => true,
    'output_tag'            => true,
    'settings_api'          => true,
    'cdn_check_time'        => '1440',
    'compiler'              => true,
    'page_permissions'      => 'manage_options',
    'save_defaults'         => true,
    'show_import_export'    => true,
    'disable_save_warn'     => true,
    'database'              => 'options',
    'transient_time'        => '3600',
    'network_sites'         => true,
);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 *
 * ---> START SECTIONS
 *
 */

/**
 * Navigation Settings
 */
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Navigation Settings', 'wp_bootstrap' ),
    'id'     => 'wp_bootstrap__section-navigation',
    'icon'   => 'el el-arrow-up',
    'fields' => array(
        array(
            'id'                    => 'wp_bootstrap__navigation-background-color',
            'type'                  => 'background',
            'title'                 => esc_html__( 'Navigation background color', 'wp_bootstrap' ),
            'subtitle'              => esc_html__( 'Pick a navigation background color', 'wp_bootstrap' ),
            'preview'               => false,
            'background-size'       => false,
            'background-repeat'     => false,
            'background-attachment' => false,
            'background-position'   => false,
            'background-image'      => false,
            'default'               => array(
                'background-color' => '#384452',
            ),
        ),
    ),
) );

/*
 * <--- END SECTIONS
 */
