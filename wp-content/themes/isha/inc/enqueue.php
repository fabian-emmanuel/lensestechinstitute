<?php
/**
 * Enqueue scripts and styles.
 */
function isha_scripts() {

	// Google font
	wp_enqueue_style( 'isha-google-font', 'https://fonts.googleapis.com/css?family='.get_theme_mod('google_fontfamily_setting','Open+Sans').':300,400,600,700,800', array(), '' );

	wp_enqueue_style( 'isha-google-font-description', 'https://fonts.googleapis.com/css?family='.get_theme_mod('description_google_fontfamily_setting','Open+Sans').':300,400,600,700,800', array(), '' );

	wp_enqueue_style( 'isha-google-font-body', 'https://fonts.googleapis.com/css?family='.get_theme_mod('body_google_fontfamily_setting','Open+Sans').':300,400,600,700,800', array(), '' );

	wp_enqueue_style( 'isha-google-font-w', 'https://fonts.googleapis.com/css?family='.get_theme_mod('google_fontfamily_widget_setting','Open+Sans').':300,400,600,700,800', array(), '' );

	wp_enqueue_style( 'isha-google-font-slider', 'https://fonts.googleapis.com/css?family='.get_theme_mod('google_fontfamily_slider_setting','Open+Sans').':300,400,600,700,800', array(), '' );

	wp_enqueue_style( 'isha-google-font-plan', 'https://fonts.googleapis.com/css?family='.get_theme_mod('google_fontfamily_plan_setting','Open+Sans').':300,400,600,700,800', array(), '' );
	
	// Bootstrap CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/assets/css/bootstrap.css', array(), '4.0.0' );

	// animate CSS
	wp_enqueue_style( 'animate', get_template_directory_uri() .'/assets/css/animate.css', array(), '1.0.0' );

	// fontawesome CSS
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/assets/css/font-awesome.css', array(), '4.7.0' );

	// jquery fancybox CSS
	wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() .'/assets/css/jquery.fancybox.css', array(), '1.0.0' );

	// Magnific CSS
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/css/magnific-popup.css', array(), '1.0.0' );

	// Slicknav CSS
	wp_enqueue_style( 'slicknav', get_template_directory_uri() .'/assets/css/slicknav.css', array(), '1.0.10' );

	// Owl Carausel CSS
	wp_enqueue_style( 'slick-slider', get_template_directory_uri() .'/assets/css/slick-slider.css', array(), '2.2.1' );

	// Style CSS
	wp_enqueue_style( 'isha-style', get_stylesheet_uri() );

	// Responsive CSS
	wp_enqueue_style( 'isha-responsive', get_template_directory_uri() .'/assets/css/responsive.css', array(), '1.0.0' );

	// Popper JS
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.js', array('jquery'), '3.3.1', true );

	// Bootstrap JS
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '4.4.1', true );

	// modernizr JS
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array('jquery'), '2.8.3', true );

	// Magnific Popup JS
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.js', array('jquery'), '1.1.0', true );

	// FacnyBox JS 
	wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/assets/js/jquery-fancybox.js', array('jquery'), '3.1.20', true );

	// easing JS
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/easing.js', array('jquery'), '1.4.1', true );

	// Wow JS
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.js', array('jquery'), '3.1.20', true );

	// Steller JS
	wp_enqueue_script( 'steller', get_template_directory_uri() . '/assets/js/steller.js', array('jquery'), '', true );

	// Counterup JS
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.js', array('jquery'), '', true );

	// Waypoints JS
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.js', array('jquery'), '', true );


	// Slick Nav JS
	wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.js', array('jquery'), '1.0.10', true );

	// Isotope JS
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.js', array('jquery'), '2.2.1', true );

	// matchHeight JS
	wp_enqueue_script( 'jquery-match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', array('jquery'), '1.0.0', true );

	// SLick JS
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.1.0', true );

	// Jquery Scrollup JS
	wp_enqueue_script( 'jquery-scrollup', get_template_directory_uri() . '/assets/js/jquery.scrollUp.js', array('jquery'), '1.1.0', true );

	// Active JS
	wp_enqueue_script( 'isha-active', get_template_directory_uri() . '/assets/js/active.js', array('jquery'), '1.1.0', true );

	wp_enqueue_script( 'isha-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'isha-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'isha_scripts' );