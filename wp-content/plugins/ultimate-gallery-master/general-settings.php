<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
wp_enqueue_style('general-settings-page-css', UGML_PLUGIN_URL.'css/general-settings-page.css');
wp_enqueue_style('free-banner-css', UGML_PLUGIN_URL.'css/free-banner.css');
		
$path_site = plugins_url("images/front_images", __FILE__);
$path_album = plugins_url("images/albums", __FILE__);
?>
<script>
jQuery(document).ready(function () {
	
    jQuery('#new-lightbox-options-list').addClass('active');
	jQuery('#lightbox_type input#lightbox').prop('checked', true);
	  
    jQuery('#lightbox_type input').change(function () {
        jQuery('#lightbox_type input').parent().removeClass('active');
        jQuery(this).parent().addClass('active');
        if (jQuery(this).val() == 'other') {
            jQuery('#lightbox-options-list').addClass('active');
            jQuery('#new-lightbox-options-list').removeClass('active');
        }
        else {
            jQuery('#lightbox-options-list').removeClass('active');
            jQuery('#new-lightbox-options-list').addClass('active');
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
		
});
</script>
<div class="wrap">
    <?php require('free-banner.php'); ?>
    <p class="pro_info">
        <?php echo __('These features are available in the Professional version of the plugin only.', 'UGML_TEXT_DOMAIN'); ?>
        <a href="https://www.webhuntinfotech.com/plugin/ultimate-gallery-master-pro/" target="_blank"
           class="button button-primary"><?php echo __('Enable', 'UGML_TEXT_DOMAIN'); ?></a>
    </p>
    <div id="post-body-heading">
    <h3 class="gen-option-title"><?php echo __( 'General Options', 'UGML_TEXT_DOMAIN' ); ?></h3>
	<a href="#" class="save-gallery-options button-primary"><?php echo __( 'Reset All', 'UGML_TEXT_DOMAIN' ); ?></a>
    <a href="#" class="save-gallery-options button-primary" id="save"><?php echo __( 'Save', 'UGML_TEXT_DOMAIN' ); ?></a>
</div>
<form action="" method="post" id="adminForm"
      name="adminForm">

    <ul id="lightbox_type" >
		<li class="active">
			<label for="lightbox"><?php _e('Lightbox Settings','UGML_TEXT_DOMAIN'); ?></label>
			<input type="checkbox" name="params[UGMP_generalOptionType]"
				   id="lightbox" value="lightbox" checked>
		</li>
		<li class="">
			<label for="other"><?php _e('Other Settings','UGML_TEXT_DOMAIN'); ?></label>
			<input type="checkbox" name="params[UGMP_generalOptionType]"
				   id="other" value="other">
		</li>
    </ul>

    <div id="new-lightbox-options-list"
         class="unique-type-options-wrapper active">
        <div class=""></div>
        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Lightbox Styles','UGML_TEXT_DOMAIN'); ?><img src="<?php echo UGML_PLUGIN_URL.'images/Gallery_Pro.png'; ?>"
                              class="gallery_img_lightbox_pro_logo"></h3>
							  
			<div class="has-background">
                <label for="lightboxSkinPath"><?php _e('Lightbox Style','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Choose the style of your lightbox','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <select name="params[UGMP_lightboxSkinPath]" id="UGMP_lightboxSkinPath">
					<option value="classic" selected><?php _e('Classic','UGML_TEXT_DOMAIN'); ?></option>
                    <option value="modern"><?php _e('Modern','UGML_TEXT_DOMAIN'); ?></option>
                </select>
            </div>
			<div>
                <label for="itemOffsetHeight"><?php _e('Lightbox Offset Margin','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the margin from top and bottom for the lightbox in pixels.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" name="params[UGMP_itemOffsetHeight]"
                       id="UGMP_itemOffsetHeight"
                       value="50"
                       class="text">
                <span>px</span>
            </div>
			<div class="has-background">
                <label for="lightBoxBackgroundColor"><?php _e('Background Color','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Choose the lightbox main background color','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" class="jscolor {hash:true} color" id="UGMP_lightBoxBackgroundColor" name="params[UGMP_lightBoxBackgroundColor]" value="#000000" size="10"/>
            </div>
			<div>
                <label for="backgroundOpacity"><?php _e('Background Opacity','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the lightbox main background opacity.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                 <input type="number" id="UGMP_backgroundOpacity"  name="params[UGMP_backgroundOpacity]"  value="0.9" step="0.1" max="1" min="0.1"
                       class="text">
            </div>
			<div class="has-background">
                <label for="itemBorderColor"><?php _e('Border Color','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Choose the lightbox item border color','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" class="jscolor {hash:true} color" id="UGMP_itemBorderColor" name="params[UGMP_itemBorderColor]" value="#333333" size="10"/>
            </div>
			<div class="has-background">
                <label for="itemBorderSize"><?php _e('Lightbox Border Size','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the lightbox item border size in px','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="UGMP_itemBorderSize"  name="params[UGMP_itemBorderSize]" value="0" class="text">
                <span>px</span>
            </div>
			<div>
                <label for="itemBorderRadius"><?php _e('Lightbox Border Radius','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the lightbox item border radius in px','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="UGMP_itemBorderRadius"  name="params[UGMP_itemBorderRadius]" value="0" class="text">
                <span>px</span>
            </div>
        </div>
		
		
        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Slideshow','UGML_TEXT_DOMAIN'); ?><img src="<?php echo UGML_PLUGIN_URL.'images/Gallery_Pro.png'; ?>"
                              class="gallery_img_lightbox_pro_logo"></h3>
            <div class="has-background">
                <label for="slideShowAutoPlay"><?php _e('Slideshow Auto Start','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable the lightbox slideshow autoplay','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_slideShowAutoPlay]"/>
                <input type="checkbox" id="UGMP_slideShowAutoPlay" name="params[UGMP_slideShowAutoPlay]" value="yes"/>
            </div>
			<div>
                <label for="videoAutoPlay"><?php _e('Video Auto Play','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable video autoplay','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_videoAutoPlay]"/>
                <input type="checkbox" id="UGMP_videoAutoPlay"  name="params[UGMP_videoAutoPlay]" value="yes" checked="checked"/>
            </div>
			<div class="has-background">
                <label for="videoLoop"><?php _e('Video Loop','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e("Set the video play in loop (doesn't apply to youtube or vimeo).","UGML_TEXT_DOMAIN"); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_videoLoop]"/>
                <input type="checkbox" id="UGMP_videoLoop"  name="params[UGMP_videoLoop]" value="yes"/>
            </div>
			<div>
                <label for="audioAutoPlay"><?php _e('Audio Auto Play','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable audio autoplay','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_audioAutoPlay]"/>
                <input type="checkbox" id="UGMP_audioAutoPlay"  name="params[UGMP_audioAutoPlay]" value="yes"/>
            </div>
			<div class="has-background">
                <label for="audioLoop"><?php _e('Audio Loop','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the audio play in loop or not','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_audioLoop]"/>
                <input type="checkbox" id="UGMP_audioLoop"  name="params[UGMP_audioLoop]" value="yes"/>
            </div>
            <div>
                <label for="slideShowDelay"><?php _e('Slideshow Interval','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the slideshow duration in seconds.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" name="params[UGMP_slideShowDelay]" id="UGMP_slideShowDelay" value="4" class="text">
                <span><?php _e('In seconds','UGML_TEXT_DOMAIN'); ?></span>
            </div>
        </div>


        <div class="lightbox-options-block gallery_general_options_grey_overlay" >
            <h3><?php _e('Advanced Options','UGML_TEXT_DOMAIN'); ?><img src="<?php echo UGML_PLUGIN_URL.'images/Gallery_Pro.png'; ?>"
                                     class="gallery_img_lightbox_pro_logo"></h3>
			<div class="has-background">
                <label for="buttonsAlignment"><?php _e('Buttons Alignment','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e("Set to 'In' the buttons will be positioned near the image and set to 'Out' the buttons will be positioned at the right or left side of the screen","UGML_TEXT_DOMAIN"); ?></p>
                        </div>
                    </div>
                </label>
                <select id="UGMP_buttonsAlignment" name="params[UGMP_buttonsAlignment]">
					<option value="in" selected><?php _e('In','UGML_TEXT_DOMAIN'); ?></option>
                    <option value="out"><?php _e('Out','UGML_TEXT_DOMAIN'); ?></option>
                </select>
            </div>						 
            <div>
                <label for="addKeyboardSupport"><?php _e('Keyboard navigation','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Enable or disable the keyboard left and right arrows to navigate between lightbox items','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_addKeyboardSupport]"/>
                <input type="checkbox" id="UGMP_addKeyboardSupport"  name="params[UGMP_addKeyboardSupport]" value="yes" checked="checked"/>
            </div>
            <div class="has-background">
                <label for="showNextAndPrevButtons"><?php _e('Show Arrows','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the next and prev buttons','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showNextAndPrevButtons]"/>
                <input type="checkbox" id="UGMP_showNextAndPrevButtons"  name="params[UGMP_showNextAndPrevButtons]" value="yes" checked="checked"/>
            </div>
			<div>
                <label for="showNextAndPrevButtonsOnMobile"><?php _e('Show Arrows in Mobile','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the next and prev buttons on mobile','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showNextAndPrevButtonsOnMobile]"/>
                <input type="checkbox" id="UGMP_showNextAndPrevButtonsOnMobile"  name="params[UGMP_showNextAndPrevButtonsOnMobile]" value="yes" checked="checked"/>
            </div>
            <div class="has-background">
                <label for="showCloseButton"><?php _e('Show Close Button','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the close button','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showCloseButton]"/>
                <input type="checkbox" id="UGMP_showCloseButton"  name="params[UGMP_showCloseButton]" value="yes" checked="checked"/>
            </div>
            <div>
                <label for="showZoomButton"><?php _e('Show Zoom Button','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the image zoom in and out button','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showZoomButton]"/>
                <input type="checkbox" id="UGMP_showZoomButton"  name="params[UGMP_showZoomButton]" value="yes" checked="checked"/>
            </div>
            <div class="has-background">
                <label for="showSlideShowButton"><?php _e('Show Slideshow Button','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the slideshow button','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showSlideShowButton]"/>
                <input type="checkbox" id="UGMP_showSlideShowButton"  name="params[UGMP_showSlideShowButton]" value="yes" checked="checked"/>
            </div>
			<div>
                <label for="showDescriptionButton"><?php _e('Show Description Button','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the description button','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showDescriptionButton]"/>
                <input type="checkbox" id="UGMP_showDescriptionButton"  name="params[UGMP_showDescriptionButton]" value="yes" checked="checked"/>
            </div>
        </div>
		
		<div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Lightbox Description Window','UGML_TEXT_DOMAIN'); ?><img src="<?php echo UGML_PLUGIN_URL.'images/Gallery_Pro.png'; ?>"
                              class="gallery_img_lightbox_pro_logo"></h3>
							  
			<div class="has-background">
                <label for="descriptionWindowAnimationType"><?php _e('Animation Type','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the animation type of the description window when on show / hide','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <select id="UGMP_descriptionWindowAnimationType" name="params[UGMP_descriptionWindowAnimationType]">
					<option value="opacity" selected><?php _e('Opacity','UGML_TEXT_DOMAIN'); ?></option>
					<option  value="motion"><?php _e('Motion','UGML_TEXT_DOMAIN'); ?></option>
                </select>
            </div>
			<div>
                <label for="descriptionWindowPosition"><?php _e('Position','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the description window position inside the lightbox item.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <select id="UGMP_descriptionWindowPosition" name="params[UGMP_descriptionWindowPosition]">
					<option value="top"><?php _e('Top','UGML_TEXT_DOMAIN'); ?></option>
					<option value="bottom" selected><?php _e('Bottom','UGML_TEXT_DOMAIN'); ?></option>
                </select>
            </div>			
			<div class="has-background">
                <label for="descriptionWindowBackgroundColor"><?php _e('Background Color','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the background color of the description window','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" class="color" id="UGMP_descriptionWindowBackgroundColor"  name="params[UGMP_descriptionWindowBackgroundColor]" value="#FFFFFF" size="10"/>
            </div>
			<div>
                <label for="descriptionWindowBackgroundOpacity"><?php _e('Background Opacity','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the description window background opacity.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                 <input type="number" id="UGMP_descriptionWindowBackgroundOpacity"  name="params[UGMP_descriptionWindowBackgroundOpacity]" value="0.95" step="0.05" max="1" min="0.1" class="text">
            </div>
			<div class="has-background">
                <label for="showDescriptionByDefault"><?php _e('Description By Default','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Shows or not the description window by default','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showDescriptionByDefault]"/>
                <input type="checkbox" id="UGMP_showDescriptionByDefault"  name="params[UGMP_showDescriptionByDefault]" value="yes" checked/>
            </div>
        </div>

        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php _e('Button Styles','UGML_TEXT_DOMAIN'); ?><img src="<?php echo UGML_PLUGIN_URL.'images/Gallery_Pro.png'; ?>"
                               class="gallery_img_lightbox_pro_logo"></h3>
            <div class="has-background">
                <label for="buttonsHideDelay"><?php _e('Buttons Hide Delay','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the delay in seconds until the buttons will hide.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="UGMP_buttonsHideDelay"  name="params[UGMP_buttonsHideDelay]" value="3"  class="text">
            </div>
            <div>
                <label for="spaceBetweenButtons"><?php _e('Space Between Buttons','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the space between buttons in px.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="UGMP_spaceBetweenButtons"  name="params[UGMP_spaceBetweenButtons]" value="1" class="text">
				<span>px</span>
            </div>
            <div class="has-background">
                <label for="buttonsOffsetIn"><?php _e('Buttons OffsetIn','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the space between the buttons and the main lightbox item.</p>','UGML_TEXT_DOMAIN'); ?>
                        </div>
                    </div>
                </label>
                <input type="number" id="UGMP_buttonsOffsetIn"  name="params[UGMP_buttonsOffsetIn]" value="2" class="text">
                <span>px</span>
            </div>
			<div>
                <label for="buttonsOffsetOut"><?php _e('Buttons OffsetOut','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the space between the buttons and window left or right side.','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="number" id="UGMP_buttonsOffsetOut"  name="params[UGMP_buttonsOffsetOut]" value="5" class="text">
                <span>px</span>
            </div>
        </div>
		
        <div class="lightbox-options-block gallery_general_options_grey_overlay" >
            <h3><?php _e('Social Share Buttons','UGML_TEXT_DOMAIN'); ?><img src="<?php echo UGML_PLUGIN_URL.'images/Gallery_Pro.png'; ?>"
                                         class="gallery_img_lightbox_pro_logo"></h3>
            <div class="has-background">
                <label for="showShareButton"><?php _e('Social Share Buttons','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Set the width of popup','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_showShareButton]"/>
                <input type="checkbox" id="UGMP_showShareButton"  name="params[UGMP_showShareButton]" value="yes" checked/>
            </div>
            <div class="social-buttons-list">
                <label><?php _e('Social Share Buttons List','UGML_TEXT_DOMAIN'); ?>
                    <div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php _e('Hide or show the social share button','UGML_TEXT_DOMAIN'); ?></p>
                        </div>
                    </div>
                </label>
                <div>
                    <table id="sub-lvl-filter">
                        <tr>
                            <td>
                                <label for="facebookShareButton"><?php _e('Facebook','UGML_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[UGMP_facebookShareButton]"/>
									<input type="checkbox" id="UGMP_facebookShareButton"  name="params[UGMP_facebookShareButton]" value="yes" checked/>
                            </td>
                            <td>
                                <label for="twitterShareButton"><?php _e('Twitter','UGML_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[UGMP_twitterShareButton]"/>
									<input type="checkbox" id="UGMP_facebookShareButton"  name="params[UGMP_twitterShareButton]" value="yes" checked/>
                            </td>
                            <td>
                                <label for="googleplusShareButton"><?php _e('Google Plus','UGML_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[UGMP_googleplusShareButton]"/>
									<input type="checkbox" id="UGMP_googleplusShareButton"  name="params[UGMP_googleplusShareButton]" value="yes" checked/>
                            </td>
                            <td>
                                <label for="pinterestShareButton"><?php _e('Pinterest','UGML_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[UGMP_pinterestShareButton]"/>
									<input type="checkbox" id="UGMP_pinterestShareButton"  name="params[UGMP_pinterestShareButton]" value="yes"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="linkedinShareButton"><?php _e('Linkedin','UGML_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[UGMP_linkedinShareButton]"/>
									<input type="checkbox" id="UGMP_linkedinShareButton"  name="params[UGMP_linkedinShareButton]" value="yes"/>
                            </td>
                            <td>
                                <label for="gmailShareButton"><?php _e('Gmail','UGML_TEXT_DOMAIN'); ?>
                                    <input type="hidden" value="no" name="params[UGMP_gmailShareButton]"/>
									<input type="checkbox" id="UGMP_gmailShareButton"  name="params[UGMP_gmailShareButton]"  value="yes"/>
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
         class="unique-type-options-wrapper <?php if ( $ugmp_general_settings['UGMP_generalOptionType'] == 'other' ) {
             echo "active";
         } ?>">
        <div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3><?php echo __( 'Menu Settings', 'UGML_TEXT_DOMAIN' ); ?></h3>

            <div class="has-background">
                <label for="comboboxSelectorLabel"><?php echo __( 'Combobox Selector Label', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'If the menu is combobox set the selector label', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" name="params[UGMP_comboboxSelectorLabel]" id="UGMP_comboboxSelectorLabel"
                       value="SELECT GALLERIES" class="input-text">
            </div>
			
			<div>
                <label for="searchLabel"><?php echo __( 'Search Label', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set the search box label', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" name="params[UGMP_searchLabel]" id="UGMP_searchLabel"
                       value="Search" class="input-text">
            </div>
			
			<div class="has-background">
                <label for="searchNotFoundLabel"><?php echo __( 'Search Not Found Label', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set the text display when search item not found', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="text" name="params[UGMP_searchNotFoundLabel]" id="UGMP_searchNotFoundLabel"
                       value="NOTHING FOUND!" class="input-text">
            </div>

            <div class="not-fixed-size">
                <label for="menuMaxWidth"><?php echo __( 'Menu Max Width', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set maximum menu width.', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div></label>
                <input type="number" name="params[UGMP_menuMaxWidth]" id="UGMP_menuMaxWidth"
                       value="1200" class="text">
                <span>px</span>
            </div>
			
			<div class="has-background">
                <label for="menuOffsetTop"><?php echo __( 'Menu Offset Top', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set margin top for the menu buttons', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div></label>
                <input type="number" name="params[UGMP_menuOffsetTop]" id="UGMP_menuOffsetTop"
                       value="20" class="text">
                <span>px</span>
            </div>

            <div class="not-fixed-size">
                <label for="menuOffsetBottom"><?php echo __( 'Menu Offset Bottom', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set margin bottom for the menu buttons', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div></label>
                <input type="number" name="params[UGMP_menuOffsetBottom]" id="UGMP_menuOffsetBottom"
                       value="20" class="text">
                <span>px</span>
            </div>
        </div>
        <div class="lightbox-options-block gallery_general_options_grey_overlay" >
            <h3 class="section_for_pro" ><?php echo __( 'Thumbnail Effect Settings', 'UGML_TEXT_DOMAIN' ); ?></h3>
            <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
            <div class="has-background">
                <label for="textAnimationType"><?php echo __( 'Text Animation Type', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Text animation type for Animtext effect', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[UGMP_textAnimationType]"  id="UGMP_textAnimationType" >
					<option 
                            value="opacity"><?php _e('Opacity','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="scale" selected><?php _e('Scale','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="scalerandom"><?php _e('Scalerandom','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="largescale"><?php _e('Largescale','UGML_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
            <div>
                <label for="textVerticalAlign"><?php echo __( 'Media Effect Text Align', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Text vertical align', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[UGMP_mediatextAlign]"  id="UGMP_mediatextAlign" >
					<option 
                            value="top"><?php _e('Top','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="bottom" selected><?php _e('Bottom','UGML_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
			<div class="has-background">
                <label for="textVerticalAlign"><?php echo __( 'Media 2 Effect Text Align', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Text vertical align', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[UGMP_media2textAlign]"  id="UGMP_media2textAlign" >
					<option 
                            value="top" selected><?php _e('Top','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="bottom"><?php _e('Bottom','UGML_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
			<div>
                <label for="imageTransitionDirection"><?php echo __( 'Image Transition Direction', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'This option will work with curtain animation type', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[UGMP_imageTransitionDirection]" id="UGMP_imageTransitionDirection" >
					<option 
                            value="top" selected><?php _e('Top','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="right"><?php _e('Right','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="bottom"><?php _e('Bottom','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="left"><?php _e('Left','UGML_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
        </div>
        <div class="lightbox-options-block gallery_general_options_grey_overlay"  >
            <h3 class="section_for_pro"><?php echo __( 'Mouse Settings', 'UGML_TEXT_DOMAIN' ); ?></h3>
            <div>
                <label for="rightClickContextMenu"><?php echo __( 'Mouse Right Click', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Set action of mouse right click over gallery content', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
				</label>
                <select name="params[UGMP_rightClickContextMenu]"  id="UGMP_rightClickContextMenu" >
					<option 
                            value="default" selected><?php _e('Default','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="disabled"><?php _e('Disabled','UGML_TEXT_DOMAIN'); ?>
                    </option>
					<option 
                            value="developer"><?php _e('Developer','UGML_TEXT_DOMAIN'); ?>
                    </option>
                </select>
            </div>
        </div>
		<div class="lightbox-options-block gallery_general_options_grey_overlay">
            <h3 class="section_for_pro"><?php echo __( 'Infinite Grid Settings', 'UGML_TEXT_DOMAIN' ); ?></h3>
			<div class="has-background">
                <label for="enableVisitedThumbnails"><?php echo __( 'Enable Visited Thumbnails', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'This way user can see which thumbnails content was viewed', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
				<input type="hidden" value="no" name="params[UGMP_enableVisitedThumbnails]"/>
                <input type="checkbox" id="UGMP_enableVisitedThumbnails"  name="params[UGMP_enableVisitedThumbnails]" value="yes"/>
            </div>
			<div>
                <label for="addZoomSupport"><?php echo __( 'Add Zoom Support', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Enable or disable gallery zoom on desktop machines and pinch & zoom on mobile devices', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
				<input type="hidden" value="no" name="params[UGMP_addZoomSupport]"/>
                <input type="checkbox" id="UGMP_addZoomSupport"  name="params[UGMP_addZoomSupport]" value="yes" checked/>
            </div>
			<div class="has-background">
                <label for="addDragAndSwipeSupport"><?php echo __( 'Drag & Swipe Support', 'UGML_TEXT_DOMAIN' ); ?><div class="help">?
                        <div class="help-block">
                            <span class="pnt"></span>
                            <p><?php echo __( 'Enable or disable drag and swipe for gallery', 'UGML_TEXT_DOMAIN' ); ?></p>
                        </div>
                    </div>
                </label>
                <input type="hidden" value="no" name="params[UGMP_addDragAndSwipeSupport]"/>
                <input type="checkbox" id="UGMP_addDragAndSwipeSupport"  name="params[UGMP_addDragAndSwipeSupport]" value="yes" checked/>
            </div>
        </div>
    </div>
</form>
</div>