<?php
$section  = 'blog_archive';
$priority = 1;
$prefix   = 'blog_archive_';
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'layout',
    'label'       => esc_html__( 'Blog Layout', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'list',
    'choices'     => array(
        'list'    => esc_html__( 'List', 'arrowit' ),
        'grid'    => esc_html__( 'Grid', 'arrowit' ),
        'masonry'    => esc_html__( 'Masonry', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'columns_list',
    'label'       => esc_html__( ' Number Columns', 'arrowit' ),
    'description' => esc_html__( 'Select columns for blog.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '1',
    'choices'     => array(
        '1' => esc_html__( '1 col', 'arrowit' ),
        '2' => esc_html__( '2 col', 'arrowit' ),
    ),
    'required'  => array(
        array(
            'setting'  => 'blog_archive_layout',
            'operator' => '==',
            'value'    => 'list',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'columns_grid',
    'label'       => esc_html__( ' Number Columns', 'arrowit' ),
    'description' => esc_html__( 'Select columns for blog.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '2',
    'choices'     => array(
        '1' => esc_html__( '1 col', 'arrowit' ),
        '2' => esc_html__( '2 col', 'arrowit' ),
        '3' => esc_html__( '3 col', 'arrowit' ),
        '4' => esc_html__( '4 col', 'arrowit' ),
    ),
    'required'  => array(
         array(
            'setting'  => 'blog_archive_layout',
            'operator' => '==',
            'value'    => 'grid',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'columns_masonry',
    'label'       => esc_html__( ' Number Columns', 'arrowit' ),
    'description' => esc_html__( 'Select columns for blog.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '2',
    'choices'     => array(
        '2' => esc_html__( '2 col', 'arrowit' ),
        '3' => esc_html__( '3 col', 'arrowit' ),
        '4' => esc_html__( '4 col', 'arrowit' ),
    ),
    'required'  => array(
         array(
            'setting'  => 'blog_archive_layout',
            'operator' => '==',
            'value'    =>  'masonry',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'multicheck',
    'settings'    => $prefix . 'post_meta_list',
    'label'       => esc_attr__( 'Post Meta', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array( 'categories', 'author' , 'date' , 'tags'),
    'choices'     => array(
        'author'      => esc_attr__( 'Author', 'arrowit' ),
        'categories'  => esc_attr__( 'Categories', 'arrowit' ),
        'date'        => esc_attr__( 'Date', 'arrowit' ),
        'comment'     => esc_attr__( 'Comment', 'arrowit' ),
        'tags'        => esc_attr__( 'Tags', 'arrowit' ),
    ),
    'required'  => array(
         array(
            'setting'  => 'blog_archive_layout',
            'operator' => '==',
            'value'    =>  'list',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'multicheck',
    'settings'    => $prefix . 'post_meta_grid',
    'label'       => esc_attr__( 'Post Meta', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array( 'categories', 'author', 'date', 'tags'),
    'choices'     => array(
        'author'      => esc_attr__( 'Author', 'arrowit' ),
        'categories'  => esc_attr__( 'Categories', 'arrowit' ),
        'date'        => esc_attr__( 'Date', 'arrowit' ),
        'comment'     => esc_attr__( 'Comment', 'arrowit' ),
        'tags'        => esc_attr__( 'Tags', 'arrowit' ),
    ),
    'required'  => array(
        array(
            'setting'  => 'blog_archive_layout',
            'operator' => '==',
            'value'    =>  'grid',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'multicheck',
    'settings'    => $prefix . 'post_meta_masonry',
    'label'       => esc_attr__( 'Post Meta', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array('date'),
    'choices'     => array(
        'date'        => esc_attr__( 'Date', 'arrowit' ),
        'categories'  => esc_attr__( 'Categories', 'arrowit' ),
        'author'      => esc_attr__( 'Author', 'arrowit' ),
        'comment'     => esc_attr__( 'Comment', 'arrowit' ),
        'tags'        => esc_attr__( 'Tags', 'arrowit' ),
    ),
    'required'  => array(
         array(
            'setting'  => 'blog_archive_layout',
            'operator' => '==',
            'value'    =>  'masonry',
        ),
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