<?php
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");

	$name = $_POST["name"];
	$email = $_POST["email"];
	$conept = $_POST["concept"];
	$amount = $_POST["amount"];

	$dir_subida = '/var/www/html/';
	$fichero_subido = $dir_subida . basename($_FILES['xmlfile']);
	
	if (move_uploaded_file($_FILES['xmlfile'], $fichero_subido)) {
	    echo "El fichero es válido y se subió con éxito.\n";
	} else {
	    echo "¡Posible ataque de subida de ficheros!\n";
	}
	
	echo 'Más información de depuración:';
	print_r($_FILES);

	
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
?>