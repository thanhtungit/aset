<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );

	return;
}?>
<div class="col2-set" id="customer_details">
            <div class="col-12">
                <h1 class="title-payment">Checkout</h1>
            </div>
            <div class="col-md-8 float-left">
			  <form id="checkoutForm" name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
			  	<p id="step-1" class="step title-step hide"><span class="num">1</span> Billing Information</p>
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
			   <?php if ( $checkout->get_checkout_fields() ) : ?>
			   	<p id="step-2" class="step title-step"><span class="num">2</span> Payment Information</p>
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<div class="box box-payment hide" id="box-payment-form">
					<h3 class="title-checkout"><span class="number">2</span>Payment Information</h3>
					<?php echo woocommerce_checkout_payment(); ?>
				</div>
				<p id="step-3" class="step title-step"><span class="num">2</span> Order Review</p>
				<div class="box box-order hide" id="box-order-form">
					  <h3 class="title-checkout" id="order_review_heading"><span class="number">3</span><?php _e( 'Order Review', 'woocommerce' ); ?></h3>
						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action( 'woocommerce_checkout_order_review' ); ?>

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

								<?php //do_action( 'woocommerce_review_order_before_order_total' ); ?>

								<div class="order-total">
								    <p><strong><?php _e( 'Total', 'woocommerce' ); ?></strong></p>
								    <p><?php wc_cart_totals_order_total_html(); ?></p>
								</div>

								<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

								</div>

							<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

					<?php
					 echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt btn-cart btn-finish" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html('Finish' ) . '</button>' ); 
					 ?>
					  <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
						</div>
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			<?php endif; ?>
		    </div>
		  </form>
		</div>
		<div class="col-md-4 float-left col-added">
                <div class="row-top">
                    <div class="row-subtotal">
                        <span><?php _e( 'Subtotal', 'woocommerce' ); ?></span>
                        <span><?php wc_cart_totals_subtotal_html(); ?></span>
                    </div>
                    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                        <div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                            <span>Discount codes:&nbsp;&nbsp;&nbsp;<strong class="text-uppercase"><?php wc_cart_totals_coupon_label( $coupon ); ?></strong></span>
                            <span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="row-grand">
                        <span><?php _e( 'Grand Total', 'woocommerce' ); ?></span>
                        <span><?php wc_cart_totals_order_total_html(); ?></span>
                    </div>
                </div>
               
                <div class="row-name" id="user-billing-info">
                	 <?php if(is_user_logged_in()){  ?>
                    <span>Billing Information</span>
                    <?php
                		$customer_id = get_current_user_id();
					    $get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
							'billing' => __( 'Billing address', 'woocommerce' ),
							'shipping' => __( 'Shipping address', 'woocommerce' ),
						), $customer_id );
						$current_user = wp_get_current_user();
						echo '<span>'.$current_user->user_email.'</span><br/>';
					   foreach ( $get_addresses as $name => $title ) { ?>
                          <address><?php
							$address = wc_get_account_formatted_address( $name );
							echo $address;
						?></address>
					   	<?php 
					   		}
       			        } 
       			   ?>
                </div>
              
			  </div>
		</div>
</div>




<?php //do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<style type="text/css">
	.woocommerce-checkout .woocommerce form .form-row#billing_postcode_field{
		float: left;
	}
	.woocommerce-checkout .woocommerce form .form-row#billing_country_field{
		float: right;
	}
</style>