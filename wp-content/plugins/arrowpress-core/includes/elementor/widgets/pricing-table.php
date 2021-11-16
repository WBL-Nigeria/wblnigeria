<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Apr_Core_Pricing_Table extends Widget_Base {

    public function get_categories() {
        return array( 'apr-core' );
    }

    public function get_name() {
        return 'apr-pricing-table';
    }

    public function get_title() {
        return __( ' APR Pricing Table', 'apr-core' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'type_section',
            [
                'label' =>  __( 'APR Pricing Type', 'apr-core' )
            ]
        );
        $this->add_control(
            'pricing_type',
            [
                'label'     =>  __( 'Pricing Type', 'apr-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'type1',
                'options'   =>  [
                    'type1'   =>  __( 'Pricing Type 1', 'apr-core' ),
                    'type2'   =>  __( 'Pricing Type 2', 'apr-core' ),
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_icon',
            [
                'label'     => __( 'Icon', 'apr-core' ),
            ]
        );
        $this->add_control(
            'icon',
            [
                'label'     => __( 'Icon', 'apr-core' ),
                'type'      => Controls_Manager::ICON,
                'default'   => '',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_header',
            [
                'label' 	=> __( 'Header', 'apr-core' ),
            ]
        );
        $this->add_control(
            'heading',
            [
                'label' 	=> __( 'Title', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> __( 'I am title', 'apr-core' ),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' 	=> __( 'Subtitle', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> '',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_pricing',
            [
                'label' 	=> __( 'Pricing', 'apr-core' ),
            ]
        );

        $this->add_control(
            'currency_symbol',
            [
                'label' 	=> __( 'Custom Currency Symbol', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'yes'  => __( 'On', 'apr-core' ),
                'no' => __( 'Off', 'apr-core' ),
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'currency_symbol_custom',
            [
                'label' 	=> __( 'Custom Symbol', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'condition' => [
                    'currency_symbol' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' 	=> __( 'Price', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> '39.99',
                'description' => __( 'Prices are displayed on the frontend. Ex: 39.00, 39...', 'apr-core' ),
            ]
        );

        $this->add_control(
            'sale',
            [
                'label' 	=> __( 'Sale', 'apr-core' ),
                'type' 		=> Controls_Manager::SWITCHER,
                'label_on' 	=> __( 'On', 'apr-core' ),
                'label_off' => __( 'Off', 'apr-core' ),
                'default' 	=> '',
            ]
        );

        $this->add_control(
            'original_price',
            [
                'label' 	=> __( 'Original Price', 'apr-core' ),
                'type' 		=> Controls_Manager::NUMBER,
                'default' 	=> '59',
                'condition' => [
                    'sale' 		=> 'yes',
                ],
            ]
        );

        $this->add_control(
            'period',
            [
                'label' 	=> __( 'Period', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> __( 'Monthly', 'apr-core' ),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_features',
            [
                'label' 	=> __( 'Features', 'apr-core' ),
            ]
        );

        $this->add_control(
            'desc_pricing',
            [
                'label'     => __( 'Description', 'apr-core' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => '',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' 	=> __( 'Text', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> __( 'List Item', 'apr-core' ),
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' 	=> __( 'Icon', 'apr-core' ),
                'type' 		=> Controls_Manager::ICON,
                'default' 	=> '',
            ]
        );

        $repeater->add_control(
            'item_icon_color',
            [
                'label' 	=> __( 'Icon Color', 'apr-core' ),
                'type' 		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'item_text_color',
            [
                'label' 	=> __( 'Text Color', 'apr-core' ),
                'type' 		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-price-table__feature-inner span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'class_item',
            [
                'label' 	=> __( 'Class', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> 'special',
            ]
        );
        $this->add_control(
            'features_list',
            [
                'type' 		=> Controls_Manager::REPEATER,
                'fields' 	=> $repeater->get_controls(),
                'default' 	=> [
                    [
                        'item_text' => __( 'List Item #1', 'apr-core' ),
                        'item_icon' => '',
                    ],
                    [
                        'item_text' => __( 'List Item #2', 'apr-core' ),
                        'item_icon' => '',
                    ],
                    [
                        'item_text' => __( 'List Item #3', 'apr-core' ),
                        'item_icon' => '',
                    ],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer',
            [
                'label' 	=> __( 'Footer', 'apr-core' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' 	=> __( 'Button Text', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> __( 'Click Here', 'apr-core' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' 	=> __( 'Link', 'apr-core' ),
                'type' 		=> Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'apr-core' ),
                'default' 	=> [
                    'url' 		=> '#',
                ],
            ]
        );

        $this->end_controls_section();

         $this->start_controls_section(
            'section_pricing_apr',
            [
                'label'     => __( 'Backgroung Image Pricing', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );
         $this->add_control(
            'background_image_pricing',
            [
                'label' => _x( 'Background Image', 'Background Control', 'apr-core' ),
                'type' => Controls_Manager::MEDIA,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table-top' => 'background-image: url({{URL}})',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_icon_style',
            [
                'label'     => __( 'Icon', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Font Size', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __( 'Icon Hover Color ', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'     => __( 'Padding', 'apr-core' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_header_style',
            [
                'label' 	=> __( 'Header', 'apr-core' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' 	=> __( 'Padding', 'apr-core' ),
                'type' 		=> Controls_Manager::DIMENSIONS,
                'size_units'=> [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_heading_style',
            [
                'label' => __( 'Title', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color_hover',
            [
                'label' => __( 'Hover Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-price-table__header .elementor-price-table__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__heading',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'heading_sub_heading_style',
            [
                'label' => __( 'Sub Title', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__subheading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__subheading',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_element_style',
            [
                'label' => __( 'Pricing', 'apr-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'pricing_element_bg_color',
            [
                'label' => __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_element_padding',
            [
                'label' => __( 'Padding', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency, {{WRAPPER}} .elementor-price-table__integer-part, {{WRAPPER}} .elementor-price-table__fractional-part' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency, {{WRAPPER}} .elementor-price-table__integer-part, {{WRAPPER}} .elementor-price-table__fractional-part' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
            ]
        );

        $this->add_control(
            'heading_currency_style',
            [
                'label' => __( 'Currency Symbol', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'currency_size',
            [
                'label' => __( 'Size', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'font-size: {{SIZE}}px',
                ],
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'currency_vertical_position',
            [
                'label' => __( 'Vertical Position', 'apr-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'apr-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'apr-core' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'apr-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'align-self: {{VALUE}}',
                ],
                'condition' => [
                    'currency_symbol!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_original_price_style',
            [
                'label' => __( 'Original Price', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'original_price_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__original-price' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'original_price_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__original-price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'original_price_vertical_position',
            [
                'label' => __( 'Vertical Position', 'apr-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'apr-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'apr-core' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'apr-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'default' => 'bottom',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__original-price' => 'align-self: {{VALUE}}',
                ],
                'condition' => [
                    'sale' => 'yes',
                    'original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_period_style',
            [
                'label' => __( 'Period', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__period' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__period',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->add_control(
            'period_position',
            [
                'label' => __( 'Position', 'apr-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'below' => 'Below',
                    'beside' => 'Beside',
                ],
                'default' => 'below',
                'condition' => [
                    'period!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features_list_style',
            [
                'label' => __( 'Features', 'apr-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'features_list_bg_color',
            [
                'label' => __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'background-color: {{VALUE}}',

                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_padding',
            [
                'label' => __( 'Padding', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-price-table.type2 .elementor-price-table__features-list li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'special_features_list_color',
            [
                'label' => __( 'Color Special Feature Item', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li.special' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__features-list li',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'features_list_alignment',
            [
                'label' => __( 'Alignment', 'apr-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'apr-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'apr-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'apr-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label' => __( 'Width', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 25,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__feature-inner' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
                ],
            ]
        );

        $this->add_control(
            'list_divider',
            [
                'label' => __( 'Divider', 'apr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => __( 'Style', 'apr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'apr-core' ),
                    'double' => __( 'Double', 'apr-core' ),
                    'dotted' => __( 'Dotted', 'apr-core' ),
                    'dashed' => __( 'Dashed', 'apr-core' ),
                ],
                'default' => 'solid',
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li:before' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ddd',
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li:before' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_weight',
            [
                'label' => __( 'Weight', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_width',
            [
                'label' => __( 'Width', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li:before' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
                ],
            ]
        );

        $this->add_control(
            'divider_gap',
            [
                'label' => __( 'Gap', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'list_divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list li:before' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer_style',
            [
                'label' => __( 'Footer', 'apr-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'footer_bg_color',
            [
                'label' => __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'footer_padding',
            [
                'label' => __( 'Padding', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_footer_button',
            [
                'label' => __( 'Button', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __( 'Size', 'apr-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => __( 'Extra Small', 'apr-core' ),
                    'sm' => __( 'Small', 'apr-core' ),
                    'md' => __( 'Medium', 'apr-core' ),
                    'lg' => __( 'Large', 'apr-core' ),
                    'xl' => __( 'Extra Large', 'apr-core' ),
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'apr-core' ),
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button ' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button ' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'button_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
                'condition' => [
                    'button_text!' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text_padding',
            [
                'label' => __( 'Text Padding', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table .elementor-price-table__footer .btn ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'apr-core' ),
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-price-table__button' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-price-table__button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-price-table__button' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __( 'Animation', 'apr-core' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings();
        $symbols = $custom_symbol = '';
        global $product;
        global  $woocommerce;
        if ( ($settings['currency_symbol'] == 'yes') && ($settings['currency_symbol_custom'] !== '') ) {
            $symbol =  $settings['currency_symbol_custom'];
        }else {
			if ( function_exists( 'is_woocommerce' ) ) {
				$symbol = get_woocommerce_currency_symbol();
			}else{
				$symbol = '';
			}
        }
        $price = $settings['price'];
        $pricing_type  =   $settings['pricing_type'];

        if($pricing_type ==='type2'){
             $this->add_render_attribute( 'button_text', 'class', [
                'btn btn-primary btn-type-1',
                'elementor-price-table__button',
                'elementor-size-' . $settings['button_size'],
            ] );
        } else {
            $this->add_render_attribute( 'button_text', 'class', [
                'btn btn-primary btn-type-2',
                'elementor-price-table__button',
                'elementor-size-' . $settings['button_size'],
            ] );
        }

        

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'button_text', 'href', $settings['link']['url'] );

            if ( ! empty( $settings['link']['is_external'] ) ) {
                $this->add_render_attribute( 'button_text', 'target', '_blank' );
            }
        }

        if ( ! empty( $settings['button_hover_animation'] ) ) {
            $this->add_render_attribute( 'button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
        }
        $this->add_render_attribute( 'icon', 'class', 'elementor-price-table__icon' );
        $this->add_render_attribute( 'heading', 'class', 'elementor-price-table__heading' );
        $this->add_render_attribute( 'sub_heading', 'class', 'elementor-price-table__subheading' );
        $this->add_render_attribute( 'desc_pricing', 'class', 'elementor-price-table__desc' );
        $this->add_render_attribute( 'period', 'class', ['elementor-price-table__period', 'elementor-typo-excluded'] );

        $this->add_inline_editing_attributes( 'icon', 'none' );
        $this->add_inline_editing_attributes( 'heading', 'none' );
        $this->add_inline_editing_attributes( 'sub_heading', 'none' );
        $this->add_inline_editing_attributes( 'period', 'none' );
        $this->add_inline_editing_attributes( 'button_text' );
        $period_position = $settings['period_position'];
        $period_element = '<span ' . $this->get_render_attribute_string( 'period' ) . '>' . $settings['period'] . '</span>';
        ?>

        <div class="elementor-price-table <?php if($pricing_type ==='type1'){echo 'type1';}?> <?php if($pricing_type ==='type2'){echo 'type2';}?>">
            <?php if ( $settings['icon'] ):?>
                <div class="elementor-price-table__icon">
                   <?php if ( ! empty( $settings['icon'] ) ) : ?>
                         <i class="<?php echo $settings['icon']; ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                </div>
            <?php endif;?>
            <div class="elementor-price-table-top">
                <?php if ( $settings['heading'] || $settings['sub_heading'] ) : ?>
                    <div class="elementor-price-table__header">
                        <?php if ( ! empty( $settings['heading'] ) ) : ?>
                            <h3 <?php echo $this->get_render_attribute_string( 'heading' ); ?>><?php echo $settings['heading']; ?></h3>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
                            <span <?php echo $this->get_render_attribute_string( 'sub_heading' ); ?>><?php echo $settings['sub_heading']; ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if($pricing_type !=='type2'):?>
                    <div class="elementor-price-table__price">
                        <?php if ( 'yes' === $settings['sale'] && ! empty( $settings['original_price'] ) ) : ?>
                            <div class="elementor-price-table__original-price elementor-typo-excluded"><?php echo $symbol . $settings['original_price']; ?></div>
                        <?php endif; ?>
                            <span class="elementor-price-table__currency"><?php echo $symbol; ?></span>
                            <span class="elementor-price-table__integer-part"><?php echo $price; ?></span>

                        <?php if ( ( ! empty( $settings['period'] ) && 'beside' === $period_position ) ) : ?>
                            <div class="elementor-price-table__after-price">
                                <?php if ( ! empty( $settings['period'] ) && 'beside' === $period_position ) : ?>
                                    <?php echo $period_element; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['period'] ) && 'below' === $period_position ) : ?>
                            <?php echo $period_element; ?>
                        <?php endif; ?>
                    </div>
                <?php endif;?>
            </div>
            <?php if ( ! empty( $settings['features_list'] ) ) : ?>
                <div class="elementor-price-table__content">
                    <?php if ( ! empty( $settings['desc_pricing'] ) ) : ?>
                        <span <?php echo $this->get_render_attribute_string( 'desc_pricing' ); ?>><?php echo $settings['desc_pricing']; ?></span>
                    <?php endif; ?>
                    <ul class="elementor-price-table__features-list">
                        <?php foreach ( $settings['features_list'] as $index => $item ) :
                            $repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'features_list', $index );
                            $this->add_inline_editing_attributes( $repeater_setting_key );
                            ?>
                            <li class="elementor-repeater-item-<?php echo $item['_id']; ?> <?php echo $item['class_item']; ?>">
                                <div class="elementor-price-table__feature-inner">
                                    <?php if ( ! empty( $item['item_icon'] ) ) : ?>
                                        <i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $item['item_text'] ) ) : ?>
                                        <span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>>
                                            <?php echo $item['item_text']; ?>
                                        </span>
                                    <?php else :
                                        echo '&nbsp;';
                                    endif;
                                    ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
             <?php if($pricing_type ==='type2'):?>
                <div class="elementor-price-table__price">
                    <?php if ( 'yes' === $settings['sale'] && ! empty( $settings['original_price'] ) ) : ?>
                        <div class="elementor-price-table__original-price elementor-typo-excluded"><?php echo $symbol . $settings['original_price']; ?></div>
                    <?php endif; ?>
                        <span class="elementor-price-table__currency"><?php echo $symbol; ?></span>
                        <span class="elementor-price-table__integer-part"><?php echo $price; ?></span>

                    <?php if ( ( ! empty( $settings['period'] ) && 'beside' === $period_position ) ) : ?>
                        <div class="elementor-price-table__after-price">
                            <?php if ( ! empty( $settings['period'] ) && 'beside' === $period_position ) : ?>
                                <?php echo $period_element; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['period'] ) && 'below' === $period_position ) : ?>
                        <?php echo $period_element; ?>
                    <?php endif; ?>
                </div>
            <?php endif;?>
            <?php if ( ! empty( $settings['button_text'] ) ) : ?>
            <div class="elementor-price-table__footer">
                <?php if ( ! empty( $settings['button_text'] ) ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'button_text' ); ?>><?php echo $settings['button_text']; ?> <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i> </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>

        <?php 
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Pricing_Table );