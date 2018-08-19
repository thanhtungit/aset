<?php

if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}

add_action('init','init_123payment');
 
function init_123payment(){
    function woocommerce_add_123payment_gateway( $methods ) {
			$methods[] = 'WC_123payment';
			return $methods;
	   }
	add_filter( 'woocommerce_payment_gateways', 'woocommerce_add_123payment_gateway' );
}


 /**
  *  123 Payment gateway
  */
class WC_123payment extends WC_Payment_Gateway {
		 public static $log_enabled = false;
		/**
		 * Logger instance
		 *
		 * @var WC_Logger
		 */
		public static $log = false;
		protected $msg = array();

       public function __construct() {
			$this->id           = '123pay';
			$this->method_title = __( '123Pay Gateway VietNam', '123payment' );
			$this->has_fields   = false;
			$this->order_button_text = __( 'Proceed to 123Pay', 'woocommerce' );
			$this->method_title  = __( '123Pay Gateway', 'woocommerce' );
			$this->method_description = __( '123Pay Standard redirects customers to 123Pay to enter their payment information.', 'woocommerce' );
			$this->icon = TEMPLATE_PATH.'/images/123pay-logo.png';
			$this->supports  = array(
					'products',
					'refunds',
			);
			$this->init_form_fields();
			$this->init_settings();
			$this->title            = $this->settings['title'];
			$this->description      = $this->settings['description'];
			$this->merchant_id      = $this->settings['merchant_id'];
			$this->access_code      = $this->settings['access_code'];
			$this->vahed            = $this->settings['vahed'];
			$this->redirect_page_id = $this->settings['redirect_page_id'];
			$this->msg['message']   = "";
			$this->msg['class']     = "";
			self::$log_enabled    = $this->debug;
			$this->testmode       = 'yes' === $this->get_option( 'testmode', 'no' );
			$this->debug          = 'yes' === $this->get_option( 'debug', 'no' );
			if ( $this->testmode ) {
			/* translators: %s: Link to PayPal sandbox testing guide page */
			$this->description .= ' ' . sprintf( __( 'SANDBOX ENABLED. You can use sandbox testing accounts only.', 'woocommerce' ), '' );
			    $this->description  = trim( $this->description );
		    }
		    add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
			add_action( 'woocommerce_order_status_on-hold_to_processing', array( $this, 'capture_payment' ) );
			add_action( 'woocommerce_order_status_on-hold_to_completed', array( $this, 'capture_payment' ) );

			add_action( 'woocommerce_api_wc_123payment', array( $this, 'check_123payment_response' ) );

			add_action( 'valid-123payment-request', array( $this, 'successful_request' ) );
			
			add_action( 'woocommerce_receipt_123payment', array( $this, 'receipt_page' ) );
			//add_action( 'woocommerce_api_' . strtolower( __CLASS__ ), array( $this, 'handle_onepay_ipn' ) );
		}  

	public static function log( $message, $level = 'info' ) {
		if ( self::$log_enabled ) {
			if ( empty( self::$log ) ) {
				self::$log = wc_get_logger();
			}
			self::$log->log( $level, $message, array( 'source' => 'napas' ) );
		}
	}   
    
		 /**
		 * Initialize Gateway Settings Form Fields
		 */
  public function init_form_fields() {
      
    $this->form_fields = apply_filters( 'wc_offline_form_fields', array(
          
        'enabled' => array(
            'title'   => __( 'Enable/Disable', 'wc-gateway-offline' ),
            'type'    => 'checkbox',
            'label'   => __( 'Enable Payment', 'wc-gateway-offline' ),
            'default' => 'no'
        ),

        'title' => array(
            'title'       => __( 'Title', 'wc-gateway-offline' ),
            'type'        => 'text',
            'description' => __( 'This controls the title for the payment method the customer sees during checkout.', 'wc-gateway-offline' ),
            'default'     => __( '123 Pay Gateway', 'wc-gateway-offline' ),
            'desc_tip'    => true,
        ),

        'description' => array(
            'title'       => __( 'Description', 'wc-gateway-offline' ),
            'type'        => 'textarea',
            'description' => __( 'Payment method description that the customer will see on your checkout.', 'wc-gateway-offline' ),
            'default'     => __( 'Pay via 123Pay Gateway in Việt Nam.', 'wc-gateway-offline' ),
            'desc_tip'    => true,
        ),
        'testmode'              => array(
		'title'       => __( '123Pay sandbox', 'woocommerce' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable 123Pay sandbox', 'woocommerce' ),
		'default'     => 'yes',
		/* translators: %s: URL */
		'description' => sprintf( __( '123Pay sandbox can be used to test payments. Sign up for a <a href="%s">developer account</a>.', 'woocommerce' ), 'https://developer.paypal.com/' ),
		),

		'debug'       => array(
		'title'       => __( 'Debug log', 'woocommerce' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable logging', 'woocommerce' ),
		'default'     => 'no',
		/* translators: %s: URL */
		'description' => sprintf( __( 'Log 123Pay events, such as IPN requests, inside %s Note: this may log personal information. We recommend using this for debugging purposes only and deleting the logs when finished.', 'woocommerce' ), '<code>' . WC_Log_Handler_File::get_log_file_path( '123pay' ) . '</code>' ),
		),
        'merchant_id'      => array(
					'title'       => __( 'Merchant ID', '123payment' ),
					'type'        => 'text',
					'description' => __( 'The unique merchant Id assigned to you by your
Payment Provider.', '123payment' )
		),
		'access_code'      => array(
					'title'       => __( 'Access Code', '123payment' ),
					'type'        => 'text',
					'description' => __( 'The access Code assigned to you by your
					Payment Provider.', '123payment' )
		),
		'secure_hash'  => array(
					'title'       => __( 'Secure Hash', '123payment' ),
					'type'        => 'text',
					'description' => __( 'The secure hash assigned to you by your
					Payment Provider.', '123payment' )
		),


		'vahed' => array(
					'title'       => __( 'Currency Unit','123payment' ),
					'type'        => 'select',
					'options'     => array(
						'USD'  => 'United States (US) dollar ($)',
						'VND' => 'Vietnamese đồng (₫)',
					),
					'description' => "Currency Unit"
		),
		'redirect_page_id' => array(
					'title'       => __( 'Redirect page after payment' ,'123payment'),
					'type'        => 'select',
					'options'     => $this->get_pages( '' ),
					'description' => ""
		),

        'instructions' => array(
            'title'       => __( 'Instructions', 'wc-gateway-offline' ),
            'type'        => 'textarea',
            'description' => __( 'Instructions that will be added to the thank you page and emails.', 'wc-gateway-offline' ),
            'default'     => '',
            'desc_tip'    => true,
        ),
      ) 
    );
   }

   public function admin_options() {
			echo '<h3>' . __( '123payment Gateway System','123payment' ) . '</h3>';
			echo '<p>' . __( '123payment Gateway System') . '</p>';
			echo '<table class="form-table">';
			$this->generate_settings_html();
			echo '</table>';
		}
	public function payment_fields() {
		if ( $this->description ) {
			echo wpautop( wptexturize( $this->description ) );
		}
	}
	public function receipt_page( $order ) {
			echo '<p>' . __( 'Connection To Payment Terminal', '123payment' ) . '</p>';
			echo $this->generate_123payment_form( $order );
	}
	public function process_payment( $order_id ) {
			$order = wc_get_order( $order_id );
			return array( 
				'result' => 'success',
				'redirect' =>$this->get_pay_url( $order )
			);
	}

	/**
	 * Set the cron job running queryDR in 20 mintues
	 * Because the Napas payment timeout is 15 minutes
	 *
	 * @param string $vpc_MerchTxnRef
	 */
	public function set_onepay_querydr_cron( $vpc_MerchTxnRef ) {

		wp_schedule_single_event(
			time() + 20 * 60,
			'woo_handle_napas_querydr',
			array( $vpc_MerchTxnRef )
		);

	}


	/**
	 * Create the vpc_SecureHash value.
	 * @seehttp://saca.com.vn/vnt_upload/product/11_2017/NAPASMerchantIntegrationSpecification_2.2.pdf
	 *
	 * @param  array $args
	 *
	 * @return string
	 */
	public function create_vpc_SecureHash( $args ) {
		$stringHashData = "";

		// arrange array data a-z before make a hash
		ksort( $args );

		foreach ( $args as $key => $value ) {

			if ( strlen( $value ) > 0 ) {
				if ( ( strlen( $value ) > 0 ) && ( ( substr( $key, 0, 4 ) == "vpc_" ) || ( substr( $key, 0, 5 ) == "user_" ) ) ) {
					$stringHashData .= $key . "=" . $value . "&";
				}
			}
		}
		//Remove the last character "&"
		$stringHashData = rtrim( $stringHashData, "&" );

		return strtoupper( hash_hmac( 'SHA256', $stringHashData, pack( 'H*', $this->secure_secret ) ) );
	}
	/**
	 * Get the OnePay pay URL for an order
	 * AND set the queryDR cron for this transaction
	 *
	 * @param  WC_Order $order
	 *
	 * @return string
	 */
	public function get_pay_url( $order ) {
		$args = array(
			'Title'           => __( 'Napas Payment Aset', 'napas' ),
			'vpc_Merchant'    => $this->merchant_id,
			'vpc_AccessCode'  => $this->access_code,
			'vpc_MerchTxnRef' => sprintf( '%1$s_%2$s', $order->get_id(), date( 'YmdHis' ) ),
			'vpc_OrderInfo'   => substr(
				sprintf( 'Order #%1$s - %2$s', $order->get_id(), get_home_url() ),
				0,
				32 ), // Limit 32 characters
			'vpc_Amount'      => $order->get_total() * 100, // Multiplying 100 is a requirement from OnePay
			'vpc_ReturnURL'   => $this->get_return_url( $order ),
			'vpc_BackURL'	  =>  get_home_url(),
			'vpc_Version'     => '2',
			'vpc_Command'     => 'pay',
			'vpc_Locale'      => ( 'vi' == get_locale() ) ? 'vn' : 'en',
			'vpc_Currency'    => 'VND',
			'vpc_TicketNo'    => $_SERVER['REMOTE_ADDR'],
		);

		// Set the queryDR cron for this transaction
		$this->set_onepay_querydr_cron( $args['vpc_MerchTxnRef'] );

		// Get the secure hash

		$vpc_SecureHash = $this->create_vpc_SecureHash( $args );
		// Add the secure hash to the args
		$args['vpc_SecureHash'] = $vpc_SecureHash;
		var_dump($args);
		die();
		$http_args              = http_build_query( $args, '', '&' );

		// Log data
		$message_log = sprintf('get_pay_url - Order ID: %1$s - http_args: %2$s', $order->get_id(), print_r($args, true) );
		self::log( $message_log);
		

		if ( $this->testmode ) {
			return 'https://sandbox.napas.com.vn/gateway/vpcpay.do?'.$http_args;
		} else {
			return 'https://napas.com.vn/gateway/vpcpay.do?' . $http_args;
		}

	}
	 public function generateHash($data)
    {
        $md5HashData =  $this->access_code;
        ksort($data);
        foreach ($data as $key => $val) {
            if (strlen($val) > 0) {
                $md5HashData .= $val;
            }
        }
        return strtoupper(md5($md5HashData));
    }

	public function generate_123payment_form( $order_id ) {
			global $woocommerce;
			$order        = new WC_Order( $order_id );
			$redirect_url = ( $this->redirect_page_id == "" || $this->redirect_page_id == 0 ) ? get_site_url() . "/" : get_permalink( $this->redirect_page_id );
			$redirect_url = add_query_arg( 'wc-api', get_class( $this ), $redirect_url );
			unset( $woocommerce->session->zegersot );
			unset( $woocommerce->session->zegersot_id );
			$woocommerce->session->zegersot = $order_id;
			$amount                         = $order->order_total;
			$merchant_id  = $this->merchant_id;
			$amount       = ( $this->vahed == 'toman' ) ? $amount * 10 : $amount;
			$callback_url = urlencode($redirect_url);
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, 'https://123pay.ir/api/v1/create/payment' );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, "merchant_id=$merchant_id&amount=$amount&callback_url=$callback_url" );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			$response = curl_exec( $ch );
			curl_close( $ch );
			$result = json_decode( $response );
			if ( $result->status ) {
				$woocommerce->session->zegersot_id = $result->RefNum;
				if ( ! headers_sent() ) {
					header( 'Location: ' . $result->payment_url );
					exit();
				} else {
					echo "<script type='text/javascript'>window.onload = function () { top.location.href = '" . $result->payment_url . "'; };</script>";
					exit();
				}
			} else {
				echo $result->message;
			}
		}

		public function check_123payment_response() {
			global $woocommerce;
			$order_id = $woocommerce->session->zegersot;
			$order    = new WC_Order( $order_id );
			if ( $order_id != '' ) {
				if ( $order->status != 'completed' ) {
					$merchant_id = $this->merchant_id;
					$RefNum      = trim( $_REQUEST['RefNum'] );
					$ch = curl_init();
					curl_setopt( $ch, CURLOPT_URL, 'https://123pay.ir/api/v1/verify/payment' );
					curl_setopt( $ch, CURLOPT_POSTFIELDS, "merchant_id=$merchant_id&RefNum=$RefNum" );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					$response = curl_exec( $ch );
					curl_close( $ch );
					$result = json_decode( $response );
					if ( $result->status AND $woocommerce->session->zegersot_id == $_REQUEST['RefNum'] ) {
						$this->msg['message'] = 'Successful Payment<br/>Reference ID : ' . $_REQUEST['RefNum'];
						$this->msg['class']   = 'success';
						$order->payment_complete();
						$order->add_order_note( 'Successful Payment<br/>Reference ID : ' . $_REQUEST['RefNum'] . ' AND ' . $_REQUEST['RefNum'] );
						$order->add_order_note( $this->msg['message'] );
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
			$redirect_url = ( $this->redirect_page_id == "" || $this->redirect_page_id == 0 ) ? get_site_url() . "/" : get_permalink( $this->redirect_page_id );
			$redirect_url = add_query_arg( array(
				'msg'  => base64_encode( $this->msg['message'] ),
				'type' => $this->msg['class']
			), $redirect_url );
			wp_redirect( $redirect_url );
			exit();
		}
		public function showMessage( $content ) {
			return '<div class="box ' . $this->msg['class'] . '-box">' . $this->msg['message'] . '</div>' . $content;
		}
		public function get_pages( $title = false, $indent = true ) {
			$wp_pages  = get_pages( 'sort_column=menu_order' );
			$page_list = array();
			if ( $title ) {
				$page_list[] = $title;
			}
			foreach ( $wp_pages as $page ) {
				$prefix = '';
				if ( $indent ) {
					$has_parent = $page->post_parent;
					while ( $has_parent ) {
						$prefix     .= ' - ';
						$next_page  = get_page( $has_parent );
						$has_parent = $next_page->post_parent;
					}
				}
				$page_list[ $page->ID ] = $prefix . $page->post_title;
			}
			return $page_list;
		}
		

}


 ?>