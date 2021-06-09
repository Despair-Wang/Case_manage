<?php
require_once "db_cone.php";
// echo set();
$sql = "select c_option from `order_case` where `case_id` = 'c202106070001';";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$c_option = '';
$op_rs = explode(',', $row['c_option']);
foreach ($op_rs as $op_r) {
    $val = explode('=', $op_r);
    // print_r($val);

    // print_r($val);
    // echo $val;
    $r = set_option($val[0], $val[1]);
    $c_option .= $r;

    // echo $r;
}
echo 'option = ' . $c_option;

// function set()
// {
//     global $con;
//     $sql = "select option_name from `case_option` where `option_id` = 'option1';";
//     // $sql = "select option_name from `case_option` where 1;";
//     // $result = mysqli_query($con, $sql);
//     // $row = mysqli_fetch_row($result);
//     // $row = mysqli_fetch_lengths($result);
//     // $sql = "select option_name from `case_option` where `option_id` = '{$opt}';";
//     $result = mysqli_query($con, $sql);
//     $row = mysqli_fetch_row($result);
//     return "<h5>{$row[0]}</h5>\n";

//     // print_r($row);
//     // echo $row[0];
// }
function set_option($opt, $bool)
{
    global $con;
    if ($bool == 'true') {
        $sql = "select option_name from `case_option` where `option_id` = '{$opt}';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        // print_r($row);
        // echo $row;
        // echo 'done';
        return "<h5>{$row[0]}</h5>\n";
    } else {
        // echo 'error';
        return '';
    }
}