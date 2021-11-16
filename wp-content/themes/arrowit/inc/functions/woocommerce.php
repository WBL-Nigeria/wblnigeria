<?php
/* 1: Remove Action */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories');
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

/* 2: Add Action */
add_action('woocommerce_product_image', 'arrowit_woocommerce_product_image', 10);
add_action('woocommerce_product_image_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_after_shop_loop_item_title', 'arrowit_woocommerce_single_excerpt', 5);
add_action('woocommerce_categories_left_toolbar', 'woocommerce_result_count', 10);
add_action('woocommerce_categories_catalog_ordering', 'woocommerce_catalog_ordering', 10);
add_action('woocommerce_categories_view', 'arrowit_woocommerce_list_view', 10);
add_action('woocommerce_before_shop_loop_item_title', 'arrowit_template_loop_product_thumbnail', 10);
add_action('woocommerce_product_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_product_excerpt', 'arrowit_woocommerce_single_excerpt', 10);
add_action('woocommerce_product_action', 'arrowit_wishlist_custom', 10);
add_action('woocommerce_product_action', 'arrowit_compare_product', 30);
add_action('woocommerce_product_action', 'arrowit_quickview', 20);
add_action('woocommerce_product_add_to_cart_text', 'arrowit_woocommerce_product_add_to_cart_text');

add_action('woocommerce_before_single_product_summary', 'arrowit_video_product', 10);
add_action('woocommerce_single_product_summary', 'arrowit_woocommerce_single_product_summary');
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10, 5);
add_action('woocommerce_cart_collaterals_before', 'woocommerce_cross_sell_display');
add_action('woocommerce_price_product_packery', 'woocommerce_template_loop_price');
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 6);

/* 3: Add Filter */
add_filter('woocommerce_show_subcategories', 'woocommerce_maybe_show_product_subcategories');
add_filter('woocommerce_short_description', 'arrowit_woocommerce_short_description', 10, 1);
add_filter('woocommerce_add_to_cart_fragments', 'arrowit_woocommerce_header_add_to_cart_fragment');
add_filter('woocommerce_product_tabs', 'arrowit_overide_product_tabs', 98);
add_filter('woocommerce_upsell_display_args', 'wc_change_number_related_products');
add_filter('woocommerce_output_related_products_args', 'arrowit_related_products_args');
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
add_filter('woocommerce_get_image_size_single', function ($size) {
    return array(
        'width' => 570,
        'height' => 684,
        'crop' => 0,
    );
});

add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    return array(
        'width' => 570,
        'height' => 684,
        'crop' => 1,
    );
});
if(!function_exists('arrowit_woocommerce_product_add_to_cart_text')){
    function arrowit_woocommerce_product_add_to_cart_text() {
        global $product;
        $product_type = $product->get_type();
        if (!$product->is_in_stock()) {
            return esc_html__('Out of Stock','arrowit'); 
        }else{    
            switch ( $product_type ) {
                    case 'simple':
                        return esc_html__('Buy Now','arrowit');
                    break;
              
                    case 'grouped':
                        return esc_html__('Buy Product','arrowit');
                    break;
                    case 'external':
                        return esc_html__('Buy Product','arrowit');
                    break;
                    case 'variable':
                        if(is_product()){
                            return esc_html__('Buy Now','arrowit');
                        }else{
                            return esc_html__('Select Options','arrowit');
                        }                  
                    break;
                    default:
                    return esc_html__( 'Read more', 'arrowit' );
            }
        }     
    }    
}

//Single gallery thumbs navigation
add_action('woocommerce_before_single-product-thumb', 'arrowit_single_gallery_nav', 10);
function arrowit_woocommerce_account_menu_items()
{
    $items = array(
        'dashboard' => __('Account Dashboard', 'arrowit'),
        'edit-account' => __('Account Information', 'arrowit'),
        'edit-address' => __('Address Book', 'arrowit'),
        'orders' => __('My Orders', 'arrowit'),
        'downloads' => __('Downloads', 'arrowit'),
        'customer-logout' => __('Logout', 'arrowit'),
    );
    return $items;
}

add_filter('woocommerce_account_menu_items', 'arrowit_woocommerce_account_menu_items');
function arrowit_woocommerce_single_product_summary()
{
    $single_type = Arrowit_Templates::get_product_single_style();
    if ($single_type === 'single_3') {
        add_action('woocommerce_single_product_summary', 'arrowit_stock_text_shop_page', 40);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 5);
        add_action('woocommerce_single_product_summary', 'arrowit_delivery_return', 40, 7);
    } else {
        add_action('woocommerce_single_product_summary', 'arrowit_stock_text_shop_page', 15);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15, 5);
        add_action('woocommerce_single_product_summary', 'arrowit_delivery_return', 15, 7);
    }
}

add_filter('woocommerce_loop_add_to_cart_args', 'remove_rel', 10, 2);
function remove_rel($args, $product)
{
    unset($args['attributes']['rel']);
    return $args;
}

function custom_price_html()
{
    global $post;
    $sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
    $sales_price_from = get_post_meta($post->ID, '_sale_price_dates_from', true);
    $strSaleFromTo = '';
    if ($sales_price_to != "" && $sales_price_from != "") {
        $sales_price_date_to = date("d/m", $sales_price_to);
        $sales_price_date_from = date("d/m", $sales_price_from);
        $strSaleFromTo = '<span class="date_from_to"> Promotion from: <span>' . $sales_price_date_from . ' - ' . $sales_price_date_to . '</span></span>';
    }
    echo wp_kses_post($strSaleFromTo);
}

function arrowit_percentage_price_sale()
{
    global $product, $woocommerce_loop;
    $labels = '';
    if (Arrowit::setting('sale_lable')) {
        if ($product->is_on_sale()) {
            $percentage = 0;

            // Main Price
            $regular_price = $product->is_type('variable') ? $product->get_variation_regular_price('min', true) : $product->get_regular_price();
            $sale_price = $product->is_type('variable') ? $product->get_variation_sale_price('min', true) : $product->get_sale_price();
            $regular_price_max = $product->is_type('variable') ? $product->get_variation_regular_price('max', true) : $product->get_regular_price();
            $sale_price_max = $product->is_type('variable') ? $product->get_variation_sale_price('max', true) : $product->get_sale_price();
            if ($regular_price !== $sale_price || $regular_price_max !== $sale_price_max && $product->is_on_sale()) {
                // Percentage calculation and text
                $percentage_price_min = round(($regular_price - $sale_price) / $regular_price * 100);
                $percentage_price_max = round(($regular_price_max - $sale_price_max) / $regular_price_max * 100);
                if ($percentage_price_max !== 0 && $percentage_price_min !== 0) {
                    $percentage = '<span class="label-upto">' . esc_html__('-', 'arrowit') . '</span>' . $percentage_price_max;
                } elseif ($percentage_price_min > 0 && $percentage_price_max == 0) {
                    $percentage = esc_html__('-', 'arrowit') . $percentage_price_min;
                } else {
                    $percentage = esc_html__('-', 'arrowit') . $percentage_price_max;
                }
            }
            if ($product->get_regular_price())
                $percentage = -round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
            if (Arrowit::setting('percentage_lable') && $percentage) {
                $percentage_price_min = round(($regular_price - $sale_price) / $regular_price * 100);
                $percentage_price_max = round(($regular_price_max - $sale_price_max) / $regular_price_max * 100);
                if (($regular_price !== $sale_price || $regular_price_max !== $sale_price_max && $product->is_on_sale()) && ($percentage_price_max < $percentage_price_min)) {
                    $sales_html = '<span class="label-product on-sale percentage"><span>' . $percentage . '<sup>%</sup></span></span>';
                    echo wp_kses_post($sales_html);
                } else {
                    $sales_html = '<span class="label-product on-sale percentage"><span>' . $percentage . '<sup>%</sup></span></span>';
                    echo wp_kses_post($sales_html);
                }
            }
        }
    }
}

function arrowit_woocommerce_product_image()
{
    global $product, $woocommerce_loop;
    $arrowit_product_layout = arrowit_get_meta_value('product_layout');
    $arrowit_product_columns = arrowit_get_meta_value('product_columns');
    $background_image_hover = 'style="background-image: url(' . esc_url(arrowit_resizeImage('350', '267')) . ';);"';
    $custom_size_product_image = Arrowit::setting('custom_size_product_image');
    $product_image_width = Arrowit::setting('product_image_width');
    $product_image_height = Arrowit::setting('product_image_height');
    if ($arrowit_product_layout) {
        $arrowit_product_layout = arrowit_get_meta_value('product_layout');
    } else {
        $arrowit_product_layout = Arrowit::setting('product_layouts');
    }
    if ($arrowit_product_columns) {
        $arrowit_product_columns = arrowit_get_meta_value('product_columns');
    } else {
        $arrowit_product_columns = Arrowit::setting('product_column');
    }
    if (isset($woocommerce_loop['product_type']) && ($woocommerce_loop['product_type'] == '2') ): ?>
        <?php
            if($woocommerce_loop['show_custom_image'] === 'yes'){
                $has_custom_size = false;
                if ( ! empty( $woocommerce_loop['custom_dimension']['width'] ) ) {
                    $has_custom_size = true;
                    $attachment_size[0] = $woocommerce_loop['custom_dimension']['width'];
                }

                if ( ! empty( $woocommerce_loop['custom_dimension']['height'] ) ) {
                    $has_custom_size = true;
                    $attachment_size[1] = $woocommerce_loop['custom_dimension']['height'];
                }
            }
        ?>
            <div class="product-image">
                <?php arrowit_percentage_price_sale(); ?>
                <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
                   title="<?php echo esc_attr($product->get_title()); ?>">
                    <?php if ($woocommerce_loop['show_custom_image'] === 'yes') :  ?>
                        <?php
                            $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                             $image_url       = Arrowit_Helper::aq_resize( array(
                                'url'    => $full_image_size,
                                'width'  => $attachment_size[0],
                                'height' => $attachment_size[1],
                                'crop'   => true,
                            ) );
                        ?>
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_title() ); ?>"/>
                        <?php else : ?>
                        <img src="<?php echo esc_url(arrowit_resizeImage('200', '160')); ?>"
                             alt="<?php echo esc_attr($product->get_title()); ?>"
                        />
                     <?php endif; ?>
                </a>
            </div>
    <?php elseif (isset($woocommerce_loop['product_type']) && ($woocommerce_loop['product_type'] == '1')): ?>
        <?php
            if($woocommerce_loop['show_custom_image'] === 'yes'){
                $has_custom_size = false;
                if ( ! empty( $woocommerce_loop['custom_dimension']['width'] ) ) {
                    $has_custom_size = true;
                    $attachment_size[0] = $woocommerce_loop['custom_dimension']['width'];
                }

                if ( ! empty( $woocommerce_loop['custom_dimension']['height'] ) ) {
                    $has_custom_size = true;
                    $attachment_size[1] = $woocommerce_loop['custom_dimension']['height'];
                }
            }
        ?>
        <div class="product-image">
            <?php do_action('woocommerce_product_image_sale_flash'); ?>
            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
               title="<?php echo esc_attr($product->get_title()); ?>">
                <?php if ($woocommerce_loop['show_custom_image'] === 'yes') :  ?>
                    <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                         $image_url       = Arrowit_Helper::aq_resize( array(
                            'url'    => $full_image_size,
                            'width'  => $attachment_size[0],
                            'height' => $attachment_size[1],
                            'crop'   => true,
                        ) );
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_title() ); ?>"/>
                    <?php else : ?>
                    <img src="<?php echo esc_url(arrowit_resizeImage('370', '444')); ?>"
                         alt="<?php echo esc_attr($product->get_title()); ?>"
                    />
                <?php endif; ?>
            </a>
        </div>
    <?php elseif ($arrowit_product_columns === '2' && $arrowit_product_layout === 'grid' || $arrowit_product_layout === 'grid_list'): ?>
        <div class="product-image">
            <?php do_action('woocommerce_product_image_sale_flash'); ?>

            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
               title="<?php echo esc_attr($product->get_title()); ?>">
               <?php if ((Arrowit::setting('custom_size_product_image')) && (isset($product_image_width)) && (isset($product_image_height)) && ($product_image_width !== '') && ($product_image_height !== '') ) : ?>
                    <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                         $image_url       = Arrowit_Helper::aq_resize( array(
                            'url'    => $full_image_size,
                            'width'  => $product_image_width,
                            'height' => $product_image_height,
                            'crop'   => true,
                        ) );
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_title() ); ?>"
                 />
                <?php else: ?>
                    <img src="<?php echo esc_url(arrowit_resizeImage('570', '684')); ?>"
                     alt="<?php echo esc_attr($product->get_title()); ?>"
                    />
                <?php endif; ?>
            </a>
        </div>
    <?php elseif ($arrowit_product_layout === 'grid' || $arrowit_product_layout === 'grid_list'): ?>
        <div class="product-image">
            <?php do_action('woocommerce_product_image_sale_flash'); ?>

            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
               title="<?php echo esc_attr($product->get_title()); ?>">
               <?php if ((Arrowit::setting('custom_size_product_image')) && (isset($product_image_width)) && (isset($product_image_height)) && ($product_image_width !== '') && ($product_image_height !== '') ) : ?>
                    <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                         $image_url       = Arrowit_Helper::aq_resize( array(
                            'url'    => $full_image_size,
                            'width'  => $product_image_width,
                            'height' => $product_image_height,
                            'crop'   => true,
                        ) );
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_title() ); ?>"
                 />
                <?php else: ?>
                    <img src="<?php echo esc_url(arrowit_resizeImage('285', '405')); ?>"
                         alt="<?php echo esc_attr($product->get_title()); ?>"
                    />
                <?php endif; ?>
            </a>
        </div>
    <?php elseif ($arrowit_product_layout === 'list' || $arrowit_product_layout === 'list_grid'): ?>
        <div class="product-image">
            <?php do_action('woocommerce_product_image_sale_flash'); ?>

            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
               title="<?php echo esc_attr($product->get_title()); ?>">
               <?php if ((Arrowit::setting('custom_size_product_image')) && (isset($product_image_width)) && (isset($product_image_height)) && ($product_image_width !== '') && ($product_image_height !== '') ) : ?>
                    <?php
                        $full_image_size = get_the_post_thumbnail_url( null, 'full' );
                         $image_url       = Arrowit_Helper::aq_resize( array(
                            'url'    => $full_image_size,
                            'width'  => $product_image_width,
                            'height' => $product_image_height,
                            'crop'   => true,
                        ) );
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_title() ); ?>"
                 />
                <?php else: ?>
                    <img src="<?php echo esc_url(arrowit_resizeImage('270', '275')); ?>"
                         alt="<?php echo esc_attr($product->get_title()); ?>"
                    />
                <?php endif; ?>
            </a>
        </div>
    <?php else: ?>
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action('woocommerce_before_shop_loop_item_title');
        ?>
    <?php endif;
}

function arrowit_template_loop_product_thumbnail()
{
    global $product;
    $second_image = '';
    $attachment_ids = $product->get_gallery_image_ids();
    if (count($attachment_ids) && isset($attachment_ids[0])) {
        $second_image = wp_get_attachment_image($attachment_ids[0], 'woocommerce_thumbnail');
    }
    ?>
    <div class="product-image <?php if ($second_image) {
        echo 'product-image-slider';
    } ?>">
        <?php if ($second_image != ''): ?>
            <a class="img-first" href="<?php the_permalink(); ?>">
                <?php echo woocommerce_get_product_thumbnail(); ?>
            </a>
            <a class="img-last" href="<?php the_permalink(); ?>">
                <?php echo wp_kses($second_image, array(
                    'img' => array(
                        'width' => array(),
                        'height' => array(),
                        'src' => array(),
                        'class' => array(),
                        'alt' => array(),
                        'id' => array(),
                    )
                )); ?>
            </a>
        <?php else: ?>
            <a href="<?php the_permalink(); ?>">
                <?php echo woocommerce_get_product_thumbnail(); ?>
            </a>
        <?php endif; ?>
    </div>
    <?php
}

//Single Product
add_action('arrowit_get_product_image', 'arrowit_get_product_image');
function arrowit_get_product_image()
{
    global $post, $product;
    $thumbnail_size = apply_filters('woocommerce_product_thumbnails_large_size', 'full');
    $post_thumbnail_id = get_post_thumbnail_id($post->ID);
    $full_size_image = wp_get_attachment_image_src($post_thumbnail_id, $thumbnail_size);
    $single_type = Arrowit_Templates::get_product_single_style();
    ?>
    <figure class="woocommerce-product-gallery__wrapper">
        <?php
        $attachment_ids = $product->get_gallery_image_ids();
        if (has_post_thumbnail()) {
            $attributes = array(
                'title' => get_post_field('post_title', $post_thumbnail_id),
                'data-caption' => get_post_field('post_excerpt', $post_thumbnail_id),
                'data-src' => $full_size_image[0],
                'data-large_image' => $full_size_image[0],
                'data-large_image_width' => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2]
            );

            if (has_post_thumbnail()) {
                $html = '<div data-thumb="' . get_the_post_thumbnail_url($post->ID, 'woocommerce_single') . '" class="woocommerce-product-gallery__image"><a href="' . esc_url($full_size_image[0]) . '">';
                $html .= get_the_post_thumbnail($post->ID, 'woocommerce_single', $attributes);
                $html .= '</a></div>';
            } else {
                $html = '<div class="woocommerce-product-gallery__image--placeholder">';
                $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'arrowit'));
                $html .= '</div>';
            }

            echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($post->ID));
        }
        if ($attachment_ids && has_post_thumbnail()) { ?>
            <?php foreach ($attachment_ids as $attachment_id) {
                $full_size_image = wp_get_attachment_image_src($attachment_id, 'full');
                $thumbnail = wp_get_attachment_image_src($attachment_id, 'woocommerce_single');
                $attributes = array(
                    'title' => get_post_field('post_title', $attachment_id),
                    'data-caption' => get_post_field('post_excerpt', $attachment_id),
                    'data-src' => $full_size_image[0],
                    'data-large_image' => $full_size_image[0],
                    'data-large_image_width' => $full_size_image[1],
                    'data-large_image_height' => $full_size_image[2],
                );
                $html = '<div data-thumb="' . esc_url($thumbnail[0]) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url($full_size_image[0]) . '">';
                $html .= wp_get_attachment_image($attachment_id, 'woocommerce_single', false, $attributes);
                $html .= '</a></div>';
                echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $attachment_id);
            } ?>
            <?php
        }
        ?>
    </figure>
    <?php
}

function arrowit_single_gallery_nav()
{
    global $product;
    $gallery_ids = $product->get_gallery_image_ids();
    ?>
    <?php if ($gallery_ids && has_post_thumbnail()): ?>
    <div class="product-list-thumbnails">
        <?php
        echo '<div class="slick-slide"><img src="' . esc_url(arrowit_resizeImage('169', '172')) . '" ></div>';
        foreach ($gallery_ids as $key => $value) {
            $full_image_size = wp_get_attachment_url($value, 'full');
            $image_url_2 = Arrowit_Helper::aq_resize(array(
                'url' => $full_image_size,
                'width' => 169,
                'height' => 172,
                'crop' => true,
            ));
            echo '<div class="slick-slide"><img src="' . esc_url($image_url_2) . '"></div>';
        }
        ?>
    </div>
<?php endif; ?>
    <?php
}

function arrowit_compare_product(){
    global $product;
    $compare = (get_option('yith_woocompare_compare_button_in_products_list') == 'yes');
    ?>
		<?php
			if ($compare && Arrowit::setting('product_compare') && class_exists('YITH_WOOCOMPARE')) {
				printf('<div class="action-item compare-product"><a title=' . esc_attr__("Compare", "arrowit") . ' data-toggle="tooltip" data-placement="top" href="%s" class="%s" data-product_id="%d"><i class="fa fa-retweet"></i></a></div>', arrowit_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id(), esc_html__('Compare', 'arrowit'));
			}
		?>
    <?php
}

function arrowit_add_compare_action($product_id)
{
    $action = 'yith-woocompare-add-product';
    $url_args = array('action' => $action, 'id' => $product_id);
    return wp_nonce_url(add_query_arg($url_args), $action);
}

function arrowit_quickview()
{
    global $product;
    ?>
    <?php
    if (class_exists('YITH_WCQV') && Arrowit::setting('product_quickview')) {
        printf('<div data-toggle="tooltip" data-placement="top" data-original-title="' . esc_attr__('Quick View', 'arrowit') . '" class="action-item quick-view"><a class="button yith-wcqv-button" href="#" data-product_id="%d" ><i class="fa  fa-eye"></i></a></div>', $product->get_id(), esc_html__('Quick View', 'arrowit'), esc_html__('Quick View', 'arrowit'));
    }
    ?>
    <?php
}

function arrowit_wishlist_custom()
{
    ?>
    <?php if (class_exists('YITH_WCWL') && Arrowit::setting('product_wishlist')) : ?>
    <div class="action-item wishlist-btn">
        <?php
        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        ?>
    </div>
<?php endif; ?>
    <?php
}

function arrowit_video_product()
{
    $video_product = arrowit_get_meta_value('video_product');
    ?>
    <?php if ($video_product): ?>
    <div class="video-product">
        <a data-fancybox href="<?php echo esc_url($video_product); ?>" data-type="iframe"><i class="fas fa-play"></i></a>
    </div>
<?php endif; ?>
    <?php
}

function arrowit_delivery_return()
{
    $single_delivery = Arrowit::setting('single_delivery');
    $single_product_delivery_popup = Arrowit::setting('single_product_delivery_popup');
    if ($single_delivery !== '' && $single_product_delivery_popup ==='1') {
        ?>
        <div class="delivery-return">
            <h4><a data-fancybox href="#single-delivery"><?php echo esc_html__('Delivery & Return', 'arrowit') ?></a>
            </h4>
            <div id="single-delivery" class="single-delivery">
                <?php echo \Elementor\Plugin::$instance->frontend->get_builder_content($single_delivery, true); ?>
            </div>
        </div>
    <?php }
}

if (!function_exists('woocommerce_show_subcategories')) {

    /**
     * Output the start of a product loop. By default this is a UL.
     *
     * @param bool $echo Should echo?.
     * @return string
     */
    function woocommerce_show_subcategories($echo = true)
    {
        ob_start();
        if ($echo) {
            echo apply_filters('woocommerce_show_subcategories', ob_get_clean());
        } else {
            return apply_filters('woocommerce_show_subcategories', ob_get_clean());
        }
    }
}
function arrowit_woocommerce_header_add_to_cart_fragment($fragments)
{
    $_cartQty = WC()->cart->cart_contents_count;
    $_cartTotal = WC()->cart->get_cart_total();
    $fragments['.minicart-content .text-items'] = '<span class="text-items">' . $_cartQty . '</span>';
    $fragments['.site-header-cart .count'] = '<span class="count">' . $_cartQty . '</span>';
    $fragments['.minicart-content .cart_qty .woocommerce-Price-amount'] = '' . $_cartTotal . '';;
    return $fragments;
}

function arrowit_woocommerce_single_excerpt()
{
    global $post;
    if (!$post->post_excerpt) {
        return;
    }
    ?>
    <div class="desc">
        <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
    </div>
    <?php
}

function arrowit_woocommerce_short_description($post_excerpt)
{
    $content = str_replace(']]>', ']]&gt;', $post_excerpt);
    return $content;
}

function arrowit_woocommerce_list_view()
{
    $arrowit_product_layout = arrowit_get_meta_value('product_layout');
    $arrowit_product_columns = arrowit_get_meta_value('product_columns');
    if ($arrowit_product_layout) {
        $arrowit_product_layout = arrowit_get_meta_value('product_layout');
    } else {
        $arrowit_product_layout = Arrowit::setting('product_layouts');
    }

    if ($arrowit_product_columns) {
        $arrowit_product_column = $arrowit_product_columns;
    }elseif($arrowit_product_layout ==='list' || $arrowit_product_layout ==='list_grid') {
        $arrowit_product_column = Arrowit::setting('product_column_list');
    } else {
        $arrowit_product_column = Arrowit::setting('product_column');
    }
    ?>
    <div class="list-view">
        <ul class="list-view-as">
            <?php if ($arrowit_product_layout == 'grid'): ?>
                <li class="four-2">
                    <a class="active" href="#" id="grid4" data-layout="layout-grid"
                       data-column="<?php echo esc_attr($arrowit_product_column); ?>"><i class="fa fa-th"></i></a>
                </li>
            <?php endif; ?>
            <?php if ($arrowit_product_layout == 'list'): ?>
                <li class="list-last">
                    <a class="active" href="#" id="list1" data-layout="layout-list" data-column="<?php echo esc_attr($arrowit_product_column); ?>"><i class="fa fa-th-list"></i></a>
                </li>
            <?php endif; ?>
            <?php if ($arrowit_product_layout == 'grid_list' || $arrowit_product_layout == 'list_grid'): ?>
                <li class="list-last">
                    <a href="#" class="<?php if ($arrowit_product_layout == 'list_grid') {
                        echo 'active';
                    } ?>" id="list1" data-layout="layout-list" data-column="<?php echo esc_attr($arrowit_product_column); ?>"><i class="fa fa-th-list"></i></a>
                </li>
                <li class="four-2">
                    <a href="#" class="<?php if ($arrowit_product_layout == 'grid_list') {echo 'active';} ?>" id="grid4" data-layout="layout-grid"
                       data-column="<?php echo esc_attr($arrowit_product_column); ?>"><i class="fa fa-th"></i></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}

function arrowit_stock_text_shop_page()
{
    global $product;
    $avail = esc_html__('Status: ', 'arrowit');
    $availability = $product->get_availability();
    $arrowit_product_meta_enable = Arrowit::setting('single_product_meta_enable');
    $arrowit_product_meta_multi = Arrowit::setting('product_meta_multi');
    if (isset($arrowit_product_meta_multi) && in_array('availability', $arrowit_product_meta_multi) && $arrowit_product_meta_enable) {
        if ($product->is_in_stock()) {
            echo '<div class="availability"><strong>' . $avail . '</strong><span class="stock">' . $product->get_stock_quantity() . esc_html__(' In Stock', 'arrowit') . '</span></div>';
        } else {
            echo '<div class="availability"><strong>' . $avail . '</strong><span class="stock">' . esc_html__(' Out Stock', 'arrowit') . '</span></div>';
        }
    }

}

function arrowit_overide_product_tabs($tabs)
{
    global $product, $post;
    $tab_review = Arrowit::setting('single_product_review');
    $tab_desc = Arrowit::setting('single_product_desc');
    $tab_info = Arrowit::setting('single_product_info');
    $rename_review = Arrowit::setting('single_product_rename_review');
    $rename_info = Arrowit::setting('single_product_rename_info');
    $rename_desc = Arrowit::setting('single_product_rename_desc');

    if (isset($tab_desc) && $tab_desc && !empty(get_the_content())) {
        unset($tabs['description']);
    } else {
        if (isset($rename_desc) && $rename_desc != '' && $post->post_content) {
            $tabs['description']['title'] = $rename_desc;
        }
    }

    if (isset($tab_review) && $tab_review) {
        unset($tabs['reviews']);
    } else {
        if (comments_open()) {
            if (isset($rename_review) && $rename_review != '') {
                $tabs['reviews']['title'] = $rename_review;
            }
        }
    }

    if ($product && ($product->has_attributes() || apply_filters('wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions()))) {
        if (isset($rename_info) && $rename_info != '') {
			$tabs['additional_information']['title'] = $rename_info;
		}
    }

    return $tabs;
}

/**
 * Change number of related products output
 */
function woo_related_products_limit()
{
    global $product;

    $args['posts_per_page'] = 6;
    return $args;
}

function arrowit_related_products_args($args)
{
    $related_limit = Arrowit::setting('related_limit');
    $args['posts_per_page'] = $related_limit; // 4 related products
    return $args;
}

/**
 * Change number of upsells output
 */

function wc_change_number_related_products($args)
{
    $upsell_limit = Arrowit::setting('upsell_limit');
    $args['posts_per_page'] = $upsell_limit; // Change this number
    $args['columns'] = $upsell_limit; // This is the number shown per row.
    return $args;
}

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields($fields)
{
    $fields["billing"]["billing_first_name"]["placeholder"] = esc_html__('First name *', 'arrowit');
    $fields["billing"]["billing_last_name"]["placeholder"] = esc_html__('Last name *', 'arrowit');
    $fields["billing"]["billing_company"]["placeholder"] = esc_html__('Company name (optional)', 'arrowit');
    $fields["billing"]["billing_address_1"]["placeholder"] = esc_html__('House number and street name *', 'arrowit');
    $fields["billing"]["billing_country"]["placeholder"] = esc_html__('Country *', 'arrowit');
    $fields["billing"]["billing_city"]["placeholder"] = esc_html__('Town/City *', 'arrowit');
    $fields["billing"]["billing_state"]["placeholder"] = esc_html__('State/County *', 'arrowit');
    $fields["billing"]["billing_phone"]["placeholder"] = esc_html__('Phone *', 'arrowit');
    $fields["billing"]["billing_email"]["placeholder"] = esc_html__('Email address *', 'arrowit');
    $fields["billing"]["billing_postcode"]["placeholder"] = esc_html__('Postcode/ZIP *', 'arrowit');

    $fields["shipping"]["shipping_first_name"]["placeholder"] = esc_html__('First name *', 'arrowit');
    $fields["shipping"]["shipping_last_name"]["placeholder"] = esc_html__('Last name *', 'arrowit');
    $fields["shipping"]["shipping_company"]["placeholder"] = esc_html__('Company name (optional)', 'arrowit');
    $fields["shipping"]["shipping_address_1"]["placeholder"] = esc_html__('House number and street name *', 'arrowit');
    $fields["shipping"]["shipping_country"]["placeholder"] = esc_html__('Country *', 'arrowit');
    $fields["shipping"]["shipping_city"]["placeholder"] = esc_html__('Town / City *', 'arrowit');
    $fields["shipping"]["shipping_state"]["placeholder"] = esc_html__('State/County *', 'arrowit');
    $fields["shipping"]["shipping_phone"]["placeholder"] = esc_html__('Phone', 'arrowit');
    $fields["shipping"]["shipping_email"]["placeholder"] = esc_html__('Email address', 'arrowit');
    $fields["shipping"]["shipping_postcode"]["placeholder"] = esc_html__('Postcode / ZIP *', 'arrowit');

    return $fields;
}

if (!function_exists('arrowit_woocommerce_support')) {
    add_action('after_setup_theme', 'arrowit_woocommerce_support');
    function arrowit_woocommerce_support()
    {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-lightbox');
    }
}
add_filter('woocommerce_default_address_fields', 'custom_override_default_address_field');
function custom_override_default_address_field($address_field)
{
    $array_placeholder = 'House number and street name *';
    $address_field['address_1']['placeholder'] = $array_placeholder;

    return $address_field;
}
