<?php
namespace Elementor;
use Elementor\Controls_Manager;
use Elementor\Repeater;
if ( ! defined( 'ABSPATH' ) ) exit;
class Apr_Core_Testimolials extends Widget_Base {
    public function get_name() {
        return 'apr-testimolials';
    }
    public function get_categories() {
        return array( 'apr-core' );
    }
    public function get_script_depends() {
        return [ 'jquery-swiper' ];
    }
    public function get_title() {
        return __( ' APR Testimolials', 'apr-core' );
    }
    public function get_icon() {
        return 'eicon-testimonial';
    }
    protected function _register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label'     => __( 'Testimonial', 'apr-core' ),
            ]
        );
        $this->add_control(
            'testimonial_type',
            array(
                'label'   => __( 'Testimonials Type', 'apr-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
                    '1'      => __( 'Type 1', 'apr-core' ),
                    '2'      => __( 'Type 2', 'apr-core' ),
                    '3'      => __( 'Type 3', 'apr-core' ),
                    '4'      => __( 'Type 4', 'apr-core' ),
                    '5'      => __( 'Type 5', 'apr-core' ),
                    '6'      => __( 'Type 6', 'apr-core' ),
                    '7'      => __( 'Type 7', 'apr-core' ),
                ),
                'default'    => '1',
            )
        );
        $this->add_control(
            'on_slider',
            [
                'label'     => __( 'On Slider', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'testimonial_name',
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
            'testimonial_rating',
            [
                'label' => __( 'Rating', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5,
                'step' => 0.1,
                'default' => 0,
            ]
        );
        $repeater->add_control(
            'testimonial_desc',
            [
                'label'     => __( 'Content', 'apr-core' ),
                'type'      => Controls_Manager::TEXTAREA,
                'dynamic'   => [
                    'active'    => true,
                ],
                'rows'      => '10',
                'default'   => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
            ]
        );
        $repeater->add_control(
            'testimonial_slider_image',
            [
                'label'     => __( 'Choose Avatar', 'apr-core' ),
                'description'   => __( 'You should choose a small, rectangle image.', 'apr-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'testimonial_image_project',
            [
                'label'     => __( 'Choose image project', 'apr-core' ),
                'description'   => __( 'Only work width testimonials type
6.', 'apr-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'testimonial_signature',
            [
                'label'     => __( 'Signature', 'apr-core' ),
                'type'      => Controls_Manager::MEDIA,
                'description'   => __( 'Signature only show testimonial type 1 or 4.', 'elementor' ),
                'dynamic'   => [
                    'active'    => true,
                ],
                'type'      => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'testimonial_job',
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
                        'testimonial_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'testimonial_job'      => __( 'Designer', 'apr-core' ),
                        'testimonial_desc'      => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
                    ],
                    [
                        'testimonial_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'testimonial_job'      => __( 'CEO & founder', 'apr-core' ),
                        'testimonial_desc'      => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
                    ],
                    [
                        'testimonial_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'testimonial_job'      => __( 'Marketing Manager', 'apr-core' ),
                        'testimonial_desc'      => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
                    ],
                    [
                        'testimonial_name'      => __( 'Neil McCarthy', 'apr-core' ),
                        'testimonial_job'      => __( 'Developer', 'apr-core' ),
                        'testimonial_desc'      => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
                    ],
                ],
                'title_field'   => '{{{ testimonial_name }}}',
            ]
        );
        $this->add_control(
            'testimonial_slider_image_position',
            [
                'label'     => __( 'Image Position', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'aside',
                'options'   => [
                    'aside'     => __( 'Aside', 'apr-core' ),
                    'top'       => __( 'Top', 'apr-core' ),
                ],
            ]
        );
        $this->add_control(
            'testimonial_alignment',
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
            'looped_slides',
            [
                'label'     => __( 'Looped slides', 'apr-core' ),
                'type'      => Controls_Manager::NUMBER,
                'step'      => 1,
                'condition' => [
                    'loop' => 'yes',
                    'testimonial_type' => '7',
                ],
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
                'condition' => [
                    'testimonial_type!' => '7',
                ],
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
                'mobile_default'  => 1,
                'condition' => [
                    'testimonial_type!' => '7',
                ],
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
                'condition' => [
                    'testimonial_type!' => '7',
                ],
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
                'condition' => [
                    'testimonial_type!' => '7',
                ],
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
                'mobile_default'  => 0,
                'condition' => [
                    'testimonial_type!' => '7',
                ],
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
                'condition' => [
                    'testimonial_type!' => '7',
                ],
            ]
        );
        $this->end_controls_section();
        // Image.
        $this->start_controls_section(
            'section_style_testimonial',
            [
                'label'     => __( 'Testimonial Box', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'testimonial_inner_padding',
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
            'testimonial_background',
            [
                'label' => esc_html__( 'Background', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'testimonial_background_after',
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
                    'testimonial_type' =>  [ '3', '4', '6' ],
                ],
            ]
        );
        $this->add_control(
            'testimonial_border_radius',
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
            'testimonial_box_shadow',
            [
                'label'     => __( 'Use Box Shadow', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_box_shadow',
                'selector' => '{{WRAPPER}} .testimonial-inner',
                'condition' => [
                    'testimonial_box_shadow' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label'     => __( 'Image', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
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
                'name' => 'testimonial_image_background',
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image:before',
            ]
        );
        $this->end_controls_section();
        //Project
        $this->start_controls_section(
            'section_style_testimonial_image_project',
            [
                'label'     => __( 'Project', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_type' =>  [ '7' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'image_project',
            [
                'label'     => __( 'Height image', 'apr-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px' ],
                'range'     => [
                    'px'    => [
                        'min' => 20,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-thumbs img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_type' =>  [ '7' ],
                ],
            ]
        );
        $this->end_controls_section();
        // Name.
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label'     => __( 'Name', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
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
        // Rating.
        $this->start_controls_section(
            'section_style_testimonial_rating',
            [
                'label'     => __( 'Rating', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'rating_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating i:before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rating_empty_color',
            [
                'label'     => __( 'Rating Empty Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Job
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label'     => __( 'Job', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
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
            'section_style_testimonial_desc',
            [
                'label'     => __( 'Description', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
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

        $this->add_responsive_control(
            'content_desc_padding',
            [
                'label' => __( 'Padding', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_type' =>  [ '5' ],
                ],
            ]
        );
        $this->add_control(
            'testimonial_desc_shadow',
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
                    'testimonial_desc_shadow' => 'yes',
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
        // Signature.
        $this->start_controls_section(
            'section_style_testimonial_signature',
            [
                'label'     => __( 'Signature', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'size_signature',
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
                    '{{WRAPPER}} .elementor-testimonial-signature img' => 'width: {{SIZE}}{{UNIT}};',
                ],
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
    /**
     * @since 2.3.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $testimonial_type  =  $settings['testimonial_type'];
        if ( empty( $settings['slides'] ) ) {
            return;
        }
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-testimonial-wrapper' );
        if ( $settings['testimonial_alignment'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'text-' . $settings['testimonial_alignment'] );
        }
        if ( $settings['testimonial_box_shadow'] === 'yes' || $settings['testimonial_desc_shadow'] === 'yes' ) {
            $this->add_render_attribute( 'wrapper', 'class', 'has-shadow' );
        }
        $this->add_render_attribute( 'meta', 'class', 'elementor-testimonial-meta' );
        if ( $settings['testimonial_slider_image_position'] ) {
            $this->add_render_attribute( 'meta', 'class', 'elementor-testimonial-image-position-' . $settings['testimonial_slider_image_position'] );
        }
        $slides = [];
        $slides_thumbs = [];
        $slides_image = [];
        $slide_count_thumb = 0;
        $slide_count = 0;
        foreach ( $settings['slides'] as $slide ) {
            $slide_html = $slide_attributes = $class_item = '';
            $icon = '&#61445;';
            $slide_element = 'div';
            if(( $slide['testimonial_slider_image']['url'] ) || ( $slide['testimonial_name'] ) || ( $slide['testimonial_rating'] ) || ( $slide['testimonial_job'] )) {
                $slide_html .= '<div ' . $this->get_render_attribute_string( 'meta' ) . '>' . '<div class="elementor-testimonial-meta-inner">';
                if ( $slide['testimonial_slider_image']['url'] ) {
                    $image_url = $slide['testimonial_slider_image']['url'];
                    $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr('Image Testimonial' , 'apr-core') . '" />';
                    $slide_html .= '<div class="elementor-testimonial-image">' . $image_html . '</div>';
                }
                if(( $slide['testimonial_name'] ) || ( $slide['testimonial_rating'] ) || ( $slide['testimonial_job'] )) {
                    $slide_html .= '<div class="elementor-testimonial-details">';
                    if ( $slide['testimonial_name'] ) {
                        $slide_html .= '<div class="elementor-testimonial-name">' . $slide['testimonial_name'] . '</div>';
                    }
                    if ( $slide['testimonial_rating'] ) {
                        $slide_html .= '<div class="elementor-testimonial-rating">';
                        $rating = (float) $slide['testimonial_rating'];
                        $rating_count = $rating[0];
                        $floored_rating = (int) $rating;
                        $stars_html = '';
                        for ( $stars = 1; $stars <= 5; $stars++ ) {
                            if ( $stars <= $floored_rating ) {
                                $slide_html .= '<i class="elementor-star-full">' . $icon . '</i>';
                            } elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
                                $slide_html .= '<i class="elementor-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
                            } else {
                                $slide_html .= '<i class="elementor-star-empty">' . $icon . '</i>';
                            }
                        }
                        $slide_html .= '</div>';
                    }
                    if ( $slide['testimonial_job'] ) {
                        $slide_html .= '<div class="elementor-testimonial-job">' . $slide['testimonial_job'] . '</div>';
                    }
                    $slide_html .= '</div>';
                }
                $slide_html .= '</div></div>';
            }
            if ( $settings['testimonial_type'] === '3' ) {
                if ( $slide['testimonial_desc'] ) {
                    $slide_html .= '<div class="elementor-testimonial-desc">' . $slide['testimonial_desc'] . '</div>';
                }
            }else{
                if ( $slide['testimonial_desc'] ) {
                    $slide_html .= '<div class="elementor-testimonial-desc">&ldquo;' . $slide['testimonial_desc'] . '&rdquo;</div>';
                }
            }
            if ( ! empty ($slide['testimonial_signature']['url'] ) ) {
                $signature_url = $slide['testimonial_signature']['url'];
                $signature_html = '<img src="' . esc_attr( $signature_url ) . '" alt="' . esc_attr(' Signature' , 'apr-core') . '" />';
                $slide_html .= '<div class="elementor-testimonial-signature">' . $signature_html . '</div>';
            }
            if($settings['on_slider'] === 'yes'){
                $class_item = 'swiper-slide';
            }else{
                $class_item = 'item-testimonial';
            }
            $slide_html =  '<' . $slide_element . ' ' . $slide_attributes . ' class="testimonial-inner">' . $slide_html . '</' . $slide_element . '>';
            $slides[] = '<div class="elementor-repeater-item-' . $slide['_id'] . ' ' . $class_item . '">' . $slide_html . '</div>';
            $slide_count++;
        }
        $slides_thumbs = [];
        $slide_count_thumb = 0;
        foreach ( $settings['slides'] as $slide_thumb ) {
            $slide_html_thumb = $slide_attributes = $class_item = '';
            $icon = '&#61445;';
            $slide_element = 'div';
            if ( $settings['testimonial_type'] === '7' ) {
                if ( $slide_thumb['testimonial_image_project']['url'] ) {
                    $image_url = $slide_thumb['testimonial_image_project']['url'];
                    $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr('Image Project' , 'apr-core') . '" />';
                    $slide_html_thumb .= '<div class="elementor-project-image">' . $image_html . '</div>';
                }
            }
            if($settings['on_slider'] === 'yes'){
                $class_item = 'swiper-slide';
            }else{
                $class_item = 'item-testimonial';
            }
            $slide_html_thumb =  '<' . $slide_element . ' ' . $slide_attributes . ' class="testimonial-inner">' . $slide_html_thumb . '</' . $slide_element . '>';
            $slides_thumbs[] = '<div class="elementor-repeater-item-' . $slide_thumb['_id'] . ' ' . $class_item . '">' . $slide_html_thumb . '</div>';
            $slide_count_thumb++;
        }
        $is_rtl = is_rtl();
        $direction = $is_rtl ? 'rtl' : 'ltr';
        $id =  'apr-testimolial-'.wp_rand();
        $loop = $autoplay = $swiper_container = $swiper_wrapper = $class_shadow = $centered_slides = $class_gallery = '';
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
            if ( $settings['testimonial_type'] === '7') {
                $class_gallery = 'gallery-top';
            }
        }else{
            $swiper_container = 'testimonial-container';
            $swiper_wrapper = 'testimonial-container-wrapper';
            if ( $settings['testimonial_type'] === '7') {
                $class_gallery = 'gallery-top-default';
            }
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
        <div id ="<?php echo esc_attr($id);?>" class="testimonial testimonial-type-<?php echo $testimonial_type;?> <?php echo $class_shadow;?>" >
            <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
                    <?php if ($settings['testimonial_type'] === '7'):?>
                        <div class=" <?php echo $swiper_container;?> gallery-thumbs" dir = "<?php echo $direction;?>">
                            <div class="<?php echo $swiper_wrapper;?>">
                                <?php echo implode( '', $slides_thumbs ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="<?php echo $swiper_container;?> <?php echo $class_gallery;?>" dir = "<?php echo $direction;?>">
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
            
            <?php if ($settings['testimonial_type'] === '7'):?>
                <script>
                    jQuery(document).ready(function($) {
                        var galleryThumbs = new Swiper('#<?php echo esc_js($id);?> .gallery-thumbs', {
                          slidesPerView: 1,
                          autoplay: <?php echo $autoplay;?>,
                          loop: <?php echo esc_attr($loop);?>,
                          freeMode: true,
                          loopedSlides: <?php echo absint( $settings['looped_slides'] );?>, //looped slides should be the same
                          watchSlidesVisibility: true,
                          watchSlidesProgress: true,
                        });
                        var galleryTop = new Swiper('#<?php echo esc_js($id);?> .gallery-top', {
                            autoplay: <?php echo $autoplay;?>,
                          loop:<?php echo esc_attr($loop);?>,
                          loopedSlides: <?php echo absint( $settings['looped_slides'] );?>, //looped slides should be the same
                          navigation: {
                            nextEl: '#<?php echo esc_js($id);?> .swiper-button-next',
                            prevEl: '#<?php echo esc_js($id);?> .swiper-button-prev',
                          },
                          pagination: {
                            el: '#<?php echo esc_js($id);?> .swiper-pagination',
                            clickable: true,
                            type: '<?php echo esc_attr( $settings['dots_type'] );?>',
                          },
                          thumbs: {
                            swiper: galleryThumbs,
                          },
                        });
                    });
                </script>
                <?php else: ?>
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
             <?php endif; ?>
        <?php
        endif;
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Testimolials );