<?php

// Check if user is logged in
function isLogged()
{
	session_start();
	if
	(isset($_SESSION["userId"]))
	{
		return 1;
	} else
	{
		return 0;
	}
}


// Logout user
function logOut()
{
	session_start();
	session_destroy();
}


function totalJson($day, $month, $year, $fnbtId, $clientId)
{

	require(realpath(dirname(__FILE__) . "/./config.php"));
	$servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM interactions WHERE";
	if ($day !== 0)
	{
		$string = $year.'-'.$month.'-'.$day;
		$sql .=  " date >= (STR_TO_DATE('".$string."', '%Y-%m-%d')) AND date <= (STR_TO_DATE('".$string."', '%Y-%m-%d') + INTERVAL 1 MONTH)";
	} else
	{
		$sql .= " EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."'";
	}

	if
	( $fnbtId !== 0 )
	{
		$sql .= " AND fanbotId='".$fnbtId."'";
	}

	if
	( $clientId !== 0 )
	{
		$sql .= " AND clientId='".$clientId."'";
	}

	$result = $conn->query($sql);
	$total = 0;
	$like = 0;
	$checkin = 0;
	$rate = 0;

	$i = 1;

	if ($result->num_rows > 0)
	{

		while
		($row = $result->fetch_assoc())
		{
			$total++;
			if
			($row['action'] == 'like')
			{
				$like++;
			} else if
				($row['action'] == 'post')
				{
					$checkin++;
			} else if
				($row['action'] == 'rate')
				{
					$rate++;
				}

		}
	}

	echo("{");

	echo('"Total":[');
	echo $total;
	echo('],');

	echo('"Likes":[');
	echo $like;
	echo('],');
	echo('"Check–in":[');
	echo $checkin;
	echo('],');
	echo('"Encuestas":[');
	echo $rate;
	echo(']');
	echo('}');

	$conn->close();

}


function monthlyLikesJson($year, $fnbtId, $clientId)
{

	require(realpath(dirname(__FILE__) . "/./config.php"));
	$servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM interactions WHERE EXTRACT(YEAR FROM date) = '". $year."'";

	if
	( $fnbtId !== 0 )
	{
		$sql = " AND fanbotId='".$fnbtId."'";
	}
	
	if
	( $clientId !== 0 )
	{
		$sql = " AND clientId='".$clientId."'";
	}

	$result = $conn->query($sql);
	$monthArray = array();
	$likeArray = array();
	$postArray = array();
	$rateArray = array();
	$i = 1;
	for
	($i = 1; $i <= 12; $i++)
	{
		$monthArray[$i] = 0;
		$likeArray[$i] = 0;
		$postArray[$i] = 0;
	}
	if ($result->num_rows > 0)
	{

		while
		($row = $result->fetch_assoc())
		{

			// Create a new date var from date in db
			$date =new DateTime($row['date']);
			// Get de number of day from the date variable
			$month = $date->format('m');
			// Create the array
			$i = 1;
			for
			($i = 1; $i <= 12; $i++)
			{
				if ($month == $i)
				{
					$dayArray[$i]++;

					if
					($row['action'] == 'like')
					{
						$likeArray[$i]++;
					} else if
						($row['action'] == 'post')
						{
							$postArray[$i]++;
						} else if
						($row['action'] == 'rate')
						{
							$rateArray[$i]++;
						} 

				}
			}
		}
	}

	echo("{");

	echo('"Total":[0,');
	for
	($i = 1; $i <= 12; $i++)
	{
		if (isset($dayArray[$i]))
		{
			echo $dayArray[$i];
		} else
		{
			echo 0;
		}
		if (12 > $i)
		{
			echo ', ';
		}

	}
	echo('],');

	echo('"Likes":[0,');
	for
	($i = 1; $i <= 12; $i++)
	{
		if (isset($likeArray[$i]))
		{
			echo $likeArray[$i];
		} else
		{
			echo 0;
		}
		if (12 > $i)
		{
			echo ', ';
		}

	}
	echo('],');
	echo('"Check–in":[0,');
	for
	($i = 1; $i <= 12; $i++)
	{
		if (isset($postArray[$i]))
		{
			echo $postArray[$i];
		} else
		{
			echo 0;
		}
		if (12 > $i)
		{
			echo ', ';
		}

	}
	echo('],');
	echo('"Encuesta":[0,');
	for
	($i = 1; $i <= 12; $i++)
	{
		if (isset($postArray[$i]))
		{
			echo $postArray[$i];
		} else
		{
			echo 0;
		}
		if (12 > $i)
		{
			echo ', ';
		}

	}
	echo(']');
	echo('}');

	$conn->close();

}

function rateJson()
{
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
		$sql = "SELECT * FROM interactions WHERE action = 'rate'";
	}else {
		$sql = "SELECT data FROM interactions WHERE clientId = '". $_SESSION['userId']. "' AND action = 'rate'";
	}

	$result = $conn->query($sql);
	
	$c = 0;
	if ($result->num_rows > 0) {		    
	    while($row = $result->fetch_assoc()) { 
		    $data = json_decode($row['data'], true);
			$A[$c] = $data['a'];
			$c++;
		}	   	
	}


	$A = array_count_values($A);

	echo ("{");

	if( !( isset($A[1]) ) ){
		echo ('"1 Estrella":[0],') ;		
	} else {
		echo ('"1  Estrella":['. $A[1] .'],') ;		
		
	}

	if( !( isset($A[2]) ) ){
		echo ('"2  Estrellas":[0],') ;		
	} else {
		echo ('"2  Estrellas":['. $A[2] .'],') ;		
		
	}

	if( !( isset($A[3]) ) ){
		echo ('"3  Estrellas":[0],') ;		
	} else {
		echo ('"3  Estrellas":['. $A[3] .'],') ;		
		
	}

	if( !( isset($A[4]) ) ){
		echo ('"4  Estrellas":[0],') ;		
	} else {
		echo ('"4  Estrellas":['. $A[4] .'],') ;		
		
	}
	
	if( !( isset($A[5]) ) ){
		echo ('"5 Estrellas":[0],') ;		
	} else {
		echo ('"5  Estrellas":['. $A[5]), ']' ;		
		
	}

	echo ("}");
	$conn->close();
}


function likesJson($month, $year, $fnbtId, $clientId)
{

	require(realpath(dirname(__FILE__) . "/./config.php"));
	$servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."'";

	if
	( $fnbtId !== 0 )
	{
		$sql .= " AND fanbotId='".$fnbtId."'";
	}
	if
	( $clientId !== 0 )
	{
		$sql .= " AND clientId='".$clientId."'";
	}

	$result = $conn->query($sql);
	$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
	$dayArray = array();
	$likeArray = array();
	$postArray = array();
	$rateArray = array();
	$i = 1;
	for
	($i = 1; $i <= $daysInMonth; $i++)
	{
		$dayArray[$i] = 0;
		$likeArray[$i] = 0;
		$postArray[$i] = 0;
		$rateArray[$i] = 0;
	}
	if ($result->num_rows > 0)
	{

		while
		($row = $result->fetch_assoc())
		{

			// Create a new date var from date in db
			$date =new DateTime($row['date']);
			// Get de number of day from the date variable
			$day = $date->format('d');
			// Create the array
			$i = 1;
			for
			($i = 1; $i <= $daysInMonth; $i++)
			{
				if ($day == $i)
				{
					$dayArray[$i]++;

					if
					($row['action'] == 'like')
					{
						$likeArray[$i]++;
					} else if
						($row['action'] == 'post')
						{
							$postArray[$i]++;
						} else if
						($row['action'] == 'rate')
						{
							$rateArray[$i]++;
						} 
				}
			}
		}
	}

	echo("{");

	echo('"Total":[0,');
	for
	($i = 1; $i <= $daysInMonth; $i++)
	{
		if (isset($dayArray[$i]))
		{
			echo $dayArray[$i];
		} else
		{
			echo 0;
		}
		if ($daysInMonth > $i)
		{
			echo ', ';
		}

	}
	echo('],');

	echo('"Likes":[0,');
	for
	($i = 1; $i <= $daysInMonth; $i++)
	{
		if (isset($likeArray[$i]))
		{
			echo $likeArray[$i];
		} else
		{
			echo 0;
		}
		if ($daysInMonth > $i)
		{
			echo ', ';
		}

	}
	echo('],');
	echo('"Check–in":[0,');
	for
	($i = 1; $i <= $daysInMonth; $i++)
	{
		if (isset($postArray[$i]))
		{
			echo $postArray[$i];
		} else
		{
			echo 0;
		}
		if ($daysInMonth > $i)
		{
			echo ', ';
		}

	}
	echo('],');
	echo('"Encuestas":[0,');
	for
	($i = 1; $i <= $daysInMonth; $i++)
	{
		if (isset($rateArray[$i]))
		{
			echo $rateArray[$i];
		} else
		{
			echo 0;
		}
		if ($daysInMonth > $i)
		{
			echo ', ';
		}

	}
	echo(']');
	echo('}');

	$conn->close();

}


function interactionsTableJson($userId, $sD, $eD, $iT)
{


	require(realpath(dirname(__FILE__) . "/./config.php"));
	$servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT t2.fbID, t2.fbName, t2.id, t1.fbPage , t1.action, t1.date, t1.fanbotId FROM interactions t1, users t2 WHERE t1.userId = t2.fbID";

	if ( $sD != 0 && $eD != 0)
	{
		$sql .=  " AND t1.date >= (STR_TO_DATE('".$sD."', '%Y-%m-%d')) AND t1.date <= (STR_TO_DATE('".$eD."', '%Y-%m-%d'))";
	}

	if ( $iT != 0)
	{
		if($iT == '1'){
			$iT = 'like';
		} else if($iT == '2'){
			$iT = 'post';
		} 
		$sql .= " AND t1.action='". $iT ."'";
	}


	if ( $userId != '00')
	{
		$sql .= " AND t1.`clientId`=". $userId;
	}

	$sql .= " ORDER by t1.`date` DESC;";
	$result = $conn->query($sql);


	echo  '{ "data": [';

	$i = 0;
	if ($result->num_rows > 0)
	{
		while
		($row = $result->fetch_assoc())
		{
			if ($i == 0)
			{
				$i++;
			} else
			{
				echo ',';
			}
			// Create a new date var from date in db
			$date =new DateTime($row['date']);
			// Get de number of day from the date variable
//			$formatedDate = $date->format('d/m/y');
//			$formatedHour = $date->format('g:i a');
			$unixDate = $date->format('U');

			echo '[ ';
			echo '"'. $unixDate . '", ';
			echo '"'. $unixDate . '", ';
			echo '"', $row['id'] .'", ';
			echo '"'. $row['fbName']. '", ';
			echo '"'. $row['fbID']. '", ';
			echo '"'. $row['action']. '", ';
			echo '"'. $row['fbPage']. '", ';
			echo '"'. $row['fanbotId']. '"';


			echo ' ]';
		}
		$conn->close();
		echo  '] }';
		return TRUE;
	} else
	{
		$conn->close();

		echo '[ ]';
		echo  '] }';

		return FALSE;

	}
}


function usersTableJson($userId, $sD, $eD, $uG)
{

	require(realpath(dirname(__FILE__) . "/./config.php"));
	$servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT  COUNT(t2.fbId), COUNT(CASE WHEN t1.action = 'post' THEN +1 END), COUNT(CASE WHEN t1.action = 'like' THEN +1 END), COUNT(CASE WHEN t1.action = 'rate' THEN +1 END), t2.id, t2.firstName,t2.lastName, t2.fbId, t2.email, t2.gender, t2.createdDate FROM interactions t1, users t2 WHERE t1.userId = t2.fbID";

	if ( $userId != '00')
	{
		$sql .= " AND t1.clientId=" . $userId;
	}

	if ( $sD != 0 && $eD != 0)
	{
		$sql .=  " AND t2.createdDate >= (STR_TO_DATE('".$sD."', '%Y-%m-%d')) AND t2.createdDate <= (STR_TO_DATE('".$eD."', '%Y-%m-%d'))";
	}


	if ( $uG != '0')
	{
		if ($uG == '1'){
			$uG = 'male';
		} else if (uG == '2'){
			$uG = 'female';
		} 
		$sql .= " AND t2.gender= '" . $uG . "'";
	}
	$sql .= " GROUP BY t2.fbId;";

	$result = $conn->query($sql);


	echo  '{ "data": [';

	$i = 0;
	if ($result->num_rows > 0)
	{
		while
		($row = $result->fetch_assoc())
		{
			if ($i == 0)
			{
				$i++;
			} else
			{
				echo ',';
			}
			// Create a new date var from date in db
			if ($row['createdDate'] != "")
			{
				$date =new DateTime($row['createdDate']);
				// Get de number of day from the date variable
				$unixDate = $date->format('U');
			} else
			{
				$unixDate = "";
			}

			echo '[ ';
			echo '"'. $row['id'] . '", ';
			echo '"'. $row['firstName'] .'", ';
			echo '"'. $row['lastName']. '", ';
			echo '"'. $row['fbId']. '", ';
			echo '"'. $row['email']. '", ';
			echo '"'. $row['gender']. '", ';
			echo '"'. $row['COUNT(CASE WHEN t1.action = \'like\' THEN +1 END)'] . '", ';
			echo '"'. $row['COUNT(CASE WHEN t1.action = \'post\' THEN +1 END)'] . '", ';
			echo '"'. $row['COUNT(CASE WHEN t1.action = \'rate\' THEN +1 END)'] . '", ';
			echo '"'. $row['COUNT(t2.fbId)'] . '", ';
			echo '"'. $unixDate . '"';


			echo ' ]';
		}
		$conn->close();
		echo  '] }';
		return TRUE;
	} else
	{
		$conn->close();
		echo '[ ]';
		echo  '] }';
		return FALSE;

	}
}


function addFanbot()
{

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
	if ($conn->connect_error)
	{
		die("Connection failed");
	}


	$sql = "INSERT INTO fanbot  (id, name, clientId, deviceId) VALUES ( '". $fanbotId. "','".  $fanbotName. "','". $fanbotClient. "','". $particleId. "')";

	if ($conn->query($sql) === TRUE)
	{
	} else
	{
		echo "Error";
	}

	$conn->close();
}


function addClient()
{

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
	if ($conn->connect_error)
	{
		die("Connection failed");
	}


	$sql = "INSERT INTO accounts  (clientId, name, username, password, mode) VALUES ( '". $clientId. "','".  $clientName. "','". $clientMail. "','". md5($clientPassword).  "','". $mode. "')";

	if ($conn->query($sql) === TRUE)
	{
	} else
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}


function editPaid()
{

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
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}


	$sql = "UPDATE fanbot SET courtDate = ". $courtDate ." , plan = ". $fanbotPlan .", freeMonth = ". $freeMonth .", estatus = ". $paidStatus ." WHERE id = '". $fanbotId ."'";

	if ($conn->query($sql) === TRUE)
	{
	} else
	{
		echo "Error";
	}

	$conn->close();
}


function changeFacebookPage()
{

	$fnbtName  = $_POST["fanbotName"];
	$actionType  = $_POST["actionType"];

	switch ($actionType){
		case '0': $actionType='like';
			break;

		case '1': $actionType='post';
			break;

		case '2': $actionType='rate';
			break;

	}
	$facebookPage  = $_POST["facebookPage"];

	if ($actionType == 'rate'){
		$q['1']  = $_POST["q1"];		
		$q['2']  = $_POST["q2"];		
		$q['3']  = $_POST["q3"];		
		$q['4']  = $_POST["q4"];		
	}


	require(realpath(dirname(__FILE__) . "/./config.php"));
	$servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}


	$sql = "SELECT * FROM fanbot WHERE name = '". $fnbtName ."' ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while
		($row = $result->fetch_assoc())
		{

			$config = json_decode($row["config"], true);

		}

	} else
	{

	}

	$config['link'] = $facebookPage;
	$config['type'] = $actionType;
	$configJson = json_encode($config);

	if ($actionType == 'rate'){
		$qJson = json_encode($q);
		$sql = "UPDATE fanbot SET config ='". $configJson ."', survey = '". $qJson ."' WHERE name = '". $fnbtName ."'";
	} else {
		$sql = "UPDATE fanbot SET config ='". $configJson ."' WHERE name = '". $fnbtName ."'";				
	}


	if ($conn->query($sql) === TRUE)
	{
	} else
	{
		echo "Error";
	}

	$conn->close();

	echo("done");
}


function changePrice()
{

	$fnbtName  = $_POST["fanbotName"];

		$p['1']  = $_POST["p1"];		
		$p['2']  = $_POST["p2"];		
		$p['3']  = $_POST["p3"];		
		$p['4']  = $_POST["p4"];		
		$p['5']  = $_POST["p5"];		
		$p['6']  = $_POST["p6"];		
		$p['7']  = $_POST["p7"];		
		$p['8']  = $_POST["p8"];		

	$bool = true;

	foreach ($p as $k => $v) {
	    if (empty($v)) {
	        $bool = false;
	    }
	}
	
	
	if( !($bool) ){
		$pJson = "NULL";

	} else {
		$pJson = json_encode($p);	
	}
	
	
	require(realpath(dirname(__FILE__) . "/./config.php"));
	$servername = $config["db"]["fanbot"]["host"];
	$username = $config["db"]["fanbot"]["username"];
	$password = $config["db"]["fanbot"]["password"];
	$dbname = $config["db"]["fanbot"]["dbname"];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}


	$sql = "UPDATE fanbot SET price ='". $pJson ."' WHERE name = '". $fnbtName ."'";


	if ($conn->query($sql) === TRUE)
	{
	} else
	{
		echo "Error";
	}

	$conn->close();

	echo("done");
}


function conektaSPEI()
{
	require_once("libraries/conekta/Conekta.php");
	Conekta::setApiKey("key_eYvWV7gSDkNYXsmr");

	$charge = Conekta_Charge::create(array(
			'description'=> 'Stogies',
			'reference_id'=> '9839-wolf_pack',
			'amount'=> 20000,
			'currency'=>'MXN',
			'bank'=> array(
				'type'=> 'spei'
			),
			'details'=> array(
				'name'=> 'Arnulfo Quimare',
				'phone'=> '403-342-0642',
				'email'=> 'logan@x-men.org',
				'customer'=> array(
					'logged_in'=> true,
					'successful_purchases'=> 14,
					'created_at'=> 1379784950,
					'updated_at'=> 1379784950,
					'offline_payments'=> 4,
					'score'=> 9
				),
				'line_items'=> array(
					array(
						'name'=> 'Box of Cohiba S1s',
						'description'=> 'Imported From Mex.',
						'unit_price'=> 20000,
						'quantity'=> 1,
						'sku'=> 'cohb_s1',
						'category'=> 'food'
					)
				),
				'billing_address'=> array(
					'street1'=>'77 Mystery Lane',
					'street2'=> 'Suite 124',
					'street3'=> null,
					'city'=> 'Darlington',
					'state'=>'NJ',
					'zip'=> '10192',
					'country'=> 'Mexico',
					'tax_id'=> 'xmn671212drx',
					'company_name'=>'X-Men Inc.',
					'phone'=> '77-777-7777',
					'email'=> 'purshasing@x-men.org'
				)
			)
		));

	print($charge->payment_method->clabe);
	print($charge->payment_method->bank);
}


function fileUpload()
{
	// if (move_uploaded_file($_FILES['xmlfile']['tmp_name'], '/var/www/html/factura.xml')) {
	//     echo "El fichero es válido y se subió con éxito.\n";
	// } else {
	//     echo "¡Posible ataque de subida de ficheros!\n";
	// }
	//
	// echo 'Más información de depuración:';
	// print_r($_FILES);
}


?>