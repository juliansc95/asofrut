-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: asofrutj
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

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
-- Table structure for table `gpxs`
--

DROP TABLE IF EXISTS `gpxs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gpxs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productor_id` int(10) unsigned NOT NULL,
  `finca_id` int(10) unsigned NOT NULL,
  `latitud` decimal(20,19) NOT NULL,
  `longitud` decimal(21,19) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gpxs_productor_id_foreign` (`productor_id`),
  KEY `gpxs_finca_id_foreign` (`finca_id`),
  CONSTRAINT `gpxs_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  CONSTRAINT `gpxs_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gpxs`
--

LOCK TABLES `gpxs` WRITE;
/*!40000 ALTER TABLE `gpxs` DISABLE KEYS */;
INSERT INTO `gpxs` VALUES (1,5,1,3.4295550000000000000,-76.5242060000000000000,'2020-12-30 04:56:06','2020-12-30 04:56:06'),(2,5,1,3.4495550000000000000,-76.5242060000000000000,'2020-12-30 04:56:10','2020-12-30 04:56:10'),(3,5,3,3.4298150000000000000,-76.5248020000000000000,'2021-01-18 15:26:37','2021-01-18 15:26:37'),(4,5,3,3.4295550000000000000,-76.5242060000000000000,'2021-01-18 20:10:29','2021-01-18 20:10:29'),(5,5,3,3.4295550000000000000,-76.5242060000000000000,'2021-01-18 20:18:03','2021-01-18 20:18:03');
/*!40000 ALTER TABLE `gpxs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gradoescolaridads`
--

DROP TABLE IF EXISTS `gradoescolaridads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gradoescolaridads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gradoescolaridads_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gradoescolaridads`
--

LOCK TABLES `gradoescolaridads` WRITE;
/*!40000 ALTER TABLE `gradoescolaridads` DISABLE KEYS */;
INSERT INTO `gradoescolaridads` VALUES (1,'Primaria Incompleta','2020-12-07 22:04:31','2020-12-07 22:04:31'),(2,'Primaria','2020-12-07 22:04:31','2020-12-07 22:04:31'),(3,'Bachiller Incompleto','2020-12-07 22:04:31','2020-12-07 22:04:31'),(4,'Bachiller','2020-12-07 22:04:32','2020-12-07 22:04:32'),(5,'Tecnico Incompleto','2020-12-07 22:04:32','2020-12-07 22:04:32'),(6,'Tecnico','2020-12-07 22:04:32','2020-12-07 22:04:32'),(7,'Tecnologo Incompleto','2020-12-07 22:04:32','2020-12-07 22:04:32'),(8,'Tecnologo','2020-12-07 22:04:32','2020-12-07 22:04:32'),(9,'Universitario Incompleto','2020-12-07 22:04:32','2020-12-07 22:04:32'),(10,'Universitario','2020-12-07 22:04:32','2020-12-07 22:04:32');
/*!40000 ALTER TABLE `gradoescolaridads` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-21  7:32:13
