<?php
if (!class_exists('Isha_About_Widget')) {
    class Isha_About_Widget extends WP_Widget
    {

        private function defaults()
        {
            $defaults = array(
                'layout_enable' => 'off',
                'select_page_id' => '',
                'video_url' => '',
                'btn_title_1'=>'',
                'btn_url_1'=>'',
                'btn_title_2'=>'',
                'btn_url_2'=>''

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'isha_about_template_widget',
                esc_html__('Isha : Template About Widget', 'isha'),
                array('description' => esc_html__('Template About Widget Section', 'isha'))
            );
        }

        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $layout_enable =  $instance[ 'layout_enable' ];
            $select_page_id   = ( ! empty( $instance['select_page_id'] ) ) ? $instance['select_page_id'] : array();
            $videourl =  $instance[ 'video_url' ];
            $btn_title_1 = ! empty( $instance[ 'btn_title_1' ] ) ? $instance[ 'btn_title_1' ] : '';
            $btn_url_1 = ! empty( $instance[ 'btn_url_1' ] ) ? $instance[ 'btn_url_1' ] : '';
            $btn_title_2 = ! empty( $instance[ 'btn_title_2' ] ) ? $instance[ 'btn_title_2' ] : '';
            $btn_url_2 = ! empty( $instance[ 'btn_url_2' ] ) ? $instance[ 'btn_url_2' ] : '';
            ?>
            <p>
               <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable About Section', 'isha'); ?></label> 
               <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
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
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('video_url') ); ?>">
                    <?php esc_html_e( 'Video Url', 'isha'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('video_url')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('video_url')); ?>" value="<?php echo esc_attr($videourl); ?>">
            </p>
        
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'btn_title_1' ) )?>"><strong><?php echo esc_html__( 'Button Title 1: ', 'isha' )?></strong></label>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'btn_title_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_title_1' ) ); ?>" value="<?php echo esc_attr( $btn_title_1 ); ?>" class="widefat">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'btn_url_1' ) )?>"><strong><?php echo esc_html__( 'Button URL 1: ', 'isha' )?></strong></label>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'btn_url_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url_1' ) ); ?>" value="<?php echo esc_url( $btn_url_1 ); ?>" class="widefat">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'btn_title_2' ) )?>"><strong><?php echo esc_html__( 'Button Title 2: ', 'isha' )?></strong></label>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'btn_title_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_title_2' ) ); ?>" value="<?php echo esc_attr( $btn_title_2 ); ?>" class="widefat">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'btn_url_2' ) )?>"><strong><?php echo esc_html__( 'Button URL 2: ', 'isha' )?></strong></label>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'btn_url_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url_2' ) ); ?>" value="<?php echo esc_url( $btn_url_2 ); ?>" class="widefat">
            </p>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
            $instance['video_url'] = esc_url_raw($new_instance['video_url']);
            $instance['select_page_id'] = absint($new_instance['select_page_id']);
            $instance[ 'btn_title_1' ] = sanitize_text_field( $new_instance[ 'btn_title_1' ] );
            $instance[ 'btn_url_1' ] = sanitize_text_field( $new_instance[ 'btn_url_1' ] );
            $instance[ 'btn_title_2' ] = sanitize_text_field( $new_instance[ 'btn_title_2' ] );
            $instance[ 'btn_url_2' ] = sanitize_text_field( $new_instance[ 'btn_url_2' ] );

            return $instance;
        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
                $layout_enable = $layout_enable_check ? 'true' : 'false';
                $video_url =  $instance['video_url'];
                $btn_title_1 = ! empty( $instance[ 'btn_title_1' ] ) ? $instance[ 'btn_title_1' ] : '';
                $btn_url_1 = ! empty( $instance[ 'btn_url_1' ] ) ? $instance[ 'btn_url_1' ] : '';
                $btn_title_2 = ! empty( $instance[ 'btn_title_2' ] ) ? $instance[ 'btn_title_2' ] : '';
                $btn_url_2 = ! empty( $instance[ 'btn_url_2' ] ) ? $instance[ 'btn_url_2' ] : '';
                $select_page_id = (!empty($instance['select_page_id'])) ? $instance['select_page_id'] : array();
                if($layout_enable =='true'):
                echo $args['before_widget'];
                $cta_page_title = get_post($select_page_id);
                $img_url = get_the_post_thumbnail_url($select_page_id);
                ?>
                <!-- About Us -->
                <section class="about-us section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="about-content">
                                    <h3><a href="<?php echo esc_url( get_permalink( ($select_page_id ) ) );?>"><?php echo esc_html($cta_page_title->post_title);?></a></h3>
                                    <p><?php echo esc_html(substr(strip_tags($cta_page_title->post_content),0,550));?></p>
                                    <div class="button">
                                        <?php if(!empty($btn_url_1)):?>
                                            <a href="<?php echo esc_url($btn_url_1);?>" class="btn"><?php echo esc_html($btn_title_1);?></a>
                                        <?php endif;?>
                                        <?php if(!empty($btn_url_2)):?>
                                            <a href="<?php echo esc_url($btn_url_2);?>" class="btn primary"><?php echo esc_html($btn_title_2);?></a>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="about-img overlay">
                                    <div class="button">
                                        <a href="<?php echo esc_url($video_url);?>" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
                                    </div>
                                    <img src="<?php echo esc_url($img_url);?>" alt="#">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End About Us -->
                <?php
                echo $args['after_widget'];
                endif;
            }
        }

        }
    }