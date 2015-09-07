<?php 

	// Check if user is logged in 
	function isLogged(){
		session_start();
		if(isset($_SESSION["userId"])){
				return 1;
		} else {
			return 0;
		}
	}
	
	
	// Logout user
	function logOut(){
		session_start();
		session_destroy();
	}

	
	function getLikesGraph($month,$year){

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

		if($_SESSION['userId'] == '00'){
			$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."'"; 
			} else {
			$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND clientId = '". $_SESSION['userId']."'"; 
			}

	$result = $conn->query($sql);
	$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
	$dayArray = array();
	$i = 1;
	for($i = 1; $i <= $daysInMonth; $i++){
		$dayArray[$i] = 0;
		}
	if ($result->num_rows > 0) {		    

		    while($row = $result->fetch_assoc()) {

			// Create a new date var from date in db
			$date =new DateTime($row['date']);
			// Get de number of day from the date variable
			$day = $date->format('d');
			// Create the array 
			$i = 1;			
			for($i = 1; $i <= $daysInMonth; $i++){
				 if ($day == $i){
				 	$dayArray[$i]++;

		    	}
			}
		}	
	}

	for($i = 1; $i <= $daysInMonth; $i++){
		
		if (isset($dayArray[$i])) {
			echo "{ d: '".$i ."', l: ". $dayArray[$i] ." }";
			
		} else {
			echo "{ d: '".$i ."', l: ". 0 ." }";
			}

		if ($daysInMonth > $i) {
			echo ', ';
		}
		
		}

	$conn->close();
	
}	

function listInteractions(){	
			
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
		
		if ( $_SESSION['userId'] == 00){
			$sql = "SELECT * FROM interactions";
			}else{
			$sql = "SELECT * FROM interactions WHERE clientId = '". $_SESSION['userId']. "'";
		}
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) { 
				
				echo  "\t\t\t". '<tr class="gradeX">'. "\r\n";
				
				// Create a new date var from date in db
				$date =new DateTime($row['date']);
				// Get de number of day from the date variable
				$formatedDate = $date->format('d/m/y');
				
				echo "\t\t\t". '<td>'. $formatedDate. '</td>'. "\r\n";
				
				
			    $sql2 = "SELECT * FROM users WHERE fbID = '". $row['userId'] . "'";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {	
						    
				    while($row2 = $result2->fetch_assoc()) { 
						$email = $row2['email'];
						$gender =  $row2['gender'];
						$fbName = $row2['fbName'];


			    }
			    
			    }
						echo "\t\t\t". '<td>'.$fbName.'</td>'. "\r\n";
						echo "\t\t\t". '<td>'. $email.' </td>'. "\r\n";
						echo "\t\t\t". '<td>'.$gender.'</td>'. "\r\n";

			    echo "\t\t\t". '<td>'.$row['fbPage']. '</td>'. "\r\n";
			    echo "\t\t\t". '<td>'.$row['fanbotId']. '</td>'. "\r\n";
			    

			    echo "\t\t    ".'</tr>'. "\r\n";
			}
			    return TRUE;	
			} else {
				echo "Empty query";
				return FALSE;

			}
		$conn->close();

	}	

function addFanbot(){

	$fanbotId = $_POST['fanbotId'];
	$fanbotName = $_POST['fanbotName'];
	$fanbotClient = $_POST['fanbotClient'];
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
	$clientPassword = $_POST['password'];
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

			$sql = "INSERT INTO accounts  (clientId, name, username, password, mode) VALUES ( '". $clientId. "','".  $clientName. "','". $clientMail. "','". md5($clientPassword).  "','". $mode. "')";
			
			if ($conn->query($sql) === TRUE) {
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();
}	

function editPaid(){

	$fanbotId = $_POST['id'];
	$fanbotPlan = $_POST['fanbotPlan'];
	$courtDate = $_POST['courtDate'];
	$freeMonth = $_POST['freeMonth'];
	$paidStatus = $_POST['paidStatus'];

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

			$sql = "UPDATE fanbot SET courtDate = ". $courtDate ." , plan = ". $fanbotPlan .", freeMonth = ". $freeMonth .", estatus = ". $paidStatus ." WHERE id = '". $fanbotId ."'";
			
			if ($conn->query($sql) === TRUE) {
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();
}	

function changeFacebookPage(){

	$fnbtName  = htmlspecialchars($_POST["fanbotName"]);
	$fbPage  = htmlspecialchars($_POST["facebookPage"]);

				
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
	
		$sql = "UPDATE fanbot SET fbPage ='". $fbPage ."' WHERE name = '". $fnbtName."'";
		
		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();

}
?>