<?php
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");

	$name = $_POST["name"];
	$email = $_POST["email"];
	$conept = $_POST["concept"];
	$amount = $_POST["amount"];

	
//	$charge = Conekta_Charge::create(array(
//		  'description'=> 'Fanbot Plan',
//		  'reference_id'=> '01',
//		  'amount'=> '75000',
//		  'currency'=>'MXN',
//		  'bank'=> array(
//		    'type'=> 'spei'
//		  ),
//		  'details'=> array(
//		    'name'=> $name,
////		    'phone'=> '3311703904',
//		    'email'=> $email,
//		    'customer'=> array(
//		    ),
//		    'line_items'=> array(
//		      array(
//		        'name'=> 'Fanbot plan mensual',
//		        'description'=> $concept,
//		        'unit_price'=> $amount . '00',
//		        'quantity'=> 1,
//		        'sku'=> '750',
//		        'category'=> 'Interacción'
//		      )
//		    ),
//		    'billing_address'=> array(
//		    )
//		  )
//		));
//
//		echo'"Nombre":"'. $name . '"';
//		echo '{';
//		echo'"Nombre":"'. $charge->details["name"] . '"';
//		echo ',';
//		echo'"Email":"'. $charge->details["email"] . '"';
//		echo ',';
//		echo'"Concepto":"'. $charge->details["line_items"][0]["description"] . '"';
//		echo ',';
//		echo'"Cantidad":"'. $charge->amount. '"';
//		echo ',';
//		echo'"CLABE":"'. $charge->payment_method->clabe . '"';
//		echo '}';


	$url = 'https://api.sendgrid.com/';
	$user = 'desarrollo@fanbot.me';
	$pass = 'R3GVcDFWYCQ7Ap';
	
	$fileName = 'factura.xml';

	$params = array(
	    'api_user'  => $user,
	    'api_key'   => $pass,
	    'to'        => $email,
	    'subject'   => 'test of file sends',
	    'html'      => '<p> the HTML </p>',
	    'text'      => 'the plain text',
	    'from'      => 'example@sendgrid.com',
	    'files['.$fileName.']' => '@'.$_FILES['photo']['tmp_name']
	  );
	
	print_r($params);
	
	$request =  $url.'api/mail.send.json';
	
	// Generate curl request
	$session = curl_init($request);
	
	// Tell curl to use HTTP POST
	curl_setopt ($session, CURLOPT_POST, true);
	
	// Tell curl that this is the body of the POST
	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
	
	// Tell curl not to return headers, but do return the response
	curl_setopt($session, CURLOPT_HEADER, false);
	// Tell PHP not to use SSLv3 (instead opting for TLS)
	curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	
	// obtain response
	$response = curl_exec($session);
	curl_close($session);
	
	// print everything out
	print_r($response);
?>