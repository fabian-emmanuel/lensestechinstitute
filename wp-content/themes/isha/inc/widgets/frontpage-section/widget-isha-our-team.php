<?php
if (!class_exists('Isha_Team_Widget')) {
    class Isha_Team_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title' => '',
                'sub-title' => '',
                'repeaters' => '',
                'layout_enable' => 'off'

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_team_widget',
                esc_html__('Isha: 6 Frontpage Team Widget', 'isha'),
                array('description' => esc_html__('Frontpage Team Section', 'isha'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $title = esc_attr( $instance['title'] );
            $subtitle =  esc_attr( $instance['sub-title'] );
            $repeaters   = ( ! empty( $instance['repeaters'] ) ) ? $instance['repeaters'] : array();
            ?>
            <p>
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Team Section', 'isha'); ?></label> 
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
                $subtitle = esc_html($instance['sub-title']);
                $repeaters = (!empty($instance['repeaters'])) ? $instance['repeaters'] : array();
                $repeaters[]= array('page_ids'=>$repeaters['main'],'position'=>$repeaters['position']);
                unset($repeaters['main']);
                unset($repeaters['position']);
                if($layout_enable =='true'):
                echo $args['before_widget'];
                ?>
                <!-- Start Team -->
                <section class="team section">
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
                             <?php if( ! empty($repeaters)):
                                foreach($repeaters as $repeater):
                                    $team_page_id  = $repeater['page_ids'];
                                    $team_position  = $repeater['position'];
                                    $team_page = get_post($team_page_id);
                                    $team_image_url = get_the_post_thumbnail_url( $team_page_id, 'isha-team-thumb' );
                                ?>
                                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Single Team -->
                                    <div class="single-team">
                                        <div class="team-head">
                                            <?php if(!empty($team_image_url)):?>
                                                <img src="<?php echo esc_url($team_image_url);?>" alt="<?php echo esc_attr($team_page->post_title);?>">
                                                <?php endif;?>
                                            
                                        </div>
                                        <div class="member-name">
                                            <p><?php echo esc_html($team_position);?></p>
                                            <h4 class="secondary-widget-title"><a href="<?php echo esc_url(get_permalink( $team_page_id ));?>"><?php echo esc_html($team_page->post_title);?></a></h4>
                                        </div>
                                    </div>
                                    <!--/ End Team -->
                                </div>
                                <?php 
                                    wp_reset_postdata();
                                endforeach;
                            endif;?>
                        </div>
                    </div>
                </section>
                <!--/ End Team -->
                <?php
                echo $args['after_widget'];
                endif;
            }
        }

        }
    }