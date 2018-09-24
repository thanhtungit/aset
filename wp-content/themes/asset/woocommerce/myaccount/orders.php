<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
	<h3>My orders</h3>

	<?php 
	  foreach ( $customer_orders->orders as $customer_order ) :
				$order      = wc_get_order( $customer_order );
				$item_count = $order->get_item_count();
				?>
				<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
					
					<tbody>
							<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
								<td colspan="3">Order #<?php echo $order->get_order_number(); ?>
									<br/>
									<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
								</td>
								<td colspan="2">
									<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
								</td>
							</tr>
						<?php
							$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
							if($order_items){
								foreach ( $order_items as $item_id => $item ) {
									$product = $item->get_product();
									?>
									 <tr>
									 	<td>
									 		<?php
									 			 $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image());

				                               if ( ! $product_permalink ) {
				                                   echo wp_kses_post( $thumbnail );
				                               } else {
				                                   printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
				                               }
									 		 ?>
									 	</td>
									 	<td>
									 		<?php

											$is_visible        = $product && $product->is_visible();
											$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

											echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $product->get_title() ) : $product->get_title(), $item, $is_visible );
											

											do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

											wc_display_item_meta( $item );

											do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
										?>
									 	</td>
									 	<td><?php 
									 			echo $product->get_price_html();

									 	 ?></td>
									 	<td><?php
									 		echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item->get_quantity() ) . '</strong>', $item );
									 	 ?></td>
									 	 <td><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
									 </tr>
									<?php 

								}
								?>
								 <tr>
								 	<td colspan="3">Total </td>
								 	<td colspan="2">
								 		<?php
									    echo $order->get_formatted_order_total();
										?>
								 	</td>
								 </tr>

								<?php 
							}
						?>
					</tbody>
				</table>
	<?php endforeach; ?>
	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php _e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go shop', 'woocommerce' ) ?>
		</a>
		<?php _e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
