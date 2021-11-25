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
-- Table structure for table `gpxzones`
--

DROP TABLE IF EXISTS `gpxzones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gpxzones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productor_id` int(10) unsigned NOT NULL,
  `finca_id` int(10) unsigned NOT NULL,
  `linea` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gpxzones_productor_id_foreign` (`productor_id`),
  KEY `gpxzones_finca_id_foreign` (`finca_id`),
  CONSTRAINT `gpxzones_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  CONSTRAINT `gpxzones_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gpxzones`
--

LOCK TABLES `gpxzones` WRITE;
/*!40000 ALTER TABLE `gpxzones` DISABLE KEYS */;
INSERT INTO `gpxzones` VALUES (19,5,3,'[{\"lat\":3.4298101533,\"lng\":-76.5247765370},{\"lat\":3.4298083931,\"lng\":-76.5247526485},{\"lat\":3.4298121650,\"lng\":-76.5247606952},{\"lat\":3.4298414178,\"lng\":-76.5247724298},{\"lat\":3.4298303537,\"lng\":-76.5247838292},{\"lat\":3.4298209660,\"lng\":-76.5247870144},{\"lat\":3.4298269171,\"lng\":-76.5248000901},{\"lat\":3.4298302699,\"lng\":-76.5247928817},{\"lat\":3.4298314434,\"lng\":-76.5247871820},{\"lat\":3.4298342094,\"lng\":-76.5247859247},{\"lat\":3.4298089799,\"lng\":-76.5247687418},{\"lat\":3.4297234844,\"lng\":-76.5246218909},{\"lat\":3.4297673218,\"lng\":-76.5246140119},{\"lat\":3.4297404997,\"lng\":-76.5245608706}]','2021-08-11 02:25:12','2021-08-11 02:25:12'),(20,5,1,'[{\"lat\":3.4298420046,\"lng\":-76.5247974079},{\"lat\":3.4298464470,\"lng\":-76.5248016827},{\"lat\":3.4298852552,\"lng\":-76.5247644670},{\"lat\":3.4298787173,\"lng\":-76.5248207934},{\"lat\":3.4298837464,\"lng\":-76.5248159319},{\"lat\":3.4298408311,\"lng\":-76.5247883555},{\"lat\":3.4298051242,\"lng\":-76.5248104837},{\"lat\":3.4298125841,\"lng\":-76.5248062089},{\"lat\":3.4297845885,\"lng\":-76.5247650538},{\"lat\":3.4298335388,\"lng\":-76.5248547401},{\"lat\":3.4298384003,\"lng\":-76.5248265769},{\"lat\":3.4297809843,\"lng\":-76.5247973241},{\"lat\":3.4297965746,\"lng\":-76.5247927979},{\"lat\":3.4298150986,\"lng\":-76.5247991681},{\"lat\":3.4297975805,\"lng\":-76.5248106513},{\"lat\":3.4297890309,\"lng\":-76.5248336177},{\"lat\":3.4298194572,\"lng\":-76.5248156805},{\"lat\":3.4298300184,\"lng\":-76.5247917082},{\"lat\":3.4298408311,\"lng\":-76.5248176083},{\"lat\":3.4298401605,\"lng\":-76.5248133335},{\"lat\":3.4297155216,\"lng\":-76.5247262456},{\"lat\":3.4297397453,\"lng\":-76.5247308556},{\"lat\":3.4298057947,\"lng\":-76.5248035267},{\"lat\":3.4298008494,\"lng\":-76.5248043649},{\"lat\":3.4298104048,\"lng\":-76.5248559974},{\"lat\":3.4298383165,\"lng\":-76.5248155128},{\"lat\":3.4298277553,\"lng\":-76.5247891936}]','2021-08-11 03:42:13','2021-08-11 03:42:13');
/*!40000 ALTER TABLE `gpxzones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-11  0:11:37
