<?php
	include '../../includes/functions.php';

	sec_session_start();


	if(isset($_SESSION['username'])) {
		$user = new user($db, $_SESSION['user_id'], $_SESSION['username'], $_SESSION['lastActive']);
	}

	include INCLUDESPATH . 'form_actions.php';
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
		else {
			$view = "404";
		}

	}

	echo '<div class="wrapper">';
	include "templates/{$view}.php";
	echo '</div>';

	include "headers/footer.php";
?>
