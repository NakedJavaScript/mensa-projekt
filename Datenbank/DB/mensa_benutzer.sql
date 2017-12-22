-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mensa
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

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
-- Table structure for table `benutzer`
--

DROP TABLE IF EXISTS `benutzer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benutzer` (
  `benutzer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `vorname` varchar(45) NOT NULL,
  `nachname` varchar(45) NOT NULL,
  `email` varchar(80) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `admin_rechte` int(1) DEFAULT NULL,
  `kontostand` double DEFAULT NULL,
  PRIMARY KEY (`benutzer_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benutzer`
--

LOCK TABLES `benutzer` WRITE;
/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer` VALUES (11,'Julian','Milicevic','julian.milicevic@its.de','$2y$12$7bffZBm.58lU4ZuFDcsdY.VuhWWXWfx/02MxXWO.uiZND9Pz/HOVq',3,12.5),(12,'Andreas','Hruschka','andreas.hruschka@its.de','$2y$12$oiiQUyiFoI6s7iwX2h335eZP2OWbyMpefznP.ItnoQ/iLR441Ida2',3,0.3),(13,'Nikolai','Nowolodski','nikolai.nowolodski@its.de','$2y$12$2/dHj1V0n91/QIGpmbBNAePABPZTquVz6FEADTKjiTg9K3PGtM5ha',3,15),(14,'Rüdiger','Berg','ruediger.berg@its.de','$2y$12$Ks/oyQ7tPHmsZM2wGTNbnubTUtLUlIdtUglJKDoClUk3ZJ8Cus7O.',3,50.6),(15,'Thorsten','Misch','thorsten.misch@its.de','$2y$12$xoZL.sz.Pl20HnOKTSE7MumO3OQPnHTtwavh2lMJ9.kSCAnfabHte',2,30.5);
/*!40000 ALTER TABLE `benutzer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-21 11:14:47
