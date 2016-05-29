<?php

if(isset($_POST['type'])) {
    $switch = $_POST['type'];

    switch($switch) {
        case 'create_team':
            $team = new teams();
            $return_msg = $team->create_team($db, $_POST['team_name'], $_POST['abb_team_name'], $_POST['p'], $_POST['website'], $_POST['team_logo'], $userID);
            break;
        default:

    }
}