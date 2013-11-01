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
 VIEW TABLES
***************************************************************/
if ($target == 'table') {

	if ($user == 'a') {
		$query = sprintf("SHOW TABLES;");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Tables In group16_db</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5' style='width: 150px;'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>Tables</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);
	}

	
}
/***************************************************************
 VIEW SCHOOL
***************************************************************/
if ($target == 's') {

	if ($user == 'a') {
		$query = sprintf("SELECT sid AS 'School ID', sname AS 'School', address AS 'Street Address', semail AS 'Email Address', password AS Password FROM School");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>School</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);
	}

	if ($user == 'p') {
		$query = sprintf("SELECT sid AS 'SID', sname AS 'School', address AS 'Street Address', semail AS 'Email Address' FROM School");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Schools</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);
	}
}
/***************************************************************
 VIEW EVENT
***************************************************************/
if ($target == 'e') {

	if ($user == 'a') {
		$query = sprintf("SELECT E.eid AS 'Event ID', E.ename AS 'Event', E.venue AS 'Venue', E.stime AS 'Start Time', E.etime AS 'End Time', S.sname AS 'School' FROM Event E NATURAL JOIN Creates C NATURAL JOIN School S ORDER BY eid");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Event</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);
	}

	if ($user == 's') {

		$sid = $_SESSION['username'];
		$query = sprintf("SELECT eid AS 'Event ID', ename AS 'Event', venue AS 'Venue', stime AS 'Start Time', etime AS 'End Time' FROM Event NATURAL JOIN Creates NATURAL JOIN School WHERE Creates.sid = " . $sid . "");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Table: Events</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);
	}

	if ($user == 'p') {

		$sid = $_POST['id'];
		$query = sprintf("SELECT eid AS 'Event ID', ename AS 'Event', venue AS 'Venue', stime AS 'Start Time', etime AS 'End Time' FROM Event NATURAL JOIN Creates NATURAL JOIN School WHERE Creates.sid = " . $sid . "");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		} else if (mysql_num_rows($result) == 0) { echo "School does not exist"; 
		} else {

			$fields_num = mysql_num_fields($result);

			$title = mysql_query("SELECT sname FROM School WHERE sid = $sid");
			echo "<h3>" . mysql_result($title, 0) . "'s Events</h3>";
			echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

			for($i=0; $i<$fields_num; $i++)
			{
			    $field = mysql_fetch_field($result);
			    echo "<td class=fieldname>{$field->name}</td>";
			}
			echo "</tr>\n";

			while($row = mysql_fetch_row($result))
			{
			    echo "<tr>";

			    foreach($row as $cell)
				echo "<td class=cell>$cell</td>";

			    echo "</tr>\n";
			}
			mysql_free_result($result);
		}
	}
}
/***************************************************************
 VIEW TEACHER
***************************************************************/
if ($target == 't') {

	if ($user == 'a') {
		$query = sprintf("SELECT tid AS 'Teacher ID', fname AS 'First Name', lname AS 'Last Name', subject AS 'Subject' FROM Teacher");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Teacher</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);

		
	

		
	}

	if ($user == 's') {

	$sid = $_SESSION['username'];
		$query = sprintf("SELECT C.tid AS 'Teacher ID', CONCAT(T.fname,' ',T.lname) AS 'Teacher', C.percentage AS 'Percentage' FROM Teacher T NATURAL JOIN Teaches C NATURAL JOIN School S WHERE C.sid = $sid");
		
		$result = mysql_query($query);
	
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;

			die($message);
		}
	
		$fields_num = mysql_num_fields($result);
	
			$title = mysql_query("SELECT sname FROM School WHERE sid = $sid");
			echo "<h3>" . mysql_result($title, 0) . "'s Teachers</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
	
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
	
		while($row = mysql_fetch_row($result))
		{
			echo "<tr>";
	
			foreach($row as $cell)
			echo "<td class=cell>$cell</td>";
	
			echo "</tr>\n";
		}
	echo "</table>";
	
	
	mysql_free_result($result);
	
		$query = sprintf("SELECT C.tid AS 'Teacher ID', CONCAT(T.fname,' ',T.lname) AS 'Teacher', SUM(C.Percentage) AS 'Workload' FROM Teacher T NATURAL JOIN Teaches C GROUP BY C.tid");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Teachers - Employed</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		echo "</table>";
		mysql_free_result($result);

		$query = sprintf("SELECT tid AS 'Teacher ID', CONCAT(fname,' ',lname) AS 'Teacher' FROM Teacher WHERE tid NOT IN (SELECT C.tid FROM Teacher T NATURAL JOIN Teaches C GROUP BY C.tid)");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Teachers - Unemployed</h3>";
		
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		echo "</table>";
		mysql_free_result($result);

		
	}

	if ($user == 'p') {

		$sid = $_POST['id'];
		$query = sprintf("SELECT tid AS 'Teacher ID', fname AS 'First Name', lname AS 'Last Name', sname AS 'School' FROM Teaches NATURAL JOIN Teacher NATURAL JOIN School WHERE Teaches.sid =$sid");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		} else if (mysql_num_rows($result) == 0) { echo "School does not exist"; 
		} else {

			$fields_num = mysql_num_fields($result);

			$title = mysql_query("SELECT sname FROM School WHERE sid = $sid");
			echo "<h3>" . mysql_result($title, 0) . "'s Teachers</h3>";
			echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

			for($i=0; $i<$fields_num; $i++)
			{
			    $field = mysql_fetch_field($result);
			    echo "<td class=fieldname>{$field->name}</td>";
			}
			echo "</tr>\n";

			while($row = mysql_fetch_row($result))
			{
			    echo "<tr>";

			    foreach($row as $cell)
				echo "<td class=cell>$cell</td>";

			    echo "</tr>\n";
			}
			echo "</table>";
			mysql_free_result($result);
		}
	}
}
/***************************************************************
 VIEW APPOINTMENT
***************************************************************/
if ($target == 'a') {

	if ($user == 'a') {
		$query = sprintf("SELECT jid AS 'Appointment ID', stime AS 'Start Time', etime AS 'End Time', tid AS 'Teacher ID', CONCAT(fname,' ',lname) AS 'Teacher', eid AS 'Event ID' FROM Joins NATURAL JOIN Teacher ORDER BY jid");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Appointment</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);
	}

	if ($user == 's') {
	
		$sid = $_SESSION['username'];
		$query = sprintf("SELECT jid AS 'Appointment ID', stime AS 'Start Time', etime AS 'End Time', tid AS 'Teacher ID', CONCAT(fname,' ',lname) AS 'Teacher', eid AS 'Event ID' FROM Joins NATURAL JOIN Teacher NATURAL JOIN Creates WHERE sid = " . $sid . " ORDER BY jid");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		echo "<h3>Appointment</h3>";
		
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

		for($i=0; $i<$fields_num; $i++)
		{
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";

		while($row = mysql_fetch_row($result))
		{
		    echo "<tr>";

		    foreach($row as $cell)
			echo "<td class=cell>$cell</td>";

		    echo "</tr>\n";
		}
		mysql_free_result($result);
	}
	if ($user == 'p') {

		$eid = $_POST['id'];
		$query = sprintf("SELECT jid AS 'Appointment ID', stime AS 'Start Time', etime AS 'End Time', CONCAT(fname,' ',lname) AS 'Teacher', subject AS 'Subject' FROM Joins NATURAL JOIN Teacher NATURAL JOIN Creates WHERE eid = " . $eid . " AND jid NOT IN (SELECT jid FROM Books) ORDER BY jid");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		} else if (mysql_num_rows($result) == 0) { echo "Appointment does not exist"; 
		} else {
		
			$fields_num = mysql_num_fields($result);

			$title = mysql_query("SELECT ename FROM Event WHERE eid = $eid");
			echo "<h3>" . mysql_result($title, 0) . " Available Appointments</h3>";
			
			echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

			for($i=0; $i<$fields_num; $i++)
			{
			    $field = mysql_fetch_field($result);
			    echo "<td class=fieldname>{$field->name}</td>";
			}
			echo "</tr>\n";

			while($row = mysql_fetch_row($result))
			{
			    echo "<tr>";

			    foreach($row as $cell)
				echo "<td class=cell>$cell</td>";

			    echo "</tr>\n";
			}
			mysql_free_result($result);
		}
	}
}
/***************************************************************
 VIEW Parent
***************************************************************/
if ($target == 'p') {
	$query = sprintf("SELECT fname AS 'First Name', lname AS 'Last Name', pemail AS 'Email Address' FROM Parent");

	$result = mysql_query($query);

	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}

	$fields_num = mysql_num_fields($result);

	echo "<h3>Parent</h3>";
	echo "<table class=result cellspacing='1' cellpadding='5'><tr>";

	for($i=0; $i<$fields_num; $i++)
	{
	    $field = mysql_fetch_field($result);
	    echo "<td class=fieldname>{$field->name}</td>";
	}
	echo "</tr>\n";

	while($row = mysql_fetch_row($result))
	{
	    echo "<tr>";

	    foreach($row as $cell)
		echo "<td class=cell>$cell</td>";

	    echo "</tr>\n";
	}
	mysql_free_result($result);
}
/***************************************************************
 VIEW BOOKING
***************************************************************/
if ($target == 'b') {
	
	if ($user == 'a') {
		$query = sprintf("SELECT B.jid AS 'Booking ID', stime AS 'Start Time', etime AS 'End Time', tid AS 'Teacher ID', eid AS 'Event ID', pemail AS 'Parent Email', childname AS 'Child' FROM Teacher T NATURAL JOIN Joins J NATURAL JOIN Books B ORDER BY B.jid");
		
		$result = mysql_query($query);
	
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	
		$fields_num = mysql_num_fields($result);
	
		echo "<h3>Booking</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
	
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
	
		while($row = mysql_fetch_row($result))
		{
			echo "<tr>";
	
			foreach($row as $cell)
			echo "<td class=cell>$cell</td>";
	
			echo "</tr>\n";
		}
	}
	
	if ($user == 'p') {
		$query = sprintf("	SELECT B.jid AS 'Booking ID', B.childname AS 'Child', J.stime AS 'Start Time', J.etime AS 'End Time', CONCAT(T.fname,' ',T.lname) AS 'Teacher', T.subject AS 'Subject'
							FROM Teacher T NATURAL JOIN Joins J NATURAL JOIN Books B 
							WHERE B.pemail = '%s' ORDER BY B.jid;", $_SESSION['username']);
		
		$result = mysql_query($query);
	
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	
		$fields_num = mysql_num_fields($result);
	
		echo "<h3>Table: Bookings</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
	
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
	
		while($row = mysql_fetch_row($result))
		{
			echo "<tr>";
	
			foreach($row as $cell)
			echo "<td class=cell>$cell</td>";
	
			echo "</tr>\n";
		}
	}
	
	
	mysql_free_result($result);
}

/***************************************************************
 VIEW EMPLOYED TEACHERS
***************************************************************/
if ($target == 'c') {
	
	if ($user == 'a') {
		$query = sprintf("SELECT C.tid AS 'Teacher ID', CONCAT(fname,' ',lname) AS 'Teacher', C.sid AS 'School ID', sname AS 'School', percentage FROM Teaches C NATURAL JOIN Teacher T NATURAL JOIN School S");
		
		$result = mysql_query($query);
	
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	
		$fields_num = mysql_num_fields($result);
	
		echo "<h3>Currently Teaching Teachers</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
	
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
	
		while($row = mysql_fetch_row($result))
		{
			echo "<tr>";
	
			foreach($row as $cell)
			echo "<td class=cell>$cell</td>";
	
			echo "</tr>\n";
		}
	}
	
	if ($user == 's') {
		$sid = $_SESSION['username'];
		$query = sprintf("SELECT C.tid AS 'Teacher ID', CONCAT(T.fname,' ',T.lname) AS 'Teacher', C.percentage AS 'Percentage' FROM Teacher T NATURAL JOIN Teaches C NATURAL JOIN School S WHERE C.sid = $sid");
		
		$result = mysql_query($query);
	
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	
		$fields_num = mysql_num_fields($result);
	
		echo "<h3>Currently Teaching Teachers</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
	
		for($i=0; $i<$fields_num; $i++)
		{
			$field = mysql_fetch_field($result);
			echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
	
		while($row = mysql_fetch_row($result))
		{
			echo "<tr>";
	
			foreach($row as $cell)
			echo "<td class=cell>$cell</td>";
	
			echo "</tr>\n";
		}
	}
	
	
	mysql_free_result($result);
}

?>
</body>
</html>
