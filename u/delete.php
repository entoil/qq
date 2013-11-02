<?php

session_start();
include("header.php");
include("../config.inc");

?>

<header>QQ</header>
<section>

<?php

	$webid = $_SERVER['QUERY_STRING'];;

	$query = sprintf("SELECT * FROM `surveys` NATURAL JOIN `users` WHERE webid = '" . $webid . "' and username = '" . $user . "';");

	$result = mysql_query($query);

	if (mysql_num_rows($result) == 0) {	header("Location: .."); }

	$sql = "DELETE FROM `surveys` WHERE webid = '" . $webid . "';";

	if (!mysql_query($sql))
	{
		die('Error: ' . mysql_error());
	}

	echo "hey";
	
	header("Location: ..");
		
?>

<?php include("footer.php"); ?>