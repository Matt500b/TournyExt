<?php

if(isset($_SESSION['username'])) {
    $userID = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $lastActive = $_SESSION['lastActive'];
}