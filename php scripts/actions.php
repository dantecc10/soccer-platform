<?php
session_start();
if (isset($_SESSION['id']) || isset($_GET['type'])) {
    include "functions.php";
    switch ($_GET['type']) {
        case 'add-team':
            $result = add_team($_POST['league-team'], $_POST['team-name'], $_FILES['logo-team'], $_POST['couch-team'], $_POST['description_team']);
            if ($result != false) {
                save_team_logo($result, $_FILES['logo-team']);
                header("Location: ../add-players.php");
            } else {
                header("Location: ../add-teams.php?error=true");
            }
            break;
        case 'load-players':
            (massive_players_upload($_POST['team-id'])) ? header("Location: ../team-detail.php?id=" . ($_POST['team-id'])) : $error = ("Error");
            if (isset($error)) {
                header("Location: ../add-players.php?error=true");
            }
            break;
        case 'foul':
            $data = array();
            $data['foul-team'] = $_POST['foul-team'];
            $data['foul-player'] = $_POST['foul-player'];
            $data['foul-type'] = $_POST['foul-type'];
            $data['foul-consequence'] = $_POST['foul-consequence'];
            $data[''] = $_POST[''];
            $data[''] = $_POST[''];

            break;
        default:
            // Error, redirigir al inicio
            break;
    }
} else {
    header("Location: ../actions.html?error=true");
}
