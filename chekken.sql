-- MySQL dump 10.13  Distrib 8.0.39, for Win64 (x86_64)
--
-- Host: localhost    Database: chekken
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `EmployeeID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `HiredDate` date NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ContactNumber` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Image` blob,
  `RoleID` int DEFAULT NULL,
  `Activate` tinyint(1) NOT NULL,
  PRIMARY KEY (`EmployeeID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  KEY `RoleID` (`RoleID`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `EventID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Date` date NOT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fight`
--

DROP TABLE IF EXISTS `fight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fight` (
  `FightID` int NOT NULL AUTO_INCREMENT,
  `Fighter1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Fighter2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Outcome` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `TotalBetsOnFighter1` decimal(10,2) NOT NULL,
  `TotalBetsOnFighter2` decimal(10,2) NOT NULL,
  `Percent` decimal(5,2) NOT NULL,
  `EventID` int DEFAULT NULL,
  PRIMARY KEY (`FightID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `fight_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fight`
--

LOCK TABLES `fight` WRITE;
/*!40000 ALTER TABLE `fight` DISABLE KEYS */;
/*!40000 ALTER TABLE `fight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `RoleID` int NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`RoleID`),
  UNIQUE KEY `RoleName` (`RoleName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `EmployeeID` int DEFAULT NULL,
  `FightID` int DEFAULT NULL,
  `BetTeam` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `PossibleWin` decimal(10,2) DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Barcode` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TransferTo` int DEFAULT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `EmployeeID` (`EmployeeID`),
  KEY `FightID` (`FightID`),
  KEY `TransferTo` (`TransferTo`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`FightID`) REFERENCES `fight` (`FightID`),
  CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`TransferTo`) REFERENCES `employee` (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-01 12:45:18
