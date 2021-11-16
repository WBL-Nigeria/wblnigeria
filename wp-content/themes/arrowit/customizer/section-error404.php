<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';
Arrowit_Kirki::add_field( 'theme', [
    'type'        => 'multicolor',
    'settings'    => $prefix . 'background',
    'label'       => esc_html__( 'Background Color', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'choices'     => [
        'top'     => esc_html__( 'Top Color', 'arrowit' ),
        'bottom'  => esc_html__( 'Bottom Color', 'arrowit' ),
    ],
    'default'     => [
        'top'     => '#fa6692',
        'bottom'  => '#58468c',
    ],
] );
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_404' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( '404 Page', 'arrowit' ) . '</div>',
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'error_title',
    'label'       => esc_html__( 'Title', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Oops!', 'arrowit' ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'title_404_color',
    'label'       => esc_html__( 'Title Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#ffffff',
    'output'      => array(
        array(
            'element'  => '.page-404 h1',
            'property' => 'color',
            'suffix'   => ' !important',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'error404_content',
    'label'       => esc_html__( 'Text content', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Looks like the page you found is broken.', 'arrowit' ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'content_404_color',
    'label'       => esc_html__( 'Text Content Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#ffffff',
    'output'      => array(
        array(
            'element'  => '.page-404 p',
            'property' => 'color',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'go_back_home_404',
    'label'       => esc_html__( 'Button Go To Home', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Go Home', 'arrowit' ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'go_back_home_404_color',
    'label'       => esc_html__( 'Button 404 Text Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#ffffff',
    'output'      => array(
        array(
            'element'  => '.page-404 .go-home',
            'property' => 'color',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'btn_404_hover_color',
    'label'       => esc_html__( 'Button 404 Hover', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#ffffff',
    'output'      => array(
        array(
            'element'  => '.page-404 .go-home:hover',
            'property' => 'background',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'go_back_contact_us',
    'label'       => esc_html__( 'Button Contact us', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Contact Us', 'arrowit' ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'go_back_contact_us_color',
    'label'       => esc_html__( 'Button Contact Text Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#fb6692',
    'output'      => array(
        array(
            'element'  => '.page-404 .go-contact',
            'property' => 'color',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'btn_contact_us_hover_color',
    'label'       => esc_html__( 'Button Contact Hover', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#fb6692',
    'output'      => array(
        array(
            'element'  => '.page-404 .go-contact:hover',
            'property' => 'background',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => 'choose_destination_contact',
    'label'       => esc_html__( 'Choose Destination', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'choices'     => arrowit_get_pages(),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => $prefix . 'bg_404',
    'label'       => esc_html__( 'Background images', 'arrowit' ),
    'description' => esc_html__( 'Background image for 404 page', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-image'      => ARROWIT_THEME_URI . '/assets/images/bg-404.png',
        'background-repeat'     => 'no-repeat',
        'background-color'      => 'rgba(255,255,255,0)',
        'background-size'       => 'cover',
        'background-attachment' => 'fixed',
        'background-position'   => 'center center',
    ),
    'output'      => array(
        array(
            'element' => 'body .page-404',
        ),
    ),
) );

/*Coming soon */
Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'custom',
    'settings' => $prefix . 'group_coming' . $priority ++,
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => '<div class="big_title">' . esc_html__( 'Coming Soon', 'arrowit' ) . '</div>',
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'coming_soon_enable',
    'label'       => esc_html__( 'Activate under construction mode', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '0',
    'choices'     => array(
        '0' => esc_html__( 'Off', 'arrowit' ),
        '1' => esc_html__( 'On', 'arrowit' ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'cm_title',
    'label'       => esc_html__( 'Title', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Daily Deals', 'arrowit' ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'cm_text_title_color',
    'label'       => esc_html__( 'Text Title Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
    'output'      => array(
        array(
            'element'  => '.coming-soon h1',
            'property' => 'color',
            'suffix'   => ' !important',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'cm_text_content',
    'label'       => esc_html__( 'Text content', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'arrowit' ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'cm_text_content_color',
    'label'       => esc_html__( 'Text Content Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
    'output'      => array(
        array(
            'element'  => '.coming-soon p.cm-info',
            'property' => 'color',
            'suffix'   => ' !important',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'background',
    'settings'    => 'cm_bg_img_overlay',
    'label'       => esc_html__( 'Background Images', 'arrowit' ),
    'description' => esc_html__( 'Background image for coming soon page', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => array(
        'background-color'      => '',
        'background-image'      => ARROWIT_THEME_URI . '/assets/images/bg-coming-soon.png',
        'background-repeat'     => 'no-repeat',
        'background-size'       => 'cover',
        'background-attachment' => 'fixed',
        'background-position'   => 'center top',
    ),
    'output'      => array(
        array(
            'element' => 'body .coming-soon-container',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'coming_subcribe_border-color',
    'label'       => esc_html__( 'Form Coming Soon Input Border Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
    'output'      => array(
        array(
            'element'  => '.page-coming-soon .coming-subcribe .mc4wp-form-fields input[type=email]',
            'property' => 'border-color',
            'suffix'   => ' !important',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'coming_subcribe_input',
    'label'       => esc_html__( 'Form Coming Soon Input Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '',
    'output'      => array(
        array(
            'element'  => '.page-coming-soon .coming-subcribe .mc4wp-form-fields input[type=email],
            .page-coming-soon .coming-subcribe .mc4wp-form-fields input[type=email]::placeholder
            ',
            'property' => 'color',
            'suffix'   => ' !important',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'coming_subcribe_text',
    'label'       => esc_html__( 'Submit button text', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => esc_html__( 'Notify Me', 'arrowit' ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'     => 'date',
    'settings' => 'coming_soon_countdown',
    'label'    => esc_html__( 'Countdown', 'arrowit' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => Arrowit_Helper::get_coming_soon_demo_date(),
) );
Arrowit_Kirki::add_field( 'theme', [
    'type'        => 'multicolor',
    'settings'    => 'cm_background_countdown',
    'label'       => esc_html__( 'Background Countdown', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'choices'     => [
        'top'     => esc_html__( 'Top Color', 'arrowit' ),
        'bottom'  => esc_html__( 'Bottom Color', 'arrowit' ),
    ],
    'default'     => [
        'top'     => '#fb6692',
        'bottom'  => '#5a468d',
    ],
] );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'countdown_number_color',
    'label'       => esc_html__( 'Countdown Number Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#ffffff',
    'output'      => array(
        array(
            'element'  => '.page-template-coming-soon .coming-soon .countdown-number',
            'property' => 'color',
            'suffix'   => ' !important',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'slider',
    'settings'    => 'countdown_number_font_size',
    'label'       => esc_html__( 'Countdown Number Font Size', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 38,
    'transport'   => 'auto',
    'choices'     => array(
        'min'  => 10,
        'max'  => 70,
        'step' => 1,
    ),
    'output'      => array(
        array(
            'element'  => '.page-template-coming-soon .coming-soon .countdown-number',
            'property' => 'font-size',
            'units'    => 'px',
            'suffix'   => ' !important',
        ),
    ),
    'required' => array(
        array(
            'setting' => 'breadcrumb',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'color',
    'settings'    => 'countdown_label_color',
    'label'       => esc_html__( 'Countdown Label Color.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport'   => 'auto',
    'default'     => '#ffffff',
    'output'      => array(
        array(
            'element'  => '.page-template-coming-soon .coming-soon .countdown-label',
            'property' => 'color',
            'suffix'   => ' !important',
        ),
    ),
) );

Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'slider',
    'settings'    => 'countdown_label_font_size',
    'label'       => esc_html__( 'Countdown Label Font Size', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 30,
    'transport'   => 'auto',
    'choices'     => array(
        'min'  => 10,
        'max'  => 70,
        'step' => 1,
    ),
    'output'      => array(
        array(
            'element'  => '.page-template-coming-soon .coming-soon .countdown-label',
            'property' => 'font-size',
            'units'    => 'px',
            'suffix'   => ' !important',
        ),
    ),
    'required' => array(
        array(
            'setting' => 'breadcrumb',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );