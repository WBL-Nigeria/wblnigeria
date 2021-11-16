<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Arrowit_Enqueue' ) ) {
	class Arrowit_Enqueue {
		protected static $instance = null;
		public function __construct() {
			add_action('after_setup_theme', array($this,'setup'));
			add_action('admin_enqueue_scripts', array($this,'admin_scripts_css'));
			add_action('wp_enqueue_scripts', array($this,'scripts_js',));
			add_filter('tiny_mce_before_init', array( $this, 'override_mce_options'));
		}
		public function setup() {
			// Make theme available for translation.
			load_theme_textdomain('arrowit', get_template_directory() . '/languages');
			// Theme editor style
			add_editor_style( array( 'style.css' ) );
			// Add theme support
			add_theme_support('automatic-feed-links');
			add_theme_support( 'title-tag' );  
			/*
			 * Enable support for Post Formats.
			 *
			 * See: https://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array(
				'image', 'video', 'audio', 'quote', 'link', 'gallery'
			) );
			// register menu locations
			register_nav_menus( array(
				'primary' => esc_html__('Primary Menu', 'arrowit'),
			));
			// Enable custom background image option
			add_theme_support( 'custom-background' );
		}
		function dequeue_woocommerce_styles_scripts() {
			if ( function_exists( 'is_woocommerce' ) ) {
				if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
					wp_dequeue_style( 'jquery-colorbox' );
					wp_dequeue_script( 'yith-woocompare-main' );
					wp_dequeue_script( 'jquery-colorbox' );
					wp_dequeue_script( 'jquery-yith-wcwl' );
					wp_dequeue_script( 'jquery-yith-wcwl-user' );
				}
			}
		}
		function enqueue_woocommerce_styles_scripts() {
			wp_enqueue_script( 'jquery-yith-wcwl' );
			wp_enqueue_script( 'jquery-yith-wcwl-user' );
			wp_enqueue_style( 'jquery-colorbox' );
			wp_enqueue_script( 'yith-woocompare-main' );
			wp_enqueue_script( 'jquery-colorbox' );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
		public function admin_scripts_css() {
			// Register & enqueue admin script
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_script( 'wp-color-picker');
			wp_register_script('arrowit-admin-js', ARROWIT_JS . '/un-minify/admin.js', array('common', 'jquery', 'media-upload', 'thickbox'), ARROWIT_THEME_VERSION, true);
			wp_enqueue_script('arrowit-admin-js'); 

		}
		
		public function scripts_js() {
			if(!is_admin()){
				global $wp_styles, $wp_query, $wp_scripts;
				$arrowit_woo_enable = $arrowit_fancybox_enable = $arrowit_rtl = $post_content = $shop_list = $arrowit_slick_enable = $arrowit_valid_form = $arrowit_animation = $product_list_mode = $arrowit_number_cate = '';
				$arrowit_scripts = array_map('basename', (array) wp_list_pluck($wp_scripts->registered, 'src') );
				$arrowit_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min'; 
				$arrowit_srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );    
				function arrowit_fonts_url() {
					$font_url = '';
					$fonts     = array();
					$subsets   = 'latin,latin-ext';
					$arrowit_breadcrumbs_font = get_post_meta(get_the_ID(),'breadcrumbs_font',true);
					/*
					Translators: If there are characters in your language that are not supported
					by chosen font(s), translate this to 'off'. Do not translate into your own language.
					 */
					if ( 'off' !== _x( 'on', 'Google font: on or off', 'arrowit' ) ) {
						$fonts[] = 'Poppins'.':300,400,500,600,700,800,900';
						$fonts[] = 'Nunito'.':300,400,500,600,700,800,900';
						
					}
					/*
					 * Translators: To add an additional character subset specific to your language,
					 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
					 */
					$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'arrowit' );
					if ( 'cyrillic' == $subset ) {
						$subsets .= ',cyrillic,cyrillic-ext';
					} elseif ( 'greek' == $subset ) {
						$subsets .= ',greek,greek-ext';
					} elseif ( 'devanagari' == $subset ) {
						$subsets .= ',devanagari';
					} elseif ( 'vietnamese' == $subset ) {
						$subsets .= ',vietnamese';
					}
					if ( $fonts ) {
						$font_url = add_query_arg( array(
							'family' => urlencode( implode( '|', $fonts ) ),
							'subset' => urlencode( $subsets ),
						), '//fonts.googleapis.com/css' );
					}
					return esc_url_raw($font_url);
				}
				if(class_exists('WooCommerce')){
					$arrowit_woo_enable = 'yes';
					$shop_list = is_product_category();
					$cat = $wp_query->get_queried_object();
					if(isset($cat->term_id)){
						$woo_cat = $cat->term_id;
					}else{
						$woo_cat = '';
					}  
					$product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true); 
					$product_cate_number = get_metadata('product_cat', $woo_cat, 'product_cate_number', true); 
					if($product_cate_number !== '' && is_tax('product_cat')){
						$arrowit_number_cate = $product_cate_number;
					}else{
						$arrowit_number_cate = Arrowit::setting( 'number_cate' );
					}
				}
                $coming_subcribe_text = Arrowit::setting( 'coming_subcribe_text' );
                $coming_soon_countdown = Arrowit::setting('coming_soon_countdown');
                $single_product_prev = Arrowit::setting('single_product_prev');
                $single_product_next = Arrowit::setting('single_product_next');
                $single_per_limit = Arrowit::setting('per_limit');
				if ( is_singular() && get_option( 'thread_comments' ) ) {
					wp_enqueue_script( 'comment-reply' );
				}
				/* Register Script */
					wp_register_script('popper', get_template_directory_uri() . '/assets/js/popper'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);   
					wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);     
					wp_register_script('isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);   
					wp_register_script('fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
					wp_register_script('slick', get_template_directory_uri() . '/assets/js/slick'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
					wp_register_script('swiper', get_template_directory_uri() . '/assets/js/swiper'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
					wp_register_script('validate', get_template_directory_uri() . '/assets/js/jquery.validate'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION);
					wp_register_script('appear', get_template_directory_uri() . '/assets/js/un-minify/appear'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);      
					wp_register_script('wow', get_template_directory_uri() . '/assets/js/wow'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
                wp_register_script('fullpage-scripts', get_template_directory_uri() . '/assets/js/fullpage'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
					wp_register_script('arrowit-scripts', get_template_directory_uri() . '/assets/js/un-minify/theme_function'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
					wp_register_script('countdown-scripts', get_template_directory_uri() . '/assets/js/jquery.countdown'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
					wp_register_script('slimscroll-scripts', get_template_directory_uri() . '/assets/js/jquery.slimscroll'.esc_html($arrowit_suffix).'.js', array('jquery'), ARROWIT_THEME_VERSION, true);
				/* Register Styles*/
					wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/plugin/bootstrap'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);
					wp_deregister_style('font-awesome'); 
					wp_deregister_style('arrowit-font');
					wp_deregister_style('yith-wcwl-font-awesome');        
					wp_register_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);  
					wp_register_style('arrowit', get_template_directory_uri() . '/assets/css/arrowit.css?ver=' . ARROWIT_THEME_VERSION);
					wp_register_style('fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);
					wp_register_style('slick', get_template_directory_uri() . '/assets/css/plugin/slick'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);
					wp_register_style('swiper', get_template_directory_uri() . '/assets/css/plugin/swiper'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);   
					wp_register_style('animate', get_template_directory_uri() . '/assets/css/animate'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);   
					wp_register_style('fullpage', get_template_directory_uri() . '/assets/css/plugin/fullpage'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);
					wp_register_style('arrowit-theme', get_template_directory_uri() . '/assets/css/theme'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);
					wp_deregister_style( 'arrowit-style' );
					wp_register_style( 'arrowit-style', get_template_directory_uri() . '/style.css' );
					
					if (Arrowit::setting( 'custom_css_enable' ) == 1) {
						wp_add_inline_style( 'arrowit-style', html_entity_decode( Arrowit::setting( 'custom_css' ), ENT_QUOTES ) );
					}
					if ( Arrowit::setting( 'custom_js_enable' ) == 1 ) {
						wp_add_inline_script( 'arrowit-scripts', html_entity_decode( Arrowit::setting( 'custom_js' ) ) );
					}
				/* Enqueue Styles & Script */
					wp_enqueue_style('bootstrap');
					wp_enqueue_script('popper');
					wp_enqueue_script('bootstrap');
					wp_enqueue_style('font-awesome'); 
					wp_enqueue_style('fullpage');
					wp_enqueue_style('arrowit');
					if (is_rtl()) {
		                wp_enqueue_style('arrowit-theme-rtl', get_template_directory_uri() . '/assets/css/theme_rtl'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);
		            }else{
		                wp_enqueue_style('arrowit-theme', get_template_directory_uri() . '/assets/css/theme'.esc_html($arrowit_suffix).'.css?ver=' . ARROWIT_THEME_VERSION);   
		            }

					wp_enqueue_script('wow');
					wp_enqueue_style('arrowit-fonts', arrowit_fonts_url(), array(), null );
                    // Animation
                        $arrowit_animation = 'yes';
                        wp_enqueue_script('appear');
                        wp_enqueue_style('animate');

                    // Fancybox
                        $arrowit_fancybox_enable = 'yes';
                        wp_enqueue_script('fancybox');
                        wp_enqueue_style('fancybox');
					if( post_type_supports( get_post_type(), 'comments' ) ) {
						if( comments_open() ) {
							$arrowit_valid_form = 'yes';
							wp_enqueue_script('validate');
						}
					}   
					wp_enqueue_script('slick');
					wp_enqueue_script('swiper');
					wp_enqueue_style('slick');
					wp_enqueue_style('swiper');
					wp_enqueue_script('jquery-ui-autocomplete' );   
					wp_enqueue_script('isotope');
					wp_enqueue_style('arrowit-style' );
					wp_enqueue_script('arrowit-scripts');
					wp_enqueue_script('countdown-scripts');
					wp_enqueue_script('slimscroll-scripts');
					wp_enqueue_script('fullpage-scripts');
					wp_localize_script('arrowit-scripts', 'arrowit_params', array(
						'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
						'ajax_loader_url' => esc_js(str_replace(array('http:', 'https'), array('', ''), ARROWIT_CSS . '/assets/images/ajax-loader.gif')),
						'ajax_cart_added_msg' => esc_html__('A product has been added to cart.', 'arrowit'),
						'ajax_compare_added_msg' => esc_html__('A product has been added to compare', 'arrowit'),
						'type_product' => $product_list_mode,
						'shop_list' => $shop_list,
						'arrowit_number_cate' => esc_js($arrowit_number_cate),
						'arrowit_woo_enable'=> esc_js($arrowit_woo_enable),
						'arrowit_fancybox_enable' => esc_js($arrowit_fancybox_enable),
						'arrowit_slick_enable' => esc_js($arrowit_slick_enable),
						'arrowit_valid_form' => esc_js($arrowit_valid_form),
						'arrowit_animation' => esc_js($arrowit_animation),
						'coming_subcribe_text' => esc_js($coming_subcribe_text),
						'coming_soon_countdown' => esc_js($coming_soon_countdown),
						'single_product_prev' => esc_js($single_product_prev),
						'single_product_next' => esc_js($single_product_next),
						'single_per_limit' => esc_js($single_per_limit),
						'arrowit_rtl' => esc_js(is_rtl()?'yes':''),
						'arrowit_search_no_result' => esc_js(__('Search no result','arrowit')),
						'arrowit_like_text' => esc_js(__('Like','arrowit')),
						'arrowit_unlike_text' => esc_js(__('Unlike','arrowit')),
						'request_error' => esc_js(__('The requested content cannot be loaded.<br/>Please try again later.', 'arrowit')),
					));    
				wp_deregister_style('wpcr_font-awesome');
			}
		}
		public function override_mce_options($initArray) {
			$opts = '*[*]';
			$initArray['valid_elements'] = $opts;
			$initArray['extended_valid_elements'] = $opts;
			return $initArray;
		} 
	}
	new Arrowit_Enqueue();
}