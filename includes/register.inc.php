<?php

include_once 'functions.php';

$err_msg = "";
$default_permission = 1;

if(isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    date_default_timezone_set("Europe/London");

    $username = strip_tags(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $email = strip_tags(filter_var($email, FILTER_VALIDATE_EMAIL));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg .= 'The email address you entered is not valid';
    }
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        $err_msg .= 'Something went wrong on the server. Please contact an administrator.';
    }

    $emailCheck = $db->SELECT('SELECT id FROM users WHERE email = ? LIMIT 1', array('s', $email));

    if(!empty($emailCheck)) {
        $err_msg .= 'A user with this email address already exists.';
    }
    else {
        $usernameCheck = $db->SELECT('SELECT id FROM users WHERE username = ? LIMIT 1', array('s', $username));

        if(!empty($usernameCheck)) {
            $err_msg .= 'A user with this username already exists.';
        }
        else {

            $random_salt = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);

            $options = [
                'cost' => 11,
                'salt' => $random_salt ,
            ];

            $password = password_hash($password, PASSWORD_DEFAULT, $options);

            $now = new DateTime();

            $insert = $db->INSERT('INSERT INTO users (username, email, password, salt, created_at, permissions) VALUES (?,?,?,?,?,?)', array('sssssi', $username, $email, $password, $random_salt, $now->format('Y-m-d H:i:s'), $default_permission));

            if($insert[0] == "Insert Successful") {
                $username = "";
                $email = "";
                $password = "";
            }
        }
    }
}