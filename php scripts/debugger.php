<?php
include_once "functions.php";

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['id_user'] = 5;
$_SESSION['name_user'] = "Dante";
