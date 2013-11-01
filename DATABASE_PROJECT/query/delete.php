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

/***************************************************************
 DELETE SCHOOL
***************************************************************/
if ($target == 's') {
	echo "<h3>Delete School</h3>";
	echo "Delete School ID (sid) of the school you wish to delete:<br><br>";
	echo "<form action=delete_check.php?target=s&user=a method=post enctype=multipart/form-data>
		<input type=text name=id />
		<br>
		<input type=submit name=submit value=Delete>
		</form>";
}
/***************************************************************
 DELETE EVENT
***************************************************************/
if ($target == 'e') {
	echo "<h3>Delete Event</h3>";
	echo "Enter Event ID (eid) of the event you wish to delete:<br><br>";
	echo "<form action=delete_check.php?target=e&user=a method=post enctype=multipart/form-data>
		<input type=text name=id />
		<br>
		<input type=submit name=submit value=Delete>
		</form>";
}
/***************************************************************
 DELETE TEACHER
***************************************************************/
if ($target == 't') {
	echo "<h3>Delete Teacher</h3>";
	echo "Enter Teacher ID (tid) of the teacher you wish to delete:<br><br>";
	echo "<form action=delete_check.php?target=t&user=a method=post enctype=multipart/form-data>
		<input type=text name=id />
		<br>
		<input type=submit name=submit value=Delete>
		</form>";
}
/***************************************************************
 DELETE PARENT
***************************************************************/
if ($target == 'p') {
	echo "<h3>Delete Parent</h3>";
	echo "Enter the email address (pemail) of the parent you wish to delete:<br><br>";
	echo "<form action=delete_check.php?target=p&user=a method=post enctype=multipart/form-data>
		<input type=text name=id />
		<br>
		<input type=submit name=submit value=Delete>
		</form>";
}
/***************************************************************
 REMOVE TEACHER FROM SCHOOL
***************************************************************/
if ($target == 'c') {
	echo "<h3>Remove Teacher from School</h3>";
	if ($user == 'a') {
		echo "Enter the teacher ID (tid) and school ID (sid) of the teacher and school to disassociate:<br><br>";
		echo "<form action=delete_check.php?target=c&user=a method=post enctype=multipart/form-data>
			tid: <input type=text name=id />
			sid: <input type=text name=sid />
			<br>
			<input type=submit name=submit value=Delete>
		</form>";
	} else if ($user == 's') {
		echo "Enter the teacher ID (tid) of the teacher you wish to remove:<br><br>";
		echo "<form action=delete_check.php?target=c&user=s method=post enctype=multipart/form-data>
			<input type=text name=id />
			<br>
			<input type=submit name=submit value=Delete>
		</form>";
	}
}
/***************************************************************
  DELETE APPOINTMENT
***************************************************************/
if ($target == 'a') {
		echo "<h3>Delete Appointment</h3>";
		echo "Enter the appoinment ID (jid) of the appointment slot you wish to delete:<br><br>";
		echo "<form action=delete_check.php?target=a&user=$user method=post enctype=multipart/form-data>
			<input type=text name=id />
			<br>
			<input type=submit name=submit value=Delete>
		</form>";
	
}
/***************************************************************
  DELETE BOOKING
***************************************************************/
if ($target == 'b') {
	echo "<h3>Delete Booking</h3>";
	echo "Enter the booking ID (jid) of the booking you wish to delete:<br><br>";
	if ($_GET['user'] == 'a') {
		echo "<form action=delete_check.php?target=b&user=a method=post enctype=multipart/form-data>
			<input type=text name=id />
			<br>
			<input type=submit name=submit value=Delete>
			</form>";
	} else {
		echo "<form action=delete_check.php?target=b&user=p method=post enctype=multipart/form-data>
			<input type=text name=id />
			<br>
			<input type=submit name=submit value=Delete>
			</form>";
			}
	}
?>
</body>
</html>
