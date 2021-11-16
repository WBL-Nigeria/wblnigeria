<?php
$section  = 'footer_layout_01';
$priority = 1;
$prefix   = 'footer_01_';

Arrowit_Kirki::add_field( 'theme', [
	'type'        => 'image',
	'settings'    => $prefix . 'group_title_' . $priority ++,
	'description' => esc_html__( 'Footer01 image demonstration.', 'arrowit' ),
	'section'     => $section,
	'priority' 	  => $priority ++,
	'default'     => ARROWIT_THEME_URI . '/assets/images/footer/footer01.jpg',
] );

Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Background Footer', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'arrowit' ),
	'description' => esc_html__( 'Controls the background of footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.footer-01',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Background Footer Top', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background_top',
	'label'       => esc_html__( 'Background', 'arrowit' ),
	'description' => esc_html__( 'Controls the background top of footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'background-color'      => '#58468c',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-footer.footer-01 .footer-top',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Background Footer Bottom', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background_bottom',
	'label'       => esc_html__( 'Background', 'arrowit' ),
	'description' => esc_html__( 'Controls the background bottom of footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'background-color'      => '#f0f0f5',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.footer-01 .footer-bottom',
		),
	),
) );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'menu_top_color',
	'label'       => esc_html__( 'Text Link Menu Color', 'arrowit' ),
	'description' => esc_html__( 'Controls the link menu color of text on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
				.footer-01 .footer-top .footer-menu ul li a',
			'property' => 'color',
		),
	),
) );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'tt_color',
	'label'       => esc_html__( 'Text Title Color', 'arrowit' ),
	'description' => esc_html__( 'Controls the title color of text on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-01 .widget-title',
			'property' => 'color',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text color', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of text on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-01 .tm-social-widget .title-desc,
				.footer-01 .list-info-contact li a, 
				.footer-01 .list-info-contact li p,
				.footer-01 .footer-copyright p,
				.footer-01 .footer-copyright p a',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 .mc4wp-form-fields input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 .mc4wp-form-fields input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 .mc4wp-form-fields input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=text]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=text]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=text]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 input[type=text]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 textarea::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 textarea::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 textarea:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 textarea:-moz-placeholder', 
			'property' => 'color',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'button_color',
	'label'       => esc_html__( 'Background Button color & Name contact', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of button & name contact on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-01 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover,
				.footer-01 .open-newsletter.btn-highlight',
			'property' => 'background',
		),
		array(
			'element'  => '
				.footer-01 .list-info-contact li span',
			'property' => 'color',
		),
		array(
			'element' => '.footer-01 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover',
			'property' => 'border-color',
 		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'social_link_color',
	'label'       => esc_html__( 'Social link color', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of social link on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-01 .tm-posts-widget .view_more,
				.footer-01 .footer-social-networks li a',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-01 .tm-posts-widget .view_more:before,
				.footer-01 .footer-social-networks li a:hover',
			'property' => 'background',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link hover color', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of link hover on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-01 .footer-top .footer-menu ul li a:hover,
				.footer-01 .list-info-contact li a:hover,
				.footer-01 .footer-copyright p a:hover',
			'property' => 'color',
		),
	),
) );
