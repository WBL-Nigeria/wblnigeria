<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class Apr_Core_Slider_Revolution extends Widget_Base {
    public function get_name() {
        return 'aux_mailchimp';
    }

    public function get_title() {
        return __('APR Revolution Slider', 'apr-core' );
    }


    public function get_icon() {
        return 'eicon-slideshow apr-badge';
    }

    public function get_categories() {
        return array('apr-core');
    }
    public function get_list_revslider() {
        global $wpdb;
        $revsliders = array(
            '' => esc_html__( 'Select a slider', 'atomlab' ),
        );

        if ( function_exists( 'rev_slider_shortcode' ) ) {

            $table_name = $wpdb->prefix . "revslider_sliders";
            $query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE type != %s ORDER BY title ASC", 'template' );
            $results    = $wpdb->get_results( $query );
            if ( ! empty( $results ) ) {
                foreach ( $results as $result ) {
                    $revsliders[ $result->alias ] = $result->title;
                }
            }
        }

        return $revsliders;
    }
    protected function _register_controls() {
        $this->start_controls_section(
            'revslider_section',
            array(
                'label'      => __('Slider', 'apr-core' ),
            )
        );

        $this->add_control(
            'revslider_id',
            array(
                'label'       => __( 'Choose Slider', 'apr-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'default'     => '',
                'options'     => $this->get_list_revslider(),
            )
        );

        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $slider = $settings['revslider_id'];
        if ($slider !=''){
        echo do_shortcode(shortcode_unautop( '[rev_slider alias=' . $slider . ']' ));
        }else{
            echo '<p>'.esc_html__("You have not selected a slider", "apr-core") . '</p>';
        }
    }

}
Plugin::instance()->widgets_manager->register_widget_type(new Apr_Core_Slider_Revolution);
