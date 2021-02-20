<?php
/**
 * Load Gallery Settings
 */
$PostId = $post->ID;
$UGML_Settings = ugml_get_gallery_value($PostId);

if($UGML_Settings['UGML_Grid_Layout']) {
	$UGML_Grid_Layout				= $UGML_Settings['UGML_Grid_Layout'];
	$UGML_Grid_Orientation			= $UGML_Settings['UGML_Grid_Orientation'];
	$UGML_cvThumbnail				= $UGML_Settings['UGML_cvThumbnail'];
	$UGML_maxWidth					= $UGML_Settings['UGML_maxWidth'];
	$UGML_maxHeight					= $UGML_Settings['UGML_maxHeight'];
	$UGML_Font_Style				= $UGML_Settings['UGML_Font_Style'];
	$UGML_openLink					= $UGML_Settings['UGML_openLink'];
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
}

?>
<style>
	@media only screen and (min-width: 970px){
		#post-body.columns-2 #postbox-container-1 {
			float: right;
			margin-right: 15px;
			width: 280px;
			right:0;
			position:absolute;
		}
	}
	.thumb-pro th, .thumb-pro label, .thumb-pro h3, .thumb-pro{
		color:#31a3dd !important;
		font-weight:bold;
	}
	.caro-pro th, .caro-pro label, .caro-pro h3, .caro-pro{
		color:#DA5766 !important;
		font-weight:bold;
	}
	.arrow::after{
		transform: none;
		height: 0px;
		left:0px;
	}
	.arrow {
		left: auto;
	}
	.smart-forms .option-group
	{
		padding-top:6px;
	}
	
	p.small-text.fine-grey.uppertitle{
		font-size:13px !important;
		line-height:0px;
	}
	
	p.small-text.fine-grey.bottomtext {
		margin-bottom: 11px;
		line-height: 18px;
		margin-top: 3px !important;
	}	
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
			jQuery( "#slider3" ).slider({
				range: "min",
				value: <?php echo $UGML_spaceBwThumbnails; ?>,
				min: 0,
				max: 15,
				slide: function(event, ui) {
					jQuery("#UGML_spaceBwThumbnails").val( ui.value );
				}
			});
			
			jQuery("#UGML_spaceBwThumbnails").val( 
				jQuery("#slider3").slider("value")
			);	
	});
</script>
<script>
// WRITE THE VALIDATION SCRIPT IN THE HEAD TAG.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }  

	jQuery(document).ready(function(){
		galleryDementation();
		showMenu();
		disableThumb();
	});

	function galleryDementation() {
		if (jQuery('#UGML_Grid_Orientation').is(":checked")) {
		  jQuery('.dimensionOption').hide();
		} else {
			jQuery('.dimensionOption').show();
		}
	}

	function showMenu() {
		if (jQuery('#UGML_showMenu').is(":checked")) {
		  jQuery('.showMenu').show(300);
		} else {
			jQuery('.showMenu').hide(300);
		}
	}
	
	function disableThumb(){
		if (jQuery('#UGML_disableThumbnails').is(":checked")) {
			jQuery('.disableThumb').hide(300);
		}else{
			jQuery('.disableThumb').show(300);
		}
	}
</script>

<input type="hidden" id="wl_action" name="wl_action" value="wl-save-settings">
<body class="woodbg">

	<div class="smart-wrap">
    	<div class="smart-forms smart-container wrap-1">

        	<div class="form-header header-primary">
            	<h4><?php _e('Product by WebHunt Infotech','UGML_TEXT_DOMAIN')?></h4>
            </div><!-- end .form-header section -->

            <form method="post" action="" id="form-ui">
            	<div class="form-body">

                    <div class="spacer-b30">
                    	<div class="tagline"><span><?php _e('Grids and Effect Settings','UGML_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>

					<div class="frm-row"><!-- Grid Layout -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Grid Layout','UGML_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6 spacer-b10">
                            <label class="field select">
                                <select name="UGML_Grid_Layout" id="UGML_Grid_Layout">
                                    <optgroup label="Select Grid Layout">
										<option value="classic" <?php if($UGML_Grid_Layout == 'classic') echo "selected=selected"; ?>><?php _e('Classic','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Dynamic (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Masonry (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Infinite (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- end of 'Grid Layout' Section-->
					
					<div class="frm-row grid_orientation"><!-- Grid Orientation -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Grid Orientation','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_Grid_Orientation" id="UGML_Grid_Orientation" onclick="return galleryDementation();" value="Vertical" <?php if($UGML_Grid_Orientation == 'Vertical' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Vertical','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_Grid_Orientation" id="UGML_Grid_Orientation" onclick="return galleryDementation();" value="Horizontal" <?php if($UGML_Grid_Orientation == 'Horizontal' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Horizontal','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Grid Orientation' Section -->

					<div class="frm-row cvThumbnail"><!-- Classic Vertical Thumbnail Styles -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Thumbnail Styles','UGML_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6 spacer-b15">
                            <label class="field select">
                                <select name="UGML_cvThumbnail" id="UGML_cvThumbnail">
                                    <optgroup label="Select Effect">
										<option value="animtext" <?php if($UGML_cvThumbnail == 'animtext') echo "selected=selected"; ?>><?php _e('Animtext','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Curtain Effect (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Move text Effect(Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Scale text Effect (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Scale Text Inverse (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Media (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Media 2 (Avaliable in PRO Version)','UGML_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('and More...','UGML_TEXT_DOMAIN')?></option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- End of Thumbnail Styles -->
					
					<div class="frm-row dimensionOption">
                    	<label class="field-label colm colm4 align-left" Style="padding-top: 30px;"><?php _e('Container Dimension','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section">
							<div class="colm colm3"><!-- "Container Dimension Max Width" Section -->
								<p class="small-text fine-grey uppertitle"> <?php _e('Max Width','UGML_TEXT_DOMAIN'); ?> </p>
								<label class="field append-icon">
									<input type="number" name="UGML_maxWidth" id="UGML_maxWidth" class="gui-input" value="<?php echo $UGML_maxWidth; ?>" onkeypress="javascript:return isNumber(event)" maxlength="4" placeholder="Max Width of Gallery Section">
									<label class="field-icon">px </label>
								</label>
							</div>
							<div class="colm colm3"><!-- "Container Dimension Max Height" Section -->
								<p class="small-text fine-grey uppertitle"> <?php _e('Max Height','UGML_TEXT_DOMAIN'); ?> </p>
								<label class="field append-icon">
									<input type="number" name="UGML_maxHeight" id="UGML_maxHeight" class="gui-input" value="<?php echo $UGML_maxHeight; ?>" onkeypress="javascript:return isNumber(event)" maxlength="4" placeholder="Max Hight of Gallery Section">
									<label class="field-icon">px </label>  
								</label>
							</div>
							<div class="colm colm4"></div>
							<div class="colm colm8"><p class="small-text fine-grey bottomtext" style="margin-top: 14px;"> <?php _e('Max width and Height of Container Dimension, for more detail <a href="https://www.webhuntinfotech.com/ultimate-gallery-master-lite-documentation/#container_dimension" target="_blank">click here</a>','UGML_TEXT_DOMAIN'); ?>.</p></div>
						</div>
					</div><!-- End of the Section -->

					<div class="frm-row spacer-t10"><!-- Gallery Font Style -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Gallery Font Style','UGML_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field select">
                                <select name="UGML_Font_Style" id="UGML_Font_Style">
									<optgroup label="Default Fonts">
										<option value="Arial" <?php selected($UGML_Font_Style, 'Arial' ); ?>><?php _e('Arial','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Arial Black" <?php selected($UGML_Font_Style, 'Arial Black' ); ?>><?php _e('Arial Black','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Comic Sans MS" <?php selected($UGML_Font_Style, 'Comic Sans MS' ); ?>><?php _e('Comic Sans MS','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Courier New" <?php selected($UGML_Font_Style, 'Courier New' ); ?>><?php _e('Courier New','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Georgia" <?php selected($UGML_Font_Style, 'Georgia' ); ?>><?php _e('Georgia','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Grande" <?php selected($UGML_Font_Style, 'Grande' ); ?>><?php _e('Grande','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Helvetica" <?php selected($UGML_Font_Style, 'Helvetica' ); ?>><?php _e('Helvetica Neue','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Impact" <?php selected($UGML_Font_Style, 'Impact' ); ?>><?php _e('Impact','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Lucida" <?php selected($UGML_Font_Style, 'Lucida' ); ?>><?php _e('Lucida','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Lucida Grande" <?php selected($UGML_Font_Style, 'Lucida Grande' ); ?>><?php _e('Lucida Grande','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Palatino Linotype" <?php selected($UGML_Font_Style, 'Palatino Linotype' ); ?>><?php _e('Palatino','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Sans" <?php selected($UGML_Font_Style, 'Sans' ); ?>><?php _e('Sans','UGML_TEXT_DOMAIN'); ?></option>
										<option value="sans-serif" <?php selected($UGML_Font_Style, 'sans-serif' ); ?>><?php _e('Sans-Serif','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Tahoma" <?php selected($UGML_Font_Style, 'Tahoma' ); ?>><?php _e('Tahoma','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Times New Roman"<?php selected($UGML_Font_Style, 'Times New Roman' ); ?>><?php _e('Times New Roman','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Trebuchet MS" <?php selected($UGML_Font_Style, 'Trebuchet MS' ); ?>><?php _e('Trebuchet MS','UGML_TEXT_DOMAIN'); ?></option>
										<option value="Verdana" <?php selected($UGML_Font_Style, 'Verdana' ); ?>><?php _e('Verdana','UGML_TEXT_DOMAIN'); ?></option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- End of 'Gallery Font Style' Section -->
					
					<div class="frm-row"><!-- Open Link -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Open External Link','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_openLink" id="UGML_openLink" value="_self" <?php if($UGML_openLink == '_self' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('On Same Tab','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_openLink" id="UGML_openLink" value="_blank" <?php if($UGML_openLink == '_blank' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('On New Tab','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Open Link' Section -->

					<div class="spacer-b10">&nbsp;</div><!-- 'Image Thumbnail Settings' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Image Thumbnail Settings','UGML_TEXT_DOMAIN'); ?> </span></div>
                    </div>
					
					<div class="frm-row"><!-- Disable Thumbnail -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Disable Hover Effect','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_disableThumbnails" id="UGML_disableThumbnails" onchange="return disableThumb();" value="yes" <?php if($UGML_disableThumbnails == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_disableThumbnails" id="UGML_disableThumbnails" onchange="return disableThumb();" value="no" <?php if($UGML_disableThumbnails == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Disable Thumbnail' Section -->

                    <div class="frm-row disableThumb"><!-- Image Hover Color -->
						<label class="field-label colm colm4 align-left"><?php _e('Image Hover Color','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_hoverColor" id="UGML_hoverColor" value="#31A3DD" <?php if($UGML_hoverColor == '#31A3DD' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Sky Blue','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_hoverColor" id="UGML_hoverColor" value="#720004" <?php if($UGML_hoverColor == '#720004' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_hoverColor" id="UGML_hoverColor" value="#000000" <?php if($UGML_hoverColor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span>  <?php _e('Black','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div> <!-- End of 'Image Hover Color' Section -->


                    <div class="frm-row disableThumb"> <!-- Image Hover Color Opacity -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Image Hover Color Opacity','UGML_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm5">
                            <label class="field select">
                                <select name="UGML_Color_Opacity" id="UGML_Color_Opacity">
                                    <optgroup label="Select Hover Color Opacity">
										<option value="1" <?php if($UGML_Color_Opacity == '1') echo "selected=selected"; ?>>1</option>
										<option value="0.9" <?php if($UGML_Color_Opacity == '0.9') echo "selected=selected"; ?>>0.9</option>
										<option value="0.8" <?php if($UGML_Color_Opacity == '0.8') echo "selected=selected"; ?>>0.8</option>
										<option value="0.7" <?php if($UGML_Color_Opacity == '0.7') echo "selected=selected"; ?>>0.7</option>
										<option value="0.6" <?php if($UGML_Color_Opacity == '0.6') echo "selected=selected"; ?>>0.6</option>
										<option value="0.5" <?php if($UGML_Color_Opacity == '0.5') echo "selected=selected"; ?>>0.5</option>
										<option value="0.4" <?php if($UGML_Color_Opacity == '0.4') echo "selected=selected"; ?>>0.4</option>
										<option value="0.3" <?php if($UGML_Color_Opacity == '0.3') echo "selected=selected"; ?>>0.3</option>
										<option value="0.2" <?php if($UGML_Color_Opacity == '0.2') echo "selected=selected"; ?>>0.2</option>
										<option value="0.1" <?php if($UGML_Color_Opacity == '0.1') echo "selected=selected"; ?>>0.1</option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- End of 'Image Hover Color Opacity' Section -->

                    <div class="frm-row disableThumb"><!-- Image Hover Text Color -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Image Overlay Text Color','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_imageHoverTextColor" id="UGML_imageHoverTextColor" value="#ffffff" <?php if($UGML_imageHoverTextColor == '#ffffff' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('White','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_imageHoverTextColor" id="UGML_imageHoverTextColor" value="#000000" <?php if($UGML_imageHoverTextColor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Black','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Image Hover Text Color' Section -->
					
					<div class="frm-row disableThumb"><!-- Show Icon Button -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Icon Button','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm8">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_useIconButtons" id="UGML_useIconButtons" value="yes" <?php if($UGML_useIconButtons == 'yes' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>

								<label class="option">
									<input type="radio" name="UGML_useIconButtons" id="UGML_useIconButtons" value="no" <?php if($UGML_useIconButtons == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Show Icon Button' Section -->
					 
					<div class="frm-row disableThumb"><!-- Icon Style -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Icon Style','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_IconStyle" id="UGML_IconStyle" value="no" <?php if($UGML_IconStyle == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Light Color','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_IconStyle" id="UGML_IconStyle" value="yes" <?php if($UGML_IconStyle == 'yes' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Dark Color','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					</div><!-- End 'Icon Style' Section -->
					
					<div class="frm-row"><!-- Thumbnail border -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Image Border','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_thumbnailBorderSize" id="UGML_thumbnailBorderSize" value="5" <?php if($UGML_thumbnailBorderSize == '5' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_thumbnailBorderSize" id="UGML_thumbnailBorderSize" value="0" <?php if($UGML_thumbnailBorderSize == '0' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Image Border' Section -->

					<div class="frm-row spaceBwThumbnails"> <!-- Space Between Images -->
						<label class="field-label colm colm4 align-left"><?php _e('Space Between Images','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm5">
							<div class="spacer-b15">
								<label for="amount"><?php _e('Space Range:','UGML_TEXT_DOMAIN'); ?></label>
								<input type="text" id="UGML_spaceBwThumbnails" class="slider-input" name="UGML_spaceBwThumbnails" readonly><span style="color:#f6931f"><?php _e('px','UGML_TEXT_DOMAIN'); ?></span> 
							</div><!-- end .spacer -->                   
							<div class="slider-wrapper">
								<div id="slider3"></div>
							</div><!-- end .slider-wrapper -->
						</div>
					</div> <!-- End of 'Space Between Images' Section -->


					<div class="spacer-b10">&nbsp;</div><!-- 'Menu Settings' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Menu Settings','UGML_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div> 

					<div class="frm-row"><!-- Show Top Bar -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show TopBar','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_showMenu" id="UGML_showMenu" onclick="return showMenu();" value="yes" <?php if($UGML_showMenu == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_showMenu" id="UGML_showMenu" onclick="return showMenu();" value="no" <?php if($UGML_showMenu == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Show Menu' Section-->
					 
					 <div class="frm-row showMenu"><!-- Menu Background Color -->
						<label class="field-label colm colm4 align-left"><?php _e('TopBar Background Color','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm8">
							<div class="option-group field">
								<label class="option" >
									<input type="radio" name="UGML_menuBgColor" id="UGML_menuBgColor" value="#31A3DD" <?php if($UGML_menuBgColor == '#31A3DD' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Sky Blue','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_menuBgColor" id="UGML_menuBgColor" value="#720004" <?php if($UGML_menuBgColor == '#720004' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_menuBgColor" id="UGML_menuBgColor" value="#000000" <?php if($UGML_menuBgColor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span>  <?php _e('Black','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_menuBgColor" id="UGML_menuBgColor" value="transparent" <?php if($UGML_menuBgColor == 'transparent' ) { echo "checked"; } ?>>
									<span class="radio"></span>  <?php _e('Transparent','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div> <!-- End of 'Menu Background Color' Section -->
					 
					 <div class="frm-row showMenu"><!-- Show Search Box -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Search Box','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_showSearchBox" id="UGML_showSearchBox" value="yes" <?php if($UGML_showSearchBox == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_showSearchBox" id="UGML_showSearchBox" value="no" <?php if($UGML_showSearchBox == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Show Search Box' Section -->

					 <div class="frm-row showMenu"><!-- Menu Position -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Search Box Position','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_menuPosition" id="UGML_menuPosition" value="right" <?php if($UGML_menuPosition == 'right' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Left','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_menuPosition" id="UGML_menuPosition" value="left" <?php if($UGML_menuPosition == 'left' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Right','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Menu Position' Section -->
					 
					<div class="frm-row showMenu"><!-- Search Box Label -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Search Box Label','UGMP_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
                           <label class="field">
                               <input type="text" name="UGML_searchLabel" id="UGML_searchLabel" class="gui-input" value="<?php echo $UGML_searchLabel; ?>" placeholder="Search Box Label">
                           </label>
                       </div>
					</div>	<!-- End of 'Search Box Label' Section -->

					<div class="frm-row showMenu"><!-- Search Not Found Text -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Search Not Found Text','UGMP_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
                           <label class="field">
                               <input type="text" name="UGML_searchNotFoundLabel" id="UGML_searchNotFoundLabel" class="gui-input" value="<?php echo $UGML_searchNotFoundLabel; ?>" placeholder="Search Not Found Label">
                           </label>
                       </div>
					</div>	<!-- End of 'Search Not Found Text' Section -->	

                    <div class="spacer-b10">&nbsp;</div><!-- 'Light Box Settings' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Light Box Settings','UGML_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>

					 <div class="frm-row"><!-- Show Zoom Button -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Zoom Button','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_showZoomButton" id="UGML_showZoomButton" value="yes" <?php if($UGML_showZoomButton == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_showZoomButton" id="UGML_showZoomButton" value="no" <?php if($UGML_showZoomButton == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Show Zoom Button' Section -->

					 <div class="frm-row"><!-- Show Description Button -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Description Button','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_showDescriptionButton" id="UGML_showDescriptionButton" value="yes" <?php if($UGML_showDescriptionButton == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_showDescriptionButton" id="UGML_showDescriptionButton" value="no" <?php if($UGML_showDescriptionButton == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Show Description Button' Section -->

					 <div class="frm-row"><!-- Description By Default -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Desc. By Default','UGML_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="UGML_descriptionByDefault" id="UGML_descriptionByDefault" value="yes" <?php if($UGML_descriptionByDefault == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','UGML_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="UGML_descriptionByDefault" id="UGML_descriptionByDefault" value="no" <?php if($UGML_descriptionByDefault == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','UGML_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Description By Default' Section -->

					<div class="spacer-b10">&nbsp;</div><!-- 'Custom CSS' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Custom CSS Editor','UGML_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>

					<div class="frm-row"><!-- Custom CSS Editor -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Custom CSS Editor','UGML_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm8">
							<label class="field">
								<textarea class="gui-textarea" id="UGML_Custom_CSS" name="UGML_Custom_CSS" placeholder="Put Your Css Here"><?php echo $UGML_Custom_CSS; ?></textarea>
								<span class="input-hint">
									<strong><?php _e('Note','UGML_TEXT_DOMAIN'); ?>:</strong> <?php _e('Please do not use','UGML_TEXT_DOMAIN'); ?> <b><?php _e('Style','UGML_TEXT_DOMAIN'); ?></b> <?php _e(' tag with Custom CSS','UGML_TEXT_DOMAIN'); ?>.
								</span>
							</label>
						</div>
					</div>	<!-- End of 'Custom CSS Editor' Section -->
					
				</div>
			</form>
		</div>
	</div>
</body>
