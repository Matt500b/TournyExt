<?php
$pid = $_GET['pid'];
$profilePage = $_GET['page'];


echo '<div class="wrapper">';
if(isset($pid)) {

    $pclass = new user_profile($db, $pid);

    echo '
    <div class="w-container">
        <div class="header">
            <div class="pro-head">
                <div class="pro-head-img">
                    <img src="http://i2.cdn.turner.com/cnnnext/dam/assets/150820163747-profile-background-stock---no-photo-full-169.jpg" alt="" />
                </div>
                <div class="pro-img">
                    <img src="http://orig02.deviantart.net/d5d6/f/2015/021/b/2/profile_laboratorio_gamer_by_nemu_art-d8etcr4.png"/>
                </div>
                <div class="pro-name">
                    '. $pclass->username .'
                </div>
            </div>
            <div class="pro-bot-hold">
                <div class="pro-bot-w">
                    <div class="w-24 info-box">
                        13
                    <div class="info-desc">Points</div>
                </div>
                <div class="w-24 info-box">
                    34
                    <div class="info-desc">Views</div>
                </div>
                <div class="w-24 info-box">
                    1,000
                    <div class="info-desc">Followers</div>
                </div>
                <div class="w-24 info-box">
                    123
                    <div class="info-desc">Follows</div>
                </div>
            </div>
        </div>
    </div>
    <div class="info-container-l">
        <div class="tab-switch">
            <a href="?view=profile&pid=' . $pid . '&page=overview">User</a>
            <a href="?view=profile&pid=' . $pid . '&page=teams">Teams</a>
            <a href="?view=profile&pid=' . $pid . '&page=history">History</a>
            <a href="">Matches</a>
        </div>
        <div class="inner-padding">
            <h4>Info Shown Below Is Switched:</h4>';
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
    
            <div class="grey-line"></div>
    
            <ul>What goes here?
                <li>User Tab: Personal Info, Games played, Game Account Links
                </li>
                <li>Team Tab: All player Teams + links to teams
                </li>
                <li>History Tab: Not really sure
                </li>
                <li>
                  Matches Tab: Current Match, Matches Won + Prize, All Previous Matches
                </li>
            </ul>
        </div>
    </div>

    <div class="info-container-r">
        <div class="inner-padding">
            <a href="#" class="edit-pro-but">Edit Profile</a>

            <div class="grey-line">    </div>
            <div class="info-title">Social</div>
            <ul class="social-list">
                <li><a href=""><i class="icon-facebook-sign"></i>
                    <span>/</span>K1LZRface</a></li>
                <li><a href=""><i class="icon-twitter-sign"></i>
                    <span>/</span>K1LZRtwit</a></li>
                <li><a href=""><i class="icon-youtube-play"></i> <span>/</span>K1LZRtwit</a></li>
                <li><a href=""><i class="icon-instagram"></i> <span>/</span>K1LZRtwit</a></li>
                <li><a href=""><i class="icon-globe"></i> <span>/</span>liefjefe.com</a></li>
            </ul>
            <div class="info-title">Bio</div>
            <div class="personal-list">
                <ul>
                    <li><span>Name:</span>' . $pclass->fname .' '. $pclass->lname . '</li>
                    <li><span>Age:</span>' . $pclass->age . '</li>
                    <li><span>Country:</span>' . $pclass->location . '</li>
                </ul>
            </div>
        </div>
    </div>

</div>


        <div class="profile-information"></div>
        ';


}//
else {
    echo 'No user selected. How to handle this :)?';
}
echo '</div>';
