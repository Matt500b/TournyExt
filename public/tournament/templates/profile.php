<?php
$pid = $_GET['pid'];
$profilePage = $_GET['page'];


echo '<div class="wrapper">';
    if(isset($pid)) {

        $pclass = new user_profile($db, $pid);

        echo '
        <div class="profile-header">' . $pclass->headerImg . '</div>
        <div class="profile-pic"><img src="' . $pclass->profileImg . '"/></div>
        <div class="profile-=navigation">
            <li><a href="?view=profile&pid=' . $pid . '&page=overview">Overview</a></li>
            <li><a href="?view=profile&pid=' . $pid . '&page=teams">My Teams</a></li>
            <li><a href="?view=profile&pid=' . $pid . '&page=history">History</a></li>
        </div>

        <div class="profile-information"></div>
        <div class="main-content">';
            switch($profilePage) {
                case 'overview':
                    echo $pclass->overview();
                    break;
                case 'teams':
                    echo $pclass->teams();
                    break;
                case 'history':
                    echo $pclass->gameHistory();
                    break;
                default:
                    echo $pclass->overview();
            }
        echo '
        </div>';


    }
    else {
        echo 'No user selected. How to handle this :)?';
    }
echo '</div>';

