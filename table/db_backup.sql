-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

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
-- Table structure for table `Audit`
--

DROP TABLE IF EXISTS `Audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ts` datetime NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `table_id` int(11) NOT NULL,
  `field` varchar(64) NOT NULL,
  `old_value` blob,
  `new_value` blob,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `table_name` (`table_name`,`table_id`,`field`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Audit`
--

LOCK TABLES `Audit` WRITE;
/*!40000 ALTER TABLE `Audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `Audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customer`
--

DROP TABLE IF EXISTS `Customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customer` (
  `customer_id` int(5) NOT NULL AUTO_INCREMENT,
  `customer_name` text CHARACTER SET utf8,
  `customer_logo` text,
  `default_image` text,
  `small_logo` text,
  `manifest_path` varchar(255) NOT NULL,
  `h_bar` varchar(255) NOT NULL,
  `v_bar` varchar(255) NOT NULL,
  `bus_feed_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL DEFAULT '1',
  `screen_schedule` text,
  `idle` varchar(255) NOT NULL,
  `text_colors` varchar(255) NOT NULL,
  `max_expiry` datetime NOT NULL DEFAULT '9999-12-31 00:00:00',
  `coop_cust` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customer`
--

LOCK TABLES `Customer` WRITE;
/*!40000 ALTER TABLE `Customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `Customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CustomerUser`
--

DROP TABLE IF EXISTS `CustomerUser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CustomerUser` (
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CustomerUser`
--

LOCK TABLES `CustomerUser` WRITE;
/*!40000 ALTER TABLE `CustomerUser` DISABLE KEYS */;
/*!40000 ALTER TABLE `CustomerUser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Grp`
--

DROP TABLE IF EXISTS `Grp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Grp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `perms` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grp`
--

LOCK TABLES `Grp` WRITE;
/*!40000 ALTER TABLE `Grp` DISABLE KEYS */;
/*!40000 ALTER TABLE `Grp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Label`
--

DROP TABLE IF EXISTS `Label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Label` (
  `label_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(2) NOT NULL DEFAULT '',
  `label_text` text NOT NULL,
  PRIMARY KEY (`label_id`,`lang_code`)
) ENGINE=MyISAM AUTO_INCREMENT=7761 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Label`
--

LOCK TABLES `Label` WRITE;
/*!40000 ALTER TABLE `Label` DISABLE KEYS */;
INSERT INTO `Label` VALUES (2,'en','Options'),(1,'en','Users'),(3,'en','Post');
/*!40000 ALTER TABLE `Label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Language`
--

DROP TABLE IF EXISTS `Language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Language` (
  `lang_code` char(2) NOT NULL DEFAULT '',
  `lang_longname` varchar(255) NOT NULL DEFAULT '',
  `lang_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lang_date_format` varchar(255) NOT NULL,
  `lang_time_format` varchar(255) NOT NULL,
  `lang_tvt_text` varchar(255) NOT NULL,
  `lang_city_first` tinyint(4) NOT NULL,
  PRIMARY KEY (`lang_code`),
  UNIQUE KEY `lang_longname` (`lang_longname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Language`
--

LOCK TABLES `Language` WRITE;
/*!40000 ALTER TABLE `Language` DISABLE KEYS */;
INSERT INTO `Language` VALUES ('en','English',1,'%a, %M %D','%l:%i %p','<p>Live<br />TV</p>',1);
/*!40000 ALTER TABLE `Language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Module`
--

DROP TABLE IF EXISTS `Module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Module` (
  `module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `module_name_id` int(10) unsigned NOT NULL DEFAULT '0',
  `module_parent_id` int(10) unsigned DEFAULT NULL,
  `module_link` varchar(255) NOT NULL DEFAULT '',
  `module_page` varchar(255) NOT NULL DEFAULT '',
  `item_order` int(11) NOT NULL DEFAULT '0',
  `module_link_target` varchar(255) NOT NULL DEFAULT '',
  `module_max_user_level` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Module`
--

LOCK TABLES `Module` WRITE;
/*!40000 ALTER TABLE `Module` DISABLE KEYS */;
INSERT INTO `Module` VALUES (1,1,3,'user.php','',10,'',1),(2,2,3,'options.php','',5,'',1),(21,21,3,'systemmessage.php','',100,'',1),(3,3,NULL,'','',10,'',1),(4,4,3,'post.php','',95,'',1);
/*!40000 ALTER TABLE `Module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PerPage`
--

DROP TABLE IF EXISTS `PerPage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PerPage` (
  `perpage` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PerPage`
--

LOCK TABLES `PerPage` WRITE;
/*!40000 ALTER TABLE `PerPage` DISABLE KEYS */;
/*!40000 ALTER TABLE `PerPage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SystemMessage`
--

DROP TABLE IF EXISTS `SystemMessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SystemMessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `message` int(11) NOT NULL,
  `show_link` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SystemMessage`
--

LOCK TABLES `SystemMessage` WRITE;
/*!40000 ALTER TABLE `SystemMessage` DISABLE KEYS */;
/*!40000 ALTER TABLE `SystemMessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SystemMessageDismissed`
--

DROP TABLE IF EXISTS `SystemMessageDismissed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SystemMessageDismissed` (
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SystemMessageDismissed`
--

LOCK TABLES `SystemMessageDismissed` WRITE;
/*!40000 ALTER TABLE `SystemMessageDismissed` DISABLE KEYS */;
/*!40000 ALTER TABLE `SystemMessageDismissed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(50) NOT NULL DEFAULT '',
  `user_lastname` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(100) DEFAULT NULL,
  `user_privs` varchar(255) NOT NULL DEFAULT '',
  `user_langprivs` set('en','fr') NOT NULL DEFAULT 'en',
  `user_last_ip` int(10) unsigned DEFAULT NULL,
  `user_session_id` varchar(32) DEFAULT NULL,
  `user_picture_id` int(10) unsigned DEFAULT NULL,
  `user_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_lang` char(2) NOT NULL DEFAULT 'en',
  `user_perpage` int(11) NOT NULL DEFAULT '25',
  `user_type` int(11) NOT NULL DEFAULT '3',
  `user_username` varchar(60) DEFAULT NULL,
  `user_reset_token` varchar(255) NOT NULL DEFAULT '',
  `user_reset_ts` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_reseller_id` int(11) NOT NULL DEFAULT '1',
  `description` varchar(500) DEFAULT NULL,
  `firsttime` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserCookie`
--

DROP TABLE IF EXISTS `UserCookie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserCookie` (
  `cookie_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cookie_token` varchar(32) NOT NULL DEFAULT '',
  `cookie_birth` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cookie_id`,`cookie_token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserCookie`
--

LOCK TABLES `UserCookie` WRITE;
/*!40000 ALTER TABLE `UserCookie` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserCookie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserGrp`
--

DROP TABLE IF EXISTS `UserGrp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserGrp` (
  `user_id` int(11) NOT NULL,
  `grp_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`grp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserGrp`
--

LOCK TABLES `UserGrp` WRITE;
/*!40000 ALTER TABLE `UserGrp` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserGrp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_version`
--

DROP TABLE IF EXISTS `db_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_version` (
  `db_version` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_version`
--

LOCK TABLES `db_version` WRITE;
/*!40000 ALTER TABLE `db_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `text` varchar(10000) DEFAULT NULL,
  `groupID` int(11) DEFAULT NULL,
  `deep` int(11) DEFAULT NULL,
  `sibilingRank` int(11) DEFAULT NULL,
  `postTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,'yong','test test test',1,1,1,'2016-12-02 00:49:08'),(2,2,'yong1','test test test',1,2,1,'2016-12-02 00:49:08'),(3,2,'yong2','test test test2',1,2,2,'2016-12-02 00:50:29'),(4,NULL,'anonymous','asdfa',4,1,1,'2016-12-03 13:28:05'),(5,NULL,'anonymous','asdasdf asasdadf',5,1,1,'2016-12-03 13:32:27'),(6,NULL,'anonymous','asdadf',6,1,1,'2016-12-03 13:32:45'),(7,NULL,'anonymous','asd a zzzz',7,1,1,'2016-12-03 13:33:04'),(8,NULL,'anonymous','',8,1,1,'2016-12-03 13:43:26'),(9,NULL,'anonymous','asdfasdf\nasdfasdf',9,1,1,'2016-12-03 14:26:10'),(10,NULL,'anonymous','asfaf',10,1,1,'2016-12-03 23:40:25'),(11,NULL,'anonymous','asdfas',11,1,1,'2016-12-03 23:48:41'),(12,NULL,'anonymous','asdasdf',12,1,1,'2016-12-03 23:50:18'),(13,NULL,'anonymous','asdasdf',13,1,1,'2016-12-04 00:08:40'),(14,NULL,'anonymous','asdfasdfas post',NULL,2,2,'2016-12-04 00:16:42'),(15,NULL,'anonymous','post 23 qe',NULL,2,2,'2016-12-04 00:19:48'),(16,NULL,'anonymous','pastt 11233',1,2,2,'2016-12-04 00:29:14'),(17,NULL,'anonymous','asdasdfa post  ',1,2,3,'2016-12-04 00:53:11'),(18,NULL,'anonymous','post 4444 ',1,2,4,'2016-12-04 00:53:41'),(19,NULL,'anonymous','asdfas new post',19,1,1,'2016-12-04 01:14:16'),(20,NULL,'anonymous','post new',7,2,2,'2016-12-04 01:15:02'),(21,NULL,'anonymous','12345',19,2,2,'2016-12-04 01:15:15'),(22,NULL,'anonymous','asdfa 123',12,2,2,'2016-12-04 01:20:59'),(23,NULL,'anonymous','asd 1134 after',12,2,3,'2016-12-04 01:21:23'),(24,NULL,'anonymous','1\n2\n3\n4',19,2,3,'2016-12-04 01:29:51'),(25,NULL,'anonymous','new post',25,1,1,'2016-12-04 05:01:44'),(26,NULL,'anonymous','reply post',25,2,2,'2016-12-04 05:02:13'),(27,NULL,'anonymous','re reply post',25,2,3,'2016-12-04 05:02:25'),(28,NULL,'anonymous','I miss u',28,1,1,'2016-12-04 16:31:21'),(29,NULL,'anonymous','idc\n',28,2,2,'2016-12-04 16:31:32'),(30,NULL,'anonymous','asdfasf',30,1,1,'2016-12-04 21:45:21');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-04 22:18:15
