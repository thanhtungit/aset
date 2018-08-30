<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>

<div class="box box-billing" id="box-billing-form">
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

	<h3 class="title-checkout"><span class="number">1</span><?php _e( 'Billing Information', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<p class="form-row form-row-first" id="billing_first_name_field">
			<label for="billing_first_name" class="">First name&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper">
				<input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="<?php echo $checkout->get_value( 'billing_first_name' ); ?>" autocomplete="given-name"></span>
		</p>
		<p class="form-row form-row-last validate-required" id="billing_last_name_field"><label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="<?php echo $checkout->get_value( 'billing_last_name' ); ?>" autocomplete="family-name"></span>
		</p>
		<p class="form-row form-row-first validate-required validate-email" id="billing_email_field" data-priority="21"><label for="billing_email" class="">Email address&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="<?php echo $checkout->get_value( 'billing_email' ); ?>" autocomplete="email username"></span></p>
		<p class="form-row form-row-last validate-required validate-phone" id="billing_phone_field"><label for="billing_phone" class="">Phone&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="" value="<?php echo $checkout->get_value( 'billing_phone' ); ?>" autocomplete="tel"></span></p>
		<p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field"><label for="billing_address_1" class="">Street address&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="House number and street name" value="<?php echo $checkout->get_value( 'billing_address_1' ); ?>" autocomplete="address-line1"></span></p>
		<p class="form-row form-row-first validate-required">
			<label for="city" class="">City&nbsp;<abbr class="required" title="required">*</abbr></label>
			<span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="" value="<?php echo $checkout->get_value( 'billing_city' ); ?>" autocomplete="address-level2"></span></p>
		<p class="form-row form-row-last"><label for="billing_state" class="">State/Provice</label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " value="<?php echo $checkout->get_value( 'billing_state' ); ?>" placeholder="" name="billing_state" autocomplete="address-level1"></span></p>
		<p class="form-row form-row-first validate-postcode validate-required"><label for="billing_postcode" class="">ZIP/Postcode<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_postcode" id="billing_postcode" placeholder="" value="<?php echo $checkout->get_value( 'billing_postcode' ); ?>" autocomplete="postal-code"></span></p>

		<?php 
          $countries_obj   = new WC_Countries();
          $countries   = $countries_obj->__get('countries');
		?>
		<p class="form-row form-row-last validate-required" id="billing_country_field" data-priority="100"><label for="billing_country" class="">Country&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="billing_country" id="billing_country" class="country_to_state country_select " autocomplete="country">
			<?php
             if($countries){
             	$value_country = $checkout->get_value( 'billing_country' );
			 ?>
			<option value="">Select a country…</option>
		    <?php foreach ($countries as $key => $country) {
		    	$selected = ($key == $value_country) ? 'selected="selected"' :'';
		    	echo $selected;
		    	echo '<option value="'.$key.'" '.$selected.'>'.$country.'</option>';
		    } ?>

		<?php } ?>
		</select>
		</span></p>
	</div>
	<p class="note">* Required fiedls</p>
	<p class="btn-footer">
	 <button onclick="main.validatForm()" class="btn btn-continue button alt  btn-cart" type="button">Continue</button>
	</p>
 </div>
 
</div>

