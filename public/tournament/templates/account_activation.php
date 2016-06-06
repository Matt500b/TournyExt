<?php

$email = $_GET['e'];
$link = $_GET['q'];

$activate = new processing($db, $response);

if(isset($email, $link)) {
    $return_msg = $activate->activate($email, $link);
    echo $return_msg['message'];
    if($return_msg['status'] == 1) {
        echo '<script>setTimeout(function(){window.location = "index.php"}, 2000);</script>';
    }
}
else {
    echo '404 page?';
}