<?php

class passwords {
    private $db, $response, $mail;


    public function __construct(\database $db, \response $response) {
        $this->db           = $db;
        $this->response     = $response;
    }

    public function sendResetPassword($email) {
        $email              = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $email              = strip_tags(filter_var($email, FILTER_VALIDATE_EMAIL));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $return_msg = $this->response->error('emailNotValid');
        }
        else {
            $emailCheck = $this->db->SELECT("SELECT * FROM users WHERE email = ?", array("s", $email));

            if (empty($emailCheck)) {
                $return_msg = $this->response->error('emailNotExist');
            } 
            else {
                $this->mail = new mailer($this->db);
                $mailer = $this->mail->sendPasswordReset($email);

                if ($mailer['status'] == 1) {
                    $return_msg = $this->response->success('reset_password');
                }
                else {
                    $return_msg = $this->response->error('reset_password');
                }
            }
        }

        return $return_msg;
    }
    
    public function resetPassword($email, $password, $link) {

        if (strlen($password) != 128) {
            $return_msg = $this->response->error('serverError');
        }
        else {

            $data = $this->db->SELECT("SELECT * FROM `password_reset` WHERE email = ?", array("s", $email));

            if (empty($data)) {
                $return_msg = $this->response->error('noResetLink');
            }
            else {
                $db_email = $data[0]['email'];
                $db_link = $data[0]['link'];
                $db_salt = $data[0]['salt'];

                $options = [
                    'cost' => 11,
                    'salt' => $db_salt,
                ];

                $resetLink = password_hash($db_salt . $email, PASSWORD_DEFAULT, $options);

                if ($db_link === $resetLink) {

                    $random_salt = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);

                    $options = [
                        'cost' => 11,
                        'salt' => $random_salt,
                    ];

                    $password = password_hash($password, PASSWORD_DEFAULT, $options);

                    $update = $this->db->UPDATE("UPDATE users SET password = ?, salt = ? WHERE email = ?", array("sss", $password, $random_salt, $email));

                    if ($update[0]['status'] == 1) {
                        $return_msg = $this->response->success('reset');
                        $this->db->DELETE("DELETE FROM `password_reset` WHERE email = ?", array("s", $email));
                    } else {
                        $return_msg = $this->response->error('resetUpdate');
                    }
                } else {
                    $return_msg = $this->response->error('reset');
                }
            }
        }
        return $return_msg;
    }
}

class passwords_display {
    private $db, $response;

    public function __construct(\database $db, \response $response) {
        $this->db           = $db;
        $this->response     = $response;
    }

    public function displayResetForm() {
        $string = '
        <h1>Simple Request Password</h1>
        
        <form action="" method="POST" class="reg_form" name="forgot_password_form">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="">
            
            <input type="hidden" name="type" id="type" value="reset_password_email">
            <button type="submit" value="Reset" >Reset</button>
        </form>';

        return $string;
    }

    public function displayResetPasswordForm($email, $link) {
        $string = '
        <h1>Simple Reset Password</h1>
        <h2>Please type your new password</h2>
        
        <form action="" method="POST" class="reg_form" name="forgot_password_form">
        
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••••••" value="">
            <label for="confirmpwd">Repeat Password</label>
            <input type="password" name="confirmpwd" id="confirmpwd" placeholder="••••••••••••" value="" />
            
            <input type="hidden" name="e" value="' . $email . '" />
			<input type="hidden" name="q" value="' . $link . '" />
            <input type="hidden" name="type" id="type" value="reset_password">
            <input type="button" value="Reset" onclick="return regformhashreset(this.form, this.form.password,this.form.confirmpwd,this.form.e, this.form.q);">
        </form>';

        return $string;
    }
}