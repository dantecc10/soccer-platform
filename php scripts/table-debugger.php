<?php
include_once "functions.php";

$fields_array = [
    ['id_match', 'local_team_id', 'visitor_team_id', 'match_referee_id', 'start_schedule_match', 'finish_schedule_match', 'local_goals_match', 'visitor_goals_match', 'local_shots_match', 'visitor_shots_match', 'local_fouls_match', 'visitor_fouls_match', 'local_corners_match', 'visitor_corners_match', 'local_yellow_cards_match', 'visitor_yellow_cards_match', 'local_red_cards_match', 'visitor_red_cards_match'],
    ['id_player', 'name_player', 'last_names_player', 'nickname_player', 'dorsal_player', 'player_team_id', 'goals_player', 'assists_player', 'fouls_player', 'yellow_cards_player', 'red_cards_player'],
    ['id_stat', 'type_stat', 'timestamp_stat', 'stat_match_id', 'stat_player_id', 'stat_referee_id', 'stat_team_id', 'stat_details'],
    ['id_team', 'name_team', 'coach_team', 'wins_team', 'draws_team', 'losses_team', 'goals_for_team', 'goals_against_team', 'points_team', 'description_teams', 'icon_team'],
    ['id_referee', 'name_referee', 'last_names_referee', 'matches_referee']
];

$matches_fields = $fields_array[0];
$player_fields = $fields_array[1];
$stats_fields = $fields_array[2];
$teams_fields = $fields_array[3];
$referees_fields = $fields_array[4];

echo (substr($fields_array[0][0], 3, strlen($fields_array[0][0])));
error_reporting(E_ALL);
debug_data_printer(sql_debug_fetcher('players', $player_fields));
