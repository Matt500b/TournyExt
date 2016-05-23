<?php

if(isset($_SESSION['username'])) {
    $loggedIn = true;
    $userID = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $lastActive = $_SESSION['lastActive'];
}