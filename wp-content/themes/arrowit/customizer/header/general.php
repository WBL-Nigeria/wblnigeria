<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';
$link_id =Arrowit::setting('choose_header_builder');
$link = '<a target="_blank" href="post.php?action=edit&post='.$link_id.'" class="link_edit_header_buider">Go to header buider</a>';

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_layout' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Layout', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'enable_header_builder',
    'label'       => esc_html__( 'Enable Header Builder', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 0,
) );


Arrowit_Kirki::add_field ('theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'header_layout_style',
    'label'       => __( 'Header layout style', 'arrowit' ),
    'section'     => $section,
    'default'     => 'wide',
    'priority'    => $priority ++,
    'choices'     => array(
        'wide'        => esc_attr__( 'Wide', 'arrowit' ),
        'full_width'  => esc_attr__( 'Full Width', 'arrowit' ),
    ),
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
    ),
));
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'show_cart',
    'label'       => esc_html__( 'Show Mini Cart', 'arrowit' ),
    'description' => esc_html__( 'Turn on to show mini cart.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 1,
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'show_search',
    'label'       => esc_html__( 'Show Search', 'arrowit' ),
    'description' => esc_html__( 'Turn on to show search.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     =>  1,
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'show_account',
    'label'       => esc_html__( 'Show Account', 'arrowit' ),
    'description' => esc_html__( 'Turn on to show account.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     =>  '',
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => 'choose_header_builder',
    'label'       => esc_html__( 'Default Header', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'choices'     => arrowit_get_headers_post_type(),
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'my_config', array(
    'type'     => 'custom',
    'settings' => 'link_edit_header_buider',
    'section'     => $section,
    'priority'    => $priority ++,
    'default'  => $link,
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_header_fix' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Header fix', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'fixed_header',
	'label'       => esc_html__( 'Enable Fixed Header', 'arrowit' ),
	'description' => esc_html__( 'Header displays over content', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'header_fix_bg_img',
    'label'    => esc_html__( 'Show/Hide Header Background', 'arrowit' ),
    'description' => esc_html__( 'Option header fixed.', 'arrowit' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '0',
    'choices'  => array(
        '0' => esc_html__( 'No', 'arrowit' ),
        '1' => esc_html__( 'Yes', 'arrowit' ),
    ),
    'required'  => array(
        array(
            'setting'  => 'fixed_header',
            'operator' => '==',
            'value'    => 1,
        ),
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'image_setting_array',
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-color'      => '',
        'background-image'      => '',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ),
    'output'      => array(
        array(
            'element'  => '.header-fixed .site-header',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_fix_bg_img',
            'operator' => '==',
            'value'    => 1,
        ),
        array(
            'setting'  => 'fixed_header',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_sticky' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Header sticky', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'header_sticky_enable',
    'label'       => esc_html__( 'Sticky Enable', 'arrowit' ),
    'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 0,
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'image',
    'settings' => 'header_sticky_logo',
    'label'    => esc_html__( 'Logo Sticky', 'arrowit' ),
    'description' => esc_html__('Select an image file for your logo','arrowit'),
    'section'  => $section,
    'priority' => $priority ++,
    'transport' => 'auto',
    'default'  => ARROWIT_THEME_URI . '/assets/images/logo-seo.png',
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
        array(
            'setting'  => 'header_sticky_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

// Show search
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'show_search_sticky',
    'label'       => esc_html__( 'Show Search', 'arrowit' ),
    'description' => esc_html__( 'Turn on to show search.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '1',
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
        array(
            'setting'  => 'header_sticky_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
// Show minicart
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'show_mini_cart_sticky',
    'label'       => esc_html__( 'Show Mini Cart', 'arrowit' ),
    'description' => esc_html__( 'Turn on to show mini cart.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
        array(
            'setting'  => 'header_sticky_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'show_account_sticky',
    'label'       => esc_html__( 'Show Account', 'arrowit' ),
    'description' => esc_html__( 'Turn on to show account.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     =>  '',
    'required'  => array(
        array(
            'setting'  => 'enable_header_builder',
            'operator' => '==',
            'value'    => 0,
        ),
        array(
            'setting'  => 'header_sticky_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
