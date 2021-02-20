<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="free_version_banner">
    <img class="manual_icon" src="<?php echo SMGL_PLUGIN_URL; ?>admin-scripts/img/free-banner/plugin_logo.png" alt="user manual"/>
    <p class="usermanual_text"><?php _e('Social Media Gallery Pro', 'SMGL_TEXT_DOMAIN'); ?></p>
    <a class="get_full_version" href="https://www.webhuntinfotech.com/plugin/social-media-gallery-pro/" target="_blank">
        <?php _e('GO PRO', 'SMGL_TEXT_DOMAIN'); ?>
    </a>
    <p class="close_banner"><?php _e('Close for now', 'SMGL_TEXT_DOMAIN'); ?></p>
    <img class="closer_icon_only" alt="Close Icon" src="<?php echo SMGL_PLUGIN_URL; ?>admin-scripts/img/free-banner/close_btn.png"/>
    <a href="http://webhuntinfotech.com/" target="_blank"><img class="webhunt_info_logo" src="<?php echo SMGL_PLUGIN_URL; ?>admin-scripts/img/free-banner/webhunt_logo.png"/></a>
    <div class="mobile_icon_show hide">
        <a href="http://webhuntinfotech.com/" target="_blank">
			<img class="webhunt_info_logo_mobile" src="<?php echo SMGL_PLUGIN_URL; ?>admin-scripts/img/free-banner/logo_mobile_screen.png"/>
		</a>
    </div>
    <div style="clear: both;"></div>
    <div class="hg_social_link_buttons">
        <a target="_blank" class="fb" href="https://www.facebook.com/webhuntinfotech/">
			</a>
        <a target="_blank" class="twitter" href="https://twitter.com/webhuntinfotech">
			</a>
        <a target="_blank" class="gplus" href="https://plus.google.com/113004527388674132913"></a>
        <a target="_blank" class="yt" href="https://www.youtube.com/channel/UCnirdttXp-loxVV5ON_NhJA"></a>
    </div>
    <div class="hg_view_plugins_block">
        <ul class="inline_menu">
            <li>
                <a target="_blank" href="https://demo.webhuntinfotech.com/demo?theme=smg-pro">
                    <?php _e('Demo', 'SMGL_TEXT_DOMAIN'); ?>
                </a>
            </li>
            <li>
                <a target="_blank" href="https://wordpress.org/support/plugin/social-media-gallery/reviews/?filter=5">
                    <?php _e('Review', 'SMGL_TEXT_DOMAIN'); ?>
                </a>
            </li>
            <li class="help_element">

                <?php _e('Help', 'SMGL_TEXT_DOMAIN'); ?>
                </a>
                <ul class="submenu">
                    <li>
                        <a target="_blank" href="https://www.webhuntinfotech.com/contact-us/">
                            <?php _e('Contact Us', 'SMGL_TEXT_DOMAIN'); ?>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://wordpress.org/support/plugin/social-media-gallery">
                            <?php _e('Forum', 'SMGL_TEXT_DOMAIN'); ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="toggle_element">
                <a href="#">
                    <img class="toggle_icon"
                         src="<?php echo SMGL_PLUGIN_URL ?>admin-scripts/img/free-banner/toggle_icon.png"/>
                </a>
            </li>
        </ul>
        <div class="description_text">
            <p><?php _e('Click "GO PRO" to activate all additional customization options.', 'SMGL_TEXT_DOMAIN'); ?></p>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>