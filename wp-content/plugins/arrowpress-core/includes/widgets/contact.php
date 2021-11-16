<?php
if ( ! class_exists( 'Apr_Core_Contact_Widget' ) ) {
	class Apr_Core_Contact_Widget extends Apr_Widget {
		public function __construct() {
			$this->widget_cssclass    = 'tm-contact-widget';
			$this->widget_description = esc_html__( 'Get list contact info.', 'apr-core' );
			$this->widget_id          = 'tm-contact-widget';
			$this->widget_name        = esc_html__( '[APR] Contact', 'apr-core' );
			$this->settings           = array(
				'posttype'           => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Style', 'apr-core' ),
					'options' => array(
						'type1' => 'Style 1',
						'type2' => 'Style 2',
					),
					'std'     => 'type1',
				),
			);
			parent::__construct();
		}
		public function widget( $args, $instance ) {
			$before_widget 	= '<div id="tm-contact-widget" class="widget tm-contact-widget">';
			$after_widget 	= '</div>';
			$before_title 	= '<h2 class="widget-title">';
			$after_title  	= '</h2>';
			$title 			= apply_filters('widget_title', $instance['title'] );
			$desc_title     = isset( $instance['desc_title'] ) ? $instance['desc_title'] : $this->settings['desc_title']['std'];
			$posttype        = isset( $instance['posttype'] ) ? $instance['posttype'] : $this->settings['posttype']['std'];
			$address        = isset( $instance['address'] ) ? $instance['address'] : $this->settings['address']['std'];
			$address_link        = (isset( $instance['address_link'] )&&$instance['address_link']!='') ? $instance['address_link'] : '#';
			$address_2        = isset( $instance['address_2'] ) ? $instance['address_2'] : $this->settings['address_2']['std'];
			$address_link_2        = (isset( $instance['address_link_2'] )&&$instance['address_link_2']!='') ? $instance['address_link_2'] : '#';
			$phone          = isset( $instance['phone'] ) ? $instance['phone'] : $this->settings['phone']['std'];
			$phone_2          = isset( $instance['phone_2'] ) ? $instance['phone_2'] : $this->settings['phone_2']['std'];
			$mail           = isset( $instance['mail'] ) ? $instance['mail'] : $this->settings['mail']['std'];
            $mail_2           = isset( $instance['mail_2'] ) ? $instance['mail_2'] : $this->settings['mail_2']['std'];
			$time           = isset( $instance['time'] ) ? $instance['time'] : $this->settings['time']['std'];
			$output         = '';
			echo wp_kses_post( $args['before_widget']);
			if ( $instance['title'] ){
                echo wp_kses_post($args['before_title'] . esc_html($instance['title']) . $args['after_title']);
			}
			if($desc_title!=''){?>
				<p class="title-desc">
					<?php echo esc_attr($desc_title); ?>
				</p>
				<?php
			}?>
			<ul class="list-info-contact <?php echo esc_attr( $posttype );?>">
			<?php if($phone!='' || $phone_2!=''): ?>
                    <li class="info-phone">
						<i class="fa fa-phone" <?php echo ($posttype == 'type2') ? 'hidden' : '' ?>></i>
						<p>
							<span class="info-txt-phone" <?php echo ($posttype == 'type1' || $posttype == 'type3' || $phone=='') ? 'hidden' : '' ?>><?php echo esc_html__('P: ','arrowit');?></span>
							<span class="info-txt-phone" <?php echo ($posttype != 'type3' || $phone=='') ? 'hidden' : '' ?>><?php echo esc_html__('Phone: ','arrowit');?></span>
						</p>
                        <div class="info-content">
                            <?php if ($phone!=''){
								$class = ($phone_2=='') ? "fc-noline" : "";
                             echo '<a class="'.$class.'" href="tel:' . str_replace(" ", "", $phone).'">'.esc_html($phone) . '</a>';
                            }
                            if ($phone_2!=''){
                             echo '<p><a href="tel:' . str_replace(" ", "", $phone_2).'">'.esc_html($phone_2) . '</a></p>';
                            } ?>
                        </div>
                    </li>
				<?php endif; ?>
				
				<?php if($mail!='' || $mail_2!=''): ?>
                    <li class="info-mail">
                    	<i class="fa fa-envelope" <?php echo ($posttype == 'type2') ? 'hidden' : '' ?>></i>
						<p>
							<span class="info-txt-mail" <?php echo ($posttype == 'type1' || $posttype == 'type3' || $mail=='') ? 'hidden' : '' ?>><?php echo esc_html__('E: ','arrowit');?></span>
							<span class="info-txt-mail" <?php echo ($posttype != 'type3' || $mail=='') ? 'hidden' : '' ?>><?php echo esc_html__('Email: ','arrowit');?></span>
						</p> 
                        <div class="info-content">
                        	<?php if ($mail!=''){
								$class = ($mail_2=='') ? "fc-noline" : "";
								if ($posttype == 'type3') {
									echo '<a href="mailto:' . esc_html($mail).'">'. '<span class="ct-email">Email 1:</span>' .esc_html($mail) . '</a>';
								} else {
									echo '<a class="'.$class.'" href="mailto:' . esc_html($mail).'">'.esc_html($mail) . '</a>';
								}                            	
                            }
                            if ($mail_2!=''){
								if ($posttype == 'type3') {
									echo '<a href="mailto:' . esc_html($mail_2).'">'. '<span class="ct-email">Email 2:</span>' .esc_html($mail_2) . '</a>';
								} else {
                                    echo '<p><a href="mailto:' . esc_html($mail_2).'">'.esc_html($mail_2) . '</a></p>';
                                }
                            } ?>
                        </div>
                    </li>
				<?php endif;?>

				<?php if($address!='' || $address_2!=''): ?>
                    <li class="info-address">
                    	<i class="fa fa-map-marker" <?php echo ($posttype == 'type2') ? 'hidden' : '' ?>></i>
						<p>
							<span class="info-txt-address" <?php echo ($posttype == 'type1' || $posttype == 'type3' || $address=='') ? 'hidden' : '' ?>><?php echo esc_html__('A: ','arrowit');?></span>
							<span class="info-txt-address" <?php echo ($posttype != 'type3' || $address=='') ? 'hidden' : '' ?>><?php echo esc_html__('Address: ','arrowit');?></span>
						</p>
                        <div class="info-content">
                            <?php if ($address!=''){
								$class = ($address_2=='') ? "fc-noline" : "";
								echo '<p><a class="'.$class.'" href="'. $address_link. '">'. esc_html($address) .'</a>
								<a class="to-map" href="'. $address_link. '" target="_blank">Go to the map</a></p>';
                            }
                            if ($address_2!=''){
								echo '<p><a href="'. $address_link_2. '">'. esc_html($address_2) .'</a>
								<a class="to-map" href="'. $address_link_2. '" target="_blank">Go to the map</a></p>';
                            }
                            ?>
                        </div>
                    </li>
                <?php endif; ?>
							
				<?php if($time!=''): ?>
					<li class="info-time"> 
						<i class="fa fa-clock-o" <?php echo ($posttype == 'type2') ? 'hidden' : '' ?>></i>
						<span class="info-txt-time" <?php echo ($posttype == 'type1') ? 'hidden' : '' ?> title="Working days/hours"><?php echo esc_html__('W: ','arrowit');?> </span>
						 <div class="info-content">
							<?php echo '<p>'. esc_html($time). '</p>';?> 
						</div>
					</li>
				<?php endif;?>
			</ul>
			<?php 
			echo wp_kses_post($args['after_widget']);
		}
		public function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title']   = strip_tags( $new_instance['title'] );
			$instance['posttype'] = strip_tags( $new_instance['posttype'] );
			$instance['desc_title'] = strip_tags( $new_instance['desc_title'] );
			$instance['address'] = strip_tags( $new_instance['address'] );
			$instance['address_link'] = strip_tags( $new_instance['address_link'] );
			$instance['address_2'] = strip_tags( $new_instance['address_2'] );
			$instance['address_link_2'] = strip_tags( $new_instance['address_link_2'] );
			$instance['phone'] 	 = strip_tags( $new_instance['phone'] );
			$instance['phone_2'] 	 = strip_tags( $new_instance['phone_2'] );
			$instance['mail'] 	 = strip_tags( $new_instance['mail'] );
			$instance['mail_2'] 	 = strip_tags( $new_instance['mail_2'] );
			$instance['time'] 	 = strip_tags( $new_instance['time'] );
			return $instance;
		}
		public function form($instance){

			$defaults = array( 
				'title'          => 'Contact info',
				'desc_title'     => '',
				'posttype'       => '',
				'address'        => '16122 Collins Street Victoria 8007 Australia',
				'address_link'   => '',
				'address_2'      => '',
				'address_link_2' => '',
				'phone'          => '+01-909-980-0032',
				'phone_2'        => '',
				'mail'           => 'info@company.com',
				'mail_2'         => '',
				'time'           => '',
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			$posttype = $instance['posttype'];
		?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
			</p>
			<p>
				<label>Choose an icon:</label>
			      <select id="<?php echo $this->get_field_id('posttype'); ?>" name="<?php echo $this->get_field_name('posttype'); ?>" class="widefat" style="width:100%;"> 
			        <option <?php selected( $instance['posttype'], 'type1'); ?> value="type1">Style 1</option> 
					<option <?php selected( $instance['posttype'], 'type2'); ?> value="type2">Style 2</option>
					<option <?php selected( $instance['posttype'], 'type3'); ?> value="type3">Style 3</option>
			    </select>
			</p>
			<p >
				<label for="<?php echo esc_attr($this->get_field_id( 'desc_title' )); ?>"><?php esc_html_e('Description Title', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'desc_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc_title' )); ?>" value="<?php echo esc_attr($instance['desc_title']); ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e('Address', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" value="<?php echo esc_attr($instance['address']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'address_link' )); ?>"><?php esc_html_e('Address Link', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'address_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_link' )); ?>" value="<?php echo esc_attr($instance['address_link']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'address_2' )); ?>"><?php esc_html_e('Address 2', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'address_2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_2' )); ?>" value="<?php echo esc_attr($instance['address_2']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'address_link_2' )); ?>"><?php esc_html_e('Address 2 Link', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'address_link_2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_link_2' )); ?>" value="<?php echo esc_attr($instance['address_link_2']); ?>" style="width:100%;" />
			</p>
			<p >
				<label for="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>"><?php esc_html_e('Phone Number', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" value="<?php echo esc_attr($instance['phone']); ?>" style="width:100%;" />
			</p>
			<p >
				<label for="<?php echo esc_attr($this->get_field_id( 'phone_2' )); ?>"><?php esc_html_e('Phone Number 2', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'phone_2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_2' )); ?>" value="<?php echo esc_attr($instance['phone_2']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'mail' )); ?>"><?php esc_html_e('Email', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'mail' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'mail' )); ?>" value="<?php echo esc_attr($instance['mail']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'mail_2' )); ?>"><?php esc_html_e('Email 2', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'mail_2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'mail_2' )); ?>" value="<?php echo esc_attr($instance['mail_2']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'time' )); ?>"><?php esc_html_e('Time', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'time' )); ?>" value="<?php echo esc_attr($instance['time']); ?>" style="width:100%;" />
			</p>	
		<?php
		}
	}
}