<?php

session_start();

if (!isset($_SESSION['username'])) {
header('Location: denied.php');
}

if ($_GET['user'] == 'a') {
	if ($_SESSION['username'] != 'admin') {
		header('Location: denied.php');
	}
}

if ($_GET['user'] == 's') {
	if (!is_numeric($_SESSION['username'])) {
		header('Location: denied.php');
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 

include('../config.inc');

$target = $_GET['target'];
$user = $_GET['user'];
$id = $_GET['id'];
$userid =  $_SESSION['username'];

/***************************************************************
 DELETE SCHOOL
***************************************************************/
if ($target == 's')  {
	mysql_query ("DELETE FROM School WHERE sid=$id");
	echo "School successfully deleted.";
}
/***************************************************************
 DELETE EVENT
***************************************************************/
if ($target == 'e') {
	mysql_query ("DELETE FROM Event WHERE eid=$id");
	echo "Event successfully deleted.";
}
/***************************************************************
 DELETE TEACHER
***************************************************************/
if ($target == 't') {
	mysql_query ("DELETE FROM Teacher WHERE tid=$id");
	echo "Teacher successfully deleted.";
}
/***************************************************************
 DELETE PARENT
***************************************************************/
if ($target == 'p') {
	if ($userid = 'a') {
		mysql_query ("DELETE FROM Parent WHERE pemail='$id'");
		echo "Parent successfully deleted.";
	} else {
		mysql_query ("DELETE FROM Parent WHERE pemail='$id'");
		echo "Your profile has been succcessfully deleted. <br>Redirecting to login page ...";
		sleep(3);
	}
}
/***************************************************************
 REMOVE TEACHER FROM SCHOOL
***************************************************************/
if ($target == 'c') {
	if ($user == 'a') {
		$sid = $_GET['sid'];
		mysql_query ("DELETE FROM Teaches WHERE sid=$sid AND tid=$id");
		echo "Teacher successfully removed from school.";
	} else if ($user == 's') {
		mysql_query ("DELETE FROM Teaches WHERE sid=" . $_SESSION['username'] . " AND tid=$id");
		echo "Teacher successfully removed from school.";
	}
}
/***************************************************************
 DELETE APPOINTMENT
***************************************************************/
if ($target == 'a') {
	mysql_query ("DELETE FROM Joins WHERE jid=$id");
	echo "Appoinment slot successfully deleted.";
}
/***************************************************************
 DELETE BOOKING
***************************************************************/
if ($target == 'b') {
	mysql_query ("DELETE FROM Books WHERE jid=$id");
	echo "Booking successfully deleted.";
}

?>
</body>
</html>
