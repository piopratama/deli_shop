/*
SQLyog Professional v12.4.1 (64 bit)
MySQL - 10.1.25-MariaDB : Database - deli_shop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`deli_shop` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `deli_shop`;

/*Table structure for table `tb_barang` */

DROP TABLE IF EXISTS `tb_barang`;

CREATE TABLE `tb_barang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(100) NOT NULL,
  `price` float unsigned NOT NULL,
  `stock` float unsigned NOT NULL,
  `unit` varchar(100) NOT NULL,
  `kategori` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

/*Data for the table `tb_barang` */

insert  into `tb_barang`(`id`,`item`,`price`,`stock`,`unit`,`kategori`,`description`) values 
(2,'Benang Jarit Extra small',2000,50000,'bh',2,''),
(3,'Benang Jarit Extra (Pack)',18000,13,'pk',2,''),
(4,'Benang Nylon OWL',6000,0,'bh',0,''),
(5,'Benang Nylon OWL (Pack)',65000,0,'pk',0,''),
(6,'Benang Kasur Ali',3000,0,'bh',0,''),
(7,'Benang Kasur alibaba (Pack)',30000,0,'pk',0,''),
(8,'Benang Kasur B',7000,0,'bh',0,''),
(9,'Benang Kasur B (Pack)',40000,0,'pk',0,''),
(10,'Benang Kasur K',3000,0,'bh',0,''),
(11,'Benang KAsur K (Pack)',28000,0,'pk',0,''),
(12,'Benang Jean',5000,12,'bh',0,''),
(13,'Benang Jean (Pack)',48000,12,'pk',0,''),
(15,'Benang Metalic',13000,0,'bh',0,''),
(16,'Tali Cina',500,0,'m',0,''),
(17,'Tali Cina Jalin K',1000,0,'m',0,''),
(18,'Tali Cina Jalin Tg',2000,0,'m',0,''),
(19,'Tali BH',9000,0,'bh',0,''),
(20,'Tali BH (Pack)',136000,0,'pk',0,''),
(21,'Tali Plintir 0,5 mm',5000,0,'bh',0,''),
(22,'Tali Plintir 1 mm',7000,0,'bh',0,''),
(23,'Tali Plintir 2 mm',500,0,'m',0,''),
(24,'Tali Plintir 3 mm',750,0,'m',0,''),
(25,'Tali Plintir 4 mm',1000,0,'m',0,''),
(26,'Tali Plintir 5 mm',1300,0,'m',0,''),
(27,'Tali Plintir 6 mm',1500,0,'m',0,''),
(28,'Tali Plintir 7 mm',1700,0,'m',0,''),
(29,'Tali Plintir 8 mm',2000,0,'m',0,''),
(30,'Tali Rish',7000,0,'bh',0,''),
(31,'Tali Barang Karet',8000,0,'bh',0,''),
(32,'Tali Rapia K',2000,0,'bh',0,''),
(33,'Tali Rapia 1/4 kg',7000,0,'bh',0,''),
(34,'Tali Rapia 1/2 kg',12000,0,'bh',0,''),
(35,'Tali Rapia 1 kg',20000,0,'bh',0,''),
(36,'Sumbu Kompor',30000,0,'',0,''),
(37,'Tali Tasi 100 (rol)',3000,0,'rol',0,''),
(38,'Tali Tasi 200 (rol)',6000,0,'rol',0,''),
(39,'Tali Tasi 300 (rol)',8000,0,'rol',0,''),
(40,'Tali Tasi 400 (rol)',10000,0,'rol',0,''),
(41,'Tali Tasi 500 (rol)',13000,0,'rol',0,''),
(42,'Tali Tasi (rol)',16000,0,'rol',0,''),
(43,'Tali Tasi 1000',3500,0,'bh',0,''),
(44,'Tali Tasi 1000 (rol)',30000,0,'rol',0,''),
(45,'Tali Tasi 1200 ',4000,0,'bh',0,''),
(46,'Tali Tasi 1200 (rol)',38000,0,'rol',0,''),
(47,'Tali Tasi 1500',5000,0,'bh',0,''),
(48,'Tali Tasi 1500 (rol)',45000,0,'rol',0,''),
(49,'Tali Tasi 2000',6000,0,'bh',0,''),
(50,'Tali Tasi 2000 (rol)',55000,0,'rol',0,''),
(51,'Tali Tasi 2500',7000,0,'bh',0,''),
(52,'Tali Tasi 2500 (rol)',65000,0,'rol',0,''),
(53,'Tali Tasi 3000',8000,0,'bh',0,''),
(54,'Tali Tasi 3000 (rol)',75000,0,'rol',0,''),
(55,'Tali Tasi 3500',9000,0,'bh',0,''),
(56,'Tali Tasi 3500 (rol)',83000,0,'rol',0,''),
(57,'Tali Tasi 4000',10000,0,'bh',0,''),
(58,'Tali Tasi 4000 (rol)',93000,0,'rol',0,''),
(59,'Tali Tasi 5000',11000,0,'bh',0,''),
(60,'Tali Tasi 5000 (rol)',98000,0,'rol',0,''),
(61,'Tali Tasi 6000',13000,0,'bh',0,''),
(62,'Tali Tasi 6000 (rol)',123000,0,'rol',0,''),
(63,'Benang Kasur Tg',5000,0,'bh',0,''),
(64,'Benang Kasur Tg (pack)',28000,0,'pk',0,''),
(65,'Resleting 12,5 cm',1500,0,'bh',0,''),
(66,'Resleting 12,5 cm (lusin)',16000,0,'ls',0,''),
(67,'Resleting 15 cm',2000,0,'bh',0,''),
(68,'Resleting 15 cm (lusin)',20000,0,'ls',0,''),
(69,'Resleting 17 cm',2500,0,'bh',0,''),
(70,'Resleting 17 cm (lusin)',22000,0,'ls',0,''),
(71,'Resleting 20 cm',3000,0,'bh',0,''),
(72,'Resleting 20 cm (lusin)',25000,0,'ls',0,''),
(73,'Resleting 25 cm',3000,0,'bh',0,''),
(74,'Resleting 30 cm',3500,0,'bh',0,''),
(75,'Resleting 35 cm',3500,0,'bh',0,''),
(76,'Resleting 40 cm',4000,0,'bh',0,''),
(77,'Resleting 45 cm',4500,0,'bh',0,''),
(78,'Resleting 50 cm',5000,0,'bh',0,''),
(79,'Resleting Jean 12,5 cm',3500,0,'bh',0,''),
(80,'Resleting Jean 12,5 cm (lusin)',38000,0,'ls',0,''),
(81,'Resleting Jean 15 cm',4000,0,'bh',0,''),
(82,'Resleting Jean 15 cm (lusin)',43000,0,'ls',0,''),
(83,'Resleting Jean 17 cm',5000,0,'bh',0,''),
(84,'Resleting Jean 17 cm (lusin)',55000,0,'ls',0,''),
(85,'Resleting Jaket Plastik 50 cm',10000,0,'bh',0,''),
(86,'Resleting Jaket Plastik 55 cm',11000,0,'bh',0,''),
(87,'Resleting Jaket Plastik 60 cm',11000,0,'bh',0,''),
(88,'Resleting Jaket Plastik 65 cm',12000,0,'bh',0,''),
(89,'Resleting Jaket Plastik 70 cm',13000,0,'bh',0,''),
(90,'Resleting Jaket Besi 50 cm',14000,0,'bh',0,''),
(91,'Resleting Jaket Besi 55 cm',15000,0,'bh',0,''),
(92,'Resleting Jepang 25 cm',5000,0,'bh',0,''),
(93,'Resleting Jepang 50 cm ',10000,0,'bh',0,''),
(94,'Mata Nenek Biasa',1000,0,'bh',0,''),
(95,'Mata Nenek Warna',1500,0,'bh',0,''),
(96,'Penedelan',3000,0,'bh',0,''),
(97,'Gunting Benang',6000,0,'bh',0,''),
(98,'Gunting Joyko K',8000,0,'bh',0,''),
(99,'Gunting Joyko B',13000,0,'bh',0,''),
(100,'Gunting Gunindo 65 ',7000,0,'bh',0,''),
(101,'Spelden Kotak H',7000,0,'bh',0,''),
(102,'Spelden Bulat',2000,0,'bh',0,''),
(103,'Spelden Paku',4000,0,'bh',0,''),
(104,'Jarum Mote',4000,0,'bh',0,''),
(105,'Jarum Set Bulat II',3000,0,'bh',0,''),
(106,'Jarum Set Sharps',8000,0,'bh',0,''),
(107,'Jarum Kristik',1000,0,'bh',0,''),
(108,'Jarum Kasur',500,0,'bh',0,''),
(109,'Jarum Karung',2000,0,'bh',0,''),
(110,'Jarum Rosa K',2000,0,'bh',0,''),
(111,'Jarum Rajut',5000,0,'bh',0,''),
(112,'Jarum Mesin Butterfly',2000,0,'bh',0,''),
(113,'Jarum Mesin Singer',5000,0,'bh',0,''),
(114,'Jarum Juki DB',3000,0,'bh',0,''),
(115,'Jarum Obras DC',4000,0,'bh',0,''),
(116,'Gunting Gunindo 55',6000,0,'bh',0,''),
(117,'Peniti Swaga',4000,0,'bh',0,''),
(118,'Peniti Swaga (pack)',45000,0,'pk',0,''),
(119,'Peniti Honaga',3000,0,'bh',0,''),
(120,'Peniti Honaga (pack)',40000,0,'pk',0,''),
(121,'Peniti Emas K',2000,0,'bh',0,''),
(122,'Kancing Kait Kebaya',2000,0,'bh',0,''),
(123,'Kancing Kait Celana',4000,0,'bh',0,''),
(124,'Kancing Kait Celana (getok)',6000,0,'bh',0,''),
(125,'Kancing Kebaya Plastik',12000,0,'bh',0,''),
(126,'Kancing Kebaya 55 (silver)',7000,0,'bh',0,''),
(127,'Meteran Kain',3000,0,'bh',0,''),
(128,'Karet Elastik Dewa Dewi',2000,0,'m',0,''),
(129,'Karet Elastik Dewa Dewi (pack)',33000,0,'pk',0,''),
(130,'Karet Elastik 0,5 cm',1000,0,'m',0,''),
(131,'Karet Elastik 2 cm',3000,0,'m',0,''),
(132,'Karet Elastik 2 cm (pack)',35000,0,'pk',0,''),
(133,'Karet Elastik 3 cm',4000,0,'m',0,''),
(134,'Karet Elastik 3 cm (pack)',55000,0,'pk',0,''),
(135,'Karet Elastik 4 cm ',5000,0,'m',0,''),
(136,'Karet Elastik 4 cm (pack)',65000,0,'pk',0,''),
(137,'Karet Elastik 5 cm',6000,0,'m',0,''),
(138,'Karet Elastik 5 cm (pack)',95000,0,'pk',0,''),
(139,'Wellcrow 2,5 cm',4000,0,'m',0,''),
(140,'Wellcrow 2,5 cm (pack)',33000,0,'pk',0,''),
(141,'Wellcrow 5 cm',10000,0,'m',0,''),
(142,'Wellcrow 5 cm (pack)',100000,0,'pk',0,''),
(143,'Kapur Kain Diamond',3000,0,'bh',0,''),
(144,'Kancing Baju K',2000,0,'bh',0,''),
(145,'Kancing Baju Tg',3000,0,'bh',0,''),
(146,'Kancing Baju B',4000,0,'bh',0,''),
(147,'Kancing Baju Kristal',2000,0,'bh',0,''),
(148,'Kancing Kristal Mawar',3000,0,'bh',0,''),
(149,'Spul Mesin K',1000,0,'bh',0,''),
(150,'Spul Mesin Juki',1500,0,'bh',0,''),
(151,'Mata Ayam B',4000,0,'bh',0,''),
(152,'Mata Ayam K',3000,0,'bh',0,''),
(153,'Wantex',1500,0,'bh',0,''),
(154,'Lem Castol K',7000,0,'bh',0,''),
(155,'Lem Castol B',10000,0,'bh',0,''),
(156,'Lem UHU K',7000,0,'bh',0,''),
(157,'Lem G',7000,0,'bh',0,''),
(158,'Lem Dlukol K',1000,0,'bh',0,''),
(159,'Lem Dlukol Tg',3000,0,'bh',0,''),
(160,'Lem Dlukol B',6000,0,'bh',0,''),
(161,'Lem Fox Sachet',16000,0,'bh',0,''),
(162,'Cutter Kenko B',18000,0,'bh',0,''),
(163,'Cutter Kenko K',8000,0,'bh',0,''),
(164,'Cutter Biasa',3000,0,'bh',0,''),
(165,'Isi Cutter Kenko B',7000,0,'bh',0,''),
(166,'Isi Cutter Kenko K',4000,0,'bh',0,''),
(167,'Peluru USA',8000,0,'bh',0,''),
(168,'Peluru Superdom',8000,0,'bh',0,''),
(169,'Gas Zippo',20000,0,'bh',0,''),
(170,'Isi Cutter B (pack)',75000,0,'pk',0,''),
(171,'Isi Cutter K (pack)',45000,0,'pk',0,'');

/*Table structure for table `tb_deposit` */

DROP TABLE IF EXISTS `tb_deposit`;

CREATE TABLE `tb_deposit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice` varchar(20) NOT NULL,
  `deposit` float NOT NULL,
  `payment` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tb_deposit` */

insert  into `tb_deposit`(`id`,`invoice`,`deposit`,`payment`) values 
(1,'2018-09-25 04:54:224',3000,0),
(2,'2018-09-25 04:58:354',3000,0),
(3,'2018-09-25 05:03:354',2000,0),
(4,'2018-09-25 05:09:144',2000,0),
(5,'2018-09-25 05:10:494',2000,0),
(6,'2018-09-25 05:12:564',2000,0),
(7,'2018-09-25 05:13:504',2000,0),
(8,'2018-09-25 05:14:234',2000,0),
(9,'2018-09-25 06:48:064',2000,0),
(10,'2018-09-25 07:21:184',20000,0),
(11,'2018-09-25 07:21:364',2000,0),
(12,'2018-09-25 07:23:324',2000,0),
(13,'2018-09-25 08:03:064',2000,0),
(14,'2018-09-25 08:03:064',0,0),
(15,'2018-09-25 08:17:124',0,0),
(16,'2018-09-25 08:17:124',0,0),
(17,'2018-09-25 08:17:124',0,0),
(18,'2018-09-25 08:17:124',0,0),
(19,'2018-09-25 08:53:214',0,0),
(20,'2018-09-25 10:04:424',0,0),
(21,'2018-09-25 10:04:424',0,0),
(22,'2018-09-26 11:40:434',0,0),
(23,'2018-10-26 08:23:524',12345,0);

/*Table structure for table `tb_employee` */

DROP TABLE IF EXISTS `tb_employee`;

CREATE TABLE `tb_employee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `sallary` float unsigned NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(20) NOT NULL,
  `status` int(20) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_employee` */

insert  into `tb_employee`(`id`,`nama`,`address`,`sallary`,`tlp`,`username`,`password`,`level`,`status`,`online_status`) values 
(3,'imam','Buleleng',0,'0','admin','202cb962ac59075b964b07152d234b70',1,1,0),
(4,'casier','Peliatan',0,'0','casier','77cf34f016313318086c77361bf90784',0,1,1);

/*Table structure for table `tb_expenses` */

DROP TABLE IF EXISTS `tb_expenses`;

CREATE TABLE `tb_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_insert` datetime NOT NULL,
  `item` varchar(200) NOT NULL,
  `qty` double NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_expenses` */

insert  into `tb_expenses`(`id`,`buyer`,`date`,`date_insert`,`item`,`qty`,`unit`,`price`,`total`,`description`) values 
(2,3,'2018-10-26','2018-10-26 04:42:17','wine',100,'krat',1000,100000,'description');

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_insert` datetime NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id`,`date_insert`,`nm_kategori`,`description`) values 
(2,'2018-10-26 18:53:16','food','');

/*Table structure for table `tb_transaksi` */

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(200) NOT NULL,
  `nm_transaksi` varchar(200) NOT NULL,
  `tnggl` datetime NOT NULL,
  `id_employee` int(11) unsigned NOT NULL,
  `id_item` int(11) unsigned NOT NULL,
  `qty` float unsigned NOT NULL,
  `total_price` float unsigned NOT NULL,
  `deposit` float unsigned NOT NULL,
  `rest_total` float unsigned NOT NULL,
  `description` text NOT NULL,
  `method` int(11) unsigned NOT NULL,
  `statuss` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_employee` (`id_employee`),
  KEY `id_item` (`id_item`),
  CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `tb_employee` (`id`),
  CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `tb_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `tb_transaksi` */

insert  into `tb_transaksi`(`id`,`invoice`,`nm_transaksi`,`tnggl`,`id_employee`,`id_item`,`qty`,`total_price`,`deposit`,`rest_total`,`description`,`method`,`statuss`) values 
(1,'2018-09-25 08:17:124','','2018-09-25 08:17:12',4,2,1,2000,0,2000,'',0,1),
(2,'2018-09-25 08:17:124','','2018-09-25 08:17:28',4,2,1,2000,0,2000,'',0,1),
(3,'2018-09-25 08:17:124','','2018-09-25 08:17:28',4,10,1,3000,0,3000,'',0,1),
(4,'2018-09-25 08:17:124','','2018-09-25 08:24:34',4,9,1,40000,0,40000,'',0,1),
(5,'2018-09-25 08:17:124','','2018-09-25 08:27:02',4,2,1,2000,0,2000,'',0,1),
(6,'2018-09-25 08:53:214','','2018-09-25 08:53:21',4,2,1,2000,0,2000,'',0,1),
(7,'2018-09-25 10:04:424','','2018-09-25 10:04:42',4,11,1,28000,0,28000,'',0,1),
(8,'2018-09-25 10:04:424','','2018-09-25 10:07:47',4,5,1,65000,0,65000,'',0,1),
(9,'2018-09-26 08:34:074','','2018-09-26 08:34:07',4,2,1,2000,0,0,'',0,1),
(10,'2018-09-26 08:34:074','','2018-09-26 08:34:07',4,3,1,18000,0,0,'',0,1),
(11,'2018-09-26 11:02:554','','2018-09-26 11:02:55',4,2,1,2000,0,0,'',0,1),
(12,'2018-09-26 11:02:554','','2018-09-26 11:02:55',4,4,1,6000,0,0,'',0,1),
(13,'2018-09-26 11:04:384','','2018-09-26 11:04:38',4,2,2,4000,0,0,'',0,1),
(14,'2018-09-26 11:04:384','','2018-09-26 11:04:38',4,3,1,18000,0,0,'',0,1),
(15,'2018-09-26 11:04:384','','2018-09-26 11:04:38',4,17,2,2000,0,0,'',0,1),
(16,'2018-09-26 11:06:544','','2018-09-26 11:06:54',4,2,1,2000,0,0,'',0,1),
(17,'2018-09-26 11:18:504','','2018-09-26 11:18:50',4,2,1,2000,0,0,'',0,1),
(18,'2018-09-26 11:18:504','','2018-09-26 11:18:50',4,3,2,36000,0,0,'',0,1),
(19,'2018-09-26 11:19:504','','2018-09-26 11:19:50',4,2,1,2000,0,0,'',0,1),
(20,'2018-09-26 11:20:534','','2018-09-26 11:20:53',4,2,1,2000,0,0,'',0,1),
(21,'2018-09-26 11:21:284','','2018-09-26 11:21:28',4,3,1,18000,0,0,'',0,1),
(22,'2018-09-26 11:31:224','','2018-09-26 11:31:22',4,9,3,120000,0,0,'',0,1),
(23,'2018-09-26 11:31:224','','2018-09-26 11:31:22',4,16,5,2500,0,0,'',0,1),
(24,'2018-09-26 11:31:224','','2018-09-26 11:31:22',4,97,2,12000,0,0,'',0,1),
(25,'2018-09-26 11:40:434','','2018-09-26 11:40:43',4,2,1,2000,0,2000,'',0,1),
(26,'2018-09-26 11:40:434','','2018-09-26 11:40:43',4,3,1,18000,0,18000,'',0,1),
(27,'2018-09-26 12:14:154','','2018-09-26 12:14:15',4,3,1,18000,0,0,'',0,1),
(28,'2018-09-26 12:15:274','','2018-09-26 12:15:27',4,4,1,6000,0,0,'',0,1),
(29,'2018-09-26 12:17:544','','2018-09-26 12:17:54',4,11,1,28000,0,0,'',0,1),
(30,'2018-09-26 12:18:514','','2018-09-26 12:18:51',4,6,1,3000,0,0,'',0,1),
(31,'2018-09-26 12:19:284','','2018-09-26 12:19:28',4,3,1,18000,0,0,'',0,1),
(32,'2018-09-26 12:20:524','','2018-09-26 12:20:52',4,11,1,28000,0,0,'',0,1),
(33,'2018-09-26 12:21:104','','2018-09-26 12:21:10',4,2,1,2000,0,0,'',0,1),
(34,'2018-09-26 12:24:364','','2018-09-26 12:24:36',4,6,1,3000,0,0,'',0,1),
(35,'2018-09-26 12:24:544','','2018-09-26 12:24:54',4,10,1,3000,0,0,'',0,1),
(36,'2018-09-26 12:26:064','','2018-09-26 12:26:06',4,11,1,28000,0,0,'',0,1),
(37,'2018-09-26 12:26:374','','2018-09-26 12:26:37',4,7,1,30000,0,0,'',0,1),
(38,'2018-09-26 12:27:324','','2018-09-26 12:27:32',4,7,1,30000,0,0,'',0,1),
(39,'2018-09-26 12:29:114','','2018-09-26 12:29:11',4,11,1,28000,0,0,'',0,1),
(40,'2018-09-26 12:29:444','','2018-09-26 12:29:44',4,9,1,40000,0,0,'',0,1),
(41,'2018-09-26 12:30:484','','2018-09-26 12:30:48',4,9,1,40000,0,0,'',0,1),
(42,'2018-09-26 12:34:244','','2018-09-26 12:34:24',4,9,1,40000,0,0,'',0,1),
(43,'2018-09-26 12:36:434','','2018-09-26 12:36:43',4,8,1,7000,0,0,'',0,1),
(44,'2018-09-26 12:37:034','','2018-09-26 12:37:03',4,5,1,65000,0,0,'',0,1),
(45,'2018-09-26 12:39:254','','2018-09-26 12:39:25',4,2,1,2000,0,0,'',0,1),
(46,'2018-09-26 12:39:574','','2018-09-26 12:39:57',4,2,1,2000,0,0,'',0,1),
(47,'2018-09-26 12:41:064','','2018-09-26 12:41:06',4,3,1,18000,0,0,'',0,1),
(48,'2018-09-26 12:41:434','','2018-09-26 12:41:43',4,11,1,28000,0,0,'',0,1),
(49,'2018-09-26 12:42:224','','2018-09-26 12:42:22',4,10,1,3000,0,0,'',0,1),
(50,'2018-09-27 06:33:334','','2018-09-27 06:33:33',4,10,1,3000,0,0,'',0,1),
(51,'2018-09-27 07:04:504','','2018-09-27 07:04:50',4,2,1,2000,0,0,'',0,1),
(52,'2018-09-27 07:15:544','','2018-09-27 07:15:54',4,2,1,2000,0,0,'',0,1),
(53,'2018-10-07 13:30:294','','2018-10-07 13:30:29',4,2,1,2000,0,0,'',0,1),
(54,'2018-10-07 13:30:294','','2018-10-07 13:30:29',4,3,1,18000,0,0,'',0,1),
(55,'2018-10-24 06:16:074','','2018-10-24 06:16:07',4,11,1,28000,0,0,'',0,1),
(56,'2018-10-26 08:23:524','adit','2018-10-26 08:23:52',4,19,7,63000,0,50655,'',0,0),
(57,'2018-11-01 07:25:084','','2018-11-01 07:25:08',4,16,4,2000,0,0,'',0,1),
(58,'2018-11-01 07:25:084','','2018-11-01 07:25:08',4,17,4,4000,0,0,'',0,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
