<?php
$section  = 'portfolio';
$priority = 1;
$prefix   = 'portfolio_';
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    =>  $prefix . 'title',
    'label'       => esc_html__( 'Portfolio Title', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'portfolio', 'arrowit' ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    =>  $prefix . 'slug',
    'label'       => esc_html__( 'Custom Portfolio Slug', 'arrowit' ),
    'description' => esc_html__( 'You will still have to refresh your permalinks after saving this! 
                                This is done by going to Settings > Permalinks and clicking save.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'portfolio', 'arrowit' ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    =>  $prefix . 'cat_slug',
    'label'       => esc_html__( 'Custom Slug for portfolio Category', 'arrowit' ),
    'description' => esc_html__( 'You will still have to refresh your permalinks after saving this! 
                                This is done by going to Settings > Permalinks and clicking save.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'portfolio-cat', 'arrowit' ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    =>  $prefix . 'layouts',
    'label'       => esc_html__( 'Select Portfolio Layout', 'arrowit' ),
    'section' => $section,
    'priority' => $priority++,
    'default'     => 'grid-1',
    'choices'     => array(
        'grid-1'  => esc_html__( 'Grid Layout 1', 'arrowit' ),
        'grid-2'  => esc_html__( 'Grid Layout 2', 'arrowit' ),
        'grid-3'  => esc_html__( 'Grid Layout 3', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'layout',
    'label'       => esc_html__( 'Portfolio Layout General', 'arrowit' ),
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
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'columns',
    'label'       => esc_html__( 'Grid Layout Columns', 'arrowit' ),
    'description' => esc_html__( 'Select columns for Portfolio.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '3',
    'choices'     => array(
        '1' => esc_html__( '1 col', 'arrowit' ),
        '2'   => esc_html__( '2 col', 'arrowit' ),
        '3' => esc_html__( '3 col', 'arrowit' ),
        '4' => esc_html__( '4 col', 'arrowit' ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'pagination',
    'label'       => esc_html__( 'Pagination type', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'number',
    'choices'     => array(
        'load_more' => esc_html__( 'Load more', 'arrowit' ),
        'next_prev'   => esc_html__( 'Next/Prev', 'arrowit' ),
        'number' => esc_html__( 'Number', 'arrowit' ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'number',
    'settings'    => $prefix . 'number_cate',
    'label'       => esc_html__( 'Number of categories to show', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '3',
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'number',
    'settings'    =>   $prefix . 'archive_number_item',
    'label'       => esc_html__( 'Post show per page', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 6,
    'choices'     => array(
        'min'  => 1,
        'max'  => 30,
        'step' => 1,
    ),
) );
Arrowit_Kirki::add_field( 'theme', [
    'type'        => 'multicolor',
    'settings'    => 'portfolio_background',
    'label'       => esc_html__( 'Background Color', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'choices'     => [
        'top'     => esc_html__( 'Top Color', 'arrowit' ),
        'bottom'  => esc_html__( 'Bottom Color', 'arrowit' ),
    ],
    'default'     => [
        'top'     => '#ffffff',
        'bottom'  => '#d9d9f3',
    ],
] );
Arrowit_Kirki::add_field( 'theme', [
    'type'        => 'multicolor',
    'settings'    => 'portfolio_popup_background',
    'label'       => esc_html__( 'Background Color Popup', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'choices'     => [
        'top'     => esc_html__( 'Top Color', 'arrowit' ),
        'bottom'  => esc_html__( 'Bottom Color', 'arrowit' ),
    ],
    'default'     => [
        'top'     => '#ffffff',
        'bottom'  => '#d9d9f3',
    ],
] );