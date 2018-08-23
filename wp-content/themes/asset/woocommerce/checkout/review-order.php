<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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
?>
<table class="shop_table woocommerce-checkout-review-order-table">
	<tbody>
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<td class="product-thumbnail">
						<?php

						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo wp_kses_post( $thumbnail );
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
						}
						?>
						</td>
						<td class="product-name">
							 <?php 
							  echo '<a href="'.esc_url( $product_permalink ).'">'.$_product->get_title().'</a>';
							$variation = new WC_Product_Variation($cart_item['variation_id']);
							$slug = current($variation->get_variation_attributes());
							$name_variation = get_term_by('slug',$slug,'pa_years');
							$title_varidation =  ($name_variation) ? $name_variation->name:'No Title';
							echo '<p>Users: '.$title_varidation.'</p>';
							?>
							
						</td>
						<td class="product-quantity"><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', sprintf( '&times; %s', $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></td>
						<td class="product-total">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</td>
					</tr>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
</table>
<div class="table_last">

<div class="cart-subtotal">
    <p><?php _e( 'Subtotal', 'woocommerce' ); ?></p>
    <p><?php wc_cart_totals_subtotal_html(); ?></p>
</div>

<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
    <div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
        <p><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
        <p><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
    </div>
<?php endforeach; ?>

<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

    <?php wc_cart_totals_shipping_html(); ?>

    <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

<?php endif; ?>

<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
    <div class="fee">
        <p><?php echo esc_html( $fee->name ); ?></p>
        <p><?php wc_cart_totals_fee_html( $fee ); ?></p>
    </div>
<?php endforeach; ?>

<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
    <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
            <div class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                <p><?php echo esc_html( $tax->label ); ?></p>
                <p><?php echo wp_kses_post( $tax->formatted_amount ); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="tax-total">
            <p><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></p>
            <p><?php wc_cart_totals_taxes_total_html(); ?></p>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

<div class="order-total">
    <p><strong><?php _e( 'Total', 'woocommerce' ); ?></strong></p>
    <p><?php wc_cart_totals_order_total_html(); ?></p>
</div>

<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

</div>
