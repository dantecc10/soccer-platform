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
    'matchday_match',
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
    'position_player',
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
            ((3 * `wins_team`) + `draws_team`) AS `points`, `id_team`
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
    WHERE (m.status_match = 0) ORDER BY m.start_schedule_match DESC LIMIT 5;",
    "SELECT m.start_schedule_match, m.field_match,
       t1.name_team AS local_name_team, t1.icon_team AS local_icon_team, m.local_goals_match,
       m.visitor_goals_match, t2.icon_team AS visitor_icon_team, t2.name_team AS visitor_name_team,
       r.name_referee, r.last_names_referee
    FROM matches m
    JOIN teams t1 ON m.local_team_id = t1.id_team JOIN teams t2 ON m.visitor_team_id = t2.id_team JOIN referees r ON m.match_referee_id = r.id_referee
    WHERE (m.id_match = ?);"
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

$top_players_query = ("SELECT `players`.*, `teams`.`name_team` AS `team_name`, `teams`.`icon_team` AS `team_logo`
FROM `players` JOIN `teams` ON `players`.`player_team_id` = `teams`.`id_team` 
ORDER BY `goals_player` DESC, `assists_player` DESC, `fouls_player` ASC LIMIT 5;");

$top_players_fields = [
    'id_player',
    'name_player',
    'last_names_player',
    'nickname_player',
    'dorsal_player',
    'player_team_id',
    'goals_player',
    'assists_player',
    'fouls_player',
    'img_player',
    'team_name',
    'team_logo'
];

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
    'points',
    'id_team'
];
$c = "'";
$top_player_inner_dom = ('
<div class="carousel-item active">
    <div class="row" style="max-height: 40rem;">
        <div class="col col-12 col-sm-5 col-md-6 col-xxl-5 ps-sm-4" style="max-height: inherit;">
            <div class="row">
                <div class="col">
                    <h1 class="text-center submain-color m-0 custom-font fs-4">FLAG FLAG</h1>
                </div>
            </div>
            <div class="row" style="max-height: 20rem;">
                <div class="col text-center p-0" style="background: url(' . $c . 'FLAG' . $c . ') center / contain no-repeat;filter: drop-shadow(0 10px 1rem rgba(0, 0, 0, 0.5));max-height: inherit;"><img src="FLAG" style="max-height: inherit;filter: drop-shadow(-10px 10px rgba(0, 0, 0, 0.5));max-width: inherit;"></div>
            </div>
        </div>
        <div class="col align-middle align-self-center mt-3 mt-sm-0" style="max-height: inherit;">
            <div class="row">
                <div class="col col-12" style="border-bottom: 4px solid var(--submain-background-color);">
                    <div class="row">
                        <div class="col justify-content-center text-center fs-4"><span>Estadísticas del jugador</span></div>
                    </div>
                </div>
                <div class="col col-12 pb-5" style="display: table;">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="row" style="border-bottom: 1.5px solid var(--submain-background-color);">
                                        <div class="col col-4 col-lg-5 text-center align-self-center px-1" style="/*border-bottom: 1.5px solid var(--third-color);*/border-right: 1.5px solid var(--third-color) !important;max-height: 2rem;"><span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-shield-heart">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 21a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12.01 12.01 0 0 1 .378 5"></path>
                                                    <path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z"></path>
                                                </svg>&nbsp;Equipo</span></div>
                                        <div class="col align-self-center text-center p-0" style="/*border-bottom: 1.5px solid var(--third-color);*/border-left: 1.5px solid var(--third-color) !important;"><span class="text-nowrap"><img class="bs-icon-sm icon" src="FLAG" style="max-height: 1rem;">&nbsp;FLAG</span></div>
                                    </div>
                                    <div class="row" style="border-bottom: 1.5px solid var(--submain-background-color);border-top: 1.5px solid var(--submain-background-color);">
                                        <div class="col col-6 text-center" style="/*border-bottom: 1.5px solid var(--third-color);*/border-right: 1.5px solid var(--third-color) !important;"><span><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                                    <g>
                                                        <rect fill="none" height="24" width="24"></rect>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M13,5.3l1.35-0.95 c1.82,0.56,3.37,1.76,4.38,3.34l-0.39,1.34l-1.35,0.46L13,6.7V5.3z M9.65,4.35L11,5.3v1.4L7.01,9.49L5.66,9.03L5.27,7.69 C6.28,6.12,7.83,4.92,9.65,4.35z M7.08,17.11l-1.14,0.1C4.73,15.81,4,13.99,4,12c0-0.12,0.01-0.23,0.02-0.35l1-0.73L6.4,11.4 l1.46,4.34L7.08,17.11z M14.5,19.59C13.71,19.85,12.87,20,12,20s-1.71-0.15-2.5-0.41l-0.69-1.49L9.45,17h5.11l0.64,1.11 L14.5,19.59z M14.27,15H9.73l-1.35-4.02L12,8.44l3.63,2.54L14.27,15z M18.06,17.21l-1.14-0.1l-0.79-1.37l1.46-4.34l1.39-0.47 l1,0.73C19.99,11.77,20,11.88,20,12C20,13.99,19.27,15.81,18.06,17.21z"></path>
                                                        </g>
                                                    </g>
                                                </svg>&nbsp;Goles</span></div>
                                        <div class="col align-self-center col-6 text-center" style="/*border-bottom: 1.5px solid var(--third-color);*/border-left: 1.5px solid var(--third-color) !important;"><span>FLAG</span></div>
                                    </div>
                                    <div class="row" style="border-top: 1.5px solid var(--submain-background-color);border-bottom: 1.5px solid var(--submain-background-color);">
                                        <div class="col col-6 text-center" style="/*border-bottom: 1.5px solid var(--third-color);*/border-right: 1.5px solid var(--third-color) !important;"><span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-shoe">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 6h5.426a1 1 0 0 1 .863 .496l1.064 1.823a3 3 0 0 0 1.896 1.407l4.677 1.114a4 4 0 0 1 3.074 3.89v2.27a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1z"></path>
                                                    <path d="M14 13l1 -2"></path>
                                                    <path d="M8 18v-1a4 4 0 0 0 -4 -4h-1"></path>
                                                    <path d="M10 12l1.5 -3"></path>
                                                </svg>&nbsp;Asistencias</span></div>
                                        <div class="col align-self-center col-6 text-center" style="/*border-bottom: 1.5px solid var(--third-color);*/border-left: 1.5px solid var(--third-color) !important;"><span>FLAG</span></div>
                                    </div>
                                    <div class="row" style="border-top: 1.5px solid var(--submain-background-color);">
                                        <div class="col col-6 text-center" style="/*border-bottom: 1.5px solid var(--third-color);*/border-right: 1.5px solid var(--third-color) !important;"><span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-cards">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M3.604 7.197l7.138 -3.109a.96 .96 0 0 1 1.27 .527l4.924 11.902a1 1 0 0 1 -.514 1.304l-7.137 3.109a.96 .96 0 0 1 -1.271 -.527l-4.924 -11.903a1 1 0 0 1 .514 -1.304z"></path>
                                                    <path d="M15 4h1a1 1 0 0 1 1 1v3.5"></path>
                                                    <path d="M20 6c.264 .112 .52 .217 .768 .315a1 1 0 0 1 .53 1.311l-2.298 5.374"></path>
                                                </svg>&nbsp;Faltas</span></div>
                                        <div class="col align-self-center col-6 text-center" style="/*border-bottom: 1.5px solid var(--third-color);*/border-left: 1.5px solid var(--third-color) !important;"><span>FLAG</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>');

$team_cards_query = 'SELECT `teams`.*, `position` FROM (SELECT `id_team`,
        ROW_NUMBER() OVER (ORDER BY ((3 * `wins_team`) + `draws_team`) DESC, (`goals_for_team` - `goals_against_team`) DESC) AS `position`
    FROM `teams`) AS `place` JOIN `teams` ON `teams`.`id_team` = `place`.`id_team`';

$card_unit_dom = ('
<div class="card col-12 col-md-3 m-2 rounded-5 team-card text-center align-items-center align-self-center" style="min-width: 30% !important;background: none !important;" onclick="javascript:team_detail(FLAG);">
    <img class="card-img-top w-100 d-block p-1 w-auto" src="FLAG" style="max-height: auto;max-width: 85% !important;" />
    <div class="card-body col-12 rounded-4 py-0">
        <div class="row p-3 align-self-center main-bg-color submain-color rounded-5" style="border: 3px solid var(--third-background-color);">
            <div class="col px-1">
                <h6 class="mb-0 p-0 fs-3 text-muted submain-bg-color rounded-5">FLAG° en la liga</h6>
                <h4 class="fw-lighter p-0 m-0" style="font-size: smaller;">DT: FLAG</h4>
                <h4 class="fs-1 fw-bolder m-0">FLAG</h4>
            </div>
        </div>
    </div>
</div>
');
