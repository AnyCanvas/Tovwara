	<?php 
		include "../resources/functions.php"; 	

		if (!isLogged()){
			exit;
		}			
		if($_SESSION['userId'] !== 00){
			totalJson(0,date("m"),date("Y"),0,$_SESSION['userId']);
		}  else if( isset($_POST["startDate"]) ){
			$string = $_POST["startDate"];
			$time = strtotime($string);
			$d = date("d", $time);
			$m = date("m", $time);
			$y = date("Y", $time);
			totalJson($d,$m,$y,$_POST["fanbotId"],0);
		} else if( isset($_GET["fnbtId"]) && isset($_GET["clientId"])){
			totalJson(0,date("m"),date("Y"),$_GET["fnbtId"],$_GET["clientId"]);				
		} else if( isset($_GET["fnbtId"]) ){
			totalJson(0,date("m"),date("Y"),$_GET["fnbtId"],0);				
		}else if( isset($_GET["clientId"]) ){
			totalJson(0,date("m"),date("Y"),0,$_GET["clientId"]);				
		} else{
			totalJson(0,date("m"),date("Y"),0,0);
		}
	?> 
