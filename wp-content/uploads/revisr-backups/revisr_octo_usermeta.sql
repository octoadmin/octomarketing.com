
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
DROP TABLE IF EXISTS `octo_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `octo_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `octo_usermeta` WRITE;
/*!40000 ALTER TABLE `octo_usermeta` DISABLE KEYS */;
INSERT INTO `octo_usermeta` VALUES (1,1,'nickname','ian.lancaster'),(2,1,'first_name',''),(3,1,'last_name',''),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'comment_shortcuts','false'),(7,1,'admin_color','midnight'),(8,1,'use_ssl','0'),(9,1,'show_admin_bar_front','true'),(10,1,'octo_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(11,1,'octo_user_level','10'),(12,1,'dismissed_wp_pointers','wpe_admin_pointers_1_0_toggle_toolbar,wpmudcs1'),(13,1,'show_welcome_panel','0'),(15,1,'octo_dashboard_quick_press_last_post_id','497'),(16,1,'wporg_favorites',''),(17,1,'closedpostboxes_wck_page_sas-page','a:0:{}'),(18,1,'metaboxhidden_wck_page_sas-page','a:0:{}'),(19,1,'closedpostboxes_dashboard','a:0:{}'),(20,1,'metaboxhidden_dashboard','a:6:{i:0;s:19:\"dashboard_right_now\";i:1;s:18:\"dashboard_activity\";i:2;s:33:\"jwl_user_tinymce_dashboard_widget\";i:3;s:21:\"dashboard_quick_press\";i:4;s:17:\"dashboard_primary\";i:5;s:22:\"tribe_dashboard_widget\";}'),(21,1,'octo_user-settings','editor=tinymce&hidetb=1&advImgDetails=show&libraryContent=browse&wplink=1&posts_list_mode=list&post_dfw=off'),(22,1,'octo_user-settings-time','1468333765'),(23,1,'closedpostboxes_knowledgebase','a:14:{i:0;s:31:\"builtwith_technology_profilediv\";i:1;s:11:\"categorydiv\";i:2;s:16:\"tagsdiv-post_tag\";i:3;s:15:\"content_typediv\";i:4;s:19:\"creative_conceptdiv\";i:5;s:18:\"target_audiencediv\";i:6;s:14:\"buyer_phasediv\";i:7;s:14:\"skill_leveldiv\";i:8;s:13:\"media_typediv\";i:9;s:19:\"message_strategydiv\";i:10;s:7:\"tonediv\";i:11;s:7:\"lookdiv\";i:12;s:15:\"distributiondiv\";i:13;s:11:\"locationdiv\";}'),(24,1,'metaboxhidden_knowledgebase','a:2:{i:0;s:13:\"pageparentdiv\";i:1;s:7:\"slugdiv\";}'),(25,1,'meta-box-order_knowledgebase','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:247:\"submitdiv,pageparentdiv,categorydiv,builtwith_technology_profilediv,tagsdiv-post_tag,media_typediv,content_typediv,message_strategydiv,creative_conceptdiv,skill_leveldiv,tonediv,lookdiv,target_audiencediv,buyer_phasediv,distributiondiv,locationdiv\";s:6:\"normal\";s:7:\"slugdiv\";s:8:\"advanced\";s:0:\"\";}'),(26,1,'screen_layout_knowledgebase','2'),(27,1,'closedpostboxes_post','a:14:{i:0;s:11:\"categorydiv\";i:1;s:31:\"builtwith_technology_profilediv\";i:2;s:16:\"tagsdiv-post_tag\";i:3;s:15:\"content_typediv\";i:4;s:19:\"creative_conceptdiv\";i:5;s:18:\"target_audiencediv\";i:6;s:14:\"buyer_phasediv\";i:7;s:14:\"skill_leveldiv\";i:8;s:13:\"media_typediv\";i:9;s:19:\"message_strategydiv\";i:10;s:7:\"tonediv\";i:11;s:7:\"lookdiv\";i:12;s:15:\"distributiondiv\";i:13;s:11:\"locationdiv\";}'),(28,1,'metaboxhidden_post','a:19:{i:0;s:24:\"extra-page-post-settings\";i:1;s:14:\"et-post-format\";i:2;s:7:\"acf_184\";i:3;s:17:\"customsidebars-mb\";i:4;s:7:\"acf_459\";i:5;s:12:\"et_pb_layout\";i:6;s:11:\"postexcerpt\";i:7;s:12:\"postimagediv\";i:8;s:13:\"trackbacksdiv\";i:9;s:10:\"postcustom\";i:10;s:16:\"commentstatusdiv\";i:11;s:7:\"slugdiv\";i:12;s:19:\"gallery-post-format\";i:13;s:17:\"audio-post-format\";i:14;s:17:\"quote-post-format\";i:15;s:16:\"link-post-format\";i:16;s:17:\"video-post-format\";i:17;s:15:\"map-post-format\";i:18;s:15:\"post-review-box\";}'),(29,1,'octo_media_library_mode','list'),(30,1,'closedpostboxes_page','a:13:{i:0;s:24:\"extra-page-post-settings\";i:1;s:13:\"pageparentdiv\";i:2;s:11:\"categorydiv\";i:3;s:16:\"tagsdiv-post_tag\";i:4;s:31:\"builtwith_technology_profilediv\";i:5;s:18:\"target_audiencediv\";i:6;s:14:\"buyer_phasediv\";i:7;s:14:\"skill_leveldiv\";i:8;s:13:\"media_typediv\";i:9;s:19:\"message_strategydiv\";i:10;s:7:\"tonediv\";i:11;s:7:\"lookdiv\";i:12;s:11:\"locationdiv\";}'),(31,1,'metaboxhidden_page','a:14:{i:0;s:9:\"authordiv\";i:1;s:15:\"content_typediv\";i:2;s:19:\"creative_conceptdiv\";i:3;s:12:\"postimagediv\";i:4;s:12:\"et_pb_layout\";i:5;s:21:\"authors-page-template\";i:6;s:23:\"blog-feed-page-template\";i:7;s:21:\"sitemap-page-template\";i:8;s:23:\"portfolio-page-template\";i:9;s:21:\"contact-page-template\";i:10;s:11:\"postexcerpt\";i:11;s:10:\"postcustom\";i:12;s:16:\"commentstatusdiv\";i:13;s:7:\"slugdiv\";}'),(32,1,'closedpostboxes_operationshandbook','a:7:{i:0;s:11:\"categorydiv\";i:1;s:31:\"builtwith_technology_profilediv\";i:2;s:16:\"tagsdiv-post_tag\";i:3;s:14:\"skill_leveldiv\";i:4;s:13:\"media_typediv\";i:5;s:7:\"tonediv\";i:6;s:15:\"distributiondiv\";}'),(33,1,'metaboxhidden_operationshandbook','a:3:{i:0;s:11:\"postexcerpt\";i:1;s:10:\"postcustom\";i:2;s:7:\"slugdiv\";}'),(34,1,'meta-box-order_page','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:279:\"submitdiv,authordiv,extra-page-post-settings,pageparentdiv,categorydiv,tagsdiv-post_tag,content_typediv,creative_conceptdiv,postimagediv,builtwith_technology_profilediv,target_audiencediv,buyer_phasediv,skill_leveldiv,media_typediv,message_strategydiv,tonediv,lookdiv,locationdiv\";s:6:\"normal\";s:174:\"et_pb_layout,authors-page-template,blog-feed-page-template,sitemap-page-template,portfolio-page-template,contact-page-template,postexcerpt,postcustom,commentstatusdiv,slugdiv\";s:8:\"advanced\";s:0:\"\";}'),(35,1,'screen_layout_page','2'),(36,1,'meta-box-order_post','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:323:\"submitdiv,categorydiv,builtwith_technology_profilediv,tagsdiv-post_tag,content_typediv,extra-page-post-settings,et-post-format,tagsdiv-creative_concept,tagsdiv-target_audience,tagsdiv-buyer_phase,tagsdiv-skill_level,tagsdiv-media_type,tagsdiv-message_strategy,tagsdiv-tone,tagsdiv-look,tagsdiv-distribution,tagsdiv-location\";s:6:\"normal\";s:97:\"et_pb_layout,postexcerpt,authordiv,postimagediv,trackbacksdiv,postcustom,commentstatusdiv,slugdiv\";s:8:\"advanced\";s:122:\"gallery-post-format,audio-post-format,quote-post-format,link-post-format,video-post-format,map-post-format,post-review-box\";}'),(37,1,'screen_layout_post','2'),(38,1,'meta-box-order_operationshandbook','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:123:\"submitdiv,categorydiv,builtwith_technology_profilediv,tagsdiv-post_tag,media_typediv,skill_leveldiv,tonediv,distributiondiv\";s:6:\"normal\";s:40:\"postexcerpt,postcustom,slugdiv,authordiv\";s:8:\"advanced\";s:0:\"\";}'),(39,1,'screen_layout_operationshandbook','2'),(40,1,'closedpostboxes_tribe_events','a:9:{i:0;s:16:\"tagsdiv-post_tag\";i:1;s:31:\"builtwith_technology_profilediv\";i:2;s:19:\"creative_conceptdiv\";i:3;s:18:\"target_audiencediv\";i:4;s:14:\"skill_leveldiv\";i:5;s:19:\"message_strategydiv\";i:6;s:11:\"locationdiv\";i:7;s:19:\"tribe_events_catdiv\";i:8;s:12:\"postimagediv\";}'),(41,1,'metaboxhidden_tribe_events','a:5:{i:0;s:11:\"postexcerpt\";i:1;s:10:\"postcustom\";i:2;s:16:\"commentstatusdiv\";i:3;s:7:\"slugdiv\";i:4;s:9:\"authordiv\";}'),(42,1,'meta-box-order_tribe_events','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:164:\"submitdiv,tribe_events_catdiv,builtwith_technology_profilediv,tagsdiv-post_tag,creative_conceptdiv,target_audiencediv,skill_leveldiv,message_strategydiv,locationdiv\";s:6:\"normal\";s:124:\"postimagediv,tribe_events_event_details,tribe_events_event_options,postexcerpt,postcustom,commentstatusdiv,slugdiv,authordiv\";s:8:\"advanced\";s:0:\"\";}'),(43,1,'screen_layout_tribe_events','2'),(44,1,'closedpostboxes_human_resources','a:10:{i:0;s:11:\"categorydiv\";i:1;s:31:\"builtwith_technology_profilediv\";i:2;s:16:\"tagsdiv-post_tag\";i:3;s:15:\"content_typediv\";i:4;s:19:\"creative_conceptdiv\";i:5;s:14:\"skill_leveldiv\";i:6;s:7:\"tonediv\";i:7;s:15:\"distributiondiv\";i:8;s:11:\"locationdiv\";i:9;s:12:\"postimagediv\";}'),(45,1,'metaboxhidden_human_resources','a:7:{i:0;s:13:\"pageparentdiv\";i:1;s:11:\"postexcerpt\";i:2;s:13:\"trackbacksdiv\";i:3;s:10:\"postcustom\";i:4;s:16:\"commentstatusdiv\";i:5;s:7:\"slugdiv\";i:6;s:9:\"authordiv\";}'),(46,1,'meta-box-order_human_resources','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:171:\"submitdiv,categorydiv,builtwith_technology_profilediv,tagsdiv-post_tag,content_typediv,creative_conceptdiv,skill_leveldiv,tonediv,distributiondiv,locationdiv,pageparentdiv\";s:6:\"normal\";s:84:\"postexcerpt,trackbacksdiv,postcustom,commentstatusdiv,slugdiv,authordiv,postimagediv\";s:8:\"advanced\";s:0:\"\";}'),(47,1,'screen_layout_human_resources','2'),(48,1,'closedpostboxes_vendors','a:8:{i:0;s:11:\"categorydiv\";i:1;s:31:\"builtwith_technology_profilediv\";i:2;s:16:\"tagsdiv-post_tag\";i:3;s:18:\"target_audiencediv\";i:4;s:14:\"skill_leveldiv\";i:5;s:11:\"locationdiv\";i:6;s:13:\"pageparentdiv\";i:7;s:12:\"postimagediv\";}'),(49,1,'metaboxhidden_vendors','a:7:{i:0;s:13:\"pageparentdiv\";i:1;s:11:\"postexcerpt\";i:2;s:13:\"trackbacksdiv\";i:3;s:10:\"postcustom\";i:4;s:16:\"commentstatusdiv\";i:5;s:7:\"slugdiv\";i:6;s:9:\"authordiv\";}'),(50,1,'meta-box-order_vendors','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:130:\"submitdiv,categorydiv,builtwith_technology_profilediv,tagsdiv-post_tag,target_audiencediv,skill_leveldiv,locationdiv,pageparentdiv\";s:6:\"normal\";s:84:\"postexcerpt,trackbacksdiv,postcustom,commentstatusdiv,slugdiv,authordiv,postimagediv\";s:8:\"advanced\";s:0:\"\";}'),(51,1,'screen_layout_vendors','2'),(52,1,'meta-box-order_dashboard','a:4:{s:6:\"normal\";s:104:\"note_506,dashboard_right_now,dashboard_activity,jetpack_summary_widget,jwl_user_tinymce_dashboard_widget\";s:4:\"side\";s:62:\"dashboard_quick_press,dashboard_primary,tribe_dashboard_widget\";s:7:\"column3\";s:0:\"\";s:7:\"column4\";s:0:\"\";}'),(53,1,'aaa_wp_edit_user_meta','a:11:{s:9:\"id_column\";s:1:\"0\";s:16:\"thumbnail_column\";s:1:\"0\";s:13:\"hide_text_tab\";s:1:\"0\";s:18:\"default_visual_tab\";s:1:\"0\";s:16:\"dashboard_widget\";s:1:\"0\";s:17:\"enable_highlights\";s:1:\"0\";s:15:\"draft_highlight\";s:7:\"#FFFFFF\";s:17:\"pending_highlight\";s:7:\"#FFFFFF\";s:19:\"published_highlight\";s:7:\"#FFFFFF\";s:16:\"future_highlight\";s:7:\"#FFFFFF\";s:17:\"private_highlight\";s:7:\"#FFFFFF\";}'),(54,1,'closedpostboxes_operations_handbook','a:7:{i:0;s:11:\"categorydiv\";i:1;s:31:\"builtwith_technology_profilediv\";i:2;s:16:\"tagsdiv-post_tag\";i:3;s:14:\"skill_leveldiv\";i:4;s:13:\"media_typediv\";i:5;s:15:\"distributiondiv\";i:6;s:16:\"impro_editor_box\";}'),(55,1,'metaboxhidden_operations_handbook','a:11:{i:0;s:11:\"categorydiv\";i:1;s:31:\"builtwith_technology_profilediv\";i:2;s:13:\"media_typediv\";i:3;s:15:\"distributiondiv\";i:4;s:17:\"customsidebars-mb\";i:5;s:11:\"postexcerpt\";i:6;s:10:\"postcustom\";i:7;s:7:\"slugdiv\";i:8;s:16:\"impro_editor_box\";i:9;s:9:\"authordiv\";i:10;s:16:\"impro_folder_box\";}'),(56,1,'meta-box-order_operations_handbook','a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:161:\"submitdiv,process_categorydiv,acf_184,categorydiv,builtwith_technology_profilediv,tagsdiv-post_tag,skill_leveldiv,media_typediv,distributiondiv,customsidebars-mb\";s:6:\"normal\";s:74:\"postexcerpt,postcustom,slugdiv,impro_editor_box,authordiv,impro_folder_box\";s:8:\"advanced\";s:44:\"et_monarch_settings,et_monarch_sharing_stats\";}'),(57,1,'screen_layout_operations_handbook','2'),(58,1,'managenav-menuscolumnshidden','a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),(59,1,'metaboxhidden_nav-menus','a:22:{i:0;s:21:\"add-post-type-project\";i:1;s:28:\"add-post-type-knowledge_base\";i:2;s:33:\"add-post-type-operations_handbook\";i:3;s:29:\"add-post-type-human_resources\";i:4;s:21:\"add-post-type-vendors\";i:5;s:26:\"add-post-type-tribe_events\";i:6;s:12:\"add-post_tag\";i:7;s:20:\"add-project_category\";i:8;s:15:\"add-project_tag\";i:9;s:32:\"add-builtwith_technology_profile\";i:10;s:16:\"add-content_type\";i:11;s:20:\"add-creative_concept\";i:12;s:19:\"add-target_audience\";i:13;s:15:\"add-buyer_phase\";i:14;s:15:\"add-skill_level\";i:15;s:14:\"add-media_type\";i:16;s:20:\"add-message_strategy\";i:17;s:8:\"add-tone\";i:18;s:8:\"add-look\";i:19;s:16:\"add-distribution\";i:20;s:12:\"add-location\";i:21;s:20:\"add-process_category\";}'),(60,1,'tribe_setDefaultNavMenuBoxes','1'),(61,1,'facebook',''),(62,1,'twitter',''),(63,1,'googleplus',''),(64,1,'pinterest',''),(65,1,'tumblr',''),(66,1,'stumbleupon',''),(67,1,'wordpress',''),(68,1,'instagram',''),(69,1,'dribbble',''),(70,1,'vimeo',''),(71,1,'linkedin',''),(72,1,'rss',''),(73,1,'deviantart',''),(74,1,'myspace',''),(75,1,'skype',''),(76,1,'youtube',''),(77,1,'picassa',''),(78,1,'flickr',''),(79,1,'blogger',''),(80,1,'spotify',''),(81,1,'delicious',''),(82,1,'closedpostboxes_acf','a:1:{i:0;s:16:\"impro_editor_box\";}'),(83,1,'metaboxhidden_acf','a:2:{i:0;s:7:\"slugdiv\";i:1;s:16:\"impro_folder_box\";}'),(84,1,'nav_menu_recently_edited','733'),(85,1,'ignore_wpedit_ag_notice','yes'),(86,1,'session_tokens','a:5:{s:64:\"521f1fe440d78becc251058ade90e63dfb996b2553f27dd23f3832999516be40\";a:4:{s:10:\"expiration\";i:1468506269;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.86 Safari/537.36\";s:5:\"login\";i:1468333469;}s:64:\"95d96ea849b16d1b756458d7460180b3149a05be8e436264b2866b286dab1dc6\";a:4:{s:10:\"expiration\";i:1468506560;s:2:\"ip\";s:13:\"71.218.174.53\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.86 Safari/537.36\";s:5:\"login\";i:1468333760;}s:64:\"7b6c643d9ccb7287eada26b06a6538b9b8f4e21634b748b8f3eab3b51dee53e7\";a:4:{s:10:\"expiration\";i:1468507851;s:2:\"ip\";s:13:\"71.218.174.53\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.86 Safari/537.36\";s:5:\"login\";i:1468335051;}s:64:\"8f27a50e1c12832fce36cef5d6343bff258901f7141de0896c05d19763fa12dd\";a:4:{s:10:\"expiration\";i:1468591142;s:2:\"ip\";s:13:\"71.218.174.53\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.86 Safari/537.36\";s:5:\"login\";i:1468418342;}s:64:\"26280aa8210265092d12560d336b848f25108ca89a9546c9e4acbcc31e6bb839\";a:4:{s:10:\"expiration\";i:1468594992;s:2:\"ip\";s:13:\"71.218.174.53\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.86 Safari/537.36\";s:5:\"login\";i:1468422192;}}'),(87,1,'jetpack_tracks_wpcom_id','105546816'),(88,1,'wpcom_user_id','105546816'),(89,1,'wpcom_user_data','O:8:\"stdClass\":10:{s:2:\"ID\";i:105546816;s:5:\"login\";s:13:\"octomarketing\";s:5:\"email\";s:34:\"info@octomarketing.onmicrosoft.com\";s:3:\"url\";s:24:\"http://octomarketing.com\";s:10:\"first_name\";s:3:\"Ian\";s:9:\"last_name\";s:9:\"Lancaster\";s:12:\"display_name\";s:13:\"octomarketing\";s:11:\"description\";s:0:\"\";s:16:\"two_step_enabled\";b:0;s:16:\"external_user_id\";i:1;}');
/*!40000 ALTER TABLE `octo_usermeta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
