<?php

session_start();
include("header.php");
include("config.inc");

?>

<header>QQ</header>
<section>

<?php

if (isset($_SESSION['username'])) {
	
	$user = $_SESSION['username'];
	header('Location: u');
	
} else {

	echo "
	
	<p>Welcome to QQ, an online questionnaire maker.</p>

	<p>You can make a free questionnaire with multiple answer types, and look at the results at any time.</p>

	<p><a href='create.php'>Create an account here.</a><p>
	<p><a href='login.php'>Login here.</a><p>
	
	";
}
?>
<?php include("footer.php"); ?>