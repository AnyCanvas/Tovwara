<?php 
	include "resources/functions.php"; 
	
	if (isLogged()){
		header("location: ./dashboard.php");
		} else {
		header("location: ./login.php");
	}			
		
?> 
