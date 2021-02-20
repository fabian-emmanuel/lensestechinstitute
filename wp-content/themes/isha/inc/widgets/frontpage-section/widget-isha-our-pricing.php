<?php
if (!class_exists('Isha_Pricing_Widget')) {
    class Isha_Pricing_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title' => '',
                'sub-title' => '',
                'layout_enable' => 'off'
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business_features_widget',
                esc_html__('Isha: 5 Frontpage Our Pricing Widget', 'isha'),
                array('description' => esc_html__('Frontpage Our Pricing Section', 'isha'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $title = esc_attr( $instance['title'] );
            $subtitle =  esc_attr( $instance['sub-title'] );
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
                <label for="<?php echo esc_attr( $this->get_field_id('sub-title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo $subtitle; ?>">
            </p>
            
            <p><?php esc_html_e( 'Add "Isha:  Single Pricing Table Widget" to "Frontpage Single Pricing Table Area" For Pricing Table', 'isha' );?></p>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);

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
                if($layout_enable =='true'):
                echo $args['before_widget'];
                ?>
                <!-- Pricing Table -->
                <section class="easy-section section">
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
                            <!-- Single Table -->
                            <?php if ( is_active_sidebar( 'frontpage-single-pricing-table' ) ) { ?>
                                <?php dynamic_sidebar( 'frontpage-single-pricing-table' );?>
                            <?php } ?>
                            <!-- End Single Table-->
                        </div>  
                    </div>  
                </section>  
                <!--/ End Pricing Table -->
                <?php
                echo $args['after_widget'];
                endif;
            }
        }

        }
    }