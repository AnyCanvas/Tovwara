	<?php
// Check if user is logged in
// sD = Start date, eD = End date, Interaction type.
include "../resources/functions.php";

if (!isLogged())
{
	exit;
}

rateJson();
?>
