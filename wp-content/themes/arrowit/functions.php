<?php
$theme = wp_get_theme();
define('ARROWIT_CSS', get_template_directory_uri() . '/css');
define('ARROWIT_JS', get_template_directory_uri() . '/assets/js');
define('ARROWIT_THEME_NAME', $theme['Name']);
define('ARROWIT_THEME_VERSION', $theme->get('Version'));
define('ARROWIT_THEME_DIR', get_template_directory());
define('ARROWIT_THEME_URI', get_template_directory_uri());
define('ARROWIT_THEME_IMAGE_URI', get_template_directory_uri() . '/assets/images');
define('ARROWIT_CHILD_THEME_URI', get_stylesheet_directory_uri());
define('ARROWIT_CHILD_THEME_DIR', get_stylesheet_directory());
define('ARROWIT_FRAMEWORK_DIR', get_template_directory() . '/inc');
define('ARROWIT_ADMIN', get_template_directory() . '/inc/admin');
define('ARROWIT_FRAMEWORK_FUNCTION', get_template_directory() . '/inc/functions');
define('ARROWIT_FRAMEWORK_PLUGIN', get_template_directory() . '/inc/plugins');
define('ARROWIT_CUSTOMIZER_DIR', ARROWIT_THEME_DIR . '/customizer');
define('ARROWIT_WIDGETS_DIR', ARROWIT_THEME_DIR . '/widgets');
require_once ARROWIT_FRAMEWORK_PLUGIN . '/functions.php';
require_once ARROWIT_FRAMEWORK_FUNCTION . '/function.php';
require_once ARROWIT_FRAMEWORK_FUNCTION . '/woocommerce.php';
require_once ARROWIT_FRAMEWORK_FUNCTION . '/ajax_search/ajax-search.php';
require_once ARROWIT_FRAMEWORK_FUNCTION . '/menus/menu.php';
require_once ARROWIT_FRAMEWORK_FUNCTION . '/menus/class-edit-menu-walker.php';
require_once ARROWIT_FRAMEWORK_FUNCTION . '/menus/class-walker-nav-menu.php';
require_once ARROWIT_FRAMEWORK_FUNCTION . '/ajax-account/custom-ajax.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-customize.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-functions.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-helper.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-kirki.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-static.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-templates.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-aqua-resizer.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-global.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-widgets.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-wpml.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-post-type-blog.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-post-type-portfolio.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-actions-filters.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-enqueue.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-custom-style.php';
require_once ARROWIT_FRAMEWORK_DIR . '/class-minify.php';
if (!isset($content_width)) {
    $content_width = 1170;
}

function arrowit_theme_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('custom-header');
    add_theme_support(
        'custom-logo',
        array(
            'flex-width' => false,
            'flex-height' => false,
        )
    );
}

add_action('after_setup_theme', 'arrowit_theme_setup');

