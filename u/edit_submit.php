<?php

session_start();
include("header.php");
include("../config.inc");

?>

<?php 
	$webid = $_SERVER['QUERY_STRING'];
	$name = $_POST['name'];
	$description = $_POST['description'];

	// Get SID
	$result = mysql_query("SELECT * FROM surveys WHERE webid = '$webid'");
	$row = mysql_fetch_assoc($result);
	$sid = $row['sid'];
	echo "Survey id is $sid <br />";

	// Update General Information
	mysql_query("UPDATE surveys SET name = '$name', description = '$description' WHERE webid = '$webid'"); 

	// Delete Questions
	$query = sprintf("SELECT * FROM `questions` NATURAL JOIN `surveys` NATURAL JOIN `users` WHERE webid = '" . $webid . "' and username = '" . $user . "';");
	$result = mysql_query($query);
	if (mysql_num_rows($result) == 0) {	header("Location: ?$webid"); }
	$sql = "DELETE FROM `questions` WHERE sid = '" . $sid . "';";
	if (!mysql_query($sql))	{die('Error: ' . mysql_error());}

	// Create Questions
	$qnum = 1;
	foreach ($_POST as $key => $value) {
	    //echo $key . ' : ' . $value . '<br />';
    	if ($key == 'age') {
    		mysql_query ("INSERT INTO questions (sid, number, question, qtype) VALUES ($sid, $qnum, 'What is your age?', 'age')");
    		$qnum++;
    	} else if ($key == 'sex') {
    		mysql_query ("INSERT INTO questions (sid, number, question, qtype) VALUES ($sid, $qnum, 'What is your gender?', 'sex')");
    		$qnum++;
    	} else if ($key[0] == 'q') {
    		echo "IT'S A QUESTION! QUESTION:" . $value;
    		echo " AND THE TYPE?: " . $_POST[preg_replace('/q/', 't', $key, 1)] . "<br />";

    		$qtype = $_POST[preg_replace('/q/', 't', $key, 1)];
    		mysql_query ("INSERT INTO questions (sid, number, question, qtype) VALUES ($sid, $qnum, '$value', '$qtype')");
    		$qnum++;
    	}
    }

	header('Location: success.php?edit');
?>