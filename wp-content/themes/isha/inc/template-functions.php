<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package isha
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function isha_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'isha_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function isha_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'isha_pingback_header' );

if( ! function_exists( 'latest_page_id' ) ) :
    function latest_page_id(){
        $latest_cpt = get_posts("post_type=page&numberposts=1");
        return absint( $latest_cpt[0]->ID );
    }
endif;

// Slider Section Item Start
if( ! function_exists( 'isha_frontpage_slider_items' ) ) :
    /**
     * Display content of frontpage slider items as repeater field
     *
     * @since 1.0.0
     */
    function isha_frontpage_slider_items() {
        $isha_default = array(
            'default' => array(
                'dropdown-pages' => latest_page_id(),
                'btn_text_1' => '',
                'btn_url_1'  =>  __('#','isha'),
                'btn_text_2' => '',
                'btn_url_2'  =>  __('#','isha')
            
              ),
              array(
                'dropdown-pages' => latest_page_id(),
                'btn_text_1' => '',
                'btn_url_1'  =>  __('#','isha'),
                'btn_text_2' => '',
                'btn_url_2'  =>  __('#','isha')
              )
              );
        $isha_slider_items  = get_theme_mod( 'slider_items', $isha_default );

       
        if( !empty( $isha_slider_items ) ) {
            foreach ( $isha_slider_items as $slider_item ) {
                $item_page_title = get_post($slider_item['dropdown-pages']);
                $slider_img_url = get_the_post_thumbnail_url($slider_item['dropdown-pages']);
                ?>
				<div class="single-slider overlay" style="background-image:url(<?php echo esc_url($slider_img_url);?>)">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 offset-lg-2 col-12">
								<!-- Welcome Text -->
								<div class="welcome-text text-center"> 
									<h2><a href="<?php echo esc_url(get_permalink( $slider_item['dropdown-pages'] ));?>"><?php echo esc_html($item_page_title->post_title);?></a></h2>
									<p><?php echo esc_html( substr(strip_tags($item_page_title->post_content), 0, 200) ) ;?></p>
									<div class="button">
										<?php if($slider_item['btn_text_1'] != ''):?>
										<a href="<?php echo esc_url($slider_item['btn_url_1']);?>" class="btn"><?php echo esc_html($slider_item['btn_text_1']);?></a>
										<?php endif;?>
										<?php if($slider_item['btn_text_2'] != ''):?>
										<a href="<?php echo esc_url($slider_item['btn_url_2']);?>" class="btn primary"><?php echo esc_html($slider_item['btn_text_2']);?></a> 
										<?php endif;?>
									</div>
								</div>
								<!-- End Welcome Text -->
							</div>
						</div>
					</div>
        		</div>
                <?php wp_reset_postdata();?> 
            <?php    }
        }
    }
endif;

// Main Menu Right Social Section
if( ! function_exists( 'isha_header_social_items' ) ) :
    /**
     * Display content of frontpage slider items as repeater field
     *
     * @since 1.0.0
     */
    function isha_header_social_items() {
        $social_items  = get_theme_mod( 'social_links_items', '' );
       
        if( !empty( $social_items ) ) {?>
        	<ul class="social">
	        	<?php
	            foreach ( $social_items as $social_item ) {
	                ?>
					<li>
						<a href="<?php echo esc_url($social_item['link']);?>"><i class="<?php echo esc_attr($social_item['font']);?>"></i></a>
					</li>
	            	<?php    
	        	}?>
        	</ul>
        <?php    
        }
    }
endif;
/* Word read count */
if (!function_exists('isha_count_content_words')) :
    /**
     * @param $content
     *
     * @return string
     */
    function isha_count_content_words($post_id)
    {
            $content = apply_filters('the_content', get_post_field('post_content', $post_id));
            $read_words = esc_attr(get_theme_mod('global_show_min_read_number','10'));
            $decode_content = html_entity_decode($content);
            $filter_shortcode = do_shortcode($decode_content);
            $strip_tags = wp_strip_all_tags($filter_shortcode, true);
            $count = str_word_count($strip_tags);
            $word_per_min = (absint($count) / $read_words);
            $word_per_min = ceil($word_per_min);

           	if ( absint($word_per_min) > 0) {
                /* translators: reading estimate time  */
                $word_count_strings = sprintf(_n('%s min  ', '%s min  ', number_format_i18n($word_per_min), 'isha'), number_format_i18n($word_per_min));
                if ('post' == get_post_type($post_id)):
                    echo '<span class="min-read">';
                    echo esc_html($word_count_strings);
                    echo '</span>';
                endif;
            }
            if ( absint($word_per_min) == Null) {
            	echo '<span class="min-read">';
                echo __('0 min','isha');
                echo '</span>';
            }
    }
endif;

if (!function_exists('isha_modal')) :
    function isha_modal() {
        if(absint(get_theme_mod('isha_blog_post_post_taxonomy_'.__('Read more','isha'),'1'))==1): ?>
            <?php if(absint(get_theme_mod('isha_popup_enable','1'))==1): ?>
                <a href="<?php the_permalink(); ?>" class=" btn <?php if ( esc_attr(get_theme_mod('isha_lite_blog_post_layout','1'))==1 ) {echo 'mt-4'; } else { echo 'float-left' ;} ?> " data-toggle="modal" data-target="#post-content-<?php the_ID(); ?>"><?php echo esc_html(get_theme_mod('isha_read_more_title',__('Read More', 'isha'))); ?></a>
                <!-- Modal -->
                <div class="modal fade" id="post-content-<?php the_ID(); ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                            <a class=" btn" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('isha_detail_here_title',__('Full view here', 'isha'))); ?></a>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body text-justify">
                                <?php the_content();?>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo esc_html(get_theme_mod('isha_close_title',__('Close', 'isha'))); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <a class=" btn" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('isha_read_more_title',__('Read More', 'isha'))); ?></a>
            <?php endif; 
        endif; 
    }
endif;
