<?php

session_start();
include("header.php");
include("../config.inc");

?>

<?php 


	$name = $_POST['name'];
	$description = $_POST['description'];

	// Get UID
	$result = mysql_query("SELECT * FROM users WHERE username = '" . $user . "'");
	$row = mysql_fetch_assoc($result);
	$uid = $row['uid'];

	$webid = substr(uniqid(),6);

	// Create Survey
	mysql_query ("INSERT INTO surveys (uid, name, description, webid) VALUES ($uid, '$name', '$description', '$webid')");
	

	// Get SID
	$result = mysql_query("SELECT * FROM surveys WHERE webid = '$webid'");
	$row = mysql_fetch_assoc($result);
	$sid = $row['sid'];
	echo "Survey id is $sid <br />";

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

    	header('Location: success.php?create');
    }

?>