<?php

$cid = $_GET['cid'];
$page = $_GET['page'];

$cup = new cup($db);

echo '<div class="wrapper">';

if(isset($cid)) {

}
else {
    echo $cup->displayAllActive();
}








echo '</div>';