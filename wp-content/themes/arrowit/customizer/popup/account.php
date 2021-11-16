<?php
$section  = 'account';
$priority = 1;
$prefix   = 'account_';
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'setting_popup',
	'label'    => esc_html__( 'Show/Hide Account.', 'arrowit' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'arrowit' ),
		'1' => esc_html__( 'Yes', 'arrowit' ),
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'overlay_bg_new',
    'label'       => esc_html__( 'Background Overlay', 'arrowit' ),
    'description' => esc_html__( 'Controls background of the outer background area of the pop-up.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-color'      => '',
        'background-image'      => '',
        'background-repeat'     => 'no-repeat',
        'background-size'       => 'cover',
        'background-attachment' => 'fixed',
        'background-position'   => 'center center',
    ),
    'output'      => array(
        array(
            'element' => '.show-bg-fancybox .fancybox-bg',
            'suffix' => '!important',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'slider',
    'settings'    => $prefix . 'overlay_bg_opacity',
    'label'       => esc_html__( 'Background Overlay Opacity', 'arrowit' ),
    'description' => esc_html__( 'Controls background opacity of the outer background area of the pop-up.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 1,
    'choices'     => [
		'min'  => 0,
		'max'  => 1,
		'step' => 0.1,
	],
    'output'      => array(
        array(
            'element' => '.fancybox-is-open.fancybox-container .fancybox-bg',
            'property'    => 'opacity',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'popup_bg_new',
    'label'       => esc_html__( 'Background Popup', 'arrowit' ),
    'description' => esc_html__( 'Controls background of the pop-up.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-color'      => '',
        'background-image'      => '',
        'background-repeat'     => 'no-repeat',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
        'background-position'   => 'left center',
    ),
    'output'      => array(
        array(
            'element' => '#account-popup',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'popup_img_left_new',
    'label'       => esc_html__( 'Popup Left Image', 'arrowit' ),
    'description' => esc_html__( 'Controls the image on the left of the pop-up.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-image'      => '',
        'background-size'       => 'contain',
        'background-attachment' => 'scroll',
        'background-repeat'     => 'no-repeat',
    ),
    'output'      => array(
        array(
            'element' => '#account-popup:before',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'popup_img_right_new',
    'label'       => esc_html__( 'Popup Right Image', 'arrowit' ),
    'description' => esc_html__( 'Controls the image on the right of the pop-up.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-image'      => '',
        'background-size'       => 'contain',
        'background-attachment' => 'scroll',
        'background-repeat'     => 'no-repeat',
    ),
    'output'      => array(
        array(
            'element' => '#account-popup:after',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'popup_img_top_new',
    'label'       => esc_html__( 'Popup Top Image', 'arrowit' ),
    'description' => esc_html__( 'Controls the image on top of the pop-up.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-image'      => '',
        'background-size'       => 'contain',
        'background-attachment' => 'scroll',
        'background-repeat'     => 'no-repeat',
    ),
    'output'      => array(
        array(
            'element' => '.logo-account:before',
        ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'width',
	'label'    => esc_html__( 'Width Account', 'arrowit' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '710px',
	'output'      => array(
        array(
			'media_query' => '@media (min-width: 767px)',
            'element' => '.account-popup',
			'property' => 'width',
        ),
    ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => $prefix . 'logo_account',
	'label'    => esc_html__( 'Logo Account', 'arrowit' ),
	'description' => esc_html__('Select an image file for your logo','arrowit'),
	'section'  => $section,
	'priority' => $priority ++,
	'transport' => 'auto',
	'default'  => ARROWIT_THEME_URI . '/assets/images/logo-text.png',
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'title_login',
	'label'    => esc_html__( 'Title Login', 'arrowit' ),
	'description'    => esc_html__( 'Show with site using one language', 'arrowit' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Login', 'arrowit' ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'title_register',
	'label'    => esc_html__( 'Title Register', 'arrowit' ),
	'description'    => esc_html__( 'Show with site using one language', 'arrowit' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Register', 'arrowit' ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => $prefix . 'title_color',
	'label'       => esc_html__( 'Title Color', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
	'output'      => array(
        array(
            'element' => '.account-popup .nav-tabs .nav-link.active',
			'property' => 'color',
        ),
    ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => $prefix . 'color_popup',
	'label'       => esc_html__( 'Text Color', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
	'output'      => array(
        array(
            'element' => '.account-popup .form-row label,
				.account-popup .woocommerce-form .form-row-name:before,
				.account-popup .register-password .forgot-pass, 
				.account-popup .login-password .forgot-pass,
				.account-popup .woocommerce-form .form-row .input-text,
				.account-popup .register-password .show_pass i, 
				.account-popup .login-password .show_pass i,
				.account-popup .woocommerce-form .form-row-user:before,
				.account-popup .woocommerce-form__label-for-checkbox span,
				.account-popup .checkcontainer',
			'property' => 'color',
        ),
		array(
            'element' => '.account-popup input ~ .radiobtn, .account-popup input ~ .checkmark',
			'property' => 'border-color',
        ),
		array(
            'element' => '.account-popup .woocommerce-form .form-row input::-webkit-input-placeholder',
			'property' => 'color',
        ),
		array(
            'element' => '.account-popup .woocommerce-form .form-row input::-moz-placeholder',
			'property' => 'color',
        ),
		array(
            'element' => '.account-popup .woocommerce-form .form-row input::-ms-input-placeholder',
			'property' => 'color',
        ),
    ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => $prefix . 'border',
	'label'    => esc_html__( 'Border Color Input', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
	'output'      => array(
        array(
            'element' => '.account-popup .woocommerce-form .form-row .input-text',
			'property' => 'border-color',
        ),
    ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => $prefix . 'border',
	'label'    => esc_html__( 'Border Radius Input', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '5px',
	'output'      => array(
        array(
            'element' => '.account-popup .woocommerce-form .form-row .input-text',
			'property' => 'border-radius',
        ),
    ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => $prefix . 'button',
	'label'    => esc_html__( 'Background Color Button', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
	'output'      => array(
        array(
            'element' => '.account-popup form.woocommerce-form button.button',
			'property' => 'background-color',
        ),
    ),
	'required'  => array(
        array(
            'setting'  => 'setting_popup',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );