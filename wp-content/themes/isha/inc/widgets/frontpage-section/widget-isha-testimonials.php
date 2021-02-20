<?php
if (!class_exists('Isha_Testimonials_Widget')) {
    class Isha_Testimonials_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title' => '',
                'sub-title' => '',
                'repeaters' => '',
                'layout_enable' => 'off',
                'post_no' => 3,

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_testimonials_widget',
                esc_html__('Isha: 4 Frontpage Testimonials Widget', 'isha'),
                array('description' => esc_html__('Frontpage Testimonials Section', 'isha'))
            );
        }
        
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $title = esc_attr( $instance['title'] );
            $subtitle =  esc_attr( $instance['sub-title'] );
            $repeaters   = ( ! empty( $instance['repeaters'] ) ) ? $instance['repeaters'] : array();
            $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
            ?>
            <p>
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Testimonials Section', 'isha'); ?></label> 
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
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'No of post to show at one time: ', 'isha' )?></strong></label>
                <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
            </p>
            <span class="isha-additional-testimonials">
            <!--repeater-->
            <p>
                <label><?php esc_html_e( 'Select Page', 'isha' ); ?>:</label>
                <?php
                if  ( count( $repeaters ) >=  1 && is_array( $repeaters ) )
                {

                    $selected = $repeaters['main'];
                    $textValue = $repeaters['position'];
                }

                else
                {
                    $selected = "";
                    $textValue = '';
                }

                $pages_id   = $this->get_field_id( 'repeaters' ).'-main';
                $pages_name = $this->get_field_name( 'repeaters'). '[main]';
                $position_id   = $this->get_field_id( 'repeaters' ).'-position';
                $position_name = $this->get_field_name( 'repeaters'). '[position]';
        
                $args = array(
                    'selected'          => $selected,
                    'name'              => $pages_name,
                    'id'                => $pages_id,
                    'class'             => 'widefat',
                    'show_option_none'  => __( 'Select Page', 'isha'),
                    'option_none_value' => 0 // string
                );
                wp_dropdown_pages( $args );
                ?>    
            </p>
            <p>
                
            </p>
             <label>
                <?php esc_html_e( 'Position', 'isha'); ?>
            </label><br/>
            <input type="text" name="<?php echo esc_attr( $position_name ) ?>" class="widefat" id="<?php echo esc_attr($position_id); ?>" value="<?php echo  esc_attr($textValue); ?>">
            <?php

            $counter = 0;

            if ( count( $repeaters ) > 0 )
            {
                foreach( $repeaters as $repeater )
                {

                    if ( isset( $repeater['page_ids'] ) )

                    { ?>
                        <div class="isha-sec-testimonials isha-sec">
                            <div class="sub-option section widget-upload">
                            <label for="<?php echo $this->get_field_id( 'repeaters' ) .'-'. $counter.'-page_ids';?>">Page</label>
                            <?php

                            $repeater_select_page_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-page_ids';
                            $repeater_select_page   = $this->get_field_name( 'repeaters' ) . '['.$counter.'][page_ids]';
                            $repeater_position  = $this->get_field_name( 'repeaters' ) . '['.$counter.'][position]';
                            $repeater_position_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-position';
                            $args = array(
                                'selected'          => $repeater['page_ids'],
                                'name'              => $repeater_select_page,
                                'id'                => $repeater_select_page_id,
                                'class'             => 'widefat pt-select',
                                'show_option_none'  => __( 'Select Page', 'isha'),
                                'option_none_value' => 0 // string
                            );
                            wp_dropdown_pages( $args );
                            ?>
                            <label for="<?php echo esc_attr($repeater_position_id);?>">
                            <?php esc_html_e( 'Position', 'isha'); ?>
                            </label><br/>
                            <input type="text" name="<?php echo esc_attr($repeater_position); ?>" class="widefat" id="<?php echo esc_attr($repeater_position_id); ?>" value="<?php echo $repeater['position']; ?>">

                            <a class="isha-remove delete"><?php esc_html_e('Remove Section','isha');?></a>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                }
            }
            ?>
            </span>
                <a class="isha-add-testimonials button repeater-btn" data-id="isha_repeater_widget" id="<?php echo esc_attr($repeater_select_page); ?>"><?php esc_html_e('Add New Section', 'isha'); ?></a>
            <hr/>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);
            $instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

            if (isset($new_instance['repeaters']))
            {
                foreach($new_instance['repeaters'] as $repeater){

                    $repeater['page_ids'] = absint($repeater['page_ids']);
                    $repeater['position'] = sanitize_text_field( $repeater['position'] );
                }
                $instance['repeaters'] = $new_instance['repeaters'];
            }
            return $instance;
        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
                $layout_enable = $layout_enable_check ? 'true' : 'false';
                $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
                $subtitle = esc_html($instance['sub-title']);
                $repeaters = (!empty($instance['repeaters'])) ? $instance['repeaters'] : array();
                $repeaters[]= array('page_ids'=>$repeaters['main'],'position'=>$repeaters['position']);
                unset($repeaters['main']);
                unset($repeaters['position']);
                if($layout_enable =='true'):
                echo $args['before_widget'];
                ?>
                <!-- Start Testimonials -->
                <section class="testimonials section">
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
                            <div class="col-12">
                                <div class="row testimonial-active"> 
                                
                                   <!-- Loop -->
                                    <?php if( ! empty($repeaters)):
                                        foreach($repeaters as $repeater):
                                            $testimonial_page_id  = $repeater['page_ids'];
                                            $testimonial_position  = $repeater['position'];
                                            $testimonial_page = get_post($testimonial_page_id);
                                            $testimonial_image_url = get_the_post_thumbnail_url( $testimonial_page_id,'isha-testimonials-thumb' );
                                        ?>
                                    <div class="col-lg-12 col-12">                   
                                        <div class="single-testimonial"> 
                                            <!--this input is used to send value to jquery  -->
                                            <input type="hidden" id="value_jquery_testimoney" value='<?php echo absint($post_no) ?>' > 
                                            <div class="t-author">
                                                <?php if(!empty($testimonial_image_url)):?>
                                                <img src="<?php echo esc_url($testimonial_image_url);?>" alt="<?php echo esc_attr($testimonial_page->post_title);?>" >
                                                <?php endif;?>
                                            </div>
                                            <div class="testimonial-inner">       
                                                <p><?php echo esc_html(substr(strip_tags($testimonial_page->post_content), 0,strpos($testimonial_page->post_content, ' ', 100)));?></p>
                                                <h4 class="secondary-widget-title t-name"><a href="<?php echo esc_url(get_permalink( $testimonial_page_id ));?>"><?php echo esc_html($testimonial_page->post_title);?></a><span><?php echo esc_html($testimonial_position);?></span></h4>
                                            </div>   
                                        </div>   
                                    </div>   
                                    <?php 
                                    wp_reset_postdata();
                                        endforeach;
                                    endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ End Testimonials -->
                <?php
                echo $args['after_widget'];
                endif;
            }
        }

        }
    }