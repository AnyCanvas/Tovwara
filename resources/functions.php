<?php 
	if((@include 'phpSpark.class.php') === false)  die("Unable to load phpSpark class");
	if((@include 'phpSpark.config.php') === false)  die("Unable to load phpSpark configuration file");
	
	// Check if user is logged in 
	function isLogged(){
		session_start();
		if(!isset($_SESSION["userId"])){
				header("location:./login.php");
		}
	}
	
	
	// Logout user
	function logOut(){
		session_start();
		session_destroy();
	}

	
	function printLikesChar(){

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
		
		if($_SESSION['userId'] == '00'){
			$sql = "SELECT * FROM interactions";
		}else {
			$sql = "SELECT * FROM interactions WHERE clientId = '". $_SESSION['userId']. "'";
		}

		$result = $conn->query($sql);
		
		if ($result->num_rows > 1) {
			$i = 1;

			while($row = $result->fetch_assoc()) {		    

			    $likesArray[$i]['fanbotId'] = $row["fanbotId"];
			    $likesArray[$i]['clientId'] = $row["clientId"];
			    $likesArray[$i]['date'] = $row["date"];
			    $i++;
			}
				
			} else {

			}
		$conn->close();

	}
	
	function getLikesGraph($month,$year){

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
		

    }

	$conn->close();
	
}

	function isFanbotOnline($token, $id){

	$spark = new phpSpark();
	

	$spark->setAccessToken($token);
	
	if($spark->getDeviceInfo($id) == true)
	{
	    $fanbot = $spark->getResult();
	}
	else
	{
	    $spark->debug("Error: " . $spark->getError());
	    $spark->debug("Error Source" . $spark->getErrorSource());
	}

		$connectedSpark = $fanbot["connected"] ;
	
		echo '<span class="label label-mini ';
		if ($connectedSpark){
			echo 'label-success"><span class="fa fa-circle" aria-hidden="true">';
		} else {
			echo 'label-default"><span class="fa fa-circle-o" aria-hidden="true">';
		}
		if ($connectedSpark){
			echo ' Conectada';
		} else {
			echo ' Desconectada';

		}

		echo '</span>';
		
	}

	function listFnbt(){	
			
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
		
		$sql = "SELECT * FROM fanbot WHERE clientId = '". $_SESSION['userId']. "'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) { ?>
			    			
							<tr>
                                <td><?php echo $row['name']?></td>
                                <td class="hidden-phone"><?php echo $row['id']?></td>
                                <td><?php echo $row['plan']?> </td>
                                <td><span class="label label-primary label-mini"><?php isFanbotOnline($row['accesToken'], $row['deviceId']); ?></span></td>
                                <td>
                                    <div class="progress progress-striped progress-xs">
                                        <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                                            <span class="sr-only">40% Complete (success)</span>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td><a class="btn btn-default btn-xs" data-toggle="modal" data-target="#configModal">Configurar</a></td>

                            </tr>


<?php			    }
			    return TRUE;	
			} else {
				return FALSE;

			}
		$conn->close();

	}	
	
		function listInteractions(){	
			
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

?>