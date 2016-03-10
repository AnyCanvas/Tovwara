<?php
// Analizar la información del evento en forma de json
$body = @file_get_contents('php://input');
$event_json = json_decode($body);


if ($charge->type == 'charge.paid' && $charge->payment_method->type == 'spei'){
 
	$url = 'https://api.mailgun.net/v3/sandboxc6096d8d59f642b5bc1a911563713e7a.mailgun.org/messages';
	$apiKey = 'key-32a9dbf6ba9b0f7f77e8eed25137ea70'; 
	$text = 'Hola,

Tu pago con CLABE: (CLABE) por la cantidad de: (CANTIDAD) ha sido realizado exitosamente. Ahora puedes seguir disfrutando de Fanbot. 

Muchas gracias por el interés en nuestros servicios.

Para mayor información comunícate al tel: (33) 1816-6873 o envíanos un correo a pagos@fanbot.me 

Consulta el Aviso de Privacidad en: http://fanbot.me/aviso-de-privacidad/';
	$params = array(
	    'to'        => $charge->details["email"],
	    'bcc'       => 'alvaro@fanbot.me',
	    'subject'   => 'CLABE y Factura Fanbot',
	    'html'      => $text,
//	    'text'      => 'the plain text',
	    'from'      => 'Ventas Fanbot <ventas@fanbot.me>',
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
}

?>