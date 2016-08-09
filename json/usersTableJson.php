<?php
// Check if user is logged in
// sD = Start date, uG = User gender, Interaction type.

include "../resources/functions.php";

if (!isLogged())
{
	exit;
}

if
( isset($_GET["sd"]) && isset($_GET["ed"]))
{
	$sD = $_GET["sd"];
	$eD = $_GET["ed"];
} else
{
	$sD = 0;
	$eD = 0;
}

if
( isset($_GET["ug"]) )
{
	$uG = $_GET["ug"];
} else
{
	$uG = 0;
}

usersTableJson($_SESSION['userId'], $sD, $eD, $uG);

?>
