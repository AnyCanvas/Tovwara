<?php
	include "resources/functions.php"; 
		
	$fnbtName  = htmlspecialchars($_POST["fanbotName"]);
	$fbPage  = htmlspecialchars($_POST["facebookPage"]);

				
	$servername="localhost"; // Host name 
	$username="Dev"; // Mysql username 
	$password="\"TRFBMIsCWh{19"; // Mysql password 
	$dbname="fanbot_db"; // Database name 

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "UPDATE fanbot SET fbPage ='". $fbPage ."' WHERE name = '". $fnbtName."'";
	
	if ($conn->query($sql) === TRUE) {
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$conn->close();

?>