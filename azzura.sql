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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` VALUES (22,33,'azeaze azezae azeazeaze',1),(23,33,'azeaz azeeaz azeaze',0),(24,27,'3 différences ',1),(25,27,'4 différences',0),(27,39,'zerezrezr',1),(28,39,'zerzerezrezrzerzer',0),(29,40,'Oui je crois',1),(36,42,'bleu',1),(37,42,'rouge',0),(38,43,'le ciel est bleu !',1),(39,43,'le ciel est noir !',0),(40,41,'Il y a 3 différences',0),(41,41,'Il y a 4 différences',0),(42,39,'azeazee',0);
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
INSERT INTO `avatar` VALUES (1,'img/avatar/avatar_1554382012427133.png','lit33'),(2,'img/avatar/avatar_1547224195793131.png','baignoire'),(3,'img/avatar/avatar_1554382908423462.png','bac'),(4,'img/avatar/avatar_1554382914103945.png','four'),(5,'img/avatar/avatar_1554382922337287.png','ordi');
/*!40000 ALTER TABLE `avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `challenge`
--

DROP TABLE IF EXISTS `challenge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction_text` longtext COLLATE utf8mb4_unicode_ci,
  `ending_text` longtext COLLATE utf8mb4_unicode_ci,
  `image_presentation_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenge`
--

LOCK TABLES `challenge` WRITE;
/*!40000 ALTER TABLE `challenge` DISABLE KEYS */;
INSERT INTO `challenge` VALUES (1,'RTE - quizz','RTE, le transporteur d’électricité en France','<b>RTE, le transporteur d’électricité en France</b><span style=\"font-weight: bolder;\">&nbsp;&nbsp;</span><div><img src=\"https://www.azzura-game-api.com/img/world/world_1551864261031249.png\">azeazeaz ezaz azeaze azeazeaze&nbsp;</div><div><hr id=\"null\"><hr id=\"null\"><font color=\"#5642f4\">Chez RTE</font>, le courant passe ! Il est&nbsp;le<b> seul acteur sur le marché de l\'énergie français</b>&nbsp;chargé du&nbsp;<b>transport de l\'électricité. </b>Cette entreprise intervient en second dans la chaîne de valeur de l\'énergie : entre la production et la distribution.&nbsp;<br><br><blockquote>Êtes-vous prêtes et prêts à découvrir le métier de RTE ?</blockquote><br></div><span style=\"font-weight: bolder; background-color: transparent; font-size: 1rem;\">C’est parti !</span><br>','<p _ngcontent-c6=\"\" style=\"margin-bottom: 1rem; color: rgb(12, 84, 96);\"><span _ngcontent-c6=\"\" style=\"\"><b>Bravo</b></span>, vous avez terminé le challenge !</p><p _ngcontent-c6=\"\" style=\"margin-bottom: 1rem; color: rgb(12, 84, 96);\">Vous êtes prêts à inventer le monde de l\'énergie de demain.</p>','img/challenge/effbc5675a7b30966e565755869dda8c.png'),(2,'Challenge quotidien','Challenge qui change toutes les semaines !',NULL,NULL,'img/challenge/c4921c9c07c1c8f7838b5b2441021eff.png');
/*!40000 ALTER TABLE `challenge` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `good_to_know`
--

LOCK TABLES `good_to_know` WRITE;
/*!40000 ALTER TABLE `good_to_know` DISABLE KEYS */;
INSERT INTO `good_to_know` VALUES (1,1,'img','img/goodtoknow/goodtoknow_1554105035556507.png','qsdqsd'),(2,2,'img','img/goodtoknow/goodtoknow_1547456407595206.png','dqsdqsd'),(3,3,'img','img/goodtoknow/goodtoknow_1547456417608747.jpeg','azeaze'),(4,4,'img','img/goodtoknow/goodtoknow_1547462240282815.png','azeaze'),(5,5,'img','img/goodtoknow/goodtoknow_1547462306896212.png','qsdqsdqsd'),(6,6,'img','img/goodtoknow/goodtoknow_1547462320319277.png','qsdqsdqd'),(7,7,'img','img/goodtoknow/goodtoknow_1547631313428478.png','azezae'),(8,7,'img','img/goodtoknow/goodtoknow_1553874846253271.png','azeaze');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memory_card`
--

LOCK TABLES `memory_card` WRITE;
/*!40000 ALTER TABLE `memory_card` DISABLE KEYS */;
INSERT INTO `memory_card` VALUES (1,3,'evier','img/memorycard/memorycard_1547223755479857.png'),(2,3,'lampe','img/memorycard/memorycard_1547223762449401.png'),(3,3,'machine','img/memorycard/memorycard_1547223769086249.png'),(4,3,'ordi','img/memorycard/memorycard_1547223776266481.png'),(5,3,'papier','img/memorycard/memorycard_1547223783301702.png'),(6,3,'prise','img/memorycard/memorycard_1547223790304175.png'),(7,3,'reveille','img/memorycard/memorycard_1547223797987279.png'),(9,3,'zerezr','img/memorycard/memorycard_1554106630339333.png');
/*!40000 ALTER TABLE `memory_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190111154524',NULL),('20190213083926',NULL),('20190312103347','2019-03-12 10:34:13'),('20190312152904','2019-03-12 15:29:09'),('20190315125853','2019-03-15 12:59:06'),('20190321124824','2019-03-21 12:48:32'),('20190322151728','2019-03-22 15:17:48'),('20190401153446','2019-04-01 15:34:57'),('20190401154240','2019-04-01 15:42:50'),('20190404131037','2019-04-04 13:10:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puzzle_piece`
--

LOCK TABLES `puzzle_piece` WRITE;
/*!40000 ALTER TABLE `puzzle_piece` DISABLE KEYS */;
INSERT INTO `puzzle_piece` VALUES (12,4,'img/puzzle/puzzle_1554117939946643.png',1),(13,4,'img/puzzle/puzzle_1554117945973288.png',2),(14,4,'img/puzzle/puzzle_1554117951807289.png',3),(15,4,'img/puzzle/puzzle_1554117955516613.png',6),(16,4,'img/puzzle/puzzle_1554117965908406.png',5),(17,4,'img/puzzle/puzzle_1554117990235696.png',4),(18,4,'img/puzzle/puzzle_1554118000078756.png',7),(19,4,'img/puzzle/puzzle_1554118005397825.png',8),(20,4,'img/puzzle/puzzle_1554118008578439.png',9);
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
  `challenge_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E59027487` (`theme_id`),
  KEY `IDX_B6F7494E98A21AC6` (`challenge_id`),
  CONSTRAINT `FK_B6F7494E59027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  CONSTRAINT `FK_B6F7494E98A21AC6` FOREIGN KEY (`challenge_id`) REFERENCES `challenge` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (27,NULL,'Combien de différences ?','azeaze<u>az</u><div><br></div><div>azea<b>zeazeazeaze</b></div><div>azeazeaze</div>','img/question/218f1b9a6209dbe507f2f326c78c28bc.png',1),(33,NULL,'zaeazeze ?','a<b>zea</b><i>zeazeaze</i><div><i><br></i></div><div><i>qsdsq&nbsp;</i></div>','img/question/0f71982009d7aa16db7f366928347571.png',1),(39,NULL,'sqazeazeaze ???','azeazeazeaze',NULL,1),(40,1,'La réponse est \"oui je croisss\"','Question très difficile ...',NULL,NULL),(41,2,'Combien y a t\'il de différences','Le soleil brûle en été','img/question/88ccc2a18dda2d1699ef1e5047c12fe6.png',NULL),(42,5,'quelle est la couleur du ciel','azeza zreezr',NULL,NULL),(43,6,'Le ciel est de quelle couleur ?','Le ciel est de quelle couleur',NULL,NULL),(44,1,'zaeazezae','azeazeaze',NULL,NULL);
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
  `width` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_draw`
--

LOCK TABLES `theme_draw` WRITE;
/*!40000 ALTER TABLE `theme_draw` DISABLE KEYS */;
INSERT INTO `theme_draw` VALUES (1,79,42,'img/theme/theme_1547455538434020.png','img/theme/theme_1547223296141065_happy.gif','img/theme/theme_1547223302164755_sad.gif',20),(2,14,9,'img/theme/theme_1547223616702674.png','img/theme/theme_1547223621312683_happy.gif','img/theme/theme_1547223626532116_sad.gif',19),(3,12,53,'img/theme/theme_1547223716551523.png','img/theme/theme_1547223720973279_happy.gif','img/theme/theme_1547223725279272_sad.gif',14),(4,59,57,'img/theme/theme_1547223838809504.png','img/theme/theme_1547223843194225_happy.gif','img/theme/theme_1547223847073351_sad.gif',23),(5,23,53,'img/theme/theme_1547223959921119.png','img/theme/theme_1547223964451684_happy.gif','img/theme/theme_1547223968535026_sad.gif',21),(6,39,49,'img/theme/theme_1547224025324576.png','img/theme/theme_1547224030932594_happy.gif','img/theme/theme_1547224035922053_sad.gif',25),(7,0,0,'','','',20);
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
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `ranking` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'bruno','bruno@gmail.com','bruno','$2y$13$FMvLXt7BHeLMr/A4T9sDGOj2tfe92FTIzcpvl0gxOfIkMfXP7su8K','ROLE_ADMIN',1),(4,'jessica','jessica@azzura.com','jessica','$2y$13$pQN3.rPVpSuaxJehnlKh6.U9su5TB0kKZmHm2wfsh2kvnh1fkJW4G','ROLE_ADMIN',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_avatar`
--

LOCK TABLES `user_avatar` WRITE;
/*!40000 ALTER TABLE `user_avatar` DISABLE KEYS */;
INSERT INTO `user_avatar` VALUES (10,1,2,1),(11,4,1,1);
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
INSERT INTO `user_good_to_know` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6);
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
INSERT INTO `world` VALUES (1,'La cuisines','qsdqsd',0,1),(2,'le salon','ddqsdqsd',1,2),(3,'chambre','qsdqsd',2,3),(4,'salle de bain','azezae',3,4),(5,'transports','aazeazeaze',4,5);
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
  `background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world_draw`
--

LOCK TABLES `world_draw` WRITE;
/*!40000 ALTER TABLE `world_draw` DISABLE KEYS */;
INSERT INTO `world_draw` VALUES (1,20,-1,'img/world/world_1553248917310281.png','img/world/world_background_1554389908672701.png','img/world/world_logo_1554385099419542.png'),(2,20,26,'img/world/world_1547462484517879.png','img/world/world_background_1553004403605104_happy.png',''),(3,40,52,'img/world/world_1547462506446024.png','',''),(4,60,32,'img/world/world_1547462540776002.png','',''),(5,58,2,'img/world/world_1547462566925800.png','','');
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

-- Dump completed on 2019-04-10 11:55:13
