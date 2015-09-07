<?php

if (isset($_SESSION["userId"])){

			echo functionNode();
			
		}


function functionNode(){

		if (isset($_POST['particleId'])){ 
			return 1;
		}
		
		if (isset($_POST['paidStatus'])) { 
			return 2;
		}
		
		if (isset($_POST['paidStatus'])){
			
		}
}





?>