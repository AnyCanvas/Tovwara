<html lang="en">
<head>
    <meta charset="utf-8">
</head>

<body>
<?php

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
		
		$sql = "SELECT * FROM interactions WHERE clientId = '00'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) { 
				
				echo  '<tr class="gradeX">';
				
				// Create a new date var from date in db
				$date =new DateTime($row['date']);
				// Get de number of day from the date variable
				$formatedDate = $date->format('d/m/y');
				
				echo '<td>'. $formatedDate. '</td>';
				
				
			    $sql2 = "SELECT * FROM users WHERE fbID = '". $row['userId'] . "'";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {	
						    
				    while($row2 = $result2->fetch_assoc()) { 
						echo '<td>'.$row2['fbName'].'</td>';
						echo '<td>'.$row2['email'].'<td>';
						echo '<td>'.$row2['gender'].'</td>';
			    }
			    
			    }

			    echo '<td>'.$row['fbPage']. '</td>';
			    echo '<td>'.$row['fanbotId']. '</td>';
			    
			    
			    echo '</tr>'. "\r\n";
			}
			    return TRUE;	
			} else {
				echo "Empty query";
				return FALSE;

			}
		$conn->close();

	}	
	
	listInteractions();
?>
</body>
