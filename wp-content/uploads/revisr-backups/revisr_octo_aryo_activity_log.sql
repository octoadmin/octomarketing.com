
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
DROP TABLE IF EXISTS `octo_aryo_activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `octo_aryo_activity_log` (
  `histid` int(11) NOT NULL AUTO_INCREMENT,
  `user_caps` varchar(70) NOT NULL DEFAULT 'guest',
  `action` varchar(255) NOT NULL,
  `object_type` varchar(255) NOT NULL,
  `object_subtype` varchar(255) NOT NULL DEFAULT '',
  `object_name` varchar(255) NOT NULL,
  `object_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `hist_ip` varchar(55) NOT NULL DEFAULT '127.0.0.1',
  `hist_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`histid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `octo_aryo_activity_log` WRITE;
/*!40000 ALTER TABLE `octo_aryo_activity_log` DISABLE KEYS */;
INSERT INTO `octo_aryo_activity_log` VALUES (1,'administrator','activated','Plugin','','Activity Log',0,1,'::1',1468449728),(2,'administrator','activated','Plugin','','Better Search Replace',0,1,'::1',1468450162),(3,'administrator','activated','Plugin','','MiwoFTP',0,1,'::1',1468450192),(4,'administrator','deactivated','Plugin','','Admin Menu Editor',0,1,'::1',1468450381),(5,'guest','logged_in','User','','ian-lancaster',1,1,'::1',1468452073),(6,'guest','logged_in','User','','ian-lancaster',1,1,'::1',1468452174);
/*!40000 ALTER TABLE `octo_aryo_activity_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

