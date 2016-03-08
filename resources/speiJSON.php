
<?php
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");
	
	$charge = Conekta_Charge::create(array(
		  'description'=> 'Fanbot Plan',
		  'reference_id'=> '01',
		  'amount'=> 75000,
		  'currency'=>'MXN',
		  'bank'=> array(
		    'type'=> 'spei'
		  ),
		  'details'=> array(
		    'name'=> 'Juan Pedro Casillas',
		    'phone'=> '3311703904',
		    'email'=> 'pedrocch@fanbot.me',
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
		        'name'=> 'Fanbot plan mensual',
		        'description'=> 'Plan por 750 interacciones',
		        'unit_price'=> 75000,
		        'quantity'=> 1,
		        'sku'=> '750',
		        'category'=> 'Interacción'
		      )
		    ),
		    'billing_address'=> array(
		      'street1'=>'Agricultores 5433',
		      'street2'=> 'Arcos de Guadalupe',
		      'street3'=> null,
		      'city'=> 'Zapopan',
		      'state'=>'Jalisco',
		      'zip'=> '45030',
		      'country'=> 'Mexico',
		      'tax_id'=> 'xmn671212drx',
		      'company_name'=>'AnyCanvas Inc.',
		      'phone'=> '3311703004',
		      'email'=> 'pedrocch@fanbot.me'
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