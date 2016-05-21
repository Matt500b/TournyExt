<?php
include_once 'settings.php';
include_once 'database.class.php';

/* Instantiating a class */
$db = new database(HOST, USER, PASSWORD, DATABASE, DEBUG);