<?php

if(isset($_POST['type'])) {
    $switch = $_POST['type'];

    switch($switch) {
        case 'create_team':
            $team = new teams();
            $return_msg = $team->create_team($db, $_POST['team_name'], $_POST['abb_team_name'], $_POST['p'], $_POST['website'], $_POST['team_logo'], $userID);
            break;
        case 'edit_profile':
            $edit_profile = new edit_user_profile($db, $_POST['firstname'], $_POST['lastname'], $_POST['location'], $_POST['age'], $_POST['facebook'], $_POST['twitter'], $_POST['youtube'],
                $_POST['instagram'], $_POST['website'], $_POST['profilePicOld'], $_POST['headerPicOld'], $_FILES["profilepic"], $_FILES["profileheader"], $userID);
            $return_msg = $edit_profile->update_profile();
            break;
        default:

    }
}