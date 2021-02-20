<?php
/**
 * Load Saved Gallery Pro Settings
 */
$PostId = $post->ID;
$SMGL_Settings = smgl_get_gallery_value($PostId);

if($SMGL_Settings['SMGP_Grid_Layout']) {
	$SMGL_Album_Type				= $SMGL_Settings['SMGP_Album_Type'];
	$SMGL_Grid_Layout				= $SMGL_Settings['SMGP_Grid_Layout'];
	$SMGL_Thumbnail					= $SMGL_Settings['SMGP_Thumbnail'];
	$SMGL_disableThumbnails			= $SMGL_Settings['SMGP_disableThumbnails'];
	$SMGL_hoverColor 				= $SMGL_Settings['SMGP_hoverColor'];
	$SMGL_useIconButtons			= $SMGL_Settings['SMGP_useIconButtons'];
	$SMGL_IconStyle					= $SMGL_Settings['SMGP_IconStyle'];
	$SMGL_spaceBwThumbnails			= $SMGL_Settings['SMGP_spaceBwThumbnails'];
	$SMGL_thumbnailBorderSize		= $SMGL_Settings['SMGP_thumbnailBorderSize'];
	$SMGL_Font_Style				= $SMGL_Settings['SMGP_Font_Style'];
	$SMGL_imageHoverTextColor		= $SMGL_Settings['SMGP_imageHoverTextColor'];
	$SMGL_showZoomButton			= $SMGL_Settings['SMGP_showZoomButton'];
	$SMGL_Custom_CSS				= $SMGL_Settings['SMGP_Custom_CSS'];
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
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery( "#slider3" ).slider({
			range: "min",
			value: <?php echo $SMGL_spaceBwThumbnails; ?>,
			min: 0,
			max: 15,
			slide: function(event, ui) {
				jQuery("#SMGL_spaceBwThumbnails").val( ui.value );
			}
		});
		
		jQuery("#SMGL_spaceBwThumbnails").val( 
			jQuery("#slider3").slider("value")
		);
	});

	jQuery(document).ready(function(){
		disableThumb();
	});
	
	function disableThumb(){
		if (jQuery('#SMGL_disableThumbnails').is(":checked")) {
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
            	<h4><?php _e('Product by','SMGL_TEXT_DOMAIN')?> <?php echo esc_html('WebHunt Infotech')?></h4>
            </div><!-- end .form-header section -->

            <form method="post" action="" id="form-ui">
            	<div class="form-body">

                    <div class="spacer-b30">
                    	<div class="tagline"><span><?php _e('Grid & Effect Settings','SMGL_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>
					
					<div class="frm-row"><!-- Grid Layout -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Grid Layout','SMGL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field select">
                                <select name="SMGL_Grid_Layout" id="SMGL_Grid_Layout" onchange="return galleryThumbnail();">
                                    <optgroup label="Select Effect">
										<option value="classic" <?php if($SMGL_Grid_Layout == 'classic') echo "selected=selected"; ?>><?php _e('Classic','SMGL_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Infinite (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- end of 'Grid Layout' Section-->

                    <div class="frm-row"><!-- Thumbnail Styles -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Thumbnail Styles','SMGL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field select">
                                <select name="SMGL_Thumbnail" id="SMGL_Thumbnail">
                                    <optgroup label="Select Effect">
										<option value="animtext" <?php if($SMGL_Thumbnail == 'animtext') echo "selected=selected"; ?>><?php _e('Animated Text Effect','SMGL_TEXT_DOMAIN')?></option>
										<option value="curtain" <?php if($SMGL_Thumbnail == 'curtain') echo "selected=selected"; ?>><?php _e('Curtain Effect','SMGL_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Move Text Effect (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Scale Text Effect (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Scale Text Inverse (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Media Effect (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
										<option disabled ><?php _e('Media 2  Effect (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- End of 'Thumbnail Styles' Section -->

					<div class="spacer-b10">&nbsp;</div><!-- 'Image Thumbnail Settings' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Image Thumbnail Settings','SMGL_TEXT_DOMAIN'); ?> </span></div>
                    </div> 
					
					<div class="frm-row"><!-- Disable Thumbnail -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Disable Hover Effect','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="SMGL_disableThumbnails" id="SMGL_disableThumbnails" onchange="return disableThumb();" value="yes" <?php if($SMGL_disableThumbnails == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_disableThumbnails" id="SMGL_disableThumbnails" onchange="return disableThumb();" value="no" <?php if($SMGL_disableThumbnails == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','SMGL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					</div><!-- End of 'Disable Thumbnail' Section -->
					
					<div class="frm-row disableThumb"><!-- Image Hover Color -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Image Hover Color','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="SMGL_hoverColor" id="SMGL_hoverColor" value="#31A3DD" <?php if($SMGL_hoverColor == '#31A3DD' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Sky Blue','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_hoverColor" id="SMGL_hoverColor" value="#de4c28" <?php if($SMGL_hoverColor == '#de4c28' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_hoverColor" id="SMGL_hoverColor" value="#000000" <?php if($SMGL_hoverColor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Black','SMGL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					</div><!-- End of 'Image Hover Color' Section -->
					
					<div class="frm-row disableThumb"><!-- Show Icon Button -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Icon Button','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm8">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="SMGL_useIconButtons" id="SMGL_useIconButtons" value="yes" <?php if($SMGL_useIconButtons == 'yes' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Yes','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_useIconButtons" id="SMGL_useIconButtons" value="no" <?php if($SMGL_useIconButtons == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','SMGL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Show Icon Button' Section -->
					 
					<div class="frm-row disableThumb"><!-- Icon Style -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Icon Style','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="SMGL_IconStyle" id="SMGL_IconStyle" value="no" <?php if($SMGL_IconStyle == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Light Color','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_IconStyle" id="SMGL_IconStyle" value="yes" <?php if($SMGL_IconStyle == 'yes' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Dark Color','SMGL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					</div><!-- End 'Icon Style' Section -->

					<div class="frm-row"> <!-- Space Between Thumbnails -->
						<label class="field-label colm colm4 align-left"><?php _e('Space Between Thumbnails','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="spacer-b15">
								<label for="amount"><?php _e('Space Range:','SMGL_TEXT_DOMAIN'); ?></label>
								<input type="text" id="SMGL_spaceBwThumbnails" class="slider-input" name="SMGL_spaceBwThumbnails" readonly><span style="color:#f6931f"><?php _e('px','SMGL_TEXT_DOMAIN'); ?></span> 
							</div><!-- end .spacer -->                   
							<div class="slider-wrapper">
								<div id="slider3"></div>
							</div><!-- end .slider-wrapper -->
						</div>
					</div> <!-- End of 'Space Between Thumbnails' Section -->
					
					 <div class="frm-row"><!-- Thumbnail Border -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Thumbnail Border','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="SMGL_thumbnailBorderSize" id="SMGL_thumbnailBorderSize" value="5" <?php if($SMGL_thumbnailBorderSize == '5' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_thumbnailBorderSize" id="SMGL_thumbnailBorderSize" value="0" <?php if($SMGL_thumbnailBorderSize == '0' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','SMGL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Thumbnail Border' Section -->
					
                    <div class="spacer-b10">&nbsp;</div><!-- 'Font Settings' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Font Settings','SMGL_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>


					<div class="frm-row">
                    	<label class="field-label colm colm4 align-left"><?php _e('Font Style','SMGL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field select">
                                <select name="SMGL_Font_Style" id="SMGL_Font_Style">
                                    <optgroup label="Default Fonts">
										<option value="Arial" <?php selected($SMGL_Font_Style, 'Arial' ); ?>><?php _e('Arial','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_arial_black" <?php selected($SMGL_Font_Style, '_arial_black' ); ?>><?php _e('Arial Black','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="Courier New" <?php selected($SMGL_Font_Style, 'Courier New' ); ?>><?php _e('Courier New','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="georgia" <?php selected($SMGL_Font_Style, 'Georgia' ); ?>><?php _e('Georgia','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="grande" <?php selected($SMGL_Font_Style, 'Grande' ); ?>><?php _e('Grande','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_helvetica_neue" <?php selected($SMGL_Font_Style, '_helvetica_neue' ); ?>><?php _e('Helvetica Neue','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_impact" <?php selected($SMGL_Font_Style, '_impact' ); ?>><?php _e('Impact','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_lucida" <?php selected($SMGL_Font_Style, '_lucida' ); ?>><?php _e('Lucida','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_lucida" <?php selected($SMGL_Font_Style, '_lucida' ); ?>><?php _e('Lucida Grande','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_OpenSansBold" <?php selected($SMGL_Font_Style, 'OpenSansBold' ); ?>><?php _e('OpenSansBold','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_palatino" <?php selected($SMGL_Font_Style, '_palatino' ); ?>><?php _e('Palatino','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_sans" <?php selected($SMGL_Font_Style, '_sans' ); ?>><?php _e('Sans','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_sans" <?php selected($SMGL_Font_Style, 'Sans-Serif' ); ?>><?php _e('Sans-Serif','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_tahoma" <?php selected($SMGL_Font_Style, '_tahoma' ); ?>><?php _e('Tahoma','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_times"<?php selected($SMGL_Font_Style, '_times' ); ?>><?php _e('Times New Roman','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_trebuchet" <?php selected($SMGL_Font_Style, 'Trebuchet' ); ?>><?php _e('Trebuchet','SMGL_TEXT_DOMAIN'); ?></option>
										<option value="_verdana" <?php selected($SMGL_Font_Style, '_verdana' ); ?>><?php _e('Verdana','SMGL_TEXT_DOMAIN'); ?></option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- end .frm-row section -->
					
					<div class="frm-row"><!-- Image Hover Text Color -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Image hover Text Color','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="SMGL_imageHoverTextColor" id="SMGL_imageHoverTextColor" value="#FFFFFF" <?php if($SMGL_imageHoverTextColor == '#FFFFFF' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('White','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_imageHoverTextColor" id="SMGL_imageHoverTextColor" value="#000000" <?php if($SMGL_imageHoverTextColor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Black','SMGL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					</div><!-- End of 'Image Hover Text Color' Section -->
					


                    <div class="spacer-b10">&nbsp;</div><!-- 'Light Box Settings' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Light Box Settings','SMGL_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>

					 <div class="frm-row"><!-- Show Zoom Button -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Show Zoom Button','SMGL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="SMGL_showZoomButton" id="SMGL_showZoomButton" value="yes" <?php if($SMGL_showZoomButton == 'yes' ) { echo "checked"; } ?> >
									<span class="radio"></span> <?php _e('Yes','SMGL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="SMGL_showZoomButton" id="SMGL_showZoomButton" value="no" <?php if($SMGL_showZoomButton == 'no' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('No','SMGL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of 'Show Zoom Button' Section -->

					<div class="spacer-b10">&nbsp;</div><!-- 'Custom CSS' Section -->
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Custom CSS','SMGL_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>

					<div class="frm-row"><!-- Custom CSS -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Custom CSS Editor','SMGL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm8">
							<label class="field">
								<textarea class="gui-textarea" id="SMGL_Custom_CSS" name="SMGL_Custom_CSS" placeholder="Put Your Css Here"><?php echo $SMGL_Custom_CSS; ?></textarea>
								<span class="input-hint">
									<strong><?php _e('Note','SMGL_TEXT_DOMAIN'); ?>:</strong> <?php _e('Please Do Not Use','SMGL_TEXT_DOMAIN'); ?> <b>Style</b> Tag <?php _e('With Custom CSS Editor','SMGL_TEXT_DOMAIN'); ?>.
								</span>
							</label>
						</div>
					</div>	<!-- End of 'Custom CSS' Section -->

				</div>
			</form>
		</div>
	</div>
</body>
