<?php

class response {
    private $error, $success, $redirect;

    public function __construct() {
        $this->error = [
                            "create_team"       => "Failed to create team.",
                            "select"            => "No data has been returned.",
                            "login"             => "Login Failed. Please try again",
                            "register"          => "Registration Failed. Please contact an administrator.",
                            "emailNotValid"     => "The email address you entered is not valid.",
                            "serverError"       => "Something went wrong on the server. Please contact an administrator.",
                            "emailExist"        => "A user with this email address already exists.",
                            "usernameExist"     => "A user with this username already exists.",
                            "teamNameExist"     => "A team with this name already exists.",
                            "wrongMethodChosen" => "You tried to use the wrong method for your query.",
                            "activation"        => "Failed to activate account. Please try again or contact an administrator.",
                            "activationUpdate"  => "Updating you account failed. Please contact an administrator immediately.",
                            "noActivationLink"  => "Your link appears to be invalid. Please try again or contact an administrator.",
                            "emailNotExist"     => "The email you entered does not exist.",
                            "reset_password"    => "Sending an email failed. Please contact an administrator.",
                            "noResetLink"       => "Your link appears to be invalid. Please try again or contact an administrator.",
                            "resetUpdate"       => "Updating you account failed. Please contact an administrator immediately.",
                            "reset"             => "Failed to reset password. Please try again or contact an administrator."
        ];

        $this->success = [
                            "insert"            => "Insert Successful.",
                            "update"            => "Update Successful.",
                            "create_team"       => "Created team successfully. An activation email has been sent to your email.",
                            "login"             => "Login Successful.",
                            "register"          => "Registration Successful.",
                            "activation"        => "Activation Successful.",
                            "reset_password"    => "Success. An email has been sent to your email with directions on how to reset your password.",
                            "reset"             => "Reset Successful."
        ];

        $this->redirect = "Redirecting you shortly.";
    }

    public function success($type, $redirect=false) {
        $message = $this->inArray($type, $this->success);

        $string = [
                            "status"        => 1,
                            "message"       => $this->constructDiv("success", $message . ($redirect ? " " . $this->redirect : ""))
        ];

        return $string;
    }

    public function error($type) {
        $message = $this->inArray($type, $this->error);

        $string = [
                            "status"        => 0,
                            "message"       => $this->constructDiv("error", $message)
        ];

        return $string;
    }

    private function constructDiv($type, $message) {
        switch($type) {
            case 'info':
                $string = '<div class="full_msg_contain">
                                <div class="msg_confirm code_1 slideInUp">
                                <span class="exit_btn">x</span>
                                ' . $message . '
                                </div>
                            </div>';
                break;
            case 'success':
                $string = '<div class="full_msg_contain">
                                <div class="msg_confirm code_2 slideInUp">
                                <span class="exit_btn">x</span>
                                ' . $message . '
                                </div>
                            </div>';
                break;
            case 'warn':
                $string = '<div class="full_msg_contain">
                                <div class="msg_confirm code_3 slideInUp">
                                <span class="exit_btn">x</span>
                                ' . $message . '
                                </div>
                            </div>';
                break;
            case 'error':
                $string = '<div class="full_msg_contain">
                                <div class="msg_confirm code_4 slideInUp">
                                <span class="exit_btn">x</span>
                                ' . $message . '
                                </div>
                            </div>';
                break;
            default:
                $string = $message;
        }

        return $string;
    }

    private function inArray($search, $in) {
        if(array_key_exists($search, $in)) {
            return $in[$search];
        }
        else {
            return 'Message not listed in responses.class.php';
        }
    }
}