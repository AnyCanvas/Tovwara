<?php
	if (isset($_POST['name'])) {
	session_start();
		
			if(!(isset( $_SESSION['actionInterval'] ))){
				$_SESSION['actionInterval'] = time();
			} else {
				if ( time() - $_SESSION['actionInterval'] > 60 * 5 || $_SESSION['userId'] == 00){
					$_SESSION['actionInterval'] = time();
				} else {
					exit("Tienes que esperar 5 minutos para activar de nuevo la maquina \n");
				}
			}
			
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
			
			$sql = "SELECT * FROM fanbot WHERE name = '". $_POST['name'] ."' ";
			$result = $conn->query($sql);
	
			$conn->close();
			
			if ($result->num_rows > 0) {		    
			    while($row = $result->fetch_assoc()) {
				    			        
			        $accesToken = $row["accesToken"];
			        $deviceId = $row["deviceId"];
	
				    }
				 fanbotAction($deviceId, $accesToken);
				 echo ("Se activo un la fanbot");
				 			    
				} else {
	
	
				}
		}		
		
		echo "Se realizo la accion ". time() . ' '. $_SESSION['actionInterval'];
	
	
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