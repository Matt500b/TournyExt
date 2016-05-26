<?php

if(isset($_POST['type'])) {
    $switch = $_POST['type'];

    switch($switch) {
        case 'create_team':
            $team = new teams();
            $team->linkDB($db);
            $team->create_team($_POST['team_name'], $_POST['abb_team_name'], $_POST['p'],$_POST['website'], $_POST['team_logo']);
            echo "i attempted to do something";
            break;
        default:

    }
}