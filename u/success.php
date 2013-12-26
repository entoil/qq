<?php

session_start();
include("header.php");
include("../config.inc");

?>

<header>QQ</header>
<section>

<?php

$mode = $_SERVER['QUERY_STRING'];

if ($mode == 'create') {
	echo "<h1>Create New Questionnaire</h1>Questionnaire successfully created. <br /><br /> <a href='/'>Back to Control Panel</a>";
} else if ($mode == 'edit') {
	echo "<h1>Edit Questionnaire</h1>Questionnaire successfully modified. <br /><br /> <a href='/'>Back to Control Panel</a>";
}


?>


<?php include("footer.php"); ?>