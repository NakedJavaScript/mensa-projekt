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
-- Table structure for table `buchungen`
--

DROP TABLE IF EXISTS `buchungen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buchungen` (
  `buchungsnummer` int(11) NOT NULL AUTO_INCREMENT,
  `schueler_ID` int(11) NOT NULL,
  `tagesangebot_ID` int(11) NOT NULL,
  `buchungsdatum` datetime NOT NULL,
  `menge` int(2) NOT NULL,
  PRIMARY KEY (`buchungsnummer`),
  KEY `schueler_ID_idx` (`schueler_ID`),
  KEY `tagesangebot_ID_idx` (`tagesangebot_ID`),
  CONSTRAINT `schueler_ID` FOREIGN KEY (`schueler_ID`) REFERENCES `benutzer` (`benutzer_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tagesangebot_ID` FOREIGN KEY (`tagesangebot_ID`) REFERENCES `tagesangebot` (`tagesangebot_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='hier sind die Buchungen der Schüler';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buchungen`
--

LOCK TABLES `buchungen` WRITE;
/*!40000 ALTER TABLE `buchungen` DISABLE KEYS */;
/*!40000 ALTER TABLE `buchungen` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-09  8:17:56
