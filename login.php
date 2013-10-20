<?php

include("header.php");

session_start();
if (isset($_SESSION['username'])) {	header('Location: /u'); }

?>

<header> QQ </header>

<section>

<h1>Login</h1>

<form action="submit_login.php" method="POST" name="form"> 
    <table cellspacing='0' cellpadding='4'>
    <tr><td>Username:</td><td><input type="text" name="user" size="18" maxlength="25"></td></tr>
    <tr><td>Password:</td><td><input type="password" name="pass" size="18" maxlength="25"></td></tr>
    </table>
    <br />
   	<table>
    <tr><td><input type="submit" value="Log In"></td>
    <td><input type="submit" value="Sign Up"> </td></tr>
    </table>
</form><br><br>

<p><a href="signup.php">Sign Up</a></p>

<?php include("footer.php"); ?>
