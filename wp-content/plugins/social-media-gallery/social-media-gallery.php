<?php
/**
 * Plugin Name: Social Media Gallery
 * Plugin URI: http://demo.webhuntinfotech.com/social-media-gallery-pro/
 * Description: A powerful plugin to display your Social Media galleries on your WordPress site. Upgrude Premium Version for more social networks (Flickr, YouTube, Pinterest).  
 * Version: 1.5.2
 * Author: WebHunt Infotech
 * Author URI: http://webhuntinfotech.com
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/** Constant Variable */
define("SMGL_TEXT_DOMAIN","SMGL_TEXT_DOMAIN" );
define("SMGL_PLUGIN_URL", plugin_dir_url(__FILE__));

add_action('plugins_loaded', 'SMGL_GetReadyTranslation');
function SMGL_GetReadyTranslation() {
	load_plugin_textdomain('SMGL_TEXT_DOMAIN', FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

/** Clean widget while add shortcode in widget area */
add_filter( 'widget_display_callback', 'smgl_clean_widget_display_callback', 10, 3 );
function smgl_clean_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}

// Function To Remove Feature Image
add_action('do_meta_boxes', 'SMGL_remove_image_box');
function SMGL_remove_image_box() {
	remove_meta_box('postimagediv','smgl_cpt','side');
}

/** Short Code Detect Function To UpLoad JS And CSS */
function SMGL_ShortCodeDetect() {
	/** js scripts */
        wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'SMGL_ShortCodeDetect' );
add_filter( 'widget_text', 'do_shortcode' );

class SMGL {
    private static $instance;
    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

	private function __construct() {
        add_action('admin_print_scripts-post.php', array(&$this, 'smgl_admin_print_scripts'));
        add_action('admin_print_scripts-post-new.php', array(&$this, 'smgl_admin_print_scripts'));
        add_shortcode('smglgallery', array(&$this, 'shortcode'));
        if (is_admin()) {
			add_action('init', array(&$this, 'socialMediaGalleryPlugin'), 1);
			add_action('add_meta_boxes', array(&$this, 'add_all_smgl_meta_boxes'));
			add_action('admin_init', array(&$this, 'add_all_smgl_meta_boxes'), 1);
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this,'smgl_activate_sublink') );

			add_action('save_post', array(&$this, 'SMGL_image_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'SMGL_settings_meta_save'), 9, 1);
			
			add_action('wp_ajax_smglgallery_get_thumbnail', array(&$this, 'ajax_get_thumbnail'));
		}
    }
	
	public function smgl_activate_sublink($links){
		$plugin_submenu_added_link=array();		
		 $added_link = array(
		 '<a target="_blank" style="color: #ff0000; font-weight: bold; font-size: 13px;" href="https://www.webhuntinfotech.com/plugin/social-media-gallery-pro/">Upgrade to Pro</a>',
		 );
		$plugin_submenu_added_link=array_merge( $plugin_submenu_added_link, $added_link );
		$plugin_submenu_added_link=array_merge( $plugin_submenu_added_link, $links );
		return $plugin_submenu_added_link;
	}
	
	//Required JS & CSS
	public function smgl_admin_print_scripts() {
		if ( 'smgl_cpt' == $GLOBALS['post_type'] ) {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('media-uploader-js', SMGL_PLUGIN_URL . 'admin-scripts/js/multiple-media-uploader.js', array('jquery'));

			wp_enqueue_media();
			//custom add image box css
			wp_enqueue_style('image-box-css', SMGL_PLUGIN_URL.'admin-scripts/css/image-box.css');

			wp_enqueue_style('smart-forms-css', SMGL_PLUGIN_URL.'admin-scripts/css/smart-forms.css');
			wp_enqueue_script('jquery-ui-slider');
		}
	}
	
	function socialMediaGalleryPlugin() {
		register_post_type('smgl_cpt',
			array(
				'labels' => array(
					'name' => __('Social Media Gallery','SMGL_TEXT_DOMAIN' ),
					'singular_name' => __('Social Media Gallery','SMGL_TEXT_DOMAIN' ),
					'add_new' => __('Add New Gallery', 'SMGL_TEXT_DOMAIN' ),
					'add_new_item' => __('Add New Gallery', 'SMGL_TEXT_DOMAIN' ),
					'edit_item' => __('Edit Gallery', 'SMGL_TEXT_DOMAIN' ),
					'new_item' => __('New Gallery', 'SMGL_TEXT_DOMAIN' ),
					'view_item' => __('View Gallery', 'SMGL_TEXT_DOMAIN' ),
					'search_items' => __('Search Gallery', 'SMGL_TEXT_DOMAIN' ),
					'not_found' => __('No Gallery found', 'SMGL_TEXT_DOMAIN' ),
					'not_found_in_trash' => __('No Gallery found in Trash', 'SMGL_TEXT_DOMAIN' ),
					'parent_item_colon' => __('Parent Gallery:', 'SMGL_TEXT_DOMAIN' ),
					'all_items' => __('All Galleries', 'SMGL_TEXT_DOMAIN' ),
					'menu_name' => __('Social Media Gallery', 'SMGL_TEXT_DOMAIN' ),
				),
				'supports' => array('title', 'thumbnail'),
				'show_in' => true,
				'show_in_nav_menus' => false,
				'public' => false,
				'menu_icon' => 'dashicons-format-gallery',
				'show_ui' => true,
			)
		);
		add_filter( 'manage_edit-smgl_cpt_columns', array(&$this, 'smgl_gallery_columns' )) ;
        add_action( 'manage_smgl_cpt_posts_custom_column', array(&$this, 'smgl_gallery_manage_columns' ), 10, 2 );
		add_action('admin_menu', array(&$this, 'smgl_advance_setting_page')); 
	}
	
	function smgl_gallery_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Social Galleries','SMGL_TEXT_DOMAIN' ),
            'shortcode' => __( 'Gallery Shortcodes','SMGL_TEXT_DOMAIN' ),
            'date' => __( 'Date','SMGL_TEXT_DOMAIN' )
        );
        return $columns;
    }

    function smgl_gallery_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input type="text" value="[SMGP id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }
	
	function smgl_advance_setting_page() {
		add_submenu_page(
			'edit.php?post_type=smgl_cpt',
			__( 'Advanced Features <span style="color:#dab246;">PRO</span>', 'SMGL_TEXT_DOMAIN' ),
			__( 'Advanced Features <span style="color:#dab246;">PRO</span>', 'SMGL_TEXT_DOMAIN' ),
			'manage_options',
			'smgl_advance_option_page',
			array(&$this, 'smgl_advance_settings_ref_page_callback')
		);
	}
	
	/**
	 * Display callback for the submenu page.
	 */
	public function smgl_advance_settings_ref_page_callback() {
		require_once('advance-settings.php');
	}

	public function add_all_smgl_meta_boxes() {
		add_meta_box( __('Add Album', 'SMGL_TEXT_DOMAIN'), __('Add Album', 'SMGL_TEXT_DOMAIN'), array(&$this, 'SMGL_generate_add_image_meta_box_function'), 'smgl_cpt', 'normal', 'low' );
		add_meta_box( __('Apply Setting On Album', 'SMGL_TEXT_DOMAIN'), __('Apply Setting On Album', 'SMGL_TEXT_DOMAIN'), array(&$this, 'SMGL_settings_meta_box_function'), 'smgl_cpt', 'normal', 'low');
		add_meta_box ( __('Gallery Shortcode', 'SMGL_TEXT_DOMAIN'), __('Gallery Shortcode', 'SMGL_TEXT_DOMAIN'), array(&$this, 'SMGL_shotcode_meta_box_function'), 'smgl_cpt', 'side', 'low');
		
		// Rate Us Meta Box
		add_meta_box(__('Show us some love, Rate Us', 'SMGL_TEXT_DOMAIN') , __('Show us some love, Rate Us', 'SMGL_TEXT_DOMAIN'), array(&$this,'Rate_us_meta_box_smgl'), 'smgl_cpt', 'side', 'low');
		
		// Plugin Support Meta Box
		add_meta_box(__('Plugin Support', 'SMGL_TEXT_DOMAIN') , __('Plugin Support', 'SMGL_TEXT_DOMAIN'), array(&$this,'smgl_support_meta_box'), 'smgl_cpt', 'side', 'low');

		// Pro Features Meta Box
		add_meta_box(__('Pro Features', 'SMGL_TEXT_DOMAIN') , __('Pro Features', 'SMGL_TEXT_DOMAIN'), array(&$this,'smgl_pro_features'), 'smgl_cpt', 'side', 'low');
	}
	
	// Rate Us Meta Box Function
	function Rate_us_meta_box_smgl() { ?>
		<div align="center">
			<p><?php _e('Please Review & Rate Us On WordPress','SMGL_TEXT_DOMAIN'); ?></p>
			<div class="stars">
				<a href="https://wordpress.org/support/plugin/social-media-gallery/reviews/?filter=5" target="_blank"><div class="imgStar"></div></a>
			</div>
		</div>
		<div style="text-align:center;margin-bottom:15px;margin-top:25px;">
			<a href="https://wordpress.org/support/plugin/social-media-gallery/reviews/?filter=5" target="_blank" title="rate us" class="btn-web button-4"><?php _e('RATE US','SMGL_TEXT_DOMAIN'); ?></a>
		</div>
		<?php
	}
	
	// Plugin Support Meta Box
	function smgl_support_meta_box() { ?>
		<div class="" style="text-align:center;margin-bottom:40px;margin-top:25px;">	
			<a href="http://www.webhuntinfotech.com/social-media-gallery-documentation/" target="_blank" class="btn-web button-2"><?php _e('Documention (Lite)','SMGL_TEXT_DOMAIN'); ?></a>
		</div>
		<div class="" style="text-align:center;margin-bottom:40px;margin-top:25px;">
			<a href="https://wordpress.org/support/plugin/social-media-gallery/" target="_blank" class="btn-web button-1"><?php _e('Support Fourm (Lite)','SMGL_TEXT_DOMAIN'); ?></a>
		</div>
	<?php
	}

	// Pro Features Meta Box
	function smgl_pro_features(){
	?>
		<ul style="">
			<li class="plan-feature">(1) <?php _e('Support for 3 social networks from which can load and display playlists, albums, sets and more (Flickr, Youtube, Pinterest).','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(2) <?php _e('Two grid layouts included with vertical and horizontal variation (classic and infinite).','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(3) <?php _e('Beautiful hover effects.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(4) <?php _e('Super easy to use for beginners.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(5) <?php _e('Quick and easy setup.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(6) <?php _e('100% responsive design','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(7) <?php _e('Developer friendly.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(8) <?php _e('Mobile optimized.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(9) <?php _e('SEO optimized.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(10) <?php _e('Light Box View.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(11) <?php _e('Two Light box skins included.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(12) <?php _e('Single or multiple categories selection.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(13) <?php _e('Filterable categories.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(14) <?php _e('Total count on categories.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(15) <?php _e('Optional menu.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(16) <?php _e('Customizable menu position with variation based on layout.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(17) <?php _e('Optional search box.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(18) <?php _e('Optional lazy loading with load more button or scroll.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(19) <?php _e('Multiple thumbnails hide / show animation types.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(20) <?php _e('Thumbnails multimedia icons.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(21) <?php _e('Adjustable thumbnails number to display / load per set.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(22) <?php _e('Adjustable thumbnail spacings / size and much more.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(23) <?php _e('Adjustable thumbnail geometry and styling.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(24) <?php _e('Social networks sharing.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(25) <?php _e('500+ Google fonts.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(26) <?php _e('Fully customizable Lightbox.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(27) <?php _e('Custom CSS Option.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(28) <?php _e('Translation ready.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(29) <?php _e('Updates and support.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(30) <?php _e('Extensive documentation.','SMGL_TEXT_DOMAIN'); ?></li>
			<li class="plan-feature">(31) <?php _e('And many more..','SMGL_TEXT_DOMAIN'); ?></li>
		</ul>
	<?php
	}
	/**
	 * This function display Add New Album interface also loads all saved Albums 
	 */
    public function SMGL_generate_add_image_meta_box_function($post) { ?>
		<div class="" style="padding:20px;text-align: center;">
			  <a  href="http://www.webhuntinfotech.com/social-media-gallery-documentation/" target="_blank" class="btn-web button-1"><?php _e('Documention (Lite)','SMGL_TEXT_DOMAIN'); ?></a>
			  <a href="http://demo.webhuntinfotech.com/social-media-gallery-pro/" target="_blank" class="btn-web button-2"><?php _e('View Live Demo (Pro)','SMGL_TEXT_DOMAIN'); ?></a>
			  <a href="http://www.webhuntinfotech.com/webhunt_plugin/social-media-gallery-pro/" target="_blank" class="btn-web button-3"><?php _e('Upgrade To Pro','SMGL_TEXT_DOMAIN'); ?></a>
		</div>
		<div >
		<?php 
		$PostId = $post->ID;
		$SMGL_Settings = smgl_get_gallery_value($PostId);

		if($SMGL_Settings['SMGP_Grid_Layout']) {
			$SMGL_Album_Type				= $SMGL_Settings['SMGP_Album_Type'];
		}
		?>
			<table class="form-table smgl-album">
				<tr>
					<th scope="row"><label><?php _e('Album Type','SMGL_TEXT_DOMAIN')?>:</label></th>
					<td>
						<select name="SMGL_Album_Type" id="SMGL_Album_Type">
							<optgroup label="Select Album Type">
								<option value="flickr" <?php if($SMGL_Album_Type == 'flickr') echo "selected=selected"; ?>><?php _e('Flickr Gallery','SMGL_TEXT_DOMAIN')?></option>
								<option disabled ><?php _e('Pinterest Gallery (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
								<option disabled ><?php _e('Youtube Gallery (Avaliable in PRO Version)','SMGL_TEXT_DOMAIN')?></option>
							</optgroup>
						</select>
						<p class="description" style="color:#ffffff">
							<?php _e('Choose Album Type.','SMGL_TEXT_DOMAIN')?>
						</p>
					</td>
				</tr>
			</table>
			<input id="SMGL_delete_all_button" class="button" type="button" value="Remove All Albums" rel="">
			<input type="hidden" id="SMGL_wl_action" name="SMGL_wl_action" value="SMGL-save-settings">
            <ul id="smgl_gallery_thumbs" class="clearfix">
				<?php
				/* load saved Ablum Details into gallery */
				$WPGP_AllAlbumsDetails = unserialize(get_post_meta( $post->ID, 'SMGP_all_albums_details', true));
				$TotalLinks =  get_post_meta( $post->ID, 'SMGP_total_album_count', true );
				if($TotalLinks) {
					foreach($WPGP_AllAlbumsDetails as $WPGP_SingleAlbumDetails) {
						$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
						$albumName = $WPGP_SingleAlbumDetails['SMGP_albumName'];
						$albumlink = $WPGP_SingleAlbumDetails['SMGP_albumlink'];
						?>
						<li class="smgl-image-entry" id="smgl_img">
							<a class="image_gallery_remove smglgallery_remove" href="#gallery_remove" id="smgl_remove_bt" ><img src="<?php echo  esc_url(SMGL_PLUGIN_URL.'admin-scripts/img/image-close-icon.png'); ?>" /></a>
							<div class="smgl-admin-inner-div1" >
								<div class="smgl-container">
									<h2><?php _e('Flickr Album Details','SMGL_TEXT_DOMAIN')?></h2>
								</div>
								<p>
									<label class="smgl_label"><?php _e('Album Name','SMGL_TEXT_DOMAIN')?> :</label>
									<input type="text" id="SMGL_albumName[]" name="SMGL_albumName[]" value="<?php echo esc_attr($albumName); ?>" placeholder="Enter Album Name" class="smgl_label_text">
								</p>
								<p>
									<label class="smgl_label"><?php _e('Album Link','SMGL_TEXT_DOMAIN')?> ( <a href="https://www.webhuntinfotech.com/create-delete-flickr-album/" target="_blank"><?php esc_html_e('Help','SMGL_TEXT_DOMAIN')?></a> ) :</label>
									<input type="text" id="SMGL_albumlink[]" name="SMGL_albumlink[]" value="<?php echo esc_url($albumlink); ?>" placeholder="Enter Link URL" class="smgl_label_text">
								</p>
							</div>
							
						</li>
						<?php
					} // end of foreach
				} else {
					$TotalLinks = 0;
				}
				?>
            </ul>
        </div>

		<!--Add New Album Button-->
		<div class="smgl-image-entry add_smgl_new_image" id="smgl_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select" >
			<div class="dashicons dashicons-plus"></div>
			<p>
				<?php _e('Add New Album', 'SMGL_TEXT_DOMAIN'); ?>
			</p>
		</div>
		<div style="clear:left;"></div>
        <?php
    }

	/**
	 * Gallery Setting Meta Box
	 */
    public function SMGL_settings_meta_box_function($post) {
		require_once('social-media-gallery-settings.php');
	}

	public function SMGL_shotcode_meta_box_function() { ?>
		<p><?php _e("Copy and paste the shortcode directly into any WordPress Post or Page.", 'SMGL_TEXT_DOMAIN');?></p>
		<input readonly="readonly" type="text" value="<?php echo "[SMGP id=".get_the_ID()."]"; ?>">
		<?php
	}

	public function admin_thumb() {
		$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        ?>
		<li class="smgl-image-entry" id="smgl_img">
			<a class="image_gallery_remove smglgallery_remove" href="#gallery_remove" id="smgl_remove_bt" ><img src="<?php echo  esc_url(SMGL_PLUGIN_URL.'admin-scripts/img/image-close-icon.png'); ?>" /></a>
			<div class="smgl-admin-inner-div1" >
				<div class="smgl-container">
					<h2><?php _e('Flickr Album Details','SMGL_TEXT_DOMAIN')?></h2>
				</div>
				<p>
					<label class="smgl_label"><?php _e('Album Name','SMGL_TEXT_DOMAIN')?> :</label>
					<input type="text" id="SMGL_albumName[]" name="SMGL_albumName[]" placeholder="Enter Album Name" class="smgl_label_text">
				</p>
				<p>
					<label class="smgl_label"><?php _e('Album Link','SMGL_TEXT_DOMAIN')?> ( <a href="https://www.webhuntinfotech.com/create-delete-flickr-album/" target="_blank"><?php esc_html_e('Help','SMGL_TEXT_DOMAIN')?></a> ) :</label>
					<input type="text" id="SMGL_albumlink[]" name="SMGL_albumlink[]" placeholder="Enter Link URL" class="smgl_label_text">
				</p>
			</div>
		</li>
        <?php
    }

    public function ajax_get_thumbnail() {
        echo $this->admin_thumb();
        die;
    }

	//save album details meta box values
    public function SMGL_image_meta_box_save($PostID) {
		if(isset($PostID) && isset($_POST['SMGL_wl_action'])) {
			if(isset($_POST['SMGL_albumlink'])){
				$TotalLinks = count($_POST['SMGL_albumlink']);
				$AlbemArray = array();
				if($TotalLinks) {
					for($i=0; $i < $TotalLinks; $i++) {
						$albumName 			= stripslashes($_POST['SMGL_albumName'][$i]);
						$albumlink 			= $_POST['SMGL_albumlink'][$i];
						$AlbemArray[] = array(
							'SMGP_albumName' => sanitize_text_field( $albumName ),
							'SMGP_albumlink' => esc_url_raw( $albumlink )
						);
					}
					update_post_meta($PostID, 'SMGP_all_albums_details', serialize($AlbemArray));
					update_post_meta($PostID, 'SMGP_total_album_count', $TotalLinks);
				}
			}else {
				$TotalLinks = 0;
				update_post_meta($PostID, 'SMGP_total_album_count', $TotalLinks);
				$AlbemArray = array();
				update_post_meta($PostID, 'SMGP_all_albums_details', serialize($AlbemArray));
			}
		}
    }

	//save settings meta box values
	public function SMGL_settings_meta_save($PostID) {
	  if(isset($PostID) && isset($_POST['SMGL_useIconButtons'])){
		$SMGL_Album_Type  				= $_POST['SMGL_Album_Type'] ;
		$SMGL_Grid_Layout  				= $_POST['SMGL_Grid_Layout'] ;
		$SMGL_Thumbnail    				= $_POST['SMGL_Thumbnail'];
		$SMGL_disableThumbnails			= $_POST['SMGL_disableThumbnails'];
		$SMGL_hoverColor 				= $_POST['SMGL_hoverColor'];
		$SMGL_useIconButtons    		= $_POST['SMGL_useIconButtons'];
		$SMGL_IconStyle					= $_POST['SMGL_IconStyle'];
		$SMGL_spaceBwThumbnails			= $_POST['SMGL_spaceBwThumbnails'];
		$SMGL_thumbnailBorderSize		= $_POST['SMGL_thumbnailBorderSize'];
		$SMGL_Font_Style           		= $_POST['SMGL_Font_Style'];
		$SMGL_imageHoverTextColor		= $_POST['SMGL_imageHoverTextColor'];
		$SMGL_showZoomButton			= $_POST['SMGL_showZoomButton'];
		$SMGL_Custom_CSS    			= $_POST['SMGL_Custom_CSS'];
		$SMGL_Settings_Array = serialize( array(
			'SMGP_Album_Type'          		=> $SMGL_Album_Type,
			'SMGP_Grid_Layout'          	=> $SMGL_Grid_Layout,
			'SMGP_Thumbnail'          		=> $SMGL_Thumbnail,
			'SMGP_disableThumbnails'		=> $SMGL_disableThumbnails,
			'SMGP_hoverColor'         		=> $SMGL_hoverColor,
			'SMGP_useIconButtons'          	=> $SMGL_useIconButtons,
			'SMGP_IconStyle'          		=> $SMGL_IconStyle,
			'SMGP_spaceBwThumbnails'     	=> $SMGL_spaceBwThumbnails,
			'SMGP_thumbnailBorderSize'     	=> $SMGL_thumbnailBorderSize,
			'SMGP_Font_Style'				=> $SMGL_Font_Style,
			'SMGP_imageHoverTextColor'		=> $SMGL_imageHoverTextColor,
			'SMGP_showZoomButton'			=> $SMGL_showZoomButton,
			'SMGP_Custom_CSS'   			=> $SMGL_Custom_CSS
		) );

		$SMGL_Gallery_Settings = "SMGP_Gallery_Settings_".$PostID;
		update_post_meta($PostID, $SMGL_Gallery_Settings, $SMGL_Settings_Array);
	  }
	}
}

global $SMGL;
$SMGL = SMGL::forge();

/**
 * Social Gallery Short Code [SMGP].
 */
require_once("social-media-gallery-shortcode.php");

add_action('media_buttons_context', 'smgl_add_smgl_custom_button');
add_action('admin_footer', 'smgl_add_smgl_inline_popup_content');

// Media Button for Page and Post
function smgl_add_smgl_custom_button($context) {
  $img = plugins_url( 'admin-scripts/img/gallery.png' , __FILE__ );
  $container_id = 'SMGL';
  $title =  __('Select Gallery to insert into post','SMGL_TEXT_DOMAIN') ;
  $context = '<a class="button button-primary thickbox"  title="'. __("Select Gallery to insert into post",'SMGL_TEXT_DOMAIN').'"
  href="#TB_inline?width=400&inlineId='.$container_id.'">
		<span class="wp-media-buttons-icon" style="background: url('.esc_url( $img ).'); background-repeat: no-repeat; background-position: left bottom;"></span>
	'. __("Get Gallery Shortcode",'SMGL_TEXT_DOMAIN').'
	</a>';
  return $context;
}

// Function of inline popup content when media button click
function smgl_add_smgl_inline_popup_content() {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#smgl_galleryinsert').on('click', function() {
			var id = jQuery('#smgl-gallery-select option:selected').val();
			window.send_to_editor('<p>[SMGP id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>

	<div id="SMGL" style="display:none;">
	  <h3><?php _e('Select Any Gallery To Insert Into Post','SMGL_TEXT_DOMAIN');?></h3>
	  <?php
		$all_posts = wp_count_posts( 'smgl_cpt')->publish;
		$args = array('post_type' => 'smgl_cpt', 'posts_per_page' =>$all_posts);
		global $smgl_galleries;
		$smgl_galleries = new WP_Query( $args );
		if( $smgl_galleries->have_posts() ) { ?>
			<select id="smgl-gallery-select">
				<?php
				while ( $smgl_galleries->have_posts() ) : $smgl_galleries->the_post(); ?>
				<option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
				<?php
				endwhile;
				?>
			</select>
			<button class='button primary' id='smgl_galleryinsert'><?php _e('Insert Gallery Shortcode','SMGL_TEXT_DOMAIN');?></button>
			<?php
		} else {
			_e('No Gallery found','SMGL_TEXT_DOMAIN');
		}
		?>
	</div>
	<?php
}

function smgl_get_gallery_value($PostId){
	$SMGL_Default_Options = array(
		'SMGP_Album_Type'  				=> 'flickr',
		'SMGP_Grid_Layout'  			=> 'classic',
		'SMGP_Thumbnail'				=> 'animtext',
		'SMGP_disableThumbnails'		=> 'no',
		'SMGP_hoverColor' 				=> '#31A3DD',
		'SMGP_useIconButtons'			=> 'yes',
		'SMGP_IconStyle'				=> 'no',
		'SMGP_spaceBwThumbnails'		=> 5,
		'SMGP_thumbnailBorderSize'		=> 0,
		'SMGP_Font_Style'          		=> 'Arial',
		'SMGP_imageHoverTextColor'		=> '#FFFFFF',
		'SMGP_showZoomButton'			=> 'yes',
		'SMGP_Custom_CSS'				=> ''
	);
	
	$SMGL_Settings = "SMGP_Gallery_Settings_".$PostId;
	$SMGL_Settings = unserialize(get_post_meta( $PostId, $SMGL_Settings, true));
	
	$SMGL_Settings = wp_parse_args($SMGL_Settings , $SMGL_Default_Options);
	
	return $SMGL_Settings;
}
?>