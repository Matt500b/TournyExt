<?php

include_once 'functions.php';

$err_msg = "";

if(isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p'];

    if (login($email, $password, $db)) {
        // Login success
        $err_msg .= 'Login success.';
    }
    else {
        // Login failed
        $err_msg .= 'Login failed. Please try again';
    }
}