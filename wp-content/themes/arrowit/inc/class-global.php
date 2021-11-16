<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Arrowit_Global' ) ) {
    class Arrowit_Global {
        protected static $instance = null;
        protected static $header_type = '01';
        protected static $footer_type = '01';
        public $has_sidebar = false;
        public $has_both_sidebar = false;
        public $wishlist_tooltip_position = 'left';
        function __construct() {
            add_action( 'wp', array( $this, 'init_global_variable' ) );
        }
        public static function instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        function init_global_variable() {
            global $arrowit_page_options;
            if ( is_singular( 'portfolio' ) ) {
                $arrowit_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_portfolio_options', true ) );
            } elseif ( is_singular( 'post' ) ) {
                $arrowit_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_post_options', true ) );
            } elseif ( is_singular( 'page' ) ) {
                $arrowit_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_page_options', true ) );
            } elseif ( is_singular( 'product' ) ) {
                $arrowit_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_product_options', true ) );
            }
            if ( function_exists( 'is_shop' ) && is_shop() ) {
                // Get page id of shop.
                $page_id              = wc_get_page_id( 'shop' );
                $arrowit_page_options = unserialize( get_post_meta( $page_id, 'apr_page_options', true ) );
            }
            $this->set_footer_type();
        }
        function set_footer_type() {
			$result = '';
			global $wp_query, $footer_type;
			if (empty($footer_type)) {
				$result = Arrowit::setting('global_footer');
				if (is_category()) {
					$cat = $wp_query->get_queried_object();
					$cat_layout = get_metadata('category', $cat->term_id, 'footer_type', true);
					if (!empty($cat_layout) && $cat_layout != 'default') {
							$result = $cat_layout;
						}
				} else if (is_archive()) {
					if (function_exists('is_shop') && is_shop()) {
						$shop_layout = get_post_meta(wc_get_page_id('shop'), 'footer_type', true);
						if(!empty($shop_layout) && $shop_layout != 'default') {
							$result = $shop_layout;
						}
					} 
				}else {
                    $footer_layout_page = get_post_meta(get_the_ID(), 'footer_type', true);
                    if($footer_layout_page && $footer_layout_page != 'default' && $result != 'none'){
                        $result = $footer_layout_page;
                    }
				}
                $footer_type = $result;
			}
			return $footer_type;
		}
        function get_footer_type() {
            return self::$footer_type;
        }
        public static function is_blog () {
            global  $post;
            $posttype = get_post_type($post );
            return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
        }
        public static function is_shop () {
             return ( is_post_type_archive( 'product' ) );
        }
        public static function check_container_type () {
            $layout_site = Arrowit::setting( 'layout_site' );
            $blog_layout = Arrowit::setting( 'blog_general_layout' );
            $member_layout = Arrowit::setting( 'member_layout' );
            $service_layout = Arrowit::setting( 'service_layout' );
            $portfolio_layout = Arrowit::setting( 'portfolio_layout' );
            $shop_layout = Arrowit::setting( 'shop_layout' );
            $single_shop_layout = Arrowit::setting( 'single_layout' );
            if (is_404()){
                $container ='container-fluid';
            }elseif (self::is_blog()){
                if ($blog_layout === 'wide'){
                    $container ='container-fluid';
                }elseif ($blog_layout === 'full_width'){
                    $container ='container';
                }else{
                    $container ='container-fluid';
                }
            }elseif ( 'member' == get_post_type()){
                if ($member_layout === 'wide'){
                    $container ='container-fluid';
                }elseif ($member_layout === 'full_width'){
                    $container ='container';
                }else{
                    $container ='container-fluid';
                }
            }elseif ( 'service' == get_post_type()){
                if ($service_layout === 'wide'){
                    $container ='container-fluid';
                }elseif ($service_layout === 'full_width'){
                    $container ='container';
                }else{
                    $container ='container-fluid';
                }
            }elseif ( 'portfolio' == get_post_type()){
                if ($portfolio_layout === 'wide'){
                    $container ='container-fluid';
                }elseif ($portfolio_layout === 'full_width'){
                    $container ='container';
                }else{
                    $container ='container-fluid';
                }
            }elseif (class_exists('WooCommerce') && is_product()){
                if ($single_shop_layout === 'wide'){
                    $container ='container-fluid';
                }elseif ($single_shop_layout === 'full_width'){
                    $container ='container';
                }else{
                    $container ='container-fluid boxed';
                }
            }elseif ( 'product' == get_post_type()){
                if ($shop_layout === 'wide'){
                    $container ='container-fluid';
                }elseif ($shop_layout === 'full_width'){
                    $container ='container';
                }else{
                    $container ='container-fluid boxed';
                }
            }else{
                if ($layout_site === 'wide'){
                    $container ='container-fluid';
                }elseif ($layout_site === 'full_width'){
                    $container ='container';
                }else {
                    $container = 'container-fluid';
                }
            }
            return $container;
        }
        public static function check_layout_type () {
            $layout_site = Arrowit::setting( 'layout_site' );
            $blog_layout = Arrowit::setting( 'blog_general_layout' );
            $member_layout = Arrowit::setting( 'member_layout' );
            $service_layout = Arrowit::setting( 'service_layout' );
            $portfolio_layout = Arrowit::setting( 'portfolio_layout' );
			$shop_layout = Arrowit::setting( 'shop_layout' );
            $single_shop_layout = Arrowit::setting( 'single_layout' );
            if (is_404()){
                $page_layout= 'wide';
            }elseif (self::is_blog()){
                if ($blog_layout === 'wide'){
                    $page_layout= 'wide';
                }elseif ($blog_layout === 'full_width'){
                    $page_layout= 'full';
                }else{
                    $page_layout= 'boxed';
                }
            }elseif ( 'member' == get_post_type()){
                if ($member_layout === 'wide'){
                    $page_layout= 'wide';
                }elseif ($member_layout === 'full_width'){
                    $page_layout= 'full';
                }else{
                    $page_layout= 'boxed';
                }
            }elseif ( 'portfolio' == get_post_type()){
                if ($portfolio_layout === 'wide'){
                    $page_layout= 'wide';
                }elseif ($portfolio_layout === 'full_width'){
                    $page_layout= 'full';
                }else{
                    $page_layout= 'boxed';
                }
            }elseif ( 'service' == get_post_type()){
                if ($service_layout === 'wide'){
                    $page_layout= 'wide';
                }elseif ($service_layout === 'full_width'){
                    $page_layout= 'full';
                }else{
                    $page_layout= 'boxed';
                }
            }elseif (class_exists('WooCommerce') && is_product()){
                if ($single_shop_layout === 'wide'){
                    $page_layout ='wide';
                }elseif ($single_shop_layout === 'full_width'){
                    $page_layout ='full';
                }else{
                    $page_layout ='boxed';
                }
            }elseif ( 'product' == get_post_type()){
                if ($shop_layout === 'wide'){
                    $page_layout ='wide';
                }elseif ($shop_layout === 'full_width'){
                    $page_layout ='full';
                }else{
					$page_layout ='boxed';
				}
            }else{
                if ($layout_site === 'wide'){
                    $page_layout= 'wide';
                }elseif ($layout_site === 'full_width'){
                    $page_layout= 'full';
                }else {
                    $page_layout= 'boxed';
                }
            }
            return $page_layout;
        }
        public static function get_left_sidebar(){
            $arrowit_left_sidebar = get_post_meta(get_the_ID(), 'left_sidebar_general', true);
            if (!is_404()){
                if (self::is_blog()){
                    if (is_category()){                            
                        $arrowit_left_sidebar_cat = arrowit_get_meta_value('left_sidebar', false);
                        if( $arrowit_left_sidebar_cat != 'default' && $arrowit_left_sidebar_cat !== 'none' && $arrowit_left_sidebar_cat !== ''){
                            $sidebar_left = $arrowit_left_sidebar_cat;
                        }elseif($arrowit_left_sidebar_cat === 'none'){
							$sidebar_left = 'none';
						}else {
                            $sidebar_left = Arrowit::setting('blog_sidebar_left');
                        } 
                    } else{
                        if (self::is_blog() || is_tax()){
                            if( $arrowit_left_sidebar != 'default' && $arrowit_left_sidebar !== 'none' && $arrowit_left_sidebar !== ''){
                                $sidebar_left = $arrowit_left_sidebar;
                            }else{ 
                                $sidebar_left = Arrowit::setting('blog_sidebar_left');
                            }
                        }
                    }
                } elseif (is_tax('product_cat')){                            
                    $arrowit_left_sidebar_product = arrowit_get_meta_value('product_left_sidebar');
                    if($arrowit_left_sidebar_product !== 'default' && $arrowit_left_sidebar_product !== 'none' && $arrowit_left_sidebar_product !== ''){
                        $sidebar_left = $arrowit_left_sidebar_product;
                    }elseif($arrowit_left_sidebar_product === 'none'){
						$sidebar_left = 'none';
					}else {
                        $sidebar_left = Arrowit::setting('shop_sidebar_left');
                    } 
                } elseif (is_singular('product')){    
                    if($arrowit_left_sidebar !== 'default' && $arrowit_left_sidebar !== 'none' && $arrowit_left_sidebar !== ''){
                        $sidebar_left = $arrowit_left_sidebar;
                    }elseif($arrowit_left_sidebar === 'none'){
						$sidebar_left = 'none';
					}else {
                        $sidebar_left = Arrowit::setting('single_sidebar_left');
                    } 
                } elseif (self::is_shop() || ((is_tax('product_tag')|| is_tax('yith_product_brand')) && class_exists('WooCommerce'))){
                    $sidebar_left = Arrowit::setting('shop_sidebar_left');
                }else {
                    if( $arrowit_left_sidebar != 'default' && $arrowit_left_sidebar !== 'none' && $arrowit_left_sidebar !== ''){
                        $sidebar_left = $arrowit_left_sidebar;
                    }elseif($arrowit_left_sidebar === 'none'){
                        $sidebar_left = 'none';
                    }else{
                        $sidebar_left = Arrowit::setting('general_left_sidebar');
                    }
                }

            }
            return $sidebar_left;
        }
        public static function get_right_sidebar(){
            $arrowit_right_sidebar = get_post_meta(get_the_ID(), 'right_sidebar_general', true);
            if (!is_404()){
                if (self::is_blog()){
                    if (is_category()){                            
                        $arrowit_right_sidebar_cat = arrowit_get_meta_value('right_sidebar', false);
                        if($arrowit_right_sidebar_cat != 'default' && $arrowit_right_sidebar_cat !== 'none' && $arrowit_right_sidebar_cat !== ''){
                            $sidebar_right = $arrowit_right_sidebar_cat;
                        }elseif($arrowit_right_sidebar_cat === 'none'){
							$sidebar_right = 'none';
						}else {
                            $sidebar_right = Arrowit::setting('blog_sidebars_right');
                        }
                    } else{
                        if (self::is_blog() || is_tax()){
                            if( $arrowit_right_sidebar != 'default' && $arrowit_right_sidebar !== 'none' && $arrowit_right_sidebar !== ''){
                                $sidebar_right = $arrowit_right_sidebar;
                            }else{ 
                                $sidebar_right = Arrowit::setting('blog_sidebars_right');
                            }
                        }
                    }
                }elseif (is_tax('product_cat')){                            
                    $arrowit_right_sidebar_product = arrowit_get_meta_value('product_right_sidebar');
                    if($arrowit_right_sidebar_product !== 'default' && $arrowit_right_sidebar_product !== 'none' && $arrowit_right_sidebar_product !== ''){
                        $sidebar_right = $arrowit_right_sidebar_product;
                    }elseif($arrowit_right_sidebar_product === 'none'){
						$sidebar_right = 'none';
					}else {
                        $sidebar_right = Arrowit::setting('shop_sidebar_right');
                    } 
                } elseif(self::is_shop() || ((is_tax('product_tag')|| is_tax('yith_product_brand')) && class_exists('WooCommerce'))){
                    $sidebar_right = Arrowit::setting('shop_sidebar_right');
                } elseif (is_singular('product')){    
                    if($arrowit_right_sidebar !== 'default' && $arrowit_right_sidebar !== 'none' && $arrowit_right_sidebar !== ''){
                        $sidebar_right = $arrowit_right_sidebar;
                    }elseif($arrowit_right_sidebar === 'none'){
						$sidebar_right = 'none';
					}else {
                        $sidebar_right = Arrowit::setting('single_sidebar_right');
                    } 
                } else{
                    if( ($arrowit_right_sidebar !== 'default') && ($arrowit_right_sidebar !== 'none') && $arrowit_right_sidebar !== ''){
                        $sidebar_right = $arrowit_right_sidebar;
                    }elseif($arrowit_right_sidebar === 'none'){
                        $sidebar_right = 'none';
                    }else{ 
                        $sidebar_right = Arrowit::setting('general_right_sidebar');
                    }
                }
            }
            return $sidebar_right;
        }
        public static function get_page_sidebar(){
            $page_sidebar1 = self::get_left_sidebar();
            $page_sidebar2 = self::get_right_sidebar();
            if (!is_404() || is_page_template('coming-soon.php')){
                if ( $page_sidebar1  !== 'none' && $page_sidebar1  !== '' && $page_sidebar2 !== 'none' && $page_sidebar2  !== '' && is_active_sidebar($page_sidebar1) && is_active_sidebar($page_sidebar2)) {
                    $cols = 'col-xl-6 col-lg-6 col-md-12 col-sm-12 main-sidebar has-sidebar';
                } elseif (($page_sidebar1  !== 'none' && $page_sidebar1  !== '' && is_active_sidebar($page_sidebar1)) || ($page_sidebar2 !== 'none'&& $page_sidebar2 !== '' && is_active_sidebar($page_sidebar2))){
                    $cols = 'col-xl-9 col-lg-9 col-md-12 col-sm-12 main-sidebar has-sidebar';
                }else {
                    $cols = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 main-sidebar';
                }
                return $cols;
            }
        }
    }
    global $arrowit_vars;
    $arrowit_vars = new Arrowit_Global();
}