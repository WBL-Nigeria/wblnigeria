<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  Automattic
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}
$arrowit_product_meta_enable = Arrowit::setting('single_product_meta_enable');
$arrowit_product_meta_multi = Arrowit::setting('product_meta_multi');
?>
<?php if (isset($arrowit_product_meta_multi) && in_array('description', $arrowit_product_meta_multi) && $arrowit_product_meta_enable) : ?>
	<div class="woocommerce-product-details__short-description">
		<?php echo wp_kses_post( $short_description ); // WPCS: XSS ok. ?>
	</div>
<?php endif; ?>