<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();
?>
<h3>My Dashboard</h3>
<?php
     echo '<h4>Hello, '.esc_html( $current_user->display_name ).'!</h4>';
?>

<p>
From your my account dashboard you have the bility to view a snapshot of your
recent account activity and update your account information. Select a link
below to view or edit information.
</p>
<h4>Account Information</h4>
<div class="row">
	<div class="col-md-6 float-left">
		<div class="panel">
		    <p class="heading">Contact Informaion <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' )); ?>">Edit</a></p>
		    <div class="heading-content">
		    	<p><?php esc_html( $current_user->display_name ); ?></p>
		    	<p><?php echo $current_user->user_email; ?></p>
		    	<p><a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' )); ?>">Change password</a></p>
		    </div>
		</div>
	</div>
	<div class="col-md-6 float-left">
		<div class="panel">
		    <p class="heading">Newslettrs <a href="#">Edit</a></p>
		    <div class="heading-content">
		    	<p>You are currently not subscribed to any newsletter.</p>
		    </div>
		</div>
	</div>
	<div class="col-md-12 float-left">
		<div class="panel">
		    <p class="heading">Address Book <a href="#">Manage Addresa</a></p>
		    <?php
			//if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
				$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
					'billing' => __( 'Default Billing address', 'woocommerce' ),
					'shipping' => __( 'Additional Address', 'woocommerce' ),
				), $customer_id );
			//} 
			$oldcol = 1;
			$col    = 1;
		     ?>
		   <div class="box-address">
		    <?php foreach ( $get_addresses as $name => $title ) : ?>
				<div class="col-md-6 float-left u-column<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> col-<?php echo ( ( $oldcol = $oldcol * -1 ) < 0 ) ? 1 : 2; ?> woocommerce-Address">
						<h3><?php echo $title; ?></h3>
					  <address><?php
						$address = wc_get_account_formatted_address( $name );
						echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
					?></address>
					<p><a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php _e( 'Edit', 'woocommerce' ); ?></a></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	</div>
</div>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
