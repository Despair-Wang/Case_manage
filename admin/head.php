<?php
session_start();
if (isset($_SESSION['login']) == false || $_SESSION['login'] == 0) {
    // echo "ERROR";
    header('Location: login.html');
    exit();
}

$init = array();
function init()
{
    // $init_c = "<script>\n\t$(document).ready(function(){";
    $init_c = "";
    global $init;
    foreach ($init as $value) {
        $init_c .= "\n\t" . $value;
    }
    $init_c .= "\n";
    echo $init_c;
}

function set_init($content)
{
    global $init;
    array_push($init, $content);
}

function set_title($title)
{
    set_init("$('title').html('{$title}');");
}

?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/croppie.css" />
<script type="text/javascript" src="js/a_core.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
<script src="js/lc_switch.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/lc_switch.css" />