<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper functions
 */
class Arrowit_Helper {
	public static function get_post_meta( $name, $default = false ) {
		global $arrowit_page_options;
		if ( $arrowit_page_options != false && isset( $arrowit_page_options[ $name ] ) ) {
			return $arrowit_page_options[ $name ];
		}
		return $default;
	}
	public static function get_the_post_meta( $options, $name, $default = false ) {
		if ( $options != false && isset( $options[ $name ] ) ) {
			return $options[ $name ];
		}
		return $default;
	}
	/**
	 * @param bool $default_option
	 *
	 * @return array
	 */
	public static function get_registered_sidebars( $default_option = false, $empty_option = true ) {
		global $wp_registered_sidebars;
		$sidebars = array();
		if ( $default_option == true ) {
			$sidebars['default'] = esc_html__( 'Default Sidebar', 'arrowit' );
		}
		if ( $empty_option == true ) {
			$sidebars['none'] = esc_html__( 'No Sidebar', 'arrowit' );
		}
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}
		return $sidebars;
	}
	/**
	 * Get content of file
	 *
	 * @param string $path
	 *
	 * @return mixed
	 */
	static function get_file_contents( $path = '' ) {
		$content = '';
		if ( $path !== '' ) {
			global $wp_filesystem;
			Arrowit::require_file( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
			if ( file_exists( $path ) ) {
				$content = $wp_filesystem->get_contents( $path );
			}
		}
		return $content;
	}
	/**
	 * Get size information for all currently-registered image sizes.
	 *
	 * @global $_wp_additional_image_sizes
	 * @uses   get_intermediate_image_sizes()
	 * @return array $sizes Data for all currently-registered image sizes.
	 */
	public static function get_image_sizes() {
		global $_wp_additional_image_sizes;
		$sizes = array( 'full' => 'full' );
		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$_size_w                               = get_option( "{$_size}_size_w" );
				$_size_h                               = get_option( "{$_size}_size_h" );
				$sizes["$_size {$_size_w}x{$_size_h}"] = $_size;
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes["$_size {$_wp_additional_image_sizes[ $_size ]['width']}x{$_wp_additional_image_sizes[ $_size ]['height']}"] = $_size;
			}
		}

		return $sizes;
	}
	public static function aq_resize( $args = array() ) {
		$defaults = array(
			'url'     => '',
			'width'   => null,
			'height'  => null,
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
			'echo'    => false,
		);
		$args  = wp_parse_args( $args, $defaults );
		$image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
		if ( $image === false ) {
			$image = $args['url'];
		}
		return $image;
	}
    /**
     * Get all menu
     */
    public static function get_all_menus() {
        $args = array(
            'hide_empty' => true,
        );
        $menus   = get_terms( 'nav_menu', $args );
        $results = array();
        foreach ( $menus as $key => $menu ) {
            $results[ $menu->slug ] = $menu->name;
        }
        $results[''] = esc_html__( 'Default Menu', 'arrowit' );
        return $results;
    }

	public static function get_animation_list( $args = array() ) {
		return array(
			'none'             	=> esc_html__( 'None', 'arrowit' ),
			'fadeIn'          	=> esc_html__( 'Fade In', 'arrowit' ),
			'fadeInUp'          => esc_html__( 'Fade In Up', 'arrowit' ),
			'fadeInDown'        => esc_html__( 'Fade In Down', 'arrowit' ),
			'fadeInLeft'        => esc_html__( 'Fade In Left', 'arrowit' ),
			'fadeInRight'       => esc_html__( 'Fade In Right', 'arrowit' ),
			'pulse'         	=> esc_html__( 'Pulse', 'arrowit' ),
			'lightSpeedIn' 		=> esc_html__( 'LightSpeedIn', 'arrowit' ),
			'zoomIn'            => esc_html__( 'Zoom In', 'arrowit' ),
			'zoomInDown'        => esc_html__( 'Zoom In Down ', 'arrowit' ),
			'zoomInLeft'        => esc_html__( 'Zoom In Left', 'arrowit' ),
			'zoomInRight'       => esc_html__( 'Zoom In Right', 'arrowit' ),
		);
	}
	public static function get_animation_classes( $animation ) {
		$classes = '';
		$animation_enable = Arrowit::setting( 'setting_animation' );
		if ( isset( $animation ) && $animation !== '' && $animation !== 'none' ) {
			if ($animation_enable === '1'){
				$classes .= "wow $animation";
			} else {
				$classes .= "";
			}
		}

		return $classes;
	}
	
	public static function get_footer_list( $default_option = false ) {

		$footers = array(
			'none' => esc_html__( 'Hide', 'arrowit' ),
			'01'   => esc_html__( 'Footer 1', 'arrowit' ),
			'02'   => esc_html__( 'Footer 2', 'arrowit' ),
			'03'   => esc_html__( 'Footer 3', 'arrowit' ),
			'04'   => esc_html__( 'Footer 4', 'arrowit' ),
			'05'   => esc_html__( 'Footer 5', 'arrowit' ),
			'06'   => esc_html__( 'Footer 6', 'arrowit' ),
			'07'   => esc_html__( 'Footer 7', 'arrowit' ),
			'08'   => esc_html__( 'Footer 8', 'arrowit' ),
		);

		if ( $default_option === true ) {
			$footers = array( '' => esc_html__( 'Default', 'arrowit' ) ) + $footers;
		}

		return $footers;
	}
	

    public static function get_coming_soon_demo_date() {
        $date = date( 'm/d/Y', strtotime( '+2 months', strtotime( date( 'Y/m/d' ) ) ) );

        return $date;
    }

    public static function the_date( $date_string ) {
		$date_format = get_option( 'date_format' );
		echo date( $date_format, strtotime( $date_string ) );
	}
	public static function w3c_iframe( $iframe ) {
		$iframe = str_replace( 'frameborder="0"', '', $iframe );
		$iframe = str_replace( 'frameborder="no"', '', $iframe );
		$iframe = str_replace( 'scrolling="no"', '', $iframe );
		$iframe = str_replace( 'gesture="media"', '', $iframe );
		$iframe = str_replace( 'allow="encrypted-media"', '', $iframe );
		$iframe = str_replace( 'allowfullscreen', '', $iframe );

		return $iframe;
	}
}
