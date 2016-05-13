	<?php 
		include "../resources/functions.php"; 		
		if( isset($_GET["fnbtId"]) && isset($_GET["clientId"])){
			totalJson(date("m"),date("Y"),$_GET["fnbtId"],$_GET["clientId"]);				
		} else if( isset($_GET["fnbtId"]) ){
			totalJson(date("m"),date("Y"),$_GET["fnbtId"],0);				
		}else if( isset($_GET["clientId"]) ){
			totalJson(date("m"),date("Y"),0,$_GET["clientId"]);				
		} else{
			totalJson(date("m"),date("Y"),0,0);
		}
	?> 
