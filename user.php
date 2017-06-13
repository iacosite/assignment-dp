<!DOCTYPE html>
<?php
require_once 'src/head.php';
require_once 'src/protection.php';
require_once 'src/cookies.php';
// $pdo_options [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
// $pdo = new PDO ( 'mysql:host=localhost;dbname=assignment', 'root', '', $pdo_options );
// $mail = strval ( $_SESSION ['mail'] );
// $stmt = $pdo->prepare ( 'SELECT mail, bid FROM users WHERE mail<>:mail' );
// $stmt->execute ( array (
// 		'mail' => $mail 
// ) );
?>
<div class="container">
	<div class="left-wrapper">
		Your actual bid is: <?php echo $_SESSION['bid'];?>
		<form action="src/functions.php" method="get" name="bidForm">
			<input type="hidden" name="action" value="bid"> 
			<div class="tooltip">
				New bid: <span class="tooltiptext">Bid increment must be at least 0.01</span><br> 
				<input type="text" name="value" onchange="checkBid()"><br> 
			</div>
			<input type="submit" value="Submit" class="button dark disabled" disabled="disabled" id="bidSubmit">
		</form>
<!-- 	</div> -->
<!-- 	<div class="content-wrapper"> -->
		<?php
// 		while ( $user = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			
// 			if ($_SESSION ['bid'] > $user ['bid']) {
// 				echo '<p class="exceeded">' . $user ['mail'] . ' - bid exceeded';
// 			} else {
// 				echo '<p class="not_exceeded">' . $user ['mail'] . ' bidded ' . $user ['bid'];
// 			}
// 			echo "</p>";
// 		}
		if($_SESSION['winning-user'] == $_SESSION['mail']) {
			echo '<p class="not_exceeded">You are the highest bidder!</p>';
		} else {
			ECHO '<p calss="exceeded">You bid has been exceeded!</p>';
		}
		?>
	</div>
</div>
<?php require_once 'src/foot.php';?>
