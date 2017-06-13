<?php 
	setcookie('test', 'cookie', time()+5);
	if(!isset($_COOKIE['test']) || $_COOKIE['test'] != 'cookie') {
		header ( 'Location: '.$_SERVER['HTTP_REFERER'].$GLOBALS['folder'] );
	}
?>