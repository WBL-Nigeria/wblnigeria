<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
    ?>
    <div class="quantity hidden">
        <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
    </div>
    <?php
} else {
    /* translators: %s: Quantity. */
    $labelledby = ! empty( $args['product_name'] ) ? sprintf( __( '%s quantity', 'arrowit' ), strip_tags( $args['product_name'] ) ) : '';
    ?>
    <div class="quantity">
        <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( 'Quantity', 'arrowit' ); ?></label>
        <div class="qty-number"><span class="increase-qty plus" onclick="">+</span></div>
        <input
                type="number"
                id="<?php echo esc_attr( $input_id ); ?>"
                class="input-text qty text"
                step="<?php echo esc_attr( $step ); ?>"
                min="<?php echo esc_attr( $min_value ); ?>"
                max="100"
                name="<?php echo esc_attr( $input_name ); ?>"
                value="<?php echo esc_attr( $input_value ); ?>"
                title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'arrowit' ); ?>"
                size="4"
                pattern="<?php echo esc_attr( $pattern ); ?>"
                inputmode="<?php echo esc_attr( $inputmode ); ?>"
                aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" />
        <div class="qty-number"><span class="increase-qty minus" onclick="">-</span></div>
    </div>
    <?php
}
