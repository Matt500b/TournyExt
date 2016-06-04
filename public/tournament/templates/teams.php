<?php

$action = $_GET['action'];
$tid = $_GET['tid'];
$team = new display_team($db, $response);

echo $return_msg;

switch($action) {
    case 'create':
        echo $team->create_team_form();
        break;

    case 'display':
        var_dump($team->display_team($tid));
        break;

    default:
        echo "stuff";
}
