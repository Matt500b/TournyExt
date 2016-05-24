<?php
$pid = $_GET['pid'];
$profilePage = $_GET['page'];

$profileData = $db->SELECT('SELECT users_info.*, users.username, users.lastOnline FROM users_info INNER JOIN users ON users.id = users_info.user_id WHERE users.username = ?', array('s', $pid));

echo '<div class="wrapper">';
    if(isset($pid)) {
        echo 'Currently viewing user '. $pid;
        ?>
        <div class="profile-header"><?php $profileData[0]['profileHeader'] ?></div>
        <div class="profile-pic"><img src="<?php $profileData[0]['profilePic'] ?>"/></div>
        <div class="profile-=navigation"></div>

        <div class="profile-information"> What info shall we have?</div>
        <div class="main-content">
        <?php
            switch($profilePage) {
                default:
                    "will add profile class to pull data through";
            }
        ?>
        </div>

        <?php
    }
    else {
        echo 'No user selected. How to handle this :)?';
    }
echo '</div>';

