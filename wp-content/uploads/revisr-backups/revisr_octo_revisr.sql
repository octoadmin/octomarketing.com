
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
DROP TABLE IF EXISTS `octo_revisr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `octo_revisr` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text,
  `event` varchar(42) NOT NULL,
  `user` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `octo_revisr` WRITE;
/*!40000 ALTER TABLE `octo_revisr` DISABLE KEYS */;
INSERT INTO `octo_revisr` VALUES (1,'2016-07-13 08:59:47','Error backing up the database.','error','ian.lancaster'),(2,'2016-07-13 08:59:53','Committed <a href=\"http://localhost/octomarketing.com/wp-admin/admin.php?page=revisr_view_commit&commit=b1acc0b&success=true\">#b1acc0b</a> to the local repository.','commit','ian.lancaster'),(3,'2016-07-13 09:00:01','Successfully pushed 1 commit to origin/master.','push','ian.lancaster'),(4,'2016-07-13 09:31:01','Error backing up the database.','error','Revisr Bot'),(5,'2016-07-13 09:31:01','The daily backup was successful.','backup','Revisr Bot'),(6,'2016-07-13 09:38:54','Successfully pushed 0 commits to origin/master.','push','ian.lancaster'),(7,'2016-07-13 09:38:54','Error contacting webhook URL.','error','ian.lancaster'),(8,'2016-07-13 09:44:37','Error backing up the database.','error','ian.lancaster');
/*!40000 ALTER TABLE `octo_revisr` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

