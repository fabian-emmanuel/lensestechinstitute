<?php
/**
 * bizbuzz Theme Options Customize Panel.
 *
 * @since 1.0.0
 * @package bizbuzz
 */

 /**
  * Customizer Panels.
  */
function bizbuzz_get_customizer_panels() {
	$panels = array(
		'theme_option_panel'    => array(
			'title'       => esc_html__( 'Theme Options ', 'bizbuzz' ),
			'description' => esc_html__( 'Theme Options.', 'bizbuzz' ),
			'priority'    => 90,
		),
		'homepage_option_panel' => array(
			'title'       => esc_html__( 'Front Page Options ', 'bizbuzz' ),
			'description' => esc_html__( 'Front Page Options.', 'bizbuzz' ),
			'priority'    => 100,
		),
	);
	return apply_filters( 'bizbuzz_filter_customizer_panels', $panels );
}
