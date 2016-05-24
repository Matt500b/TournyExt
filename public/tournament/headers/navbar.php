    <body>
            <div id="navigation-bar">
                <div class="navigation-container clearfix">

                    <div id="logo"></div>
                    <div id="menu">
                        <a href="./">HOME</a>
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
                                            <li><a href="#profile">Admin pages here.</a></li>
                                            <li class="dd-line"></li>
                                            <!--<li><a href="#profile">+ New Tournament</a></li>-->
                                            <li><a href="#profile">+ Create a Team</a></li>
                                            <li class="dd-line"></li>
                                            <li><a href="?view=profile&pid=' . $username . '">Your profile</a></li>
                                            <!--<li><a href="#profile">Settings</a></li>
                                            <li><a href="#profile">Activity log</a></li>
                                            <li><a href="#profile">Help</a></li>-->
                                            <li><a href="#profile">Report a problem</a></li>
                                            <li class="dd-line"></li>
                                            <li><a href="logout.php">Sign out</a></li>
                                        </ul>
                                    </div>';
                            }
                            else {
                                echo '<a href="login.php">Login</a><br><a href="register.php">Register</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
