<?php
// Check if user is logged in 
include "../resources/functions.php"; 	

// if (!isLogged()){
// 	exit;
// }	
$ch = curl_init("https://api.particle.io/v1/devices/?access_token=8f143ea31dd63ec40437558c3d352b560a2dfcd4");
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

$fanbotList = json_decode($output, true);

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

if
($_SESSION['userId'] == '00')
{
    $sql = "SELECT * FROM fanbot";
}else
{
    $sql = "SELECT * FROM fanbot WHERE clientId = '". $_SESSION['userId']. "'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    while
    ($row = $result->fetch_assoc())
    {
        $config = json_decode($row["config"], true);
		echo $row['id'];
		if( $_SESSION['userId'] !== '00'){
			echo $row['name'];
        } else {
			echo $row['name'];
		} 
			echo $config['link'];
            switch ($row['plan'])
                {
                case '00':
                    echo "AWESOMERANDOM";
                    break;
                case '01':
                    echo "BASIC";
                    break;
                case '02':
                    echo "PRO";
                    break;
                case '03':
                    echo "PREMIUM";
                    break;
                }
				echo '<span class="label label-mini ';
                $id = $row['deviceId'];
                $key = array_search($id, array_column($fanbotList, "id"));
                if( $fanbotList[$key]["connected"]){
                    echo 'label-success"><span class="fa fa-circle" aria-hidden="true">';
                } else {
                    echo 'label-default"><span class="fa fa-circle-o" aria-hidden="true">';
                }
                if( $fanbotList[$key]["connected"]){
                     echo ' Conectada';
                } else{
                    echo ' Desconectada';
                }
				echo '</span>';
                            $timezone = $_SESSION['time'];
                            $datetime = new DateTime($fanbotList[$key]["last_heard"]);
                            $orderDate = $datetime->format('ymd');
                            echo '<span style="display: none;">'. $orderDate .'</span>'. $datetime->format('d-m-Y H:i');
				}


            }
            $conn->close();

?>