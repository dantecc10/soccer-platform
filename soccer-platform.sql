/*
 Navicat Premium Data Transfer

 Source Server         : Servidor
 Source Server Type    : MySQL
 Source Server Version : 100616 (10.6.16-MariaDB-0ubuntu0.22.04.1)
 Source Host           : 74.208.62.188:3306
 Source Schema         : soccer-platform

 Target Server Type    : MySQL
 Target Server Version : 100616 (10.6.16-MariaDB-0ubuntu0.22.04.1)
 File Encoding         : 65001

 Date: 30/01/2024 01:35:56
*/

CREATE DATABASE `soccer-platform`;
USE `soccer-platform`;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for matches
-- ----------------------------
DROP TABLE IF EXISTS `matches`;
CREATE TABLE `matches`  (
  `id_match` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `local_team_id` int(255) UNSIGNED ZEROFILL NOT NULL,
  `visitor_team_id` int(255) UNSIGNED ZEROFILL NOT NULL,
  `match_referee_id` int(255) UNSIGNED ZEROFILL NOT NULL,
  `start_schedule_match` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `finish_schedule_match` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `local_goals_match` int NULL DEFAULT NULL,
  `visitor_goals_match` int NULL DEFAULT NULL,
  `local_shots_match` int NULL DEFAULT NULL,
  `visitor_shots_match` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_match`) USING BTREE,
  INDEX `matches_local_team_id`(`local_team_id` ASC) USING BTREE,
  INDEX `matches_visitor_team_id`(`visitor_team_id` ASC) USING BTREE,
  INDEX `matches_referee_id`(`match_referee_id` ASC) USING BTREE,
  CONSTRAINT `matches_local_team_id` FOREIGN KEY (`local_team_id`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `matches_visitor_team_id` FOREIGN KEY (`visitor_team_id`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `matches_referee_id` FOREIGN KEY (`match_referee_id`) REFERENCES `referees` (`id_referee`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for players
-- ----------------------------
DROP TABLE IF EXISTS `players`;
CREATE TABLE `players`  (
  `id_player` int(255) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `name_player` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `last_names_player` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `nickname_player` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `dorsal_player` int NULL DEFAULT NULL,
  `player_team_id` int(255) UNSIGNED ZEROFILL NOT NULL,
  `goals_player` int NULL DEFAULT NULL,
  `assists_player` int NULL DEFAULT NULL,
  `fouls_player` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_player`) USING BTREE,
  INDEX `players_player_team_id`(`player_team_id` ASC) USING BTREE,
  CONSTRAINT `players_player_team_id` FOREIGN KEY (`player_team_id`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for referees
-- ----------------------------
DROP TABLE IF EXISTS `referees`;
CREATE TABLE `referees`  (
  `id_referee` int(255) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `name_referee` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `last_names_referee` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `matches_referee` int NULL DEFAULT 0,
  PRIMARY KEY (`id_referee`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for stats
-- ----------------------------
DROP TABLE IF EXISTS `stats`;
CREATE TABLE `stats`  (
  `id_stat` int(255) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `type_stat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `timestamp_stat` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `stat_match_id` int(255) UNSIGNED ZEROFILL NOT NULL,
  `stat_player_id` int(255) UNSIGNED ZEROFILL NOT NULL,
  `stat_referee_id` int(255) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `stat_team_id` int(255) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`id_stat`) USING BTREE,
  INDEX `stats_match_id`(`stat_match_id` ASC) USING BTREE,
  INDEX `stats_player_id`(`stat_player_id` ASC) USING BTREE,
  INDEX `stats_team_id`(`stat_team_id` ASC) USING BTREE,
  INDEX `stats_referee_id`(`stat_referee_id` ASC) USING BTREE,
  CONSTRAINT `stats_match_id` FOREIGN KEY (`stat_match_id`) REFERENCES `matches` (`id_match`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `stats_player_id` FOREIGN KEY (`stat_player_id`) REFERENCES `players` (`id_player`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `stats_referee_id` FOREIGN KEY (`stat_referee_id`) REFERENCES `referees` (`id_referee`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `stats_team_id` FOREIGN KEY (`stat_team_id`) REFERENCES `teams` (`id_team`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams`  (
  `id_team` int(255) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `name_team` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `wins_team` int NULL DEFAULT NULL,
  `defeats_team` int NULL DEFAULT NULL,
  `draws_team` int NULL DEFAULT NULL,
  `icon_team` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  PRIMARY KEY (`id_team`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
