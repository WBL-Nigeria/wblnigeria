<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
class Apr_Core_Blog extends Widget_Base {
    public function get_categories() {
        return array( 'apr-core' );
    }
    public function get_name() {
        return 'apr_blog';
    }
    public function get_title() {
        return __( 'APR Blog', 'apr-core' );
    }
    public function get_icon() {
        return 'eicon-post-excerpt';
    }
    public function get_script_depends() {
        return [ 'jquery-slick' ];
    }
    
    protected function _register_controls() {
        $this->start_controls_section(
            'blog_section',
            [
                'label' =>  __( 'APR Blog', 'apr-core' )
            ]
        );
         $this->add_control(
            'blog_style',
            [
                'label'     =>  __( 'Blog Style', 'apr-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'style1',
                'options'   =>  [
                    'style1'   =>  __( 'Grid Style 1', 'apr-core' ),
                    'style2'   =>  __( 'Grid Style 2', 'apr-core' ),
                    'style5'   =>  __( 'Grid Style 3', 'apr-core' ),
                    'style3'   =>  __( 'Grid Slide 1', 'apr-core' ),
                    'style4'   =>  __( 'Grid Slide 2', 'apr-core' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_number_column',
            [
                'label'     => __( 'Number column', 'apr-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1'         => __( '1', 'apr-core' ),
                    '2'         => __( '2', 'apr-core' ),
                    '3'         => __( '3', 'apr-core' ),
                    '4'         => __( '4', 'apr-core' ),
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => 3,
                'tablet_default'  => 2,
                'mobile_default'  => 1,
            ]
        );
        $this->add_control(
            'blog_select_cat',
            [
                'label'         =>  __( 'Select Category Post', 'apr-core' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  apr_core_check_get_cat( 'category' ),
                'multiple'      =>  true,
                'label_block'   =>  true,
            ]
        );
        $this->add_control(
            'blog_limit',
            [
                'label'     =>  __( 'Number of Posts', 'apr-core' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  3,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );
        $this->add_control(
            'show_custom_image',
            [
                'label'     =>  __( 'Show Custom Image Size', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'On', 'apr-core' ),
                'label_off' => __( 'Off', 'apr-core' ),
                'default'   => 'Off',
                'condition' => [
                    'blog_style' => [ 'style1', 'style2' , 'style3'],
                ],
            ]
        );
        $this->add_control(
            'custom_dimension',
            [
                'label' => __( 'Image Size', 'apr-core' ),
                'type' => Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'apr-core' ),
                'condition' => [
                    'show_custom_image' => 'yes',
                    'blog_style' => [ 'style1', 'style2' , 'style3'],
                ],
            ]
        );
        $this->add_control(
            'blog_order_by',
            [
                'label'     =>  __( 'Order By', 'apr-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'            =>  __( 'Post ID', 'apr-core' ),
                    'author'        =>  __( 'Post Author', 'apr-core' ),
                    'title'         =>  __( 'Title', 'apr-core' ),
                    'date'          =>  __( 'Date', 'apr-core' ),
                    'rand'          =>  __( 'Random', 'apr-core' ),
                    'comment_count' =>  __( 'Comment count', 'apr-core' ),
                ],
            ]
        );
        $this->add_control(
            'blog_order',
            [
                'label'     =>  __( 'Order', 'apr-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ASC',
                'options'   =>  [
                    'ASC'   =>  __( 'Ascending', 'apr-core' ),
                    'DESC'  =>  __( 'Descending', 'apr-core' ),
                ],
            ]
        );
        $this->add_control(
            'blog_show_more',
            [
                'label'     =>  __( 'Show View More', 'apr-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'On', 'apr-core' ),
                'label_off' => __( 'Off', 'apr-core' ),
                'default'   => 'Off',
                'condition' => [
                    'blog_style' => [ 'style1', 'style2' ],
                ],
            ]
        );
        $this->end_controls_section();
        /*-----------------------------------------------------------------------------------*/
        /*  Style TAB
        /*-----------------------------------------------------------------------------------*/
        $this->start_controls_section(
            'title_style_section_item',
            array(
                'label'     => __( 'Item', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .blog-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'selector' => '{{WRAPPER}} .blog-item',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'title_style_section_item_active',
            array(
                'label'     => __( 'Item Active', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            )
        );
        $this->add_control(
            'bg_overlay',
            [
                'label'   => __( 'Background Overlay', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-current.slick-active .blog-item:before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'bg_overlay_after',
            [
                'label'   => __( 'Background Overlay After', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-current.slick-active .blog-content:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'width_bg_overlay_after',
            [
                'label'   => __( 'Width Background Overlay After', 'apr-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px','%'),
                'range'      => array(
                    '%' => array(
                        'min'  => 1,
                        'max'  => 100,
                    ),
                    'px' => array(
                        'min'  => 1,
                        'max'  => 1000,
                        'step' => 1
                    )
                ),
                'selectors' => [
                    '{{WRAPPER}} .slick-current.slick-active .blog-content:after' => 'width:{{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'category_active',
            [
                'label'   => __( 'Category', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'active_category_color',
            [
                'label'   => __( 'Category Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-current.slick-active .info-category a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'active_category_background',
                'selector' => '{{WRAPPER}} .slick-current.slick-active .info-category a',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'active_category_border',
                'label' => esc_html__( 'Border', 'apr-core' ),
                'selector' => '{{WRAPPER}} .slick-current.slick-active .info-category a',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'active_category_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .slick-current.slick-active .info-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'title_active',
            [
                'label'   => __( 'Title', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'active_title_text_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-current.slick-active .post-name a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'active_title_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .slick-current.slick-active .post-name a',
            ]
        );
        $this->add_control(
            'author_active',
            [
                'label'   => __( 'Author', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'active_author_text_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-current.slick-active .info-post .author-post a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'active_author_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .slick-current.slick-active .info-post .author-post a',
            ]
        );
        $this->add_control(
            'date_active',
            [
                'label'   => __( 'Date', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'active_date_text_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-current.slick-active .info-post .custom-date a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'active_date_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .slick-current.slick-active .info-post .custom-date a',
            ]
        );
        $this->end_controls_section();
        //Item Hover
        $this->start_controls_section(
            'title_style_section_item_hover',
            array(
                'label'     => __( 'Item Hover', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .blog-content:hover .blog-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_background_hover',
                'selector' => '{{WRAPPER}} .blog-content:hover .blog-item',
            ]
        );
        $this->add_control(
            'date_color_hover',
            [
                'label'   => __( 'Date Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content:hover .post-time a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'date_bg_hover',
                'selector' => '{{WRAPPER}} .blog-content:hover .post-time a',
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'   => __( 'Title Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content:hover .post-name a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'description_color_hover',
            [
                'label'   => __( 'Description Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content:hover .entry-content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Categories
        $this->start_controls_section(
            'title_style_section_cat',
            array(
                'label'     => __( 'Category', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            )
        );
        $this->add_control(
            'category_color',
            [
                'label'   => __( 'Category Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .info-category a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'category_background',
                'selector' => '{{WRAPPER}} .info-category a',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'category_border',
                'label' => esc_html__( 'Border', 'apr-core' ),
                'selector' => '{{WRAPPER}} .info-category a',
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_responsive_control(
            'category_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'apr-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .info-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->end_controls_section();
        //Author
        $this->start_controls_section(
            'title_style_section_author',
            array(
                'label'     => __( 'Author', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            )
        );
        $this->add_control(
            'author_color',
            [
                'label'   => __( 'Author Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .info-post .author-post a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style4' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'author_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .info-post .author-post a',
            ]
        );
        $this->end_controls_section();
        //Date
        $this->start_controls_section(
            'title_style_section',
            array(
                'label'     => __( 'Date', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'date_color',
            [
                'label'   => __( 'Date Color', 'apr-core' ),
                'type'    => Controls_Manager::COLOR,
                'scheme'  => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .post-time a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'date_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .post-time a',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'date_background',
                'selector' => '{{WRAPPER}} .post-time a',
                'condition' => [
                    'blog_style' => [ 'style1', 'style2', 'style3' ],
                ],
            ]
        );

        $this->end_controls_section();
        // Title.
        $this->start_controls_section(
            'section_style_title_blog',
            [
                'label'     => __( 'Title', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_text_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-name a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .post-name a',
            ]
        );
        $this->end_controls_section();
        // Image.
        $this->start_controls_section(
            'section_style_image_blog',
            [
                'label'     => __( 'Image', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_background',
            [
                'label'     => __( 'Background Color  ', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'description' => __( '(Can only be used when the image is in png format)', 'apr-core' ),
                'selectors' => [
                    '{{WRAPPER}} .blog-img' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Description.
        $this->start_controls_section(
            'section_style_desc_blog',
            [
                'label'     => __( 'Description', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_post_desc p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'description_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .entry-content p',
            ]
        );


        $this->add_responsive_control(
            'description_padding',
            [
                'label'      => __( 'Padding', 'apr-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .blog_post_desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // View More.
        $this->start_controls_section(
            'section_style_button_view_more',
            [
                'label'     => __( 'View More', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => [ 'style1', 'style2' ],
                    'blog_show_more' => [ 'yes' ],
                ],
            ]
        );
        $this->add_control(
            'btn_view_more_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .view_more ' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style1', 'style2' ],
                    'blog_show_more' => [ 'yes' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'btn_view_more_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .view_more',
                'condition' => [
                    'blog_style' => [ 'style1', 'style2' ],
                    'blog_show_more' => [ 'yes' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_view_more_background',
                'selector' => '{{WRAPPER}} .view_more',
                'condition' => [
                    'blog_style' => [ 'style1', 'style2' ],
                    'blog_show_more' => [ 'yes' ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_dots',
            [
                'label'     => __( 'Dots', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => [ 'style3' , 'style4' ],
                ],
            ]
        );
        $this->add_control(
            'dot_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button ' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => [ 'style3' , 'style4'],
                ],
            ]
        );
        $this->end_controls_section();
        // Read More.
        $this->start_controls_section(
            'section_style_text_read_more',
            [
                'label'     => __( 'Read More', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => ['style2' ],
                ],
            ]
        );
        $this->add_control(
            'text_read_more_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} read-more a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => ['style2' ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'text_read_more_typography',
                'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} read-more a',
                'condition' => [
                    'blog_style' => ['style2' ],
                ],
            ]
        );
        $this->end_controls_section();
        // Arrow.
        $this->start_controls_section(
            'section_style_arrow',
            [
                'label'     => __( 'Arrow', 'apr-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_style' => ['style4' ],
                ],
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => ['style4' ],
                ],
            ]
        );
        $this->add_control(
            'arrow_bg_color',
            [
                'label'     => __( 'Background Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_style' => ['style4' ],
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings       =   $this->get_settings_for_display();
        $cat_post       =   $settings['blog_select_cat'];
        $column_desktop =   $settings['blog_number_column'];
        $column_tablet  =   $settings['blog_number_column_tablet'];
        $column_mobile  =   $settings['blog_number_column_mobile'];
        $blog_style     =   $settings['blog_style'];
        $limit_post     =   $settings['blog_limit'];
        $order_by_post  =   $settings['blog_order_by'];
        $order_post     =   $settings['blog_order'];
        $show_more_post =   $settings['blog_show_more'];
        $show_custom_image =   $settings['show_custom_image'];
        $custom_dimension =   $settings['custom_dimension'];
        if($show_custom_image === 'yes'){
            $has_custom_size = false;
            if ( ! empty( $custom_dimension['width'] ) ) {
                $has_custom_size = true;
                $attachment_size[0] = $custom_dimension['width'];
            }

            if ( ! empty( $custom_dimension['height'] ) ) {
                $has_custom_size = true;
                $attachment_size[1] = $custom_dimension['height'];
            }

            if ( ! $has_custom_size ) {
                $attachment_size = 'full';
            }
        }else{
            if($blog_style ==='style4'){
                $attachment_size[0] = 585;
                $attachment_size[1] = 320;
            }else{
                if($blog_style ==='style3' || $blog_style ==='style1'){
                    if ($column_desktop === "1"){
                        $attachment_size[0] = 1170;
                        $attachment_size[1] = 727;
                    } else{
                        $attachment_size[0] = 910;
                        $attachment_size[1] = 566;
                    }
                }elseif ($blog_style ==='style2') {
                    if ($column_desktop === "2"){
                        $attachment_size[0] = 570;
                        $attachment_size[1] = 393;
                    } else{
                        $attachment_size[0] = 370;
                        $attachment_size[1] = 255;
                    }
                }elseif ($blog_style ==='style5') {
                    if ($column_desktop === "2"){
                        $attachment_size[0] = 570;
                        $attachment_size[1] = 377;
                    } else{
                        $attachment_size[0] = 991;
                        $attachment_size[1] = 656;
                    }
                }else{
                    $attachment_size[0] = 585;
                    $attachment_size[1] = 320;
                }
            }
        }
        if ( !empty( $cat_post ) ) :
            $apr_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'col_desktop'       =>  $column_desktop, 
                'col_tablet'        =>  $column_tablet,
                'col_mobile'        =>  $column_mobile,
                'tax_query'         => array(
                    array(
                        'taxonomy'  => 'category',
                        'field'     => 'slug',
                        'terms'     => $cat_post
                    )
                ) 
            );
        else:
            $apr_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'col_desktop'       =>  $column_desktop, 
                'col_tablet'        =>  $column_tablet,
                'col_mobile'        =>  $column_mobile,   
            );
        endif;
         if($blog_style == 'style1'|| $blog_style == 'style2' || $blog_style == 'style5'){
            $items_desktop = 12/$column_desktop;
            $items_tablets = 12/$column_tablet;
            $items_mobile  = 12/$column_mobile;
        }
        
        query_posts($apr_post_type_arg);
        global $wp_query;
        $apr_post_type_query = new WP_Query($apr_post_type_arg);

        if ( $apr_post_type_query->have_posts() ) :
        $id =  'apr-blog-'.wp_rand();
        $id_img =  'blog-img-'.wp_rand();
		$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

        $is_rtl = is_rtl();
        $direction = $is_rtl ? 'true' : 'false';
    ?>
    <div id ="<?php echo esc_attr($id);?>" class="blog-shortcode <?php if($blog_style ==='style1'){echo 'blog-grid grid-style1';}?>  <?php if($blog_style ==='style2'){echo 'blog-grid grid-style2';}?>  <?php if($blog_style ==='style5'){echo 'grid-style3';}?>  <?php if($blog_style ==='style3'){echo 'blog-grid grid-style1 blog-slide-1';}?> <?php if($blog_style ==='style4'){echo 'blog-slide-2';}?> <?php if($blog_style !=='style3' || $blog_style !=='style4'){echo 'load-item  row  clearfix';}?>">
        <?php while ( $apr_post_type_query->have_posts() ): $apr_post_type_query->the_post(); ?>
             <?php
                $format_class = '';
                if ( !has_post_thumbnail()){ 
                    $format_class = 'no-image';
                } elseif( get_post_format() ==='quote'){
                    $format_class = 'post-quote';
                } elseif( get_post_format() ==='link'){
                    $format_class = 'post-link';
                } elseif( get_post_format() ==='audio'){
                    $format_class = 'post-audio';
                }elseif( get_post_format() ==='video'){
                    $format_class = 'post-video';
                } elseif( get_post_format() ==='image'){ 
                    $format_class = 'post-image';
                } else{
                    $format_class = 'blog-has-img';
                }
            ?>
            <?php if($blog_style ==='style3' || $blog_style ==='style4'):?>
            <div class="item item-page<?php echo esc_attr($current_page); ?> <?php if ( is_sticky() ){ echo 'post_sticky';} ?>">
            <?php else:?>
            <div class="item-page<?php echo esc_attr($current_page); ?> item col-lg-<?php echo esc_html($items_desktop) ?> col-md-<?php echo esc_html($items_tablets) ?> col-sm-<?php echo esc_html($items_mobile) ?> <?php if ( is_sticky() ){ echo 'post_sticky';} ?>">  
            <?php endif;?>
                <div class="blog-content">
                    <?php if( $blog_style ==='style4' ):?>
                        <?php if (has_post_thumbnail()): ?>
                            <?php
                                $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                                $args = array(
                                    'url'     => $full_image_size,
                                    'width'   => $attachment_size[0],
                                    'height'  => $attachment_size[1],
                                    'crop'    => true,
                                    'single'  => true,
                                    'upscale' => false,
                                    'echo'    => false,
                                );
                               $image4 = aq_resize( $args['url'], $args['crop'], $args['single'], $args['upscale'] );
                                if ( $image4 === false ) {
                                    $image4 = $args['url'];
                                }
                            ?>
                        <?php endif; ?>
                    <div class="blog-item <?php echo esc_attr($format_class);?>" style=" background-image: url(<?php echo esc_url( $image4 ); ?>) " >
                    <?php else:?>
                    <div class="blog-item <?php echo esc_attr($format_class);?> ">
                    <?php endif;?>
                        
                    <?php if ( is_sticky() ):?>
                         <div class="icon-sticky"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                    <?php endif;?>
                        <?php if( $blog_style ==='style2'): ?>
                            <div class="top-description">
                        <?php endif;?>
                        <?php if( ($blog_style !=='style4') && ($blog_style !=='style5')): ?>
                            <div class="post-time">
                                <div class=" custom-date ">
                                    <a href="<?php the_permalink(); ?>">
                                        <span><?php echo get_the_time('d'); ?> <?php echo get_the_time('M'); ?> <?php echo get_the_time('Y'); ?></span>
                                    </a>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if( $blog_style ==='style4'): ?>
                            <div class="blog_info">
                                <div class="info-category">
                                    <?php echo get_the_term_list($apr_post_type_query->ID,'category', '',' ','' ); ?>
                                </div>     
                            </div>
                        <?php endif;?>
                        <?php if( $blog_style !=='style5'): ?>
                            <h4 class="post-name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php
                                $title =  strlen(get_the_title());
                                if ($title > 29) {
                                    $get_title = substr( get_the_title() , 0, 29);
                                    echo esc_attr($get_title) . '...';
                                }else{
                                    the_title();
                                }
                                ?>
                                </a>
                            </h4>
                        <?php endif;?>
                        <?php if( $blog_style ==='style4'): ?>
                            <div class="info-post">
                                <div class="author-post">
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                        <?php the_author(); ?>
                                    </a>     
                                </div>
                                <div class="post-time">
                                    <div class=" custom-date ">
                                        <a href="<?php the_permalink(); ?>">
                                            <span><?php echo get_the_time('M'); ?> <?php echo get_the_time('d'); ?> ,  <?php echo get_the_time('Y'); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if( $blog_style ==='style2'): ?>
                            </div>
                        <?php endif;?>
                        <?php if ( has_post_thumbnail() && get_post_format() !=='quote' && get_post_format() !=='audio' && get_post_format() !=='video'):?>
                                <div class="blog-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                                        if($blog_style ==='style3' || $blog_style ==='style1'){
                                             if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            } else{
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            }
                                        }elseif ($blog_style ==='style2') {
                                            if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            } else{
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            }
                                        }elseif ($blog_style ==='style5') {
                                            if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            } else{
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            }
                                        } else {
                                            $args = array(
                                            'url'     => $full_image_size,
                                            'width'   => $attachment_size[0],
                                            'height'  => $attachment_size[1],
                                            'crop'    => true,
                                            'single'  => true,
                                            'upscale' => false,
                                            'echo'    => false,
                                            );
                                        }
                                        
                                        $image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
                                        if ( $image === false ) {
                                            $image = $args['url'];
                                        }
                                        ?>
                                        <img src="<?php echo esc_url( $image ); ?>"
                                             alt="<?php get_the_title(); ?>"/>
                                    </a>
                                </div>
                            <?php elseif( (get_post_format() == 'quote') &&  ($blog_style ==='style2')): ?>
                                <div class="blog-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                                        if($blog_style ==='style3' || $blog_style ==='style1'){
                                             if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            } else{
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            }
                                        }elseif ($blog_style ==='style2') {
                                            if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            } else{
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            }
                                        }elseif ($blog_style ==='style5') {
                                            if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            } else{
                                                $args = array(
                                                    'url'     => $full_image_size,
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                            }
                                        } else {
                                            $args = array(
                                            'url'     => $full_image_size,
                                            'width'   => $attachment_size[0],
                                            'height'  => $attachment_size[1],
                                            'crop'    => true,
                                            'single'  => true,
                                            'upscale' => false,
                                            'echo'    => false,
                                            );
                                        }
                                        
                                        $image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
                                        if ( $image === false ) {
                                            $image = $args['url'];
                                        }
                                        ?>
                                        <img src="<?php echo esc_url( $image ); ?>"
                                             alt="<?php get_the_title(); ?>"/>
                                    </a>
                                </div>
                            <?php elseif( (get_post_format() == 'audio') &&  ($blog_style ==='style2')): ?>
                                <?php $audio = get_post_meta(get_the_ID(), 'post_audio', true); ?>
                                    <?php if ($audio && $audio != ''): ?>
                                        <div class="blog-img blog-audio">
                                                <?php  echo '<div class="iframe_audio_container">';
                                                ?>
                                                <?php echo wp_oembed_get( $audio,  array('height'=>255 ) ); ?> 
                                                <?php echo '</div>';
                                                ?>                 
                                        </div>
                                    <?php endif; ?>
                            <?php elseif(get_post_format() == 'gallery'): ?>
                                <?php  $gallery = get_post_meta(get_the_ID(), 'gallery_metabox', true);?> 
                                    <?php if (is_array($gallery) && count($gallery) > 1) : ?>          
                                    <div class="blog-gallery blog-img arrows-custom"> 
                                        <?php
                                        $index = 0;
                                        foreach ($gallery as $key => $value) :
                                            $full_image_size = wp_get_attachment_image_src($value, 'full');
                                            $alt = get_post_meta($value, '_wp_attachment_image_alt', true); 
                                            if($blog_style ==='style3' || $blog_style ==='style1'){
                                                if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size[0],
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                                } else{
                                                    $args = array(
                                                        'url'     => $full_image_size[0],
                                                        'width'   => $attachment_size[0],
                                                        'height'  => $attachment_size[1],
                                                        'crop'    => true,
                                                        'single'  => true,
                                                        'upscale' => false,
                                                        'echo'    => false,
                                                    );
                                                }
                                            }elseif ($blog_style ==='style2') {
                                                if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size[0],
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                                } else{
                                                    $args = array(
                                                        'url'     => $full_image_size[0],
                                                        'width'   => $attachment_size[0],
                                                        'height'  => $attachment_size[1],
                                                        'crop'    => true,
                                                        'single'  => true,
                                                        'upscale' => false,
                                                        'echo'    => false,
                                                    );
                                                }
                                            }elseif ($blog_style ==='style5') {
                                                if ($column_desktop === "2"){
                                                $args = array(
                                                    'url'     => $full_image_size[0],
                                                    'width'   => $attachment_size[0],
                                                    'height'  => $attachment_size[1],
                                                    'crop'    => true,
                                                    'single'  => true,
                                                    'upscale' => false,
                                                    'echo'    => false,
                                                );
                                                } else{
                                                    $args = array(
                                                        'url'     => $full_image_size[0],
                                                        'width'   => $attachment_size[0],
                                                        'height'  => $attachment_size[1],
                                                        'crop'    => true,
                                                        'single'  => true,
                                                        'upscale' => false,
                                                        'echo'    => false,
                                                    );
                                                }
                                            }
                                            else{
                                               $args = array(
                                                'url'     => $full_image_size[0],
                                                'width'   => $attachment_size[0],
                                                'height'  => $attachment_size[1],
                                                'crop'    => true,
                                                'single'  => true,
                                                'upscale' => false,
                                                'echo'    => false,
                                            );  
                                            }
                                            $image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
                                            if ( $image === false ) {
                                                $image = $args['url'];
                                            }
                                            ?>
                                            <div class ="img-gallery">
                                                <img src="<?php echo esc_url( $image ); ?>"
                                                 alt="<?php echo esc_attr( $alt ); ?>"/>
                                            </div>
                                            <?php
                                            $index++;
                                        endforeach;
                                        ?>
                                    </div> 
                                    <?php endif;?>
                            <?php elseif(get_post_format() === 'video'): ?>
                                    <?php $video = get_post_meta(get_the_ID(), 'post_video', true); ?>
                                    <?php if ($video && $video != ''): ?>
                                        <?php if ( has_post_thumbnail()):?>
                                            <div class="blog-video blog-img">
                                                <a class="fancybox" data-fancybox href="<?php echo esc_url($video); ?>">
                                                <?php
                                                    $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                                                    if($blog_style ==='style3' || $blog_style ==='style1'){
                                                        if ($column_desktop === "2"){
                                                            $args = array(
                                                                'url'     => $full_image_size,
                                                                'width'   => $attachment_size[0],
                                                                'height'  => $attachment_size[1],
                                                                'crop'    => true,
                                                                'single'  => true,
                                                                'upscale' => false,
                                                                'echo'    => false,
                                                            );
                                                        } else{
                                                            $args = array(
                                                                'url'     => $full_image_size,
                                                                'width'   => $attachment_size[0],
                                                                'height'  => $attachment_size[1],
                                                                'crop'    => true,
                                                                'single'  => true,
                                                                'upscale' => false,
                                                                'echo'    => false,
                                                            );
                                                        } 
                                                    }elseif ($blog_style ==='style2') {
                                                        if ($column_desktop === "2"){
                                                            $args = array(
                                                                'url'     => $full_image_size,
                                                                'width'   => $attachment_size[0],
                                                                'height'  => $attachment_size[1],
                                                                'crop'    => true,
                                                                'single'  => true,
                                                                'upscale' => false,
                                                                'echo'    => false,
                                                            );
                                                        } else{
                                                            $args = array(
                                                                'url'     => $full_image_size,
                                                                'width'   => $attachment_size[0],
                                                                'height'  => $attachment_size[1],
                                                                'crop'    => true,
                                                                'single'  => true,
                                                                'upscale' => false,
                                                                'echo'    => false,
                                                            );
                                                        } 
                                                    }elseif ($blog_style ==='style5') {
                                                        if ($column_desktop === "2"){
                                                            $args = array(
                                                                'url'     => $full_image_size,
                                                                'width'   => $attachment_size[0],
                                                                'height'  => $attachment_size[1],
                                                                'crop'    => true,
                                                                'single'  => true,
                                                                'upscale' => false,
                                                                'echo'    => false,
                                                            );
                                                        } else{
                                                            $args = array(
                                                                'url'     => $full_image_size,
                                                                'width'   => $attachment_size[0],
                                                                'height'  => $attachment_size[1],
                                                                'crop'    => true,
                                                                'single'  => true,
                                                                'upscale' => false,
                                                                'echo'    => false,
                                                            );
                                                        } 
                                                    } 
                                                    else {
                                                       $args = array(
                                                        'url'     => $full_image_size,
                                                        'width'   => $attachment_size[0],
                                                        'height'  => $attachment_size[1],
                                                        'crop'    => true,
                                                        'single'  => true,
                                                        'upscale' => false,
                                                        'echo'    => false,
                                                    );}
                                                    $image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
                                                    if ( $image === false ) {
                                                        $image = $args['url'];
                                                    }
                                                ?>
                                                    <img src="<?php echo esc_url( $image ); ?>"
                                                         alt="<?php get_the_title(); ?>"/>
                                                    <i class="fa fa-play"></i>
                                                </a>      
                                            </div>
                                         <?php endif; ?>
                                    <?php endif; ?>
                        <?php endif;?>
                        <?php if((get_post_format() =='link' || get_post_format()  =='quote'|| get_post_format() =='audio') && $blog_style ==='style5'):?>
                            <?php if ( get_post_format() == 'audio') : ?>
                                <?php $audio = get_post_meta(get_the_ID(), 'post_audio', true); ?>
                                <?php if ($audio && $audio != ''): ?>
                                    <div class="blog-audio">
                                            <?php if(get_post_format() == 'audio'){
                                                echo '<div class="iframe_audio_container">';
                                            }
                                            ?>
                                            <?php if( $blog_style ==='style2'): ?>    <?php echo wp_oembed_get( $audio,  array('height'=>255 ) ); ?> 
                                            <?php else: ?>             
                                                <?php echo wp_oembed_get( $audio,  array('height'=>193 ) ); ?>
                                            <?php endif; ?>
                                            <?php if(get_post_format() == 'audio'){
                                                echo '</div>';
                                            }
                                            ?>                 
                                    </div>
                                <?php endif; ?>
                            <?php elseif (get_post_format() =='link'):?>
                                <?php 
                                    $link = get_post_meta(get_the_ID(), 'post_link', true); 
                                    $link_title = get_post_meta(get_the_ID(), 'post_link', true);
                                ?>
                                <?php if($link && $link != ''):?>
                                    <div class="link_section clearfix">
                                        <div class="link-icon">
                                            <a class="link-post"  href="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link);?>">
                                                <i class="fa fa-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;?> 
                            <?php elseif(get_post_format() =='quote'):?>
                                <?php 
                                    $quote_text = get_post_meta(get_the_ID(), 'post_quote_text', true); 
                                ?>
                                <?php if($quote_text && $quote_text != ''):?>
                                    <div class="quote_section">
                                        <blockquote class="var3">
                                            <p><?php echo wp_kses($quote_text,array());?></p>
                                        </blockquote>
                                    </div>
                                <?php endif;?>  
                            <?php endif;?>
                        <?php endif;?>
                        <?php if( $blog_style ==='style5'): ?>
                            <h4 class="post-name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php
                                $title =  strlen(get_the_title());
                                if ($title > 90) {
                                    $get_title = substr( get_the_title() , 0, 90);
                                    echo esc_attr($get_title) . '...';
                                }else{
                                    the_title();
                                }
                                ?>
                                </a>
                            </h4>
                        <?php endif;?>
                        <div class="blog-post-info">
                            <div class="just-center">
                                <?php if((get_post_format() =='link' || get_post_format()  =='quote'|| get_post_format() =='audio') && $blog_style !=='style5'):?>
                                    <?php if ( get_post_format() == 'audio') : ?>
                                        <?php $audio = get_post_meta(get_the_ID(), 'post_audio', true); ?>
                                        <?php if ($audio && $audio != ''): ?>
                                            <div class="blog-audio">
                                                    <?php if(get_post_format() == 'audio'){
                                                        echo '<div class="iframe_audio_container">';
                                                    }
                                                    ?>
                                                    <?php if( $blog_style ==='style2'): ?>    <?php echo wp_oembed_get( $audio,  array('height'=>255 ) ); ?> 
                                                    <?php else: ?>             
                                                        <?php echo wp_oembed_get( $audio,  array('height'=>193 ) ); ?>
                                                    <?php endif; ?>
                                                    <?php if(get_post_format() == 'audio'){
                                                        echo '</div>';
                                                    }
                                                    ?>                 
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif (get_post_format() =='link'):?>
                                        <?php 
                                            $link = get_post_meta(get_the_ID(), 'post_link', true); 
                                            $link_title = get_post_meta(get_the_ID(), 'post_link', true);
                                        ?>
                                        <?php if($link && $link != ''):?>
                                            <div class="link_section clearfix">
                                                <div class="link-icon">
                                                    <a class="link-post"  href="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link);?>">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif;?> 
                                    <?php elseif(get_post_format() =='quote'):?>
                                        <?php 
                                            $quote_text = get_post_meta(get_the_ID(), 'post_quote_text', true); 
                                        ?>
                                        <?php if($quote_text && $quote_text != ''):?>
                                            <div class="quote_section">
                                                <blockquote class="var3">
                                                    <p><?php echo wp_kses($quote_text,array());?></p>
                                                </blockquote>
                                            </div>
                                        <?php endif;?>  
                                    <?php endif;?>
                                <?php endif;?>
                                <div class="blog_post_desc">
                                    <?php
                                    echo '<div class="entry-content">';
                                    $excerpt = get_the_excerpt();
                                    echo '<p>' . substr( $excerpt, 0, 135 ) . '&hellip;' . '</p>';
                                    wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'apr-core' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'apr-core' ) . ' </span>%',
                                        'separator'   => '<span class="screen-reader-text">, </span>',
                                    ) );
                                    echo '</div>';
                                    ?>
                                    <?php if($blog_style ==='style4'):?>
                                            <a class="read-more-style4" href="<?php the_permalink();?>"><i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></a>
                                    <?php endif;?>
                                </div>
                                <?php if( get_post_format() !='image'):?>
                                    <?php if($blog_style ==='style2'):?>
                                        <div class="read-more">
                                            <a href="<?php the_permalink();?>"><?php echo esc_html__('','apr-core');?></a>
                                        </div>
                                    <?php endif;?>
                                <?php endif;?>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_query(); ?>
    </div>
    <?php if($show_more_post === 'yes') :?>
        <div class="btn-viewmore text-center">
            <a class="view_more " href="<?php echo esc_url(get_post_type_archive_link('post')); ?>"><?php echo esc_html('More','apr-core') . '<span class="icon-play32"></span>';?></a>
        </div>
    <?php endif; ?>
    <?php if($blog_style ==='style3') : ?>
            <script>
                jQuery(document).ready(function($) {
                    $('#<?php echo esc_js($id);?>.blog-slide-1').slick({
                        dots: true,
                        arrows: false,
                        speed: 300,
                        rtl: <?php echo esc_attr($direction);?>,
                        centerPadding: '0',
                        centerMode: true,
                        slidesToShow:<?php echo esc_attr( $column_desktop);?>,
                        responsive: [
                            {
                              breakpoint: 1025,
                              settings: {
                                slidesToShow: <?php echo esc_attr( $column_tablet);?>,
                              }
                            },
                            {
                              breakpoint: 768,
                              settings: {
                                slidesToShow: <?php echo esc_attr( $column_mobile);?>,
                              }
                            }
                        ]
                    });
                });
            </script>
        <?php
    endif;?>
    <?php if( $blog_style ==='style4') : ?>
            <script>
                jQuery(document).ready(function($) {
                    $('#<?php echo esc_js($id);?>.blog-slide-2').slick({
                        dots: true,
                        arrows: true,
                        autoplay: true,
                        autoplaySpeed: 6000,
                        nextArrow: '<button class="btn-next"><i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></button>',
                        prevArrow: '<button class="btn-prev"><i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i></button>',
                        speed: 1000,
                        rtl: <?php echo esc_attr($direction);?>,
                        centerPadding: '60px',
                        slidesToShow:<?php echo esc_attr( $column_desktop);?>,
                        responsive: [
                            {
                              breakpoint: 1025,
                              settings: {
                                slidesToShow: <?php echo esc_attr( $column_tablet);?>,
                              }
                            },
                            {
                              breakpoint: 768,
                              settings: {
                                slidesToShow: <?php echo esc_attr( $column_mobile);?>,
                              }
                            }
                        ]
                    });
                });
            </script>
        <?php
    endif;?>     
    <?php endif;}
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Blog );