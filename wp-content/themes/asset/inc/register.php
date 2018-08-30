<?php 
 
 function register_submit_check(){

 $retrieved_nonce = $_POST['woo_register_ac'];
  if ( isset( $_POST['woo_register_ac'] ) && wp_verify_nonce($retrieved_nonce,'woo_register_ac') ){
    
  	 if(registration_validation(
  	 	$_POST['billing_first_name'],
  	 	$_POST['billing_last_name'],
  	 	$_POST['billing_email'],
  	 	$_POST['billing_phone'],
  	 	$_POST['billing_address_1'],
  	 	$_POST['billing_city'],
  	 	$_POST['billing_state'],
  	 	$_POST['billing_postcode'],
  	 	$_POST['billing_country']
  	 )){

  	  $first_name = sanitize_text_field( $_POST['billing_first_name'] );
      $last_name  = sanitize_text_field( $_POST['billing_last_name'] );
      $email   	  = sanitize_email($_POST['billing_email']);
      $phone  	  = sanitize_text_field( $_POST['billing_phone'] );
      $address    = sanitize_text_field( $_POST['billing_address_1'] );
      $city 	  = sanitize_text_field( $_POST['billing_city'] );
      $state      = sanitize_text_field( $_POST['billing_state'] );
      $postcode   = sanitize_text_field( $_POST['billing_postcode'] );
      $country    = sanitize_text_field( $_POST['billing_country'] );

      complete_registration($first_name, $last_name, $email ,$phone, $address, $city, $state, $postcode, $country);

  	 }


  	

  }


 }

 function registration_validation( $first_name, $last_name, $email, $phone, $address, $city, $state='', $postcode, $country )  {

    global $reg_errors;
	$reg_errors = new WP_Error;


	if ( empty( $first_name ) ) {
         $reg_errors->add('first_name', 'Please input first name');
    }
    if( empty($last_name)){
    	$reg_errors->add('last_name','Please input last name');
    }
    if( empty($email)){
    	$reg_errors->add('email','Please input email');

    }elseif($email && !is_email( $email )){
    	 $reg_errors->add( 'email', 'Email is not valid' );
    }
    if ( email_exists( $email ) ) {
       $reg_errors->add( 'email', 'Email Already in use' );
    }
    if( empty($phone)){
    	$reg_errors->add('phone','Please input phone');
    }
    if( empty($address)){
    	$reg_errors->add('address','Please input address');
    }
    if( empty($postcode)){
    	$reg_errors->add('postcode','Please input postcode');
    }
    if( empty($country)){
    	$reg_errors->add('country','Please input country');
    }
 
    if ( is_wp_error( $reg_errors )  && $reg_errors->get_error_messages()) {
       echo '<ul class="woocommerce-error" role="alert">';
	    foreach ( $reg_errors->get_error_messages() as $error ) {
			echo '<li>'.$error.'</li>';
	     }
      echo '</ul>';
 	   return false;
    }

  return true;

 }

 function complete_registration( $first_name, $last_name, $email, $phone, $address, $city, $state='', $postcode, $country ) {
     global $reg_errors;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
          
         var_dump($first_name);
    }
}





?>