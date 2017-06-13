<?php
if (! isset ( $_SESSION ['mail'] )) {
	header ( 'Location: http://localhost/assignment/login.php' );
}
