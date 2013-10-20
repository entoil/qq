<form>
<p>1. What is your age?</p>
<select name="age" id="age">
<?php
for($i = 18; $i <= 80; $i += 1){
     echo("<option value='{$i}'>{$i}</option>");
}		
?>
</select>
<p>2. What is your gender?</p>
<input type="radio" name="sex" value="male" id="male"><label for="male">Male</label><br />
<input type="radio" name="sex" value="female" id="female"><label for="female">Female</label>

<p>3. On a scale of 1 to 5, how is the weather?</p>
<input type="radio" name="grade" value="1" id="1"> <label for="1">1</label>
<input type="radio" name="grade" value="2" id="2"> <label for="2">2</label>
<input type="radio" name="grade" value="3" id="3"> <label for="3">3</label>
<input type="radio" name="grade" value="4" id="4"> <label for="4">4</label>
<input type="radio" name="grade" value="5" id="5"> <label for="5">5</label>

<p>4. You are a goose.</p>
<input type="radio" name="tf" value="true" id="true"> <label for="true">True</label>
<input type="radio" name="tf" value="false" id="false"> <label for="false">False</label>

<p>5. Do you like cats?</p>
<input type="radio" name="yn" value="yes" id="yes"> <label for="yes">Yes</label>
<input type="radio" name="yn" value="no" id="no"> <label for="no">No</label>

<p>6. Pancakes are Delicious. </p>
<input type="radio" name="agrdis" value="sagree" id="sagree"> <label for="sagree">Strongly Agree</label><br />
<input type="radio" name="agrdis" value="agree" id="agree"> <label for="agree">Agree</label><br />
<input type="radio" name="agrdis" value="neutral" id="neutral"> <label for="neutral">Neutral</label><br />
<input type="radio" name="agrdis" value="disagree" id="disagree"> <label for="disagree">Disagree</label><br />
<input type="radio" name="agrdis" value="sdisagree" id="sdisagree"> <label for="sdisagree">Strongly Disagree</label><br />

<br />
<input type="button" style="margin-left: 170px; padding: 5px;" value="Submit"/>
<br />
</form>