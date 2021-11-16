<?php
$section  = 'blog_general';
$priority = 1;
$prefix   = 'blog_general_';
$registered_sidebars = Arrowit_Helper::get_registered_sidebars();
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'blog_title',
    'label'       => esc_html__( 'Blog Title', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Blog', 'arrowit' ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'layout',
    'label'       => esc_html__( 'Blog Layout', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'full_width',
    'choices'     => array(
        'wide' => esc_html__( 'Wide', 'arrowit' ),
        'full_width'   => esc_html__( 'Full Width', 'arrowit' )
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => 'blog_sidebar_left',
    'label'       => esc_html__( 'Sidebar Left', 'arrowit' ),
    'description' => esc_html__( 'Select sidebar left.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'blog_sidebar',
    'choices'     => $registered_sidebars,
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => 'blog_sidebars_right',
    'label'       => esc_html__( 'Sidebar Right', 'arrowit' ),
    'description' => esc_html__( 'Select sidebar right.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'none',
    'choices'     => $registered_sidebars,
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'date_format',
    'label'       => esc_html__( 'Use default date format setting in Settings > General', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '1',
    'choices'     => array(
        '0' => esc_html__( 'No', 'arrowit' ),
        '1' => esc_html__( 'Yes', 'arrowit' ),
    ),
) );