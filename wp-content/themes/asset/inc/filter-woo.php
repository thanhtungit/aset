<?php
 remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
 
 function my_custom_add_to_cart_redirect( $url ) {
	//$url = WC()->cart->get_checkout_url();
	global $woocommerce;
     $url = $woocommerce->cart->get_cart_url();
	// $url = wc_get_checkout_url(); // since WC 2.5.0
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );

add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
    if (is_cart()) :
        ?>
        <script type="text/javascript">
            (function($){
                $(function(){
                    $('div.woocommerce').on( 'change', '.qty', function(){
                        $("[name='update_cart']").trigger('click');
                    });
                });
            })(jQuery);
        </script>
        <?php
    endif;
}

 ?>