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
            $string .= '
            <div class="part_info">
                <div class="game-type">
                    <img src="https://d3kq2xhl2rew87.cloudfront.net/tournament/image/9/0/3/monday_thursday_nNSkCfN.png" alt="" />
                    <h1>Friday, June 9th</h1>
                </div>
                <ul>
                    <li><a href="">Rules</a></li>
                    <li><a href="">Matches</a></li>
                    <li><a href="">Brackets</a></li>
                    <li><a href="">Teams</a></li>
            
                </ul>
                <div class="event_table">
                    <div class="data_title">Participants</div>
                    <div class="data_enter">#/' . $cups[$i]['teamLimit'] . '</div>
                    <div class="data_title">Total Teams</div>
                    <div class="data_enter">' . $cups[$i]['teamLimit'] . '</div>
                    <div class="data_title">Register Start</div>
                    <div class="data_enter">
                        Thursday 2nd Jun
                    </div>
                    <div class="data_title">Register end</div>
                    <div class="data_enter">
                        Thursday 9th Jun
                    </div>
                    <div class="data_title">Time Scheduled</div>
                    <div class="data_enter">
                        05:00pm - 05:45pm
                    </div>
                    <div class="data_title">Prize</div>
                    <div class="data_enter">
                        $200
                    </div>
              </div>
            </div>';
        }

        return $string;
    }

    public function displaySelected($id) {
        $cups = $this->db->SELECT("SELECT * FROM cups WHERE cid = ?", array("i", $id));


    }

}