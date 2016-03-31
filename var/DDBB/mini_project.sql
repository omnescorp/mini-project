-- MySQL dump 10.15  Distrib 10.0.23-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: mini_project
-- ------------------------------------------------------
-- Server version	10.0.23-MariaDB

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
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_title` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_status` int(11) NOT NULL,
  `post_view` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20582 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20559,'2016-03-31 10:49:06','','bundles/mrussominiproject/img/Worm-Hole.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20560,'2016-03-31 10:49:16','','bundles/mrussominiproject/img/Wallpapers-room_com___The_cubes1_by_DivineError_1280x960.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20561,'2016-03-31 10:49:20','','bundles/mrussominiproject/img/scorpion-robot-hd-wallpaper.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20562,'2016-03-31 10:49:24','','bundles/mrussominiproject/img/sables.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20563,'2016-03-31 10:49:36','','bundles/mrussominiproject/img/Shining 3D Wallpapers 01.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20564,'2016-03-31 10:49:40','','bundles/mrussominiproject/img/dj_mixing_console_1024x768.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20565,'2016-03-31 10:49:51','adsad','bundles/mrussominiproject/img/hd-wallpaper-glow1.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20566,'2016-03-31 10:50:06','','bundles/mrussominiproject/img/brilliant_3d-_wallpapers-_for-_desktop.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20567,'2016-03-31 10:50:24','','bundles/mrussominiproject/img/2011_wall_2b.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20568,'2016-03-31 10:50:32','','bundles/mrussominiproject/img/amazing-3d-light-wallpaper.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20569,'2016-03-31 10:50:40','','bundles/mrussominiproject/img/abstract-hd-wallpaper-69.png',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20570,'2016-03-31 10:50:52','','bundles/mrussominiproject/img/Amazing 3D Free HD Widescreen Wallpapers (23).jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20571,'2016-03-31 10:51:16','','bundles/mrussominiproject/img/amazing-3d-wallpaper-6304-6656-hd-wallpapers.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20572,'2016-03-31 10:52:00','','bundles/mrussominiproject/img/amazing-3d-wallpaper-6304-6656-hd-wallpapers.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20573,'2016-03-31 10:52:09','','bundles/mrussominiproject/img/3D_desktop_wallpaper.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20574,'2016-03-31 10:52:44','','bundles/mrussominiproject/img/3D-Background-Wallpapers-HD-Wallpapers-in-HD.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20575,'2016-03-31 11:29:06','','bundles/mrussominiproject/img/wallpaper-trabajos-de-luz.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20576,'2016-03-31 11:37:17','','bundles/mrussominiproject/img/smiley_faces-2560x1600.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20577,'2016-03-31 11:41:13','titlñe cool la pasta','bundles/mrussominiproject/img/Purple_Balls_Wallpaper.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20578,'2016-03-31 11:42:33','Eso lo iban a dar ellos?','bundles/mrussominiproject/img/light_wallpaper_2-Wallpaper-HD-Widescreen.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20579,'2016-03-31 11:43:04','','bundles/mrussominiproject/img/Darth_Vader_mask_Star_Wars_free_computer_desktop_wallpaper_1024.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20580,'2016-03-31 11:54:48','','bundles/mrussominiproject/img/water-flame-fantasy04.jpg',1,0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`, `post_view`) VALUES (20581,'2016-03-31 11:54:55','nada','bundles/mrussominiproject/img/snow-leopard-server-wallpaper.jpg',1,0);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-31 11:59:22
