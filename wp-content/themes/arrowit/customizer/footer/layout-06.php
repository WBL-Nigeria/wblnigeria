<?php
$section  = 'footer_layout_06';
$priority = 1;
$prefix   = 'footer_06_';

Arrowit_Kirki::add_field( 'theme', [
	'type'        => 'image',
	'settings'    => $prefix . 'group_title_' . $priority ++,
	'description' => esc_html__( 'Footer06 image demonstration.', 'arrowit' ),
	'section'     => $section,
	'priority' 	  => $priority ++,
	'default'     => ARROWIT_THEME_URI . '/assets/images/footer/footer06.jpg',
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
			'element' => '.footer-06',
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
				.footer-06 .list-info-contact li span,
				.footer-06 .widget-title',
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
				.footer-06 .tm-social-widget .title-desc,
				.footer-06 .list-info-contact li a, 
				.footer-06 .list-info-contact li p,
				.footer-06 .footer-copyright p,
				.footer-06 .footer-copyright p a',
			'property' => 'color',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'tt_form_color',
	'label'       => esc_html__( 'Text Title Form Color', 'arrowit' ),
	'description' => esc_html__( 'Controls the title form color of text on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-06 .footer-contact-form .widget-title',
			'property' => 'color',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'text_form_color',
	'label'       => esc_html__( 'Text form color', 'arrowit' ),
	'description' => esc_html__( 'Controls the placeholder color of form text on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-06 input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=email]::-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=email]:-ms-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=email]:-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=email]::-webkit-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=email]::-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=email]:-ms-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=email]:-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=text]::-webkit-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=text]::-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=text]:-ms-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 input[type=text]:-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 textarea::-webkit-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 textarea::-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 textarea:-ms-input-placeholder',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'element'  => '
				.footer-06 textarea:-moz-placeholder', 
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'button_color',
	'label'       => esc_html__( 'Background Button color', 'arrowit' ),
	'description' => esc_html__( 'Controls the color of button & name contact on footer.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
				.footer-06 .wpcf7-form .form-submit input[type=submit]',
			'property' => 'background',

		),
		array(
			'element'  => '
				.footer-06 .wpcf7-form .form-submit input[type=submit]',
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
				.footer-06 .list-info-contact li a:hover,
				.footer-06 .footer-copyright p a:hover',
			'property' => 'color',
		),
		
	),
) );
