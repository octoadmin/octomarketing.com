
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
DROP TABLE IF EXISTS `9702313174postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `9702313174postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `9702313174postmeta` WRITE;
/*!40000 ALTER TABLE `9702313174postmeta` DISABLE KEYS */;
INSERT INTO `9702313174postmeta` VALUES (1,2,'_wp_page_template','default'),(19,12,'_et_pb_predefined_default_type','home'),(21,13,'_et_pb_predefined_default_layout','on'),(15,10,'_et_pb_built_for_post_type','layout'),(16,11,'_et_pb_predefined_layout','on'),(18,12,'_et_pb_predefined_default_layout','on'),(13,9,'_et_pb_built_for_post_type','layout'),(12,9,'_et_pb_predefined_layout','on'),(10,8,'_et_pb_predefined_layout','on'),(11,8,'_et_pb_built_for_post_type','layout'),(14,10,'_et_pb_predefined_layout','on'),(17,11,'_et_pb_built_for_post_type','layout'),(20,12,'_extra_layout_home','1'),(22,13,'_et_pb_predefined_default_type','index'),(23,14,'_et_pb_predefined_layout','on'),(24,13,'_extra_layout_default','1'),(25,14,'_et_pb_built_for_post_type','layout'),(26,15,'_et_pb_predefined_layout','on'),(27,15,'_et_pb_built_for_post_type','layout'),(28,16,'_et_pb_predefined_layout','on'),(29,16,'_et_pb_built_for_post_type','layout'),(30,17,'_et_pb_predefined_layout','on'),(31,17,'_et_pb_built_for_post_type','layout'),(32,18,'_et_pb_predefined_layout','on'),(33,18,'_et_pb_built_for_post_type','layout'),(34,19,'_et_pb_predefined_layout','on'),(35,19,'_et_pb_built_for_post_type','layout'),(36,20,'_et_pb_predefined_layout','on'),(37,20,'_et_pb_built_for_post_type','layout'),(38,21,'_et_pb_predefined_layout','on'),(39,21,'_et_pb_built_for_post_type','layout');
/*!40000 ALTER TABLE `9702313174postmeta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

