<?php
// Analizar la información del evento en forma de json
$body = @file_get_contents('php://input');
$charge = json_decode($body,true);


//if ($charge->type == 'charge.paid'){
 
	if ( $charge['data']['object']['payment_method']['type'] == 'spei' && $charge['data']['object']['status'] == 'paid'){

		$url = 'https://api.mailgun.net/v3/mg.fanbot.me/messages';
		$apiKey = 'key-32a9dbf6ba9b0f7f77e8eed25137ea70'; 
		$text = '<p>Hola,</p>

<p>Tu pago con CLABE: '. $charge['data']['object']['payment_method']['clabe'] .' por la cantidad de: '. ($charge['data']['object']['amount'] / 100) .' ha sido realizado exitosamente. Ahora puedes seguir disfrutando de Fanbot.</p>

<p>Muchas gracias por el interés en nuestros servicios.</p>

<p>Para mayor información comunícate al tel: (33) 1816-6873 o envíanos un correo a pagos@fanbot.me</p>

<p>Consulta el Aviso de Privacidad en: http://fanbot.me/aviso-de-privacidad/</p>';
		
		$params = array(
		    'to'        => $charge['data']['object']['details']['email'],
		    'bcc'       => 'alvaro@fanbot.me',
		    'subject'   => 'Pago de tu Fanbot exitoso',
		    'html'      => $text,
	//	    'text'      => 'the plain text',
		    'from'      => 'Ventas Fanbot <ventas@fanbot.me>',
		  );
		
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
		
	}
//}

?>