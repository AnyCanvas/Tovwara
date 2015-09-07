<?php

if (isset($_SESSION["userId"])){

			$numero = functionNode();
			echo $numero;
			
		}


function functionNode(){

		if (isset($_POST['particleId'])){ 
			return 1;
		}
		
		if (isset($_POST['paidStatus'])) { 
			return 2;
		}
		
		if (isset($_POST['console'])){
			return 3;
		}
}

echo "enter";


?>