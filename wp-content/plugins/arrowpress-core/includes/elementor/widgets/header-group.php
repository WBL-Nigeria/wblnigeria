<?php

namespace Elementor;
use Arrowit_Templates;if (!defined('ABSPATH'))
    exit;

class Apr_Core_Header_Group extends Widget_Base
{

    public function get_name()
    {
        return 'apr-header-group';
    }

    public function get_title()
    {
        return __('APR Header Group', 'apr-core');
    }

    public function get_icon()
    {
        return 'eicon-lock-user';
    }

    public function get_categories()
    {
        return ['apr-core'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'account_config',
            [
                'label' => __('Config', 'apr-core'),
            ]
        );
        if (is_plugin_active('yith-woocommerce-wishlist/init.php')):
            $this->add_control(
                'show_wishlist',
                [
                    'label' => __('Show wishlist', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
        endif;
        $this->add_control(
            'show_language',
            [
                'label' => __('Show language', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'show_search',
            [
                'label' => __('Show search form', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        if (apr_is_woocommerce_activated()):
            $this->add_control(
                'show_account',
                [
                    'label' => __('Show account', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'show_cart',
                [
                    'label' => __('Show cart', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
        endif;
        $this->add_control(
            'show_humburger',
            [
                'label' => __('Show Humburger', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_custom_text',
            [
                'label' => __('Show Custom Text', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'show_menu_mobile',
            [
                'label' => __('Show Toggle Menu Mobile', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'humburger_config',
            [
                'label' => __('Humburger Menu', 'apr-core'),
                'condition' => [
                    'show_humburger!' => '',
                ],
            ]
        );
        $this->add_control(
            'toggle_type',
            [
                'label' => __('Toggle Button', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'none' => __('None', 'apr-core'),
                    'default' => __('Default', 'apr-core'),
                    'custom' => __('custom', 'apr-core'),
                ],
                'prefix_class' => 'toggle-menu-',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'custom_text_config',
            [
                'label' => __('Custom Text', 'apr-core'),
                'condition' => [
                    'show_custom_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'show_custom_text_desktop',
            [
                'label' => __('Hide On Desktop', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_custom_text_tablet',
            [
                'label' => __('Hide On Tablet', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_custom_text_mobile',
            [
                'label' => __('Hide On mobile', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'custom_text',
            [
                'label' => __( 'Custom Text', 'apr-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Enter your text',
                'placeholder' => __( 'Enter your text', 'apr-core' ),
            ]
        );
        $this->add_control(
            'custom_text_link',
            [
                'label' => __( 'Custom Link', 'apr-core' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'apr-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'toggle_menu_config',
            [
                'label' => __('Toggle Menu Mobile', 'apr-core'),
                'condition' => [
                    'show_menu_mobile!' => '',
                ],
            ]
        );



        $this->add_control(
            'toggle_menu_mobile',
            [
                'label'        => __('Toggle Menu Mobile', 'apr-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'tablet',
                'options'      => [
                    'mobile' => __('Mobile (767px >)', 'apr-core'),
                    'tablet' => __('Tablet (1023px >)', 'apr-core'),
                ],
                'prefix_class' => 'header-group-toggle-mobile-',
            ]
        );

        $this->end_controls_section();
        if (is_plugin_active('yith-woocommerce-wishlist/init.php')):
            //Wishlist config
            $this->start_controls_section(
                'wishlist_config',
                [
                    'label' => __('WooCommerce Wishlist', 'apr-core'),
                    'condition' => [
                        'show_wishlist!' => '',
                    ],
                ]
            );

            $this->add_control(
                'wishlist_icon',
                [
                    'label' => __('Choose Icon', 'apr-core'),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-heart-o',
                ]
            );

            $this->add_control(
                'show_subtotal',
                [
                    'label' => __('Show Total', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );

            $this->end_controls_section();
            //End Wishlist config
         endif;
        //Search form config
        $this->start_controls_section(
            'search_config',
            [
                'label' => __('Search Form', 'apr-core'),
                'condition' => [
                    'show_search!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_skin',
            [
                'label' => __( 'Choose Icon', 'apr-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-search',
            ]
        );

        $this->add_control(
            'toggle_search_size',
            [
                'label' => __('Icon Size', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-form .btn-search i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'show_search_desktop',
            [
                'label' => __('Hide On Desktop', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_search_tablet',
            [
                'label' => __('Hide On Tablet', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_search_mobile',
            [
                'label' => __('Hide On mobile', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->end_controls_section();
        //End Search form config

        if (apr_is_woocommerce_activated()):
            //Account config
            $this->start_controls_section(
                'account_content',
                [
                    'label' => __('Account', 'apr-core'),
                    'condition' => [
                        'show_account!' => '',
                    ],
                ]
            );

            $this->add_control(
                'show_icon_account',
                [
                    'label' => __('Show Icon', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'show_submenu_indicator',
                [
                    'label' => __('Show Submenu Indicator', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );


            $this->add_control(
                'icon_account',
                [
                    'label' => __('Choose Icon', 'apr-core'),
                    'type' => Controls_Manager::ICON,
                    'default' => 'apr-icon-user3',
                    'condition' => [
                        'show_icon_account!' => '',
                    ],
                ]
            );

            $this->add_control(
                'text_account',
                [
                    'label' => __('Text', 'apr-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('My account', 'apr-core'),
                ]
            );
            $this->add_responsive_control(
                'config_account_padding',
                [
                    'label' => __('Padding', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .account' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'config_account_margin',
                [
                    'label' => __('Margin', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .account' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();
            //End account config

            //WooCommerce cart config
            $this->start_controls_section(
                'cart_content',
                [
                    'label' => __('WooCommerce Cart', 'apr-core'),
                    'condition' => [
                        'show_cart!' => '',
                    ],
                ]
            );

            $this->add_control(
                'cart_icon',
                [
                    'label' => __('Choose Icon', 'apr-core'),
                    'type' => Controls_Manager::ICON,
                    'default' => 'apr-icon-cart3',
                ]
            );

            $this->add_control(
                'title_cart',
                [
                    'label' => __('Title', 'apr-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Cart', 'apr-core'),
                ]
            );

            $this->add_control(
                'title_cart_hover',
                [
                    'label' => __('Title Hover', 'apr-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('View your shopping cart', 'apr-core'),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'show_items',
                [
                    'label' => __('Show Count Text', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'show_count',
                [
                    'label' => __('Show Count', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'cart_align',
                [
                    'label' => __('Align', 'apr-core'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'Right',
                    'options' => array(
                        'justify-content-start' => esc_html__('Left', 'apr-core'),
                        'justify-content-center' => esc_html__('Center', 'apr-core'),
                        'justify-content-end' => esc_html__('Right', 'apr-core'),
                    ),
                ]
            );

            $this->add_responsive_control(
                'config_padding_cart',
                [
                    'label' => __('Padding', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart> a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'config_cart_margin',
                [
                    'label' => __('Margin', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'border_color',
                [
                    'label'     => __( 'Border Hover', 'apr-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart > a' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'border_style',
                [
                    'label'       => __( 'Border Style', 'apr-core' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => 'none',
                    'label_block' => false,
                    'options'     => [
                        'none'   => __( 'None', 'apr-core' ),
                        'solid'  => __( 'Solid', 'apr-core' ),
                        'double' => __( 'Double', 'apr-core' ),
                        'dotted' => __( 'Dotted', 'apr-core' ),
                        'dashed' => __( 'Dashed', 'apr-core' ),
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} .site-header-cart > a' => 'border-style: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'border_size',
                [
                    'label'      => __( 'Border Width', 'apr-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'default'    => [
                        'top'    => '',
                        'bottom' => '',
                        'left'   => '',
                        'right'  => '',
                        'unit'   => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .site-header-cart > a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'border_radius',
                [
                    'label'      => __( 'Border Radius', 'apr-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .site-header-cart > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'default'    => [
                        'top'    => '',
                        'bottom' => '',
                        'left'   => '',
                        'right'  => '',
                        'unit'   => 'px',
                    ],
                ]
            );
            $this->add_control(
                'show_cart_desktop',
                [
                    'label' => __('Hide On Desktop', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'show_cart_tablet',
                [
                    'label' => __('Hide On Tablet', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'show_cart_mobile',
                [
                    'label' => __('Hide On mobile', 'apr-core'),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            $this->end_controls_section();
        endif;
        //End WooCommerce cart
        if (is_plugin_active('yith-woocommerce-wishlist/init.php')):
            //Start style wishlist
            $this->start_controls_section(
                'section_lable_style_wishlist',
                [
                    'label' => __('Wishlist Style', 'apr-core'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_wishlist' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'wishlist_style',
                [
                    'label' => __('STYLE', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'wishlist_background_color',
                [
                    'label' => __('Background Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist > a' => 'background-color: {{VALUE}};',
                    ],

                ]
            );


            $this->add_control(
                'wishlist_background_hover_color',
                [
                    'label' => __('Background Hover Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist > a:hover' => 'background-color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'padding_wishlist',
                [
                    'label' => __('Padding', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_wishlist_style',
                [
                    'label' => __('ICON', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'icon_wishlist_color',
                [
                    'label' => __('Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,

                    'selectors' => [
                        '{{WRAPPER}} .apr-header-wishlist i' => 'color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_control(
                'icon_wishlist__hover_color',
                [
                    'label' => __('Hover Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,

                    'selectors' => [
                        '{{WRAPPER}} .apr-header-wishlist:hover i' => 'color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'icon_wishlist_size',
                [
                    'label' => __('Size', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .apr-header-wishlist i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_wishlist_spacing',
                [
                    'label' => __('Spacing', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .apr-header-wishlist i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            $this->add_control(
                'count_wishlish_style',
                [
                    'label' => __('COUNT', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'count_wl_color',
                [
                    'label' => __('Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist .count' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'count_wl_background_color',
                [
                    'label' => __('Background Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist .count' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_wl_font_size',
                [
                    'label' => __('Font Size', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist .count' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'count_wl_size',
                [
                    'label' => __('Size', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist .count' => 'line-height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_wl_margin',
                [
                    'label' => __('Margin', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-wishlist .count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();
            //End style wishlist
        endif;

        $this->start_controls_section(
            'section_lable_style_Custom_text',
            [
                'label' => __('Custom Text', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_custom_text' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs('tabs_menu_item_style');

        $this->start_controls_tab(
            'tab_menu_item_normal',
            [
                'label' => __('Normal', 'apr-core'),
            ]
        );

        $this->add_control(
            'custom_text_color',
            [
                'label' => __('Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'background_color_custom_text',
            [
                'label' => __('Background Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .custom-text' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'custom_text_border',
                'selector' => '{{WRAPPER}} .custom-text',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'custom_text_border_radius',
            [
                'label' => __('Border Radius', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_menu_item_hover',
            [
                'label' => __('Hover & Active', 'apr-core'),
            ]
        );

        $this->add_control(
            'custom_text_color_hover',
            [
                'label' => __('Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'background_color_custom_text_hover',
            [
                'label' => __('Background Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .custom-text:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'custom_text_border_hover',
                'selector' => '{{WRAPPER}} .custom-text:hover',
                'separator' => 'before',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'text_padding_custom_text',
            [
                'label' => __('Padding', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_custom_text' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label' => __('Icon Space', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '.custom-text > i' => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();
        //End style Custom Text

        //Style Search Form
        $this->start_controls_section(
            'section_input_style',
            [
                'label' => __('Search Form Style', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_search!' => '',
                ],
            ]
        );

        $this->add_control(
            'style_search_icon',
            [
                'label'     => __( 'Icon Search', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );
        $this->start_controls_tabs('tabs_input_colors');

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => __('Normal', 'apr-core'),
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-form .btn-search' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label' => __('Hover', 'apr-core'),
            ]
        );

        $this->add_control(
            'input_text_color_focus',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-form .btn-search:hover,
					{{WRAPPER}} .search-form .btn-search:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
            'text_padding_search',
            [
                'label' => __('Padding', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .search-form .btn-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'config_search_margin',
            [
                'label' => __('Margin', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .search-form .btn-search' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // End Style Search Form

        //Language config
        $this->start_controls_section(
            'language_config',
            [
                'label' => __('Language Style', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_language!' => '',
                ],
            ]
        );

        $this->add_control(
            'name_lang_color',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-lang .lang-1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'lang_padding',
            [
                'label' => __('Padding', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .site-header-lang' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        if (apr_is_woocommerce_activated()):
            //Start Style Account
            $this->start_controls_section(
                'section_style_account',
                [
                    'label' => __('Account Style', 'apr-core'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_account' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'heading_title_account',
                [
                    'label' => __('TITLE', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'name_text_color',
                [
                    'label' => __('Text Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account > a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'name_text_hover_color',
                [
                    'label' => __('Text Hover Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account > a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'name_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .site-header-account > a',
                ]
            );

            $this->add_responsive_control(
                'account_align',
                [
                    'label' => __('Text Alignment', 'apr-core'),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'center',
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'apr-core'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'apr-core'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'apr-core'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'heading_icon_account',
                [
                    'label' => __('ICON', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => __('Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account > a span' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'icon_hover_color',
                [
                    'label' => __('Hover Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account > a:hover span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_account_size',
                [
                    'label' => __('Size', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account > a span' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_account_spacing',
                [
                    'label' => __('Spacing', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account > a span' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'Sub_account',
                [
                    'label' => __('Sub Account', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'sub_top_distance',
                [
                    'label' => __('Distance', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-account .sub-item' => 'margin-top: {{SIZE}}{{UNIT}} !important',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->end_controls_section();


            //Start style cart
            $this->start_controls_section(
                'section_lable_style',
                [
                    'label' => __('Cart Style', 'apr-core'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_cart' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'cart_style',
                [
                    'label' => __('STYLE', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'cart_background_color',
                [
                    'label' => __('Cart Background Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart > a' => 'background-color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_control(
                'cart_background_hover_color',
                [
                    'label' => __('Cart Background Hover Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart > a:hover' => 'background-color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'text_padding_cart',
                [
                    'label' => __('Padding', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'Sub_cart',
                [
                    'label' => __('Dropdown Cart', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'sub_cart_top_distance',
                [
                    'label' => __('Distance', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .shopping_cart' => 'margin-top: {{SIZE}}{{UNIT}} !important',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'icon_cart_style',
                [
                    'label' => __('ICON', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'icon_cart_color',
                [
                    'label' => __('Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,

                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart i' => 'color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_control(
                'icon_cart_hover_color',
                [
                    'label' => __('Hover Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,

                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart:hover i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .site-header-cart:hover .amount' => 'color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'icon_cart_size',
                [
                    'label' => __('Size', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_cart_spacing',
                [
                    'label' => __('Spacing', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'title_cart_style',
                [
                    'label' => __('TITLE', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cart_title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .site-header-cart .title',
                ]
            );

            $this->add_control(
                'cart_title_color',
                [
                    'label' => __('Title Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .title' => 'color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_control(
                'cart_title_hover_color',
                [
                    'label' => __('Title Hover Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart:hover .title' => 'color: {{VALUE}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'cart_title_spacing',
                [
                    'label' => __('Spacing', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .title' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'amount_cart_style',
                [
                    'label' => __('AMOUNT', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'show_amount!' => '',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cart_amount_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .site-header-cart .amount',
                    'condition' => [
                        'show_amount!' => '',
                    ],
                ]
            );

            $this->add_control(
                'amount_color',
                [
                    'label' => __('Amount Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .amount' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_amount!' => '',
                    ],

                ]
            );

            $this->add_responsive_control(
                'amount_spacing',
                [
                    'label' => __('Spacing', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .header-button .amount' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_amount!' => '',
                    ],
                ]
            );

            $this->add_control(
                'count_text_cart_style',
                [
                    'label' => __('COUNT TEXT', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'show_items!' => '',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cart_count_text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .site-header-cart .count-text',
                    'condition' => [
                        'show_items!' => '',
                    ],
                ]
            );

            $this->add_control(
                'count_text_color',
                [
                    'label' => __('Count Text Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count-text' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_items!' => '',
                    ],

                ]
            );

            $this->add_control(
                'countcart_style',
                [
                    'label' => __('COUNT', 'apr-core'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->add_control(
                'count_color',
                [
                    'label' => __('Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->add_control(
                'count_background_color',
                [
                    'label' => __('Background Color', 'apr-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_font_size',
                [
                    'label' => __('Font Size', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );


            $this->add_responsive_control(
                'count_size',
                [
                    'label' => __('Size', 'apr-core'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count' => 'line-height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );


            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'count_border',
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .site-header-cart .count',
                    'separator' => 'before',
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->add_control(
                'count_border_radius',
                [
                    'label' => __('Border Radius', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'count_box_shadow',
                    'selector' => '{{WRAPPER}} .site-header-cart .count',
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_padding',
                [
                    'label' => __('Padding', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_margin',
                [
                    'label' => __('Margin', 'apr-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .site-header-cart .count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_count!' => '',
                    ],
                ]
            );

            $this->end_controls_section();
        endif;
        $this->start_controls_section(
            'section_style_humburger',
            [
                'label' => __('Toggle Humburger Menu', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_humburger' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'toggle_humburger_color',
            [
                'label' => __('Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-humburger' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'toggle_humburger_size',
            [
                'label' => __('Size', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 16,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-humburger' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'toggle_humburger_padding',
            [
                'label' => __('Padding', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .btn-humburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_menu_mobile!' => '',
                ],
            ]
        );

        $this->end_controls_section();
        //End style mobile
        $this->start_controls_section(
            'section_lable_style_toggle_menu_mobile',
            [
                'label' => __('Toggle Menu Mobile', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_menu_mobile' => 'yes',
                ],
            ]
        );
		$this->add_control(
            'toggle_background_color',
            [
                'label' => __('Toggle Background Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-icon' => 'background-color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'toggle_background_hover_color',
            [
                'label' => __('Toggle Background Hover Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-icon:hover' => 'background-color: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'toggle_color',
            [
                'label' => __('Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'toggle_menu_size',
            [
                'label' => __('Size', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 14,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'toggle_menu_mobile_padding',
            [
                'label' => __('Padding', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .menu-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_menu_mobile!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'toggle_menu_mobile_margin',
            [
                'label' => __('Margin', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .menu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_menu_mobile!' => '',
                ],
            ]
        );
		$this->add_control(
			'toggle_border_color',
			[
				'label'     => __( 'Border Hover', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-icon' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'toggle_border_style',
			[
				'label'       => __( 'Border Style', 'apr-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => [
					'none'   => __( 'None', 'apr-core' ),
					'solid'  => __( 'Solid', 'apr-core' ),
					'double' => __( 'Double', 'apr-core' ),
					'dotted' => __( 'Dotted', 'apr-core' ),
					'dashed' => __( 'Dashed', 'apr-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}} .menu-icon' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'toggle_border_size',
			[
				'label'      => __( 'Border Width', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'    => '',
					'bottom' => '',
					'left'   => '',
					'right'  => '',
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .menu-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .menu-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'    => '',
					'bottom' => '',
					'left'   => '',
					'right'  => '',
					'unit'   => 'px',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();

        if (is_plugin_active('yith-woocommerce-wishlist/init.php')):
            if ($settings['show_wishlist'] == 'yes') {
                echo '<div class="site-header-wishlist">';
                $this->render_wishlist();
                echo '</div>';
            }
        endif;

        if (apr_is_woocommerce_activated()):
            if ($settings['show_account'] == 'yes') {
                echo '<div class="account">';
                $this->render_account();
                echo '</div>';
            }
            if ($settings['show_cart'] == 'yes') {
                $this->render_cart();
            }
        endif;
        if ($settings['show_search'] == 'yes') {
            $this->render_search_form();
        }

        if ($settings['show_language'] == 'yes') {
            get_template_part('templates/header/language');
        }

        if ($settings['show_humburger'] == 'yes') {
            echo "<div class=\"btn-humburger\"><i class=\"fa fa-bars\" aria-hidden=\"true\"></i></div>";
        }

        if ($settings['show_custom_text'] == 'yes') {
            $this->render_custom_text();
        }

        if ($settings['show_menu_mobile'] == 'yes') {
            echo '<div class="menu-icon bg-btn-mobile">';
            echo '<i class="fa fa-bars"></i>';
            echo '</div>';
        }
    }

    public function render_cart_class(){
        $settings = $this->get_settings();
        $classes = array( 'cart-woocommerce' );
        if ($settings['show_cart_desktop'] == 'yes'){
            $classes[] = "hidden-desktop";
        }
        if ($settings['show_cart_tablet'] == 'yes'){
            $classes[] = "hidden-tablet";
        }
        if ($settings['show_cart_tablet'] == 'yes'){
            $classes[] = "hidden-mobile";
        }

        $classes = apply_filters( 'cart_class', $classes );
        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }

    public function render_search_class(){
        $settings = $this->get_settings();
        $classes = array( 'search-form' );
        if ($settings['show_search_desktop'] == 'yes'){
            $classes[] = "hidden-desktop";
        }
        if ($settings['show_search_tablet'] == 'yes'){
            $classes[] = "hidden-tablet";
        }
        if ($settings['show_search_tablet'] == 'yes'){
            $classes[] = "hidden-mobile";
        }

        $classes = apply_filters( 'search_class', $classes );
        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }
    public function render_custom_text(){
        $settings = $this->get_settings();

        $has_custom_text = ! empty( $settings['custom_text'] );
        $target = $settings['custom_text_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['custom_text_link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        <?php
        if ($has_custom_text) :
            ?>
            <a <?php $this->render_class_custom_text();?> href="<?php echo $settings['custom_text_link']['url'];?>" <?php echo "$target $nofollow"?>>
            <?php
            echo $settings['custom_text'].'<i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i> ';
            echo '</a>';
        endif;
    }
    public function render_class_custom_text(){
        $settings = $this->get_settings();
        $classes = array( 'custom-text' );
        if ($settings['show_custom_text_desktop'] == 'yes'){
            $classes[] = "hidden-desktop";
        }
        if ($settings['show_custom_text_tablet'] == 'yes'){
            $classes[] = "hidden-tablet";
        }
        if ($settings['show_custom_text_tablet'] == 'yes'){
            $classes[] = "hidden-mobile";
        }

        $classes = apply_filters( 'custom_text_class', $classes );
        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }
    protected function render_wishlist()
    {
        $settings = $this->get_settings();

        $items = '';

        if (function_exists('yith_wcwl_count_all_products')) {
            $items = '<div class="site-header-wishlist">';
            $items .= '<a class="apr-header-wishlist header-button" title="' . esc_attr__('View wishlist ', 'apr-core') . '" href="' . esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))) . '">';
            $items .= '<i class="' . $settings['wishlist_icon'] . '" aria-hidden="true"></i>';
            if ($settings['show_subtotal']) {
                $items .= '<span class="count">' . esc_html(yith_wcwl_count_all_products()) . '</span>';
            }
            $items .= '</a>';
            $items .= '</div>';
        }
        echo($items);

    }

    protected function render_search_form()
    {
        $settings = $this->get_settings();
        ?>
        <div <?php $this->render_search_class();?>>
            <div class="btn-search toggle-search">
                <i class="<?php echo $settings['icon_skin']; ?>" aria-hidden="true"></i>
            </div>
        </div>
        <?php
    }

    protected function render_cart()
    {
        $settings = $this->get_settings(); ?>

        <div <?php $this->render_cart_class();?>>
            <div class="site-header-cart menu d-flex <?php echo esc_attr($settings['cart_align']); ?>">
                <a data-toggle="toggle" class="cart-contents header-button d-flex align-items-center"
                   href="#" title="">
                    <i class="<?php echo esc_attr($settings['cart_icon']); ?>" aria-hidden="true"></i>
                    <span class="title"><?php echo esc_html($settings['title_cart']); ?></span>
                        <?php if ($settings['show_count']): ?>
                            <span class="count d-inline-block text-center">
                                <?php echo is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '';; ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($settings['show_items']): ?>
                            <span class="count-text"><?php echo wp_kses_data(_n("item", "items", is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '', "apr-core")); ?></span>
                        <?php endif; ?>
                </a>
                <ul class="shopping_cart sub-cart">
                    <li><?php the_widget('WC_Widget_Cart', 'title='); ?></li>
                </ul>
            </div>
        </div>
        <?php
    }

    protected function render_account()
    {
        $settings = $this->get_settings();
        if (apr_is_woocommerce_activated()) {
            $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
        } else {
            $account_link = wp_login_url();
        }
        $logout_url = wp_logout_url(get_permalink('woocommerce_myaccount_page_id'));
        ?>
        <div class="site-header-account">
            <?php

            if (!is_user_logged_in() & !is_account_page()){
                echo '<a href="#account-popup" data-fancybox>';
            }else{
                echo '<a href="' . esc_html($account_link) . '">';
            }

            if ($settings['show_icon_account'] == 'yes') {
                echo '<span class="' . esc_attr($settings['icon_account']) . '"></span>';
            }
            if ($settings['text_account']){
            echo "<p>".$settings['text_account']."</p>";
            }
            if ($settings['show_submenu_indicator']) {
                echo '<i class="fa fa-angle-down submenu-indicator" aria-hidden="true"></i>';
            }
            echo '</a>';
            ?>
            <?php if (is_user_logged_in()):?>
                <ul class="sub-item">
                    <li><a href="<?php echo esc_html($account_link);?>"><?php echo esc_html__('My Account', 'apr-core') ?></a></li>
                    <li><a href="<?php echo esc_html($logout_url);?>"><?php echo esc_html__('Logout', 'apr-core') ?></a></li>
                </ul>
            <?php endif;?>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Apr_Core_Header_Group);

if (!function_exists('apr_is_woocommerce_activated')) {
    /**
     * Query WooCommerce activation
     */
    function apr_is_woocommerce_activated()
    {
        return class_exists('WooCommerce') ? true : false;
    }
}