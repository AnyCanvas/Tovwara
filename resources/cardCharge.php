<?php 
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");

	$paid = $_POST["paid"];
	$conektaTokenId = $_POST["conektaTokenId"];
	$name = $_POST["name"];
	$street1 = $_POST["street1"];
	$street2 = $_POST["street2"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$rfc = $_POST["rfc"];
	$companyName = $_POST["company_name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	
	$charge = Conekta_Charge::create(array(
	  'description'=> 'Fanbot Plan',
	  'reference_id'=> '01',
	  'amount'=> 20000,
	  'currency'=>'MXN',
	  'card'=> $conektaTokenId,
	  'details'=> array(
	    'name'=> $name,
	    'phone'=> $phone,
	    'email'=> $email,
	    'customer'=> array(
	      'logged_in'=> true,
	      'successful_purchases'=> 14,
	      'created_at'=> 1379784950,
	      'updated_at'=> 1379784950,
	      'offline_payments'=> 4,
	      'score'=> 9
	    ),
	    'line_items'=> array(
	      array(
	        'name'=> 'Box of Cohiba S1s',
	        'description'=> 'Imported From Mex.',
	        'unit_price'=> 20000,
	        'quantity'=> 1,
	        'sku'=> 'cohb_s1',
	        'category'=> 'food'
	      )
	    ),
	    'billing_address'=> array(
	      'street1'=> $street1,
	      'street2'=> $street2,
	      'street3'=> null,
	      'city'=> $city,
	      'state'=>$state,
	      'zip'=> $zip,
	      'country'=> 'Mexico',
	      'tax_id'=> $rfc,
	      'company_name'=>$companyName,
	      'phone'=> $phone,
	      'email'=> $email
	    )
	  )
	));
	
	echo $charge->status;
?>