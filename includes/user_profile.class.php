<?php

//include 'database.class.php';

class user_profile {

    private $db;
    public $username;
    public $fname;
    public $lname;
    public $location;
    public $age;
    public $headerImg;
    public $profileImg;

    public function __construct(\database $db, $pid) {
        $this->db = $db;
        $this->username = $pid;

        $params = $this->db->SELECT("SELECT users_info.*, users.username, users.lastOnline FROM users_info INNER JOIN users ON users.id = users_info.user_id WHERE users.username = ?", array('s', $this->username));
        $this->fname = (isset($params[0]['fname']) ? $params[0]['fname'] : null);
        $this->lname = (isset($params[0]['lname']) ? $params[0]['lname'] : null);
        $this->location = (isset($params[0]['location']) ? $params[0]['location'] : null);
        $this->age = (isset($params[0]['age']) ? $params[0]['age'] : null);
        $this->headerImg = (isset($params[0]['headerImg']) ? $params[0]['headerImg'] : null);
        $this->profileImg = (isset($params[0]['profileImg']) ? $params[0]['profileImg'] : null);

    }

    public function overview() {
        $string = '
        <h4>Recently Played games</h4>
        <div class="game-list">
          <div class="game-cover">
            <div class="game-cov-img">
              <a href="#"><img src="http://vignette2.wikia.nocookie.net/callofduty/images/7/76/Game_cover_art_BOIII.jpg/revision/latest/scale-to-width-down/300?cb=20160211194000" alt="" /></a>
            </div>
            <div class="game-cov-title">CS:GO</div>
          </div>
                  <div class="game-cover">
            <div class="game-cov-img">
              <a href="#"><img src="http://vignette2.wikia.nocookie.net/callofduty/images/7/76/Game_cover_art_BOIII.jpg/revision/latest/scale-to-width-down/300?cb=20160211194000" alt="" /></a>
            </div>
            <div class="game-cov-title">CS:GO</div>
          </div>
          <div class="game-cover">
            <div class="game-cov-img">
              <a href="#"><img src="http://vignette2.wikia.nocookie.net/callofduty/images/7/76/Game_cover_art_BOIII.jpg/revision/latest/scale-to-width-down/300?cb=20160211194000" alt="" /></a>
            </div>
            <div class="game-cov-title">COD BO3</div>
          </div>
                  <div class="game-cover">
            <div class="game-cov-img">
              <a href="#"><img src="http://static.giantbomb.com/uploads/original/1/13692/2302957-i2cs9uzmq4yua.jpg" alt="" /></a>
            </div>
            <div class="game-cov-title">CS:GO</div>
          </div>
        </div>

        ';// end of string

        return $string;
    }

    public function teams() {
        $string = "This will have the layout for the teams section";

        $string .= '<div style="border: 1px solid red">Testing for the Teams Div</div>';

        return $string;
    }

    public function gameHistory() {
        $string = "This will have the layout for the history section";

        $string .= '<div style="border: 1px solid blue">Testing for the history Div</div>';

        return $string;
    }
}