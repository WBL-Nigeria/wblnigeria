<?php
$section  = 'color-config';
$priority = 1;
$prefix   = 'general_';
$show = esc_html__( 'Show', 'arrowit' );
$hide = esc_html__( 'Hide', 'arrowit' );

/*--------------------------------------------------------------
# Color
--------------------------------------------------------------*/
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_color' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Color', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field ('theme', array(
    'type'        => 'toggle',
    'settings'    => $prefix .'gradient',
    'label'       => __( 'Enable gradient color', 'arrowit' ),
    'section'     => $section,
    'default'     => '0',
    'priority'    => $priority ++,
));

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'primary_color',
	'label'       => esc_html__( 'Primary Color', 'arrowit' ),
	'description' => esc_html__( 'If you select a color, there is only one main color, while two colors change it to a gradient.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Arrowit::PRIMARY_COLOR,
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color-alpha',
    'settings'    => 'hightlight_color',
    'label'       => esc_html__( 'Hightlight Color', 'arrowit' ),
    'description' => esc_html__( ' Controls the gradient color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => Arrowit::HIGHTLIGHT_COLOR,
) );

/*--------------------------------------------------------------
# Body background
--------------------------------------------------------------*/

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_bg' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Body background', 'arrowit' ) . '</div>',
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'image_body',
    'label'       => esc_html__( 'Background', 'arrowit' ),
    'description' => esc_html__( 'Controls background of the outer background area in boxed mode.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
	'transport'   => 'auto',
    'default'     => array(
        'background-color'      => 'rgba(255,255,255,0)',
        'background-image'      => '',
        'background-repeat'     => 'no-repeat',
        'background-size'       => 'contain',
        'background-attachment' => 'scroll',
        'background-position'   => 'center center',
    ),
    'output'      => array(
        array(
            'element' => 'html body',
        ),
    ),
) );

/*--------------------------------------------------------------
# Button Color
--------------------------------------------------------------*/

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_title_button' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Button', 'arrowit' ) . '</div>',
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings' => 'btn_custom',
    'label'    => esc_html__( 'Enable Custom', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 0,
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color-alpha',
    'settings'    => 'btn_primary_color',
    'label'       => esc_html__( 'Primary Color', 'arrowit' ),
    'description' => esc_html__( 'If you select a color, there is only one main color, while two colors change it to a gradient.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => Arrowit::PRIMARY_COLOR,
    'required'  => array(
        array(
            'setting'  => 'btn_custom',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color-alpha',
    'settings'    => 'btn_secondary_color',
    'label'       => esc_html__( 'Secondary Color', 'arrowit' ),
    'description' => esc_html__( ' Controls the gradient color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => Arrowit::SECONDARY_COLOR,
    'required'  => array(
        array(
            'setting'  => 'btn_custom',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );