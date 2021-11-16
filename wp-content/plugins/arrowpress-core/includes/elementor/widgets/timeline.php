<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Apr_Core_Timeline extends Widget_Base {

    public function get_categories() {
        return array( 'apr-core' );
    }

    public function get_name() {
        return 'apr-timeline';
    }

    public function get_title() {
        return __( ' APR Timeline', 'apr-core' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    protected function _register_controls() {

        $this->start_controls_section(
			'section_timeline',
			[
				'label' => __( 'APR Timeline', 'elementor' ),
			]
		);

		$this->add_control(
			'timeline_type',
            [
                'label'     =>  __( 'Timeline Type', 'apr-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'type1',
                'options'   =>  [
                    'type1'   =>  __( 'Type 1', 'apr-core' ),
                    'type2'   =>  __( 'Type 2', 'apr-core' ),
                ],
            ]
		);
		
		$this->add_control(
            'section_timeline_heading',
            [
                'label' 	=> __( 'Heading', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'timeline_type' =>[  'type1' ],
                ],
            ]
        );
		$this->add_control(
            'date_heading',
            [
                'label' 	=> __( 'Date Heading', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'placeholder' => __( '2013 - 2015', 'apr-core' ),
                'default' 	=> __( '2013 - 2015', 'apr-core' ),
                'condition' => [
                    'timeline_type' =>[  'type1' ],
                ],
            ]
        );
		$this->add_control(
            'heading',
            [
                'label' 	=> __( 'Title', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'placeholder' => __( 'I am title', 'apr-core' ),
                'default' 	=> __( '', 'apr-core' ),
                'condition' => [
                    'timeline_type' =>[  'type1' ],
                ],
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label' 	=> __( 'Description Heading', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default' 	=>  __( '', 'apr-core' ),
                'condition' => [
                    'timeline_type' =>[  'type1' ],
                ],
            ]
        );


		$this->add_control(
            'section_timeline_heading_list',
            [
                'label' 	=> __( 'List Timeline', 'apr-core' ),
                'type' => Controls_Manager::HEADING,
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
			'date_timeline',
			[
				'label' => __( 'Date Timeline', 'elementor' ),
                'description' => __( 'Used when "Timeline Type" = "Type1"', 'apr-core' ),
				'type' => Controls_Manager::TEXT ,
				'label_block' => true,
				
			]
		);

		$repeater->add_control(
			'desc_timeline',
			[
				'label' => __( 'Description Timeline', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => '',
			]
		);

		 $repeater->add_control(
            'class_item',
            [
                'label' 	=> __( 'Class', 'apr-core' ),
                'type' 		=> Controls_Manager::TEXT,
                'default' 	=> '',
            ]
        );
		$this->add_control(
			'timeline_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'item_text' => __( 'List Item #1', 'elementor' ),
					],
					[
						'item_text' => __( 'List Item #2', 'elementor' ),
					],
					[
						'item_text' => __( 'List Item #3', 'elementor' ),
					],
				],
				'title_field' => '{{{ item_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_timeline',
			[
				'label' => __( 'Timeline', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_style',
			[
				'label' => __( 'Heading', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' =>[
					'timeline_type' => ['type1'],
				],
			]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'header_bg_color',
                'label'     => __('Background Header Color', 'apr-core' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .elementor-timeline .elementor-timeline-top .elementor-timeline_header',
				'condition' =>[
					'timeline_type' => ['type1'],
				],
            ]
        );
		$this->add_control(
			'header_color',
			[
				'label' => __( 'Header Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-timeline .elementor-timeline-top .elementor-timeline_header .elementor-timeline-heading,
					{{WRAPPER}} .elementor-timeline .elementor-timeline-top .elementor-timeline_header' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'condition' =>[
					'timeline_type' => ['type1'],
				],
			]
		);
		$this->add_control(
			'header_desc_color',
			[
				'label' => __( 'Header Description Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-timeline .elementor-timeline-top .elementor-timeline-heading-desc' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'condition' =>[
					'timeline_type' => ['type1'],
				],
			]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'header_bg_hover_color',
                'label'     => __( 'Background Header Color', 'apr-core' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .elementor-timeline .elementor-timeline-top .elementor-timeline_header:hover',
				'condition' =>[
					'timeline_type' => ['type1'],
				],
            ]
        );
		 $this->add_control(
			'list_timeline_style',
			[
				'label' => __( 'List Timeline', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-timeline .elementor-timeline-inner-content .elementor-timeline-title,
					{{WRAPPER}} .elementor-timeline.type2 .elementor-timeline-inner-content .elementor-timeline-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Color Hover', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-timeline .elementor-timeline-inner:hover .elementor-timeline-inner-content .elementor-timeline-title,
					{{WRAPPER}} .elementor-timeline.type2 .elementor-timeline-inner:hover .elementor-timeline-inner-content .elementor-timeline-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'apr-core' ),
				'selector' => '{{WRAPPER}} .elementor-timeline .elementor-timeline-inner-content .elementor-timeline-title,
								{{WRAPPER}} .elementor-timeline.type2 .elementor-timeline-inner-content .elementor-timeline-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-timeline .elementor-timeline-inner-content .elementor-timeline-desc,
					{{WRAPPER}} .elementor-timeline.type2 .elementor-timeline-inner-content .elementor-timeline-desc' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Description Typography', 'apr-core' ),
				'selector' => '{{WRAPPER}} .elementor-timeline .elementor-timeline-inner-content .elementor-timeline-desc,
					{{WRAPPER}} .elementor-timeline.type2 .elementor-timeline-inner-content .elementor-timeline-desc',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings();
        $timeline_type  =   $settings['timeline_type'];
       	$this->add_render_attribute( 'heading', 'class', 'elementor-timeline-heading' );
        $this->add_render_attribute( 'date_heading', 'class', 'elementor-timeline-heading-date' );
        $this->add_render_attribute( 'desc_heading', 'class', 'elementor-timeline-heading-desc' );
        $this->add_render_attribute( 'number_timeline', 'class', 'elementor-timeline-number' );
        $this->add_render_attribute( 'date_timeline', 'class', 'elementor-timeline-date' );
        $this->add_render_attribute( 'desc_timeline', 'class', 'elementor-timeline-desc' );
        $this->add_render_attribute( 'item_text', 'class', 'elementor-timeline-title' );

        $this->add_inline_editing_attributes( 'heading', 'none' );
        $this->add_inline_editing_attributes( 'desc_heading', 'none' );
        $this->add_inline_editing_attributes( 'item_text', 'none' );
        $this->add_inline_editing_attributes( 'desc_timeline', 'none' );

        ?>

        <div class="elementor-timeline <?php if($timeline_type ==='type1'){echo 'type1';}?> <?php if($timeline_type ==='type2'){echo 'type2';}?>">
            <div class="elementor-timeline-top">
                <?php if ( $settings['heading']): ?> 
                    <div class="elementor-timeline_header">
                    	<?php if ( ! empty( $settings['date_heading'] ) ) : ?>
                            <span <?php echo $this->get_render_attribute_string( 'date_heading' ); ?>>
                            	<?php echo $settings['date_heading']; ?>
                            </span>
                        <?php endif; ?>
                        <?php if ( ! empty( $settings['heading'] ) ) : ?>
                            <h3 <?php echo $this->get_render_attribute_string( 'heading' ); ?>>
                            	<?php echo $settings['heading']; ?>
                            </h3>
                        <?php endif; ?>
                    </div>
                <?php endif;?>
                <?php if ( ! empty( $settings['desc_heading'] ) ) : ?>
                    <div <?php echo $this->get_render_attribute_string( 'desc_heading' ); ?>><?php echo $settings['desc_heading']; ?></div>
                <?php endif; ?>
            </div>
            <div class="elementor-timeline-content">
                <ul class="elementor-timeline-list">
                    <?php foreach ( $settings['timeline_list'] as $index => $item ) :
                        $repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'timeline_list', $index );
                        $this->add_inline_editing_attributes( $repeater_setting_key );
                        ?>
                        <li class="elementor-repeater-item-<?php echo $item['_id']; ?> <?php echo $item['class_item']; ?>">
                            <div class="elementor-timeline-inner">
                            	<?php if ( ! empty( $item['date_timeline'] ) ) : ?>
                                    <div <?php echo $this->get_render_attribute_string( 'date_timeline' ); ?>>
                                        <?php echo $item['date_timeline']; ?>
                                    </div>
                                <?php endif;?>
                        	 	<div class="elementor-timeline-inner-content ">
	                                <?php if ( ! empty( $item['item_text'] ) ) : ?>
	                                    <h2 <?php echo $this->get_render_attribute_string( 'item_text' ); ?>>
	                                        <?php echo $item['item_text']; ?>
	                                    </h2>
	                                <?php endif; ?>
	                                <?php if ( ! empty( $item['desc_timeline'] ) ) : ?>
	                                    <div <?php echo $this->get_render_attribute_string( 'desc_timeline' ); ?>>
	                                        <?php echo $item['desc_timeline']; ?>
	                                    </div>
	                                <?php endif;?>
	                            </div>
                                <?php if ( ! empty( $item['number_timeline'] ) ) : ?>
                                    <div <?php echo $this->get_render_attribute_string( 'number_timeline' ); ?>>
                                        <?php echo $item['number_timeline']; ?>
                                    </div>
                                <?php endif;?>
                                 
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
		</div>
        <?php 
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Timeline );