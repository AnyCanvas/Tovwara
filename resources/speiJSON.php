
<?php
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");
	
	$name = $_POST["name"];
	$email = $_POST["email"];
	$conept = $_POST["concept"];
	$amount = $_POST["amount"];
	
	$charge = Conekta_Charge::create(array(
		  'description'=> 'Fanbot Plan',
		  'reference_id'=> '01',
		  'amount'=> $amount . '00',
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
?>