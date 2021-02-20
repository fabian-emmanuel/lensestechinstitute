<?php
/**
 * isha Theme Customizer
 *
 * @package isha
 */
use WPTRT\Customize\Section\Button;

function isha_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'isha_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'isha_customize_partial_blogdescription',
		) );
	}

	
	require get_template_directory() . '/inc/customizer/colors.php';

	//Upgrade to Pro
	// Register custom section types.
	$wp_customize->register_section_type( 'Isha_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Go Pro','isha'),
				'pro_text' => esc_html__( 'Buy Pro Isha','isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/downloads/pro-isha-portfolio-wordpress-theme/'),
				'priority' => 1,
			)
		)
	);
	// Document paler  //
	$wp_customize->add_panel( 'isha_document_panel', array(
		'priority'	=> 2,
		'title'		=> __( 'Documents', 'isha' )
	) );
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell1',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'All documents', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/downloads/isha-portfolio-free-wordpress-theme/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell2',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'Quick setup Portfolio page', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro/quick-setup-guide-as-per-demo-for-setting-your-homepage-as-newspaper-page/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upselle3',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'Step by Step guide P. page', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro/step-by-step-setup-guide-for-portfolio-homepage/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upselle4',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'Quick setup Blog page', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro/quick-setup-guide-for-setting-your-homepage-as-blog-page/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upselle5',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'One click Demo import', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro/video-guide-for-one-click-demo-import-for-setting-theme/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upselle6',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'Images not in correct shape', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro/why-my-site-images-are-not-in-correct-shape/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upselle7',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'How to buy Pro theme ', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro/how-to-buy-premium-theme-from-postmagthemes-com/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Isha_Customize_Section_Upsell(
			$wp_customize,
			'theme_upselle8',
			array(
				'title'    => esc_html__( 'View', 'isha' ),
				'pro_text' => esc_html__( 'Create about us page', 'isha' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-free-isha-portfolio-and-pro/how-to-create-about-us-page-as-in-demo/'),
				'priority' => 1,
				'panel'          => 'isha_document_panel',
				
			)
		)
	);
}
add_action( 'customize_register', 'isha_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function isha_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function isha_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function isha_customize_preview_js() {
	wp_enqueue_script( 'isha-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'isha_customize_preview_js' );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Load customizer required panels.
 */
require get_template_directory() . '/inc/customizer/background-color-panel.php';
require get_template_directory() . '/inc/customizer/theme-option-panel.php';

require get_template_directory() . '/inc/customizer/customizer-sanitize.php';
require get_template_directory() . '/inc/customizer/customizer-css.php';

/**
 *  load Go to Pro.
 */
require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php';

/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function isha_customize_backend_scripts() {
	wp_enqueue_script( 'isha-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/pro.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'isha-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/pro.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'isha_customize_backend_scripts', 10 );