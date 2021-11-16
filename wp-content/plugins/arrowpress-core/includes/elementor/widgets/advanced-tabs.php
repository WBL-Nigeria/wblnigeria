<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Apr_Core_Widget_Advanced_Tabs extends Widget_Base {

	public function get_name() {
		return 'apr-adv-tabs';
	}

	public function get_title() {
		return esc_html__( 'APR Advanced Tabs', 'apr-core' );
	}

	public function get_script_depends() {
        return [
            'apr-scripts'
        ];
    }

	public function get_icon() {
		return 'eicon-tabs';
	}

   public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function _register_controls() {
		/**
  		 * Advance Tabs Settings
  		 */
  		$this->start_controls_section(
  			'apr_section_adv_tabs_settings',
  			[
  				'label' => esc_html__( 'General Settings', 'apr-core' )
  			]
  		);
		$this->add_control(
		  'apr_adv_tab_layout',
		  	[
		   	'label'       	=> esc_html__( 'Layout', 'apr-core' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'apr-tabs-horizontal',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'apr-tabs-horizontal' => esc_html__( 'Horizontal', 'apr-core' ),
		     		'apr-tabs-vertical' => esc_html__( 'Vertical', 'apr-core' ),
		     	],
		  	]
		);
		$this->add_responsive_control(
            'apr_adv_tab_height',
            [
                'label' => __( 'Height', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1500,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'px', 'vh', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .apr-tabs-nav ul' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .apr-tabs-content .tabs-content' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
				'condition' => [
                    'apr_adv_tab_layout' => 'apr-tabs-vertical',
                ],
            ]
        );

        $this->add_control(
            'horizontal_text',
            [
                'label' => __( 'Title Text', 'apr-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '', 'apr-core' ),
                'placeholder'     => 'Enter your title',
                'condition' => [
                    'apr_adv_tab_layout' => 'apr-tabs-horizontal',
                ],
            ]
        );
		$this->add_control(
		  'apr_adv_tab_type',
		  	[
		   	'label'       	=> esc_html__( 'Type', 'apr-core' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'apr-tabs-type-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'apr-tabs-type-1' => esc_html__( 'Align Left', 'apr-core' ),
		     		'apr-tabs-type-2' => esc_html__( 'Align Right', 'apr-core' ),
		     		'apr-tabs-type-3' => esc_html__( 'Align Center', 'apr-core' ),
		     	],
				'condition' => [
					'apr_adv_tab_layout' => 'apr-tabs-horizontal',
				],
		  	]
		);
		$this->add_control(
			'apr_adv_tabs_icon_show',
			[
				'label' => esc_html__( 'Enable Icon', 'apr-core' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
		  'apr_adv_tab_icon_position',
		  	[
		   	'label'       	=> esc_html__( 'Icon Position', 'apr-core' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'apr-tab-inline-icon',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'apr-tab-top-icon' => esc_html__( 'Stacked', 'apr-core' ),
		     		'apr-tab-inline-icon' => esc_html__( 'Inline', 'apr-core' ),
		     	],
		     	'condition' => [
		     		'apr_adv_tabs_icon_show' => 'yes'
		     	]
		  	]
		);
  		$this->end_controls_section();

  		/**
  		 * Advance Tabs Content Settings
  		 */
  		$this->start_controls_section(
  			'apr_section_adv_tabs_content_settings',
  			[
  				'label' => esc_html__( 'Content', 'apr-core' )
  			]
  		);
  		$this->add_control(
			'apr_adv_tabs_tab',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'apr_adv_tabs_tab_title' => esc_html__( 'Tab 1', 'apr-core' ) ],
					[ 'apr_adv_tabs_tab_title' => esc_html__( 'Tab 2', 'apr-core' ) ],
					[ 'apr_adv_tabs_tab_title' => esc_html__( 'Tab 3', 'apr-core' ) ],
				],
				'fields' => [
					[
						'name' => 'apr_adv_tabs_tab_show_as_default',
						'label' => __( 'Set as Default', 'apr-core' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'inactive',
						'return_value' => 'active-default',
				  	],
                    [
						'name'        => 'apr_adv_tabs_icon_type',
						'label'       => esc_html__( 'Icon Type', 'apr-core' ),
                        'type'        => Controls_Manager::CHOOSE,
                        'label_block' => false,
                        'options'     => [
                            'none' => [
                                'title' => esc_html__( 'None', 'apr-core' ),
                                'icon'  => 'fa fa-ban',
                            ],
                            'icon' => [
                                'title' => esc_html__( 'Icon', 'apr-core' ),
                                'icon'  => 'fa fa-gear',
                            ],
                            'image' => [
                                'title' => esc_html__( 'Image', 'apr-core' ),
                                'icon'  => 'fa fa-picture-o',
                            ],
                        ],
                        'default'       => 'icon',
					],
					[
						'name' => 'apr_adv_tabs_tab_title_icon',
						'label' => esc_html__( 'Icon', 'apr-core' ),
						'type' => Controls_Manager::ICON,
						'default' => '',
						'condition' => [
							'apr_adv_tabs_icon_type' => 'icon'
						]
					],
					[
						'name' => 'apr_adv_tabs_tab_title_image',
						'label' => esc_html__( 'Image', 'apr-core' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'apr_adv_tabs_icon_type' => 'image'
						]
					],
					[
						'name' => 'apr_adv_tabs_tab_title',
						'label' => esc_html__( 'Tab Title', 'apr-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Tab Title', 'apr-core' ),
						'dynamic' => [ 'active' => true ]
					],
					[
						'name' => 'apr_adv_number_tab',
						'label' => esc_html__( 'Number Tab', 'apr-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'dynamic' => [ 'active' => true ]
					],
					[
		                'name'					=> 'apr_adv_tabs_text_type',
		                'label'                 => __( 'Content Type', 'apr-core' ),
		                'type'                  => Controls_Manager::SELECT,
		                'options'               => [
		                    'content'       => __( 'Content', 'apr-core' ),
		                    'template'      => __( 'Saved Templates', 'apr-core' ),
		                ],
		                'default'               => 'content',
		            ],
		            [
		                'name'					=> 'apr_primary_templates',
		                'label'                 => __( 'Choose Template', 'apr-core' ),
		                'type'                  => Controls_Manager::SELECT,
		                'options'               => apr_core_get_page_templates(),
						'condition'             => [
							'apr_adv_tabs_text_type'      => 'template',
						],
		            ],
				  	[
						'name' => 'apr_adv_tabs_tab_content',
						'label' => esc_html__( 'Tab Content', 'apr-core' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'apr-core' ),
						'dynamic' => [ 'active' => true ],
						'condition'             => [
							'apr_adv_tabs_text_type'      => 'content',
						],
					],
				],
				'title_field' => '{{apr_adv_tabs_tab_title}}',
			]
		);
  		$this->end_controls_section();
  		
  		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_style_settings',
			[
				'label' => esc_html__( 'General', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_padding',
			[
				'label' => esc_html__( 'Padding', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .apr-advance-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_margin',
			[
				'label' => esc_html__( 'Margin', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .apr-advance-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'apr_adv_tabs_border',
				'label' => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-advance-tabs',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .apr-advance-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'apr_adv_tabs_box_shadow',
				'selector' => '{{WRAPPER}} .apr-advance-tabs',
			]
		);
  		$this->end_controls_section();
  		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_tab_style_settings',
			[
				'label' => esc_html__( 'Tab Title', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'apr_adv_tabs_tab_title_typography',
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_title_width',
			[
				'label' => __( 'Title Min Width', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav > ul' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'apr_adv_tab_layout' => 'apr-tabs-vertical'
				]
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_icon_size',
			[
				'label' => __( 'Icon Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 16,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li img' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_icon_gap',
			[
				'label' => __( 'Icon Gap', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .apr-tab-inline-icon li i, {{WRAPPER}} .apr-tab-inline-icon li img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apr-tab-top-icon li i, {{WRAPPER}} .apr-tab-top-icon li img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_padding',
			[
				'label' => esc_html__( 'Padding', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_margin',
			[
				'label' => esc_html__( 'Margin', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->start_controls_tabs( 'apr_adv_tabs_header_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'apr_adv_tabs_header_normal', [ 'label' => esc_html__( 'Normal', 'apr-core' ) ] );
				$this->add_control(
					'apr_adv_tabs_tab_color',
					[
						'label' => esc_html__( 'Tab Background Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'apr_adv_tabs_tab_text_color',
					[
						'label' => esc_html__( 'Text Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'apr_adv_tabs_tab_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li i' => 'color: {{VALUE}};',
						],
						'condition' => [
							'apr_adv_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'apr_adv_tabs_tab_border',
						'label' => esc_html__( 'Border', 'apr-core' ),
						'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li',
					]
				);
				$this->add_responsive_control(
					'apr_adv_tabs_tab_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'apr-core' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
			 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();
			// Hover State Tab
			$this->start_controls_tab( 'apr_adv_tabs_header_hover', [ 'label' => esc_html__( 'Hover', 'apr-core' ) ] );
				$this->add_control(
					'apr_adv_tabs_tab_color_hover',
					[
						'label' => esc_html__( 'Tab Background Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'apr_adv_tabs_tab_text_color_hover',
					[
						'label' => esc_html__( 'Text Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'apr_adv_tabs_tab_icon_color_hover',
					[
						'label' => esc_html__( 'Icon Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li:hover .fa' => 'color: {{VALUE}};',
						],
						'condition' => [
							'apr_adv_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'apr_adv_tabs_tab_border_hover',
						'label' => esc_html__( 'Border', 'apr-core' ),
						'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li:hover',
					]
				);
				$this->add_responsive_control(
					'apr_adv_tabs_tab_border_radius_hover',
					[
						'label' => esc_html__( 'Border Radius', 'apr-core' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
			 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();
			// Active State Tab
			$this->start_controls_tab( 'apr_adv_tabs_header_active', [ 'label' => esc_html__( 'Active', 'apr-core' ) ] );
				$this->add_control(
					'apr_adv_tabs_tab_color_active',
					[
						'label' => esc_html__( 'Tab Background Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active-default' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'apr_adv_tabs_tab_text_color_active',
					[
						'label' => esc_html__( 'Text Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active' => 'color: {{VALUE}};',
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active-deafult' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'apr_adv_tabs_tab_icon_color_active',
					[
						'label' => esc_html__( 'Icon Color', 'apr-core' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active .fa' => 'color: {{VALUE}};',
							'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active-default .fa' => 'color: {{VALUE}};',
						],
						'condition' => [
							'apr_adv_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'apr_adv_tabs_tab_border_active',
						'label' => esc_html__( 'Border', 'apr-core' ),
						'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active, {{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active-default',
					]
				);
				$this->add_responsive_control(
					'apr_adv_tabs_tab_border_radius_active',
					[
						'label' => esc_html__( 'Border Radius', 'apr-core' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
			 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li.active-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_tab_content_style_settings',
			[
				'label' => esc_html__( 'Content', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'adv_tabs_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'adv_tabs_content_text_color',
			[
				'label' => esc_html__( 'Text Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div, .apr-advance-tabs .apr-tabs-content > div p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'apr_adv_tabs_content_typography',
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_content_padding',
			[
				'label' => esc_html__( 'Padding', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_content_margin',
			[
				'label' => esc_html__( 'Margin', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'apr_adv_tabs_content_border',
				'label' => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'apr_adv_tabs_content_shadow',
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div',
				'separator' => 'before'
			]
		);
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Caret Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_tab_caret_style_settings',
			[
				'label' => esc_html__( 'Caret', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_caret_show',
			[
				'label' => esc_html__( 'Show Caret on Active Tab', 'apr-core' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_caret_size',
			[
				'label' => esc_html__( 'Caret Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li:after' => 'border-width: {{SIZE}}px; bottom: -{{SIZE}}px',
					'{{WRAPPER}} .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav > ul li:after' => 'right: -{{SIZE}}px; top: calc(50% - {{SIZE}}px) !important;',
				],
				'condition' => [
					'apr_adv_tabs_tab_caret_show' => 'yes'
				]
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_caret_color',
			[
				'label' => esc_html__( 'Caret Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul li:after' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav > ul li:after' => 'border-top-color: transparent; border-left-color: {{VALUE}};',
				],
				'condition' => [
					'apr_adv_tabs_tab_caret_show' => 'yes'
				]
			]
		);
  		$this->end_controls_section();
	}

	protected function render() {

   		$settings = $this->get_settings_for_display();
   		$apr_find_default_tab = array();
   		$apr_adv_tab_id = 1;
		$apr_adv_tab_content_id = 1;
		   
		$this->add_render_attribute(
			'apr_tab_wrapper',
			[
				'id'				=> "apr-advance-tabs-{$this->get_id()}",
				'class'				=> [ 'apr-advance-tabs', $settings['apr_adv_tab_layout'], $settings['apr_adv_tab_type'] ],
				'data-tabid'		=> $this->get_id()
			]
		);
		if($settings['apr_adv_tabs_tab_caret_show'] != 'yes')
			$this->add_render_attribute('apr_tab_wrapper', 'class', 'active-caret-on');

		$this->add_render_attribute( 'apr_tab_icon_position', 'class', esc_attr($settings['apr_adv_tab_icon_position']) );
	?>
	<div <?php echo $this->get_render_attribute_string('apr_tab_wrapper'); ?>>
  		<div class="apr-tabs-nav">
            <?php if ($settings['horizontal_text'] != '') {?>
            <h3 class="horizontal-title"><?php echo $settings['horizontal_text'] ?></h3>
            <?php }$settings['horizontal_text'] ?>
			<ul <?php echo $this->get_render_attribute_string('apr_tab_icon_position'); ?>>
				<?php foreach( $settings['apr_adv_tabs_tab'] as $tab ) : ?>
					<li class="<?php echo esc_attr( $tab['apr_adv_tabs_tab_show_as_default'] ); ?>"><?php if( $settings['apr_adv_tabs_icon_show'] === 'yes' ) : 
							if( $tab['apr_adv_tabs_icon_type'] === 'icon' ) : ?>
								<i class="<?php echo esc_attr( $tab['apr_adv_tabs_tab_title_icon'] ); ?>"></i>
							<?php elseif( $tab['apr_adv_tabs_icon_type'] === 'image' ) : ?>
								<img src="<?php echo esc_attr( $tab['apr_adv_tabs_tab_title_image']['url'] ); ?>">
							<?php endif; ?>
					<?php endif; ?> <span class="apr-tab-title"><?php echo $tab['apr_adv_tabs_tab_title']; ?></span>
                        <span class="number-tab"><?php echo $tab['apr_adv_number_tab']; ?></span>
                    </li>
				<?php endforeach; ?>
    		</ul>
  		</div>
  		<div class="apr-tabs-content">
			<?php foreach( $settings['apr_adv_tabs_tab'] as $tab ) : $apr_find_default_tab[] = $tab['apr_adv_tabs_tab_show_as_default'];?>
				<div class="clearfix tabs-content <?php if($settings['apr_adv_tab_height'] != ''){echo 'tabs-scroll';} ?> <?php echo esc_attr( $tab['apr_adv_tabs_tab_show_as_default'] ); ?>">
					<div class="tabs-content-adv">
						<?php if( 'content' == $tab['apr_adv_tabs_text_type'] ) : ?>
							<?php echo do_shortcode( $tab['apr_adv_tabs_tab_content'] ); ?>
						<?php elseif( 'template' == $tab['apr_adv_tabs_text_type'] ) : ?>
							<?php
								if ( !empty( $tab['apr_primary_templates'] ) ) {
									$apr_template_id = $tab['apr_primary_templates'];
									$apr_frontend = new Frontend;
									echo $apr_frontend->get_builder_content( $apr_template_id, true );
								}
							?>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
	}

	protected function content_template() {}
}


Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Widget_Advanced_Tabs() );