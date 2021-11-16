<?php
$panel    = 'general';
$priority = 1;
Arrowit_Kirki::add_section( 'layout-config', array(
    'title'    => esc_html__( 'Layout', 'arrowit' ),
    'panel'    => $panel,
    'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'color-config', array(
	'title'    => esc_html__( 'Color', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'typography-config', array(
	'title'    => esc_html__( 'Typography', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'preloader-config', array(
	'title'    => esc_html__( 'Preloader', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'breadcrumb-config', array(
	'title'    => esc_html__( 'Breadcrumbs & Page Title', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );