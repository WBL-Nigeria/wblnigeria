<?php
$section  = 'footer_layout_04';
$priority = 1;
$prefix   = 'footer_04_';

Arrowit_Kirki::add_field( 'theme', [
	'type'        => 'image',
	'settings'    => $prefix . 'group_title_' . $priority ++,
	'description' => esc_html__( 'Footer04 image demonstration.', 'arrowit' ),
	'section'     => $section,
	'priority' 	  => $priority ++,
	'default'     => ARROWIT_THEME_URI . '/assets/images/footer/footer04.jpg',
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
			'element' => '.footer-04',
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
				.footer-04 .widget-title,
				.footer-04 .list-info-contact li span',
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
				.footer-04 .list-info-contact li i,
				.footer-04 .mc4wp-form-fields input[type=email],
				.footer-04 input[type=email], 
				.footer-04 input[type=password], 
				.footer-04 input[type=text],
				.footer-04 textarea,
				.footer-04 .tm-social-widget .title-desc,
				.footer-04 .footer-contact .title-desc,
				.footer-04 .footer-menu ul li a,
				.footer-04 .list-info-contact li a, 
				.footer-04 .list-info-contact li p,
				.footer-04 .footer-copyright p,
				.footer-04 .footer-copyright p a',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 .mc4wp-form-fields input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 .mc4wp-form-fields input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 .mc4wp-form-fields input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=text]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=text]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=text]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 input[type=text]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 textarea::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 textarea::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 textarea:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 textarea:-moz-placeholder', 
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
				.footer-04 .footer-social-networks li a',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 .wpcf7-form .form-submit input[type=submit]',
			'property' => 'background',
		),
	),
) );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'button_hover_color',
	'label'       => esc_html__( 'Button hover color', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of button hover on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-04 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover,
				.footer-04 .wpcf7-form .form-submit input[type=submit]:hover',
			'property' => 'background',
		),
		array(
			'element'  => '
				.footer-04 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover,
				.footer-04 .wpcf7-form .form-submit input[type=submit]:hover',
			'property' => 'border-color',
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
				.footer-04 .list-info-contact li a:hover,
				.footer-04 .footer-copyright p a:hover',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-04 .footer-social-networks li a:hover',
			'property' => 'background',
		),
	),
) );
