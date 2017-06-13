<?php
session_start ();

$host = 'localhost';
$db = 'assignment';
$user = 'root';
$pass = '';
$conn = mysqli_connect($host,$user, $pass, $db);
mysqli_select_db($conn, $db) or die(mysqli_error($conn));

$folder = 'assignment';
if (isset ( $_REQUEST ['action'] )) {
	$action = $_REQUEST ['action'];
	// Non authenticated actions
	switch ($action) {
		case 'login' :
			login ();
			break;
		case 'logout' :
			logout ();
			break;
		case 'signup' :
			signup ();
			break;
		case 'bid' :
			require_once 'protection.php';
			bid ();
			break;
	}
}
function signup() {
	if (isset ( $_REQUEST ['mail'] ) && isset ( $_REQUEST ['pass'] ) && isset ( $_REQUEST ['pass2'] ) && isset ( $_REQUEST ['name'] ) && isset ( $_REQUEST ['surname'] )) {
		$conn = $GLOBALS['conn'];
		$mail = mysqli_escape_string($conn, $_REQUEST ['mail'] );
		$pass = mysqli_escape_string($conn, $_REQUEST ['pass'] );
		$pass2 = mysqli_escape_string($conn, $_REQUEST ['pass2'] );
		$name = mysqli_escape_string($conn, $_REQUEST ['name'] );
		$surname = mysqli_escape_string($conn, $_REQUEST ['surname'] );
		

		if ($pass == $pass2) {
			if (preg_match ( "/[a-zA-Z0-9.-]+@[a-zA-Z]+\.[a-zA-Z]+/", $mail ) > 0 && preg_match ( "/(.*[a-zA-Z].*[0-9].*)|(.*[0-9].*[a-zA-Z].*)/", $pass ) > 0) {
				$pass = md5($pass);
				$query = "INSERT INTO users (mail, password, name, surname) VALUES('$mail', '$pass', '$name', '$surname')";
				mysqli_autocommit($conn, false);
				
				if (!mysqli_query($conn, $query)) {
					mysqli_rollback($conn);
					header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'/signup.php' );
				}
				
				$query = "SELECT COUNT(*) FROM users WHERE mail='$mail'";
				$result= mysqli_query($conn, $query);
				if (mysqli_fetch_array($result)[0] == 1) {
					$_SESSION ['mail'] = $mail;
					$_SESSION ['name'] = $name;
					$_SESSION ['surname'] = $surname;
					$_SESSION ['bid'] = 0;
					$_SESSION ['bid_time'] = 'NULL';
					mysqli_commit($conn);
					header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'] );
				} else {
					mysqli_rollback($conn);
					header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'/signup.php' );
				}
			} else {
				// Mail or password are not compilant
				echo "Wrong stuff $mail - $pass";
				header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'/signup.php' );
			}
		} else {
			// Passwords differ
			echo "Wrong password $pass1 - $pass2";
			header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'/signup.php' );
		}
	} else {
		echo "Wrong param";
		header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'/signup.php' );
	}
}
function login() {
	if (isset ( $_REQUEST ['mail'] ) && isset ( $_REQUEST ['pass'] )) {
		$conn = $GLOBALS['conn'];
		$mail = mysqli_escape_string($conn, $_REQUEST ['mail'] );
		$pass = md5(mysqli_escape_string($conn, $_REQUEST ['pass'] ));


		$query = "SELECT COUNT(*) FROM users WHERE mail='$mail' AND password='$pass'";
		$result = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($result);
		if ($data[0] == 1) {
			$query = "SELECT * FROM users WHERE mail='$mail' AND password='$pass'";
			$request = mysqli_query($conn, $query);
			$result = mysqli_fetch_assoc($request);
			$_SESSION ['mail'] = $result ['mail'];
			$_SESSION ['name'] = $result ['name'];
			$_SESSION ['surname'] = $result ['surname'];
			$_SESSION ['bid'] = $result ['bid'];
			$_SESSION ['bid_time'] = $result ['bid_time'];
			header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'] );
		} else {
			header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'/login.php' );
		}
	}
}
function logout() {
	// TODO aggiungere pagina di logout, js che dopo 2 secondi ti porta alla pagina principale
	session_unset ();
	session_destroy ();
	header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'' );
}

function bid() {
	if (isset ( $_REQUEST ['value'] )) {
		$default_bid = 1;
		$value = mysqli_real_escape_string($conn,$_REQUEST ['value'] );
		$conn = $GLOBALS['conn'];

		// Create the connection
		mysqli_autocommit($conn, false);
		$query = "SELECT mail, bid, bid_time FROM users ORDER BY bid DESC, bid_time ASC LIMIT 2";
		$request = mysqli_query($conn, $query);
		$result = mysqli_fetch_assoc($request);

		$maxbid = $result['bid'];
		$maxuser = $result['mail'];
		$result= $result = mysqli_fetch_assoc($request);
		$secondbid = $result['bid'];
		if ($maxbid != 0) {
			if ($secondbid != 0) {
				// if at least 2 user bid
				if ($maxbid > $secondbid) {
					$maxbid = $secondbid + 0.01;
				}
			} else {
				// only 1 user bid
				$maxbid = $default_bid;
			}
			$_SESSION ['winning-bid'] = $maxbid;
			$_SESSION ['winning-user'] = $maxuser;
		} else {
			$_SESSION ['winning-bid'] = $default_bid;
		}// TODO Considerare round per input dell'utente
		if ($value > ($_SESSION ['winning-bid']+0.01) ) {
			$_SESSION ['bid'] = $value;
			$bid = doubleval ( $_SESSION ['bid'] );
			$mail = strval ( $_SESSION ['mail'] );
			$query = "UPDATE users SET bid=$bid, bid_time=CURRENT_TIMESTAMP WHERE mail='$mail'";
			if(mysqli_query($conn, $query)){
				mysqli_commit($conn);
			} else {
				mysqli_rollback($conn);
			}
		} else {
			mysqli_rollback($conn);
		}
	}
	header ( 'Location: http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['folder'].'/user.php' );
}
function getwinningbid() {
	$default_bid = 1;
	$conn = $GLOBALS['conn'];
	
	$query = "SELECT mail, bid, bid_time FROM users ORDER BY bid DESC, bid_time ASC LIMIT 2";
	$result = mysqli_query($conn, $query);
	
	$data = mysqli_fetch_assoc($result);
	$maxbid = $data['bid'];
	$maxuser = $data['mail'];
	
	$data = mysqli_fetch_assoc($result);
	$secondbid = $data['bid'];
	
	if ($maxbid != 0) {
		if ($secondbid != 0) {
			if ($maxbid > $secondbid) {
				$maxbid = $secondbid + 0.01;
			}
		} else {
			$maxbid = $default_bid;
		}
		$_SESSION ['winning-bid'] = $maxbid;
		$_SESSION ['winning-user'] = $maxuser;
// 		mysqli_close($conn);
		return true;
	} else {
		$_SESSION ['winning-bid'] = $default_bid;
// 		mysqli_close($con);
		return false;
	}
}
function refreshsession() {
	if (isset ( $_SESSION ['lastaction'] )) {
		$last = $_SESSION ['lastaction'];
		// TODO sistemare threashold a 120
		if ((time () - $last) > 12000) {
			session_unset ();
			session_destroy ();
		}
	}

	$_SESSION ['lastaction'] = time ();
}

?>
