<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;
if(class_exists('WooCommerce')){
    class Apr_Core_Products extends Widget_Base {

        public function get_categories() {
            return array( 'apr-core' );
        }

        public function get_name() {
            return 'apr_products';
        }

        public function get_title() {
            return __( 'APR Products', 'apr-core' );
        }

        public function get_icon() {
            return 'eicon-woocommerce';
        }

        protected function _register_controls() {

            $this->start_controls_section(
                'product_section',
                [
                    'label' =>  __( 'APR Products', 'apr-core' )
                ]
            );

            $this->add_control(
                'product_type',
                array(
                    'label'   => __( 'Product Type', 'apr-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => array(
                        '1'      => __( 'Grid', 'apr-core' ),
                        '2'      => __( 'List', 'apr-core' ),
                        '3'      => __( 'Grid Slide', 'apr-core' ),
                    ),
                    'default'   => '1',
                )
            );
            $this->add_control(
                'product_column_number',
                [
                    'label'     =>  __( 'Column', 'apr-core' ),
                    'type'      =>  Controls_Manager::SELECT,
                    'default'   =>  4,
                    'options'   =>  [
                        5   =>  __( '5 Column', 'apr-core' ),
                        4   =>  __( '4 Column', 'apr-core' ),
                        3   =>  __( '3 Column', 'apr-core' ),
                        2   =>  __( '2 Column', 'apr-core' ),
                    ],
                    'condition' => [
                        'product_type' => ['1'],
                    ],
                ]
            );

            $this->add_control(
                'product_cat',
                [
                    'label'         =>  __( 'Product Categories', 'apr-core' ),
                    'type'          =>  Controls_Manager::SELECT2,
                    'options'       =>  apr_core_check_get_cat( 'product_cat' ),
                    'multiple'      =>  true,
                    'label_block'   =>  true
                ]
            );

            $this->add_control(
                'product_limit',
                [
                    'label'     =>  __( 'Number of Products', 'apr-core' ),
                    'type'      =>  Controls_Manager::NUMBER,
                    'default'   =>  6,
                    'min'       =>  1,
                    'max'       =>  100,
                    'step'      =>  1,
                ]
            );

            $this->add_control(
                'filter_by',
                [
                    'label' => __( 'Filter By', 'apr-core' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'recent_products',
                    'options' => [
                        'featured_products' => __( 'Featured', 'apr-core' ),
                        'sale_products' => __( 'Sale', 'apr-core' ),
                        'recent_products' => __( 'Recent', 'apr-core' ),
                        'top_rated_products' => __( 'Top Rate', 'apr-core' ),
                        'best_selling_products' => __( 'Best Selling', 'apr-core' ),
                    ],
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => __( 'Order By', 'apr-core' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [
                        'date' => __( 'Date', 'apr-core' ),
                        'title' => __( 'Title', 'apr-core' ),
                        'price' => __( 'Price', 'apr-core' ),
                        'popularity' => __( 'Popularity', 'apr-core' ),
                        'rating' => __( 'Rating', 'apr-core' ),
                        'rand' => __( 'Random', 'apr-core' ),
                        'menu_order' => __( 'Menu Order', 'apr-core' ),
                    ],
                ]
            );

            $this->add_control(
                'order',
                [
                    'label'     =>  __( 'Order', 'apr-core' ),
                    'type'      =>  Controls_Manager::SELECT,
                    'default'   =>  'ASC',
                    'options'   =>  [
                        'ASC'   =>  __( 'Ascending', 'apr-core' ),
                        'DESC'  =>  __( 'Descending', 'apr-core' ),
                    ],
                ]
            );
            $this->add_control(
                'show_custom_image',
                [
                    'label'     =>  __( 'Show Custom Image Size', 'apr-core' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'label_on'  => __( 'On', 'apr-core' ),
                    'label_off' => __( 'Off', 'apr-core' ),
                    'default'   => 'Off',
                    'condition' => [
                        'product_type' => ['1' , '2'],
                    ],
                ]
            );
            $this->add_control(
                'custom_dimension',
                [
                    'label' => __( 'Image Size', 'apr-core' ),
                    'type' => Controls_Manager::IMAGE_DIMENSIONS,
                    'description' => __( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'apr-core' ),
                    'condition' => [
                        'show_custom_image' => 'yes',
                        'product_type' => ['1' , '2'],
                    ],
                ]
            );
            $this->end_controls_section();

            $this->start_controls_section(
                'section_slider_options',
                [
                    'label' => __( 'Slider Options', 'apr-core' ),
                    'type' => Controls_Manager::SECTION,
                    'condition' => [
                        'product_type' => ['3'],
                    ],
                ]
            );
            $this->add_control(
                'slidestoshow',
                [
                    'label' => __( 'Slides To Show', 'apr-core' ),
                    'description' => __( 'Set how many item for screen < 1200px.', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '4',
                ]
            );
            $this->add_control(
                'slidestoscroll',
                [
                    'label' => __( 'Slides To Scroll', 'apr-core' ),
                    'description' => __( 'Set how many item for screen < 1200px.', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '2',
                ]
            );
            $this->add_control(
                'slidestoshow_desktop',
                [
                    'label' => __( 'Desktop 1199 - 992', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '4',
                ]
            );
            $this->add_control(
                'slidestoshow_tablet',
                [
                    'label' => __( 'Tablet Lanscape', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '3',
                ]
            );
            $this->add_control(
                'slidestoshow_tablet_ver',
                [
                    'label' => __( 'Tablet Portrait', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '2',
                ]
            );
            $this->add_control(
                'slidestoshow_small_tablet',
                [
                    'label' => __( 'Small Tablet', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '2',
                ]
            );
            $this->add_control(
                'slidestoshow_mobile',
                [
                    'label' => __( 'Mobile', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '1',
                ]
            );
            $this->add_control(
                'slidestoshow_mobile_mini',
                [
                    'label' => __( 'Mobile mini 420 - 320', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '1',
                ]
            );
            $this->add_control(
                'slidesrow',
                [
                    'label' => __( 'Row', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '1',
                ]
            );
            $this->add_control(
                'navigation',
                [
                    'label' => __( 'Navigation', 'apr-core' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'arrows',
                    'options' => [
                        'both' => __('Arrows and Dots', 'apr-core' ),
                        'arrows' => __('Arrows', 'apr-core' ),
                        'dots' => __('Dots', 'apr-core' ),
                        'none' => __('None', 'apr-core' ),
                    ],
                ]
            );
			$this->add_control(
				'navigation_type',
				[
					'label' => __( 'Navigation Type', 'apr-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'type-2',
					'options' => [
						'type-1' => __( 'Type 1', 'apr-core' ),
						'type-2' => __( 'Type 2', 'apr-core' ),
						'type-3' => __( 'Type 3', 'apr-core' ),
						'type-4' => __( 'Type 4', 'apr-core' ),
						'type-5' => __( 'Type 5', 'apr-core' )
					],
					'condition' => [
						'navigation' => [ 'arrows', 'both' ],
					],
				]
			);
			$this->add_control(
				'arrows_position',
				[
					'label' => __( 'Position', 'apr-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'slick-arrows-bottom',
					'options' => [
						'slick-arrows-top' => __( 'Top', 'apr-core' ),
						'slick-arrows-center' => __( 'Center', 'apr-core' ),
						'slick-arrows-bottom' => __( 'Bottom', 'apr-core' ),
						'slick-arrows-right' => __( 'Right', 'apr-core' ),
					],
					'condition' => [
						'navigation' => [ 'arrows', 'both' ],
					],
				]
			);
            $this->add_control(
                'transition_speed',
                [
                    'label' => __( 'Transition Speed (ms)', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 500,
                ]
            );
            $this->add_control(
                'content_animation',
                [
                    'label' => __( 'Content Animation', 'apr-core' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'fadeInUp',
                    'options' => [
                        '' => __( 'None', 'apr-core' ),
                        'fadeInDown' => __( 'Down', 'apr-core' ),
                        'fadeInUp' => __( 'Up', 'apr-core' ),
                        'fadeInRight' => __( 'Right', 'apr-core' ),
                        'fadeInLeft' => __( 'Left', 'apr-core' ),
                        'zoomIn' => __( 'Zoom', 'apr-core' ),
                    ],
                ]
            );
            $this->add_control(
                'autoplay_speed',
                [
                    'label' => __( 'Autoplay Speed', 'apr-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5000,
                    'condition' => [
                        'autoplay' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                    ],
                ]
            );
            $this->add_control(
                'autoplay',
                [
                    'label' => __( 'Autoplay', 'apr-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                ]
            );
            $this->add_control(
                'infinite',
                [
                    'label' => __( 'Infinite Loop', 'apr-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'pause_on_hover',
                [
                    'label' => __( 'Pause on Hover', 'apr-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );
            $this->end_controls_section();
        }

        protected function render() {
            global $woocommerce_loop;
            $settings       =   $this->get_settings_for_display();
            $product_type   =   $settings['product_type'];
            $shortcodes     =   $settings['filter_by'];
            if($product_type == '1'){
                $columns    =   $settings['product_column_number'];
            }else{
                $columns = 1;
            }
            $cat_slug       =   $settings['product_cat'];
            $limit_post     =   $settings['product_limit'];
            $orderby  =   $settings['orderby'];
            $order     =   $settings['order'];
            $show_custom_image    =   $settings['show_custom_image'];
            $custom_dimension    =   $settings['custom_dimension'];
            $woocommerce_loop['custom_dimension'] = $custom_dimension;
            $woocommerce_loop['show_custom_image'] = $show_custom_image;
            $woocommerce_loop['product_column_number'] = $columns;
            $woocommerce_loop['product_type'] = $product_type;

            $product_class = '';
            if($product_type == '2'){
				$product_class = 'product-list list-1';
            }elseif($product_type == '1'){
                $product_class = 'product-grid';
            }else{
                $product_class = 'product-slide';
            }

            if(!empty( $cat_slug)){
                $cat = implode(",", $cat_slug);
            }else{
                $cat = '';
            }

            $id =  'apr_product_'.wp_rand();

            $is_rtl = is_rtl();
            $direction = $is_rtl ? 'true' : 'false';
            $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
            $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
			$navigation_type = $settings['navigation_type'];
			$arrows_position = $settings['arrows_position'];
            $show_arr = 'false';
            $show_dot = 'false';
            if($settings['navigation'] == 'both'){
                $show_arr = 'true';
                $show_dot = 'true';
            }elseif($settings['navigation'] == 'arrows'){
                $show_arr = 'true';
            }elseif($settings['navigation'] == 'dots'){
                $show_dot = 'true';
            }
            if($settings['infinite'] == 'yes'){
                $infinite = 'true';
            }else{
                $infinite = 'false';
            }
            if($settings['autoplay'] == 'yes'){
                $autoplay = 'true';
            }else{
                $autoplay = 'false';
            }
            if($settings['pause_on_hover'] == 'yes'){
                $pauseonhover = 'true';
            }else{
                $pauseonhover = 'false';
            }
            ?>
            <div id="<?php echo esc_attr($id); ?>" class="apr-product <?php echo esc_attr($navigation_type); ?> <?php echo esc_attr($arrows_position); ?> <?php echo esc_attr($product_class); ?>">
                <?php
                echo do_shortcode('['.$shortcodes.' category="'.$cat.'"  per_page="'.$limit_post.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
                ?>
            </div>
            <?php if($product_type == '3') : ?>
                <script>
                    jQuery(document).ready(function($) {
                        var viewportWidth = $(window).width();
                        if( viewportWidth > 768 ){
                            var Rows = <?php echo absint( $settings['slidesrow'] );?>;
                        } else {
                            var Rows = 1;
                        }
                        $('#<?php echo esc_js($id);?> .products').slick({
                            slidesToShow: <?php echo absint( $settings['slidestoshow'] );?>,
                            slidesToScroll: <?php echo absint( $settings['slidestoscroll'] );?>,
                            rows: Rows,
                            dots: <?php echo esc_attr($show_dot);?>,
                            arrows: <?php echo esc_attr($show_arr);?>,
                            nextArrow: '<button class="slick-next"><i class="theme-icon-right-arrow2"></i></button>',
							prevArrow: '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
                            speed : <?php echo absint( $settings['transition_speed'] );?>,
                            infinite: <?php echo esc_attr($infinite);?>,
                            autoplay: <?php echo esc_attr($autoplay);?>,
                            autoplaySpeed: <?php echo absint( $settings['autoplay_speed'] );?>,
                            rtl: <?php echo esc_attr($direction);?>,
                            pauseOnHover: <?php echo esc_attr($pauseonhover);?>,
                            responsive: [
                                {
                                    breakpoint: 1200,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slidestoshow'] );?>
                                    }
                                },
                                {
                                    breakpoint: 1199,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slidestoshow_desktop'] );?>
                                    }
                                },
                                {
                                    breakpoint: 992,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slidestoshow_tablet'] );?>,
                                        slidesToScroll: 1,
                                    }
                                },
                                {
                                    breakpoint: 768,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slidestoshow_tablet_ver'] );?>,
                                        slidesToScroll: 1,
                                    }
                                },
                                {
                                    breakpoint: 635,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slidestoshow_small_tablet'] );?>,
                                        slidesToScroll: 1,
                                    }
                                },
                                {
                                    breakpoint: 481,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slidestoshow_mobile'] );?>,
                                        slidesToScroll: 1,
                                    }
                                },
                                {
                                    breakpoint: 421,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slidestoshow_mobile_mini'] );?>,
                                        slidesToScroll: 1,
                                    }
                                },
                            ]
                        });
                    });
                </script>
            <?php endif; ?>

            <?php

        }

        protected function content_template() {}

    }

    Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Products );
}