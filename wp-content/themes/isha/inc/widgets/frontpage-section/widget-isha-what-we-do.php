<?php
if (!class_exists('Isha_What_We_Do_Widget')) {
    class Isha_What_We_Do_Widget extends WP_Widget
    {

        private function defaults()
        {
            $defaults = array(
                'select_page_id' => '',
                'layout_enable' => 'off',
                'repeaters' => ''

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_what_We_do_widget',
                esc_html__('Isha: 1 Frontpage What We Do Widget', 'isha'),
                array('description' => esc_html__('Frontpage What We Do Section', 'isha'))
            );
        }

        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $select_page_id   = ( ! empty( $instance['select_page_id'] ) ) ? $instance['select_page_id'] : array();
            $repeaters   = ( ! empty( $instance['repeaters'] ) ) ? $instance['repeaters'] : array();
            ?>
            <p>
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Why Choose Section', 'isha'); ?></label> 
            </p>
        
            <p>
                <label><?php esc_html_e( 'Select Page', 'isha' ); ?>:</label>
                <?php
                if  ( isset( $select_page_id ) )
                {

                    $selected = $select_page_id;
                }

                else
                {
                    $selected = "";
                }

                $page_id   = $this->get_field_id( 'select_page_id' );
                $page_name = $this->get_field_name( 'select_page_id');
                
                $args = array(
                    'selected'          => $selected,
                    'name'              => $page_name,
                    'id'                => $page_id,
                    'class'             => 'widefat',
                    'show_option_none'  => __( 'Select Page', 'isha'),
                    'option_none_value' => 0 // string
                );
                wp_dropdown_pages( $args );
                ?>    
            </p>
            
            <span class="isha-additional-why-choose">
            <!--repeater-->
                <?php
                if  ( count( $repeaters ) >=  1 && is_array( $repeaters ) )
                {

                    $numberValue = $repeaters['rep_number'];
                    $symbolValue = $repeaters['rep_symbol'];
                    $textValue = $repeaters['rep_text'];
                }

                else
                {
                    $numberValue = '';
                    $symbolValue = '';
                    $textValue = '';
                }

                $number_id   = $this->get_field_id( 'repeaters' ).'-rep_number';
                $number_name = $this->get_field_name( 'repeaters'). '[rep_number]';
                $symbol_id   = $this->get_field_id( 'repeaters' ).'-rep_symbol';
                $symbol_name = $this->get_field_name( 'repeaters'). '[rep_symbol]';
                $text_id   = $this->get_field_id( 'repeaters' ).'-rep_text';
                $text_name = $this->get_field_name( 'repeaters'). '[rep_text]';
                ?>    
            <p>
                <label><?php esc_html_e( 'Number example as " 100 " ', 'isha' ); ?>:</label>
                <input type="number" name="<?php echo esc_attr( $number_name ) ?>" class="widefat" id="<?php echo esc_attr($number_id); ?>" value="<?php echo  esc_attr($numberValue); ?>">
            </p>

             <p>
                <label><?php esc_html_e( 'Symbol example as " $ "', 'isha' ); ?>:</label>
                <input type="text" name="<?php echo esc_attr( $symbol_name ) ?>" class="widefat" id="<?php echo esc_attr($symbol_id); ?>" value="<?php echo  esc_attr($symbolValue); ?>">
            </p>

            <p>
                <label><?php esc_html_e( 'Text', 'isha' ); ?>:</label>
                <input type="text" name="<?php echo esc_attr( $text_name ) ?>" class="widefat" id="<?php echo esc_attr($text_id); ?>" value="<?php echo  esc_attr($textValue); ?>">
            </p>
             <?php

            $counter = 0;

            if ( count( $repeaters ) > 0 )
            {
                foreach( $repeaters as $repeater )
                {

                    if ( isset( $repeater['number'] ) || isset( $repeater['symbol'] ) || isset( $repeater['text'] ) )

                    { 
                        $repeater_number_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-number';
                        $repeater_number_name   = $this->get_field_name( 'repeaters' ) . '['.$counter.'][number]';
                        $repeater_symbol_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-symbol';
                        $repeater_symbol_name  = $this->get_field_name( 'repeaters' ) . '['.$counter.'][symbol]';
                        $repeater_text_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-text';
                        $repeater_text_name  = $this->get_field_name( 'repeaters' ) . '['.$counter.'][text]';
                    ?>

                        <div class="isha-sec-why-choose isha-sec">
                            <div class="sub-option section widget-upload">
                                <label for="<?php echo esc_attr( $repeater_number_id );?>"><?php esc_html_e('Number','isha');?></label>
                                <br/>
                                <input type="number" name="<?php echo esc_attr($repeater_number_name); ?>" class="widefat" id="<?php echo esc_attr($repeater_number_id); ?>" value="<?php echo $repeater['number']; ?>">
                            
                                <label for="<?php echo esc_attr( $repeater_symbol_id );?>"><?php esc_html_e('Symbol','isha');?></label>
                                <br/>
                                <input type="text" name="<?php echo esc_attr($repeater_symbol_name); ?>" class="widefat" id="<?php echo esc_attr($repeater_symbol_id); ?>" value="<?php echo $repeater['symbol']; ?>">
                            
                                <label for="<?php echo esc_attr( $repeater_text_id );?>"><?php esc_html_e('Text','isha');?></label>
                                <br/>
                                <input type="text" name="<?php echo esc_attr($repeater_text_name); ?>" class="widefat" id="<?php echo esc_attr($repeater_text_id); ?>" value="<?php echo $repeater['text']; ?>">
                
                                <a class="isha-remove delete"><?php esc_html_e( 'Remove Section', 'isha' );?> </a>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                }
            }
            ?>
            </span>
            <a class="isha-add-why-choose button repeater-btn" data-id="isha_repeater_widget" id="<?php echo esc_attr($number_id); ?>"><?php esc_html_e('Add New Section', 'isha'); ?></a>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance['select_page_id'] = absint($new_instance['select_page_id']);
            if (isset($new_instance['repeaters']))
            {
                foreach($new_instance['repeaters'] as $repeater){

                    $repeater['number'] = absint($repeater['number']);
                    $repeater['symbol'] = sanitize_text_field($repeater['symbol']);
                    $repeater['text'] = sanitize_text_field($repeater['text']);
                }
                $instance['repeaters'] = $new_instance['repeaters'];
            }

            return $instance;
        }

        public function widget($args, $instance)
        {
            
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
                $layout_enable = $layout_enable_check ? 'true' : 'false';
                $select_page_id[] = (!empty($instance['select_page_id'])) ? $instance['select_page_id'] : array();
                $repeaters = (!empty($instance['repeaters'])) ? $instance['repeaters'] : array();
                $repeaters[]= array('number'=>$repeaters['rep_number'],'symbol'=>$repeaters['rep_symbol'],'text'=>$repeaters['rep_text']);
                unset($repeaters['rep_number']);
                unset($repeaters['rep_symbol']);
                unset($repeaters['rep_text']);
                if($layout_enable =='true'):
                
                ?>
                <!-- Why Choose -->
                <section class="why-choose section" data-stellar-background-ratio="0.5">
                    <div class="container">
                        <div class="row">
                            <?php
                            $args = array (
                                'post_type' => 'page',
                                'post_per_page' => 1,
                                'post__in'         => ($select_page_id) ? ($select_page_id) : '',
                                'orderby'           =>'post__in',
                            );

                            $whatWeDoloop = new WP_Query($args);
                            if ($whatWeDoloop->have_posts()) :  while ($whatWeDoloop->have_posts()) : $whatWeDoloop->the_post();?>
                            <div class="col-lg-6 col-12">
                                <div class="why-left">
                                    <div class="why-slider">
                                        <!-- Why Image -->
                                        <?php if(has_post_thumbnail()): 
                                            $featured_image = get_the_post_thumbnail_url(get_the_ID(),'isha-what-we-do-thumb');
                                            ?>
                                        <div class="single-image">
                                            <img src="<?php echo esc_url($featured_image);?>" alt="#">
                                            <a data-fancybox="portfolio" href="<?php echo esc_url($featured_image);?>" class="zoom"><i class="fa fa-photo"></i></a>
                                        </div>
                                        <?php endif;?>
                                        <!-- End Why Image -->
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="section-title">
                                    <h2 class="front-widget-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                </div>
                                <div class="choose-main">
                                   <?php the_excerpt();?>
                                </div>
                                
                                <div class="some-fact">
                                    <div class="row">
                                        <?php if( ! empty($repeaters)):
                                            foreach($repeaters as $repeater):
                                                $number  = $repeater['number'];
                                                $symbol  = $repeater['symbol'];
                                                $text  = $repeater['text'];
                                                ?>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="single-fact">
                                                        <h4 class="secondary-widget-title wow zoomIn" data-wow-delay="0.2s"><span class="<?php if (!$number =='') { echo "count" ;} ?>"><?php echo esc_html($number);?></span><?php echo esc_html($symbol);?></h4>
                                                        <p><?php echo esc_html($text);?></p>
                                                    </div>
                                                </div>
                                        <?php 
                                        endforeach;
                                    endif;?>
                                    </div>
                                </div>
                            </div>
                            <?php  
                            endwhile;
                            wp_reset_postdata();  
                            endif; ?>
                        </div>
                    </div>
                </section>
                <!--/ End Why Choose -->
                <?php
                
                endif;
            }
        }

        }
    }