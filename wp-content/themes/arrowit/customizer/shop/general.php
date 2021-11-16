<?php
$section  = 'general_shop';
$priority = 1;
$prefix   = 'general_shop_';
Arrowit_Kirki::add_field( 'theme', [
    'type'        => 'color-alpha',
    'settings'    => $prefix.'background',
    'label'       => esc_html__( 'Background Color', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
] );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'number_cate',
	'label'       => esc_html__( '[Desktop] Number of categories to show', 'arrowit' ),
	'description' => esc_html__( 'This option will work if you select to display categories in shop archive page.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '4',
) );
/*--------------------------------------------------------------
# Product Button
--------------------------------------------------------------*/
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Button', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'add_to_cart',
	'label'       => esc_html__( 'Show Add to Cart button', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_price',
	'label'       => esc_html__( 'Show Product Price', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_quickview',
	'label'       => esc_html__( 'Show Quickview', 'arrowit' ),
	'description' => esc_html__( 'This option will work if you install and active YITH Quickview plugin.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_compare',
	'label'       => esc_html__( 'Show Compare', 'arrowit' ),
	'description' => esc_html__( 'This option will work if you install and active YITH Compare plugin.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_wishlist',
	'label'       => esc_html__( 'Show Wishlist', 'arrowit' ),
	'description' => esc_html__( 'This option will work if you install and active YITH Wishlist plugin.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
/*--------------------------------------------------------------
# Product Lable
--------------------------------------------------------------*/
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Label', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'hot_lable',
	'label'       => esc_html__( 'Show "Hot" Label', 'arrowit' ),
	'description' => esc_html__( 'Will be show in the featured product.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'new_lable',
	'label'       => esc_html__( 'Show "New" Label', 'arrowit' ),
	'description' => esc_html__( 'Will be show in the recent product.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'sale_lable',
	'label'       => esc_html__( 'Show "Sale" Label', 'arrowit' ),
	'description' => esc_html__( 'Will be show in the special product.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'percentage_lable',
	'label'       => esc_html__( 'Show Sale Price Percentage', 'arrowit' ),
	'description' => esc_html__( 'Will be show in the special product.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'arrowit' ),
		'1' => esc_html__( 'On', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'shop_archive_new_days',
	'label'       => esc_html__( 'New Badge (Days)', 'arrowit' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '7',
	'choices'     => array(
		'0'  => esc_html__( 'None', 'arrowit' ),
		'1'  => esc_html__( '1 day', 'arrowit' ),
		'2'  => esc_html__( '2 days', 'arrowit' ),
		'3'  => esc_html__( '3 days', 'arrowit' ),
		'4'  => esc_html__( '4 days', 'arrowit' ),
		'5'  => esc_html__( '5 days', 'arrowit' ),
		'6'  => esc_html__( '6 days', 'arrowit' ),
		'7'  => esc_html__( '7 days', 'arrowit' ),
		'8'  => esc_html__( '8 days', 'arrowit' ),
		'9'  => esc_html__( '9 days', 'arrowit' ),
		'10' => esc_html__( '10 days', 'arrowit' ),
		'15' => esc_html__( '15 days', 'arrowit' ),
		'20' => esc_html__( '20 days', 'arrowit' ),
		'25' => esc_html__( '25 days', 'arrowit' ),
		'30' => esc_html__( '30 days', 'arrowit' ),
		'60' => esc_html__( '60 days', 'arrowit' ),
		'90' => esc_html__( '90 days', 'arrowit' ),
	),
) );