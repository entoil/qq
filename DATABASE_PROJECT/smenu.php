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
	parent.document.getElementById("main").src="shome.php";
</script>
<?php
	
	include('config.inc');

	$id = $_SESSION['username'];
	$query = "SELECT * FROM School where sid=$id";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
?>

<p>Logged in as: <b><?php echo $row['sname']; ?></b></p>
<strong>Menu</strong>
<p>

<span onclick="tree(6);">Events</span><br />
<font color="black" id="com6" class="menutext">
<a href="query/view.php?target=e&user=s" target="main">View</a><br />
<a href="query/create.php?target=e&user=s" target="main">Create</a><br />
<a href="query/edit.php?target=e&user=s" target="main">Edit</a><br />
<a href="query/delete.php?target=e&user=s" target="main">Delete</a><br /> </font></p>
<p>
<span onclick="tree(2);">Teachers</span><br />
<font color="black" id="com2" class="menutext">
<a href="query/view.php?target=t&user=s" target="main">View All</a><br />
<a href="query/create.php?target=t&user=s" target="main">Add</a><br />
<a href="query/create.php?target=c&user=s" target="main">Employ Teacher</a><br />
<a href="query/delete.php?target=c&user=s" target="main">Unemploy Teacher</a><br />
<a href="query/edit.php?target=t&user=s" target="main">Edit</a><br /> </font></p>
<p>
<span onclick="tree(3);">Appointments</span><br />
<font color="black" id="com3" class="menutext">
<a href="query/view.php?target=a&user=s" target="main">View</a><br />
<a href="query/create.php?target=a&user=s" target="main">Create</a><br />
<a href="query/delete.php?target=a&user=s" target="main">Delete</a><br /> </font></p>

<p><a href="logout.php" style="padding-left: -5px; color: #FF8080;">» Logout</a></p>
</body>
</html>
