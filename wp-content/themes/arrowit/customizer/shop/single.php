<?php
$section = 'shop_single';
$priority = 1;
$prefix = 'single_product_';
$registered_sidebars = Arrowit_Helper::get_registered_sidebars();
$block_name = arrowit_get_save_template();
Arrowit_Kirki::add_field('theme', array(
    'type' => 'color-alpha',
    'settings' => 'single_bg',
    'label' => esc_html__('Background Color Page', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '',
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '
				.single-product .wrapper',
            'property' => 'background-color',
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'radio-buttonset',
    'settings' => 'single_layout',
    'label' => esc_html__('Single Layout', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 'full_width',
    'choices' => array(
        'wide' => esc_html__('Wide', 'arrowit'),
        'full_width' => esc_html__('Full Width', 'arrowit')
    ),
));
Arrowit_Kirki::add_field('theme', array(
    'type' => 'select',
    'settings' => 'single_sidebar_left',
    'label' => esc_html__('Sidebar Left', 'arrowit'),
    'description' => esc_html__('Select sidebar left.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '',
    'choices' => $registered_sidebars,
));
Arrowit_Kirki::add_field('theme', array(
    'type' => 'select',
    'settings' => 'single_sidebar_right',
    'label' => esc_html__('Sidebar Right', 'arrowit'),
    'description' => esc_html__('Select sidebar right.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '',
    'choices' => $registered_sidebars,
));
Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'single_product_prev',
    'label' => esc_html__('Enter Icon Class Button Prev', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 'fa fa-angle-left',
    'required' => array(
        array(
            'setting' => 'single_style',
            'operator' => 'contains',
            'value' => array('single_3', 'single_4'),
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'single_product_next',
    'label' => esc_html__('Enter Icon Class Button Next', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 'fa fa-angle-right',
    'required' => array(
        array(
            'setting' => 'single_style',
            'operator' => 'contains',
            'value' => array('single_3', 'single_4'),
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'radio-buttonset',
    'settings' => 'single_product_meta_enable',
    'label' => esc_html__('Show/Hide Product Meta', 'arrowit'),
    'description' => esc_html__('Turn on to display the product meta.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '1',
    'choices' => array(
        '0' => esc_html__('Off', 'arrowit'),
        '1' => esc_html__('On', 'arrowit'),
    ),
));
Arrowit_Kirki::add_field('theme', array(
    'type' => 'multicheck',
    'settings' => 'product_meta_multi',
    'label' => esc_html__('Product Meta', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => array('description', 'availability'),
    'choices' => array(
        'availability' => esc_html__('Availability', 'arrowit'),
        'sku' => esc_html__('SKU', 'arrowit'),
        'categories' => esc_html__('Categories', 'arrowit'),
        'tags' => esc_html__('Tags', 'arrowit'),
        'brands' => esc_html__('Brands', 'arrowit'),
        'description' => esc_html__('Quick Description', 'arrowit')
    ),
    'required' => array(
        array(
            'setting' => 'single_product_meta_enable',
            'operator' => '==',
            'value' => 1,
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'radio-buttonset',
    'settings' => 'single_product_delivery_popup',
    'label' => esc_html__('Delivery Popup', 'arrowit'),
    'description' => esc_html__('Turn on to display the delivery popup.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '1',
    'choices' => array(
        '0' => esc_html__('Off', 'arrowit'),
        '1' => esc_html__('On', 'arrowit'),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'select',
    'settings' => 'single_delivery',
    'label' => esc_html__('Delivery Popup', 'arrowit'),
    'description' => esc_html__('You can create templates in Templates -> Add New', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '',
    'choices' => $block_name,
    'required' => array(
        array(
            'setting' => 'single_product_delivery_popup',
            'operator' => '==',
            'value' => 1,
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'radio-buttonset',
    'settings' => 'single_product_sharing_enable',
    'label' => esc_html__('Product sharing', 'arrowit'),
    'description' => esc_html__('Turn on to display the product sharing.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '0',
    'choices' => array(
        '0' => esc_html__('Off', 'arrowit'),
        '1' => esc_html__('On', 'arrowit'),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'number',
    'settings' => 'per_limit',
    'label' => esc_html__('Product Number', 'arrowit'),
    'description' => esc_html__('Displayed Related, Upsell, Cross-sell Products.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '4',
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'radio-buttonset',
    'settings' => 'single_product_related_enable',
    'label' => esc_html__('Related products', 'arrowit'),
    'description' => esc_html__('Turn on to display the related products section.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '0',
    'choices' => array(
        '1' => esc_html__('Off', 'arrowit'),
        '0' => esc_html__('On', 'arrowit'),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'number',
    'settings' => 'related_limit',
    'label' => esc_html__('Related Products Limit', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '4',
    'required' => array(
        array(
            'setting' => 'single_product_related_enable',
            'operator' => '==',
            'value' => 0,
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'radio-buttonset',
    'settings' => 'single_product_up_sells_enable',
    'label' => esc_html__('Up-sells products', 'arrowit'),
    'description' => esc_html__('Turn on to display the up-sells products section.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '0',
    'choices' => array(
        '1' => esc_html__('Off', 'arrowit'),
        '0' => esc_html__('On', 'arrowit'),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'number',
    'settings' => 'upsell_limit',
    'label' => esc_html__('Up-sells Products Limit', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '4',
    'required' => array(
        array(
            'setting' => 'single_product_up_sells_enable',
            'operator' => '==',
            'value' => 0,
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'related_title',
    'label' => esc_html__('Title Related Products', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'required' => array(
        array(
            'setting' => 'single_product_related_enable',
            'operator' => '==',
            'value' => 0,
        ),
    ),
    'default' => wp_kses(__('Related Products', 'arrowit'),
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

));
Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'upsel_title',
    'label' => esc_html__('Title Upsel Products', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'required' => array(
        array(
            'setting' => 'single_product_up_sells_enable',
            'operator' => '==',
            'value' => 0,
        ),
    ),
    'default' => wp_kses(__('May you like also', 'arrowit'),
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

));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'custom',
    'settings' => $prefix . 'single_product_' . $priority++,
    'section' => $section,
    'priority' => $priority++,
    'default' => '<div class="big_title">' . esc_html__('Product Tab', 'arrowit') . '</div>',
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'toggle',
    'settings' => 'single_product_desc',
    'label' => esc_html__('Remove Details Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 0
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'toggle',
    'settings' => 'single_product_review',
    'label' => esc_html__('Remove Reviews Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 0
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'toggle',
    'settings' => 'single_product_info',
    'label' => esc_html__('Remove Information Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 0
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'toggle',
    'settings' => 'single_product_tag',
    'label' => esc_html__('Remove Tag Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 0
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'single_product_rename_desc',
    'label' => esc_html__('Rename Details Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => esc_html__('Description', 'arrowit'),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'single_product_rename_review',
    'label' => esc_html__('Rename Review Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => esc_html__('Reviews', 'arrowit'),
));


Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'single_product_rename_info',
    'label' => esc_html__('Rename Information Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => esc_html__('Information', 'arrowit'),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'text',
    'settings' => 'single_product_rename_tag',
    'label' => esc_html__('Rename Tag Tab', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => esc_html__('Tags', 'arrowit'),
));