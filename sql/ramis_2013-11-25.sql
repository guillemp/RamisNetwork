# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: ramis
# Generation Time: 2013-11-25 15:42:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `course_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL DEFAULT '',
  `course_description` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`)
VALUES
	(1,'1r ESO',''),
	(2,'2n ESO',''),
	(3,'3r ESO',''),
	(4,'4t ESO',''),
	(5,'1r PQPI',''),
	(6,'2n PQPI',''),
	(7,'1r Batxillerat',''),
	(8,'2n Batxillerat',''),
	(9,'1r Batxillerat dist.',''),
	(10,'2n Batxillerat dist.',''),
	(11,'1r SMX',''),
	(12,'2n SMX',''),
	(13,'1r DAW',''),
	(14,'2n DAW','');

/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table friends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `friend_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `friend_from` int(11) NOT NULL DEFAULT '0',
  `friend_to` int(11) NOT NULL DEFAULT '0',
  `friend_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;

INSERT INTO `friends` (`friend_id`, `friend_from`, `friend_to`, `friend_status`)
VALUES
	(1,1,6,1),
	(3,1,3,1),
	(4,1,11,1),
	(5,14,11,1),
	(6,1,9,0),
	(7,1,10,1),
	(8,1,8,0),
	(11,1,8,0),
	(13,15,1,0),
	(14,16,1,0),
	(15,15,10,0),
	(16,1,13,0),
	(17,1,13,0);

/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(20) NOT NULL DEFAULT '',
  `link` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`id`, `type`, `link`, `user`)
VALUES
	(1,'post',47,1),
	(2,'post',66,1),
	(3,'post',31,1),
	(4,'post',61,15),
	(5,'post',41,15),
	(6,'post',24,15),
	(7,'post',61,10),
	(8,'post',41,10),
	(9,'post',67,11),
	(10,'post',68,7),
	(11,'post',11,1),
	(12,'',27,3),
	(13,'post',69,1),
	(14,'post',67,1),
	(15,'post',68,1),
	(16,'post',27,1);

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_type` char(20) NOT NULL DEFAULT '',
  `log_link` int(11) NOT NULL DEFAULT '0',
  `log_user` int(11) NOT NULL DEFAULT '0',
  `log_comment` text NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;

INSERT INTO `logs` (`log_id`, `log_type`, `log_link`, `log_user`, `log_comment`, `log_date`)
VALUES
	(1,'post_new',8,3,'prova de logs','2013-10-12 20:13:42'),
	(2,'post_new',8,3,'jsdif sdjfoisdj foisdjf sdiofjsdfiodsfj','2013-10-12 20:14:31'),
	(3,'post_new',3,3,'hola','2013-10-12 20:47:51'),
	(4,'post_new',3,3,'huihiuhiuhiu','2013-10-12 20:51:05'),
	(5,'post_new',11,3,'pasa julioooooo','2013-10-12 20:51:23'),
	(6,'post_new',4,3,'hola juan','2013-10-12 20:51:32'),
	(7,'post_new',2,11,'com va paco??','2013-10-13 20:49:39'),
	(8,'post_new',2,11,'djfivdfjlj','2013-10-13 20:50:57'),
	(9,'post_new',10,11,'david, te voy a matar!','2013-10-13 20:52:15'),
	(10,'post_new',1,0,'huhuhu','2013-10-14 10:13:13'),
	(11,'post_new',1,1,'huihiuhuih','2013-10-14 10:13:48'),
	(12,'post_new',9,1,'eh pablo!','2013-10-14 10:20:31'),
	(13,'post_new',1,1,'jiji','2013-10-14 17:00:21'),
	(14,'post_new',5,11,'jxiojvioj','2013-10-14 17:10:30'),
	(15,'post_new',28,11,'hola','2013-10-14 17:13:05'),
	(16,'post_new',29,11,'jijiji','2013-10-14 17:17:02'),
	(17,'user_new',0,12,'','2013-10-20 12:52:31'),
	(18,'post_new',30,12,'hola','2013-10-20 12:53:36'),
	(19,'user_new',0,13,'','2013-10-20 12:56:34'),
	(20,'post_new',31,13,'hola soy lola','2013-10-20 13:07:54'),
	(21,'post_new',32,13,'hola soy lola','2013-10-20 13:10:40'),
	(22,'post_new',33,1,'uyguyguyg','2013-10-22 17:21:15'),
	(23,'post_new',34,1,'gytgyguyg','2013-10-22 17:21:23'),
	(24,'post_new',35,1,'hola','2013-10-22 17:56:44'),
	(25,'post_new',36,1,'sdhcui sdchdsu ichdisu chdiuhcdi hsdcuidsch uidshc udisch disuchdsu ichsdu cihdsc uidshc uidschdisu chdsu ichdscu isdhcudis chsduic hdsuichdiu chdsuci dcuhsdc uisdhcuisd hcsudihcsdu ichdsciu sdhcsduich dsich ucisdhcsduic hisdch uidshc iusdchsduic hdsucds hcdsuicds cudhscuisd cshd :)','2013-10-22 17:59:44'),
	(26,'post_new',37,1,'hola maria','2013-10-22 18:02:18'),
	(27,'post_new',38,1,'hola albert','2013-10-22 18:04:28'),
	(28,'post_new',39,1,'ponte foto lola','2013-10-22 18:07:34'),
	(29,'post_new',40,1,'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','2013-10-22 18:12:13'),
	(30,'post_new',41,1,'hola hola','2013-10-22 18:18:41'),
	(31,'user_new',0,14,'','2013-10-25 20:08:43'),
	(32,'post_new',42,14,'ei, ya estoy registrado!!!','2013-10-25 20:10:27'),
	(33,'user_new',0,15,'','2013-10-25 20:12:31'),
	(34,'post_new',43,15,'Hola pepe! com va?','2013-10-25 20:13:49'),
	(35,'post_new',44,15,'Este es mi muro :P','2013-10-25 20:14:21'),
	(36,'post_new',45,15,'ponte foto uron!','2013-10-25 20:15:35'),
	(37,'post_new',46,1,'Hola David!','2013-10-25 20:32:33'),
	(38,'post_new',47,10,'hola guillem he vist es teu missatge!','2013-10-25 20:50:49'),
	(39,'post_new',48,10,'hola pacooooo','2013-10-25 20:55:08'),
	(40,'post_new',49,1,'h','2013-10-27 19:31:16'),
	(41,'post_new',50,1,'Fem una prova d\'un comentari un poc més llarg per veure com queden els links de la part inferior...','2013-10-27 19:34:27'),
	(42,'post_new',51,1,'Uep Julio com va?','2013-10-27 19:49:32'),
	(43,'post_new',52,1,'Hola Laia, provo les friend requests','2013-10-28 17:35:16'),
	(44,'user_new',0,16,'','2013-10-28 18:03:19'),
	(45,'post_new',53,1,'Hola fanta!','2013-10-30 10:36:07'),
	(46,'post_new',54,1,'prova\r\nde\r\nintros\r\ndins\r\nun\r\nmissatge','2013-10-30 10:37:09'),
	(47,'post_new',55,1,'hola que tal','2013-10-31 16:46:29'),
	(48,'post_new',56,1,'prova que funciona','2013-10-31 16:47:50'),
	(49,'post_new',57,1,'jsiofjsdio fsdiof','2013-10-31 16:49:24'),
	(50,'post_new',58,1,'sdch oisdhfsu dhfsidu fhiu huh','2013-10-31 16:49:30'),
	(51,'post_new',59,1,'jsdcio sdhcio sdhsdio dhsio','2013-10-31 16:49:59'),
	(52,'post_new',60,1,'jsdcio sdhcio sdhsdio dhsio','2013-10-31 16:50:01'),
	(53,'post_new',61,1,'functiona el mur encara','2013-10-31 16:50:30'),
	(54,'post_new',62,1,'2n de daw','2013-10-31 16:51:51'),
	(55,'post_new',63,1,'hola PQPI','2013-10-31 17:11:42'),
	(56,'post_new',64,15,'Hola 2n DAW!!','2013-11-01 22:35:38'),
	(57,'post_new',65,15,'Hola Fanta! :)','2013-11-01 22:36:15'),
	(58,'post_new',66,15,'Pepooooot','2013-11-01 22:36:35'),
	(59,'post_like',41,15,'','2013-11-02 12:30:34'),
	(60,'post_like',24,15,'','2013-11-02 12:35:00'),
	(61,'post_like',61,10,'','2013-11-02 12:48:17'),
	(62,'post_like',41,10,'','2013-11-02 12:48:20'),
	(63,'post_new',67,10,'Com va guillem?','2013-11-02 13:00:46'),
	(64,'post_new',68,11,'Jo també provo les notificacions!','2013-11-02 13:14:25'),
	(65,'post_like',67,11,'','2013-11-02 13:15:06'),
	(66,'post_new',69,7,'Uhoooolaaaaaaaa','2013-11-02 13:50:45'),
	(67,'post_like',68,7,'','2013-11-02 13:51:13'),
	(68,'avatar_change',0,1,'','2013-11-02 13:57:36'),
	(69,'post_like',11,1,'','2013-11-02 16:59:41'),
	(70,'post_like',27,3,'','2013-11-02 17:04:17'),
	(71,'post_like',69,1,'','2013-11-02 17:23:42'),
	(72,'post_like',67,1,'','2013-11-02 17:45:52'),
	(73,'post_new',70,1,'jijoihioh','2013-11-02 17:58:21'),
	(74,'avatar_change',0,1,'','2013-11-08 20:01:29'),
	(75,'user_new',0,17,'','2013-11-08 20:07:23'),
	(76,'user_new',0,18,'','2013-11-08 20:16:35'),
	(77,'post_new',71,1,'hola Jose','2013-11-08 20:20:21'),
	(78,'avatar_change',0,1,'','2013-11-08 20:20:33'),
	(79,'avatar_change',0,1,'','2013-11-11 17:51:07'),
	(80,'avatar_change',0,1,'','2013-11-12 17:50:52'),
	(81,'avatar_change',0,1,'','2013-11-12 17:51:27'),
	(82,'avatar_change',0,1,'','2013-11-12 18:05:41'),
	(83,'photo_new',1,1,'photo_528e2a908f0cf.jpg','2013-11-21 16:45:20'),
	(84,'photo_new',2,1,'photo_528e2aea982a6.jpg','2013-11-21 16:46:50'),
	(85,'photo_new',3,1,'photo_528e2c2411064.jpg','2013-11-21 16:52:05'),
	(86,'photo_new',4,1,'photo_528e2f8ccfcc3.jpg','2013-11-21 17:06:37'),
	(87,'photo_new',5,1,'photo_528e3012f1bb5.jpg','2013-11-21 17:08:51'),
	(88,'photo_new',6,1,'photo_528e302f690f4.jpg','2013-11-21 17:09:20'),
	(89,'photo_new',1,1,'1528fa02f3235a','2013-11-22 19:19:29'),
	(90,'photo_new',2,1,'1528fa0bcecc01','2013-11-22 19:21:49'),
	(91,'photo_new',3,1,'1528fa156b6fa8','2013-11-22 19:24:23'),
	(92,'post_new',72,1,'hola a tots','2013-11-22 20:04:40'),
	(93,'post_like',68,1,'','2013-11-22 20:04:57'),
	(94,'post_like',27,1,'','2013-11-22 20:05:25'),
	(95,'user_new',0,19,'','2013-11-25 16:02:04'),
	(96,'user_new',0,20,'','2013-11-25 16:07:36'),
	(97,'post_new',73,20,'Mi primer post','2013-11-25 16:09:02'),
	(98,'post_new',74,20,'Hola gente de DAW 2 :)','2013-11-25 16:14:02'),
	(99,'post_new',75,20,'Hola gente de DAW 2 :)','2013-11-25 16:14:52'),
	(100,'course_post_new',76,20,'Prova de comentari a 1r d\'ESO','2013-11-25 16:22:40');

/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `notification_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type` char(20) NOT NULL,
  `notification_link` int(11) NOT NULL DEFAULT '0',
  `notification_from` int(11) NOT NULL DEFAULT '0',
  `notification_to` int(11) NOT NULL DEFAULT '0',
  `notification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`notification_id`, `notification_type`, `notification_link`, `notification_from`, `notification_to`, `notification_date`)
VALUES
	(4,'post_like',24,15,1,'2013-11-02 12:35:00'),
	(5,'post_like',61,10,1,'2013-11-02 12:48:17'),
	(6,'post_like',41,10,1,'2013-11-02 12:48:20'),
	(7,'post_new',67,10,1,'2013-11-02 13:00:46'),
	(8,'post_new',68,11,1,'2013-11-02 13:14:25'),
	(9,'post_like',67,11,10,'2013-11-02 13:15:06'),
	(10,'post_new',69,7,1,'2013-11-02 13:50:45'),
	(11,'post_like',68,7,11,'2013-11-02 13:51:13'),
	(12,'post_like',11,1,3,'2013-11-02 16:59:41'),
	(13,'post_like',27,3,11,'2013-11-02 17:04:17'),
	(14,'post_like',69,1,7,'2013-11-02 17:23:42'),
	(15,'post_like',67,1,10,'2013-11-02 17:45:52'),
	(16,'post_new',70,1,15,'2013-11-02 17:58:21'),
	(17,'post_new',71,1,17,'2013-11-08 20:20:21'),
	(18,'post_new',72,1,1,'2013-11-22 20:04:40'),
	(19,'post_like',68,1,11,'2013-11-22 20:04:57'),
	(20,'post_like',27,1,11,'2013-11-22 20:05:25'),
	(21,'post_new',73,20,20,'2013-11-25 16:09:02'),
	(22,'post_new',74,20,14,'2013-11-25 16:14:02'),
	(23,'post_new',75,20,14,'2013-11-25 16:14:52'),
	(24,'course_post_new',76,20,1,'2013-11-25 16:22:40');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photos`;

CREATE TABLE `photos` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `photo_author` int(11) NOT NULL DEFAULT '0',
  `photo_type` char(20) NOT NULL DEFAULT 'wall',
  `photo_link` int(11) NOT NULL DEFAULT '0',
  `photo_name` varchar(200) NOT NULL,
  `photo_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;

INSERT INTO `photos` (`photo_id`, `photo_author`, `photo_type`, `photo_link`, `photo_name`, `photo_date`)
VALUES
	(1,1,'wall',1,'1528fa02f3235a','2013-11-22 19:19:29'),
	(2,1,'wall',1,'1528fa0bcecc01','2013-11-22 19:21:49'),
	(3,1,'wall',1,'1528fa156b6fa8','2013-11-22 19:24:23');

/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` int(11) NOT NULL DEFAULT '0',
  `post_type` char(20) NOT NULL DEFAULT 'wall',
  `post_link` int(11) NOT NULL DEFAULT '0',
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_parent` int(11) NOT NULL DEFAULT '0',
  `post_likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `post_link` (`post_link`),
  KEY `post_type` (`post_type`),
  KEY `post_parent` (`post_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`post_id`, `post_author`, `post_type`, `post_link`, `post_content`, `post_date`, `post_parent`, `post_likes`)
VALUES
	(1,1,'wall',5,'ola k ase','2013-10-12 19:26:38',0,0),
	(2,1,'wall',5,'Hola Nuria k ase, faig proves de posts','2013-10-12 19:26:38',0,0),
	(3,1,'wall',5,'jiojiojoij','2013-10-12 19:34:59',0,0),
	(4,1,'wall',5,'mira que si va, flipes','2013-10-12 19:35:32',0,0),
	(6,3,'wall',5,'quina teniu liada per aqui','2013-10-12 19:40:08',0,0),
	(7,3,'wall',3,'hola com estic avui??','2013-10-12 19:42:18',0,0),
	(8,3,'wall',7,'wepppp com va??','2013-10-12 19:52:52',0,0),
	(9,3,'wall',7,'jiojj','2013-10-12 20:00:34',0,0),
	(10,3,'wall',7,'jiojj','2013-10-12 20:01:13',0,0),
	(11,3,'wall',7,'hiuhu','2013-10-12 20:01:17',0,1),
	(12,3,'wall',2,'pacooooooooooo','2013-10-12 20:02:21',0,0),
	(13,3,'wall',8,'carolina!!!','2013-10-12 20:06:15',0,0),
	(14,3,'wall',8,'prova de logs','2013-10-12 20:13:42',0,0),
	(15,3,'wall',8,'jsdif sdjfoisdj foisdjf sdiofjsdfiodsfj','2013-10-12 20:14:31',0,0),
	(16,3,'wall',3,'hola','2013-10-12 20:47:51',0,0),
	(17,3,'wall',3,'huihiuhiuhiu','2013-10-12 20:51:05',0,0),
	(18,3,'wall',11,'pasa julioooooo','2013-10-12 20:51:23',0,0),
	(19,3,'wall',4,'hola juan','2013-10-12 20:51:32',0,0),
	(20,11,'wall',2,'com va paco??','2013-10-13 20:49:39',0,0),
	(21,11,'wall',2,'djfivdfjlj','2013-10-13 20:50:57',0,0),
	(22,11,'wall',10,'david, te voy a matar!','2013-10-13 20:52:15',0,0),
	(23,0,'wall',1,'huhuhu','2013-10-14 10:13:13',0,0),
	(24,1,'wall',1,'huihiuhuih','2013-10-14 10:13:48',0,1),
	(25,1,'wall',9,'eh pablo!','2013-10-14 10:20:31',0,0),
	(26,1,'wall',1,'jiji','2013-10-14 17:00:21',0,0),
	(27,11,'wall',5,'jxiojvioj','2013-10-14 17:10:30',0,2),
	(28,11,'wall',1,'hola','2013-10-14 17:13:05',0,0),
	(29,11,'wall',10,'jijiji','2013-10-14 17:17:02',0,0),
	(30,12,'wall',12,'hola','2013-10-20 12:53:36',0,0),
	(31,13,'wall',1,'hola soy lola','2013-10-20 13:07:54',0,1),
	(32,13,'wall',13,'hola soy lola','2013-10-20 13:10:40',0,0),
	(33,1,'wall',1,'uyguyguyg','2013-10-22 17:21:15',0,0),
	(34,1,'wall',11,'gytgyguyg','2013-10-22 17:21:23',0,0),
	(35,1,'wall',7,'hola','2013-10-22 17:56:44',0,0),
	(36,1,'wall',7,'sdhcui sdchdsu ichdisu chdiuhcdi hsdcuidsch uidshc udisch disuchdsu ichsdu cihdsc uidshc uidschdisu chdsu ichdscu isdhcudis chsduic hdsuichdiu chdsuci dcuhsdc uisdhcuisd hcsudihcsdu ichdsciu sdhcsduich dsich ucisdhcsduic hisdch uidshc iusdchsduic hdsucds hcdsuicds cudhscuisd cshd :)','2013-10-22 17:59:44',0,0),
	(37,1,'wall',3,'hola maria','2013-10-22 18:02:18',0,0),
	(38,1,'wall',6,'hola albert','2013-10-22 18:04:28',0,0),
	(39,1,'wall',13,'ponte foto lola','2013-10-22 18:07:34',0,0),
	(40,1,'wall',1,'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','2013-10-22 18:12:13',0,0),
	(41,1,'wall',1,'hola hola','2013-10-22 18:18:41',0,2),
	(42,14,'wall',11,'ei, ya estoy registrado!!!','2013-10-25 20:10:27',0,0),
	(43,15,'wall',14,'Hola pepe! com va?','2013-10-25 20:13:49',0,0),
	(44,15,'wall',15,'Este es mi muro :P','2013-10-25 20:14:21',0,0),
	(45,15,'wall',12,'ponte foto uron!','2013-10-25 20:15:35',0,0),
	(46,1,'wall',10,'Hola David!','2013-10-25 20:32:33',0,0),
	(47,10,'wall',1,'hola guillem he vist es teu missatge!','2013-10-25 20:50:49',0,1),
	(48,10,'wall',2,'hola pacooooo','2013-10-25 20:55:08',0,0),
	(49,1,'wall',14,'h','2013-10-27 19:31:16',0,0),
	(50,1,'wall',14,'Fem una prova d\'un comentari un poc més llarg per veure com queden els links de la part inferior...','2013-10-27 19:34:27',0,0),
	(51,1,'wall',11,'Uep Julio com va?','2013-10-27 19:49:32',0,0),
	(52,1,'wall',15,'Hola Laia, provo les friend requests','2013-10-28 17:35:16',0,0),
	(53,1,'wall',16,'Hola fanta!','2013-10-30 10:36:07',0,0),
	(54,1,'wall',14,'prova\r\nde\r\nintros\r\ndins\r\nun\r\nmissatge','2013-10-30 10:37:09',0,0),
	(55,1,'course',1,'hola que tal','2013-10-31 16:46:29',0,0),
	(56,1,'wall',1,'prova que funciona','2013-10-31 16:47:50',0,0),
	(57,1,'course',1,'jsiofjsdio fsdiof','2013-10-31 16:49:24',0,0),
	(58,1,'course',1,'sdch oisdhfsu dhfsidu fhiu huh','2013-10-31 16:49:30',0,0),
	(59,1,'course',1,'jsdcio sdhcio sdhsdio dhsio','2013-10-31 16:49:59',0,0),
	(60,1,'course',1,'jsdcio sdhcio sdhsdio dhsio','2013-10-31 16:50:01',0,0),
	(61,1,'wall',1,'functiona el mur encara','2013-10-31 16:50:30',0,2),
	(62,1,'course',14,'2n de daw','2013-10-31 16:51:51',0,0),
	(63,1,'course',5,'hola PQPI','2013-10-31 17:11:42',0,0),
	(64,15,'course',14,'Hola 2n DAW!!','2013-11-01 22:35:38',0,0),
	(65,15,'wall',16,'Hola Fanta! :)','2013-11-01 22:36:15',0,0),
	(66,15,'wall',1,'Pepooooot','2013-11-01 22:36:35',0,1),
	(67,10,'wall',1,'Com va guillem?','2013-11-02 13:00:46',0,2),
	(68,11,'wall',1,'Jo també provo les notificacions!','2013-11-02 13:14:25',0,2),
	(69,7,'wall',1,'Uhoooolaaaaaaaa','2013-11-02 13:50:45',0,1),
	(70,1,'private',15,'jijoihioh','2013-11-02 17:58:21',0,0),
	(71,1,'wall',17,'hola Jose','2013-11-08 20:20:21',0,0),
	(72,1,'wall',1,'hola a tots','2013-11-22 20:04:40',0,0),
	(73,20,'wall',20,'Mi primer post','2013-11-25 16:09:02',0,0),
	(74,20,'course',14,'Hola gente de DAW 2 :)','2013-11-25 16:14:02',0,0),
	(75,20,'course',14,'Hola gente de DAW 2 :)','2013-11-25 16:14:52',0,0),
	(76,20,'course',1,'Prova de comentari a 1r d\'ESO','2013-11-25 16:22:40',0,0);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `gender` tinyint(2) NOT NULL DEFAULT '0',
  `avatar` varchar(64) NOT NULL,
  `course` tinyint(3) NOT NULL DEFAULT '0',
  `privacy` tinyint(2) NOT NULL DEFAULT '0',
  `visits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `birthday`, `gender`, `avatar`, `course`, `privacy`, `visits`)
VALUES
	(1,'Guillem','Pagès','guillem@iesjoanramis.org','c1ebb4933e06ce5617483f665e26627c','1983-03-10',1,'52825fe58ff8b.jpg',14,0,18),
	(2,'Paco','Ramiz','paco@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1993-02-15',1,'user2.jpg',14,0,0),
	(3,'Maria','Perez','maria@iesjoanramis.org','9de37a0627c25684fdd519ca84073e34','1993-02-15',2,'user3.jpg',2,0,1),
	(4,'Juan','Sanchez','juan@iesjoanramis.org','3b6281fa2ce2b6c20669490ef4b026a4','2000-05-09',1,'',5,0,0),
	(5,'Nuria','Melero','nura@iesjoanramis.org','f7c0e071db137f5ae65382041c7cef4b','1986-08-16',2,'user5.jpg',14,0,3),
	(6,'Albert','Garcia','albert@iesjoanramis.org','74b87337454200d4d33f80c4663dc5e5','1989-11-29',1,'user6.jpg',12,0,0),
	(7,'Paula','Pons','paula@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1990-01-06',2,'user7.jpg',11,0,5),
	(8,'Carolina','Melez','carolina@iesjoanramis.org','41fcba09f2bdcdf315ba4119dc7978dd','1984-06-09',2,'user8.jpg',1,0,1),
	(9,'Pablo','Seguí','pablo@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1999-08-20',1,'user9.jpg',3,0,1),
	(10,'David','Fernandez','david@iesjoanramis.org','11ddbaf3386aea1f2974eee984542152','1982-03-15',1,'user10.jpg',7,0,5),
	(11,'Julio','Escobar','julio@iesjoanramis.org','3b6281fa2ce2b6c20669490ef4b026a4','1995-12-06',1,'user11.jpg',14,0,11),
	(12,'uron','pongo','uron@iesjoanramis.org','3fcf6748deb8c48fcbfef4a9cd6e55a0','1993-08-09',2,'',9,0,0),
	(13,'lola','fernandez','lola@iesjoanramis.org','562b530cff1f5bca3b1a4c1ad4ad9962','1980-01-01',2,'',6,0,3),
	(14,'Pepe','Botella','pepe@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1990-02-02',1,'526ab3e854abb.jpg',14,0,1),
	(15,'Laia','Marodio','laia@iesjoanramis.org','562b530cff1f5bca3b1a4c1ad4ad9962','1983-07-02',2,'526ab4ba062b4.jpg',2,0,2),
	(16,'fanta','de naranja','fanta@iesjoanramis.org','ece926d8c0356205276a45266d361161','1994-05-03',2,'',8,0,0),
	(17,'Jose','Ramon','jose@iesjoanramis.org','3b6281fa2ce2b6c20669490ef4b026a4','1987-06-03',1,'',10,0,2),
	(18,'montse','rrat','montse@iesjoanramis.org','9de37a0627c25684fdd519ca84073e34','1990-04-04',2,'',11,0,0),
	(19,'Memo','Lo','memo@iesjoanramis.org','9de37a0627c25684fdd519ca84073e34','1983-05-02',1,'',5,0,0),
	(20,'Santi','Millan','santi@iesjoanramis.org','','1990-12-06',1,'',14,0,0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
