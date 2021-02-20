<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
} 

/**
 * Load Saved Gallery Pro Settings
 */
$PostId = $post->ID;
$PVGM_Gallery_Settings = pvgm_get_gallery_value($PostId);
if($PVGM_Gallery_Settings['PVGM_Show_Gallery_Title'] && $PVGM_Gallery_Settings['PVGM_Color'] ) {
	$PVGM_Effect				= esc_attr( $PVGM_Gallery_Settings['PVGM_Effect'] );
	$PVGM_Color 				= esc_attr( $PVGM_Gallery_Settings['PVGM_Color'] );
	$PVGM_Label_Bg_Color 		= esc_attr( $PVGM_Gallery_Settings['PVGM_Label_Bg_Color'] );
	$PVGM_Label_Text_Color 		= esc_attr( $PVGM_Gallery_Settings['PVGM_Label_Text_Color'] );
	$PVGM_Descp_Text_Color 		= esc_attr( $PVGM_Gallery_Settings['PVGM_Descp_Text_Color'] );
	$PVGM_Button_Bg_Color 		= esc_attr( $PVGM_Gallery_Settings['PVGM_Button_Bg_Color'] );
	$PVGM_Button_Text_Color 	= esc_attr( $PVGM_Gallery_Settings['PVGM_Button_Text_Color'] );
	$PVGM_Show_Gallery_Title	= esc_attr( $PVGM_Gallery_Settings['PVGM_Show_Gallery_Title'] );
	$PVGM_Show_Image_Label		= esc_attr( $PVGM_Gallery_Settings['PVGM_Show_Image_Label'] );
	$PVGM_Show_Image_Descp		= esc_attr( $PVGM_Gallery_Settings['PVGM_Show_Image_Descp'] );
	$PVGM_Show_Image_Button		= esc_attr( $PVGM_Gallery_Settings['PVGM_Show_Image_Button'] );
	$PVGM_Button_Radious		= esc_html( $PVGM_Gallery_Settings['PVGM_Button_Radious'] );
	$PVGM_Button_Text			= esc_html( $PVGM_Gallery_Settings['PVGM_Button_Text'] );
	$PVGM_Gallery_Layout		= esc_attr( $PVGM_Gallery_Settings['PVGM_Gallery_Layout'] );
	$PVGM_Open_Link        		= esc_attr( $PVGM_Gallery_Settings['PVGM_Open_Link'] );
	$PVGM_Font_Style			= esc_attr( $PVGM_Gallery_Settings['PVGM_Font_Style'] );
	$PVGM_Lable_Font_Size		= esc_attr( $PVGM_Gallery_Settings['PVGM_Lable_Font_Size']);
	$PVGM_tlineheight			= esc_attr( $PVGM_Gallery_Settings['PVGM_tlineheight']);
	$PVGM_Desc_Font_Size		= esc_attr( $PVGM_Gallery_Settings['PVGM_Desc_Font_Size']);
	$PVGM_Light_Box				= esc_attr( $PVGM_Gallery_Settings['PVGM_Light_Box'] );
	$PVGM_Image_Border			= esc_attr( $PVGM_Gallery_Settings['PVGM_Image_Border'] );
	$PVGM_Custom_CSS			= wp_filter_nohtml_kses( $PVGM_Gallery_Settings['PVGM_Custom_CSS'] );
}
?>
<script>
jQuery(document).ready(function(){
	PVGM_ReadButtonClick();
});
function PVGM_ReadButtonClick() {
	if (jQuery('#PVGM_Show_Image_Button1').is(":checked")) {
	  jQuery('.buttontext').show();
	} else {
		jQuery('.buttontext').hide();
	}
}
</script>

<input type="hidden" id="wl_action" name="wl_action" value="wl-save-settings">

<div class="smart-wrap">
	<div class="smart-forms smart-container wrap-1">

    	<div class="form-header header-primary">
        	<h4><?php _e('Product by WebHunt Infotech','PVGM_TEXT_DOMAIN'); ?></h4>
        </div><!-- end .form-header section -->

        <form method="post" action="" id="form-ui">
        	<div class="form-body">

                <div class="spacer-b30">
                	<div class="tagline"><span><?php _e('Display & Layout Options','PVGM_TEXT_DOMAIN'); ?></span></div><!-- .tagline -->
                </div>

				<div class="frm-row"><!-- Transition Effect -->
                	<label class="field-label colm colm3 align-right"><?php _e('Transition Effect','PVGM_TEXT_DOMAIN'); ?>:</label>
                    <div class="section colm colm6">
                        <label class="field select">
                            <select name="PVGM_Effect" id="PVGM_Effect">
                               <optgroup label="Select Effect">
									<option value="fifth" <?php if($PVGM_Effect == 'fifth') echo "selected=selected"; ?>><?php _e('Effect 1','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="third" <?php if($PVGM_Effect == 'third') echo "selected=selected"; ?>><?php _e('Effect 2','PVGM_TEXT_DOMAIN'); ?></option>
									<option disabled ><?php _e('Effect 3 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Effect 4 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Effect 5 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Effect 6 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Effect 7 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Effect 8 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Effect 9 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Effect 10 (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
								 </optgroup>
                            </select>
                            <i class="arrow double"></i>
                        </label>
                    </div>
                </div><!-- end of "Transition Effect" section -->
				
				
				<div class="frm-row"><!-- Gallery Layout -->
                	<label class="field-label colm colm3 align-right"><?php _e('Gallery Layout','PVGM_TEXT_DOMAIN'); ?>:</label>
                    <div class="section colm colm6">
                        <label class="field select">
                            <select name="PVGM_Gallery_Layout" id="PVGM_Gallery_Layout">
                                <optgroup label="Select Gallery Layout">
									<option value="col-md-6" <?php if($PVGM_Gallery_Layout == 'col-md-6') echo "selected=selected"; ?>><?php _e('Two Column','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Three Column (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Four Column (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
								</optgroup>
                            </select>
                            <i class="arrow double"></i>
                        </label>
                    </div>
                </div><!-- end of "Gallery Layout" section -->
				
				<div class="frm-row"><!-- Open External Link -->
                	<label class="field-label colm colm3 align-right"><?php _e('Open External Link','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Open_Link" id="PVGM_Open_Link" value="_self" <?php if($PVGM_Open_Link == '_self' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('In Same Tab','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Open_Link" id="PVGM_Open_Link" value="_blank" <?php if($PVGM_Open_Link == '_blank' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('In New Tab','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Open External Link" section -->
				
				<div class="spacer-b10">&nbsp;</div>
                <div class="spacer-t20 spacer-b40">
                	<div class="tagline"><span> <?php _e('Color Options','PVGM_TEXT_DOMAIN'); ?> </span></div>
                </div>

				<div class="frm-row"><!-- Image Hover Color -->
                	<label class="field-label colm colm3 align-right"><?php _e('Image Hover Color','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Color" value="#31A3DD" <?php if($PVGM_Color == '#31A3DD' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('Sky Blue','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Color" value="#1A78A8" <?php if($PVGM_Color == '#1A78A8' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('Blue','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Color" value="#de4c28" <?php if($PVGM_Color == '#de4c28' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('Red','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Color" value="#000000" <?php if($PVGM_Color == '#000000' ) { echo "checked"; } ?>>
								<span class="radio"></span>  <?php _e('Black','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- end of "Image Hover Color" section -->

				<div class="frm-row"><!-- Label Background Color -->
                	<label class="field-label colm colm3 align-right"><?php _e('Label Bg Color','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Label_Bg_Color" id="PVGM_Label_Bg_Color1" value="#ffffff" <?php if($PVGM_Label_Bg_Color == '#ffffff' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('White','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Label_Bg_Color" id="PVGM_Label_Bg_Color2" value="#000000" <?php if($PVGM_Label_Bg_Color == '#000000' ) { echo "checked"; } ?>>
								<span class="radio"></span>  <?php _e('Black','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Label Background Color" section -->


				 <div class="frm-row"><!-- Label Text Color -->
                	<label class="field-label colm colm3 align-right"><?php _e('Label Text Color','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Label_Text_Color" id="PVGM_Label_Text_Color1" value="#ffffff" <?php if($PVGM_Label_Text_Color == '#ffffff' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('White','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Label_Text_Color" id="PVGM_Label_Text_Color2" value="#000000" <?php if($PVGM_Label_Text_Color == '#000000' ) { echo "checked"; } ?>>
								<span class="radio"></span>  <?php _e('Black','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Label Text Color" section -->


				<div class="frm-row"><!-- Description Color -->
                	<label class="field-label colm colm3 align-right"><?php _e('Description Color','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Descp_Text_Color" id="PVGM_Descp_Text_Color1" value="#ffffff" <?php if($PVGM_Descp_Text_Color == '#ffffff' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('White','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Descp_Text_Color" id="PVGM_Descp_Text_Color2" value="#000000" <?php if($PVGM_Descp_Text_Color == '#000000' ) { echo "checked"; } ?>>
								<span class="radio"></span>  <?php _e('Black','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Description Color" section -->
				 
				<div class="frm-row"><!-- Button Background Color -->
                	<label class="field-label colm colm3 align-right"><?php _e('Button Bg Color','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Button_Bg_Color" id="PVGM_Button_Bg_Color" value="#ffffff" <?php if($PVGM_Button_Bg_Color == '#ffffff' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('White','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Button_Bg_Color" id="PVGM_Button_Bg_Color" value="#000000" <?php if($PVGM_Button_Bg_Color == '#000000' ) { echo "checked"; } ?>>
								<span class="radio"></span>  <?php _e('Black','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				</div><!-- End of "Button Background Color" section -->

				<div class="frm-row"><!-- Button Text Color -->
                	<label class="field-label colm colm3 align-right"><?php _e('Button Text Color','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Button_Text_Color" id="PVGM_Button_Text_Color" value="#ffffff" <?php if($PVGM_Button_Text_Color == '#ffffff' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('White','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Button_Text_Color" id="PVGM_Button_Text_Color" value="#000000" <?php if($PVGM_Button_Text_Color == '#000000' ) { echo "checked"; } ?>>
								<span class="radio"></span>  <?php _e('Black','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				</div><!-- End of "Button Text Color" section -->	
				 
				<div class="spacer-b10">&nbsp;</div>
                <div class="spacer-t20 spacer-b40">
                	<div class="tagline"><span> <?php _e('Hide/Show Options','PVGM_TEXT_DOMAIN'); ?> </span></div>
                </div>

				<div class="frm-row"><!-- Show Gallery Title -->
                	<label class="field-label colm colm3 align-right"><?php _e('Show Gallery Title','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Show_Gallery_Title" id="PVGM_Show_Gallery_Title1" value="yes" <?php if($PVGM_Show_Gallery_Title == 'yes' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('Yes','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Show_Gallery_Title" id="PVGM_Show_Gallery_Title2" value="no" <?php if($PVGM_Show_Gallery_Title == 'no' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('No','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Show Gallery Title" section -->

				<div class="frm-row"><!-- Show Image Label -->
                	<label class="field-label colm colm3 align-right"><?php _e('Show Image Label','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Show_Image_Label" id="PVGM_Show_Image_Label1" value="yes" <?php if($PVGM_Show_Image_Label == 'yes' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('Yes','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Show_Image_Label" id="PVGM_Show_Image_Label2" value="no" <?php if($PVGM_Show_Image_Label == 'no' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('No','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Show Image Label" section -->

				<div class="frm-row"><!-- Show Description -->
                	<label class="field-label colm colm3 align-right"><?php _e('Show Description','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Show_Image_Descp" id="PVGM_Show_Image_Descp1" value="yes" <?php if($PVGM_Show_Image_Descp == 'yes' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('Yes','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Show_Image_Descp" id="PVGM_Show_Image_Descp2" value="no" <?php if($PVGM_Show_Image_Descp == 'no' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('No','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Show Description" section -->

				<div class="frm-row"><!-- Show Button -->
                	<label class="field-label colm colm3 align-right"><?php _e('Show Button','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Show_Image_Button" id="PVGM_Show_Image_Button1" value="yes" <?php if($PVGM_Show_Image_Button == 'yes' ) { echo "checked"; } ?>  onclick="return PVGM_ReadButtonClick();">
								<span class="radio"></span> <?php _e('Yes','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Show_Image_Button" id="PVGM_Show_Image_Button2" value="no" <?php if($PVGM_Show_Image_Button == 'no' ) { echo "checked"; } ?> onclick="return PVGM_ReadButtonClick();" >
								<span class="radio"></span> <?php _e('No','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Show Button" section -->
				 
				<div class="frm-row"><!-- Button Section -->
                	<label class="field-label colm colm3 align-right"><?php _e('Button Layout','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Button_Radious" id="PVGM_Button_Radious" value="rectangle" <?php if($PVGM_Button_Radious == 'rectangle' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('Square','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Button_Radious" id="PVGM_Button_Radious" value="circle" <?php if($PVGM_Button_Radious == 'circle' ) { echo "checked"; } ?>>
								<span class="radio"></span> <?php _e('Circle','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				</div><!-- End of "Button Layout" Section --> 

				<div class="frm-row buttontext"><!-- Button Text -->
                	<label class="field-label colm colm3 align-right"><?php _e('Button Text','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
                       <label class="field">
                           <input type="text" name="PVGM_Button_Text" id="PVGM_Button_Text" class="gui-input" value="<?php echo $PVGM_Button_Text; ?>" placeholder="Button Text">
                       </label>
                   </div>
				</div><!-- End of "Button Text" section -->
				
				<div class="spacer-b10">&nbsp;</div>
                <div class="spacer-t20 spacer-b40">
                	<div class="tagline"><span> <?php _e('Font Stying Options','PVGM_TEXT_DOMAIN'); ?> </span></div>
                </div>

				<div class="frm-row"><!-- Gallery Font Style -->
                	<label class="field-label colm colm3 align-right"><?php _e('Gallery Font Style','PVGM_TEXT_DOMAIN'); ?>:</label>
                    <div class="section colm colm6">
                        <label class="field select">
                            <select name="PVGM_Font_Style" id="PVGM_Font_Style">
                                <optgroup label="Default Fonts">
									<option value="Arial" <?php selected($PVGM_Font_Style, 'Arial' ); ?>><?php _e('Arial','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Arial Black" <?php selected($PVGM_Font_Style, 'Arial Black' ); ?>><?php _e('Arial Black','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Comic Sans MS" <?php selected($PVGM_Font_Style, 'Comic Sans MS' ); ?>><?php _e('Comic Sans MS','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Courier New" <?php selected($PVGM_Font_Style, 'Courier New' ); ?>><?php _e('Courier New','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Georgia" <?php selected($PVGM_Font_Style, 'Georgia' ); ?>><?php _e('Georgia','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Grande" <?php selected($PVGM_Font_Style, 'Grande' ); ?>><?php _e('Grande','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Helvetica" <?php selected($PVGM_Font_Style, 'Helvetica' ); ?>><?php _e('Helvetica Neue','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Impact" <?php selected($PVGM_Font_Style, 'Impact' ); ?>><?php _e('Impact','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Lucida" <?php selected($PVGM_Font_Style, 'Lucida' ); ?>><?php _e('Lucida','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Lucida Grande" <?php selected($PVGM_Font_Style, 'Lucida Grande' ); ?>><?php _e('Lucida Grande','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Palatino Linotype" <?php selected($PVGM_Font_Style, 'Palatino Linotype' ); ?>><?php _e('Palatino','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Sans" <?php selected($PVGM_Font_Style, 'Sans' ); ?>><?php _e('Sans','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="sans-serif" <?php selected($PVGM_Font_Style, 'sans-serif' ); ?>><?php _e('Sans-Serif','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Tahoma" <?php selected($PVGM_Font_Style, 'Tahoma' ); ?>><?php _e('Tahoma','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Times New Roman"<?php selected($PVGM_Font_Style, 'Times New Roman' ); ?>><?php _e('Times New Roman','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Trebuchet MS" <?php selected($PVGM_Font_Style, 'Trebuchet MS' ); ?>><?php _e('Trebuchet MS','PVGM_TEXT_DOMAIN'); ?></option>
									<option value="Verdana" <?php selected($PVGM_Font_Style, 'Verdana' ); ?>><?php _e('Verdana','PVGM_TEXT_DOMAIN'); ?></option>
								</optgroup>
                            </select>
                            <i class="arrow double"></i>
                        </label>
                    </div>
                </div><!-- End of "Gallery Font Style" section -->
				
				<div class="frm-row">
               	<label class="field-label colm colm3 align-right" Style="padding-top: 35px;"><?php _e('Label Font Settings','PVGM_TEXT_DOMAIN'); ?>:</label>
                   <div class="section colm colm3"><!-- "Label Font Size" Section -->
						<p class="small-text fine-grey"> <?php _e('Label Font Size','PVGM_TEXT_DOMAIN'); ?> </p>
                       <label class="field append-icon">
                           <input class="gui-input" type="number" name="PVGM_Lable_Font_Size" min="10" max="99" step="1" value="<?php echo $PVGM_Lable_Font_Size; ?>">
                           <label class="field-icon">px </label>  
                       </label>
                   </div>
					<div class="section colm colm3"><!-- "Label Line Height" Section -->
						<p class="small-text fine-grey"> <?php _e('Label Line Height','PVGM_TEXT_DOMAIN'); ?> </p>
                       <label class="field append-icon">
                           <input class="gui-input" type="number" name="PVGM_tlineheight" min="10" max="99" step="1" value="<?php echo $PVGM_tlineheight; ?>">
                           <label class="field-icon">px </label>  
                       </label>
                   </div>
               </div><!-- End of the Section -->

				<div class="frm-row"><!-- Description Font Size -->
                	<label class="field-label colm colm3 align-right"><?php _e('Description Font Size','PVGM_TEXT_DOMAIN'); ?>:</label>
                    <div class="section colm colm6">
                        <label class="field select">
                            <select name="PVGM_Desc_Font_Size" id="PVGM_Desc_Font_Size">
                                <optgroup label="Select Desc. Font Size">
									<option value="10" <?php if($PVGM_Desc_Font_Size == '10') echo "selected=selected"; ?>>10</option>
									<option value="11" <?php if($PVGM_Desc_Font_Size == '11') echo "selected=selected"; ?>>11</option>
									<option value="12" <?php if($PVGM_Desc_Font_Size == '12') echo "selected=selected"; ?>>12</option>
									<option value="13" <?php if($PVGM_Desc_Font_Size == '13') echo "selected=selected"; ?>>13</option>
									<option value="14" <?php if($PVGM_Desc_Font_Size == '14') echo "selected=selected"; ?>>14</option>
									<option value="15" <?php if($PVGM_Desc_Font_Size == '15') echo "selected=selected"; ?>>15</option>
									<option value="16" <?php if($PVGM_Desc_Font_Size == '16') echo "selected=selected"; ?>>16</option>
									<option value="17" <?php if($PVGM_Desc_Font_Size == '17') echo "selected=selected"; ?>>17</option>
									<option value="18" <?php if($PVGM_Desc_Font_Size == '18') echo "selected=selected"; ?>>18</option>
									<option value="19" <?php if($PVGM_Desc_Font_Size == '19') echo "selected=selected"; ?>>19</option>
									<option value="20" <?php if($PVGM_Desc_Font_Size == '20') echo "selected=selected"; ?>>20</option>
								</optgroup>
                            </select>
                            <i class="arrow double"></i>
                        </label>
                    </div>
                </div><!-- End of "Description Font Size" section -->
				
				<div class="spacer-b10">&nbsp;</div>
                <div class="spacer-t20 spacer-b40">
                	<div class="tagline"><span> <?php _e('Lightbox & Border Option','PVGM_TEXT_DOMAIN'); ?> </span></div>
                </div>

				<div class="frm-row"><!-- Light Box Style -->
                	<label class="field-label colm colm3 align-right"><?php _e('Light Box Style','PVGM_TEXT_DOMAIN'); ?>:</label>
                    <div class="section colm colm6">
                        <label class="field select">
                            <select name="PVGM_Light_Box" id="PVGM_Light_Box">
                                <optgroup label="Select Light Box Styles">
									<option value="lightbox" <?php if($PVGM_Light_Box == 'lightbox') echo "selected=selected"; ?>><?php _e('Swipe Box','PVGM_TEXT_DOMAIN'); ?></option>
									<option disabled ><?php _e('Pretty Photos (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
									<option disabled ><?php _e('Master Lightbox (Avaliable in PRO Version)','PVGM_TEXT_DOMAIN')?></option>
								</optgroup>
                            </select>
                            <i class="arrow double"></i>
                        </label>
                    </div>
                </div><!-- End of "Light Box Style" section -->

				<div class="frm-row"><!-- Image Border -->
                	<label class="field-label colm colm3 align-right"><?php _e('Image Border','PVGM_TEXT_DOMAIN'); ?>:</label>
					<div class="section colm colm6">
						<div class="option-group field">
							<label class="option">
								<input type="radio" name="PVGM_Image_Border" id="PVGM_Image_Border" value="yes" <?php if($PVGM_Image_Border == 'yes' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('Yes','PVGM_TEXT_DOMAIN'); ?>
							</label>
							<label class="option">
								<input type="radio" name="PVGM_Image_Border" id="PVGM_Image_Border" value="no" <?php if($PVGM_Image_Border == 'no' ) { echo "checked"; } ?> >
								<span class="radio"></span> <?php _e('No','PVGM_TEXT_DOMAIN'); ?>
							</label>
						</div>
					</div>
				 </div><!-- End of "Image Border" section -->

				<div class="spacer-b10">&nbsp;</div>
                <div class="spacer-t20 spacer-b40">
                	<div class="tagline"><span> <?php _e('Custom CSS Field','PVGM_TEXT_DOMAIN'); ?> </span></div>
                </div>
				
				<div class="frm-row"><!-- Custom CSS -->
                	<label class="field-label colm colm3 align-right"><?php _e('Custom CSS','PVGM_TEXT_DOMAIN'); ?>:</label>
                    <div class="section colm colm8">
						<label class="field">
							<textarea class="gui-textarea" id="PVGM_Custom_CSS" name="PVGM_Custom_CSS" placeholder="Put Your Css Here"><?php echo $PVGM_Custom_CSS; ?></textarea>
							<span class="input-hint">
								<strong><?php _e('Note','PVGM_TEXT_DOMAIN'); ?>:</strong> <?php _e('Please Do Not Use','PVGM_TEXT_DOMAIN'); ?> <b><?php _e('Style','PVGM_TEXT_DOMAIN'); ?></b> <?php _e('Tag with Custom CSS','PVGM_TEXT_DOMAIN'); ?>.
							</span>
						</label>
					</div>
				</div><!-- End of "Custom CSS" section -->
				
			</div>
		</form>
	</div>
</div>