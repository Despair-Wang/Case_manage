<?php
switch ($_GET['do']) {
    case 'save_pic':
        if (isset($_POST)) {
            $files1 = $_POST['gallery'];
            $type = '';
            foreach ($files1 as $value) {
                if (strpos($value, 'jpeg') != false) {
                    $value = str_replace('data:image/jpeg;base64,', '', $value);
                    $type = '.jpeg';
                } elseif (strpos($value, 'png') != false) {
                    $value = str_replace('data:image/png;base64,', '', $value);
                    $type = '.png';
                }
                $value = str_replace(' ', '+', $value);
                $data = base64_decode($value);
                $file = 'image/' . uniqid('gall', false) . $type;
                $result = file_put_contents($file, $data);
            }
            foreach ($_POST['stepPic'] as $value) {
                if (strpos($value, 'jpeg') != false) {
                    $value = str_replace('data:image/jpeg;base64,', '', $value);
                    $type = '.jpeg';
                } elseif (strpos($value, 'png') != false) {
                    $value = str_replace('data:image/png;base64,', '', $value);
                    $type = '.png';
                }
                $value = str_replace(' ', '+', $value);
                $data = base64_decode($value);
                $file = 'image/' . uniqid('step', false) . $type;
                $result = file_put_contents($file, $data);
            }

            echo 'GET';
            // $number = $_POST['number'];
            // $price = $_POST['price'];
            // print_r($number);
            // print_r($price);
        } else {
            echo 'NOT DATA';
        }

        // echo $files;
        break;

    default:
        # code...
        break;
}