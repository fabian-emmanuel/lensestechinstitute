<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
wp_enqueue_style('general-settings-page-css', SMGL_PLUGIN_URL.'admin-scripts/css/general-settings-page.css');
wp_enqueue_style('free-banner-css', SMGL_PLUGIN_URL.'admin-scripts/css/free-banner.css');
		
$path_free_banner = plugins_url("admin-scripts/img", __FILE__);
?>
<script>
jQuery(document).ready(function () {
	  
    jQuery('#lightbox_type input').change(function () {
        jQuery('#lightbox_type input').parent().removeClass('active');
        jQuery(this).parent().addClass('active');
        if (jQuery(this).val() == 'other') {
            jQuery('#lightbox-options-list').addClass('active');
            jQuery('#new-lightbox-options-list').removeClass('active');
			jQuery('#pro-screenshot-list').removeClass('active');
        }
        else if(jQuery(this).val() == 'screenshot') {
			jQuery('#pro-screenshot-list').addClass('active');
            jQuery('#lightbox-options-list').removeClass('active');
            jQuery('#new-lightbox-options-list').removeClass('active');
        }
		else {
			jQuery('#new-lightbox-options-list').addClass('active');
            jQuery('#lightbox-options-list').removeClass('active');
            jQuery('#pro-screenshot-list').removeClass('active');
        }
        jQuery('#lightbox_type input').prop('checked', false);
        if (!jQuery(this).prop('checked')) {
            jQuery(this).prop('checked', true);
        }
    });
	
/**
 * Close banner on 'X' button
 */		
	jQuery(".close_banner").on("click", function () {
        jQuery(".free_version_banner").css("display", "none");
        galleryImgSetCookie('hgGalleryFreeBannerShow', 'no', {expires: 86400});
    });
	
/**
 * Click action on Show Sharing Button
 */	
	jQuery('#SMGP_showShareButton').click(function () {
		 jQuery('#sub-lvl-filter input[type="checkbox"]').prop('checked', this.checked).trigger('change')
	});
	
/**
 * Change value of Parent social button on changing sub levels
 */
	jQuery('#sub-lvl-filter input[type="checkbox"]').change(function(){
		var a = jQuery('#sub-lvl-filter input[type="checkbox"]');
		if(a.length > a.filter(":checked").length && a.filter(":checked").length > 0){
			jQuery('#SMGP_showShareButton').prop('checked','checked');
		}
		else if(a.filter(":checked").length < 1){
			jQuery('#SMGP_showShareButton').prop('checked','');
		}
	});
	
});
</script>
<div class="wrap">
    <?php require('free-banner.php'); ?>
    <p class="pro_info">
        <?php echo __('These features are available in the Professional version of the plugin only.', 'SMGL_TEXT_DOMAIN'); ?>
        <a href="https://www.webhuntinfotech.com/plugin/social-media-gallery-pro/" target="_blank"
           class="button button-primary"><?php echo __('Enable', 'SMGL_TEXT_DOMAIN'); ?></a>
    </p>
    <div id="post-body-heading">
    <h3 class="gen-option-title"><?php echo __( 'General Options', 'SMGL_TEXT_DOMAIN' ); ?></h3>
	<a href="#" class="save-gallery-options button-primary"><?php echo __( 'Reset All', 'SMGL_TEXT_DOMAIN' ); ?></a>
    <a href="#" class="save-gallery-options button-primary" id="save"><?php echo __( 'Save', 'SMGL_TEXT_DOMAIN' ); ?></a>
</div>
<form action="" method="post" id="adminForm"
      name="adminForm">

    <ul id="lightbox_type" >
		<li class="active">
			<label for="lightbox"><?php _e('Lightbox Settings','SMGL_TEXT_DOMAIN'); ?></label>
			<input type="checkbox" name="params[SMGP_generalOptionType]"
				   id="lightbox" value="lightbox" checked>
		</li>
		<li class="">
			<label for="other"><?php _e('Other Settings','SMGL_TEXT_DOMAIN'); ?></label>
			<input type="checkbox" name="params[SMGP_generalOptionType]"
				   id="other" value="other">
		</li>
		<li class="">
			<label for="screenshot"><?php _e('Pro Gallery Screenshot','SMGL_TEXT_DOMAIN'); ?></label>
			<input type="checkbox" name="params[SMGP_generalOptionType]"
				   id="screenshot" value="screenshot">
		</li>
    </ul>

    <div id="new-lightbox-options-list"
         class="unique-type-options-wrapper active">
        <div class=""></div>
        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Lightbox Styles','SMGL_TEXT_DOMAIN'); ?><img src="<?php echo $path_free_banner.'/Gallery_Pro.png'; ?>"
                              class="gallery_img_lightbox_pro_logo"></h3>
							  
			<div class="has-background">
                <label for="lightboxSkinPath"><?php _e('Lightbox Style','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Choose the style of your lightbox','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <select name="params[SMGP_lightboxSkinPath]" id="SMGP_lightboxSkinPath">
					<option value="classic" selected><?php _e('Classic','SMGL_TEXT_DOMAIN'); ?></option>
                    <option value="modern"><?php _e('Modern','SMGL_TEXT_DOMAIN'); ?></option>
                </select>
            </div>
			<div>
                <label for="itemOffsetHeight"><?php _e('Lightbox Offset Margin','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the margin from top and bottom for the lightbox in pixels.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" name="params[SMGP_itemOffsetHeight]"
                       id="SMGP_itemOffsetHeight"
                       value="50"
                       class="text">
                <span>px</span>
            </div>
			<div class="has-background">
                <label for="lightBoxBackgroundColor"><?php _e('Background Color','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Choose the lightbox main background color','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" class="jscolor {hash:true} color" id="SMGP_lightBoxBackgroundColor" name="params[SMGP_lightBoxBackgroundColor]" value="#000000" size="10"/>
            </div>
			<div>
                <label for="backgroundOpacity"><?php _e('Background Opacity','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the lightbox main background opacity.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                 <input type="number" id="SMGP_backgroundOpacity"  name="params[SMGP_backgroundOpacity]"  value="0.9" step="0.1" max="1" min="0.1"
                       class="text">
            </div>
			<div class="has-background">
                <label for="itemBorderColor"><?php _e('Border Color','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Choose the lightbox item border color','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" class="jscolor {hash:true} color" id="SMGP_itemBorderColor" name="params[SMGP_itemBorderColor]" value="#333333" size="10"/>
            </div>
			<div class="has-background">
                <label for="itemBorderSize"><?php _e('Lightbox Border Size','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the lightbox item border size in px','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="SMGP_itemBorderSize"  name="params[SMGP_itemBorderSize]" value="0" class="text">
                <span>px</span>
            </div>
			<div>
                <label for="itemBorderRadius"><?php _e('Lightbox Border Radius','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the lightbox item border radius in px','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="SMGP_itemBorderRadius"  name="params[SMGP_itemBorderRadius]" value="0" class="text">
                <span>px</span>
            </div>
        </div>
		
		
        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Slideshow','SMGL_TEXT_DOMAIN'); ?><img src="<?php echo $path_free_banner.'/Gallery_Pro.png'; ?>"
                              class="gallery_img_lightbox_pro_logo"></h3>
            <div class="has-background">
                <label for="slideShowAutoPlay"><?php _e('Slideshow Auto Start','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable the lightbox slideshow autoplay','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_slideShowAutoPlay]"/>
                <input type="checkbox" id="SMGP_slideShowAutoPlay" name="params[SMGP_slideShowAutoPlay]" value="yes"/>
            </div>
			<div>
                <label for="videoAutoPlay"><?php _e('Video Auto Play','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable video autoplay','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_videoAutoPlay]"/>
                <input type="checkbox" id="SMGP_videoAutoPlay"  name="params[SMGP_videoAutoPlay]" value="yes" checked="checked"/>
            </div>
			<div class="has-background">
                <label for="videoLoop"><?php _e('Video Loop','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e("Set the video play in loop (doesn't apply to youtube or vimeo).","SMGL_TEXT_DOMAIN"); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_videoLoop]"/>
                <input type="checkbox" id="SMGP_videoLoop"  name="params[SMGP_videoLoop]" value="yes"/>
            </div>
			<div>
                <label for="audioAutoPlay"><?php _e('Audio Auto Play','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable audio autoplay','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_audioAutoPlay]"/>
                <input type="checkbox" id="SMGP_audioAutoPlay"  name="params[SMGP_audioAutoPlay]" value="yes"/>
            </div>
			<div class="has-background">
                <label for="audioLoop"><?php _e('Audio Loop','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the audio play in loop or not','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_audioLoop]"/>
                <input type="checkbox" id="SMGP_audioLoop"  name="params[SMGP_audioLoop]" value="yes"/>
            </div>
            <div>
                <label for="slideShowDelay"><?php _e('Slideshow Interval','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the slideshow duration in seconds.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" name="params[SMGP_slideShowDelay]" id="SMGP_slideShowDelay" value="4" class="text">
                <span><?php _e('In seconds','SMGL_TEXT_DOMAIN'); ?></span>
            </div>
        </div>


        <div class="lightbox-options-block gallery_general_options_grey_overlay" >
            <h3><?php _e('Advanced Options','SMGL_TEXT_DOMAIN'); ?><img src="<?php echo $path_free_banner.'/Gallery_Pro.png'; ?>"
                                     class="gallery_img_lightbox_pro_logo"></h3>
			<div class="has-background">
                <label for="buttonsAlignment"><?php _e('Buttons Alignment','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e("Set to 'In' the buttons will be positioned near the image and set to 'Out' the buttons will be positioned at the right or left side of the screen","SMGL_TEXT_DOMAIN"); ?></p>
                        </div>
                    </div>
                </label>
                <select id="SMGP_buttonsAlignment" name="params[SMGP_buttonsAlignment]">
					<option value="in" selected><?php _e('In','SMGL_TEXT_DOMAIN'); ?></option>
                    <option value="out"><?php _e('Out','SMGL_TEXT_DOMAIN'); ?></option>
                </select>
            </div>						 
            <div>
                <label for="addKeyboardSupport"><?php _e('Keyboard navigation','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable the keyboard left and right arrows to navigate between lightbox items','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_addKeyboardSupport]"/>
                <input type="checkbox" id="SMGP_addKeyboardSupport"  name="params[SMGP_addKeyboardSupport]" value="yes" checked="checked"/>
            </div>
            <div class="has-background">
                <label for="showNextAndPrevButtons"><?php _e('Show Arrows','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the next and prev buttons','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showNextAndPrevButtons]"/>
                <input type="checkbox" id="SMGP_showNextAndPrevButtons"  name="params[SMGP_showNextAndPrevButtons]" value="yes" checked="checked"/>
            </div>
			<div>
                <label for="showNextAndPrevButtonsOnMobile"><?php _e('Show Arrows in Mobile','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the next and prev buttons on mobile','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showNextAndPrevButtonsOnMobile]"/>
                <input type="checkbox" id="SMGP_showNextAndPrevButtonsOnMobile"  name="params[SMGP_showNextAndPrevButtonsOnMobile]" value="yes" checked="checked"/>
            </div>
            <div class="has-background">
                <label for="showCloseButton"><?php _e('Show Close Button','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the close button','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showCloseButton]"/>
                <input type="checkbox" id="SMGP_showCloseButton"  name="params[SMGP_showCloseButton]" value="yes" checked="checked"/>
            </div>
            <div>
                <label for="showZoomButton"><?php _e('Show Zoom Button','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the image zoom in and out button','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showZoomButton]"/>
                <input type="checkbox" id="SMGP_showZoomButton"  name="params[SMGP_showZoomButton]" value="yes" checked="checked"/>
            </div>
            <div class="has-background">
                <label for="showSlideShowButton"><?php _e('Show Slideshow Button','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the slideshow button','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showSlideShowButton]"/>
                <input type="checkbox" id="SMGP_showSlideShowButton"  name="params[SMGP_showSlideShowButton]" value="yes" checked="checked"/>
            </div>
			<div>
                <label for="showDescriptionButton"><?php _e('Show Description Button','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the description button','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showDescriptionButton]"/>
                <input type="checkbox" id="SMGP_showDescriptionButton"  name="params[SMGP_showDescriptionButton]" value="yes" checked="checked"/>
            </div>
        </div>
		
		<div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Lightbox Description Window','SMGL_TEXT_DOMAIN'); ?><img src="<?php echo $path_free_banner.'/Gallery_Pro.png'; ?>"
                              class="gallery_img_lightbox_pro_logo"></h3>
							  
			<div class="has-background">
                <label for="descriptionWindowAnimationType"><?php _e('Animation Type','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the animation type of the description window when on show / hide','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <select id="SMGP_descriptionWindowAnimationType" name="params[SMGP_descriptionWindowAnimationType]">
					<option value="opacity" selected><?php _e('Opacity','SMGL_TEXT_DOMAIN'); ?></option>
					<option  value="motion"><?php _e('Motion','SMGL_TEXT_DOMAIN'); ?></option>
                </select>
            </div>
			<div>
                <label for="descriptionWindowPosition"><?php _e('Position','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the description window position inside the lightbox item.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <select id="SMGP_descriptionWindowPosition" name="params[SMGP_descriptionWindowPosition]">
					<option value="top"><?php _e('Top','SMGL_TEXT_DOMAIN'); ?></option>
					<option value="bottom" selected><?php _e('Bottom','SMGL_TEXT_DOMAIN'); ?></option>
                </select>
            </div>			
			<div class="has-background">
                <label for="descriptionWindowBackgroundColor"><?php _e('Background Color','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the background color of the description window','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" class="color" id="SMGP_descriptionWindowBackgroundColor"  name="params[SMGP_descriptionWindowBackgroundColor]" value="#FFFFFF" size="10"/>
            </div>
			<div>
                <label for="descriptionWindowBackgroundOpacity"><?php _e('Background Opacity','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the description window background opacity.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                 <input type="number" id="SMGP_descriptionWindowBackgroundOpacity"  name="params[SMGP_descriptionWindowBackgroundOpacity]" value="0.95" step="0.05" max="1" min="0.1" class="text">
            </div>
			<div class="has-background">
                <label for="descriptionWindowTextColor"><?php _e('Text Color','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the text color of the description window','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" class="color" id="SMGP_descriptionWindowTextColor"  name="params[SMGP_descriptionWindowTextColor]" value="#000000" size="10"/>
            </div>
			<div>
                <label for="showDescriptionByDefault"><?php _e('Description By Default','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Shows or not the description window by default','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showDescriptionByDefault]"/>
                <input type="checkbox" id="SMGP_showDescriptionByDefault"  name="params[SMGP_showDescriptionByDefault]" value="yes" checked/>
            </div>
        </div>

        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Button Styles','SMGL_TEXT_DOMAIN'); ?><img src="<?php echo $path_free_banner.'/Gallery_Pro.png'; ?>"
                               class="gallery_img_lightbox_pro_logo"></h3>
            <div class="has-background">
                <label for="buttonsHideDelay"><?php _e('Buttons Hide Delay','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the delay in seconds until the buttons will hide.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="SMGP_buttonsHideDelay"  name="params[SMGP_buttonsHideDelay]" value="3"  class="text">
            </div>
            <div>
                <label for="spaceBetweenButtons"><?php _e('Space Between Buttons','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the space between buttons in px.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="SMGP_spaceBetweenButtons"  name="params[SMGP_spaceBetweenButtons]" value="1" class="text">
				<span>px</span>
            </div>
            <div class="has-background">
                <label for="buttonsOffsetIn"><?php _e('Buttons OffsetIn','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the space between the buttons and the main lightbox item.</p>','SMGL_TEXT_DOMAIN'); ?>
                        </div>
                    </div>
                </label>
                <input type="number" id="SMGP_buttonsOffsetIn"  name="params[SMGP_buttonsOffsetIn]" value="2" class="text">
                <span>px</span>
            </div>
			<div>
                <label for="buttonsOffsetOut"><?php _e('Buttons OffsetOut','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the space between the buttons and window left or right side.','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="SMGP_buttonsOffsetOut"  name="params[SMGP_buttonsOffsetOut]" value="5" class="text">
                <span>px</span>
            </div>
        </div>
		
        <div class="lightbox-options-block gallery_general_options_grey_overlay" >
            <h3><?php _e('Social Share Buttons','SMGL_TEXT_DOMAIN'); ?><img src="<?php echo $path_free_banner.'/Gallery_Pro.png'; ?>"
                                         class="gallery_img_lightbox_pro_logo"></h3>
            <div class="has-background">
                <label for="showShareButton"><?php _e('Social Share Buttons','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the width of popup','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_showShareButton]"/>
                <input type="checkbox" id="SMGP_showShareButton"  name="params[SMGP_showShareButton]" value="yes" checked/>
            </div>
            <div class="social-buttons-list">
                <label><?php _e('Social Share Buttons List','SMGL_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the social share button','SMGL_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <div>
                    <table id="sub-lvl-filter">
                        <tr>
                            <td>
                                <label for="facebookShareButton"><?php _e('Facebook','SMGL_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[SMGP_facebookShareButton]"/>
									<input type="checkbox" id="SMGP_facebookShareButton"  name="params[SMGP_facebookShareButton]" value="yes" checked/>
                            </td>
                            <td>
                                <label for="twitterShareButton"><?php _e('Twitter','SMGL_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[SMGP_twitterShareButton]"/>
									<input type="checkbox" id="SMGP_facebookShareButton"  name="params[SMGP_twitterShareButton]" value="yes" checked/>
                            </td>
                            <td>
                                <label for="googleplusShareButton"><?php _e('Google Plus','SMGL_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[SMGP_googleplusShareButton]"/>
									<input type="checkbox" id="SMGP_googleplusShareButton"  name="params[SMGP_googleplusShareButton]" value="yes" checked/>
                            </td>
                            <td>
                                <label for="pinterestShareButton"><?php _e('Pinterest','SMGL_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[SMGP_pinterestShareButton]"/>
									<input type="checkbox" id="SMGP_pinterestShareButton"  name="params[SMGP_pinterestShareButton]" value="yes"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="linkedinShareButton"><?php _e('Linkedin','SMGL_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[SMGP_linkedinShareButton]"/>
									<input type="checkbox" id="SMGP_linkedinShareButton"  name="params[SMGP_linkedinShareButton]" value="yes"/>
                            </td>
                            <td>
                                <label for="gmailShareButton"><?php _e('Gmail','SMGL_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[SMGP_gmailShareButton]"/>
									<input type="checkbox" id="SMGP_gmailShareButton"  name="params[SMGP_gmailShareButton]"  value="yes"/>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                               
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="lightbox-options-list"
         class="unique-type-options-wrapper">
        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3 class="section_for_pro"><?php echo __( 'Menu Settings', 'SMGL_TEXT_DOMAIN' ); ?></h3>

            <div class="has-background">
                <label for="comboboxSelectorLabel"><?php echo __( 'Combobox Selector Label', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'If the menu is combobox set the selector label', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" name="params[SMGP_comboboxSelectorLabel]" id="SMGP_comboboxSelectorLabel"
                       value="SELECT GALLERIES" class="input-text">
            </div>
			
			<div>
                <label for="searchLabel"><?php echo __( 'Search Label', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set the search box label', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" name="params[SMGP_searchLabel]" id="SMGP_searchLabel"
                       value="Search" class="input-text">
            </div>
			
			<div class="has-background">
                <label for="searchNotFoundLabel"><?php echo __( 'Search Not Found Label', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set the text display when search item not found', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" name="params[SMGP_searchNotFoundLabel]" id="SMGP_searchNotFoundLabel"
                       value="NOTHING FOUND!" class="input-text">
            </div>

            <div class="not-fixed-size">
                <label for="menuMaxWidth"><?php echo __( 'Menu Max Width', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set maximum menu width.', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div></label>
                <input type="number" name="params[SMGP_menuMaxWidth]" id="SMGP_menuMaxWidth"
                       value="1200" class="text">
                <span>px</span>
            </div>
			
			<div class="has-background">
                <label for="menuOffsetTop"><?php echo __( 'Menu Offset Top', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set margin top for the menu buttons', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div></label>
                <input type="number" name="params[SMGP_menuOffsetTop]" id="SMGP_menuOffsetTop"
                       value="20" class="text">
                <span>px</span>
            </div>

            <div class="not-fixed-size">
                <label for="menuOffsetBottom"><?php echo __( 'Menu Offset Bottom', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set margin bottom for the menu buttons', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div></label>
                <input type="number" name="params[SMGP_menuOffsetBottom]" id="SMGP_menuOffsetBottom"
                       value="20" class="text">
                <span>px</span>
            </div>
        </div>
        <div class="lightbox-options-block gallery_general_options_grey_overlay" >
            <h3 class="section_for_pro" ><?php echo __( 'Thumbnail Effect Settings', 'SMGL_TEXT_DOMAIN' ); ?></h3>
            <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
            <div class="has-background">
                <label for="textAnimationType"><?php echo __( 'Text Animation Type', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Text animation type for Animtext effect', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[SMGP_textAnimationType]"  id="SMGP_textAnimationType" >
					<option 
                            value="opacity"><?php _e('Opacity','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="scale" selected><?php _e('Scale','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="scalerandom"><?php _e('Scalerandom','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="largescale"><?php _e('Largescale','SMGL_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
			<div>
                <label for="imageTransitionDirection"><?php echo __( 'Image Transition Direction', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'This option will work with curtain animation type', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[SMGP_imageTransitionDirection]" id="SMGP_imageTransitionDirection" >
					<option 
                            value="top" selected><?php _e('Top','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="right"><?php _e('Right','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="bottom"><?php _e('Bottom','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="left"><?php _e('Left','SMGL_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
            <div class="has-background">
                <label for="textVerticalAlign"><?php echo __( 'Media Effect Text Align', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Text vertical align', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[SMGP_mediatextAlign]"  id="SMGP_mediatextAlign" >
					<option 
                            value="top"><?php _e('Top','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="bottom" selected><?php _e('Bottom','SMGL_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
			<div>
                <label for="textVerticalAlign"><?php echo __( 'Media 2 Effect Text Align', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Text vertical align', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[SMGP_media2textAlign]"  id="SMGP_media2textAlign" >
					<option 
                            value="top" selected><?php _e('Top','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="bottom"><?php _e('Bottom','SMGL_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
        </div>
        <div class="lightbox-options-block gallery_general_options_grey_overlay"  >
            <h3 class="section_for_pro"><?php echo __( 'Mouse Settings', 'SMGL_TEXT_DOMAIN' ); ?></h3>
            <div>
                <label for="rightClickContextMenu"><?php echo __( 'Mouse Right Click', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set action of mouse right click over gallery content', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[SMGP_rightClickContextMenu]"  id="SMGP_rightClickContextMenu" >
					<option 
                            value="default" selected><?php _e('Default','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="disabled"><?php _e('Disabled','SMGL_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="developer"><?php _e('Developer','SMGL_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
        </div>
		<div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3 class="section_for_pro"><?php echo __( 'Infinite Grid Settings', 'SMGL_TEXT_DOMAIN' ); ?></h3>
			<div class="has-background">
                <label for="enableVisitedThumbnails"><?php echo __( 'Enable Visited Thumbnails', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'This way user can see which thumbnails content was viewed', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
				<input type="hidden" value="no" name="params[SMGP_enableVisitedThumbnails]"/>
                <input type="checkbox" id="SMGP_enableVisitedThumbnails"  name="params[SMGP_enableVisitedThumbnails]" value="yes"/>
            </div>
			<div>
                <label for="addZoomSupport"><?php echo __( 'Add Zoom Support', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Enable or disable gallery zoom on desktop machines and pinch & zoom on mobile devices', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
				<input type="hidden" value="no" name="params[SMGP_addZoomSupport]"/>
                <input type="checkbox" id="SMGP_addZoomSupport"  name="params[SMGP_addZoomSupport]" value="yes" checked/>
            </div>
			<div class="has-background">
                <label for="addDragAndSwipeSupport"><?php echo __( 'Drag & Swipe Support', 'SMGL_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Enable or disable drag and swipe for gallery', 'SMGL_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[SMGP_addDragAndSwipeSupport]"/>
                <input type="checkbox" id="SMGP_addDragAndSwipeSupport"  name="params[SMGP_addDragAndSwipeSupport]" value="yes" checked/>
            </div>
        </div>
    </div>
	<div id="pro-screenshot-list"
         class="unique-type-options-wrapper">
        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php echo __( 'Classic Grid Layout Settings', 'SMGL_TEXT_DOMAIN' ); ?></h3>

            <div class="has-background">
				<img src="<?php echo $path_free_banner.'/social-media-gallery-pro-classic.jpg'; ?>" class="pro-screenshot">
            </div>
        </div>
        <div class="lightbox-options-block gallery_general_options_grey_overlay" >
            <h3 class="section_for_pro" ><?php echo __( 'Infinite Grid Layout Settings', 'SMGL_TEXT_DOMAIN' ); ?></h3>
            <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
            <div class="has-background">
                <img src="<?php echo $path_free_banner.'/social-media-gallery-pro-infinite.jpg'; ?>" class="pro-screenshot">
            </div>
			
        </div>
    </div>
</form>
</div>