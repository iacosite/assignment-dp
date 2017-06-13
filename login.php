<!DOCTYPE html>
<?php 
require_once 'src/head.php';
require_once 'src/cookies.php';?>
<form action="src/functions.php" method="get" name="loginForm">
	<input type="hidden" name="action" value="login">
	<div class="tooltip">
		Email: <span class="tooltiptext">The email address you used to
			register</span><br> <input type="text" name="mail" onchange="checkLogin()"><br>
	</div>
	<div class="tooltip">
		Password: <span class="tooltiptext">Password to log in</span><br> <input
			type="text" name="pass" onchange="checkLogin()"><br>
	</div>
	<input type="submit" value="Submit" class="button dark disabled" disabled="disabled" id="loginSubmit">
</form>
<?php require_once 'src/foot.php';?>
