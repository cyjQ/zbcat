-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: zbcat
-- ------------------------------------------------------
-- Server version	5.5.47

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
-- Table structure for table `zb_user`
--

DROP TABLE IF EXISTS `zb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `pwd` char(32) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sex` int(1) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `IP` varchar(19) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zb_user`
--

LOCK TABLES `zb_user` WRITE;
/*!40000 ALTER TABLE `zb_user` DISABLE KEYS */;
INSERT INTO `zb_user` VALUES (1,'359889053@qq.com','e10adc3949ba59abbe56e057f20f883e','359889@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'cyj','e10adc3949ba59abbe56e057f20f883e','359889053@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'cyj','e10adc3949ba59abbe56e057f20f883e','359889053@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'cyj','e10adc3949ba59abbe56e057f20f883e','359889053@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'215@qq.com','e10adc3949ba59abbe56e057f20f883e','359889053@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'18349691750','e10adc3949ba59abbe56e057f20f883e','12345@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'13540780420','e10adc3949ba59abbe56e057f20f883e','359889@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'359889053@qq.com','e10adc3949ba59abbe56e057f20f883e','359889@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'123','e10adc3949ba59abbe56e057f20f883e','359889@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'359889053@qq.com','e10adc3949ba59abbe56e057f20f883e','cyj62@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'12345612`','16951e123f444e8ce22b12a420a41e1e','we@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'13540780420','e10adc3949ba59abbe56e057f20f883e','359889@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'13540780420','e10adc3949ba59abbe56e057f20f883e','359889@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'qq','9c52aab8b521f7c82e511dedab5ff5e3','35@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'ip','9c52aab8b521f7c82e511dedab5ff5e3','21@qq.com',NULL,NULL,NULL,NULL,1477559498,'127.0.0.1',NULL);
/*!40000 ALTER TABLE `zb_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-27 17:30:38
