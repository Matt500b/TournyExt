<?php

include_once 'functions.php';

$default_permission = 1;

if(isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    date_default_timezone_set(TIMEZONE);

    $username = strip_tags(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $email = strip_tags(filter_var($email, FILTER_VALIDATE_EMAIL));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $return_msg = $response->error('emailNotValid');
    }
    else {
        $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
        if (strlen($password) != 128) {
            $return_msg = $response->error('serverError');
        } else {
            $emailCheck = $db->SELECT('SELECT id FROM users WHERE email = ? LIMIT 1', array('s', $email));

            if (!empty($emailCheck)) {
                $return_msg = $response->error('emailExist');
            } else {
                $usernameCheck = $db->SELECT('SELECT id FROM users WHERE username = ? LIMIT 1', array('s', $username));

                if (!empty($usernameCheck)) {
                    $return_msg = $response->error('usernameExist');
                } else {

                    $random_salt = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);

                    $options = [
                        'cost' => 11,
                        'salt' => $random_salt,
                    ];

                    $password = password_hash($password, PASSWORD_DEFAULT, $options);

                    $now = new DateTime();

                    $maxID = $db->SELECT('SELECT MAX(id) AS maxid FROM users');
                    $insID = intval($maxID[0]['maxid']) + 1;

                    $insert = $db->INSERT('INSERT INTO users (id, username, email, password, salt, created_at, permissions) VALUES (?,?,?,?,?,?,?)', array('isssssi', $insID, $username, $email, $password, $random_salt, $now->format('Y-m-d H:i:s'), $default_permission));
                    $insert2 = $db->INSERT('INSERT INTO users_info (user_id) VALUES (?)', array('i', $insID));

                    if ($insert[0]['status'] == 1) {
                        $return_msg = $response->success('register', true);
                        header('Refresh: 2; URL=index.php');
                    }
                }
            }
        }
    }
}
