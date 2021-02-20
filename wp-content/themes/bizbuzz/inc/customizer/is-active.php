<?php
/**
 * bizbuzz Theme Options is active callback.
 *
 * @since 1.0.0
 * @package bizbuzz
 */

/**
 * Function to check Customizer Section is Enabled or not.
 *
 * @param String $section Section name.
 *
 * @since 1.0.0
 * @package bizbuzz
 */
function bizbuzz_is_section_enabled( $section ) {
	if ( ! $section ) {
		return false;
	}
	// Section status.
	$section_status = bizbuzz_get_option( $section );

	// Check condition only for slider.
	if ( 'slider_enable' === $section ) {
		if ( ! is_home() && ( ( is_front_page() && 'static-frontpage' === $section_status ) || 'entire-site' === $section_status ) ) {
			return true;
		} else {
			return false;
		}
	} else {
		return $section_status;
	}
}

