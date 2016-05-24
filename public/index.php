<?php

/*
    Entrance into the tournament extension
    Place the link anywhere on your menu and link it to the /tournament directory
*/

echo '<a href="/tournament/index.php">Proceed to application...</a>';

include_once '../includes/functions.php';

$maxID = $db->SELECT('SELECT MAX(id) AS maxid FROM users');
$insID = intval($maxID[0]['maxid']) + 1;
echo $insID;