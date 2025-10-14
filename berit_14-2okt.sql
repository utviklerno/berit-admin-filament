-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: berit
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.24.04.2

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
-- Table structure for table `admin_password_reset_tokens`
--

DROP TABLE IF EXISTS `admin_password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_password_reset_tokens`
--

LOCK TABLES `admin_password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `admin_password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'Tom-Erik Paulsen','tepaulsen@gmail.com','2025-10-13 07:33:40','$2y$12$QJqboQhGD4dUsQzbxS0Lo.3wAZIYN71XwlIv1UNht8laS8Lo8vPBm',NULL,'2025-10-13 07:33:40','2025-10-13 07:33:40'),(2,'Admin User','admin@berit.app','2025-10-13 07:33:40','$2y$12$Zp4a9na1T2kc4cAwVDNFVum9yp5UcrNs/Z5zSjqK1TRCNeVlr5NSi',NULL,'2025-10-13 07:33:40','2025-10-13 07:33:40'),(3,'Developer','dev@berit.app','2025-10-13 07:33:40','$2y$12$z.ayET.kqvpsoLU3ArO3xeYp3jfExfOvl6N0Kc6/4snL7XfvmI6uy',NULL,'2025-10-13 07:33:40','2025-10-13 07:33:40'),(4,'John Doe','john@berit.app','2025-10-13 07:33:41','$2y$12$JcWBg01egZGEigmze4c63uQcmmfODtKEj768L4aHX6PNK/xIv.mJe','DHA8onPfTw','2025-10-13 07:33:41','2025-10-13 07:33:41'),(5,'Jane Smith','jane@berit.app','2025-10-13 07:33:41','$2y$12$wTkSXd0v7oQfLCnw4KKPGOYSt7EM7EOXyQxtCh1AtumMP6lzJvKkO','YdmvHNM63k','2025-10-13 07:33:41','2025-10-13 07:33:41');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-livewire-rate-limiter:6cd5c007471c3df734662a989de7574c440ef65b','i:1;',1760431742),('laravel-cache-livewire-rate-limiter:6cd5c007471c3df734662a989de7574c440ef65b:timer','i:1760431742;',1760431742);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `native_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_emoji` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_rtl` tinyint(1) NOT NULL DEFAULT '0',
  `is_fallback` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `completion_percentage` float NOT NULL DEFAULT '0',
  `region` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UTC',
  `first_day_of_week` int NOT NULL DEFAULT '1',
  `currency_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_position` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'after',
  `currency_space` tinyint(1) NOT NULL DEFAULT '1',
  `currency_decimals` int NOT NULL DEFAULT '2',
  `decimal_separator` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '.',
  `thousands_separator` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ',',
  `date_format` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y-m-d',
  `time_format` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'H:i',
  `datetime_format` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y-m-d H:i',
  `locale_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plural_rules` json DEFAULT NULL,
  `date_names` json DEFAULT NULL,
  `last_updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_code_unique` (`code`),
  KEY `languages_is_active_sort_order_index` (`is_active`,`sort_order`),
  KEY `languages_is_default_index` (`is_default`),
  KEY `languages_code_index` (`code`),
  KEY `languages_completion_percentage_index` (`completion_percentage`),
  KEY `languages_updated_by_foreign` (`updated_by`),
  CONSTRAINT `languages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','English','en','en','🇬🇧',NULL,1,1,0,1,1,0,'International','GB','UTC',1,'GBP','£','before',0,2,'.',',','d/m/Y','H:i','d/m/Y H:i','en_GB','utf8mb4_unicode_ci',NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(2,'Norwegian','Norsk','no','no','🇳🇴',NULL,1,0,0,0,2,0,'Nordic','NO','Europe/Oslo',1,'NOK','kr','after',1,2,',',' ','d.m.Y','H:i','d.m.Y H:i','nb_NO','utf8mb4_norwegian_ci',NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(3,'Swedish','Svenska','se','sv','🇸🇪',NULL,1,0,0,0,3,0,'Nordic','SE','Europe/Stockholm',1,'SEK','kr','after',1,2,',',' ','Y-m-d','H:i','Y-m-d H:i','sv_SE','utf8mb4_swedish_ci',NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(4,'Danish','Dansk','da','da','🇩🇰',NULL,1,0,0,0,4,0,'Nordic','DK','Europe/Copenhagen',1,'DKK','kr','after',1,2,',',' ','d.m.Y','H:i','d.m.Y H:i','da_DK','utf8mb4_danish_ci',NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(5,'Finnish','Suomi','fi','fi','🇫🇮',NULL,1,0,0,0,5,0,'Nordic','FI','Europe/Helsinki',1,'EUR','€','after',1,2,',',' ','d.m.Y','H:i','d.m.Y H:i','fi_FI','utf8mb4_finnish_ci',NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_item_slugs`
--

DROP TABLE IF EXISTS `menu_item_slugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_item_slugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` bigint unsigned NOT NULL,
  `language_id` bigint unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_item_slugs_menu_item_id_language_id_unique` (`menu_item_id`,`language_id`),
  KEY `menu_item_slugs_language_id_foreign` (`language_id`),
  KEY `menu_item_slugs_slug_index` (`slug`),
  CONSTRAINT `menu_item_slugs_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_item_slugs_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_item_slugs`
--

LOCK TABLES `menu_item_slugs` WRITE;
/*!40000 ALTER TABLE `menu_item_slugs` DISABLE KEYS */;
INSERT INTO `menu_item_slugs` VALUES (1,1,1,'the-marketplace-of-opportunities','2025-10-14 07:43:41','2025-10-14 07:43:41'),(2,2,1,'business-operations','2025-10-14 07:43:41','2025-10-14 07:43:41'),(3,3,1,'customer-service','2025-10-14 07:43:41','2025-10-14 07:43:41'),(4,3,3,'kund-service','2025-10-14 08:11:47','2025-10-14 08:11:47');
/*!40000 ALTER TABLE `menu_item_slugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  KEY `menu_items_page_id_foreign` (`page_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_items_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'the-marketplace-of-opportunities',1,'2025-10-13 08:50:32','2025-10-13 08:50:32'),(2,1,'business-operations',2,'2025-10-13 08:50:52','2025-10-13 08:50:52'),(3,4,'customer-service',14,'2025-10-13 09:01:22','2025-10-13 09:01:22');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Berit','2025-10-13 07:54:31','2025-10-13 07:54:31'),(2,'Om Berit','2025-10-13 07:54:39','2025-10-13 07:54:39'),(3,'Personvern','2025-10-13 07:54:49','2025-10-13 07:54:49'),(4,'Help','2025-10-13 09:01:02','2025-10-13 09:01:02');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_04_05_170222_create_user_profiles_table',1),(5,'2025_04_07_075044_create_product_types_table',1),(6,'2025_04_08_065606_create_product_type_items_table',1),(7,'2025_04_08_071928_create_user_locations_table',1),(8,'2025_04_08_072046_create_user_items_table',1),(9,'2025_04_08_072824_create_user_item_images_table',1),(10,'2025_09_09_122418_create_admin_users_table',1),(11,'2025_09_09_124236_create_tenants_table',1),(12,'2025_09_09_124258_add_tenant_id_to_admin_users_table',1),(13,'2025_09_09_124434_add_tenant_id_to_users_table',1),(14,'2025_09_09_132326_remove_tenant_id_from_admin_users_table',1),(15,'2025_09_09_132340_remove_tenant_id_from_users_table',1),(16,'2025_09_09_132357_drop_tenants_table',1),(17,'2025_09_09_152610_add_mobile_column_to_users_table',1),(18,'2025_09_10_103841_create_languages_table',1),(19,'2025_09_10_103841_create_translation_categories_table',1),(20,'2025_09_10_103842_create_translation_keys_table',1),(21,'2025_09_10_103842_create_translation_values_table',1),(22,'2025_09_11_102448_create_payment_settings_table',1),(23,'2025_09_11_110058_update_payment_settings_separate_test_production_keys',1),(24,'2025_09_11_161112_add_images_column_to_user_items_table',1),(25,'2025_09_11_161116_add_images_column_to_user_locations_table',1),(26,'2025_09_11_161117_add_images_column_to_user_profiles_table',1),(27,'2025_09_19_120000_create_pages_table',1),(28,'2025_09_19_120100_create_subpages_table',1),(29,'2025_09_19_120200_add_unique_page_language_to_subpages',1),(30,'2025_10_13_120000_create_menus_table',2),(31,'2025_10_13_120100_create_menu_items_table',2),(32,'2025_10_14_000001_create_menu_item_slugs_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` json DEFAULT NULL,
  `meta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_pagename_unique` (`pagename`),
  KEY `pages_pagename_index` (`pagename`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'berit-the-marketplace-of-opportunities','The Marketplace of Opportunities',NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(2,'berit-business-operations','Business Operations',NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(3,'berit-become-a-business-customer','Become a Business Customer',NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(4,'berit-information-and-inspiration','Information and Inspiration',NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(5,'berit-admin-for-businesses','Admin for Businesses',NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(6,'about-berit-work-at-berit','Work at Berit',NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(7,'about-berit-beritspiration','Beritspiration',NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(8,'about-berit-terms-and-privacy','Terms and Privacy',NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(9,'about-berit-privacy-policy','Privacy Policy',NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(10,'about-berit-privacy-at-berit','Privacy at Berit',NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(11,'privacy-cookies','Cookies',NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(12,'privacy-cookie-settings','Cookie Settings',NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(13,'privacy-privacy-settings','Privacy Settings',NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(14,'help-customer-service','Customer Service',NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(15,'help-safe-shopping-on-berit','Safe Shopping on Berit',NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(16,'help-all-set-service','All Set Service',NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(17,'help-terms-of-use','Terms of Use',NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(18,'help-advertising-rules','Advertising Rules',NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(19,'help-accessibility','Accessibility',NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_settings`
--

DROP TABLE IF EXISTS `payment_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `default_gateway` enum('stripe','vipps') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `stripe_use_test_mode` tinyint(1) NOT NULL DEFAULT '1',
  `stripe_test_publishable_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_test_secret_key` text COLLATE utf8mb4_unicode_ci,
  `stripe_test_webhook_secret` text COLLATE utf8mb4_unicode_ci,
  `stripe_live_publishable_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_live_secret_key` text COLLATE utf8mb4_unicode_ci,
  `stripe_live_webhook_secret` text COLLATE utf8mb4_unicode_ci,
  `vipps_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `vipps_use_sandbox` tinyint(1) NOT NULL DEFAULT '1',
  `vipps_test_merchant_serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vipps_test_client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vipps_test_client_secret` text COLLATE utf8mb4_unicode_ci,
  `vipps_test_subscription_key` text COLLATE utf8mb4_unicode_ci,
  `vipps_live_merchant_serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vipps_live_client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vipps_live_client_secret` text COLLATE utf8mb4_unicode_ci,
  `vipps_live_subscription_key` text COLLATE utf8mb4_unicode_ci,
  `vipps_callback_prefix` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_settings`
--

LOCK TABLES `payment_settings` WRITE;
/*!40000 ALTER TABLE `payment_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type_items`
--

DROP TABLE IF EXISTS `product_type_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_type_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type_id` int NOT NULL,
  `pri` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type_items`
--

LOCK TABLES `product_type_items` WRITE;
/*!40000 ALTER TABLE `product_type_items` DISABLE KEYS */;
INSERT INTO `product_type_items` VALUES (1,1,1,'Parkeringsplasser','Daglige parkeringsplasser',10000),(2,1,2,'Langtidsparkering','Parkering for lengre perioder',150000),(3,1,3,'Lagring bil','Innendørs billagring',200000),(4,1,4,'Lagring bobil','Lagring av bobil og campingvogn',300000),(5,1,5,'Lagring motorsykkel','Trygg lagring av motorsykkel',80000),(6,2,1,'Båtopplag inne','Innendørs båtlagring',400000),(7,2,2,'Båtopplag ute','Utendørs båtlagring',250000),(8,3,1,'Selvbetjente lagerenheter','Selvbetjente lagerrom',120000),(9,3,2,'Lagercontainere','Containere for lagring',180000),(10,4,1,'Garasjer og boder','Private garasjer og boder',160000),(11,4,2,'Uthus og skur','Uthus og mindre skur',100000),(12,4,3,'Ekstra rom','Ledige rom til lagring',80000),(13,4,4,'Kjeller','Kjellerlokaler',70000),(14,4,5,'Loft','Loftslokaler',60000),(15,5,1,'Varehus / Lagerbygninger','Store lagerlokaler',500000),(16,5,2,'Bedriftslagring','Bedriftslagring og arkiv',350000);
/*!40000 ALTER TABLE `product_type_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pri` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_types`
--

LOCK TABLES `product_types` WRITE;
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;
INSERT INTO `product_types` VALUES (1,1,'Parkering','Parkerings- og kjøretøylagring'),(2,2,'Opplag','Båtopplag og oppbevaring'),(3,3,'Selvbetjent lagring','Selvbetjent lagring og containere'),(4,4,'Lagerplasser','Private lagerplasser og rom'),(5,5,'Kommersielt lager','Kommersielle lagerlokaler');
/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('sI8SnFOceqKAKlsVs13gzYjQP5QYad5FqrH42xe3',1,'192.168.1.136','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:143.0) Gecko/20100101 Firefox/143.0','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiREF2aGZBZ2tocklJVWhLTXM2dUhlTXFVVjIwTnU3aHl4cWt5a1VPRiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUxOiJodHRwOi8vYmVyaXQtYWRtaW4tZmlsYW1lbnQudGVzdC9hZG1pbi9tZW51cy80L2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxOToicGFzc3dvcmRfaGFzaF9hZG1pbiI7czo2MDoiJDJ5JDEyJFFKcWJvUWhHRDRkVXNRemJ4UzBMby4zd0FaSVlONzFYd2xJdjFVTmh0OGxhUzhMbzh2UEJtIjtzOjY6InRhYmxlcyI7YTo0OntzOjQwOiJhNTE2Y2I0MzNkNTRjYjM3NjI4NGMyMWZjNGU0ZmFhNV9jb2x1bW5zIjthOjQ6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoyOiJpZCI7czo1OiJsYWJlbCI7czoyOiJJRCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoibmFtZSI7czo1OiJsYWJlbCI7czo5OiJNZW51IE5hbWUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjEwOiJDcmVhdGVkIEF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoidXBkYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMjoiTGFzdCBVcGRhdGVkIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiI5NzkyYjZkZTU3MzE1NmVjMDQ1ZWE4MTg4MWJlM2QzZF9jb2x1bW5zIjthOjU6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoyOiJpZCI7czo1OiJsYWJlbCI7czoyOiJJRCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6Im1ldGFfdGl0bGUiO3M6NToibGFiZWwiO3M6MTA6Ik1ldGEgVGl0bGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjg6InBhZ2VuYW1lIjtzOjU6ImxhYmVsIjtzOjk6IlBhZ2UgTmFtZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IkNyZWF0ZWQgQXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTI6Ikxhc3QgVXBkYXRlZCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX1zOjQwOiJlMGYzNTI1Mzk0Yjg3YzZhMWI5N2VhNzFkZmIzNDE2N19jb2x1bW5zIjthOjM6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoyOiJpZCI7czo1OiJsYWJlbCI7czoyOiJJRCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjE6Imxhbmd1YWdlLmRpc3BsYXlfbmFtZSI7czo1OiJsYWJlbCI7czo4OiJMYW5ndWFnZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NToidGl0bGUiO3M6NToibGFiZWwiO3M6NToiVGl0bGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9fXM6NDA6ImFkZGNhYTBiMWUyN2Q2OTY3ZGNkZjU5ODJiMTg2YTNlX2NvbHVtbnMiO2E6NDp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjQ6InNsdWciO3M6NToibGFiZWwiO3M6NDoiU2x1ZyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTU6InBhZ2UubWV0YV90aXRsZSI7czo1OiJsYWJlbCI7czo0OiJQYWdlIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MDt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjIyOiJsb2NhbGl6ZWRfbG9jYWxlX2NvZGVzIjtzOjU6ImxhYmVsIjtzOjc6IkxvY2FsZXMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjowO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6NzoiVXBkYXRlZCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319fXM6ODoiZmlsYW1lbnQiO2E6MDp7fX0=',1760437240);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subpages`
--

DROP TABLE IF EXISTS `subpages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subpages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `pid` bigint unsigned DEFAULT NULL,
  `language_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` json DEFAULT NULL,
  `meta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subpages_page_language_unique` (`page_id`,`language_id`),
  KEY `subpages_pid_foreign` (`pid`),
  KEY `subpages_language_id_foreign` (`language_id`),
  KEY `subpages_page_id_language_id_index` (`page_id`,`language_id`),
  CONSTRAINT `subpages_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subpages_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subpages_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `subpages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subpages`
--

LOCK TABLES `subpages` WRITE;
/*!40000 ALTER TABLE `subpages` DISABLE KEYS */;
INSERT INTO `subpages` VALUES (1,1,NULL,1,'The Marketplace of Opportunities',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(2,1,1,2,'Mulighetenes marked',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(3,1,1,3,'Möjligheternas marknad',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(4,1,1,4,'Mulighedernes marked',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(5,1,1,5,'Mahdollisuuksien markkinapaikka',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(6,2,NULL,1,'Business Operations',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(7,2,6,2,'Næringsvirksomhet',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(8,2,6,3,'Näringsverksamhet',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(9,2,6,4,'Erhvervsvirksomhed',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(10,2,6,5,'Liiketoiminta',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(11,3,NULL,1,'Become a Business Customer',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:36','2025-10-13 07:33:36'),(12,3,11,2,'Bli bedriftskunde',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(13,3,11,3,'Bli företagskund',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(14,3,11,4,'Bliv erhvervskunde',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(15,3,11,5,'Liity yritysasiakkaaksi',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(16,4,NULL,1,'Information and Inspiration',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(17,4,16,2,'Informasjon og inspirasjon',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(18,4,16,3,'Information och inspiration',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(19,4,16,4,'Information og inspiration',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(20,4,16,5,'Tietoa ja inspiraatiota',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(21,5,NULL,1,'Admin for Businesses',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(22,5,21,2,'Admin for bedrifter',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(23,5,21,3,'Admin för företag',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(24,5,21,4,'Admin for virksomheder',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(25,5,21,5,'Yritysten hallinta',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(26,6,NULL,1,'Work at Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(27,6,26,2,'Jobbe i Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(28,6,26,3,'Jobba på Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(29,6,26,4,'Arbejd hos Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(30,6,26,5,'Työskentele Beritillä',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(31,7,NULL,1,'Beritspiration',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(32,7,31,2,'Beritspirasjon',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(33,7,31,3,'Beritspiration',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(34,7,31,4,'Beritspiration',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(35,7,31,5,'Beritinspiraatio',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(36,8,NULL,1,'Terms and Privacy',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(37,8,36,2,'Vilkår og personvern',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:37','2025-10-13 07:33:37'),(38,8,36,3,'Villkor och integritet',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(39,8,36,4,'Vilkår og privatliv',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(40,8,36,5,'Ehdot ja tietosuoja',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(41,9,NULL,1,'Privacy Policy',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(42,9,41,2,'Personvernerklæring',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(43,9,41,3,'Integritetspolicy',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(44,9,41,4,'Privatlivspolitik',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(45,9,41,5,'Tietosuojakäytäntö',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(46,10,NULL,1,'Privacy at Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(47,10,46,2,'Personvern i Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(48,10,46,3,'Integritet på Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(49,10,46,4,'Privatliv hos Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(50,10,46,5,'Tietosuoja Beritillä',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(51,11,NULL,1,'Cookies',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(52,11,51,2,'Informasjonskapsler',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(53,11,51,3,'Cookies',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(54,11,51,4,'Cookies',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(55,11,51,5,'Evästeet',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(56,12,NULL,1,'Cookie Settings',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(57,12,56,2,'Innstillinger for informasjonskapsler',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(58,12,56,3,'Inställningar för cookies',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(59,12,56,4,'Indstillinger for cookies',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(60,12,56,5,'Evästeasetukset',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(61,13,NULL,1,'Privacy Settings',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(62,13,61,2,'Innstillinger for personvern',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(63,13,61,3,'Integritetsinställningar',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(64,13,61,4,'Indstillinger for privatliv',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:38','2025-10-13 07:33:38'),(65,13,61,5,'Tietosuoja-asetukset',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(66,14,NULL,1,'Customer Service',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(67,14,66,2,'Kundeservice',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(68,14,66,3,'Kundservice',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(69,14,66,4,'Kundeservice',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(70,14,66,5,'Asiakaspalvelu',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(71,15,NULL,1,'Safe Shopping on Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(72,15,71,2,'Trygg handel på Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(73,15,71,3,'Trygg handel på Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(74,15,71,4,'Tryg handel på Berit',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(75,15,71,5,'Turvallinen asiointi Beritissä',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(76,16,NULL,1,'All Set Service',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(77,16,76,2,'Fiks ferdig',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(78,16,76,3,'Färdigfixat',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(79,16,76,4,'Fiks og færdig',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(80,16,76,5,'Kaikki valmiina -palvelu',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(81,17,NULL,1,'Terms of Use',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(82,17,81,2,'Bruksvilkår',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(83,17,81,3,'Användarvillkor',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(84,17,81,4,'Brugsvilkår',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(85,17,81,5,'Käyttöehdot',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(86,18,NULL,1,'Advertising Rules',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(87,18,86,2,'Annonseregler',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(88,18,86,3,'Annonsregler',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(89,18,86,4,'Annonce regler',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(90,18,86,5,'Mainonnan säännöt',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(91,19,NULL,1,'Accessibility',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:39','2025-10-13 07:33:39'),(92,19,91,2,'Tilgjengelighet',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:40','2025-10-13 07:33:40'),(93,19,91,3,'Tillgänglighet',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:40','2025-10-13 07:33:40'),(94,19,91,4,'Tilgængelighed',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:40','2025-10-13 07:33:40'),(95,19,91,5,'Saavutettavuus',NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:33:40','2025-10-13 07:33:40');
/*!40000 ALTER TABLE `subpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translation_categories`
--

DROP TABLE IF EXISTS `translation_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translation_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `total_keys` int NOT NULL DEFAULT '0',
  `completion_percentage` float NOT NULL DEFAULT '0',
  `last_updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translation_categories_key_unique` (`key`),
  KEY `translation_categories_is_active_sort_order_index` (`is_active`,`sort_order`),
  KEY `translation_categories_group_index` (`group`),
  KEY `translation_categories_completion_percentage_index` (`completion_percentage`),
  KEY `translation_categories_created_by_foreign` (`created_by`),
  KEY `translation_categories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `translation_categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `translation_categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation_categories`
--

LOCK TABLES `translation_categories` WRITE;
/*!40000 ALTER TABLE `translation_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `translation_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translation_keys`
--

DROP TABLE IF EXISTS `translation_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translation_keys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_key` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `context` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `example_usage` text COLLATE utf8mb4_unicode_ci,
  `placeholder_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `character_limit` int DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deprecated` tinyint(1) NOT NULL DEFAULT '0',
  `translation_count` int NOT NULL DEFAULT '0',
  `completion_percentage` float NOT NULL DEFAULT '0',
  `last_translated_at` timestamp NULL DEFAULT NULL,
  `related_keys` json DEFAULT NULL,
  `variables` json DEFAULT NULL,
  `fallback_key` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translation_keys_category_id_key_unique` (`category_id`,`key`),
  UNIQUE KEY `translation_keys_full_key_unique` (`full_key`),
  KEY `translation_keys_category_id_sort_order_index` (`category_id`,`sort_order`),
  KEY `translation_keys_is_active_is_required_index` (`is_active`,`is_required`),
  KEY `translation_keys_completion_percentage_index` (`completion_percentage`),
  KEY `translation_keys_full_key_index` (`full_key`),
  KEY `translation_keys_created_by_foreign` (`created_by`),
  KEY `translation_keys_updated_by_foreign` (`updated_by`),
  CONSTRAINT `translation_keys_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `translation_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `translation_keys_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `translation_keys_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation_keys`
--

LOCK TABLES `translation_keys` WRITE;
/*!40000 ALTER TABLE `translation_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `translation_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translation_values`
--

DROP TABLE IF EXISTS `translation_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translation_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `translation_key_id` bigint unsigned NOT NULL,
  `language_id` bigint unsigned NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_html` text COLLATE utf8mb4_unicode_ci,
  `plural_forms` json DEFAULT NULL,
  `status` enum('draft','review','approved','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_ai_generated` tinyint(1) NOT NULL DEFAULT '0',
  `needs_review` tinyint(1) NOT NULL DEFAULT '0',
  `quality_score` int DEFAULT NULL,
  `context_note` text COLLATE utf8mb4_unicode_ci,
  `usage_example` text COLLATE utf8mb4_unicode_ci,
  `screenshot_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` int NOT NULL DEFAULT '1',
  `change_reason` text COLLATE utf8mb4_unicode_ci,
  `revision_history` json DEFAULT NULL,
  `character_count` int NOT NULL DEFAULT '0',
  `word_count` int NOT NULL DEFAULT '0',
  `exceeds_limit` tinyint(1) NOT NULL DEFAULT '0',
  `translator_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `translator_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `translated_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `variables_used` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_translation_version` (`translation_key_id`,`language_id`,`version`),
  KEY `translation_values_translation_key_id_language_id_index` (`translation_key_id`,`language_id`),
  KEY `translation_values_language_id_status_index` (`language_id`,`status`),
  KEY `translation_values_status_needs_review_index` (`status`,`needs_review`),
  KEY `translation_values_is_verified_index` (`is_verified`),
  KEY `translation_values_quality_score_index` (`quality_score`),
  KEY `translation_values_version_index` (`version`),
  KEY `translation_values_created_by_foreign` (`created_by`),
  KEY `translation_values_updated_by_foreign` (`updated_by`),
  KEY `translation_values_reviewed_by_foreign` (`reviewed_by`),
  KEY `translation_values_approved_by_foreign` (`approved_by`),
  CONSTRAINT `translation_values_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `translation_values_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `translation_values_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `translation_values_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `translation_values_translation_key_id_foreign` FOREIGN KEY (`translation_key_id`) REFERENCES `translation_keys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `translation_values_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation_values`
--

LOCK TABLES `translation_values` WRITE;
/*!40000 ALTER TABLE `translation_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `translation_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_item_images`
--

DROP TABLE IF EXISTS `user_item_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_item_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_item_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_item_images`
--

LOCK TABLES `user_item_images` WRITE;
/*!40000 ALTER TABLE `user_item_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_item_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_items`
--

DROP TABLE IF EXISTS `user_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_product_type` int NOT NULL,
  `id_product_type_item` int NOT NULL,
  `id_user_location` int NOT NULL,
  `pri` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int NOT NULL,
  `price` int NOT NULL,
  `price_interval_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_interval_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_items`
--

LOCK TABLES `user_items` WRITE;
/*!40000 ALTER TABLE `user_items` DISABLE KEYS */;
INSERT INTO `user_items` VALUES (1,99999999,1,2,1,1,'Dagparkering i garasje','Har en ledig parkering mellom 8 og 17 i oslo',1,200,'week',1,'2025-10-13 07:34:04',NULL,NULL),(2,99999999,1,2,1,1,'Dagparkering langs gate','Har en ledig parkering mellom 8 og 17 i oslo',1,100,'month',1,'2025-10-13 07:34:04',NULL,NULL),(3,3,5,15,63,7,'Varehus / Lagerbygninger Deluxe','Utmerket for langtidslagring',1,17570,'month',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(4,6,1,5,3,9,'Premium Lagring motorsykkel','Ledig straks, fleksible avtaler',1,13720,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(5,6,1,5,74,0,'Lagring motorsykkel','Ledig straks, fleksible avtaler',1,3470,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(6,7,4,11,42,5,'Uthus og skur','Godt vedlikeholdt område',1,18070,'day',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(7,7,3,8,42,5,'Selvbetjente lagerenheter','Trygt og sikkert område',1,14290,'day',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(8,8,3,9,66,9,'Lagercontainere Deluxe','Trygt og sikkert område',1,8510,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(9,8,1,5,18,5,'Lagring motorsykkel','Perfekt størrelse for dine behov',1,7360,'week',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(10,8,4,12,18,4,'Professional Ekstra rom','Overvåket område med kameraer',0,8640,'month',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(11,9,2,6,14,0,'Båtopplag inne Pro','Ledig straks, fleksible avtaler',0,12440,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(12,9,1,5,14,7,'Premium Lagring motorsykkel','Utmerket for langtidslagring',0,3370,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(13,9,4,10,14,3,'Garasjer og boder Pro','Ledig straks, fleksible avtaler',1,3990,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(14,10,2,6,49,4,'Båtopplag inne Deluxe','Godt vedlikeholdt område',1,6960,'month',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(15,10,3,9,49,0,'Premium Lagercontainere','Tørr og ren lagringsplass',1,18610,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(16,11,5,16,52,3,'Professional Bedriftslagring','Godt vedlikeholdt område',1,6910,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(17,13,3,8,58,0,'Selvbetjente lagerenheter','Utmerket for langtidslagring',1,15820,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(18,16,3,8,7,0,'Professional Selvbetjente lagerenheter','Perfekt størrelse for dine behov',0,13200,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(19,16,1,4,31,1,'Lagring bobil Pro','Konkurransedyktige priser',1,16690,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(20,16,2,6,12,6,'Båtopplag inne Pro','Tørr og ren lagringsplass',0,19240,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(21,17,3,9,29,4,'Lagercontainere','Sentralt beliggende',0,9130,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(22,17,5,16,29,5,'Bedriftslagring Pro','Konkurransedyktige priser',0,19160,'day',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(23,17,4,10,29,10,'Premium Garasjer og boder','Perfekt størrelse for dine behov',1,2180,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(24,19,4,10,75,6,'Garasjer og boder Deluxe','Utmerket for langtidslagring',1,2050,'day',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(25,19,5,15,36,4,'Varehus / Lagerbygninger','Sentralt beliggende',1,10140,'day',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(26,19,4,11,33,1,'Professional Uthus og skur','Trygt og sikkert område',0,8250,'month',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(27,21,1,4,1,5,'Professional Lagring bobil','Godt vedlikeholdt område',1,11750,'week',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(28,21,1,4,8,6,'Professional Lagring bobil','Sentralt beliggende',1,1950,'month',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(29,21,5,15,1,3,'Premium Varehus / Lagerbygninger','Tørr og ren lagringsplass',1,9420,'day',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(30,22,4,10,38,9,'Premium Garasjer og boder','Godt vedlikeholdt område',1,11910,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(31,22,4,10,38,10,'Professional Garasjer og boder','Konkurransedyktige priser',0,1620,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(32,23,2,6,4,7,'Premium Båtopplag inne','Godt vedlikeholdt område',0,5660,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(33,23,4,10,55,1,'Premium Garasjer og boder','Sentralt beliggende',0,15850,'day',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(34,25,3,9,79,3,'Lagercontainere Pro','Trygt og sikkert område',0,15720,'day',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(35,25,2,6,23,4,'Professional Båtopplag inne','Tørr og ren lagringsplass',1,14540,'month',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(36,25,1,5,40,1,'Lagring motorsykkel','Ledig straks, fleksible avtaler',1,9480,'day',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(37,26,1,2,22,7,'Premium Langtidsparkering','Trygt og sikkert område',1,3540,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(38,26,2,6,22,10,'Båtopplag inne','Sentralt beliggende',0,8850,'week',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(39,27,4,12,45,9,'Ekstra rom Pro','Perfekt størrelse for dine behov',1,7590,'day',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(40,28,4,14,5,1,'Premium Loft','Perfekt størrelse for dine behov',1,10590,'month',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(41,30,3,9,65,2,'Lagercontainere Deluxe','Konkurransedyktige priser',0,4840,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(42,32,3,9,53,0,'Lagercontainere Pro','Konkurransedyktige priser',1,7930,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(43,33,3,8,82,7,'Premium Selvbetjente lagerenheter','Trygt og sikkert område',0,7010,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(44,34,5,16,15,10,'Premium Bedriftslagring','Perfekt størrelse for dine behov',1,14030,'month',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(45,34,4,13,21,7,'Professional Kjeller','Lett tilgjengelig lokasjon',1,11340,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(46,34,4,10,21,9,'Garasjer og boder Deluxe','Sentralt beliggende',1,11100,'month',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(47,35,5,15,30,10,'Varehus / Lagerbygninger','Trygt og sikkert område',0,13660,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(48,35,3,9,30,3,'Lagercontainere Pro','Konkurransedyktige priser',1,18370,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(49,35,1,1,30,2,'Parkeringsplasser Deluxe','Sentralt beliggende',0,17780,'month',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(50,37,1,3,20,4,'Professional Lagring bil','Godt vedlikeholdt område',1,14920,'week',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(51,38,4,13,76,0,'Professional Kjeller','Perfekt størrelse for dine behov',1,9730,'month',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(52,39,3,8,67,1,'Selvbetjente lagerenheter','Perfekt størrelse for dine behov',1,11580,'day',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(53,40,3,9,71,10,'Professional Lagercontainere','Utmerket for langtidslagring',1,17140,'day',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(54,40,1,1,71,4,'Parkeringsplasser Pro','Ledig straks, fleksible avtaler',1,18060,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(55,40,5,16,71,5,'Bedriftslagring','Trygt og sikkert område',1,1220,'month',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(56,42,4,10,44,6,'Premium Garasjer og boder','Sentralt beliggende',1,12310,'day',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(57,43,4,14,69,9,'Premium Loft','Tørr og ren lagringsplass',1,2200,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(58,43,4,14,59,0,'Loft Pro','Tørr og ren lagringsplass',1,12270,'week',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(59,44,1,3,61,10,'Lagring bil Pro','Ledig straks, fleksible avtaler',0,15560,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(60,47,5,15,10,5,'Varehus / Lagerbygninger','Ledig straks, fleksible avtaler',1,640,'week',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(61,47,1,2,10,8,'Premium Langtidsparkering','Tørr og ren lagringsplass',1,14020,'day',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(62,48,4,11,9,2,'Uthus og skur','Sentralt beliggende',1,16940,'week',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(63,48,4,14,9,1,'Premium Loft','Ledig straks, fleksible avtaler',1,6790,'week',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(64,48,1,3,9,10,'Professional Lagring bil','Sentralt beliggende',1,16380,'month',3,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(65,49,1,1,57,0,'Parkeringsplasser','Perfekt størrelse for dine behov',1,12360,'month',2,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(66,50,5,15,6,9,'Varehus / Lagerbygninger Deluxe','Sentralt beliggende',1,18740,'week',1,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL);
/*!40000 ALTER TABLE `user_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_locations`
--

DROP TABLE IF EXISTS `user_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `primary_location` int NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_instructions` text COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_locations`
--

LOCK TABLES `user_locations` WRITE;
/*!40000 ALTER TABLE `user_locations` DISABLE KEYS */;
INSERT INTO `user_locations` VALUES (1,21,1,'Location 1','Vollveien 3',NULL,'3183 Horten','Norway','','Norway',NULL,0,NULL,59.42545399,10.49286677,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(2,26,1,'Location 2','Fv310 23',NULL,'3181 Horten','Norway','','Norway',NULL,0,NULL,59.41912291,10.47836139,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(3,6,1,'Location 3','Rustadbrygga 1',NULL,'3187 Horten','Norway','','Norway',NULL,0,NULL,59.41113096,10.48617198,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(4,23,1,'Location 4','Åsen Terrasse 20',NULL,'3181 Horten','Norway','','Norway',NULL,0,NULL,59.41741987,10.47213866,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(5,28,1,'Location 5','Rådmann Knudsens gate 1',NULL,'3188 Horten','Norway','','Norway',NULL,0,NULL,59.41217919,10.47231032,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(6,50,1,'Location 6','Rustadgata 25',NULL,'3187 Horten','Norway','','Norway',NULL,0,NULL,59.40999534,10.48020675,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(7,16,1,'Location 7','Thranes gate 15',NULL,'3187 Horten','Norway','','Norway',NULL,0,NULL,59.41152405,10.48338248,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(8,21,1,'Location 8','Martin Rønnes gate 1',NULL,'3188 Horten','Norway','','Norway',NULL,0,NULL,59.41152405,10.46346976,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(9,48,1,'Location 9','Friggs gate 17',NULL,'3182 Horten','Norway','','Norway',NULL,0,NULL,59.40776766,10.47265365,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(10,47,1,'Location 10','Fjordveien 2A',NULL,'3187 Horten','Norway','','Norway',NULL,0,NULL,59.40478077,10.48015031,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(11,34,1,'Location 11','Granlyveien 7B',NULL,'3186 Horten','Norway','','Norway',NULL,0,NULL,59.39744086,10.46710405,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(12,16,1,'Location 12','Parkveien 34',NULL,'3186 Horten','Norway','','Norway',NULL,0,NULL,59.39748456,10.47697458,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(13,27,1,'Location 13','Langgrunnveien 35',NULL,'3186 Horten','Norway','','Norway',NULL,0,NULL,59.39145297,10.47594508,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(14,9,1,'Location 14','Sandeveien 3A',NULL,'3184 Borre','Norway','','Norway',NULL,0,NULL,59.38249279,10.45697650,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(15,34,1,'Location 15','Alfred Øverlands vei 14',NULL,'3184 Borre','Norway','','Norway',NULL,0,NULL,59.37949221,10.45149128,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(17,30,1,'Location 17','Fogdeveien 60A',NULL,'3184 Borre','Norway','','Norway',NULL,0,NULL,59.37573227,10.44505398,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(18,8,1,'Location 18','Steinbrygga 30',NULL,'3184 Borre','Norway','','Norway',NULL,0,NULL,59.37831181,10.46642582,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(19,25,1,'Location 19','Okerveien 5',NULL,'3179 Åsgårdstrand','Norway','','Norway',NULL,0,NULL,59.35780124,10.46325008,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(20,37,1,'Location 20','Even Ulvings vei 6',NULL,'3179 Åsgårdstrand','Norway','','Norway',NULL,0,NULL,59.35560209,10.46221500,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(21,34,1,'Location 21','Kimestadveien 22',NULL,'3184 Borre','Norway','','Norway',NULL,0,NULL,59.36483179,10.43843990,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(22,26,1,'Location 22','Flarenveien 4C',NULL,'3179 Åsgårdstrand','Norway','','Norway',NULL,0,NULL,59.34588960,10.46925886,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(23,25,1,'Location 23','Bjørkeveien 37',NULL,'3179 Åsgårdstrand','Norway','','Norway',NULL,0,NULL,59.34707113,10.45689924,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(24,11,1,'Location 24','Utsikten 8',NULL,'3179 Åsgårdstrand','Norway','','Norway',NULL,0,NULL,59.33971872,10.48058851,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(26,3,1,'Location 26','Orrestien 42',NULL,'3150 Tolvsrød','Norway','','Norway',NULL,0,NULL,59.28899831,10.49039358,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(27,40,1,'Location 27','Beles vei 39',NULL,'3150 Tolvsrød','Norway','','Norway',NULL,0,NULL,59.28058106,10.44885153,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(28,8,1,'Location 28','Grevinneveien 19D',NULL,'3117 Tønsberg','Norway','','Norway',NULL,0,NULL,59.27865182,10.42207235,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(29,17,1,'Location 29','Trimveien 7B',NULL,'3151 Tolvsrød','Norway','','Norway',NULL,0,NULL,59.27206237,10.46189779,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(30,35,1,'Location 30','Graabrødregaten 24B',NULL,'3110 Tønsberg','Norway','','Norway',NULL,0,NULL,59.26785191,10.40936941,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(31,16,1,'Location 31','Buddes Vei 18',NULL,'3120 Nøtterøy','Norway','','Norway',NULL,0,NULL,59.25416433,10.41657919,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(32,32,1,'Location 32','Øvre Fjellvei 35',NULL,'3121 Nøtterøy','Norway','','Norway',NULL,0,NULL,59.24854732,10.39391989,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(33,19,1,'Location 33','Fugleveien 28',NULL,'3142 Vestskogen','Norway','','Norway',NULL,0,NULL,59.24363168,10.38945669,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(34,38,1,'Location 34','Dueveien 21',NULL,'3142 Vestskogen','Norway','','Norway',NULL,0,NULL,59.24257823,10.39014334,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(35,39,1,'Location 35','Løvvangveien 11',NULL,'3120 Nøtterøy','Norway','','Norway',NULL,0,NULL,59.24064683,10.41829580,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(36,19,1,'Location 36','Dukenveien 36',NULL,'3133 Duken','Norway','','Norway',NULL,0,NULL,59.21306857,10.45606131,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(38,22,1,'Location 38','Ferjeodden 35',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.16574303,10.38808340,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(39,27,1,'Location 39','Hellveien 22',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.16539109,10.39906973,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(40,25,1,'Location 40','Grimestadstranda 24',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.13660759,10.41074270,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(42,7,1,'Location 42','Pytterønningen 41',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.11352781,10.40833944,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(43,26,1,'Location 43','Stauperveien 14',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.11634755,10.38980002,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(44,42,1,'Location 44','Flatåsveien 94',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.11564264,10.41383261,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(45,27,1,'Location 45','Ormeletveien 53',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.10876898,10.40696615,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(46,17,1,'Location 46','Lindholmveien 3',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.11493771,10.39288992,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(47,49,1,'Location 47','Goneveien 33C',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.10564059,10.39966964,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(48,39,1,'Location 48','Hvasserveien 168',NULL,'3148 Hvasser','Norway','','Norway',NULL,0,NULL,59.07760039,10.44224166,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(49,10,1,'Location 49','Toråsveien 4A',NULL,'3145 Tjøme','Norway','','Norway',NULL,0,NULL,59.07742397,10.40447616,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(50,39,1,'Location 50','Mesterfjellveien 48',NULL,'3258 Larvik','Norway','','Norway',NULL,0,NULL,59.05246893,10.04574299,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(51,33,1,'Location 51','Hovland alle 4',NULL,'3274 Larvik','Norway','','Norway',NULL,0,NULL,59.06588447,10.05226613,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(52,11,1,'Location 52','Heibergs gt. 13',NULL,'3257 Larvik','Norway','','Norway',NULL,0,NULL,59.05282204,10.03818989,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(53,32,1,'Location 53','Brekkeåsen 12',NULL,'3260 Larvik','Norway','','Norway',NULL,0,NULL,59.03410233,10.07732869,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(55,23,1,'Location 55','Gonveien 74',NULL,'3260 Larvik','Norway','','Norway',NULL,0,NULL,59.02509205,10.07458210,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(56,49,1,'Location 56','Fiskerveien 5',NULL,'3263 Larvik','Norway','','Norway',NULL,0,NULL,59.04434645,10.04471302,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(57,49,1,'Location 57','Utsiktsveien 1',NULL,'3292 Stavern','Norway','','Norway',NULL,0,NULL,59.00511967,10.02445698,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(58,13,1,'Location 58','Stavernsveien 232',NULL,'3267 Larvik','Norway','','Norway',NULL,0,NULL,59.03286576,10.00729084,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(59,43,1,'Location 59','Knappliveien 2B',NULL,'3290 Stavern','Norway','','Norway',NULL,0,NULL,58.99558146,10.02989544,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(60,6,1,'Location 60','Eikelundveien 54',NULL,'3290 Stavern','Norway','','Norway',NULL,0,NULL,58.99858773,10.01925243,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(61,44,1,'Location 61','Grøtvika 19',NULL,'3294 Stavern','Norway','','Norway',NULL,0,NULL,58.97205278,9.96260418,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(62,34,1,'Location 62','Kolbensrødveien 13',NULL,'3294 Stavern','Norway','','Norway',NULL,0,NULL,58.98850685,9.97359051,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(63,3,1,'Location 63','Lia 11',NULL,'3296 Nevlunghamn','Norway','','Norway',NULL,0,NULL,58.97356878,9.85805185,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(64,33,1,'Location 64','Amundrødbakken 10',NULL,'3295 Helgeroa','Norway','','Norway',NULL,0,NULL,58.98754578,9.86869486,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(65,30,1,'Location 65','Hyttesone I 367',NULL,'3295 Helgeroa','Norway','','Norway',NULL,0,NULL,58.98701512,9.84809549,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(66,8,1,'Location 66','Gjerpensgata 21',NULL,'3917 Porsgrunn','Norway','','Norway',NULL,0,NULL,59.13746301,9.66376805,'2025-10-13 07:34:05','2025-10-13 07:34:05',NULL),(67,39,1,'Location 67','Bedriftsvegen 27',NULL,'3735 Skien','Norway','','Norway',NULL,0,NULL,59.18076057,9.61089634,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(69,43,1,'Location 69','Mælagata 100',NULL,'3716 Skien','Norway','','Norway',NULL,0,NULL,59.22516394,9.59029698,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(70,11,1,'Location 70','Meensvegen 403',NULL,'3711 Skien','Norway','','Norway',NULL,0,NULL,59.16503311,9.69741368,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(71,40,1,'Location 71','Bærumsveien 132',NULL,'1358 Jar','Norway','','Norway',NULL,0,NULL,59.92415382,10.61086206,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(72,44,1,'Location 72','Skogveien 186',NULL,'1356 Bekkestua','Norway','','Norway',NULL,0,NULL,59.91038658,10.58682947,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(73,25,1,'Location 73','Fetsundgata 3',NULL,'0654 Oslo','Norway','','Norway',NULL,0,NULL,59.91417314,10.78046350,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(74,6,1,'Location 74','Avstikkeren 2',NULL,'1156 Oslo','Norway','','Norway',NULL,0,NULL,59.86836121,10.82646875,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(75,19,1,'Location 75','Seterhøyveien 5E',NULL,'1176 Oslo','Norway','','Norway',NULL,0,NULL,59.87525426,10.79076319,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(76,38,1,'Location 76','Kongleveien 2',NULL,'1452 Nesoddtangen','Norway','','Norway',NULL,0,NULL,59.85560531,10.66167383,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(77,19,1,'Location 77','Bjørn Farmanns gate 11A',NULL,'0271 Oslo','Norway','','Norway',NULL,0,NULL,59.91245203,10.70767908,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(79,25,1,'Location 79','Åsveien 12B',NULL,'1369 Stabekk','Norway','','Norway',NULL,0,NULL,59.91540785,10.62047510,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(80,30,1,'Location 80','Toftes Gate 25L',NULL,'0556 Oslo','Norway','','Norway',NULL,0,NULL,59.92814082,10.75986414,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(81,43,1,'Location 81','Biskop Jens Nilssøns gate 18A',NULL,'0659 Oslo','Norway','','Norway',NULL,0,NULL,59.90886740,10.79762964,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(82,33,1,'Location 82','Kleivveien 26',NULL,'1356 Bekkestua','Norway','','Norway',NULL,0,NULL,59.91299836,10.58408289,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL),(83,13,1,'Location 83','Simon Darres vei 75',NULL,'0669 Oslo','Norway','','Norway',NULL,0,NULL,59.91230990,10.82990198,'2025-10-13 07:34:06','2025-10-13 07:34:06',NULL);
/*!40000 ALTER TABLE `user_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (1,2,'Beverstien 20','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(2,3,'Jernbanegata 9','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(3,4,'Rørehagen 8','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(4,5,'Sørbygata 12','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(5,6,'Harestien 10','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(6,7,'Holtanveien 15','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(7,8,'Håkonsgate 19','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(8,9,'Eskebekkveien 9','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(9,10,'Kongsbakken 20','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(10,11,'Storgata 13','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(11,12,'Sørbygata 10','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(12,13,'Otto Engersgate 10','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(13,14,'Kongsbakken 20','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(14,15,'Rustadgata 4','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(15,16,'Østengen 18','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(16,17,'Sam Eydes gate 1','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(17,18,'Håkonsgate 1','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(18,19,'Øysteins gate 7','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(19,20,'Grønligata 18','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(20,21,'Nygata 19','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(21,22,'Tveitenveien 5','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(22,23,'Åsgata 8','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(23,24,'Tveitenveien 11','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(24,25,'Mullersgate 2','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(25,26,'Holtanveien 13','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(26,27,'Prestegata 16','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(27,28,'Gamleveien 20','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(28,29,'Storgata 19','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(29,30,'Åsgata 13','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(30,31,'Prestegata 16','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(31,32,'Storgata 4','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(32,33,'Kongeveien 13','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(33,34,'Sam Eydes gate 19','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(34,35,'Geddesgate 4','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(35,36,'Vipesvingen 1','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(36,37,'Rustadgata 6','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(37,38,'Granlyveien 18','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(38,39,'Winstings vei 13','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:03','2025-10-13 07:34:03',NULL),(39,40,'Sam Eydes gate 19','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(40,41,'Holtanveien 13','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(41,42,'Grønligata 14','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(42,43,'Pedersgata 6','Horten','Vestfold','3186','Norway',NULL,NULL,NULL,NULL,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL),(43,100000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-13 07:34:04','2025-10-13 07:34:04',NULL);
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=100000001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Finn Erik','Sjong','finneriksjong@berit.app','2025-10-13 07:33:41','$2y$12$D4ynYRSjyI2P/2f5T6jaWuyb8HNJDV0Bs5wKTzjxHox9GQo8.9yEK',NULL,0,NULL,'2025-10-13 07:33:41','2025-10-13 07:33:41',NULL),(3,'Jostein','Aasterud','josteinaasterud@berit.app','2025-10-13 07:33:41','$2y$12$84kaB0w5xU539tPgxdVLmuJJ5t/B9KkyiBptsBWEjkjRMaib.aPc2',NULL,0,NULL,'2025-10-13 07:33:42','2025-10-13 07:33:42',NULL),(4,'Bent','Walmestad','bentwalmestad@berit.app','2025-10-13 07:33:42','$2y$12$XeHXbksES4BX8s2xRKvyVOzH3fccyWnwMm6HrpULcAVLeih/0Txo6',NULL,0,NULL,'2025-10-13 07:33:42','2025-10-13 07:33:42',NULL),(5,'Berit','Abrahamsen','beritabrahamsen@berit.app','2025-10-13 07:33:42','$2y$12$T0ZEvhuAAQdFJA9Y3AiGHuJFRlSHSPjO2PUbcTZdRuhw7Chm2wBF.',NULL,0,NULL,'2025-10-13 07:33:42','2025-10-13 07:33:42',NULL),(6,'Bjørg','Aabye','bjrgaabye@berit.app','2025-10-13 07:33:42','$2y$12$9VXBQvS5yr/k9ge7WpLyN.030bTtoV3PBfiZRASN9zRZazN0pawGa',NULL,0,NULL,'2025-10-13 07:33:42','2025-10-13 07:33:42',NULL),(7,'Cecilie','Aamodt','cecilieaamodt@berit.app','2025-10-13 07:33:42','$2y$12$4D/MvDayOywPlnq/PFegSe.o/WdO0Bu0IK3x6kZD77zybVxsAq01i',NULL,0,NULL,'2025-10-13 07:33:43','2025-10-13 07:33:43',NULL),(8,'Dagfinn','Aanondson','dagfinnaanondson@berit.app','2025-10-13 07:33:43','$2y$12$lxLJ/99z85z9MJWykT3pXevR6RYo3zAsdpuRkyUwflRnygvoTmUsC',NULL,0,NULL,'2025-10-13 07:33:43','2025-10-13 07:33:43',NULL),(9,'Else','Aarsand','elseaarsand@berit.app','2025-10-13 07:33:43','$2y$12$Gap/2gqILNoAUsh9M3Ob6.Vk2JkkqA.ZiRP5UfkjVh2N9J0Khy5Fm',NULL,0,NULL,'2025-10-13 07:33:43','2025-10-13 07:33:43',NULL),(10,'Eirik','Aasheim','eirikaasheim@berit.app','2025-10-13 07:33:43','$2y$12$bgYms1gNe6Q672sHzMMKLeai0tcZ8e7YIvMwxLsxvi9hMDV6cIt0e',NULL,0,NULL,'2025-10-13 07:33:43','2025-10-13 07:33:43',NULL),(11,'Elin','Åsli','elinsli@berit.app','2025-10-13 07:33:43','$2y$12$aN/FTBL.YTazZLqMeTcyvuv2hijb/eTde4rrkJO4/a7TDwIqtQKG6',NULL,0,NULL,'2025-10-13 07:33:44','2025-10-13 07:33:44',NULL),(12,'Elling','Adalsteinsson','ellingadalsteinsson@berit.app','2025-10-13 07:33:44','$2y$12$f1Luh19ILZ0oYswOuSpZhev5.G/8G46I.kO2HoVL/f5H.qmqQDNhi',NULL,0,NULL,'2025-10-13 07:33:44','2025-10-13 07:33:44',NULL),(13,'Erling','Aadland','erlingaadland@berit.app','2025-10-13 07:33:44','$2y$12$T.ZXTLyr9T4I3jRo9vrHXOxkS5YdsdPfvodqmMMzIt4SS.Eyey7DK',NULL,0,NULL,'2025-10-13 07:33:44','2025-10-13 07:33:44',NULL),(14,'Frode','Aalvik','frodeaalvik@berit.app','2025-10-13 07:33:44','$2y$12$VpH69IymOjX0SH6l/YBiE.xM1Jo8WaK76MFe5ogNl/lAkFwpisaGS',NULL,0,NULL,'2025-10-13 07:33:44','2025-10-13 07:33:44',NULL),(15,'Guro','Aanesen','guroaanesen@berit.app','2025-10-13 07:33:44','$2y$12$2/jGGjtAf8j0wfJsn2yq.ujRTVOLz3mXSrbAs0e4FaJ8BKjra5Lg6',NULL,0,NULL,'2025-10-13 07:33:45','2025-10-13 07:33:45',NULL),(16,'Halvor','Aabøe','halvoraabe@berit.app','2025-10-13 07:33:45','$2y$12$i1ARizJQ3wAQ2bVCghH7MOTXfIebTNrBaNLFzhop4do3KmQRz/w2m',NULL,0,NULL,'2025-10-13 07:33:45','2025-10-13 07:33:45',NULL),(17,'Hege','Aastad','hegeaastad@berit.app','2025-10-13 07:33:45','$2y$12$t9d1eEQXrAYuLIgvjYDOnuy9II4LETk6HzKuNxq0JcKJwux.smFi2',NULL,0,NULL,'2025-10-13 07:33:45','2025-10-13 07:33:45',NULL),(18,'Henrik','Aarseth','henrikaarseth@berit.app','2025-10-13 07:33:45','$2y$12$4To6R7tB9ffXu1P/SOavPObTEyY5UuvdmLLNn9QUkGj4lSN69JHEe',NULL,0,NULL,'2025-10-13 07:33:45','2025-10-13 07:33:45',NULL),(19,'Ingrid','Abrahamsen','ingridabrahamsen@berit.app','2025-10-13 07:33:45','$2y$12$G6HCRfG.c87UYCxbNB8Br.oqRF9yz4if3tM9KNVG5hfZ1wRF3U22a',NULL,0,NULL,'2025-10-13 07:33:45','2025-10-13 07:33:45',NULL),(20,'Jan','Aabye','janaabye@berit.app','2025-10-13 07:33:45','$2y$12$EaYL6oZWa8QadyGDVjuAlOrntdGU8.NULazkwsEVCuGxmb11ubbS6',NULL,0,NULL,'2025-10-13 07:33:46','2025-10-13 07:33:46',NULL),(21,'Johan','Aamodt','johanaamodt@berit.app','2025-10-13 07:33:46','$2y$12$TUX//XzyXbtGwf1EY1dvautkgE6hDpRqk/fhYi1UuFMGOUU24W6QO',NULL,0,NULL,'2025-10-13 07:33:46','2025-10-13 07:33:46',NULL),(22,'Kari','Aanondson','kariaanondson@berit.app','2025-10-13 07:33:46','$2y$12$1GXs1jBYBgOV6OfkEwZb6.zcuHYSBTUK1CY2LnjB9sD743HMCn0DS',NULL,0,NULL,'2025-10-13 07:33:46','2025-10-13 07:33:46',NULL),(23,'Knut','Aarsand','knutaarsand@berit.app','2025-10-13 07:33:46','$2y$12$QMY.LmXXDl9CflttOpDKJu6UFaDBtB7Q7ybcC/B0/xpAMuoF3G6pi',NULL,0,NULL,'2025-10-13 07:33:46','2025-10-13 07:33:46',NULL),(24,'Laila','Aasheim','lailaaasheim@berit.app','2025-10-13 07:33:46','$2y$12$111fkSU5DRbWFnlBHQCQMu2J9GjnkksBP/ymioMwAazEugfi4Ubr.',NULL,0,NULL,'2025-10-13 07:33:47','2025-10-13 07:33:47',NULL),(25,'Leiv','Åsli','leivsli@berit.app','2025-10-13 07:33:47','$2y$12$.OwMrzNVDp4hV5WCBq/FM.kXXgSGVzGaqIJPAwfkMOCEeRS0jYaky',NULL,0,NULL,'2025-10-13 07:33:47','2025-10-13 07:33:47',NULL),(26,'Line','Adalsteinsson','lineadalsteinsson@berit.app','2025-10-13 07:33:47','$2y$12$54vjZaOE5Q0O6tsM3oxUCeb2s/5f9UK6KwFJ/SA5HKeGDz79/q.6S',NULL,0,NULL,'2025-10-13 07:33:47','2025-10-13 07:33:47',NULL),(27,'Magne','Aadland','magneaadland@berit.app','2025-10-13 07:33:47','$2y$12$i6iZiTLv6ymdf80XdAmyK.H05R47fNBCm3zV5/b91GLP2A7TqFREG',NULL,0,NULL,'2025-10-13 07:33:47','2025-10-13 07:33:47',NULL),(28,'Marit','Aalvik','maritaalvik@berit.app','2025-10-13 07:33:47','$2y$12$acq1OV.Op9i8ASjIrTXw5uVNoxtQasxEYFqIw8GX664JCD6iX4D/6',NULL,0,NULL,'2025-10-13 07:33:48','2025-10-13 07:33:48',NULL),(29,'Morten','Aanesen','mortenaanesen@berit.app','2025-10-13 07:33:48','$2y$12$rpBeY4AnNxIyAtkFn59kX.VHH3Zh64pkjhvF.DESg6pD50HEOWGXi',NULL,0,NULL,'2025-10-13 07:33:48','2025-10-13 07:33:48',NULL),(30,'Ole','Aabøe','oleaabe@berit.app','2025-10-13 07:33:48','$2y$12$dVHi3NvFFu5bUoYWEgwEEO13vlA1ufm4bHBD.6c7PP55nOoRUiGgO',NULL,0,NULL,'2025-10-13 07:33:48','2025-10-13 07:33:48',NULL),(31,'Odd','Aastad','oddaastad@berit.app','2025-10-13 07:33:48','$2y$12$LS7prfkpcJYoMkr4LGMdA.MDovo0RNunYw3tBbo4Hyx/kBCrBG62y',NULL,0,NULL,'2025-10-13 07:33:48','2025-10-13 07:33:48',NULL),(32,'Ragnhild','Aarseth','ragnhildaarseth@berit.app','2025-10-13 07:33:48','$2y$12$NNS5GGTOw67BVDG49rUtFOWK.0agCE74IcIA1.PoWfqPShDnA0kZi',NULL,0,NULL,'2025-10-13 07:33:49','2025-10-13 07:33:49',NULL),(33,'Reidun','Abrahamsen','reidunabrahamsen@berit.app','2025-10-13 07:33:49','$2y$12$g5lu/dvuG4x4ZVGjz5Grd.GB3QQKlUfNCCsKoIa7tdCkT.RLDezu.',NULL,0,NULL,'2025-10-13 07:33:49','2025-10-13 07:33:49',NULL),(34,'Sissel','Aabye','sisselaabye@berit.app','2025-10-13 07:33:49','$2y$12$s/2O/5FF3cg0io7eyk1sHe8DWoKABu0D1fWgp.W4dJql/PFQKMs/q',NULL,0,NULL,'2025-10-13 07:33:49','2025-10-13 07:33:49',NULL),(35,'Stein','Aamodt','steinaamodt@berit.app','2025-10-13 07:33:49','$2y$12$4iihOrGRlngKSWmaYWjlL.X66Pkzfa6S777slwArcMHXytTxPzJMm',NULL,0,NULL,'2025-10-13 07:33:49','2025-10-13 07:33:49',NULL),(36,'Svein','Aanondson','sveinaanondson@berit.app','2025-10-13 07:33:49','$2y$12$KdRJFdhHgJkakQsyfnMfNO8sSj5u39LgGMfZqI4eM9OlSCz/Flkw2',NULL,0,NULL,'2025-10-13 07:33:50','2025-10-13 07:33:50',NULL),(37,'Terje','Aarsand','terjeaarsand@berit.app','2025-10-13 07:33:50','$2y$12$YPshRElPCtQEQpnBwlcJkO67WobbhWQwxaszgp5vXBjs.GjXBjsK6',NULL,0,NULL,'2025-10-13 07:33:50','2025-10-13 07:33:50',NULL),(38,'Torstein','Aasheim','torsteinaasheim@berit.app','2025-10-13 07:33:50','$2y$12$czTSK6mV/NRIrwWpTGyDIOEWbKgxX/VPeax8.CIvxa8YB6lLGqjTu',NULL,0,NULL,'2025-10-13 07:33:50','2025-10-13 07:33:50',NULL),(39,'Trine','Åsli','trinesli@berit.app','2025-10-13 07:33:50','$2y$12$MWnhrC6FT.ri1.jU/caeGuIvZT38bNXpMa9kCWteKT4lMBrBKPXPe',NULL,0,NULL,'2025-10-13 07:33:50','2025-10-13 07:33:50',NULL),(40,'Vegar','Adalsteinsson','vegaradalsteinsson@berit.app','2025-10-13 07:33:50','$2y$12$uEPGYLrgqlEsmvYy6Lb26.7wMkWyo7pUtrU76tPZYiUFHAocl.8TW',NULL,0,NULL,'2025-10-13 07:33:50','2025-10-13 07:33:50',NULL),(41,'Vibeke','Aadland','vibekeaadland@berit.app','2025-10-13 07:33:50','$2y$12$w1qWL4DHOd5aN6iZKdbsn.dpia8dcm9uoTPjWiNxP3W5Zr6jHgh0.',NULL,0,NULL,'2025-10-13 07:33:51','2025-10-13 07:33:51',NULL),(42,'Yngve','Aalvik','yngveaalvik@berit.app','2025-10-13 07:33:51','$2y$12$gwIWN38a8xti0/.sPbZczOj8sjRrPZJBsqsmE8LGmbk6utZN3ZKpu',NULL,0,NULL,'2025-10-13 07:33:51','2025-10-13 07:33:51',NULL),(43,'Yrje','Aanesen','yrjeaanesen@berit.app','2025-10-13 07:33:51','$2y$12$LaeWDqQP105fCT9gmNocW.yjOiJOJgbXDlqvZ8fdutFcfzLt8jrSW',NULL,0,NULL,'2025-10-13 07:33:51','2025-10-13 07:33:51',NULL),(44,'Aslak','Andersen','aslakandersen@berit.app','2025-10-13 07:33:51','$2y$12$XujkQ3M8LnQYpY4ON1SrTelsi3E4q08hgLtUJTVetEpj6l2w0FXKi',NULL,0,NULL,'2025-10-13 07:33:51','2025-10-13 07:33:51',NULL),(46,'Tom-Erik','Paulsen','tomerikpaulsen@berit.app','2025-10-13 07:33:51','$2y$12$oqfW9xw7hAUTMZW6LS.YyeBTh35rCObCNekhL1bRbqz4PAzNoSgVK',NULL,0,NULL,'2025-10-13 07:33:52','2025-10-13 07:33:52',NULL),(47,'Arne','Andreassen','arneandreassen@berit.app','2025-10-13 07:33:52','$2y$12$ok6QbqzakXW7YdDbwwue1.CbZiniffY2rHB.zmIv6FUbHhzxr1Ife',NULL,0,NULL,'2025-10-13 07:33:52','2025-10-13 07:33:52',NULL),(48,'Bjørn','Aas','bjrnaas@berit.app','2025-10-13 07:33:52','$2y$12$9EeKEamhVY7YAUvZmGqG8eB9CYpScNLTGQOIyxIKPEY5xSVr2HxzS',NULL,0,NULL,'2025-10-13 07:33:52','2025-10-13 07:33:52',NULL),(49,'Bente','Aarseth','benteaarseth@berit.app','2025-10-13 07:33:52','$2y$12$NhMcOmnifd5qBitMXrzZPu2oTHAqysEPTiIU9D1B2Xe6VV47XTpfK',NULL,0,NULL,'2025-10-13 07:33:52','2025-10-13 07:33:52',NULL),(50,'Berit','Abrahamsen','beritabrahamsen1@berit.app','2025-10-13 07:33:52','$2y$12$vZj6.NcpAfcxrxXl6t1tPu3gBWcAn.QzAB50fRso2SpdzWqGHdkhi',NULL,0,NULL,'2025-10-13 07:33:53','2025-10-13 07:33:53',NULL),(51,'Bjørg','Aabye','bjrgaabye1@berit.app','2025-10-13 07:33:53','$2y$12$5iz15CM8mMQQwINgwrG5nuQZBLUyd0qYE9auFxjz9ejaaUNLQ/lla',NULL,0,NULL,'2025-10-13 07:33:53','2025-10-13 07:33:53',NULL),(52,'Cecilie','Aamodt','cecilieaamodt1@berit.app','2025-10-13 07:33:53','$2y$12$/Uw.Rk0jLRvtMxgBvo8lLu7ZNmJk2uC9.gUMILZ6T7rJsWLn1GZF2',NULL,0,NULL,'2025-10-13 07:33:53','2025-10-13 07:33:53',NULL),(53,'Dagfinn','Aanondson','dagfinnaanondson1@berit.app','2025-10-13 07:33:53','$2y$12$ijcZNHxywQG8q4TcKfvYGO3mmQ2qj/Oxrk/pM5gaZ7aOrIygoYEZi',NULL,0,NULL,'2025-10-13 07:33:53','2025-10-13 07:33:53',NULL),(54,'Else','Aarsand','elseaarsand1@berit.app','2025-10-13 07:33:53','$2y$12$LTPs6o1EZ7B0vb8qLjnVN.VLy6sSneqSc7xkLvw9H7Lf/PKvEjxWi',NULL,0,NULL,'2025-10-13 07:33:53','2025-10-13 07:33:53',NULL),(55,'Eirik','Aasheim','eirikaasheim1@berit.app','2025-10-13 07:33:53','$2y$12$ZsY.c7O6bx0MrKoHxDTL7On9wlMIzqVQYXtetcGfQoks8XViPS1G2',NULL,0,NULL,'2025-10-13 07:33:54','2025-10-13 07:33:54',NULL),(56,'Elin','Åsli','elinsli1@berit.app','2025-10-13 07:33:54','$2y$12$on1U7wMDYz5nxBHgXkwjgOlN95im8kT6YK2JLetNzETA76orhujl6',NULL,0,NULL,'2025-10-13 07:33:54','2025-10-13 07:33:54',NULL),(57,'Elling','Adalsteinsson','ellingadalsteinsson1@berit.app','2025-10-13 07:33:54','$2y$12$QQq.IOO/2CcC8zbQLCJAO.zVECCIBJfVcaEgXRNm6AFUh7yyoTHVa',NULL,0,NULL,'2025-10-13 07:33:54','2025-10-13 07:33:54',NULL),(58,'Erling','Aadland','erlingaadland1@berit.app','2025-10-13 07:33:54','$2y$12$CmO1lzSOjx9hBUdHjKe9F.gUTZreuLjGjH0MvdaITz66CvitS3XFG',NULL,0,NULL,'2025-10-13 07:33:54','2025-10-13 07:33:54',NULL),(59,'Frode','Aalvik','frodeaalvik1@berit.app','2025-10-13 07:33:54','$2y$12$52xHLT.S2XJmS46DepzxOOBpV1JKS0902XWqx6zkUcz88aYNK/mOu',NULL,0,NULL,'2025-10-13 07:33:55','2025-10-13 07:33:55',NULL),(60,'Guro','Aanesen','guroaanesen1@berit.app','2025-10-13 07:33:55','$2y$12$q1MQFTMfkAlQahVqZX7dpu6cz8.99J9aju7L8IXBLKkAks00ewuy.',NULL,0,NULL,'2025-10-13 07:33:55','2025-10-13 07:33:55',NULL),(61,'Halvor','Aabøe','halvoraabe1@berit.app','2025-10-13 07:33:55','$2y$12$xfEERUhTDhyzPhgO/Na8eOV46pEzNLh0OCt4qxVGE9KbH6Jul4sQi',NULL,0,NULL,'2025-10-13 07:33:55','2025-10-13 07:33:55',NULL),(62,'Hege','Aastad','hegeaastad1@berit.app','2025-10-13 07:33:55','$2y$12$ohH6OJe2i6JSdDoBy5I4cea8TjxFd.qe4tM7UtWEltm4F9Bkc6TDq',NULL,0,NULL,'2025-10-13 07:33:55','2025-10-13 07:33:55',NULL),(63,'Henrik','Aarseth','henrikaarseth1@berit.app','2025-10-13 07:33:55','$2y$12$SEne/gSmoGEHgRcTx9/3quaHJ4VPivIA0EionAB1MWgVcwpCO0rWW',NULL,0,NULL,'2025-10-13 07:33:56','2025-10-13 07:33:56',NULL),(64,'Ingrid','Abrahamsen','ingridabrahamsen1@berit.app','2025-10-13 07:33:56','$2y$12$3lAJF0Gxm6WwLn6A8MAn4eGv.o5Oc8yjGd1E5tGTk4FIsljQCJUZa',NULL,0,NULL,'2025-10-13 07:33:56','2025-10-13 07:33:56',NULL),(65,'Jan','Aabye','janaabye1@berit.app','2025-10-13 07:33:56','$2y$12$1.o0I4l2uEitpKYMIjrHTuiaDW55K.UTuUfYSHwe5UeQWFn4d65jK',NULL,0,NULL,'2025-10-13 07:33:56','2025-10-13 07:33:56',NULL),(66,'Johan','Aamodt','johanaamodt1@berit.app','2025-10-13 07:33:56','$2y$12$wDq5ngKWF9ZG.mDGTDYWWu8137idksbpd0tsJwkAogqre9rXHRxqu',NULL,0,NULL,'2025-10-13 07:33:56','2025-10-13 07:33:56',NULL),(67,'Kari','Aanondson','kariaanondson1@berit.app','2025-10-13 07:33:56','$2y$12$5ZMDRz53jGVdMrviIL6cxeeoAoE9neJVIIXDJ2VZ165xdBvJmK7Hi',NULL,0,NULL,'2025-10-13 07:33:57','2025-10-13 07:33:57',NULL),(68,'Knut','Aarsand','knutaarsand1@berit.app','2025-10-13 07:33:57','$2y$12$eikmPHgsjW4ZDUHeK.2v5etk2QQzlC1.MZbYrivSmvi1slLBpYuzC',NULL,0,NULL,'2025-10-13 07:33:57','2025-10-13 07:33:57',NULL),(69,'Laila','Aasheim','lailaaasheim1@berit.app','2025-10-13 07:33:57','$2y$12$1qD3a0ano8ZhdOcIdqheaunpz71BRzMzahQmkGL69oHiDWhC3CTsC',NULL,0,NULL,'2025-10-13 07:33:57','2025-10-13 07:33:57',NULL),(70,'Leiv','Åsli','leivsli1@berit.app','2025-10-13 07:33:57','$2y$12$uTKZ.Z9xh16Bfeaj7b.fkOuL3WfBFxAf6q/eqy8uqAmriBV7cMxQ.',NULL,0,NULL,'2025-10-13 07:33:57','2025-10-13 07:33:57',NULL),(71,'Line','Adalsteinsson','lineadalsteinsson1@berit.app','2025-10-13 07:33:57','$2y$12$60Q1hLikzaI8ZQimyQQfquDSFAk6DNX4nHQCBnZL28Tfm.ErZlp5e',NULL,0,NULL,'2025-10-13 07:33:57','2025-10-13 07:33:57',NULL),(72,'Magne','Aadland','magneaadland1@berit.app','2025-10-13 07:33:57','$2y$12$5I/18rBw7iXofIqXflACd.rboh618CsfYlesDuXHHSB6k3iSfD.ce',NULL,0,NULL,'2025-10-13 07:33:58','2025-10-13 07:33:58',NULL),(73,'Marit','Aalvik','maritaalvik1@berit.app','2025-10-13 07:33:58','$2y$12$kDPMnBE9.epDDAwk9DXOt.OKqLCHNL/12q/SQiFHnzpliuZr2bv6W',NULL,0,NULL,'2025-10-13 07:33:58','2025-10-13 07:33:58',NULL),(74,'Morten','Aanesen','mortenaanesen1@berit.app','2025-10-13 07:33:58','$2y$12$8tTkLxT/eLGtrcsYM8rYv.dBUiuPFrP8Se7fSlPceT9cVsthPQfUm',NULL,0,NULL,'2025-10-13 07:33:58','2025-10-13 07:33:58',NULL),(75,'Ole','Aabøe','oleaabe1@berit.app','2025-10-13 07:33:58','$2y$12$TFLQe4HHMkzwdZwsBUvVw./Nw1GNPm.sY3qH17dmxm.ucnamgEVQq',NULL,0,NULL,'2025-10-13 07:33:58','2025-10-13 07:33:58',NULL),(76,'Odd','Aastad','oddaastad1@berit.app','2025-10-13 07:33:58','$2y$12$If48EHFuNManL53ZI.F9Y.fxGqTt5OKE5HQwMgEgv2IUG2ffcD9/e',NULL,0,NULL,'2025-10-13 07:33:59','2025-10-13 07:33:59',NULL),(77,'Ragnhild','Aarseth','ragnhildaarseth1@berit.app','2025-10-13 07:33:59','$2y$12$sKBIakC.ie5.r2/pKr4VuuqtlRWu.P5nU5SibnyoufGCwybP5TDZ6',NULL,0,NULL,'2025-10-13 07:33:59','2025-10-13 07:33:59',NULL),(78,'Reidun','Abrahamsen','reidunabrahamsen1@berit.app','2025-10-13 07:33:59','$2y$12$sYq4K0GWSzMl3SDUGYpuku8uVrVDHEO22XqjpleOsrtK/vaSJVE4W',NULL,0,NULL,'2025-10-13 07:33:59','2025-10-13 07:33:59',NULL),(79,'Sissel','Aabye','sisselaabye1@berit.app','2025-10-13 07:33:59','$2y$12$I0mwO9PTe9EVpXuk8lTtEuslXamKZeGmGzjISqcH4rPiaZlY8YB2O',NULL,0,NULL,'2025-10-13 07:33:59','2025-10-13 07:33:59',NULL),(80,'Stein','Aamodt','steinaamodt1@berit.app','2025-10-13 07:33:59','$2y$12$gtfiZ3tDWXDnW6EDviOyVuWWAnv4a8i41tR2fOnx4EP4txSJOnkRG',NULL,0,NULL,'2025-10-13 07:34:00','2025-10-13 07:34:00',NULL),(81,'Svein','Aanondson','sveinaanondson1@berit.app','2025-10-13 07:34:00','$2y$12$5Ze80Adf0NdxzzCwxTfyteK8DX/bALDm4MeVBXfppeMaqTlIMeA4O',NULL,0,NULL,'2025-10-13 07:34:00','2025-10-13 07:34:00',NULL),(82,'Terje','Aarsand','terjeaarsand1@berit.app','2025-10-13 07:34:00','$2y$12$aF/0so9QiK4l7mPllASXie2bSp9bEMiNTrSOmFzj4kE.jWwU3HPDG',NULL,0,NULL,'2025-10-13 07:34:00','2025-10-13 07:34:00',NULL),(83,'Torstein','Aasheim','torsteinaasheim1@berit.app','2025-10-13 07:34:00','$2y$12$tjKdIdhECpiejmisn3gjNeV/I2q4ScULh5wz2Znz/FLvA7W.xRVhu',NULL,0,NULL,'2025-10-13 07:34:00','2025-10-13 07:34:00',NULL),(84,'Trine','Åsli','trinesli1@berit.app','2025-10-13 07:34:00','$2y$12$446c2GEoh2.HjFONr9ln2uZ4luyPwdKRkHSs1vdYjATfbZAs00e3W',NULL,0,NULL,'2025-10-13 07:34:00','2025-10-13 07:34:00',NULL),(85,'Vegar','Adalsteinsson','vegaradalsteinsson1@berit.app','2025-10-13 07:34:00','$2y$12$50JvDWy63lAz.a3G.LSpMe0p9i3vsLPDS8X6JmuBmsqRGL.Pn655i',NULL,0,NULL,'2025-10-13 07:34:01','2025-10-13 07:34:01',NULL),(86,'Vibeke','Aadland','vibekeaadland1@berit.app','2025-10-13 07:34:01','$2y$12$zL/FlhmbRqt13Iz.X4ymLOMAcnMmaS35SkBh0XQQFwy7Iuibi2fs.',NULL,0,NULL,'2025-10-13 07:34:01','2025-10-13 07:34:01',NULL),(87,'Yngve','Aalvik','yngveaalvik1@berit.app','2025-10-13 07:34:01','$2y$12$nqPFyW51HphzoVk0990TTOfph49jQAcuDUz4xjmWL/hJ8/nGTXFQO',NULL,0,NULL,'2025-10-13 07:34:01','2025-10-13 07:34:01',NULL),(88,'Yrje','Aanesen','yrjeaanesen1@berit.app','2025-10-13 07:34:01','$2y$12$diqt6F0gnd1sH.GAB4i4FOqlsiy0aKOXu7PMr5ZeE4nySBJxq2dga',NULL,0,NULL,'2025-10-13 07:34:01','2025-10-13 07:34:01',NULL),(89,'Aslak','Andersen','aslakandersen1@berit.app','2025-10-13 07:34:01','$2y$12$imGXZb1a6oY5V7R0PeWif.vxJaM7GLraK0C1UtTk123cv/Z188Aje',NULL,0,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL),(99999999,'Tom-Erik','Paulsen','tomerikpaulsen1@berit.app','2025-10-13 07:34:02','$2y$12$EYgbjlsU1.k0HyRcj6K0CuXFgPAgxujREMYeLSBOQzYA2OckFEbky','93217356',1,NULL,'2025-10-13 07:33:41','2025-10-13 07:34:02',NULL),(100000000,'Tom Erik Paulsen','Paulsen','tomerikpaulsenpaulsen@berit.app','2025-10-13 07:34:02','$2y$12$lTUGV5j/2Jnx3qfFJMiYB.REY5PzSOPqRqpl8wzy/7njotIFliOd6',NULL,0,NULL,'2025-10-13 07:34:02','2025-10-13 07:34:02',NULL);
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

-- Dump completed on 2025-10-14 12:21:02
