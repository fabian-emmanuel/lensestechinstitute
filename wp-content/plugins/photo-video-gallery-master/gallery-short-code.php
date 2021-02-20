<?php
add_shortcode( 'PVGM', 'PhotoVideoGalleryMasterShortCode' );
function PhotoVideoGalleryMasterShortCode( $Id ) {
	
	$PVGM_Id = $Id['id'];
	$TotalImages =  get_post_meta( $PVGM_Id, 'PVGM_total_images_count', true );
	if( $TotalImages == "" ){
		ob_start();
		printf( __( "Gallery with ID %s doesn't exist.","PVGM_TEXT_DOMAIN" ), $PVGM_Id );
		return ob_get_clean();
	}
	if( $TotalImages == 0 ){
		ob_start();
		printf( __( "Gallery with ID %s is empty.","PVGM_TEXT_DOMAIN" ), $PVGM_Id );
		return ob_get_clean();
	}
	
    ob_start();
	$PVGM_Gallery_Settings = pvgm_get_gallery_value($PVGM_Id);
	if(count($PVGM_Gallery_Settings)) {
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
		$PVGM_Button_Radious		= esc_attr( $PVGM_Gallery_Settings['PVGM_Button_Radious'] );
		$PVGM_Button_Text			= esc_attr( $PVGM_Gallery_Settings['PVGM_Button_Text'] );
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
	<script type="text/javascript">
		jQuery(document).ready(function(){
			;( function( jQuery ) {
				jQuery( '.swipebox_<?php echo $PVGM_Id;?>' ).swipebox({
							hideBarsDelay:0,
							hideCloseButtonOnMobile : false,
						});
			})( jQuery );
		});
	</script>
<?php 
	$border =  PVGM_hex2rgb( "#000000" );
	$image_border = implode(", ", $border);
    $bg_color =  PVGM_hex2rgb( $PVGM_Color );
	$img_bg_color = implode(", ", $bg_color);
	
	$Label_Bg_Color =  PVGM_hex2rgb( $PVGM_Label_Bg_Color );
	$Label_Bg_Color = implode(", ", $Label_Bg_Color);
	
	$Label_Text_Color =  PVGM_hex2rgb( $PVGM_Label_Text_Color );
	$Label_Text_Color = implode(", ", $Label_Text_Color);
	
	$Button_Bg_Color =  PVGM_hex2rgb( $PVGM_Button_Bg_Color );
	$Button_Bg_Color = implode(", ", $Button_Bg_Color);
	
	if($PVGM_Button_Text == ""){
		$PVGM_Button_Text = "Read More";
	}

	include("css/style_common.php");
?>

	<?php if($PVGM_Show_Gallery_Title=="yes" && !empty(get_the_title($PVGM_Id))){?>
	<div class="pvgm-gallery-title">
        <?php echo esc_attr( get_the_title($PVGM_Id) ) ;?>
    </div>
	<?php } ?>
	
	<div class="row pvgm-gallery" id="pvgm_<?php echo $PVGM_Id;?>">
	<?php
		$PVGM_AllPhotosDetails = unserialize(get_post_meta( $PVGM_Id, 'PVGM_all_photos_details', true));
		$TotalImages =  get_post_meta( $PVGM_Id, 'PVGM_total_images_count', true );
		if($TotalImages) {
			foreach($PVGM_AllPhotosDetails as $PVGM_SinglePhotoDetails) {
				$name = esc_attr( $PVGM_SinglePhotoDetails['PVGM_image_label'] );
				$url = esc_url( $PVGM_SinglePhotoDetails['PVGM_image_url'] );
				$circle = esc_url( $PVGM_SinglePhotoDetails['PVGM_gallery_admin_circle'] );
				$video = esc_url( $PVGM_SinglePhotoDetails['PVGM_video_link'] ); 
				$link = esc_url( $PVGM_SinglePhotoDetails['PVGM_external_link'] );
				$type = esc_attr( $PVGM_SinglePhotoDetails['PVGM_portfolio_type'] );
				$description = stripslashes(esc_attr($PVGM_SinglePhotoDetails['PVGM_image_descp']));
				if(isset($PVGM_SinglePhotoDetails['PVGM_image_alt'])){
					$alt = $PVGM_SinglePhotoDetails['PVGM_image_alt'];
				}else{
					$alt = "";
				}
				if($type=="image"){
					$href_link = $url;
				}  elseif($type=="link"){
					$href_link = $link;
				} else {
					$href_link = $video;
				}
				
				?>
				<div class="<?php echo $PVGM_Gallery_Layout; ?> col-sm-6 wl-gallery">
				
				<?php if($PVGM_Show_Image_Button == "no"){ ?>
					<a href="<?php echo $href_link; ?>" <?php  
								if($type != "link") { ?> class="swipebox_<?php echo $PVGM_Id; ?> info" title="<?php echo $alt; ?>" <?php }else{ ?> class="info" target="<?php echo $PVGM_Open_Link; ?>" <?php } 
								?>>
						<div class="view view-<?php echo $PVGM_Effect ?> " style="cursor:pointer !important;">
							<img src="<?php echo $circle; ?>" alt="<?php echo $alt; ?>" />
							<div class="mask">
							<?php if( $PVGM_Show_Image_Label =="yes"){ ?>
								<h2 class="h2"><?php echo $name; ?></h2>
							<?php } ?>	
								<p>
								<?php  if($PVGM_Show_Image_Descp == "yes") { 
									echo $description;
								} ?>
								</p>
							</div>
						</div> 
					</a>
				<?php } else {?>
				
					<div class="view view-<?php echo $PVGM_Effect ?> ">
						<img src="<?php echo $circle; ?>" alt="<?php echo $alt; ?>" />
						<div class="mask">
							<?php if( $PVGM_Show_Image_Label =="yes" && $name != ""){ ?>
							<h2 class="h2"><?php echo $name; ?></h2>
							<?php }else{ ?>
								<span class="t_20"></span>
							<?php	
							} ?>
							<p>
							<?php  if($PVGM_Show_Image_Descp == "yes") { 
								echo $description;
							} ?>
							</p>
							<a href="<?php echo $href_link; ?>" <?php  
								if($type != "link") { ?> class="swipebox_<?php echo $PVGM_Id;?> info <?php echo $PVGM_Button_Radious;?>" alt="<?php echo $alt; ?>" <?php }else{ ?> class="info" target="<?php echo $PVGM_Open_Link; ?>" <?php } 
								?>><?php echo $PVGM_Button_Text; ?> </a>
						</div>
					</div>
				<?php } ?>
				
				</div>	
				<?php
			}
		}
		?>
	</div>
	<?php
	wp_reset_postdata();
    return ob_get_clean();
}
?>