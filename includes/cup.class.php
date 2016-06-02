<?php

class cup {
    private $db;

    public $name;
    public $id;
    public $date;
    public $totalTeams;
    public $participants;
    public $registerStart;
    public $registerEnd;
    public $startDate;
    public $checkInDate;
    public $prizes = [];

    public function __construct(\database $db) {
        $this->db = $db;
    }

    public function displayAllActive() {
        $cups = $this->db->SELECT("SELECT * FROM cups WHERE active = 1");
        $string = '';

        for ($i=0; $i<count($cups); $i++) {
            $string .= $cups[$i]['cid'] . $cups[$i]['name'] . $cups[$i]['teamLimit'] . $cups[$i]['active'] . '<br>';
        }

        return $string;
    }

    public function displaySelected($id) {
        $cups = $this->db->SELECT("SELECT * FROM cups WHERE cid = ?", array("i", $id));


    }

}