<?php
/**
 * Theme optons panel at Theme Customizer
 *
 * @package Isha 
 * @since 1.0.0
 */

add_action( 'customize_register', 'isha_theme_option_register' );

function isha_theme_option_register( $wp_customize ) {
    /**
     * Add Theme options Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
        'isha_theme_option_panel',
        array(
            'priority'       => 30,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Theme options', "isha" ),
        )
    );
}
require get_template_directory() . '/inc/customizer/header-settings.php';
require get_template_directory() . '/inc/customizer/blog-settings.php'; /* this contains both blog and single page setting */
require get_template_directory() . '/inc/customizer/slider-settings.php';
require get_template_directory() . '/inc/customizer/general-settings.php';