<?php
$section  = 'layout-config';
$priority = 1;
$prefix   = 'layout_';
$registered_sidebars = Arrowit_Helper::get_registered_sidebars();
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'site',
    'label'       => esc_html__( 'General Layout', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'full_width',
    'choices'     => array(
        'wide' => esc_html__( 'Wide', 'arrowit' ),
        'full_width'   => esc_html__( 'Full Width', 'arrowit' ),
        'boxed' => esc_html__( 'Boxed', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'dimension',
    'settings'    => $prefix . 'width',
    'label'       => esc_html__( 'Site Width', 'arrowit' ),
    'description' => esc_html__( 'Controls the overall site width (layout: full width). Enter value including any valid CSS unit, ex: 1170px.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'output'      => array(
        array(
            'element' => '.container, .elementor-inner .elementor-section.elementor-section-boxed>.elementor-container',
            'property'    => 'max-width',
            'media_query' => '@media (min-width: 1200px)'
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => 'general_left_sidebar',
    'label'       => esc_html__( 'Sidebar Left', 'arrowit' ),
    'description' => esc_html__( 'Select sidebar left.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'choices'     => $registered_sidebars,
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => 'general_right_sidebar',
    'label'       => esc_html__( 'Sidebar Right', 'arrowit' ),
    'description' => esc_html__( 'Select sidebar right.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'choices'     => $registered_sidebars,
) );