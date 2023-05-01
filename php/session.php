<?php
if (!isset($_COOKIE['access']) || $_COOKIE['access'] == false) { session_start(); session_unset();}
else { session_start(); }

function linkName() {
	if (isset($_COOKIE['access']) ) {
	    if ( $_COOKIE['access'] == true) {
		    echo $_SESSION['login'];
	    }
	}
	else { echo "Войти"; }
}
header("Content-Type: text/html; charset=UTF-8");

require_once 'connection.php';

?>
