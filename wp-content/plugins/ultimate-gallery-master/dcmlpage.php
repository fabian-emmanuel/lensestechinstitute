<script type="text/javascript">
FWDRLUtils.onReady(function(){
	new FWDUGP({
	/* main settings  */
		gridType:"<?php echo $gridType; ?>",
		rightClickContextMenu:"default",
		instanceName:"myUGP_<?php echo $UGML_Id;?>",
		parentId:"<?php echo $parentId; ?>",
		mainFolderPath:"<?php echo UGML_PLUGIN_URL.'content'; ?>",
		gridSkinPath:"grid_skin_classic",
		lightboxSkinPath:"lightbox_skin_classic",
		playlistId:"UGMGallery_<?php echo $UGML_Id;?>",
		animateParent:"yes",
		startAtCategory:0,
		<?php if($UGML_Grid_Orientation == "Horizontal") { ?>
		addMouseWheelSupport:"yes",
		maxWidth:<?php echo $UGML_maxWidth; ?>,
		maxHeight:<?php echo $UGML_maxHeight; ?>,
		<?php } ?>
	/* menu settings */
		showMenu:"<?php echo $UGML_showMenu; ?>",
		showSearchBox:"<?php echo $UGML_showSearchBox; ?>",
		centerNoSearchFoundLabelWithMenu:"yes",
		menuPosition:"<?php echo $UGML_menuPosition; ?>",
		searchLabel:"<?php echo $UGML_searchLabel; ?>",
		searchNotFoundLabel:"<?php echo $UGML_searchNotFoundLabel; ?>",
		menuButtonSpacerWidth:1,
		menuButtonSpacerHeight:20,
		menuButtonsSapcerLeftAndRight:10,
		menuMaxWidth:920,
		menuOffsetTop:18,
		menuOffsetBottom:36,
	/* thumbnail settings */
		thumbanilBoxShadow:"none",
		disableThumbnails:"<?php echo $UGML_disableThumbnails; ?>", 
		inverseButtonsIcons:"<?php echo $UGML_IconStyle;?>",
		thumbnailBackgroundColor:"<?php echo $UGML_hoverColor; ?>",
		thumbnailBorderNormalColor:"#000000",
		thumbnailBorderSelectedColor:"#000000",
		thumbnailsHorizontalOffset:0,
		thumbnailsVerticalOffset:5,
		horizontalSpaceBetweenThumbnails:<?php echo $UGML_spaceBwThumbnails; ?>,
		verticalSpaceBetweenThumbnails:<?php echo $UGML_spaceBwThumbnails; ?>,
		thumbnailBorderSize:<?php echo $UGML_thumbnailBorderSize; ?>,
	/* preset settings */
		preset:"animtext",
		textAnimationType:"scale",
		useIconButtons:"<?php echo $UGML_useIconButtons; ?>",
		thumbnailIconWidth:30,
		thumbnailIconHeight:29,
		spaceBetweenThumbanilIcons:12,
		spaceBetweenTextAndIcons:20,
		thumbnailOverlayColor:"<?php echo $UGML_hoverColor; ?>",
		thumbnailOverlayOpacity:<?php echo $UGML_Color_Opacity; ?>,
	/* ligtbox settings (optional) */
		showZoomButton:"<?php echo $UGML_showZoomButton; ?>",
		showDescriptionButton:"<?php echo $UGML_showDescriptionButton; ?>",
		showDescriptionByDefault:"<?php echo $UGML_descriptionByDefault; ?>",
	});
});
</script>
<!-- UGP holder -->
<div id="<?php echo $parentId; ?>"></div>
<div id="UGMGallery_<?php echo $UGML_Id;?>" style="display:none">
	<ul>
	<?php
		if (!function_exists('videoType')) {
			function videoType($url) {
				if (strpos($url, 'youtube') > 0) {
					return 'yv_video';
				} elseif (strpos($url, 'vimeo') > 0) {
					return 'yv_video';
				} else {
					return 'image';
				}
			}
		}
		
		$filtered = unserialize(get_post_meta( $UGML_Id, 'UGML_all_photos_details', true));
		$TotalImages =  get_post_meta( $UGML_Id, 'UGML_total_images_count', true );
		if($TotalImages) {		
			foreach($filtered as $filter) {
				$image_title		= $filter['UGML_image_label'];
				$image_url 			= $filter['UGML_image_url'];
				$thumb_image 		= $filter['UGML_gallery_admin_circle'];
				$type 				= $filter['UGML_display_type'];
				$description 		= $filter['UGML_image_descp'];
				$link 				= $filter['UGML_external_link'];
				$extra_button_url 	= $filter['UGML_extra_button_url'];

				if($type =="yv_video")
				{
					$type = videoType($link);
				}
				$output = '<li ';
				switch ($type) {
					case "image":
						$output .=  'data-url="'. $image_url .'" ';
						break;
					case "yv_video":
						$output .=  'data-url="'. $link .'" data-width="900" data-height="550" ';
						break;
					case "link":
						$output .=  'data-url="link:'. $link .'" data-target="'. $UGML_openLink .'" ';
						break;
					default:
						$output .=  'data-url="'. $image_url .'" ';
				}
				if($extra_button_url != "") {
					$output .=  'data-extra-button-url="'. $extra_button_url .'" data-extra-button-target="'. $UGML_openLink .'" ';
				}
				$output .= '>';
				$output .=  '<img src="'. $thumb_image .'" alt="'. $image_title .'"/> ';
				$output .=  '<div data-thumbnail-content1="">';
				$output .=  	'<div class="centerDark">'. $image_title .'</div>';
				$output .=  '</div>';
				$output .=  '<div data-lightbox-desc="">';
				$output .=  	'<p class="gallery1DecHeader">'. $image_title .'</p>';
				$output .=  	'<p class="gallery1DescP">'. $description .'</p>';
				$output .=  '</div>';
				$output .=  '</li>';

				echo $output;	
			}
		}
	?>
	</ul>		
</div>