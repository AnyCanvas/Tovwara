<?php
if (isset($_POST['name'])) {

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
		
		$sql = "SELECT * FROM fanbot WHERE name = '". $_POST['name'] ."' ";
		$result = $conn->query($sql);

		$conn->close();
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) {
			    			        
		        $accesToken = $row["accesToken"];
		        $deviceId = $row["deviceId"];

			    }
			 fanbotAction($deviceId, $accesToken);
			 			    
			} else {


			}
	}		


	function fanbotAction($deviceId, $accesToken){
		
		$ip = 'api.particle.io';	
				$ch = curl_init("https://". $ip ."/v1/devices/". $deviceId.  "/led?access_token=". $accesToken);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "params=D7,HIGH");
				curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$output = curl_exec($ch);
				curl_close($ch);
	
	}
?>