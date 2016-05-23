            <div id="navigation-bar">
                <div class="navigation-container clearfix">

                    <div id="logo"></div>
                    <div id="menu">
                        <a href="./">HOME</a>
                    </div>
                    <div id="user">
                        <?php
                            if($loggedIn) {
                                echo '<a href="logout.php">Logout</a>';
                            }
                            else {
                                echo '<a href="login.php">Login</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
