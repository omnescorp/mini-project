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
-- Table structure for table `acl_classes`
--

DROP TABLE IF EXISTS `acl_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_69DD750638A36066` (`class_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_classes`
--

LOCK TABLES `acl_classes` WRITE;
/*!40000 ALTER TABLE `acl_classes` DISABLE KEYS */;
INSERT INTO `acl_classes` (`id`, `class_type`) VALUES (1,'MRusso\\LibBundle\\Entity\\Route');
/*!40000 ALTER TABLE `acl_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_entries`
--

DROP TABLE IF EXISTS `acl_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(10) unsigned NOT NULL,
  `object_identity_id` int(10) unsigned DEFAULT NULL,
  `security_identity_id` int(10) unsigned NOT NULL,
  `field_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ace_order` smallint(5) unsigned NOT NULL,
  `mask` int(11) NOT NULL,
  `granting` tinyint(1) NOT NULL,
  `granting_strategy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `audit_success` tinyint(1) NOT NULL,
  `audit_failure` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4` (`class_id`,`object_identity_id`,`field_name`,`ace_order`),
  KEY `IDX_46C8B806EA000B103D9AB4A6DF9183C9` (`class_id`,`object_identity_id`,`security_identity_id`),
  KEY `IDX_46C8B806EA000B10` (`class_id`),
  KEY `IDX_46C8B8063D9AB4A6` (`object_identity_id`),
  KEY `IDX_46C8B806DF9183C9` (`security_identity_id`),
  CONSTRAINT `FK_46C8B8063D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_46C8B806DF9183C9` FOREIGN KEY (`security_identity_id`) REFERENCES `acl_security_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_46C8B806EA000B10` FOREIGN KEY (`class_id`) REFERENCES `acl_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_entries`
--

LOCK TABLES `acl_entries` WRITE;
/*!40000 ALTER TABLE `acl_entries` DISABLE KEYS */;
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (152,1,30,1,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (275,1,39,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (304,1,35,3,NULL,1,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (305,1,36,3,NULL,1,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (306,1,37,3,NULL,1,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (343,1,34,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (344,1,33,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (345,1,35,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (346,1,36,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (347,1,37,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (348,1,38,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (349,1,40,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (350,1,41,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (351,1,42,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (352,1,43,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (353,1,44,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (354,1,45,2,NULL,0,128,1,'all',0,0);
INSERT INTO `acl_entries` (`id`, `class_id`, `object_identity_id`, `security_identity_id`, `field_name`, `ace_order`, `mask`, `granting`, `granting_strategy`, `audit_success`, `audit_failure`) VALUES (355,1,46,2,NULL,0,128,1,'all',0,0);
/*!40000 ALTER TABLE `acl_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_object_identities`
--

DROP TABLE IF EXISTS `acl_object_identities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_object_identities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_object_identity_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `object_identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entries_inheriting` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9407E5494B12AD6EA000B10` (`object_identifier`,`class_id`),
  KEY `IDX_9407E54977FA751A` (`parent_object_identity_id`),
  CONSTRAINT `FK_9407E54977FA751A` FOREIGN KEY (`parent_object_identity_id`) REFERENCES `acl_object_identities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_object_identities`
--

LOCK TABLES `acl_object_identities` WRITE;
/*!40000 ALTER TABLE `acl_object_identities` DISABLE KEYS */;
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (30,NULL,1,'1',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (31,NULL,1,'2',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (32,NULL,1,'5',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (33,NULL,1,'6',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (34,NULL,1,'4',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (35,NULL,1,'7',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (36,NULL,1,'8',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (37,NULL,1,'9',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (38,NULL,1,'10',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (39,NULL,1,'11',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (40,NULL,1,'12',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (41,NULL,1,'13',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (42,NULL,1,'14',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (43,NULL,1,'15',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (44,NULL,1,'16',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (45,NULL,1,'17',1);
INSERT INTO `acl_object_identities` (`id`, `parent_object_identity_id`, `class_id`, `object_identifier`, `entries_inheriting`) VALUES (46,NULL,1,'18',1);
/*!40000 ALTER TABLE `acl_object_identities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_object_identity_ancestors`
--

DROP TABLE IF EXISTS `acl_object_identity_ancestors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_object_identity_ancestors` (
  `object_identity_id` int(10) unsigned NOT NULL,
  `ancestor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`object_identity_id`,`ancestor_id`),
  KEY `IDX_825DE2993D9AB4A6` (`object_identity_id`),
  KEY `IDX_825DE299C671CEA1` (`ancestor_id`),
  CONSTRAINT `FK_825DE2993D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_825DE299C671CEA1` FOREIGN KEY (`ancestor_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_object_identity_ancestors`
--

LOCK TABLES `acl_object_identity_ancestors` WRITE;
/*!40000 ALTER TABLE `acl_object_identity_ancestors` DISABLE KEYS */;
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (30,30);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (31,31);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (32,32);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (33,33);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (34,34);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (35,35);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (36,36);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (37,37);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (38,38);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (39,39);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (40,40);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (41,41);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (42,42);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (43,43);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (44,44);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (45,45);
INSERT INTO `acl_object_identity_ancestors` (`object_identity_id`, `ancestor_id`) VALUES (46,46);
/*!40000 ALTER TABLE `acl_object_identity_ancestors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_security_identities`
--

DROP TABLE IF EXISTS `acl_security_identities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_security_identities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8835EE78772E836AF85E0677` (`identifier`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_security_identities`
--

LOCK TABLES `acl_security_identities` WRITE;
/*!40000 ALTER TABLE `acl_security_identities` DISABLE KEYS */;
INSERT INTO `acl_security_identities` (`id`, `identifier`, `username`) VALUES (2,'ROLE_1',0);
INSERT INTO `acl_security_identities` (`id`, `identifier`, `username`) VALUES (1,'ROLE_2',0);
INSERT INTO `acl_security_identities` (`id`, `identifier`, `username`) VALUES (3,'ROLE_3',0);
/*!40000 ALTER TABLE `acl_security_identities` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20555 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20533,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20534,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20535,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20536,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20537,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20538,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20539,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20540,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20541,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20542,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20543,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20544,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20545,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20546,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20547,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20548,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20549,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20550,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20551,'2016-03-31 09:51:40','título 1','imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20552,'2016-03-31 09:51:41','Tñoitulo 2','otra imagen',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20553,'2016-03-31 10:01:59','aaa','aaaa',0);
INSERT INTO `post` (`id`, `post_date`, `post_title`, `post_image`, `post_status`) VALUES (20554,'2016-03-31 10:01:59','333','333',0);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `role_title`) VALUES (1,'[es]Administrador[/es][en]Admin[/en]');
INSERT INTO `role` (`id`, `role_title`) VALUES (2,'[es]Registrado[/es][en]Signed[/en]');
INSERT INTO `role` (`id`, `role_title`) VALUES (3,'[es]Mitad[/es][en]Middle[/en]');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rout_controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rout_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rout_father` int(11) NOT NULL,
  `rout_visible` int(11) NOT NULL,
  `rout_order` int(11) NOT NULL,
  `rout_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rout_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (4,'MRussoBackendAdminBundle:Role:list','[es]grupo_admin[/es][en]admin_group[/en]',0,1,5,'[es]Grupos[/es][en]Groups[/en]','[es]Grupos[/es][en]Groups[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (6,'MRussoBackendAdminBundle:Role:edit','[es]administracion/rol/edit/{id}[/es][en]admin/role/edit/{id}[/en]',4,0,1,'[es]Editar Rol[/es][en]Edit Role[/en]','Editar Rol');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (7,'MRussoCmsBundle:BackEndAdmin:list','[es]gestor_cms[/es][en]cms_manager[/en]',0,1,3,'[es]Administrar Páginas[/es][en]Post Administartor[/en]','[es]Administrar Páginas[/es][en]Post Administartor[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (8,'MRussoCmsBundle:BackEndAdmin:edit','[es]cms/editar/{id}[/es][en]cms/edit/{id}[/en]',7,0,2,'[es]Editar[/es][en]Edit[/en]','Editar');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (9,'MRussoCmsBundle:BackEndAdmin:create','[es]cms/crear[/es][en]cms/create[/en]',7,1,2,'[es]Crear[/es][en]Create[/en]','[es]Crear[/es][en]Crear[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (10,'MRussoCmsBundle:BackEndAdmin:delete','[es]cms/eliminar/{id}[/es][en]cms/delete/{id}[/en]',7,0,3,'[es]Eliminar[/es][en]Delete[/en]','Editar');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (12,'MRussoBackendAdminBundle:Route:list','[es]Rutas[/es][en]Routes[/en]',0,1,6,'[es]Rutas[/es][en]Routes[/en]','[es]Rutas[/es][en]Routes[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (13,'MRussoBackendAdminBundle:Route:edit','[es]administracion/ruta_cambiaesto/edit/{id}[/es][en]admin/rol_ruta_cambiar_e/edit/{id}[/en]',12,0,6,'[es]Rutas[/es][en]Routes[/en]','[es]Rutas[/es][en]Routes[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (14,'MRussoBackendAdminBundle:User:list','[es]usuario[/es][en]user[/en]',0,1,6,'[es]Usuarios[/es][en]Users[/en]','[es]Usuarios[/es][en]Users[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (15,'MRussoBackendAdminBundle:User:edit','[es]administracion/usuario_cambiaesto/edit/{id}[/es][en]admin/rol_ruser_cambiar_e/edit/{id}[/en]',14,0,6,'[es]Editar[/es][en]Edit[/en]','[es]Editar[/es][en]Edit[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (16,'MRussoPlanBundle:Index:Index','[es]plan[/es][en]planing[/en]',0,1,10,'[es]Plan[/es][en]Planing[/en]','[es]Plan[/es][en]Planing[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (17,'MRussoPlanBundle:Index:Create','[es]plasn/crear[/es][en]planinsg/create[/en]',16,0,10,'[es]Crear[/es][en]Create[/en]','[es]Plan[/es][en]Planing[/en]');
INSERT INTO `route` (`id`, `rout_controller`, `rout_path`, `rout_father`, `rout_visible`, `rout_order`, `rout_label`, `rout_title`) VALUES (18,'MRussoPlanBundle:Index:Update','[es]plasn/actualziar/{id}[/es][en]planinsg/update/{id}[/en]',16,0,10,'[es]Actualizar[/es][en]Update[/en]','[es]Actualziar[/es][en]Update[/en]');
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `local` varchar(2) NOT NULL DEFAULT 'es',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `password`, `name`, `surname`, `active`, `local`) VALUES (1,'omnes','202cb962ac59075b964b07152d234b70','Marco','Russo',1,'es');
INSERT INTO `user` (`id`, `email`, `password`, `name`, `surname`, `active`, `local`) VALUES (2,'otro','202cb962ac59075b964b07152d234b70','otro','nombre',1,'es');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES (1,1);
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES (1,2);
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES (1,3);
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES (2,3);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-31 10:44:30
