<?php
require_once "db_cone.php";
session_start();
// session_destroy();
$mail = $_POST['mail'];
$pw = $_POST['pw'];
$sql = "select `serial`,`role`,`name`,`image` from `users` where mail = '{$mail}' and pw = '{$pw}';";
// echo $sql;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($row as $value) {
    $_SESSION['role'] = $value['role'];
    $_SESSION['serial'] = $value['serial'];
    $_SESSION['name'] = $value['name'];
    $_SESSION['image'] = $value['image'];
    $_SESSION['login'] = true;
}
// session_destroy();
// echo $_SESSION['login'];
header('Location: nothome.php');
// header('Location: head.php');
// exit();