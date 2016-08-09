	<?php
// Check if user is logged in
// sD = Start date, eD = End date, Interaction type.
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
	$sD = $eD = 0;
}

if
( isset($_GET["it"]) )
{
	$iT = $_GET["it"];
} else
{
	$iT = 0;
}

interactionsTableJson($_SESSION['userId'], $sD, $eD, $iT);
?>
