<?php

$str = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAA...';

if (strpos($str, 'png') != false) {
    echo 'Is png!!!!!!!!!!!!!!!!!!!!!!!!';
} elseif (strpos($str, 'jpeg') != false) {
    echo 'Is JPEG!!!!!!!!!!!!!!!!!!!!!!!!!';
} else {
    echo 'IS OTHER!!!!!!!!!!!!!!!!!!!!!!!!!!';
}