<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
<?php
    global $post, $product, $arrowit_settings;
    $custom_tab_title = get_post_meta(get_the_id(), 'custom_tab_title', true);
    $custom_tab_content = get_post_meta(get_the_id(), 'custom_tab_content', true);
    $tag_condition = get_the_terms( $post->ID, 'product_tag' );
	$tab_tag = Arrowit::setting('single_product_tag');
	$tab_name = Arrowit::setting('single_product_rename_tag');
?>
<div class="product-tab">
	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="nav nav-tabs tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
            <?php if($tag_condition && isset($tab_tag) && $tab_tag !='1') :?>
                <li  class="tab-custom1_tab"><h4><a href="#tab-custom1">
                    <?php if(isset($tab_name) && $tab_name !=''):?>
                        <?php echo esc_attr($tab_name); ?>
                    <?php else:?>
                        <?php echo esc_html__('Tags', 'arrowit') ?>
                    <?php endif;?>
                    
                </a></h4></li>                
            <?php endif;?>
            <?php if ($custom_tab_title && $custom_tab_content) : ?>
                <li  class="tab-custom1_tab"><h4><a href="#tab-custom2"><?php echo esc_html($custom_tab_title) ?></a></h4></li>
            <?php endif; ?>
		</ul>
        <div class="tab-content">
    		<?php foreach ( $tabs as $key => $tab ) : ?>
    			<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
    				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
    			</div>
    		<?php endforeach; ?>
            
            <?php if($tag_condition && isset($tab_tag) && $tab_tag !='1') :?>
                <div class="panel entry-content" id="tab-custom1">
                <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', '<span>Tags:</span>', count( $product->get_tag_ids() ), 'arrowit' ) . ' ', '</span>' ); ?>
                </div>
            <?php endif; ?>    
            <?php if ($custom_tab_title && $custom_tab_content) : ?>
                <div class="panel entry-content" id="tab-custom2">
                    <?php echo wpautop(do_shortcode($custom_tab_content)) ?>
                </div>
            <?php endif; ?>
        </div>
	</div>
</div>
<?php endif; ?>
