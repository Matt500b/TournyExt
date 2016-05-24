<?php
$pid = $_GET['pid'];

echo '<div class="wrapper">';
    if(isset($pid)) {
        echo 'Currently viewing user '. $pid;
    }
    else {
        echo 'No user selected. How to handle this :)?';
    }
echo '</div>';

