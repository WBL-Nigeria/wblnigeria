<?php
$section  = 'breadcrumb-config';
$priority = 1;
$prefix   = 'general_';
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_title_' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Styling', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'      => 'spacing',
    'settings'  => $prefix . 'padding',
    'label'     => esc_html__( 'Padding', 'arrowit' ),
    'description' => esc_html__( 'Default padding:76px(top), 74px(bottom).', 'arrowit' ),
    'section'   => $section,
    'priority'  => $priority ++,
    'default'   => array(
        'top'    => '76px',
        'bottom' => '77px',
    ),
    'transport' => 'auto',
    'output'    => array(
        array(
            'element'  => array(
                '.side-breadcrumb',
            ),
            'property' => 'padding',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => $prefix . 'align',
    'label'     => esc_html__( 'Align', 'arrowit' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => 'center',
    'choices'  => array(
        'left' => esc_html__( 'Left', 'arrowit' ),
        'center' => esc_html__( 'Center', 'arrowit' ),
        'right' => esc_html__( 'Right', 'arrowit' ),
    ),
    'output'    => array(
        array(
            'element'  => array(
                '.side-breadcrumb',
            ),
            'property' => 'text-align',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'background_overlay',
    'label'       => esc_html__( 'Background Overlay', 'arrowit' ),
    'description' => esc_html__( 'Controls the background overlay of breadcrumb.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'output'      => array(
        array(
            'element' => '.side-breadcrumb:before',
            'property' => 'background'
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'text',
    'settings' => 'bg_opacity',
    'label'    => __( 'Enter opacity to set background opacity, default: 0.8.', 'arrowit' ),
    'section'  => $section,
    'default'  => esc_attr__( '0.8', 'arrowit' ),
    'priority' => $priority ++,
    'output'   => array(
        array(
            'element'  => '.side-breadcrumb:before',
            'property' => 'opacity',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'background',
    'label'       => esc_html__( 'Background', 'arrowit' ),
    'description' => esc_html__( 'Controls the background of breadcrumb. Note: Setting background image for breadcrumbs on the specific page has priority over that on customizing section which is the default for all pages. Background color is not applied when background image is applied.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-color'      => '',
        'background-image'      => ARROWIT_THEME_URI . '/assets/images/bg-breadcrumb.jpg',
        'background-repeat'     => 'no-repeat',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
        'background-position'   => 'center center',
    ),
    'output'      => array(
        array(
            'element' => '.side-breadcrumb',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_title_' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Page Title', 'arrowit' ) . '</div>',
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'page_title',
    'label'    => esc_html__( 'Page Title.', 'arrowit' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '1',
    'choices'  => array(
        '0' => esc_html__( 'Hide', 'arrowit' ),
        '1' => esc_html__( 'Show', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'typography',
    'settings'    => 'page_title_typography',
    'label'       => esc_html__( 'Typography', 'arrowit' ),
    'description' => esc_html__( 'These settings control the typography for page title.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => array(
        'font-family'    => Arrowit::PRIMARY_FONT,
        'variant'        => '500',
        'letter-spacing' => '0.015em',
        'font-size'      =>  '40px',
        'text-transform' => 'capitalize'
    ),
	'choices'     => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
    'output'      => array(
        array(
            'element' => '.side-breadcrumb .page-title h1',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'page_title',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'page_title_color',
    'label'       => esc_html__( 'Color for page title', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
    'output'      => array(
        array(
            'element'  => '.side-breadcrumb .page-title h1',
            'property' => 'color',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'page_title',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_title_' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'breadcrumb',
    'label'    => esc_html__( 'Breadcrumb.', 'arrowit' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '1',
    'choices'  => array(
        '0' => esc_html__( 'Hide', 'arrowit' ),
        '1' => esc_html__( 'Show', 'arrowit' ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'link_align',
    'label'    => esc_html__( 'Align breadcrumb link.', 'arrowit' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => 'center',
    'choices'  => array(
        'left' => esc_html__( 'Left', 'arrowit' ),
        'right' => esc_html__( 'Right', 'arrowit' ),
        'center' => esc_html__( 'Center', 'arrowit' ),
    ),
    'output'      => array(
        array(
            'element'  => '.col-xl-12 .breadcrumb',
            'property' => 'text-align',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'page_title',
            'operator' => '==',
            'value'    => 0,
        ),
        array(
            'setting' => 'breadcrumb',
            'operator' => '==',
            'value'    => 1,
        ),
    ),

) );

// Icon link

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'typography',
    'settings'    => 'link_typography',
    'label'       => esc_html__( 'Typography', 'arrowit' ),
    'description' => esc_html__( 'These settings control the typography for breadcrumb link.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => array(
        'font-family'    => Arrowit::PRIMARY_FONT,
        'variant'    => '600',
        'letter-spacing' => '0.05em',
        'text-transform' => 'Capitalize'
    ),
	'choices'     => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
    'output'      => array(
        array(
            'element' => '.breadcrumb li, 
                        .breadcrumb li a',
        ),
    ),
    'required' => array(
        array(
            'setting' => 'breadcrumb',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'slider',
    'settings'    => 'text_font_size',
    'label'       => esc_html__( 'Breadcrumb Link Font Size', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 16,
    'transport'   => 'auto',
    'choices'     => array(
        'min'  => 10,
        'max'  => 30,
        'step' => 1,
    ),
    'output'      => array(
        array(
            'element'  => '.breadcrumb li:before, 
                            .breadcrumb li:last-child, 
                            .breadcrumb li a',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
    'required' => array(
        array(
            'setting' => 'breadcrumb',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'link_color',
    'label'       => esc_html__( 'Color for breadcrumb link', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
    'output'      => array(
        array(
            'element'  => '.breadcrumb li .home, .breadcrumb li a',
            'property' => 'color',
        ),
    ),
    'required' => array(
        array(
            'setting' => 'breadcrumb',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'text_color',
    'label'       => esc_html__( 'Color for breadcrumb', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
    'output'      => array(
        array(
            'element'  => '.breadcrumb li, .breadcrumb li:before',
            'property' => 'color',
        ),
    ),
    'required' => array(
        array(
            'setting' => 'breadcrumb',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );


