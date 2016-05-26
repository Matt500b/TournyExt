<?php

$action = $_GET['action'];
$team = new teams();


echo '<div class="wrapper">';

switch($action) {
    case 'create':
        echo $team->create_team_form();
        break;
    default:
        echo "stuff";
}
echo '</div>';