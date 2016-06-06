<?php

class processing {

    private $db, $response, $mail, $email, $password;

    public function __construct(\database $db, \response $response) {
        date_default_timezone_set(TIMEZONE);
        $this->db           = $db;
        $this->response     = $response;
    }

    public function login($email, $password) {
        $this->email         = $_POST['email'];
        $this->password      = $_POST['p'];
        $now                 = new DateTime();

        $loginData = $this->db->SELECT("SELECT id, username, password, salt FROM users WHERE email = ? LIMIT 1", array('s', $this->email));
        if(!empty($loginData)) {

            $options = [
                'cost' => 11,
                'salt' => $loginData[0]['salt']
            ];

            $typed_password = password_hash($this->password, PASSWORD_DEFAULT, $options);

            if ($this->check_brute($loginData[0]['id'])) {
                return false;
                // Account is locked
                // Send an email to user saying that their account is locked
            }
            else {
                if ($loginData[0]['password'] == $typed_password) {

                    $user_id = preg_replace("/[^0-9]+/", "", $loginData[0]['id']);
                    $_SESSION['user_id'] = $user_id;

                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $loginData[0]['username']);
                    $_SESSION['username'] = $username;

                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['login_string'] = password_hash($password . $user_browser, PASSWORD_DEFAULT, $options);

                    $_SESSION['lastActive'] = $now;
                    $this->db->UPDATE("UPDATE users SET lastOnline = ? WHERE email = ?", array('ss', $now->format('Y-m-d H:i:s'), $this->email));

                    return true;
                }
                else {
                    $this->db->INSERT('INSERT INTO login_attempts (`user_id`, `time`) VALUES (?,?)', array('ii', $loginData[0]['id'], $now->getTimestamp()));

                    return false;
                }
            }
        }
        else {
            return false;
        }
    }
    
    public function register($username, $email, $password) {

        $default_permission = 1;
        $username           = strip_tags(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $email              = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $email              = strip_tags(filter_var($email, FILTER_VALIDATE_EMAIL));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $return_msg = $this->response->error('emailNotValid');
        }
        else {
            $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
            if (strlen($password) != 128) {
                $return_msg = $this->response->error('serverError');
            } 
            else {
                $emailCheck = $this->db->SELECT('SELECT id FROM users WHERE email = ? LIMIT 1', array('s', $email));

                if (!empty($emailCheck)) {
                    $return_msg = $this->response->error('emailExist');
                } 
                else {
                    $usernameCheck = $this->db->SELECT('SELECT id FROM users WHERE username = ? LIMIT 1', array('s', $username));

                    if (!empty($usernameCheck)) {
                        $return_msg = $this->response->error('usernameExist');
                    } 
                    else {

                        $random_salt = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);

                        $options = [
                            'cost' => 11,
                            'salt' => $random_salt,
                        ];

                        $password = password_hash($password, PASSWORD_DEFAULT, $options);

                        $now = new DateTime();

                        $maxID = $this->db->SELECT('SELECT MAX(id) AS maxid FROM users');
                        $insID = intval($maxID[0]['maxid']) + 1;

                        $insert = $this->db->INSERT('INSERT INTO users (id, username, email, password, salt, created_at, permissions) VALUES (?,?,?,?,?,?,?)', array('isssssi', $insID, $username, $email, $password, $random_salt, $now->format('Y-m-d H:i:s'), $default_permission));
                        $insert2 = $this->db->INSERT('INSERT INTO users_info (user_id) VALUES (?)', array('i', $insID));

                        $this->mail = new mailer($this->db);
                        $mailer = $this->mail->sendActivationEmail($username, $email);

                        if ($insert[0]['status'] == 1 && $insert2[0]['status'] == 1 && $mailer['status'] == 1) {
                            $return_msg = $this->response->success('register', true);
                            header('Refresh: 2; URL=index.php');
                        }
                        else {
                            $return_msg = $this->response->error('register');
                        }
                    }
                }
            }
        }
        return $return_msg;
    }

    public function activate($email, $link)
    {
        $data = $this->db->SELECT("SELECT * FROM `activations` WHERE email = ?", array("s", $email));

        if (empty($data)) {
            $return_msg = $this->response->error('noActivationLink');
        }
        else {
            $db_email = $data[0]['email'];
            $db_link = $data[0]['link'];
            $db_salt = $data[0]['salt'];

            $options = [
                'cost' => 11,
                'salt' => $db_salt,
            ];

            $activationLink = password_hash($db_salt . $email, PASSWORD_DEFAULT, $options);

            if ($db_link === $activationLink) {
                $update = $this->db->UPDATE("UPDATE users SET permissions = 2 WHERE email = ?", array("s", $email));

                if ($update[0]['status'] == 1) {
                    $return_msg = $this->response->success('activation');
                    $this->db->DELETE("DELETE FROM `activations` WHERE email = ?", array("s", $email));
                } else {
                    $return_msg = $this->response->error('activationUpdate');
                }
            } else {
                $return_msg = $this->response->error('activation');
            }
        }

        return $return_msg;
    }
    
    private function check_brute($id) {
        
        $now            = new DateTime;
        $valid_attempts = $now->getTimestamp() - (2 * 60 * 60);
        $brute          = $this->db->SELECT("SELECT time FROM login_attemps WHERE user_id = ? AND time > ?", array('ii', $id, $valid_attempts));

        if (count($brute) > 5) {
            return true;
        } else {
            return false;
        }
    }
}