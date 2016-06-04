<?php
include '../../includes/functions.php';

sec_session_start();
if(isset($_SESSION['username'])) {
    $user = new user($db, $_SESSION['user_id'], $_SESSION['username'], $_SESSION['lastActive']);
}

include "headers/header.php";
include "headers/navbar.php";

if($user->permissionLevel >= 11) {
    $view = 'index';
    if (!empty($_GET['view'])) {
        $tmp_view = basename($_GET['view']);

        if (file_exists("admin/{$tmp_view}.php")) {
            //if(hasPermission($userID, $tmp_view) || !$loggedIn) {
            $view = $tmp_view;
            //}
        } else {
            $view = "404";
        }

    }

    include "admin/{$view}.php";
}
else {
    include "admin/401.php";
}
include "headers/footer.php";
?>
