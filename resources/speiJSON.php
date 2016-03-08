
<?php
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");
	
	$charge = Conekta_Charge::create(array(
		  'description'=> 'Fanbot Plan',
		  'reference_id'=> '01',
		  'amount'=> 750,
		  'currency'=>'MXN',
		  'bank'=> array(
		    'type'=> 'spei'
		  ),
		  'details'=> array(
		    'name'=> 'Juan Pedro Casillas',
		    'phone'=> '3311703904',
		    'email'=> 'pedrocch@gmail.com',
		    'customer'=> array(
//		      'logged_in'=> true,
//		      'successful_purchases'=> 14,
//		      'created_at'=> 1379784950,
//		      'updated_at'=> 1379784950,
//		      'offline_payments'=> 4,
//		      'score'=> 9
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
		      'street1'=>'77 Mystery Lane',
		      'street2'=> 'Suite 124',
		      'street3'=> null,
		      'city'=> 'Darlington',
		      'state'=>'NJ',
		      'zip'=> '10192',
		      'country'=> 'Mexico',
		      'tax_id'=> 'xmn671212drx',
		      'company_name'=>'X-Men Inc.',
		      'phone'=> '77-777-7777',
		      'email'=> 'purshasing@x-men.org'
		    )
		  )
		));
		
		print($charge->payment_method->clabe);
?>