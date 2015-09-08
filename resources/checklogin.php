<?php

	require(realpath(dirname(__FILE__) . "/./config.php"));
    $servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];


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
			header("location:../dashboard.php");

		} else {
			header("location:../index.php");

		}
$conn->close();

?>