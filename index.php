<?php 
	include "resources/functions.php"; 
	
	if (isLogged()){
		require_once("dashboard.php");
	} else {
		require_once("login.php");		
	}			
		
?> 
