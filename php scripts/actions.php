<?php
session_start();
if (isset($_SESSION['id']) || isset($_GET['type'])) {
    include "functions.php";
    switch ($_GET['type']) {
        case 'add-team':
            $result = add_team($_POST['league-team'], $_POST['team-name'], $_FILES['logo-team'], $_POST['couch-team'], $_POST['description_team'], $_POST['name-user'], $_POST['last-names-user'], $_POST['email-user'], $_POST['password-user'], 0);
            if ($result != false) {
                save_team_logo($result, $_FILES['logo-team']);
                $_SESSION['logged_in'] = true;
                $_SESSION['id_user'] = $result;
                $_SESSION['name_user'] = $_POST['name-user'];
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

        case 'add-match':
            $result = add_match($_POST['team-local'], $_POST['team-visitor'], $_POST['referee-match'], $_POST['date-match'], $_POST['time-match'], $_POST['field-match'], $_POST['matchday-match']);
            if ($result) {
                header("Location: ../#matches");
            } else {
                header("Location: ../add-matches.php?error=true");
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
