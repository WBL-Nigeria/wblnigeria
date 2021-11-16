<?php
$section  = 'footer_layout_05';
$priority = 1;
$prefix   = 'footer_05_';

Arrowit_Kirki::add_field( 'theme', [
	'type'        => 'image',
	'settings'    => $prefix . 'group_title_' . $priority ++,
	'description' => esc_html__( 'Footer05 image demonstration.', 'arrowit' ),
	'section'     => $section,
	'priority' 	  => $priority ++,
	'default'     => ARROWIT_THEME_URI . '/assets/images/footer/footer05.jpg',
] );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'arrowit' ),
	'description' => esc_html__( 'Controls the background of footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'background-color'      => '#292a41',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.footer-05',
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
				.footer-05 .widget-title',
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
				.footer-05 .list-info-contact li i,
				.footer-05 .mc4wp-form-fields input[type=email],
				.footer-05 input[type=email], 
				.footer-05 input[type=password], 
				.footer-05 input[type=text],
				.footer-05 textarea,
				.footer-05 .tm-social-widget .title-desc,
				.footer-05 .footer-contact .title-desc,
				.footer-05 .footer-menu ul li a,
				.footer-05 .list-info-contact li a, 
				.footer-05 .list-info-contact li p,
				.footer-05 .footer-copyright p,
				.footer-05 .footer-copyright p a,
				.footer-05 .mc4wp-form-fields .form-submit.submit input[type="submit"],
				.footer-05 .mc4wp-form-fields .form-submit.submit::before',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 .mc4wp-form-fields input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 .mc4wp-form-fields input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 .mc4wp-form-fields input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=text]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=text]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=text]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 input[type=text]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 textarea::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 textarea::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 textarea:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 textarea:-moz-placeholder', 
			'property' => 'color',
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
				.footer-05 .footer-social-networks li a',
			'property' => 'color',
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
				.footer-05 .footer-social-networks li a:hover,
				.footer-05 .footer-copyright p a:hover',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-05 .footer-social-networks li a:hover',
			'property' => 'border-color',
		),
	),
) );
