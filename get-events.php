<?php

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

if (!isset($_GET['start']) || !isset($_GET['end'])) {
    die("Please provide a date range.");
}

$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

$time_zone = new DateTimeZone('Asia/Taipei');

$role = "`user_serial` = '" . $_GET['serial'] . "'";

require_once "db_cone.php";
$sql = "select `title`,`start`,`end` from `schedule` where {$role};";
$result = mysqli_query($con, $sql);
$input_arrays = mysqli_fetch_all($result, MYSQLI_ASSOC);

$output_arrays = array();
foreach ($input_arrays as $array) {

    $event = new Event($array, $time_zone);

    if ($event->isWithinDayRange($range_start, $range_end)) {
        $output_arrays[] = $event->toArray();
    }
}

echo json_encode($output_arrays);