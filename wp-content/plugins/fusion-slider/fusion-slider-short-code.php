<?php
add_shortcode( 'FSL', 'FusionSliderShortCode' );
function FusionSliderShortCode( $Id ) {
	
	$FSL_Id = $Id['id'];
	$TotalImages =  get_post_meta( $FSL_Id, 'FSL_total_images_count', true );
	if( $TotalImages == "" ){
		ob_start();
		printf( __( "Slider with ID %s doesn't exist.","FSL_TEXT_DOMAIN" ), $FSL_Id );
		return ob_get_clean();
	}
	if( $TotalImages == 0 ){
		ob_start();
		printf( __( "Slider with ID %s is empty.","FSL_TEXT_DOMAIN" ), $FSL_Id );
		return ob_get_clean();
	}
	
    ob_start();
	
	// slider js css scripts
	wp_enqueue_script('FSL-responsiveslides-js', FSL_PLUGIN_URL.'assets/sliders/responsive/responsiveslides.js', array('jquery'));
	wp_enqueue_style('FSL-responsiveslides-css', FSL_PLUGIN_URL.'assets/sliders/responsive/responsiveslides.css');
	
	$FSL_Settings = fsl_get_gallery_value($FSL_Id);
	if(count($FSL_Settings)) {
		$fsl_type  			= $FSL_Settings['fsl_type'];
		$fsl_fullWidth	   	= $FSL_Settings['fsl_fullWidth'];
		$fsl_width 			= $FSL_Settings['fsl_width'];
		$fsl_height 		= $FSL_Settings['fsl_height'];
		$fsl_openLink 		= $FSL_Settings['fsl_openLink'];
		$fsl_links      	= $FSL_Settings['fsl_links'];
		$fsl_arrowcolor     = $FSL_Settings['fsl_arrowcolor'];
		$fsl_prevText       = $FSL_Settings['fsl_prevText'];
		$fsl_nextText       = $FSL_Settings['fsl_nextText'];
		$fsl_navigation     = $FSL_Settings['fsl_navigation'];
		$fsl_navibgcolor	= $FSL_Settings['fsl_navibgcolor'];
		$fsl_textstyle     	= $FSL_Settings['fsl_textstyle'];
		$fsl_tbgcolor		= $FSL_Settings['fsl_tfontstyle']['bgcolor'];
		$fsl_tfontfamily	= $FSL_Settings['fsl_tfontstyle']['fontfamily'];
		$fsl_tfontcolor		= $FSL_Settings['fsl_tfontstyle']['color'];
		$fsl_tfontsize		= $FSL_Settings['fsl_tfontstyle']['size'];
		$fsl_tlineheight	= $FSL_Settings['fsl_tfontstyle']['lineheight'];
		$fsl_tspacetop		= $FSL_Settings['fsl_tspacetop'];
		$fsl_tspaceleft		= $FSL_Settings['fsl_tspaceleft'];
		$fsl_dbgcolor		= $FSL_Settings['fsl_dfontstyle']['bgcolor'];
		$fsl_dfontfamily	= $FSL_Settings['fsl_dfontstyle']['fontfamily'];
		$fsl_dfontcolor		= $FSL_Settings['fsl_dfontstyle']['color'];
		$fsl_dfontsize		= $FSL_Settings['fsl_dfontstyle']['size'];
		$fsl_dlineheight	= $FSL_Settings['fsl_dfontstyle']['lineheight'];
		$fsl_dspacetop		= $FSL_Settings['fsl_dspacetop'];
		$fsl_dspaceleft		= $FSL_Settings['fsl_dspaceleft'];
		$fsl_dtextalign		= $FSL_Settings['fsl_dtextalign'];
		$fsl_center	   		= $FSL_Settings['fsl_center'];
		$fsl_autoPlay       = $FSL_Settings['fsl_autoPlay'];
		$fsl_random      	= $FSL_Settings['fsl_random'] ;
		$fsl_hoverPause     = $FSL_Settings['fsl_hoverPause'];
		$fsl_delay          = $FSL_Settings['fsl_delay'];
		$fsl_animationSpeed = $FSL_Settings['fsl_animationSpeed'];
		$fsl_customCss      = $FSL_Settings['fsl_customCss'];
	}
	
	require('inc/responsive-slider.php');
	
	wp_reset_postdata();
	return ob_get_clean();
}
?>