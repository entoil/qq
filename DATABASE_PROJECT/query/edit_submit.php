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
 EDIT SCHOOL
***************************************************************/
if ($target == 's') {
        if ($user == 'a') {
                $sname=$_POST['sname'];
                $semail=$_POST['semail'];
                $addy=$_POST['address'];
                $password=$_POST['password'];   
                $check = mysql_query("SELECT * FROM School WHERE sname = '" . $sname . "'");
                if (mysql_num_rows($check) >= 2) {
                        echo "School name already exists.";
                } else {
                        mysql_query ("UPDATE School SET sname = '$sname', semail = '$semail', address = '$addy', password = '$password' WHERE sid = $id"); 
                        echo "School information successfully updated.";
                }
        }
}
/***************************************************************
 EDIT EVENT
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
		mysql_query("UPDATE Event SET ename = '$ename', venue = '$venue', stime = '$stime', etime = '$etime' WHERE eid=$id");
		echo "Event Update successful.";
	}
	
}
/***************************************************************
 EDIT TEACHER
***************************************************************/
if ($target == 't') {
	if ($user == 's') {
		$sid = $_SESSION['username'];
	} else {$sid = $_GET['sid'];}
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $sub=$_POST['subject'];
        $perc=$_POST['percentage'];
        
        
        mysql_query("UPDATE Teacher SET fname = '$fname', lname = '$lname', subject = '$sub' WHERE tid = $id"); 
        mysql_query("UPDATE Teaches SET percentage = $perc WHERE tid = $id and sid = $sid");
        echo "Teacher information successfully updated.";
}
/***************************************************************
 EDIT PARENT
***************************************************************/
if ($target == 'p') {
        
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        if ($user == 'a') {
                $pemail=$_POST['pemail'];
                $check = mysql_query("SELECT * FROM Parent WHERE pemail = '$pemail'");
                if (mysql_num_rows($check) > 1) {
                        echo "Parent email address already exists.";
                } else {
                        mysql_query ("UPDATE Parent SET pemail = '$pemail', fname = '$fname', lname = '$lname' WHERE pemail = '$id'");
                        echo "Parent information successfully updated.";
                }
        } else if ($user == 'p') {
                mysql_query ("UPDATE Parent SET fname = '$fname', lname = '$lname' WHERE pemail = '" . $_SESSION['username'] . "'");
                echo "Parent information successfully updated.";
        }
}
?>
</body>
</html>
