<?php
/**
* Primary Theme Color
*/
 $wp_customize->add_setting( 'isha_primary_theme_color_setting', array(
  'capability'        => 'edit_theme_options',
  'default'           => '#dd1f1f',
  'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'isha_primary_theme_color_setting',array(
  'label'                 =>  __( 'Theme Color', 'isha' ),
  'section'               => 'colors',
  'type'                  => 'color',
  'priority'              => 40,
  'settings' => 'isha_primary_theme_color_setting',
) )
);