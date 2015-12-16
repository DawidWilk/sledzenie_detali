-- MySQL dump 10.13  Distrib 5.5.21, for Win32 (x86)
--
-- Host: localhost    Database: system_detale
-- ------------------------------------------------------
-- Server version	5.5.21-log

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
-- Table structure for table `detal`
--

DROP TABLE IF EXISTS `detal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detal` (
  `id_detal` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa_detalu` varchar(45) NOT NULL,
  `maszyny_id_maszyny` int(11) NOT NULL,
  `stan` varchar(45) NOT NULL,
  PRIMARY KEY (`id_detal`),
  UNIQUE KEY `id_detal_UNIQUE` (`id_detal`),
  KEY `fk_detal_maszyny1_idx` (`maszyny_id_maszyny`),
  CONSTRAINT `fk_detal_maszyny1` FOREIGN KEY (`maszyny_id_maszyny`) REFERENCES `maszyny` (`id_maszyny`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detal`
--

LOCK TABLES `detal` WRITE;
/*!40000 ALTER TABLE `detal` DISABLE KEYS */;
INSERT INTO `detal` VALUES (21,'walek1',8,'usuniety'),(22,'walek2',8,'usuniety'),(23,'walek3',8,'usuniety'),(24,'walek4',0,'usuniety'),(25,'problny_walek',0,'usuniety'),(26,'probny_walek2',2,'uzycie'),(27,'probny_walek2',0,'uzycie'),(28,'26',0,'uzycie');
/*!40000 ALTER TABLE `detal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia`
--

DROP TABLE IF EXISTS `historia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historia` (
  `id_historia` int(11) NOT NULL AUTO_INCREMENT,
  `operatorzy_id_operatorzy` int(11) NOT NULL,
  `detal_id_detal` int(11) NOT NULL,
  `maszyny_id_maszyny` int(11) NOT NULL,
  `typ_operacji` varchar(45) NOT NULL,
  `maszyna_poprzednia` int(11) NOT NULL,
  `data` varchar(45) NOT NULL,
  PRIMARY KEY (`id_historia`),
  UNIQUE KEY `id_historia_UNIQUE` (`id_historia`),
  KEY `fk_historia_operatorzy1_idx` (`operatorzy_id_operatorzy`),
  KEY `fk_historia_detal1_idx` (`detal_id_detal`),
  KEY `fk_historia_maszyny1_idx` (`maszyny_id_maszyny`),
  CONSTRAINT `fk_historia_detal1` FOREIGN KEY (`detal_id_detal`) REFERENCES `detal` (`id_detal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historia_maszyny1` FOREIGN KEY (`maszyny_id_maszyny`) REFERENCES `maszyny` (`id_maszyny`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historia_operatorzy1` FOREIGN KEY (`operatorzy_id_operatorzy`) REFERENCES `operatorzy` (`id_operatorzy`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia`
--

LOCK TABLES `historia` WRITE;
/*!40000 ALTER TABLE `historia` DISABLE KEYS */;
INSERT INTO `historia` VALUES (45,15,21,0,'dodanie',0,'15:49:32 2015-12-13'),(46,15,22,0,'dodanie',0,'15:49:38 2015-12-13'),(47,15,23,0,'dodanie',0,'15:49:43 2015-12-13'),(48,15,24,0,'dodanie',0,'15:49:49 2015-12-13'),(49,15,24,0,'usuniecie',0,'15:54:33 2015-12-13'),(50,4,23,2,'pobranie',0,'15:59:49 2015-12-13'),(51,4,23,2,'przeniesienie',2,'15:59:59 2015-12-13'),(52,4,22,2,'pobranie',0,'10:08:32 2015-12-15'),(53,4,23,8,'przeniesienie',2,'10:08:46 2015-12-15'),(54,4,21,2,'pobranie',0,'12:07:40 2015-12-15'),(55,4,21,8,'przeniesienie',2,'12:07:58 2015-12-15'),(56,4,22,8,'przeniesienie',2,'12:08:07 2015-12-15'),(57,15,21,0,'usuniecie',0,'12:08:54 2015-12-15'),(58,15,22,0,'usuniecie',0,'12:09:01 2015-12-15'),(59,15,25,0,'dodanie',0,'12:09:34 2015-12-15'),(60,15,23,0,'usuniecie',0,'14:17:28 2015-12-15'),(61,15,25,0,'usuniecie',0,'15:23:13 2015-12-15'),(62,15,26,0,'dodanie',0,'15:23:45 2015-12-15'),(63,15,27,0,'dodanie',0,'15:25:09 2015-12-15'),(64,15,28,0,'dodanie',0,'15:25:14 2015-12-15'),(65,15,26,2,'przeniesienie_k',0,'16:41:38 2015-12-15');
/*!40000 ALTER TABLE `historia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maszyny`
--

DROP TABLE IF EXISTS `maszyny`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maszyny` (
  `id_maszyny` int(11) NOT NULL,
  `nazwa_maszyny` varchar(45) NOT NULL,
  `typ` varchar(45) NOT NULL,
  `lokalizacja` varchar(45) NOT NULL,
  PRIMARY KEY (`id_maszyny`),
  UNIQUE KEY `id_maszyny_UNIQUE` (`id_maszyny`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maszyny`
--

LOCK TABLES `maszyny` WRITE;
/*!40000 ALTER TABLE `maszyny` DISABLE KEYS */;
INSERT INTO `maszyny` VALUES (0,'Źródło','miejsce','W1'),(1,'SIP1','szlifierka','W1'),(2,'SIP2','szlifierka','W2'),(3,'TRAK1','tokarka','W1'),(4,'TRAK2','tokarka','W3'),(5,'Micron1','frezarka','W20'),(6,'Micron2','frezarka','W20'),(7,'Sykes1','dłutownica','W4'),(8,'Cel','miejsce','W1');
/*!40000 ALTER TABLE `maszyny` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operatorzy`
--

DROP TABLE IF EXISTS `operatorzy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operatorzy` (
  `id_operatorzy` int(11) NOT NULL,
  `imie` varchar(45) NOT NULL,
  `nazwisko` varchar(45) NOT NULL,
  `haslo` varchar(45) NOT NULL,
  `maszyny_id_maszyny` int(11) NOT NULL,
  `stanowisko` varchar(45) NOT NULL,
  PRIMARY KEY (`id_operatorzy`),
  KEY `fk_operatorzy_maszyny_idx` (`maszyny_id_maszyny`),
  CONSTRAINT `fk_operatorzy_maszyny` FOREIGN KEY (`maszyny_id_maszyny`) REFERENCES `maszyny` (`id_maszyny`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operatorzy`
--

LOCK TABLES `operatorzy` WRITE;
/*!40000 ALTER TABLE `operatorzy` DISABLE KEYS */;
INSERT INTO `operatorzy` VALUES (1,'Jan','Nowak','pass',1,'operator'),(2,'Adam','Kowalski','pass',1,'operator'),(3,'Janek','Jakis','pass',2,'operator'),(4,'Mateusz','Wilk','pass',2,'operator'),(5,'Franek','Skurski','pass',3,'operator'),(6,'Mietek','Bańka','pass',3,'operator'),(7,'Bronisław','Komorowski','pass',4,'operator'),(8,'Jarosław','Kaczyński','pass',4,'operator'),(9,'Tomasz','Malinowski','pass',5,'operator'),(10,'Adam','Małysz','pass',5,'operator'),(11,'Mariusz','Pudzianowski','pass',6,'operator'),(12,'Robert','Kubica','pass',6,'operator'),(13,'Krzysztof','Ibisz','pass',7,'operator'),(14,'Arnold','Czarnymurzyn','pass',7,'operator'),(15,'Dawid','Wilk','pass',0,'kierownik');
/*!40000 ALTER TABLE `operatorzy` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-16  8:56:44
