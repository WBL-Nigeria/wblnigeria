<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}


class Apr_Core_MailChimp extends Widget_Base {
    public function get_name() {
        return 'apr_mailchimp';
    }

    public function get_title() {
        return __('APR MailChimp', 'apr-core' );
    }


    public function get_icon() {
        return 'eicon-mailchimp apr-badge';
    }

    public function get_categories() {
        return array('apr-core');
    }
    public function get_forms() {
        $options = array( 0 => __('Select the form to show', 'apr-core' ) ) ;

        if( ! function_exists('mc4wp_get_forms') ){
            return $options;
        }

        $forms   = mc4wp_get_forms();
        foreach( $forms as $form ) {
            $options[ $form->ID ] = $form->name;
        }

        return $options;
    }
    protected function _register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*  Content TAB
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'forms_section',
            array(
                'label'      => __('Form', 'apr-core' ),
            )
        );

        $this->add_control(
            'form_type',
            array(
                'label'       => __( 'Form Type', 'apr-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'default',
                'options'     => array(
                    'default' => __( 'Defaults'  , 'apr-core' ),
                    'custom'  => __( 'Custom'  , 'apr-core' )
                )
            )
        );

        $this->add_control(
            'form_id',
            array(
                'label'       => __( 'MailChimp Sign-Up Form', 'apr-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'default'     => 0,
                'options'     => $this->get_forms(),
                'condition'   => array(
                    'form_type' => array('default')
                )
            )
        );

        $this->add_control(
            'html',
            array(
                'label'       => __( 'Custom Form', 'apr-core' ),
                'type'        => Controls_Manager::CODE,
                'language'    => 'html',
                'description' => __( 'Enter your custom form markup', 'apr-core' ),
                'condition'   => array(
                    'form_type' => array('custom')
                )
            )
        );

        $this->end_controls_section();
    }

    public function custom_form( $content ) {
        $settings   = $this->get_settings_for_display();

        if( ! empty( $settings['html'] ) ) {
            $content = $settings['html'];
        }

        return $content;
    }

    protected function render() {
        // Check whether required resources are available
        if( ! function_exists('mc4wp_show_form') ) {
            $this->apr_elementor_plugin_missing_notice( array( 'plugin_name' => __( 'MailChimp', 'apr-core' ) ) );
            return;
        }

        $settings = $this->get_settings_for_display();

        if(  $settings['form_type'] === 'custom' ) {
            add_filter( 'mc4wp_form_content', array( $this, 'custom_form'), 10, 1 );
            $settings['form_id'] = 0;
        }

        return mc4wp_show_form( $settings['form_id'] );
    }
    public function apr_elementor_plugin_missing_notice( $args ){
        // default params
        $defaults = array(
            'plugin_name' => '',
            'echo'        => true
        );
        $args = wp_parse_args( $args, $defaults );

        ob_start();
        ?>
        <div class="elementor-alert elementor-alert-danger" role="alert">
        <span class="elementor-alert-title">
            <?php echo sprintf( esc_html__( '"%s" Plugin is Not Activated!', 'apr-core' ), $args['plugin_name'] ); ?>
        </span>
            <span class="elementor-alert-description">
            <?php esc_html_e( 'In order to use this element, you need to install and activate this plugin.', 'apr-core' ); ?>
        </span>
        </div>
        <?php
        $notice =  ob_get_clean();

        if( $args['echo'] ){
            echo $notice;
        } else {
            return $notice;
        }
    }
}
Plugin::instance()->widgets_manager->register_widget_type(new Apr_Core_MailChimp);
