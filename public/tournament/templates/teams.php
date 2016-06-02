<?php

$action = $_GET['action'];
$tid = $_GET['tid'];

include_once '../../includes/form_actions.php';


echo '<div class="wrapper">';

    echo $return_msg;

    switch($action) {
        case 'create':
            $team = new teams($db);
            echo $team->create_team_form();
            break;
        case 'display':
            $team = new teams($db);
            var_dump($team->display_team($tid));
            break;
        default:
            echo "stuff";
    }
echo '</div>';