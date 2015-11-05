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
  `id_detal` int(11) NOT NULL,
  `nazwa` varchar(45) NOT NULL,
  `maszyny_id_maszyny` int(11) NOT NULL,
  PRIMARY KEY (`id_detal`),
  UNIQUE KEY `id_detal_UNIQUE` (`id_detal`),
  KEY `fk_detal_maszyny1_idx` (`maszyny_id_maszyny`),
  CONSTRAINT `fk_detal_maszyny1` FOREIGN KEY (`maszyny_id_maszyny`) REFERENCES `maszyny` (`id_maszyny`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detal`
--

LOCK TABLES `detal` WRITE;
/*!40000 ALTER TABLE `detal` DISABLE KEYS */;
INSERT INTO `detal` VALUES (1,'wałek',0),(2,'wałekS',0),(3,'korba',0),(4,'korbaS1',0),(5,'łopatka1',0);
/*!40000 ALTER TABLE `detal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia`
--

DROP TABLE IF EXISTS `historia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historia` (
  `id_historia` int(11) NOT NULL,
  `czas_przyjscia` varchar(45) NOT NULL,
  `czas_wyjscia` varchar(45) DEFAULT NULL,
  `operatorzy_id_operatorzy` int(11) NOT NULL,
  `detal_id_detal` int(11) NOT NULL,
  `maszyny_id_maszyny` int(11) NOT NULL,
  PRIMARY KEY (`id_historia`),
  UNIQUE KEY `id_historia_UNIQUE` (`id_historia`),
  KEY `fk_historia_operatorzy1_idx` (`operatorzy_id_operatorzy`),
  KEY `fk_historia_detal1_idx` (`detal_id_detal`),
  KEY `fk_historia_maszyny1_idx` (`maszyny_id_maszyny`),
  CONSTRAINT `fk_historia_detal1` FOREIGN KEY (`detal_id_detal`) REFERENCES `detal` (`id_detal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historia_maszyny1` FOREIGN KEY (`maszyny_id_maszyny`) REFERENCES `maszyny` (`id_maszyny`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historia_operatorzy1` FOREIGN KEY (`operatorzy_id_operatorzy`) REFERENCES `operatorzy` (`id_operatorzy`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia`
--

LOCK TABLES `historia` WRITE;
/*!40000 ALTER TABLE `historia` DISABLE KEYS */;
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
  `nazwa` varchar(45) NOT NULL,
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
INSERT INTO `maszyny` VALUES (0,'Źródło','Źródło','W1'),(1,'SIP1','szlifierka','W1'),(2,'SIP2','szlifierka','W2'),(3,'TRAK1','tokarka','W1'),(4,'TRAK2','tokarka','W3'),(5,'Micron1','frezarka','W20'),(6,'Micron2','frezarka','W20'),(7,'Sykes1','dłutownica','W4'),(8,'Cel','Cel','W1');
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
INSERT INTO `operatorzy` VALUES (1,'Jan','Nowak','pass',1),(2,'Adam','Kowalski','pass',1),(3,'Dawid','Wilk','pass',2),(4,'Mateusz','Wilk','pass',2),(5,'Franek','Skurski','pass',3),(6,'Mietek','Bańka','pass',3),(7,'Bronisław','Komorowski','pass',4),(8,'Jarosław','Kaczyński','pass',4),(9,'Tomasz','Malinowski','pass',5),(10,'Adam','Małysz','pass',5),(11,'Mariusz','Pudzianowski','pass',6),(12,'Robert','Kubica','pass',6),(13,'Krzysztof','Ibisz','pass',7),(14,'Arnold','Czarnymurzyn','pass',7);
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

-- Dump completed on 2015-11-05 22:29:48
