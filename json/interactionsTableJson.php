	<?php 
		// Check if user is logged in 
		include "../resources/functions.php"; 	

		if( isset($_GET["sD"]) && isset($_GET["eD"])){
			$startDate = $_GET["sD"];
			$endDate = $_GET["eD"];
		}

		if( isset($_GET["iT"]) ){
			$interactionType = $_GET["iT"];
		}

        interactionsTableJson($_SESSION['userId']);
	?> 
