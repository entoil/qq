<?php

session_start();
include("header.php");
include("../config.inc");

?>
<style>
table {
    color:#333333;
    border-width: 1px;
    border-color: #666666;
    border-collapse: collapse;
    width: 50%;
    margin: auto;
    margin-top: 5px;
}
td {
    border-width: 1px;
    padding: 5px;
    border-style: solid;
    border-color: #666666;
    background-color: #ffffff;
    width: 25%;
}
</style>
<header>QQ</header>
<section>
<h1>Stats</h1>
<?php

$webid = $_SERVER['QUERY_STRING'];;
$query = "SELECT * FROM surveys NATURAL JOIN users WHERE webid = '$webid' AND username = '$user'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$sid = $row['sid'];
$br = "<br />";


if (mysql_num_rows($result) < 1) {
        echo "Questionnaire does not exist.";
} else {
		echo "Survey: " . $row['name'] . $br;
        
        // Get Number of Participants
        $countps = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as count FROM participants WHERE sid = $sid GROUP BY sid;"));
        $partics = $countps['count'];
        

        if (!$partics) {
            echo "0" . $br . $br;
            echo "No one has participated in this questionnaire." . $br . $br;
        } else {
            $query = "SELECT * FROM questions WHERE sid = $sid";
            $result = mysql_query($query);
            echo "Number of participants: " . $partics  . $br . $br;
        while($row = mysql_fetch_array($result)) {

            echo $row['number'] . ". " . $row['question'] . $br;
            $qid = $row['qid'];

            // Get Question Type
            $typerow = mysql_fetch_assoc(mysql_query("SELECT * FROM questions WHERE qid = $qid"));
            $type = $typerow['qtype'];
            echo "<table>";

            if ($type == "age") {
                $qid = $row['qid'];
                $tally = mysql_query("SELECT answer, COUNT(*) as count FROM answers WHERE qid = $qid GROUP BY answer;");
                while($answer = mysql_fetch_array($tally)) { 
                    echo "<tr><td>" . $answer['answer'] . "</td><td>" . $answer['count'] . "</td></tr>";
                }
            } else if ($type == "sex") {
                $qid = $row['qid'];
                $tally = mysql_query("SELECT qid, SUM(answer='male') male, SUM(answer='female') female FROM answers WHERE qid = $qid");
                $answer = mysql_fetch_assoc($tally);
                echo "<tr><td>Male</td><td>" . $answer['male'] . "</td></tr>";
                echo "<tr><td>Female</td><td>" . $answer['female'] . "</td></tr>";
            } else if ($type == "yn") {
                $qid = $row['qid'];
                $tally = mysql_query("SELECT qid, SUM(answer='yes') yes, SUM(answer='no') no FROM answers WHERE qid = $qid");
                $answer = mysql_fetch_assoc($tally);
                echo "<tr><td>Yes</td><td>" . $answer['yes'] . "</td></tr>";
                echo "<tr><td>No</td><td>" . $answer['no'] . "</td></tr>";
                
            } else if ($type == "tf") {
                $qid = $row['qid'];
                $tally = mysql_query("SELECT qid, SUM(answer='true') true, SUM(answer='false') false FROM answers WHERE qid = $qid");
                $answer = mysql_fetch_assoc($tally);
                echo "<tr><td>True</td><td>" . $answer['true'] . "</td></tr>";
                echo "<tr><td>False</td><td>" . $answer['false'] . "</td></tr>";
                
            } else if ($type == "opinion") {
                $qid = $row['qid'];
                $tally = mysql_query("SELECT qid, SUM(answer='sagree') sagree, SUM(answer='agree') agree, SUM(answer='neutral') neutral, SUM(answer='disagree') disagree, SUM(answer='sdisagree') sdisagree FROM answers WHERE qid = $qid");
                $answer = mysql_fetch_assoc($tally);
                echo "<tr><td>Strongly Agree</td><td>" . $answer['sagree'] . "</td></tr>";
                echo "<tr><td>Agree</td><td>" . $answer['agree'] . "</td></tr>";   
                echo "<tr><td>Neutral</td><td>" . $answer['neutral'] . "</td></tr>";    
                echo "<tr><td>Disagree</td><td>" . $answer['disagree'] . "</td></tr>";    
                echo "<tr><td>Strongly Disagree</td><td>" . $answer['sdisagree'] . "</td></tr>"; 

            } else if ($type == "often") {
                $qid = $row['qid'];
                $tally = mysql_query("SELECT qid, SUM(answer='always') always, SUM(answer='often') often, SUM(answer='sometimes') sometimes, SUM(answer='rarely') rarely, SUM(answer='never') never FROM answers WHERE qid = $qid");
                $answer = mysql_fetch_assoc($tally);
                echo "<tr><td>Always</td><td>" . $answer['always'] . "</td></tr>";
                echo "<tr><td>Often</td><td>" . $answer['often'] . "</td></tr>";   
                echo "<tr><td>Sometimes</td><td>" . $answer['sometimes'] . "</td></tr>";    
                echo "<tr><td>Rarely</td><td>" . $answer['rarely'] . "</td></tr>";    
                echo "<tr><td>Never</td><td>" . $answer['never'] . "</td></tr>";     
            } else if ($type == "scale") {
                $qid = $row['qid'];
                $tally = mysql_query("SELECT qid, SUM(answer='1') '1', SUM(answer='2') '2', SUM(answer='3') '3', SUM(answer='4') '4', SUM(answer='5') '5' FROM answers WHERE qid = $qid");
                $answer = mysql_fetch_assoc($tally);
                echo "<tr><td>1</td><td>" . $answer['1'] . "</td></tr>";
                echo "<tr><td>2</td><td>" . $answer['2'] . "</td></tr>";   
                echo "<tr><td>3</td><td>" . $answer['3'] . "</td></tr>";    
                echo "<tr><td>4</td><td>" . $answer['4'] . "</td></tr>";    
                echo "<tr><td>5</td><td>" . $answer['5'] . "</td></tr>"; 
                
            }

            echo "</table><br />";
        }

        

        }
		echo "<a href='/'>Back to Control Panel</a>";
}
		
?>

<?php include("footer.php"); ?>