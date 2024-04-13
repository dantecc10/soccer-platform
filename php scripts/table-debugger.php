<?php
include_once "functions.php";

$player_fields = [
    'id_player',
    'name_player',
    'last_names_player',
    'nickname_player',
    'dorsal_player',
    'player_team_id',
    'goals_player',
    'assists_player',
    'fouls_player',
    'yellow_cards_player',
    'red_cards_player'
];

error_reporting(E_ALL);
debug_data_printer(sql_debug_fetcher('players', $player_fields));
