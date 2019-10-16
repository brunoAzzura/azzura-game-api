-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: azzura
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A251E27F6BF` (`question_id`),
  CONSTRAINT `FK_DADD4A251E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` VALUES (1,1,'oui',0),(2,1,'non',1),(4,2,'3',0),(5,2,'4',1),(6,2,'5',0),(7,3,'ouiii',1),(8,3,'non',0),(9,4,'oui',1),(10,4,'non',0),(20,1,'new question dood',0),(21,1,'new question dood',1),(22,1,'new question dood',0),(23,1,'new question dood',0);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avatar`
--

LOCK TABLES `avatar` WRITE;
/*!40000 ALTER TABLE `avatar` DISABLE KEYS */;
INSERT INTO `avatar` VALUES (1,'img/avatar/avatar_1547224178632119.png','lit'),(2,'img/avatar/avatar_1547224195793131.png','baignoire'),(3,'img/avatar/avatar_1547547873625642.png','bac'),(4,'img/avatar/avatar_1547547884409638.png','four'),(5,'img/avatar/avatar_1547547891510957.png','ordi');
/*!40000 ALTER TABLE `avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_type`
--

DROP TABLE IF EXISTS `game_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_type`
--

LOCK TABLES `game_type` WRITE;
/*!40000 ALTER TABLE `game_type` DISABLE KEYS */;
INSERT INTO `game_type` VALUES (1,'quizz'),(2,'memory'),(3,'puzzle');
/*!40000 ALTER TABLE `game_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `good_to_know`
--

DROP TABLE IF EXISTS `good_to_know`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `good_to_know` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_90FA5B5B59027487` (`theme_id`),
  CONSTRAINT `FK_90FA5B5B59027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `good_to_know`
--

LOCK TABLES `good_to_know` WRITE;
/*!40000 ALTER TABLE `good_to_know` DISABLE KEYS */;
INSERT INTO `good_to_know` VALUES (1,1,'img','img/goodtoknow/goodtoknow_1547456399727803.png','qsdqsd'),(2,2,'img','img/goodtoknow/goodtoknow_1547456407595206.png','dqsdqsd'),(3,3,'img','img/goodtoknow/goodtoknow_1547456417608747.jpeg','azeaze'),(4,4,'img','img/goodtoknow/goodtoknow_1547462240282815.png','azeaze'),(5,5,'img','img/goodtoknow/goodtoknow_1547462306896212.png','qsdqsdqsd'),(6,6,'img','img/goodtoknow/goodtoknow_1547462320319277.png','qsdqsdqd'),(7,7,'img','img/goodtoknow/goodtoknow_1547631313428478.png','azezae');
/*!40000 ALTER TABLE `good_to_know` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memory_card`
--

DROP TABLE IF EXISTS `memory_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memory_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B927F3DD59027487` (`theme_id`),
  CONSTRAINT `FK_B927F3DD59027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memory_card`
--

LOCK TABLES `memory_card` WRITE;
/*!40000 ALTER TABLE `memory_card` DISABLE KEYS */;
INSERT INTO `memory_card` VALUES (1,3,'evier','img/memorycard/memorycard_1547223755479857.png'),(2,3,'lampe','img/memorycard/memorycard_1547223762449401.png'),(3,3,'machine','img/memorycard/memorycard_1547223769086249.png'),(4,3,'ordi','img/memorycard/memorycard_1547223776266481.png'),(5,3,'papier','img/memorycard/memorycard_1547223783301702.png'),(6,3,'prise','img/memorycard/memorycard_1547223790304175.png'),(7,3,'reveille','img/memorycard/memorycard_1547223797987279.png'),(8,3,'toilette','img/memorycard/memorycard_1547223805525655.png');
/*!40000 ALTER TABLE `memory_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190111154524'),('20190213083926');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puzzle_game`
--

DROP TABLE IF EXISTS `puzzle_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puzzle_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_limit` smallint(6) NOT NULL,
  `nb_cases` smallint(6) NOT NULL,
  `image_puzzle_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puzzle_game`
--

LOCK TABLES `puzzle_game` WRITE;
/*!40000 ALTER TABLE `puzzle_game` DISABLE KEYS */;
INSERT INTO `puzzle_game` VALUES (1,240,3,''),(2,240,3,''),(3,240,3,''),(4,120,3,''),(5,240,3,''),(6,240,3,''),(7,240,3,''),(8,240,3,''),(9,240,3,''),(10,240,3,''),(11,240,3,''),(12,240,3,''),(13,240,3,''),(14,240,3,''),(15,240,3,''),(16,240,3,''),(17,240,3,''),(18,240,3,''),(19,240,3,'');
/*!40000 ALTER TABLE `puzzle_game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puzzle_piece`
--

DROP TABLE IF EXISTS `puzzle_piece`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puzzle_piece` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puzzle_game_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_order` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75F6759A6635A1F3` (`puzzle_game_id`),
  CONSTRAINT `FK_75F6759A6635A1F3` FOREIGN KEY (`puzzle_game_id`) REFERENCES `puzzle_game` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puzzle_piece`
--

LOCK TABLES `puzzle_piece` WRITE;
/*!40000 ALTER TABLE `puzzle_piece` DISABLE KEYS */;
INSERT INTO `puzzle_piece` VALUES (1,4,'img/puzzle/puzzle_1547223872075200.png',1),(2,4,'img/puzzle/puzzle_1547223877040248.png',2),(3,4,'img/puzzle/puzzle_1547223882522028.png',3),(4,4,'img/puzzle/puzzle_1547223887035063.png',6),(5,4,'img/puzzle/puzzle_1547223894483475.png',5),(6,4,'img/puzzle/puzzle_1547223898797576.png',4),(7,4,'img/puzzle/puzzle_1547223902854726.png',7),(8,4,'img/puzzle/puzzle_1547223907112967.png',8),(9,4,'img/puzzle/puzzle_1547223911560669.png',9);
/*!40000 ALTER TABLE `puzzle_piece` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) DEFAULT NULL,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E59027487` (`theme_id`),
  CONSTRAINT `FK_B6F7494E59027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,1,'new wording2','',NULL),(2,2,'Combien de différences ?','','img/question/question_1547223678239511.png'),(3,5,'la reponse est ouiii','',NULL),(4,6,'la reponse est oui','',NULL);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `world_id` int(11) DEFAULT NULL,
  `theme_draw_id` int(11) DEFAULT NULL,
  `game_type_id` int(11) DEFAULT NULL,
  `puzzle_game_id` int(11) DEFAULT NULL,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ranking` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9775E70836A6C49B` (`theme_draw_id`),
  UNIQUE KEY `UNIQ_9775E7086635A1F3` (`puzzle_game_id`),
  KEY `IDX_9775E7088925311C` (`world_id`),
  KEY `IDX_9775E708508EF3BC` (`game_type_id`),
  CONSTRAINT `FK_9775E70836A6C49B` FOREIGN KEY (`theme_draw_id`) REFERENCES `theme_draw` (`id`),
  CONSTRAINT `FK_9775E708508EF3BC` FOREIGN KEY (`game_type_id`) REFERENCES `game_type` (`id`),
  CONSTRAINT `FK_9775E7086635A1F3` FOREIGN KEY (`puzzle_game_id`) REFERENCES `puzzle_game` (`id`),
  CONSTRAINT `FK_9775E7088925311C` FOREIGN KEY (`world_id`) REFERENCES `world` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` VALUES (1,1,1,1,1,'frigot','azeaze',9),(2,1,2,1,2,'chaudière','azeaze',9),(3,1,3,2,3,'robinet','azeaze',9),(4,1,4,3,4,'machine à laver','qsdqsd',9),(5,1,5,1,5,'micro onde','azeaze',9),(6,1,6,1,6,'four','azeaze',9),(7,2,7,1,7,'television','qsdsqd',9);
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_draw`
--

DROP TABLE IF EXISTS `theme_draw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_draw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_x` smallint(6) NOT NULL,
  `position_y` smallint(6) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_success_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_error_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_question_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_question_success_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_question_error_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_draw`
--

LOCK TABLES `theme_draw` WRITE;
/*!40000 ALTER TABLE `theme_draw` DISABLE KEYS */;
INSERT INTO `theme_draw` VALUES (1,80,51,'img/theme/theme_1547455538434020.png','img/theme/theme_1547223296141065_happy.gif','img/theme/theme_1547223302164755_sad.gif','','','',20),(2,14,9,'img/theme/theme_1547223616702674.png','img/theme/theme_1547223621312683_happy.gif','img/theme/theme_1547223626532116_sad.gif','','','',19),(3,12,53,'img/theme/theme_1547223716551523.png','img/theme/theme_1547223720973279_happy.gif','img/theme/theme_1547223725279272_sad.gif','','','',14),(4,61,66,'img/theme/theme_1547223838809504.png','img/theme/theme_1547223843194225_happy.gif','img/theme/theme_1547223847073351_sad.gif','','','',23),(5,23,53,'img/theme/theme_1547223959921119.png','img/theme/theme_1547223964451684_happy.gif','img/theme/theme_1547223968535026_sad.gif','','','',21),(6,39,55,'img/theme/theme_1547224025324576.png','img/theme/theme_1547224030932594_happy.gif','img/theme/theme_1547224035922053_sad.gif','','','',25),(7,0,0,'','','','','','',20);
/*!40000 ALTER TABLE `theme_draw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `credit` smallint(6) NOT NULL,
  `ranking` smallint(6) NOT NULL,
  `image_profil_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'bruno','bruno','bruno','$2y$13$IfShikA4DSnm80SgqgJNjOF9HTVUBJ.HdVDHJp2BPt3mTOg3c3D46','123','ROLE_ADMIN',0,1,'dfgdgfd'),(2,'paul','paul','paul','$2y$13$IfShikA4DSnm80SgqgJNjOF9HTVUBJ.HdVDHJp2BPt3mTOg3c3D46','222','ROLE_USER',0,0,'qsdqs');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_avatar`
--

DROP TABLE IF EXISTS `user_avatar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73256912A76ED395` (`user_id`),
  KEY `IDX_7325691286383B10` (`avatar_id`),
  CONSTRAINT `FK_7325691286383B10` FOREIGN KEY (`avatar_id`) REFERENCES `avatar` (`id`),
  CONSTRAINT `FK_73256912A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_avatar`
--

LOCK TABLES `user_avatar` WRITE;
/*!40000 ALTER TABLE `user_avatar` DISABLE KEYS */;
INSERT INTO `user_avatar` VALUES (10,1,2,1),(11,2,1,1);
/*!40000 ALTER TABLE `user_avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_good_to_know`
--

DROP TABLE IF EXISTS `user_good_to_know`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_good_to_know` (
  `user_id` int(11) NOT NULL,
  `good_to_know_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`good_to_know_id`),
  KEY `IDX_10362759A76ED395` (`user_id`),
  KEY `IDX_1036275928F9B6C` (`good_to_know_id`),
  CONSTRAINT `FK_1036275928F9B6C` FOREIGN KEY (`good_to_know_id`) REFERENCES `good_to_know` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_10362759A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_good_to_know`
--

LOCK TABLES `user_good_to_know` WRITE;
/*!40000 ALTER TABLE `user_good_to_know` DISABLE KEYS */;
INSERT INTO `user_good_to_know` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(2,2),(2,5);
/*!40000 ALTER TABLE `user_good_to_know` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world`
--

DROP TABLE IF EXISTS `world`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `world` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ranking` smallint(6) NOT NULL,
  `world_draw_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3A7711438080EFEF` (`world_draw_id`),
  CONSTRAINT `FK_3A7711438080EFEF` FOREIGN KEY (`world_draw_id`) REFERENCES `world_draw` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world`
--

LOCK TABLES `world` WRITE;
/*!40000 ALTER TABLE `world` DISABLE KEYS */;
INSERT INTO `world` VALUES (1,'La cuisine','/img/fa0afe878d957108b50c951791a389fa.png',0,1),(2,'le salon','ddqsdqsd',1,2),(3,'chambre','qsdqsd',2,3),(4,'salle de bain','azezae',3,4),(5,'transports','aazeazeaze',4,5);
/*!40000 ALTER TABLE `world` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_draw`
--

DROP TABLE IF EXISTS `world_draw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `world_draw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_x` smallint(6) NOT NULL,
  `position_y` smallint(6) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_draw`
--

LOCK TABLES `world_draw` WRITE;
/*!40000 ALTER TABLE `world_draw` DISABLE KEYS */;
INSERT INTO `world_draw` VALUES (1,24,-1,'img/world/world_1547455827501121.png','','img/world/world_background_1547454272195809_happy.png'),(2,23,27,'img/world/world_1547462484517879.png','',''),(3,42,55,'img/world/world_1547462506446024.png','',''),(4,62,32,'img/world/world_1547462540776002.png','',''),(5,62,0,'img/world/world_1547462566925800.png','','');
/*!40000 ALTER TABLE `world_draw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world_score`
--

DROP TABLE IF EXISTS `world_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `world_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `world_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `score` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3F9E55E8925311C` (`world_id`),
  KEY `IDX_B3F9E55EA76ED395` (`user_id`),
  CONSTRAINT `FK_B3F9E55E8925311C` FOREIGN KEY (`world_id`) REFERENCES `world` (`id`),
  CONSTRAINT `FK_B3F9E55EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_score`
--

LOCK TABLES `world_score` WRITE;
/*!40000 ALTER TABLE `world_score` DISABLE KEYS */;
INSERT INTO `world_score` VALUES (1,1,1,6);
/*!40000 ALTER TABLE `world_score` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-27 13:39:59
