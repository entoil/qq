<?php

session_start();

if (!isset($_SESSION['username'])) {
header('Location: denied.php');
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
 VIEW EVENT
***************************************************************/
if ($target == 'e') {
	echo "<h2>View Events</h2>";
	echo "Enter School ID (SID) of the School you would like to view the events of:<br><br>";
	echo "<form action=view.php?target=e&user=p method=post enctype=multipart/form-data>
		<input type=text name=id />
		<br>
		<input type=submit name=submit value=View Events>
		</form>";
}
/***************************************************************
 VIEW TEACHER
***************************************************************/
if ($target == 't') {
	echo "<h2>View Teachers</h2>";
	echo "Enter School ID (SID) of the School you would like to view the Teachers of:<br><br>";
	echo "<form action=view.php?target=t&user=p method=post enctype=multipart/form-data>
		<input type=text name=id />
		<br>
		<input type=submit name=submit value=View Teachers>
		</form>";
}

/***************************************************************
  VIEW APPOINTMENT
***************************************************************/
if ($target == 'a') {
	echo "<h2>View Appointments</h2>";
	echo "Enter Event ID (SID) of the School you would like to view the Teachers of:<br><br>";
	echo "<form action=view.php?target=a&user=p method=post enctype=multipart/form-data>
		<input type=text name=id />
		<br>
		<input type=submit name=submit value=View Events>
		</form>";
}

?>
</body>
</html>
