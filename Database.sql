-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: medcure
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `id_invoice` int NOT NULL AUTO_INCREMENT,
  `invoice_date` datetime DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `invoiced_to` int NOT NULL,
  `invoiced_checkd_by` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_invoice`),
  KEY `fk_user_1_idx` (`invoiced_to`),
  KEY `fk_user_2_idx` (`invoiced_checkd_by`),
  CONSTRAINT `fk_user_1` FOREIGN KEY (`invoiced_to`) REFERENCES `users` (`id_users`),
  CONSTRAINT `fk_user_2` FOREIGN KEY (`invoiced_checkd_by`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=48;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (37,'2021-04-10 18:57:37',90,88,NULL,2),(38,'2021-04-11 11:53:27',50,88,NULL,1),(39,'2021-04-12 06:36:09',70,88,NULL,2),(40,'2021-04-12 15:26:13',70,88,NULL,1),(42,'2021-04-25 20:59:31',105,88,NULL,2),(43,'2021-04-26 19:33:27',900,88,NULL,2),(44,'2021-04-27 21:09:23',220,88,NULL,1),(45,'2021-04-28 22:11:39',350,88,NULL,2),(46,'2021-05-03 19:56:07',200,88,NULL,2),(47,'2021-05-03 20:14:50',10,88,NULL,2);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_items` (
  `id_invoice_items` int NOT NULL AUTO_INCREMENT,
  `id_product` int DEFAULT NULL,
  `id_invoice` int DEFAULT NULL,
  `line_qty` int DEFAULT NULL,
  `line_unit_price` double DEFAULT NULL,
  PRIMARY KEY (`id_invoice_items`),
  KEY `fk_invoice_1_idx` (`id_invoice`),
  KEY `fk_product_1_idx` (`id_product`),
  CONSTRAINT `fk_invoice_1` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id_invoice`),
  CONSTRAINT `fk_product_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_products`)
) ENGINE=InnoDB AUTO_INCREMENT=95;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
INSERT INTO `invoice_items` VALUES (65,18,37,1,50),(66,17,37,2,20),(73,18,38,1,50),(74,17,39,1,20),(75,18,39,1,50),(76,18,40,1,50),(77,17,40,1,20),(86,23,42,3,35),(90,18,43,18,50),(91,17,44,10,22),(92,18,45,7,50),(93,22,46,5,40),(94,25,47,1,10);
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_category` (
  `id_product_category` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_product_category`)
) ENGINE=InnoDB AUTO_INCREMENT=13;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (8,'Medicine',NULL),(9,'Medical Devices',NULL),(10,'Wellness',NULL),(11,'Personal Care',NULL),(12,'GNC',NULL);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id_products` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(500) DEFAULT NULL,
  `buy_price` double DEFAULT NULL,
  `sell_price` double DEFAULT NULL,
  `avl_qty` double DEFAULT NULL,
  `product_category` int DEFAULT NULL,
  `product_profile_img` varchar(500) DEFAULT NULL,
  `is_active` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_products`),
  KEY `fk_category_idx` (`product_category`),
  CONSTRAINT `fk_category` FOREIGN KEY (`product_category`) REFERENCES `product_category` (`id_product_category`)
) ENGINE=InnoDB AUTO_INCREMENT=31;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (17,'PANADOL 500mg PARACETAMOL TABLETS','Panadol Advance 500mg Tablets are a mild analgesic and antipyretic, and are recommended for the treatment of most painful and febrile conditions.',17,22,15,8,'panadol.png',1),(18,'NATROL, BIOTIN, MAXIMUM STRENGTH, 10,000mcg','Biotin , a B vitamin also known as Vitamin H or Vitamin B7, is not only an important nutrient for hair, skin and nails, but also helps convert food into energy.',12,15.45,20,10,'biotin.png',1),(22,'RED BULL - ENERGY DRINK','Revitalize mind and body with Red Bull: It gives you wings. Helps you feel significantly more energetic, while simultaneously improving your ability to focus and concentrate. Contains taurine, caffeine and B-group vitamins.',35,40,15,10,'redbull.png',1),(23,'DETTOL HANDY PACK (3 in 1)','Dettol handy-pack is great for instant clean ups on-the-go. With a mild fresh fragrance, these wipes kill 99.9% of germs and are gentle enough to use on your skin. Dermatologically tested and pH balanced.',30,35,50,11,'detol.png',1),(24,'GNC VITAMIN K2 30S 534890','Good for the bone building process*\r\nSuperior, highly absorbable form of vitamin K-2. Vitamin K-2 Soft Chews are a convenient alternative to pills and a great addition to your daily nutrition and health regimen.',16,19.9,30,10,'k2.png',1),(25,'LINK SAMAHAN AYURVEDIC HERBAL TEA PACKETS (AN EXTRA DRINK FOR IMMUNITY)','Samahan is a concentrated, water soluble herbal preparation of selected medical herbs used over centuries in health care. As Samahan is combination of 14 herbs. Samahan is most effective for analgesic, antipyretic, expectorant, and anti-inflammatory.',7,10,60,10,'samahan.jpg',1),(26,'GOLD STANDARD 100% WHEY PROTEIN','Gold Standard 100% Whey Protein contains per scoop 24 grams of high-quality whey protein, 3.5 grams of glutamine, 5 grams of BCAAs only 3 grams of carbohydrates and a minimum of fat and lactose. Proteins support stronger muscles, the maintenance of muscle mass and recovery',50,56.9,45,12,'whey.png',1),(27,'PEDIAPRO','Anchor PediaPro 1-2 is a milk powder for toddlers between the ages of one to two years, with Protein, Calcium and fortified with DHA, Vitamins A, C, E, B1, B3, B6, D3 and Iron, Zinc, Copper, Selenium, Folic Acid and added with prebiotics (Inulin).',8,10,20,11,'pediapro.png',1),(28,'CHANDANALEPA SOAP','Chandanalepa Ayurvedic Herbal Soap is produced with all-natural herbal extracts to add nutrition to the skin and boost immunity against infectious disease. It contains no harmful toxins or chemicals. Use Chandanalepa Ayurvedic Herbal Soap keep skin healthy, glowing and youthful.',5,8,55,11,'soap.png',1),(29,'5 LAYER PROTECTIVE KN95 FACE MASK','These Disposable Masks are non-medical and are designed to keep out dust, particles, saliva etc... They feature a close fit and block 95% of particles when worn properly.',10,12,43,9,'kn95.png',1),(30,'DUM HATTIYA - HELA SUWAYA (2pks)','A mix of herbs to boil and inhale. Contains 2 packs of Hela Suwaya dum hattiya.',16.5,18.9,70,8,'dum-hattiya.png',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `country` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `zipcode` varchar(45) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT '1',
  `is_active` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=109;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (88,'Siththaru','De Silva','No 210, Kalutara South','Sri Lanka','Kalutara','12000','0774690754','siththarudesilva@gmail.com','admin','123','1',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'medcure'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-03 20:58:03
