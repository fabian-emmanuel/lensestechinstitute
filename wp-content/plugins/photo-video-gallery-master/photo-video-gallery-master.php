<?php
/**
 * Plugin Name: Photo Video Gallery Master
 * Plugin URI: http://demo.webhuntinfotech.com/demo?theme=pvgm-pro
 * Description: Display your WordPress content like Photo, Video, Link, Image etc in Gallery format With CSS3 Hover Animation & Display With Lightbox.
 * Author: WebHunt Infotech
 * Author URI: http://www.webhuntinfotech.com/
 * Version: 1.5.3
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
} 

/** Constant Variable  */
define("PVGM_PLUGIN_URL", plugin_dir_url(__FILE__));

add_action('plugins_loaded', 'PVGM_GetReadyTranslation');
function PVGM_GetReadyTranslation() {
	load_plugin_textdomain('PVGM_TEXT_DOMAIN', FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

function pvgm_get_plugin_version() {
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}

/**
* Crop Images In Desire Format
*/
add_image_size( 'PVGM_gallery_admin_thumb', 300, 300, array( 'top', 'center' ) );
add_image_size( 'PVGM_gallery_admin_circle', 400, 400, array( 'top', 'center' ) );
add_image_size( 'PVGM_gallery_admin_medium', 400,9999,array( 'top', 'center' ) );


/** Clean widget while add shortcode in widget area */
add_filter( 'widget_display_callback', 'pvgm_clean_widget_display_callback', 10, 3 );
function pvgm_clean_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}

// Function To Remove Feature Image
function PVGM_remove_image_box() {
	remove_meta_box('postimagediv','pvgm_gallery','side');
}
add_action('do_meta_boxes', 'PVGM_remove_image_box');

/**	 Short Code Detach Function To UpLoad JS And CSS	*/
function PVGM_ShortCodeDetect() {
	/**  js scripts */
		wp_enqueue_script('jquery');

	/**  Load Light Box Swipebox JS CSS  */
		wp_enqueue_style('PVGM-swipe-css', PVGM_PLUGIN_URL.'lightbox/swipebox/swipebox.css');
		wp_enqueue_script('PVGM-swipe-js', PVGM_PLUGIN_URL.'lightbox/swipebox/jquery.swipebox.min.js', array('jquery'));

	/**  css scripts  */
	   wp_enqueue_style('PVGM-boot-strap-css', PVGM_PLUGIN_URL.'css/bootstrap.css');
	   wp_enqueue_style('pvgm-effects-css', PVGM_PLUGIN_URL.'css/pvgm-effects.css');
}
add_action( 'wp_enqueue_scripts', 'PVGM_ShortCodeDetect' );
add_filter( 'widget_text', 'do_shortcode' );

class PVGM {
    private static $instance;
    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

	private function __construct() {
        add_action('admin_print_scripts-post.php', array(&$this, 'pvgm_admin_print_scripts'));
        add_action('admin_print_scripts-post-new.php', array(&$this, 'pvgm_admin_print_scripts'));
        add_shortcode('pvgmgallery', array(&$this, 'shortcode'));
        if (is_admin()) {
			add_action('init', array(&$this, 'PhotoGalleryPlugin'), 1);
			add_action('admin_menu', array(&$this, 'pvgm_SettingsPage'), 1);
			add_action('add_meta_boxes', array(&$this, 'add_all_pvgm_meta_boxes'));
			add_action('admin_init', array(&$this, 'add_all_pvgm_meta_boxes'), 1);
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this,'pvgm_activate_sublink') );

			add_action('save_post', array(&$this, 'PVGM_image_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'PVGM_settings_meta_save'), 9, 1);

			add_action('wp_ajax_PVGMgallery_get_thumbnail', array(&$this, 'ajax_get_thumbnail'));
		}
    }
	
	public function pvgm_activate_sublink($links){
		$added_link_1 = '<a href="https://www.webhuntinfotech.com/plugin/photo-video-gallery-master-pro/" style="font-weight:700; color:#f44336" target="_blank">Go Pro</a>';
		$added_link_2 = '<a href="edit.php?post_type=pvgm_gallery">Settings</a>';
		array_unshift( $links, $added_link_1, $added_link_2 );

		return $links;
	}

	//Required JS & CSS
	public function pvgm_admin_print_scripts() {
		if ( 'pvgm_gallery' == $GLOBALS['post_type'] ) {
			wp_enqueue_media();
			//custom add image box and form css
			wp_enqueue_style('meta-css', PVGM_PLUGIN_URL.'css/meta.css');
			wp_enqueue_style('smart-forms.css', PVGM_PLUGIN_URL.'css/smart-forms.css');
			
			wp_enqueue_script('media-upload');
			wp_enqueue_script('media-uploader-js', PVGM_PLUGIN_URL . 'js/multiple-media-uploader.js', array('jquery'));
		}
	}

	// Register Custom Post Type
	public function PhotoGalleryPlugin() {
		$labels = array(
			'name' => __('Photo Video Gallery Master','PVGM_TEXT_DOMAIN' ),
			'singular_name' => __('Photo Video Gallery Master','PVGM_TEXT_DOMAIN' ),
			'add_new' => __('Add New Gallery', 'PVGM_TEXT_DOMAIN' ),
			'add_new_item' => __('Add New Gallery', 'PVGM_TEXT_DOMAIN' ),
			'edit_item' => __('Edit Gallery', 'PVGM_TEXT_DOMAIN' ),
			'new_item' => __('New Gallery', 'PVGM_TEXT_DOMAIN' ),
			'view_item' => __('View Gallery', 'PVGM_TEXT_DOMAIN' ),
			'search_items' => __('Search Gallery', 'PVGM_TEXT_DOMAIN' ),
			'not_found' => __('No Gallery found', 'PVGM_TEXT_DOMAIN' ),
			'not_found_in_trash' => __('No Gallery found in Trash', 'PVGM_TEXT_DOMAIN' ),
			'parent_item_colon' => __('Parent Gallery:', 'PVGM_TEXT_DOMAIN' ),
			'all_items' => __('All Galleries', 'PVGM_TEXT_DOMAIN' ),
			'menu_name' => __('Photo Video Gallery Master', 'PVGM_TEXT_DOMAIN' ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title','thumbnail'),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-format-gallery',
			'show_in_nav_menus' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => false,
			'capability_type' => 'post'
		);

        register_post_type( 'pvgm_gallery', $args );
        add_filter( 'manage_edit-pvgm_gallery_columns', array(&$this, 'pvgm_gallery_columns' )) ;
        add_action( 'manage_pvgm_gallery_posts_custom_column', array(&$this, 'pvgm_gallery_manage_columns' ), 10, 2 );
	}
	
	function pvgm_SettingsPage() {
		add_submenu_page(
			'edit.php?post_type=pvgm_gallery',
			__( 'Need Help?', 'PVGM_TEXT_DOMAIN' ),
			__( 'Need Help?', 'PVGM_TEXT_DOMAIN' ),
			'manage_options',
			'pvgm_help_page',
			array(&$this, 'pvgm_help_page_callback' )
		);
		
		add_submenu_page(
			'edit.php?post_type=pvgm_gallery',
			__( 'Recommendation', 'PVGM_TEXT_DOMAIN' ),
			__( 'Recommendation', 'PVGM_TEXT_DOMAIN' ),
			'manage_options',
			'pvgm_recommend_page',
			array(&$this, 'pvgm_recommend_page_callback' )
		);
	}
	
	/**
	 * Display callback for the submenu page.
	 */
	function pvgm_help_page_callback() {
		wp_enqueue_style('pvgm-help-css', PVGM_PLUGIN_URL.'css/help-page.css');
		require_once('help-page.php');
	}
	
	function pvgm_recommend_page_callback() {
		wp_enqueue_style( 'pvgm-recommend-css', PVGM_PLUGIN_URL . 'css/recommend.css' );
		require_once('recommendations.php');
	}

	function pvgm_gallery_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'All Saved Galleries','PVGM_TEXT_DOMAIN' ),
            'shortcode' => __( 'Galleries Shortcode','PVGM_TEXT_DOMAIN' ),
            'date' => __( 'Date','PVGM_TEXT_DOMAIN' )
        );
        return $columns;
    }

    function pvgm_gallery_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input type="text" name="gallery_shortcode" value="[PVGM id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }

	public function add_all_pvgm_meta_boxes() {
		add_meta_box( __('Add Images', 'PVGM_TEXT_DOMAIN'), __('Add Images', 'PVGM_TEXT_DOMAIN'), array(&$this, 'PVGM_generate_add_image_meta_box_function'), 'pvgm_gallery', 'normal', 'low' );
		add_meta_box( __('Apply Setting On Gallery', 'PVGM_TEXT_DOMAIN'), __('Apply Setting On Gallery', 'PVGM_TEXT_DOMAIN'), array(&$this, 'PVGM_settings_meta_box_function'), 'pvgm_gallery', 'normal', 'low');
		add_meta_box ( __('Gallery Shortcode', 'PVGM_TEXT_DOMAIN'), __('Gallery Shortcode', 'PVGM_TEXT_DOMAIN'), array(&$this, 'PVGM_shotcode_meta_box_function'), 'pvgm_gallery', 'side', 'low');

		// Rate Us Meta Box
		add_meta_box(__('Show us some love, Rate Us', 'PVGM_TEXT_DOMAIN') , __('Show us some love, Rate Us', 'PVGM_TEXT_DOMAIN'), array(&$this,'Rate_us_meta_box_pvgm'), 'pvgm_gallery', 'side', 'low');

		// Pro Features Meta Box
		add_meta_box(__('PRO Features List', 'PVGM_TEXT_DOMAIN') , __('PRO Features List', 'PVGM_TEXT_DOMAIN'), array(&$this,'pvgm_pro_features'), 'pvgm_gallery', 'side', 'low');
	}

	// Rate Us Meta Box Function
	function Rate_us_meta_box_pvgm() { ?>
		<div align="center">
			<p><a href="https://wordpress.org/support/plugin/photo-video-gallery-master/reviews/?filter=5" target="_blank"><?php _e('Please Review & Rate Us On WordPress','PVGM_TEXT_DOMAIN'); ?></a></p>
			<div class="stars">
				<a href="https://wordpress.org/support/plugin/photo-video-gallery-master/reviews/?filter=5" target="_blank"><div class="imgStar"></div></a>
			</div>
		</div>
		<div style="text-align:center;margin-bottom:15px;margin-top:25px;">
			<a href="https://wordpress.org/support/plugin/photo-video-gallery-master/reviews/?filter=5" target="_blank" title="rate us" class="btn-web button-4"><?php _e('RATE US','PVGM_TEXT_DOMAIN'); ?></a>
		</div>
		<?php
	}

	function pvgm_pro_features(){
	?>
		<ul style="">
			<li class="plan-feature">(1) <?php _e('100% Responsive Design.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(2) <?php _e('10 Beautiful Transition Effects.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(3) <?php _e('Rectangular/Circular Image Design Layout.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(4) <?php _e('Isotope/Masonry Effects.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(5) <?php _e('Two, Three and Four Column Gallery Layout.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(6) <?php _e('Photo/Image Gallery.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(7) <?php _e('Youtube/Vimeo/Self Hosted Video.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(8) <?php _e('Play Flash File with Master Ligthbox.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(9) <?php _e('Extrenal Link Gallery.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(10) <?php _e('Unlimited Color Options.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(11) <?php _e('3 Types Of Lightbox.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(12) <?php _e('Multiple Image Uploader.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(13) <?php _e('Drag and Drop Image Position.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(14) <?php _e('Each Gallery Unique Shortcode [PVGMP id=xxx].','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(15) <?php _e('Individual Gallery Setting Panel.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(16) <?php _e('Shortcode Button on Post and Page.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(17) <?php _e('Hover Color Opacity.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(18) <?php _e('Hide/Show Gallery Title and Image Label.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(19) <?php _e('Hide/Show Gallery Description.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(20) <?php _e('Optional Read More Button.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(21) <?php _e('Image Border Settings.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(22) <?php _e('Font Typography Option.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(23) <?php _e('500+ of Google Fonts Style.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(24) <?php _e('Custom CSS Option.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(25) <?php _e('All Major Device Compatible – iPhone, iPad, Tablets, PC.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(26) <?php _e('Translation Ready.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(27) <?php _e('Updates and Premium Supports.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(28) <?php _e('Extensive Documentation.','PVGM_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(29) <?php _e('And many more..','PVGM_TEXT_DOMAIN'); ?></li>
		</ul>
	<?php
	}

	/**
	 * This function display Add New Image interface
	 * Also loads all saved gallery photos into gallery
	 */
    public function PVGM_generate_add_image_meta_box_function($post) { ?>
			<div class="" style="padding:20px;text-align: center;">
			  <a  href="https://www.webhuntinfotech.com/photo-video-gallery-master-documentation/" target="_blank" class="btn-web button-1"><?php _e('Documention (Lite)','PVGM_TEXT_DOMAIN'); ?></a>
			  <a href="http://demo.webhuntinfotech.com/demo?theme=pvgm-pro" target="_blank" class="btn-web button-2"><?php _e('View Live Demo (PRO)','PVGM_TEXT_DOMAIN'); ?></a>
			  <a href="http://webhuntinfotech.com/amember/signup/pvgmp" target="_blank" class="btn-web button-3"><?php _e('Upgrade to PRO','PVGM_TEXT_DOMAIN'); ?></a>
			</div>
		<div >
			<div class="pvgm-tips-div">
				<p><strong><?php _e('Tips','PVGM_TEXT_DOMAIN'); ?>:</strong> <?php _e('Upload all gallery images using Add New Image button. Do not use/add pre-uploaded images which are uploaded previously using Media/Post/Page. Minimum Dimensions for Upload Image is 400*400.','PVGM_TEXT_DOMAIN'); ?></p>
			</div>
			<input id="PVGM_delete_all_button" class="button" type="button" value="Remove All Images" rel="">
			<input type="hidden" id="PVGM_wl_action" name="PVGM_wl_action" value="PVGM-save-settings">

			<!--Add New Image Button-->
			<div class="add_pvgm_new_image" id="pvgm_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select">
				<div class="dashicons dashicons-plus"></div>
				<p>
					<?php _e('Add New Media', 'PVGM_TEXT_DOMAIN'); ?>
				</p>
			</div>

            <ul id="pvgm_gallery_thumbs" class="clearfix">
				<?php
				/* Load saved photos */
				$WPGP_AllPhotosDetails = unserialize(get_post_meta( $post->ID, 'PVGM_all_photos_details', true));
				$TotalImages =  get_post_meta( $post->ID, 'PVGM_total_images_count', true );
				if($TotalImages) {
					foreach($WPGP_AllPhotosDetails as $WPGP_SinglePhotoDetails) {
						$name = $WPGP_SinglePhotoDetails['PVGM_image_label'];
						$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
						$url = $WPGP_SinglePhotoDetails['PVGM_image_url'];
						$url1 = $WPGP_SinglePhotoDetails['PVGM_gallery_admin_thumb'];
						$url2 = $WPGP_SinglePhotoDetails['PVGM_gallery_admin_medium'];
						$circle = $WPGP_SinglePhotoDetails['PVGM_gallery_admin_circle'];
						$video = $WPGP_SinglePhotoDetails['PVGM_video_link'];
						$link = $WPGP_SinglePhotoDetails['PVGM_external_link'];
						$type = $WPGP_SinglePhotoDetails['PVGM_portfolio_type'];
						$description = $WPGP_SinglePhotoDetails['PVGM_image_descp'];
						if(isset($WPGP_SinglePhotoDetails['PVGM_image_alt'])){
							$alt = $WPGP_SinglePhotoDetails['PVGM_image_alt'];
						}else{
							$alt = "";
						}
						?>
						<li class="pvgm-image-entry" id="pvgm_img">
							<a class="image_gallery_remove pvgmgallery_remove" href="#gallery_remove" id="pvgm_remove_bt" ><img src="<?php echo  esc_url(PVGM_PLUGIN_URL.'images/image-close-icon.png'); ?>" /></a>
							<div class="pvgm-admin-inner-div1" >
								<img src="<?php echo esc_url($url1); ?>" class="pvgm-meta-image" alt=""  style="">
								<input type="hidden" id="unique_string[]" name="unique_string[]" value="<?php echo esc_attr($UniqueString); ?>" />
								<p>
									<label><?php _e('Display Type','PVGM_TEXT_DOMAIN')?></label>
									<select name="PVGM_portfolio_type[]" id="PVGM_portfolio_type[]" style="width:100%; margin-top:5px;">
										<optgroup label="Select Type">
											<option value="image" <?php if($type == 'image') echo "selected=selected"; ?>> <?php _e('Image','PVGM_TEXT_DOMAIN')?></option>
											<option value="video" <?php if($type == 'video') echo "selected=selected"; ?>> <?php _e('Video','PVGM_TEXT_DOMAIN')?></option>
											<option value="link" <?php if($type == 'link') echo "selected=selected"; ?>> <?php _e('Link','PVGM_TEXT_DOMAIN')?></option>
										</optgroup>
									</select>
								</p>
							</div>
							<div class="pvgm-admin-inner-div2" >

								<input type="text" id="PVGM_image_url[]" name="PVGM_image_url[]" class="pvgm_label_text"  value="<?php echo esc_url($url); ?>"  readonly="readonly" style="display:none;" />
								<input type="text" id="PVGM_gallery_admin_thumb[]" name="PVGM_gallery_admin_thumb[]" class="pvgm_label_text"  value="<?php echo esc_url($url1); ?>"  readonly="readonly" style="display:none;" />
								<input type="text" id="PVGM_gallery_admin_medium[]" name="PVGM_gallery_admin_medium[]" class="pvgm_label_text"  value="<?php echo esc_url($url2); ?>"  readonly="readonly" style="display:none;" />
								<input type="text" id="PVGM_gallery_admin_circle[]" name="PVGM_gallery_admin_circle[]" class="pvgm_label_text"  value="<?php echo esc_url($circle); ?>"  readonly="readonly" style="display:none;" />
								<p>
									<div class="pvgm_label"><label ><?php _e('Image Label','PVGM_TEXT_DOMAIN')?></label></div>
									<input type="text" id="PVGM_image_label[]" name="PVGM_image_label[]" value="<?php echo esc_attr($name); ?>" placeholder="Enter Image Label Name" class="pvgm_label_text">
								</p>
								<p>
									<label class="pvgm_label labelspace" style="vertical-align:top;"><?php _e('Description','PVGM_TEXT_DOMAIN')?></label>
									<textarea id="PVGM_image_descp[]" name="PVGM_image_descp[]" class="pvgm_textarea" placeholder="Enter Image Description"><?php echo $description; ?></textarea>
								</p>
								<p>
									<div class="pvgm_label"><label ><?php _e('Image Alt','PVGM_TEXT_DOMAIN')?></label></div>
									<input type="text" id="PVGM_image_alt[]" name="PVGM_image_alt[]" value="<?php echo esc_attr($alt); ?>" placeholder="Enter Image Alt Text" class="pvgm_label_text">
								</p>
								<p>
									<label class="pvgm_label"><?php _e('Video URL','PVGM_TEXT_DOMAIN')?></label>
									<input type="text" id="PVGM_video_link[]" name="PVGM_video_link[]" value="<?php echo esc_url($video); ?>" placeholder="Enter Youtube/Vimeo Video URL" class="pvgm_label_text">
								</p>
								<p>
									<label class="pvgm_label"><?php _e('External Link','PVGM_TEXT_DOMAIN')?></label>
									<input type="text" id="PVGM_external_link[]" name="PVGM_external_link[]" value="<?php echo esc_url($link); ?>" placeholder="Enter External Link URL" class="pvgm_label_text">
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

		<div style="clear:left;"></div>
        <?php	
    }
	
	/**
	 * Gallery settings metabox funtion
	 */
    public function PVGM_settings_meta_box_function($post) {
		require_once('gallery-setting-metabox.php');
	}

	public function PVGM_shotcode_meta_box_function() { ?>
		<p><?php _e("Use below shortcode in any Page/Post to publish your gallery", 'PVGM_TEXT_DOMAIN');?></p>
		<input type="text" name="PVGM_short_code" value="<?php echo "[PVGM id=".get_the_ID()."]"; ?>" readonly="readonly" >
		<?php
	}

	public function admin_thumb($id) {
		$image  = wp_get_attachment_image_src($id, 'PVGM_gallery_admin_original', true);
		$image1 = wp_get_attachment_image_src($id, 'PVGM_gallery_admin_thumb', true);
		$image2 = wp_get_attachment_image_src($id, 'PVGM_gallery_admin_medium', true);
		$circle = wp_get_attachment_image_src($id, 'PVGM_gallery_admin_circle', true);
		$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        ?>
		<li class="pvgm-image-entry" id="pvgm_img">
			<a class="image_gallery_remove pvgmgallery_remove" href="#gallery_remove" id="pvgm_remove_bt" ><img src="<?php echo  esc_url(PVGM_PLUGIN_URL.'images/image-close-icon.png'); ?>" /></a>
			<div class="pvgm-admin-inner-div1" >
				<img src="<?php echo esc_url($image1[0]); ?>" class="pvgm-meta-image">
				<p>
					<label><?php _e('Display Type','PVGM_TEXT_DOMAIN')?></label>
					<select name="PVGM_portfolio_type[]" id="PVGM_portfolio_type[]" style="width:100%; margin-top:5px;">
						<optgroup label="Select Type">
							<option value="image" selected="selected"> <?php _e('Image','PVGM_TEXT_DOMAIN')?></option>
							<option value="video"> <?php _e('Video','PVGM_TEXT_DOMAIN')?></option>
							<option value="link"> <?php _e('Link','PVGM_TEXT_DOMAIN')?></option>
						</optgroup>
					</select>
				</p>
			</div>
			<div class="pvgm-admin-inner-div2" >
				<input type="text" id="PVGM_image_url[]" name="PVGM_image_url[]" class="pvgm_label_text"  value="<?php echo esc_url($image[0]); ?>"  readonly="readonly" style="display:none;" />
				<input type="text" id="PVGM_gallery_admin_thumb[]" name="PVGM_gallery_admin_thumb[]" class="pvgm_label_text"  value="<?php echo esc_url($image1[0]); ?>"  readonly="readonly" style="display:none;" />
				<input type="text" id="PVGM_gallery_admin_medium[]" name="PVGM_gallery_admin_medium[]" class="pvgm_label_text"  value="<?php echo esc_url($image2[0]); ?>"  readonly="readonly" style="display:none;" />
				<input type="text" id="PVGM_gallery_admin_circle[]" name="PVGM_gallery_admin_circle[]" class="pvgm_label_text"  value="<?php echo esc_url($circle[0]); ?>"  readonly="readonly" style="display:none;" />
				<p>
					<label class="pvgm_label"><?php _e('Image Label','PVGM_TEXT_DOMAIN')?></label>
					<input type="text" id="PVGM_image_label[]" name="PVGM_image_label[]" placeholder="Enter Image Label Name" class="pvgm_label_text">
				</p>
				<p>
					<label class="pvgm_label labelspace" style="vertical-align:top;"><?php _e('Description','PVGM_TEXT_DOMAIN')?></label>
					<textarea id="PVGM_image_descp[]" name="PVGM_image_descp[]" class="pvgm_textarea" placeholder="Enter Image Description"></textarea>
				</p>
				<p>
					<label class="pvgm_label"><?php _e('Image Alt','PVGM_TEXT_DOMAIN')?></label>
					<input type="text" id="PVGM_image_alt[]" name="PVGM_image_alt[]" placeholder="Enter Image Alt Text" class="pvgm_label_text">
				</p>
				<p>
					<label class="pvgm_label"><?php _e('Video URL','PVGM_TEXT_DOMAIN')?> </label>
					<input type="text" id="PVGM_video_link[]" name="PVGM_video_link[]" placeholder="Enter Youtube/Vimeo Video URL" class="pvgm_label_text">
				</p>
				<p>
					<label class="pvgm_label"><?php _e('External Link','PVGM_TEXT_DOMAIN')?></label>
					<input type="text" id="PVGM_external_link[]" name="PVGM_external_link[]" placeholder="Enter External Link URL" class="pvgm_label_text">
				</p>
			</div>
		</li>
        <?php
    }

    public function ajax_get_thumbnail() {
        echo $this->admin_thumb($_POST['imageid']);
        die;
    }

    public function PVGM_image_meta_box_save($PostID) {
		if(isset($PostID) && isset($_POST['PVGM_wl_action'])) {
			if(isset($_POST['PVGM_image_url'])){
				$TotalImages = count($_POST['PVGM_image_url']);
				$ImagesArray = array();
				if($TotalImages) {
					
					for($i=0; $i < $TotalImages; $i++) {
						$image_label = stripslashes($_POST['PVGM_image_label'][$i]);
						$url = $_POST['PVGM_image_url'][$i];
						$url1 = $_POST['PVGM_gallery_admin_thumb'][$i];
						$url2 = $_POST['PVGM_gallery_admin_medium'][$i];
						$circle = $_POST['PVGM_gallery_admin_circle'][$i];
						$video = $_POST['PVGM_video_link'][$i];
						$link = $_POST['PVGM_external_link'][$i];
						$type = $_POST['PVGM_portfolio_type'][$i];
						$description = $_POST['PVGM_image_descp'][$i];
						$alt = $_POST['PVGM_image_alt'][$i];
						$ImagesArray[] = array(
							'PVGM_image_label' => $image_label,
							'PVGM_image_url' => esc_url_raw( $url ),
							'PVGM_gallery_admin_thumb' => esc_url_raw( $url1 ),
							'PVGM_gallery_admin_medium' => esc_url_raw( $url2 ),
							'PVGM_gallery_admin_circle' => esc_url_raw( $circle ),
							'PVGM_video_link' => esc_url_raw( $video ),
							'PVGM_external_link' => esc_url_raw( $link ),
							'PVGM_portfolio_type' => sanitize_text_field( $type ),
							'PVGM_image_descp' => stripslashes(esc_attr($description)),
							'PVGM_image_alt' => stripslashes(esc_attr($alt))
						);
					}
					
					update_post_meta($PostID, 'PVGM_all_photos_details', serialize($ImagesArray));
					update_post_meta($PostID, 'PVGM_total_images_count', $TotalImages);
				}

			}else {
				$TotalImages = 0;
				update_post_meta($PostID, 'PVGM_total_images_count', $TotalImages);
				$ImagesArray = array();
				update_post_meta($PostID, 'PVGM_all_photos_details', serialize($ImagesArray));
			}
		}
    }

	//save settings meta box values
	public function PVGM_settings_meta_save($PostID) {
	  if(isset($PostID) && isset($_POST['PVGM_Show_Gallery_Title'])){
		$PVGM_Effect  				= sanitize_text_field( $_POST['PVGM_Effect'] );
		$PVGM_Color 				= sanitize_text_field( $_POST['PVGM_Color'] );
		$PVGM_Label_Bg_Color 		= sanitize_text_field( $_POST['PVGM_Label_Bg_Color'] );
		$PVGM_Label_Text_Color 		= sanitize_text_field( $_POST['PVGM_Label_Text_Color'] );
		$PVGM_Descp_Text_Color 		= sanitize_text_field( $_POST['PVGM_Descp_Text_Color'] );
		$PVGM_Button_Bg_Color 		= sanitize_text_field( $_POST['PVGM_Button_Bg_Color'] );
		$PVGM_Button_Text_Color 	= sanitize_text_field( $_POST['PVGM_Button_Text_Color'] );
		$PVGM_Show_Gallery_Title    = sanitize_text_field( $_POST['PVGM_Show_Gallery_Title'] );
		$PVGM_Show_Image_Label      = sanitize_text_field( $_POST['PVGM_Show_Image_Label'] );
		$PVGM_Show_Image_Descp      = sanitize_text_field( $_POST['PVGM_Show_Image_Descp'] );
		$PVGM_Show_Image_Button	   	= sanitize_text_field( $_POST['PVGM_Show_Image_Button'] );
		$PVGM_Button_Radious	   	= sanitize_text_field( $_POST['PVGM_Button_Radious'] );
		$PVGM_Button_Text	   		= stripslashes(esc_attr($_POST['PVGM_Button_Text']));
		$PVGM_Gallery_Layout        = sanitize_text_field( $_POST['PVGM_Gallery_Layout'] );
		$PVGM_Open_Link		        = sanitize_text_field( $_POST['PVGM_Open_Link'] );
		$PVGM_Font_Style           	= sanitize_text_field( $_POST['PVGM_Font_Style'] );
		$PVGM_Lable_Font_Size      	= sanitize_text_field( $_POST['PVGM_Lable_Font_Size']);
		$PVGM_tlineheight      		= sanitize_text_field( $_POST['PVGM_tlineheight']);
		$PVGM_Desc_Font_Size      	= sanitize_text_field($_POST['PVGM_Desc_Font_Size'] );
		$PVGM_Light_Box           	= sanitize_text_field( $_POST['PVGM_Light_Box'] );
		$PVGM_Image_Border          = sanitize_text_field( $_POST['PVGM_Image_Border'] );
		$PVGM_Custom_CSS    		= wp_filter_nohtml_kses( $_POST['PVGM_Custom_CSS'] );
		$PVGM_Settings_Array = serialize( array(
			'PVGM_Effect'          		    => $PVGM_Effect,
			'PVGM_Color'         		    => $PVGM_Color,
			'PVGM_Label_Bg_Color'       	=> $PVGM_Label_Bg_Color,
			'PVGM_Label_Text_Color'     	=> $PVGM_Label_Text_Color,
			'PVGM_Descp_Text_Color'     	=> $PVGM_Descp_Text_Color,
			'PVGM_Button_Bg_Color'     		=> $PVGM_Button_Bg_Color,
			'PVGM_Button_Text_Color'     	=> $PVGM_Button_Text_Color,
			'PVGM_Show_Gallery_Title'		=> $PVGM_Show_Gallery_Title,
			'PVGM_Show_Image_Label'    		=> $PVGM_Show_Image_Label,
			'PVGM_Show_Image_Descp'     	=> $PVGM_Show_Image_Descp,
			'PVGM_Show_Image_Button'     	=> $PVGM_Show_Image_Button,
			'PVGM_Button_Radious'     		=> $PVGM_Button_Radious,
			'PVGM_Button_Text'     			=> $PVGM_Button_Text,
			'PVGM_Gallery_Layout'      		=> $PVGM_Gallery_Layout,
			'PVGM_Open_Link'      			=> $PVGM_Open_Link,
			'PVGM_Font_Style'				=> $PVGM_Font_Style,
			'PVGM_Lable_Font_Size'			=> $PVGM_Lable_Font_Size,
			'PVGM_tlineheight'				=> $PVGM_tlineheight,
			'PVGM_Desc_Font_Size'			=> $PVGM_Desc_Font_Size,
			'PVGM_Light_Box'          		=> $PVGM_Light_Box,
			'PVGM_Image_Border'         	=> $PVGM_Image_Border,
			'PVGM_Custom_CSS'   			=> $PVGM_Custom_CSS
		) );
		$PVGM_Gallery_Settings = "PVGM_Gallery_Settings_".$PostID;
		update_post_meta($PostID, $PVGM_Gallery_Settings, $PVGM_Settings_Array);
	  }
	}
}

global $PVGM;
$PVGM = PVGM::forge();

/**
 * Simple Gallery Short Code [PVGM].
 */
require_once("gallery-short-code.php");

/**
 * Add the media button to the editor
 */
add_action('media_buttons', 'pvgm_add_media_custom_button');
add_action('admin_footer', 'add_pvgm_inline_popup_content');
 
function pvgm_add_media_custom_button() {
	$title =  __("Photo Video Gallery Master ShortCode",'PVGM_TEXT_DOMAIN');
	$button = __(" PVGM-Lite Shortcode",'PVGM_TEXT_DOMAIN');
	$img = plugins_url( '/images/gallery.png' , __FILE__ );
	$container_id = 'PVGM';
	
	echo '<a class="button button-primary thickbox"  title="'. $title .'" href="#TB_inline?width=400&inlineId='.$container_id.'">
		<span class="wp-media-buttons-icon" style="background: url('.esc_url( $img ).'); background-repeat: no-repeat; background-position: left bottom;"></span>'. $button .'</a>';
}

function add_pvgm_inline_popup_content(){
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#pvgm_sliderinsert').on('click', function() {
			var id = jQuery('#pvgm-gallery-select option:selected').val();
			window.send_to_editor('<p>[PVGM id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>
	
	<?php
	echo '<div id="PVGM" style="display:none;">';
		$all_posts = wp_count_posts( 'pvgm_gallery')->publish;
		$args = array('post_type' => 'pvgm_gallery', 'posts_per_page' =>$all_posts);
		global $pvgm_galleries;
		$pvgm_galleries = new WP_Query( $args );
		if( $pvgm_galleries->have_posts() ) { 
			echo "<h3>" . __( "Select Gallery to Insert into Page or Post", "PVGM_TEXT_DOMAIN" ) . "</h3>";
			echo "<select id='pvgm-gallery-select'>";	
			while ( $pvgm_galleries->have_posts() ) : $pvgm_galleries->the_post(); 
				echo "<option value=".get_the_ID().">". get_the_title(). "</option>";
			endwhile;
			echo "</select>";
			echo "<button class='button primary' id='pvgm_sliderinsert'>" . __( "Insert Gallery Shortcode", "PVGM_TEXT_DOMAIN" ) . "</button>";
		} else {
			_e('No Gallery found','PVGM_TEXT_DOMAIN');
		}
	echo '</div>';
}

// RGB Color Code Funtion 
function PVGM_hex2rgb( $colour ) {
	if ( $colour[0] == '#' ) {
		$colour = substr( $colour, 1 );
	}
	if ( strlen( $colour ) == 6 ) {
		list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	} elseif ( strlen( $colour ) == 3 ) {
		list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	} else {
		return false;
	}
	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );
	
	$PVGM = array($r, $g, $b);
	return $PVGM;
}

function pvgm_get_gallery_value($PostId){
	$PVGM_Default_Options = array(
		'PVGM_Effect'  				=> 'fifth',
		'PVGM_Color' 				=> '#1A78A8',
		'PVGM_Label_Bg_Color' 		=> '#000000',
		'PVGM_Label_Text_Color' 	=> '#ffffff',
		'PVGM_Descp_Text_Color' 	=> '#ffffff',
		'PVGM_Button_Bg_Color' 		=> '#000000',
		'PVGM_Button_Text_Color' 	=> '#ffffff',
		'PVGM_Show_Gallery_Title'   => 'yes',
		'PVGM_Show_Image_Label'     => 'yes',
		'PVGM_Show_Image_Descp'     => 'yes',
		'PVGM_Show_Image_Button'	=> 'yes',
		'PVGM_Button_Radious'		=> 'rectangle',
		'PVGM_Button_Text'			=> '',
		'PVGM_Gallery_Layout'       => 'col-md-6',
		'PVGM_Open_Link'        	=> '_blank',
		'PVGM_Font_Style'           => 'Arial',
		'PVGM_Lable_Font_Size'		=> '18',
		'PVGM_tlineheight'			=> '24',
		'PVGM_Desc_Font_Size'		=> '14',
		'PVGM_Light_Box'           	=> 'lightbox',
		'PVGM_Image_Border'         => 'no',
		'PVGM_Custom_CSS'			=> ''
	);
	
	$PVGM_Settings = "PVGM_Gallery_Settings_".$PostId;
	$PVGM_Settings = unserialize(get_post_meta( $PostId, $PVGM_Settings, true));
	
	$PVGM_Settings = wp_parse_args($PVGM_Settings , $PVGM_Default_Options);
	
	return $PVGM_Settings;
}
?>