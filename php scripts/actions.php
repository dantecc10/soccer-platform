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
            $result = add_match($_POST['local-team'], $_POST['visitor-team'], $_POST['referee-match'], $_POST['date-match'], $_POST['time-match'], $_POST['field-match'], $_POST['matchday-match']);
            if ($result) {
                header("Location: ../#matches");
            } else {
                header("Location: ../add-matches.php?error=true");
            }
            break;
        case 'foul':
            $data = array();
            $data[0] = $_POST['foul-team']; // ['foul-team']
            $data[1] = $_POST['foul-player']; // ['foul-player']
            $data[2] = $_POST['foul-type']; // ['foul-type']
            //$data[3] = $_POST['foul-card']; // ['foul-card']
            if (isset($_POST['foul-no-card'])) {
                $data[3] = 0;
            } else {
                if (isset($_POST['foul-yellow-card'])) {
                    $data[3] = 1;
                } else {
                    $data[3] = (isset($_POST['foul-double-yellow-card'])) ? 2 : 3;
                }
            }
            /*
            Correct this code!
            */
            $data[4] = $_POST['foul-consequence']; // ['foul-consequence']
            $data[5] = $_POST['match-id']; // $_POST['foul-match']; // ['foul-match']
            $data[6] = (isset($_POST['foul-time'])) ? ($_POST['foul-time']) : 0; // ['foul-time']
            $data[7] = $_POST['referee-id']; // $_POST['foul-referee']; // ['foul-referee']
            $data[8] = $_POST['match-score']; // ['match-score']
            echo (add_foul($data) ? "true" : "false");

            break;
        case 'goal':
            $data = array();
            $data[0] = $_POST['goal-team']; // ['goal-team']
            $data[1] = $_POST['goal-player']; // ['goal-player']
            $data[2] = $_POST['goal-type']; // ['goal-type']
            $data[3] = (isset($_POST['goal-against'])) ? 1 : 0;
            $data[4] = $_POST['match_id_form']; // ['foul-match']
            $data[5] = (isset($_POST['goal-time']) ? $_POST['goal-time'] : 0); // ['goal-time']
            $data[6] = $_POST['referee-id']; // ['foul-referee']
            //$data[7] = ; // enviar localía o visita
            $data[8] = $_POST['match-score']; // ['match-score']
            echo (add_goal($data) ? "true" : "false");
            //echo ($_POST['match-id']."/".$_POST['referee-id']."/".$_POST['match-score']);
            break;
        case 'update-event-data':
            $id  = $_POST['id'];
            echo (detailed_matches_output(null, $id));
            break;
        default:
            // Error, redirigir al inicio
            break;
    }
} else {
    header("Location: ../actions.php?error=true");
}
