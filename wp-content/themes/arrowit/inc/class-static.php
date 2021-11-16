<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Arrowit {
    const PRIMARY_FONT = 'Poppins';
    const SECONDARY_FONT = 'Poppins';
    const PRIMARY_COLOR = '#58468c';
    const HIGHTLIGHT_COLOR = '#fb6692';
    const SECONDARY_COLOR = '#fb6692';
    const THIRD_COLOR = '#ababab';
    const HEADING_COLOR = '#58468c';
//    const HEADING_COLOR = '#474747';


    /**
     * Get setting from Kirki
     *
     * @param string $setting
     *
     * @return mixed
     */
    public static function setting( $setting = '' ) {
        $settings = Arrowit_Kirki::get_option( 'theme', $setting );
        return $settings;
    }
    /**
     * Requirement one file.
     *
     * @param string $file Enter your file path here (included .php)
     */
    public static function require_file( $file = '' ) {
        if ( file_exists( $file ) ) {
            require_once $file;
        } else {
            wp_die( esc_html__( 'Could not load theme file: ', 'arrowit' ) . $file );
        }
    }
    /**
     * Primary Menu
     */
    public static function menu_primary( $args = array() ) {
        $menu = get_post_meta(get_the_ID(), 'menu_display', true);
        if($menu === ''){
            if ( has_nav_menu( 'primary' ) && class_exists( 'Arrowit_Primary_Walker_Nav_Menu' ) ) {
                $defaults = array(
                    'theme_location' => 'primary',
                    'container'      => 'ul',
                    'menu_class'     => 'mega-menu',
                );
                $args['walker'] = new Arrowit_Primary_Walker_Nav_Menu;

            }else{
                $defaults = array(
                    'container'      => 'ul',
                    'menu_class'     => 'mega-menu',
                );
            }
            $args     = wp_parse_args( $args, $defaults );
        }else{
            $defaults = array(
                'menu' => $menu,
                'container'      => 'ul',
                'menu_class'     => 'mega-menu',
            );
            $args['walker'] = new Arrowit_Primary_Walker_Nav_Menu;
            $args     = wp_parse_args( $args, $defaults );
        }
        wp_nav_menu( $args );
    }
    public static function menu_builder($menu_builder){
        $menu = get_post_meta(get_the_ID(), 'menu_display', true);
        $args = array();
        if (empty($menu)){
            $defaults = array(
                'menu' => $menu_builder,
                'container'      => 'ul',
                'menu_class' => 'apr-nav-menu',
            );
        }else{
            $defaults = array(
                'menu' => $menu,
                'container'      => 'ul',
                'menu_class' => 'apr-nav-menu',
            );
        }
        $args['walker'] = new Arrowit_Primary_Walker_Nav_Menu;
        $args     = wp_parse_args( $args, $defaults );
        wp_nav_menu( $args );
    }

    /**
     * Adds custom attributes to the body tag.
     */
    public static function body_attributes() {
        $attrs = apply_filters( 'insight_body_attributes', array() );

        $attrs_string = '';
        if ( ! empty( $attrs ) ) {
            foreach ( $attrs as $attr => $value ) {
                $attrs_string .= " {$attr}=" . '"' . esc_attr( $value ) . '"';
            }
        }
        echo '' . $attrs_string;
    }
    /**
     * Adds custom classes to the branding.
     */
    public static function branding_class( $class = '' ) {
        $classes = array( 'branding' );

        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }

        $classes = apply_filters( 'insight_branding_class', $classes, $class );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }
    /**
     * Adds custom classes to the navigation.
     */
    public static function navigation_class( $class = '' ) {
        $classes = array( 'navigation page-navigation' );

        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }
        $classes = apply_filters( 'insight_navigation_class', $classes, $class );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }
    public static function header_sticky_builder_class($class =''){
        $classes = array( 'header-sticky header-builder' );
        $enable_header_builder = Arrowit::setting('enable_header_builder');
        $header_customize_id = Arrowit::setting('choose_header_builder');
        $header_type = arrowit_get_meta_value('header_type');
        if ($enable_header_builder == true || $header_type !=='default'){
            $classes[] = "header-builder";
            if ($header_type!== '' && $header_type !=='default'){
                $classes[] = $header_type;
            }else{
                $classes[] = $header_customize_id;
            }
        }
        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            $class = array();
        }
        $classes = apply_filters( 'arrowit_header_sticky_class', $classes, $class );
        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }

    public static function get_header_sticky_type(){
        $enable_header_builder = Arrowit::setting('enable_header_builder');
        $header_type = arrowit_get_meta_value('header_type');
        $header_customize_id = Arrowit::setting('choose_header_builder');
        if (class_exists( 'Apr_Core' )):
            if (is_category()){
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-sticky');
                }else{
                    get_template_part('templates/header/header-sticky');
                }
            }elseif (is_tax('product_cat')){
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-sticky');
                }else{
                    get_template_part('templates/header/header-sticky');
                }
            }elseif (is_archive()){
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-sticky');
                }else{
                    get_template_part('templates/header/header-sticky');
                }
            }
            else{
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-sticky');
                }else{
                    get_template_part('templates/header/header-sticky');
                }
            }
        else:
            get_template_part('templates/header/header-sticky');
        endif;
    }
    public static function get_header_type(){
        $enable_header_builder = Arrowit::setting('enable_header_builder');
        $header_type = arrowit_get_meta_value('header_type');
        $header_customize_id = Arrowit::setting('choose_header_builder');
        if (class_exists( 'Apr_Core' )):
            if (is_category()){
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-builder');
                }else{
                    get_template_part('headers/header-default');
                }
            }elseif (is_tax('product_cat')){
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-builder');
                }else{
                    get_template_part('headers/header-default');
                }
            }elseif (is_archive()){
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-builder');
                }else{
                    get_template_part('headers/header-default');
                }
            }
            else{
                if (($enable_header_builder == true && !empty($header_customize_id)) || (!empty($header_type) && $header_type !=='default')){
                    get_template_part('headers/header-builder');
                }else{
                    get_template_part('headers/header-default');
                }
            }
        else:
            get_template_part('headers/header-default');
        endif;
    }
    public static function header_class( $class = '' ) {
        $classes = array( 'site-header page-header' );
        if (class_exists( 'Apr_Core' )){
            $enable_header_builder = Arrowit::setting('enable_header_builder');
            $header_type = arrowit_get_meta_value('header_type');
            $header_customize_id = Arrowit::setting('choose_header_builder');
            if ($enable_header_builder == true || $header_type !=='default'){
                $classes[] = "header-builder";
                if ($header_type!== '' && $header_type !=='default'){
                    $classes[] = $header_type;
                }else{
                    $classes[] = $header_customize_id;
                }
            }else{
                $classes[] = "header-default";
            }
        }else{
            $classes[] = "header-default";
        }
        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }
        $classes = apply_filters( 'arrowit_header_class', $classes, $class );
        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }
    /**
     * Adds custom classes to the footer.
     */
    public static function footer_class( $class = '' ) {
        $classes = array( 'page-footer' );
        $footer_type = Arrowit_Global::instance()->set_footer_type();
        $classes[] = "footer-{$footer_type}";
        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }
        $classes = apply_filters( 'arrowit_footer_class', $classes, $class );
        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }
}