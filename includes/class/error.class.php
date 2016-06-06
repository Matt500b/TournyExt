<?php

class error {

    public function __construct($debug) {
        if($debug) { 
            error_reporting(E_ALL & ~E_NOTICE); 
        } 
        else { 
            error_reporting(0);
        }
    }

    public function page401() {
        $string = '
        <div class="err_contain">
            <div class="four-04">401 Error</div>
            <img src="images/lock.png"/>
            <h1>Unauthorized </h1><br>
            <div class="err_message">Sorry, the page you have requested can\'t be authorized.</div>
    
            <a href="" onclick="goBack()" class="classy_btn">Go Back</a>
            <a href="index.php" class="classy_btn">Return to homepage</a>
    
            <div class="grey-line"></div>
            <span class="open_sgt">See Suggestions</span>
            <div class="open-suggestions">
                <ul>
                    <li>Contact us</li>
                    <li>Clear cookies</li>
                    <li>Double check url</li>
                    <li>Retry again</li>
                </ul>
            </div>
        </div>';

        return $string;
    }
    public function page404() {
        $string = '
        <div class="err_contain">
            <div class="four-04">404 Error</div>
            <h1>Whoops </h1><br>
            <div class="err_message">Sorry, the page you are trying to reach was not found in our system.</div>

            <a href="" onclick="goBack()" class="classy_btn">Go Back</a>
            <a href="index.php" class="classy_btn">Return to homepage</a>

            <div class="grey-line"></div>
            <span class="open_sgt">See Suggestions</span>
            <div class="open-suggestions">
                <ul>
                    <li>Contact us</li>
                    <li>Clear cookies</li>
                    <li>Double check url</li>
                    <li>Retry again</li>
                </ul>
            </div>
        </div>';

        return $string;
    }
}