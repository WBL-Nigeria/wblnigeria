<?php
namespace Elementor;
if (!defined('ABSPATH')) exit;
class Apr_Core_Banner extends Widget_Base
{
    public function get_name()
    {
        return 'apr_banner';
    }
    public function get_title()
    {
        return __('APR Banner', 'apr-core');
    }
    public function get_icon()
    {
        return 'eicon-image-box';
    }
    public function get_categories()
    {
        return array('apr-core');
    }
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_banner',
            [
                'label' => __( 'Banner', 'apr-core' ),
            ]
        );
        /**/
        $this->start_controls_tabs( 'tabs_bn_style' );

        $this->start_controls_tab(
            'tab_bn_content',
            [
                'label' => __( 'CONTENT', 'apr-core' ),
            ]
        );

        $this->add_responsive_control(
            'bn_align',
            [
                'label'     => __( 'Alignment', 'apr-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'left',
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'apr-core' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'apr-core' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'bottom-center' => [
                        'title' => __( 'Bottom Center', 'apr-core' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'apr-core' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
            ]
        );
        $this->add_control(
            'top_title',
            [

                'label'    => __( 'Top Title', 'apr-core' ),
                'type'     => Controls_Manager::TEXT,
                'placeholder'     => 'Enter your top title',
                'dynamic'  => [
                    'active' => true,
                ],
                'default'  => __( 'Top title', 'apr-core' ),
            ]
        );

        $this->add_control(
            'before_heading_title',
            [

                'label'    => __( 'Before Title', 'apr-core' ),
                'type'     => Controls_Manager::TEXTAREA,
                'placeholder'     => 'Enter your before title',
                'dynamic'  => [
                    'active' => true,
                ],
                'default'  => __( 'Before title', 'apr-core' ),
            ]
        );

        $this->add_control(
            'second_heading_title',
            [
                'label'    => __( 'Second Title', 'apr-core' ),
                'type'     => Controls_Manager::TEXTAREA,
                'placeholder'     => 'Enter your second title',
                'dynamic'  => [
                    'active' => true,
                ],
                'default'  => __( 'Second title', 'apr-core' ),
            ]
        );

        $this->add_control(
            'after_heading_title',
            [
                'label'    => __( 'After Title', 'apr-core' ),
                'type'     => Controls_Manager::TEXTAREA,
                'placeholder'     => 'Enter your after title',
                'dynamic'  => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'bn_desc_text',
            [
                'label' => __( 'Description Text', 'apr-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder'     => 'Enter your description title',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'apr-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Shop now', 'apr-core' ),
                'placeholder'     => 'Enter your button text',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_link',
            [
                'label'       => __( 'Link', 'apr-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'apr-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_bn_background',
            [
                'label' => __( 'BACKGROUND', 'apr-core' ),
            ]
        );

        $this->add_responsive_control(
            'background_color',
            [
                'label' => __( 'Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .apr-banner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => _x( 'Image', 'Background Control', 'apr-core' ),
                'type' => Controls_Manager::MEDIA,
                'selectors' => [
                    '{{WRAPPER}} .apr-banner' => 'background-image: url({{URL}})',
                ],
            ]
        );
        $this->add_control(
            'background_size',
            [
                'label' => _x( 'Size', 'Background Control', 'apr-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => _x( 'Cover', 'Background Control', 'apr-core' ),
                    'contain' => _x( 'Contain', 'Background Control', 'apr-core' ),
                    'auto' => _x( 'Auto', 'Background Control', 'apr-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-banner' => 'background-size: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_bn_image',
            [
                'label' => __( 'Image', 'apr-core' ),
            ]
        );

        $this->add_responsive_control(
            'cate_thumb',
            [
                'label'     => __( 'Choose Image', 'elementor' ),
                'description'   => __( 'You should choose a small, square image.', 'elementor' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'       => '',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'cate_thumb',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'slides_height',
            [
                'label' => __( 'Height', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 275,
                ],
                'size_units' => [ 'px', 'vh', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .apr-banner' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content-margin',
            [
                'label' => __( 'Content', 'apr-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_margin_top',
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
                    '{{WRAPPER}} .apr-banner .bn-content' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content-margin-bottom',
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
                    '{{WRAPPER}}  .apr-banner .bn-content' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'bn_tab_style',
            [
                'label' => __( 'Title', 'apr-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_title_max_width',
            [
                'label' => __( 'Content Width', 'apr-core' ),
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
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .bn-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bn_top_title_heading',
            [
                'label'     => __( 'Top Title', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'bn_top_title_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .top-title' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'bn_top_title_typography',
                'label'     => __( 'Typography', 'apr-core' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .apr-banner .top-title',
            ]
        );

        $this->add_responsive_control(
            'bn_top_margin',
            [
                'label'      => __( 'Between Top title & Title', 'apr-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 60,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .apr-banner .top-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /* Before Title*/
        $this->add_control(
            'bn_before_title_heading',
            [
                'label'     => __( 'Before Title', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'bn_before_title_bg_color',
                'label'     => __( 'Background Color', 'apr-core' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .bn-before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'bn_before_title_typography',
                'label'     => __( 'Typography', 'apr-core' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .apr-banner .bn-before',
            ]
        );
        /* Second Title*/
        $this->add_control(
            'bn_second_title_heading',
            [
                'label'     => __( 'Second Title', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'bn_second_title_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .bn-middle' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'bn_second_title_typography',
                'label'     => __( 'Typography', 'apr-core' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .apr-banner .bn-middle',
            ]
        );
        /* After Title*/
        $this->add_control(
            'bn_after_title_heading',
            [
                'label'     => __( 'After Title', 'apr-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'bn_after_title_typography',
                'label'     => __( 'Typography', 'apr-core' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .apr-banner .bn-after',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'bn_after_title_bg_color',
                'label'     => __( 'Background Color', 'apr-core' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .bn-after',
                'default'      => 'color',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'bn_tab_desc_style',
            [
                'label' => __( 'Description', 'apr-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_desc_max_width',
            [
                'label' => __( 'Content Width', 'apr-core' ),
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
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .bn-desc' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'bn_desc_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '#948e90',
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .bn-desc' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'bn_desc_typography',
                'label'     => __( 'Typography', 'apr-core' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .apr-banner .bn-desc',
            ]
        );

        $this->add_responsive_control(
            'bn_desc_margin',
            [
                'label'      => __( 'Margin', 'apr-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 60,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .apr-banner .bn-desc' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'bn_button_tab_style',
            [
                'label' => __( 'Button', 'apr-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'tabs_button_style'
        );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'apr-core' ),
            ]
        );

        $this->add_control(
            'bn_btn_bn_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .btn-bn' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'btn-gradient',
            [
                'label'        => __( 'Button gradient', 'apr-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'apr-core' ),
                'label_off'    => __( 'No', 'apr-core' ),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'default'   => '#00000000',
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .btn-bn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_border',
                'label'       => __( 'Border', 'apr-core' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .apr-banner .btn-bn',
            ]
        );

        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label'      => __( 'Border Radius', 'apr-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .apr-banner .btn-bn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );

        $this->add_responsive_control(
            'btn_border_padding',
            [
                'label'      => __( 'Padding', 'apr-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .apr-banner .btn-bn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );

        $this->add_responsive_control(
            'bn_btn_bn_margin',
            [
                'label'      => __( 'Margin', 'apr-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 60,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .apr-banner .btn-bn' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'bn_btn_bn_typography',
                'label'     => __( 'Typography', 'apr-core' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .apr-banner .btn-bn',
                'separator'  => 'after',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'apr-core' ),
            ]
        );

        $this->add_control(
            'bn_btn_bn_hover_color',
            [
                'label'     => __( 'Color', 'apr-core' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default'   => '#c44860',
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .btn-bn:hover' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __( 'Background Color', 'apr-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .apr-banner .btn-bn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_border_hover',
                'label'       => __( 'Border', 'apr-core' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .apr-banner .btn-bn:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings();
        $cate_thumb_url = Group_Control_Image_Size::get_attachment_image_html($settings, 'cate_thumb', 'cate_thumb');

        $top_title = $settings['top_title'];
        $before_heading_title = $settings['before_heading_title'];
        $second_heading_title = $settings['second_heading_title'];
        $after_heading_title = $settings['after_heading_title'];
        $button_text = $settings['button_text'];
        $bn_desc_text = $settings['bn_desc_text'];
        $link = '';
        if ( ! empty( $settings['heading_link']['url'] ) ) {
            $this->add_render_attribute( 'url', 'href', $settings['heading_link']['url'] );

            if ( $settings['heading_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['heading_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }
            $link = $this->get_render_attribute_string( 'url' );
        }
            ?>
        <div class="apr-banner <?php echo 'bn-align-' . $settings['bn_align'];?>">
             <?php if (!empty($cate_thumb_url)){?>
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'cate_thumb', 'cate_thumb'); ?>

            <?php }?>
            <div class="bn-content">
                <?php if ($top_title != ''){?>
                <p class="top-title"><?php echo $top_title;?></p>
                <?php }?>
                <?php if ( ! empty( $settings['heading_link']['url'] ) ) { ?>
                <a <?php echo $link; ?> >
                    <?php } ?>
                <?php if ($before_heading_title || $second_heading_title || $after_heading_title){?>
                <p class="bn-title">
                    <?php if ($before_heading_title != '') {?>
                        <span class="bn-before"><?php echo $before_heading_title;?></span>
                    <?php }?>
                    <?php if ($second_heading_title != '') {?>
                        <span class="bn-middle"><?php echo $second_heading_title;?></span>
                    <?php }?>
                    <?php if ($after_heading_title != '') {?>
                        <span class="bn-after"><?php echo $after_heading_title;?></span>
                    <?php }?>
                </p>
                <?php if ( ! empty( $settings['heading_link']['url'] ) ) { ?>
                </a>
                <?php }}
                if ($bn_desc_text != ''){?>
                    <p class="bn-desc"><?php echo $bn_desc_text;?></p>
                <?php }
                if ($button_text != ''){
                ?>
                <a <?php if ($link != ''){echo $link;} else{echo 'href="#"';}?> class="btn-bn <?php if ($settings['btn-gradient'] == 'yes')  echo 'btn btn-border btn-gradient';?>"><?php echo $button_text;?></a>
                <?php }?>
            </div>
        </div>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type(new Apr_Core_Banner);