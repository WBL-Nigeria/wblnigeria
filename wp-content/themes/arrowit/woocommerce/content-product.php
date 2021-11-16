<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
defined( 'ABSPATH' ) || exit;
global $product, $woocommerce_loop;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$entries_count = 0;
$animation = Arrowit::setting( 'product_css_animation' );
$animation_class = Arrowit_Helper::get_animation_classes( $animation );
$post_term_arr = get_the_terms( get_the_ID(), 'product_cat' );
$post_term_filters = '';
$post_term_names = '';
if( is_array( $post_term_arr ) && count( $post_term_arr ) > 0 ) {
    foreach ( $post_term_arr as $post_term ) {

        $post_term_filters .= $post_term->slug . ' ';
        $post_term_names .= $post_term->name . ', ';
    }
}
if(isset($woocommerce_loop['product_type']) && ($woocommerce_loop['product_type'] == '5')){
	$index_size1 = array('2','10','21');
	$classes[] = "";
	if(in_array($woocommerce_loop['i'], $index_size1)){
		$classes[] = 'item image_size1';
	}else{
		$classes[] = 'item image_size';
	} 
}
$post_term_filters = trim( $post_term_filters );
$post_term_names = substr( $post_term_names, 0, -2 );
$classes[] = $post_term_filters;
$classes[] = $animation_class;
?>
<li <?php post_class($classes); ?>>
	<div class="product-content clearfix">
		<div class="product-top">
			<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_product_image' );
			?>
			<div class="product-action">
				<?php
					/**
					 * Hook: woocommerce_product_action.
					 *
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_product_add_to_cart' );
				?>
			</div>
		</div>
		<div class="product-desc">
			<h3 class="product-title"><a href="<?php the_permalink(); ?>" class="product-name"><?php arrowit_limit_title('35'); ?></a></h3>
			<div class="product-price">
				<?php
					/**
					 * Hook: woocommerce_after_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
					
				?>

			</div>
			<div class="product-action">
				<?php
						/**
						 * Hook: woocommerce_product_action.
						 *
						 * @hooked woocommerce_template_loop_add_to_cart - 10
						 */
						do_action( 'woocommerce_product_add_to_cart' );
					?>
                <div class="group-action clearfix">
                    <?php
                    /**
                     * Hook: woocommerce_product_action.
                     *
                     * @hooked arrowit_quickview - 10
                     * @hooked arrowit_wishlist_custom - 20
                     * @hooked arrowit_compare_product - 30
                     */
                    do_action( 'woocommerce_product_action' );
                    ?>
                </div>
			</div>
		</div>
	</div>
</li>
<?php 
    $entries_count++;
	if(isset($woocommerce_loop['product_type']) && ($woocommerce_loop['product_type'] == '5')){
		$woocommerce_loop['i']++;
	}
?>