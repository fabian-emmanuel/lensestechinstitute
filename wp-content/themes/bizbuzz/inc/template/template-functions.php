<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package bizbuzz
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bizbuzz_body_classes( $classes ) {
	$post_id = get_the_ID();

	$classes[] = 'bizbuzz lite-version classic-menu';
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$options = bizbuzz_get_option();

	$sticky_primary_menu = $options['sticky_primary_menu'];
	$absolute_header     = $options['absolute_header'];
	$page_layout         = $options['page_layout'];

	if ( $sticky_primary_menu ) {
		$classes[] = 'sticky-menu';
	}

	if ( $absolute_header && ( is_home() || is_front_page() ) ) {
		$classes[] = 'absolute-header';

	} else {
		$classes[] = 'relative-header';
	}

	// Sidebar class for post and pages.
	$classes[]     = bizbuzz_get_sidebar_class( $post_id );

	if ( ! is_home() && ! is_front_page() ) {
		$classes[] = 'bizbuzz-inner-page';
	} else {
		if ( is_home() ) {
			$classes[] = 'bizbuzz-home';
		} else {
			$classes[] = 'bizbuzz-front-page';
		}
	}
	// Global Layout Class.
	if ( $page_layout ) {
		$classes[] = esc_attr( $page_layout );
	}

	return $classes;
}

/**
 * Function to return sidebar class.
 *
 * @since 1.0.0
 */
function bizbuzz_get_sidebar_class( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_404() ) {
		$sidebar_class = 'no-sidebar';
	} else {
		$args    = array( 'sidebar_position_archive', 'sidebar_position_homepage', 'sidebar_position_page', 'sidebar_position_post' );
		$options = bizbuzz_get_option( $args );

		if ( is_home() || is_front_page() ) {
			if ( ! is_front_page() && is_home() ) {
				$sidebar_class = $options['sidebar_position_archive'];
			} else {
				$sidebar_class = $options['sidebar_position_homepage'];
			}
		} else {
			if ( is_archive() ) {
				$sidebar_class = $options['sidebar_position_archive'];
			} elseif ( is_page( $post_id ) ) {
				$sidebar_class = $options['sidebar_position_page'];
			} else {
				$sidebar_class = $options['sidebar_position_post'];
			}
		}
		
		
	}
	$sidebar_class = apply_filters( 'bizbuzz_filter_sidebar_class', $sidebar_class, $post_id );
	return $sidebar_class;
}

if ( ! function_exists( 'bizbuzz_post_class' ) ) {
	function bizbuzz_post_class( $classes, $class, $post_id ) {
		// $classes[] = 'el-rt-animate fadeInUp';
		return $classes;
	}
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bizbuzz_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

function bizbuzz_slider_scripts() {
	wp_enqueue_style( 'bizbuzz-slick-style', get_template_directory_uri() . '/assets/plugins/slick/slick.css' );
	wp_enqueue_style( 'bizbuzz-slick-theme-style', get_template_directory_uri() . '/assets/plugins/slick/slick-theme.css' );

	wp_enqueue_script( 'bizbuzz-slick', get_template_directory_uri() . '/assets/plugins/slick/slick.min.js', array( 'jquery' ) );
}

function bizbuzz_hide_home_content_callback( $hide ) {
	return bizbuzz_get_option( 'hide_home_content' );
}

if ( ! function_exists( 'bizbuzz_excerpt_length_callback' ) ) :

	/**
	 * Set excerpt length on archive page.
	 *
	 * @param  int $length Number of words in the excerpt [content].
	 * @return int Length.
	 */
	function bizbuzz_excerpt_length_callback( $length ) {
		if ( is_admin() ) return $length;
		$excerpt_length = bizbuzz_get_option( 'excerpt_length' );

		if ( ! empty( $excerpt_length ) ) {
			$length = $excerpt_length;
		}
		return apply_filters( 'bizbuzz_filter_excerpt_length', esc_attr( ( int ) $length ) );
	}

endif;

if ( ! function_exists( 'bizbuzz_excerpt_read_more' ) ) :

	/**
	 * Implement read more in excerpt
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function bizbuzz_excerpt_read_more( $more ) {
		if ( is_admin() ) return $more;
		$output        = $more;
		$readmore_text = bizbuzz_get_option( 'readmore_text' );
		if ( ! empty( $readmore_text ) ) {
			$output = ' <span class="read-more" ><a href="' . esc_url( get_permalink() ) . '" class="btn btn-primary">' . esc_html( $readmore_text ) . '</a></span>';
			$output = apply_filters( 'bizbuzz_filter_excerpt_read_more', $output );
		}
		return $output;
	}

endif;

if ( ! function_exists( 'bizbuzz_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more           Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function bizbuzz_content_more_link( $more, $more_link_text ) {

		$output        = $more;
		$readmore_text = bizbuzz_get_option( 'readmore_text' );

		if ( ! empty( $readmore_text ) ) {
			$output = str_replace( $more_link_text, esc_html( $readmore_text ), $more );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'bizbuzz_read_more_filters' ) ) {
	function bizbuzz_read_more_filters() {
		if ( is_home() || is_front_page() || is_category() || is_tag() || is_author() || is_date() ) {
			add_filter( 'excerpt_length', 'bizbuzz_excerpt_length_callback', 999 );

			add_filter( 'excerpt_more', 'bizbuzz_excerpt_read_more' );
			add_filter( 'the_content_more_link', 'bizbuzz_content_more_link', 10, 2 );
		}
	}
}


add_filter( 'body_class', 'bizbuzz_body_classes' );
add_action( 'wp_head', 'bizbuzz_pingback_header' );
add_action( 'bizbuzz_action_additional_scripts', 'bizbuzz_slider_scripts' );
add_filter( 'bizbuzz_filter_hide_home_content', 'bizbuzz_hide_home_content_callback' );
add_action( 'wp', 'bizbuzz_read_more_filters' );
add_filter( 'post_class', 'bizbuzz_post_class', 10, 3 );
