<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Settings for 1Pay Gateway.
 * @since 1.3 
 */
return array(
	'enabled'       => array(
		'title'   => __( 'Enable/Disable', 'onepay' ),
		'type'    => 'checkbox',
		'label'   => __( 'OnePay Domestic Gateway', 'onepay' ),
		'default' => 'no'
	),
	'testmode'      => array(
		'title'       => __( 'OnePay Sandbox', 'woocommerce' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable OnePay sandbox (testing)', 'woocommerce' ),
		'default'     => 'no',
		'description' => sprintf( __( 'OnePay sandbox can be used to test payments. See <a href="%s">the testing info</a>.', 'woocommerce' ), 'https://mtf.onepay.vn/developer/?page=modul_noidia' ),
		//@todo: add the logo https://mtf.onepay.vn/developer/?page=logo
	),
	'title'         => array(
		'title'       => __( 'Title', 'onepay' ),
		'type'        => 'text',
		'description' => __( 'This controls the title which the user sees during checkout.', 'onepay' ),
		'default'     => __( 'OnePay Domestic Gateway', 'onepay' ),
		'desc_tip'    => true,
	),
	'description'   => array(
		'title'       => __( 'Description', 'onepay' ),
		'type'        => 'textarea',
		'desc_tip'    => true,
		'description' => __( 'This controls the description which the user sees during checkout.', 'onepay' ),
		'default'     => __( 'With OnePay, you can make payment by using any local Vietnam ATM card.', 'onepay' )
	),
	'api_details'   => array(
		'title'       => __( 'API Credentials', 'onepay' ),
		'type'        => 'title',
		'description' => sprintf( __( 'Enter your OnePay API credentials. Contact OnePay to have your credentials %shere%s.', 'onepay' ), '<a href="http://onepay.com.vn/home/en/contact-us.html">', '</a>' ),
	),
	'merchant_id'   => array(
		'title'       => __( 'Merchant ID', 'onepay' ),
		'type'        => 'text',
		'description' => __( 'Get your Merchant ID from OnePay.', 'onepay' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __( 'Required. Provided by OnePay.', 'onepay' )
	),
	'access_code'   => array(
		'title'       => __( 'Access Code', 'woocommerce' ),
		'type'        => 'text',
		'description' => __( 'Get your Access Code from OnePay.', 'onepay' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __( 'Required. Provided by OnePay.', 'onepay' )
	),
	'secure_secret' => array(
		'title'       => __( 'Secure Secret', 'woocommerce' ),
		'type'        => 'text',
		'description' => __( 'Get your Secure Secret from OnePay.', 'onepay' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __( 'Required. Provided by OnePay.', 'onepay' )
	),
	'user'          => array(
		'title'       => __( 'User for queryDR. Test value: op01', 'woocommerce' ),
		'type'        => 'text',
		'description' => __( 'Get your user info from OnePay.', 'onepay' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __( 'Required. Provided by OnePay', 'onepay' )
	),
	'password'      => array(
		'title'       => __( 'Password for queryDR. Test value: op123456', 'woocommerce' ),
		'type'        => 'text',
		'description' => __( 'Get your password info from OnePay.', 'onepay' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __( 'Required. Provided by OnePay.', 'onepay' )
	),
	'more_info'     => array(
		'title'       => __( 'Instant Payment Notification (IPN)', 'onepay' ),
		'type'        => 'title',
		'description' =>
			sprintf( 'URL: <code>%s</code>', OnePay_Domestic::get_onepay_ipn_url() ) . '<p/>' .
			sprintf( __( '%sContact OnePay%s to configure this URL on its site. <strong>This is required  based on its guidelines.</strong>', 'onepay' ), '<a href="http://onepay.com.vn/home/en/contact-us.html">', '</a>' ),
	),
	/**
	 * @since 1.3.1
	 */
	'debug' => array(
		'title'       => __( 'Debug log', 'onepay' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable logging', 'onepay' ),
		'default'     => 'no',
		'description' => sprintf( __( 'Log events, such as IPN requests, inside %s', 'onepay' ), '<code>' . WC_Log_Handler_File::get_log_file_path( 'OnePay_Domestic' ) . '</code>' ),
	),

);