<?php
require_once "db_cone.php";
$sql = "select `title`,`start` from `schedule` where 1;";
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($rows);
echo $rows;