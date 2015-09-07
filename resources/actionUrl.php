<?php
include "functions.php"; 

function functionNode(){

		if (isset($_POST['particleId'])){ 
			return addFanbot();
		} else if (isset($_POST['paidStatus'])) { 
			return 2;
		} else if (isset($_POST['mode'])){
			return 3;
		} else if (isset($_POST['facebookPage'])){
			return 4;
		} else 0;
}


$numero = functionNode();
switch($numero){
	case 1: addFanbot();
		break;
	case 2: editPaid();
		break;
	case 3: addClient();
		break;
	case 4: changeFacebookPage();
}

?>