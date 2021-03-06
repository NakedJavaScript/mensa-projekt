-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mensa
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.29-MariaDB

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
-- Table structure for table `speise`
--

DROP TABLE IF EXISTS `speise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `speise` (
  `speise_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `preis` double NOT NULL,
  `likes` int(11) DEFAULT '0',
  `allergene_inhaltsstoffe` varchar(255) DEFAULT NULL,
  `sonstiges` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`speise_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speise`
--

LOCK TABLES `speise` WRITE;
/*!40000 ALTER TABLE `speise` DISABLE KEYS */;
INSERT INTO `speise` VALUES (1,'Schweine Schnitzel',5.5,0,'GG, Ei, Nus, Ses','Pommes oder Brötchen'),(2,'Maultaschen in Bratensoße',3.5,0,'GG, Ei, Sel',''),(3,'Leberkäsbrötchen',2.2,0,'Sel, Sen','Ketchup oder Mayo'),(4,'Kleine Pommes',1.2,0,'- Keine Allergene -','Ketchup oder Mayo'),(5,'Große Pommes',1.8,0,'- Keine Allergene -','Ketchup oder Mayo'),(6,'Döner',4.5,0,'GG, Ei, Nus, Ses','Lamme oder Hühnerfleisch'),(8,'Käsespätzle',6,0,'GG, Ei','Gouda oder Mozzarella'),(9,'Hamburger',7.5,0,'GG, Ei, Nus, Ses','Mit Pommes'),(10,'Cheeseburger',8,0,'GG, Ei, Mil, Nus, Ses','Mit Pommes'),(11,'Pizza Salami',5,0,'GG, Ei, Nus, Wei',''),(12,'Pizza Schinken',5,0,'GG, Ei, Mil',''),(13,'Bratkartoffeln',3,0,'- Keine Allergene -','Ketchup oder Mayo');
/*!40000 ALTER TABLE `speise` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-09 23:19:39
