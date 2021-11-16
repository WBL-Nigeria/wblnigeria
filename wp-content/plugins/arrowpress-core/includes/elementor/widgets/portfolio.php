<?php

namespace Elementor;

use Arrowit_Helper;

if (!defined('ABSPATH')) exit;

class Apr_Core_Portfolio extends Widget_Base
{
    public function get_categories()
    {
        return array('apr-core');
    }

    public function get_name()
    {
        return 'apr_portfolio';
    }

    public function get_title()
    {
        return __('APR Portfolio', 'apr-core');
    }

    public function get_icon()
    {
        return 'eicon-post-excerpt';
    }

    public function get_script_depends()
    {
        return ['jquery-slick'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'portfolio_section',
            [
                'label' => __('APR Portfolio', 'apr-core')
            ]
        );
        $this->add_control(
            'portfolio_style',
            [
                'label' => __('Portfolio Style', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => __('Style 1', 'apr-core'),
                    'style2' => __('Style 2', 'apr-core'),
                    'style3' => __('Style 3', 'apr-core'),
                ],
            ]
        );
        $this->add_control(
            'portfolio_title',
            [
                'label' => __('Portfolio Title', 'apr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your portfolio title', 'apr-core'),
                'default' => __('Featured Portfolio', 'apr-core'),
                'condition' => [
                    'portfolio_style' => 'style1',
                ],
            ]
        );
        $this->add_control(
            'portfolio_desc',
            [
                'label' => __('Portfolio Descript', 'apr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your portfolio descript', 'apr-core'),
                'default' => __('With our experience, we always bring the best services for Clients', 'apr-core'),
                'condition' => [
                    'portfolio_style' => 'style1',
                ],
            ]
        );
        $this->add_responsive_control(
            'portfolio_number_column',
            [
                'label' => __('Number column', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __('1', 'apr-core'),
                    '2' => __('2', 'apr-core'),
                    '3' => __('3', 'apr-core'),
                    '4' => __('4', 'apr-core'),
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'condition' => [
                    'portfolio_style' => [ 'style1','style2' ],
                ],
            ]
        );
        $this->add_control(
            'portfolio_select_cat',
            [
                'label' => __('Select Category Portfolio', 'apr-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => apr_core_check_get_cat('portfolio_cat'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'portfolio_style' => [ 'style1','style2' ],
                ],
            ]
        );
        $this->add_control(
            'portfolio_limit',
            [
                'label' => __('Posts Per Page', 'apr-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'condition' => [
                    'portfolio_style' => [ 'style1','style2' ],
                ],
            ]
        );
        $this->add_control(
            'portfolio_order_by',
            [
                'label' => __('Order By', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ID',
                'options' => [
                    'ID' => __('Post ID', 'apr-core'),
                    'author' => __('Post Author', 'apr-core'),
                    'title' => __('Title', 'apr-core'),
                    'date' => __('Date', 'apr-core'),
                    'rand' => __('Random', 'apr-core'),
                    'comment_count' => __('Comment count', 'apr-core'),
                ],
                'condition' => [
                    'portfolio_style' => [ 'style1','style2' ],
                ],
            ]
        );
        $this->add_control(
            'portfolio_order',
            [
                'label' => __('Order', 'apr-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => [
                    'ASC' => __('Ascending', 'apr-core'),
                    'DESC' => __('Descending', 'apr-core'),
                ],
                'condition' => [
                    'portfolio_style' => [ 'style1','style2' ],
                ],
            ]
        );
        $this->add_control(
            'portfolio_show_more',
            [
                'label' => __('Show View More', 'apr-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'apr-core'),
                'label_off' => __('Off', 'apr-core'),
                'default' => 'Off',
                'condition' => [
                    'portfolio_style' => 'style1',
                ],
            ]
        );

        $this->add_control(
            'on_slider',
            [
                'label'     => __( 'On Slider', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'portfolios_name',
            [
                'label'     => __( 'Name', 'apr-core' ),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active'    => true,
                ],
                'default'   => 'Neil McCarthy',
            ]
        );
        $repeater->add_control(
            'portfolios_desc',
            [
                'label'     => __( 'Content', 'apr-core' ),
                'type'      => Controls_Manager::TEXTAREA,
                'dynamic'   => [
                    'active'    => true,
                ],
                'rows'      => '10',
                'default'   => 'Lorem Ipsum is simply dummy text of the printing and 
typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an 
unknown. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
industry\'s standard dummy text ever since the 1500s, when an unknown. Lorem Ipsum is simply dummy text',
            ]
        );
        $repeater->add_control(
            'portfolios_slider_image',
            [
                'label'     => __( 'Choose Avatar', 'elementor' ),
                'description'   => __( 'You should choose a small, rectangle image.', 'elementor' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'portfolios_job',
            [
                'label'     => __( 'Job', 'apr-core' ),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active'    => false,
                ],
                'default'   => 'Designer',
            ]
        );
        $this->add_control(
            'slides',
            [
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'portfolios_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'portfolios_job'      => __( 'Designer', 'apr-core' ),
                        'portfolios_desc'      => 'Lorem Ipsum is simply dummy text of the printing and 
typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an 
unknown. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
industry\'s standard dummy text ever since the 1500s, when an unknown. Lorem Ipsum is simply dummy text',
                    ],
                    [
                        'portfolios_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'portfolios_job'      => __( 'CEO & founder', 'apr-core' ),
                        'portfolios_desc'      => 'Lorem Ipsum is simply dummy text of the printing and 
typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an 
unknown. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
industry\'s standard dummy text ever since the 1500s, when an unknown. Lorem Ipsum is simply dummy text',
                    ],
                    [
                        'portfolios_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'portfolios_job'      => __( 'Marketing Manager', 'apr-core' ),
                        'portfolios_desc'      => 'Lorem Ipsum is simply dummy text of the printing and 
typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an 
unknown. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
industry\'s standard dummy text ever since the 1500s, when an unknown. Lorem Ipsum is simply dummy text',
                    ],
                    [
                        'portfolios_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'portfolios_job'      => __( 'Developer', 'apr-core' ),
                        'portfolios_desc'      => 'Lorem Ipsum is simply dummy text of the printing and 
typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an 
unknown. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
industry\'s standard dummy text ever since the 1500s, when an unknown. Lorem Ipsum is simply dummy text',
                    ],
                ],
                'title_field'   => '{{{ portfolios_name }}}',
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'portfolios_slider_image_position',
            [
                'label'     => __( 'Image Position', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'aside',
                'options'   => [
                    'aside'     => __( 'Aside', 'apr-core' ),
                    'top'       => __( 'Top', 'apr-core' ),
                ],
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'portfolios_alignment',
            [
                'label'     => __( 'Alignment', 'apr-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
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
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'view',
            [
                'label'     => __( 'View', 'apr-core' ),
                'type'      => Controls_Manager::HIDDEN,
                'default'   => 'traditional',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_slider_options',
            [
                'label'     => __( 'Slider Options', 'apr-core' ),
                'type'      => Controls_Manager::SECTION,
                'condition' => [
                    'on_slider' => 'yes',
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'navigation',
            [
                'label'     => __( 'Navigation', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'both',
                'options'   => [
                    'both'      => __( 'Arrows and Dots', 'apr-core' ),
                    'arrows'    => __( 'Arrows', 'apr-core' ),
                    'dots'      => __( 'Dots', 'apr-core' ),
                    'none'      => __( 'None', 'apr-core' ),
                ],
            ]
        );
        $this->add_control(
            'dots_type',
            [
                'label'     => __( 'Dots Type', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bullets',
                'options'   => [
                    'bullets'     => __( 'Bullets', 'apr-core' ),
                    'fraction'    => __( 'Fraction', 'apr-core' ),
                    'progressbar' => __( 'Progressbar', 'apr-core' ),
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'loop',
            [
                'label'     => __( 'Loop', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label'     => __( 'Autoplay', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );
        $this->add_control(
            'centered_slides',
            [
                'label'     => __( 'Centered Slides', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );
        $this->add_control(
            'autoplay_delay',
            [
                'label'     => __( 'Autoplay Delay', 'apr-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_item_per_view',
            [
                'label'     => __( 'Number item per view', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'auto'      => __( 'Auto', 'apr-core' ),
                    '1'         => __( '1', 'apr-core' ),
                    '2'         => __( '2', 'apr-core' ),
                    '3'         => __( '3', 'apr-core' ),
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => 1,
                'tablet_default'  => 1,
                'mobile_default'  => 1
            ]
        );
        $this->add_responsive_control(
            'number_column',
            [
                'label'     => __( 'Number Column', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1'         => __( '1', 'apr-core' ),
                    '2'         => __( '2', 'apr-core' ),
                    '3'         => __( '3', 'apr-core' ),
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '',
                'tablet_default'  => '',
                'mobile_default'  => '',
            ]
        );
        $this->add_responsive_control(
            'number_column_fill',
            [
                'label'     => __( 'Number Column Fill', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'row'         => __( 'Row', 'apr-core' ),
                    'column'      => __( 'Column', 'apr-core' ),
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '',
                'tablet_default'  => '',
                'mobile_default'  => '',
            ]
        );
        $this->add_responsive_control(
            'space_between',
            [
                'label'     => __( 'Space between items', 'apr-core' ),
                'type'      => Controls_Manager::NUMBER,
                'step'            => 1,
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => 0,
                'tablet_default'  => 0,
                'mobile_default'  => 0
            ]
        );
        $this->add_control(
            'effect',
            [
                'label'     => __( 'Effect', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'slide',
                'options'   => [
                    'slide'        => __( 'Slide', 'apr-core' ),
                    'fade'         => __( 'Fade', 'apr-core' ),
                    'cube'         => __( 'Cube', 'apr-core' ),
                    'coverflow'    => __( 'Coverflow ', 'apr-core' ),
                    'flip'         => __( 'Flip ', 'apr-core' ),
                ],
            ]
        );
        $this->end_controls_section();
        // Image.
        $this->start_controls_section(
            'section_style_portfolios',
            [
                'label'     => __( 'Portfolios Box', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'portfolios_inner_padding',
            [
                'label' => esc_html__( 'Padding', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'portfolios_background',
            [
                'label' => esc_html__( 'Background', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'portfolios_background_after',
            [
                'label'         => esc_html__( 'Background Shadow After', 'apr-core' ),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__( 'Ex: 100,93,188 (RGBA)', 'apr-core' ),
                'selectors'     => [
                    '{{WRAPPER}} .testimonial-inner:before' => 'background: rgba({{VALUE}},0.4);
            background: -moz-radial-gradient(center, ellipse cover, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.1) 51%, rgba({{VALUE}},0) 70%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba({{VALUE}},0.4)), color-stop(0%, rgba({{VALUE}},0.4)), color-stop(51%, rgba({{VALUE}},0.1)), color-stop(100%, rgba({{VALUE}},0)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.1) 51%, rgba({{VALUE}},0) 70%);
            background: -o-radial-gradient(center, ellipse cover, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.1) 51%, rgba({{VALUE}},0) 70%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(#645dbc,0.4) 0%, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.1) 51%, rgba({{VALUE}},0) 70%);
            background: radial-gradient(ellipse at center, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.4) 0%, rgba({{VALUE}},0.1) 51%, rgba({{VALUE}},0) 70%);',
                ],
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'portfolios_border_radius',
            [
                'label' => __( 'Border Radius', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'portfolios_box_shadow',
            [
                'label'     => __( 'Use Box Shadow', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'portfolios_box_box_shadow',
                'selector' => '{{WRAPPER}} .testimonial-inner',
                'condition' => [
                    'portfolios_box_shadow' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_portfolios_image',
            [
                'label'     => __( 'Image', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'width_image',
            [
                'label'     => __( 'Width', 'apr-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px' ],
                'range'     => [
                    'px'    => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'height_image',
            [
                'label'     => __( 'Height', 'apr-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px' ],
                'range'     => [
                    'px'    => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'width_bg_overlay',
            [
                'label'     => __( 'Width background overlay', 'apr-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px' ],
                'range'     => [
                    'px'    => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-image:before,
                    {{WRAPPER}} .elementor-testimonial-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'height_bg_overlay',
            [
                'label'     => __( 'Height background overlay', 'apr-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px' ],
                'range'     => [
                    'px'    => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-image:before, {{WRAPPER}} .elementor-testimonial-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'portfolios_image_background',
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image:before',
            ]
        );
        $this->end_controls_section();
        // Name.
        $this->start_controls_section(
            'section_style_portfolios_name',
            [
                'label'     => __( 'Name', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'name_text_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'name_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .elementor-testimonial-name',
            ]
        );
        $this->end_controls_section();
        //Job
        $this->start_controls_section(
            'section_style_portfolios_job',
            [
                'label'     => __( 'Job', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'job_text_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'job_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .elementor-testimonial-job',
            ]
        );
        $this->end_controls_section();
        // Content.
        $this->start_controls_section(
            'section_style_portfolios_desc',
            [
                'label'     => __( 'Description', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'content_desc_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_desc_bg_color',
            [
                'label'     => __( 'Background', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-desc' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-desc:after' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_desc_border_radius',
            [
                'label' => __( 'Border Radius', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'portfolios_desc_shadow',
            [
                'label'     => __( 'Use Box Shadow', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_desc_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-testimonial-desc',
                'condition' => [
                    'portfolios_desc_shadow' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'desc_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
                'selector'  => '{{WRAPPER}} .elementor-testimonial-desc',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label'     => __( 'Navigation', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation'    => [ 'arrows', 'dots', 'both' ],
                    'on_slider'     => 'yes',
                    'portfolio_style' =>  ['style3' ],
                ],
            ]
        );
        $this->add_control(
            'heading_style_dots',
            [
                'label'     => __( 'Dots', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'dots_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial .swiper-pagination-bullet, {{WRAPPER}} .testimonial .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .testimonial .swiper-pagination-fraction' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'heading_style_arrows',
            [
                'label'     => __( 'Arrows', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'arrows_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial .swiper-button-next, {{WRAPPER}} .testimonial .swiper-button-prev' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->add_control(
            'arrows_bg_color',
            [
                'label'     => __( 'Background Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial .swiper-button-next, {{WRAPPER}} .testimonial .swiper-button-prev' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $portfolio_title = $settings['portfolio_title'];
        $portfolio_style = $settings['portfolio_style'];
        $portfolio_desc = $settings['portfolio_desc'];
        $cat_post = $settings['portfolio_select_cat'];
        $column_desktop = $settings['portfolio_number_column'];
        $column_tablet = $settings['portfolio_number_column_tablet'];
        $column_mobile = $settings['portfolio_number_column_mobile'];
        $portfolio_limit = $settings['portfolio_limit'];
        $order_by_post = $settings['portfolio_order_by'];
        $order_post = $settings['portfolio_order'];
        $show_more_post = $settings['portfolio_show_more'];
        if (!empty($cat_post)) :
            $apr_portfolio_type_arg = array(
                'post_type' => 'portfolio',
                'posts_per_page' => $portfolio_limit,
                'orderby' => $order_by_post,
                'order' => $order_post,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_cat',
                        'field' => 'slug',
                        'terms' => $cat_post
                    )
                )
            );
        else:
            $apr_portfolio_type_arg = array(
                'post_type' => 'portfolio',
                'posts_per_page' => $portfolio_limit,
                'orderby' => $order_by_post,
                'order' => $order_post,
            );
        endif;
        query_posts($apr_portfolio_type_arg);
        $apr_post_type_query = new \ WP_Query($apr_portfolio_type_arg);

        if ($apr_post_type_query->have_posts() && ($portfolio_style=='style1' || $portfolio_style=='style2')) :
            $items_desktop = 12 / $column_desktop;
            $items_tablets = 12 / $column_tablet;
            $items_mobile = 12 / $column_mobile;
            $id = 'apr-portfolio-' . wp_rand();
            $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
            ?>
            <?php if ($portfolio_style === "style1"): ?>
            <div class="portfolio-header text-center">
                <?php if ($portfolio_title != '') { ?>
                    <h2><?php echo $portfolio_title; ?></h2>
                <?php } ?>
                <?php if ($portfolio_desc != '') { ?>
                    <p><?php echo $portfolio_desc; ?></p>
                <?php } ?>
            </div>
        <?php endif; ?>
        <div id="<?php echo esc_attr($id); ?>"
             class="load-item portfolio-shortcode row">
            <?php while ($apr_post_type_query->have_posts()):
            $apr_post_type_query->the_post(); ?>
            <?php if ($portfolio_style === "style1"): ?>
            <div class="item col-lg-<?php echo esc_html($items_desktop) ?> col-md-<?php echo esc_html($items_tablets) ?> col-sm-<?php echo esc_html($items_mobile) ?>">
            <div class="portfolio-content">
            <?php else: ?>
            <div class="portfolio-<?php echo $portfolio_style; ?> col-lg-<?php echo esc_html($items_desktop) ?> col-md-<?php echo esc_html($items_mobile) ?> col-sm-<?php echo esc_html($items_mobile) ?>">
                <div class="portfolio-home">
                    <?php endif; ?>
                    <div class="portfolio-item">
                        <?php if ($portfolio_style === 'style1'): ?>
                            <div class="portfolio-title">
                                <h2 class="post-name text-center">
                                        <?php echo arrowit_limit_title(50); ?>
                                </h2>
                            </div>
                        <?php endif; ?>
                        <?php if (has_post_thumbnail() && get_post_format() !== 'quote' && get_post_format() !== 'audio' && get_post_format() !== 'video'): ?>
                            <div class="portfolio-img image-hover-zoom">
                                    <?php
                                    if ($portfolio_style === 'style1'):
                                        $image = arrowit_resize_image(555, 345);
                                    else:
                                        $image = arrowit_resize_image(900, 900);
                                        $gallery = get_post_meta(get_the_ID(), 'gallery_metabox', true);
                                        if (is_array($gallery) && count($gallery) > 0) :
                                            $full_image_size = wp_get_attachment_image_src($gallery[0], 'full');
                                            $image_url = Arrowit_Helper::aq_resize(array(
                                                'url' => $full_image_size[0],
                                            ));
                                        endif;
                                    endif;
                                    ?>
                                    <?php if ($portfolio_style === 'style2' && is_array($gallery) && count($gallery) > 0): ?>
                                        <img src="<?php echo esc_url($image); ?>"
                                             alt="<?php get_the_title(); ?>"/>
                                    <?php else: ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php get_the_title(); ?>"/>
                                    <?php endif; ?>
                                <?php if ($portfolio_style === 'style2'): ?>
                                    <h2 class="post-name text-center"><a href="<?php the_permalink(); ?>"
                                                                         title="<?php the_title_attribute(); ?>">
                                            <?php echo arrowit_limit_title(50); ?>
                                        </a>
                                    </h2>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        if ($portfolio_style === 'style1'):
                            ?>
                            <div class="portfolio-post-info">
                                <div class="just-center text-center">
                                    <div class="portfolio-description">
                                        <div class="entry-content">
                                            <p>
                                                <?php echo arrowit_limit_excerpt(169); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="read-more">
                                        <a class="view_detail_portfolio" data-fancybox
                                           href="#single-delivery<?php echo get_the_ID(); ?>"><?php echo esc_html__('More Detail', 'apr-core'); ?></a>
                                        <div id="single-delivery<?php echo get_the_ID(); ?>"
                                             class="single-delivery">
                                            <div class="portfolio-img">
                                                <?php
                                                $gallery = get_post_meta(get_the_ID(), 'gallery_metabox', true);
                                                if (is_array($gallery) && count($gallery) > 1) : ?>
                                                    <div class="portfolio-gallery arrows-custom">
                                                        <?php
                                                        foreach ($gallery as $key => $value) :
                                                            $full_image_size = wp_get_attachment_image_src($value, 'full');
                                                            $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                                            $image_url = Arrowit_Helper::aq_resize(array(
                                                                'url' => $full_image_size[0],
                                                            ));
                                                            ?>
                                                            <div class="slider<?php echo get_the_ID() . wp_rand(); ?>">
                                                                <img src="<?php echo esc_url($image_url); ?>"
                                                                     alt="<?php echo esc_attr($alt); ?>"/>
                                                            </div>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php else: ?>
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <?php
                                                        $image = arrowit_resize_image(555, 345);
                                                        ?>
                                                        <img src="<?php echo esc_url($image); ?>"
                                                             alt="<?php the_title_attribute(); ?>"/>
                                                        <?php
                                                    endif;
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="portfolio-content-text clearfix">
                                                <div class="portfolio-left float-left">
                                                    <div class="portfolios-info">
                                                        <h3 class="portfolio-name"><?php the_title(); ?></h3>
                                                    </div>
                                                    <div class="portfolio-desc">
                                                        <?php
                                                        echo '<div class="entry-content">';
                                                        the_content();
                                                        wp_link_pages(array(
                                                            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'arrowit') . '</span>',
                                                            'after' => '</div>',
                                                            'link_before' => '<span>',
                                                            'link_after' => '</span>',
                                                            'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'arrowit') . ' </span>%',
                                                            'separator' => '<span class="screen-reader-text">, </span>',
                                                        ));
                                                        echo '</div>';
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="portfolio-right float-left">
                                                    <div class="portfolios-info">
                                                        <h3 class="portfolio-name"><?php echo esc_html__('Project Details', 'arrowit') ?></h3>
                                                    </div>
                                                    <div class="portfolio-desc">
                                                        <p><?php echo esc_html__('Completed: ', 'arrowit') ?>
                                                            <span><?php the_modified_time('F jS, Y'); ?></span>
                                                        </p>
                                                        <p><?php echo esc_html__('Author: ', 'arrowit') ?>
                                                            <span><?php the_author(); ?></span></p>
                                                        <?php
                                                        $portfolio_category = get_the_term_list($apr_post_type_query->ID,'portfolio_cat', ' ', ', ');
                                                        if ($portfolio_category != '') {
                                                            ?>
                                                            <p><?php echo esc_html__('Category: ', 'arrowit') ?><?php echo $portfolio_category; ?></p>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_query(); ?>
            </div>
            <?php if ($show_more_post === 'yes') : ?>
            <div class="viewmore-portfolio text-center col-lg-<?php echo esc_html($items_desktop) ?> col-md-<?php echo esc_html($items_tablets) ?> col-sm-<?php echo esc_html($items_mobile) ?>">
                <a class="view_more " href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>"><?php echo esc_html('','apr-core').'<i class="fa fa-caret-down"></i>' . '<span class="icon-play32"></span>';?></a>
                <div class="btn-viewmore"></div>
            </div>
        <?php endif; ?>
        <?php endif;
        if($portfolio_style=='style3'):
                $settings = $this->get_settings_for_display();
                $portfolios_type  =  6;
                if ( empty( $settings['slides'] ) ) {
                return;
                }
                $this->add_render_attribute( 'wrapper', 'class', 'elementor-testimonial-wrapper' );
                if ( $settings['portfolios_alignment'] ) {
                $this->add_render_attribute( 'wrapper', 'class', 'text-' . $settings['portfolios_alignment'] );
                }
                if ( $settings['portfolios_box_shadow'] === 'yes' || $settings['portfolios_desc_shadow'] === 'yes' ) {
                $this->add_render_attribute( 'wrapper', 'class', 'has-shadow' );
                }
                $this->add_render_attribute( 'meta', 'class', 'elementor-testimonial-meta' );
                if ( $settings['portfolios_slider_image_position'] ) {
                $this->add_render_attribute( 'meta', 'class', 'elementor-testimonial-image-position-' . $settings['portfolios_slider_image_position'] );
                }
                $slides = [];
                $slides_image = [];
                $slide_count = 0;
                foreach ( $settings['slides'] as $slide ) {
                $slide_html = $slide_attributes = $class_item = '';
                $icon = '&#61445;';
                $slide_element = 'div';
                if(( $slide['portfolios_slider_image']['url'] ) || ( $slide['portfolios_name'] ) || ( $slide['portfolios_job'] )) {
                $slide_html .= '<div ' . $this->get_render_attribute_string( 'meta' ) . '>' . '<div class="elementor-testimonial-meta-inner">';
                    if ( $slide['portfolios_slider_image']['url'] ) {
                    $image_url = $slide['portfolios_slider_image']['url'];
                    $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr('Image Portfolios' , 'apr-core') . '" />';
                    $slide_html .= '<div class="elementor-testimonial-image">' . $image_html . '</div>';
                    }
                    if(( $slide['portfolios_name'] ) || ( $slide['portfolios_job'] )) {
                    $slide_html .= '<div class="elementor-testimonial-details">';
                        if ( $slide['portfolios_name'] ) {
                        $slide_html .= '<div class="elementor-testimonial-name">' . $slide['portfolios_name'] . '</div>';
                        }
                        if ( $slide['portfolios_job'] ) {
                        $slide_html .= '<div class="elementor-testimonial-job">' . $slide['portfolios_job'] . '</div>';
                        }
                        $slide_html .= '</div>';
                    }
                    $slide_html .= '</div></div>';
            }

            if ( $slide['portfolios_desc'] ) {
            $slide_html .= '<div class="elementor-testimonial-desc">&ldquo;' . $slide['portfolios_desc'] . '&rdquo;</div>';
            }

            if($settings['on_slider'] === 'yes'){
            $class_item = 'swiper-slide';
            }else{
            $class_item = 'item-portfolios';
            }
            $slide_html =  '<' . $slide_element . ' ' . $slide_attributes . ' class="testimonial-inner">' . $slide_html . '</' . $slide_element . '>';
        $slides[] = '<div class="elementor-repeater-item-' . $slide['_id'] . ' ' . $class_item . '">' . $slide_html . '</div>';
        $slide_count++;
        }
        $is_rtl = is_rtl();
        $direction = $is_rtl ? 'rtl' : 'ltr';
        $id =  'apr-testimonial-'.wp_rand();
        $loop = $autoplay = $swiper_container = $swiper_wrapper = $class_shadow = $centered_slides = '';
        if($settings['loop'] === 'yes'){
        $loop = 'true';
        }else{
        $loop = 'false';
        }
        if($settings['centered_slides'] === 'yes'){
        $centered_slides = 'true';
        }else{
        $centered_slides = 'false';
        }
        if($settings['on_slider'] === 'yes'){
        $swiper_container = 'swiper-container';
        $swiper_wrapper = 'swiper-wrapper';
        }else{
        $swiper_container = 'portfolios-container';
        $swiper_wrapper = 'portfolios-container-wrapper';
        }
        if($settings['autoplay'] === 'yes'){
        if ($settings['autoplay_delay']) {
        $autoplay .= '{';
        $autoplay .= 'delay:' .  absint( $settings['autoplay_delay'] ) . ',';
        $autoplay .= 'disableOnInteraction: false,';
        $autoplay .= '}';
        }
        }else{
        $autoplay = 'false';
        }
        $carousel_classes = [ 'testimonial-content' ];
        $this->add_render_attribute( 'slides', [
        'class' => $carousel_classes,
        ] );
        ?>
        <div id ="<?php echo esc_attr($id);?>" class="testimonial testimonial-type-6 <?php echo $class_shadow;?>" >
            <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
                    <div class=" <?php echo $swiper_container;?>" dir = "<?php echo $direction;?>">
                        <div class="<?php echo $swiper_wrapper;?>">
                            <?php echo implode( '', $slides ); ?>
                        </div>

                        <?php if($settings['navigation'] == 'both'):?>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        <?php elseif($settings['navigation'] == 'arrows'):?>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        <?php elseif($settings['navigation'] == 'dots'):?>
                            <div class="swiper-pagination"></div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php if($settings['on_slider'] === 'yes') : ?>
        <script>
            jQuery(document).ready(function($) {
                var swiper = new Swiper('#<?php echo esc_js($id);?> .swiper-container', {
                    loop: <?php echo esc_attr($loop);?>,
                    slidesPerView: '<?php echo esc_attr( $settings['number_item_per_view'] );?>',
                    slidesPerColumn : '<?php echo esc_attr( $settings['number_column'] );?>',
                    slidesPerColumnFill: '<?php echo esc_attr( $settings['number_column_fill'] );?>',
                    spaceBetween: <?php echo absint( $settings['space_between'] );?>,
                    centeredSlides: <?php echo $centered_slides;?>,
                    pagination: {
                        el: '#<?php echo esc_js($id);?> .swiper-pagination',
                        clickable: true,
                        type: '<?php echo esc_attr( $settings['dots_type'] );?>',
                    },
                    navigation: {
                        nextEl: '#<?php echo esc_js($id);?> .swiper-button-next',
                        prevEl: '#<?php echo esc_js($id);?> .swiper-button-prev',
                    },
                    effect: '<?php echo esc_attr( $settings['effect'] );?>',
                    autoplay: <?php echo $autoplay;?>,
                    breakpoints: {
                        1024.2: {
                            slidesPerView: '<?php echo esc_attr( $settings['number_item_per_view_tablet'] );?>',
                            spaceBetween: <?php echo absint( $settings['space_between_tablet'] );?>,
                            slidesPerColumn : '<?php echo esc_attr( $settings['number_column_tablet'] );?>',
                            slidesPerColumnFill: '<?php echo esc_attr( $settings['number_column_fill_tablet'] );?>',
                        },
                        767.2: {
                            slidesPerView: '<?php echo esc_attr( $settings['number_item_per_view_mobile'] );?>',
                            spaceBetween: <?php echo absint( $settings['space_between_mobile'] );?>,
                            slidesPerColumn : '<?php echo esc_attr( $settings['number_column_mobile'] );?>',
                            slidesPerColumnFill: '<?php echo esc_attr( $settings['number_column_fill_mobile'] );?>',
                        },
                    }
                });
            });
        </script>
    <?php
    endif;?>
        <?php endif;
    }

    protected function _content_template()
    {
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Apr_Core_Portfolio);