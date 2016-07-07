<?php
// Check if user is logged in
// sD = Start date, uG = User gender, Interaction type.

include "../resources/functions.php";

if (!isLogged())
{
	exit;
}

if
( isset($_GET["sD"]) && isset($_GET["eD"]))
{
	$sD = $_GET["sD"];
	$eD = $_GET["eD"];
} else
{
	$sD = $eD = 0;
}

if
( isset($_GET["uG"]) )
{
	$uG = $_GET["uG"];
} else
{
	$uG = 0;
}

usersTableJson($_SESSION['userId'], $sD, $eD, $uG);

?>
