<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Apr_Core_Nav_Menu extends Widget_Base
{

    protected $nav_menu_index = 1;

    public function get_name()
    {
        return 'apr-nav-menu';
    }

    public function get_title()
    {
        return __('APR Nav Menu', 'apr-core');
    }

    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    public function get_categories()
    {
        return array('apr-core');
    }

    public function get_keywords()
    {
        return ['menu', 'nav', 'button'];
    }

    public function get_script_depends()
    {
        return ['smartmenus'];
    }

    public function on_export($element)
    {
        unset($element['settings']['menu']);

        return $element;
    }

    protected function get_nav_menu_index()
    {
        return $this->nav_menu_index++;
    }

    private function get_available_menus()
    {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'apr-core'),
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label' => __('Menu', 'apr-core'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',
                    'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'apr-core'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<strong>' . __('There are no menus in your site.', 'apr-core') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'apr-core'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator' => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'layout',
            [
                'label' => __('Layout', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => __('Horizontal', 'apr-core'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'align_items',
            [
                'label' => __('Align', 'apr-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'apr-core'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'apr-core'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'apr-core'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'justify' => [
                        'title' => __('Stretch', 'apr-core'),
                        'icon' => 'eicon-h-align-stretch',
                    ],
                ],
                'prefix_class' => 'apr-nav-menu__align-',
                'condition' => [
                    'layout!' => 'dropdown',
                ],
            ]
        );

        $this->add_control(
            'pointer',
            [
                'label' => __('Pointer', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __('None', 'apr-core'),
                    'underline' => __('Underline', 'apr-core'),
                    'overline' => __('Overline', 'apr-core'),
                    'double-line' => __('Double Line', 'apr-core'),
                    'framed' => __('Framed', 'apr-core'),
                    'background' => __('Background', 'apr-core'),
                ],
                'condition' => [
                    'layout!' => 'dropdown',
                ],
            ]
        );

        $this->add_control(
            'indicator',
            [
                'label' => __('Submenu Indicator', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'classic',
                'options' => [
                    'none' => __('None', 'apr-core'),
                    'classic' => __('Classic', 'apr-core'),
                    'angle' => __('Angle', 'apr-core'),
                    'plus' => __('Plus', 'apr-core'),
                ],
                'prefix_class' => 'apr-nav-menu--indicator-',
            ]
        );

        $this->add_control(
            'heading_mobile_dropdown',
            [
                'label' => __('Mobile Dropdown', 'apr-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'layout!' => 'dropdown',
                ],
            ]
        );

        $this->add_control(
            'toggle_type',
            [
                'label' => __('Toggle Button', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'none' => __('None', 'apr-core'),
                    'default' => __('Defautl', 'apr-core'),
                    'custom' => __('Custom', 'apr-core'),
                ],
                'prefix_class' => 'toggle-menu-',
                'condition' => [
                    'layout!' => 'dropdown',
                ],
            ]
        );

        $this->add_control(
            'toggle_align',
            [
                'label' => __('Toggle Align', 'apr-core'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'right',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'apr-core'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'apr-core'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'apr-core'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto',
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-menu-toggle' => '{{VALUE}}',
                ],
                'label_block' => false,
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_style_main-menu',
            [
                'label' => __('Main Menu', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout!' => 'dropdown',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .apr-nav-menu--main .apr-nav-menu > li > a',
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
            'color_menu_item',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu--main .apr-nav-menu > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'color_menu_item_sticky',
            [
                'label' => __('Text Color Header sticky', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item' => 'color: {{VALUE}}',
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
            'color_menu_item_hover',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu--main .apr-nav-menu > li:hover > a,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.apr-item-active,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.highlighted,
					{{WRAPPER}} .apr-nav-menu--main  .apr-nav-menu > li.current-menu-parent > a,
					{{WRAPPER}} .apr-nav-menu > li.current_page_item > a,
					{{WRAPPER}} .apr-nav-menu--main  > li > a:focus' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'pointer!' => 'background',
                ],
            ]
        );
        $this->add_control(
            'color_menu_item_sticky_hover',
            [
                'label' => __('Text Color Header Sticky', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'default' => '',
                'selectors' => [
                    '.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item:hover,
					.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item.apr-item-active,
					.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item.highlighted,
					.is-sticky {{WRAPPER}} .apr-nav-menu > li.current-menu-parent > a,
					.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item:focus' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'pointer!' => 'background',
                ],
            ]
        );

        $this->add_control(
            'color_menu_item_hover_pointer_bg',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu--main .apr-item:hover,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.apr-item-active,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.highlighted,
					{{WRAPPER}} .apr-nav-menu--main .apr-nav-menu > li > a:focus,
					' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'pointer' => 'background',
                ],
            ]
        );

        $this->add_control(
            'pointer_color_menu_hover',
            [
                'label' => __('Pointer Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .apr-item:before,
					{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .apr-item:after,
					{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .apr-nav-menu > li > a:before,
					{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .apr-nav-menu > li > a:after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .e--pointer-framed .apr-item:before,
					{{WRAPPER}} .e--pointer-framed .apr-item:after,
					{{WRAPPER}} .e--pointer-framed .apr-nav-menu > li > a:before,
					{{WRAPPER}} .e--pointer-framed .apr-nav-menu > li > a:after' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'pointer!' => ['none', 'text'],
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        /* This control is required to handle with complicated conditions */
        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pointer_width',
            [
                'label' => __('Pointer Width', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'devices' => [self::RESPONSIVE_DESKTOP, self::RESPONSIVE_TABLET],
                'range' => [
                    'px' => [
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .e--pointer-framed .apr-item:before' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .e--pointer-framed.e--animation-draw .apr-item:before' => 'border-width: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .e--pointer-framed.e--animation-draw .apr-item:after' => 'border-width: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
                    '{{WRAPPER}} .e--pointer-framed.e--animation-corners .apr-item:before' => 'border-width: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .e--pointer-framed.e--animation-corners .apr-item:after' => 'border-width: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
                    '{{WRAPPER}} .e--pointer-underline .apr-item:after,
					 {{WRAPPER}} .e--pointer-overline .apr-item:before,
					 {{WRAPPER}} .e--pointer-double-line .apr-item:before,
					 {{WRAPPER}} .e--pointer-double-line .apr-item:after' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'pointer' => ['underline', 'overline', 'double-line', 'framed'],
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_padding',
            [
                'label' => __('Padding', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu--main .apr-nav-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_space_between',
            [
                'label' => __('Space Between', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .apr-nav-menu--layout-horizontal .apr-nav-menu > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .apr-nav-menu--layout-horizontal .apr-nav-menu > li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .apr-nav-menu--main:not(.apr-nav-menu--layout-horizontal) .apr-nav-menu > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius_menu_item',
            [
                'label' => __('Border Radius', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu > li > a:before' => 'border-radius: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .e--animation-shutter-in-horizontal .apr-nav-menu > li > a:before' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
                    '{{WRAPPER}} .e--animation-shutter-in-horizontal .apr-nav-menu > li > a:after' => 'border-radius: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .e--animation-shutter-in-vertical .apr-nav-menu > li > a:before' => 'border-radius: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
                    '{{WRAPPER}} .e--animation-shutter-in-vertical .apr-nav-menu > li > a:after' => 'border-radius: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'pointer' => 'background',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_dropdown',
            [
                'label' => __('Dropdown', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dropdown_description',
            [
                'raw' => __('On desktop, this will affect the submenu.', 'apr-core'),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-descriptor',
            ]
        );

        $this->start_controls_tabs('tabs_dropdown_item_style');

        $this->start_controls_tab(
            'tab_dropdown_item_normal',
            [
                'label' => __('Normal', 'apr-core'),
            ]
        );

        $this->add_control(
            'color_dropdown_item',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-menu a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_item_hover',
            [
                'label' => __('Hover & active', 'apr-core'),
            ]
        );

        $this->add_control(
            'color_dropdown_item_hover',
            [
                'label' => __('Text Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-menu li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'background_color_dropdown_item',
            [
                'label' => __('Background Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-menu' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dropdown_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'exclude' => ['line_height'],
                'selector' => '.apr-nav-menu .sub-menu a',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_border',
                'selector' => '{{WRAPPER}} .apr-nav-menu .sub-menu',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'dropdown_border_radius',
            [
                'label' => __('Border Radius', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dropdown_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}}  .apr-nav-menu .sub-menu',
            ]
        );

        $this->add_responsive_control(
            'sub_menu_padding',
            [
                'label' => __('Padding', 'apr-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_dropdown_divider',
            [
                'label' => __('Divider', 'apr-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_divider',
                'selector' => '{{WRAPPER}} .apr-nav-menu .sub-menu li:not(:first-child) > a',
                'exclude' => ['width'],
            ]
        );

        $this->add_control(
            'dropdown_divider_width',
            [
                'label' => __('Border Width', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-nav-menu .sub-menu li:not(:first-child) > a' => 'border-top-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dropdown_divider_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('style_toggle',
            [
                'label' => __('Toggle Button', 'apr-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'toggle_type' => 'custom',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'toggle_menu_gradient',
                'label'     => __( 'Background Color', 'apr-core' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}}.toggle-menu-custom .menu-icon',
            ]
        );
        $this->start_controls_tabs('tabs_toggle_style');

        $this->start_controls_tab(
            'tab_toggle_style_normal',
            [
                'label' => __('Normal', 'apr-core'),
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label' => __('Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-icon' => 'color: {{VALUE}}', // Harder selector to override text color control
                ],
            ]
        );

        $this->add_control(
            'toggle_background_color',
            [
                'label' => __('Background Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-icon:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_toggle_style_hover',
            [
                'label' => __('Hover', 'apr-core'),
            ]
        );

        $this->add_control(
            'toggle_color_hover',
            [
                'label' => __('Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.apr-menu-toggle:hover' => 'color: {{VALUE}}', // Harder selector to override text color control
                ],
            ]
        );

        $this->add_control(
            'toggle_background_color_hover',
            [
                'label' => __('Background Color', 'apr-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .apr-menu-toggle:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'toggle_size',
            [
                'label' => __('Size', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 15,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'toggle_border_width',
            [
                'label' => __('Border Width', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-menu-toggle' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_border_radius',
            [
                'label' => __('Border Radius', 'apr-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apr-menu-toggle' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $available_menus = $this->get_available_menus();

        if (!$available_menus) {
            return;
        }

        $settings = $this->get_active_settings();
        $args = [
            'echo' => false,
            'menu' => $settings['menu'],
            'menu_class' => 'apr-nav-menu',
            'fallback_cb' => '__return_empty_string',
            'container' => '',
        ];
        if ('vertical' === $settings['layout']) {
            $args['menu_class'] .= ' sm-vertical';
        }

        // Add custom filter to handle Nav Menu HTML output.
        add_filter('nav_menu_link_attributes', [$this, 'handle_link_classes'], 10, 4);
        add_filter('nav_menu_submenu_css_class', [$this, 'handle_sub_menu_classes']);
        add_filter('nav_menu_item_id', '__return_empty_string');

        // General Menu.
        $menu_html = wp_nav_menu($args);

        // Dropdown Menu.
        $args['menu_class'] = 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();

        // Remove all our custom filters.
        remove_filter('nav_menu_link_attributes', [$this, 'handle_link_classes']);
        remove_filter('nav_menu_submenu_css_class', [$this, 'handle_sub_menu_classes']);
        remove_filter('nav_menu_item_id', '__return_empty_string');

        if (empty($menu_html)) {
            return;
        }


        $this->add_render_attribute('menu-toggle', 'class', [
            'apr-menu-toggle',
        ]);

        $this->add_render_attribute('menu-toggle', [
            'class' => 'menu-icon',
        ]);

        if ('dropdown' !== $settings['layout']) :
            $this->add_render_attribute('main-menu', 'class', [
                'apr-nav-menu--main',
                'apr-nav-menu__container',
                'apr-nav-menu--layout-' . $settings['layout'],
            ]);

            if ($settings['pointer']) :
                $this->add_render_attribute('main-menu', 'class', 'e--pointer-' . $settings['pointer']);

                foreach ($settings as $key => $value) :
                    if (0 === strpos($key, 'animation') && $value) :
                        $this->add_render_attribute('main-menu', 'class', 'e--animation-' . $value);

                        break;
                    endif;
                endforeach;
            endif; ?>
            <nav <?php echo $this->get_render_attribute_string('main-menu'); ?>>
                <?php
            \Arrowit::menu_builder($settings['menu']); ?>
            </nav>
        <?php
        endif;
        if ($settings['toggle_type'] !== 'none'){
        ?>
        <div <?php echo $this->get_render_attribute_string('menu-toggle'); ?>>
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <?php }?>
        <div class="mobile-menu menu-mobile">
            <div class="menu-mobile-content">
                <div class="top-mobile">
                    <?php
                    if (has_custom_logo()){
                        the_custom_logo();
                    }else{
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"  rel="home" class="site-title"><?php echo esc_attr(get_bloginfo('name', 'display')) ?></a>
                        <?php
                    }?>
                    <div class="close-menu-mobile">
                        <div class="close-menu btn-menu"><i class="fas fa-times"></i></div>
                    </div>
                </div>
                <div class="mobile-content">
                    <nav class="apr-nav-menu--dropdown apr-nav-menu__container nav-menu-mobile">
                        <?php
                        \Arrowit::menu_builder($settings['menu']);
                        ?>

                    </nav>
                    <?php \Arrowit_Templates::get_search_box();?>
                </div>
            </div>
        </div>
        <?php
    }
    public function handle_link_classes($atts, $item, $args, $depth)
    {
        $classes = $depth ? 'elementor-sub-item' : 'apr-item';
        $is_anchor = false !== strpos($atts['href'], '#');

        if (!$is_anchor && in_array('current-menu-item', $item->classes)) {
            $classes .= ' apr-item-active';
        }

        if ($is_anchor) {
            $classes .= ' apr-item-anchor';
        }

        if (empty($atts['class'])) {
            $atts['class'] = $classes;
        } else {
            $atts['class'] .= ' ' . $classes;
        }

        return $atts;
    }

    public function handle_sub_menu_classes($classes)
    {
        $classes[] = 'apr-nav-menu--dropdown';

        return $classes;
    }

    public function render_plain_content()
    {
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Apr_Core_Nav_Menu);