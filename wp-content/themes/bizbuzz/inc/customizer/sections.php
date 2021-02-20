<?php
/**
 * bizbuzz Theme Options Customize Section.
 *
 * @since 1.0.0
 * @package bizbuzz
 */

 /**
  * Customizer Sections.
  */
function bizbuzz_get_customizer_sections() {
	$sections = array(

		// Theme Options.
		'loader_options'         => array(
			'title'    => __( 'Loader', 'bizbuzz' ),
			'priority' => 10,
			'panel'    => 'theme_option_panel',
		),
		'layout_options'         => array(
			'title'    => __( 'Layout', 'bizbuzz' ),
			'priority' => 20,
			'panel'    => 'theme_option_panel',
		),
		'topbar_options'         => array(
			'title'       => __( 'Topbar', 'bizbuzz' ),
			'description' => esc_html__( 'Check to enable Topbar.', 'bizbuzz' ),
			'priority'    => 30,
			'panel'       => 'theme_option_panel',
		),
		'header_options'         => array(
			'title'    => __( 'Header', 'bizbuzz' ),
			'priority' => 40,
			'panel'    => 'theme_option_panel',
		),
		'breadcrumb_options'     => array(
			'title'    => __( 'Breadcrumb', 'bizbuzz' ),
			'priority' => 50,
			'panel'    => 'theme_option_panel',
		),
		'blog_options'           => array(
			'title'    => __( 'Blog', 'bizbuzz' ),
			'priority' => 60,
			'panel'    => 'theme_option_panel',
		),
		'excerpt_options'        => array(
			'title'    => __( 'Excerpt', 'bizbuzz' ),
			'priority' => 70,
			'panel'    => 'theme_option_panel',
		),
		'pagination_options'     => array(
			'title'    => __( 'Pagination', 'bizbuzz' ),
			'priority' => 80,
			'panel'    => 'theme_option_panel',
		),
		'footer_options'         => array(
			'title'    => __( 'Footer', 'bizbuzz' ),
			'priority' => 90,
			'panel'    => 'theme_option_panel',
		),
		'back_to_top_options'    => array(
			'title'    => __( 'Back to Top', 'bizbuzz' ),
			'priority' => 100,
			'panel'    => 'theme_option_panel',
		),

		// Front Page Options.
		'bizbuzz_slider'        => array(
			'title'    => esc_html__( 'bizbuzz Slider', 'bizbuzz' ),
			'priority' => 10,
			'panel'    => 'homepage_option_panel',
		),
		'homepage_content'       => array(
			'title'    => esc_html__( 'Content', 'bizbuzz' ),
			'priority' => 20,
			'panel'    => 'homepage_option_panel',
		),
		'homepage_about_us'      => array(
			'title'    => esc_html__( 'About us Section', 'bizbuzz' ),
			'priority' => 30,
			'panel'    => 'homepage_option_panel',
		),
		'homepage_featured_post' => array(
			'title'    => esc_html__( 'Featured Post Section', 'bizbuzz' ),
			'priority' => 40,
			'panel'    => 'homepage_option_panel',
		),

		'homepage_cta'           => array(
			'title'    => esc_html__( 'Call to action Section', 'bizbuzz' ),
			'priority' => 50,
			'panel'    => 'homepage_option_panel',
		),
		'homepage_latest_blogs'  => array(
			'title'       => esc_html__( 'Recent Blog', 'bizbuzz' ),
			'description' => esc_html__( 'For more options, go to "Theme Options > Blog"', 'bizbuzz' ),
			'priority'    => 60,
			'panel'       => 'homepage_option_panel',
		),

		// Reset All Options.
		'reset_section'          => array(
			'title'    => __( 'Reset All Options', 'bizbuzz' ),
			'priority' => 200,
		),
	);
	return apply_filters( 'bizbuzz_filter_customizer_sections', $sections );
}



