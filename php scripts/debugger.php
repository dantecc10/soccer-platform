<?php
include_once "functions.php";

session_start();
//$_SESSION['logged_in'] = true;
//$_SESSION['id_user'] = 5;
//$_SESSION['name_user'] = "Dante";
//
//if (logged_in()) {
//    echo "You are logged in";
//} else {
//    echo "You are not logged in";
//}
//
//if (isset($_SESSION['img_exec'])) {
//    echo ($_SESSION['img_exec'] == true) ? "Image uploaded" : "Image not uploaded";
//    echo ($_SESSION['error']);
//}

//print_r(match_events(22));
//echo (isset($_SESSION["referee_id_user"]) ? $_SESSION["referee_id_user"] : "No referee");
//echo (isset($_SESSION["email_user"]) ? $_SESSION["email_user"] : "No email");

//echo proccess_events(match_events(24), [2, 3]);

//print_r(match_events(23)[2]);

echo (matches_output(fetch_matches(1, null)));