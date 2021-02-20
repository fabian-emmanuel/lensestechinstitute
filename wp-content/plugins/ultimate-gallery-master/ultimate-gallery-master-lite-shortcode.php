<?php
add_shortcode( 'UGML', 'ultimateGalleryMasterLiteShortCode' );
function ultimateGalleryMasterLiteShortCode( $Id ) {
	
	$UGML_Id = $Id['id'];
	$TotalImages =  get_post_meta( $UGML_Id, 'UGML_total_images_count', true );
	if( $TotalImages == "" ){
		ob_start();
		printf( __( "Gallery with ID %s doesn't exist.","UGML_TEXT_DOMAIN" ), $UGML_Id );
		return ob_get_clean();
	}
	if( $TotalImages == 0 ){
		ob_start();
		printf( __( "Gallery with ID %s is empty.","UGML_TEXT_DOMAIN" ), $UGML_Id );
		return ob_get_clean();
	}
	
    ob_start();
	$UGML_Settings = ugml_get_gallery_value($UGML_Id);
	if(count($UGML_Settings)) {
		$UGML_Grid_Layout				= $UGML_Settings['UGML_Grid_Layout'];
		$UGML_Grid_Orientation			= $UGML_Settings['UGML_Grid_Orientation'];
		$UGML_cvThumbnail				= $UGML_Settings['UGML_cvThumbnail'];
		$UGML_maxWidth					= $UGML_Settings['UGML_maxWidth'];
		$UGML_maxHeight					= $UGML_Settings['UGML_maxHeight'];
		$UGML_openLink					= $UGML_Settings['UGML_openLink'];
		$UGML_Font_Style				= $UGML_Settings['UGML_Font_Style'];
		$UGML_disableThumbnails			= $UGML_Settings['UGML_disableThumbnails'];
		$UGML_hoverColor 				= $UGML_Settings['UGML_hoverColor'];
		$UGML_Color_Opacity      		= $UGML_Settings['UGML_Color_Opacity'];
		$UGML_imageHoverTextColor		= $UGML_Settings['UGML_imageHoverTextColor'];
		$UGML_useIconButtons			= $UGML_Settings['UGML_useIconButtons'];
		$UGML_IconStyle					= $UGML_Settings['UGML_IconStyle'];
		$UGML_thumbnailBorderSize		= $UGML_Settings['UGML_thumbnailBorderSize'];
		$UGML_spaceBwThumbnails			= $UGML_Settings['UGML_spaceBwThumbnails'];
		$UGML_showMenu					= $UGML_Settings['UGML_showMenu'];
		$UGML_menuBgColor				= $UGML_Settings['UGML_menuBgColor'];
		$UGML_showSearchBox				= $UGML_Settings['UGML_showSearchBox'];
		$UGML_menuPosition				= $UGML_Settings['UGML_menuPosition'];
		$UGML_searchLabel				= $UGML_Settings['UGML_searchLabel'];
		$UGML_searchNotFoundLabel		= $UGML_Settings['UGML_searchNotFoundLabel'];
		$UGML_showZoomButton			= $UGML_Settings['UGML_showZoomButton'];
		$UGML_showDescriptionButton		= $UGML_Settings['UGML_showDescriptionButton'];
		$UGML_descriptionByDefault		= $UGML_Settings['UGML_descriptionByDefault'];
		$UGML_Custom_CSS				= $UGML_Settings['UGML_Custom_CSS'];

		$gridType	= $UGML_Grid_Layout.$UGML_Grid_Orientation;
		$parentId   = 'UGM_'.$UGML_Id;
	}
?>
	<style> 
		/* Menu Background color */
		<?php echo '#'.$parentId; ?> .UGPMenuBackground{
			background-color:<?php echo $UGML_menuBgColor; ?>; 
		}

		<?php echo '#'.$parentId; ?> .UGPMenuButtonBackgroundSelected{
			background-color: <?php echo $UGML_menuBgColor; ?>;
			pointer-events: none;
			color:<?php echo $UGML_menuBgColor; ?>;
		}

		<?php echo '#'.$parentId; ?> .centerDark,
		<?php echo '#'.$parentId; ?> .centerWhite,
		<?php echo '#'.$parentId; ?> .centerNormalDark {
			color:<?php echo $UGML_imageHoverTextColor; ?>;
		}
		
		<?php echo '#'.$parentId; ?> .searchClassName,
		<?php echo '#'.$parentId; ?> .searchNotFound,
		<?php echo '#'.$parentId; ?> .centerWhite,
		<?php echo '#'.$parentId; ?> .centerDark,
		<?php echo '#'.$parentId; ?> .gallery1DecHeader,
		<?php echo '#'.$parentId; ?> .gallery1DescP
		{
			font-family:<?php echo $UGML_Font_Style; ?> !important;
		}
	<?php echo $UGML_Custom_CSS; ?>
	</style>
	<script src="<?php echo UGML_PLUGIN_URL.'js/FWDUGP.js' ;?>"></script>
<?php
	include("dcmlpage.php");

	wp_reset_postdata();
    return ob_get_clean();
}
?>