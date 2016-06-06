<?php

$action = $_GET['action'];
$email = $_GET['e'];
$link = $_GET['q'];

$pass = new passwords_display($db, $response);
echo $return_msg['message'];

if($action == "forgot_password") {
    echo $pass->displayResetForm();
}
else if ($action == "reset" && isset($email, $link)) {
    echo $pass->displayResetPasswordForm($email, $link);
}

else {
    
}