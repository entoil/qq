<?php

include("../config.inc");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QQ - Online Questionnaire Maker</title>
<style type="text/css">
header {
	text-align: center;
	letter-spacing: 2px;
	height: 60px;
	width: 450px;
	border: 1px solid #999;
	padding-top: 40px;
	font-size: 14px;
	margin: auto;
	margin-bottom: 5px;
	margin-top: 80px;
		background-color: #CCC;
	background-image: url(../images/hbg.png);
		-moz-box-shadow: 5px 5px 0 5px #BBB;
	-webkit-box-shadow: 5px 5px 0 5px#BBB;
	box-shadow: 2px 2px 0 0px #BBB;
}
section {
	min-height: 400px;
	width: 410px;
	border: 1px solid #999;
	margin: auto;
	padding: 20px;
		background-color: #FFF;
		-moz-box-shadow: 5px 5px 0 5px #BBB;
	-webkit-box-shadow: 5px 5px 0 5px#BBB;
	box-shadow: 2px 2px 0 0px #BBB;
}
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	line-height: 20px;
	letter-spacing: 1px;
	background-image: url(../images/bg.png);
	margin-bottom: 100px;
}
select, input { 
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	margin-left: 17px; 
	border: solid 1px #000;
	position: relative;
	top: 4px;
}
</style>

</head>
<?php 

$webid = $_SERVER['QUERY_STRING'];;
$error = "";

$query = sprintf("SELECT * FROM `questions` NATURAL JOIN `surveys` WHERE webid = '" . $webid . "' ORDER BY number ASC;");
$result = mysql_query($query);
$row = mysql_fetch_array($result);

 ?>
<body>
<header><?php echo $row['name']; ?></header>
<section>

<?php
echo "<p>" . $row['description'] . "</p>";



$webid = $_SERVER['QUERY_STRING'];
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Get SID
	
	$result = mysql_query("SELECT * FROM surveys WHERE webid = '$webid'");
	$row = mysql_fetch_assoc($result);
	$sid = $row['sid'];
	//$ip = substr(uniqid(),8); 
	$ip = $_SERVER['REMOTE_ADDR'];

	// Check Already Completed
	$qnum = 1;
	$result = mysql_query("SELECT * FROM participants WHERE sid = $sid AND ip = '$ip'");
	if (mysql_num_rows($result) != 0) {	
		$error = "You have already participated in this survey.";
	} else {
		// Create New Participant
		$date = date("Y-m-d H:i:s");
		mysql_query ("INSERT INTO participants (sid, ip, date) VALUES ($sid, '$ip', '$date')");
		
		// Get number of questions
		$result = mysql_query("SELECT * FROM `questions` WHERE sid = $sid ORDER BY number DESC");
		$row = mysql_fetch_assoc($result);
		$qtotal = $row['number'];

		// Get PID
		$result = mysql_query("SELECT * FROM participants WHERE sid = $sid AND ip = '$ip'");
		$row = mysql_fetch_assoc($result);
		$pid = $row['pid'];

		// Send Answer
		foreach ($_POST as $key => $value) {
			//echo $key . ' : ' . $value . '<br />';
    		insert($value, $qnum, $sid, $pid);
    		$qnum++;
		}

		// -1 for the submit button input, -1 for the final ++
		$qnum = $qnum - 2;

		if ($qnum != $qtotal) {
	    		// Delete Participant
	    		$sql = "DELETE FROM `participants` WHERE pid = $pid;";
				if (!mysql_query($sql))	{die('Error: ' . mysql_error());}
				$error = "All fields must be complete.";
		} else {
			header("Location: success.php");
		}
	}

}

// Create Answer
function insert($answer, $qnum, $sid, $pid)
{
	// Get QID
	$result = mysql_query("SELECT * FROM questions WHERE sid = $sid AND number = $qnum");
	$row = mysql_fetch_assoc($result);
	$qid = $row['qid'];
    $answer = trim($answer);
    $answer = stripslashes($answer);
    $answer = htmlspecialchars($answer);

    mysql_query ("INSERT INTO answers (pid, qid, answer) VALUES ($pid, $qid, '$answer')");
}
?>

<?php


mysql_free_result($result);

$query = sprintf("SELECT * FROM `questions` NATURAL JOIN `surveys` WHERE webid = '" . $webid . "' ORDER BY number ASC;");
//$query = sprintf("SELECT E.eid AS 'Event ID', E.ename AS 'Event', E.venue AS 'Venue', E.stime AS 'Start Time', E.etime AS 'End Time', S.sname AS 'School' FROM Event E NATURAL JOIN Creates C NATURAL JOIN School S ORDER BY eid");

$result = mysql_query($query);

if (!$result) {
	$message  = "Invalid query: " . mysql_error();
	$message .= "Whole query: " . $query;
	die($message);
}

$fields_num = mysql_num_fields($result);

echo 	"<p>" . $error . "</p><form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?$webid" . "'> ";

while($row = mysql_fetch_array($result))
{
	echo "<p>" . $row['number'] . ". " . $row['question'] . "</p>";
	$type = $row['qtype'];
	$qname = $row['number']; 

	if ($type == "tf") {
		echo "	<input type='radio' name='$qname' value='true' id='true'> <label for='true'>True</label>
				<input type='radio' name='$qname' value='false' id='false'> <label for='false'>False</label>";
	} else if ($type == "age") {
		echo "<select name='$qname' id='age'>";
		for($i = 13; $i <= 99; $i += 1){
     		echo("<option value='{$i}'>{$i}</option>");
		}	
		echo "</select>";
	} else if ($type == "sex") {
		echo "	<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="male") {echo "checked ";} echo "value='male' id='male'><label for='male'>Male</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="female") {echo "checked ";} echo "value='female' id='female'><label for='female'>Female</label>";
	} else if ($type == "scale") {
		echo "	<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="1") {echo "checked ";} echo "value='1' id='1'> <label for='1'>1</label>
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="2") {echo "checked ";} echo "value='2' id='2'> <label for='2'>2</label>
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="3") {echo "checked ";} echo "value='3' id='3'> <label for='3'>3</label>
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="4") {echo "checked ";} echo "value='4' id='4'> <label for='4'>4</label>
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="5") {echo "checked ";} echo "value='5' id='5'> <label for='5'>5</label>";
	} else if ($type == "yn") {
		echo "	<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="yes") {echo "checked ";} echo "value='yes' id='yes'> <label for='yes'>Yes</label>
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="no") {echo "checked ";} echo "value='no' id='no'> <label for='no'>No</label>";
	} else if ($type == "opinion") {
		echo "	<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="sagree") {echo "checked ";} echo "value='sagree' id='sagree'> <label for='sagree'>Strongly Agree</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="agree") {echo "checked ";} echo "value='agree' id='agree'> <label for='agree'>Agree</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="neutral") {echo "checked ";} echo "value='neutral' id='neutral'> <label for='neutral'>Neutral</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="disagree") {echo "checked ";} echo "value='disagree' id='disagree'> <label for='disagree'>Disagree</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="sdisagree") {echo "checked ";} echo "value='sdisagree' id='sdisagree'> <label for='sdisagree'>Strongly Disagree</label><br />";
	} else if ($type == "often") {
		echo "	<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="always") {echo "checked ";} echo "value='always' id='always'> <label for='always'>Always</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="often") {echo "checked ";} echo "value='often' id='often'> <label for='often'>Often</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="sometimes") {echo "checked ";} echo "value='sometimes' id='sometimes'> <label for='sometimes'>Sometimes</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="rarely") {echo "checked ";} echo "value='rarely' id='rarely'> <label for='rarely'>Rarely</label><br />
				<input type='radio' name='$qname' "; if (isset($_POST[$qname]) && $_POST[$qname]=="never") {echo "checked ";} echo "value='never' id='never'> <label for='never'>Never</label><br />";
	}
	
}
mysql_free_result($result);


?>

<br /><br />
<input type='submit' name='submit' style='margin-left: 170px; padding: 5px;' value='Submit'/>
<br /><br />
</form>

</section>
</body>
</html>
