-- MariaDB dump 10.18  Distrib 10.5.8-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: chatter
-- ------------------------------------------------------
-- Server version	10.5.8-MariaDB

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
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `message_id` int(255) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment`
--

LOCK TABLES `attachment` WRITE;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_room`
--

DROP TABLE IF EXISTS `chat_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_room` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salt` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_room`
--

LOCK TABLES `chat_room` WRITE;
/*!40000 ALTER TABLE `chat_room` DISABLE KEYS */;
INSERT INTO `chat_room` VALUES (27,'test_1','1234',NULL),(29,'test2','1234',NULL),(30,'Test','',NULL),(31,'Family group','',NULL),(33,'Friends','hello',NULL),(34,'beta','1234',NULL),(35,'development','1234',NULL);
/*!40000 ALTER TABLE `chat_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_user`
--

DROP TABLE IF EXISTS `chat_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_user` (
  `user_id` int(255) NOT NULL,
  `chat_room_id` int(255) NOT NULL,
  `privileges` tinyint(1) NOT NULL DEFAULT 0,
  KEY `user_id` (`user_id`),
  KEY `chat_room_id` (`chat_room_id`),
  CONSTRAINT `chat_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chat_user_ibfk_2` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_user`
--

LOCK TABLES `chat_user` WRITE;
/*!40000 ALTER TABLE `chat_user` DISABLE KEYS */;
INSERT INTO `chat_user` VALUES (12,27,3),(12,29,3),(12,30,3),(12,31,3),(12,33,3),(13,31,0),(13,30,0),(13,29,0),(13,34,3),(14,34,0),(12,34,0),(12,35,3),(15,35,0),(16,27,0),(17,29,0),(17,30,0);
/*!40000 ALTER TABLE `chat_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `owner_id` int(255) NOT NULL,
  `chat_room_id` int(255) NOT NULL,
  `message_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `chat_room_id` (`chat_room_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=541 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (517,12,27,'Hello, this is the first message in Test_1','2021-02-01 13:39:08'),(518,12,27,'Second message ...','2021-02-01 13:39:16'),(519,12,27,'There are three messages In test_1','2021-02-01 13:39:32'),(520,12,33,'This is a chat room with friends.','2021-02-01 13:42:27'),(521,12,33,'Unfortunately I have no Friends. :(','2021-02-01 13:42:42'),(522,12,31,'Hello, this is my family group.','2021-02-01 13:42:59'),(523,13,31,'I am in the Family','2021-02-01 13:43:47'),(524,13,30,'I did not create this chat, but i posted on it : )','2021-02-01 13:44:29'),(525,13,30,'Here is another message','2021-02-01 13:44:41'),(526,13,29,'I joined this group with a code and a pin','2021-02-01 13:45:27'),(527,13,29,'The owner has not sent any messages yet...','2021-02-01 13:45:40'),(528,13,34,'Press the hamburger to reveal join code and pin for the chat.','2021-02-01 13:46:36'),(529,14,34,'Okay, thanks','2021-02-01 13:51:15'),(530,14,34,'This is a very good platform.','2021-02-01 13:51:27'),(531,12,34,': )','2021-02-01 13:51:59'),(532,12,29,'I have now','2021-02-01 13:52:23'),(533,12,35,'this chat is for the developers','2021-02-01 13:53:28'),(534,15,35,'I am a developer.','2021-02-01 13:56:19'),(535,15,35,'We used the MVC model, although we did not use a framework.','2021-02-01 13:59:06'),(536,15,35,'There are some security vulnerabilities with the site','2021-02-01 13:59:30'),(537,16,27,'Now there are 4','2021-02-01 14:00:14'),(538,16,27,'5','2021-02-01 14:01:35'),(539,17,29,'I joined this group as well','2021-02-01 14:10:43'),(540,17,30,'This chat does not have a pin, that is allowed, but not reccomended','2021-02-01 14:11:13');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` int(255) NOT NULL,
  `last_online` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (12,'alex','36efb123f63dbb6b2330243ea8b2b233724f888ed32fefa8c8862e561cbad6fd',1934308771,'2021-02-01 13:38:16'),(13,'Benjy','c2cd3a059b16e830e2a328aff1054bc5fad9a653a5b8ea6773f70de39b1caee7',1130274538,'2021-02-01 13:43:32'),(14,'John','5ef61749f62eb8a25e2401fb24c9f153f4003fc46020fe50ee6cf2886efc11c3',717209162,'2021-02-01 13:51:01'),(15,'Varni','d8472ae69cb04f55dad24310d139c53de63e7c2a58b81c6b17515eadb383c73d',2111329668,'2021-02-01 13:56:01'),(16,'Smith','33121fc61d88745fc8cea4c52992edc2f62449ba97afd31e28bb46b80b1bc1ff',960073734,'2021-02-01 13:59:59'),(17,'francis','a049e293cc94f6e0ff4da4fc46100029bd643ddd896a4b4ba57a56b215548714',804062934,'2021-02-01 14:10:24');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-01 14:23:27
