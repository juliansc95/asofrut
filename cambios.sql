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
-- Table structure for table `enfermedads`
--

DROP TABLE IF EXISTS `enfermedads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enfermedads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productor_id` int(10) unsigned NOT NULL,
  `finca_id` int(10) unsigned NOT NULL,
  `monitoreo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMonitoreo` int(11) DEFAULT NULL,
  `antracnosis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoAntra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAntra` int(11) DEFAULT NULL,
  `botritys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoBotritys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaBotritys` int(11) DEFAULT NULL,
  `mildeo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoMildeo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMildeo` int(11) DEFAULT NULL,
  `mildeoVelloso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoMildeoVelloso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMildeoVelloso` int(11) DEFAULT NULL,
  `adherentes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreAdherente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosisAplicacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enfermedads_productor_id_foreign` (`productor_id`),
  KEY `enfermedads_finca_id_foreign` (`finca_id`),
  CONSTRAINT `enfermedads_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  CONSTRAINT `enfermedads_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enfermedads`
--

LOCK TABLES `enfermedads` WRITE;
/*!40000 ALTER TABLE `enfermedads` DISABLE KEYS */;
INSERT INTO `enfermedads` VALUES (1,5,1,'Si',5,'Si','Trampas',2,'Si','Biopreparados',5,'No','Biologicos',2,'Si','Agroquimicos',1,'Si','quimico',50,'2021-03-04 20:17:51','2021-03-04 20:17:51');
/*!40000 ALTER TABLE `enfermedads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practicas`
--

DROP TABLE IF EXISTS `practicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `practicas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productor_id` int(10) unsigned NOT NULL,
  `finca_id` int(10) unsigned NOT NULL,
  `vivenda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viveSitio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bateriaSanitaria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pozoSeptico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zonaBarbecho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaBarbecho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agroquimicos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mezclaAgroquimicos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaAgroquimicos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bodegaMateriales` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaBodega` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canastillas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaCanastillas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trajeProteccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaTraje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puntoEcologico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaPuntoEcologico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `botiquin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaBotiquin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extintor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaExtintor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacitacionesBPA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificadas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institucionCertificado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `practicas_productor_id_foreign` (`productor_id`),
  KEY `practicas_finca_id_foreign` (`finca_id`),
  CONSTRAINT `practicas_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  CONSTRAINT `practicas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practicas`
--

LOCK TABLES `practicas` WRITE;
/*!40000 ALTER TABLE `practicas` DISABLE KEYS */;
INSERT INTO `practicas` VALUES (1,5,1,'Si','Si','Si','Si','Si','Si','Si','No','Si','No','No','Si','No','Si','No','Si','No','Si',NULL,'Si','Si','Si','Si','SENA',NULL,'2020-12-27 05:55:19','2020-12-27 05:55:19'),(2,5,1,'Si','Si','Si','Si','Si','Si','Si','No','No','Si','Si','No','Si','Si','No','Si','No','Si','Si','No','Si','Si','Si','Unicauca',NULL,'2020-12-27 06:03:32','2020-12-27 06:03:32'),(3,5,1,'Si','Si','Si','Si','No','No','Si','Si','Si','Si','No','Si','No','Si','No','Si','Si','No','No','Si','Si','Si','Si','sena',2,'2021-03-04 04:47:55','2021-03-04 04:47:55');
/*!40000 ALTER TABLE `practicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riegos`
--

DROP TABLE IF EXISTS `riegos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `riegos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productor_id` int(10) unsigned NOT NULL,
  `finca_id` int(10) unsigned NOT NULL,
  `riego` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adquisicion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo` int(11) DEFAULT NULL,
  `jornales` int(11) DEFAULT NULL,
  `reservorio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidadR` int(11) DEFAULT NULL,
  `alturaR` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riegos_productor_id_foreign` (`productor_id`),
  KEY `riegos_finca_id_foreign` (`finca_id`),
  CONSTRAINT `riegos_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  CONSTRAINT `riegos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riegos`
--

LOCK TABLES `riegos` WRITE;
/*!40000 ALTER TABLE `riegos` DISABLE KEYS */;
INSERT INTO `riegos` VALUES (1,5,1,'Si','Inversion propia','3','Aspersion',45,2,NULL,NULL,NULL,'2020-12-27 03:12:23','2020-12-27 03:12:23'),(2,5,1,'Si','Inversion propia','5','Aspersion',200,2,'Si',12,54,'2021-03-04 14:44:43','2021-03-04 14:44:43');
/*!40000 ALTER TABLE `riegos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-05 14:16:02
