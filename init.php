<?php
//CONNECTION TO DATABASE
require "connect.php";


$tpl    = "includes/templates/";
$css    = "design/css/"; //CSS DIRECTORY
$js     = "design/js/"; //JS DIRECTORY
$func   = "includes/functions/"; //FUNCTIONS DIRECTORY


//REQUIRING IMPORTANT FILES
require $func . 'functions.php';
require $tpl . 'header.php';
if (!isset($noNavbar)) {
    require $tpl . 'navbar.php';
}
