	<?php 
		include "../resources/functions.php"; 		
		if( isset($_POST["startDate"]) ){
			$string = $_POST["startDate"];
			$timestamp = strtotime($string);
			$m = date("m", $timestamp);
			$y = date("y", $timestamp);
			echo ($m.$y);
			echo $_POST["fanbotId"];
			totalJson(date(5),date($y),$_POST["fanbotId"],0);
		} else if( isset($_GET["fnbtId"]) && isset($_GET["clientId"])){
			totalJson(date("m"),date("Y"),$_GET["fnbtId"],$_GET["clientId"]);				
		} else if( isset($_GET["fnbtId"]) ){
			totalJson(date("m"),date("Y"),$_GET["fnbtId"],0);				
		}else if( isset($_GET["clientId"]) ){
			totalJson(date("m"),date("Y"),0,$_GET["clientId"]);				
		} else{
			totalJson(date("m"),date("Y"),0,0);
		}
	?> 
