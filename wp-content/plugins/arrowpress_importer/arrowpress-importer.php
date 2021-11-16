<?php
/**
* Plugin Name: ArrowPress Importer
* Description: ArrowPress One click demo import 
* Version: 1.0
* Author: ArrowPress
* Author URI: http://arrowpress.net/
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');


define('ARROWPRESS_IMPORTER_URL', plugin_dir_url(__FILE__));
// require_once( 'inc/functions.php' );
require_once( 'one-click-demo-import/one-click-demo-import.php' );


/** Enqueue admin style file for import page */
add_action('admin_enqueue_scripts', 'arrowpress_importer_enqueue'); 
function arrowpress_importer_enqueue() {
  	wp_enqueue_style('arrowpress_importer_style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}

/**
 * Import file setup
 */
if ( ! function_exists( 'arrowpress_importer_files' ) ) {
	function arrowpress_importer_files() {
		$demo_link = 'hn.arrowpress.net/arrowit/';
	  	return array(
			array(
				'import_file_name'             => 'Base Content',
				'categories'                   => array( 'Base Content'),
				'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/data/content.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/data/widget.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/data/customizer.dat',
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/base.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
			),
			array(
				'import_file_name'             => 'Tech Business',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-tech.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'tech-business',
			),  
			array(
				'import_file_name'             => 'Product Landing',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-product.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'product-landing',
			), 
			array(
				'import_file_name'             => 'App Landing',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-app.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'app-landing',
			), 	
			array(
				'import_file_name'             => 'Seo Marketing',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-seo.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'seo',
			), 	
			array(
				'import_file_name'             => 'Software',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-software.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'software',
			), 
			array(
				'import_file_name'             => 'Startup Business',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-startup.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'startup-business',
			), 
			array(
				'import_file_name'             => 'Digital Agency',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-digital.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'digital-agency',
			), 
			array(
				'import_file_name'             => 'Webmaster',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-webmaster.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-webmaster',
			), 
			array(
				'import_file_name'             => 'CV',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-cv.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-cv',
			),
			array(
				'import_file_name'             => 'IoT',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-iot.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-iot',
			),
			array(
				'import_file_name'             => 'IoT Details',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home-details-iot.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'lampo-page',
			),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'arrowpress_importer_files' );
}


/**
 * Steps after importing content: 
 * 
 * - Set menu location
 * - Import theme options
 * - Set front page & blog page
 * - Import slider
 */
if ( ! function_exists( 'arrowpress_importer_after_import' ) ) {
	function arrowpress_importer_after_import( $selected_import ) {
    	global $wp_filesystem; 
            if ( empty( $wp_filesystem ) ) {
                require_once ABSPATH . '/wp-admin/includes/file.php';
                WP_Filesystem();
            }	
    		$chosen_template = $selected_import['import_file_name'];

    	    if ( 'Base Content' === $selected_import['import_file_name'] ) {

    	       	//Set Main Menu
    			$main_menu = get_term_by( 'name', 'Menu Primary', 'nav_menu' );
    			set_theme_mod( 'nav_menu_locations', array(
    					'primary' => $main_menu->term_id,
    				)
    			); 

                
                echo 'Delete Default Post and Page \n';

                /** Delete Hello Post */
    		    wp_delete_post( 1, true );

    		    /** Delete "Sample Page" Page */
    		    wp_delete_post( 2, true );

                // /*Widgets*/
                // $widgets_file = ARROWPRESS_IMPORTER_URL . 'data/widget_data.json';
                // echo $widgets_file;
                // // if ( file_exists( $widgets_file ) ) {
                // 	echo 'file exits';
                //     $encode_widgets_array = $wp_filesystem->get_contents( $widgets_file );
                //     arrowpress_import_widgets( $encode_widgets_array );
                //     print_r($encode_widgets_array);
                // // }	
                
    	    }elseif('Tech Business' === $selected_import['import_file_name']){
                //front page
                echo "Set Front Page \n";	
                $front_page = get_page_by_title( 'Tech' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }	
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-tech.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
				
    		}elseif('Product Landing' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'Product Landing' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-product.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();  
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
				
            }elseif('App Landing' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'App Landing' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-app.zip';
					$app_slider = plugin_dir_path( __FILE__ ) . '/data/app-landing.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }

                    if ( file_exists( $app_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $app_slider );
                    }
                } 
            }elseif('Seo Marketing' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'Seo Marketing' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-seo.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
            }elseif('Software' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'Software' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-software.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
            }elseif('Startup Business' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'Startup Business' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-startup.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
            }elseif('Digital Agency' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'Digital Agency' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-digital.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
            }elseif('Webmaster' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'Webmaster' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-webmaster.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
            }elseif('CV' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'CV' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
            }elseif('IoT' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'IoT' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/home-iot.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
            }elseif('IoT Details' === $selected_import['import_file_name']) {
                //front page
                $front_page = get_page_by_title( 'IoT Details' );
                if ( isset( $front_page->ID ) ) {
                    update_option( 'page_on_front', $front_page->ID );
                    update_option( 'show_on_front', 'page' );
                }

                $blog_page = get_page_by_title( 'Blog' );
                if ( isset( $blog_page->ID ) ) {
                    update_option( 'page_for_posts', $blog_page->ID );
                }  
				if ( class_exists( 'RevSlider' ) ) {
                    $main_slider = plugin_dir_path( __FILE__ ) . '/data/lampo-single.zip';

                    if ( file_exists( $main_slider ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $main_slider );
                    }
                } 
            }
    	}
	add_action( 'pt-ocdi/after_import', 'arrowpress_importer_after_import' );
}


/** Echo text before importing widget in log file */
if ( ! function_exists( 'arrowpress_importer_before_widgets_import' ) ) {
	function arrowpress_importer_before_widgets_import( $selected_import ) {
		echo "Import Widget";
	}
	add_action( 'pt-ocdi/before_widgets_import', 'arrowpress_importer_before_widgets_import' );
}

/**
 * Changing Import Page slug
 */
if ( ! function_exists( 'arrowpress_importer_plugin_page_setup' ) ) {
	function arrowpress_importer_plugin_page_setup( $default_settings ) {
		$default_settings['parent_slug'] = 'themes.php';
		$default_settings['page_title']  = esc_html__( 'ArrowPress Importer' , 'arrowpress-importer' );
		$default_settings['menu_title']  = esc_html__( 'Import Demo Content' , 'arrowpress-importer' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'arrowpress-importer';

		return $default_settings;
	}
	add_filter( 'pt-ocdi/plugin_page_setup', 'arrowpress_importer_plugin_page_setup' );
}

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

// Increase PHP max execution time. Just in case, even though the AJAX calls are only 25 sec long.
$disabled = explode(',', ini_get('disable_functions'));
if( !ini_get('safe_mode') && !in_array('set_time_limit', $disabled) ) {
	set_time_limit( apply_filters( 'pt-ocdi/set_time_limit_for_demo_data_import', 600 ) );
}