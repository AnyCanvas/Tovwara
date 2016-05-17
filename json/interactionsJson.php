	<?php 
		// Check if user is logged in 
		function isLogged(){
			session_start();
			if(isset($_SESSION["userId"])){
					return 1;
			} else {
				return 0;
			}
		}

		include "../resources/functions.php"; 	

		if($_SESSION['userId'] !== 00){
			likesJson(date("m"),date("Y"),0,$_SESSION['userId']);
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
