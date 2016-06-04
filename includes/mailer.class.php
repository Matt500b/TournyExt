<?php

class mailer {

    private $db;

    public function __construct(\database $db) {
        $this->db = $db;
    }

    public function sendActivationEmail($username, $email) {

        $random_salt = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);

        $options = [
            'cost' => 11,
            'salt' => $random_salt ,
        ];

        $activationLink = password_hash($random_salt . $email, PASSWORD_DEFAULT, $options);

        $url = WEBSITE . "/tournament/account_activation.php?e=" . $email . "&q=" . $activationLink;

        $body = '<html><body>';
        $body .= "Dear " . $username . "<br><br> You need to activate your account in order to use it. <br><br>  Please click the following link to active your account: <br><br>  <a href='" . $url . "'>" . $url . "</a> <br><br>  Thanks, <br> The Administration";
        $body .= '</body></html>';

        $subject = WEBSITE . " - activation link";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        mail($email, $subject, $body, $headers);

        $insert = $this->db->INSERT("INSERT INTO activations (`email`, `link`, `salt`) VALUES (?,?,?)", array('sss', $email, $activationLink, $random_salt));

        return $insert[0];
    }

    public function sendPasswordReset() {
        // Todo later.
    }
}