<?php 
function isha_color_font_css(){?>
	<style>
	
	<?php 
		require get_template_directory() . '/inc/customizer/css/primary-theme-color.php';
		require get_template_directory() . '/inc/customizer/css/background.php';
	?>
	
	
	</style>
<?php }

add_action('wp_head','isha_color_font_css');