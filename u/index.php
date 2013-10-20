<?php

session_start();
include("header.php");
include("../config.inc");

?>

<header>QQ</header>
<section>

<?php

	echo "
	
	<p>Welcome to QQ, " . $user . " (<a href='../logout.php'>Logout</a>)</p>

	<p><b>Your Questionnaires:</b> </p>
	
	";
	
		$query = sprintf("SELECT name AS 'Questionnaire Name', sid , uniqid FROM `surveys` NATURAL JOIN `users` WHERE username = '" . $user . "';");
		//$query = sprintf("SELECT E.eid AS 'Event ID', E.ename AS 'Event', E.venue AS 'Venue', E.stime AS 'Start Time', E.etime AS 'End Time', S.sname AS 'School' FROM Event E NATURAL JOIN Creates C NATURAL JOIN School S ORDER BY eid");

		$result = mysql_query($query);

		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		$fields_num = mysql_num_fields($result);

		if (mysql_num_rows($result) == 0) { echo "<p>You do not have any!</p> <p><a href='create.php' >+ Create New Questionnaire </a></p>"; }
		
		else {
			
			echo "<table class=result cellspacing='0' cellpadding='4'>";
	
			while($row = mysql_fetch_array($result))
			{
				echo "<tr>";
				foreach($row as $cell) {
				$out = strlen($cell) > 35 ? substr($cell,0,35)."..." : $cell;
				echo "<td class=cell>$out</td>";
				
				break;
				}
				echo "<td>
				
				<a href='edit.php?" . $row['uniqid'] . "' title='Edit'><img src=\"../images/edit.gif\" /></a> &nbsp;
				<a href='stats.php?" . $row['uniqid'] . "' title='Stats'><img src=\"../images/stat.gif\" /></a> &nbsp;
				<a href='../q?" . $row['uniqid'] . "' title='View'><img src=\"../images/view.gif\" /></a> &nbsp;
				<a href='delete.php?" . $row['uniqid'] . "' title='Delete'><img src=\"../images/del.gif\" /></a> &nbsp;
				</td>";
				//echo substr(uniqid(),6) . "\n";
				echo "</tr>\n";
			}
			echo "<tr><td  colspan=2><a href='create.php' >+ Create New Questionnaire </a></td><tr>";
			echo "</table>";
		
		}
		mysql_free_result($result);
		
?>

<?php include("footer.php"); ?>