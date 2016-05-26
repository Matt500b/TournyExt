<?php

class teams {
    
    
    
    public function create_team_form() {
        $string = '
        <div class="create_team">
            <form action="" method="POST" class="reg_form" name="registration_form">
                <label for="team_name">Team Name</label>
                <input type="text" name="team_name" id="team_name" value="">
                <label for="abb_team_name">Abbreviation</label>
                <input type="text" name="abb_team_name" id="abb_team_name" value="">
                <label for="password">Join Pass</label>
                <input type="password" name="password" id="password" placeholder="••••••••••••" value="">
                <label for="website">Website</label>
                <input type="text" name="website" id="website" value="">
                <label for="team_logo">Team Logo</label>
                <input type="file" name="team_logo" id="team_logo">
                <label for="bio">Team Bio</label>
                <textarea name="bio" id="bio" cols="45" rows="5"></textarea>
                
                <input type="button" value="Create Team" onclick="return createTeamHash(this.form, this.form.team_name, this.form.abb_team_name, this.form.password);">
            </form>
        </div>';
        
        return $string;
    }
    
    public function create_team() {
        
    }
}