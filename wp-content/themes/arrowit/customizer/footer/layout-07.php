<?php
$section  = 'footer_layout_07';
$priority = 1;
$prefix   = 'footer_07_';

Arrowit_Kirki::add_field( 'theme', [
	'type'        => 'image',
	'settings'    => $prefix . 'group_title_' . $priority ++,
	'description' => esc_html__( 'Footer07 image demonstration.', 'arrowit' ),
	'section'     => $section,
	'priority' 	  => $priority ++,
	'default'     => ARROWIT_THEME_URI . '/assets/images/footer/footer07.jpg',
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
			'element' => '.footer-07',
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
				.footer-07 .footer-content .widget-title, 
				.footer-07 .tm-posts-widget .view_more, 
				.footer-07 .footer-social-networks li a,
				.footer-07 .f7rp ul li a',
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
                .footer-07 .tm-social-widget .title-desc,
                .footer-07 .footer-07 .f7rp ul li a,
				.footer-07 .footer-copyright p,
				.footer-07 .footer-copyright p a,
				.footer-07 .f7rp ul li span',
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
				.footer-07 .list-info-contact li a:hover,
				.footer-07 .footer-copyright p a:hover,
				.footer-07 .f7rp ul li a:hover,
				.footer-07 .view_more:hover,
				.footer-07 .footer-social-networks li a:hover',
			'property' => 'color',
		),
		array(
			'element'  => '.footer-07 .tm-posts-widget .view_more:before',
			'property' => 'background-color',
		)
	),
) );
