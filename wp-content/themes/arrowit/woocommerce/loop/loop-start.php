<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $woocommerce_loop;
$arrowit_product_layout = arrowit_get_meta_value('product_layout');
$arrowit_product_columns = arrowit_get_meta_value('product_columns');
$arrowit_product_layout_class = $product_layout_list = '';
$woocommerce_loop['product_column_number'] = '';
if($arrowit_product_layout){
	$arrowit_product_layout = arrowit_get_meta_value('product_layout');
}else{
	$arrowit_product_layout = Arrowit::setting('product_layouts');
}
if(isset($woocommerce_loop['product_column_number']) && (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] === '1') || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] === '5')){
	$arrowit_product_column = wc_get_loop_prop( 'columns' );
}elseif($arrowit_product_columns){
	$arrowit_product_column = $arrowit_product_columns;
}elseif($arrowit_product_layout === 'list' || $arrowit_product_layout ==='list_grid' && $arrowit_product_columns ===''){
	$arrowit_product_column = Arrowit::setting('product_column_list');
}else{
	$arrowit_product_column = Arrowit::setting('product_column');
}
if(isset($woocommerce_loop['product_type']) && ($woocommerce_loop['product_type'] === '2' || $woocommerce_loop['product_type'] === '4')){
	$arrowit_product_layout_class = 'product-list';
}else if(isset($woocommerce_loop['product_type']) && ($woocommerce_loop['product_type'] === '1' || $woocommerce_loop['product_type'] === '3')){
	$arrowit_product_layout_class = 'product-grid';
}else if($arrowit_product_layout === 'list' || $arrowit_product_layout ==='list_grid'){
	$arrowit_product_layout_class = 'product-list';
}else{
	$arrowit_product_layout_class = 'product-grid';
}
?>

<ul class="products <?php echo esc_attr($arrowit_product_layout_class); ?> columns-<?php echo esc_attr($arrowit_product_column); ?>">
