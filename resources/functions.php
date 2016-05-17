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

function totalJson($day,$month,$year,$fnbtId,$clientId){

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

	if ($day !== 0){
		$string = $year.'-'.$month.'-'.$day;
		$sql= "SELECT * FROM interactions WHERE date >= (STR_TO_DATE('".$string."', '%Y-%m-%d')) AND date <= (STR_TO_DATE('".$string."', '%Y-%m-%d') + INTERVAL 1 MONTH) AND fanbotId='".$fnbtId."'";
	} else if( ($fnbtId !== 0) && ($clientId !== 0) ){
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND fanbotId='".$fnbtId."' AND clientId='".$clientId."'";
	} else if( $fnbtId !== 0 ){
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND fanbotId='".$fnbtId."'";
	}else if( $clientId !== 0 ){
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND clientId='".$clientId."'"; 
	} else{
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."'"; 
	}
	$result = $conn->query($sql);
	$total = 0;
	$like = 0;
	$checkin = 0;
	$i = 1;
	if ($result->num_rows > 0) {		    

		while($row = $result->fetch_assoc()) {
			$total++;			
			if($row['action'] == 'like'){
			   $like++;						 	
			} else if($row['action'] == 'post') {
			   $checkin++; 	
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
	echo('"Check\-in":[');
	echo $checkin;
	echo(']');	
	echo('}');

	$conn->close();
	
}

function likesJson($month,$year,$fnbtId,$clientId){

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

	if( ($fnbtId !== 0) && ($clientId !== 0) ){
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND fanbotId='".$fnbtId."' AND clientId='".$clientId."'";
	} else if( $fnbtId !== 0 ){
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND fanbotId='".$fnbtId."'";
	}else if( $clientId !== 0 ){
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."' AND clientId='".$clientId."'"; 
	} else{
		$sql = "SELECT * FROM interactions WHERE EXTRACT(MONTH FROM date) = '". $month. "' AND EXTRACT(YEAR FROM date) = '". $year."'"; 
	}

	$result = $conn->query($sql);
	$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
	$dayArray = array();
	$likeArray = array();
	$postArray = array();
	$i = 1;
	for($i = 1; $i <= $daysInMonth; $i++){
		$dayArray[$i] = 0;
    	$likeArray[$i] = 0;
	    $postArray[$i] = 0;
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
				 	
				 	if($row['action'] == 'like'){
						$likeArray[$i]++;						 	
				 	} else if($row['action'] == 'post') {
						$postArray[$i]++; 	
				 	}

		    	}
			}
		}	
	}
	
	echo("{");

	echo('"Total":[0,');
	for($i = 1; $i <= $daysInMonth; $i++){
		if (isset($dayArray[$i])) {
			echo $dayArray[$i];
		} else {
			echo 0;
		}
		if ($daysInMonth > $i) {
			echo ', ';
		}
		
		}
	echo('],');

	echo('"Likes":[0,');
	for($i = 1; $i <= $daysInMonth; $i++){
		if (isset($likeArray[$i])) {
			echo $likeArray[$i];
		} else {
			echo 0;
		}
		if ($daysInMonth > $i) {
			echo ', ';
		}
		
		}
	echo('],');	
	echo('"Check\-in":[0,');
	for($i = 1; $i <= $daysInMonth; $i++){
		if (isset($postArray[$i])) {
			echo $postArray[$i];
		} else {
			echo 0;
		}
		if ($daysInMonth > $i) {
			echo ', ';
		}
		
		}
	echo(']');	
	echo('}');

	$conn->close();
	
}	

function listInteractions(){
	
	
		?> 
		<div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Mis Fanbot</h4>
	                    </div>
                    <table  class="table" id="actionsTable">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                        <th>Pagina de Facebook</th>
                        <th>Fanbot</th>
                    </tr>
                    </thead>

                    <tbody>
		
		<?php	
			
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
			$sql = "SELECT t2.fbID, t2.fbName, t2.id, t1.fbPage , t1.action, t1.date, t1.fanbotId FROM interactions t1, users t2 WHERE t1.userId = t2.fbID ORDER by t1.`date` DESC;";
			}else{
			$sql = "SELECT t2.fbName, t2.id, t1.fbPage , t1.action, t1.date, t1.fanbotId FROM interactions t1, users t2 WHERE t1.userId = t2.fbID AND t1.`clientId`=". $_SESSION['userId']. " ORDER by t1.`date` DESC;";

		}
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) { 
				
				echo  "\t\t\t". '<tr class="gradeX">'. "\r\n";
				
				// Create a new date var from date in db
				$date =new DateTime($row['date']);
				// Get de number of day from the date variable
				$formatedDate = $date->format('d/m/y');
				$formatedHour = $date->format('g:i a');		
				$orderDate = $date->format('U');
				
				echo "\t\t\t". '<td data-order='. (1/$orderDate) .'">'. $formatedDate. '</td>'. "\r\n";
				echo "\t\t\t". '<td>'. $formatedHour. '</td>'. "\r\n";
				echo "\t\t\t". '<td>'. $row['id'] .'</td>'. "\r\n";				
				echo "\t\t\t". '<td><a href="http://facebook.com/'. $row['fbID'] .'" target="_blank">'. $row['fbName'] .'</a></td>'. "\r\n";
			    echo "\t\t\t". '<td>'.$row['action']. '</td>'. "\r\n";
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
		
		?>
		                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                        <th>Pagina de Facebook</th>
                        <th>Fanbot</th>
                    </tr>
                    </tfoot>
                    </table>
                    </div>
                </section>
            </div>
        </div>
		<?php

	}	
	
function listUsers(){
	
	
		?> 
		<div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Mis Fanbot</h4>
	                    </div>
                    <table  class="table" id="actionsTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>Likes</th>
                        <th>Check-in</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
		
		<?php	
			
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
			$sql = "SELECT  COUNT(t2.fbId), COUNT(CASE WHEN t1.action = 'post' THEN +1 END), COUNT(CASE WHEN t1.action = 'like' THEN +1 END), t2.id, t2.firstName,t2.lastName, t2.fbId, t2.email, t2.gender FROM interactions t1, users t2 WHERE t1.userId = t2.fbID GROUP BY t2.fbId;";
			}else{
			$sql = "SELECT COUNT(t2.fbId), COUNT(CASE WHEN t1.action = 'post' THEN +1 END), COUNT(CASE WHEN t1.action = 'like' THEN +1 END), t2.id, t2.firstName,t2.lastName, t2.fbId, t2.email, t2.gender FROM interactions t1, users t2 WHERE t1.userId = t2.fbID AND t1.clientId=" . $_SESSION['userId']. "  GROUP BY t2.fbId;";

		}
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) { 
				
				echo  "\t\t\t". '<tr class="gradeX">'. "\r\n";

				echo "\t\t\t". '<td>'. $row['id'] .'</td>'. "\r\n";
				echo "\t\t\t". '<td><a href="http://facebook.com/'. $row['fbId'] .'" target="_blank">'. $row['firstName'] .'</a></td>'. "\r\n";
				echo "\t\t\t". '<td>'. $row['lastName'] .'</td>'. "\r\n";
			    echo "\t\t\t". '<td>'.$row['email']. '</td>'. "\r\n";
			    echo "\t\t\t". '<td>'.$row['gender']. '</td>'. "\r\n";
				echo "\t\t\t". '<td>'. $row['COUNT(CASE WHEN t1.action = \'like\' THEN +1 END)'] . '</td>'. "\r\n";
				echo "\t\t\t". '<td>'. $row['COUNT(CASE WHEN t1.action = \'post\' THEN +1 END)'] . '</td>'. "\r\n";
				echo "\t\t\t". '<td>'. $row['COUNT(t2.fbId)'] . '</td>'. "\r\n";

			    echo "\t\t    ".'</tr>'. "\r\n";
			}
			    return TRUE;	
			} else {
				echo "Empty query";
				return FALSE;

			}
		$conn->close();
		
		?>
		                    </tbody>

                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>Likes</th>
                        <th>Check-in</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    </table>
                    </div>
                </section>
            </div>
        </div>
		<?php

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

	$fnbtName  = $_POST["fanbotName"];
	$actionType  = $_POST["actionType"];

	$facebookPage  = $_POST["facebookPage"];

				
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


		$sql = "SELECT * FROM fanbot WHERE name = '". $fnbtName ."' ";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {		    
		    while($row = $result->fetch_assoc()) {
			    			        
		        $config = json_decode($row["config"], true);

			    }

			} else {

			}
		
		$config['link'] = $facebookPage;
		$config['type'] = $actionType;
		$configJson = json_encode($config);
	    
		$sql = "UPDATE fanbot SET config ='". $configJson ."' WHERE name = '". $fnbtName ."'";
		
		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
		
		echo("done");
}

	function sendMail($color){

		switch ($color){
			case '1': $texto = file_get_contents('buenfin/amarilla.txt', "r");
				break;
			case '2': $texto = file_get_contents('buenfin/verde.txt', "r");
				break;
			case '3': $texto = file_get_contents('buenfin/azul.txt', "r");
				break;
			default; $texto = file_get_contents('buenfin/amarilla.txt', "r");
				break;
		}
		

		$para      = $_SESSION['fbUser']['email']. '.btag.it';
		$titulo    = 'Tu premio Fanbot';
		$mensaje   = $texto;
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: Gerardo Ruiz <gerardo@fanbot.me>' . "\r\n";


		mail($para, $titulo, $mensaje, $cabeceras);		
	}
	
	function sendGrid($color){

		switch ($color){
			case '1': $texto = file_get_contents('buenfin/amarilla.txt', "r");
				break;
			case '2': $texto = file_get_contents('buenfin/verde.txt', "r");
				break;
			case '3': $texto = file_get_contents('buenfin/azul.txt', "r");
				break;
			default; $texto = file_get_contents('buenfin/amarilla.txt', "r");
				break;
		}


		$url = 'https://api.sendgrid.com/';
		$user = 'PayTime';
		$pass = '?V53Q@*v';
		
		$params = array(
		    'api_user'  => $user,
		    'api_key'   => $pass,
		    'to'        => $_SESSION['fbUser']['email'],
		    'subject'   => 'Tu premio Fanbot',
		    'html'      => $texto,
		    'from'      => 'gerardo@fanbot.me',
		  );
		
		
		$request =  $url.'api/mail.send.json';
		
		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		
		// obtain response
		$response = curl_exec($session);
		curl_close($session);
		
		// print everything out
//		print_r($response);
	}
	
	
	function conektaSPEI(){
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


	function fileUpload(){
		//	if (move_uploaded_file($_FILES['xmlfile']['tmp_name'], '/var/www/html/factura.xml')) {
		//	    echo "El fichero es válido y se subió con éxito.\n";
		//	} else {
		//	    echo "¡Posible ataque de subida de ficheros!\n";
		//	}
		//	
		//	echo 'Más información de depuración:';
		//	print_r($_FILES);
	}
?>