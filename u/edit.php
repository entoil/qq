<?php

session_start();
include("header.php");
include("../config.inc");

?>

<script>
var x = 1
function printqn() {
	x++
	return x - 1
}
function getqn() {
	return x
}
function resetqn() {
	x = 1
}
function validateForm()
{

	i = 1
	domn = 4
	while (document.contains(document.forms["newqq"][domn + 1])) {
		qf = document.forms["newqq"][domn].value
		if (qf == null || qf == "") {
			if (delqnoalert(i) == 1) {
				break
			}
		} else {
			domn = domn + 2
			i++
		}
	}



	field = document.forms["newqq"]["name"].value;
	firstq = document.forms["newqq"][4].value;

	if (field==null || field=="") {
		if (firstq == null || firstq == "") {
			document.getElementById("errorbox").innerHTML = "Questionnaire name required.<br />Questionnaire must have at least one question.<br /><br />"
		} else {
			document.getElementById("errorbox").innerHTML = "Questionnaire name required."
		}
		return false;
	} else if (firstq == null || firstq == "") {
		document.getElementById("errorbox").innerHTML = "Questionnaire must have at least one question.<br /><br />"
		return false;
	}

	return true;

}
function newq()
{
	var table=document.getElementById("questiontable");
	var row=table.insertRow(-1);
	var cell1=row.insertCell(0);
	var cell2=row.insertCell(1);
	var cell3=row.insertCell(2);
	var qname = s4();
	cell1.innerHTML="<a onclick='jsfunction' href='javascript:delq(" + getqn() + ");'>" + printqn() + ".</a>";
	cell2.innerHTML="<input size='45' type='text' name='" + "q" + qname + "'' placeholder='Question'/> ";
	cell3.innerHTML="<select name='" + "t" + qname + "''><option value=yn>Yes/No</option><option value=tf>True/False</option><option value=scale>Scale</option><option value=opinion>Opinion</option><option value=often>Often</option></select>";
}
function delq(n)
{
	if (getqn() != 2) {
		if (confirm("Are you sure you want to delete this question?")) {
			var table=document.getElementById("questiontable");
			table.deleteRow(n - 1);
			resetqn()
			for (var i = 0, row; row = table.rows[i]; i++) {
				row.cells[0].innerHTML = "<a onclick='jsfunction' href='javascript:delq(" + getqn() + ");'>" + printqn() + ".</a>";
			}
		}
	}

}
function delqnoalert(n)
{
	onlyq = 0
	if (getqn() <= 3) {
		onlyq = 1
	}
	if (getqn() != 2) {
		var table=document.getElementById("questiontable");
		table.deleteRow(n - 1);
		resetqn()
		for (var i = 0, row; row = table.rows[i]; i++) {
			row.cells[0].innerHTML = "<a onclick='jsfunction' href='javascript:delq(" + getqn() + ");'>" + printqn() + ".</a>";
		}
	}

	return onlyq
}

function s4() {
  return Math.floor((1 + Math.random()) * 0x10000)
             .toString(16)
             .substring(1);
}
</script>
<header>QQ</header>
<section>
<h1>Edit</h1>
<?php

    $webid = $_SERVER['QUERY_STRING'];;
    $query = "SELECT * FROM surveys NATURAL JOIN users WHERE webid = '$webid' AND username = '$user'";
    $result = mysql_query($query);

    function selected($qtype, $seltype) {
    	if (strcmp($qtype, $seltype) == 0) {
    		return "selected";
    	} else {
    		return "";
    	}
    }

    if (mysql_num_rows($result) < 1) {
            echo "Questionnaire does not exist.";
    } else {   		
    		$row = mysql_fetch_assoc($result);
			echo "<span id='errorbox'></span>";
            echo "<form name=newqq action=edit_submit.php?$webid method=post onsubmit='return validateForm()'>
                    <table>
                    <tr><td width='80px'>Name:</td> <td width=250px><input size=45 type=text name=name value='" . $row['name'] . "'/></td></tr>
                    <tr><td>Description:</td> <td><textarea cols=45 name='description'/>" . $row['description'] . "</textarea></td></tr>
		            </table>
		            <br \>
		            <input type=\"checkbox\" name=\"age\" name=\"age\">Ask for Age 
					<input type=\"checkbox\" name=\"sex\" name=\"sex\">Ask for Gender<br \><br \>
		            <table id='questiontable'>";

			$query = "SELECT * FROM questions NATURAL JOIN surveys NATURAL JOIN users WHERE webid = '$webid'";
    		$result = mysql_query($query);

		    while($row = mysql_fetch_assoc($result)) {

		    		if ($row['qtype'] != "age" || $row['qtype'] != "sex") {
			    		$qname = substr(uniqid(),4); 
			            echo "
			            
			            <tr>
			            <td>
			            <script>document.write(\"<a onclick='jsfunction' href='javascript:delq(\" + getqn() + \");' >\" + printqn() + \".\");</script></a>
			            </td>
			            <td>
			            <input size=45 type=text name=q" . $qname . " placeholder='question' value=\""; echo $row['question'];   echo"\"/> 
			            </td>
			            <td>
				            <select name=t" . $qname . " >
							  <option value=yn "; echo selected("yn", $row['qtype']); echo ">Yes/No</option>
							  <option value=tf "; echo selected("tf", $row['qtype']); echo ">True/False</option>
							  <option value=scale "; echo selected("scale", $row['qtype']); echo ">Scale</option>
							  <option value=opinion "; echo selected("opinion", $row['qtype']); echo ">Opinion</option>
							  <option value=often "; echo selected("often", $row['qtype']); echo ">Often</option>
							</select>
						</td>
						</tr>";
					}
			}
			echo "</table><center><a onclick=\"jsfunction\" href=\"javascript:newq();\">+ Add Question</a></center>";
			echo "<br \><br \>       
            <input type=submit>
            </form>";
    }
		
?>

<?php include("footer.php"); ?>