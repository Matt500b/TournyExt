<?php

include_once 'functions.php';
sec_session_start();


if(isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p'];

    if (login($email, $password, $db)) {
        // Login success
        $return_msg = $response->success('login', true);
        header('Refresh: 2; URL=index.php');
    }
    else {
        // Login failed
        $return_msg = $response->error('login');
    }
}