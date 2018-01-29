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
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`benutzer_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benutzer`
--

LOCK TABLES `benutzer` WRITE;
/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer` VALUES (1,'Julian','Milicevic','julian.milicevic@its-stuttgart.de','$2y$12$HoYHSnAebXOaqBQWJL0biORs62Kok0RR2sJfUhFUTuKCgqbeRKuUG',2,450,NULL),(2,'Andreas','Hruschka','andreas.hruschka@its-stuttgart.de','$2y$12$oiiQUyiFoI6s7iwX2h335eZP2OWbyMpefznP.ItnoQ/iLR441Ida2',3,0.3,NULL),(3,'Nikolai','Nowolodski','nikolai.nowolodski@its-stuttgart.de','$2y$12$2/dHj1V0n91/QIGpmbBNAePABPZTquVz6FEADTKjiTg9K3PGtM5ha',3,15,NULL),(4,'Rüdiger','Berg','ruediger.berg@its-stuttgart.de','$2y$12$Ks/oyQ7tPHmsZM2wGTNbnubTUtLUlIdtUglJKDoClUk3ZJ8Cus7O.',3,50.6,NULL),(5,'Thorsten','Misch','thorsten.misch@its-stuttgart.de','$2y$12$xoZL.sz.Pl20HnOKTSE7MumO3OQPnHTtwavh2lMJ9.kSCAnfabHte',2,30.5,NULL),(6,'Julius','Elsner','julius.elsner@its-stuttgart.de','$2y$12$dQGLD.DhdMXmKkd918NGq.Fa6KyUmixlup.UX.yd6NvVT7necXh.O',3,12.5,NULL),(7,'Marcel','Ernst','marcel.ernst@its-stuttgart.de','$2y$12$fcVlRsCT4uZAQqIWNDX3zet1NsT1M4vJ1WuoYg6YH60wv/W7FEzAC',3,5,NULL),(8,'Maximilian','Krüger','maximilian.krueger@its-stuttgart.de','$2y$12$1noD0VZ/CWQ0hGUQIQMGR.taZvLSBKCTSrgDLTfm8in4UPWwAapZi',3,5,NULL),(9,'Marvin','Stäbler','marvin.staebler@its-stuttgart.de','$2y$12$gh/K8DNVJ2717u9WhTwPJ.p7dNb8e8xj88vT1vSAVpIEbUaAHG5aO',3,5,NULL),(10,'Alexander','Dosch','alexander.dosch@its-stuttgart.de','$2y$12$rklvYu05fgYhU04VBYjtOeOeicsUbESKLXgTNPJHVEE3lIcOnVWNy',3,123,NULL),(11,'Natalia','Othega','natalia.othega@its-stuttgart.de','$2y$12$M3bin0QreS2ypbNBn8hBc.5umFQ/YbW01UtHuUzslsXo7fmTbucqW',3,123,NULL),(12,'Alischa','Fritzsche','alischa.fritzsche@its-stuttgart.de','$2y$12$4SbHiKyDaL8pUsTWpAlfE.qCfb2RgoHKEyngfxV5qS2Jpg3N6OWAu',3,12,NULL),(13,'Alexander','Ullmann','alexander.ullmann@its-stuttgart.de','$2y$12$mdhPIEYMrCUotIjlLg.YOe7M0M1Q3k8rltunw2YMXbND79melZG.C',3,12,NULL),(14,'Kevin','Kohnert','kevin.kohnert@its-stuttgart.de','$2y$12$3Icqw/11ycbh2pjt6ASGS.L3gPWqWUF5tib/9kvHIq9sjVgOb8hiq',3,8,NULL),(15,'Pascal','Delassus','pascal.delassus@its-stuttgart.de','$2y$12$qihUpaWMQF/6BOLq1uK9AehXYm2nebDjhq8RH418DYaqBoONqOuKy',3,5,NULL),(16,'Tobias','Gerussi','tobias.gerussi@its-stuttgart.der','$2y$12$tXEjGwFl1bBqaS7Q6owmiOWek/1dfzkPONwmrt7ufq5vdlUMrcKoO',3,5,NULL),(17,'Marc','Müller','marc.mueller@its-stuttgart.de','$2y$12$iQue374ginzn.zKUvEAkluQ0bCWyQ0M3EwOs0xzlkhE22bR8w2n7e',3,3,NULL),(18,'Enthonen','Freitas','enthonen.freitas@its-stuttgart.de','$2y$12$kV8arI8vCgyZxWi1klaqeuuaicqMDqW8BDptGRrAHwBOb.r3/lZey',3,5,NULL),(19,'Martin','Brehm','martin.brehm@its-stuttgart.de','$2y$12$hEuocLCpkNri.mKCpX9Q..3MkCRAy03ZnrhLBVK/Hv17fE2WeDYiu',3,1,NULL),(20,'Marcel','Hödl','marcel.hoedl@its-stuttgart.de','$2y$12$qoTosLTq08VJ4OnH324ds.B8U5GZjOO7pK.Mr0wppg5UFcWEcKNBi',3,5,NULL),(21,'Adal','Waldemaria','adal.waldemaria@its-stuttgart.de','$2y$12$xGcZQCQjHFYQoqUC/2.iHuiRCSgzwh/ALV7IKrGgLoyoN.MEaImDa',3,1,NULL),(22,'Dirk','Maier','dirk.maier@its-stuttgart.de','$2y$12$okTdit4lU4evGie1M16EO.6eDAzpN4yzarp96WBMnBzLBNHhVFjkG',3,8,NULL),(23,'Nico','Martin','nico.martin@its-stuttgart.de','$2y$12$DJs6NnBlN9ejwtVPiq627.nEUXrR4wsAtwcj9PwCLofLwT39OqxES',3,1,NULL);
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

-- Dump completed on 2018-01-29 15:39:49
