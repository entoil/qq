<?php

session_start();

if (!isset($_SESSION['username'])) {
header('Location: denied.php');
}

if ($_GET['user'] == 'a') {
        if ($_SESSION['username'] != 'admin') {
                header('Location: denied.php');
        }
}

if ($_GET['user'] == 's') {
        if (!is_numeric($_SESSION['username'])) {
                header('Location: denied.php');
        }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 

include('../config.inc');

$target = $_GET['target'];
$user = $_GET['user'];
/***************************************************************
 EDIT TABLES
***************************************************************/
if ($target == 'table') {

	if ($user == 'a') {
		echo "<h3>Edit Table</h3>";
		echo "Upload SQL file for table editing<br><br>";
		echo "<form action=table_upload.php?target=tables method=post enctype=multipart/form-data>
			<label for=file>Filename:</label>
			<input type=file name=file id=file>
			<br>
			<input type=submit name=submit value=Submit>
			</form>";
	}

	
}

/***************************************************************
 EDIT SCHOOL
***************************************************************/
if ($target == 's') {
        echo "<h3>Edit School</h3>";
        echo "Enter School ID (sid) of the school you wish to edit:<br><br>";
        echo "<form action=edit_forms.php?target=s&user=a method=post enctype=multipart/form-data>
                <input type=text name=id />
                <br>
                <input type=submit name=submit value=Edit>
                </form>";
}
/***************************************************************
 EDIT EVENT
***************************************************************/
if ($target == 'e') {
	if ($user == 'a') {
        echo "<h3>Edit Event</h3>";
        echo "Enter Event ID (eid) of the event you wish to edit:<br><br>";
        echo "<form action=edit_forms.php?target=e&user=a method=post enctype=multipart/form-data>
                <input type=text name=id />
                <br>
                <input type=submit name=submit value=Edit>
                </form>";
        }  else if ($user == 's') {
        echo "<h3>Edit Event</h3>";
        echo "Enter Event ID (eid) of the event you wish to edit:<br><br>";
        echo "<form action=edit_forms.php?target=e&user=s method=post enctype=multipart/form-data>
                <input type=text name=id />
                <br>
                <input type=submit name=submit value=Edit>
                </form>";
        }
}
/***************************************************************
 EDIT TEACHER
***************************************************************/
if ($target == 't') {
	if ($user == 'a') {
		echo "<h3>Edit Teacher</h3>";
		echo "Enter Teacher ID (tid) and the School ID of the school they work at:<br><br>";
		echo "<form action=edit_forms.php?target=t&user=a method=post enctype=multipart/form-data>
		        tid: <input type=text name=id />
		        sid: <input type=text name=sid /><br>
		        <input type=submit name=submit value=Edit>
		        </form>";
        } else if ($user == 's') {
		echo "<h3>Edit Teacher</h3>";
		echo "Enter Teacher ID (tid) of the teacher you wish to edit:<br><br>";
		echo "<form action=edit_forms.php?target=t&user=s method=post enctype=multipart/form-data>
		        <input type=text name=id />
		        <br>
		        <input type=submit name=submit value=Edit>
		        </form>";
        }
}
/***************************************************************
 EDIT PARENT
***************************************************************/
if ($target == 'p') {
	if ($user == 'a') {
        echo "<h3>Edit Parent</h3>";
        echo "Enter the email address (pemail) of the parent you wish to edit:<br><br>";
        echo "<form action=edit_forms.php?target=p&user=a method=post enctype=multipart/form-data>
                <input type=text name=id />
                <br>
                <input type=submit name=submit value=Edit>
                </form>";
	} else if ($user == 'p') {
		header( 'Location: edit_forms.php?target=p&user=p' );
	}
}
?>
</body>
</html>
