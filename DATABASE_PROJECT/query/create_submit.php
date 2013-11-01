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
 SWITCH STATEMENT EXPLANATION
 	The switch statements were mandatory in generating 
	accurate comparison results, as PHP's integer comparison 
	is unusual/bugged - '5' is greater than '10', but '05' is not
	greater than '10'. PHP translates the one digit-number
	to a two-digit number by placing a '0' in the end, 
	making the '5' in the first example '50'.
***************************************************************/

/***************************************************************
 CREATE School
***************************************************************/
if ($target == 's') {
	if ($user == 'a') {
		$sname=$_POST['sname'];
		$semail=$_POST['semail'];
		$addy=$_POST['address'];
		$password=$_POST['password'];	
		$check = mysql_query("SELECT * FROM School WHERE sname = '" . $sname . "'");
		if (mysql_num_rows($check) >= 1) {
			echo "School name already exists.";
		} else {
			mysql_query ("INSERT INTO School (sname,address,semail,password) VALUES ('$sname','$addy','$semail','$password')"); 
			echo "School entry successful.";
		}
	}
}
/***************************************************************
 CREATE EVENT
***************************************************************/
if ($target == 'e') {

	switch ($_POST['daydropdown']) {
	    case 1:
		$day = '01';
		break;
	    case 2:
		$day = '02';
		break;
	    case 3:
		$day = '03';
		break;
	    case 4:
		$day = '04';
		break;
	    case 5:
		$day = '05';
		break;
	    case 6:
		$day = '06';
		break;
	    case 7:
		$day = '07';
		break;
	    case 8:
		$day = '08';
		break;
	    case 9:
		$day = '09';
		break;
	    default:
		$day = $_POST['daydropdown'];
		break;
	}

	switch ($_POST['monthdropdown']) {
	    case "Jan":
		$month = '01';
		break;
	    case "Feb":
		$month = '02';
		break;
	    case "Mar":
		$month = '03';
		break;
	    case "Apr":
		$month = '04';
		break;
	    case "May":
		$month = '05';
		break;
	    case "Jun":
		$month = '06';
		break;
	    case "Jul":
		$month = '07';
		break;
	    case "Aug":
		$month = '08';
		break;
	    case "Sep":
		$month = '09';
		break;
	    case "Oct":
		$month = '10';
		break;
	    case "Nov":
		$month = '11';
		break;
	    case "Dec":
		$month = '12';
		break;
	}
	
	switch ($_POST['minutedropdown']) {
	    case 5:
		$minute = '05';
		break;
	    default:
		$minute = $_POST['minutedropdown'];
		break;
	}

	switch ($hour = $_POST['hourdropdown']) {
	    case 8:
		$hour = '08';
		break;
	    case 9:
		$hour = '09';
		break;
	    default:
		$hour = $_POST['hourdropdown'];
		break;
	}

	$year = $_POST['yeardropdown'];
	
	$stime = sprintf("$year-$month-$day $hour:$minute:00");

	switch ($_POST['daydropdown2']) {
	    case 1:
		$day = '01';
		break;
	    case 2:
		$day = '02';
		break;
	    case 3:
		$day = '03';
		break;
	    case 4:
		$day = '04';
		break;
	    case 5:
		$day = '05';
		break;
	    case 6:
		$day = '06';
		break;
	    case 7:
		$day = '07';
		break;
	    case 8:
		$day = '08';
		break;
	    case 9:
		$day = '09';
		break;
	    default:
		$day = $_POST['daydropdown2'];
		break;
	}

	switch ($_POST['monthdropdown2']) {
	    case "Jan":
		$month = '01';
		break;
	    case "Feb":
		$month = '02';
		break;
	    case "Mar":
		$month = '03';
		break;
	    case "Apr":
		$month = '04';
		break;
	    case "May":
		$month = '05';
		break;
	    case "Jun":
		$month = '06';
		break;
	    case "Jul":
		$month = '07';
		break;
	    case "Aug":
		$month = '08';
		break;
	    case "Sep":
		$month = '09';
		break;
	    case "Oct":
		$month = '10';
		break;
	    case "Nov":
		$month = '11';
		break;
	    case "Dec":
		$month = '12';
		break;
	}
	
	switch ($_POST['minutedropdown2']) {
	    case 5:
		$minute = '05';
		break;
	    default:
		$minute = $_POST['minutedropdown2'];
		break;
	}

	switch ($hour = $_POST['hourdropdown2']) {
	    case 8:
		$hour = '08';
		break;
	    case 9:
		$hour = '09';
		break;
	    default:
		$hour = $_POST['hourdropdown2'];
		break;
	}

	$year = $_POST['yeardropdown2'];
	
	$etime = sprintf("$year-$month-$day $hour:$minute:00");
	
	$ename=$_POST['ename'];
	$venue=$_POST['venue'];
	date_default_timezone_set('Australia/Perth');
	$datetimenow = new DateTime("now");
	if ($stime < $datetimenow->format("Y-m-d H:i:s")) {
		echo "Event cannot begin before current time.";

	} else if ($etime < $stime) {
		echo "Event cannot end before it starts.";
	} else {
		mysql_query ("INSERT INTO Event (ename,venue,stime,etime) VALUES ('$ename','$venue','$stime','$etime')");
		$query = "SELECT MAX(eid) FROM Event";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		$eid = $row['MAX(eid)'];
		if ($user == 's') {
			mysql_query ("INSERT INTO Creates (eid,sid) VALUES ('$eid','" . $_SESSION['username'] . "')");
			echo "Event entry successful.";
		} else if ($user == 'a') {
			$sid=$_POST['sid'];
			mysql_query ("INSERT INTO Creates (eid,sid) VALUES ($eid,$sid)");
		echo "Event entry successful.";
		}
	}

	
}
/***************************************************************
 CREATE TEACHER
***************************************************************/
if ($target == 't') {
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$sub=$_POST['subject'];
	mysql_query("INSERT INTO Teacher (fname,lname,subject) VALUES ('$fname','$lname','$sub')"); 
	echo "Teacher entry successful.";
}
/***************************************************************
 CREATE APPOINTMENT
***************************************************************/
if ($target == 'a') {

	switch ($_POST['daydropdown']) {
	    case 1:
		$day = '01';
		break;
	    case 2:
		$day = '02';
		break;
	    case 3:
		$day = '03';
		break;
	    case 4:
		$day = '04';
		break;
	    case 5:
		$day = '05';
		break;
	    case 6:
		$day = '06';
		break;
	    case 7:
		$day = '07';
		break;
	    case 8:
		$day = '08';
		break;
	    case 9:
		$day = '09';
		break;
	    default:
		$day = $_POST['daydropdown'];
		break;
	}

	switch ($_POST['monthdropdown']) {
	    case "Jan":
		$month = '01';
		break;
	    case "Feb":
		$month = '02';
		break;
	    case "Mar":
		$month = '03';
		break;
	    case "Apr":
		$month = '04';
		break;
	    case "May":
		$month = '05';
		break;
	    case "Jun":
		$month = '06';
		break;
	    case "Jul":
		$month = '07';
		break;
	    case "Aug":
		$month = '08';
		break;
	    case "Sep":
		$month = '09';
		break;
	    case "Oct":
		$month = '10';
		break;
	    case "Nov":
		$month = '11';
		break;
	    case "Dec":
		$month = '12';
		break;
	}
	
	switch ($_POST['minutedropdown']) {
	    case 5:
		$minute = '05';
		break;
	    default:
		$minute = $_POST['minutedropdown'];
		break;
	}

	switch ($hour = $_POST['hourdropdown']) {
	    case 8:
		$hour = '08';
		break;
	    case 9:
		$hour = '09';
		break;
	    default:
		$hour = $_POST['hourdropdown'];
		break;
	}

	$year = $_POST['yeardropdown'];
	
	$stime = sprintf("$year-$month-$day $hour:$minute:00");

	switch ($_POST['daydropdown2']) {
	    case 1:
		$day = '01';
		break;
	    case 2:
		$day = '02';
		break;
	    case 3:
		$day = '03';
		break;
	    case 4:
		$day = '04';
		break;
	    case 5:
		$day = '05';
		break;
	    case 6:
		$day = '06';
		break;
	    case 7:
		$day = '07';
		break;
	    case 8:
		$day = '08';
		break;
	    case 9:
		$day = '09';
		break;
	    default:
		$day = $_POST['daydropdown2'];
		break;
	}

	switch ($_POST['monthdropdown2']) {
	    case "Jan":
		$month = '01';
		break;
	    case "Feb":
		$month = '02';
		break;
	    case "Mar":
		$month = '03';
		break;
	    case "Apr":
		$month = '04';
		break;
	    case "May":
		$month = '05';
		break;
	    case "Jun":
		$month = '06';
		break;
	    case "Jul":
		$month = '07';
		break;
	    case "Aug":
		$month = '08';
		break;
	    case "Sep":
		$month = '09';
		break;
	    case "Oct":
		$month = '10';
		break;
	    case "Nov":
		$month = '11';
		break;
	    case "Dec":
		$month = '12';
		break;
	}
	
	switch ($_POST['minutedropdown2']) {
	    case 5:
		$minute = '05';
		break;
	    default:
		$minute = $_POST['minutedropdown2'];
		break;
	}

	switch ($hour = $_POST['hourdropdown2']) {
	    case 8:
		$hour = '08';
		break;
	    case 9:
		$hour = '09';
		break;
	    default:
		$hour = $_POST['hourdropdown2'];
		break;
	}

	$year = $_POST['yeardropdown2'];
	
	$etime = sprintf("$year-$month-$day $hour:$minute:00");
	$eid=$_POST['eid'];
	$tid=$_POST['tid'];
	$cstimes = mysql_query("SELECT stime FROM Joins WHERE tid = '" . $tid . "'");
	$cetimes = mysql_query("SELECT etime FROM Joins WHERE tid = '" . $tid . "'");
	$length = mysql_num_rows($cstimes);
	$eventstart = mysql_result(mysql_query("SELECT stime FROM Event WHERE eid = '" . $eid . "'"),0);
	$eventend = mysql_result(mysql_query("SELECT etime FROM Event WHERE eid = '" . $eid . "'"),0);
	$noclashes = true;
	for($counter = 0; $counter < $length; $counter += 1) {
		if ((mysql_result($cstimes,$counter) < $stime && $stime < mysql_result($cetimes,$counter)) || (mysql_result($cstimes,$counter) < $etime && $etime < mysql_result($cetimes,$counter))) {
			$noclashes = false;
			break;
		}
	} if ($noclashes == false) {
		echo "Teacher already busy at this time.";
	} else if ($stime < $eventstart) {
		echo "Appointment cannot start before event.";
	} else if ($etime < $stime) {
		echo "Appointment cannot end before it starts.";
	} else if ($eventend < $etime) {
		echo "Appointment cannot end after event.";
		echo $eventend;
		echo "<br>";
		echo $etime;
		
	} else if ($user == 's') {
		$check = mysql_result(mysql_query ("SELECT sid FROM Creates WHERE eid = " . $eid . ""),0);
		if ($check == (int)$_SESSION['username']) {
			mysql_query ("INSERT INTO Joins (eid,tid,stime,etime) VALUES ('$eid','$tid','$stime','$etime')");
			echo "Appointment successfully created.";
		} else {
			echo "Event does not belong to School.";
		}
	} else if ($user == 'a') {
		mysql_query ("INSERT INTO Joins (eid,tid,stime,etime) VALUES ('$eid','$tid','$stime','$etime')");
		echo "Appointment successfully created.";
	} else {
		echo "Unkown error!";
	}
}
/***************************************************************
 CREATE PARENT
***************************************************************/
if ($target == 'p') {
	$pemail=$_POST['pemail'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$check = mysql_query("SELECT * FROM Parent WHERE pemail = '" . $pemail . "'");
	if (mysql_num_rows($check) >= 1) {
		echo "Parent email address already exists.";
	} else {
		mysql_query ("INSERT INTO Parent (pemail,fname,lname) VALUES ('$pemail','$fname','$lname')");
		echo "Parent entry successful.";
	}
}
/***************************************************************
 CREATE BOOKING
***************************************************************/
if ($target == 'b') {
	$jid=$_POST['jid'];
	$child=$_POST['childname'];
	$check = mysql_query("SELECT * FROM Books WHERE jid='" . $jid . "'");
	if (mysql_num_rows($check) >= 1) {
		echo "Appointment already booked.";
	} else if ($user == 'a') {
		$pemail=$_POST['pemail'];
		mysql_query ("INSERT INTO Books (jid, pemail, childname) VALUES ('$jid','$pemail','$child')"); 
		echo "Booking entry successful.";
	} else if ($user == 'p') {
		mysql_query ("INSERT INTO Books (jid, pemail, childname) VALUES ('$jid','" . $_SESSION['username'] . "','$child')");
		echo "Booking entry successful.";
	}
}
/***************************************************************
 ADD TEACHER TO School
***************************************************************/
if ($target == 'c') {
	$tid=$_POST['tid'];
	$percentage=$_POST['percentage'];
	$persum = mysql_result(mysql_query("SELECT SUM(percentage) FROM Teaches WHERE tid=$tid"),0);
	if ($persum + $percentage > 100) {
		echo "Teacher will be overloaded.";
	} else if ($user == 'a') {
		$sid=$_POST['sid'];
		mysql_query ("INSERT INTO Teaches (tid, sid, percentage) VALUES ($tid, $sid, $percentage)");
		echo "Teacher successfully added to School.";
	} else if ($user == 's') {
		mysql_query ("INSERT INTO Teaches (tid, sid, percentage) VALUES ($tid," . $_SESSION['username'] . ",$percentage)");
		echo "Teacher successfully added to School.";
	} else {
		echo "Unkown error!";
	}
}

?>
</body>
</html>
