<?php
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);

function my_custom_add_to_cart_redirect($url)
{
    //$url = WC()->cart->get_checkout_url();
    global $woocommerce;
    $url = $woocommerce->cart->get_cart_url();
    // $url = wc_get_checkout_url(); // since WC 2.5.0
    return $url;
}
add_filter('woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect');

add_action('wp_footer', 'cart_update_qty_script');
function cart_update_qty_script()
{
    if (is_cart()):
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

add_filter('woocommerce_checkout_fields', 'order_fields');

function order_fields($fields)
{

   // $fields['billing']['billing_first_name']['priority'] = 1;
   // $fields['billing']['billing_last_name']['priority']  = 2;
    $fields['billing']['billing_email']['priority']      = 21;
    $fields['billing']['billing_phone']['priority']      = 22;
    $fields['billing']['billing_address_1']['priority']  = 23;
    $fields['billing']['billing_country']['priority']    = 100;
    $fields['billing']['billing_city']['class']       =  ['form-row-first'];
   // $fields['billing']['billing_city']['priority']       = 6;
    $fields['billing']['billing_state']['class']      = ['form-row-last'];
    $fields['billing']['billing_state']['label'] ='State/Provice'; 
    $fields['billing']['billing_state']['required'] = false; 
   // $fields['billing']['billing_postcode']['priority']   = 8;
    $fields['billing']['billing_postcode']['class']       =  ['form-row-first'];
    $fields['billing']['billing_country']['class']       =  ['form-row-last'];
    // $fields['billing']['billing_address_2']['priority']  = 8;

    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_company']);

    return $fields;
}

function wpb_woo_my_account_order() {
 $myorder = array(
 'dashboard' => __( 'Account Dashboard', 'woocommerce' ),
 'edit-account' => __( 'Account Information', 'woocommerce' ),
 'edit-address' => __( 'Address Book', 'woocommerce' ),
 'orders' => __( 'My Orders', 'woocommerce' ),
 'downloads' => __( 'Downloads', 'woocommerce' ),
 //'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
 'sub-newsletter' => __( 'Newsletter Subscription', 'woocommerce' ),
 'customer-logout' => __( 'Logout', 'woocommerce' ),
 );
 return $myorder;
}

add_filter( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );
 
function add_sub_newsletter_endpoint() {
    add_rewrite_endpoint( 'sub-newsletter', EP_ROOT | EP_PAGES );
}
 
add_action( 'init', 'add_sub_newsletter_endpoint' );

function sub_newsletter_query_vars( $vars ) {
    $vars[] = 'sub-newsletter';
    return $vars;
}
 
add_filter( 'query_vars', 'sub_newsletter_query_vars', 0 );

function sub_newsletter_endpoint_content() {
    ?>
     <h3>Newsletter Subscription</h3>
     <form method="post" action="">
         <p><input type="checkbox" name="my_sub"> <label>General Subscription</label></p>
         <p><button class="btn button float-right" type="submit">Save</button></p>
    </form>
  <?php 
}
 
add_action( 'woocommerce_account_sub-newsletter_endpoint', 'sub_newsletter_endpoint_content' );

?>