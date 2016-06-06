<?php

/*
    Entrance into the tournament extension
    Place the link anywhere on your menu and link it to the /tournament directory
*/

echo '<a href="/tournament/index.php">Proceed to application...</a>';

include_once '../includes/functions.php';

$db2 = new testDB(HOST, USER, PASSWORD, DATABASE, DEBUG);

$data = $db2    ->SELECT(array("*"))
                ->FROM("users_info")
                ->WHERE("username")
                ->RUN();

echo $data;
