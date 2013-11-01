<?php

session_start();

include('config.inc');
	
if ($_POST['selmenu'] == 1) {
	
	if ($_POST['user'] == 'admin' && $_POST['pass'] == 'admin') {
		$_SESSION['username'] = $_POST['user'];
		header('Location: amenu.php');
	}
	else {
		header('Location: login.php');
	}
}


if ($_POST['selmenu'] == 2) {
	
$login = mysql_query("SELECT * FROM School WHERE semail = '" . mysql_real_escape_string($_POST['user']) . "' and password = '" . mysql_real_escape_string($_POST['pass']) . "'");
	
	
	if (mysql_num_rows($login) == 1) {
		$result = mysql_query("SELECT * FROM School where semail='" . mysql_real_escape_string($_POST['user']) . "'");
		$row = mysql_fetch_assoc($result);

		$_SESSION['username'] = $row['sid'];
		header('Location: smenu.php');
	}
	else {
		header('Location: login.php');
	}
}


if ($_POST['selmenu'] == 3) {
	$login = mysql_query("SELECT * FROM Parent WHERE (pemail = '" . mysql_real_escape_string($_POST['user']) . "')");
	
	if (mysql_num_rows($login) == 1) {
		$_SESSION['username'] = $_POST['user'];
		header('Location: pmenu.php');
	}
	else {
		header('Location: login.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
</body>
</html>
