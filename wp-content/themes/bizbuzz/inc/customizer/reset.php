<?php
/**
 * bizbuzz Reset.
 *
 * @since 1.0.0
 * @package bizbuzz
 */



if ( ! function_exists( 'bizbuzz_reset_customizer' ) ) :
	/**
	 * Reset customizer options
	 *
	 * @since 1.0.0
	 *
	 * @return bool Whether the reset is checked.
	 */
	function bizbuzz_reset_customizer() {
		$reset = bizbuzz_get_option( 'reset_customizer' );
		if ( true === $reset ) {
			// Reset custom theme options.
			set_theme_mod( 'theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
			remove_theme_mod( 'header_textcolor' );
		}
	}
endif;
add_action( 'customize_save_after', 'bizbuzz_reset_customizer' );
