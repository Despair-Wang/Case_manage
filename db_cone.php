<?php

date_default_timezone_set("Asia/Taipei");

$con = new mysqli('127.0.0.1', 'system', 'Zxcv1234@', 'case_manage') or die("Connect Error!");

if ($con->connect_error == "") {
    $con->character_set_name();
    $con->set_charset("utf8mb4");
}