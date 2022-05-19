-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: PLANT_COMMUNITY
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

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
-- Table structure for table `ASTE`
--

DROP TABLE IF EXISTS `ASTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ASTE` (
  `CODICE_ASTA` int(11) NOT NULL AUTO_INCREMENT,
  `NOME_PIANTA` varchar(50) DEFAULT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `DATA_INIZIO` date DEFAULT NULL,
  `DATA_FINE` date NOT NULL,
  `PREZZO_CORRENTE` int(11) DEFAULT NULL,
  `MIGLIOR_OFFERENTE` varchar(255) DEFAULT NULL,
  `LINK_IMG` text NOT NULL,
  PRIMARY KEY (`CODICE_ASTA`),
  KEY `USERNAME` (`USERNAME`),
  KEY `MIGLIOR_OFFERENTE` (`MIGLIOR_OFFERENTE`),
  CONSTRAINT `aste_ibfk_1` FOREIGN KEY (`USERNAME`) REFERENCES `USERS` (`USERNAME`),
  CONSTRAINT `aste_ibfk_2` FOREIGN KEY (`MIGLIOR_OFFERENTE`) REFERENCES `USERS` (`USERNAME`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ASTE`
--

LOCK TABLES `ASTE` WRITE;
/*!40000 ALTER TABLE `ASTE` DISABLE KEYS */;
INSERT INTO `ASTE` VALUES (1,'Citrullus lanatus (Thunb.) Matsum. & Nakai','GIUSEPPE','2022-05-18','2022-05-19',86,'utente1','https://www.giardinaggio.it/ortofrutta/orto/coltivare-il-cocomero_NG1.jpg'),(2,'Musa acuminata Colla','GIUSEPPE','2022-05-18','2022-05-19',35,'GIUSEPPE','https://www.seeds-gallery.shop/10863-large_default/semi-di-banana-selvatica-della-foresta-musa-yunnanensis.jpg'),(3,'Musa acuminata Colla','GIUSEPPE','2022-05-18','2022-05-19',88,'GIUSEPPE','https://it.les-jardins-de-sanne.com/wp-content/uploads/sites/10/2019/09/food_plants_img_108.jpg'),(5,'Epipremnum pinnatum (L.) Engl.','PIPPO','2022-05-18','2022-05-19',57,'GIUSEPPE','https://images.squarespace-cdn.com/content/v1/5a206c4bdc2b4affa2b76f82/1585682687564-HZ417AN1G0P32UMX9PIK/lucidmonstera.jpg?format=1000w'),(6,'Monstera deliciosa Liebm.','PIPPO','2022-05-18','2022-05-19',122,'utente1','http://www.palmpedia.net/forum/attachments/variegated-monstera-007-jpg.26715/'),(7,'Aglaonema commutatum Schott','ROSA','2022-05-18','2022-05-19',61,'utente1','https://i.etsystatic.com/20973711/r/il/8d429e/3030773724/il_fullxfull.3030773724_pvk2.jpg'),(8,'Gossypium hirsutum L.','utente1','2022-05-18','2022-05-19',52,'GIUSEPPE','https://1.bp.blogspot.com/-ArZXmfw1SuA/XAvmvU8Vg3I/AAAAAAAAKfU/yQJpovWftFYRJVayHGI9ILgKRpqyMiLDwCLcBGAs/s1600/IMG_8471.jpg'),(9,'Linum alpinum Jacq.','GIUSEPPE','2022-05-19','2022-05-20',40,'GIUSEPPE','https://www.dailygreen.it/wp-content/uploads/2019/11/lino-pianta.jpg');
/*!40000 ALTER TABLE `ASTE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ASTE_FOLLOW`
--

DROP TABLE IF EXISTS `ASTE_FOLLOW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ASTE_FOLLOW` (
  `MD5_CODE` varchar(255) NOT NULL,
  `ASTA_CODE` int(11) NOT NULL,
  KEY `MD5_CODE` (`MD5_CODE`),
  KEY `ASTA_CODE` (`ASTA_CODE`),
  CONSTRAINT `aste_follow_ibfk_1` FOREIGN KEY (`MD5_CODE`) REFERENCES `USERS` (`MD5_CODE`),
  CONSTRAINT `aste_follow_ibfk_2` FOREIGN KEY (`ASTA_CODE`) REFERENCES `ASTE` (`CODICE_ASTA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ASTE_FOLLOW`
--

LOCK TABLES `ASTE_FOLLOW` WRITE;
/*!40000 ALTER TABLE `ASTE_FOLLOW` DISABLE KEYS */;
INSERT INTO `ASTE_FOLLOW` VALUES ('6284f6e8a3859 ',1),('6284f79d3fe00 ',1),('6284f79d3fe00 ',3),('6284f79d3fe00 ',5),('6284f911ef0c7 ',1),('6284f911ef0c7 ',5),('6284f911ef0c7 ',2),('6284f911ef0c7 ',3),('6284f911ef0c7 ',6),('6284f911ef0c7 ',7),('6284f6e8a3859 ',6),('6285506aa0f7a ',2),('6285506aa0f7a ',1),('6285506aa0f7a ',5),('6284f6e8a3859 ',8);
/*!40000 ALTER TABLE `ASTE_FOLLOW` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `PROFILE_IMAGE` text DEFAULT NULL,
  `MD5_CODE` varchar(255) NOT NULL,
  PRIMARY KEY (`USERNAME`),
  UNIQUE KEY `MD5_CODE` (`MD5_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('GIUSEPPE','10fBT8Ayrv01k','https://digitalshirt.it/wp-content/uploads/2021/03/profilo-uomo-dani-anteprima-grafica-15.jpg','6284f6e8a3859'),('PIPPO','10fBT8Ayrv01k',NULL,'6284f79d3fe00'),('ROSA','10fBT8Ayrv01k',NULL,'6284f911ef0c7'),('utente1','10.50AMGFOZqU','https://us.123rf.com/450wm/triken/triken1608/triken160800029/61320775-maschio-avatar-picture-profilo-predefinito-user-avatar-ospite-avatar-semplicemente-testa-umana-vetto.jpg?ver=6','6285506aa0f7a');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-19 11:39:45
