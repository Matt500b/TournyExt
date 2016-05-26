<?php

$action = $_GET['action'];
$team = new teams();

include_once '../../includes/form_actions.php';


echo '<div class="wrapper">';

    if (!empty($err_msg)) {
        echo '<div class="error_msg">' . $err_msg . '</div>';
    }
    else if (!empty($success_msg)) {
        echo '<div class="success_msg">' . $success_msg . '</div>';
    }

    switch($action) {
        case 'create':
            echo $team->create_team_form();
            break;
        default:
            echo "stuff";
    }
echo '</div>';