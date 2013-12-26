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
<h1>Create New Questionnaire</h1>
<?php
			echo "<span id='errorbox'></span>";
            echo "<form name=newqq action=create_submit.php method=post onsubmit='return validateForm()'>
                    <table>
                    <tr><td width='80px'>Name:</td> <td width=250px><input size=45 type=text name=name placeholder='Questionnaire Name'/></td></tr>
                    <tr><td>Description:</td> <td><textarea cols=45 name=description placeholder='Description'></textarea></td></tr>
		            </table>
		            <br \>
		            <input type=\"checkbox\" name=\"age\" name=\"age\">Ask for Age 
					<input type=\"checkbox\" name=\"sex\" name=\"sex\">Ask for Gender<br \><br \>
		            <table id='questiontable'>";

		    for ($i = 0; $i < 1; $i++) {        
		            echo "
		            
		            <tr>
		            <td>
		            <script>document.write(\"<a onclick='jsfunction' href='javascript:delq(\" + getqn() + \");' >\" + printqn() + \".\");</script></a>
		            </td>
		            <td>
		            <input size=45 type=text name='q8256' placeholder='Question'/> 
		            </td>
		            <td>
			            <select name='t8256' >
						  <option value=yn>Yes/No</option>
						  <option value=tf>True/False</option>
						  <option value=scale>Scale</option>
						  <option value=opinion>Opinion</option>
						  <option value=often>Often</option>
						</select>
					</td>
					</tr>";
			}
			echo "</table><center><a onclick=\"jsfunction\" href=\"javascript:newq();\">+ Add Question</a></center>";
			echo "<br \><br \>       
            <input type=submit value=Create><a href='..' style='margin-left: 17px;'><input type=button value=Cancel></a>
            </form>";
    
		
?>

<?php include("footer.php"); ?>