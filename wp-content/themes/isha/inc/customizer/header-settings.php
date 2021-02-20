<?php
/**
 * Isha Header Settings panel at Theme Customizer
 *
 * @package Isha
 * @since 1.0.0
 */

add_action( 'customize_register', 'isha_header_settings_register' );

function isha_header_settings_register( $wp_customize ) {
  require get_template_directory() .'/inc/repeater/customizer/isha-class-repeater-settings.php';
  require get_template_directory() .'/inc/repeater/customizer/isha-class-control-repeater.php';

  /*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Menu Right Social section
     *
     * @since 1.0.0
     */
  $wp_customize->add_section(
    'isha_top_header_section',
    array(
     'priority'       => 1,
     'panel'          => 'isha_theme_option_panel',
     'capability'     => 'edit_theme_options',
     'theme_supports' => '',
     'title'          => __( 'Social link at top', 'isha' ),
     'description'    => __( 'Managed the content display of social link at top.', 'isha' ),
   )
  );

  /*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     *Enable/Disable Menu Right Social section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
      'isha_header_social_enable',
      array(
        'default'           => 0,
        'sanitize_callback' => 'isha_sanitize_checkbox',
      )
    );
    
    $wp_customize->add_control(
      'isha_header_social_enable',
      array(
        'section'     => 'isha_top_header_section',
        'label'       => __( 'Enable/Disable social section at top', 'isha' ),
        'type'        => 'checkbox'
      )       
    );
    
    /** Social Links */
    $wp_customize->add_setting( 
      new Isha_Repeater_Setting( 
        $wp_customize, 
        'social_links_items', 
        array(
          'default' => array(
           array(
            'font' => '',
            'link' => '#',                        
          ),
           array(
            'font' => '',
            'link' => '#',
          ),
           array(
            'font' => '',
            'link' => '#',
          ),
         ),
          'sanitize_callback' => array( 'Isha_Repeater_Setting', 'sanitize_repeater_setting' ),
        ) 
      ) 
    );

    $wp_customize->add_control(
      new Isha_Control_Repeater(
        $wp_customize,
        'social_links_items',
        array(
          'section' => 'isha_top_header_section',              
          'label'   => __( 'Social Links', 'isha' ),
          'fields'  => array(
            'font' => array(
              'type'        => 'font',
              'label'       => __( 'Font Awesome Icon', 'isha' ),
              'description' => __( 'Example: fa fa-facebook', 'isha' ),
            ),
            'link' => array(
              'type'        => 'url',
              'label'       => __( 'Link', 'isha' ),
              'description' => __( 'Example: http://facebook.com', 'isha' ),
            )
          ),
          'row_label' => array(
            'type' => 'field',
            'value' => __( 'social', 'isha' ),
            'field' => 'link'
          )                        
        )
      )
    );
}