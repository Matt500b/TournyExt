<?php

/*
    Entrance into the tournament extension
    Place the link anywhere on your menu and link it to the /tournament directory
*/

echo '<a href="/tournament/index.php">Proceed to application...</a>';

include_once '../includes/functions.php';

function inArray($search, $in) {
    if(array_key_exists($search, $in)) {
        return $in[$search];
    }
    else {
        return 'Message not listed in responses.class.php';
    }
}

$array = [
    "create_team"   => "Failed to create team.",
    "select"        => "No data has been returned.",
    "login"         => "Login Failed. Please try again"
];
echo inArray("login", $array);