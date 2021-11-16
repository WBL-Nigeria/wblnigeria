<?php
$header_layout = Arrowit::setting('header_layout_style');
if ($header_layout == 'wide') {
    $container = 'container-fluid';
} elseif ($header_layout == 'full_width') {
    $container = 'container';
} else {
    $container = 'container-fluid';
}
Arrowit_Templates::mobile_menu();
?>
<header class="site-header header-default">
    <div class="<?php echo esc_attr($container); ?>">
        <div class="header-main-content d-flex align-items-center">
            <?php get_template_part('templates/header/site', 'branding'); ?>
            <?php if (has_nav_menu('primary')): ?>
                <div class="navigation-top">
                    <nav id="site-navigation" class="main-navigation">
                        <?php Arrowit::menu_primary(); ?>
                    </nav>
                </div>
            <?php endif; ?>
            <div class="header-group menu-col-right  justify-content-end">
                <div class="header-icon">
                    <?php
                    $show_cart = Arrowit::setting('show_cart');
                    $show_search = Arrowit::setting('show_search');
                    $show_account = Arrowit::setting('show_account');
                    if ($show_search) {
                        ?>

                        <div class="search-header d-inline-block">
                            <div class="icon-header btn-search toggle-search">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <?php
                    }
                    if ($show_cart && class_exists( 'WooCommerce' )) {
                        Arrowit_Templates::get_minicart_template();
                    }
                    if ($show_account) {
                        Arrowit_Templates::get_setting_template();
                        if (!is_user_logged_in()) {
                            get_template_part('templates/header/account');
                        }
                    } ?>
                </div>
                <div class="menu-icon menu_bar align-items-center">
                    <span class="fa fa-bars"></span>
                </div>
            </div>
        </div>
    </div>
</header>