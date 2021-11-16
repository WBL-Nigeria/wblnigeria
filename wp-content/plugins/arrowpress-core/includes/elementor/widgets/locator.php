<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Apr_Core_Locator extends Widget_Base {

    public function get_categories() {
        return array( 'apr-core' );
    }

    public function get_name() {
        return 'apr-locator';
    }

    public function get_title() {
        return __( ' APR Locator', 'apr-core' );
    }

    public function get_icon() {
        return 'eicon-google-maps';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_locator',
            [
                'label'     => __( 'Maps Locator', 'apr-core' ),
            ]
        );
        $this->add_control(
            'store_select_id',
            [
                'label'         =>  __( 'Select store locator', 'apr-core' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  apr_core_get_post_id('wpsl_stores'),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );
        $this->add_control(
            'zoom',
            [
                'label' => __( 'Zoom', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'apr-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 40,
                        'max' => 1440,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpsl-gmap-canvas' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'scrollwheel',
            [
                'label' => __( 'Scroll Wheel', 'apr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'apr-core' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings();
        global $wpsl_settings, $wpsl;
        $store_id =   $settings['store_select_id'];
        $zoom     =   $settings['zoom']['size'];
        if(!empty( $store_id)){
            $id = implode(",", $store_id);
        }else{
            $id = '';
        }
        if($settings['scrollwheel'] == 'yes'){
            $scrollwheel = 'true';
        }else{
            $scrollwheel = 'false';
        }
		echo do_shortcode('[wpsl_map id="'. $id .'" zoom="'.$zoom.'" map_type="roadmap" map_type_control="true" street_view="false" scrollwheel="'.$scrollwheel.'" control_position="left"]');
	}
	protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Apr_Core_Locator );