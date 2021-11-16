<?php
namespace Elementor;
if (!defined('ABSPATH')) exit;
if (class_exists('WooCommerce')) {
    class Apr_Core_Woo_categories extends Widget_Base
    {
        public function get_name()
        {
            return 'apr_woo_categories';
        }

        public function get_title()
        {
            return __('APR Woo - Categories', 'apr-core');
        }

        public function get_icon()
        {
            return 'eicon-woocommerce';
        }

        public function get_categories()
        {
            return array('apr-core');
        }

        protected function _register_controls()
        {
            $this->start_controls_section(
                'woo_categories_section',
                array(
                    'label' => __('Content', 'apr-core'),
                )
            );
            $this->add_control(
                'cate_type',
                [
                    'label'   => __( 'Categories Type', 'apr-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => array(
                        '1'      => __( 'Type 1', 'apr-core' ),
                        '2'      => __( 'Type 2', 'apr-core' ),
                    ),
                    'default'   => '1',
                ]
            );
            $this->add_responsive_control(
                'cate_image',
                array(
                    'label' => __('Image', 'apr-core'),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => array(
                        'active' => true,
                    ),
                    'default' => array(
                        'url' => Utils::get_placeholder_image_src(),
                    )
                )
            );
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'cate_image',
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );
            $this->add_control(
                'category_filter',
                [
                    'label' => __('Category Filter', 'apr-core'),
                    'type' => Controls_Manager::SELECT,
                    'multiple' => true,
                    'default' => '',
                    'options'       =>  apr_core_check_get_cat( 'product_cat' ),

                ]
            );
            $this->add_control(
                'cate_alignment',
                [
                    'label'     => __( 'Alignment', 'apr-core' ),
                    'type'      => Controls_Manager::CHOOSE,
                    'default'   => 'left',
                    'options'   => [
                        'left'  => [
                            'title'     => __( 'Left', 'apr-core' ),
                            'icon'      => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title'     => __( 'Center', 'apr-core' ),
                            'icon'      => 'fa fa-align-center',
                        ],
                        'right'  => [
                            'title'     => __( 'Right', 'apr-core' ),
                            'icon'      => 'fa fa-align-right',
                        ],
                    ],
                    'label_block'       => false,
                    'style_transfer'    => true,
                    'selectors' => [
                        '{{WRAPPER}} .cate-content .name-cate h3' => 'text-align: {{VALUE}}',

                    ],
                ]
            );
            $this->add_control(
                'position',
                [
                    'label'     => __( 'Position', 'apr-core' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'top_left',
                    'options'   => [
                        'top_left' => _x( 'Top Left',  'apr-core' ),
                        'top_center' => _x( 'Top center',  'apr-core' ),
                        'top_right' => _x( 'Top right', 'apr-core' ),
                        'center_left' => _x( 'Center left', 'apr-core' ),
                        'center_center' => _x( 'Center center', 'apr-core' ),
                        'center_right' => _x( 'Center right', 'apr-core' ),
                        'bottom_left' => _x( 'Bottom Left', 'apr-core' ),
                        'bottom_center' => _x( 'Bottom Center', 'apr-core' ),
                        'bottom_right' => _x( 'Bottom Right', 'apr-core' ),
                        'custom' => _x( 'Custom', 'apr-core' ),
                    ],
                    'condition' => [
                        'cate_type' => '1'
                    ],
                ]
            );
             $this->add_control(
                'x_position',
                [
                    'label'     => __( 'X Position', 'apr-core' ),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woo-product-category .cate-content .name-cate' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'position' => 'custom'
                    ],
                ]
            );
            $this->add_control(
                'y_position',
                [
                    'label'     => __( 'Y Position', 'apr-core' ),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .woo-product-category .cate-content .name-cate' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'position' => 'custom'
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'section_style_content',
                [
                    'label' => __('Content', 'apr-core'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_control(
                'text_above_color',
                [
                    'label' => __('Text Above Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .woo-product-category .cate-content .name-cate h3 a.woo-cate-title' => 'color: {{VALUE}}',

                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_above_typo',
                    'label' => __('Text Above Typography', 'apr-core'),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .woo-product-category .cate-content .name-cate h3 a.woo-cate-title',
                ]
            );
            $this->add_control(
                'text_below_color',
                [
                    'label' => __('Text Below Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .woo-product-category .cate-content .name-cate h3 a.woo-cate-title span' => 'color: {{VALUE}}',

                    ],
                ]
            );
            $this->add_control(
                'text_below_border_color',
                [
                    'label' => __('Text Below Border Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .woo-product-category .cate-content .name-cate h3 a.woo-cate-title span:before' => 'background-color: {{VALUE}}',

                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_below_typo',
                    'label' => __('Text Below Typography', 'apr-core'),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .woo-product-category .cate-content .name-cate h3 a.woo-cate-title span',
                ]
            );
            $this->add_responsive_control(
                'apr_text_below_padding',
                [
                    'label' => esc_html__( 'Padding', 'apr-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                            '{{WRAPPER}} .woo-product-category .cate-content .name-cate h3 a.woo-cate-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();
            $cate_type = $settings['cate_type'];
            $category = $settings['category_filter'];
            $cate_alignment = $settings['cate_alignment'];
            $position = $settings['position'];
            $align= $class_position= '';
            if ($cate_alignment === 'left') {
                $align = 'al-left';
            }elseif ($cate_alignment === 'right') {
                $align = 'al-right';
            }else{
                $align = 'al-center';
            }
            if ($position === 'top_left') {
                $class_position = 'top_left';
            }elseif ($position === 'top_right') {
                $class_position = 'top_right';
            }elseif ($position === 'top_center') {
                $class_position = 'top_center';
            }elseif ($position === 'center_left') {
                $class_position = 'center_left';
            }elseif ($position === 'center_center') {
                $class_position = 'center_center';
            }elseif ($position === 'center_right') {
                $class_position = 'center_right';
            }elseif ($position === 'bottom_left') {
                $class_position = 'bottom_left';
            }elseif ($position === 'bottom_center') {
                $class_position = 'bottom_center';
            }elseif ($position === 'bottom_right') {
                $class_position = 'bottom_right';
            }else{
                $class_position = 'custom';
            }

            if ($category !== ''){
                $term = get_term_by('slug', $category, 'product_cat');
            }
            $cate_thumb_url = Group_Control_Image_Size::get_attachment_image_html($settings, 'cate_image', 'cate_image');

            if ($cate_type == '1'){
            ?>
            <div class="woo-product-category ">
                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'cate_image', 'cate_image'); ?>
                <?php
                if ($category !== ''){
                    ?>
                    <div class="cate-content <?php echo esc_attr($align); ?> <?php echo esc_attr($class_position); ?>">
                        <div class="name-cate">
                            <h3>
                                <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?>" class="woo-cate-title">
                                    <?php
                                        $arr = explode(' ',trim($term->name));
                                        echo $arr[0];
                                    ?>
                                    <?php
                                    if (str_word_count($term->name) >= '2') {
                                    ?>
                                    <span>
                                       <?php
                                            $str = $term->name;
                                            $str = ltrim($str, $arr[0]);
                                            echo $str;
                                        ?> 
                                    </span>
                                    <?php } ?>
                                </a>
                            </h3>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            }else{
                ?>
                <div class="woo-list-category">
                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?>" class="list-cate-title">
                        <?php echo $term->name; ?>
                    </a>
                <?php if (!empty($cate_thumb_url)){?>
                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?>" class="cate-thumb">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'cate_image', 'cate_image'); ?>
                    </a>
                <?php }
                $children = get_terms( $term->taxonomy, array(
                    'parent'    => $term->term_id,
                    'hide_empty' => false
                ) );
                if ( $children ) {
                    echo '<ul class="children-cate">';
                    foreach( $children as $subcat )
                    {
                        $term_meta = get_term_meta( $subcat->term_id, 'product_cat_label', true );
                        $term_meta_color = get_term_meta( $subcat->term_id, 'categories_label_color', true );
                        ?>
                        <li>
                            <a href="<?php echo esc_url(get_term_link($subcat, $subcat->taxonomy));?>"><?php echo $subcat->name;?>
                                <?php if ($term_meta !== ''){
                                ?>
                                <span class="label-new" <?php if ($term_meta_color !=='') echo 'style ='."background:$term_meta_color" ;?>>
                                    <?php
                                    echo $term_meta;
                                    echo '</span>';
                                    }?>
                            </a>
                        </li>
                        <?php
                    }
                    echo '</ul>';
                }
                ?>
                </div>
                <?php
            }
        }
        protected function content_template() {}
    }

    Plugin::instance()->widgets_manager->register_widget_type(new Apr_Core_Woo_categories);
}