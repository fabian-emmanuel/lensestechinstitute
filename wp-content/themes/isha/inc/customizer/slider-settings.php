<?php
/**
 * Isha Slider Settings panel at Theme Customizer
 *
 * @package Isha
 * @since 1.0.0
 */

add_action( 'customize_register', 'isha_slider_settings_register' );

function isha_slider_settings_register( $wp_customize ) {
  require get_template_directory() .'/inc/repeater/customizer/isha-class-repeater-settings.php';
  require get_template_directory() .'/inc/repeater/customizer/isha-class-control-repeater.php';

  /*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Slider section
     *
     * @since 1.0.0
     */
  $wp_customize->add_section(
    'slider_section',
    array(
     'priority'       => 2,
     'panel'          => 'isha_theme_option_panel',
     'capability'     => 'edit_theme_options',
     'theme_supports' => '',
     'title'          => __( 'Front page slider section', 'isha' ),
     'description'    => __( 'Managed the content display at front page slider section.', 'isha' ),
   )
  );

  /*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     *Enable/Disable Slider section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
      'slider_enable',
      array(
        'default'           => 1,
        'sanitize_callback' => 'isha_sanitize_checkbox',
      )
    );
    
    $wp_customize->add_control(
      'slider_enable',
      array(
        'section'     => 'slider_section',
        'label'       => __( 'Enable/Disable front page slider section', 'isha' ),
        'type'        => 'checkbox'
      )       
    );
    
   

    /** Slider Section */
    $wp_customize->add_setting( 
      new Isha_Repeater_Setting( 
        $wp_customize, 
        'slider_items', 
        array(
          'default' => array(
            array(
              'dropdown-pages' => latest_page_id(),
              'btn_text_1' => '',
              'btn_url_1'  =>  __('#','isha'),
              'btn_text_2' => '',
              'btn_url_2'  =>  __('#','isha')
            ),
            array(
              'dropdown-pages' => latest_page_id(),
              'btn_text_1' => '',
              'btn_url_1'  =>  __('#','isha'),
              'btn_text_2' => '',
              'btn_url_2'  =>  __('#','isha')
            )
          ),
          'sanitize_callback' => array( 'Isha_Repeater_Setting', 'sanitize_repeater_setting' ),
        ) 
      ) 
    );

    $wp_customize->add_control(
      new Isha_Control_Repeater(
        $wp_customize,
        'slider_items',
        array(
          'section' => 'slider_section',              
          'label'   => __( 'Slider items', 'isha' ),
          'fields'  => array(
            'dropdown-pages' => array(
              'type'        => 'select',
              'label'       => __( 'Select Page for slider title and description', 'isha' ),
              'choices'     => isha_pages(),
            ),

            'btn_text_1' => array(
              'type'        => 'text',
              'label'       => __( 'Button Text 1', 'isha' ),
            ),
            'btn_url_1' => array(
              'type'        => 'url',
              'label'       => __( 'Button Url 1', 'isha' ),
            ),
             'btn_text_2' => array(
              'type'        => 'text',
              'label'       => __( 'Button Text 2', 'isha' ),
            ),
            'btn_url_2' => array(
              'type'        => 'url',
              'label'       => __( 'Button Url 2', 'isha' ),
            ),
          ),
          'row_label' => array(
            'type' => 'field',
            'value' => __( 'Slider', 'isha' ),
            'field' => 'title'
          )                        
        )
      )
    );
}