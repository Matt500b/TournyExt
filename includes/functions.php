<?php
include_once 'settings.php';
include_once 'session.php';
include_once 'database.class.php';
include_once 'responses.class.php';
include_once 'teams.class.php';
include_once 'user_profile.class.php';
include_once 'cup.class.php';
/*foreach (glob('../../includes/class/*.class.php', GLOB_NOCHECK) as $filename) {
    include_once $filename;
}*/


/* Setting the error_reporting value depending on DEBUG value */
if(DEBUG) { error_reporting(E_ALL & ~E_NOTICE); } else { error_reporting(0);}

/* Instantiating a class of reporting*/
$response = new response();

/* Instantiating a class for the database*/
$db = new database(HOST, USER, PASSWORD, DATABASE, DEBUG, $response);


function hasPermission($id=null, $page=null, $db) {

    if(isset($id)) {
        $permissionLevel = $db->SELECT("SELECT permissions FROM users WHERE id = ?", array('i', $id));

        switch ($page) {
            default:
                $return = true;
        }

        return $return;
    }

}

function jsRedir($url, $timeout=0) {
    return '<script>setTimeout(function(){window.location = "'. $url . '"},' . $timeout. ');</script>';
}