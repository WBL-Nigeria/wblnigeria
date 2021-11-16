<?php
$panel    = 'shop';
$priority = 1;
Arrowit_Kirki::add_section( 'general_shop', array(
	'title'    => esc_html__( 'General', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'shop_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'shop_single', array(
	'title'    => esc_html__( 'Shop Single', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'shopping_cart', array(
	'title'    => esc_html__( 'Shopping Cart', 'arrowit' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );