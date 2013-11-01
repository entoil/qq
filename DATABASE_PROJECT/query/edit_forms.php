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
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
}
for (var m=0; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], monthtext[m])
monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
var thisyear=today.getFullYear()
for (var y=0; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear+=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year

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
</head>

<body>
<?php 

include('../config.inc');

$target = $_GET['target'];
$user = $_GET['user'];
if ($user != 'p') {
	$id = $_POST['id'];
}

/***************************************************************
 EDIT SCHOOL
***************************************************************/
if ($target == 's')  {
        $query = "SELECT * FROM School where sid=$id";
        $result = mysql_query($query);
        if (mysql_num_rows($result) < 1) {
                echo "School ID does not exist.";
        } else {
                $row = mysql_fetch_assoc($result);
                echo "<h2>Edit school information:</h2>";
                echo "<form action=edit_submit.php?target=s&user=a&id=$id method=post>
                        <table>
                <tr><td>School Name:</td> <td><input type=text name=sname value=\""; echo $row['sname']; echo  "\"/></td></tr>
                <tr><td>School Email:</td> <td><input type=text name=semail value=\""; echo $row['semail']; echo  "\"/></td></tr>
                <tr><td>School Address:</td> <td><input type=text name=address value=\""; echo $row['address']; echo  "\"/></td></tr>
                <tr><td>School Password:</td> <td><input type=password name=password value=\""; echo $row['password']; echo  "\"/></td></tr>
                        </table>
                <input type=submit>
                </form>";
        }
}

/***************************************************************
 CREATE EVENT
***************************************************************/
if ($target == 'e') {
		$result = mysql_query("SELECT eid AS 'Event ID', ename AS 'Event', venue AS 'Venue', stime AS 'Start Time', etime AS 'End Time' FROM Event WHERE eid=$id");
		if (mysql_num_rows($result) < 1) {
			echo "Event ID does not exist.";
		} else if ($user == 's' && mysql_num_rows(mysql_query("SELECT * FROM Creates WHERE eid=$id AND sid='" . $_SESSION['username'] . "'")) < 1) {
				echo "Event does not belong to your school.";
		} else {
			$fields_num = mysql_num_fields($result);
			echo "<h3>Edit Event:</h3>";
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
			
			$query = "SELECT * FROM Event NATURAL JOIN Creates where eid=$id";
			$result = mysql_query($query);
		        $row = mysql_fetch_assoc($result);
			echo "<h2>Create an event</h2>";
			if ($user == 'a') {echo "<form action=edit_submit.php?target=e&user=a&id=$id method=post>";}
			else {echo "<form action=edit_submit.php?target=e&user=s&id=$id method=post>";}
			echo "
				<table>
			<tr><td>Event Name:</td> <td><input type=text name=ename value=\""; echo $row['ename']; echo  "\"/></td></tr>
			<tr><td>Event Venue:</td> <td><input type=text name=venue  value=\""; echo $row['venue']; echo  "\"/></td></tr>
		
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
 EDIT TEACHER
***************************************************************/
if ($target == 't') {
	if ($_SESSION['username'] != 'admin') {
		$sid = $_SESSION['username'];
	} else {$sid = $_POST['sid'];}
	
        $query = "SELECT * FROM Teacher NATURAL JOIN Teaches where Teaches.tid=$id";
        $query2 = "SELECT * FROM Teacher NATURAL JOIN Teaches where Teaches.tid=$id and sid = $sid";
        $result = mysql_query($query);
        $result2 = mysql_query($query2);
        if (mysql_num_rows($result) < 1) {
                echo "Teacher ID does not exist.";
        } else if (mysql_num_rows($result2) < 1) {
                echo "Teacher does not teach at the school.";
        } else {
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);
                echo "<h2>Edit Teacher information:</h2>";
                if ($user == 's') {echo "<form action=edit_submit.php?target=t&user=s&id=$id&sid=$sid method=post>";}
		if ($user == 'a') {echo "<form action=edit_submit.php?target=t&user=a&id=$id&sid=$sid method=post>";}
		echo "
                <table>
                <tr><td>First Name:</td> <td><input type=text name=fname value=\""; echo $row['fname']; echo  "\"/></td></tr>
                <tr><td>Last Name:</td> <td><input type=text name=lname value=\""; echo $row['lname']; echo  "\"/></td></tr>
                <tr><td>Subject:</td> <td><input type=text name=subject value=\""; echo $row['subject']; echo  "\"/></td></tr>
                <tr><td>Percentage:</td> <td><input type=text name=percentage value=\""; echo $row['percentage']; echo  "\"/></td></tr>
                        </table>
                <input type=submit>
                </form>";
        }
}
/***************************************************************
 EDIT PARENT
***************************************************************/
if ($target == 'p') {
        if ($user == 'a') {
                $result = mysql_query("SELECT * FROM Parent where pemail='$id'");
                if (mysql_num_rows($result) < 1) {
                        echo "Parent email address does not exist.";
                } else {
                        $row = mysql_fetch_assoc($result);
                        echo "<h2>Edit parent information:</h2>";
                        echo "<form action=edit_submit.php?target=p&user=a&id=$id method=post>
                                <table>
                        <tr><td>Email Address:</td> <td><input type=text name=pemail value=\""; echo $row['pemail']; echo  "\"/></td></tr>
                        <tr><td>First Name:</td> <td><input type=text name=fname value=\""; echo $row['fname']; echo  "\"/></td></tr>
                        <tr><td>Last Name:</td> <td><input type=text name=lname value=\""; echo $row['lname']; echo  "\"/></td></tr>
                                </table>
                        <input type=submit>
                        </form>";
                }
        } else if ($user == 'p') {
        	$parent = $_SESSION['username'];
                $result = mysql_query("SELECT * FROM Parent where pemail='$parent'");
                $row = mysql_fetch_assoc($result);
                echo "<h2>Edit parent information:</h2>";
                echo "<form action=edit_submit.php?target=p&user=p&id=$parent method=post>
                        <table>
                <tr><td>First Name:</td> <td><input type=text name=fname value=\""; echo $row['fname']; echo  "\"/></td></tr>
                <tr><td>Last Name:</td> <td><input type=text name=lname value=\""; echo $row['lname']; echo  "\"/></td></tr>
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
