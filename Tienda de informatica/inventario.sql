-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: inventario
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'disco'),(2,'fuente'),(3,'gabinete'),(4,'mother'),(5,'placa de video'),(6,'procesador'),(7,'ram');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `finalizar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,1,'2023-10-19 03:18:51',0),(2,1,'2023-10-19 03:20:54',0);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_producto`
--

DROP TABLE IF EXISTS `orden_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_producto` (
  `id_compra` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_compra` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_compra`,`producto_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `orden_producto_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`),
  CONSTRAINT `orden_producto_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_producto`
--

LOCK TABLES `orden_producto` WRITE;
/*!40000 ALTER TABLE `orden_producto` DISABLE KEYS */;
INSERT INTO `orden_producto` VALUES (1,8,2),(1,12,1),(1,32,1),(2,4,2),(2,8,1);
/*!40000 ALTER TABLE `orden_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_codigo` varchar(70) NOT NULL,
  `producto_nombre` varchar(70) NOT NULL,
  `producto_precio` decimal(30,2) NOT NULL,
  `producto_stock` int(11) NOT NULL,
  `producto_foto` varchar(500) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'100','disco rigido w.d 1 tb blue sata',40020.00,10,'img/DISCOS/Disco Rigido W.D. 1TB Blue Sata.jpg',1),(2,'101','disco rigido w.d 2 tb 5400 sata',46000.00,10,'img/DISCOS/Disco Rigido W.D. 2TB Blue 5400 Sata.jpg',1),(3,'102','disco ssd acer sa100 960gb sata',40020.00,10,'img/DISCOS/Disco SSD Acer SA100 960GB Sata.jpg',1),(4,'103','disco ssd gigabyte 240gb sata',16560.00,10,'img/DISCOS/Disco SSD Gigabyte 240Gb Sata.jpg',1),(5,'104','ssd crucial bx500 500gb sata',23000.00,10,'img/DISCOS/SSD Crucial BX500 500GB Sata.jpg',1),(6,'105','fuente corsair rm850x white 80+gold',110400.00,10,'img/FUENTES/Fuente Corsair RM850X White 80+Gold.jpg',2),(7,'106','fuente corsair rmx shift 1000w 80+gold',165600.00,10,'img/FUENTES/Fuente Corsair RMX Shift 1000W 80+Gold.jpg',2),(8,'107','fuente gigabyte gp-p450b 450w 80+bronce',42320.00,10,'img/FUENTES/Fuente Gigabyte GP-P450B 450W 80+Bronce.jpg',2),(9,'108','fuente gigabyte gp-p750gm 750w 80+gold',82800.00,10,'img/FUENTES/Fuente Gigabyte GP-P750GM 750W 80+Gold.jpg',2),(10,'109','fuente segotep gm1250w 80+gold',115000.00,10,'img/FUENTES/Fuente Segotep GM1250W 80+Gold.jpg',2),(11,'110','gabinete corsair icue 7000x rgb white',276000.00,10,'img/GABINETES/Gabinete Corsair iCUE 7000X RGB White.jpg',3),(12,'111','gabinete deepcool 55 mesh rgb 4f',82800.00,10,'img/GABINETES/Gabinete DeepCool 55 MESH RGB 4F.jpg',3),(13,'112','gabinete phanteks p200a drgb itx',69000.00,10,'img/GABINETES/Gabinete Phanteks P200A DRGB ITX.jpg',3),(14,'113','gabinete silverstone fara r1 pro v2 white',78200.00,10,'img/GABINETES/Gabinete Silverstone Fara R1 PRO v2 White.jpg',3),(15,'114','gabinete thermaltake ah t200 white matx',105800.00,10,'img/GABINETES/Gabinete Thermaltake AH T200 White Matx.jpg',3),(16,'115','mother asrock z790m pg lightning d4 lga 1700',184000.00,10,'img/MOTHERS/Mother Asrock Z790M PG Lightning D4 LGA 1700.jpg',4),(17,'116','mother asus prime z690-p wifi d4 lga1700',230000.00,10,'img/MOTHERS/Mother Asus Prime Z690-P WIFI D4 LGA1700.jpg',4),(18,'117','mother asus tuf z690-plus wifi d4 lga1700',276000.00,10,'img/MOTHERS/Mother Asus TUF Z690-Plus Wifi D4 LGA1700.jpg',4),(19,'118','mother asus tuf z790-plus gaming wifi d4 lga1700',322000.00,10,'img/MOTHERS/Mother Asus Tuf Z790-Plus Gaming Wifi D4 LGA1700.jpg',4),(20,'119','mother msi pro z690-a ddr4 lga1700',187680.00,10,'img/MOTHERS/Mother MSI Pro Z690-A DDR4 LGA1700.jpg',4),(21,'120','vga asus dual oc rtx3060ti 8gb gddr6x',391000.00,10,'img/PLACAS DE VIDEO/Vga Asus Dual OC RTX3060TI 8GB GDDR6X.jpg',5),(22,'121','vga asus tuf evo oc gtx1660ti 6gb',273700.00,10,'img/PLACAS DE VIDEO/Vga Asus Tuf EVO Oc GTX1660Ti 6GB.jpg',5),(23,'122','vga gigabyte oc rtx3060ti 8gb',400200.00,10,'img/PLACAS DE VIDEO/Vga Gigabyte OC RTX3060TI 8GB.jpg',5),(24,'123','vga pny dual fan gtx1660ti 6gb',266800.00,10,'img/PLACAS DE VIDEO/Vga PNY Dual Fan GTX1660Ti 6GB.jpg',5),(25,'124','vga zotac twin fan gtx1660 super 6gb',253000.00,10,'img/PLACAS DE VIDEO/Vga Zotac Twin Fan GTX1660 Super 6GB.jpg',5),(26,'125','micro intel core i5 12400f lga1700',179400.00,10,'img/PROCESADORES/INTEL 12400F.jpeg',6),(27,'126','micro intel core i5 12400 lga1700',207000.00,10,'img/PROCESADORES/INTEL 12400.jpeg',6),(28,'127','micro intel core i5 13400f lga1700',216200.00,10,'img/PROCESADORES/INTEL 13400F.jpeg',6),(29,'128','micro intel core i5 13400 lga1700',230000.00,10,'img/PROCESADORES/INTEL 13400 - .jpeg',6),(30,'129','micro intel core i7 12700 lga1700',354200.00,10,'img/PROCESADORES/INTEL I7 12700.jpg',6),(31,'130','memoria corsair vengeance 2x16gb ddr5 5200mhz',138000.00,10,'img/RAM/Memoria Corsair Vengeance 2x16GB DDR5 5200Mhz.jpg',7),(32,'131','memoria crucial 8gb ddr5 4800mhz',27140.00,10,'img/RAM/Memoria Crucial 8GB DDR5 4800Mhz.jpg',7),(33,'132','memoria kingston fury beast 8gb ddr5 4800mhz',32200.00,10,'img/RAM/Memoria Kingston Fury Beast 8GB DDR5 4800Mhz.jpg',7),(34,'133','memoria kingston fury beast 16gb ddr5 4800mhz',55200.00,10,'img/RAM/Memoria Kingston Fury Beast 16GB DDR5 4800Mhz.jpg',7),(35,'134','memoria xpg lancer rgb 16gb ddr5 5200mhz',69000.00,10,'img/RAM/Memoria XPG Lancer RGB 16GB DDR5 5200Mhz.jpg',7);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(40) NOT NULL,
  `usuario_apellido` varchar(40) NOT NULL,
  `usuario_usuario` varchar(20) NOT NULL,
  `usuario_clave` varchar(200) NOT NULL,
  `usuario_email` varchar(70) NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'franco','lescano','franlesk','$2y$10$SIuJ4/cyIQc2EO0.UAqBze/OrKUmRoW7DHwUn9ehktrMrDn6apXKG','franlesk@gmail.com'),(2,'franco','lescano','michi deodo','$2y$10$.InEDnVwyvGJT4FUVDqY9eKdwf8VqAz8IGlLFfVKDZpKDVOHYY5u6','michideodo22@gmail.com');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'inventario'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-18 19:37:40
