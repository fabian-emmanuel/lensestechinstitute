<?php

    /**
     * Blog Settings at Theme Customizer
     *
     * @package Isha  
     * @since 1.0.0
     */
    add_action( 'customize_register', 'isha_blog_settings_register' );

    function isha_blog_settings_register( $wp_customize ) {
    /*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Blog Post/ Archive / Search  Section
     *
     * @since 1.0.0
     */

    $wp_customize->add_section(
        'isha_blog_archive_options_section',
        array(
            'priority'       => 3,
            'panel'          => 'isha_theme_option_panel',
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Blog post / page / archive / search section', "isha" ),
            'description'    => __( 'Choose this options to display post at blog / page / archive / search page', "isha" ),
        )
    );

    $post_taxonomy_arrays = array(__('Published date','isha'),__('Comment no.','isha'),__('Category','isha'),__('Excerpt','isha'),__('Read more','isha'),__('Reading time','isha'),__('Author','isha') );
    foreach ($post_taxonomy_arrays as  $post_taxonomy) {
        $wp_customize->add_setting( 'isha_blog_post_post_taxonomy_'.$post_taxonomy, array(
        'capability'            => 'edit_theme_options',
        'default'               => 1,
        'sanitize_callback' => 'isha_sanitize_checkbox'
        ) );
    
        $wp_customize->add_control( 'isha_blog_post_post_taxonomy_'.$post_taxonomy, array(
            /* translators: %s: Label */ 
            'label'                 =>  sprintf( __( 'Display %s', 'isha' ), $post_taxonomy ),
            'section'               => 'isha_blog_archive_options_section',
            'type'                  => 'checkbox',
            'settings' => 'isha_blog_post_post_taxonomy_'.$post_taxonomy,
    
        ) );
    }

    $wp_customize->add_setting('isha_blog_post_post_taxonomy_tag', 
        array(
            'sanitize_callback' => 'isha_sanitize_checkbox',
            'default'           => 0
        )
    );

    $wp_customize->add_control('isha_blog_post_post_taxonomy_tag', 
        array(
            'label'             => __( 'Dsiplay tag', "isha" ),
            'section'           => 'isha_blog_archive_options_section',
            'type'              => 'checkbox',
            'settings'          => 'isha_blog_post_post_taxonomy_tag'
        ) 
    );

    $wp_customize->add_setting('isha_blog_archive_layout_settings', 
        array(
            'sanitize_callback' => 'isha_sanitize_select',
            'default'           => 'right'
        )
    );

    $wp_customize->add_control('isha_blog_archive_layout_settings', 
        array(
            'label'             => __( 'Blog / Homepage layouts settings', "isha" ),
            'section'           => 'isha_blog_archive_options_section',
            'type'              => 'radio',
            'choices'           => array(
                'right'         => esc_html__('Right Sidebar',"isha"),
                'left'         => esc_html__('Left Sidebar',"isha"),
                'none'         => esc_html__('None',"isha"),
            ),
            'settings'          => 'isha_blog_archive_layout_settings'
        ) 
    );

    
    $wp_customize->add_setting('isha_blog_archive_type_settings', 
    array(
        'sanitize_callback' => 'isha_sanitize_select',
        'default'           => '1'
    )
    );

    $wp_customize->add_control('isha_blog_archive_type_settings', 
        array(
            'label'             => __( 'Blog / Home page layout types', "isha" ),
            'description'    => __( 'Layout type does not affect on archive and search page, it is fixed but in blog post / homepage it will change', "isha" ),
            'section'           => 'isha_blog_archive_options_section',
            'type'              => 'select',
            'choices'           => array(
                '1'         => esc_html__('Single column full image',"isha"),
                '2'         => esc_html__('Double column half image',"isha"),
                '3'         => esc_html__('Double column full image',"isha"),
            ),
            'settings'          => 'isha_blog_archive_type_settings'
        ) 
    );

    $wp_customize->add_setting('isha_blog_realted_post_enable', 
        array(
            'sanitize_callback' => 'isha_sanitize_checkbox',
            'default'           => 1
        )
    );

    $wp_customize->add_control('isha_blog_realted_post_enable', 
        array(
            'label'             => __( 'Display related post in blog', "isha" ),
            'section'           => 'isha_blog_archive_options_section',
            'type'              => 'checkbox',
            'settings'          => 'isha_blog_realted_post_enable'
        ) 
    );
    
    /*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Blog Single Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'isha_blog_single_options_section',
        array(
            'priority'       => 4,
            'panel'          => 'isha_theme_option_panel',
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Single page/post section', "isha" ),
            'description'    => __( 'Choose this options to display single post/page', "isha" ),
        )
    );


    $wp_customize->add_setting('isha_blog_single_layout_settings', 
        array(
            'sanitize_callback' => 'isha_sanitize_select',
            'default'           => 'right',
        )
    );

    $wp_customize->add_control('isha_blog_single_layout_settings', 
        array(
            'label'             => __( 'Single page/post layouts', "isha" ),
            'section'           => 'isha_blog_single_options_section',
            'type'              => 'select',
            'choices'           => array(
                    'right'         => esc_html__('Right sidebar','isha'),
                    'left'         => esc_html__('Left sidebar','isha'),
                    'none'         => esc_html__('No sidebar','isha'),
         ),
            'settings'          => 'isha_blog_single_layout_settings'
        ) 
    );
    $wp_customize->add_setting('isha_blog_single_post_realted_post_enable', 
        array(
            'sanitize_callback' => 'isha_sanitize_checkbox',
            'default'           => 1
        )
    );

    $wp_customize->add_control('isha_blog_single_post_realted_post_enable', 
        array(
            'label'             => __( 'Display related post in post detail', "isha" ),
            'section'           => 'isha_blog_single_options_section',
            'type'              => 'checkbox',
            'settings'          => 'isha_blog_single_post_realted_post_enable'
        ) 
    );

    $wp_customize->add_setting('isha_blog_single_post_author_enable', 
    array(
        'sanitize_callback' => 'isha_sanitize_checkbox',
        'default'           => 1
    )
    );

    $wp_customize->add_control('isha_blog_single_post_author_enable', 
        array(
            'label'             => __( 'Display author detail', "isha" ),
            'section'           => 'isha_blog_single_options_section',
            'type'              => 'checkbox',
            'settings'          => 'isha_blog_single_post_author_enable'
        ) 
    );

    $post_taxonomy_arrays = array(__('Avatar','isha'),__('Email','isha'),__('Description','isha'),__('Total post','isha') );
    foreach ($post_taxonomy_arrays as  $post_taxonomy) {
        $wp_customize->add_setting( 'isha_single_page_post_taxonomy_'.$post_taxonomy, array(
        'capability'            => 'edit_theme_options',
        'default'               => 1,
        'sanitize_callback' => 'isha_sanitize_checkbox'
        ) );
    
        $wp_customize->add_control( 'isha_single_page_post_taxonomy_'.$post_taxonomy, array(
            /* translators: %s: Label */ 
            'label'                 =>  sprintf( __( 'Display %s', 'isha' ), $post_taxonomy ),
            'section'               => 'isha_blog_single_options_section',
            'type'                  => 'checkbox',
            'settings' => 'isha_single_page_post_taxonomy_'.$post_taxonomy,
    
        ) );
    }
}
