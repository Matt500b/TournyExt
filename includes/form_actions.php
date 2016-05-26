<?php

$switch = $_POST['type'];

switch($switch) {
    case 'create_team':
        $team = new teams();
        $team->create_team();
        break;
    default:

}