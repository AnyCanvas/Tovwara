<?php
	require(realpath(dirname(__FILE__) . "/./resources/config.php"));
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

	$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."'"; 

	$result = $conn->query($sql);
	print_r($result);
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
	


?>