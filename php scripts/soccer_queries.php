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
    'field_match',
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

$match_basic_data_queries = [
    "SELECT m.start_schedule_match, m.field_match,
       t1.name_team AS local_name_team, t1.icon_team AS local_icon_team, m.local_goals_match,
       m.visitor_goals_match, t2.icon_team AS visitor_icon_team, t2.name_team AS visitor_name_team,
       r.name_referee, r.last_names_referee
    FROM matches m
    JOIN teams t1 ON m.local_team_id = t1.id_team JOIN teams t2 ON m.visitor_team_id = t2.id_team JOIN referees r ON m.match_referee_id = r.id_referee
    WHERE m.status_match = 4 ORDER BY m.start_schedule_match DESC LIMIT 5;",
    "SELECT m.start_schedule_match, m.field_match,
       t1.name_team AS local_name_team, t1.icon_team AS local_icon_team, m.local_goals_match,
       m.visitor_goals_match, t2.icon_team AS visitor_icon_team, t2.name_team AS visitor_name_team,
       r.name_referee, r.last_names_referee
    FROM matches m
    JOIN teams t1 ON m.local_team_id = t1.id_team JOIN teams t2 ON m.visitor_team_id = t2.id_team JOIN referees r ON m.match_referee_id = r.id_referee
    WHERE ((m.status_match < 4) AND (m.status_match > 0)) ORDER BY m.start_schedule_match DESC LIMIT 5;",
    "SELECT m.start_schedule_match, m.field_match,
       t1.name_team AS local_name_team, t1.icon_team AS local_icon_team, m.local_goals_match,
       m.visitor_goals_match, t2.icon_team AS visitor_icon_team, t2.name_team AS visitor_name_team,
       r.name_referee, r.last_names_referee
    FROM matches m
    JOIN teams t1 ON m.local_team_id = t1.id_team JOIN teams t2 ON m.visitor_team_id = t2.id_team JOIN referees r ON m.match_referee_id = r.id_referee
    WHERE (m.status_match = 0) ORDER BY m.start_schedule_match DESC LIMIT 5;"
];
$team_detail_query = "SELECT `teams`.*, `played_games`, `position` FROM (
         SELECT `id_team`, ((3 * `wins_team`) + `draws_team`) AS `points`, 
             (`goals_for_team` - `goals_against_team`) AS `goal_difference`,
               (`wins_team` + `losses_team` + `draws_team`) AS `played_games`,
             ROW_NUMBER() OVER (ORDER BY ((3 * `wins_team`) + `draws_team`) DESC, (`goals_for_team` - `goals_against_team`) DESC) AS `position`
         FROM `teams`) AS `place` JOIN `teams` ON `teams`.`id_team` = `place`.`id_team` WHERE `teams`.`id_team` = 7;";

$team_position = "SELECT `position` FROM (
                    SELECT `id_team`, `name_team`, ((3 * `wins_team`) + `draws_team`) AS `points`, 
                    (`goals_for_team` - `goals_against_team`) AS `goal_difference`,
           		    ROW_NUMBER() OVER (ORDER BY ((3 * `wins_team`) + `draws_team`) DESC, (`goals_for_team` - `goals_against_team`) DESC) AS `position`
                FROM `teams`) AS `place` WHERE `id_team` = 7";

$match_basic_data_fields = [
    'start_schedule_match',
    'field_match',
    'local_name_team',
    'local_icon_team',
    'local_goals_match',
    'visitor_goals_match',
    'visitor_icon_team',
    'visitor_name_team',
    'name_referee',
    'last_names_referee'
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

