<?php
/**
 * About configuration
 *
 * @package isha
 */

$config = array(
	'menu_name' => esc_html__( 'Isha Setup', 'isha' ),
	'page_name' => esc_html__( 'Isha Setup', 'isha' ),

	/* translators: theme version */
	'welcome_title' => sprintf( esc_html__( 'Welcome to %s - ', 'isha' ), 'Isha' ),

	/* translators: 1: theme name */
	'welcome_content' => sprintf( esc_html__( 'We hope this page will help you to setup %1$s with few clicks. We believe you will find it easy to use and perfect for your website development.', 'isha' ), 'Isha' ),

	// Quick links.
	'quick_links' => array(
		'theme_url' => array(
			'text' => esc_html__( 'Theme Details','isha' ),
			'url'  => esc_url('https://www.postmagthemes.com/downloads/isha-portfolio-free-wordpress-theme/'),
		),
		'demo_url' => array(
			'text' => esc_html__( 'View Demo','isha' ),
			'url'  => esc_url('https://www.postmagthemes.com/demoisha/'),
		),
		'documentation_url' => array(
			'text'   => esc_html__( 'Documentation','isha' ),
			'url'    => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro'),
		)
	),

	// Tabs.
	'tabs' => array(
		'getting_started'     => esc_html__( 'Getting Started', 'isha' ),
		'recommended_actions' => esc_html__( 'Recommended Actions', 'isha' ),
		'support'             => esc_html__( 'Support', 'isha' ),
	),

	// Getting started.
	'getting_started' => array(
		array(
			'title'               => esc_html__( 'Theme Documentation', 'isha' ),
			'text'                => esc_html__( 'Find step by step instructions to setup theme easily.', 'isha' ),
			'button_label'        => esc_html__( 'View documentation', 'isha' ),
			'button_link'         => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro'),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Recommended Actions', 'isha' ),
			'text'                => esc_html__( 'We recommend few steps to take so that you can get complete site like shown in demo.', 'isha' ),
			'button_label'        => esc_html__( 'Check recommended actions', 'isha' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=isha-about&tab=recommended_actions' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'       => esc_html__( 'Required minimum image size', 'isha' ),
			'text' => esc_html__( 'Please use minimum image size ( 1200 px width , 600 px height ) for using as feature image on post/page.', 'isha' ),
		),
		array(
			'title'               => esc_html__( 'Customize Everything', 'isha' ),
			'text'                => esc_html__( 'Start customizing every aspect of the website with customizer.', 'isha' ),
			'button_label'        => esc_html__( 'Go to Customizer', 'isha' ),
			'button_link'         => esc_url( wp_customize_url() ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(
			
			'postmagthemes-demo-import' => array(
				'title'       => esc_html__( 'PostmagThemes Demo Import', 'isha' ),
				'description' => esc_html__( 'Please install the PostmagThemes Demo Import plugin to import the demo content. After activation go to Appearance >> Import Demo Data and import it.', 'isha' ),
				'check'       => class_exists( 'PMDI_Plugin' ),
				'plugin_slug' => 'postmagthemes-demo-import',
				'id'          => 'postmagthemes-demo-import',
			),

		),
	),

	// Support.
	'support_content' => array(
		'first' => array(
			'title'        => esc_html__( 'Contact Support', 'isha' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'If you have any problem, feel free to create ticket on our dedicated support forum.', 'isha' ),
			'button_label' => esc_html__( 'Contact Support', 'isha' ),
			'button_link'  => esc_url('https://www.postmagthemes.com/contact'),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Theme Documentation', 'isha' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Kindly check our theme documentation for detailed information and video instructions.', 'isha' ),
			'button_label' => esc_html__( 'View Documentation', 'isha' ),
			'button_link'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro'),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		
	),


);
Isha_About::init( apply_filters( 'isha_about_filter', $config ) );