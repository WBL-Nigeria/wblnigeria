<?php
$panel    = 'blog';
$priority = 1;
Arrowit_Kirki::add_section( 'blog_general', array(
	'title'    => esc_html__( 'General', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'blog_single', array(
	'title'    => esc_html__( 'Blog Single Post', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );