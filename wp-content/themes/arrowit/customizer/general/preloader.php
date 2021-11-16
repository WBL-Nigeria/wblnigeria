<?php
$section  = 'preloader-config';
$priority = 1;
$prefix   = 'general_';
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'preloader',
	'label'    => esc_html__( 'Show/Hide Preloader.', 'arrowit' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'arrowit' ),
		'1' => esc_html__( 'Yes', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-image',
	'settings'    => 'preloader-image',
	'label'       => esc_html__( 'Preloader Control', 'arrowit' ),
	'section'  => $section,
	'priority' => $priority ++,
	'choices'     => array(
		'preload-1'   => get_template_directory_uri() . '/assets/images/preloader/preload-1.jpg',
		'preload-2'   => get_template_directory_uri() . '/assets/images/preloader/preload-2.jpg',
		'preload-3'   => get_template_directory_uri() . '/assets/images/preloader/preload-3.jpg',
		'preload-4'   => get_template_directory_uri() . '/assets/images/preloader/preload-4.jpg',
		'preload-5'   => get_template_directory_uri() . '/assets/images/preloader/preload-5.jpg',
		'preload-6'   => get_template_directory_uri() . '/assets/images/preloader/preload-6.jpg',
		'preload-7'   => get_template_directory_uri() . '/assets/images/preloader/preload-7.jpg',
		'preload-8'   => get_template_directory_uri() . '/assets/images/preloader/preload-8.jpg',
		'preload-9'   => get_template_directory_uri() . '/assets/images/preloader/preload-9.jpg',
	),
	'required'  => array(
        array(
            'setting'  => 'preloader',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );