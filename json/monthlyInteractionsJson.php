	<?php 
		// Check if user is logged in 
		include "../resources/functions.php"; 	

		if (!isLogged()){
			exit;
		}	

		if( isset($_GET["y"]) ){
			$y = $_GET["y"];
		} else {
			$y = date("Y");
		}

		if($_SESSION['userId'] !== '00'){
			monthlyLikesJson($y,0,$_SESSION['userId']);
		}  else if( isset($_GET["fnbtId"]) && isset($_GET["clientId"])){
			monthlyLikesJson($y,$_GET["fnbtId"],$_GET["clientId"]);				
		} else if( isset($_GET["fnbtId"]) ){
			monthlyLikesJson($y,$_GET["fnbtId"],0);				
		}else if( isset($_GET["clientId"]) ){
			monthlyLikesJson($y,0,$_GET["clientId"]);				
		} else{
			monthlyLikesJson($y,0,0);
		}
	?> 
