<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

$full_image_size = wp_get_attachment_url( get_post_thumbnail_id() );
$image_url       = Arrowit_Helper::aq_resize( array(
	'url'    => $full_image_size,
	'width'  => 70,
	'height' => 85,
	'crop'   => true,
) );
?>
<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
    <div class="product-content clearfix">
        <div class="product-top">
            <div class="product-image">
                <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo wp_kses_post( $product->get_name() ); ?>">
                </a>
            </div>
        </div>
        <div class="product-desc">
            <h6 class="product-title">
                <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                    <?php echo wp_kses_post( $product->get_name() ); ?>
                </a>
            </h6>
            <?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
            <div class="product-price">
                <span class="price">
                <?php echo wp_kses_post($product->get_price_html()); ?>
                </span>
            </div>
        </div>

    </div>
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
