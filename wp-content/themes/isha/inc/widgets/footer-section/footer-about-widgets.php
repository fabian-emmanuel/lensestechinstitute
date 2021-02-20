<?php
if (!class_exists('Isha_Footer_About_Widget')) {
    class Isha_Footer_About_Widget extends WP_Widget
    {

        private function defaults()
        {
            $defaults = array(
                'layout_enable' => 'off',
                'image_url'=>'',
                'description'=>'',
                'repeaters' => ''

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_about_widget',
                esc_html__('Isha : Footer info', 'isha'),
                array('description' => esc_html__('Footer info section', 'isha'))
            );
        }

        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $image_url   = ( ! empty( $instance['image_url'] ) ) ? $instance['image_url'] : '';
            $description = ! empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
            $repeaters   = ( ! empty( $instance['repeaters'] ) ) ? $instance['repeaters'] : array();
            ?>
            <p>
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Footer About Section', 'isha'); ?></label> 
            </p>

            <p>
              <label for="<?php echo esc_attr($this->get_field_id('image_url')); ?>"><?php esc_attr_e( 'Logo:', 'isha' );?></label><br />
                <img class="custom_media_image_footer_about" src="<?php if(!empty($instance['image_url'])){echo esc_url($instance['image_url']);} ?>"/>
                <input type="hidden" class="widefat custom_media_url_footer_about" name="<?php echo esc_attr($this->get_field_name('image_url')); ?>" id="<?php echo $this->get_field_id('image_url'); ?>" value="<?php echo esc_url($instance['image_url']); ?>">
                <input type="button" value="<?php esc_attr_e( 'Upload Image', 'isha' ); ?>" class="button custom_media_upload" id="custom_image_uploader_<?php echo $this->get_field_id('image_url'); ?>"/>
                <a class="isha-remove-counter button" data-id="remove_media_button"><?php esc_html_e('Remove Image', 'isha'); ?></a>
            </p>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) )?>"><strong><?php esc_html_e( 'Description: ', 'isha' )?></strong></label>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" value="<?php echo esc_attr( $description ); ?>" class="widefat">
            </p>
            <div class="isha-additional-footer-social">
            <!--repeater-->
                <?php
                if  ( count( $repeaters ) >=  1 && is_array( $repeaters ) )
                {
                    $socialIconValue = $repeaters['social_icon'];
                    $socialUrlValue = $repeaters['social_url'];
                }

                else
                {
                    $socialIconValue = '';
                    $socialUrlValue = '';
                }

                $social_icon_id   = $this->get_field_id( 'repeaters' ).'-social_icon';
                $social_icon_name = $this->get_field_name( 'repeaters'). '[social_icon]';
                $social_url_id   = $this->get_field_id( 'repeaters' ).'-social_url';
                $social_url_name = $this->get_field_name( 'repeaters'). '[social_url]';
                ?>    
             <p>
                <label>
                <?php 
                /* translators: %1$s: link of fontawesome, %2$s: closing anchor tag */ 
                echo sprintf( __( 'Social Icon example as " fa fa-facebook " (Use font awesome icon: %1$s See more here %2$s)', 'isha' ),'<a href="'.esc_url('https://fontawesome.com/v4.7.0/icons/').'" target="_blank">','</a>'); 
                ?>
                 </label>
                <input type="text" name="<?php echo esc_attr( $social_icon_name ) ?>" class="widefat" id="<?php echo esc_attr($social_icon_id); ?>" value="<?php echo  esc_attr($socialIconValue); ?>">
            </p>

            <p>
                <label><?php _e( 'Social Url', 'isha' ); ?>:</label>
                <input type="text" name="<?php echo esc_attr( $social_url_name ) ?>" class="widefat" id="<?php echo esc_attr($social_url_id); ?>" value="<?php echo  esc_url($socialUrlValue); ?>">
            </p>
             <?php

            $counter = 0;

            if ( count( $repeaters ) > 0 )
            {
                foreach( $repeaters as $repeater )
                {

                    if ( isset( $repeater['social_icon'] ) || isset( $repeater['social_url'] ) )

                    { 
                        $repeater_social_icon_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-social_icon';
                        $repeater_social_icon_name  = $this->get_field_name( 'repeaters' ) . '['.$counter.'][social_icon]';
                       
                        $repeater_social_url_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-social_url';
                        $repeater_social_url_name  = $this->get_field_name( 'repeaters' ) . '['.$counter.'][social_url]';
                    ?>

                        <div class="isha-sec-footer-social isha-sec">
                            <div class="sub-option section widget-upload">
                                <label for="<?php echo esc_attr( $repeater_social_icon_id );?>"><?php 
                                /* translators: %1$s: link of fontawesome, %2$s: closing anchor tag */ 
                                echo sprintf( __( 'Use font awesome icon: %1$s See more here %2$s', 'isha' ),'<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>'); 
                                ?></label>
                                <br/>
                                <input type="text" name="<?php echo esc_attr($repeater_social_icon_name); ?>" class="widefat" id="<?php echo esc_attr($repeater_social_icon_id); ?>" value="<?php echo esc_Attr($repeater['social_icon']); ?>">
                                <br/>
                                
                                <label for="<?php echo esc_attr( $repeater_social_url_id );?>"><?php esc_html_e('Social Url','isha');?></label>
                                <br/>
                                <input type="text" name="<?php echo esc_attr($repeater_social_url_name); ?>" class="widefat" id="<?php echo esc_attr($repeater_social_url_id); ?>" value="<?php echo esc_attr($repeater['social_url']); ?>">
                
                                <a class="isha-remove delete"><?php esc_html_e( 'Remove Section', 'isha' );?> </a>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                }
            }
            ?>
            </div>
            <a class="isha-add-footer-social button repeater-btn" data-id="isha_repeater_widget" id="<?php echo esc_attr($number_id); ?>"><?php esc_html_e('Add New Section', 'isha'); ?></a>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance['image_url'] = esc_url_raw($new_instance['image_url']);
            $instance[ 'description' ] = sanitize_text_field( $new_instance[ 'description' ] );
            if (isset($new_instance['repeaters']))
            {
                foreach($new_instance['repeaters'] as $repeater){
                    $repeater['social_icon'] = sanitize_text_field($repeater['social_icon']);
                    $repeater['social_url'] = esc_url_raw($repeater['social_url']);
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
                $image_url = (!empty($instance['image_url'])) ? $instance['image_url'] : array();
                $description = ! empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
                $repeaters = (!empty($instance['repeaters'])) ? $instance['repeaters'] : array();
                $repeaters[]= array('social_icon'=>$repeaters['social_icon'],'social_url'=>$repeaters['social_url']);
                unset($repeaters['social_icon']);
                unset($repeaters['social_url']);
                if($layout_enable =='true'):
                ?>
               <!-- Single Widget -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-widget about">
                        <?php if(!empty($image_url)):?>
                        <img src="<?php echo esc_url($image_url);?>" alt="#">
                        <?php else:?>
                         <h2 class="site-title mt-3"><a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                        <?php endif;?>
                        <p><?php echo esc_html($description);?></p>
                        <div class="social">
                            <ul>
                                 <?php if( ! empty($repeaters)):
                                foreach($repeaters as $repeater):
                                    $icon  = $repeater['social_icon'];
                                    $url  = $repeater['social_url'];
                                    
                                    if( ! empty($icon)): ?>
                                        <li><a href="<?php echo esc_url($url);?>"><i class="<?php echo esc_attr($icon);?>"></i></a></li>
                                    <?php endif;
                               
                                endforeach;
                            endif;?>  
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ End Single Widget -->
                <?php
                
                endif;
            }
        }

    }
}