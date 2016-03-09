<?php
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_nvJm2aBVNEd1qxPwxzzwrA");

	$name = $_POST["name"];
	$email = $_POST["email"];
	$conept = $_POST["concept"];
	$amount = $_POST["amount"];
	$xmlFile = $_POST["xmlFile"];

	$target_dir = "./";
	$target_file = $target_dir . basename($_FILES["xmlFile"]["name"]);
	$uploadOk = 1;
//	// Check if file already exists
//	if (file_exists($target_file)) {
//	    echo "Sorry, file already exists.";
//	    $uploadOk = 0;
//	}
//	// Check file size
//	if ($_FILES["fileToUpload"]["size"] > 500000) {
//	    echo "Sorry, your file is too large.";
//	    $uploadOk = 0;
//	}
//	// Allow certain file formats
//	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//	&& $imageFileType != "gif" ) {
//	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//	    $uploadOk = 0;
//	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["xmlFile"]["xmlFile"], $target_file)) {
	        echo "The file ". basename( $_FILES["xmlFile"]["xmlFile"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}


	
	$charge = Conekta_Charge::create(array(
		  'description'=> 'Fanbot Plan',
		  'reference_id'=> '01',
		  'amount'=> '75000',
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
?>