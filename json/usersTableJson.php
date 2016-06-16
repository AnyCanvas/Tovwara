	<?php 
		// Check if user is logged in 
		include "../resources/functions.php"; 	

		if (!isLogged()){
			exit;
		}	
		
		if( isset($_GET["sD"]) && isset($_GET["eD"])){
			$startDate = $_GET["sD"];
			$endDate = $_GET["eD"];
		}

		if( isset($_GET["g"]) ){
			$gender = $_GET["g"];
		}
		usersTableJson($_SESSION['userId']);
	?> 
