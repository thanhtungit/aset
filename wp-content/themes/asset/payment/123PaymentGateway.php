<?php

if (!class_exists('WC_Payment_Gateway')) {
    return;
}

include '123pay/rest.client.class.php';
add_action('init', 'init_123payment');

function init_123payment()
{
    function woocommerce_add_123payment_gateway($methods)
    {
        $methods[] = 'WC_123payment';
        return $methods;
    }
    add_filter('woocommerce_payment_gateways', 'woocommerce_add_123payment_gateway');
}

/**
 *  123 Payment gateway
 */
class WC_123payment extends WC_Payment_Gateway
{
    public static $log_enabled = false;
    /**
     * Logger instance
     *
     * @var WC_Logger
     */
    public static $log = false;
    protected $msg     = array();

    public function __construct()
    {
        $this->id                 = '123pay';
        $this->method_title       = __('123Pay Gateway VietNam', '123payment');
        $this->has_fields         = false;
        $this->order_button_text  = __('Proceed to 123Pay', 'woocommerce');
        $this->method_title       = __('123Pay Gateway', 'woocommerce');
        $this->method_description = __('123Pay Standard redirects customers to 123Pay to enter their payment information.', 'woocommerce');
        $this->icon               = TEMPLATE_PATH . '/images/123pay-logo.png';
        $this->supports           = array(
            'products',
            'refunds',
        );
        $this->init_form_fields();
        $this->init_settings();
        $this->title            = $this->settings['title'];
        $this->description      = $this->settings['description'];
        $this->merchantCode     = $this->settings['merchantCode'];
        $this->passcode         = $this->settings['passcode'];
        $this->key              = $this->settings['key'];
        $this->redirect_page_id = $this->settings['redirect_page_id'];
        $this->msg['message']   = "";
        $this->msg['class']     = "";
        self::$log_enabled      = $this->debug;
        $this->testmode         = 'yes' === $this->get_option('testmode', 'no');
        $this->debug            = 'yes' === $this->get_option('debug', 'no');
        if ($this->testmode) {
            $this->description .= ' ' . sprintf(__('SANDBOX ENABLED. You can use sandbox testing accounts only.', 'woocommerce'), '');
            $this->description = trim($this->description);
        }
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_order_status_on-hold_to_processing', array($this, 'capture_payment'));
        add_action('woocommerce_order_status_on-hold_to_completed', array($this, 'capture_payment'));

        add_action('woocommerce_api_wc_123payment', array($this, 'check_123payment_response'));

        add_action('valid-123payment-request', array($this, 'successful_request'));

        add_action('woocommerce_receipt_123payment', array($this, 'receipt_page'));
        //add_action( 'woocommerce_api_' . strtolower( __CLASS__ ), array( $this, 'handle_onepay_ipn' ) );
    }

    public static function log($message, $level = 'info')
    {
        if (self::$log_enabled) {
            if (empty(self::$log)) {
                self::$log = wc_get_logger();
            }
            self::$log->log($level, $message, array('source' => 'napas'));
        }
    }

    /**
     * Initialize Gateway Settings Form Fields
     */
    public function init_form_fields()
    {

        $this->form_fields = apply_filters('wc_offline_form_fields', array(

            'enabled'          => array(
                'title'   => __('Enable/Disable', 'wc-gateway-offline'),
                'type'    => 'checkbox',
                'label'   => __('Enable Payment', 'wc-gateway-offline'),
                'default' => 'no',
            ),

            'title'            => array(
                'title'       => __('Title', 'wc-gateway-offline'),
                'type'        => 'text',
                'description' => __('This controls the title for the payment method the customer sees during checkout.', 'wc-gateway-offline'),
                'default'     => __('123Pay Gateway', 'wc-gateway-offline'),
                'desc_tip'    => true,
            ),

            'description'      => array(
                'title'       => __('Description', 'wc-gateway-offline'),
                'type'        => 'textarea',
                'description' => __('Payment method description that the customer will see on your checkout.', 'wc-gateway-offline'),
                'default'     => __('Pay via 123Pay Gateway in Việt Nam.', 'wc-gateway-offline'),
                'desc_tip'    => true,
            ),
            'testmode'         => array(
                'title'       => __('123Pay sandbox', 'woocommerce'),
                'type'        => 'checkbox',
                'label'       => __('Enable 123Pay sandbox', 'woocommerce'),
                'default'     => 'yes',
                'description' => sprintf(__('123Pay sandbox can be used to test payments. Sign up for a <a href="%s">developer account</a>.', 'woocommerce'), 'https://developer.paypal.com/'),
            ),

            'debug'            => array(
                'title'       => __('Debug log', 'woocommerce'),
                'type'        => 'checkbox',
                'label'       => __('Enable logging', 'woocommerce'),
                'default'     => 'no',
                'description' => sprintf(__('Log 123Pay events, such as IPN requests, inside %s Note: this may log personal information. We recommend using this for debugging purposes only and deleting the logs when finished.', 'woocommerce'), '<code>' . WC_Log_Handler_File::get_log_file_path('123pay') . '</code>'),
            ),
            'merchantCode'     => array(
                'title'       => __('Merchant ID', '123payment'),
                'type'        => 'text',
                'default'     => 'MICODE',
                'description' => __('The unique merchant Id assigned to you by your
Payment Provider.', '123payment'),
            ),
            'passcode'         => array(
                'title'       => __('Access Code', '123payment'),
                'type'        => 'text',
                'default'     => 'MIPASSCODE',
                'description' => __('The access Code assigned to you by your
					Payment Provider.', '123payment'),
            ),
            'key'              => array(
                'title'       => __('Secret key', '123payment'),
                'type'        => 'text',
                'default'     => 'MIKEY',
                'description' => __('The secure hash assigned to you by your
					Payment Provider.', '123payment'),
            ),
            'redirect_page_id' => array(
                'title'       => __('Redirect page after payment', '123payment'),
                'type'        => 'select',
                'options'     => $this->get_pages(''),
                'description' => "",
            ),

            'instructions'     => array(
                'title'       => __('Instructions', 'wc-gateway-offline'),
                'type'        => 'textarea',
                'description' => __('Instructions that will be added to the thank you page and emails.', 'wc-gateway-offline'),
                'default'     => '',
                'desc_tip'    => true,
            ),
        )
        );
    }

    public function admin_options()
    {
        echo '<h3>' . __('123payment Gateway System', '123payment') . '</h3>';
        echo '<p>' . __('123payment Gateway System') . '</p>';
        echo '<table class="form-table">';
        $this->generate_settings_html();
        echo '</table>';
    }
    public function payment_fields()
    {
        if ($this->description) {
            echo wpautop(wptexturize($this->description));
        }
    }
    public function receipt_page($order)
    {
        echo '<p>' . __('Connection To Payment Terminal', '123payment') . '</p>';
        echo $this->generate_123payment_form($order);
    }
    public function process_payment($order_id)
    {
        $order = wc_get_order($order_id);
        return array(
            'result'   => 'success',
            'redirect' => $this->get_pay_url($order),
        );
    }

    /**
     * Set the cron job running queryDR in 20 mintues
     * Because the Napas payment timeout is 15 minutes
     *
     * @param string $vpc_MerchTxnRef
     */
    public function set_onepay_querydr_cron($vpc_MerchTxnRef)
    {

        wp_schedule_single_event(
            time() + 20 * 60,
            'woo_handle_napas_querydr',
            array($vpc_MerchTxnRef)
        );

    }

    /**
     *
     * @param  array $args
     *
     * @return string
     */
    public function checksum($args)
    {
        $sRawDataSign = '';
        foreach ($args as $k => $v) {
            if ($k != 'checksum' && $k != 'addInfo' && $k != 'description') {
                $sRawDataSign .= $v;
            }

        }
        $checksum = sha1($sRawDataSign . $this->key);
        return $checksum;
    }
    /**
     * Get the OnePay pay URL for an order
     * AND set the queryDR cron for this transaction
     *
     * @param  WC_Order $order
     *
     * @return string
     */
    public function get_pay_url($order)
    {
        $args = array(
            'mTransactionID' => sprintf('%1$s_%2$s', $order->get_id(), date('YmdHis')),
            'merchantCode'   => $this->merchantCode,
            'bankCode'       => '123PAY',
            'totalAmount'    => $order->get_total() * 23000,
            'clientIP'       => '127.0.0.1', //$this->get_client_ip(),
            'custName'       => $order->billing_first_name . ' ' . $order->billing_last_name,
            'custAddress'    => $order->get_billing_email(),
            'custGender'     => 'M',
            'custDOB'        => '20/10/1982',
            'custPhone'      => $order->get_billing_phone(),
            'custMail'       => $order->get_billing_email(),
            'description'    => substr(
                sprintf('Order #%1$s - %2$s', $order->get_id(), get_home_url()),
                0,
                32),
            'cancelURL'      => get_home_url(),
            'redirectURL'    => $this->get_return_url($order),
            'errorURL'       => $this->get_return_url($order),
            'passcode'       => $this->passcode,
        );

        // Set the queryDR cron for this transaction
        $this->set_onepay_querydr_cron($args['mTransactionID']);
        // Get the secure hash
        $checksum = $this->checksum($args);
        // Add the secure hash to the args
        $args['checksum'] = $checksum;
        //$http_args        = http_build_query($args, '', '&');

        // Log data
        $message_log = sprintf('get_pay_url - Order ID: %1$s - http_args: %2$s', $order->get_id(), print_r($args, true));
        self::log($message_log);

        if ($this->testmode) {
            $link = 'https://sandbox.123pay.vn/miservice/createOrder1';
            //return 'https://sandbox.123pay.vn/miservice/createOrder1?'.$http_args;
            $request = new RestRequest($link, 'POST');
            $request->buildPostBody($args);
            $request->execute();
            $http_code = $request->getHTTPCode();
            if ($http_code == '200') {
                $result = json_decode($request->getResponseBody(), true);
                if($result[0]=='1'){
                	return $result[2];
                }
            } else{
                $error = $request->getResponseBody();
            }

        } else {
            //return 'https://sandbox.123pay.vn/miservice/createOrder1?' . $http_args;
        }

    }

    function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
}

    public function generate_123payment_form($order_id)
    {
        global $woocommerce;
        $order        = new WC_Order($order_id);
        $redirect_url = ($this->redirect_page_id == "" || $this->redirect_page_id == 0) ? get_site_url() . "/" : get_permalink($this->redirect_page_id);
        $redirect_url = add_query_arg('wc-api', get_class($this), $redirect_url);
        unset($woocommerce->session->zegersot);
        unset($woocommerce->session->zegersot_id);
        $woocommerce->session->zegersot = $order_id;
        $amount                         = $order->order_total;
        $merchant_id                    = $this->merchant_id;
        $amount                         = ($this->vahed == 'toman') ? $amount * 10 : $amount;
        $callback_url                   = urlencode($redirect_url);
        $ch                             = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sandbox.123pay.vn/miservice/createOrder1');
        curl_setopt($ch, CURLOPT_POSTFIELDS, "merchant_id=$merchant_id&amount=$amount&callback_url=$callback_url");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        if ($result->status) {
            $woocommerce->session->zegersot_id = $result->RefNum;
            if (!headers_sent()) {
                header('Location: ' . $result->payment_url);
                exit();
            } else {
                echo "<script type='text/javascript'>window.onload = function () { top.location.href = '" . $result->payment_url . "'; };</script>";
                exit();
            }
        } else {
            echo $result->message;
        }
    }

    public function check_123payment_response()
    {
        global $woocommerce;
        $order_id = $woocommerce->session->zegersot;
        $order    = new WC_Order($order_id);
        if ($order_id != '') {
            if ($order->status != 'completed') {
                $merchant_id = $this->merchant_id;
                $RefNum      = trim($_REQUEST['RefNum']);
                $ch          = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://123pay.ir/api/v1/verify/payment');
                curl_setopt($ch, CURLOPT_POSTFIELDS, "merchant_id=$merchant_id&RefNum=$RefNum");
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($response);
                if ($result->status and $woocommerce->session->zegersot_id == $_REQUEST['RefNum']) {
                    $this->msg['message'] = 'Successful Payment<br/>Reference ID : ' . $_REQUEST['RefNum'];
                    $this->msg['class']   = 'success';
                    $order->payment_complete();
                    $order->add_order_note('Successful Payment<br/>Reference ID : ' . $_REQUEST['RefNum'] . ' AND ' . $_REQUEST['RefNum']);
                    $order->add_order_note($this->msg['message']);
                    $woocommerce->cart->empty_cart();
                } else {
                    $this->msg['class']   = 'error';
                    $this->msg['message'] = "Payment failed";
                }
            } else {
                $this->msg['class']   = 'error';
                $this->msg['message'] = 'We can not find order information';
            }
        }
        $redirect_url = ($this->redirect_page_id == "" || $this->redirect_page_id == 0) ? get_site_url() . "/" : get_permalink($this->redirect_page_id);
        $redirect_url = add_query_arg(array(
            'msg'  => base64_encode($this->msg['message']),
            'type' => $this->msg['class'],
        ), $redirect_url);
        wp_redirect($redirect_url);
        exit();
    }
    public function showMessage($content)
    {
        return '<div class="box ' . $this->msg['class'] . '-box">' . $this->msg['message'] . '</div>' . $content;
    }
    public function get_pages($title = false, $indent = true)
    {
        $wp_pages  = get_pages('sort_column=menu_order');
        $page_list = array();
        if ($title) {
            $page_list[] = $title;
        }
        foreach ($wp_pages as $page) {
            $prefix = '';
            if ($indent) {
                $has_parent = $page->post_parent;
                while ($has_parent) {
                    $prefix .= ' - ';
                    $next_page  = get_page($has_parent);
                    $has_parent = $next_page->post_parent;
                }
            }
            $page_list[$page->ID] = $prefix . $page->post_title;
        }
        return $page_list;
    }

}
