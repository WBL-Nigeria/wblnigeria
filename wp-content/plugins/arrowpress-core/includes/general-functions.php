<?php

namespace Elementor;

class Apr_Core_Widgets {

    /**
     * Plugin constructor.
     */
    public function __construct() {
		$this->apr_core_add_actions();
        $this->apr_core_register_posttypes();
    }

    private function apr_core_add_actions() {

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'apr_core_widgets_registered' ] );
        add_action( 'elementor/init', [ $this, 'apr_core_widgets_int' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'apr_elementor_styles' ] );

    }
    
    private $shortcodes = array("blog", "icon-box", "advanced-tabs", "heading-modern", "banner", "pricing-table", "testimolials", "slides", "mailchimp", "locator", 
								"countdown","contact-form","elementor-template","image-carousel","slider-revolution", "header-group", "site-logo", "nav-menu", "timeline", "counter", "portfolio", "product", "woo-categories");
	
	private $widgets = array("contact","facebook-page", "logo", "posts", "social", "twitter", "elementor-template");
	
	private $posttype = array("header", "static-block", "portfolio");
    /**
     * register all post type here
     * @return void
     */

    public static function get_animation_options() {
        return [
            ''              => __( 'None', 'apr-core' ),
            'fadeInDown'    => __( 'FadeInDown', 'apr-core' ),
            'fadeInUp'      => __( 'FadeInUp', 'apr-core' ),
            'fadeInRight'   => __( 'FadeInRight', 'apr-core' ),
            'fadeInLeft'    => __( 'FadeInLeft', 'apr-core' ),
            'fadeInDownBig'    => __( 'FadeInDownBig', 'apr-core' ),
            'fadeInLeftBig'    => __( 'FadeInLeftBig', 'apr-core' ),
            'fadeInRightBig'   => __( 'FadeInRightBig', 'apr-core' ),
            'fadeInUpBig'      => __( 'FadeInUpBig', 'apr-core' ),
            'lightSpeedIn'     => __( 'LightSpeedIn', 'apr-core' ),
            'lightSpeedOut'    => __( 'LightSpeedOut', 'apr-core' ),
            'zoomIn'           => __( 'Zoom', 'apr-core' ),
            'zoomInDown'       => __( 'ZoomInDown', 'apr-core' ),
            'zoomInLeft'       => __( 'ZoomInLeft', 'apr-core' ),
            'zoomInRight'      => __( 'ZoomInRight', 'apr-core' ),
            'zoomInUp'         => __( 'ZoomInUp', 'apr-core' ),
            'pulse'         => __( 'Pulse', 'apr-core'),
            'bounceIn'      => __( 'BounceIn', 'apr-core'),
            'bounceInDown'  => __( 'BounceInDown', 'apr-core'),
            'bounceInLeft'  => __( 'BounceInLeft', 'apr-core'),
            'bounceInRight' => __( 'BounceInRight', 'apr-core'),
            'bounceInUp'    => __( 'BounceInUp', 'apr-core'),
            'rotateIn'      => __( 'RotateIn', 'apr-core'),
            'rotateInDownLeft'      => __( 'RotateInDownLeft', 'apr-core'),
            'rotateInDownRight'     => __( 'RotateInDownRight', 'apr-core'),
            'rotateInUpLeft'        => __( 'RotateInUpLeft', 'apr-core'),
            'rotateInUpRight'       => __( 'RotateInUpRight', 'apr-core'),
            'slideInUp'             => __( 'SlideInUp', 'apr-core'),
            'slideInDown'           => __( 'SlideInDown', 'apr-core'),
            'slideInLeft'           => __( 'SlideInLeft', 'apr-core'),
            'slideInRight'          => __( 'SlideInRight', 'apr-core'),
            'jackInTheBox'          => __( 'JackInTheBox', 'apr-core'),
        ];
    }

    protected function apr_core_register_posttypes() {
		$theme_name = wp_get_theme();
		if($theme_name == 'Arrowit' || $theme_name == 'Arrowit Child Theme'){
            foreach ($this->posttype as $posttypes) {
                require_once(APR_CORE_SERVER_PATH . '/includes/posttypes/' . $posttypes . '.php');
            }
		}  
    }
    protected function apr_core_add_widget() {
		foreach ($this->widgets as $widgets) {
            require_once(APR_CORE_SERVER_PATH . '/includes/widgets/' . $widgets . '.php');
        }
    }
    public function apr_core_widgets_registered() {
		$this->apr_core_includes();
    }

    public function apr_core_widgets_int() {
        $this->apr_core_register_widget();
    }
    private function apr_core_includes() {
		foreach ($this->shortcodes as $shortcode) {
            require_once(APR_CORE_SERVER_PATH . '/includes/elementor/widgets/' . $shortcode . '.php');
        }
    }
    
    private function apr_core_register_widget() {

        Plugin::instance()->elements_manager->add_category(
            'apr-core',
            [
                'title' => esc_html__( 'Apr Elementor PRO', 'apr-core' ),
                'icon'  => 'icon-goes-here'
            ]
        );

    }
	public function apr_elementor_styles() {
		wp_register_style('apr-icon', APR_CORE_PATH . 'assets/css/apr-font.css', array(), APR_VERSION );
		wp_enqueue_style('apr-icon');
	}
}

new Apr_Core_Widgets();

/* Start get Category check box */
function apr_core_check_get_cat( $type_taxonomy ) {
    $category     =   get_categories( array( 'taxonomy'   =>  $type_taxonomy ) );
    $cat_check = array();
    if ( !is_wp_error($category)):
        foreach( $category as $item ) {
            $cat_check[$item->slug]  =   $item->name.'('. $item->count .')';
        }
    endif;
    return $cat_check;
}
function apr_core_get_post_id($post_type){
    $block_options = array();
    $args = array(
        'numberposts' => -1,
        'post_type' => $post_type,
        'post_status' => 'publish',
    );
    $posts = get_posts($args);
    foreach( $posts as $_post ){
        $block_options[$_post->ID] = $_post->post_title;
    }
    return $block_options;
}
if (!is_admin()) {
        add_action( 'wp_enqueue_scripts', function() {
        wp_deregister_script( 'jquery-slick' );
        wp_deregister_style( 'jquery-slick' );
    }, 11 );
}

if( ! function_exists('auxin_is_true') ){

    function auxin_is_true( $var ) {
        if ( is_bool( $var ) ) {
            return $var;
        }

        if ( is_string( $var ) ){
            $var = strtolower( $var );
            if( in_array( $var, array( 'yes', 'on', 'true', 'checked' ) ) ){
                return true;
            }
        }

        if ( is_numeric( $var ) ) {
            return (bool) $var;
        }

        return false;
    }

}
if ( ! function_exists( 'rwmb_meta' ) ) {
    function rwmb_meta( $key, $args = '', $post_id = null ) {
        return false;
    }
}
/* End get Category check box */

// Get all elementor page templates
if ( !function_exists('apr_core_get_page_templates') ) {
    function apr_core_get_page_templates(){
        $page_templates = get_posts( array(
            'post_type'         => 'elementor_library',
            'posts_per_page'    => -1
        ));

        $options = array();

        if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
            foreach ( $page_templates as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        }
        return $options;
    }
}

