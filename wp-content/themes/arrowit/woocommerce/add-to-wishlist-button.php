<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.8
 */
if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly
global $product;
?>
<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) )?>" rel="nofollow" data-product-id="<?php echo esc_attr($product_id) ?>" data-product-type="<?php echo esc_attr($product_type)?>" class="button <?php echo esc_attr($link_classes) ?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo esc_attr__('Wishlist','arrowit');?>">
    <i class="fa fa-heart"></i> <span><?php echo esc_html__('Add to wish list','arrowit');?></span>
</a>
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ajax-loader.gif' ) ?>" class="ajax-loading" alt="<?php esc_attr_e('Loading','arrowit'); ?>" width="16" height="16" style="visibility:hidden" />