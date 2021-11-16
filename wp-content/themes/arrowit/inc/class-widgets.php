<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Arrowit_Widgets' ) ) {
	class Arrowit_Widgets {
		public function __construct() {
			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );
		}
		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {
			$defaults = array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			);
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'blog_sidebar',
				'name'        => esc_html__( 'Blog Sidebar', 'arrowit' ),
				'description' => esc_html__( 'Default Sidebar of blog.', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'page_sidebar',
				'name'        => esc_html__( 'Page Sidebar', 'arrowit' ),
				'description' => esc_html__( 'Add widgets here.', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar',
				'name'        => esc_html__( 'Shop Sidebar', 'arrowit' ),
				'description' => esc_html__( 'Default Sidebar of shop.', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar_left',
				'name'        => esc_html__( 'Shop Sidebar Left', 'arrowit' ),
				'description' => esc_html__( 'Default Sidebar left of shop.', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar_right',
				'name'        => esc_html__( 'Shop Sidebar Right', 'arrowit' ),
				'description' => esc_html__( 'Default Sidebar Right of shop.', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer1-top',
				'name'        => esc_html__( 'Footer1 top', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer1',
				'name'        => esc_html__( 'Footer1', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer2-top',
				'name'        => esc_html__( 'Footer2 top', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer2',
				'name'        => esc_html__( 'Footer2', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer3-left',
				'name'        => esc_html__( 'Footer3 left', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer3-right',
				'name'        => esc_html__( 'Footer3 right', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer4-top',
				'name'        => esc_html__( 'Footer4 top', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer4-left',
				'name'        => esc_html__( 'Footer4 left', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer4-right',
				'name'        => esc_html__( 'Footer4 right', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer5',
				'name'        => esc_html__( 'Footer5', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer6',
				'name'        => esc_html__( 'Footer6', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer7-top',
				'name'        => esc_html__( 'Footer7 top', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer7',
				'name'        => esc_html__( 'Footer7', 'arrowit' ),
			) ) );
			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer8',
				'name'        => esc_html__( 'Footer8', 'arrowit' ),
			) ) );
            register_sidebar( array_merge( $defaults, array(
                'id'          => 'humburger_menu_sidebar',
                'name'        => esc_html__( 'Humburger Menu Sidebar', 'arrowit' ),
                'description' => esc_html__( 'Default Sidebar of Humburger Menu Sidebar.', 'arrowit' ),
            ) ) );
		}
	}
	new Arrowit_Widgets();
}