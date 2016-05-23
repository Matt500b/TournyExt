<?php

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
}

function login($email, $password, $db) {
    date_default_timezone_set(TIMEZONE);

    $loginData = $db->SELECT("SELECT id, username, password, salt FROM users WHERE email = ? LIMIT 1", array('s', $email));

    if(!empty($loginData)) {

        $options = [
            'cost' => 11,
            'salt' => $loginData[0]['salt']
        ];

        $typed_password = password_hash($password, PASSWORD_DEFAULT, $options);

        if (check_brute($loginData[0]['id'], $db)) {
            // Account is locked
            // Send an email to user saying that their account is locked
        } 
        else {
            if ($loginData[0]['password'] == $typed_password) {

                $user_id = preg_replace("/[^0-9]+/", "", $loginData[0]['id']);
                $_SESSION['user_id'] = $user_id;

                $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $loginData[0]['username']);
                $_SESSION['username'] = $username;

                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['login_string'] = password_hash($password . $user_browser, PASSWORD_DEFAULT, $options);

                $now = new DateTime();
                $_SESSION['lastActive'] = $now;
                $db->UPDATE("UPDATE users SET lastOnline = ? WHERE email = ?", array('ss', $now->format('Y-m-d H:i:s'), $email));
                
                return true;
            }
            else {
                $db->INSERT('INSERT INTO login_attemps (user_id, time) VALUES (?,?)', array('is', $loginData[0]['id'], $now->getTimestamp()));

                return false;
            }
        }
    }
    else {
        // Not data returned. User does not exist.
        return false;
    }
}

function check_brute($user_id, $db) {
    date_default_timezone_set(TIMEZONE);
    $now = new DateTime;

    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now->getTimestamp() - (2 * 60 * 60);

    $brute = $db->SELECT("SELECT time FROM login_attemps WHERE user_id = ? AND time > ?", array('ii', $user_id, $valid_attempts));

    if(count($brute) > 5) {
        return true;
    }
    else {
        return false;
    }
}