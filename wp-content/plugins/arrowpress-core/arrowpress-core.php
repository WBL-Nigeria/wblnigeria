<?php
/*
Plugin Name: Arrowpress Core
Plugin URI: https://www.arrowhitech.com/
Description: Core for ArrowPress Theme.
Version: 1.0.1
Author: AHT
Author URI: https://www.arrowhitech.com/
License: MIT License
Text Domain: apr-core
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$theme = wp_get_theme();
if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}
define( 'APR_CORE_SITE_URI', site_url() );
define( 'APR_CORE_PATH', plugin_dir_url( __FILE__ ) );
define( 'APR_CORE_DIR', dirname( __FILE__ ) );
define( 'APR_CORE_THEME_NAME', $theme['Name'] );
define( 'APR_CORE_THEME_SLUG', $theme['Template'] );
define( 'APR_CORE_THEME_VERSION', $theme['Version'] );
define( 'APR_CORE_THEME_DIR', get_template_directory() );
define( 'APR_CORE_THEME_URI', get_template_directory_uri() );

if ( !class_exists( 'Apr_Core' ) ) :

    class Apr_Core {

        /*
        * This method loads other methods of the class.
        */
        function __construct() {

            /* Load define */
            $this->apr_core_define();

            /* Load check Elementor installed and activated */
            add_action( 'plugins_loaded', [ $this, 'apr_core_loaded' ] );

            /*Load script*/
            $this->apr_core_script();

        }

        /* Load define */
        function apr_core_define() {

            define('APR_VERSION', '1.0.0');

            define( 'APR_CORE_SERVER_PATH', dirname( __FILE__ ) );

        }
		
		 /* Load includes */
        function apr_core_includes() {
            require_once(APR_CORE_SERVER_PATH . '/includes/general-functions.php');
            require_once(APR_CORE_SERVER_PATH . '/includes/metabox/metabox.php');
            require_once(APR_CORE_SERVER_PATH . '/includes/metabox/class-taxonomy-metabox.php');
            require_once(APR_CORE_SERVER_PATH . '/includes/metabox/class-taxonomy-portfolio.php');
            require_once(APR_CORE_SERVER_PATH . '/includes/metabox/class-taxonomy-product.php');
            require_once(APR_CORE_SERVER_PATH . '/includes/widgets/class-widget.php');
            require_once(APR_CORE_SERVER_PATH . '/includes/widgets/class-widgets.php');
            require_once(APR_CORE_SERVER_PATH . '/includes/posttypes/class-custom-meta-field.php');
            $postApr_Core_Taxonomy_Metabox = new Apr_Core_Taxonomy_Metabox('category');
            $portfolioApr_Core_Taxonomy_Metabox = new Apr_Core_Taxonomy_Portfolio_Metabox('portfolio_cat');
            $productApr_Core_Taxonomy_Metabox = new Apr_Core_Taxonomy_Product_Metabox('product_cat');
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
		
        function apr_core_loaded() {

            /* Load languages */
            $this->apr_core_i18n();
			
			/* Load includes */
            $this->apr_core_includes();

            /* Load check Elementor installed and activated */
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'apr_core_admin_notice' ] );
                return;
            }

        }

        /* Load languages */
        function apr_core_i18n() {
            load_plugin_textdomain( 'apr-core', false, APR_CORE_PATH . 'languages' );
        }

        /* admin notice */
        function apr_core_admin_notice() {
            if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
            $apr_core_message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
                esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'apr-core' ),
                '<strong>' . esc_html__( 'Arrowpress for Elementor', 'apr-core' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'apr-core' ) . '</strong>'
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $apr_core_message );
        }
		
        /* Load script */
        function apr_core_script() {
            add_action( 'wp_enqueue_scripts', [ $this, 'apr_core_frontend_scripts' ], 999 );
            add_action( 'wp_enqueue_scripts', [ $this, 'apr_core_frontend_style' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'load_admin_styles' ] );
        }

        /* Frontend scripts */
        function apr_core_frontend_style(){
            if (is_rtl()) {
                wp_enqueue_style('apr-core-rtl', APR_CORE_PATH . '/assets/css/apr-core-rtl.min.css?ver=' . APR_VERSION);
            }else{
                wp_enqueue_style( 'apr-core', APR_CORE_PATH . 'assets/css/apr-core.min.css', array(), APR_VERSION );
            }
        }
        function apr_core_frontend_scripts() {
			wp_enqueue_script( 'apr-script', APR_CORE_PATH . 'assets/js/elementor-scripts.min.js', array(), APR_VERSION );
        }
        function load_admin_styles(){
            wp_enqueue_script( 'apr-metabox-script', APR_CORE_PATH . 'assets/js/metabox.min.js', array(), APR_VERSION );
            wp_enqueue_style( 'apr-metabox-css', APR_CORE_PATH . 'assets/css/metabox.min.css', array(), APR_VERSION );
        }

    }

    new Apr_Core();

endif;
/**
 * Adding custom icon to icon control in Elementor
 */
function icon_font_custom( $controls_registry ) {
	// Get existing icons
	$icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
	// Append new icons
	$new_icons = array_merge(
		array(
            'theme-icon-research' => 'Research',
            'theme-icon-settings' => 'Setting',
            'theme-icon-layout' => 'Layout',
            'theme-icon-creative-idea' => 'Creative',
            'theme-icon-arrow' => 'Arrow',
            'theme-icon-customer-service' => 'Customer Service 1',
            'theme-icon-worldwide' => 'Worldwide',
            'theme-icon-cloud-computing' => 'Cloud Computing',
            'theme-icon-favorites' => 'favarites',
            'theme-icon-icon' => 'Icon',
            'theme-icon-home' => 'Home',
            'theme-icon-calendar' => 'Calendar',
            'theme-icon-money1' => 'Money',
            'theme-icon-organize' => 'Organize',
            'theme-icon-support1' => 'Support',
            'theme-icon-login' => 'Login',
            'theme-icon-scale' => 'Scale',
            'theme-icon-fingerprint' => 'Fingerprint',
            'theme-icon-art' => 'Art',
            'theme-icon-cord' => 'Cord',
            'theme-icon-support2' => 'Support2',
            'theme-icon-loading' => 'Loading',
            'theme-icon-analysis' => 'Analysis',
            'theme-icon-email' => 'Email',
            'theme-icon-network' => 'Network',
            'theme-icon-social-media' => 'Social Media',
            'theme-icon-psd' => 'PSD',
            'theme-icon-customer-service1' => 'Customer Service 2',
            'theme-icon-server' => 'Server',
            'theme-icon-ai1' => 'AI',
            'theme-icon-customer-service2' => 'Customer Service 3',
            'theme-icon-devices' => 'Responsive Devices',
            'theme-icon-paint' => 'Paint2',
            'theme-icon-folder' => 'Folder2',
            'theme-icon-refresh' => 'Refresh2',
            'theme-icon-bluetooth' => 'Bluetooth',
            'theme-icon-radio' => 'Radio',
            'theme-icon-target' => 'theme Target',
            'theme-icon-scroll' => 'theme Scroll',
            'theme-icon-team' => 'theme our team',
            'theme-icon-app-store-apple-symbol'=>'theme app store',
            'theme-icon-location' => 'Location',
            'theme-icon-email1' => 'Email 2',
            'theme-icon-bag' => 'Bag',
            'theme-icon-share' => 'Share 2',
            'theme-icon-security' => 'Security',
            'theme-icon-art1' => 'Art 2',
            'theme-icon-web-programming' => 'Web programming',
            'theme-icon-quotation1' => 'Quotation',
            'theme-icon-right-quote' => 'Right-Quote',
            'theme-icon-home-automation' => 'Home-automation',
            'theme-icon-hula-hoop' => 'Hula-hoop',
            'theme-icon-skipping-rope' => 'Skipping-rope',
            'theme-icon-shield' => 'Shield',
            'theme-icon-winner' => 'Winner',
            'theme-icon-trophy' => 'Trophy',
            'theme-icon-cup' => 'Cup',
            'theme-icon-medal' => 'Medal',
            'theme-icon-sync' => 'Sync',
            'theme-icon-cloud-computing1' => 'Cloud Computing 2',
            'theme-icon-controls' => 'Controls',
            'theme-icon-analysis1' => 'Analysis 2',
            'theme-icon-lightroom' => 'Lightroom',
            'theme-icon-after-effects' => 'After-effects',
            'theme-icon-dreamweaver' => 'Dreamweaver',
            'theme-icon-indesign' => 'Indesign',
            'theme-icon-tools' => 'Tools',
            'theme-icon-bar-chart' => 'Bar Chart',
            'theme-icon-database' => 'Database',
            'theme-icon-warning-sign' => 'Warning Sign',
            'theme-icon-web' => 'Web',
            'theme-icon-time-management' => 'Time Management',
            'theme-icon-call' => 'Call',
            'theme-icon-user' => 'User',
            'theme-icon-computer' => 'Computer',
            'theme-icon-adobe' => 'Adobe',
            'theme-icon-illustrator' => 'Illustrator',
            'theme-icon-photoshop' => 'Photoshop',
 		),
		$icons
	);
	// Then we set a new list of icons as the options of the icon control
	$controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
}
add_action( 'elementor/controls/controls_registered', 'icon_font_custom', 10, 1 );


