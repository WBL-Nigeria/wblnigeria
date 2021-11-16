<?php
$section  = 'layout';
$priority = 1;
$prefix   = 'site_';
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'General', 'arrowit' ),
	'description' => esc_html__( 'Controls the site general.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'wide',
	'choices'     => array(
		'boxed' => esc_html__( 'Boxed', 'arrowit' ),
		'wide'  => esc_html__( 'Wide', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Site Width', 'arrowit' ),
	'description' => esc_html__( 'Controls the overall site width. Enter value including any valid CSS unit, ex: 1200px.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1200px',
) );