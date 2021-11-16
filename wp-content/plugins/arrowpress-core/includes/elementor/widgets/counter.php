<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
class Apr_Core_Counter extends Widget_Base {
    public function get_categories() {
        return array( 'apr-core' );
    }
    /**
     * Get widget name.
     *
     * Retrieve counter widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'apr_counter';
    }
    /**
     * Get widget title.
     *
     * Retrieve counter widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'APR Counter', 'apr-core' );
    }
    /**
     * Get widget icon.
     *
     * Retrieve counter widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-counter-circle';
    }
    
    /**
     * Register counter widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_counter',
            [
                'label' => __( 'APR Counter', 'apr-core' ),
            ]
        );
        $this->add_control(
            'counter_type',
            [
                'label'     =>  __( 'Counter type', 'apr-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'type2',
                'options'   =>  [
                    'type1'   =>  __( 'Type 1', 'apr-core' ),
                    'type2'   =>  __( 'Type 2', 'apr-core' ),
                ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'counter_starting_number',
            [
                'label' => __( 'Starting Number', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'dynamic'   => [
                    'active'    => true,
                ],
            ]
        );
        $repeater->add_control(
            'counter_ending_number',
            [
                'label' => __( 'Ending Number', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );
        $repeater->add_control(
            'counter_prefix',
            [
                'label' => __( 'Number Prefix', 'apr-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => 1,
                'dynamic'   => [
                    'active'    => true,
                ],
            ]
        );
        $repeater->add_control(
            'counter_suffix',
            [
                'label' => __( 'Number Suffix', 'apr-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __( 'Plus', 'apr-core' ),
            ]
        );
        $repeater->add_control(
            'counter_title',
            [
                'label'     => __( 'Title', 'apr-core' ),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active'    => false,
                ],
                'default'   => 'Cool Number',
            ]
        );
        $this->add_control(
            'slides',
            [
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'counter_title'      => __( 'Cool Number', 'apr-core' ),
                        'counter_ending_number'      => __( '100', 'apr-core' ),
                    ],
                    [
                        'counter_title'      => __( 'Cool Number', 'apr-core' ),
                        'counter_ending_number'      => __( '100', 'apr-core' ),
                    ], 
                    [
                        'counter_title'      => __( 'Cool Number', 'apr-core' ),
                        'counter_ending_number'      => __( '100', 'apr-core' ),
                    ],
                    [
                        'counter_title'      => __( 'Cool Number', 'apr-core' ),
                        'counter_ending_number'      => __( '100', 'apr-core' ),
                    ],
                ],
                'title_field'   => '{{{ counter_title }}}',
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'icon_counter',
            [
                'label' => __( 'Icon', 'apr-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'icon-cloud-computing',
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );
        $this->add_control(
            'starting_number_type2',
            [
                'label' => __( 'Starting Number', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );

        $this->add_control(
            'ending_number_type2',
            [
                'label' => __( 'Ending Number', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 100,
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );
        $this->add_control(
            'title_type2',
            [
                'label' => __( 'Title', 'apr-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Cool Number', 'apr-core' ),
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );
        $this->add_control(
            'counter_duration',
            [
                'label' => __( 'Animation Duration', 'apr-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'min' => 100,
                'step' => 100,
                'dynamic'   => [
                    'active'    => true,
                ],
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label'     => __( 'Autoplay', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'navigation',
            [
                'label'     => __( 'Navigation', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'arrows',
                'options'   => [
                    'both'      => __( 'Arrows and Dots', 'apr-core' ),
                    'arrows'    => __( 'Arrows', 'apr-core' ),
                    'dots'      => __( 'Dots', 'apr-core' ),
                    'none'      => __( 'None', 'apr-core' ),
                ],
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_responsive_control(
            'number_item_per_view',
            [
                'label'     => __( 'Number item per view', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1'         => __( '1', 'apr-core' ),
                    '2'         => __( '2', 'apr-core' ),
                    '3'         => __( '3', 'apr-core' ),
                    '4'         => __( '4', 'apr-core' ),
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => 1,
                'tablet_default'  => 1,
                'mobile_default'  => 1,
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_number',
            [
                'label' => __( 'Number', 'apr-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __( 'Text Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_number',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-counter-number-wrapper',
            ]
        );
        $this->add_control(
            'number_border_color',
            [
                'label' => __( 'Border Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-wrapper:before' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'number_background',
                'selector' => '{{WRAPPER}} .elementor-counter-number-wrapper:after',
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_responsive_control(
            'x_position',
            [
                'label'     => __( 'X Position Background', 'apr-core' ),
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
                    '{{WRAPPER}} .elementor-counter-number-wrapper:after' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_responsive_control(
            'y_position',
            [
                'label'     => __( 'Y Position Background', 'apr-core' ),
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
                    '{{WRAPPER}} .elementor-counter-number-wrapper:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title', 'apr-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .elementor-counter-title',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_navigation',
            [
                'label'     => __( 'Navigation', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => [ 'arrows', 'dots', 'both' ],
                    'counter_type' => 'type1',
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
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'dots_color',
            [
                'label'     => __( 'Dots Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'dots_border_color',
            [
                'label'     => __( 'Dots Border Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                    'counter_type' => 'type1',
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
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'arrows_color',
            [
                'label'     => __( 'Arrows Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'arrows_border_color',
            [
                'label'     => __( 'Arrows Border Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'arrows_bg_color',
            [
                'label'     => __( 'Arrows Background Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'heading_style_arrows_hover',
            [
                'label'     => __( 'Arrows Hover', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'arrows_color_hover',
            [
                'label'     => __( 'Arrows Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'arrows_border_color_hover',
            [
                'label'     => __( 'Arrows Border Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->add_control(
            'arrows_bg_color_hover',
            [
                'label'     => __( 'Arrows Background Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                    'counter_type' => 'type1',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_icon',
            [
                'label'     => __( 'Icon', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Text Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-counter' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Font size', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'size_units' => [ 'px' ],
                'default'    => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-counter' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_box_hover',
            [
                'label'     => __( 'Box hover', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_type' => 'type2',
                ],
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label' => __( 'Icon Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .box-counter .icon-counter' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __( 'Title Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'number_color_hover',
            [
                'label' => __( 'Number Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-counter-number-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $type_count = $settings['counter_type'];
        $id =  'apr-counter-'.wp_rand();
        if ($type_count === 'type2') {
            $this->add_render_attribute( 'counter', [
                'class' => 'elementor-counter-number',
                'data-count' => $settings['ending_number_type2'],
            ] );
        }
        ?>
        <div id ="<?php echo esc_attr($id);?>" class="elementor-counter counter-<?php echo esc_attr( $settings['counter_type'] )  ?>">
            <?php if ($settings['counter_type'] === 'type2') : ?>
                <div class="box-counter">
                    <?php if ( $settings['icon_counter'] ) : ?>
                         <div class="icon-counter">
                            <i class="<?php echo $settings['icon_counter']; ?>" aria-hidden="true"></i>
                        </div>
                    <?php endif; ?>    
                    <div class="content-counter">
                        <?php if ( $settings['title_type2'] ) : ?>
                            <div class="elementor-counter-title"><?php echo $settings['title_type2']; ?></div>
                        <?php endif; ?>           
                        <div class="elementor-counter-number-wrapper">
                            <span <?php echo $this->get_render_attribute_string( 'counter' ); ?>><?php echo $settings['starting_number_type2']; ?></span>
                        </div>
                    </div>
                </div>
                
            <?php else : ?>
                <?php
                    if ( empty( $settings['slides'] ) ) {
                        return;
                    }
                    $slides = [];
                    $slide_count = 0;
                    foreach ( $settings['slides'] as $slide ) {
                        $slide_html =  $slide_attributes = '';
                        $slide_element = 'div';
                        $slide_html .= '<div class = "elementor-counter-number-wrapper">';
                        $slide_html .= '<div class="elementor-counter-number-prefix">' . $slide['counter_prefix'] .  '</div>';
                        $slide_html .= '<div class = "elementor-counter-number" data-count="' . $slide['counter_ending_number'] . '">'  . $slide['counter_starting_number'] .  '</div>';
                        $slide_html .= '<div class="elementor-counter-number-suffix">' . $slide['counter_suffix'] .  '</div>';
                        $slide_html .= '</div>';
                        if ( $slide['counter_title'] ) {
                            $slide_html .= '<div class="elementor-counter-title">' . $slide['counter_title'] .  '</div>';
                        }
                        $slides[] = '<div class="item counter-item-' . $slide['_id']  . '">' . $slide_html . '</div>';
                        $slide_count++;
                    }
                    $autoplay = '';
                    if($settings['autoplay'] == 'yes'){
                        $autoplay = 'true';
                    }else{
                        $autoplay = 'false';
                    }
                    $is_rtl = is_rtl();
                    $direction = $is_rtl ? 'true' : 'false';
                    $show_arr = 'false';
                    $show_dot = 'false';
                    if($settings['navigation'] == 'both'){
                        $show_arr = 'true';
                        $show_dot = 'true';
                    }elseif($settings['navigation'] == 'arrows'){
                        $show_arr = 'true';
                    }elseif($settings['navigation'] == 'dots'){
                        $show_dot = 'true';
                    }
                    echo implode( '', $slides );
                ?>
            <?php endif;?>
        </div>
        <?php if ($settings['counter_type'] === 'type1') : ?>
        <script>
            jQuery(document).ready(function($) {
                $('#<?php echo esc_js($id);?>.counter-type1 .elementor-counter-number').each(function() {
                    var $this = $(this),
                      countTo = $this.attr('data-count');
                    $({ countNum: $this.text()}).animate({
                    countNum: countTo
                    },
                    {
                        duration: <?php echo esc_attr( $settings['counter_duration'] );?>,
                        easing:'linear',
                        step: function() {
                          $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                          $this.text(this.countNum);
                        }
                    });  
                });
                $('#<?php echo esc_js($id);?>.counter-type1').slick({
                    infinite: false,
                    slidesToShow: <?php echo esc_attr( $settings['number_item_per_view'] );?>,
                    slidesToScroll: 1,
                    autoplay: <?php echo esc_attr($autoplay);?>,
                    arrows: <?php echo esc_attr($show_arr);?>,
                    dots: <?php echo esc_attr($show_dot);?>,
                    rtl: <?php echo esc_attr($direction);?>,
                    nextArrow: '<button class="btn-next"><i class="fa fa-caret-right" aria-hidden="true"></i></button>',
                    prevArrow: '<button class="btn-prev"><i class="fa fa-caret-left" aria-hidden="true"></i></button>',
                    responsive: [
                    {
                      breakpoint: 1025,
                      settings: {
                        slidesToShow: <?php echo esc_attr( $settings['number_item_per_view_tablet'] );?>,
                      }
                    },
                    {
                      breakpoint: 768,
                      settings: {
                        slidesToShow: <?php echo esc_attr( $settings['number_item_per_view_mobile'] );?>,
                      }
                    }
                  ]
                });
            });
        </script>
        <?php else : ?>
            <script>
             jQuery(document).ready(function($) {
                $('#<?php echo esc_js($id);?>.counter-type2 .elementor-counter-number').each(function() {
                    var $this = $(this),
                      countTo = $this.attr('data-count');
                    $({ countNum: $this.text()}).animate({
                    countNum: countTo
                    },
                    {
                        duration: <?php echo esc_attr( $settings['counter_duration'] );?>,
                        easing:'linear',
                        step: function() {
                          $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                          $this.text(this.countNum);
                        }
                    });  
                });
            });
            </script>
        <?php endif;?>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Counter );