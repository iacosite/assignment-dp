<html>
<head>
<!-- 	BOOTSTRAP -->
<!-- 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<link rel="stylesheet" href="src/css/style.css">
<script type="text/javascript" src="src/js/script.js"></script>
<title>Iacopo Olivo 2017</title>
</head>
<body>
	<div class="header">
	<noscript>
		<div style="background-color: red; padding: 20px;"><p>Javascript disabilitato, impossibile usare alcune funzionalità</p></div>
	</noscript>
		<h1>My assignment</h1>
			<?php
			require_once 'src/functions.php';
			// Check if cookies are enabled
			$cookies = false;			
			if (isset($_GET['check']) && $_GET['check'] == true) {
				if(isset($_COOKIE['test']) && $_COOKIE['test'] == 'cookie') {
					// cookie is working
					$cookies = true;
				} else {
					// show the message "cookie is not working"
					$cookies = false;
				}
			} else {
				// save the referrer in session. if cookie works we can get back to it later.
				// set a cookie to test
				setcookie('test', 'cookie', time()+120);
				// redirecting to the same page to check
				header("location: {$_SERVER['PHP_SELF']}?check=true");
			}
			getwinningbid ();
			refreshsession ();
			if (isset ( $_SESSION ['mail'] )) {
				echo "<p>Assignment bidding system for " . $_SESSION ['name'] . " " . $_SESSION ['surname'] . "</p><br>";
			} else {
				echo "<p>Assignment bidding system</p><br>";
			}
			?>
		</div>
	<div class="container">
		<div class="menu left-wrapper dark">

			<a href="index.php">
				<div class="title">Home</div>
			</a>


	      	<?php 
		    if($cookies):
			    if(isset($_SESSION['mail'])): ?>
			     	<a href="user.php">
						<div class="element">User Page</div>
					</a> <a href="src/functions.php?action=logout">
						<div class="element">Logout</div>
					</a>
		      	<?php else: ?>
			      	<a href="login.php">
						<div class="element">Log In</div>
					</a> <a href="signup.php">
						<div class="element">Sign Up</div>
					</a>
			<?php endif;
	     	else:?>
					<div class="element">Cookies disabled</div>
					<div class="element">Navigation forbidden</div>
		<?php endif;?>
		  </div>

		<div class="content-wrapper">
			<div class="item">