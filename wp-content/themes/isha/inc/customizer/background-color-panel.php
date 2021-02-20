<?php
/**
 * Background Color panel at Theme Customizer
 * @package Isha 
 * @since 1.0.0
 */

add_action( 'customize_register', 'isha_custom_color_register' );
function isha_custom_color_register( $wp_customize ) {
 
    // Inlcude the Alpha Color Picker control file.
    require get_template_directory() . '/inc/alpha-color-picker.php';
    
    $wp_customize->add_section(
    'isha_background_color_section',
    array(
        'priority'       => 31,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Background color', "isha" ),
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
		'label'     => __( 'Main background color', 'isha' ),
		'section'   => 'isha_background_color_section',
		'settings'  => 'background_color',
		'type'		=> 'color',
		) 
	) );

 
    //Overlay Bg color Background
    $wp_customize->add_setting(
        'overlay_bg_color',
        array(
            'default'    => '#000',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage',
            'sanitize_callback' =>'sanitize_text_field'
        )
    );
 
  // Alpha Color Picker control.
    $wp_customize->add_control(
        new Isha_Customize_Alpha_Color_Control(
            $wp_customize,
            'overlay_bg_color',
            array(
                'label'        => __( 'Overlay color in background color', 'isha' ),
                'description'   => __('Overlay color is used in main slider','isha'),
                'section'      => 'isha_background_color_section',
                'settings'     => 'overlay_bg_color',
                'show_opacity' => true, // Optional.
                'palette'      => array(
                    '#9632dc',
                    '#000000',
                    '#FFFFFF',
                    '#c95c2e' ,
                    '#2b50bf',
                    '#d63199',
                    '#dfe835',
                    '#541600'
                )
            )
        )
    );


    //header Bg color Background
    $wp_customize->add_setting(
        'header_bg_color',
        array(
            'default'    => '#222',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'postMessage',
            'sanitize_callback' =>'sanitize_text_field'
        )
    );
 
  // Alpha Color Picker control.
    $wp_customize->add_control(
        new Isha_Customize_Alpha_Color_Control(
            $wp_customize,
            'header_bg_color',
            array(
                'label'        => __( 'Header Background Color', 'isha' ),
                'section'      => 'isha_background_color_section',
                'settings'     => 'header_bg_color',
                'show_opacity' => true, // Optional.
                'palette'      => array(
                    '#9632dc',
                    '#000000',
                    '#FFFFFF',
                    '#c95c2e' ,
                    '#2b50bf',
                    '#d63199',
                    '#dfe835',
                    '#541600'
                )
            )
        )
    );
}