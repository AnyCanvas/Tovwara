	<?php 
		// Check if user is logged in 
		include "../resources/functions.php"; 	

		if (!isLogged()){
			exit;
		}	


		if($_SESSION['userId'] !== 00){
			likesJson(date("m"),date("Y"),0,0);
		} if( isset($_GET["fnbtId"]) && isset($_GET["clientId"])){
			likesJson(date("m"),date("Y"),$_GET["fnbtId"],$_GET["clientId"]);				
		} else if( isset($_GET["fnbtId"]) ){
			likesJson(date("m"),date("Y"),$_GET["fnbtId"],0);				
		}else if( isset($_GET["clientId"]) ){
			likesJson(date("m"),date("Y"),0,$_GET["clientId"]);				
		} else{
			likesJson(date("m"),date("Y"),0,0);
		}
	?> 
