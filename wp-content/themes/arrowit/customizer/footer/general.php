<?php
$section  = 'footer';
$priority = 1;
$prefix   = 'footer_';
$footers = Arrowit_Helper::get_footer_list();
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'footer_layout',
    'label'       => esc_html__( 'Footer Layout', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'full_width',
    'choices'     => array(
        'wide' => esc_html__( 'Wide', 'arrowit' ),
        'full_width'   => esc_html__( 'Full Width', 'arrowit' )
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'global_footer',
	'label'       => esc_html__( 'Default Footer', 'arrowit' ),
	'description' => esc_html__( 'Select default footer type for your site.', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '01',
	'choices'     => Arrowit_Helper::get_footer_list(  ),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_footer',
	'label'    => esc_html__( 'Logo', 'arrowit' ),
	'description' => esc_html__('Select an image file for your logo','arrowit'),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => ARROWIT_THEME_URI . '/assets/images/logo-footer.png',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => 'footer_copyright',
	'label'    => esc_html__( 'Copyright', 'arrowit' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default' => wp_kses( __(' <p>Copyright &copy;2007 &ndash; 2019 by <a href="#">ArrowIT</a>. All Rights Reserved.</p>', 'arrowit'),
        array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
        ),
        'p' => array('class' => array()),
        'br' => array(),
        'i' => array(
            'class' => array(),
            'aria-hidden' => array(),
        ),
    )), 
) );
