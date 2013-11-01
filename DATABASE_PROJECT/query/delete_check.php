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
<link href="../main.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 

include('../config.inc');

$target = $_GET['target'];
$user = $_GET['user'];
if ($user != 'p') {
	$id = $_POST['id'];
}
$userid =  $_SESSION['username'];

/***************************************************************
 DELETE SCHOOL
***************************************************************/
if ($target == 's') {
	$result = mysql_query("SELECT sid AS 'School ID', sname AS 'School', address AS 'Street Address', semail AS 'Email Address' FROM School WHERE sid=$id");
	if (mysql_num_rows($result) < 1) {
		echo "School ID does not exist.";
	} else {
		$fields_num = mysql_num_fields($result);
		echo "<h3>Confirm deletion:</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
		for($i=0; $i<$fields_num; $i++) {
	    $field = mysql_fetch_field($result);
	    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
		while($row = mysql_fetch_row($result)) {
	    echo "<tr>";
	    foreach($row as $cell)
			echo "<td style='background-color:#FFF;'>$cell</td>";
	    echo "</tr>\n";
		}
		echo "</table><br>";
		mysql_free_result($result);
		if ($user == 'a') {
			echo "<form action=delete_confirm.php?target=s&user=a&id=$id method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
		} else if ($user == 's') {
			echo "<form action=delete_confirm.php?target=s&user=s&id=$id method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
		}
	}
}
/***************************************************************
 DELETE EVENT
***************************************************************/
if ($target == 'e') {
	$result = mysql_query("SELECT eid AS 'Event ID', ename AS 'Event', venue AS 'Venue', stime AS 'Start Time', etime AS 'End Time' FROM Event WHERE eid=$id");
	if (mysql_num_rows($result) < 1) {
		echo "Event ID does not exist.";
	} else if ($user == 's' && mysql_num_rows(mysql_query("SELECT * FROM Creates WHERE eid=$id AND sid='" . $_SESSION['username'] . "'")) < 1) {
			echo "Event does not belong to your school.";
	} else {
		$fields_num = mysql_num_fields($result);
		echo "<h3>Confirm deletion:</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
		for($i=0; $i<$fields_num; $i++) {
	    $field = mysql_fetch_field($result);
	    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
		while($row = mysql_fetch_row($result)) {
	    echo "<tr>";
	    foreach($row as $cell)
			echo "<td style='background-color:#FFF;'>$cell</td>";
	    echo "</tr>\n";
		}
		echo "</table><br>";
		mysql_free_result($result);
		echo "<form action=delete_confirm.php?target=e&user=a&id=$id method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
	}
}
/***************************************************************
 DELETE TEACHER
***************************************************************/
if ($target == 't') {
	$result = mysql_query("SELECT tid AS 'Teacher ID', CONCAT(fname,' ',lname) AS Teacher, subject AS 'Subject' FROM Teacher WHERE tid=$id");
	if (mysql_num_rows($result) < 1) {
		echo "Teacher ID does not exist.";
	} else {
		$fields_num = mysql_num_fields($result);
		echo "<h3>Confirm deletion:</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
		for($i=0; $i<$fields_num; $i++) {
	    $field = mysql_fetch_field($result);
	    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
		while($row = mysql_fetch_row($result)) {
	    echo "<tr>";
	    foreach($row as $cell)
			echo "<td style='background-color:#FFF;'>$cell</td>";
	    echo "</tr>\n";
		}
		echo "</table><br>";
		mysql_free_result($result);
		echo "<form action=delete_confirm.php?target=t&user=a&id=$id method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
	}
}
/***************************************************************
 DELETE PARENT
***************************************************************/
if ($target == 'p') {
	if ($user == 'a') {
		$result = mysql_query("SELECT pemail AS 'Email Address', CONCAT(fname,' ',lname) AS 'Parent' FROM Parent WHERE pemail='$id'");
		if (mysql_num_rows($result) < 1) {
			echo "Parent email does not exist.";
		} else {
			$fields_num = mysql_num_fields($result);
			echo "<h3>Confirm deletion:</h3>";
			echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
			for($i=0; $i<$fields_num; $i++) {
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
			}
			echo "</tr>\n";
			while($row = mysql_fetch_row($result)) {
		    echo "<tr>";
		    foreach($row as $cell)
				echo "<td style='background-color:#FFF;'>$cell</td>";
		    echo "</tr>\n";
			}
			echo "</table><br>";
			mysql_free_result($result);
			echo "<form action=delete_confirm.php?target=p&user=a&id=$id method=post>
				<input type=submit name=submit value=Confirm Delete>
				<input type=button value=Cancel onclick=history.back()></form>";
		}
	}
	if ($user == 'p') {
		$result = mysql_query("SELECT * FROM Parent WHERE pemail='$userid'");
		if (mysql_num_rows($result) < 1) {
			echo "Parent email does not exist.";
		} else {
			$fields_num = mysql_num_fields($result);
			echo "<h3>Confirm deletion:</h3>";
			echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
			for($i=0; $i<$fields_num; $i++) {
		    $field = mysql_fetch_field($result);
		    echo "<td class=fieldname>{$field->name}</td>";
			}
			echo "</tr>\n";
			while($row = mysql_fetch_row($result)) {
		    echo "<tr>";
		    foreach($row as $cell)
				echo "<td style='background-color:#FFF;'>$cell</td>";
		    echo "</tr>\n";
			}
			echo "</table><br>";
			mysql_free_result($result);
			echo "<form action=delete_confirm.php?target=p&user=p&id=$userid method=post>
				<input type=submit name=submit value=Confirm Delete>
				<input type=button value=Cancel onclick=history.back()></form>";
		}
	}
}
/***************************************************************
 REMOVE Teacher from School
***************************************************************/
if ($target == 'c') {
	$tid=$_POST['id'];
	$sid=$_POST['sid'];
	$result;
	if ($user == 's') {
		$result = mysql_query("SELECT C.tid AS 'Teacher ID', CONCAT(T.fname,' ',T.lname) AS 'Teacher' FROM Teaches C NATURAL JOIN Teacher T WHERE C.tid=$tid AND C.sid='" . $_SESSION['username'] . "'");
	} else {
		$result = mysql_query("SELECT C.tid AS 'Teacher ID', CONCAT(T.fname,' ',T.lname) AS 'Teacher', C.sid AS 'School ID', S.sname AS 'School' FROM School S NATURAL JOIN Teaches C NATURAL JOIN Teacher T WHERE C.tid=$tid AND C.sid=$sid");
	}
	if (mysql_num_rows($result) < 1) {
		echo "Given teacher is not teaching at school.";
	} else {
		$fields_num = mysql_num_fields($result);
		echo "<h3>Confirm deletion:</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
		for($i=0; $i<$fields_num; $i++) {
	    $field = mysql_fetch_field($result);
	    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
		while($row = mysql_fetch_row($result)) {
	    echo "<tr>";
	    foreach($row as $cell)
			echo "<td style='background-color:#FFF;'>$cell</td>";
	    echo "</tr>\n";
		}
		echo "</table><br>";
		mysql_free_result($result);
	if ($user == 's') {
		echo "<form action=delete_confirm.php?target=c&user=s&id=$tid&sid=$sid method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
	} else {
		echo "<form action=delete_confirm.php?target=c&user=a&id=$tid&sid=$sid method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
	}
	}
}
/***************************************************************
  DELETE APPOINTMENT
***************************************************************/
if ($target == 'a') {
	$result = mysql_query("SELECT jid AS 'Appointment ID', stime AS 'Start Time', etime AS 'End Time', tid AS 'Teacher ID', eid AS 'Event ID' FROM Joins WHERE jid=$id");
	if (mysql_num_rows($result) < 1) {
		echo "Appointment ID does not exist.";
	} else if ($user == 's' && mysql_num_rows(mysql_query("SELECT * FROM Joins NATURAL JOIN Teacher NATURAL JOIN Teaches WHERE Joins.jid=$id AND Teaches.sid='" . $_SESSION['username'] . "'")) < 1) {
			echo "Appointment does not belong to your school.";
	} else {
		$fields_num = mysql_num_fields($result);
		echo "<h3>Confirm deletion:</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
		for($i=0; $i<$fields_num; $i++) {
	    $field = mysql_fetch_field($result);
	    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
		while($row = mysql_fetch_row($result)) {
	    echo "<tr>";
	    foreach($row as $cell)
			echo "<td style='background-color:#FFF;'>$cell</td>";
	    echo "</tr>\n";
		}
		echo "</table><br>";
		mysql_free_result($result);
		
		echo "<form action=delete_confirm.php?target=a&user=$user&id=$id method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
	}

}
/***************************************************************
  DELETE Booking
***************************************************************/
if ($target == 'b') {
	$id = $_POST['id'];
	$result = mysql_query("SELECT B.jid , J.stime, J.etime, B.childname, CONCAT(T.fname,' ',T.lname) AS Teacher, T.subject FROM Books B NATURAL JOIN Joins J NATURAL JOIN Teacher T WHERE B.jid=$id");
	if (mysql_num_rows($result) < 1) {
		echo "Booking ID does not exist.";
	} else if ($userid != 'admin' && mysql_num_rows(mysql_query("SELECT * FROM Books WHERE jid=$id AND pemail='" . $_SESSION['username'] . "'")) < 1) {
			echo "Booking is not reserved in your name.";
	} else {
		$fields_num = mysql_num_fields($result);
		echo "<h3>Confirm deletion:</h3>";
		echo "<table class=result cellspacing='1' cellpadding='5'><tr>";
		for($i=0; $i<$fields_num; $i++) {
	    $field = mysql_fetch_field($result);
	    echo "<td class=fieldname>{$field->name}</td>";
		}
		echo "</tr>\n";
		while($row = mysql_fetch_row($result)) {
	    echo "<tr>";
	    foreach($row as $cell)
			echo "<td style='background-color:#FFF;'>$cell</td>";
	    echo "</tr>\n";
		}
		mysql_free_result($result);
		echo "</table><br>";
		echo "<form action=delete_confirm.php?target=b&user=p&id=$id method=post>
			<input type=submit name=submit value=Confirm Delete>
			<input type=button value=Cancel onclick=history.back()></form>";
	}
}
?>
</body>
</html>
