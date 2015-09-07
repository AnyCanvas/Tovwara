<?php

function functionNode(){

		if (isset($_POST['particleId'])){ 
			return 1;
		} else if (isset($_POST['paidStatus'])) { 
			return 2;
		} else if (isset($_POST['mode'])){
			return 3;
		} else 0;
}



$numero = functionNode();
switch($numero){
	case 1: echo 1;
		break;
	case 2: echo 2;
		break;
	case 3: echo 3;
		break;
}


?>