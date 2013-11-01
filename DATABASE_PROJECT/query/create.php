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
<script type="text/javascript">

/***************************************************************
  DROP DOWN DATE SELECT
  			Code based on script found at JavaScriptKit.com
***************************************************************/

var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

function populatedropdown(dayfield, monthfield, yearfield){
var today=new Date()
var dayfield=document.getElementById(dayfield)
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)

for (var i=1; i<32; i++) {
dayfield.options[i]=new Option(i, i)
		if (i < 10) { dayfield.options[i]=new Option("0" + i, i) }
		else { dayfield.options[i]=new Option(i, i) }
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true)
}
for (var m=0; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], monthtext[m])
monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true)

var thisyear=today.getFullYear()
for (var y=0; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear+=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true)

}

function timedropdown(hourfield, minutefield){

var hourfield=document.getElementById(hourfield)
var minutefield=document.getElementById(minutefield)

var hour = 8
	for (var i=0; i<12; i++) {
		if (hour < 10) { hourfield.options[i]=new Option("0" + hour, hour) }
		else { hourfield.options[i]=new Option(hour, hour) }
	hour++
	}

var minute = 0
	for (var t=0; t<12; t++) {
		if (minute < 10) { minutefield.options[t]=new Option("0" + minute, minute) }
		else { minutefield.options[t]=new Option(minute, minute) }
	minute += 5
	}
}
</script>
<link href="../main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 

include('../config.inc');

$target = $_GET['target'];
$user = $_GET['user'];
/***************************************************************
 CREATE TABLES
***************************************************************/
if ($target == 'table') {

	if ($user == 'a') {
		echo "<h3>Create Table</h3>";
		echo "Upload SQL file for table creation<br><br>";
		echo "<form action=table_upload.php?target=tables method=post enctype=multipart/form-data>
			<label for=file>Filename:</label>
			<input type=file name=file id=file>
			<br>
			<input type=submit name=submit value=Submit>
			</form>";
	}

	
}
/***************************************************************
 CREATE SCHOOL
***************************************************************/
if ($target == 's')  {
	echo "<h3>Add School</h3>";
	echo "<form action=create_submit.php?target=s&user=a method=post>
		<table>
	<tr><td>School Name:</td> <td><input type=text name=sname /></td></tr>
	<tr><td>School Email:</td> <td><input type=text name=semail /></td></tr>
	<tr><td>School Address:</td> <td><input type=text name=address /></td></tr>
	<tr><td>School Password:</td> <td><input type=password name=password /></td></tr>
		</table>
	<br><input type=submit>
	</form>";
	echo "<br><p> </p><br>";
	echo "<h3>Upload School Information</h3>";
	echo "Fields must be seperated by commas.<br><br>";
		echo "<form action=table_upload.php?target=s method=post enctype=multipart/form-data>
			<label for=file>Filename:</label>
			<input type=file name=file id=file>
			<br><br>
			<input type=submit name=submit value=Submit>
			</form>";
}
/***************************************************************
 CREATE EVENT
***************************************************************/
if ($target == 'e') {
	if ($user == 'a') {
		echo "<h3>Create Event</h3>";
		echo "<form action=create_submit.php?target=e&user=a method=post>
			<table>
		<tr><td>Event Name:</td> <td><input type=text name=ename /></td></tr>
		<tr><td>School ID:</td> <td><input type=text name=sid /></td></tr>
		<tr><td>Event Venue:</td> <td><input type=text name=venue /></td></tr>
		
		<tr><td>Start Day:</td> <td>
		<select id=\"daydropdown\" name=\"daydropdown\">
		</select> 
		<select id=\"monthdropdown\" name=\"monthdropdown\">
		</select> 
		<select id=\"yeardropdown\" name=\"yeardropdown\">
		</select> </td></tr>
		
		<tr><td>Start Time:</td> <td>
		<select id=\"hourdropdown\" name=\"hourdropdown\">
		</select> :
		<select id=\"minutedropdown\" name=\"minutedropdown\">
		</select> 
		</td></tr>
		
		<tr><td>End Day:</td> <td>
		<select id=\"daydropdown2\" name=\"daydropdown2\">
		</select> 
		<select id=\"monthdropdown2\" name=\"monthdropdown2\">
		</select> 
		<select id=\"yeardropdown2\" name=\"yeardropdown2\">
		</select>  </td></tr>
		
		<tr><td>End Time:</td> <td>
		<select id=\"hourdropdown2\" name=\"hourdropdown2\">
		</select> :
		<select id=\"minutedropdown2\" name=\"minutedropdown2\">
		</select> </td></tr>
			</table>
			<br><input type=submit>
			</form>";

	} else if ($user == 's') {
		echo "<h3>Create Event</h3>";
		echo "<form action=create_submit.php?target=e&user=s method=post>
			<table>
		<tr><td>Event Name:</td> <td><input type=text name=ename /></td></tr>
		<tr><td>Event Venue:</td> <td><input type=text name=venue /></td></tr>
		<tr><td>Start Day:</td> <td>
		<select id=\"daydropdown\" name=\"daydropdown\">
		</select> 
		<select id=\"monthdropdown\" name=\"monthdropdown\">
		</select> 
		<select id=\"yeardropdown\" name=\"yeardropdown\">
		</select> </td></tr>
		
		<tr><td>Start Time:</td> <td>
		<select id=\"hourdropdown\" name=\"hourdropdown\">
		</select> :
		<select id=\"minutedropdown\" name=\"minutedropdown\">
		</select> 
		</td></tr>
		
		<tr><td>End Day:</td> <td>
		<select id=\"daydropdown2\" name=\"daydropdown2\">
		</select> 
		<select id=\"monthdropdown2\" name=\"monthdropdown2\">
		</select> 
		<select id=\"yeardropdown2\" name=\"yeardropdown2\">
		</select>  </td></tr>
		
		<tr><td>End Time:</td> <td>
		<select id=\"hourdropdown2\" name=\"hourdropdown2\">
		</select> :
		<select id=\"minutedropdown2\" name=\"minutedropdown2\">
		</select> </td></tr>
			</table>
			<br><input type=submit>
			</form>";
	}
}
/***************************************************************
 CREATE TEACHER
***************************************************************/
if ($target == 't') {
	if ($user == 'a') {
		echo "<h3>Add Teacher</h3>";
		echo "<form action=create_submit.php?target=t&user=a method=post>
			<table>
		<tr><td>First Name:</td> <td><input type=text name=fname /></td></tr>
		<tr><td>Last Name:</td> <td><input type=text name=lname /></td></tr>
		<tr><td>Subject:</td> <td><input type=text name=subject /></td></tr>
			</table>
		<br><input type=submit>
		</form><br><br><br>";
		echo "<h3>Upload Teacher Information</h3>";
		echo "Fields must be seperated by commas.<br><br>";
			echo "<form action=table_upload.php?target=t method=post enctype=multipart/form-data>

				<label for=file>Filename:</label>

				<input type=file name=file id=file>
				<br>

				<br><input type=submit name=submit value=Submit>

				</form>";
	} else if ($user == 's') {
		echo "<h3>Add  Teacher</h3>";
		echo "<form action=create_submit.php?target=t&user=s method=post>
			<table>
		<tr><td>First Name:</td> <td><input type=text name=fname /></td></tr>
		<tr><td>Last Name:</td> <td><input type=text name=lname /></td></tr>
		<tr><td>Subject:</td> <td><input type=text name=subject /></td></tr>
			</table>
		<br><input type=submit>
		</form><br><br><br>";
		echo "<h3>Upload Teacher Information</h3>";
		echo "Fields must be seperated by commas.<br><br>";
			echo "<form action=table_upload.php?target=t method=post enctype=multipart/form-data>

				<label for=file>Filename:</label>

				<input type=file name=file id=file>
				<br>

				<br><input type=submit name=submit value=Submit>

				</form>";
	}
	
}
/***************************************************************
 CREATE APPOINTMENT
***************************************************************/
if ($target == 'a') {
	if ($user == 'a') {
		echo "<h3>Create Appointment</h3>";
			echo "<form action=create_submit.php?target=a&user=a method=post>
				<table>
			<tr><td>Teacher ID:</td> <td><input type=text name=tid /></td></tr>
			<tr><td>Event ID:</td> <td><input type=text name=eid /></td></tr>
			<tr><td>Start Day:</td> <td>
		<select id=\"daydropdown\" name=\"daydropdown\">
		</select> 
		<select id=\"monthdropdown\" name=\"monthdropdown\">
		</select> 
		<select id=\"yeardropdown\" name=\"yeardropdown\">
		</select> </td></tr>
		
		<tr><td>Start Time:</td> <td>
		<select id=\"hourdropdown\" name=\"hourdropdown\">
		</select> :
		<select id=\"minutedropdown\" name=\"minutedropdown\">
		</select> 
		</td></tr>
		
		<tr><td>End Day:</td> <td>
		<select id=\"daydropdown2\" name=\"daydropdown2\">
		</select> 
		<select id=\"monthdropdown2\" name=\"monthdropdown2\">
		</select> 
		<select id=\"yeardropdown2\" name=\"yeardropdown2\">
		</select>  </td></tr>
		
		<tr><td>End Time:</td> <td>
		<select id=\"hourdropdown2\" name=\"hourdropdown2\">
		</select> :
		<select id=\"minutedropdown2\" name=\"minutedropdown2\">
		</select> </td></tr>
			</table>
			<input type=submit>
			</form>";
	} else if ($user == 's') {
		echo "<h3>Create Appointment</h3>";
			echo "<form action=create_submit.php?target=a&user=s method=post>
				<table>
			<tr><td>Teacher ID:</td> <td><input type=text name=tid /></td></tr>
			<tr><td>Event ID:</td> <td><input type=text name=eid /></td></tr>
			<tr><td>Start Day:</td> <td>
		<select id=\"daydropdown\" name=\"daydropdown\">
		</select> 
		<select id=\"monthdropdown\" name=\"monthdropdown\">
		</select> 
		<select id=\"yeardropdown\" name=\"yeardropdown\">
		</select> </td></tr>
		
		<tr><td>Start Time:</td> <td>
		<select id=\"hourdropdown\" name=\"hourdropdown\">
		</select> :
		<select id=\"minutedropdown\" name=\"minutedropdown\">
		</select> 
		</td></tr>
		
		<tr><td>End Day:</td> <td>
		<select id=\"daydropdown2\" name=\"daydropdown2\">
		</select> 
		<select id=\"monthdropdown2\" name=\"monthdropdown2\">
		</select> 
		<select id=\"yeardropdown2\" name=\"yeardropdown2\">
		</select>  </td></tr>
		
		<tr><td>End Time:</td> <td>
		<select id=\"hourdropdown2\" name=\"hourdropdown2\">
		</select> :
		<select id=\"minutedropdown2\" name=\"minutedropdown2\">
		</select> </td></tr>
				</table>
			<input type=submit>
			</form>";
	}
}
/***************************************************************
 CREATE PARENT
***************************************************************/
if ($target == 'p') {
	echo "<h3>Register Parent</h3>";
		echo "<form action=create_submit.php?target=p&user=a method=post>
			<table>
		<tr><td>First Name:</td> <td><input type=text name=fname /></td></tr>
		<tr><td>Last Name:</td> <td><input type=text name=lname /></td></tr>
		<tr><td>Email Address:</td> <td><input type=text name=pemail /></td></tr>
			</table>
			<input type=submit>
			</form>";
}
/***************************************************************
 CREATE BOOKING
***************************************************************/

//Using event ID and teacher ID to bring up a table of slots for those teachers and events.

if ($target == 'b') {
	if ($user == 'a') {
		echo "<h3>Register Booking</h3>";
			echo "<form action=create_submit.php?target=b&user=a method=post>
				<table>
			<tr><td>Parent Email:</td> <td><input type=text name=pemail /></td></tr>
			<tr><td>Child Name:</td> <td><input type=text name=childname /></td></tr>
			<tr><td>Appointment ID:</td> <td><input type=text name=jid /></td></tr>
				</table>
			<input type=submit>
			</form>";
	} else if ($user == 'p') {
		echo "<h3>Register booking</h3>";
			echo "<form action=create_submit.php?target=b&user=p method=post>
				<table>
			<tr><td>Appointment ID:</td> <td><input type=text name=jid /></td></tr>
			<tr><td>Child Name:</td> <td><input type=text name=childname /></td></tr>
				</table>
			<input type=submit>
			</form>";
	}
}
/***************************************************************
 ADD TEACHER TO SCHOOL
***************************************************************/
if ($target == 'c') {
	if ($user == 'a') {
		echo "<h3>Add Teacher to School</h3>";
			echo "<form action=create_submit.php?target=c&user=a method=post>
				<table>
			<tr><td>School ID:</td> <td><input type=text name=sid /></td></tr>
			<tr><td>Teacher ID:</td> <td><input type=text name=tid /></td></tr>
			<tr><td>Focus of teacher on school:</td> <td><input type=text name=percentage />%</td></tr>
				</table>
			<input type=submit>
			</form>";
	} else if ($user == 's') {
		echo "<h3>Add Teacher to School</h3>";
			echo "<form action=create_submit.php?target=c&user=s method=post>
				<table>
			<tr><td>Teacher ID:</td> <td><input type=text name=tid /></td></tr>
			<tr><td>Focus of teacher on school:</td> <td><input type=text name=percentage />%</td></tr>
				</table>
			<input type=submit>
			</form>";
	}
}
?>

<script type="text/javascript">

window.onload=function(){
populatedropdown("daydropdown", "monthdropdown", "yeardropdown");
populatedropdown("daydropdown2", "monthdropdown2", "yeardropdown2");
timedropdown("hourdropdown","minutedropdown");
timedropdown("hourdropdown2","minutedropdown2");
}
</script>
</body>
</html>
