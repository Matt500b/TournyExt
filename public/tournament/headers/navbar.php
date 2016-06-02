<body>
<div id="navigation-bar">
    <div class="navigation-container clearfix">

        <div id="logo"></div>
        <div id="menu">
            <a href="./">HOME</a>
            <a href="?view=cups">CUPS</a>
            <a href="?view=ladder">LADDER</a>
        </div>
        <div id="user">
            <?php
            if($loggedIn) {
                echo '
                                    <div class="simple-dd-menu">
                                        ' . $username . '
                                        <img src="https://avatars2.githubusercontent.com/u/17126397?v=3&s=460" alt="" />
                                        <div class="drop-down-tri"></div>
                                        <ul>
                                            <li class="log_status">Online for <b>3m</b></li>
                                            <li class="dd-line"></li>
                                            <li><a href="#">Admin Control Panel</a></li>
                                            <li><a href="#">Moderator Control Panel</a></li>
                                            <li class="dd-line"></li>
                                            <li><a href="?view=teams&action=create">+ Create a Team</a></li>
                                            <li class="dd-line"></li>
                                            <li><a href="?view=profile&pid=' . $username . '">Profile</a></li>
                                            <li><a href="#">Teams</a></li>
                                            <li><a href="#profile">Report a problem</a></li>
                                            <li class="dd-line"></li>
                                            <li><a href="logout.php">Sign out</a></li>
                                        </ul>
                                    </div>';
            }
            else {
                echo '<a class="btn login" href="login.php">Login</a><br><a class="btn register" href="register.php">Register</a>';
            }
            ?>
        </div>
    </div>
</div>
