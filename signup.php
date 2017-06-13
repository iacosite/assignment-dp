<!DOCTYPE html>
<?php
require_once 'src/head.php';
require_once 'src/cookies.php';?>
<!-- <div class="left-wrapper"> -->
<form action="src/functions.php" method="get" name="signupForm">
	<input type="hidden" name="action" value="signup">
	<div class="tooltip">
		Name: <span class="tooltiptext">Given name</span><br> <input
			type="text" name="name" onchange="checkSignup()"><br>
	</div>
	<div class="tooltip">
		Surname: <span class="tooltiptext">Given surname</span><br> <input
			type="text" name="surname" onchange="checkSignup()"><br>
	</div>
	<div class="tooltip">
		Email: <span class="tooltiptext">Your email address</span><br> 
		<input type="text" name="mail" onchange="checkSignup()"><br>
	</div>
	<div class="tooltip">
		Password: <span class="tooltiptext">Password must contain one letter and one digit</span><br> 
		<input type="text" name="pass" onchange="checkSignup()"><br>
	</div>
	<div class="tooltip">
		Repeat password: <span class="tooltiptext">Passwords must be equal</span><br>
		<input type="text" name="pass2" onchange="checkSignup()"><br>
	</div>
	<input type="submit" value="Submit" class="button dark disabled" id="signupSubmit" disabled="disabled">
</form>
<!-- </div> -->
<?php require_once'src/foot.php';?>
	