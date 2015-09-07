<?php

function functionNode(){

		if (isset($_POST['particleId'])){ 
			return 1;
		} else if (isset($_POST['paidStatus'])) { 
			return 2;
		} else if (isset($_POST['console'])){
			return 3;
		}
}



			$numero = functionNode();
			echo $numero;



echo "enter";


?>