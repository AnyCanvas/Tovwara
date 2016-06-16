<?php
// Check if user is logged in
include "../resources/functions.php";

if (!isLogged())
{
	exit;
}

if
( isset($_GET["sD"]) && isset($_GET["eD"]))
{
	$startDate = $_GET["sD"];
	$endDate = $_GET["eD"];
} else
{
	$startDate = $endDate = '';
}

if
( isset($_GET["g"]) )
{
	$gender = $_GET["g"];
} else
{
	$gender = '';
}

if ($startDate != '' && $endDate != '' && $gender != '')
{

} else if ( $startDate != '' && $endDate != '' )
	{
	usersTableJson($_SESSION['userId'], $startDate, $endDate, 0);
	} else if ( $gender != '' )
	{
		usersTableJson($_SESSION['userId'], 0, 0, $gender);
	} else
{
	usersTableJson($_SESSION['userId'], 0, 0, 0);
}
?>
