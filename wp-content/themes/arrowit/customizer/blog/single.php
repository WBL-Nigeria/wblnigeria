<?php
$section  = 'blog_single';
$priority = 1;
$prefix   = 'single_post_';
$on = esc_html__( 'On', 'arrowit' );
$off = esc_html__( 'Off', 'arrowit' );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'multicheck',
    'settings'    => $prefix . 'meta',
    'label'       => esc_attr__( 'Post Meta', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array( 'categories', 'author' , 'date', 'tags'),
    'choices'     => array(
        'author'      => esc_attr__( 'Author', 'arrowit' ),
        'categories'  => esc_attr__( 'Categories', 'arrowit' ),
        'date'        => esc_attr__( 'Date', 'arrowit' ),
        'comment'     => esc_attr__( 'Comment', 'arrowit' ),
        'tags'        => esc_attr__( 'Tags', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'comment_enable',
    'label'       => esc_html__( 'Single comment', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '1',
    'choices'     => array(
        '0' => $off,
        '1' => $on,
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => $prefix . 'share_enable',

    'label'       => esc_html__( 'Post Sharing', 'arrowit' ),
    'description' => esc_html__( 'Turn on to display the social sharing on blog single posts.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '0',
    'choices'     => array(
        '0' => esc_html__( 'Off', 'arrowit' ),
        '1' => esc_html__( 'On', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'multicheck',
    'settings'    => $prefix . 'item_enable',
    'label'       => esc_attr__( 'Sharing Links', 'arrowit' ),
    'description' => esc_html__( 'Check to the box to enable social share links.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array( 'facebook', 'twitter', 'gmail','pinterest' ),
    'choices'     => array(
    'facebook'    => esc_attr__( 'Facebook', 'arrowit' ),
    'twitter'     => esc_attr__( 'Twitter', 'arrowit' ),
    'gmail' => esc_attr__( 'Gmail', 'arrowit' ),
    'pinterest' => esc_attr__( 'Pinterest', 'arrowit' ),
    'whatsapp' => esc_attr__( 'Whatsapp', 'arrowit' ),
    ),
    'required'    => array(
        array(
            'setting'  => $prefix . 'share_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'single_post_related_enable',
    'label'       => esc_html__( 'Other news', 'arrowit' ),
    'description' => esc_html__( 'Turn on to display other news post on blog single posts.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '0',
    'choices'     => array(
        '0' => esc_html__( 'Off', 'arrowit' ),
        '1' => esc_html__( 'On', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'textarea',
    'settings' => 'other_news_title',
    'label'    => esc_html__( 'Title other news', 'arrowit' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default' => wp_kses( __('Other news from the Arrowit:','arrowit'),
        array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
        ),
        'p' => array('class' => array()),
        'br' => array(),
        'i' => array(
            'class' => array(),
            'aria-hidden' => array(),
        ),
    )), 
    
    'active_callback' => array(
        array(
            'setting'  => 'single_post_related_enable',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'            => 'number',
    'settings'        => 'single_post_related_number',
    'label'           => esc_html__( 'Number of other posts item', 'arrowit' ),
    'section'         => $section,
    'priority'        => $priority ++,
    'default'         => 3,
    'choices'         => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
    'active_callback' => array(
        array(
            'setting'  => 'single_post_related_enable',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
) );