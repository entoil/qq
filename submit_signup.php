<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 

include('config.inc');

$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];

	$check = mysql_query("SELECT * FROM Parent WHERE pemail = '" . $email . "'");
	if (mysql_num_rows($check) >= 1) {
		echo "Account already exists.";
	} else {
		mysql_query ("INSERT INTO Parent (pemail,fname,lname) VALUES ('$email','$first_name','$last_name')");
		echo "Sign-up successful. <br>Your username is: <strong>$email</strong>";
	}
?>
</body>
</html>
