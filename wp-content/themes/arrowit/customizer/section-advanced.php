<?php
$section = 'advanced';
$priority = 1;
$prefix = 'advanced_';

Arrowit_Kirki::add_field('theme', array(
    'type' => 'radio-buttonset',
    'settings' => 'setting_animation',
    'label' => esc_html__('Show/Hide animation.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => '0',
    'choices' => array(
        '0' => esc_html__('No', 'arrowit'),
        '1' => esc_html__('Yes', 'arrowit'),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'select',
    'settings' => 'blog_css_animation',
    'label' => esc_html__('Blog', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 'fadeInDown',
    'choices' => Arrowit_Helper::get_animation_list(),
    'required' => array(
        array(
            'setting' => 'setting_animation',
            'operator' => '==',
            'value' => 1,
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'select',
    'settings' => 'product_css_animation',
    'label' => esc_html__('Product', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 'fadeInDown',
    'choices' => Arrowit_Helper::get_animation_list(),
    'required' => array(
        array(
            'setting' => 'setting_animation',
            'operator' => '==',
            'value' => 1,
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'custom',
    'settings' => $prefix . 'group_title_' . $priority++,
    'section' => $section,
    'priority' => $priority++,
    'default' => '<div class="big_title">' . esc_html__('Go to top', 'arrowit') . '</div>',
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'toggle',
    'settings' => 'scroll_top_enable',
    'label' => esc_html__('Go To Top Button', 'arrowit'),
    'description' => esc_html__('Turn on to show go to top button.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 1,
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'custom',
    'settings' => $prefix . 'group_title_' . $priority++,
    'section' => $section,
    'priority' => $priority++,
    'default' => '<div class="big_title">' . esc_html__('Style', 'arrowit') . '</div>',
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'toggle',
    'settings' => 'custom_css_enable',
    'label' => esc_html__('Custom CSS', 'arrowit'),
    'description' => esc_html__('Turn on to enable custom css.', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 1,
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'code',
    'settings' => 'custom_css',
    'section' => $section,
    'priority' => $priority++,
    'default' => 'body{background-color:#fff;}',
    'choices' => array(
        'language' => 'css',
        'theme' => 'monokai',
    ),
    'transport' => 'postMessage',
    'js_vars' => array(
        array(
            'element' => '#arrowit-style-inline-css',
            'function' => 'html',
        ),
    ),
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'toggle',
    'settings' => 'custom_js_enable',
    'label' => esc_html__('Custom Javascript', 'arrowit'),
    'description' => esc_html__('Turn on to enable custom javascript', 'arrowit'),
    'section' => $section,
    'priority' => $priority++,
    'default' => 0,
));

Arrowit_Kirki::add_field('theme', array(
    'type' => 'code',
    'settings' => 'custom_js',
    'section' => $section,
    'priority' => $priority++,
    'default'  => '
		(function ($) {
			"use strict";
		})(jQuery);',
	'choices'  => array(
		'language' => 'javascript',
		'theme'    => 'monokai',
	),
));