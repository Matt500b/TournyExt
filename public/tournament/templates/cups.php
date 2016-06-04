<?php

$cid = $_GET['cid'];
$page = $_GET['page'];

$cup = new cup($db);

if(isset($cid)) {

}
else {
    echo $cup->displayAllActive();
}