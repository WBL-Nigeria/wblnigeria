<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.add-cart-btn
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
$cols = Arrowit_Global::get_page_sidebar();
$arrowit_left_sidebar = Arrowit_Global::get_left_sidebar();
$arrowit_right_sidebar = Arrowit_Global::get_right_sidebar();
$arrowit_toolbar = Arrowit::setting('shop_archive_toolbar');
$arrowit_left_toolbar = Arrowit::setting('shop_archive_left_toolbar');
$arrowit_right_toolbar = Arrowit::setting('shop_archive_right_toolbar');
$arrowit_class_toolbar = $product_layout_list ='';
if($arrowit_left_toolbar && $arrowit_right_toolbar){
	$arrowit_class_left_toolbar = 'col-xl-0 col-md-12 col-sm-12 col-lg-12 toolbar-left';
	$arrowit_class_right_toolbar = 'col-xl-0 col-md-12 col-sm-12 col-lg-12 text-right toolbar-right';
}else{
	$arrowit_class_left_toolbar = 'col-xl-0 col-md-12 col-sm-12 col-lg-12';
	$arrowit_class_right_toolbar = 'col-xl-0 col-md-12 col-sm-12 col-lg-12';
}

$arrowit_product_layout = arrowit_get_meta_value('product_layout');
if ($arrowit_product_layout === 'list') {
	$product_layout_list = 'list';
}
?>
<div class="row no-margin">
	<?php
        get_sidebar('left');
	?>
	<div class="<?php echo esc_attr($cols);?> <?php echo esc_attr($product_layout_list);?>">
		<?php
		if ( woocommerce_product_loop() ) {
			do_action( 'woocommerce_before_shop_loop' );
			
			global $wp_query;
			$cat = $wp_query->get_queried_object();
			if (is_tax('product_cat')){
                $display_type_product = get_term_meta( $cat->term_id, 'display_type', true );
                if($display_type_product !== ''){
                    $display_type = $display_type_product;
                }else{
                    $display_type = woocommerce_get_loop_display_mode();
                }
            }else{
                $display_type = woocommerce_get_loop_display_mode();
            }
			
			if ( 'subcategories' === $display_type || 'both' === $display_type ){
				?>
				<ul class="cate-archive clearfix">
					<?php woocommerce_show_subcategories(); ?>
				</ul>
				<?php
			}
			if ( 'products' === $display_type || 'both' === $display_type ){
				if($arrowit_toolbar){
					?>
					<div class="toobar-top">
						<div class="row align-items-center">
							<?php if($arrowit_left_toolbar): ?>
								<div class="<?php echo esc_attr($arrowit_class_left_toolbar); ?>">
									<?php if(Arrowit::setting('shop_archive_catalog_ordering')): ?>
										<?php do_action('woocommerce_categories_catalog_ordering'); ?>
									<?php endif; ?>
									<?php
										if(Arrowit::setting('shop_archive_result_count')){
											/**
											* Hook: woocommerce_categories_left_toolbar.
											*
											* @hooked woocommerce_result_count
											*/
											do_action( 'woocommerce_categories_left_toolbar' );
										}
									?>
								</div>
							<?php endif; ?>
							<?php if($arrowit_right_toolbar): ?>
								<div class="<?php echo esc_attr($arrowit_class_right_toolbar); ?>">
									<?php if(Arrowit::setting('shop_archive_view')): ?>
										<?php do_action('woocommerce_categories_view'); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
				woocommerce_product_loop_start();
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						?>
							<?php 
								the_post();
								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );
								wc_get_template_part( 'content', 'product' );
							?>
						<?php
					}
				}
			}
			woocommerce_product_loop_end();
			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
		?>
	</div>

	<?php get_sidebar('right'); ?>
</div>
<?php do_action( 'woocommerce_after_main_content' );?>
<?php get_footer( 'shop' ); ?>

