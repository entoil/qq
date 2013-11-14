<?php

include("header.php");

session_start();
if (isset($_SESSION['username'])) {	header('Location: /u'); }

?>

<header> QQ </header>

<section>

<h1>Sign Up</h1>

<?php 

include('config.inc');

$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];

	$check = mysql_query("SELECT * FROM users WHERE username = '" . $username . "' OR email = '" . $email . "'");
	if (mysql_num_rows($check) != 0) {
		echo "Account with the username or email already exists.<br \><br \><a href='signup.php'>Back</a><br \>";
	} else {
		mysql_query ("INSERT INTO users (username,password,email) VALUES ('$username','$password','$email')");
		echo "Successfully signed up with username " . $username . "!<br \><br \><a href='login.php'>Login</a>";
	}
?>

<?php include("footer.php"); ?>
