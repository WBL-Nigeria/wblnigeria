<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$arrowit_upsell_product = '';
$arrowit_upsell = get_post_meta(get_the_ID(), 'upsell_product', true);
if($arrowit_upsell ){
	$arrowit_upsell_product = $arrowit_upsell;
}else{
	$arrowit_upsell_product = Arrowit::setting( 'single_product_up_sells_enable' );
}
$upsel_title = Arrowit::setting( 'upsel_title' );

if ( $upsells && $arrowit_upsell_product !== '1') : ?>
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 products-upsells">
		<div class="product-extra">
			<section class="up-sells upsells products">
				<div class="instagram_title">
					<?php if($upsel_title !== ''): ?>
						<?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): ?>
							<h2><?php echo esc_html__( 'May you like also', 'arrowit' ) ?></h2>
						<?php else:?>
							<h2><?php echo esc_html($upsel_title); ?></h2>
						<?php endif;?>
					<?php endif;?>
				</div>

				<?php woocommerce_product_loop_start(); ?>

					<?php foreach ( $upsells as $upsell ) : ?>

						<?php
							$post_object = get_post( $upsell->get_id() );

							setup_postdata( $GLOBALS['post'] =& $post_object );

							wc_get_template_part( 'content', 'product' ); ?>

					<?php endforeach; ?>

				<?php woocommerce_product_loop_end(); ?>

			</section>
		</div>
	</div>
<?php endif;

wp_reset_postdata();
