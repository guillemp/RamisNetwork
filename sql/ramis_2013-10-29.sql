# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: ramis
# Generation Time: 2013-10-29 08:42:40 +0000
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
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;

INSERT INTO `courses` (`course_id`, `course_name`)
VALUES
	(1,'1r ESO'),
	(2,'2n ESO'),
	(3,'3r ESO'),
	(4,'4t ESO'),
	(5,'1r PQPI'),
	(6,'2n PQPI'),
	(7,'1r Batxillerat'),
	(8,'2n Batxillerat'),
	(9,'1r Batxillerat dist.'),
	(10,'2n Batxillerat dist.'),
	(11,'1r SMX'),
	(12,'2n SMX'),
	(13,'1r DAW'),
	(14,'2n DAW');

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
	(14,16,1,0);

/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
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
	(44,'user_new',0,16,'','2013-10-28 18:03:19');

/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photos`;

CREATE TABLE `photos` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `photo_user` int(11) NOT NULL DEFAULT '0',
  `photo_name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  PRIMARY KEY (`post_id`),
  KEY `post_link` (`post_link`),
  KEY `post_type` (`post_type`),
  KEY `post_parent` (`post_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`post_id`, `post_author`, `post_type`, `post_link`, `post_content`, `post_date`, `post_parent`)
VALUES
	(1,1,'wall',5,'ola k ase','2013-10-12 19:26:38',0),
	(2,1,'wall',5,'Hola Nuria k ase, faig proves de posts','2013-10-12 19:26:38',0),
	(3,1,'wall',5,'jiojiojoij','2013-10-12 19:34:59',0),
	(4,1,'wall',5,'mira que si va, flipes','2013-10-12 19:35:32',0),
	(6,3,'wall',5,'quina teniu liada per aqui','2013-10-12 19:40:08',0),
	(7,3,'wall',3,'hola com estic avui??','2013-10-12 19:42:18',0),
	(8,3,'wall',7,'wepppp com va??','2013-10-12 19:52:52',0),
	(9,3,'wall',7,'jiojj','2013-10-12 20:00:34',0),
	(10,3,'wall',7,'jiojj','2013-10-12 20:01:13',0),
	(11,3,'wall',7,'hiuhu','2013-10-12 20:01:17',0),
	(12,3,'wall',2,'pacooooooooooo','2013-10-12 20:02:21',0),
	(13,3,'wall',8,'carolina!!!','2013-10-12 20:06:15',0),
	(14,3,'wall',8,'prova de logs','2013-10-12 20:13:42',0),
	(15,3,'wall',8,'jsdif sdjfoisdj foisdjf sdiofjsdfiodsfj','2013-10-12 20:14:31',0),
	(16,3,'wall',3,'hola','2013-10-12 20:47:51',0),
	(17,3,'wall',3,'huihiuhiuhiu','2013-10-12 20:51:05',0),
	(18,3,'wall',11,'pasa julioooooo','2013-10-12 20:51:23',0),
	(19,3,'wall',4,'hola juan','2013-10-12 20:51:32',0),
	(20,11,'wall',2,'com va paco??','2013-10-13 20:49:39',0),
	(21,11,'wall',2,'djfivdfjlj','2013-10-13 20:50:57',0),
	(22,11,'wall',10,'david, te voy a matar!','2013-10-13 20:52:15',0),
	(23,0,'wall',1,'huhuhu','2013-10-14 10:13:13',0),
	(24,1,'wall',1,'huihiuhuih','2013-10-14 10:13:48',0),
	(25,1,'wall',9,'eh pablo!','2013-10-14 10:20:31',0),
	(26,1,'wall',1,'jiji','2013-10-14 17:00:21',0),
	(27,11,'wall',5,'jxiojvioj','2013-10-14 17:10:30',0),
	(28,11,'wall',1,'hola','2013-10-14 17:13:05',0),
	(29,11,'wall',10,'jijiji','2013-10-14 17:17:02',0),
	(30,12,'wall',12,'hola','2013-10-20 12:53:36',0),
	(31,13,'wall',1,'hola soy lola','2013-10-20 13:07:54',0),
	(32,13,'wall',13,'hola soy lola','2013-10-20 13:10:40',0),
	(33,1,'wall',1,'uyguyguyg','2013-10-22 17:21:15',0),
	(34,1,'wall',11,'gytgyguyg','2013-10-22 17:21:23',0),
	(35,1,'wall',7,'hola','2013-10-22 17:56:44',0),
	(36,1,'wall',7,'sdhcui sdchdsu ichdisu chdiuhcdi hsdcuidsch uidshc udisch disuchdsu ichsdu cihdsc uidshc uidschdisu chdsu ichdscu isdhcudis chsduic hdsuichdiu chdsuci dcuhsdc uisdhcuisd hcsudihcsdu ichdsciu sdhcsduich dsich ucisdhcsduic hisdch uidshc iusdchsduic hdsucds hcdsuicds cudhscuisd cshd :)','2013-10-22 17:59:44',0),
	(37,1,'wall',3,'hola maria','2013-10-22 18:02:18',0),
	(38,1,'wall',6,'hola albert','2013-10-22 18:04:28',0),
	(39,1,'wall',13,'ponte foto lola','2013-10-22 18:07:34',0),
	(40,1,'wall',1,'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','2013-10-22 18:12:13',0),
	(41,1,'wall',1,'hola hola','2013-10-22 18:18:41',0),
	(42,14,'wall',11,'ei, ya estoy registrado!!!','2013-10-25 20:10:27',0),
	(43,15,'wall',14,'Hola pepe! com va?','2013-10-25 20:13:49',0),
	(44,15,'wall',15,'Este es mi muro :P','2013-10-25 20:14:21',0),
	(45,15,'wall',12,'ponte foto uron!','2013-10-25 20:15:35',0),
	(46,1,'wall',10,'Hola David!','2013-10-25 20:32:33',0),
	(47,10,'wall',1,'hola guillem he vist es teu missatge!','2013-10-25 20:50:49',0),
	(48,10,'wall',2,'hola pacooooo','2013-10-25 20:55:08',0),
	(49,1,'wall',14,'h','2013-10-27 19:31:16',0),
	(50,1,'wall',14,'Fem una prova d\'un comentari un poc més llarg per veure com queden els links de la part inferior...','2013-10-27 19:34:27',0),
	(51,1,'wall',11,'Uep Julio com va?','2013-10-27 19:49:32',0),
	(52,1,'wall',15,'Hola Laia, provo les friend requests','2013-10-28 17:35:16',0);

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
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `birthday`, `gender`, `avatar`, `course`, `privacy`)
VALUES
	(1,'Guillem','Pagès','guillem@iesjoanramis.org','c1ebb4933e06ce5617483f665e26627c','1983-03-10',1,'526ab2711ec18.jpg',14,0),
	(2,'Paco','Ramiz','paco@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1993-02-15',1,'user2.jpg',8,0),
	(3,'Maria','Perez','maria@iesjoanramis.org','9de37a0627c25684fdd519ca84073e34','1993-02-15',2,'user3.jpg',2,0),
	(4,'Juan','Sanchez','juan@iesjoanramis.org','3b6281fa2ce2b6c20669490ef4b026a4','2000-05-09',1,'',5,0),
	(5,'Nuria','Melero','nura@iesjoanramis.org','f7c0e071db137f5ae65382041c7cef4b','1986-08-16',2,'user5.jpg',14,0),
	(6,'Albert','Garcia','albert@iesjoanramis.org','74b87337454200d4d33f80c4663dc5e5','1989-11-29',1,'user6.jpg',12,0),
	(7,'Paula','Pons','paula@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1990-01-06',2,'user7.jpg',11,0),
	(8,'Carolina','Melez','carolina@iesjoanramis.org','41fcba09f2bdcdf315ba4119dc7978dd','1984-06-09',2,'user8.jpg',1,0),
	(9,'Pablo','Seguí','pablo@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1999-08-20',1,'user9.jpg',3,0),
	(10,'David','Fernandez','david@iesjoanramis.org','11ddbaf3386aea1f2974eee984542152','1982-03-15',1,'user10.jpg',7,0),
	(11,'Julio','Escobar','julio@iesjoanramis.org','3b6281fa2ce2b6c20669490ef4b026a4','1995-12-06',1,'user11.jpg',9,0),
	(12,'uron','pongo','uron@iesjoanramis.org','3fcf6748deb8c48fcbfef4a9cd6e55a0','0000-00-00',2,'',0,0),
	(13,'lola','fernandez','lola@iesjoanramis.org','562b530cff1f5bca3b1a4c1ad4ad9962','1980-01-01',2,'',0,0),
	(14,'Pepe','Botella','pepe@iesjoanramis.org','2d7acadf10224ffdabeab505970a8934','1990-02-02',1,'526ab3e854abb.jpg',0,0),
	(15,'Laia','Marodio','laia@iesjoanramis.org','562b530cff1f5bca3b1a4c1ad4ad9962','1983-07-02',2,'526ab4ba062b4.jpg',0,0),
	(16,'fanta','de naranja','fanta@iesjoanramis.org','ece926d8c0356205276a45266d361161','1994-05-03',2,'',0,0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
