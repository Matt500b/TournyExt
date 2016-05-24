<?php

include_once 'functions.php';
sec_session_start();

$err_msg = "";
$success_msg = "";

if(isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p'];

    if (login($email, $password, $db)) {
        // Login success
        $success_msg .= 'Login success. Redirecting to the home page shortly.';
        header('Refresh: 2; URL=index.php');
    }
    else {
        // Login failed
        $err_msg .= 'Login failed. Please try again';
        header('Refresh: 1; URL=login.php');
    }
}