<?php

session_start();

include('config.inc');
	

$login = mysql_query("SELECT * FROM users WHERE username = '" . mysql_real_escape_string($_POST['user']) . "' and password = '" . mysql_real_escape_string($_POST['pass']) . "'");
	
	
	if (mysql_num_rows($login) == 1) {
		$result = mysql_query("SELECT * FROM users where username='" . mysql_real_escape_string($_POST['user']) . "'");
		$row = mysql_fetch_assoc($result);

		$_SESSION['username'] = $row['username'];
		header('Location: index.php');
	}
	else {
		header('Location: login.php?error=1');
	}

?>
