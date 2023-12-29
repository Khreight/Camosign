-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: camosign
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversation` (
  `conversationId` int(11) NOT NULL AUTO_INCREMENT,
  `conversationDate` datetime DEFAULT NULL,
  `utilisateur1Id` int(11) DEFAULT NULL,
  `utilisateur2Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`conversationId`),
  KEY `utilisateur1Id` (`utilisateur1Id`),
  KEY `utilisateur2Id` (`utilisateur2Id`),
  CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`utilisateur1Id`) REFERENCES `utilisateur` (`utilisateurId`),
  CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`utilisateur2Id`) REFERENCES `utilisateur` (`utilisateurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversation`
--

LOCK TABLES `conversation` WRITE;
/*!40000 ALTER TABLE `conversation` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `langues`
--

DROP TABLE IF EXISTS `langues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `langues` (
  `languesId` int(11) NOT NULL AUTO_INCREMENT,
  `languesName` varchar(120) DEFAULT NULL,
  `languesEmoji` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`languesId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langues`
--

LOCK TABLES `langues` WRITE;
/*!40000 ALTER TABLE `langues` DISABLE KEYS */;
/*!40000 ALTER TABLE `langues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sanction`
--

DROP TABLE IF EXISTS `sanction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sanction` (
  `sanctionId` int(11) NOT NULL AUTO_INCREMENT,
  `sanctionTraited` tinyint(1) DEFAULT NULL,
  `sanctionWarnOrBan` int(11) DEFAULT NULL,
  `sanctionDescription` text,
  `utilisateurId` int(11) DEFAULT NULL,
  PRIMARY KEY (`sanctionId`),
  KEY `utilisateurId` (`utilisateurId`),
  CONSTRAINT `sanction_ibfk_1` FOREIGN KEY (`utilisateurId`) REFERENCES `utilisateur` (`utilisateurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sanction`
--

LOCK TABLES `sanction` WRITE;
/*!40000 ALTER TABLE `sanction` DISABLE KEYS */;
/*!40000 ALTER TABLE `sanction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tentative`
--

DROP TABLE IF EXISTS `tentative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tentative` (
  `tentativeId` int(11) NOT NULL AUTO_INCREMENT,
  `tentativeTime` timestamp NULL DEFAULT NULL,
  `utilisateurId` int(11) DEFAULT NULL,
  PRIMARY KEY (`tentativeId`),
  KEY `utilisateurId` (`utilisateurId`),
  CONSTRAINT `tentative_ibfk_1` FOREIGN KEY (`utilisateurId`) REFERENCES `utilisateur` (`utilisateurId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tentative`
--

LOCK TABLES `tentative` WRITE;
/*!40000 ALTER TABLE `tentative` DISABLE KEYS */;
/*!40000 ALTER TABLE `tentative` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `utilisateurId` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurInscriptionDate` date DEFAULT NULL,
  `utilisateurPseudo` varchar(30) DEFAULT NULL,
  `utilisateurMail` varchar(30) DEFAULT NULL,
  `utilisateurNaissance` date DEFAULT NULL,
  `utilisateurRole` varchar(30) DEFAULT NULL,
  `utilisateurPassword` varchar(50) DEFAULT NULL,
  `utilisateurToken` varchar(60) NOT NULL,
  `utilisateurVerifie` tinyint(1) DEFAULT NULL,
  `utilisateurBanned` tinyint(1) DEFAULT NULL,
  `utilisateurSuppression` tinyint(1) NOT NULL DEFAULT '0',
  `utilisateurReasonSuppression` text NOT NULL,
  `utilisateurDateSuppression` date NOT NULL,
  PRIMARY KEY (`utilisateurId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'2023-12-26','Louis','louisthedeaf@gmail.com','2005-09-11','administrator','Louis','',0,0,0,'','0000-00-00'),(2,'2023-12-26','Khreight','pro.khreight@gmail.com','2005-09-11','user','$2y$10$uH9kTEeox1aO1EsM8kbiV.XdNkZA6LqgweDX3faVosJ','',0,0,0,'','0000-00-00');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur_langues`
--

DROP TABLE IF EXISTS `utilisateur_langues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur_langues` (
  `utilisateur_languesId` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurId` int(11) DEFAULT NULL,
  `languesId` int(11) DEFAULT NULL,
  PRIMARY KEY (`utilisateur_languesId`),
  KEY `utilisateurId` (`utilisateurId`),
  KEY `languesId` (`languesId`),
  CONSTRAINT `utilisateur_langues_ibfk_1` FOREIGN KEY (`utilisateurId`) REFERENCES `utilisateur` (`utilisateurId`),
  CONSTRAINT `utilisateur_langues_ibfk_2` FOREIGN KEY (`languesId`) REFERENCES `langues` (`languesId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur_langues`
--

LOCK TABLES `utilisateur_langues` WRITE;
/*!40000 ALTER TABLE `utilisateur_langues` DISABLE KEYS */;
/*!40000 ALTER TABLE `utilisateur_langues` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-29 21:27:43
