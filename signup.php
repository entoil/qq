
<?php

include("header.php");

session_start();
if (isset($_SESSION['username'])) {	header('Location: /u'); }

?>

<header> QQ </header>

<section>

<h1>Sign Up</h1>

<form action="submit_signup.php" method="POST" name="form"> 
    <table cellspacing='0' cellpadding='4'>
    <tr><td>Username:</td><td><input type="text" name="username" size="18" maxlength="25"></td></tr>
    <tr><td>Password:</td><td><input type="password" name="password" size="18" maxlength="25"></td></tr>
    <tr><td>Re-enter:</td><td><input type="password" name="password" size="18" maxlength="25"></td></tr>
    <tr><td>E-mail:</td><td><input type="email" name="email" size="18" maxlength="25"></td></tr>

    </table>
    <br />
   	<table>
    <tr><td><input type="submit" value="Sign Up"></td></tr>
    </table>
</form><br><br>

<?php include("footer.php"); ?>
