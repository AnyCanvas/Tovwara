	<?php
// Check if user is logged in
// sD = Start date, eD = End date, Interaction type.
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
( isset($_GET["iT"]) )
{
	$iT = $_GET["iT"];
} else
{
	$iT = 0;
}

interactionsTableJson($_SESSION['userId'], $sD, $eD, $iT);
?>
