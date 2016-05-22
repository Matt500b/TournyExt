<?php
include_once 'settings.php';
include_once 'database.class.php';
include_once 'session.php';

/* Setting the error_reporting value depending on DEBUG value */
if(DEBUG) { error_reporting(-1); } else { error_reporting(0);}

/* Instantiating a class */
$db = new database(HOST, USER, PASSWORD, DATABASE, DEBUG);


function hasPermission($id=null, $page=null) {

    if(isset($id)) {
        $permissionLevel = $db->SELECT("SELECT permissions FROM users WHERE id = ?", array('i', $id));

        switch ($page) {
            default:
                $return = true;
        }

        return $return;
    }

}