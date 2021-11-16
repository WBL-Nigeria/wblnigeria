<?php
$section  = 'footer_layout_02';
$priority = 1;
$prefix   = 'footer_02_';

Arrowit_Kirki::add_field( 'theme', [
	'type'        => 'image',
	'settings'    => $prefix . 'group_title_' . $priority ++,
	'description' => esc_html__( 'Footer02 image demonstration.', 'arrowit' ),
	'section'     => $section,
	'priority' 	  => $priority ++,
	'default'     => ARROWIT_THEME_URI . '/assets/images/footer/footer02.jpg',
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
			'element' => '.footer-02, .footer-02 .footer-content',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Color Options', 'arrowit' ) . '</div>',
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
				.footer-02 .footer-contact-form h2,
				.footer-02 .list-info-contact li span',
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
				.footer-02 .list-info-contact li i,
				.footer-02 .mc4wp-form-fields input[type=email],
				.footer-02 input[type=email], 
				.footer-02 input[type=text],
				.footer-02 textarea,
				.footer-02 .list-info-contact li p,
				.footer-02 .list-info-contact li a',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 .mc4wp-form-fields input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 .mc4wp-form-fields input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 .mc4wp-form-fields input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=email]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=email]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=email]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=text]::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=text]::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=text]:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 input[type=text]:-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 textarea::-webkit-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 textarea::-moz-placeholder', 
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 textarea:-ms-input-placeholder',
			'property' => 'color',
		),
		array(
			'element'  => '
				.footer-02 textarea:-moz-placeholder', 
			'property' => 'color',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'copyright_color',
	'label'       => esc_html__( 'Text copyright color', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of text on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-02 .footer-copyright p, 
				.footer-02 .footer-copyright p a',
			'property' => 'color',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'button_color',
	'label'       => esc_html__( 'Button color', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of button on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit],
				.footer-02 .wpcf7-form .form-submit input[type=submit]',
			'property' => 'background-color',
		),
		array(
			'element'  => '
				.footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit],
				.footer-02 .wpcf7-form .form-submit input[type=submit]',
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
				.footer-02 .list-info-contact li a:hover,
				.footer-02 .footer-copyright p a:hover',
			'property' => 'color',
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
				.footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover,
				.footer-02 .wpcf7-form .form-submit input[type=submit]:hover',
			'property' => 'background',
		),
		array(
			'element'  => '
				.footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover,
				.footer-02 .wpcf7-form .form-submit input[type=submit]:hover',
			'property' => 'border-color',
		),
	),
) );