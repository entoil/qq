<?php

$hostname = 'cits2232.csse.uwa.edu.au'; 
$dbname   = 'group16_db'; 
$username = '20951255';
$password = 'smudge12'; 

mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');

mysql_select_db($dbname) or DIE('Database name is not available!');

?>
