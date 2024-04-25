<?php
session_start();
if (isset($_SESSION['id']) || isset($_GET['type'])) {
    include "functions.php";
    switch ($_GET['type']) {
        case 'add-team':
            
            $result = add_team($_POST['league_team'], $_POST['team_name'], $_POST['logo_team'], $_POST['couch_team'], $_POST['description_name']);
            if ($result != false) {
                save_team_logo($result, $_FILES['logo_team']);

                header("Location: ../add-team-members.html");
            } else {
                header("Location: ../add-team.php?error=true");
            }
            break;

        default:
            // Error, redirigir al inicio
            break;
    }
}else{
    header("Location: ../actions.html?error=true");
}
