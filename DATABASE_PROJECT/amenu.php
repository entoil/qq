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
/****************************************************************
	Direct Administrator to admin home page
****************************************************************/
	parent.document.getElementById("main").src="ahome.php";
</script>
<p>Logged in as: <b><?php echo $_SESSION['username']; ?></b></p>
<strong>Menu</strong>
<p>
<span onclick="tree(0);">Tables</span><br />
<font color="black" id="com0" class="menutext">
<a href="query/view.php?target=table&user=a" target="main">View</a><br />
<a href="query/create.php?target=table&user=a" target="main">Create</a><br />
<a href="query/edit.php?target=table&user=a" target="main">Update/Delete</a><br /></font></p>
<p>
<span onclick="tree(1);">School</span><br />
<font color="black" id="com1" class="menutext">
<a href="query/view.php?target=s&user=a" target="main">View</a><br />
<a href="query/create.php?target=s&user=a" target="main">Add</a><br />
<a href="query/edit.php?target=s&user=a" target="main">Edit</a><br />
<a href="query/delete.php?target=s&user=a" target="main">Delete</a> </font></p>
<p>
<span onclick="tree(6);">Events</span><br />
<font color="black" id="com6" class="menutext">
<a href="query/view.php?target=e&user=a" target="main">View</a><br />
<a href="query/create.php?target=e&user=a" target="main">Create</a><br />
<a href="query/edit.php?target=e&user=a" target="main">Edit</a><br />
<a href="query/delete.php?target=e&user=a" target="main">Delete</a> </font></p>
<p>
<span onclick="tree(2);">Teachers</span><br />
<font color="black" id="com2" class="menutext">
<a href="query/view.php?target=t&user=a" target="main">View All</a><br />
<a href="query/view.php?target=c&user=a" target="main">Currently Hired</a><br />
<a href="query/create.php?target=t&user=a" target="main">Add Teacher</a><br />
<a href="query/create.php?target=c&user=a" target="main">Employ Teacher</a><br />
<a href="query/delete.php?target=c&user=a" target="main">Unemploy Teacher</a><br />
<a href="query/edit.php?target=t&user=a" target="main">Edit</a><br />
<a href="query/delete.php?target=t&user=a" target="main">Delete</a> </font></p>
<p>
<span onclick="tree(3);">Appointments</span><br />
<font color="black" id="com3" class="menutext">
<a href="query/view.php?target=a&user=a" target="main">View</a><br />
<a href="query/create.php?target=a&user=a" target="main">Create</a><br />
<a href="query/delete.php?target=a&user=a" target="main">Delete</a> </font></p>
<p>
<span onclick="tree(4);">Parents</span><br />
<font color="black" id="com4" class="menutext">
<a href="query/view.php?target=p&user=a" target="main">View</a><br />
<a href="query/create.php?target=p&user=a" target="main">Add</a><br />
<a href="query/edit.php?target=p&user=a" target="main">Edit</a><br />
<a href="query/delete.php?target=p&user=a" target="main">Delete</a> </font></p>
<p>
<span onclick="tree(5);">Bookings</span><br />
<font color="black" id="com5" class="menutext">
<a href="query/view.php?target=b&user=a" target="main">View</a><br />
<a href="query/create.php?target=b&user=a" target="main">Register</a><br />
<a href="query/delete.php?target=b&user=a" target="main">Delete</a> </font></p></body>


<p><a href="logout.php" style="padding-left: -5px; color: #FF8080;">» Logout</a></p>
</html>
