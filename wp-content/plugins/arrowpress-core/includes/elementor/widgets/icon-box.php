<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class Apr_Core_Icon_Box extends Widget_Base {

	public function get_categories() {
        return array( 'apr-core' );
    }

    public function get_name() {
        return 'icon-box';
    }

    public function get_title() {
        return __( ' APR Icon Box', 'apr-core' );
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Block Icon Box', 'apr-core' ),
			]
		);

		$this->add_control(
            'icon_box_type',
            [
                'label'     =>  __( 'Icon Box Type', 'apr-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'default',
                'options'   =>  [
                	'default'   =>  __( 'Default', 'apr-core' ),
                    'type1'   =>  __( 'Icon Box Type 1', 'apr-core' ),
					'type2'   =>  __( 'Icon Box Type 2', 'apr-core' ),
                ],
            ]
        );

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'apr-core' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-star',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'apr-core' ),
					'stacked' => __( 'Stacked', 'apr-core' ),
					'framed' => __( 'Framed', 'apr-core' ),
				],
				'default' => 'default',
				'prefix_class' => 'elementor-view-',
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'apr-core' ),
					'square' => __( 'Square', 'apr-core' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
					'icon!' => '',
				],
				'prefix_class' => 'elementor-shape-',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title & Description', 'apr-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'apr-core' ),
				'placeholder' => __( 'Enter your title', 'apr-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'apr-core' ),
				'placeholder' => __( 'Enter your description', 'apr-core' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Title Link', 'apr-core' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'separator' => 'before',
			]
		);
		 $this->add_control(
            'button_text',
            [
                'label' 	=> __( 'Button Text', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Click Here', 'apr-core' ),
                'default' 	=> __( '', 'apr-core' ),
                'label_block' => true,
            ]
        );

		$this->add_control(
			'position',
			[
				'label' => __( 'Icon Position', 'apr-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'apr-core' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'apr-core' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'apr-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Title HTML Tag', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon_box',
			[
				'label' => __( 'Block Icon Box', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'apr-core' ),
				'type' => Controls_Manager::CHOOSE,
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
					'justify' => [
						'title' => __( 'Justified', 'apr-core' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'content_padding_top',
            [
                'label' => __( 'Padding top', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'default'    => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content-padding-bottom',
            [
                'label'      => __( 'Padding bottom', 'apr-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .elementor-icon-box-wrapper' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'tt_box_bg_color',
            [
                'label' 	=> __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'box_bg_color',
                'label'     => __( 'Background Color', 'apr-core' ),
                'types'     => [ 'classic', 'gradient' ],
                 'selector'  => '{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper',
            ]
        );
         $this->add_control(
            'tt_box_hover_bg_color',
            [
                'label' 	=> __( 'Background Hover Color', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'box_hover_bg_color',
                'label'     => __( 'Background Hover Color', 'apr-core' ),
                'types'     => [ 'classic', 'gradient' ],
                 'selector'  => '{{WRAPPER}} .elementor-icon-box-wrapper:hover,{{WRAPPER}} .elementor-icon-box-wrapper.type1:hover',
            ]
        );
      
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_box',
				'label'     => __( 'Box Shadow', 'apr-core' ),
				'selector' => '{{WRAPPER}} .elementor-icon-box-wrapper:not(.type2)',
				'separator' => 'before',
				'condition' => [
					'icon_box_type!' => 'type2',
				],
			]
		);

		 $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_box_hover',
				'label'     => __( 'Box Shawdow Hover', 'apr-core' ),
				'selector' => '{{WRAPPER}} .elementor-icon-box-wrapper:not(.type2):hover',
				'separator' => 'before',
				'condition' => [
					'icon_box_type!' => 'type2',
				],
			]
		);

        $this->add_responsive_control(
			'block_icon_min_height',
			[
				'label' => __( 'Min Height', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);
        $this->add_control(
            'bg_img-icon',
            [
                'label' => _x( 'Background Image', 'Background Control', 'apr-core' ),
                'type' => Controls_Manager::MEDIA,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-icon' => 'background-image: url({{URL}})',
                ],
            ]
        );
		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, 
					 {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-default.elementor-widget-icon-box .elementor-icon-box-wrapper:not(.type2):hover .elementor-icon-box-icon .elementor-icon,
					{{WRAPPER}}.elementor-view-stacked.elementor-widget-icon-box .elementor-icon-box-wrapper:not(.type2):hover .elementor-icon-box-icon .elementor-icon' =>'color: {{VALUE}};', 
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'apr-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Bottom Spacing', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_animation',
			[
				'label' => __( 'Cancel Animation', 'apr-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'apr-core' ),
				'label_off' => __( 'NO', 'apr-core' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon:before' => 'animation: {{Option}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_min_width',
			[
				'label' => __( 'Min Width', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon' => 'min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before' => 'width: calc({{SIZE}}{{UNIT}} + 3{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'icon_min_height',
			[
				'label' => __( 'Min Height', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-box-icon' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before' => 'height: calc({{SIZE}}{{UNIT}} + 4{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'icon_line_height',
			[
				'label' => __( 'Line Height', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

        $this->add_control(
            'left_icon',
            [
                'label' => __( 'Left', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'heading_icon_after',
			[
				'label' => __( 'Icon After', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['default','type1'],
				],
			]
		);

		$this->add_responsive_control(
			'icon_after_size',
			[
				'label' => __( 'Icon After Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon:after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['default','type1'],
				],
			]
		);


		$this->start_controls_tabs( 'icon_after_colors' );

		$this->start_controls_tab(
			'icon_after_colors_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
				'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['default','type1','type2'],
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_after_color',
                'label'     => __( 'Icon After Color', 'apr-core' ),
                'types'     => ['gradient' ],
                'selector'  => '{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper .elementor-icon-box-icon:after',
                'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['default','type1'],
				],
            ]
		);
		
		$this->add_control(
			'icon_box_border_solid_color',
            [
                'label'     => __( 'Icon Box Border Solid Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors'  => [
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before' => 'border-color: {{VALUE}}'
				],
                'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['type2'],
				],
            ]
        );
		$this->add_control(
			'icon_box_bordercolor',
            [
                'label'     => __( 'Icon Box Border Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors'  => [
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon' => 'border-color: {{VALUE}}'
				],
                'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['type2'],
				],
            ]
        );
		$this->add_control(
			'icon_after_bordercolor',
            [
                'label'     => __( 'Icon Box Inner Border Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors'  => [
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:after' => 'border-color: {{VALUE}}'
				],
                'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['type2'],
				],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_after_colors_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
				'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['default','type1','type2'],
				],
			]
		);
		 $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_after_color_hover',
                'label'     => __( 'Icon After Hover Color', 'apr-core' ),
                'types'     => ['gradient' ],
                'selector'  => '{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper:hover .elementor-icon-box-icon:after',
                'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['default','type1'],
				],
            ]
        );

		$this->add_control(
			'hover_after_animation',
			[
				'label' => __( 'Hover Animation', 'apr-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['default','type1'],
				],
			]
		);

		$this->add_control(
			'icon_box_hover_bordercolor',
            [
                'label'     => __( 'Icon Box Hover Border Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors'  => [
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:hover' => 'border-color: {{VALUE}}'
				],
                'condition' =>[
					'icon!' => '',
					'icon_box_type' => ['type2'],
				],
            ]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' =>[
					'title_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' =>[
					'title_text!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'condition' =>[
					'title_text!' => '',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Color Hover', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title:hover,
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'condition' =>[
					'title_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'condition' =>[
					'title_text!' => '',
				],
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' =>[
					'description_text!' => '',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' =>[
					'description_text!' => '',
				],
			]
		);

		$this->add_control(
			'description_hover_color',
			[
				'label' => __( 'Hover Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'condition' =>[
					'description_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'condition' =>[
					'description_text!' => '',
				],
			]
		);

		$this->add_control(
			'heading_button',
			[
				'label' => __( 'Button', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'button_text!' => '',
                ],
			]
		);

		$this->add_responsive_control(
			'button_top_space',
			[
				'label' => __( 'Top Spacing', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-icon-box .box-reading' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'button_text!' => '',
                ],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .box-reading a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'condition' => [
                    'button_text!' => '',
                ],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Hover Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper:hover .box-reading a, {{WRAPPER}} .elementor-icon-box-wrapper .box-reading a:hover' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
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
				'selector' => '{{WRAPPER}} .box-reading a',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'condition' => [
                    'button_text!' => '',
                ],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';
		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );
		$icon_box_type = $settings['icon_box_type'];	
		if($icon_box_type ==='type1'){
			$icon_box_class = "type1";
		} elseif ($icon_box_type ==='type2'){
			$icon_box_class = "type2";
		} else {
			$icon_box_class = "";
		}
		$text_align = $settings['text_align'];
		$text_align_class = 'align-left';
		if($text_align ==='left'){
			$text_align_class = "align-left";
		} elseif ($text_align ==='right'){
			$text_align_class = "align-right";
		} elseif ($text_align ==='justify'){
			$text_align_class = "align-justify";
		} else{
			$text_align_class = "align-center";
		}
		$this->add_render_attribute( 'description_text', 'class', 'elementor-icon-box-description' );
		$this->add_inline_editing_attributes( 'title_text', 'none' );
		$this->add_inline_editing_attributes( 'description_text' );
		?>
		<div class="elementor-icon-box-wrapper <?php echo esc_attr( $text_align_class ); ?> <?php echo esc_attr($icon_box_class); ?>">
		<?php if ( $has_icon ) : ?>
			<div class="elementor-icon-box-icon">
				<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
				<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
				</<?php echo $icon_tag; ?>>
			</div>
			<?php endif; ?>
			<div class="elementor-icon-box-content">
				<<?php echo $settings['title_size']; ?> class="elementor-icon-box-title icon-box-title-overflow">
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
				</<?php echo $settings['title_size']; ?>>
				<p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $settings['description_text']; ?></p>
				<?php if ( ! empty( $settings['button_text'] ) ) : ?>
					<div class="box-reading">
						<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'button_text' ); ?>><?php echo $settings['button_text']; ?></<?php echo $icon_tag; ?>>
					</div>
				<?php endif;?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render icon box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
			iconTag = link ? 'a' : 'span';

		view.addRenderAttribute( 'description_text', 'class', 'elementor-icon-box-description' );

		view.addInlineEditingAttributes( 'title_text', 'none' );
		view.addInlineEditingAttributes( 'description_text' );
		#>
		<div class="elementor-icon-box-wrapper {{ settings.icon_box_type }}">
			<# if ( settings.icon ) { #>
			<div class="elementor-icon-box-icon">
				<{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
				<i class="{{ settings.icon }}" aria-hidden="true"></i>
			</{{{ iconTag }}}>
		</div>
			<# } #>
			<div class="elementor-icon-box-content">
				<{{{ settings.title_size }}} class="elementor-icon-box-title icon-box-title-overflow">
					<{{{ iconTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
				</{{{ settings.title_size }}}>
				<p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Icon_Box );