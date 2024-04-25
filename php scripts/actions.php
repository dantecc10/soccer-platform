<?php
session_start();
if (isset($_SESSION['id']) || isset($_GET['type'])) {
    include "functions.php";
    switch ($_GET['type']) {
        case 'add-team':
            $result = add_team($_POST['league-team'], $_POST['team-name'], $_FILES['logo-team'], $_POST['couch-team'], $_POST['description_team']);
            if ($result != false) {
                save_team_logo($result, $_FILES['logo-team']);

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
