-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 74.208.62.188    Database: soccer-platform
-- ------------------------------------------------------
-- Server version	10.6.16-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matches` (
  `id_match` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `local_team_id` int(10) unsigned NOT NULL,
  `visitor_team_id` int(10) unsigned NOT NULL,
  `match_referee_id` int(10) unsigned DEFAULT NULL,
  `start_schedule_match` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `finish_schedule_match` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status_match` smallint(5) unsigned NOT NULL DEFAULT 0,
  `field_match` varchar(255) DEFAULT NULL,
  `matchday_match` int(10) unsigned DEFAULT NULL,
  `local_goals_match` int(10) unsigned DEFAULT 0,
  `visitor_goals_match` int(10) unsigned DEFAULT 0,
  `local_shots_match` int(10) unsigned DEFAULT 0,
  `visitor_shots_match` int(10) unsigned DEFAULT 0,
  `local_fouls_match` int(10) unsigned DEFAULT 0,
  `visitor_fouls_match` int(10) unsigned DEFAULT 0,
  `local_corners_match` int(10) unsigned DEFAULT 0,
  `visitor_corners_match` int(10) unsigned DEFAULT 0,
  `local_yellow_cards_match` int(10) unsigned DEFAULT 0,
  `visitor_yellow_cards_match` int(10) unsigned DEFAULT 0,
  `local_red_cards_match` int(10) unsigned DEFAULT 0,
  `visitor_red_cards_match` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id_match`),
  KEY `matches_visitor_team_id` (`visitor_team_id`),
  KEY `matches_local_team_id` (`local_team_id`),
  KEY `matches_referee_id` (`match_referee_id`),
  CONSTRAINT `matches_local_team_id` FOREIGN KEY (`local_team_id`) REFERENCES `teams` (`id_team`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matches_referee_id` FOREIGN KEY (`match_referee_id`) REFERENCES `referees` (`id_referee`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matches_visitor_team_id` FOREIGN KEY (`visitor_team_id`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `id_player` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_player` varchar(255) NOT NULL,
  `last_names_player` varchar(255) DEFAULT NULL,
  `nickname_player` varchar(255) DEFAULT NULL,
  `dorsal_player` int(11) NOT NULL,
  `position_player` varchar(255) NOT NULL,
  `player_team_id` int(10) unsigned NOT NULL,
  `goals_player` int(10) unsigned DEFAULT NULL,
  `assists_player` int(10) unsigned DEFAULT NULL,
  `fouls_player` int(10) unsigned DEFAULT NULL,
  `yellow_cards_player` int(10) unsigned DEFAULT NULL,
  `red_cards_player` int(10) unsigned DEFAULT NULL,
  `img_player` text DEFAULT NULL,
  PRIMARY KEY (`id_player`),
  KEY `players_player_team_id` (`player_team_id`),
  CONSTRAINT `players_player_team_id` FOREIGN KEY (`player_team_id`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referees`
--

DROP TABLE IF EXISTS `referees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referees` (
  `id_referee` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_referee` varchar(255) NOT NULL,
  `last_names_referee` varchar(255) DEFAULT NULL,
  `matches_referee` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id_referee`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stats` (
  `id_stat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_stat` varchar(255) NOT NULL,
  `timestamp_stat` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `stat_match_id` int(10) unsigned NOT NULL,
  `stat_player_id` int(10) unsigned NOT NULL,
  `stat_referee_id` int(10) unsigned DEFAULT NULL,
  `stat_team_id` int(10) unsigned NOT NULL,
  `stat_details` text DEFAULT NULL,
  PRIMARY KEY (`id_stat`),
  KEY `stats_match_id` (`stat_match_id`),
  KEY `stats_player_id` (`stat_player_id`),
  KEY `stats_team_id` (`stat_team_id`),
  KEY `stats_referee_id` (`stat_referee_id`),
  CONSTRAINT `stats_match_id` FOREIGN KEY (`stat_match_id`) REFERENCES `matches` (`id_match`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `stats_player_id` FOREIGN KEY (`stat_player_id`) REFERENCES `players` (`id_player`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `stats_referee_id` FOREIGN KEY (`stat_referee_id`) REFERENCES `referees` (`id_referee`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `stats_team_id` FOREIGN KEY (`stat_team_id`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id_team` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_team` varchar(255) NOT NULL,
  `coach_team` varchar(255) DEFAULT NULL,
  `wins_team` int(10) unsigned DEFAULT 0,
  `draws_team` int(10) unsigned DEFAULT 0,
  `losses_team` int(10) unsigned DEFAULT 0,
  `goals_for_team` int(10) unsigned DEFAULT 0,
  `goals_against_team` int(10) unsigned DEFAULT 0,
  `points_team` int(10) unsigned DEFAULT (`wins_team` * 3 + `draws_team`),
  `description_teams` text DEFAULT NULL,
  `icon_team` text DEFAULT NULL,
  PRIMARY KEY (`id_team`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_user` varchar(255) NOT NULL,
  `last_names_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `role_user` smallint(5) unsigned NOT NULL DEFAULT 0,
  `managed_team_id_user` int(10) unsigned DEFAULT NULL,
  `referee_id_user` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  KEY `managed_team_id_user_fk_users` (`managed_team_id_user`),
  KEY `referee_id_user_fk_users` (`referee_id_user`),
  CONSTRAINT `managed_team_id_user_fk_users` FOREIGN KEY (`managed_team_id_user`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `referee_id_user_fk_users` FOREIGN KEY (`referee_id_user`) REFERENCES `referees` (`id_referee`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-10  1:39:13
