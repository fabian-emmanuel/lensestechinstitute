<?php
if (!class_exists('Isha_Latest_BLog_Widget')) {
    class Isha_Latest_BLog_Widget extends WP_Widget
    {

        public function __construct()
        {
            parent::__construct(
                'isha_latest_blog_widget',
                esc_html__('Isha: 7 Frontpage Latest Blog Widget', 'isha'),
                array('description' => esc_html__('Frontpage Latest Blog Section', 'isha'))
            );
        }
        function form( $instance ) {
            $title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
            $subtitle =  ! empty( $instance[ 'sub-title' ] ) ? $instance[ 'sub-title' ] : '';
            $cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
            $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
            $layout_enable = ! empty( $instance[ 'layout_enable' ] ) ? $instance[ 'layout_enable' ] : 'off';
            $author_1 = ! empty( $instance[ 'author_1' ] ) ? $instance[ 'author_1' ] : 0;
            $orderby = ! empty( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';
            $column_no = ! empty( $instance[ 'column_no' ] ) ? $instance[ 'column_no' ] : 2;
            $excerpt_enable = ! empty( $instance[ 'excerpt_enable' ] ) ? $instance[ 'excerpt_enable' ] : 'off';
            $date_enable = ! empty( $instance[ 'date_enable' ] ) ? $instance[ 'date_enable' ] : 'off';
            $comment_enable = ! empty( $instance[ 'comment_enable' ] ) ? $instance[ 'comment_enable' ] : 'off';
            $cat_enable = ! empty( $instance[ 'cat_enable' ] ) ? $instance[ 'cat_enable' ] : 'off';
            $tag_enable = ! empty( $instance[ 'tag_enable' ] ) ? $instance[ 'tag_enable' ] : 'off';
            $read_enable = ! empty( $instance[ 'read_enable' ] ) ? $instance[ 'read_enable' ] : 'off';
            $author_enable = ! empty( $instance[ 'author_enable' ] ) ? $instance[ 'author_enable' ] : 'off';
            $readtime_enable = ! empty( $instance[ 'readtime_enable' ] ) ? $instance[ 'readtime_enable' ] : 'off';
            ?>

            <p>
                <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Blog Section display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $excerpt_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'excerpt_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'excerpt_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'excerpt_enable' )); ?>"><?php esc_html_e('Enable/Disable excerpt display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $date_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'date_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'date_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'date_enable' )); ?>"><?php esc_html_e('Enable/Disable published date display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $comment_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'comment_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'comment_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'comment_enable' )); ?>"><?php esc_html_e('Enable/Disable comment no. display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $cat_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'cat_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cat_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'cat_enable' )); ?>"><?php esc_html_e('Enable/Disable category display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $tag_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'tag_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tag_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'tag_enable' )); ?>"><?php esc_html_e('Enable/Disable tag display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $read_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'read_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'read_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'read_enable' )); ?>"><?php esc_html_e('Enable/Disable read more button display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $author_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'author_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'author_enable' )); ?>"><?php esc_html_e('Enable/Disable author display', 'isha'); ?></label>
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $readtime_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'readtime_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'readtime_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'readtime_enable' )); ?>"><?php esc_html_e('Enable/Disable read time display', 'isha'); ?></label>
                <br/>
                
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'isha' ); ?></strong></label>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
                <br/>   
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sub-title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo $subtitle; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_no' ) )?>"><strong><?php echo esc_html__( 'No of post to show at one time: ', 'isha' )?></strong></label>
                <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'column_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_no' ) ); ?>" value="<?php echo esc_attr( $column_no ); ?>" class="widefat">
            </p>

            <p>
            <!-- CODE FOR ORDER BY IN LAYOUT -->
            <label><strong><?php esc_html_e( 'Select chronological order', 'isha' ); ?></strong></label>
                <select class='widefat' id="<?php echo $this->get_field_id('orderby'); ?>"
                    name="<?php echo $this->get_field_name('orderby'); ?>" type="text">
                    <option value='date'<?php echo ($orderby=='date')?'selected':''; ?>>
                    <?php esc_html_e('Date','isha'); ?>
                    </option>
                    <option value='comment_count'<?php echo ($orderby=='comment_count')?'selected':''; ?>>
                    <?php esc_html_e('Comment count','isha'); ?>
                    </option> 
                    <option value='rand'<?php echo ($orderby=='rand')?'selected':''; ?>>
                    <?php esc_html_e('Random date','isha'); ?>
                    </option> 
                </select>
                <br>
                <label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category: ', 'isha' ); ?></strong></label>
                <?php
                $cat_args = array(
                    'orderby'   => 'name',
                    'hide_empty'    => 1,
                    'show_count'    => 1,
                    'hierarchical'  => 1,
                    'id'    => absint($this->get_field_id( 'cat' )),
                    'name'  => esc_html($this->get_field_name( 'cat' )),
                    'class' => 'widefat',
                    'taxonomy'  => 'category',
                    'selected'  => absint( $cat ),
                    'show_option_all'   => esc_html__( 'All category', 'isha' )
                );
                wp_dropdown_categories( $cat_args );
                ?>
                <label for="<?php echo esc_attr( $this->get_field_id( 'author_1' ) )?>"><strong><?php echo esc_html__( 'Select author', 'isha' ); ?></strong></label>
                <br>
                <?php
        
                $author_args_1 = array(
                    'show_option_all'         => __('All author ','isha'),
                    'hide_if_only_one_author' => null, // string
                    'orderby'                 => 'display_name',
                    'order'                   => 'ASC',
                    'include'                 => null, // string
                    'exclude'                 => null, // string
                    'multi'                   => false,
                    'show'                    => 'display_name',
                    'echo'                    => true,
                    'selected'                => $author_1,
                    'include_selected'        => false,
                    'name'                  => esc_html( $this->get_field_name('author_1') ),
                    'id'                    => absint( $this->get_field_id('author_1') ),
                    'class'                   => null, // string 
                    'blog_id'                 => $GLOBALS['blog_id'],
                    'who'                     => null, // string,
                    'role'                    => null, // string|array,
                    'role__in'                => null, // array    
                    'role__not_in'            => null, // array 
                );
                wp_dropdown_users($author_args_1);
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post no: ', 'isha' )?></strong></label>
                <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
            </p>
            <?php
        }
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);
            $instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
            $instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance[ 'orderby' ] = sanitize_text_field( $new_instance['orderby'] );
            $instance[ 'author_1' ] = absint( $new_instance[ 'author_1' ] );
            $instance[ 'column_no' ] = absint( $new_instance[ 'column_no' ] );
            $instance[ 'excerpt_enable' ] = $new_instance[ 'excerpt_enable' ];
            $instance[ 'date_enable' ] = $new_instance[ 'date_enable' ];
            $instance[ 'cat_enable' ] = $new_instance[ 'cat_enable' ];
            $instance[ 'tag_enable' ] = $new_instance[ 'tag_enable' ];
            $instance[ 'read_enable' ] = $new_instance[ 'read_enable' ];
            $instance[ 'comment_enable' ] = $new_instance[ 'comment_enable' ];
            $instance[ 'author_enable' ] = $new_instance[ 'author_enable' ];
            $instance[ 'readtime_enable' ] = $new_instance[ 'readtime_enable' ];
            return $instance;
        }

        
        function widget( $args, $instance ) {
            $cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
            $title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $subtitle =  ! empty( $instance[ 'sub-title' ] ) ? $instance[ 'sub-title' ] : '';
            $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
            $author_1 = ! empty( $instance[ 'author_1' ] ) ? $instance[ 'author_1' ] : 0;
            $orderby = ! empty( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';
            $column_no = ! empty( $instance[ 'column_no' ] ) ? $instance[ 'column_no' ] : 2;
            $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
            $layout_enable = $layout_enable_check ? 'true' : 'false';
            $excerpt_enable_check = isset( $instance['excerpt_enable'] ) ? esc_attr( $instance['excerpt_enable'] ) : '';
            $excerpt_enable = $excerpt_enable_check ? 'true' : 'false';
            $date_enable_check = isset( $instance['date_enable'] ) ? esc_attr( $instance['date_enable'] ) : '';
            $date_enable = $date_enable_check ? 'true' : 'false';
            $cat_enable_check = isset( $instance['cat_enable'] ) ? esc_attr( $instance['cat_enable'] ) : '';
            $cat_enable = $cat_enable_check ? 'true' : 'false';
            $tag_enable_check = isset( $instance['tag_enable'] ) ? esc_attr( $instance['tag_enable'] ) : '';
            $tag_enable = $tag_enable_check ? 'true' : 'false';
            $read_enable_check = isset( $instance['read_enable'] ) ? esc_attr( $instance['read_enable'] ) : '';
            $read_enable = $read_enable_check ? 'true' : 'false';
            $comment_enable_check = isset( $instance['comment_enable'] ) ? esc_attr( $instance['comment_enable'] ) : '';
            $comment_enable = $comment_enable_check ? 'true' : 'false';
            $readtime_enable_check = isset( $instance['readtime_enable'] ) ? esc_attr( $instance['readtime_enable'] ) : '';
            $readtime_enable = $readtime_enable_check ? 'true' : 'false';
            $author_enable_check = isset( $instance['author_enable'] ) ? esc_attr( $instance['author_enable'] ) : '';
            $author_enable = $author_enable_check ? 'true' : 'false';

            echo $args[ 'before_widget' ];
            if($layout_enable =='true'):
                ?>
                <section class="newsblog section">
                    <?php
                    $arguments = array(
                        'cat'   => absint( $cat ),
                        'posts_per_page' => absint( $post_no ),
                        'author'       => esc_attr( $author_1 ),
                        'orderby' => array( esc_attr( $orderby ) => 'DSC', 'date' => 'DSC'),

                    );
                    $query = new WP_Query( $arguments );
                    if( $query->have_posts() ) :
                        ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-title">
                                    <?php
                                    echo $args[ 'before_title' ];
                                    
                                    echo esc_html( $title ); 
                                    
                                    echo $args[ 'after_title' ];
                                    ?>
                                    <p><?php echo esc_html($subtitle);?></p>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 none">
                                    <div class="row newsblog-slider">
                                        <?php
                                            while( $query->have_posts() ) :
                                                $query->the_post();
                                                ?>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                                                    <!-- Single News -->
                                                    <div class="single-news">
                                                        <!--this input is used to send value to jquery  -->
                                                        <input type="hidden" id="value_jquery_latest-blog" value='<?php echo absint($column_no) ?>' > 
                                                        <div class="news-head news-meta double-column-half-image">
                                                        <?php 
                                                        if(has_post_thumbnail()):?>
                                                                <?php the_post_thumbnail('isha-blog-news');?>
                                                        <?php elseif (! has_post_thumbnail()): ?>
                                                            <img src = "<?php echo esc_url( get_template_directory_uri() ); ?>/inc/images/538_357.png ">
                                                        <?php endif;
                                                        ?>
                                                            <ul class="pro-meta meta">
                                                            <?php if ($author_enable == 'true') : ?>   
                                                                    <li class="author-in-blog" >
                                                                        <?php echo get_avatar( get_the_author_meta('ID'), 100); ?>
                                                                    </li>
                                                                    <li class="border-0 post-by">
                                                                        <?php isha_posted_by(); ?> 
                                                                    </li>
                                                                <?php endif ; ?>
                                                                <?php if ($readtime_enable == 'true') : ?>   
                                                                    <li class="reading-time" ><i class="fa fa fa-book"></i><?php isha_count_content_words( get_the_ID() ); ?></li>
                                                                <?php endif ; ?>
                                                            </ul>
                                                        </div>
                                                        <div class="news-bottom">
                                                            <div class="content">
                                                                <h4 class="secondary-widget-title pb-3"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                                                <div class="news-meta widget-latest-blog double-column-half-image">
                                                                    <ul class="list">
                                                                        <?php if ($date_enable == 'true') : ?>   
                                                                            <li><i class="fa fa-calendar"></i><?php isha_posted_on();?></li>
                                                                        <?php endif; ?>
                                                                        <?php if ($comment_enable == 'true') : ?>   
                                                                            <li><i class="fa fa-comment-o"></i><?php isha_post_comment() ;?></li>
                                                                        <?php endif; ?>
                                                    
                                                                    </ul>
                                                                </div>
                                                                <ul class="list">
                                                                <?php if ($cat_enable == 'true') : ?>   
                                                                        <li class="pt-1"><span class ="cat"> <?php the_category( ' / ' ); ?> </span></li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                               <?php if ($excerpt_enable == 'true') : ?>   
                                                                    <div class="pt-3 pb-3">
                                                                        <?php the_excerpt(); ?>
                                                                    </div>
                                                               <?php endif; ?>
                    
                                                                <ul class="list">
                                                                <?php if ($tag_enable == 'true') : ?>   
                                                                        <li> <span class="tag"> <?php isha_post_tag(); ?> </span></li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                                <?php if ($read_enable == 'true') : ?>   
                                                                    <div class="pb-4">
                                                                        <a class=" btn" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('isha_read_more_title',__('Read More', 'isha'))); ?></a>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/ End Single News -->
                                                </div>
                                                <?php
                                            endwhile;
                                            wp_reset_postdata();        
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;?>
                </section>
                <?php
            endif;
            echo $args[ 'after_widget' ];
        }

        }
    }