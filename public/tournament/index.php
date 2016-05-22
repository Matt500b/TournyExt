<?php

	include("headers/header.php");
	include("headers/navbar.php");

	$view = 'index';
	if (!empty($_GET['view'])) {
		$tmp_view = basename($_GET['view']);

		if (file_exists("templates/{$tmp_view}.php")) {
			if(hasPermission($tmp_view)) {
				$view = $tmp_view;
			}
		}
	}
	
	include("templates/{$view}.php");

	include("headers/footer.php");
?>
