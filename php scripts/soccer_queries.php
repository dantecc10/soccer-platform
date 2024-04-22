<?php
$league_table = "SELECT * FROM `teams` ORDER BY (`wins_team` * 3) + (`draws_team` * 1) DESC"; // Suma los puntos de victoria, más los de empates, según eso, se ordena
$top_scorers = "SELECT * FROM `players` ORDER BY (`goals_player`) DESC";
$top_assisters = "SELECT * FROM `players` ORDER BY (`assists_player`) DESC";
$top_fouls = "SELECT * FROM `players` ORDER BY (`fouls_player`) DESC";
$x_team_players = "SELECT * FROM `players` WHERE (`player_team_id` = ?) ORDER BY (`dorsal_player`) ASC"; // Se debe pasar el id del equipo por STMT
$referees = "SELECT * FROM `referees`";

$matches_fields = [
    'id_match',
    'local_team_id',
    'visitor_team_id',
    'match_referee_id',
    'start_schedule_match',
    'finish_schedule_match',
    'status_match',
    'local_goals_match',
    'visitor_goals_match',
    'local_shots_match',
    'visitor_shots_match',
    'local_fouls_match',
    'visitor_fouls_match',
    'local_corners_match',
    'visitor_corners_match',
    'local_yellow_cards_match',
    'visitor_yellow_cards_match',
    'local_red_cards_match',
    'visitor_red_cards_match'
];

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
    'red_cards_player',
    'img_player'
];

$stats_fields = [
    'id_stat',
    'type_stat',
    'timestamp_stat',
    'stat_match_id',
    'stat_player_id',
    'stat_referee_id',
    'stat_team_id',
    'stat_details'
];

$teams_fields = [ //'stadium_team', 'city_team', 'foundation_team', 'president_team',
    'id_team',
    'name_team',
    'coach_team',
    'wins_team',
    'draws_team',
    'losses_team',
    'goals_for_team',
    'goals_against_team',
    'points_team',
    'description_teams',
    'icon_team'
];

$referees_fields = [
    'id_referee',
    'name_referee',
    'last_names_referee',
    'matches_referee'
];

$matches = "SELECT * FROM `matches` ORDER BY (`start_schedule_match`) DESC;";

$league_query = "SELECT `icon_team`, `name_team`,
            (`wins_team` + `draws_team` + `losses_team`) AS `played_games`,
            `wins_team`, `draws_team`, `losses_team`, `goals_for_team`, `goals_against_team`,
            (`goals_for_team` - `goals_against_team`) AS `goals_difference`,
            ((3 * `wins_team`) + `draws_team`) AS `points`
            FROM `teams` ORDER BY `points` DESC, `goals_difference` DESC;";

$match_basic_data_query = "SELECT
            `local_team`.`name_team`, `local_team`.`icon_team`, `matches`.`local_goals_match`, `matches`.`visitor_goals_match`,
            `visitor_team`.`name_team`, `visitor_team`.`icon_team`, `matches`.`start_schedule_match`
            FROM `matches`
            INNER JOIN `teams` AS `local_team` ON `matches`.`local_team_id` = `local_team`.`id_team`
            INNER JOIN `teams` AS `visitor_team` ON `matches`.`visitor_team_id` = `visitor_team`.`id_team`
            WHERE (`matches`.`finish_schedule_match` < CURRENT_DATE) ORDER BY `matches`.`start_schedule_match` DESC";

$match_basic_data_fields = [
    'name_team',
    'icon_team',
    'local_goals_match',
    'visitor_goals_match',
    'name_team',
    'icon_team',
    'start_schedule_match'
];

$league_table_fields = [
    'icon_team',
    'name_team',
    'played_games',
    'wins_team',
    'draws_team',
    'losses_team',
    'goals_for_team',
    'goals_against_team',
    'goals_difference',
    'points'
];