<?php 
if( !class_exists('Isha_Single_Pricing_Widget')){
	class Isha_Single_Pricing_Widget extends WP_Widget{
		// setup the widget name, description etc.

		 private function defaults()
        {

            $defaults = array(
                'layout_enable' => 'off',
                'title'=> '',
                'currency'=> '',
                'price'=> '',
                'duration'=> '',
                'repeaters'=>''
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_single_pricing_widget',
                esc_html__('Isha : Pricing Table Widget', 'isha'),
                array('description' => esc_html__('Princing table Section', 'isha'))
            );
        }
        
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $title = esc_attr( $instance['title'] );
            $currency   = ( ! empty( $instance['currency'] ) ) ? $instance['currency'] : '';
            $price   = ( ! empty( $instance['price'] ) ) ? $instance['price'] : '';
            $duration   = ( ! empty( $instance['duration'] ) ) ? $instance['duration'] : '';
            $repeaters   = ( ! empty( $instance['repeaters'] ) ) ? $instance['repeaters'] : array();
           	$btn_text   = ( ! empty( $instance['btn_text'] ) ) ? $instance['btn_text'] : '';
           	$btn_url   = ( ! empty( $instance['btn_url'] ) ) ? $instance['btn_url'] : '';
            ?>
            <p>
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Feature Section', 'isha'); ?></label> 
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>
           	
           	<p>
				<label for="<?php echo esc_attr( $this->get_field_id('currency') ); ?>"><?php esc_html_e('Currency example as " $ " ', 'isha'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('currency') ); ?>" name="<?php echo esc_attr( $this->get_field_name('currency') ); ?>" type="text" value="<?php echo esc_attr( $currency );?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('price') ); ?>"><?php esc_html_e('Price example as " 100 "', 'isha'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('price') ); ?>" name="<?php echo esc_attr( $this->get_field_name('price') ); ?>" type="text" value="<?php echo esc_attr( $price );?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('duration') ); ?>"><?php esc_html_e('Duration example as " weekly "', 'isha'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('duration') ); ?>" name="<?php echo esc_attr( $this->get_field_name('duration') ); ?>" type="text" value="<?php echo esc_attr( $duration );?>"/>
			</p>

			<span class="isha-additional">
            <!--repeater-->
            <p>
                <label><?php esc_html_e( 'Type your Feature', 'isha' ); ?>:</label>
                <?php
                if  ( count( $repeaters ) >=  1 && is_array( $repeaters ) )
                {
                    $textValue = $repeaters['feature'];
                }

                else
                {
                    $textValue = '';
                }

                $repeater_feature_id   = $this->get_field_id( 'repeaters' ).'-feature';
                $repeater_feature_name = $this->get_field_name( 'repeaters'). '[feature]';
                ?>    
                 <input type="text" name="<?php echo esc_attr( $repeater_feature_name ) ?>" class="widefat" id="<?php echo esc_attr($repeater_feature_id); ?>" value="<?php echo  esc_attr($textValue); ?>">
            </p>
          
            <?php

            $counter = 0;

            if ( count( $repeaters ) > 0 )
            {
                foreach( $repeaters as $repeater )
                {

                    if ( isset( $repeater['feature'] ) )

                    { ?>
                        <div class="isha-sec">
                            <div class="sub-option section widget-upload">
                            <?php
                            $repeater_feature_name  = $this->get_field_name( 'repeaters' ) . '['.$counter.'][feature]';
                            $repeater_feature_id     = $this->get_field_id( 'repeaters' ) .'-'. $counter.'-feature';?>
                            
                            <label for="<?php echo esc_attr($repeater_feature_id);?>">
                            <?php esc_html_e( 'Feature', 'isha' ) ?>
                            </label><br/>
                            <input type="text" name="<?php echo esc_attr($repeater_feature_name); ?>" class="widefat" id="<?php echo esc_attr($repeater_feature_id); ?>" value="<?php echo esc_attr($repeater['feature']); ?>">

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
            <a class="isha-add-pricing button repeater-btn" data-id="isha_repeater_widget" id="<?php echo esc_attr($repeater_feature_id); ?>"><?php esc_html_e('Add New Section', 'isha'); ?></a>

            <hr/>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('btn_text') ); ?>"><?php esc_html_e('Button Text', 'isha'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('btn_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('btn_text') ); ?>" type="text" value="<?php echo esc_attr( $btn_text );?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('btn_url') ); ?>"><?php esc_html_e('Button Link', 'isha'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('btn_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('btn_url') ); ?>" type="text" value="<?php echo esc_url( $btn_url );?>"/>
			</p>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['currency'] = sanitize_text_field($new_instance['currency']);
            $instance['price'] = sanitize_text_field($new_instance['price']);
            $instance['duration'] = sanitize_text_field($new_instance['duration']);
             if (isset($new_instance['repeaters']))
            {
                foreach($new_instance['repeaters'] as $repeater){
                    $repeater['feature'] = sanitize_text_field($repeater['feature']);
                }
                $instance['repeaters'] = $new_instance['repeaters'];
            }
            $instance['btn_text'] = sanitize_text_field($new_instance['btn_text']);
            $instance['btn_url'] = esc_url_raw($new_instance['btn_url']);
            return $instance;
        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
                $layout_enable = $layout_enable_check ? 'true' : 'false';
                $currency = (!empty($instance['currency'])) ? $instance['currency'] : '';
                $price = (!empty($instance['price'])) ? $instance['price'] : '';
                $duration = (!empty($instance['duration'])) ? $instance['duration'] : '';
                $repeaters = (!empty($instance['repeaters'])) ? $instance['repeaters'] : array();
                $repeaters[]= array('feature' => isset($repeaters['feature']) ? $repeaters['feature'] : '');
                unset($repeaters['feature']);
                $btn_text = (!empty($instance['btn_text'])) ? $instance['btn_text'] : '';
                $btn_url = (!empty($instance['btn_url'])) ? $instance['btn_url'] : '';
                if($layout_enable =='true'):
                echo $args['before_widget'];
                ?>
                <div class="e-table2 e-table-default wow fadeInUp" data-wow-delay="0.2s">
                    <!-- Table Head -->
                    <div class="e-table-head">
                        <?php echo $args['before_title'];
                        	echo esc_html($title);
                        echo $args['after_title'];?>
                        <!-- Table Price -->
                        <div class="price">
                            <p class="amount"><span class="currency"><?php echo esc_html($currency);?></span><?php echo esc_html($price);?><span><?php esc_html_e('/','isha');?><?php echo esc_html($duration);?></span></p>
                        </div>
                    </div>
                    <!-- Table List -->
                    <ul class="e-table-list">
                         <?php if( ! empty($repeaters)):
                            foreach($repeaters as $repeater):
                                
                                $feature = $repeater['feature'];
                                
                            ?>
                        <li><?php echo esc_html($feature);?></li>
                       <?php 
                          
                            endforeach;
                        endif;?>
                    </ul>
                    <!-- Table Bottom -->
                    <div class="e-table-bottom">
                        <?php if( !empty($btn_text)):?>
                        <a class="btn shine" href="<?php echo esc_url($btn_url);?>"><?php echo esc_html($btn_text);?></a>
                        <?php endif;?>
                    </div>
                </div>
                <?php
                echo $args['after_widget'];
                endif;
            }
        }
	}
}
