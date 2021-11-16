<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';
$registered_sidebars = Arrowit_Helper::get_registered_sidebars();
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'General', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'shop_layout',
    'label'       => esc_html__( 'Shop Layout', 'arrowit' ),
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
    'settings'    => 'shop_sidebar_left',
    'label'       => esc_html__( 'Sidebar Left', 'arrowit' ),
    'description' => esc_html__( 'Select sidebar left.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'choices'     => $registered_sidebars,
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => 'shop_sidebar_right',
    'label'       => esc_html__( 'Sidebar Right', 'arrowit' ),
    'description' => esc_html__( 'Select sidebar right.', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
    'choices'     => $registered_sidebars,
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Toolbar', 'arrowit' ) . '</div>',
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_toolbar',
	'label'       => esc_html__( 'Show/Hide Toolbar', 'arrowit' ),
	'description' => esc_html__( 'Turn on to show toolbar', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_left_toolbar',
	'label'       => esc_html__( 'Show/Hide Left Toolbar', 'arrowit' ),
	'description' => esc_html__( 'Turn on to show left toolbar', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'  => array(
        array(
            'setting'  => 'shop_archive_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_catalog_ordering',
	'label'       => esc_html__( 'Show/Hide Catalog Ordering', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'  => array(
        array(
            'setting'  => 'shop_archive_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
		array(
            'setting'  => 'shop_archive_left_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_result_count',
	'label'       => esc_html__( 'Show/Hide Result Count', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'  => array(
        array(
            'setting'  => 'shop_archive_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
		array(
            'setting'  => 'shop_archive_left_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_right_toolbar',
	'label'       => esc_html__( 'Show/Hide Right Toolbar', 'arrowit' ),
	'description' => esc_html__( 'Turn on to show right toolbar', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'  => array(
        array(
            'setting'  => 'shop_archive_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );

Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_view',
	'label'       => esc_html__( 'Show/Hide Grid-List View', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'  => array(
        array(
            'setting'  => 'shop_archive_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
		array(
            'setting'  => 'shop_archive_right_toolbar',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'product_layouts',
    'label'       => esc_html__( 'Product Layouts', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'grid_list',
    'choices'     => array(
        'grid' => esc_html__( 'Grid', 'arrowit' ),
        'list'   => esc_html__( 'List', 'arrowit' ),
        'grid_list' => esc_html__( 'Grid(default) / List', 'arrowit' ),
        'list_grid' => esc_html__( 'List(default) / Grid', 'arrowit' ),
    ),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'product_column',
    'label'       => esc_html__( 'Product Column', 'arrowit' ),
    'description' => esc_html__( 'Option 4 col not for cases where the page has 2 sidebar (left and right)', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '3',
    'choices'     => array(
        '2' => esc_html__( '2', 'arrowit' ),
        '3' => esc_html__( '3', 'arrowit' ),
        '4' => esc_html__( '4', 'arrowit' ),
    ),
	'required'  => array(
        array(
            'setting'  => 'product_layouts',
            'operator' => 'contains',
            'value'    => array('grid', 'grid_list'),
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'product_column_list',
    'label'       => esc_html__( 'Product Column', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '2',
    'choices'     => array(
        '1' => esc_html__( '1', 'arrowit' ),
        '2' => esc_html__( '2', 'arrowit' ),
    ),
    'required'  => array(
        array(
            'setting'  => 'product_layouts',
            'operator' => 'contains',
            'value'    => array('list', 'list_grid'),
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'arrowit' ),
    'description' => esc_html__( 'Controls the number of products display on shop archive page', 'arrowit' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 9,
	'choices'     => array(
		'min'  => 1,
		'max'  => 30,
		'step' => 1,
	),
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'toggle',
    'settings'    => 'custom_size_product_image',
    'label'       => esc_html__( 'Show/Hide Custom Product Image', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 0,
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'number',
    'settings'    => 'product_image_width',
    'label'       => esc_html__( 'Product Image Width (Required)', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 570,
    'choices'     => array(
        'min'  => 1,
        'max'  => 1000,
        'step' => 1,
    ),
    'required'  => array(
        array(
            'setting'  => 'custom_size_product_image',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );
Arrowit_Kirki::add_field( 'theme', array(
    'type'        => 'number',
    'settings'    => 'product_image_height',
    'label'       => esc_html__( 'Product Image Height (Required)', 'arrowit' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 684,
    'choices'     => array(
        'min'  => 1,
        'max'  => 1000,
        'step' => 1,
    ),
    'required'  => array(
        array(
            'setting'  => 'custom_size_product_image',
            'operator' => '==',
            'value'    => 1,
        ),
    ), 
) );