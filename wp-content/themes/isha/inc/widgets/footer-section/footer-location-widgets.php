<?php
if (!class_exists('Isha_Footer_Location_Widget')) {
    class Isha_Footer_Location_Widget extends WP_Widget
    {

        private function defaults()
        {
            $defaults = array(
                'title' => '',
                'description' => '',
                'address_icon'=> '',
                'address_info'=>'',
                'phone_icon' => '',
                'phone_no'=> '',
                'email_icon'=> '',
                'email_address'=>''

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_location_widget',
                esc_html__('Isha : Footer Location', 'isha'),
                array('description' => esc_html__('Footer Location section', 'isha'))
            );
        }

        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $title = $instance['title'] ;
            $description   =  $instance['description'] ;
            $address_icon   =  $instance['address_icon'] ;
            $address_info   =  $instance['address_info'] ;
            $phone_icon   =  $instance['phone_icon'] ;
            $phone_no   =  $instance['phone_no'] ;
            $email_icon   =  $instance['email_icon'] ;
            $email_address   =  $instance['email_address'] ;
            ?>
         
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo esc_attr($title); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('description')); ?>">
                    <?php esc_html_e('Description', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description') ); ?>" value="<?php echo esc_attr($description); ?>">
            </p>

             <p>
                <label for="<?php echo esc_attr($this->get_field_id('address_icon')); ?>">
                    <?php esc_html_e('Address icon example as " fa fa-home " ', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('address_icon') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address_icon') ); ?>" value="<?php echo esc_attr($address_icon); ?>">
            </p>

             <p>
                <label for="<?php echo esc_attr($this->get_field_id('address_info')); ?>">
                    <?php esc_html_e('Address info', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('address_info') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address_info') ); ?>" value="<?php echo esc_attr($address_info); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('phone_icon')); ?>">
                    <?php esc_html_e('Phone icon example as " fa fa-phone "', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('phone_icon') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_icon') ); ?>" value="<?php echo esc_attr($phone_icon); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('phone_no')); ?>">
                    <?php esc_html_e('Phone Number', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('phone_no') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_no') ); ?>" value="<?php echo esc_attr($phone_no); ?>">
            </p>


            <p>
                <label for="<?php echo esc_attr($this->get_field_id('email_icon')); ?>">
                    <?php esc_html_e('Email icon example as " fa fa-envelope "', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('email_icon') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_icon') ); ?>" value="<?php echo esc_attr($email_icon); ?>">
            </p>


            <p>
                <label for="<?php echo esc_attr($this->get_field_id('email_address')); ?>">
                    <?php esc_html_e('Email Address', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('email_address') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_address') ); ?>" value="<?php echo esc_attr($email_address); ?>">
            </p>

            
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['description'] = sanitize_text_field($new_instance['description']);
            $instance['address_icon'] = sanitize_text_field($new_instance['address_icon']);
            $instance['address_info'] = sanitize_text_field($new_instance['address_info']);
            $instance['phone_icon'] = sanitize_text_field($new_instance['phone_icon']);
            $instance['phone_no'] = sanitize_text_field($new_instance['phone_no']);
            $instance['email_icon'] = sanitize_text_field($new_instance['email_icon']);
            $instance['email_address'] = sanitize_text_field($new_instance['email_address']);

            return $instance;
        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $description   =  $instance['description'] ;
                $address_icon   =  $instance['address_icon'] ;
                $address_info   =  $instance['address_info'] ;
                $phone_icon   =  $instance['phone_icon'] ;
                $phone_no   =  $instance['phone_no'] ;
                $email_icon   =  $instance['email_icon'] ;
                $email_address   =  $instance['email_address'] ;
                ?>
                <!-- Count Down -->
              	<div class="col-lg-4 col-md-6 col-12">
					<div class="single-widget contact">
						<h2><?php echo esc_html($title);?></h2>
						<p><?php echo esc_html($description);?></p>
						<ul class="list">
							<li><i class="<?php echo esc_attr($address_icon);?>"></i><?php echo esc_html($address_info);?></li>
							<li><i class="<?php echo esc_attr($phone_icon);?>"></i><?php echo esc_html($phone_no);?></li>
                            <li><i class="<?php echo esc_attr($email_icon);?>"></i><a href="mailto:<?php echo esc_attr($email_address);?>"><?php echo esc_html($email_address);?></a></li>							
						</ul>
					</div>
				</div>
                <!--/ End Count Down -->
                <?php
            
            }
        }

        }
    }
