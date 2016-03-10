<?php
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");

	$name = $_POST["name"];
	$email = $_POST["email"];
	$concept = $_POST["concept"];
	$amount = $_POST["amount"];
	$dir = '/var/www/html/facturas';

	$charge = Conekta_Charge::create(array(
		  'description'=> 'Fanbot Plan',
		  'reference_id'=> '01',
		  'amount'=> $amount. '00',
		  'currency'=>'MXN',
		  'bank'=> array(
		    'type'=> 'spei'
		  ),
		  'details'=> array(
		    'name'=> $name,
//		    'phone'=> '3311703904',
		    'email'=> $email,
		    'customer'=> array(
		    ),
		    'line_items'=> array(
		      array(
		        'name'=> 'Fanbot plan mensual',
		        'description'=> $concept,
		        'unit_price'=> $amount . '00',
		        'quantity'=> 1,
		        'sku'=> '750',
		        'category'=> 'Interacción'
		      )
		    ),
		    'billing_address'=> array(
		    )
		  )
		));

		echo'"Nombre":"'. $name . '"';
		echo '{';
		echo'"Nombre":"'. $charge->details["name"] . '"';
		echo ',';
		echo'"Email":"'. $charge->details["email"] . '"';
		echo ',';
		echo'"Concepto":"'. $charge->details["line_items"][0]["description"] . '"';
		echo ',';
		echo'"Cantidad":"'. $charge->amount. '"';
		echo ',';
		echo'"CLABE":"'. $charge->payment_method->clabe . '"';
		echo '}';
	echo '<br>';


	if (!file_exists($dir) && !is_dir($dir)) {
		    mkdir($dir);         
	} 	

	if (move_uploaded_file($_FILES['xmlfile']['tmp_name'], $dir. $email . '-' . $charge->payment_method->clabe . '-factura.xml')) {
	    echo "El fichero es válido y se subió con éxito.\n";
	} else {
	    echo "¡Posible ataque de subida de ficheros!\n";
	}
	
	echo 'Más información de depuración:';
	print_r($_FILES);
	echo '<br>';




	$url = 'https://api.mailgun.net/v3/sandboxc6096d8d59f642b5bc1a911563713e7a.mailgun.org/messages';
	$apiKey = 'key-32a9dbf6ba9b0f7f77e8eed25137ea70'; 
	$params = array(
	    'to'        => $email,
	    'subject'   => 'Test of file sends',
	    'html'      => '<p> the HTML </p>',
	    'text'      => 'the plain text',
	    'from'      => 'Ventas Fanbot <pedrocch@fanbot.me>',
	    'attachment' => '@'.$_FILES['xmlfile']['tmp_name']
	  );
	
	print_r($params);
	echo '<br>';
	
	// Generate curl request
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $apiKey);		
	// Tell curl to use HTTP POST
	curl_setopt ($ch, CURLOPT_POST, true);

	// Tell curl that this is the body of the POST
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
	
	// Tell curl not to return headers, but do return the response
	curl_setopt($ch, CURLOPT_HEADER, false);
	// Tell PHP not to use SSLv3 (instead opting for TLS)
	curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	// obtain response
	$response = curl_exec($ch);
	curl_close($ch);
	
	// print everything out
	print_r($response);
	echo '<br>';

?>