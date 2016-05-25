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
        $string = $this->fname . ' <br>' . $this->lname . ' <br>' . $this->location . ' <br>' . $this->age . ' <br>' . $this->headerImg . ' <br>' . $this->profileImg;

        $string .= '<div style="border: 1px solid green">Testing for the overview Div</div>';

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