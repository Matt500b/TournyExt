<?php
	include '../../includes/functions.php';

	//sec_session_start();
	$loggedIn = (isset($_SESSION['id']) ? true : false);
	//$userID = $_SESSION['id'];

	include "headers/header.php";
	include "headers/navbar.php";


	$view = 'index';
	if (!empty($_GET['view'])) {
		$tmp_view = basename($_GET['view']);

		if (file_exists("templates/{$tmp_view}.php")) {
			//if(hasPermission($userID, $tmp_view) || !$loggedIn) {
				$view = $tmp_view;
			//}
		}
	}
	
	include "templates/{$view}.php";

	include "headers/footer.php";
?>
