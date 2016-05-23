<?php
	include '../../includes/functions.php';

	sec_session_start();
	include 'headers/set_session_variables.php';

	echo $userID . '<br>';
	echo $username . '<br>';
	echo $lastActive->format('d/m/Y H:i:s') . '<br>';

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
