<?php
/**
 * @package Isha
	=========================
			WIDGET CLASS
	=========================
 */

    // Widget News Layouts
    
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-latest-blog.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-our-portfolio.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-our-pricing.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-our-team.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-our-creative-services.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-testimonials.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-what-we-do.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/frontpage-section/widget-isha-single-pricing-table.php';

     // Footer widget
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/footer-section/footer-about-widgets.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/footer-section/footer-location-widgets.php';
    
    // Template widget
    require_once trailingslashit( get_template_directory() ) . '/inc/widgets/template-section/widget-isha-about.php';

    // Register Widget
    if ( ! function_exists( 'isha_register_widget' ) ) {
    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function isha_register_widget() {
        // Frontpage Layout
        register_widget( 'Isha_Latest_BLog_Widget' );
        register_widget( 'Isha_Portfolio_Widget' );
        register_widget( 'Isha_Pricing_Widget' );
        register_widget( 'Isha_Team_Widget' );
        register_widget( 'Isha_Services_Widget' );
        register_widget( 'Isha_Testimonials_Widget' );
        register_widget( 'Isha_What_We_Do_Widget' );
        register_widget( 'Isha_Single_Pricing_Widget' );
        // Footer widget register
        register_widget( 'Isha_Footer_About_Widget' );
        register_widget( 'Isha_Footer_Location_Widget' );
        // Template widget register
        register_widget( 'Isha_About_Widget' );
    }
}

add_action( 'widgets_init', 'isha_register_widget' );