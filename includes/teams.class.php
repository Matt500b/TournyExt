<?php

class create_team {
    private $db, $response, $password, $salt, $creation_role;
    private $imgLoc = "images/teams/";
    private $path = HOMEPATH . "tournament/images/teams/";

    public $name, $abv, $website, $logo, $bio, $userID;

    public function __construct(\database $db, \response $response, $name, $abv, $password, $website, $logo, $bio, $userID) {
        date_default_timezone_set(TIMEZONE);
        $this->db               = $db;
        $this->response         = $response;

        $this->creation_role    = 2;
        $this->name             = (!empty($name)        ? $name     : "");
        $this->abv              = (!empty($abv)         ? $abv      : "");
        $this->password         = (!empty($password)    ? $password : "");
        $this->website          = (!empty($website)     ? $website  : "");
        $this->logo             = (!empty($logo)        ? $logo     : "default_team_img.png");
        $this->bio              = (!empty($bio)         ? $bio      : "");
        $this->userID           = (!empty($userID)      ? $userID   : "");
    }

    public function create_team() {

        if($this->logo['name'] != "") {
            $ext = pathinfo($this->logo['name'])['extension'];
            $random1        = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
            $logoFile       = $random1 . ".$ext";

            move_uploaded_file($this->logo['tmp_name'], $this->path . $logoFile);
        }
        else {
            $logoFile = "default_team_img.png";
        }

        $nameCheck = $this->db->SELECT('SELECT `name` FROM teams WHERE `name` = ? LIMIT 1', array('s', $this->name));

        if(!empty($nameCheck)) {
            $message = $this->response->error('teamNameExist');
            return $message['message'];
        }
        else {
            if(isset($password)) {
                $this->salt = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);

                $options = [
                    'cost' => 11,
                    'salt' => $this->salt,
                ];

                $this->password = password_hash($password, PASSWORD_DEFAULT, $options);
            }
            else {
                $this->password = "";
                $this->salt = "";
            }

            $now            = new DateTime();

            $maxID          = $this->db->SELECT('SELECT MAX(id) AS maxid FROM teams');
            $insID          = intval($maxID[0]['maxid']) + 1;

            $insert         = $this->db->INSERT('INSERT INTO teams (`id`, `name`, `abv`, `teamImg`, `website`, `bio`, `created_at`, `join_password`, `salt`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', array('issssssss', $insID, $this->name, $this->abv, $logoFile, $this->website, $this->bio, $now->format('Y-m-d H:i:s'), $this->password, $this->salt));
            $insert2        = $this->db->INSERT('INSERT INTO teams_players (`team_id`, `player_id`, `role_id`) VALUES (?, ?, ?)', array('iii', $insID, $this->userID, $this->creation_role));

            return $insert2[0]['message'];
        }
    }

}
class display_team {
    private $db, $response;

    public $name, $abv, $website, $logo, $bio;

    public function __construct(\database $db, $response) {
        date_default_timezone_set(TIMEZONE);
        $this->db           = $db;
        $this->response     = $response;
    }

    public function display_user_teams($user) {
        $data = $this->db->SELECT("SELECT t1.name, t1.abv, t1.teamImg, t2.team_id, t3.role 
                                  FROM teams AS t1 
                                  INNER JOIN teams_players AS t2
                                  ON t1.id=t2.team_id  
                                  INNER JOIN teams_roles AS t3 
                                  ON t2.role_id = t3.role_id 
                                  WHERE t2.player_id = ?", array('i', $user));
        
        return $data;
    }

    public function display_team($tid) {
        $teamData = $this->db->SELECT("SELECT * FROM teams WHERE name = ?", array("i", $tid));
        $teamMembers = $this->db->SELECT("SELECT t1.*, t2.username, t3.*, t4.role FROM teams_players AS t1 
                                        INNER JOIN users AS t2 ON t1.player_id = t2.id
                                        INNER JOIN users_info AS t3 ON t2.id = t3.user_id
                                        INNER JOIN teams_roles AS t4 ON t1.role_id = t4.role_id 
                                        WHERE t1.team_id = ?", array('i', $tid));
        $this->name = $teamData[0]['name'];
        $this->abv = $teamData[0]['abv'];

        $string = '
            <div>' . $this->name . '</div>
            <div>' . $this->abv . '</div>
        ';

        return $teamMembers;
    }

    public function create_team_form() {
        $string = '
        <div class="create_team">
            <h2>Create New Team</h2>
            <div class="grey-line">    </div>
            <form action="" method="POST" class="reg_form create_team_form" name="registration_form" enctype="multipart/form-data">
                <label for="team_name">Team Name</label>
                <input type="text" name="team_name" id="team_name" value="">
                <span>This will be your teams unique name.</span>
                <label for="abb_team_name">Abbreviation</label>
                <input type="text" name="abb_team_name" id="abb_team_name" value="">
                <label for="password">Join Pass</label>
                <input type="password" name="password" id="password" placeholder="••••••••••••" value="">
                <span>Unique password that is required everytime someone join your team.</span>
                <label for="website">Website</label>
                <input type="text" name="website" id="website" value="">
                <span>Got a team website? Make sure to add it here.</span>
                <label for="team_logo">Team Logo</label>
                <input type="file" name="team_logo" id="team_logo">
                <label for="bio">Team Bio</label>
                <textarea name="bio" id="bio"></textarea>
                <input type="hidden" name="type" id="type" value="create_team">
                <input type="button" value="Create Team" onclick="return createTeamHash(this.form, this.form.team_name, this.form.abb_team_name, this.form.password);">
            </form>
        </div>';

        return $string;
    }
}