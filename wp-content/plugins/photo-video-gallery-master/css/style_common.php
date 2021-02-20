<style>
	#pvgm_<?php echo $PVGM_Id;?> .view {
	   <?php if($PVGM_Image_Border=="yes"){?>
	   border:5px solid #000000;
	   <?php } ?>
	}

	#pvgm_<?php echo $PVGM_Id;?> .view h2 {
	   font-family: <?php echo $PVGM_Font_Style; ?>;
	   background:  rgba(<?php echo $Label_Bg_Color; ?>,0.8 ) !important;
	   color: <?php echo $PVGM_Label_Text_Color; ?> !important;
	   font-size: <?php echo $PVGM_Lable_Font_Size; ?>px;
	   line-height: <?php echo $PVGM_tlineheight; ?>px;
	}
	
	#pvgm_<?php echo $PVGM_Id;?> .view span.t_20 {
		margin-top: 15px;
		display: block;
	}

	#pvgm_<?php echo $PVGM_Id;?> .view p {
	   font-family: <?php echo $PVGM_Font_Style; ?>;
	   color: <?php echo $PVGM_Descp_Text_Color; ?>;
	   font-size: <?php echo $PVGM_Desc_Font_Size; ?>px;
	}

	#pvgm_<?php echo $PVGM_Id;?> .view a.info {
	   background:  rgba(<?php echo $Button_Bg_Color; ?>,0.8 ) !important;
	   color: <?php echo $PVGM_Button_Text_Color; ?>;
	}

	#pvgm_<?php echo $PVGM_Id;?> .view-<?php echo $PVGM_Effect?> .mask {
		background-color: rgba(<?php echo $img_bg_color; ?>,1 ) !important;
	}
	<?php echo $PVGM_Custom_CSS; ?>
</style>