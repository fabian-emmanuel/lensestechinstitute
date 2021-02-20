<?php
/**
 * Plugin Name: Ultimate Gallery Master
 * Plugin URI: http://demo.webhuntinfotech.com/demo?theme=ugm-pro
 * Description: Plugin allows to create unlimited Image, Video (YouTube and Vimeo) and link galleries with unlimited possibilities. Plugin runs on all major browsers with support for older browsers like IE8 and mobile devices like iPhone, iPad, IOS, Android or Windows mobile.
 * Version: 1.4.5
 * Author: WebHunt Infotech
 * Author URI: http://www.webhuntinfotech.com/
 */
 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
} 

/** Constant Variable */
define("UGML_TEXT_DOMAIN","UGML_TEXT_DOMAIN" );
define("UGML_PLUGIN_URL", plugin_dir_url(__FILE__));

/** Translation Ready */
add_action('plugins_loaded', 'UGML_GetReadyTranslation');
function UGML_GetReadyTranslation() {
	load_plugin_textdomain('UGML_TEXT_DOMAIN', FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

/** Crop Images In Desire Format */
add_image_size( 'UGML_gallery_admin_thumb', 300, 300, array( 'top', 'center' ) );
add_image_size( 'UGML_gallery_admin_circle', 400, 400, array( 'top', 'center' ) );

/** Clean widget while add shortcode in widget area */
add_filter( 'widget_display_callback', 'ugml_clean_widget_display_callback', 10, 3 );
function ugml_clean_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}

// Function To Remove Feature Image
function UGML_remove_image_box() {
	remove_meta_box('postimagediv','ugml_cpt','side');
}
add_action('do_meta_boxes', 'UGML_remove_image_box');

/** Short Code Detect Function To UpLoad JS And CSS */
function UGML_ShortCodeDetect() {
	/** js scripts */
		wp_enqueue_script('jquery');

	/**   css scripts  */
	   wp_enqueue_style('UGML-global-css', UGML_PLUGIN_URL.'css/global.css');	
}
add_action( 'wp_enqueue_scripts', 'UGML_ShortCodeDetect' );
add_filter( 'widget_text', 'do_shortcode' );
	
class UGML {
    private static $instance;
    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

	private function __construct() {
        add_action('admin_print_scripts-post.php', array(&$this, 'ugml_admin_print_scripts'));
        add_action('admin_print_scripts-post-new.php', array(&$this, 'ugml_admin_print_scripts'));
        add_shortcode('ugmlgallery', array(&$this, 'shortcode'));
        
        if (is_admin()) {
			add_action('init', array(&$this,'ugml_gallery_cpt'));
			add_action('admin_menu', array(&$this,'ugml_general_setting_page'));
			add_action('add_meta_boxes', array(&$this, 'add_all_ugml_meta_boxes'));
			add_action('admin_init', array(&$this, 'add_all_ugml_meta_boxes'), 1);
			add_filter('manage_edit-ugml_cpt_columns', array(&$this, 'ugml_gallery_column' )) ;
			add_action('manage_ugml_cpt_posts_custom_column', array(&$this, 'ugml_gallery_manage_columns' ), 10, 2 );
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this,'ugml_activate_sublink') );

			add_action('save_post', array(&$this, 'UGML_image_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'UGML_settings_meta_save'), 9, 1);
			
			add_action('wp_ajax_ugmlgallery_get_thumbnail', array(&$this, 'ajax_get_thumbnail'));
		}
    }
	
	//Required JS & CSS
	public function ugml_admin_print_scripts() {
		if ( 'ugml_cpt' == $GLOBALS['post_type'] ) {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('media-uploader-js', UGML_PLUGIN_URL . 'js/multiple-media-uploader.js', array('jquery'));

			wp_enqueue_media();
			//custom add image box css
			wp_enqueue_style('image-box-css', UGML_PLUGIN_URL.'css/image-box.css');
			wp_enqueue_style('smart-forms-css', UGML_PLUGIN_URL.'css/smart-forms.css');

			wp_enqueue_script('jquery-ui-slider');
		}
	}
	
	// Register Custom Post Type
	function ugml_gallery_cpt() {
		register_post_type('ugml_cpt',
			array(
				'labels' => array(
					'name' 			=> esc_html__('Ultimate Gallery Master','UGML_TEXT_DOMAIN' ),
					'singular_name' => esc_html__('Ultimate Gallery Master','UGML_TEXT_DOMAIN' ),
					'add_new' 		=> esc_html__('Add New Gallery', 'UGML_TEXT_DOMAIN' ),
					'add_new_item' 	=> esc_html__('Add New Gallery', 'UGML_TEXT_DOMAIN' ),
					'edit_item' 	=> esc_html__('Edit Gallery', 'UGML_TEXT_DOMAIN' ),
					'new_item' 		=> esc_html__('New Gallery', 'UGML_TEXT_DOMAIN' ),
					'view_item' 	=> esc_html__('View Gallery', 'UGML_TEXT_DOMAIN' ),
					'search_items' 	=> esc_html__('Search Gallery', 'UGML_TEXT_DOMAIN' ),
					'not_found' 	=> esc_html__('No Gallery found', 'UGML_TEXT_DOMAIN' ),
					'not_found_in_trash'=> esc_html__('No Gallery found in Trash', 'UGML_TEXT_DOMAIN' ),
					'parent_item_colon' => esc_html__('Parent Gallery:', 'UGML_TEXT_DOMAIN' ),
					'all_items' 	=> esc_html__('All Galleries', 'UGML_TEXT_DOMAIN' ),
					'menu_name' 	=> esc_html__('Ultimate Gallery Master', 'UGML_TEXT_DOMAIN' ),
				),
				'supports' => array('title', 'thumbnail'),
				'show_in' => true,
				'show_in_nav_menus' => false,
				'public' => false,
				'menu_icon' => 'dashicons-format-gallery',			
				'hierarchical' => false,	
				'show_ui' => true,
				'show_in_menu' => true,
				'menu_position' => 10,
				'publicly_queryable' => false,
				'exclude_from_search' => true,
				'has_archive' => true,
				'query_var' => true,
				'can_export' => true,
				'rewrite' => false,
				'capability_type' => 'post'
			)
		);
	}

	function ugml_general_setting_page() {
		add_submenu_page(
			'edit.php?post_type=ugml_cpt',
			esc_html__( 'General Settings', 'UGML_TEXT_DOMAIN' ),
			esc_html__( 'General Settings', 'UGML_TEXT_DOMAIN' ),
			'manage_options',
			'ugml_general_option_page',
			array(&$this, 'ugml_general_settings_ref_page_callback' )
		);
		
		add_submenu_page(
			'edit.php?post_type=ugml_cpt',
			esc_html__( 'Recommendation', 'UGML_TEXT_DOMAIN' ),
			esc_html__( 'Recommendation', 'UGML_TEXT_DOMAIN' ),
			'manage_options',
			'ugml_recommend_page',
			array(&$this, 'ugml_recommend_page_callback' )
		);
	}
	
	/**
	 * Display callback for the submenu page.
	 */
	function ugml_general_settings_ref_page_callback() {
		require_once('general-settings.php');
	}
	
	function ugml_recommend_page_callback() {
		wp_enqueue_style( 'ugml-recommend-css', UGML_PLUGIN_URL . 'css/recommend.css' );
		require_once('recommendations.php');
	}
	
	function ugml_gallery_column( $columns ){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => esc_html__( 'All Galleries','UGML_TEXT_DOMAIN' ),
			'images' => esc_html__( 'Number of Images','UGML_TEXT_DOMAIN' ),
			'shortcode' => esc_html__( 'Gallery Shortcodes','UGML_TEXT_DOMAIN' ),
			'date' => esc_html__( 'Date','UGML_TEXT_DOMAIN' )
		);
		return $columns;
	}

	function ugml_gallery_manage_columns( $column, $post_id ){
		global $post;
		switch( $column ) {
		  case 'shortcode' :
			echo '<input type="text" value="[UGML id='.$post_id.']" readonly="readonly" />';
			break;
		  case 'images' :
			$TotalImages =  get_post_meta( $post_id, 'UGML_total_images_count', true );
            echo '<span style="padding-left:4%">' . $TotalImages . '</span>';
            break;		
		  default :
			break;
		}
	}
	
	// Upgrade to PRO activate link
	public function ugml_activate_sublink($links){
		$added_link_1 = '<a href="https://www.webhuntinfotech.com/amember/signup/ugmp" style="font-weight:700; color:#f44336" target="_blank">Go Pro</a>';
		$added_link_2 = '<a href="edit.php?post_type=ugml_cpt">Settings</a>';
		array_unshift( $links, $added_link_1, $added_link_2 );

		return $links;
	}

	public function add_all_ugml_meta_boxes() {
		add_meta_box( __('Add Images', 'UGML_TEXT_DOMAIN'), __('Add Images', 'UGML_TEXT_DOMAIN'), array(&$this, 'UGML_generate_add_image_meta_box_function'), 'ugml_cpt', 'normal', 'low' );
		add_meta_box( __('Apply Setting On Gallery', 'UGML_TEXT_DOMAIN'), __('Apply Setting On Gallery', 'UGML_TEXT_DOMAIN'), array(&$this, 'UGML_settings_meta_box_function'), 'ugml_cpt', 'normal', 'low');
		add_meta_box ( __('Gallery Shortcode', 'UGML_TEXT_DOMAIN'), __('Gallery Shortcode', 'UGML_TEXT_DOMAIN'), array(&$this, 'UGML_shotcode_meta_box_function'), 'ugml_cpt', 'side', 'low');
		
		// Rate Us Meta Box
		add_meta_box(__('Show us some love, Rate Us', 'UGML_TEXT_DOMAIN') , __('Show us some love, Rate Us', 'UGML_TEXT_DOMAIN'), array(&$this,'Rate_us_meta_box_ugml'), 'ugml_cpt', 'side', 'low');

		// Pro Features Meta Box
		add_meta_box(__('Pro Feature List', 'UGML_TEXT_DOMAIN') , __('Pro Features List', 'UGML_TEXT_DOMAIN'), array(&$this,'ugml_pro_features'), 'ugml_cpt', 'side', 'low');
	}
	
	// Rate Us Meta Box Function
	function Rate_us_meta_box_ugml() { ?>
		<div align="center">
			<p><?php esc_html_e('Please Review & Rate Us On WordPress','UGML_TEXT_DOMAIN'); ?></p>
			<div class="stars">
				<a href="https://wordpress.org/support/plugin/ultimate-gallery-master/reviews/?filter=5" target="_blank"><div class="imgStar"></div></a>
			</div>
		</div>
		<div style="text-align:center;margin-bottom:15px;margin-top:25px;">
			<a href="https://wordpress.org/support/plugin/ultimate-gallery-master/reviews/?filter=5" target="_blank" title="rate us" class="btn-web button-4"><?php esc_html_e('RATE US','UGML_TEXT_DOMAIN'); ?></a>
		</div>
	<?php
	}

	function ugml_pro_features(){
	?>
		<ul style="">
			<li class="plan-feature">(1) <?php esc_html_e('100% Responsive Design.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(2) <?php esc_html_e('Four grid layouts (dynamic, masonry, classic and infinite).','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(3) <?php esc_html_e('Vertical and horizontal variation.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(4) <?php esc_html_e('Full multimedia support (image, youtube, vimeo, self hosted video, youku video, audio, flash file, iframe, google maps, external link).','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(5) <?php esc_html_e('More than 150 Presets (thumbnail display styles) included.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(6) <?php esc_html_e('Multiple shortcode on page or post.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(7) <?php esc_html_e('Unique settings for each gallery.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(8) <?php esc_html_e('Runs on all major browsers.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(9) <?php esc_html_e('Super easy to use for beginners.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(10) <?php esc_html_e('All-purpose usage.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(11) <?php esc_html_e('Quick and easy setup.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(12) <?php esc_html_e('SEO optimized.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(13) <?php esc_html_e('Mobile optimized.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(14) <?php esc_html_e('Single or multiple categories selection.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(15) <?php esc_html_e('Filterable categories.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(16) <?php esc_html_e('Optional menu.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(17) <?php esc_html_e('Two menu types list or dropbox.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(18) <?php esc_html_e('Customizable menu position with variation based on layout.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(19) <?php esc_html_e('Optional search box.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(20) <?php esc_html_e('Optional lazy loading with load more button or scroll.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(21) <?php esc_html_e('Multiple thumbnails hide / show animation types.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(22) <?php esc_html_e('Thumbnails multimedia icons.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(23) <?php esc_html_e('Adjustable thumbnails number to display / load per set.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(24) <?php esc_html_e('Adjustable thumbnail spacings / size and much more.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(25) <?php esc_html_e('Adjustable thumbnail geometry and styling.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(26) <?php esc_html_e('Light Box View.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(27) <?php esc_html_e('Two lightbox screen (classic and modern).','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(28) <?php esc_html_e('Unlimited color scheme.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(29) <?php esc_html_e('Social networks sharing.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(30) <?php esc_html_e('500+ Google Fonts.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(31) <?php esc_html_e('Custom CSS Option.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(32) <?php esc_html_e('Translation ready.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(33) <?php esc_html_e('Updates and support.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(34) <?php esc_html_e('Extensive documentation.','UGML_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(35) <?php esc_html_e('And many more..','UGML_TEXT_DOMAIN'); ?></li>
		</ul>
	<?php
	}
	

	/**
	 * This function display Add New Image interface
	 * Also loads all saved gallery photos into gallery
	 */
    public function UGML_generate_add_image_meta_box_function($post) { ?>
		
			<div class="" style="padding:20px;text-align: center;">  
			  <a href="http://demo.webhuntinfotech.com/demo?theme=ugm-pro" target="_blank" class="btn-web button-1"><?php _e('View Live Demo (PRO)','UGML_TEXT_DOMAIN'); ?></a>
			  <a href="http://webhuntinfotech.com/amember/signup/ugmp/" target="_blank" class="btn-web button-2"><?php _e('Upgrade To PRO','UGML_TEXT_DOMAIN'); ?></a>
			  <a  href="https://www.webhuntinfotech.com/ultimate-gallery-master-lite-documentation/" target="_blank" class="btn-web button-3"><?php _e('Documention ( Lite )','UGML_TEXT_DOMAIN'); ?></a>
			</div>
		<div >
			<div class="ugml-tips-div">
				<p><strong><?php _e('Tips','UGML_TEXT_DOMAIN'); ?>:</strong> <?php _e('Upload all gallery images using Add New Image button. Do not use/add pre-uploaded images which are uploaded previously using Media/Post/Page. Minimum Dimensions for Upload Image is 400*400.','UGML_TEXT_DOMAIN'); ?></p>
			</div>
			<input id="UGML_delete_all_button" class="button" type="button" value="Remove All Images" rel="">
			<input type="hidden" id="UGML_wl_action" name="UGML_wl_action" value="UGML-save-settings">
            <ul id="ugml_gallery_thumbs" class="clearfix">
				<?php
				/* load saved photos into gallery */
				$WPGP_AllPhotosDetails = unserialize(get_post_meta( $post->ID, 'UGML_all_photos_details', true));
				$TotalImages =  get_post_meta( $post->ID, 'UGML_total_images_count', true );
				if($TotalImages) {
					foreach($WPGP_AllPhotosDetails as $WPGP_SinglePhotoDetails) {
						$name = $WPGP_SinglePhotoDetails['UGML_image_label'];
						$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
						$url = $WPGP_SinglePhotoDetails['UGML_image_url'];
						$url1 = $WPGP_SinglePhotoDetails['UGML_gallery_admin_thumb'];
						$circle = $WPGP_SinglePhotoDetails['UGML_gallery_admin_circle'];
						$type = $WPGP_SinglePhotoDetails['UGML_display_type'];
						$description = $WPGP_SinglePhotoDetails['UGML_image_descp'];
						$link = $WPGP_SinglePhotoDetails['UGML_external_link'];
						$extra_button_url = $WPGP_SinglePhotoDetails['UGML_extra_button_url'];
						?>
						<li class="ugml-image-entry" id="ugml_img">
							<a class="image_gallery_remove ugmlgallery_remove" href="#gallery_remove" id="ugml_remove_bt" ><img src="<?php echo  esc_url(UGML_PLUGIN_URL.'images/image-close-icon.png'); ?>" /></a>
							<div class="ugml-admin-inner-div1" >

								<img src="<?php echo esc_url($url1); ?>" class="ugml-meta-image">
								<input type="hidden" id="unique_string[]" name="unique_string[]" value="<?php echo esc_attr($UniqueString); ?>" />

								<p>
									<label><?php _e('Display Type','UGML_TEXT_DOMAIN')?></label>
									<select name="UGML_display_type[]" id="UGML_display_type[]" style="width:100%; margin-top:5px;">
										<optgroup label="Select Type">
											<option value="image" <?php if($type == 'image') echo "selected=selected"; ?>> <?php _e('Image','UGML_TEXT_DOMAIN')?></option>
											
											<option value="yv_video" <?php if($type == 'yv_video') echo "selected=selected"; ?>> <?php _e('Youtube/Vimeo video','UGML_TEXT_DOMAIN')?></option>
											
											<option value="link" <?php if($type == 'link') echo "selected=selected"; ?>> <?php _e('External Link','UGML_TEXT_DOMAIN')?></option>
											
											<option disabled> <?php _e('Uploaded Video (In PRO)','UGML_TEXT_DOMAIN')?></option>
											<option disabled> <?php _e('Audio (In PRO)','UGML_TEXT_DOMAIN')?></option>
											<option disabled> <?php _e('Google Maps (In PRO)','UGML_TEXT_DOMAIN')?></option>
											<option disabled> <?php _e('Flash (In PRO)','UGML_TEXT_DOMAIN')?></option>
											<option disabled> <?php _e('IFRAME (In PRO)','UGML_TEXT_DOMAIN')?></option>
										</optgroup>
									</select>
								</p>
							</div>
							<div class="ugml-admin-inner-div2" >

								<input type="text" id="UGML_image_url[]" name="UGML_image_url[]" class="ugml_label_text"  value="<?php echo esc_url($url); ?>"  readonly="readonly" style="display:none;" />
								<input type="text" id="UGML_gallery_admin_thumb[]" name="UGML_gallery_admin_thumb[]" class="ugml_label_text"  value="<?php echo esc_url($url1); ?>"  readonly="readonly" style="display:none;" />
								<input type="text" id="UGML_gallery_admin_circle[]" name="UGML_gallery_admin_circle[]" class="ugml_label_text"  value="<?php echo esc_url($circle); ?>"  readonly="readonly" style="display:none;" />

								<p>
									<div class="ugml_label"><label ><?php _e('Image Title','UGML_TEXT_DOMAIN')?> </label></div>
									<input type="text" id="UGML_image_label[]" name="UGML_image_label[]" value="<?php echo esc_attr($name); ?>" placeholder="Enter Image Title Name" class="ugml_label_text">
								</p>
								<p>
									<label class="ugml_label labelspace" style="vertical-align:top;"><?php _e('Description','UGML_TEXT_DOMAIN')?> </label>
									<textarea id="UGML_image_descp[]" name="UGML_image_descp[]" class="ugml_textarea" placeholder="Enter Image Description"><?php echo esc_html($description); ?></textarea>
								</p>
								<p>
									<label class="ugml_label"><?php _e('Video/Link URL','UGML_TEXT_DOMAIN')?> </label>
									<input type="text" id="UGML_external_link[]" name="UGML_external_link[]" value="<?php echo esc_url($link); ?>" placeholder="Enter Video/External Link URL" class="ugml_label_text">
								</p>
								<p>
									<label class="ugml_label"><?php _e('Extra Button url','UGML_TEXT_DOMAIN')?> </label>
									<input type="text" id="UGML_extra_button_url[]" name="UGML_extra_button_url[]" value="<?php echo esc_url($extra_button_url); ?>" placeholder="Enter Extra Button URL" class="ugml_label_text">
								</p>
							</div>
						</li>
						<?php
					} // end of foreach
				} else {
					$TotalImages = 0;
				}
				?>
            </ul>
        </div>

		<!--Add New Image Button-->
		<div class="ugml-image-entry add_ugml_new_image" id="ugml_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select" >
			<div class="dashicons dashicons-plus"></div>
			<p>
				<?php _e('Add New Media', 'UGML_TEXT_DOMAIN'); ?>
			</p>
		</div>
		<div style="clear:left;"></div>
        <?php
    }

	/** Call settings meta box */
    public function UGML_settings_meta_box_function($post) {
		require_once('ultimate-gallery-master-lite-settings.php');
	}

	/** Shortcode metabox function */
	public function UGML_shotcode_meta_box_function() { ?>
		<p><?php _e("Use below shortcode in any Page/Post to publish your gallery", 'UGML_TEXT_DOMAIN');?></p>
		<input readonly="readonly" type="text" value="<?php echo "[UGML id=".get_the_ID()."]"; ?>">
		<?php
	}

	public function admin_thumb($id) {
		$image  = wp_get_attachment_image_src($id, 'UGML_gallery_admin_original', true);
		$image1 = wp_get_attachment_image_src($id, 'UGML_gallery_admin_thumb', true);
		$circle = wp_get_attachment_image_src($id, 'UGML_gallery_admin_circle', true);
		$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        ?>
		<li class="ugml-image-entry" id="ugml_img">
			<a class="image_gallery_remove ugmlgallery_remove" href="#gallery_remove" id="ugml_remove_bt" ><img src="<?php echo  esc_url(UGML_PLUGIN_URL.'images/image-close-icon.png'); ?>" /></a>
			<div class="ugml-admin-inner-div1" >
				<img src="<?php echo esc_url($image1[0]); ?>" class="ugml-meta-image">
				<p>
					<label><?php _e('Display Type','UGML_TEXT_DOMAIN')?></label>
					<select name="UGML_display_type[]" id="UGML_display_type[]" style="width:100%;">
						<optgroup label="Select Type">
							<option value="image" selected="selected"> <?php _e('Image','UGML_TEXT_DOMAIN')?></option>
							<option value="yv_video"> <?php _e('Youtube/Vimeo video','UGML_TEXT_DOMAIN')?></option>
							<option value="link"> <?php _e('External Link','UGML_TEXT_DOMAIN')?></option>
						</optgroup>
					</select>
				</p>
			</div>
			<div class="ugml-admin-inner-div2" >
				<input type="text" id="UGML_image_url[]" name="UGML_image_url[]" class="ugml_label_text"  value="<?php echo esc_url($image[0]); ?>"  readonly="readonly" style="display:none;" />
				<input type="text" id="UGML_gallery_admin_thumb[]" name="UGML_gallery_admin_thumb[]" class="ugml_label_text"  value="<?php echo esc_url($image1[0]); ?>"  readonly="readonly" style="display:none;" />
				<input type="text" id="UGML_gallery_admin_circle[]" name="UGML_gallery_admin_circle[]" class="ugml_label_text"  value="<?php echo esc_url($circle[0]); ?>"  readonly="readonly" style="display:none;" />
				
				<p>
					<label class="ugml_label"><?php _e('Image Title','UGML_TEXT_DOMAIN')?> </label>
					<input type="text" id="UGML_image_label[]" name="UGML_image_label[]" placeholder="Enter Image Title Name" class="ugml_label_text">
				</p>
				<p>
					<label class="ugml_label labelspace" style="vertical-align:top;"><?php _e('Description','UGML_TEXT_DOMAIN')?> </label>
					<textarea id="UGML_image_descp[]" name="UGML_image_descp[]" class="ugml_textarea" placeholder="Enter Image Description"></textarea>
				</p>
				<p>
					<label class="ugml_label"><?php _e('Video/Link URL','UGML_TEXT_DOMAIN')?> </label>
					<input type="text" id="UGML_external_link[]" name="UGML_external_link[]" placeholder="Enter Video/External Link URL" class="ugml_label_text">
				</p>
				<p>
					<label class="ugml_label"><?php _e('Extra Button URL','UGML_TEXT_DOMAIN')?> </label>
					<input type="text" id="UGML_extra_button_url[]" name="UGML_extra_button_url[]" placeholder="Enter Extra Button URL" class="ugml_label_text">
				</p>
			</div>
		</li>
        <?php
    }

    public function ajax_get_thumbnail() {
        echo $this->admin_thumb($_POST['imageid']);
        die;
    }

	//save Image meta box values
    public function UGML_image_meta_box_save($PostID) {
		if(isset($PostID) && isset($_POST['UGML_wl_action'])) {
			if(isset($_POST['UGML_image_url'])){
				$TotalImages = count($_POST['UGML_image_url']);
				$ImagesArray = array();
				if($TotalImages) {
					for($i=0; $i < $TotalImages; $i++) {
						$image_label 		= stripslashes($_POST['UGML_image_label'][$i]);
						$url 				= $_POST['UGML_image_url'][$i];
						$url1 				= $_POST['UGML_gallery_admin_thumb'][$i];
						$circle 			= $_POST['UGML_gallery_admin_circle'][$i];
						$type 				= $_POST['UGML_display_type'][$i];
						$tagline 			= "";
						$description 		= $_POST['UGML_image_descp'][$i];
						$link 				= $_POST['UGML_external_link'][$i];
						$extra_button_url 	= $_POST['UGML_extra_button_url'][$i];
						$ImagesArray[] = array(
							'UGML_image_label' 				=> sanitize_text_field( $image_label ),
							'UGML_image_url' 				=> esc_url_raw( $url ),
							'UGML_gallery_admin_thumb' 		=> esc_url_raw( $url1 ),
							'UGML_gallery_admin_circle' 	=> esc_url_raw( $circle ),
							'UGML_display_type' 			=> sanitize_text_field( $type ),
							'UGML_image_tagline' 			=> sanitize_text_field( $tagline ),
							'UGML_image_descp' 				=> stripslashes(esc_attr($description)),
							'UGML_external_link' 			=> esc_url_raw( $link ),
							'UGML_extra_button_url' 		=> esc_url_raw( $extra_button_url )
						);
					}
					update_post_meta($PostID, 'UGML_all_photos_details', serialize($ImagesArray));
					update_post_meta($PostID, 'UGML_total_images_count', $TotalImages);
				}
			}else {
				$TotalImages = 0;
				update_post_meta($PostID, 'UGML_total_images_count', $TotalImages);
				$ImagesArray = array();
				update_post_meta($PostID, 'UGML_all_photos_details', serialize($ImagesArray));
			}
		}
    }

	//save settings meta box values
	public function UGML_settings_meta_save($PostID) {
	  if(isset($PostID) && isset($_POST['UGML_useIconButtons'])){
		$UGML_Grid_Layout  				= $_POST['UGML_Grid_Layout'] ;
		$UGML_Grid_Orientation    		= $_POST['UGML_Grid_Orientation'];
		$UGML_cvThumbnail    			= $_POST['UGML_cvThumbnail'];
		$UGML_maxWidth					= $_POST['UGML_maxWidth'];
		$UGML_maxHeight					= $_POST['UGML_maxHeight'];
		$UGML_openLink					= $_POST['UGML_openLink'];
		$UGML_Font_Style           		= $_POST['UGML_Font_Style'];
		$UGML_disableThumbnails			= $_POST['UGML_disableThumbnails'];
		$UGML_hoverColor 				= $_POST['UGML_hoverColor'];
		$UGML_Color_Opacity         	= $_POST['UGML_Color_Opacity'];
		$UGML_imageHoverTextColor		= $_POST['UGML_imageHoverTextColor'];
		$UGML_useIconButtons    		= $_POST['UGML_useIconButtons'];
		$UGML_IconStyle					= $_POST['UGML_IconStyle'];
		$UGML_thumbnailBorderSize		= $_POST['UGML_thumbnailBorderSize'];
		$UGML_spaceBwThumbnails			= $_POST['UGML_spaceBwThumbnails'];
		$UGML_showMenu					= $_POST['UGML_showMenu'];
		$UGML_menuBgColor				= $_POST['UGML_menuBgColor'];
		$UGML_showSearchBox				= $_POST['UGML_showSearchBox'];
		$UGML_menuPosition				= $_POST['UGML_menuPosition'];
		$UGML_searchLabel				= $_POST['UGML_searchLabel'];
		$UGML_searchNotFoundLabel		= $_POST['UGML_searchNotFoundLabel'];
		$UGML_showZoomButton			= $_POST['UGML_showZoomButton'];
		$UGML_showDescriptionButton		= $_POST['UGML_showDescriptionButton'];
		$UGML_descriptionByDefault		= $_POST['UGML_descriptionByDefault'];
		$UGML_Custom_CSS    			= $_POST['UGML_Custom_CSS'];
		$UGML_Settings_Array = serialize( array(
			'UGML_Grid_Layout'          	=> $UGML_Grid_Layout,
			'UGML_Grid_Orientation'    		=> $UGML_Grid_Orientation,
			'UGML_cvThumbnail'          	=> $UGML_cvThumbnail,
			'UGML_maxWidth'					=> $UGML_maxWidth,
			'UGML_maxHeight'				=> $UGML_maxHeight,
			'UGML_openLink'					=> $UGML_openLink,
			'UGML_Font_Style'				=> $UGML_Font_Style,
			'UGML_disableThumbnails'		=> $UGML_disableThumbnails,
			'UGML_hoverColor'         		=> $UGML_hoverColor,
			'UGML_Color_Opacity'			=> $UGML_Color_Opacity,
			'UGML_imageHoverTextColor'		=> $UGML_imageHoverTextColor,
			'UGML_useIconButtons'          	=> $UGML_useIconButtons,
			'UGML_IconStyle'          		=> $UGML_IconStyle,
			'UGML_thumbnailBorderSize'     	=> $UGML_thumbnailBorderSize,
			'UGML_spaceBwThumbnails'     	=> $UGML_spaceBwThumbnails,
			'UGML_showMenu'					=> $UGML_showMenu,
			'UGML_menuBgColor'				=> $UGML_menuBgColor,
			'UGML_showSearchBox'			=> $UGML_showSearchBox,
			'UGML_menuPosition'				=> $UGML_menuPosition,
			'UGML_searchLabel'				=> stripslashes(esc_attr($UGML_searchLabel)),
			'UGML_searchNotFoundLabel'		=> stripslashes(esc_attr($UGML_searchNotFoundLabel)),
			'UGML_showZoomButton'			=> $UGML_showZoomButton,
			'UGML_showDescriptionButton'	=> $UGML_showDescriptionButton,
			'UGML_descriptionByDefault'		=> $UGML_descriptionByDefault,
			'UGML_Custom_CSS'   			=> $UGML_Custom_CSS
		) );

		$UGML_Gallery_Settings = "UGML_Gallery_Settings_".$PostID;
		update_post_meta($PostID, $UGML_Gallery_Settings, $UGML_Settings_Array);
	  }
	}
}

global $UGML;
$UGML = UGML::forge();

/**
 * Ultimate Gallery Master Short Code [UGML].
 */
require_once("ultimate-gallery-master-lite-shortcode.php");

/*	'Media Button' code for Page or Post */
add_action('media_buttons_context', 'ugml_add_ugml_custom_button');
add_action('admin_footer', 'ugml_add_ugml_inline_popup_content');

function ugml_add_ugml_custom_button($context) {
  $img = plugins_url( '/images/gallery.png' , __FILE__ );
  $container_id = 'UGML';
  $title =  __('Select Gallery to insert into post or page','UGML_TEXT_DOMAIN') ;
  $context = '<a class="button button-primary thickbox"  title="'. __("Select Gallery to insert into post or page",'UGML_TEXT_DOMAIN').'"
  href="#TB_inline?width=400&inlineId='.$container_id.'">
		<span class="wp-media-buttons-icon" style="background: url('.esc_url( $img ).'); background-repeat: no-repeat; background-position: left bottom;"></span>
	'. __("Ultimate Shortcodes",'UGML_TEXT_DOMAIN').'
	</a>';
  return $context;
}

function ugml_add_ugml_inline_popup_content() {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#ugml_galleryinsert').on('click', function() {
			var id = jQuery('#ugml-gallery-select option:selected').val();
			window.send_to_editor('<p>[UGML id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>

	<div id="UGML" style="display:none;">
	  <h3><?php _e('Select Any Gallery to Insert Into Post or page','UGML_TEXT_DOMAIN');?></h3>
	  <?php
		$all_posts = wp_count_posts( 'ugml_cpt')->publish;
		$args = array('post_type' => 'ugml_cpt', 'posts_per_page' =>$all_posts);
		global $ugml_galleries;
		$ugml_galleries = new WP_Query( $args );
		if( $ugml_galleries->have_posts() ) { ?>
			<select id="ugml-gallery-select">
				<?php
				while ( $ugml_galleries->have_posts() ) : $ugml_galleries->the_post(); ?>
				<option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
				<?php
				endwhile;
				?>
			</select>
			<button class='button primary' id='ugml_galleryinsert'><?php _e('Insert Gallery Shortcode','UGML_TEXT_DOMAIN');?></button>
			<?php
		} else {
			_e('No Gallery found','UGML_TEXT_DOMAIN');
		}
		?>
	</div>
	<?php
}

function ugml_get_gallery_value($PostId){
	$UGML_Default_Options = array(
		'UGML_Grid_Layout'  			=> 'classic',
		'UGML_Grid_Orientation'			=> 'Vertical',
		'UGML_cvThumbnail'				=> 'animtext',
		'UGML_maxWidth'					=> '1600',
		'UGML_maxHeight'				=> '600',
		'UGML_openLink'					=>  '_blank',
		'UGML_Font_Style'				=> 'Arial',
		'UGML_disableThumbnails'		=> 'no',
		'UGML_hoverColor' 				=> '#720004',
		'UGML_Color_Opacity'        	=> 0.8,	
		'UGML_imageHoverTextColor'		=> '#ffffff',
		'UGML_useIconButtons'			=> 'yes',
		'UGML_IconStyle'				=> 'no',
		'UGML_thumbnailBorderSize'		=> 0,
		'UGML_spaceBwThumbnails'		=> 5,
		'UGML_showMenu'					=> 'yes',
		'UGML_menuBgColor'				=> '#720004',
		'UGML_showSearchBox'			=> 'yes',
		'UGML_menuPosition'				=> 'right',
		'UGML_searchLabel'				=> 'Search',
		'UGML_searchNotFoundLabel'		=> 'NOTHING FOUND!',
		'UGML_showZoomButton'			=> 'yes',
		'UGML_showDescriptionButton'	=> 'yes',
		'UGML_descriptionByDefault'		=> 'yes',
		'UGML_Custom_CSS'				=> ''
	);
	
	$UGML_Settings = "UGML_Gallery_Settings_".$PostId;
	$UGML_Settings = unserialize(get_post_meta( $PostId, $UGML_Settings, true));
	
	$UGML_Settings = wp_parse_args($UGML_Settings , $UGML_Default_Options);
	
	return $UGML_Settings;
}
?>