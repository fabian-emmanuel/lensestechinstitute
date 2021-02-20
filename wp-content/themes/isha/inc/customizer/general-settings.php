<?php 
add_action( 'customize_register', 'isha_general_settings_register' );
function isha_general_settings_register( $wp_customize ) {
    /*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Slider section
     *
     * @since 1.0.0
     */
  $wp_customize->add_section(
    'isha_general_section',
    array(
     'priority'       => 5,
     'panel'          => 'isha_theme_option_panel',
     'capability'     => 'edit_theme_options',
     'theme_supports' => '',
     'title'          => __( 'General settings section', 'isha' ),
     'description'    => __( 'Managed the general setting', 'isha' ),
   )
  );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * modal popup
     *
     * @since 1.0.1
     */
    $wp_customize->add_setting(
        'isha_popup_enable',
        array(
          'default'           => 1,
          'sanitize_callback' => 'isha_sanitize_checkbox',
        )
      );
      
      $wp_customize->add_control(
        'isha_popup_enable',
        array(
          'section'     => 'isha_general_section',
          'label'       => __( 'Enable/Disable modal popup in blog post', 'isha' ),
          'type'        => 'checkbox'
        )       
      );
    
    $wp_customize->add_setting( 'isha_detail_here_title', 
    array(
        
        'default'     => __('Full view here','isha'),
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control( 'isha_detail_here_title', 
        array(
            'label' 	=> __( 'Full view at popup', 'isha' ),
            'section'	=> 'isha_general_section',
            'settings' 	=> 'isha_detail_here_title',
            'type'      => 'text',
        ));
    $wp_customize->add_setting( 'isha_close_title', 
    array(
        
        'default'     => __('Close','isha'),
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control( 'isha_close_title', 
    array(
        'label' 	=> __( 'Close at popup', 'isha' ),
        'section'	=> 'isha_general_section',
        'settings' 	=> 'isha_close_title',
        'type'      => 'text',
    ));
      
/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * read more
     *
     * @since 1.0.1
     */

    $wp_customize->add_setting( 'isha_read_more_title', 
    array(
        
        'default'     => __('Read more','isha'),
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control( 'isha_read_more_title', 
        array(
            'label' 	=> __( 'Read more text', 'isha' ),
            'section'	=> 'isha_general_section',
            'settings' 	=> 'isha_read_more_title',
            'type'      => 'text',
        ));


/*----------------------------------------------------------------------------------------------------------------------------------------*/
        /**
         * length of min read
         * @since 1.0.0
         */
      
        $wp_customize->add_setting('global_show_min_read_number',
        array(
            'default' => 100,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control('global_show_min_read_number',
        array(
            'label' => esc_html__('Number of words per minute in read time', 'isha'),
            'section' => 'isha_general_section',
            'type' => 'number',
            'priority' => 130
        )
    );

  /*----------------------------------------------------------------------------------------------------------------------------------------*/
  /**
   * length of Excerpt at blog post
   * @since 1.0.0
   */

  $wp_customize->add_setting('blog_excerpt_length',
  array(
      'default' => 30,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'isha_sanitize_positive_number',
  )
  );
  $wp_customize->add_control('blog_excerpt_length',
      array(
          'label' => esc_html__('Length of excerpt in blog post', 'isha'),
          'section' => 'isha_general_section',
          'type' => 'number',
          'priority' => 131
      )
  );
}