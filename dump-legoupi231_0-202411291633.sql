-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: mysql-etu.unicaen.fr    Database: legoupi231_0
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.6-MariaDB-0+deb12u1-log

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
-- Table structure for table `Adventure`
--

DROP TABLE IF EXISTS `Adventure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Adventure` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_first_chapter` int(11) DEFAULT NULL,
  `ad_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ad_id`),
  KEY `Adventure_Chapter_FK` (`ad_first_chapter`,`ad_id`),
  CONSTRAINT `Adventure_Chapter_FK` FOREIGN KEY (`ad_first_chapter`, `ad_id`) REFERENCES `Chapter` (`id`, `ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Adventure`
--

LOCK TABLES `Adventure` WRITE;
/*!40000 ALTER TABLE `Adventure` DISABLE KEYS */;
INSERT INTO `Adventure` VALUES (0,0,'aventure test');
/*!40000 ALTER TABLE `Adventure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Armor`
--

DROP TABLE IF EXISTS `Armor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Armor` (
  `am_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `amt_id` int(11) NOT NULL,
  `am_point` int(11) NOT NULL,
  `initiative_penalty` int(11) DEFAULT NULL,
  PRIMARY KEY (`am_id`),
  KEY `Armor_FK_Type` (`amt_id`),
  KEY `Armor_PK_Item` (`item_id`),
  CONSTRAINT `Armor_FK_Type` FOREIGN KEY (`amt_id`) REFERENCES `Armor_Type` (`amt_id`),
  CONSTRAINT `Armor_PK_Item` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Armor`
--

LOCK TABLES `Armor` WRITE;
/*!40000 ALTER TABLE `Armor` DISABLE KEYS */;
INSERT INTO `Armor` VALUES (0,0,0,5,3);
/*!40000 ALTER TABLE `Armor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Armor_Type`
--

DROP TABLE IF EXISTS `Armor_Type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Armor_Type` (
  `amt_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`amt_id`),
  UNIQUE KEY `Armor_Type_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Armor_Type`
--

LOCK TABLES `Armor_Type` WRITE;
/*!40000 ALTER TABLE `Armor_Type` DISABLE KEYS */;
INSERT INTO `Armor_Type` VALUES (0,'type armor test');
/*!40000 ALTER TABLE `Armor_Type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chapter`
--

DROP TABLE IF EXISTS `Chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Chapter` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `treasure_id` int(11) DEFAULT NULL,
  `ad_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`ad_id`),
  KEY `treasure_id` (`treasure_id`),
  KEY `Chapter_FK_Ad` (`ad_id`),
  CONSTRAINT `Chapter_FK_Ad` FOREIGN KEY (`ad_id`) REFERENCES `Adventure` (`ad_id`),
  CONSTRAINT `Chapter_ibfk_1` FOREIGN KEY (`treasure_id`) REFERENCES `Treasure` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chapter`
--

LOCK TABLES `Chapter` WRITE;
/*!40000 ALTER TABLE `Chapter` DISABLE KEYS */;
INSERT INTO `Chapter` VALUES (0,'chapitre de test','chap.png',0,0);
/*!40000 ALTER TABLE `Chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chapter_Treasure`
--

DROP TABLE IF EXISTS `Chapter_Treasure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Chapter_Treasure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `adventure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `Chapter_Treasure_ibfk_1` (`id`,`adventure_id`),
  KEY `Chapter_Treasure_ibfk_0` (`chapter_id`,`adventure_id`),
  CONSTRAINT `Chapter_Treasure_ibfk_0` FOREIGN KEY (`chapter_id`, `adventure_id`) REFERENCES `Chapter` (`id`, `ad_id`),
  CONSTRAINT `Chapter_Treasure_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chapter_Treasure`
--

LOCK TABLES `Chapter_Treasure` WRITE;
/*!40000 ALTER TABLE `Chapter_Treasure` DISABLE KEYS */;
INSERT INTO `Chapter_Treasure` VALUES (1,0,0,0);
/*!40000 ALTER TABLE `Chapter_Treasure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Class`
--

DROP TABLE IF EXISTS `Class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `base_pv` int(11) NOT NULL,
  `base_mana` int(11) NOT NULL,
  `base_primary_wp` int(11) DEFAULT NULL,
  `base_secondary_wp` int(11) DEFAULT NULL,
  `base_spell` int(11) DEFAULT NULL,
  `base_shield` int(11) DEFAULT NULL,
  `base_initiative` int(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `base_strength` int(11) DEFAULT NULL,
  `base_qte_item_limit` int(11) DEFAULT NULL,
  `base_weight_limit` int(11) DEFAULT NULL,
  `base_armor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CLASS_PRIMARY_WP` (`base_primary_wp`),
  KEY `FK_CLASS_SECONDARY_WP` (`base_secondary_wp`),
  KEY `FK_CLASS_SPELL` (`base_spell`),
  KEY `Class_FK` (`base_shield`),
  KEY `FK_CLASS_BASE_ARMOR` (`base_armor`),
  CONSTRAINT `Class_FK` FOREIGN KEY (`base_shield`) REFERENCES `Shield` (`sh_id`),
  CONSTRAINT `FK_CLASS_BASE_ARMOR` FOREIGN KEY (`base_armor`) REFERENCES `Armor` (`am_id`),
  CONSTRAINT `FK_CLASS_PRIMARY_WP` FOREIGN KEY (`base_primary_wp`) REFERENCES `Weapon` (`wp_id`),
  CONSTRAINT `FK_CLASS_SECONDARY_WP` FOREIGN KEY (`base_secondary_wp`) REFERENCES `Weapon` (`wp_id`),
  CONSTRAINT `FK_CLASS_SPELL` FOREIGN KEY (`base_spell`) REFERENCES `Spell` (`sp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Class`
--

LOCK TABLES `Class` WRITE;
/*!40000 ALTER TABLE `Class` DISABLE KEYS */;
/*!40000 ALTER TABLE `Class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Encounter`
--

DROP TABLE IF EXISTS `Encounter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Encounter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `monster_id` int(11) DEFAULT NULL,
  `adventure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `monster_id` (`monster_id`),
  KEY `Encounter_ibfk_1` (`id`,`adventure_id`),
  KEY `Encounter_ibfk_0` (`chapter_id`,`adventure_id`),
  CONSTRAINT `Encounter_ibfk_0` FOREIGN KEY (`chapter_id`, `adventure_id`) REFERENCES `Chapter` (`id`, `ad_id`),
  CONSTRAINT `Encounter_ibfk_2` FOREIGN KEY (`monster_id`) REFERENCES `Monster` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Encounter`
--

LOCK TABLES `Encounter` WRITE;
/*!40000 ALTER TABLE `Encounter` DISABLE KEYS */;
INSERT INTO `Encounter` VALUES (0,0,0,0);
/*!40000 ALTER TABLE `Encounter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Hero`
--

DROP TABLE IF EXISTS `Hero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Hero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `pv` int(11) NOT NULL,
  `mana` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `initiative` int(11) NOT NULL,
  `shield` int(11) DEFAULT NULL,
  `xp` int(11) NOT NULL,
  `current_level` int(11) DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `am_id` int(11) DEFAULT NULL,
  `primary_wp_id` int(11) DEFAULT NULL,
  `secondary_wp_id` int(11) DEFAULT NULL,
  `weight_limit` float DEFAULT NULL,
  `qte_item_limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `hero_fk_user` (`user_id`),
  KEY `Hero_FK_Item` (`am_id`),
  KEY `Hero_FK_Primary_Weapon` (`primary_wp_id`),
  KEY `Hero_FK_Secondary_Weapon` (`secondary_wp_id`),
  KEY `FK_HERO_SHIELD` (`shield`),
  CONSTRAINT `FK_HERO_SHIELD` FOREIGN KEY (`shield`) REFERENCES `Shield` (`sh_id`),
  CONSTRAINT `Hero_FK_Item` FOREIGN KEY (`am_id`) REFERENCES `Armor` (`am_id`),
  CONSTRAINT `Hero_FK_Primary_Weapon` FOREIGN KEY (`primary_wp_id`) REFERENCES `Weapon` (`wp_id`),
  CONSTRAINT `Hero_FK_Secondary_Weapon` FOREIGN KEY (`secondary_wp_id`) REFERENCES `Weapon` (`wp_id`),
  CONSTRAINT `Hero_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `Class` (`id`),
  CONSTRAINT `hero_fk_user` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Hero`
--

LOCK TABLES `Hero` WRITE;
/*!40000 ALTER TABLE `Hero` DISABLE KEYS */;
/*!40000 ALTER TABLE `Hero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Inventory`
--

DROP TABLE IF EXISTS `Inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Inventory` (
  `hero_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qte` int(11) DEFAULT NULL,
  PRIMARY KEY (`hero_id`,`item_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `Inventory_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`),
  CONSTRAINT `Inventory_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Inventory`
--

LOCK TABLES `Inventory` WRITE;
/*!40000 ALTER TABLE `Inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `Inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Items`
--

DROP TABLE IF EXISTS `Items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `weight` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Items`
--

LOCK TABLES `Items` WRITE;
/*!40000 ALTER TABLE `Items` DISABLE KEYS */;
INSERT INTO `Items` VALUES (0,'test_item','item de test',1.1);
/*!40000 ALTER TABLE `Items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Level`
--

DROP TABLE IF EXISTS `Level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `required_xp` int(11) NOT NULL,
  `pv_bonus` int(11) NOT NULL,
  `mana_bonus` int(11) NOT NULL,
  `strength_bonus` int(11) NOT NULL,
  `initiative_bonus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `Level_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `Class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Level`
--

LOCK TABLES `Level` WRITE;
/*!40000 ALTER TABLE `Level` DISABLE KEYS */;
/*!40000 ALTER TABLE `Level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Links`
--

DROP TABLE IF EXISTS `Links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `next_chapter_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `key_item_id` int(11) DEFAULT NULL,
  `adventure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Links_FK_Item` (`key_item_id`),
  KEY `Links_Chapter_FK` (`id`,`adventure_id`),
  KEY `Links_ibfk_1` (`chapter_id`,`adventure_id`),
  KEY `Links_ibfk_2` (`next_chapter_id`,`adventure_id`),
  CONSTRAINT `Links_FK_Item` FOREIGN KEY (`key_item_id`) REFERENCES `Items` (`id`),
  CONSTRAINT `Links_ibfk_1` FOREIGN KEY (`chapter_id`, `adventure_id`) REFERENCES `Chapter` (`id`, `ad_id`),
  CONSTRAINT `Links_ibfk_2` FOREIGN KEY (`next_chapter_id`, `adventure_id`) REFERENCES `Chapter` (`id`, `ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Links`
--

LOCK TABLES `Links` WRITE;
/*!40000 ALTER TABLE `Links` DISABLE KEYS */;
INSERT INTO `Links` VALUES (0,0,0,'link test',0,0);
/*!40000 ALTER TABLE `Links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Loot`
--

DROP TABLE IF EXISTS `Loot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Loot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `Loot_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Loot`
--

LOCK TABLES `Loot` WRITE;
/*!40000 ALTER TABLE `Loot` DISABLE KEYS */;
INSERT INTO `Loot` VALUES (0,'loot test',0,1);
/*!40000 ALTER TABLE `Loot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Monster`
--

DROP TABLE IF EXISTS `Monster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Monster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pv` int(11) NOT NULL,
  `mana` int(11) DEFAULT NULL,
  `initiative` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `attack` text DEFAULT NULL,
  `loot_id` int(11) DEFAULT NULL,
  `xp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `loot_id` (`loot_id`),
  CONSTRAINT `Monster_ibfk_1` FOREIGN KEY (`loot_id`) REFERENCES `Loot` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Monster`
--

LOCK TABLES `Monster` WRITE;
/*!40000 ALTER TABLE `Monster` DISABLE KEYS */;
INSERT INTO `Monster` VALUES (0,'monstre test',10,10,10,10,'10',0,10);
/*!40000 ALTER TABLE `Monster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Quest`
--

DROP TABLE IF EXISTS `Quest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Quest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hero_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `adventure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hero_id` (`hero_id`),
  KEY `Quest_ibfk_2` (`chapter_id`,`adventure_id`),
  CONSTRAINT `Quest_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`),
  CONSTRAINT `Quest_ibfk_2` FOREIGN KEY (`chapter_id`, `adventure_id`) REFERENCES `Chapter` (`id`, `ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Quest`
--

LOCK TABLES `Quest` WRITE;
/*!40000 ALTER TABLE `Quest` DISABLE KEYS */;
INSERT INTO `Quest` VALUES (0,NULL,0,0);
/*!40000 ALTER TABLE `Quest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shield`
--

DROP TABLE IF EXISTS `Shield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Shield` (
  `sh_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `sh_point` int(11) DEFAULT NULL,
  `initiative_penality` int(11) DEFAULT NULL,
  PRIMARY KEY (`sh_id`),
  KEY `FK_SHIELD_ITEM` (`item_id`),
  CONSTRAINT `FK_SHIELD_ITEM` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shield`
--

LOCK TABLES `Shield` WRITE;
/*!40000 ALTER TABLE `Shield` DISABLE KEYS */;
INSERT INTO `Shield` VALUES (0,0,10,10);
/*!40000 ALTER TABLE `Shield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Spell`
--

DROP TABLE IF EXISTS `Spell`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Spell` (
  `sp_id` int(11) NOT NULL,
  `spt_id` int(11) DEFAULT NULL,
  `sp_power` int(11) DEFAULT NULL,
  `sp_cost` int(11) DEFAULT NULL,
  `sp_legend` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sp_id`),
  KEY `FK_SPELL_SPELL_TYPE` (`spt_id`),
  CONSTRAINT `FK_SPELL_SPELL_TYPE` FOREIGN KEY (`spt_id`) REFERENCES `Spell_Type` (`spt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Spell`
--

LOCK TABLES `Spell` WRITE;
/*!40000 ALTER TABLE `Spell` DISABLE KEYS */;
INSERT INTO `Spell` VALUES (0,0,10,10,'spell test');
/*!40000 ALTER TABLE `Spell` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Spell_List`
--

DROP TABLE IF EXISTS `Spell_List`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Spell_List` (
  `hero_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  PRIMARY KEY (`hero_id`,`sp_id`),
  KEY `FK_LIST_SPELL` (`sp_id`),
  CONSTRAINT `FK_LIST_HERO` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`),
  CONSTRAINT `FK_LIST_SPELL` FOREIGN KEY (`sp_id`) REFERENCES `Spell` (`sp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Spell_List`
--

LOCK TABLES `Spell_List` WRITE;
/*!40000 ALTER TABLE `Spell_List` DISABLE KEYS */;
/*!40000 ALTER TABLE `Spell_List` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Spell_Type`
--

DROP TABLE IF EXISTS `Spell_Type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Spell_Type` (
  `spt_id` int(11) NOT NULL,
  `spt_label` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`spt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Spell_Type`
--

LOCK TABLES `Spell_Type` WRITE;
/*!40000 ALTER TABLE `Spell_Type` DISABLE KEYS */;
INSERT INTO `Spell_Type` VALUES (0,'spell type test');
/*!40000 ALTER TABLE `Spell_Type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Treasure`
--

DROP TABLE IF EXISTS `Treasure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Treasure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `Treasure_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Treasure`
--

LOCK TABLES `Treasure` WRITE;
/*!40000 ALTER TABLE `Treasure` DISABLE KEYS */;
INSERT INTO `Treasure` VALUES (0,'tresor test',0,5);
/*!40000 ALTER TABLE `Treasure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_pseudo` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `User_UNIQUE` (`user_email`),
  UNIQUE KEY `User_UNIQUE_pseudo` (`user_pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'exemple@toto.com','AZERTY','Toto'),(2,'admin@admin.com','admin','Admin');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Weapon`
--

DROP TABLE IF EXISTS `Weapon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Weapon` (
  `wp_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `wpt_id` int(11) NOT NULL,
  `bonus_strength` int(11) NOT NULL,
  `initiative_penalty` int(11) DEFAULT NULL,
  PRIMARY KEY (`wp_id`),
  KEY `Weapon_FK_Item` (`item_id`),
  KEY `Weapon_FK` (`wpt_id`),
  CONSTRAINT `Weapon_FK` FOREIGN KEY (`wpt_id`) REFERENCES `Weapon_Type` (`wpt_id`),
  CONSTRAINT `Weapon_FK_Item` FOREIGN KEY (`item_id`) REFERENCES `Items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Weapon`
--

LOCK TABLES `Weapon` WRITE;
/*!40000 ALTER TABLE `Weapon` DISABLE KEYS */;
INSERT INTO `Weapon` VALUES (0,0,0,10,10);
/*!40000 ALTER TABLE `Weapon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Weapon_Type`
--

DROP TABLE IF EXISTS `Weapon_Type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Weapon_Type` (
  `wpt_id` int(2) NOT NULL AUTO_INCREMENT,
  `label` varchar(20) NOT NULL,
  PRIMARY KEY (`wpt_id`),
  UNIQUE KEY `Weapon_Type_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Weapon_Type`
--

LOCK TABLES `Weapon_Type` WRITE;
/*!40000 ALTER TABLE `Weapon_Type` DISABLE KEYS */;
INSERT INTO `Weapon_Type` VALUES (0,'type weapon test');
/*!40000 ALTER TABLE `Weapon_Type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'legoupi231_0'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-29 16:33:35
