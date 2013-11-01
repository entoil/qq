<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: login.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="JavaScript">
/****************************************************************
	Tree-type menu: Onclick menu heading, 
						the children links appear.
****************************************************************/
<!--
flag = new Array();
function tree(num){
    com = document.getElementById("com" + num)
    if(flag[num] == 1){
        com.style.display='none';
        flag[num] = 0;
    }
    else{
        com.style.display='block';
        flag[num] = 1;
    }
}
//-->
</script>
<link href="menu.css" rel="stylesheet" type="text/css" />

</head>

<body>
<script type="text/javascript">
	parent.document.getElementById("main").src="phome.php";
</script>

<p>Logged in as: <b><?php echo $_SESSION['username']; ?></b></p>
<strong>Menu</strong>
<p>

<span onclick="tree(4);">Profile</span><br />
<font color="black" id="com4" class="menutext">
<a href="query/edit_forms.php?target=p&user=p&id=0" target="main">Edit</a><br />
<a href="query/delete_check.php?target=p&user=p" target="main">Delete</a> </font></p>

<span onclick="tree(1);">School</span><br />
<font color="black" id="com1" class="menutext">
<a href="query/view.php?target=s&user=p" target="main">View Schools</a><br />
<a href="query/view_form.php?target=t&user=p" target="main">View Teachers</a><br />
<a href="query/view_form.php?target=e&user=p" target="main">View Events</a></font>
<p>

<span onclick="tree(3);">Appointments</span><br />
<font color="black" id="com3" class="menutext">
<a href="query/view_form.php?target=a&user=p" target="main">View Available</a></font>
<p>

<span onclick="tree(5);">Bookings</span><br />
<font color="black" id="com5" class="menutext">
<a href="query/view.php?target=b&user=p" target="main">View</a><br />
<a href="query/create.php?target=b&user=p" target="main">Create</a><br />
<a href="query/delete.php?target=b&user=p" target="main">Cancel</a> </font></p>


<p><a href="logout.php" style="padding-left: -5px; color: #FF8080;">» Logout</a></p>
</body>
</html>
