<head><link href="../main.css" rel="stylesheet" type="text/css" /></head>
<?php
/***************************************************************
  PHP file executing file upload-related queries.
***************************************************************/
include('../config.inc');

$target = $_GET['target'];

$url = $_FILES["file"]["tmp_name"];

if ($target == 'tables') {
	$sql = explode(";",file_get_contents($url));

	$first = $sql[0];
	mysql_query("$first");

	foreach($sql as $query) { 
		echo $query; 
		mysql_query("$query");

		echo "<br>"; 
		if (mysql_errno()) { 
		  $error = "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>"; 

		 }
	}
	echo "<br>Upload successful.";
}

if ($target == 's') {
	
	$sql = explode("\n",file_get_contents($url));

	foreach($sql as $query) { 
		echo $query; 
		echo "<br>"; 
		if ($query != "") {
		mysql_query("INSERT INTO School VALUES($query)");
		}
		if (mysql_errno()) { 
		  $error = "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>"; 

		 } 
	}
	echo "<br>Upload successful.";
}

if ($target == 't') {
	
	$sql = explode("\n",file_get_contents($url));

	foreach($sql as $query) { 
		echo $query; 
		echo "<br>"; 
		if ($query != "") {
		mysql_query("INSERT INTO Teacher VALUES($query)");
		}
		if (mysql_errno()) { 
		  $error = "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>"; 

		}
	}
	echo "<br>Upload successful.";

}

?>
