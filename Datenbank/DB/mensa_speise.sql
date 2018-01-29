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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speise`
--

LOCK TABLES `speise` WRITE;
/*!40000 ALTER TABLE `speise` DISABLE KEYS */;
INSERT INTO `speise` VALUES (1,'SCHWEINEHALS SCHNITZEL',5.5,0,'GG, Ei, Nus, Ses','POMMES ODER BRöTCHEN'),(2,'MAULTASCHEN IN BRATENSOßE',3.5,0,'GG, Ei, Sel',''),(3,'LEBERKäSBRöTCHEN',2.2,0,'Sel, Sen','KETCHUP ODER MAYO ODER SENF'),(4,'KLEINE POMMES',1.2,0,'- Keine Allergene -','KETCHUP ODER MAYO ODER SENF'),(5,'GROßE POMMES',1.8,0,'- Keine Allergene -','KETCHUP ODER MAYO ODER SENF'),(6,'DöNER',4.5,0,'GG, Ei, Nus, Ses','LAMM ODER HAMMELFLEISCH'),(7,'SPäTZLE UND SOß',6,0,'GG, Ei','DUNKLE ODER HELLE SAUCE'),(8,'KäSESPäTZLE',6,0,'GG, Ei','GOUDA UND MOZZARELLA'),(9,'HAMBURGER',7.5,0,'GG, Ei, Nus, Ses','DAZU POMMES'),(10,'CHEESEBURGER',8,0,'GG, Ei, Mil, Nus, Ses','DAZU KLEINE POMMES'),(11,'PIZZA SALAMI',5,0,'GG, Ei, Nus, Wei','ALS VIERECK ODER KLASSISCHEN KREIS'),(12,'PIZZA MAGHERITA',5,0,'GG, Ei, Mil','MOZZARELLA/EMMENTALER MIX'),(13,'BRATKARTOFFEL',3,0,'- Keine Allergene -','MIT KETCHUP, MAYO ODER SENF'),(14,'YOLONESSE',1999,0,'- Keine Allergene -','ARSCHRITZE DAZU');

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

-- Dump completed on 2018-01-27 22:05:51
