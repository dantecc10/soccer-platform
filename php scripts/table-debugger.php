<?php
include_once "functions.php";

$fields_array = [
    ['id_match', 'local_team_id', 'visitor_team_id', 'match_referee_id', 'start_schedule_match', 'finish_schedule_match', 'status_match', 'field_match', 'local_goals_match', 'visitor_goals_match', 'local_shots_match', 'visitor_shots_match', 'local_fouls_match', 'visitor_fouls_match', 'local_corners_match', 'visitor_corners_match', 'local_yellow_cards_match', 'visitor_yellow_cards_match', 'local_red_cards_match', 'visitor_red_cards_match'],
    ['id_player', 'name_player', 'last_names_player', 'nickname_player', 'dorsal_player', 'player_team_id', 'goals_player', 'assists_player', 'fouls_player', 'yellow_cards_player', 'red_cards_player', 'img_player'],
    ['id_stat', 'type_stat', 'timestamp_stat', 'stat_match_id', 'stat_player_id', 'stat_referee_id', 'stat_team_id', 'stat_details'],
    ['id_team', 'name_team', 'coach_team', 'wins_team', 'draws_team', 'losses_team', 'goals_for_team', 'goals_against_team', 'points_team', 'description_teams', 'icon_team'],
    ['id_referee', 'name_referee', 'last_names_referee', 'matches_referee']
];

$matches_fields = $fields_array[0];
$player_fields = $fields_array[1];
$stats_fields = $fields_array[2];
$teams_fields = $fields_array[3];
$referees_fields = $fields_array[4];



//echo (substr($fields_array[0][0], 3, strlen($fields_array[0][0])));
error_reporting(E_ALL);
include_once "soccer_queries.php";
//debug_data_printer(sql_debug_fetcher('matches', $matches_fields, ""));
//generate_league_table();
//create_match([2, 5, 3, '2021-05-01 12:00:00', '2021-05-01 14:00:00', 1, 'Allianz Arena']);
//debug_data_printer(sql_debug_fetcher('matches', $match_basic_data_fields, $match_basic_data_query));

//debug_data_printer(sql_debug_fetcher('matches', $match_basic_data_fields, $match_basic_data_queries[0]));
//$temp = $match_basic_data_fields;
//$temp[] = 'id_match';
//$temp[] = 'status_match';
//
//$data = fetch_fields('matches', $temp, null, str_replace("?", 22, $match_basic_data_queries[3]));
//print_r($data);
//echo (matches_output(fetch_matches(0)));

//echo __DIR__;
$fields = [
    'id_stat',
    'type_stat',
    'timestamp_stat',
    'stat_match_id',
    'stat_player_id',
    'stat_referee_id',
    'stat_team_id',
    'stat_details',
    'name_player',
    'nickname_player',
    'last_names_player',
    'icon_team'
];
$id = 22;
$sql = "SELECT stats.*, players.name_player, players.nickname_player, players.last_names_player, teams.icon_team
            FROM stats JOIN players ON stats.stat_player_id = players.id_player
            JOIN teams ON players.player_team_id = teams.id_team WHERE stats.stat_match_id = $id
        ORDER BY stats.timestamp_stat DESC;";
debug_data_printer(sql_debug_fetcher('stats', $fields, $sql));