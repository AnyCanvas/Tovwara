	<?php 
		// Check if user is logged in 
		include "../resources/functions.php"; 	

		if (!isLogged()){
			exit;
		}	

		if( isset($_GET["m"]) ){
			$m = $_GET["m"];
		} else {
			$m = date("m");
		}

		if( isset($_GET["y"]) ){
			$y = $_GET["y"];
		} else {
			$y = date("Y");
		}

		if($_SESSION['userId'] !== '00'){
			likesJson($m,$y,0,$_SESSION['userId']);
		}  else if( isset($_GET["fnbtId"]) && isset($_GET["clientId"])){
			likesJson($m,$y,$_GET["fnbtId"],$_GET["clientId"]);				
		} else if( isset($_GET["fnbtId"]) ){
			likesJson($m,$y,$_GET["fnbtId"],0);				
		}else if( isset($_GET["clientId"]) ){
			likesJson(date("m"),date("Y"),0,$_GET["clientId"]);				
		} else{
			likesJson($m,$y,0,0);
		}
	?> 
