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
	border: 1px solid #000;
	padding-top: 40px;
	font-size: 14px;
	margin: auto;
	margin-bottom: 5px;
	margin-top: 80px;
}
section {
	min-height: 400px;
	width: 410px;
	border: 1px solid #000;
	margin: auto;
	padding: 20px;
}
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	line-height: 20px;
	letter-spacing: 1px;
}
select, input { 
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	margin-left: 17px; 
	border: solid 1px #000;
	position: relative;
	top: 4px;
}

input :
</style>

</head>
<?php 

$webid = $_SERVER['QUERY_STRING'];;

$query = sprintf("SELECT * FROM `questions` NATURAL JOIN `surveys` WHERE webid = '" . $webid . "' ORDER BY number ASC;");

$result = mysql_query($query);

$row = mysql_fetch_array($result);

 ?>
<body>
<header><?php echo $row['name']; ?></header>
<section>
<?php

echo "<p>" . $row['description'] . "</p>";

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


while($row = mysql_fetch_array($result))
{
	echo "<p>" . $row['number'] . ". " . $row['question'] . "</p>";
	$type = $row['qtype'];
	
	if ($type == "tf") {
		echo "	<input type='radio' name='tf' value='true' id='true'> <label for='true'>True</label>
				<input type='radio' name='tf' value='false' id='false'> <label for='false'>False</label>";
	} else if ($type == "age") {
		echo "<select name='age' id='age'>";
		for($i = 13; $i <= 99; $i += 1){
     		echo("<option value='{$i}'>{$i}</option>");
		}	
		echo "</select>";
	} else if ($type == "sex") {
		echo "	<input type='radio' name='sex' value='male' id='male'><label for='male'>Male</label><br />
				<input type='radio' name='sex' value='female' id='female'><label for='female'>Female</label>";
	} else if ($type == "scale") {
		echo "	<input type='radio' name='scale' value='1' id='1'> <label for='1'>1</label>
				<input type='radio' name='scale' value='2' id='2'> <label for='2'>2</label>
				<input type='radio' name='scale' value='3' id='3'> <label for='3'>3</label>
				<input type='radio' name='scale' value='4' id='4'> <label for='4'>4</label>
				<input type='radio' name='scale' value='5' id='5'> <label for='5'>5</label>";
	} else if ($type == "yn") {
		echo "	<input type='radio' name='yn' value='yes' id='yes'> <label for='yes'>Yes</label>
				<input type='radio' name='yn' value='no' id='no'> <label for='no'>No</label>";
	} else if ($type == "opinion") {
		echo "	<input type='radio' name='opinion' value='sagree' id='sagree'> <label for='sagree'>Strongly Agree</label><br />
				<input type='radio' name='opinion' value='agree' id='agree'> <label for='agree'>Agree</label><br />
				<input type='radio' name='opinion' value='neutral' id='neutral'> <label for='neutral'>Neutral</label><br />
				<input type='radio' name='opinion' value='disagree' id='disagree'> <label for='disagree'>Disagree</label><br />
				<input type='radio' name='opinion' value='sdisagree' id='sdisagree'> <label for='sdisagree'>Strongly Disagree</label><br />
";
	} else if ($type == "often") {
		echo "	<input type='radio' name='often' value='sagree' id='sagree'> <label for='sagree'>Always</label><br />
				<input type='radio' name='often' value='agree' id='agree'> <label for='agree'>Often</label><br />
				<input type='radio' name='often' value='neutral' id='neutral'> <label for='neutral'>Neutral</label><br />
				<input type='radio' name='often' value='disagree' id='disagree'> <label for='disagree'>Rarely</label><br />
				<input type='radio' name='often' value='sdisagree' id='sdisagree'> <label for='sdisagree'>Never</label><br />
";
	}
	
}
mysql_free_result($result);


?>

<!--

<form>
<p>1. What is your age?</p>
<select name="age" id="age">
<?php
for($i = 18; $i <= 80; $i += 1){
     echo("<option value='{$i}'>{$i}</option>");
}		
?>
</select>


<p>2. What is your gender?</p>
<input type='radio' name='sex' value='male' id='male'><label for='male'>Male</label><br />
<input type='radio' name='sex' value='female' id='female'><label for='female'>Female</label>

<p>3. On a scale of 1 to 5, how is the weather?</p>
<input type='radio' name='grade' value='1' id='1'> <label for='1'>1</label>
<input type='radio' name='grade' value='2' id='2'> <label for='2'>2</label>
<input type='radio' name='grade' value='3' id='3'> <label for='3'>3</label>
<input type='radio' name='grade' value='4' id='4'> <label for='4'>4</label>
<input type='radio' name='grade' value='5' id='5'> <label for='5'>5</label>

<p>4. You are a goose.</p>
<input type='radio' name='tf' value='true' id='true'> <label for='true'>True</label>
<input type='radio' name='tf' value='false' id='false'> <label for='false'>False</label>

<p>5. Do you like cats?</p>
<input type='radio' name='yn' value='yes' id='yes'> <label for='yes'>Yes</label>
<input type='radio' name='yn' value='no' id='no'> <label for='no'>No</label>

<p>6. Pancakes are Delicious. </p>
<input type='radio' name='agrdis' value='sagree' id='sagree'> <label for='sagree'>Strongly Agree</label><br />
<input type='radio' name='agrdis' value='agree' id='agree'> <label for='agree'>Agree</label><br />
<input type='radio' name='agrdis' value='neutral' id='neutral'> <label for='neutral'>Neutral</label><br />
<input type='radio' name='agrdis' value='disagree' id='disagree'> <label for='disagree'>Disagree</label><br />
<input type='radio' name='agrdis' value='sdisagree' id='sdisagree'> <label for='sdisagree'>Strongly Disagree</label><br />
-->
<br /><br />
<input type='button' style='margin-left: 170px; padding: 5px;' value='Submit'/>
<br />
</form>

</section>
</body>
</html>
