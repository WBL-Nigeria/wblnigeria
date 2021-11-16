<?php
/**
 * Theme Customizer
 *
 * @package APR Arrowit
 * @since   1.0
 */
/**
 * Setup configuration
 */
Arrowit_Kirki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );
/**
 * Add sections
 */
$priority = 1;
Arrowit_Kirki::add_panel( 'general', array(
	'title'    => esc_html__( 'General', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'header', array(
	'title'    => esc_html__( 'Header', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_panel( 'footer', array(
	'title'    => esc_html__( 'Footer', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_panel( 'blog', array(
	'title'    => esc_html__( 'Blog', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'portfolio', array(
	'title'    => esc_html__( 'Portfolio', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_panel( 'shop', array(
	'title'    => esc_html__( 'Shop', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'sidebars', array(
	'title'    => esc_html__( 'Sidebars', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'error404_page', array(
	'title'    => esc_html__( '404 Page & Maintenance', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_section( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'arrowit' ),
	'priority' => $priority ++,
) );
Arrowit_Kirki::add_panel( 'popup', array(
	'title'    => esc_html__( 'Popup', 'arrowit' ),
	'priority' => $priority ++,
) );

/* Custom field height logo */
Arrowit_Kirki::add_field( 'theme', array(
    'type'      => 'slider',
    'settings'  => 'logo_size',
    'label'     => esc_html__( 'Width Logo', 'arrowit' ),
    'description' => esc_html__('Select max width for your logo','arrowit'),
    'section'   => 'title_tagline',
    'priority'  => 9,
    'default'   => '',
    'transport' => 'refresh',
    'choices'   => array(
        'min'  => 30,
        'max'  => 200,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'     => '.custom-logo',
            'property'    => 'max-width',
            'units'       => 'px',
        ),
    ),
) );

/**
 * Load panel & section files
 */
/* General */
require_once ARROWIT_CUSTOMIZER_DIR .'/general/_panel.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/general/typography.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/general/color.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/general/layout.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/general/preloader.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/general/breadcrumb.php';;
/* Header */
require_once ARROWIT_CUSTOMIZER_DIR .'/header/_panel.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/header/general.php';
/* Footer */
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/_panel.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/general.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-01.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-02.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-03.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-04.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-05.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-06.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-07.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/footer/layout-08.php';
/* Advanced */
require_once ARROWIT_CUSTOMIZER_DIR .'/section-advanced.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/section-error404.php';
/* Blog */
require_once ARROWIT_CUSTOMIZER_DIR .'/blog/_panel.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/blog/general.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/blog/archive.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/blog/single.php';
/* Portfolio */
require_once ARROWIT_CUSTOMIZER_DIR .'/section-portfolio.php';
/* Shop */
require_once ARROWIT_CUSTOMIZER_DIR .'/shop/_panel.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/shop/general.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/shop/archive.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/shop/single.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/shop/cart.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/section-sidebars.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/popup/_panel.php';
require_once ARROWIT_CUSTOMIZER_DIR .'/popup/account.php';