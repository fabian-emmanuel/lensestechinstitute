<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bizbuzz
 */

 /**
  * Hook - bizbuzz_action_doctype.
  *
  * @hooked bizbuzz_doctype -  10
  */
 do_action( 'bizbuzz_action_doctype' );
?>
<head>	
	<?php
	/**
	 * Hook - bizbuzz_action_head.
	 *
	 * @hooked bizbuzz_head -  10
	 */
	do_action( 'bizbuzz_action_head' );
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<?php
	/**
	 * Body Open Hook to add Additional scripts inside body tag.
	 */
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}

	/**
	 * Hook - bizbuzz_action_before_start.
	 *
	 * @hooked bizbuzz_loader - 10
	 * @hooked bizbuzz_page_wrapper_start -  10
	 * $hooked bizbuzz_screen_reader_text - 10
	 */
	do_action( 'bizbuzz_action_before_start' );

	/**
	 * Hook - bizbuzz_action_before_header.
	 *
	 * @hooked bizbuzz_header_wrapper_start - 10
	 * @hooked bizbuzz_top_section - 10
	 */
	do_action( 'bizbuzz_action_before_header' );

	/**
	 * Hook - bizbuzz_action_header.
	 *
	 * @hooked bizbuzz_header - 10
	 */
	do_action( 'bizbuzz_action_header' );

	/**
	 * Hook - bizbuzz_action_after_header.
	 *
	 * @hooked bizbuzz_header_wrapper_end - 10
	 * @hooked bizbuzz_slider - 10
	 */
	do_action( 'bizbuzz_action_after_header' );

	/**
	 * Hook - bizbuzz_action_before_content.
	 *
	 * @hooked bizbuzz_main_slider 10
	 * @hooked bizbuzz_get_breadcrumb 20
	 * @hooked bizbuzz_woocommerce_main_content_ends 30 [ need to be after breadcrubm ]
	 * @hooked bizbuzz_main_content_start - 40
	 */
	do_action( 'bizbuzz_action_before_content' );

	/**
	 * Hook - bizbuzz_action_content.
	 *
	 */
	do_action( 'bizbuzz_action_content' );
