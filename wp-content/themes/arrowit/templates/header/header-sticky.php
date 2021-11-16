<?php

$header_layout_style = get_post_meta(get_the_ID(), 'header_layout', true);
if ($header_layout_style && $header_layout_style != 'default') {
    $header_layout_style = $header_layout_style;
} else {
    $header_layout_style = Arrowit::setting('header_layout_style');
}
global $container;
if ($header_layout_style == 'wide') {
    $container = 'container-fluid';
} elseif ($header_layout_style == 'boxed') {
    $container = 'container-fluid boxed';
} else {
    $container = 'container';
}
?>
<div class="header-sticky default header-default">
    <div class="<?php echo esc_attr($container); ?>">
        <div class="header-main-content d-flex align-items-center">
            <div class="site-branding">
                <div class="wrap">
                    <?php
                    $show_sticky = Arrowit::setting( 'header_sticky_logo' );
                    if (!empty($show_sticky)){
                        ?>
                        <a class="logo-sticky" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($show_sticky);?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')) ?>"></a>
                        <?php
                    }elseif (has_custom_logo()){
                        the_custom_logo();
                    }else{?>
                        <div class="site-branding-text ">
                            <?php if (is_front_page()) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_attr(get_bloginfo('name', 'display')) ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_attr(get_bloginfo('name', 'display')) ?></a>
                                </p>
                            <?php endif;
                            $description = get_bloginfo( 'description', 'display' );
                            if ($description || is_customize_preview()) :
                                ?>
                                <p class="site-description"><?php echo esc_html($description); ?></p>
                            <?php endif; ?>
                        </div><!-- .site-branding-text -->
                    <?php }?>
                </div><!-- .wrap -->
            </div><!-- .site-branding -->
            <div class="navigation-top">
                <nav class="main-navigation">
                    <?php Arrowit::menu_primary(); ?>
                </nav>
            </div>
            <div class="header-group menu-col-right  d-flex align-items-center justify-content-end">
                <div class="header-icon">
                    <?php
                    $show_search_sticky = Arrowit::setting('show_search_sticky');
                    $icon_search_sticky = Arrowit::setting('icon_search_sticky');
                    $show_account_sticky = Arrowit::setting('show_account_sticky');
                    if ($show_search_sticky) {
                        ?>
                        <div class="search-header d-inline-block">
                            <div class="icon-header btn-search toggle-search">
                                <i class="<?php echo esc_attr('fa fa-search'); ?>"></i>
                            </div>
                        </div>
                        <?php
                    }
                    $show_mini_cart_sticky = Arrowit::setting('show_mini_cart_sticky');
                    if ($show_mini_cart_sticky) {
                        Arrowit_Templates::get_minicart_template();
                    }

                    if ($show_account_sticky) {
                        Arrowit_Templates::get_setting_template();
                        if (!is_user_logged_in()) {
                            get_template_part('templates/header/account');
                        }
                    }
                    ?>

                </div>
                <div class="menu-icon menu_bar align-items-center">
                    <span class="fa fa-menu"></span>
                </div>
            </div>
        </div>
    </div>
</div>