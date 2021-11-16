<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Arrowit_Custom_Style')) {
    Class Arrowit_Custom_Style
    {
        public function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'style_css'));
        }

        public function style_css()
        {
            wp_register_style('custom-style', false);
            wp_enqueue_style('custom-style');
            $style_css = "";
            $style_css .= $this->primary_color_css();
            $style_css .= $this->page_gradient();
            $style_css .= $this->button_primary_color();
            $style_css .= $this->breadcrumbs();
            $style_css .= $this->site_background();
            $style_css .= $this->mb_single_product_background();
            $style_css .= $this->mb_category_background();
            $style_css .= $this->body_bg_image();
            $style_css .= $this->portfolio_background();
            $style_css .= $this->portfolio_popup_background();
            $style_css .= $this->general_shop_background();
            $style_css .= $this->header();
            $style_css .= $this->footer();
            $style_css .= $this->site_width();
            $style_css .= $this->remove_space_top();
            $style_css .= $this->remove_space_bottom();
            $style_css .= $this->error404_page_background();
            $style_css .= $this->cm_background_countdown();
            $style_css .= $this->scroll_top_color();
            $style_css .= $this->scroll_top_spacer();
            $style_css .= $this->btn_style_color();
            $style_css = Arrowit_Minify::css( $style_css );
            wp_add_inline_style('custom-style', html_entity_decode($style_css, ENT_QUOTES));
        }

        # Check color
        function check_color($color_1, $color_2)
        {
            $check_color = arrowit_get_meta_value($color_1);
            if (isset($check_color) && $check_color !== '') {
                $color = $check_color;
            } else {
                $color = Arrowit::setting($color_2);
            }
            return $color;
        }

        # Regardless of the name, this function works for both primary and highlight color, gradient additionally.
        function primary_color_css()
        {
            $hasGra = arrowit_get_meta_value('enable_gradient');
            if ($hasGra){
                $hasGra = $hasGra;
            }else{
                $hasGra = Arrowit::setting('general_gradient');
            }
            $color = $this->check_color('site_color', 'primary_color');
            $colorH = $this->check_color('page_highlight_color', 'hightlight_color');
            $css = '';

            if (isset($color) && $color !== '') {
                $css = "
                    h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,th,a,
                    .active-sidebar .widget_categories ul li a,
                    .active-sidebar .widget.widget_product_categories ul.product-categories li:hover > a, .active-sidebar .widget.widget_product_categories ul.product-categories li:hover > p, .active-sidebar .widget.widget_product_categories ul.product-categories li:hover > span.count,
                    .testimonial-type-3 .swiper-button-prev, .testimonial-type-3 .swiper-button-next,
                    .woocommerce nav.woocommerce-pagination .page-numbers li a,
                    .page-numbers:not(.prev), .page-numbers:not(.next),
                    .counter-box .elementor-counter .elementor-counter-title,
                    .contact-title p, .list-view li a.active, .list-view li a:hover,
                    .woocommerce .woocommerce-ordering label, .testimonial-type-3 .elementor-testimonial-wrapper .elementor-testimonial-name,
                    .woocommerce nav.woocommerce-pagination .page-numbers li a.prev, .woocommerce nav.woocommerce-pagination .page-numbers li a.next,
                    .product-title .product-name, .testimonial-type-2 .swiper-button-prev, .testimonial-type-2 .swiper-button-next,
                    .elementor-widget-accordion .elementor-accordion .elementor-tab-title,
                    .elementor-widget-accordion .elementor-accordion .elementor-tab-content ul > li span,
                    .elementor-widget-wrap .viewmore-portfolio a,
                    .elementor-timeline.type1 .elementor-timeline-date,
                    .elementor-timeline.type2 .elementor-timeline-inner-content .elementor-timeline-title,
                    .elementor-widget-wrap .elementor-widget-apr-pricing-table .elementor-price-table.type2 .elementor-price-table__header .elementor-price-table__heading,
                    .elementor-widget-wrap .elementor-widget-apr-pricing-table .elementor-price-table__price .elementor-price-table__integer-part, 
                    .elementor-widget-wrap .elementor-widget-apr-pricing-table .elementor-price-table__price .elementor-price-table__currency,
                    .btn-primary:hover, .btn-primary:focus, .btn-primary:active,
                    .btn-primary:not(:disabled):not(.disabled):active, 
                    .btn-primary:not(:disabled):not(.disabled).active, 
                    .show > .btn-primary.dropdown-toggle, .product-extra .slick-arrow:focus,
                    .post-type-archive-portfolio .portfolio-container .load-item .item .portfolio_body .portfolio-more-detail .delivery-return .btn-sm:focus, .tax-portfolio_cat .portfolio-container .load-item .item .portfolio_body .portfolio-more-detail .delivery-return .btn-sm:focus,
                    .elementor-widget-icon-box .elementor-icon-box-title,
                    .elementor-widget-icon-box .box-reading a,
                    .elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon .elementor-icon,
                    .footer-02 .list-info-contact li a:hover, .footer-02 .footer-copyright p a:hover,
                    .slick-arrow:hover, .counter-type1 .slick-arrow:focus,
                    .grid-style3 .post-name a:hover, .blog.post-single .related-archive .item-posts h5 a,
                    .heading-modern .heading-title a:hover,
                    table thead th, .quote_section>span, .social-networks.type-1 li a,
                    .text-link-type2:hover, .testimonial-type-5 .elementor-testimonial-wrapper .swiper-container .elementor-testimonial-job,
                    .product-landing .product-grid .product-content .product-desc .product-price span.price,
                    .testimonial-type-5 .elementor-testimonial-wrapper .elementor-testimonial-rating,
                    .testimonial-type-1 .elementor-testimonial-wrapper .elementor-testimonial-job,
                    .list-info-contact.type2 li p span, .widget.brand li:hover:before,
                    .active-sidebar .widget.widget_product_categories ul.product-categories li.current-cat > a, .active-sidebar .widget.widget_product_categories ul.product-categories li.current-cat > p, .active-sidebar .widget.widget_product_categories ul.product-categories li.current-cat > span.count,
                    .has_icon_title .elementor-toggle-icon i,
                    .footer-menu ul li a:hover, .testimonial-type-2 .elementor-testimonial-wrapper .elementor-testimonial-name,
                    .counter-type2 .box-counter .icon-counter,
                    .counter-type2.elementor-counter .elementor-counter-title,
                    .icon-box-home-app .counter-type2.elementor-counter:not(:hover) .elementor-counter-number-wrapper,
                    .languges-flags a:hover, .product-action .action-item a.button,
                    .side-breadcrumb .page-title h1, .side-breadcrumb .page-title h2,
                    .single-product .comment-actions .wpulike .wp_ulike_general_class .wp_ulike_btn:after,
                    .breadcrumb li .home, .pagination-content.type-5 li a,
                    .widget-title, .woocommerce div.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:before,
                    .list-info-contact li a:hover, .active-sidebar .widget.widget_product_categories span.count,
                    .woocommerce table.shop_table th, .widget.brand .list-brand li.cat-item:hover a,
                    .active-sidebar .widget_recent_comments ul > li,
                    .list-style-3 li a, .list-style-3 li:before,
                    .grid-style1 .post-name a:hover, .grid-style1 .read-more a:hover, .grid-style2 .post-name a:hover, .grid-style2 .read-more a:hover,
                    .shop_table.cart .product-cart-content .product-name:hover,
                    .shop_table .product-subtotal span, 
                    .shop_table .product-price span,
                    .shop_table .cart_item a.remove:hover i,
                    .fancybox-container .fancybox-inner .single-delivery .portfolio-img .portfolio-gallery .btn-prev i, .fancybox-container .fancybox-inner .single-delivery .portfolio-img .portfolio-gallery .btn-next i,
                    .blog-gallery .slick-arrow, .btn-hover.btn-primary,
                    .social-networks.type-3 li a:hover, .social-networks.type-4 li a,
                    .post-type-archive-portfolio .portfolio-container .load-item .item .portfolio_body .portfolio-more-detail .delivery-return .btn-sm:hover, .tax-portfolio_cat .portfolio-container .load-item .item .portfolio_body .portfolio-more-detail .delivery-return .btn-sm:hover,
                    .woocommerce div.entry-summary .product_meta .sku_wrapper strong,
                    .woocommerce div.entry-summary .product_meta .yith-wcbr-brands,
                    .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong,
                    .title-hdwoo .title-cart, .blog.post-single .related-topic a:hover,
                    .tm-posts-widget .view_more, .active-sidebar .widget_categories ul li:before,
                    .active-sidebar .widget.widget_top_rated_products .product_list_widget .product-content .product-desc .product-title a,
                    .footer-social-networks li a, .list-info-contact.type1 li i:before,
                    .showlogin, .showcoupon, .slide-icon-box.slide-icon-box-tech .elementor-widget-icon-box .box-reading a,
                    .woocommerce ul.order_details li, .active-sidebar .widget_rss ul li a,
                    .woocommerce-Address-title.title .edit, .footer-copyright p a:hover,
                    .site-header-cart .widget_shopping_cart_content ul.woocommerce-mini-cart li a:not(.remove), .cart-header .widget_shopping_cart_content ul.woocommerce-mini-cart li a:not(.remove),
                    .site-header-cart p.woocommerce-mini-cart__total.total strong, .cart-header p.woocommerce-mini-cart__total.total strong,
                    .footer-07 .f7rp ul li a:hover, .page-links > *:not(.page-links-title),
                    .page .comment-nav-links .page-numbers.next, .page .comment-nav-links .page-numbers.prev,
                    .active-sidebar .widget.widget_product_categories ul.product-categories li a,
                    .active-sidebar .widget.widget_product_categories ul.product-categories li:before,
                    .product-action .yith-wcwl-wishlistaddedbrowse a:before, .product-action .yith-wcwl-wishlistexistsbrowse a:before,
                    .woocommerce div.entry-summary .availability strong,
                    .box-info-comment .comment-reply a, .footer-01 .close-newsletter,
                    .product-detail.single_3 .product-list-thumbnails .slick-arrow,
                    .blog.post-single .box-info-comment .info-comment,
                    .blog.post-single .box-info-comment .wpulike-default .count-box:after,
                    .blog.post-single .box-info-comment .comment-reply a,
                    .footer-03 .footer-copyright p a:hover,
                    .blog-gallery-single .slick-next:focus,
                    .blog-gallery-single .slick-prev:focus,
                    #yith-quick-view-content .product-list-thumbnails .slick-arrow,
                    .footer-02 .widget_mc4wp_form_widget .form-submit.submit:hover:before,
                    .woocommerce .shop_table.woocommerce-checkout-review-order-table tfoot tr.order-total td, 
                    .apr-nav-menu--main .apr-nav-menu .sub-menu li a, 
                    .main-navigation > .mega-menu .sub-menu li a,
                    .apr-advance-tabs:not(.apr-tabs-vertical) .apr-tabs-nav > ul li:not(.active):hover span,
                    .elementor-widget-wrap .elementor-widget-apr-pricing-table .elementor-price-table.type2:hover .elementor-price-table__icon:after,
                    .product-grid .product-content:hover .product-top .product-action .action-item .add-cart-btn a,
                    .btn-highlight:hover, .woocommerce div.entry-summary form.cart .woocommerce-grouped-product-list.group_table tbody td .quantity input.qty.text,
                    .lampo-product-features .elementor-widget-icon-box .elementor-icon-box-icon .elementor-icon,
                    .testimonial-lampo .testimonial-type-6 .swiper-button-next:hover:before,
                    .testimonial-lampo .testimonial-type-6 .swiper-button-prev:hover:before{
                        color: {$color};
                    }
                    
                    .shop_table .cart_item a.remove:hover,.mailchimp-iot .mc4wp-form-fields .form-submit.submit input[type=submit]:hover{
                        color: {$color} !important;
                    }
                    .product-content:hover .product-top .product-image:before,
                    .widget_berocket_aapf_single .berocket_filter_slider.ui-widget-content .ui-slider-handle, .widget_berocket_aapf_single .berocket_filter_price_slider.ui-widget-content .ui-slider-handle,
                    .slide-icon-box.slide-icon-box-tech .slick-dots .slick-active button,
                    .slide-icon-box.slide-icon-box-tech .slick-dots li button:hover,.custom.tp-bullets .tp-bullet,
                     .lampo-slider-product .apr-slide .apr-image-carousel .slick-dots li.slick-active button, .lampo-slider-product .apr-slide .apr-image-carousel .slick-dots li.slick-active:before{
                        background-color: {$color} !important ";
                        if (isset($hasGra) && $hasGra == 1) {
                                $css .= "background: -moz-linear-gradient(to bottom, $color, $colorH) !important;
                                background: -ms-linear-gradient(to bottom, $color, $colorH) !important;
                                background: -o-linear-gradient( to bottom, $color, $colorH) !important;
                                background: -webkit-gradient(linear,left top,left bottom,from($color),to($colorH)) !important;
                                background: linear-gradient(to bottom,$color,$colorH) !important;";
                            }
                        $css .= "
                    }
                    .tech-button .btn-highlight:hover,
                    .blog-gallery-single .slick-next,
                    .lampo-slider-product .apr-slide .apr-image-carousel .slick-dots li button{
                        border-color: {$color} !important;
                    }
                    .slide-icon-box.has-bg .elementor-widget-icon-box .elementor-icon-box-wrapper:not(.type2):hover .elementor-icon-box-icon:after,
                    .elementor-widget-icon-box .elementor-icon-box-icon:after,
                    .nav-tabs li.active a, .nav-tabs li:hover a:before,
                    .form-subscribe .mc4wp-form .mc4wp-form-fields p.submit input[type=submit],
                    .counter-type1.elementor-counter .elementor-counter-number-wrapper:after{
                        background-color: {$color};
                        background-image: -ms-linear-gradient(left, $color 0%, $colorH 100%);
                        background-image: -o-linear-gradient(left, $color 0%, $colorH 100%);
                        background-image: -webkit-linear-gradient(left, $color 0%, $colorH 100%);
                        background-image: linear-gradient(to right, $color 0%, $colorH 100%);
                    }
                    .page-footer.footer-01 .footer-top,
                    .footer-01 .footer-social-networks li a:hover, .footer-07 .footer-social-networks li a:hover,
                    .scroll-to-top, .tab-home-start .apr-tabs-nav > ul li.active, .tab-home-start .apr-tabs-nav > ul li:hover,
                    body:not(.elementor-editor-active) .preloader8 span,                
                    .home-app-toggle .elementor-toggle-icon i,
                    .icon-box-startup:not(.icon-box-startup-last) .elementor-icon-box-wrapper:after,
                    .woocommerce-account .woocommerce-MyAccount-navigation,
                    .post-video .blog-img i,
                    .product-grid .product-top .product-action .action-item .add-cart-btn a
                    {
                        background-color:{$color};";
                        if (isset($hasGra) && $hasGra == 1) {
                            $css .= "background: -moz-linear-gradient(to bottom, $color, $colorH) !important;
                            background: -ms-linear-gradient(to bottom, $color, $colorH) !important;
                            background: -o-linear-gradient( to bottom, $color, $colorH) !important;
                            background: -webkit-gradient(linear,left top,left bottom,from($color),to($colorH)) !important;
                            background: linear-gradient(to bottom,$color,$colorH) !important;";
                        }
                $css .= "}
                    .btn-primary, .load_more_button a, .list-style-2 li:before, 
                    .nav-tabs li:before, 
                    .testimonial-type-2 .elementor-testimonial-wrapper .elementor-testimonial-image:before,
                    .testimonial .swiper-pagination-bullet, .slick-dots li button,
                    .grid-style2 .blog-content:hover .blog-item, .grid-style2 .post-time a,
                    .product-content:hover .product-top .product-image::before,
                    .apr-advance-tabs.apr-tabs-horizontal .apr-tabs-nav > ul li:before,
                    .features-pagination .elementor-icon-list-item.active,
                    .elementor-timeline.type2 .elementor-timeline-number, .blog-slide-2 .slick-arrow,
                    .grid-style1 .post-time a, .testimonial .swiper-pagination-progressbar .swiper-pagination-progressbar-fill,
                    .apr-advance-tabs .apr-tabs-nav>ul li:before, .blog-slide-2 .slick-dots li button,
                    .elementor-widget-accordion .elementor-accordion .elementor-tab-content ul > li:before,
                    .color-primary, .icon-box-home-app .elementor-widget-apr_counter:hover .elementor-widget-container,
                    .shop_table.cart .actions .coupon .btn, .nav-menu-mobile .top-mobile,
                    .account-popup form.login button[type='submit']:hover, .account-popup form.login button[type='submit']:focus, .account-popup form.register button[type='submit']:hover, .account-popup form.register button[type='submit']:focus,
                    .woocommerce form.woocommerce-shipping-calculator .button,
                    .woocommerce .wc-proceed-to-checkout a.button.alt, .active-sidebar .widget_arrowpress_latest_tweet .latest-tweets li i.fa-twitter,
                    .product-action .action-item a.button:hover,
                    .checkout-col-right #order_review_heading, .fancybox-close-small:before,
                    .woocommerce-checkout #payment ul.payment_methods li input:checked ~ label:after,
                    .woocommerce-checkout #payment #place_order, .blog.post-single .related-archive .item-posts h5:before,
                    h3.tlt-woocommerce-MyAccount:after, .tooltip-inner,
                    .woocommerce-account .woocommerce-MyAccount-content .button,
                    .woocommerce-account .woocommerce-MyAccount-content .shop_table thead tr th,
                    .woocommerce-account .woocommerce-MyAccount-content form > h3:after,
                    .woocommerce-form.woocommerce-form-login button.button,
                    .woocommerce div.entry-summary .product_title:after,
                    .product-detail.single_3 .product-list-thumbnails .slick-arrow:focus,
                    body:not(.elementor-editor-active) .pacman > div:nth-child(3), body:not(.elementor-editor-active) .pacman > div:nth-child(4), body:not(.elementor-editor-active) .pacman > div:nth-child(5), body:not(.elementor-editor-active) .pacman > div:nth-child(6),
                    body:not(.elementor-editor-active) #object-7,
                    body:not(.elementor-editor-active) .busy-loader .w-ball-wrapper .w-ball,
                    .radiobtn:after, .text-drop p::first-letter,
                    .social-networks.type-5 li a,
                    .social-networks.type-1 li a:hover, .social-networks.type-2 li:before, body:not(.elementor-editor-active) .bubblingG span,
                    .footer-01 .close-newsletter:hover, .woocommerce form.lost_reset_password button.button,
                    .mc4wp-form-fields .form-submit.submit input[type=submit],
                    .site-header-cart a.button:nth-child(2), .cart-header a.button:nth-child(2),
                    .site-header-cart a.button:first-child:hover, .cart-header a.button:first-child:hover,
                    .active-sidebar .widget-title:before, .active-sidebar .banner-sidebar .btn-banner-blog:before,
                    #yith-wcwl-message, #cart_added_msg_popup, #compare_added_msg_popup,
                    .product-detail.single_3 .product-list-thumbnails .slick-arrow:hover,
                    .woocommerce ul.products:not(.product-list) .product-content .product-desc .product-action .action-item.add-cart a:hover,
                    .active-sidebar .widget_rss ul li:before,
                    .woocommerce div.entry-summary form.cart button[type='submit']:before,
                    .woocommerce .return-to-shop a.button,
                    #yith-quick-view-content .product-list-thumbnails .slick-arrow:hover,
                    .list-buy-app li a:hover,
                    .wpcf7-form .form-submit input[type=submit],
                    .text-link-type2:before,
                    .quote-name-people .elementor-heading-title:before,
                    .category-post a:before,
                    .show-video a:before,.icon-right .elementor-icon-list-icon,
                    .woocommerce div.entry-summary form.cart button[type='submit'],
                    .woocommerce-mini-cart__buttons.buttons .button:before,
                    .woocommerce div.entry-summary form.cart .woocommerce-grouped-product-list.group_table thead{
                        background-color:{$color}";
                        if (isset($hasGra) && $hasGra == 1) {
                            $css .= "background: -moz-linear-gradient(to bottom, $color, $colorH);
                            background: -ms-linear-gradient(to bottom, $color, $colorH);
                            background: -o-linear-gradient( to bottom, $color, $colorH);
                            background: -webkit-gradient(linear,left top,left bottom,from($color),to($colorH));
                            background: linear-gradient(to bottom,$color,$colorH);";
                        }
                        $css .= "
                    }
                    .menu-mobile .menu-mobile-content,
                    .tm-posts-widget .view_more:before,
                    .bg-header-top:after,
                    .menu-mobile .top-mobile{
                        background-color:{$color};
                    }
                    @keyframes bubblingG {
                        0% {
                            width: 10px;
                            height: 10px;
                            background-color: {$color};
                            transform: translateY(0);
                        }
                
                        100% {
                            width: 23px;
                            height: 23px;
                            background-color:rgb(255,255,255);
                            transform: translateY(-20px);
                        }
                    }
                
                    @-o-keyframes bubblingG {
                        0% {
                            width: 10px;
                            height: 10px;
                            background-color: {$color};
                            -o-transform: translateY(0);
                        }
                
                        100% {
                            width: 23px;
                            height: 23px;
                            background-color:rgb(255,255,255);
                            -o-transform: translateY(-20px);
                        }
                    }
                
                    @-ms-keyframes bubblingG {
                        0% {
                            width: 10px;
                            height: 10px;
                            background-color: {$color};
                            -ms-transform: translateY(0);
                        }
                
                        100% {
                            width: 23px;
                            height: 23px;
                            background-color:rgb(255,255,255);
                            -ms-transform: translateY(-20px);
                        }
                    }
                
                    @-webkit-keyframes bubblingG {
                        0% {
                            width: 10px;
                            height: 10px;
                            background-color: {$color};
                            -webkit-transform: translateY(0);
                        }
                
                        100% {
                            width: 23px;
                            height: 23px;
                            background-color:rgb(255,255,255);
                            -webkit-transform: translateY(-20px);
                        }
                    }
                
                    @-moz-keyframes bubblingG {
                        0% {
                            width: 10px;
                            height: 10px;
                            background-color: {$color};
                            -moz-transform: translateY(0);
                        }
                
                        100% {
                            width: 23px;
                            height: 23px;
                            background-color:rgb(255,255,255);
                            -moz-transform: translateY(-20px);
                        }
                    }
                    .menu-mobile .mobile-content{
                        background: {$color};
                        filter: brightness(90%);
                    }
                    .menu-mobile .search-box .search-form .search-input{
                        background-color: {$color};
                        filter: brightness(120%);
                    }
                    .menu-mobile .mega-menu li, .nav-menu-mobile > ul li {
                        border-top-color: {$color};
                        filter: brightness(120%);
                    }
                    @media (min-width: 1025px) {
                        .blog-slide-2 .slick-current.slick-active .blog-item:before {
                            background-color:{$color};
                        }
                    }
                    .pl-icon-box .elementor-widget-icon-box .elementor-icon-box-wrapper.type2.type2 .elementor-icon-box-icon:before,
                    .pl-icon-box .elementor-widget-icon-box .elementor-icon-box-wrapper.type2.type2 .elementor-icon-box-icon:hover,
                    .type-1 .slick-arrow.slick-prev:hover, .type-1 .slick-arrow.slick-next,
                    .product-landing .product-grid .product-content .product-desc .top-desc:before,
                    .features-pagination .elementor-icon-list-item.active .elementor-icon-list-text,
                    select:hover, input[type=email]:hover, input[type=password]:hover, input[type=search]:hover, input[type=text]:hover, input[type=url]:hover, textarea:hover,
                    .features-pagination .elementor-icon-list-text:hover,
                    body:not(.elementor-editor-active) .lds-ripple div,
                    .product-list-thumbnails .slick-current img,
                    .btn, button, input[type=button], input[type=reset], input[type=submit],
                    .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle,
                    .product-title .product-name::before, .btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:active,
                    .elementor-widget-wrap .elementor-widget-apr-pricing-table .elementor-price-table:not(.type2) .elementor-price-table__footer .btn,
                    .woocommerce .checkout .form-row .woocommerce-input-wrapper input:hover, .woocommerce .checkout .form-row .woocommerce-input-wrapper textarea:hover,
                    .woocommerce .checkout .form-row .select2-container--default .select2-selection--single:hover,
                    .woocommerce form .form-row.woocommerce-invalid .select2-container, 
                    .woocommerce form .form-row.woocommerce-invalid input.input-text,
                    .woocommerce #reviews #comment:hover, .woocommerce #reviews #comment:focus, 
                    .woocommerce form .form-row.woocommerce-invalid select,
                    #yith-quick-view-content div.entry-summary .summary-content .single_add_to_cart_button:hover,
                    .list-buy-app li a:hover,
                    .category-post a:hover:before,
                    .post-type-archive-portfolio .portfolio-container .pagination-content .page-numbers:not(.next):hover, .post-type-archive-portfolio .portfolio-container .pagination-content .page-numbers:not(.prev):hover,
                    .page-numbers:not(.next).current, .page-numbers:not(.next):active, .page-numbers:not(.next):focus, .page-numbers:not(.next):hover, .page-numbers:not(.prev).current, .page-numbers:not(.prev):active, .page-numbers:not(.prev):focus, .page-numbers:not(.prev):hover{
                        border-color:{$color};
                    }
                    .link_section .link-icon,
                    .elementor-timeline.type2 .elementor-timeline-number:before,
                    .blog-shortcode .link_section .link-icon{
                        border-right-color: {$color};
                    }
                    .elementor-timeline.type2 .elementor-timeline-list li:nth-child(2n) .elementor-timeline-number:before{
                        border-left-color: {$color};
                    }
                    body:not(.elementor-editor-active) .lds-dual-ring:after,
                    .tooltip .arrow:before {
                        border-bottom-color: {$color} !important;
                        border-top-color: {$color} !important;
                    }
                    body:not(.elementor-editor-active) .object-3 {
                        border-left-color: {$color};
                        border-top-color: {$color};
                    }
                    body:not(.elementor-editor-active) .pacman > div:nth-child(2),
                    body:not(.elementor-editor-active) .pacman > div:first-of-type {
                        border-left-color: {$color};
                        border-top-color: {$color};
                        border-bottom-color: {$color};
                    }
                    .apr-cf7 .wpcf7-form .form-submit input[type='submit']:hover,
                    .features-pagination .elementor-icon-list-item:hover,
                    .btn-hover.btn-highlight,
                    .post-type-archive-portfolio .portfolio-container .load-item .item .portfolio_body .portfolio-more-detail .delivery-return .btn-sm, .tax-portfolio_cat .portfolio-container .load-item .item .portfolio_body .portfolio-more-detail .delivery-return .btn-sm,
                    .page-links > span:not(.page-links-title), .slick-arrow,
                    .woocommerce #reviews #review_form .comment-form p.form-submit input#submit:hover,
                    .blog.post-single .commentform .form-submit .btn-primary:hover,
                    .btn-highlight:hover, .btn-highlight:focus, .btn-highlight:active,
                    .footer-03 .wpcf7-form .form-submit input[type=submit]
                    {
                        border-color: {$color};
                        background-color:{$color}";
                        if (isset($hasGra) && $hasGra == 1) {
                            $css .= "background: -moz-linear-gradient(to bottom, $color, $colorH);
                            background: -ms-linear-gradient(to bottom, $color, $colorH);
                            background: -o-linear-gradient( to bottom, $color, $colorH);
                            background: -webkit-gradient(linear,left top,left bottom,from($color),to($colorH));
                            background: linear-gradient(to bottom,$color,$colorH);
                            border-color: transparent";
                        }
                        $css .= "
                    }
                    .woocommerce nav.woocommerce-pagination .page-numbers li a:hover,
                    .woocommerce nav.woocommerce-pagination .page-numbers li span.current{
                         border-color: {$color};
                    }
                    
                    @media (min-width: 1025px) {
                        .megamenu_sub .elementor-widget-wp-widget-nav_menu ul.menu li:hover a:after,
                         .apr-nav-menu--main .apr-nav-menu .sub-menu li a:after, .main-navigation > .mega-menu .sub-menu li a:after{
                            background-color: {$color};
                        }
                        .megamenu_sub .elementor-widget-wp-widget-nav_menu h5,
                        .megamenu_sub .elementor-widget-wp-widget-nav_menu ul.menu li a{
                            color: {$color};
                        }
                        .apr-nav-menu--main .apr-nav-menu .sub-menu li a, 
                        .main-navigation > .mega-menu .sub-menu li a,
                        .megamenu_sub .elementor-widget-wp-widget-nav_menu ul.menu li a{
                            border-color: {$color}59;
                        }
                    }
                    ";
            }                   

            if (isset($colorH) && $colorH != '') {
                $css .= "
                    a:hover, a:focus, .account-popup .apsl-login-networks .social-networks a:hover i,
                    .account-popup form.login .social-networks a:hover .apsl-icon-block i:after, .account-popup form.register .social-networks a:hover .apsl-icon-block i:after,
                    .woocommerce ul.products li.type-product .price,
                    .woocommerce nav.woocommerce-pagination .page-numbers li a.next:hover,
                    .product-title .product-name:hover, .blog-slide-2 .info-post .author-post a,
                    .category-post a, .page-404 .go-contact,
                    .active-sidebar .widget.widget_top_rated_products .product_list_widget .product-content .product-desc .price,
                    .contact-title p a, .list-info-contact.type1 li .info-content .to-map,
                    .faq2-wrap .elementor-toggle-icon .fa-minus:before,
                    .blog.post-single .blog-info-single .author-post a,
                    .blog.post-single .blog-info-single .info a:hover,
                    .blog.post-single .related-archive .item-posts h5 a:hover,
                    .counter-type2.elementor-counter .elementor-counter-number-wrapper,
                    .footer-01 .list-info-contact.type2 li p span,
                    .footer-01 .list-info-contact li a:hover,
                    .blog-post-info .post-name a:hover, .active-sidebar .widget_rss ul li a:hover,
                    .blog-img:hover a, .blog-slide-2 .info-category a,
                    .elementor-timeline.type1 .elementor-timeline-inner:hover .elementor-timeline-date,
                    .elementor-timeline.type2 .elementor-timeline-inner:hover .elementor-timeline-inner-content .elementor-timeline-title,
                    .list-style-1 li a:hover, .active-sidebar .widget_categories ul > li:hover > a,
                    .open-newsletter.btn-highlight:hover, .seo.tparrows:before,
                    .open-newsletter.btn-highlight:focus,
                    .page .comment-nav-links .page-numbers.next:hover, .page .comment-nav-links .page-numbers.prev:hover,
                    .social-custom .footer-social-networks li a:hover,
                    .open-newsletter.btn-highlight:active, .text-link-type1,
                    .footer-01 .footer-copyright p a:hover,
                    .footer-01 .list-info-contact li a:hover,
                    .list-style-3 li:hover a, .list-style-3 li:hover:before,
                    .site-header-cart p.woocommerce-mini-cart__total.total .woocommerce-Price-amount, .cart-header p.woocommerce-mini-cart__total.total .woocommerce-Price-amount,
                    .site-header-cart .widget_shopping_cart_content ul.woocommerce-mini-cart li .quantity, .cart-header .widget_shopping_cart_content ul.woocommerce-mini-cart li .quantity,
                    .site-header-cart .widget_shopping_cart_content ul.woocommerce-mini-cart li a:not(.remove):hover, .cart-header .widget_shopping_cart_content ul.woocommerce-mini-cart li a:not(.remove):hover,
                    .active-sidebar .widget_arrowpress_latest_tweet .latest-tweets li .twitter_time a,
                    .main-navigation > .mega-menu .sub-menu > li:hover > a,
                    .main-navigation > .mega-menu .sub-menu > li.current-menu-item > a,
                    .header-info p a, .btn-search i:hover:before,
                    .breadcrumb li a, .breadcrumb li:before, .breadcrumb li,
                    .active-sidebar .widget.widget_product_categories ul.product-categories li:hover a,
                    .box-info-comment .comment-reply a:hover,
                    .woocommerce div.entry-summary .price ins, 
                    .woocommerce div.entry-summary .price .amount,
                    .social-networks.type-2 li a:hover, .social-networks.type-4 li a:hover,
                    .active-sidebar .content-sidebar .widget_product_tag_cloud .tagcloud a:hover,
                    .blog-item .blog-post-info .info-post .author-post a,
                    .blog.post-single .box-info-comment .wpulike-default .wp_ulike_put_image:after,
                    .info-tag i, .woocommerce div.entry-summary p.price{
                        color: {$colorH};
                    }
                    .menu-mobile .mega-menu .sub-menu-active > a, .nav-menu-mobile > ul .sub-menu-active > a,
                    .site-header-cart .widget_shopping_cart_content ul.woocommerce-mini-cart li a.remove:hover, 
                    .cart-header .widget_shopping_cart_content ul.woocommerce-mini-cart li a.remove:hover {
                        color: {$colorH} !important;
                    }
                    .blog-video i,
                    .post-video .blog-img i,.app-bg:before, .show-video a {
                        background-color:{$colorH};
                        background: -moz-linear-gradient(to bottom, $color, $colorH);
                        background: -ms-linear-gradient(to bottom, $color, $colorH);
                        background: -o-linear-gradient( to bottom, $color, $colorH);
                        background: -webkit-gradient(linear,left top,left bottom,from($color),to($colorH));
                        background: linear-gradient(to bottom,$color,$colorH);
                    }
                    .type-1 .slick-arrow.slick-prev,                   
                    .quote-format .date,
                    .page-404 .go-home,
                    .apr-advance-tabs:not(.apr-tabs-vertical) .apr-tabs-nav > ul li.active span:before,
                    .dot-bottom.custom-dot.dot-section .testimonial-type-5 .elementor-testimonial-wrapper .elementor-testimonial-desc,
                    .color-highlight{
                        background-color:{$colorH};";
                        if (isset($hasGra) && $hasGra == 1) {
                            $css .= "background: -moz-linear-gradient(to bottom, $color, $colorH);
                            background: -ms-linear-gradient(to bottom, $color, $colorH);
                            background: -o-linear-gradient( to bottom, $color, $colorH);
                            background: -webkit-gradient(linear,left top,left bottom,from($color),to($colorH));
                            background: linear-gradient(to bottom,$color,$colorH);";
                        }
                    $css .= "}
                    .elementor-widget-wrap .elementor-widget-apr-pricing-table .elementor-price-table__features-list li:before,
                    .label-product.on-hot, .tech-button .btn-highlight,
                    .page-coming-soon .coming-subcribe .mc4wp-form-fields input[type=submit],
                    .apr-cf7 .wpcf7-form .form-submit input[type='submit'],
                    .load_more_button a:hover, .list-style-2 li:hover:before,
                    .btn-highlight,
                    .elementor-timeline.type2 .elementor-timeline-inner:hover .elementor-timeline-number,
                    .blog-masonry .default-date, .blog-masonry .custom-date,
                    .blog.post-single .commentform .form-submit .btn-primary,
                    .elementor-toggle-icon i, .list-style-1 li:hover:before,
                    span.count, .woocommerce div.entry-summary form.cart button[type='submit'],
                    .humburger-content .swiper-scrollbar-drag,
                    .woocommerce div.entry-summary form.cart button[type='submit']:hover,
                    .shop_table.cart .actions .coupon .btn:hover,
                    .product-landing .product-grid .product-top .product-image::before,
                    .site-header-cart a.button:first-child, .cart-header a.button:first-child,
                    .site-header-cart a.button:nth-child(2):hover, .cart-header a.button:nth-child(2):hover,
                    .account-popup form.login button[type='submit'], .account-popup form.register button[type='submit'],
                    .product-list .product-action .add-cart-btn a,
                    .woocommerce ul.products:not(.product-list) .product-content .product-desc .product-action .action-item.add-cart a,
                    .woocommerce-ResetPassword button[type='submit']:before,
                    .woocommerce form.lost_reset_password button.button:hover,
                    .woocommerce form.woocommerce-shipping-calculator .button:hover,
                    .woocommerce .wc-proceed-to-checkout a.button.alt:hover,
                    .woocommerce-checkout #payment #place_order:hover,
                    .woocommerce-account .woocommerce-MyAccount-content .button:hover,
                    .woocommerce-account .woocommerce-MyAccount-content table.my_account_orders .button:hover,
                    .woocommerce-account .woocommerce-form.woocommerce-form-login button.button:hover, 
                    .woocommerce-account .woocommerce-form.woocommerce-form-login button.button:focus, 
                    .woocommerce-account .woocommerce-form.woocommerce-form-login button.button:active,
                    .woocommerce #reviews #review_form .comment-form p.form-submit input#submit,
                    .woocommerce .return-to-shop a.button:hover, 
                    .woocommerce .return-to-shop a.button:focus, 
                    .woocommerce .return-to-shop a.button:active,
                    #yith-quick-view-content div.entry-summary .summary-content .single_add_to_cart_button:hover,
                    .page.woocommerce-cart .btn-primary:before,
                    .woocommerce-mini-cart__buttons.buttons .button.checkout:before{
                        background-color: {$colorH};
                    }
                    @media (min-width: 1025px) {
                        .apr-nav-menu--main .apr-nav-menu .sub-menu > li:hover > a:before,
                        .apr-nav-menu--main .apr-nav-menu .sub-menu > li.current-menu-item > a:before, 
                        .main-navigation > .mega-menu .sub-menu > li:hover > a:before,
                        .main-navigation > .mega-menu .sub-menu > li.current-menu-item > a:before,
                        .apr-nav-menu--main .apr-nav-menu .sub-menu > .current-menu-item > a:before, 
                        .main-navigation > .mega-menu .sub-menu > .current-menu-item > a:before,
                        .apr-nav-menu--main .apr-nav-menu .sub-menu li:hover > a:before,
                        .main-navigation > .mega-menu .sub-menu li:hover > a:before,
                        .megamenu_sub .elementor-widget-wp-widget-nav_menu ul.menu li:hover a:before{
                            background-color: {$colorH};
                        }
                    }
                    .menu-mobile .mega-menu .sub-menu-active > a:before, .nav-menu-mobile > ul .sub-menu-active > a:before {
                        background-color: {$colorH} !important;
                    }
                    .blog.post-single .related-archive .item-posts h5 a, .tech-button .btn-highlight,
                    .blog.post-single .commentform .form-submit .btn-primary,
                    .apr-cf7 .wpcf7-form .form-submit input[type='submit'],
                    .slick-arrow.slick-next,
                    .woocommerce #reviews #review_form .comment-form p.form-submit input#submit,
                    .elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:after,
                    .elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before,
                    .btn-highlight, .blog-slide-2 .slick-current.slick-active .info-category a:hover
                    {
                        border-color:{$colorH};
                    }
                    .dot-bottom.custom-dot.dot-section .testimonial-type-5 .elementor-testimonial-wrapper .elementor-testimonial-desc:after {
                        border-top-color:{$colorH};
                    }
                    .elementor-timeline.type2 .elementor-timeline-list li:nth-child(2n) .elementor-timeline-inner:hover .elementor-timeline-number:before{
                        border-left-color:{$colorH};
                    }
                    .elementor-timeline.type2 .elementor-timeline-inner:hover .elementor-timeline-number:before{
                        border-right-color:{$colorH};
                    }
                    .elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before{
                        box-shadow:3px 0px 0 0 {$colorH};
                    }
                ";
            }
            return $css;
        }

        # Page Gradient
        function page_gradient()
        {
            $color_1 = $this->check_color('site_color', 'primary_color');
            $color_2 = $this->check_color('page_highlight_color', 'hightlight_color');
            $page_gradient = Arrowit::setting('general_gradient');
            $css = '';
            if ($page_gradient == 1 && isset($color_1, $color_2) && $color_1 !== '' && $color_2 !== '') {
                $css = "
                    .pagination-content.type-2 li.pagination_button_prev a,
                    .nav-tabs li.active a, .nav-tabs li:hover a,
                    .pagination-content.type-3 li.pagination_button_prev a,
                    .apr-advance-tabs .apr-tabs-nav>ul li.active span, 
                    .apr-advance-tabs .apr-tabs-nav>ul li:hover span,
                    .counter-type1.elementor-counter .elementor-counter-number-wrapper:after {
                        background: {$color_1};
                        background: -moz-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -webkit-gradient(left top, right top, color-stop(0%, {$color_1}), color-stop(100%, {$color_2}))!important;
                        background: -webkit-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -o-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -ms-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: linear-gradient(to right, {$color_1} 0%, {$color_2} 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$color_1}', endColorstr='{$color_2}', GradientType=1 );
                    }
                    .pagination-content.type-2 li.pagination_button_next a ,
                    .pagination-content.type-3 li.pagination_button_next a{
                        background: {$color_2};
                        background: -moz-linear-gradient(left, {$color_2} 0%, {$color_1} 100%);
                        background: -webkit-gradient(left top, right top, color-stop(0%, {$color_2}), color-stop(100%, {$color_1}));
                        background: -webkit-linear-gradient(left, {$color_2} 0%, {$color_1} 100%);
                        background: -o-linear-gradient(left, {$color_2} 0%, {$color_1} 100%);
                        background: -ms-linear-gradient(left, {$color_2} 0%, {$color_1} 100%);
                        background: linear-gradient(to right, {$color_2} 0%, {$color_1} 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$color_2}', endColorstr='{$color_1}', GradientType=1 );
                    }

                    .elementor-widget-icon-box .elementor-icon-box-icon:after{
                        background: {$color_1};
                        background: -moz-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -webkit-gradient(left top, right top, color-stop(0%, {$color_1}), color-stop(100%, {$color_2}));
                        background: -webkit-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -o-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -ms-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: linear-gradient(to right, {$color_1} 0%, {$color_2} 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$color_1}', endColorstr='{$color_2}', GradientType=1 );
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                    }
                    .slide-icon-box.has-bg .elementor-widget-icon-box .elementor-icon-box-wrapper:not(.type2):hover .elementor-icon-box-icon:after{
                        background: {$color_1};
                        background: -moz-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -webkit-gradient(left top, right top, color-stop(0%, {$color_1}), color-stop(100%, {$color_2}));
                        background: -webkit-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -o-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: -ms-linear-gradient(left, {$color_1} 0%, {$color_2} 100%);
                        background: linear-gradient(to right, {$color_1} 0%, {$color_2} 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$color_1}', endColorstr='{$color_2}', GradientType=1 );
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                    }
                    .show-video a{
                        background-image: linear-gradient(-180deg, {$color_1} 0%, {$color_2} 100%);
                    }
                ";
            }
            return $css;
        }

        # Button Primary color
        function button_primary_color()
        {
            $css = '';
            $color = Arrowit::setting('btn_primary_color');
            if (Arrowit::setting('btn_custom') == 1 && $color !== '') {
                $css = "
                    .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle,
                    .btn-primary:hover, .btn-primary:focus, .btn-primary:active,
                    .btn-primary{
                        border-color:{$color};
                    }
                    .btn-primary,.btn-highlight:before{
                        background-color:{$color};
                    }
                    .btn-hover.btn-primary {
                        color: {$color};
                    }
                ";
                /* Hover color*/
                $css .= "
                .btn-highlight:hover, .btn-highlight:focus, .btn-highlight:active,.btn-hover.btn-highlight{
                    border-color: {$color};
                    background-color: {$color};
                }";
            }
            return $css;
        }

        # Button 2nd color
        function button_secondary_color()
        {
            $css = '';
            $color = Arrowit::setting('btn_secondary_color');
            if (Arrowit::setting('btn_custom') && $color !== '') {
                $css = "
                    .btn-highlight{
                    border-color: {$color};
                    background-color: {$color};
                }
                ";
            }
            return $css;
        }

        function breadcrumbs()
        {
            $breadcrumbs_padding = arrowit_get_meta_value('breadcrumbs_padding');
            $align_breadcrumbs = arrowit_get_meta_value('align_breadcrumbs');
            $breadcrumbs_color = arrowit_get_meta_value('breadcrumbs_color');
            $breadcrumbs_opacity = get_post_meta(get_the_ID(), 'breadcrumbs_opacity', true);
            $breadcrumbs_bg_overlay = get_post_meta(get_the_ID(), 'breadcrumbs_bg_overlay', true);
            $breadcrumbs_font_size = get_post_meta(get_the_ID(), 'breadcrumbs_font_size', true);
            $title_color = get_post_meta(get_the_ID(), 'title_color', true);
            $link_color = get_post_meta(get_the_ID(), 'link_color', true);
            $css = '';

            if (isset($align_breadcrumbs) && $align_breadcrumbs !== 'default' && $align_breadcrumbs !== '') {
                $css .= "
                div.side-breadcrumb{
                    text-align: {$align_breadcrumbs};
                }";
            }
            if (isset($breadcrumbs_color) && $breadcrumbs_color != '') {
                $css .= "
                div.side-breadcrumb .breadcrumb > li,
                div.side-breadcrumb .breadcrumb{
                    color: {$breadcrumbs_color};
                }";
            }
            if (isset($title_color) && $title_color != '') {
                $css .= "
                div.side-breadcrumb .page-title h1, div.side-breadcrumb .page-title h2 {
                    color: {$title_color};
                }";
            }
            if (isset($link_color) && $link_color != '') {
                $css .= "
                div.side-breadcrumb .breadcrumb .home,
                div.side-breadcrumb .breadcrumb li a,
                div.side-breadcrumb .breadcrumb li:before {
                    color: {$link_color};
                }";
            }
            if (isset($breadcrumbs_padding) && $breadcrumbs_padding != '') {
                $css .= "
                div.side-breadcrumb {
                    padding-bottom: {$breadcrumbs_padding}px;
                    padding-top: {$breadcrumbs_padding}px;
                }";
            }
            if (isset($breadcrumbs_opacity) && $breadcrumbs_opacity != '') {
                $css .= "
                div.side-breadcrumb:before {
                    opacity: {$breadcrumbs_opacity};
                }";
            }
            if (isset($breadcrumbs_bg_overlay) && $breadcrumbs_bg_overlay != '') {
                $css .= "
                div.side-breadcrumb:before {
                    background-color: {$breadcrumbs_bg_overlay};
                }";
            }
            if (isset($breadcrumbs_font_size) && $breadcrumbs_font_size != '') {
                $css .= "
                div.side-breadcrumb .page-title h1, div.side-breadcrumb .page-title h2 {
                    font-size: {$breadcrumbs_font_size}px;
                }";
            }
            return $css;
        }

        function site_background()
        {
            $site_background = arrowit_get_meta_value('site_background');
            $css = '';
            if ($site_background != '') {
                $css = "
                body{
                    background-color: {$site_background}!important;
                }";
            }
            return $css;
        }

        function mb_single_product_background()
        {
            $background_color_single_product = arrowit_get_meta_value('background_color_single_product');
            $css = '';
            if ($background_color_single_product != '') {
                $css = "
                .single-product .wrapper{
                    background-color: {$background_color_single_product} !important;
                }";
            }
            return $css;
        }

        function mb_category_background()
        {

            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $term_id = isset($cat->term_id) ? $cat->term_id : 0;
            $bg_color_cate = get_term_meta($term_id, 'bg_color_cate', true);

            $css = '';
            if (isset($bg_color_cate) && $bg_color_cate != '') {
                $css = "
                body.post-type-archive-product, body.single-product, body.tax-product_cat{
                    background-color: {$bg_color_cate};
                }";
            }
            return $css;
        }

        function body_bg_image()
        {
            $body_bg_image = arrowit_get_meta_value('body_bg_image');
            $css = '';
            if ($body_bg_image != '') {
                $css = "
                body{
                    background-image: url($body_bg_image) !important;
                }";
            }
            return $css;
        }

        function portfolio_background()
        {
            $portfolio_background = Arrowit::setting('portfolio_background');
            $css = '';
            if ($portfolio_background != '') {
                $css = "
                .post-type-archive-portfolio .wrapper, .tax-portfolio_cat .wrapper, .single-portfolio .wrapper{
                    background: -moz-linear-gradient(90deg, {$portfolio_background['bottom']} 0%, {$portfolio_background['bottom']} 50%, {$portfolio_background['top']} 70%, {$portfolio_background['top']} 100%);
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, {$portfolio_background['top']}), color-stop(30%, {$portfolio_background['top']}), color-stop(50%, {$portfolio_background['bottom']}), color-stop(100%, {$portfolio_background['bottom']}));
                    background: -webkit-linear-gradient(90deg, {$portfolio_background['bottom']} 0%, {$portfolio_background['bottom']} 50%, {$portfolio_background['top']} 70%, {$portfolio_background['top']} 100%);
                    background: -o-linear-gradient(90deg, {$portfolio_background['bottom']} 0%, {$portfolio_background['bottom']} 50%, {$portfolio_background['top']} 70%, {$portfolio_background['top']} 100%);
                    background: -ms-linear-gradient(90deg, {$portfolio_background['bottom']} 0%, {$portfolio_background['bottom']} 50%, {$portfolio_background['top']} 70%, {$portfolio_background['top']} 100%);
                    background: linear-gradient(0deg, {$portfolio_background['bottom']} 0%, {$portfolio_background['bottom']} 50%, {$portfolio_background['top']} 70%, {$portfolio_background['top']} 100%); 
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$portfolio_background['top']}', endColorstr='{$portfolio_background['bottom']}',GradientType=0 ); 
                }";
            }
            return $css;
        }

        function portfolio_popup_background()
        {
            $portfolio_popup_background = Arrowit::setting('portfolio_popup_background');
            $css = '';
            if ($portfolio_popup_background != '') {
                $css = "
                .post-type-archive-portfolio .fancybox-container .fancybox-bg, .tax-portfolio_cat .fancybox-container .fancybox-bg{
                    background: -moz-linear-gradient(270deg, {$portfolio_popup_background['top']} 0%, {$portfolio_popup_background['bottom']} 34%, {$portfolio_popup_background['bottom']} 100%); 
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, {$portfolio_popup_background['top']}), color-stop(34%, {$portfolio_popup_background['bottom']}), color-stop(100%, {$portfolio_popup_background['bottom']})); 
                    background: -webkit-linear-gradient(270deg, {$portfolio_popup_background['top']} 0%, {$portfolio_popup_background['bottom']} 34%, {$portfolio_popup_background['bottom']} 100%); 
                    background: -o-linear-gradient(270deg, {$portfolio_popup_background['top']} 0%, {$portfolio_popup_background['bottom']} 34%, {$portfolio_popup_background['bottom']} 100%); 
                    background: -ms-linear-gradient(270deg, {$portfolio_popup_background['top']} 0%, {$portfolio_popup_background['bottom']} 34%, {$portfolio_popup_background['bottom']} 100%); 
                    background: linear-gradient(180deg, {$portfolio_popup_background['top']} 0%, {$portfolio_popup_background['bottom']} 34%, {$portfolio_popup_background['bottom']} 100%); 
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$portfolio_popup_background['top']}', endColorstr='{$portfolio_popup_background['bottom']}',GradientType=0 ); 
                }";
            }
            return $css;
        }

        function general_shop_background(){
            $general_shop_background = Arrowit::setting('general_shop_background');
            $css = '';
            if ($general_shop_background != '') {
                $css = "
                .post-type-archive-product,
                .single-product,
                .tax-product_cat{
                    background-color: {$general_shop_background};
                }";
            }
            return $css;
        }

        function error404_page_background()
        {
            $error404_page_background = Arrowit::setting('error404_page_background');
            $css = '';
            if ($error404_page_background != '') {
                $css = "
                .error404 .wrapper{
                    background: -moz-linear-gradient(90deg, {$error404_page_background['bottom']} 0%, {$error404_page_background['top']} 100%); 
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, {$error404_page_background['top']}), color-stop(100%, {$error404_page_background['bottom']}));
                    background: -webkit-linear-gradient(90deg, {$error404_page_background['bottom']} 0%, {$error404_page_background['top']} 100%);
                    background: -o-linear-gradient(90deg, {$error404_page_background['bottom']} 0%, {$error404_page_background['top']} 100%);
                    background: -ms-linear-gradient(90deg, {$error404_page_background['bottom']} 0%, {$error404_page_background['top']} 100%);
                    background: linear-gradient(0deg, {$error404_page_background['bottom']} 0%, {$error404_page_background['top']} 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$error404_page_background['top']}', endColorstr='{$error404_page_background['bottom']}',GradientType=0 );
                }";
            }
            return $css;
        }

        function cm_background_countdown()
        {
            $cm_background_countdown = Arrowit::setting('cm_background_countdown');
            $css = '';
            if ($cm_background_countdown != '') {
                $css = "
                .page-template-coming-soon .countdown-section{
                    background: -moz-linear-gradient(270deg, {$cm_background_countdown['top']} 0%, {$cm_background_countdown['bottom']} 100%);
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, {$cm_background_countdown['top']}), color-stop(100%, {$cm_background_countdown['bottom']})); 
                    background: -webkit-linear-gradient(270deg, {$cm_background_countdown['top']} 0%, {$cm_background_countdown['bottom']} 100%); 
                    background: -o-linear-gradient(270deg, {$cm_background_countdown['top']} 0%, {$cm_background_countdown['bottom']} 100%); 
                    background: -ms-linear-gradient(270deg, {$cm_background_countdown['top']} 0%, {$cm_background_countdown['bottom']} 100%); 
                    background: linear-gradient(180deg, {$cm_background_countdown['top']} 0%, {$cm_background_countdown['bottom']} 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$cm_background_countdown['top']}', endColorstr='{$cm_background_countdown['bottom']}',GradientType=0 );
                    }
                 .page-template-coming-soon .countdown-section .countdown-number{
                    background-color: {$cm_background_countdown['top']}80;
                 }
                    ";
            }
            return $css;
        }
        function header(){
            $sticky_bg = arrowit_get_meta_value('sticky_bg');

            $css = '';
            if (isset($sticky_bg) && $sticky_bg !==''){
                $css = "
                    .header-sticky.is-sticky, .header-sticky.is-sticky.header-4 .header-content > .elementor > .elementor-inner > .elementor-section-wrap > .elementor-element{
                        background-color: {$sticky_bg}!important;
                    }
                ";
            }
            $choose_header_builder = Arrowit::setting('choose_header_builder');
            $header_type = arrowit_get_meta_value('header_type');

            if(is_singular('header')){
                global $post;
                $id = $post->ID;
            }else{
                if (!empty($header_type) && $header_type !== 'default'){
                    $id = arrowit_get_id_by_slug(arrowit_get_meta_value('header_type'));
                }else{
                    $id = arrowit_get_id_by_slug(Arrowit::setting('choose_header_builder'));
                }
            }
            $header_fix_bg = get_post_meta($id, 'header_fix_bg', true);
            if (isset($header_fix_bg) && $header_fix_bg !==''){
                $css = "
                     .header-fixed .header-content > .elementor > .elementor-inner > .elementor-section-wrap > .elementor-element{
                        background-color: {$header_fix_bg}!important;
                    }
                ";
            }
            # Header fix color
            $header_fix_color = get_post_meta($id, 'header_fix_color', true);
            if (isset($header_fix_color) && $header_fix_color !==''){
                $css .= "
                     .header-fixed .apr-nav-menu--main .apr-nav-menu > li:not(:hover) > a, .header-fixed .header-8 .account .site-header-account > a, .header-fixed .header-8 .cart-contents .title, .header-fixed .header-8 span.count,
                     .header-fixed .header-8 .site-header-cart i,
                     .header-fixed .header-8 .site-header-account span{
                        color: {$header_fix_color}!important;
                    }
                    .header-fixed .apr-nav-menu--main .apr-nav-menu > li:not(:hover) > a, .header-fixed .header-10 .account .site-header-account > a, .header-fixed .header-10 .cart-contents .title, .header-fixed .header-10 span.count,
                     .header-fixed .header-10 .site-header-cart i,
                     .header-fixed .header-10 .site-header-account span{
                        color: {$header_fix_color}!important;
                    }
                ";
            }
            # Header fix hover color
            $header_fix_color_hover = get_post_meta($id, 'header_fix_color_hover', true);
            if (isset($header_fix_color_hover) && $header_fix_color_hover !==''){
                $css .= "
                     .header-fixed .apr-nav-menu--main .apr-nav-menu > li:hover > a,
                     .header-fixed .apr-nav-menu--main .apr-nav-menu > li.current-menu-parent > a,
                     .header-fixed .header-8 .account .site-header-account > a:hover, .header-fixed .header-8 .cart-contents:hover .title, .header-fixed .header-8 a:hover span.count{
                        color: {$header_fix_color_hover}!important;
                    }
                    .header-fixed .apr-nav-menu--main .apr-nav-menu > li:hover > a,
                     .header-fixed .apr-nav-menu--main .apr-nav-menu > li.current-menu-parent > a,
                     .header-fixed .header-10 .account .site-header-account > a:hover, .header-fixed .header-10 .cart-contents:hover .title, .header-fixed .header-10 a:hover span.count{
                        color: {$header_fix_color_hover}!important;
                    }
                ";
            }
            return $css;
        }
        function footer()
        {
            $footer_top_bg = arrowit_get_meta_value('footer_top_bg');
            $css = '';
            if ($footer_top_bg != '') {
                $css = "
                    .page-footer.footer-01 .footer-top,
                    .footer-02 .fm-container.elementor-element.fm-container.elementor-section.elementor-top-section{
                        background: {$footer_top_bg} !important;
                    }
                ";
            }
            $footer_top_bg_image = arrowit_get_meta_value('footer_top_bg_image');
            if ($footer_top_bg_image != '') {
                $css .= "
                    .page-footer.footer-01 .footer-top,
                    .footer-02 .fm-container.elementor-element.fm-container.elementor-section.elementor-top-section{
                        background-image: url($footer_top_bg_image) !important;
                        background-repeat: repeat !important;
                    }
                ";
            }
            $footer_bg = arrowit_get_meta_value('footer_bg');
            if ($footer_bg != '') {
                $css .= "
                    .footer-01, .footer-02, .footer-03, .footer-04, .footer-06{
                        background-color: {$footer_bg}!important;
                    }
                    .footer-05{
                         background: {$footer_bg}!important;
                    }
                ";
            }
            $footer_bg_image = arrowit_get_meta_value('footer_bg_image');
            if ($footer_bg_image != '') {
                $css .= "
                    .footer-01 ,.footer-02 ,.footer-03,
                    .footer-04 ,.footer-05 ,.footer-06{
                        background-image: url($footer_bg_image) !important;
                        background-repeat: repeat !important;
                    }
                ";
            }
            $footer_tt_color = arrowit_get_meta_value('footer_tt_color');
            if ($footer_tt_color != '') {
                $css .= "
                    .footer-01 .widget-title,
                    .footer-02 .footer-contact-form h2, 
                    .footer-02 .list-info-contact li span,
                    .footer-03 .widget-title,
                    .footer-04 .widget-title, 
                    .footer-04 .list-info-contact li span,
                    .footer-05 .widget-title,
                    .footer-06 .list-info-contact li span, 
                    .footer-06 .widget-title{
                        color: {$footer_tt_color} !important;
                    }
                ";
            }
            $footer_text_color = arrowit_get_meta_value('footer_text_color');
            if ($footer_text_color != '') {
                $css .= "
                    .footer-01 .tm-social-widget .title-desc,
                    .footer-01 .list-info-contact li a, 
                    .footer-01 .list-info-contact li p,
                    .footer-01 .footer-copyright p,
                    .footer-01 .footer-copyright p a,
                    .footer-02 .list-info-contact li i, 
                    .footer-02 .mc4wp-form-fields input[type=email], 
                    .footer-02 input[type=email], .footer-02 input[type=text], 
                    .footer-02 textarea, .footer-02 .list-info-contact li p, 
                    .footer-02 .list-info-contact li a,
                    .footer-02 .footer-copyright p, .footer-02 .footer-copyright p a,
                    .footer-03 .list-info-contact li i, .footer-03 .mc4wp-form-fields input[type=email], 
                    .footer-03 input[type=email], .footer-03 input[type=password], .footer-03 input[type=text], 
                    .footer-03 textarea, .footer-03 .footer-contact .title-desc, .footer-03 .footer-menu ul li a, 
                    .footer-03 .list-info-contact li a, .footer-03 .list-info-contact li p, 
                    .footer-03 .footer-copyright p, .footer-03 .footer-copyright p a,
                    .footer-04 .list-info-contact li i, .footer-04 .mc4wp-form-fields input[type=email], 
                    .footer-04 input[type=email], .footer-04 input[type=password], .footer-04 input[type=text], 
                    .footer-04 textarea, .footer-04 .tm-social-widget .title-desc, 
                    .footer-04 .footer-contact .title-desc, .footer-04 .footer-menu ul li a, 
                    .footer-04 .list-info-contact li a, .footer-04 .list-info-contact li p, 
                    .footer-04 .footer-copyright p, .footer-04 .footer-copyright p a,
                    .footer-05 .list-info-contact li i, .footer-05 .mc4wp-form-fields input[type=email], 
                    .footer-05 input[type=email], .footer-05 input[type=password], .footer-05 input[type=text], 
                    .footer-05 textarea, .footer-05 .tm-social-widget .title-desc, 
                    .footer-05 .footer-contact .title-desc, .footer-05 .footer-menu ul li a, .footer-05 .list-info-contact li a, 
                    .footer-05 .list-info-contact li p, .footer-05 .footer-copyright p, .footer-05 .footer-copyright p a,
                    .footer-06 .tm-social-widget .title-desc, .footer-06 .list-info-contact li a, 
                    .footer-06 .list-info-contact li p, .footer-06 .footer-copyright p, .footer-06 .footer-copyright p a{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 .mc4wp-form-fields input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 .mc4wp-form-fields input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 .mc4wp-form-fields input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=text]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=text]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=text]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 input[type=text]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 textarea::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 textarea::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 textarea:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-01 textarea:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 .mc4wp-form-fields input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 .mc4wp-form-fields input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 .mc4wp-form-fields input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=text]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=text]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=text]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 input[type=text]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 textarea::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 textarea::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 textarea:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-02 textarea:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 .mc4wp-form-fields input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 .mc4wp-form-fields input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 .mc4wp-form-fields input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=text]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=text]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=text]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 input[type=text]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 textarea::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 textarea::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 textarea:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-03 textarea:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 .mc4wp-form-fields input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 .mc4wp-form-fields input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 .mc4wp-form-fields input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=text]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=text]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=text]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 input[type=text]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 textarea::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 textarea::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 textarea:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-04 textarea:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }

                    .footer-05 .mc4wp-form-fields input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 .mc4wp-form-fields input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 .mc4wp-form-fields input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 .mc4wp-form-fields input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=email]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=email]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=email]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=email]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=text]::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=text]::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=text]:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 input[type=text]:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 textarea::-webkit-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 textarea::-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 textarea:-ms-input-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                    .footer-05 textarea:-moz-placeholder{
                        color: {$footer_text_color} !important; 
                    }
                ";
            }
            $footer_button_color = arrowit_get_meta_value('footer_button_color');
            if ($footer_button_color != '') {
                $css .= "
                    .footer-01 .open-newsletter.btn-highlight,
                    .footer-01 .mc4wp-form-fields .form-submit.submit input[type=submit],
                    .footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit], 
                    .footer-02 .wpcf7-form .form-submit input[type=submit],
                    .footer-03 .mc4wp-form-fields .form-submit.submit input[type=submit], 
                    .footer-03 .wpcf7-form .form-submit input[type=submit],
                    .footer-04 .mc4wp-form-fields .form-submit.submit input[type=submit], 
                    .footer-04 .wpcf7-form .form-submit input[type=submit],
                    .footer-05 .footer-social-networks li a,
                    .footer-05 .mc4wp-form-fields input[type=email],
                    .footer-05 .mc4wp-form-fields .form-submit.submit input[type=submit],
                    .footer-06 .wpcf7-form .form-submit input[type=submit]{
                         background: {$footer_button_color} !important;  
                    }
                    .footer-01 .mc4wp-form-fields .form-submit.submit input[type=submit],
                    .footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit], 
                    .footer-02 .wpcf7-form .form-submit input[type=submit]{
                         border-color: {$footer_button_color} !important;  
                    }
                    .footer-01 .close-newsletter,
                    .open-newsletter.btn-highlight:hover,
                    .open-newsletter.btn-highlight:focus, 
                    .open-newsletter.btn-highlight:active{
                        color: {$footer_button_color} !important; 
                    }

                ";
            }
            $footer_button_hover_color = arrowit_get_meta_value('footer_button_hover_color');
            if ($footer_button_hover_color != '') {
                $css .= "
                    .footer-01 .close-newsletter:hover,
                    .footer-01 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover,
                    .footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover, 
                    .footer-02 .wpcf7-form .form-submit input[type=submit]:hover,
                    .footer-03 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover, 
                    .footer-03 .wpcf7-form .form-submit input[type=submit]:hover,
                    .footer-04 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover, 
                    .footer-04 .wpcf7-form .form-submit input[type=submit]:hover{
                        background: {$footer_button_hover_color} !important;
                    }
                    .footer-01 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover,
                    .footer-02 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover, 
                    .footer-02 .wpcf7-form .form-submit input[type=submit]:hover,
                    .footer-04 .mc4wp-form-fields .form-submit.submit input[type=submit]:hover, 
                    .footer-04 .wpcf7-form .form-submit input[type=submit]:hover{
                        border-color: {$footer_button_hover_color} !important;
                    }
                    .footer-06 .wpcf7-form .form-submit input[type=submit]:hover, 
                    .footer-06 .wpcf7-form .form-submit:hover:before{
                        color: {$footer_button_hover_color} !important;
                    }
                ";
            }
            $footer_link_color = arrowit_get_meta_value('footer_link_color');
            if ($footer_link_color != '') {
                $css .= "
                    .footer-01 .tm-posts-widget .view_more, 
                    .footer-01 .footer-social-networks li a,
                    .footer-03 .footer-social-networks li a,
                    .footer-04 .footer-social-networks li a,
                    .footer-05 .footer-social-networks li a{
                         color: {$footer_link_color} !important;  
                    }
                    .footer-01 .tm-posts-widget .view_more:before, 
                    .footer-04 .footer-social-networks li a:hover{
                        background: {$footer_link_color} !important;  
                    }
                ";
            }
            $footer_link_hover_color = arrowit_get_meta_value('footer_link_hover_color');
            if ($footer_link_hover_color != '') {
                $css .= "
                    .footer-01 .list-info-contact li a:hover,
                    .footer-01 .footer-copyright p a:hover,
                    .footer-01 .footer-social-networks li a:hover,
                    .footer-02 .list-info-contact li a:hover, 
                    .footer-02 .footer-copyright p a:hover,
                    .footer-03 .footer-menu ul li a:hover, 
                    .footer-03 .list-info-contact li a:hover, 
                    .footer-03 .footer-social-networks li a:hover, 
                    .footer-03 .footer-copyright p a:hover,
                    .footer-04 .list-info-contact li a:hover, 
                    .footer-04 .footer-copyright p a:hover,
                    .footer-05 .footer-social-networks li a:hover, 
                    .footer-05 .footer-copyright p a:hover,
                    .footer-06 .list-info-contact li a:hover, 
                    .footer-06 .footer-copyright p a:hover,
                    .footer-07 .footer-social-networks li a:hover, 
                    .footer-07 .footer-copyright p a:hover{
                        color: {$footer_link_hover_color} !important;  
                    }
                    .footer-05 .footer-social-networks li a:hover{
                        border-color: {$footer_link_hover_color} !important;
                    }
                ";
            }
            $footer_background_bottom = arrowit_get_meta_value('footer_background_bottom');
            if ($footer_background_bottom != '') {
                $css .= " 
                   .footer-01 .footer-bottom{
                       background: {$footer_background_bottom} !important; 
                   } 
                ";
            }
            return $css;
        }

        function site_width()
        {
            $site_width = arrowit_get_meta_value('site_width');
            $css = '';
            if (isset($site_width) && $site_width != '') {
                $css = "
                 @media (min-width: 1200px){
                    .site-width > .wrapper > .container,
                    .elementor-inner .elementor-section.elementor-section-boxed>.elementor-container{
                        max-width: {$site_width};
                    }
                }";
            }
            return $css;
        }

        function remove_space_top()
        {
            $remove_space_top = arrowit_get_meta_value('remove_space_top');
            $css = '';
            if ($remove_space_top != '') {
                $css = "
                .remove_space_top .side-breadcrumb{
                    margin-bottom: 0 !important;
                }
                .remove_space_top .site-header+.wrapper{
                    padding-top: 0 !important;
                }";
            }
            return $css;
        }

        function remove_space_bottom()
        {
            $remove_space_bottom = arrowit_get_meta_value('remove_space_bottom');
            $css = '';
            if ($remove_space_bottom != '') {
                $css = "
               .remove_space_bottom .page-footer,
               .remove_space_bottom  + .page-footer{
                    margin-top: 0 !important;
                }
                ";
            }
            return $css;
        }

        function scroll_top_color()
        {
            $scroll_top_color = arrowit_get_meta_value('scroll_top_color');
            $css = '';
            if ($scroll_top_color != '') {
                $css = "
                .scroll-to-top {
                    background: {$scroll_top_color};
                }
                ";
            }
            return $css;
        }
        function scroll_top_spacer()
        {
            $scroll_top_spacer = arrowit_get_meta_value('scroll_top_spacer');
            $scroll_top_horizontal = arrowit_get_meta_value('scroll_top_horizontal');
            $css = '';
            if ($scroll_top_spacer != '') {
                $css .= "
                .scroll-to-top {
                    bottom: {$scroll_top_spacer} !important;
                }
                ";
            }
            if ($scroll_top_horizontal != '') {
                $css .= "
                .scroll-to-top {
                    right: {$scroll_top_horizontal} !important;
                }
                ";
            }
            return $css;
        }

        function btn_style_color()
        {
            $btn_style_color = arrowit_get_meta_value('footer_button_style_color');
            $css = '';
            if ($btn_style_color != '') {
                $css .= "
                .apr-cf7-button-left .apr-cf7 .wpcf7-form .form-submit:before {
                    background-color: {$btn_style_color};
                }
                ";
            }
            return $css;
        }
    }

    new Arrowit_Custom_Style();
}