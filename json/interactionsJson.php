	<?php 
		include "../resources/functions.php"; 	

		if($_SESSION['userId'] !== '00'){
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
