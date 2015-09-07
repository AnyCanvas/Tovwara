<?php

function functionNode(){

		if (isset($_POST['particleId'])){ 
			return addFanbot();
		} else if (isset($_POST['paidStatus'])) { 
			return 2;
		} else if (isset($_POST['mode'])){
			return 3;
		} else 0;
}

function addFanbot(){

	$fanbotId = $_POST['fanbotId'];
	$fanbotName = $_POST['fanbotName'];
	$fanbotClient = $_POST['fanbotId'];
	$particleId = $_POST['particleId'];

	require(realpath(dirname(__FILE__) . "/./config.php"));		
		$servername = $config["db"]["fanbot"]["host"];
		$username = $config["db"]["fanbot"]["username"];
		$password = $config["db"]["fanbot"]["password"];
		$dbname = $config["db"]["fanbot"]["dbname"];

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "INSERT INTO fanbot  (id, name, clientId, deviceId) VALUES ( '". $fanbotId. "','".  $fanbotName. "','". $fanbotClient. "','". $particleId. "')";
			
			if ($conn->query($sql) === TRUE) {
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();
}	

function addClient(){

	$clientId = $_POST['clientId'];
	$clientName = $_POST['clientName'];
	$clientMail = $_POST['clientMail'];
	$password = $_POST['password'];
	$mode = $_POST['mode'];

	require(realpath(dirname(__FILE__) . "/./config.php"));		
		$servername = $config["db"]["fanbot"]["host"];
		$username = $config["db"]["fanbot"]["username"];
		$password = $config["db"]["fanbot"]["password"];
		$dbname = $config["db"]["fanbot"]["dbname"];

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "INSERT INTO accounts  (clientId, name, username, password, mode) VALUES ( '". $clientId. "','".  $clientName. "','". $clientMail. "','". $password.  "','". $mode. "')";
			
			if ($conn->query($sql) === TRUE) {
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();
}	

$numero = functionNode();
switch($numero){
	case 1: addFanbot();
		break;
	case 2:
		break;
	case 3: addClient();
		break;
}

function editPaid(){
	
}
?>