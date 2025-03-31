/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 8.0.35 : Database - gdcdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gdcdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `gdcdb`;

/*Table structure for table `academic_levels` */

DROP TABLE IF EXISTS `academic_levels`;

CREATE TABLE `academic_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Weight` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `academic_levels` */

insert  into `academic_levels`(`id`,`name`,`Weight`,`created_at`,`updated_at`) values 
(1,'Certificate',2,NULL,NULL),
(2,'Diploma',3,NULL,NULL),
(3,'Degree',5,NULL,NULL),
(4,'PostGraduate Diploma',6,NULL,NULL),
(5,'Masters',7,NULL,NULL),
(6,'PHD',8,NULL,NULL),
(7,'KCSE/O -Level',0,NULL,NULL),
(9,'A-Level',1,NULL,NULL),
(10,'Higher Diploma',4,NULL,NULL);

/*Table structure for table `applicant_docs` */

DROP TABLE IF EXISTS `applicant_docs`;

CREATE TABLE `applicant_docs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_specific` tinyint(1) NOT NULL DEFAULT '0',
  `expire_after` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `applicant_docs` */

insert  into `applicant_docs`(`id`,`document_name`,`job_specific`,`expire_after`,`active`,`created_at`,`updated_at`) values 
(1,'National ID',0,NULL,1,'2023-09-12 12:29:48',NULL),
(5,'Driving Licence',1,NULL,1,'2023-09-13 09:54:04',NULL),
(6,'Curriculum Vitae - CV',1,NULL,1,'2023-09-13 10:10:05','2024-01-18 15:21:16'),
(7,'Cover Letter/Application Letter',1,NULL,1,'2023-09-13 10:10:15','2024-01-18 15:20:59'),
(8,'IHRM Certificate',1,NULL,1,'2023-09-14 13:22:13',NULL),
(9,'Proficiency In Computer Applications',1,NULL,1,'2023-09-14 13:23:40','2024-01-18 15:20:18'),
(10,'First Aid Certificate',1,NULL,1,'2023-10-25 21:38:26',NULL),
(11,'Suitability Test for Driver Grade III',1,NULL,1,'2023-10-25 21:38:50',NULL),
(12,'Occupational Test Grade III',1,NULL,1,'2023-10-25 21:39:04',NULL),
(13,'Portfolio',1,NULL,1,'2023-10-25 21:46:42',NULL),
(14,'Post graduate Diploma in Law',1,NULL,1,'2024-02-12 16:37:24',NULL),
(15,'Current Law Practicing Certificate',1,NULL,1,'2024-02-12 16:37:54',NULL),
(16,'Senior Management Course Certificate',1,NULL,1,'2024-02-12 16:38:20',NULL),
(17,'Proof of Advocate of the High Court of Kenya',1,NULL,1,'2024-02-12 16:42:09',NULL),
(18,'CPA',1,NULL,0,'2024-02-16 18:49:22',NULL);

/*Table structure for table `audit_logs` */

DROP TABLE IF EXISTS `audit_logs`;

CREATE TABLE `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `activity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` bigint unsigned NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `action_data` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `audit_logs` */

/*Table structure for table `constituencies` */

DROP TABLE IF EXISTS `constituencies`;

CREATE TABLE `constituencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `countyid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `constituencies` */

insert  into `constituencies`(`id`,`name`,`active`,`created_at`,`updated_at`,`countyid`) values 
(1,'CHANGAMWE',1,NULL,NULL,1),
(2,'JOMVU',1,NULL,NULL,1),
(3,'KISAUNI',1,NULL,NULL,1),
(4,'NYALI',1,NULL,NULL,1),
(5,'LIKONI',1,NULL,NULL,1),
(6,'MVITA',1,NULL,NULL,1),
(7,'MSAMBWENI',1,NULL,NULL,2),
(8,'LUNGALUNGA',1,NULL,NULL,2),
(9,'MATUGA',1,NULL,NULL,2),
(10,'KINANGO',1,NULL,NULL,2),
(11,'KILIFI NORTH',1,NULL,NULL,3),
(12,'KILIFI SOUTH',1,NULL,NULL,3),
(13,'KALOLENI',1,NULL,NULL,3),
(14,'RABAI',1,NULL,NULL,3),
(15,'GANZE',1,NULL,NULL,3),
(16,'MALINDI',1,NULL,NULL,3),
(17,'MAGARINI',1,NULL,NULL,3),
(18,'GARSEN',1,NULL,NULL,4),
(19,'GALOLE',1,NULL,NULL,4),
(20,'BURA',1,NULL,NULL,4),
(21,'LAMU EAST',1,NULL,NULL,5),
(22,'LAMU WEST',1,NULL,NULL,5),
(23,'TAVETA',1,NULL,NULL,6),
(24,'WUNDANYI',1,NULL,NULL,6),
(25,'MWATATE',1,NULL,NULL,6),
(26,'VOI',1,NULL,NULL,6),
(27,'GARISSA TOWNSHIP',1,NULL,NULL,7),
(28,'BALAMBALA',1,NULL,NULL,7),
(29,'LAGDERA',1,NULL,NULL,7),
(30,'DADAAB',1,NULL,NULL,7),
(31,'FAFI',1,NULL,NULL,7),
(32,'IJARA',1,NULL,NULL,7),
(33,'WAJIR NORTH',1,NULL,NULL,8),
(34,'WAJIR EAST',1,NULL,NULL,8),
(35,'TARBAJ',1,NULL,NULL,8),
(36,'WAJIR WEST',1,NULL,NULL,8),
(37,'ELDAS',1,NULL,NULL,8),
(38,'WAJIR SOUTH',1,NULL,NULL,8),
(39,'MANDERA WEST',1,NULL,NULL,9),
(40,'BANISSA',1,NULL,NULL,9),
(41,'MANDERA NORTH',1,NULL,NULL,9),
(42,'MANDERA SOUTH',1,NULL,NULL,9),
(43,'MANDERA EAST',1,NULL,NULL,9),
(44,'LAFEY',1,NULL,NULL,9),
(45,'MOYALE',1,NULL,NULL,10),
(46,'NORTH HORR',1,NULL,NULL,10),
(47,'SAKU',1,NULL,NULL,10),
(48,'LAISAMIS',1,NULL,NULL,10),
(49,'ISIOLO NORTH',1,NULL,NULL,11),
(50,'ISIOLO SOUTH',1,NULL,NULL,11),
(51,'IGEMBE SOUTH',1,NULL,NULL,12),
(52,'IGEMBE CENTRAL',1,NULL,NULL,12),
(53,'IGEMBE NORTH',1,NULL,NULL,12),
(54,'TIGANIA WEST',1,NULL,NULL,12),
(55,'TIGANIA EAST',1,NULL,NULL,12),
(56,'NORTH IMENTI',1,NULL,NULL,12),
(57,'BUURI',1,NULL,NULL,12),
(58,'CENTRAL IMENTI',1,NULL,NULL,12),
(59,'SOUTH IMENTI',1,NULL,NULL,12),
(60,'MAARA',1,NULL,NULL,13),
(61,'CHUKA/IGAMBANG\'OMBE',1,NULL,NULL,13),
(62,'THARAKA',1,NULL,NULL,13),
(63,'MANYATTA',1,NULL,NULL,14),
(64,'RUNYENJES',1,NULL,NULL,14),
(65,'MBEERE SOUTH',1,NULL,NULL,14),
(66,'MBEERE NORTH',1,NULL,NULL,14),
(67,'MWINGI NORTH',1,NULL,NULL,15),
(68,'MWINGI WEST',1,NULL,NULL,15),
(69,'MWINGI CENTRAL',1,NULL,NULL,15),
(70,'KITUI WEST',1,NULL,NULL,15),
(71,'KITUI RURAL',1,NULL,NULL,15),
(72,'KITUI CENTRAL',1,NULL,NULL,15),
(73,'KITUI EAST',1,NULL,NULL,15),
(74,'KITUI SOUTH',1,NULL,NULL,15),
(75,'MASINGA',1,NULL,NULL,16),
(76,'YATTA',1,NULL,NULL,16),
(77,'KANGUNDO',1,NULL,NULL,16),
(78,'MATUNGULU',1,NULL,NULL,16),
(79,'KATHIANI',1,NULL,NULL,16),
(80,'MAVOKO',1,NULL,NULL,16),
(81,'MACHAKOS TOWN',1,NULL,NULL,16),
(82,'MWALA',1,NULL,NULL,16),
(83,'MBOONI',1,NULL,NULL,17),
(84,'KILOME',1,NULL,NULL,17),
(85,'KAITI',1,NULL,NULL,17),
(86,'MAKUENI',1,NULL,NULL,17),
(87,'KIBWEZI WEST',1,NULL,NULL,17),
(88,'KIBWEZI EAST',1,NULL,NULL,17),
(89,'KINANGOP',1,NULL,NULL,18),
(90,'KIPIPIRI',1,NULL,NULL,18),
(91,'OL KALOU',1,NULL,NULL,18),
(92,'OL JOROK',1,NULL,NULL,18),
(93,'NDARAGWA',1,NULL,NULL,18),
(94,'TETU',1,NULL,NULL,19),
(95,'KIENI',1,NULL,NULL,19),
(96,'MATHIRA',1,NULL,NULL,19),
(97,'OTHAYA',1,NULL,NULL,19),
(98,'MUKURWEINI',1,NULL,NULL,19),
(99,'NYERI TOWN',1,NULL,NULL,19),
(100,'MWEA',1,NULL,NULL,20),
(101,'GICHUGU',1,NULL,NULL,20),
(102,'NDIA',1,NULL,NULL,20),
(103,'KIRINYAGA CENTRAL',1,NULL,NULL,20),
(104,'KANGEMA',1,NULL,NULL,21),
(105,'MATHIOYA',1,NULL,NULL,21),
(106,'KIHARU',1,NULL,NULL,21),
(107,'KIGUMO',1,NULL,NULL,21),
(108,'MARAGWA',1,NULL,NULL,21),
(109,'KANDARA',1,NULL,NULL,21),
(110,'GATANGA',1,NULL,NULL,21),
(111,'GATUNDU SOUTH',1,NULL,NULL,22),
(112,'GATUNDU NORTH',1,NULL,NULL,22),
(113,'JUJA',1,NULL,NULL,22),
(114,'THIKA TOWN',1,NULL,NULL,22),
(115,'RUIRU',1,NULL,NULL,22),
(116,'GITHUNGURI',1,NULL,NULL,22),
(117,'KIAMBU',1,NULL,NULL,22),
(118,'KIAMBAA',1,NULL,NULL,22),
(119,'KABETE',1,NULL,NULL,22),
(120,'KIKUYU',1,NULL,NULL,22),
(121,'LIMURU',1,NULL,NULL,22),
(122,'LARI',1,NULL,NULL,22),
(123,'TURKANA NORTH',1,NULL,NULL,23),
(124,'TURKANA WEST',1,NULL,NULL,23),
(125,'TURKANA CENTRAL',1,NULL,NULL,23),
(126,'LOIMA',1,NULL,NULL,23),
(127,'TURKANA SOUTH',1,NULL,NULL,23),
(128,'TURKANA EAST',1,NULL,NULL,23),
(129,'KAPENGURIA',1,NULL,NULL,24),
(130,'SIGOR',1,NULL,NULL,24),
(131,'KACHELIBA',1,NULL,NULL,24),
(132,'POKOT SOUTH',1,NULL,NULL,24),
(133,'SAMBURU WEST',1,NULL,NULL,25),
(134,'SAMBURU NORTH',1,NULL,NULL,25),
(135,'SAMBURU EAST',1,NULL,NULL,25),
(136,'KWANZA',1,NULL,NULL,26),
(137,'ENDEBESS',1,NULL,NULL,26),
(138,'SABOTI',1,NULL,NULL,26),
(139,'KIMININI',1,NULL,NULL,26),
(140,'CHERANGANY',1,NULL,NULL,26),
(141,'SOY',1,NULL,NULL,27),
(142,'TURBO',1,NULL,NULL,27),
(143,'MOIBEN',1,NULL,NULL,27),
(144,'AINABKOI',1,NULL,NULL,27),
(145,'KAPSERET',1,NULL,NULL,27),
(146,'KESSES',1,NULL,NULL,27),
(147,'MARAKWET EAST',1,NULL,NULL,28),
(148,'MARAKWET WEST',1,NULL,NULL,28),
(149,'KEIYO NORTH',1,NULL,NULL,28),
(150,'KEIYO SOUTH',1,NULL,NULL,28),
(151,'TINDERET',1,NULL,NULL,29),
(152,'ALDAI',1,NULL,NULL,29),
(153,'NANDI HILLS',1,NULL,NULL,29),
(154,'CHESUMEI',1,NULL,NULL,29),
(155,'EMGWEN',1,NULL,NULL,29),
(156,'MOSOP',1,NULL,NULL,29),
(157,'TIATY',1,NULL,NULL,30),
(158,'BARINGO  NORTH',1,NULL,NULL,30),
(159,'BARINGO CENTRAL',1,NULL,NULL,30),
(160,'BARINGO SOUTH',1,NULL,NULL,30),
(161,'MOGOTIO',1,NULL,NULL,30),
(162,'ELDAMA RAVINE',1,NULL,NULL,30),
(163,'LAIKIPIA WEST',1,NULL,NULL,31),
(164,'LAIKIPIA EAST',1,NULL,NULL,31),
(165,'LAIKIPIA NORTH',1,NULL,NULL,31),
(166,'MOLO',1,NULL,NULL,32),
(167,'NJORO',1,NULL,NULL,32),
(168,'NAIVASHA',1,NULL,NULL,32),
(169,'GILGIL',1,NULL,NULL,32),
(170,'KURESOI SOUTH',1,NULL,NULL,32),
(171,'KURESOI NORTH',1,NULL,NULL,32),
(172,'SUBUKIA',1,NULL,NULL,32),
(173,'RONGAI',1,NULL,NULL,32),
(174,'BAHATI',1,NULL,NULL,32),
(175,'NAKURU TOWN WEST',1,NULL,NULL,32),
(176,'NAKURU TOWN EAST',1,NULL,NULL,32),
(177,'KILGORIS',1,NULL,NULL,33),
(178,'EMURUA DIKIRR',1,NULL,NULL,33),
(179,'NAROK NORTH',1,NULL,NULL,33),
(180,'NAROK EAST',1,NULL,NULL,33),
(181,'NAROK SOUTH',1,NULL,NULL,33),
(182,'NAROK WEST',1,NULL,NULL,33),
(183,'KAJIADO NORTH',1,NULL,NULL,34),
(184,'KAJIADO CENTRAL',1,NULL,NULL,34),
(185,'KAJIADO EAST',1,NULL,NULL,34),
(186,'KAJIADO WEST',1,NULL,NULL,34),
(187,'KAJIADO SOUTH',1,NULL,NULL,34),
(188,'KIPKELION EAST',1,NULL,NULL,35),
(189,'KIPKELION WEST',1,NULL,NULL,35),
(190,'AINAMOI',1,NULL,NULL,35),
(191,'BURETI',1,NULL,NULL,35),
(192,'BELGUT',1,NULL,NULL,35),
(193,'SIGOWET/SOIN',1,NULL,NULL,35),
(194,'SOTIK',1,NULL,NULL,36),
(195,'CHEPALUNGU',1,NULL,NULL,36),
(196,'BOMET EAST',1,NULL,NULL,36),
(197,'BOMET CENTRAL',1,NULL,NULL,36),
(198,'KONOIN',1,NULL,NULL,36),
(199,'LUGARI',1,NULL,NULL,37),
(200,'LIKUYANI',1,NULL,NULL,37),
(201,'MALAVA',1,NULL,NULL,37),
(202,'LURAMBI',1,NULL,NULL,37),
(203,'NAVAKHOLO',1,NULL,NULL,37),
(204,'MUMIAS WEST',1,NULL,NULL,37),
(205,'MUMIAS EAST',1,NULL,NULL,37),
(206,'MATUNGU',1,NULL,NULL,37),
(207,'BUTERE',1,NULL,NULL,37),
(208,'KHWISERO',1,NULL,NULL,37),
(209,'SHINYALU',1,NULL,NULL,37),
(210,'IKOLOMANI',1,NULL,NULL,37),
(211,'VIHIGA',1,NULL,NULL,38),
(212,'SABATIA',1,NULL,NULL,38),
(213,'HAMISI',1,NULL,NULL,38),
(214,'LUANDA',1,NULL,NULL,38),
(215,'EMUHAYA',1,NULL,NULL,38),
(216,'MT. ELGON',1,NULL,NULL,39),
(217,'SIRISIA',1,NULL,NULL,39),
(218,'KABUCHAI',1,NULL,NULL,39),
(219,'BUMULA',1,NULL,NULL,39),
(220,'KANDUYI',1,NULL,NULL,39),
(221,'WEBUYE EAST',1,NULL,NULL,39),
(222,'WEBUYE WEST',1,NULL,NULL,39),
(223,'KIMILILI',1,NULL,NULL,39),
(224,'TONGAREN',1,NULL,NULL,39),
(225,'TESO NORTH',1,NULL,NULL,40),
(226,'TESO SOUTH',1,NULL,NULL,40),
(227,'NAMBALE',1,NULL,NULL,40),
(228,'MATAYOS',1,NULL,NULL,40),
(229,'BUTULA',1,NULL,NULL,40),
(230,'FUNYULA',1,NULL,NULL,40),
(231,'BUDALANGI',1,NULL,NULL,40),
(232,'UGENYA',1,NULL,NULL,41),
(233,'UGUNJA',1,NULL,NULL,41),
(234,'ALEGO USONGA',1,NULL,NULL,41),
(235,'GEM',1,NULL,NULL,41),
(236,'BONDO',1,NULL,NULL,41),
(237,'RARIEDA',1,NULL,NULL,41),
(238,'KISUMU EAST',1,NULL,NULL,42),
(239,'KISUMU WEST',1,NULL,NULL,42),
(240,'KISUMU CENTRAL',1,NULL,NULL,42),
(241,'SEME',1,NULL,NULL,42),
(242,'NYANDO',1,NULL,NULL,42),
(243,'MUHORONI',1,NULL,NULL,42),
(244,'NYAKACH',1,NULL,NULL,42),
(245,'KASIPUL',1,NULL,NULL,43),
(246,'KABONDO KASIPUL',1,NULL,NULL,43),
(247,'KARACHUONYO',1,NULL,NULL,43),
(248,'RANGWE',1,NULL,NULL,43),
(249,'HOMA BAY TOWN',1,NULL,NULL,43),
(250,'NDHIWA',1,NULL,NULL,43),
(251,'SUBA NORTH',1,NULL,NULL,43),
(252,'SUBA SOUTH',1,NULL,NULL,43),
(253,'RONGO',1,NULL,NULL,44),
(254,'AWENDO',1,NULL,NULL,44),
(255,'SUNA EAST',1,NULL,NULL,44),
(256,'SUNA WEST',1,NULL,NULL,44),
(257,'URIRI',1,NULL,NULL,44),
(258,'NYATIKE',1,NULL,NULL,44),
(259,'KURIA WEST',1,NULL,NULL,44),
(260,'KURIA EAST',1,NULL,NULL,44),
(261,'BONCHARI',1,NULL,NULL,45),
(262,'SOUTH MUGIRANGO',1,NULL,NULL,45),
(263,'BOMACHOGE BORABU',1,NULL,NULL,45),
(264,'BOBASI',1,NULL,NULL,45),
(265,'BOMACHOGE CHACHE',1,NULL,NULL,45),
(266,'NYARIBARI MASABA',1,NULL,NULL,45),
(267,'NYARIBARI CHACHE',1,NULL,NULL,45),
(268,'KITUTU CHACHE NORTH',1,NULL,NULL,45),
(269,'KITUTU CHACHE SOUTH',1,NULL,NULL,45),
(270,'KITUTU MASABA',1,NULL,NULL,46),
(271,'WEST MUGIRANGO',1,NULL,NULL,46),
(272,'NORTH MUGIRANGO',1,NULL,NULL,46),
(273,'BORABU',1,NULL,NULL,46),
(274,'WESTLANDS',1,NULL,NULL,47),
(275,'DAGORETTI NORTH',1,NULL,NULL,47),
(276,'DAGORETTI SOUTH',1,NULL,NULL,47),
(277,'LANGATA',1,NULL,NULL,47),
(278,'KIBRA',1,NULL,NULL,47),
(279,'ROYSAMBU',1,NULL,NULL,47),
(280,'KASARANI',1,NULL,NULL,47),
(281,'RUARAKA',1,NULL,NULL,47),
(282,'EMBAKASI SOUTH',1,NULL,NULL,47),
(283,'EMBAKASI NORTH',1,NULL,NULL,47),
(284,'EMBAKASI CENTRAL',1,NULL,NULL,47),
(285,'EMBAKASI EAST',1,NULL,NULL,47),
(286,'EMBAKASI WEST',1,NULL,NULL,47),
(287,'MAKADARA',1,NULL,NULL,47),
(288,'KAMUKUNJI',1,NULL,NULL,47),
(289,'STAREHE',1,NULL,NULL,47),
(290,'MATHARE',1,NULL,NULL,47);

/*Table structure for table `course_categories` */

DROP TABLE IF EXISTS `course_categories`;

CREATE TABLE `course_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `course_categories` */

insert  into `course_categories`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Applied and Pure Sciences',NULL,NULL),
(2,'Architecture and Construction',NULL,NULL),
(3,'Arts and Humanities',NULL,NULL),
(4,'Business and Management',NULL,NULL),
(5,'Computer Science and IT',NULL,NULL),
(6,'Creative Arts and Design',NULL,NULL),
(7,'Education and Training',NULL,NULL),
(8,'Finance and Economics',NULL,NULL),
(9,'Engineering',NULL,NULL),
(10,'Health and Medicine',NULL,NULL),
(11,'Law',NULL,NULL),
(12,'Life Sciences',NULL,NULL),
(13,'Political Science',NULL,NULL),
(14,'Physical Sciences',NULL,NULL),
(15,'Psychology',NULL,NULL),
(16,'Social Studies and Media',NULL,NULL),
(17,'Travel and Hospitality',NULL,NULL),
(18,'KCPE',NULL,NULL),
(19,'KCSE',NULL,NULL),
(20,'Other',NULL,NULL);

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `shopname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

/*Table structure for table `designations` */

DROP TABLE IF EXISTS `designations`;

CREATE TABLE `designations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `designations` */

insert  into `designations`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Mr','2023-08-21 12:29:41',NULL),
(3,'Mrs','2023-08-21 12:31:36',NULL),
(4,'Ms','2023-08-21 12:31:44',NULL),
(5,'Dr','2023-08-21 12:31:49',NULL),
(6,'Prof',NULL,NULL),
(7,'Rev',NULL,NULL),
(8,'Ms','2024-01-10 12:08:59',NULL),
(9,'Other','2024-01-12 12:23:36',NULL),
(10,'Hon.','2024-01-18 14:37:03',NULL);

/*Table structure for table `disabilities` */

DROP TABLE IF EXISTS `disabilities`;

CREATE TABLE `disabilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `disabilities` */

/*Table structure for table `education_qualifications` */

DROP TABLE IF EXISTS `education_qualifications`;

CREATE TABLE `education_qualifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `academiclevel` int NOT NULL,
  `startDate` date DEFAULT NULL,
  `exitDate` date NOT NULL,
  `institutionName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_category` int NOT NULL,
  `grade` int NOT NULL,
  `certNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entryDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `education_qualifications` */

insert  into `education_qualifications`(`id`,`userid`,`academiclevel`,`startDate`,`exitDate`,`institutionName`,`courseName`,`course_category`,`grade`,`certNo`,`certificate`,`entryDate`,`created_at`,`updated_at`) values 
(1,3,5,NULL,'2010-02-01','Jada Berry','Shad Mueller',3,5,'515','upload/educationqual/EQ-1.pdf','2025-03-28','2025-03-28 16:44:30','2025-03-28 16:44:30');

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idnumber` int NOT NULL,
  `idphoto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving` tinyint(1) NOT NULL,
  `dl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employees` */

/*Table structure for table `ethnicities` */

DROP TABLE IF EXISTS `ethnicities`;

CREATE TABLE `ethnicities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ethnicities` */

insert  into `ethnicities`(`id`,`name`,`active`,`created_at`,`updated_at`) values 
(1,'AWEER/WAATA',1,NULL,NULL),
(2,'BAJUNI',1,NULL,NULL),
(3,'BORANA',1,NULL,NULL),
(4,'BURJI',1,NULL,NULL),
(5,'DAHALO',1,NULL,NULL),
(6,'DASENACH (Merile)',1,NULL,NULL),
(7,'DOROBO',1,NULL,NULL),
(8,'EL MOLO',1,NULL,NULL),
(9,'EMBU',1,NULL,NULL),
(10,'GABRA',1,NULL,NULL),
(11,'GOSHA',1,NULL,NULL),
(12,'ILCHAMUS / NJEMPS',1,NULL,NULL),
(13,'KALENJIN',1,NULL,NULL),
(14,'KAMBA',1,NULL,NULL),
(15,'KENYAN SOMALI',1,NULL,NULL),
(16,'KIKUYU',1,NULL,NULL),
(17,'KISII',1,NULL,NULL),
(18,'KONSO',1,NULL,NULL),
(19,'KURIA',1,NULL,NULL),
(20,'LUHYA',1,NULL,NULL),
(21,'LUO',1,NULL,NULL),
(22,'MAASAI',1,NULL,NULL),
(23,'MAKONDE',1,NULL,NULL),
(24,'MBEERE',1,NULL,NULL),
(25,'MERU',1,NULL,NULL),
(26,'MIJIKENDA',1,NULL,NULL),
(27,'NUBI',1,NULL,NULL),
(28,'POKOMO',1,NULL,NULL),
(29,'ORMA',1,NULL,NULL),
(30,'RENDILE',1,NULL,NULL),
(31,'SAKUYE',1,NULL,NULL),
(32,'SAMBURU',1,NULL,NULL),
(33,'SUBA',1,NULL,NULL),
(34,'SWAHILI',1,NULL,NULL),
(35,'TAITA',1,NULL,NULL),
(36,'TAVETA',1,NULL,NULL),
(37,'TESO',1,NULL,NULL),
(38,'THARAKA',1,NULL,NULL),
(39,'TURKANA',1,NULL,NULL),
(40,'WALWANA/MALAKOTE',1,NULL,NULL),
(41,'WAYYU',1,NULL,NULL),
(42,'KENYAN ASIANS',1,NULL,NULL),
(43,'KENYAN AMERICAN',1,NULL,NULL),
(44,'KENYAN ARABS',1,NULL,NULL),
(45,'KENYAN EUROPEAN',1,NULL,NULL),
(46,'NON KENYANS',1,NULL,NULL),
(47,'KENYAN SO STATE',1,NULL,NULL),
(48,'NOT STATED',1,NULL,NULL);

/*Table structure for table `experiences` */

DROP TABLE IF EXISTS `experiences`;

CREATE TABLE `experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Duties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `exitDate` date DEFAULT NULL,
  `exitReasons` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isCurrent` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `experiences` */

insert  into `experiences`(`id`,`userid`,`company`,`jobTitle`,`Duties`,`startDate`,`exitDate`,`exitReasons`,`isCurrent`,`created_at`,`updated_at`) values 
(1,3,'ICTA','Senior Driver','<p>...cxcf</p>','2025-03-28',NULL,'',1,'2025-03-28 16:45:39','2025-03-28 16:45:39');

/*Table structure for table `experiences_tmp` */

DROP TABLE IF EXISTS `experiences_tmp`;

CREATE TABLE `experiences_tmp` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `company` int NOT NULL,
  `jobTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Duties` text COLLATE utf8mb4_unicode_ci,
  `startDate` date DEFAULT NULL,
  `exitDate` date DEFAULT NULL,
  `exitReasons` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isCurrent` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `experiences_tmp` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

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

/*Data for the table `failed_jobs` */

/*Table structure for table `genders` */

DROP TABLE IF EXISTS `genders`;

CREATE TABLE `genders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `genders` */

insert  into `genders`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Male','2023-08-21 17:49:07',NULL),
(2,'Female','2023-08-21 17:49:14',NULL),
(3,'Intersex','2023-08-21 17:50:36','2023-08-21 17:59:50');

/*Table structure for table `grades` */

DROP TABLE IF EXISTS `grades`;

CREATE TABLE `grades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grades` */

insert  into `grades`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Pass',NULL,NULL),
(2,'Credit',NULL,NULL),
(3,'Fail',NULL,NULL),
(4,'Distinction',NULL,NULL),
(5,'Second Lower Class',NULL,NULL),
(6,'Second Upper Class',NULL,NULL),
(7,'First Class',NULL,NULL),
(8,'A',NULL,NULL),
(9,'A-',NULL,NULL),
(10,'B+',NULL,NULL),
(11,'B',NULL,NULL),
(12,'B-',NULL,NULL),
(13,'C+',NULL,NULL),
(14,'C',NULL,NULL),
(15,'C-',NULL,NULL),
(16,'D+',NULL,NULL),
(17,'D',NULL,NULL),
(18,'D-',NULL,NULL),
(19,'E',NULL,NULL),
(20,'Division 1',NULL,NULL),
(21,'Division 2',NULL,NULL),
(22,'Division 3',NULL,NULL),
(23,'Division 4',NULL,NULL);

/*Table structure for table `home_counties` */

DROP TABLE IF EXISTS `home_counties`;

CREATE TABLE `home_counties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `home_counties` */

insert  into `home_counties`(`id`,`name`,`active`,`created_at`,`updated_at`) values 
(1,'MOMBASA',0,NULL,NULL),
(2,'KWALE',0,NULL,NULL),
(3,'KILIFI',0,NULL,NULL),
(4,'TANA RIVER',0,NULL,NULL),
(5,'LAMU',0,NULL,NULL),
(6,'TAITA TAVETA',0,NULL,NULL),
(7,'GARISSA',0,NULL,NULL),
(8,'WAJIR',0,NULL,NULL),
(9,'MANDERA',0,NULL,NULL),
(10,'MARSABIT',0,NULL,NULL),
(11,'ISIOLO',0,NULL,NULL),
(12,'MERU',0,NULL,NULL),
(13,'THARAKA - NITHI',0,NULL,NULL),
(14,'EMBU',1,NULL,NULL),
(15,'KITUI',0,NULL,NULL),
(16,'MACHAKOS',0,NULL,NULL),
(17,'MAKUENI',0,NULL,NULL),
(18,'NYANDARUA',0,NULL,NULL),
(19,'NYERI',1,NULL,NULL),
(20,'KIRINYAGA',0,NULL,NULL),
(21,'MURANG\'A',0,NULL,NULL),
(22,'KIAMBU',1,NULL,NULL),
(23,'TURKANA',0,NULL,NULL),
(24,'WEST POKOT',0,NULL,NULL),
(25,'SAMBURU',0,NULL,NULL),
(26,'TRANS NZOIA',1,NULL,NULL),
(27,'UASIN GISHU',1,NULL,NULL),
(28,'ELGEYO/MARAKWET',0,NULL,NULL),
(29,'NANDI',1,NULL,NULL),
(30,'BARINGO',0,NULL,NULL),
(31,'LAIKIPIA',0,NULL,NULL),
(32,'NAKURU',1,NULL,NULL),
(33,'NAROK',0,NULL,NULL),
(34,'KAJIADO',0,NULL,NULL),
(35,'KERICHO',1,NULL,NULL),
(36,'BOMET',1,NULL,NULL),
(37,'KAKAMEGA',0,NULL,NULL),
(38,'VIHIGA',0,NULL,NULL),
(39,'BUNGOMA',0,NULL,NULL),
(40,'BUSIA',1,NULL,NULL),
(41,'SIAYA',1,NULL,NULL),
(42,'KISUMU',0,NULL,NULL),
(43,'HOMA BAY',0,NULL,NULL),
(44,'MIGORI',0,NULL,NULL),
(45,'KISII',0,NULL,NULL),
(46,'NYAMIRA',0,NULL,NULL),
(47,'NAIROBI CITY',1,NULL,NULL);

/*Table structure for table `internal_emails` */

DROP TABLE IF EXISTS `internal_emails`;

CREATE TABLE `internal_emails` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `internal_emails_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `internal_emails` */

/*Table structure for table `job_application_documents` */

DROP TABLE IF EXISTS `job_application_documents`;

CREATE TABLE `job_application_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jobapplicationid` int NOT NULL,
  `userid` int NOT NULL,
  `vacancyid` int NOT NULL,
  `documentid` int NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_application_documents` */

/*Table structure for table `job_applications` */

DROP TABLE IF EXISTS `job_applications`;

CREATE TABLE `job_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancyid` int NOT NULL,
  `userid` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Applied',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shortlistingdate` date DEFAULT NULL,
  `shortlistedby` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_applications` */

/*Table structure for table `job_seeker_docs` */

DROP TABLE IF EXISTS `job_seeker_docs`;

CREATE TABLE `job_seeker_docs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int NOT NULL,
  `userid` int NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_seeker_docs` */

insert  into `job_seeker_docs`(`id`,`document_id`,`userid`,`path`,`created_at`,`updated_at`) values 
(1,1,3,'upload/commondocs/0.28339800_1743169634.pdf',NULL,NULL);

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

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

/*Data for the table `jobs` */

/*Table structure for table `leadership_courses` */

DROP TABLE IF EXISTS `leadership_courses`;

CREATE TABLE `leadership_courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `institutionName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date DEFAULT NULL,
  `exitDate` date NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entryDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leadership_courses_user_id_foreign` (`user_id`),
  CONSTRAINT `leadership_courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `leadership_courses` */

insert  into `leadership_courses`(`id`,`user_id`,`institutionName`,`courseName`,`startDate`,`exitDate`,`grade`,`certNo`,`certificate`,`entryDate`,`created_at`,`updated_at`) values 
(1,3,'JKUAT','Computer Science',NULL,'2025-03-28','PASS','','upload/lc/LC-1.pdf','2025-03-28','2025-03-28 16:47:01','2025-03-28 16:47:01');

/*Table structure for table `marital_statuses` */

DROP TABLE IF EXISTS `marital_statuses`;

CREATE TABLE `marital_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `marital_statuses` */

insert  into `marital_statuses`(`id`,`name`,`active`,`created_at`,`updated_at`) values 
(1,'Married',1,NULL,NULL),
(2,'Single',1,NULL,NULL),
(3,'Widowed',1,NULL,NULL),
(4,'Divorced',1,NULL,NULL),
(5,'N/A',0,NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_07_13_194247_create_employees_table',1),
(6,'2023_07_15_080240_create_customers_table',1),
(7,'2023_08_21_120314_create_designations_table',2),
(8,'2023_08_21_124623_create_genders_table',3),
(9,'2023_08_21_124633_create_nationalities_table',3),
(10,'2023_08_21_124646_create_ethnicities_table',3),
(11,'2023_08_21_124754_create_home_counties_table',3),
(12,'2023_08_21_124808_create_constituencies_table',3),
(13,'2023_08_21_124823_create_marital_statuses_table',3),
(14,'2023_08_21_124842_create_disabilities_table',3),
(15,'2023_08_25_093925_create_education_qualifications_table',4),
(16,'2023_08_25_094106_create_academic_levels_table',4),
(17,'2023_08_25_094203_create_grades_table',4),
(18,'2023_08_29_181321_create_proffessional_quals_table',5),
(19,'2023_08_30_053928_create_proffessional_memberships_table',6),
(20,'2023_08_31_125148_create_experiences_table',7),
(21,'2023_09_12_062201_create_course_categories_table',8),
(22,'2023_09_12_115521_create_applicant_docs_table',9),
(23,'2023_09_12_132018_create_job_seeker_docs_table',10),
(24,'2023_09_13_065545_create_recruitments_table',11),
(25,'2023_09_13_093103_create_vacancies_table',12),
(26,'2023_09_13_120458_create_vacancy_documents_table',13),
(27,'2023_09_14_075653_create_job_applications_table',14),
(28,'2023_09_14_080517_create_job_application_documents_table',14),
(29,'2023_09_19_092404_create_selection_stages_table',15),
(30,'2023_09_19_094527_create_temp_in_selections_table',16),
(31,'2023_09_19_115118_create_selection_d_b_queries_table',17),
(32,'2023_09_19_132103_create_vacancy_resets_table',18),
(33,' 2023_09_20_081021_create_shortling_stages_table',19),
(34,'2023_09_20_081021_create_shortling_stages_table',20),
(35,'2023_09_20_135226_create_pending_selections_table',20),
(36,'2023_09_20_143534_create_shortlisting_loggers_table',20),
(37,'2024_01_04_145821_last_login',20),
(38,'2024_01_12_140910_add_newdisabilities_to_table',20),
(39,'2024_01_15_123454_add_countyid_to_table',21),
(40,'2024_01_15_152107_add_activeness_to_table',22),
(41,'2024_01_16_184122_add_extensionjustification_to_table',23),
(42,'2024_01_17_073250_create_permission_tables',24),
(43,'2024_01_17_074617_add_groupname_to_table',24),
(44,'2024_01_19_054145_create_tempjobapplications_table',25),
(45,'2024_05_23_185816_add_nccs_to_table',25),
(46,'2024_05_23_194611_add_type_to_table',26),
(47,'2025_01_15_193758_create_internal_emails_table',27),
(48,'2025_01_07_175003_create_audit_logs_table',28),
(49,'2025_01_07_176311_add_approval_to_recruitments_table',28),
(50,'2025_01_07_182951_add_updated_at_to_audit_logs_table',28),
(51,'2025_01_08_065123_add_newsalary_to_vacancies_table',28),
(52,'2025_01_08_145552_create_leadership_courses_table',28),
(53,'2025_01_08_152434_add_leadership_to_users_table',28),
(54,'2025_01_09_225409_create_jobs_table',28),
(55,'2025_02_19_172437_create_stage2_evaluations_archive_table',28);

/*Table structure for table `nationalities` */

DROP TABLE IF EXISTS `nationalities`;

CREATE TABLE `nationalities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `nationalities` */

insert  into `nationalities`(`id`,`name`,`created_at`,`updated_at`) values 
(2,'Afghanistan',NULL,NULL),
(3,'?land (Finland)',NULL,NULL),
(4,'Albania',NULL,NULL),
(5,'Algeria',NULL,NULL),
(7,'Andorra',NULL,NULL),
(8,'Angola',NULL,NULL),
(10,'Antigua and Barbuda',NULL,NULL),
(11,'Argentina',NULL,NULL),
(12,'Armenia',NULL,NULL),
(13,'Artsakh',NULL,NULL),
(14,'Aruba (Netherlands)',NULL,NULL),
(15,'Australia',NULL,NULL),
(16,'Austria',NULL,NULL),
(17,'Azerbaijan',NULL,NULL),
(18,'Bahamas',NULL,NULL),
(19,'Bahrain',NULL,NULL),
(20,'Bangladesh',NULL,NULL),
(21,'Barbados',NULL,NULL),
(22,'Belarus',NULL,NULL),
(23,'Belgium',NULL,NULL),
(24,'Belize',NULL,NULL),
(25,'Benin',NULL,NULL),
(26,'Bermuda (BOT)',NULL,NULL),
(27,'Bhutan',NULL,NULL),
(28,'Bolivia',NULL,NULL),
(29,'Bonaire (Netherlands)',NULL,NULL),
(30,'Bosnia and Herzegovina',NULL,NULL),
(31,'Botswana',NULL,NULL),
(32,'Brazil',NULL,NULL),
(33,'British Virgin Islands (BOT)',NULL,NULL),
(34,'Brunei',NULL,NULL),
(35,'Bulgaria',NULL,NULL),
(36,'Burkina Faso',NULL,NULL),
(37,'Burundi',NULL,NULL),
(38,'Cambodia',NULL,NULL),
(39,'Cameroon',NULL,NULL),
(40,'Canada',NULL,NULL),
(41,'Cape Verde',NULL,NULL),
(42,'Cayman Islands (BOT)',NULL,NULL),
(43,'Central African Republic',NULL,NULL),
(44,'Chad',NULL,NULL),
(45,'Chile',NULL,NULL),
(46,'China',NULL,NULL),
(47,'Christmas Island (Australia)',NULL,NULL),
(48,'Cocos (Keeling) Islands (Australia)',NULL,NULL),
(49,'Colombia',NULL,NULL),
(50,'Comoros',NULL,NULL),
(51,'Congo',NULL,NULL),
(52,'Cook Islands',NULL,NULL),
(53,'Costa Rica',NULL,NULL),
(54,'Croatia',NULL,NULL),
(55,'Cuba',NULL,NULL),
(56,'Cura?ao (Netherlands)',NULL,NULL),
(57,'Cyprus',NULL,NULL),
(58,'Czech Republic',NULL,NULL),
(59,'Denmark',NULL,NULL),
(60,'Djibouti',NULL,NULL),
(61,'Dominica',NULL,NULL),
(62,'Dominican Republic',NULL,NULL),
(63,'DR Congo',NULL,NULL),
(64,'East Timor',NULL,NULL),
(65,'Ecuador',NULL,NULL),
(66,'Egypt',NULL,NULL),
(67,'El Salvador',NULL,NULL),
(68,'Equatorial Guinea',NULL,NULL),
(69,'Eritrea',NULL,NULL),
(70,'Estonia',NULL,NULL),
(71,'Eswatini',NULL,NULL),
(72,'Ethiopia',NULL,NULL),
(73,'Falkland Islands (BOT)',NULL,NULL),
(74,'Faroe Islands (Denmark)',NULL,NULL),
(75,'Fiji',NULL,NULL),
(76,'Finland',NULL,NULL),
(77,'France',NULL,NULL),
(78,'French Guiana (France)',NULL,NULL),
(79,'French Polynesia (France)',NULL,NULL),
(80,'Gabon',NULL,NULL),
(81,'Gambia',NULL,NULL),
(82,'Georgia',NULL,NULL),
(83,'Germany',NULL,NULL),
(84,'Ghana',NULL,NULL),
(85,'Gibraltar (BOT)',NULL,NULL),
(86,'Greece',NULL,NULL),
(87,'Greenland (Denmark)',NULL,NULL),
(88,'Grenada',NULL,NULL),
(89,'Guadeloupe (France)',NULL,NULL),
(90,'Guam (US)',NULL,NULL),
(91,'Guatemala',NULL,NULL),
(92,'Guernsey (Crown Dependency)',NULL,NULL),
(93,'Guinea',NULL,NULL),
(94,'Guinea-Bissau',NULL,NULL),
(95,'Guyana',NULL,NULL),
(96,'Haiti',NULL,NULL),
(97,'Honduras',NULL,NULL),
(98,'Hong Kong',NULL,NULL),
(99,'Hungary',NULL,NULL),
(100,'Iceland',NULL,NULL),
(101,'India',NULL,NULL),
(102,'Indonesia',NULL,NULL),
(103,'Iran',NULL,NULL),
(104,'Iraq',NULL,NULL),
(105,'Ireland',NULL,NULL),
(106,'Isle of Man (Crown Dependency)',NULL,NULL),
(107,'Israel',NULL,NULL),
(108,'Italy',NULL,NULL),
(109,'Ivory Coast',NULL,NULL),
(110,'Jamaica',NULL,NULL),
(111,'Japan',NULL,NULL),
(112,'Jersey (Crown Dependency)',NULL,NULL),
(113,'Jordan',NULL,NULL),
(114,'Kazakhstan',NULL,NULL),
(115,'Kenya',NULL,NULL),
(116,'Kiribati',NULL,NULL),
(117,'Kosovo',NULL,NULL),
(118,'Kuwait',NULL,NULL),
(119,'Kyrgyzstan',NULL,NULL),
(120,'Laos',NULL,NULL),
(121,'Latvia',NULL,NULL),
(122,'Lebanon',NULL,NULL),
(123,'Lesotho',NULL,NULL),
(124,'Liberia',NULL,NULL),
(125,'Libya',NULL,NULL),
(126,'Liechtenstein',NULL,NULL),
(127,'Lithuania',NULL,NULL),
(128,'Luxembourg',NULL,NULL),
(129,'Macau',NULL,NULL),
(130,'Madagascar',NULL,NULL),
(131,'Malawi',NULL,NULL),
(132,'Malaysia',NULL,NULL),
(133,'Maldives',NULL,NULL),
(134,'Mali',NULL,NULL),
(135,'Malta',NULL,NULL),
(136,'Marshall Islands',NULL,NULL),
(137,'Martinique (France)',NULL,NULL),
(138,'Mauritania',NULL,NULL),
(139,'Mauritius',NULL,NULL),
(140,'Mayotte (France)',NULL,NULL),
(141,'Mexico',NULL,NULL),
(142,'Micronesia',NULL,NULL),
(143,'Moldova',NULL,NULL),
(144,'Monaco',NULL,NULL),
(145,'Mongolia',NULL,NULL),
(146,'Montenegro',NULL,NULL),
(147,'Montserrat (BOT)',NULL,NULL),
(148,'Morocco',NULL,NULL),
(149,'Mozambique',NULL,NULL),
(150,'Myanmar',NULL,NULL),
(151,'Namibia',NULL,NULL),
(152,'Nauru',NULL,NULL),
(153,'Nepal',NULL,NULL),
(154,'Netherlands',NULL,NULL),
(155,'New Caledonia (France)',NULL,NULL),
(156,'New Zealand',NULL,NULL),
(157,'Nicaragua',NULL,NULL),
(158,'Niger',NULL,NULL),
(159,'Nigeria',NULL,NULL),
(160,'Niue',NULL,NULL),
(161,'Norfolk Island (Australia)',NULL,NULL),
(162,'North Korea',NULL,NULL),
(163,'North Macedonia',NULL,NULL),
(164,'Northern Cyprus',NULL,NULL),
(165,'Northern Mariana Islands (US)',NULL,NULL),
(166,'Norway',NULL,NULL),
(167,'Oman',NULL,NULL),
(168,'Pakistan',NULL,NULL),
(169,'Palau',NULL,NULL),
(170,'Palestine',NULL,NULL),
(171,'Panama',NULL,NULL),
(172,'Papua New Guinea',NULL,NULL),
(173,'Paraguay',NULL,NULL),
(174,'Peru',NULL,NULL),
(175,'Philippines',NULL,NULL),
(176,'Pitcairn Islands (BOT)',NULL,NULL),
(177,'Poland',NULL,NULL),
(178,'Portugal',NULL,NULL),
(179,'Puerto Rico (US)',NULL,NULL),
(180,'Qatar',NULL,NULL),
(181,'R?union (France)',NULL,NULL),
(182,'Romania',NULL,NULL),
(183,'Russia',NULL,NULL),
(184,'Rwanda',NULL,NULL),
(185,'Saba (Netherlands)',NULL,NULL),
(186,'Saint Barth?lemy (France)',NULL,NULL),
(187,'Saint Helena, Ascension and Tristan da Cunha (BOT)',NULL,NULL),
(188,'Saint Kitts and Nevis',NULL,NULL),
(189,'Saint Lucia',NULL,NULL),
(190,'Saint Martin (France)',NULL,NULL),
(191,'Saint Pierre and Miquelon (France)',NULL,NULL),
(192,'Saint Vincent and the Grenadines',NULL,NULL),
(193,'Samoa',NULL,NULL),
(194,'San Marino',NULL,NULL),
(195,'S?o Tom? and Pr?ncipe',NULL,NULL),
(196,'Saudi Arabia',NULL,NULL),
(197,'Senegal',NULL,NULL),
(198,'Serbia',NULL,NULL),
(199,'Seychelles',NULL,NULL),
(200,'Sierra Leone',NULL,NULL),
(201,'Singapore',NULL,NULL),
(202,'Sint Eustatius (Netherlands)',NULL,NULL),
(203,'Sint Maarten (Netherlands)',NULL,NULL),
(204,'Slovakia',NULL,NULL),
(205,'Slovenia',NULL,NULL),
(206,'Solomon Islands',NULL,NULL),
(207,'Somalia',NULL,NULL),
(208,'South Africa',NULL,NULL),
(209,'South Korea',NULL,NULL),
(210,'South Sudan',NULL,NULL),
(211,'Spain',NULL,NULL),
(212,'Sri Lanka',NULL,NULL),
(213,'Sudan',NULL,NULL),
(214,'Suriname',NULL,NULL),
(215,'Svalbard and Jan Mayen (Norway)',NULL,NULL),
(216,'Sweden',NULL,NULL),
(217,'Switzerland',NULL,NULL),
(218,'Syria',NULL,NULL),
(219,'Taiwan',NULL,NULL),
(220,'Tajikistan',NULL,NULL),
(221,'Tanzania',NULL,NULL),
(222,'Thailand',NULL,NULL),
(223,'Togo',NULL,NULL),
(224,'Tokelau (NZ)',NULL,NULL),
(225,'Tonga',NULL,NULL),
(226,'Transnistria',NULL,NULL),
(227,'Trinidad and Tobago',NULL,NULL),
(228,'Tunisia',NULL,NULL),
(229,'Turkey',NULL,NULL),
(230,'Turkmenistan',NULL,NULL),
(231,'Turks and Caicos Islands (BOT)',NULL,NULL),
(232,'Tuvalu',NULL,NULL),
(233,'U.S. Virgin Islands (US)',NULL,NULL),
(234,'Uganda',NULL,NULL),
(235,'Ukraine',NULL,NULL),
(236,'United Arab Emirates',NULL,NULL),
(237,'United Kingdom',NULL,NULL),
(238,'United States',NULL,NULL),
(239,'Uruguay',NULL,NULL),
(240,'Uzbekistan',NULL,NULL),
(241,'Vanuatu',NULL,NULL),
(242,'Vatican City',NULL,NULL),
(243,'Venezuela',NULL,NULL),
(244,'Vietnam',NULL,NULL),
(245,'Wallis and Futuna (France)',NULL,NULL),
(246,'Western Sahara',NULL,NULL),
(247,'Yemen',NULL,NULL),
(248,'Zambia',NULL,NULL),
(249,'Zimbabwe',NULL,NULL);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pending_selections` */

DROP TABLE IF EXISTS `pending_selections`;

CREATE TABLE `pending_selections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancyid` int NOT NULL,
  `userid` int NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pending_selections` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `proffessional_memberships` */

DROP TABLE IF EXISTS `proffessional_memberships`;

CREATE TABLE `proffessional_memberships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `proffBody` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memberNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memberCertificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `proffessional_memberships` */

insert  into `proffessional_memberships`(`id`,`userid`,`proffBody`,`memberNumber`,`memberCertificate`,`created_at`,`updated_at`,`active`) values 
(1,3,'ISACA','872','upload/proffmemb/PM-1.pdf','2025-03-28 16:45:17','2025-03-28 16:45:17',1);

/*Table structure for table `proffessional_quals` */

DROP TABLE IF EXISTS `proffessional_quals`;

CREATE TABLE `proffessional_quals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `institutionName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date DEFAULT NULL,
  `exitDate` date NOT NULL,
  `grade` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entryDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `proffessional_quals` */

insert  into `proffessional_quals`(`id`,`userid`,`institutionName`,`courseName`,`startDate`,`exitDate`,`grade`,`certificate`,`entryDate`,`created_at`,`updated_at`) values 
(1,3,'JKUAT','Computer Science',NULL,'2025-03-28','PASS','upload/proffqual/PQ-1.pdf','2025-03-28','2025-03-28 16:44:58','2025-03-28 16:44:58');

/*Table structure for table `recruitments` */

DROP TABLE IF EXISTS `recruitments`;

CREATE TABLE `recruitments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startDate` date NOT NULL,
  `closeDate` date NOT NULL,
  `approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `justification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `recruitments` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

/*Table structure for table `selection_d_b_queries` */

DROP TABLE IF EXISTS `selection_d_b_queries`;

CREATE TABLE `selection_d_b_queries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancyid` int NOT NULL,
  `userid` int NOT NULL,
  `query` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bindings` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `selection_d_b_queries` */

/*Table structure for table `selection_stages` */

DROP TABLE IF EXISTS `selection_stages`;

CREATE TABLE `selection_stages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jobapplicationid` int NOT NULL,
  `vacancyid` int DEFAULT NULL,
  `stage` int NOT NULL,
  `StageID` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` bigint NOT NULL,
  `queryid` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `selection_stages` */

/*Table structure for table `shortling_stages` */

DROP TABLE IF EXISTS `shortling_stages`;

CREATE TABLE `shortling_stages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stage` int NOT NULL,
  `criteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacancyid` int NOT NULL,
  `userid` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `shortling_stages` */

/*Table structure for table `shortlisting_loggers` */

DROP TABLE IF EXISTS `shortlisting_loggers`;

CREATE TABLE `shortlisting_loggers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancyid` int DEFAULT NULL,
  `stage` int NOT NULL,
  `applicationid` int NOT NULL,
  `userid` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `shortlisting_loggers` */

/*Table structure for table `stage2_evaluations_archive` */

DROP TABLE IF EXISTS `stage2_evaluations_archive`;

CREATE TABLE `stage2_evaluations_archive` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stage2_evaluations_archive` */

/*Table structure for table `temp_in_selections` */

DROP TABLE IF EXISTS `temp_in_selections`;

CREATE TABLE `temp_in_selections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jobapplicationid` int NOT NULL,
  `vacancyid` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `temp_in_selections` */

/*Table structure for table `tempjobapplications` */

DROP TABLE IF EXISTS `tempjobapplications`;

CREATE TABLE `tempjobapplications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancyid` int NOT NULL,
  `userid` int NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tempjobapplications` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `must_change` tinyint(1) NOT NULL DEFAULT '0',
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_number` int DEFAULT NULL,
  `passcode` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adak_role` int DEFAULT NULL COMMENT '0-Superadmin,1-admin,2-HR Admin,3-Shortlisting Panel',
  `title` int DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `idnumber` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kra` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int NOT NULL,
  `nationality` int NOT NULL,
  `ethnicity` int NOT NULL,
  `county` int NOT NULL,
  `constituency` int NOT NULL,
  `postal_address` int DEFAULT NULL,
  `postal_code` int DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital` int NOT NULL,
  `disability` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `disabilitydescription` text COLLATE utf8mb4_unicode_ci,
  `disability_cert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_certifications` int NOT NULL DEFAULT '0',
  `no_experience` int NOT NULL DEFAULT '0',
  `years_of_experience` int DEFAULT NULL,
  `leadership` int NOT NULL DEFAULT '0',
  `no_membership` int NOT NULL DEFAULT '0',
  `level` int NOT NULL DEFAULT '1' COMMENT '1-Account,2-profile,3-education,4-proffessional,5-membership,6-leadership,7-documents',
  `status` int DEFAULT '0',
  `panel_role` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacancy_id` int DEFAULT NULL,
  `highest_academic_level` int DEFAULT NULL,
  `highest_weight` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disability_reg` tinyint(1) NOT NULL DEFAULT '0',
  `disability_desc` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`other_name`,`last_name`,`email`,`email_verified_at`,`password`,`must_change`,`user_type`,`staff_number`,`passcode`,`phone`,`photo`,`remember_token`,`role`,`adak_role`,`title`,`dob`,`age`,`idnumber`,`kra`,`gender`,`nationality`,`ethnicity`,`county`,`constituency`,`postal_address`,`postal_code`,`city`,`marital`,`disability`,`disabilitydescription`,`disability_cert`,`no_certifications`,`no_experience`,`years_of_experience`,`leadership`,`no_membership`,`level`,`status`,`panel_role`,`vacancy_id`,`highest_academic_level`,`highest_weight`,`created_at`,`updated_at`,`last_login_time`,`last_login_ip`,`disability_reg`,`disability_desc`) values 
(1,'Canjetan',NULL,'Ngahu','canjetan.ngahu@icta.go.ke','2024-06-03 11:13:38','$2y$10$IDaGCdYTvGZDKG8Dl40XFeFh2Px0wsuVGBDjbSuCNjvkDKsLmb8hu',0,NULL,NULL,NULL,NULL,NULL,NULL,'admin',2,NULL,NULL,NULL,'','',0,115,0,0,0,NULL,NULL,NULL,0,'No',NULL,NULL,0,0,NULL,0,0,1,0,NULL,NULL,NULL,NULL,'2024-06-03 10:20:58','2025-01-18 11:22:39','2025-01-18 11:22:39','197.156.146.243',0,NULL),
(2,'Admin',NULL,'ICTA','admin@icta.go.ke','2024-06-03 02:22:43','$2y$10$IDaGCdYTvGZDKG8Dl40XFeFh2Px0wsuVGBDjbSuCNjvkDKsLmb8hu',0,NULL,NULL,NULL,NULL,NULL,NULL,'admin',2,NULL,NULL,NULL,'','',0,115,0,0,0,NULL,NULL,NULL,0,'No',NULL,NULL,0,0,NULL,0,0,1,0,NULL,NULL,NULL,NULL,'2024-06-03 02:22:07','2025-01-18 11:20:01','2025-01-18 11:20:01','197.237.188.206',0,NULL),
(3,'Nita','Autumn Joyce','Horton','pikawyz@mailinator.com','2025-03-28 16:35:48','$2y$10$0XRj754Osprg7fjnczf.R.mGP6JCgJyjwaUdFkdaSGkHup7YlYYzu',0,NULL,NULL,NULL,'526',NULL,NULL,'applicant',NULL,7,'1983-01-23',42,'931','',3,115,40,44,254,95,NULL,'Optio eos eveniet',5,'Yes','PWD/20/2000','upload/disability/3.pdf',1,1,0,1,1,8,0,NULL,NULL,5,7,'2025-03-28 16:39:39','2025-03-31 14:55:49','2025-03-31 14:55:49','127.0.0.1',1,NULL);

/*Table structure for table `vacancies` */

DROP TABLE IF EXISTS `vacancies`;

CREATE TABLE `vacancies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Recruitmentid` int NOT NULL,
  `jobTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobDescription` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobSpecification` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `positionCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Positions` int NOT NULL,
  `VacancyReference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `competence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `jobtype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_salary` int DEFAULT NULL,
  `max_salary` int DEFAULT NULL,
  `job_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'External',
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vacancies` */

/*Table structure for table `vacancy_documents` */

DROP TABLE IF EXISTS `vacancy_documents`;

CREATE TABLE `vacancy_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancy_id` int NOT NULL,
  `document_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vacancy_documents` */

insert  into `vacancy_documents`(`id`,`vacancy_id`,`document_id`,`created_at`,`updated_at`) values 
(1,2,6,NULL,NULL),
(2,2,7,NULL,NULL),
(6,1,6,NULL,NULL),
(7,1,7,NULL,NULL);

/*Table structure for table `vacancy_resets` */

DROP TABLE IF EXISTS `vacancy_resets`;

CREATE TABLE `vacancy_resets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancyid` int NOT NULL,
  `userid` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vacancy_resets` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
