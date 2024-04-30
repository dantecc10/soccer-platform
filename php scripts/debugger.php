<?php
include_once "functions.php";

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['id_user'] = 5;
$_SESSION['name_user'] = "Dante";

if (logged_in()) {
    echo "You are logged in";
} else {
    echo "You are not logged in";
}

if (isset($_SESSION['img_exec'])) {
    echo ($_SESSION['img_exec'] == true) ? "Image uploaded" : "Image not uploaded";
}
