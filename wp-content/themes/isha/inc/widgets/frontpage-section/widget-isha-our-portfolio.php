<?php
if (!class_exists('Isha_Portfolio_Widget')) {
    class Isha_Portfolio_Widget extends WP_Widget
    {
        private function defaults()
        {

            $defaults = array(
                'layout_enable' => 'off',
                'title' => '',
                'sub-title' => '',
                'cat' => '',
                'post_no' => '',
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_portfolio_widget',
                esc_html__('Isha: 3 Frontpage Portfolio Widget', 'isha'),
                array('description' => esc_html__('Frontpage Portfolio Section', 'isha'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $title = esc_attr( $instance['title'] );
            $subtitle =  esc_attr( $instance['sub-title'] );
            $cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
            $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 6;
            ?>
            <p>
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable our portfolio section', 'isha'); ?></label> 
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sub-title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo $subtitle; ?>">
            </p>
        
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select main categories of portfolio', 'isha' ); ?></strong></label>
                <br>
                <?php
                $cat_args = array(
                    'orderby'   => 'name',
                    'show_option_none'   => esc_attr__( 'Select Category', 'isha' ),
                    'option_none_value'  => '',
                    'hide_empty'    => 1,
                    'show_count'    => 1,
                    'hierarchical'  => 2,
                    'id'    => $this->get_field_id( 'cat' ),
                    'name'  => $this->get_field_name( 'cat' ),
                    'class' => esc_attr__( 'widefat', 'isha' ),
                    'taxonomy'  => esc_attr__( 'category', 'isha' ),
                    'selected'  => absint( $cat ),
                );
                wp_dropdown_categories( $cat_args );
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Maxium post number to show in each sub cateogry : ', 'isha' )?></strong></label>
                <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
            </p>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);
            $instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
            $instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

          
            return $instance;
        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
                $layout_enable = $layout_enable_check ? 'true' : 'false';
                $subtitle = esc_html($instance['sub-title']);
                
                $cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
                $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 6;

                if($layout_enable =='true'):
                echo $args['before_widget'];
                ?>
                <!-- Start Project -->
                <section class="project section">
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
                        <?php  if (! $cat == ''){ ?>
                            <div class="row">
                                <div class="col-12">
                                    <!-- Project Nav -->
                                    <ul class="project-nav">
                                        <li class="active" data-filter="*"> <a href="<?php the_permalink(); ?>"><?php esc_html_e('Random','isha');?></a></li>
                                        <?php 
                                        $project_category_id = $cat;
                                        $project_args = array('child_of' =>$project_category_id);
                                        $categories = get_categories( $project_args );
                                        foreach($categories as $category):
                                        ?>
                                        <li data-filter=".<?php echo esc_attr($category->slug);?>"><a href="<?php the_permalink(); ?>"><?php echo esc_html($category->name);?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row isotop-active" id="<?php echo absint( $post_no );?>">
                                <?php
                                $sub_cats = get_categories('parent=' . $project_category_id);
                                if( $sub_cats ) :
                                foreach( $sub_cats as $sub_cat ) : 
                                    $sub_query = new WP_Query( array(
                                        'category__in' => array( $sub_cat->term_id ),
                                        'posts_per_page' => $post_no,
                                        'orderby' => array( 'date' => 'DSC'),
                                         )
                                    );
                                    if ( $sub_query->have_posts() ) :
                                        while( $sub_query->have_posts() ) : $sub_query->the_post();?>
                                        
                                            <div class="col-lg-4 col-md-4 col-12  <?php echo  esc_attr($sub_cat->slug);?>">
                                                <!-- Single Project -->
                                                <div class="single-project">
                                                    <div class="project-head overlay">
                                                        <?php if(has_post_thumbnail()):
                                                        the_post_thumbnail('isha-portfolio-thumb');
                                                        endif;?>
                                                        <?php if (get_theme_mod('isha_blog_post_post_taxonomy_'.__('Reading time','isha'),'1') == 1 ) : ?>
                                                            <ul class="pro-meta meta pl-2 pb-2">
                                                                <li class="reading-time" ><i class="fa fa fa-book"></i><?php isha_count_content_words( get_the_ID() ); ?></li>
                                                            </ul>
                                                        <?php endif ; ?>
                                                        <div class="project-hover">
                                                            <a href="<?php the_permalink();?>" class="btn"><i class="fa fa-link"></i></a>
                                                            <a data-fancybox="portfolio" href="<?php echo esc_url( get_the_post_thumbnail_url(get_the_ID(),'isha-portfolio-thumb') );?> " class="btn zoom"><i class="fa fa-search"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="project-des">
                                                    
                                                        <h4 class="secondary-widget-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                                        
                                                    </div>
                                                </div>
                                                <!--/ End Single Project -->
                                            </div>
                                        <?php endwhile;
                                    endif;
                                endforeach;
                                  wp_reset_postdata();
                            endif;
                            ?>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <!--/ End Project -->
                <?php
                echo $args['after_widget'];
                endif;
            }
        }
        }
    }