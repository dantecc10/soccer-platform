<?php
$league_table = "SELECT * FROM `teams` ORDER BY (`wins_team` * 3) + (`draws_team` * 1) DESC;"; // Suma los puntos de victoria, más los de empates, según eso, se ordena
$top_scorers = "SELECT * FROM `players` ORDER BY (`goals_player`) DESC;";
$top_assisters = "SELECT * FROM `players` ORDER BY (`assists_player`) DESC;";
$top_fouls = "SELECT * FROM `players` ORDER BY (`fouls_player`) DESC;";
$x_team_players = "SELECT * FROM `players` WHERE (`player_team_id` = 1) ORDER BY (`dorsal_player`) ASC;";
