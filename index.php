<?php 
	include "resources/functions.php"; 
	
	if (isLogged()){
		header("location: ./dashboard.php");
		exit();
		} else {
		header("location: ./login.php");
		exit();
	}			
		
?> 
