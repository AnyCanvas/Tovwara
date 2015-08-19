<?php

$servername="localhost"; // Host name 
$username="Dev"; // Mysql username 
$password="\"TRFBMIsCWh{19"; // Mysql password 
$dbname="fanbot_db"; // Database name 


// Connect to server and select databse.
$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

// username and password sent from form 
$myusername=$_POST['username']; 
$mypassword= md5($_POST['password']); 



$sql="SELECT * FROM accounts WHERE username='$myusername' and password='$mypassword'";
$result = $conn->query($sql);

// Mysql_num_row is counting table row
		if ($result->num_rows > 0) {		    
		session_start();  
	    while($row = $result->fetch_assoc()) {
		    			        
			$_SESSION['userId'] = $row["clientId"];
		    }
			header("location:../index.php");

		} else {
			header("location:../login.php");

		}
$conn->close();

?>