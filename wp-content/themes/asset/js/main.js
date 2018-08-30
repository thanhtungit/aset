var main = {
	 validatForm: function(){
	  var  form = $("#checkoutForm");
	  form.validate({
			rules: {
				billing_first_name: {
					required: true,
					minlength:2,
				},
				billing_last_name: {
					required: true,
					minlength:2,
				},
				billing_email: {
					required: true,
					email:true,
				},
				billing_phone: {
					required: true,
					number:true,
				},
				billing_address_1: {
					required: true,
					minlength:2,
				},
				billing_city: {
					required: true,
					minlength:2,
				},
				billing_postcode: {
					required: true,
				},
				billing_city: {
					required: true,
					minlength:2,
				},
				billing_country: {
				   required: true,
				}
			}
		});
	  if (form.valid() == true){
	  	   $('#box-payment-form').removeClass('hide');
	  	   $('#box-billing-form').addClass('hide');
	  	   $('#step-1').removeClass('hide');
	  	   $('#step-2').addClass('hide');
	  	   var first_name = $('#billing_first_name').val();
	  	   var last_name = $('#billing_last_name').val();
	  	   var email = $('#billing_email').val();
	  	   var address = $('#billing_address_1').val();
	  	   var phone = $('#billing_phone').val();
	  	   var txt = `<span>Billing Information</span><span>${first_name} ${last_name}</span><br/><span>${email}</span><br/>
	  	   <span>${address}</span><br/><span>Phone: ${phone}</span>`;
	  	   $('#user-billing-info').html(txt);
	    }
	  
	},
	backBilling: function(){
		$('#box-billing-form').removeClass('hide');
	  	$('#box-payment-form').addClass('hide');
	  	$('#step-1').addClass('hide');
	  	$('#step-2').removeClass('hide');
	},
	backPayment: function(){
		$('#box-order-form').addClass('hide');
	  	$('#box-payment-form').removeClass('hide');
	  	$('#step-2').addClass('hide');
	  	$('#step-3').removeClass('hide');
	},
	nextOrder: function(){
		$('#box-order-form').removeClass('hide');
	  	$('#box-payment-form').addClass('hide');
	  	$('#step-2').removeClass('hide');
	  	$('#step-3').addClass('hide');
	}
};