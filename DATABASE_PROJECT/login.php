<?php

session_start();

if (isset($_SESSION['username'])) {
	
	$user = $_SESSION['username'];
	
	if ($user == 'admin') {
	header('Location: amenu.php');
	}
	
	else if (is_numeric($user)) {
	header('Location: smenu.php');
	}
	
	else {
	header('Location: pmenu.php');
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
/****************************************************************
	User type selection - 
				Selecting parent disables password field.
****************************************************************/
function findselected() { 
   if (document.form.selmenu.value == '3') {
      document.form.pass.disabled=true;
   } else {
      document.form.pass.disabled=false;
   }
} 
function change(){
	parent.document.getElementById("main").src="phome.php";
}
</script>
</head>

<body>
<script type="text/javascript">
/****************************************************************
	Take unauthenticated users to welcome page
****************************************************************/
	parent.document.getElementById("main").src="hello.php";
</script>

<strong>Login</strong><p>

<form action="submit_login.php" method="POST" name="form"> 
    <select name="selmenu" onChange="findselected()"> 
        <option value="1">Administrator</option> 
        <option value="2">School</option> 
        <option value="3">Parent</option> 
    </select> 
    <p> 
    Username: <input type="text" name="user" size="18" maxlength="25">
    <p> 
    Password: <input type="password" name="pass" size="18" maxlength="25"> 
    <p> 
    <input type="submit" value="Login"> 
</form><br><br>
<a target="main" href="signup.php" style="color: #FF8080;">» Sign Up</a>

</body>
</html>
