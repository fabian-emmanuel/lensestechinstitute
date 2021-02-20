<?php
if (!class_exists('Isha_Services_Widget')) {
    class Isha_Services_Widget extends WP_Widget
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
                'isha_services_widget',
                esc_html__('Isha: 2 Frontpage Our Creative Services Widget', 'isha'),
                array('description' => esc_html__('Frontpage Our Creative Services Section', 'isha'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $title = $instance['title'];
            $subtitle =  $instance['sub-title'];
            $repeaters   = ( ! empty( $instance['repeaters'] ) ) ? $instance['repeaters'] : array();
            ?>
            <p>
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Our Creatuve Service Section', 'isha'); ?></label> 
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="color-picker widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo esc_attr($title); ?>" data-alpha="true">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sub-title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo esc_attr($subtitle); ?>">
            </p>

            <span class="isha-additional">
            <!--repeater-->
            <p>
                <label><?php esc_html_e( 'Select Page', 'isha' ); ?>:</label>
                <?php
                if  ( count( $repeaters ) >=  1 && is_array( $repeaters ) )
                {

                    $selected = $repeaters['main'];
                    $textValue = $repeaters['icon'];
                }

                else
                {
                    $selected = "";
                    $textValue = '';
                }

                $repeater_pages_id   = $this->get_field_id( 'repeaters' ).'-main';
                $repeater_pages_name = $this->get_field_name( 'repeaters'). '[main]';
                $repeater_icon_id   = $this->get_field_id( 'repeaters' ).'-icon';
                $repeater_icon_name = $this->get_field_name( 'repeaters'). '[icon]';
        
                $args = array(
                    'selected'          => $selected,
                    'name'              => $repeater_pages_name,
                    'id'                => $repeater_pages_id,
                    'class'             => 'widefat',
                    'show_option_none'  => __( 'Select Page', 'isha'),
                    'option_none_value' => 0 // string
                );
                wp_dropdown_pages( $args );
                ?>    
            </p>
            <p>   
            <label>
            <?php 
            /* translators: %1$s: link of fontawesome, %2$s: closing anchor tag */ 
            echo sprintf( __( 'Use font awesome icon example as " fa fa-university " : %1$s See more here %2$s', 'isha' ),'<a href="'.esc_url('https://fontawesome.com/v4.7.0/icons/').'" target="_blank">','</a>'); 
            ?>
            </label><br/>
            <input type="text" name="<?php echo esc_attr( $repeater_icon_name ) ?>" class="widefat" id="<?php echo esc_attr($repeater_icon_id); ?>" value="<?php echo  esc_attr($textValue); ?>">
            </p>
            <?php

            $counter = 0;

            if ( count( $repeaters ) > 0 )
            {
                foreach( $repeaters as $repeater )
                {
                    if ( isset( $repeater['page_ids'] ) )
                    { ?>
                        <div class="isha-sec">
                            <div class="sub-option section widget-upload">
                                <?php
                                $repeater_select_page_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-page_ids';
                                $repeater_select_page_name   = $this->get_field_name( 'repeaters' ) . '['.$counter.'][page_ids]';
                                $repeater_icon_name  = $this->get_field_name( 'repeaters' ) . '['.$counter.'][icon]';
                                $repeater_icon_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-icon';?>
                                <label for="<?php echo esc_attr( $repeater_select_page_id );?>"><?php esc_html_e('Select Page','isha');?></label>
                                <?php $args = array(
                                    'selected'          => $repeater['page_ids'],
                                    'name'              => $repeater_select_page_name,
                                    'id'                => $repeater_select_page_id,
                                    'class'             => 'widefat pt-select',
                                    'show_option_none'  => __( 'Select Page', 'isha'),
                                    'option_none_value' => 0 // string
                                );
                                wp_dropdown_pages( $args );
                                ?>
                                <label for="<?php echo esc_attr($repeater_icon_id);?>">
                                <?php 
                                /* translators: %1$s: link of fontawesome, %2$s: closing anchor tag */ 
                                echo sprintf( __( 'Use font awesome icon  example as " fa fa-university " : %1$s See more here %2$s', 'isha' ),'<a href="'.esc_url('https://fontawesome.com/v4.7.0/icons/').'" target="_blank">','</a>'); 
                                ?>
                                </label><br/>
                                <input type="text" name="<?php echo esc_attr($repeater_icon_name); ?>" class="widefat" id="<?php echo esc_attr($repeater_icon_id); ?>" value="<?php echo esc_attr( $repeater['icon'] ); ?>">

                                <a class="isha-remove delete"><?php esc_html_e( 'Remove Section', 'isha' ) ;?></a>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                }
            }

            ?>

            </span>
            <a class="isha-add-features button repeater-btn" data-id="isha_repeater_widget" id="<?php echo esc_attr($repeater_pages_id); ?>"><?php esc_html_e('Add New Section', 'isha'); ?></a>

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
                    $repeater['icon'] = absint($repeater['icon']);
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
                $repeaters[]= array('page_ids'=>$repeaters['main'],'icon'=>$repeaters['icon']);
                unset($repeaters['main']);
                unset($repeaters['icon']);
                if($layout_enable =='true'):
                echo $args['before_widget'];
                ?>
                <!-- Services -->
                <section class="services section">
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
                                    $service_page_id  = $repeater['page_ids'];
                                    $service_icon  = $repeater['icon'];
                                    $service_page = get_post($service_page_id);
                                ?>
                            <div class="col-lg-4 col-md-6 col-12 wow fadeIn" data-wow-delay="0.2s">
                                <!-- Single Service -->
                                <div class="single-service">
                                    <i class="<?php echo esc_attr($service_icon);?>"></i>
                                    <h4  class="secondary-widget-title"><a href="<?php echo esc_url(get_page_link($service_page_id));?>"><?php echo esc_html( $service_page->post_title);?></a></h4>
                                    <p><?php echo esc_html(strip_tags(substr($service_page->post_content,0,strpos($service_page->post_content, ' ', 100) )));?></p>
                                </div>
                                <!--/ End Single Service -->
                            </div>
                           <?php 
                                wp_reset_postdata();
                                endforeach;
                            endif;?>
                        </div>
                    </div>
                </section>
                <!--/ End Services -->
                <?php
                echo $args['after_widget'];
                endif;
            }
        }

        }
    }