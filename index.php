<!DOCTYPE html>
<?php require_once 'src/head.php'; ?>
<div class="biditem">
	<img src="res/polito.jpg" alt="Item to sell">
		<?php
		if (getwinningbid ()) {
			echo "<p>Highest bid: " . $_SESSION ['winning-bid'] . "</p>";
			echo "<p>Winning bidder: " . $_SESSION ['winning-user'] . "</p>";
		} else {
			echo "<p>Starting value: 1.00</p><br>";
			echo "<p>No bids yet!</p><br>";
		}
		?>
	</div>
<?php require_once 'src/foot.php';?>
