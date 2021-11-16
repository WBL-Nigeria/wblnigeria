<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image carousel widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */
class Apr_Core_Image_Carousel extends Widget_Base {

	public function get_name()
	{
		return 'Apr_Core_Image_Carousel';
	}
	public function get_title()
	{
		return __('APR Image Carousel', 'apr-core');
	}
	public function get_categories()
	{
		return array('apr-core');
	}
	public function get_icon() {
		return 'eicon-slider-push';
	}
	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'carousel', 'slider' ];
	}

	/**
	 * Register image carousel widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => __( 'Image Carousel', 'apr-core' ),
			]
		);
		$this->add_control(
			'show_slide_2',
			array(
				'label'   => __( 'Show Slider 2', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default'   => '',
			)
		);

		$this->add_control(
			'carousel',
			[
				'label' => __( 'Add Images', 'apr-core' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'Slides to Show', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
					'6' => __( '6', 'apr-core' ),
					'7' => __( '7', 'apr-core' ),
					'8' => __( '8', 'apr-core' ),
					'9' => __( '9', 'apr-core' ),
				],
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label' => __( 'Slides to Scroll', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'apr-core' ),
				'default' => '1',
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
					'6' => __( '6', 'apr-core' ),
					'7' => __( '7', 'apr-core' ),
					'8' => __( '8', 'apr-core' ),
					'9' => __( '9', 'apr-core' ),
				]
			]
		);

        $this->add_control(
            'centered_slides',
            [
                'label' => __( 'Centered Slides', 'apr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'variable_width',
            [
                'label' => __( 'Variable Width', 'apr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );

		$this->add_control(
			'image_stretch',
			[
				'label' => __( 'Image Stretch', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => __( 'No', 'apr-core' ),
					'yes' => __( 'Yes', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'both' => __( 'Arrows and Dots', 'apr-core' ),
					'arrows' => __( 'Arrows', 'apr-core' ),
					'dots' => __( 'Dots', 'apr-core' ),
					'none' => __( 'None', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => __( 'Link', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'apr-core' ),
					'file' => __( 'Media File', 'apr-core' ),
					'custom' => __( 'Custom URL', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'apr-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => __( 'Lightbox', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'apr-core' ),
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'caption_type',
			[
				'label' => __( 'Caption', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'apr-core' ),
					'title' => __( 'Title', 'apr-core' ),
					'caption' => __( 'Caption', 'apr-core' ),
					'description' => __( 'Description', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'apr-core' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'apr-core' ),
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				]
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'apr-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				]
			]
		);

		$this->add_control(
			'effect',
			[
				'label' => __( 'Effect', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'apr-core' ),
					'fade' => __( 'Fade', 'apr-core' ),
				],
				'condition' => [
					'slides_to_show' => '1',
				]
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Animation Speed', 'apr-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => __( 'Direction', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => __( 'Left', 'apr-core' ),
					'rtl' => __( 'Right', 'apr-core' ),
				]
			]
		);

		$this->end_controls_section();
		
		// Start Content Slide 2
		
		$this->start_controls_section(
			'section_image_carousel_2',
			[
				'label' => __( 'Image Carousel Slide 2', 'apr-core' ),
				'condition' => [
					'show_slide_2' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_2',
			[
				'label' => __( 'Add Images', 'apr-core' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'medium', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'slides_to_show_2',
			[
				'label' => __( 'Slides to Show', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
					'6' => __( '6', 'apr-core' ),
					'7' => __( '7', 'apr-core' ),
					'8' => __( '8', 'apr-core' ),
					'9' => __( '9', 'apr-core' ),
				]
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll_2',
			[
				'label' => __( 'Slides to Scroll', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'apr-core' ),
				'default' => '1',
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
					'6' => __( '6', 'apr-core' ),
					'7' => __( '7', 'apr-core' ),
					'8' => __( '8', 'apr-core' ),
					'9' => __( '9', 'apr-core' ),
				]
			]
		);

		$this->add_control(
			'image_stretch_2',
			[
				'label' => __( 'Image Stretch', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => __( 'No', 'apr-core' ),
					'yes' => __( 'Yes', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'navigation_2',
			[
				'label' => __( 'Navigation', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'apr-core' ),
					'arrows' => __( 'Arrows', 'apr-core' ),
					'dots' => __( 'Dots', 'apr-core' ),
					'none' => __( 'None', 'apr-core' ),
				]
			]
		);

		$this->add_control(
			'link_to_2',
			[
				'label' => __( 'Link', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'apr-core' ),
					'file' => __( 'Media File', 'apr-core' ),
					'custom' => __( 'Custom URL', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'link_2',
			[
				'label' => __( 'Link', 'apr-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'condition' => [
					'link_to_2' => 'custom',
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'open_lightbox_2',
			[
				'label' => __( 'Lightbox', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'apr-core' ),
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				],
				'condition' => [
					'link_to_2' => 'file',
				],
			]
		);

		$this->add_control(
			'caption_type_2',
			[
				'label' => __( 'Caption', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'apr-core' ),
					'title' => __( 'Title', 'apr-core' ),
					'caption' => __( 'Caption', 'apr-core' ),
					'description' => __( 'Description', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'view_2',
			[
				'label' => __( 'View', 'apr-core' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options_2',
			[
				'label' => __( 'Additional Options Slide 2', 'apr-core' ),
				'condition' => [
					'show_slide_2' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover_2',
			[
				'label' => __( 'Pause on Hover', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				]
			]
		);

		$this->add_control(
			'autoplay_2',
			[
				'label' => __( 'Autoplay', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				]
			]
		);

		$this->add_control(
			'autoplay_speed_2',
			[
				'label' => __( 'Autoplay Speed', 'apr-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000
			]
		);

		$this->add_control(
			'infinite_2',
			[
				'label' => __( 'Infinite Loop', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'apr-core' ),
					'no' => __( 'No', 'apr-core' ),
				]
			]
		);

		$this->add_control(
			'effect_2',
			[
				'label' => __( 'Effect', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'apr-core' ),
					'fade' => __( 'Fade', 'apr-core' ),
				],
				'condition' => [
					'slides_to_scroll_2' => '1',
				]
			]
		);

		$this->add_control(
			'speed_2',
			[
				'label' => __( 'Animation Speed', 'apr-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500
			]
		);

		$this->add_control(
			'direction_2',
			[
				'label' => __( 'Direction', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => __( 'Left', 'apr-core' ),
					'rtl' => __( 'Right', 'apr-core' ),
				]
			]
		);

		$this->end_controls_section();
		
		// End Content Slide 2
		$this->start_controls_section(
			'section_content_carousel',
			[
				'label' => __( 'Content', 'apr-core' ),
			]
		);
		$this->add_control(
            'title',
            array(
                'label'       => __( 'Title', 'apr-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => array(
                    'active'  => true
                ),
                'placeholder' => __( 'Enter your title', 'apr-core' ),
                'default'     => '',
                'label_block' => true,
            )
		);
		
		$this->add_control(
            'animation_tit',
            [
                'label' => __( 'Title Animation', 'apr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => Apr_Core_Widgets::get_animation_options(),
            ]
        );
        $this->add_control(
            'transition_delay_tit',
            [
                'label' => __( 'Title Transition Delay(ms)', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
            ]
		);

		$this->add_control(
			'editor',
			[
				'label' => '',
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'apr-core' ),
			]
		);

		$this->add_control(
            'animation_des',
            [
                'label' => __( 'Description Animation', 'apr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => Apr_Core_Widgets::get_animation_options(),
            ]
        );
        $this->add_control(
            'transition_delay_des',
            [
                'label' => __( 'Description Transition Delay(ms)', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
            ]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'width_slide',
			[
				'label' => __( 'Width Content Slide 1', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
                    'unit' => '%',
                ],
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
				'selectors' => [
					'{{WRAPPER}} .apr-slide .apr-carousel' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'width_slide_2',
			[
				'label' => __( 'Width Content Slide 2', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
                    'unit' => '%',
                ],
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
				'selectors' => [
					'{{WRAPPER}} .apr-slide .apr-image-carousel-2' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
            'title_color',
            [
                'label'   => __( 'Title Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title-content h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'title_typo',
                'label' 	=> __( 'Title Typography', 'apr-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .title-content h2',
            ]
        );

        $this->add_control(
			'text_color',
			[
				'label' => __( 'Description Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selector'  => '{{WRAPPER}} .content-top .descr'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __( 'Description Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector'  => '{{WRAPPER}} .content-top .descr'
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __( 'Navigation Slide 1', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __( 'Arrows', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
				'default' => 'center',
				'options' => [
					'top' => __( 'Top', 'apr-core' ),
					'center' => __( 'Center', 'apr-core' ),
					'bottom' => __( 'Bottom', 'apr-core' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __( 'Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel.slick-slider .slick-prev:after, {{WRAPPER}} .apr-image-carousel.slick-slider .slick-next:after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel.slick-slider .slick-prev:after, {{WRAPPER}} .apr-image-carousel.slick-slider .slick-next:after' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => __( 'Dots', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __( 'Position', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'left' => __( 'Left', 'apr-core' ),
					'center' => __( 'Center', 'apr-core' ),
					'right' => __( 'Right', 'apr-core' ),
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __( 'Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel .slick-dots li button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel .elementor-image-carousel .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);
		$this->end_controls_section();
		
		// Config slider 2
		
		$this->start_controls_section(
			'section_style_navigation_2',
			[
				'label' => __( 'Navigation Slide 2', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation_2' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows_2',
			[
				'label' => __( 'Arrows', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation_2' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position_2',
			[
				'label' => __( 'Position', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'top' => __( 'Top', 'apr-core' ),
					'center' => __( 'Center', 'apr-core' ),
					'bottom' => __( 'Bottom', 'apr-core' ),
				],
				'condition' => [
					'navigation_2' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size_2',
			[
				'label' => __( 'Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .slick-slider .slick-prev:before, {{WRAPPER}} .apr-image-carousel .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation_2' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color_2',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .slick-slider .slick-prev:before, {{WRAPPER}} .apr-image-carousel .slick-slider .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation_2' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots_2',
			[
				'label' => __( 'Dots', 'apr-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation_2' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position_2',
			[
				'label' => __( 'Position', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'left' => __( 'Left', 'apr-core' ),
					'center' => __( 'Center', 'apr-core' ),
					'right' => __( 'Right', 'apr-core' ),
				],
				'condition' => [
					'navigation_2' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size_2',
			[
				'label' => __( 'Size', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .elementor-image-carousel .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation_2' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color_2',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .elementor-image-carousel .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation_2' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image Slide 1', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'apr-core' ),
					'custom' => __( 'Custom', 'apr-core' ),
				],
				'default' => '',
				'condition' => [
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_control(
			'image_spacing_custom',
			[
				'label' => __( 'Image Spacing', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],
				'show_label' => false,
				'selectors' => [
					'{{WRAPPER}} .slick-list' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slick-slide .slick-slide-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_spacing' => 'custom',
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .apr-image-carousel .slick-slide-image',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel .slick-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_image_2',
			[
				'label' => __( 'Image Slide 2', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_spacing_2',
			[
				'label' => __( 'Spacing', 'apr-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'apr-core' ),
					'custom' => __( 'Custom', 'apr-core' ),
				],
				'default' => '',
				'condition' => [
					'slides_to_show_2!' => '1',
				],
			]
		);

		$this->add_control(
			'image_spacing_custom_2',
			[
				'label' => __( 'Image Spacing', 'apr-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],
				'show_label' => false,
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .slick-list' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apr-image-carousel-2 .slick-slide .slick-slide-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_spacing_2' => 'custom',
					'slides_to_show_2!' => '1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border_2',
				'selector' => '{{WRAPPER}} .apr-image-carousel-2 .slick-slide-image',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius_2',
			[
				'label' => __( 'Border Radius', 'apr-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .slick-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label' => __( 'Caption Slide 1', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_type!' => '',
				],
			]
		);

		$this->add_control(
			'caption_align',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_text_color',
			[
				'label' => __( 'Text Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel .elementor-image-carousel-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .apr-image-carousel .elementor-image-carousel-caption',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_caption_2',
			[
				'label' => __( 'Caption Slide 2', 'apr-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_type_2!' => '',
				],
			]
		);

		$this->add_control(
			'caption_align_2',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_text_color_2',
			[
				'label' => __( 'Text Color', 'apr-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .apr-image-carousel-2 .elementor-image-carousel-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography_2',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .apr-image-carousel-2 .elementor-image-carousel-caption',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render image carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$animation_tit       =   $settings['animation_tit'];
		$transition_delay_tit=   $settings['transition_delay_tit'];
		$animation_des       =   $settings['animation_des'];
        $transition_delay_des=   $settings['transition_delay_des'];

		if ( empty( $settings['carousel'] ) ) {
			return;
		}

		$slides = [];

		foreach ( $settings['carousel'] as $index => $attachment ) {
			$image_url = Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'thumbnail', $settings );

			$image_html = '<img class="slick-slide-image" src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $attachment ) ) . '" />';

			$link = $this->get_link_url( $attachment, $settings );

			if ( $link ) {
				$link_key = 'link_' . $index;

				$this->add_render_attribute( $link_key, [
					'href' => $link['url'],
					'data-elementor-open-lightbox' => $settings['open_lightbox'],
					'data-elementor-lightbox-slideshow' => $this->get_id(),
					'data-elementor-lightbox-index' => $index,
				] );

				if ( Plugin::$instance->editor->is_edit_mode() ) {
					$this->add_render_attribute( $link_key, [
						'class' => 'elementor-clickable',
					] );
				}

				if ( ! empty( $link['is_external'] ) ) {
					$this->add_render_attribute( $link_key, 'target', '_blank' );
				}

				if ( ! empty( $link['nofollow'] ) ) {
					$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}

				$image_html = '<a ' . $this->get_render_attribute_string( $link_key ) . '>' . $image_html . '</a>';
			}

			$image_caption = $this->get_image_caption( $attachment );

			$slide_html = '<div class="img-slide"><figure class="slick-slide-inner">' . $image_html;

			if ( ! empty( $image_caption ) ) {
				$slide_html .= '<figcaption class="elementor-image-carousel-caption">' . $image_caption . '</figcaption>';
			}

			$slide_html .= '</figure></div>';

			$slides[] = $slide_html;

		}

		if ( empty( $slides ) ) {
			return;
		}

		$this->add_render_attribute( 'carousel', 'class', 'apr-carousel apr-image-carousel' );

		if ( 'none' !== $settings['navigation'] ) {
			if ( 'dots' !== $settings['navigation'] ) {
				$this->add_render_attribute( 'carousel', 'class', 'slick-arrows-' . $settings['arrows_position'] );
			}

			if ( 'arrows' !== $settings['navigation'] ) {
				$this->add_render_attribute( 'carousel', 'class', 'slick-dots-' . $settings['dots_position'] );
			}
		}

		if ( 'yes' === $settings['image_stretch'] ) {
			$this->add_render_attribute( 'carousel', 'class', 'slick-image-stretch' );
		}
		
		if('yes' === $settings['show_slide_2'] ){
			if ( empty( $settings['carousel_2'] ) ) {
				return;
			}

			$slides_2 = [];

			foreach ( $settings['carousel_2'] as $index_2 => $attachment_2 ) {
				$image_url_2 = Group_Control_Image_Size::get_attachment_image_src( $attachment_2['id'], 'medium', $settings );

				$image_html_2 = '<img class="slick-slide-image" src="' . esc_attr( $image_url_2 ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $attachment_2 ) ) . '" />';

				$link_2 = $this->get_link_url_2( $attachment_2, $settings );

				if ( $link_2 ) {
					$link_key_2 = 'link_' . $index_2;

					$this->add_render_attribute( $link_key_2, [
						'href' => $link_2['url'],
						'data-elementor-open-lightbox' => $settings['open_lightbox_2'],
						'data-elementor-lightbox-slideshow' => $this->get_id(),
						'data-elementor-lightbox-index' => $index_2,
					] );

					if ( Plugin::$instance->editor->is_edit_mode() ) {
						$this->add_render_attribute( $link_key_2, [
							'class' => 'elementor-clickable',
						] );
					}

					if ( ! empty( $link_2['is_external'] ) ) {
						$this->add_render_attribute( $link_key_2, 'target', '_blank' );
					}

					if ( ! empty( $link_2['nofollow'] ) ) {
						$this->add_render_attribute( $link_key_2, 'rel', 'nofollow' );
					}

					$image_html_2 = '<a ' . $this->get_render_attribute_string( $link_key_2 ) . '>' . $image_html_2 . '</a>';
				}

				$image_caption_2 = $this->get_image_caption_2( $attachment_2 );

				$slide_html_2 = '<div class="img-slide"><figure class="slick-slide-inner">' . $image_html_2;

				if ( ! empty( $image_caption_2 ) ) {
					$slide_html_2 .= '<figcaption class="elementor-image-carousel-caption">' . $image_caption_2 . '</figcaption>';
				}

				$slide_html_2 .= '</figure></div>';

				$slides_2[] = $slide_html_2;

			}
			
			if ( empty( $slides_2 ) ) {
				return;
			}

			$this->add_render_attribute( 'carousel_2', 'class', 'apr-image-carousel-2' );

			if ( 'none' !== $settings['navigation_2'] ) {
				if ( 'dots' !== $settings['navigation_2'] ) {
					$this->add_render_attribute( 'carousel_2', 'class', 'slick-arrows-' . $settings['arrows_position_2'] );
				}

				if ( 'arrows' !== $settings['navigation_2'] ) {
					$this->add_render_attribute( 'carousel_2', 'class', 'slick-dots-' . $settings['dots_position_2'] );
				}
			}

			if ( 'yes' === $settings['image_stretch_2'] ) {
				$this->add_render_attribute( 'carousel_2', 'class', 'slick-image-stretch' );
			}
			
		}
		$is_rtl = is_rtl();
		$direction = $is_rtl ? 'true' : 'false';
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$slides_to_scroll = $settings['slides_to_scroll'];
		$slides_to_show = $settings['slides_to_show'];
		$show_dot = $show_arr = $show_arr_2 = $show_dot_2 = 'false';
		$slides_scroll = '';
		if($slides_to_show == 1){
			$slides_scroll = 1;
		}else{
			$slides_scroll = $slides_to_scroll;
		}
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
		// Slider 2
		$show_dots_2 = ( in_array( $settings['navigation_2'], [ 'dots', 'both' ] ) );
		$show_arrows_2 = ( in_array( $settings['navigation_2'], [ 'arrows', 'both' ] ) );
		$slides_to_scroll_2 = $settings['slides_to_scroll_2'];
		$slides_to_show_2 = $settings['slides_to_show_2'];
		$slides_scroll_2 = '';
		if($slides_to_show_2 == 1){
			$slides_scroll_2 = 1;
		}else{
			$slides_scroll_2 = $slides_to_scroll_2;
		}
		if($settings['navigation_2'] == 'both'){
			$show_arr_2 = 'true';
			$show_dot_2 = 'true';
		}elseif($settings['navigation_2'] == 'arrows'){
			$show_arr_2 = 'true';
		}elseif($settings['navigation_2'] == 'dots'){
			$show_dot_2 = 'true';
		}
		if($settings['infinite_2'] == 'yes'){
			$infinite_2 = 'true';
		}else{
			$infinite_2 = 'false';
		}
		if($settings['autoplay_2'] == 'yes'){
			$autoplay_2 = 'true';
		}else{
			$autoplay_2 = 'false';
		}
		if($settings['pause_on_hover_2'] == 'yes'){
			$pauseonhover_2 = 'true';
		}else{
			$pauseonhover_2 = 'false';
		}
        if($settings['centered_slides'] === 'yes'){
            $centered_slides = 'true';
        }else{
            $centered_slides = 'false';
        }

        if($settings['variable_width'] === 'yes'){
            $variable_width = 'true';
        }else{
            $variable_width = 'false';
        }

		$navfor= '';
		if('yes' === $settings['show_slide_2'] ){
			$navfor = "'.apr-image-carousel-2'";
		}else{
			$navfor = "''";
		}
		
		$editor_content = $this->get_settings_for_display( 'editor' );

		$editor_content = $this->parse_text_editor( $editor_content );

		$transition_time = (isset($transition_delay_des)&&$transition_delay_des!=='') ? 'animation-delay:'.$transition_delay_des.'ms' : '';
		$this->add_render_attribute( 'editor', ['class'=>['descr','elementor-text-editor','elementor-clearfix','animated',$animation_des], 'style'=>$transition_time] );

		$this->add_inline_editing_attributes( 'editor', 'advanced' );

		?>
			<div class="apr-slide">
				<div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
					<?php echo implode( '', $slides ); ?>
				</div>
				<?php if('yes' === $settings['show_slide_2'] ){
					?>
						<div class="apr-carousel apr-carousel-right">
							<?php if($settings['title'] || $settings['editor']): ?>
							<div class="content-top">
								<div class="title-content <?php echo (isset($animation_tit)&&$animation_tit!=='') ? 'animated '.$animation_tit : '';?>" <?php echo (isset($transition_delay_tit)&&$transition_delay_tit!=='') ? 'style="animation-delay:'.$transition_delay_tit.'ms"' : '';?>>
									<h2><?php echo $settings['title']; ?></h2>
								</div>
								<div <?php echo $this->get_render_attribute_string( 'editor' ); ?>><?php echo $editor_content; ?></div>
							</div>
							<?php endif;?>
							<div <?php echo $this->get_render_attribute_string( 'carousel_2' ); ?>>
								<?php echo implode( '', $slides_2 ); ?>
							</div>
						</div>
					<?php
				}?>
			</div>
			<script>
				jQuery(document).ready(function($) {
					$('.apr-image-carousel').slick({
						slidesToShow: <?php echo absint( $settings['slides_to_show'] );?>,
						slidesToScroll: <?php echo esc_attr($slides_scroll);?>,
						dots: <?php echo esc_attr($show_dot);?>,
                        arrows: <?php echo esc_attr($show_arr);?>,
						nextArrow: '<button class="slick-next"><i class="theme-icon-right-arrow2"></i></button>',
						prevArrow: '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
						speed : <?php echo absint( $settings['speed'] );?>,
						infinite: <?php echo esc_attr($infinite);?>,
						autoplay: <?php echo esc_attr($autoplay);?>,
						autoplaySpeed: <?php echo absint( $settings['autoplay_speed'] );?>,
						rtl: <?php echo esc_attr($direction);?>,
						pauseOnHover: <?php echo esc_attr($pauseonhover);?>,
						focusOnSelect: true,
						asNavFor: <?php echo $navfor;?>,
                        centerMode: <?php echo $centered_slides;?>,
                        variableWidth: <?php echo $variable_width;?>,
                        centerPadding: 0,
						responsive: [
                                {
                                    breakpoint: 1025,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slides_to_show_tablet'] );?>,
                                        slidesToScroll: <?php echo absint( $settings['slides_to_scroll_tablet'] );?>
                                    }
                                },
                                {
                                    breakpoint: 768,
                                    settings: {
                                        slidesToShow: <?php echo absint( $settings['slides_to_show_mobile'] );?>,
                                        slidesToScroll: <?php echo absint( $settings['slides_to_scroll_mobile'] );?>
                                    }
                                },
								{
                                    breakpoint: 481,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                },
                            ]
					});
					<?php if('yes' === $settings['show_slide_2'] ): ?>
						$('.apr-image-carousel-2').slick({
							slidesToShow: <?php echo absint( $settings['slides_to_show_2'] );?>,
							slidesToScroll: <?php echo esc_attr($slides_scroll_2);?>,
							dots: <?php echo esc_attr($show_dot_2);?>,
							arrows: <?php echo esc_attr($show_arr_2);?>,
							nextArrow: '<button class="slick-next"><i class="theme-icon-right-arrow2"></i></button>',
							prevArrow: '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
							speed : <?php echo absint( $settings['speed_2'] );?>,
							infinite: <?php echo esc_attr($infinite_2);?>,
							autoplay: <?php echo esc_attr($autoplay_2);?>,
							autoplaySpeed: <?php echo absint( $settings['autoplay_speed_2'] );?>,
							rtl: <?php echo esc_attr($direction);?>,
							pauseOnHover: <?php echo esc_attr($pauseonhover_2);?>,
							focusOnSelect: true,
							asNavFor: '.apr-image-carousel',
							responsive: [
									{
										breakpoint: 1025,
										settings: {
											slidesToShow: <?php echo absint( $settings['slides_to_show_2_tablet'] );?>,
											slidesToScroll: <?php echo absint( $settings['slides_to_scroll_2_tablet'] );?>
										}
									},
									{
										breakpoint: 768,
										settings: {
											slidesToShow: <?php echo absint( $settings['slides_to_show_2_mobile'] );?>,
											slidesToScroll: <?php echo absint( $settings['slides_to_scroll_2_mobile'] );?>
										}
									}
								]
						});
					<?php endif; ?>
				});
			</script>
		<?php
		
	}

	/**
	 * Retrieve image carousel link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $attachment
	 * @param object $instance
	 *
	 * @return array|string|false An array/string containing the attachment URL, or false if no link.
	 */
	private function get_link_url( $attachment, $instance ) {
		if ( 'none' === $instance['link_to'] ) {
			return false;
		}

		if ( 'custom' === $instance['link_to'] ) {
			if ( empty( $instance['link']['url'] ) ) {
				return false;
			}

			return $instance['link'];
		}

		return [
			'url' => wp_get_attachment_url( $attachment['id'] ),
		];
	}
	private function get_link_url_2( $attachment_2, $instance_2 ) {
		if ( 'none' === $instance_2['link_to_2'] ) {
			return false;
		}

		if ( 'custom' === $instance_2['link_to_2'] ) {
			if ( empty( $instance_2['link']['url'] ) ) {
				return false;
			}

			return $instance_2['link'];
		}

		return [
			'url' => wp_get_attachment_url( $attachment_2['id'] ),
		];
	}

	/**
	 * Retrieve image carousel caption.
	 *
	 * @since 1.2.0
	 * @access private
	 *
	 * @param array $attachment
	 *
	 * @return string The caption of the image.
	 */
	private function get_image_caption( $attachment ) {
		$caption_type = $this->get_settings_for_display( 'caption_type' );

		if ( empty( $caption_type ) ) {
			return '';
		}

		$attachment_post = get_post( $attachment['id'] );

		if ( 'caption' === $caption_type ) {
			return $attachment_post->post_excerpt;
		}

		if ( 'title' === $caption_type ) {
			return $attachment_post->post_title;
		}

		return $attachment_post->post_content;
	}
	private function get_image_caption_2( $attachment_2 ) {
		$caption_type_2 = $this->get_settings_for_display( 'caption_type_2' );
		if ( empty( $caption_type_2 ) ) {
			return '';
		}

		$attachment_post_2 = get_post( $attachment_2['id'] );

		if ( 'caption' === $caption_type_2 ) {
			return $attachment_post_2->post_excerpt;
			echo $attachment_post_2->post_excerpt;
		}

		if ( 'title' === $caption_type_2 ) {
			return $attachment_post_2->post_title;
		}

		return $attachment_post_2->post_content;
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Image_Carousel );