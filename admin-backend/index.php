<?php

include 'assets/api/login_functions.php';
include 'assets/api/admin_db.php';

session_start();

if (array_key_exists('username', $_SESSION)) {
  	header("Location: panel.php");
}

if (array_key_exists('username', $_POST)) {
  	echo login($admin_handler, $_POST['username'], $_POST['password']);
} else {
	echo file_get_contents('assets/html/login_html.htm');
}

?>
