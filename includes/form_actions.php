<?php

if(isset($_POST['type'])) {
    $switch = $_POST['type'];

    switch($switch) {
        case 'create_team':
            $create_team = new create_team($db, $response, $_POST['team_name'], $_POST['abb_team_name'], $_POST['p'], $_POST['website'], $_FILES['team_logo'], $_POST['bio'], $user->userID);
            $return_msg = $create_team->create_team();
            //echo '<script>setTimeout(function(){window.location = "?view=teams&tid='.$_POST['team_name'].'"}, 2000);</script>';
            break;
        
        case 'edit_profile':
            $edit_profile = new edit_user_profile($db, $_POST['firstname'], $_POST['lastname'], $_POST['location'], $_POST['age'], $_POST['facebook'], $_POST['twitter'], $_POST['youtube'],
                $_POST['instagram'], $_POST['website'], $_POST['profilePicOld'], $_POST['headerPicOld'], $_FILES["profilepic"], $_FILES["profileheader"], $user->userID);
            $return_msg = $edit_profile->update_profile();
            echo '<script>setTimeout(function(){window.location = "?view=profile&pid='.$user->username.'"}, 2000);</script>';
            break;

        case 'register':
            $register = new processing($db, $response);
            $return_msg = $register->register($_POST['username'], $_POST['email'], $_POST['p']);
            echo '<script>setTimeout(function(){window.location = "./"}, 2000);</script>';
            break;

        case 'login':
            $login = new processing($db, $response);
            if ($login->login($_POST['email'], $_POST['p'])) {
                $return_msg = $response->success('login', true);
                echo '<script>setTimeout(function(){window.location = "./"}, 2000);</script>';
            }
            else {
                $return_msg = $response->error('login');
            }
            break;
        default:

    }
}