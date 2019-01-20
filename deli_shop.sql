/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 10.1.37-MariaDB : Database - deli_shop
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
  `price` double NOT NULL,
  `stock` float unsigned NOT NULL,
  `unit` varchar(100) NOT NULL,
  `kategori` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

/*Data for the table `tb_barang` */

insert  into `tb_barang`(`id`,`item`,`price`,`stock`,`unit`,`kategori`,`supplier`) values 
(1,'CREAM CHEESE LIGHT 250GR ',56000,1,'PCS',1,3),
(2,'OLIVE OIL EXTRA VIRGIN (REFILL)',140000,37,'LITER',5,0),
(3,'OLIVE OIL EXTRA VIRGIN 1 LITER ',195000,2,'LITER',5,0),
(4,'CREAM CHEESE NEUFCHATEL 250GR ',68000,4,'PCS',1,0),
(5,'SOUR CREAM 250GR \"YUMMY\"',48000,3,'PCS',1,0),
(6,'RICOTTA 250GR \"GREENFIELDS\"',46000,3,'PCS',1,0),
(7,'FETA CHEESE 250GR ',54000,2,'PCS',1,0),
(8,'MOZZARELLA 250GR \"SUNRISE\"',54000,9,'PCS',1,0),
(9,'DANISH BLUE CHEESE \"VIKINGS\"',54000,0,'PCS',1,0),
(10,'STRIPLOIN AUSTRALIAN (CHILLED)',398000,2.725,'KG',6,0),
(11,'RUMP BEEF AUSTRALIAN (CHILLED)',310000,5.34,'KG',6,0),
(12,'MASCARPONE 250GR \"TATUA\"',58000,0,'PCS',1,0),
(13,'RIB EYE AUSTRALIAN (CHILLED)',410000,1.64,'KG',6,0),
(14,'LAMB CHOP AUSTRALIAN',398000,0,'KG',6,0),
(15,'MASCARPONE 1KG \"TATUA\"',190000,12,'PCS',1,0),
(16,'TENDERLOIN AUSTRALIAN (CHILLED)',530000,0,'KG',6,0),
(17,'FETA CHEESE 1 KG',198000,0,'KG',1,0),
(18,'CHEESE WEDGES  \"THE LAUGHING COW\"',38000,0,'PCS',1,0),
(19,'TENDERLOIN AUSTRALIAN (FROZEN)',510000,3.685,'KG',6,0),
(20,'WAGYU TENDERLOIN  (FROZEN)',1200000,0.605,'KG',6,0),
(21,'CHEESE MINI \"BABYBEL\"',58000,6,'PCS',1,0),
(22,'STEAK BURGER',58000,26,'PCS',6,0),
(23,'FRESH BURRATA 200GR',110000,4,'PCS',1,0),
(24,'FRESH BURRATINA 125GR',64000,9,'PCS',1,0),
(25,'PORK CHILI SAUSAGE (ITALIAN RECIPE)',275000,3,'KG',6,0),
(26,'CHICKEN SAUSAGE (ITALIAN RECIPE)',210000,1.455,'KG',6,0),
(27,'PORK SAUSAGE (ITALIAN RECIPE)',275000,3.27,'KG',6,0),
(28,'PORK RIBS',220000,0,'KG',6,0),
(29,'PORK CHOP',190000,35.295,'KG',6,0),
(30,'FRESH MOZZARELLA 110GR',46000,20,'PCS',1,0),
(31,'CHICKEN WHOLE',70000,4,'KG',6,0),
(32,'CHICKEN BREAST',120000,5.99,'KG',6,0),
(33,'SWISS CHEESE \"AMMERLAND\" 3 KG-3.5 KG',230000,0.53,'GR',1,0),
(34,'CHICKEN LEG',70000,2.095,'KG',6,0),
(35,'LUCIFERO CHEESE',560000,1285,'GR',1,0),
(36,'CHICKEN WINGS',45000,0,'KG',6,0),
(37,'BEEF HOT DOG 60gr',88000,15,'PCS',6,0),
(38,'BEEF HOT DOG 100gr',88000,15,'PCS',6,0),
(39,'PORK HOT DOG 100gr',85000,47,'PCS',6,0),
(40,'EDAM CHEESE ',210000,3260,'gr',1,0),
(41,'MINCED BEEF 500gr',95000,54,'PCS',6,0),
(42,'SMOKED HAM \"ALSACE\"',310000,13.295,'KG',3,0),
(43,'CREAM CHEESE \"EXQUISA\"',200000,10,'kg',1,0),
(44,'COOKED HAM \"ALSACE\"',340000,12.41,'KG',3,0),
(45,'BACON 500gr \"MAMAS\"',95000,31,'PCS',3,0),
(46,'BACON 1kg \"MAMAS\"',180000,11,'PCS',3,0),
(47,'MOZZARELLA BLOCK 2.3 KG',185000,50215,'gr',1,0),
(48,'SALAME MILANO \"MAMAS\"',330000,5.7,'KG',3,0),
(49,'PAPRIKA SALAME \"MAMAS\"',320000,2.32,'KG',3,0),
(50,'SALAME CHORIZO',360000,2.53,'KG',3,0),
(51,'GOUDA CHEESE \"AMMERLAND\" 3 KG- 3.5 KG',210000,0.155,'gr',1,0),
(52,'COPPA \"VIA EMILIA\"',530000,1.5,'KG',3,0),
(53,'SALAME \"VIA EMILIA\"',430000,0.63,'KG',3,0),
(54,'GOUDA CHEESE MILD \"BAROS\" (1.8-2 KG)',370000,0,'gr',0,0),
(55,'LONZINO \"VIA EMILIA\"',430000,1.445,'KG',3,0),
(56,'PANCETTA ',330000,0,'KG',3,0),
(57,'MORTADELLA ITALIAN',780000,0,'KG',3,0),
(58,'GOUDA CHEESE OLD \"BAROS\" (1.8-2KG)',390000,1470,'gr',1,0),
(59,'JAMON SERRANO',860000,8,'KG',3,0),
(60,'BRESAOLA ITALIAN',980000,1.795,'KG',3,0),
(61,'GOUDA CHEESE YOUNG  \"BAROS\" (1.8-2 KG)',360000,0.97,'gr',1,0),
(62,'TANGGIRI PORTION FROZEN',120000,0,'KG',4,0),
(63,'CHEDDAR CHEESE ENGLAND',320000,0.63,'gr',1,0),
(64,'TUNA FROZEN',120000,2.09,'KG',4,0),
(65,'SHRIMPS WHOLE',140000,0,'KG',4,0),
(66,'SHRIMPS PEELED',160000,0,'KG',4,0),
(67,'CHEEDAR CHEESE \"SUNRISE\" 2KG',260000,2,'kg',1,0),
(68,'GROUPER FROZEN',220000,0,'KG',4,0),
(69,'MAHI MAHI FROZEN',86000,0,'KG',4,0),
(70,'SQUID WHOLE FROZEN',120000,1.4,'KG',4,0),
(71,'EMMENTHAL FRANCE',340000,2.72,'kg',1,0),
(72,'SQUID HEAD FROZEN',100000,1.5,'KG',4,0),
(73,'OCTOPUS FROZEN',120000,4.73,'KG',4,0),
(74,'GORGONZOLA DOLCE',550000,3.082,'kg',1,0),
(75,'PRAWN +/- 25gr',200000,0,'KG',4,0),
(76,'PRAWN +/- 40gr',215000,0,'KG',4,0),
(77,'GORGONZOLA PICCANTE',560000,5.266,'kg',1,0),
(78,'PRAWN JUMBO +/-300gr',350000,4.475,'KG',4,0),
(79,'PIATTONE CHEESE',450000,0.41,'kg',0,0),
(80,'CASERA CHEESE',460000,0.8,'gr',1,0),
(81,'SMOKED SALMON FROZEN',650000,0,'KG',4,0),
(82,'TRE SIGNORI CHEESE',540000,0.226,'kg',1,0),
(83,'ANCHOVIES FILLET 50gr',58000,71,'PCS',4,0),
(84,'ANCHOVIES FILLET 720gr ',450000,0,'PCS',4,0),
(85,'MATUSC CHEESE',490000,0.16,'kg',1,0),
(86,'TUNA CANNED 175gr',28000,12,'PCS',4,0),
(87,'SAN TUMAS CHEESE',580000,3.98,'kg',1,0),
(88,'SUNFLOWER OIL (REFILL)',42000,0,'LITER',5,0),
(89,'YOGURT PLAIN  125gr \"GREENFIELDS\"',20000,4,'PCS',1,0),
(90,'BALSAMIC VINEGAR 250ml \"LA RAMBLA\"',48000,1,'PCS',5,0),
(91,'YOGURT STRAWBERRY \"GREENFIELDS\"',20000,0,'CUP',1,0),
(92,'YOGURT BLUEBERRY \"GREEN FIELDS\"',20000,0,'CUP',1,0),
(93,'APPLE CIDER VINEGAR 250ml \"LA RAMBLA\"',46000,7,'PCS',5,0),
(94,'YOGURT MANGO 125gr \"GREENFIELDS\"',20000,0,'CUP',0,0),
(95,'PORCINI CONDIMENT EVO 250ml \"OLITALIA\"',142000,0,'PCS',5,0),
(96,'TRUFFLE CONDIMENT EVO 250ml \"OLITALIA\"',194000,3,'PCS',5,0),
(97,'YOGURT GREEK PLAIN 110gr \"YUMMY\"',24000,4,'CUP',1,0),
(98,'ARTICHOKES HEART \"LA RAMBLA\"',82000,19,'PCS',5,0),
(99,'YOGURT GREEK STRAWBERRY 110gr \"YUMMY\"',24000,2,'CUP',1,0),
(100,'BLACK PITTED OLIVES 235gr \"LA RAMBLA\"',42000,5,'PCS',5,0),
(101,'GREEN MANZANILLA OLIVES 235gr \"LA RAMBLA\"',42000,43,'PCS',5,0),
(102,'YOGURT GREEK 500gr \"YUMMY\"',84000,0,'CUP',1,0),
(103,'GREEN OLIVES W/ANCHOVIES 235gr \"LA RAMBLA\"',62000,32,'PCS',5,0),
(104,'YOGURT GREEK STRAWBERRY 500GR \"YUMMY\"',98000,0,'CUP',1,0),
(105,'GRAINY DIJON MUSTARD 200gr',42000,25,'PCS',5,0),
(106,'DIJON MUSTARD EXTRA STRONG 200gr',42000,36,'PCS',5,0),
(107,'YOGURT PLAIN 1kg \"BIOKUL\"',88000,0,'CUP',1,0),
(108,'TUMMY YOGURT DRINK BLUBERRY',24000,5,'BTL',1,0),
(109,'TUMMY YOGURT DRINK MANGO CARROT',24000,6,'btl',1,0),
(110,'YOGURT GREEK GRANOLA 100gr',38000,0,'CUP',1,0),
(111,'YOGURT GREEK HONEY 100gr',38000,0,'CUP',1,0),
(112,'YOGURT GREEK PEACH 100GR',38000,0,'CUP',1,0),
(113,'FRESH MILK 1L \"GREENFIELDS\"',52000,0,'BTL',1,0),
(114,'FRESH MILK 1L \"DIAMOND\"',38000,0,'BTL',1,0),
(115,'FRESH MILK 350 ml \"DIAMOND\"',16000,0,'BTL',1,0),
(116,'FRESH MILK 1L - NO FAT \"DIAMOND\"',38000,0,'BTL',1,0),
(117,'SALTED BUTTER 227gr \"ANCHOR\"',62000,0,'PCS',1,0),
(118,'UNSALTED BUTTER 227GR ',62000,5,'PCS',1,0),
(119,'AUST UNSALTED BUTTER BULK',220000,10,'KG',1,0),
(120,'MINI BUTTER 10GR \"ANCHOR\"',3500,1546,'PCS',1,0),
(121,'WHIPPING CULINARY CREAM 1 KG \"TATUA\"',140000,3,'BKS',1,0),
(122,'MIX LETTUCE',120000,9.07,'KG',12,0),
(123,'RUCOLA',130000,2.965,'KG',12,0),
(124,'BASIL ',140000,1.225,'KG',12,0),
(125,'MINT LEAF',130000,0.79,'gr',12,0),
(126,'PARSLEY ITALY',180000,1.78,'KG',12,0),
(127,'PARSLEY LOCAL',120000,0,'KG',12,0),
(128,'MUSHROOM',130000,3.355,'KG',12,0),
(129,'ZUCCHINE',130000,1.49,'KG',12,0),
(130,'CORIANDER',140000,0.505,'gr',12,0),
(131,'CHERRY TOMATO',140000,1.16,'kg',12,0),
(132,'BEETROOT',120000,1.2,'kg',12,0),
(133,'MIX PAPRIKA',140000,5.23,'kg',12,0),
(134,'RED ONION',160000,0,'kg',12,0),
(135,'RED CABAGE RTG',70000,14.84,'kg',12,0),
(136,'RED CABAGE BALI',110000,0,'kg',12,0),
(137,'RED RADISH',130000,0,'kg',12,0),
(138,'ORANGE SUNKIST',120000,0,'kg',12,0),
(139,'LEMON IMPORT',120000,1.08,'kg',12,0),
(140,'FROZEN GREEN PEAS 1 KG \"GOLDEN FARM\"',58000,1,'BKS',12,0),
(141,'FROZEN GREEN PEAS 500GR \"GOLDEN FARM\"',34000,1,'BKS',12,0),
(142,'FROZEN LEAF SPINACH 400gr \"BONDUELLE\"',48000,0,'BKS',12,0),
(143,'FROZEN MIX VEGETBALES 500gr \"GOLDEN FARM\"',34000,0,'BKS',12,0),
(144,'FRENCH FRISE STRAIGHT CUT 1KG \"GOLDEN FARM\"',48000,0,'BKS',12,0),
(145,'FRECH FRISE CRINKLE CUT 1KG \"GOLDEN FARM\"',48000,0,'BKS',12,0),
(146,'FLAXSEED LINCED',90000,5.84,'KG',11,0),
(147,'PUMPKIN SEED',190000,6.14,'kg',11,0),
(148,'SUNFLOWER SEEDS',140000,4.51,'KG',11,0),
(149,'POLENTA',80000,0,'KG',11,0),
(150,'BORLOTTI BEANS',90000,0,'KG',11,0),
(151,'CHICK PEAS',100000,2.61,'KG',11,0),
(152,'BROWN LENTIL',80000,2.29,'KG',11,0),
(153,'CANELLINI BEANS',100000,4.42,'KG',11,0),
(154,'WHITE SESAME SEEDS',100000,14.075,'KG',11,0),
(155,'BLACK SESAME SEEDS',200000,3.34,'KG',11,0),
(156,'COUS COUS',80000,5.575,'KG',11,0),
(157,'PEARL BARLEY',80000,3.87,'KG',11,0),
(158,'BLACK CHIA SEEDS',180000,7.07,'KG',11,0),
(159,'WHITE QUINOA ORGANIC',200000,6.915,'KG',11,0),
(160,'RED QUINOA ORGANIC',220000,6.285,'KG',11,0),
(161,'MACA POWDER',540000,2.845,'KG',11,0),
(162,'DRY RAISINS',70000,0,'KG',11,0),
(163,'ALMOND NATURAL WHOLE',330000,2.37,'KG',11,0),
(164,'GOJI BERRIES',480000,2.575,'KG',11,0),
(165,'WALNUT HALVES',450000,3.545,'KG',11,0),
(166,'WASABI POWDER 1KG',210000,4,'KG',11,0),
(167,'COCONUT FLAKE 1KG',120000,2,'BKS',11,0),
(168,'BUCKWHEAT FLOUR 1KG',160000,3,'KG',11,0),
(169,'WHITE FLOUR GLUTEN FREE',160000,2,'KG',11,0),
(170,'SWEET PAPRIKA',190000,5,'KG',11,0),
(171,'HOT CHILI POWDER',210000,2.34,'KG',11,0),
(172,'BLACK PEPPER CORN',380000,6.485,'KG',11,0),
(173,'CHILI FLAKE',170000,15.33,'KG',11,0),
(174,'OREGANO FLAKE',150000,8.25,'KG',11,0),
(175,'DRIED ROSEMARY CUT',170000,0.125,'KG',11,0),
(176,'SAGE LEAVES',160000,0.42,'KG',11,0),
(177,'CORIANDER POWDER',130000,2.23,'KG',11,0),
(178,'CINNAMON POWDER',190000,0.59,'KG',11,0),
(179,'SPIRULINA POWDER \"VERDURE\" 100gr',160000,4,'PCS',11,0),
(180,'C ACAO POWDER ',78000,5,'PCS',11,0),
(181,'TURMERIC POWDER ',46000,4,'PCS',11,0),
(182,'MORINGA POWDER ',76000,4,'PCS',11,0),
(183,'SPIRULINA FLAKE ',160000,3,'PCS',11,0),
(184,'WAFER CUBI CACAO \"BALCONI\" 250gr',48000,4,'PCS',10,0),
(185,'WAFER CUBI HAZELNUT \"BALCONI\" 250gr',48000,0,'PCS',10,0),
(186,'WAFER CUBI VANILLA \"BALCONI\" 250gr',48000,0,'PCS',10,0),
(187,'CACAO CASHEW NUTS 35gr ',22000,38,'PCS',10,0),
(188,'CHILI LIME CASHEW NUTS 35gr ',22000,20,'PCS',10,0),
(189,'SEA SALT CASHEW NUTS 35gr \"EAST BALI CASHEWS\"',220000,0,'PCS',10,0),
(190,'ROASTED CASHEW SNACK 35gr ',22000,18,'PCS',10,0),
(191,'CACAO CASHEW NUTS 75gr \"EAST BALI CASHEWS\"',42000,4,'PCS',10,0),
(192,'GARLIC PEPPER CASHEW NUTS 75gr \"EAST BALI CASHEWS\"',42000,7,'PCS',10,0),
(193,'GRANOLA CHOCOLATE VANILLA 400gr \"EAST BALI CASHEWS\"',79000,35,'PCS',10,0),
(194,'GRANOLA COCONUT BANANA 400gr \"EAST BALI CASHEWS\"',79000,20,'PCS',10,0),
(195,'POPCORN WITH CHOCOLATE CARAMEL',35000,29,'PCS',10,0),
(196,'POPCORN WITH CASHEWS SALTED CARAMEL \"EAST BALI CASHEWS\"',35000,25000,'PCS',10,0),
(197,'HAND MADE CHOKO CHIPS COOKIES',12000,92,'PCS',10,0),
(198,'HAND MADE OATMEAL COOKIES',12000,33,'PCS',10,0),
(199,'HAND MADE CHOCO RICE WITH DULCE DE LECHE (gluten free)',34000,54,'PCS',10,0),
(200,'HAND MADE CHOCOLATE ALFAJORES ARGENTINOS WITH DULCE DE LECHE',28000,17,'PCS',10,0),
(201,'HAND MADE CORN ALFAJORES WITH DULCE DE LECHE AND COCONUT',28000,32,'PCS',10,0),
(202,'SAVORY PIE ERBAZZONE WITH SPINACH AND PARMESAN \"VIA EMILIA\"',86000,5,'PCS',10,0),
(203,'FOCACCIA \"VIA EMILIA\"',46000,8,'PCS',10,0),
(204,'BRUSCHETTE BITES SLOW ROASTED GARLIC 70gr \"MARETTI\" ',38000,27,'PCS',10,0),
(205,'BRUSCHETTE BITES TOMATO,OLIVES,OREGANO 70gr \"MARETTI\" ',38000,32,'PCS',10,28),
(206,'BRUSCHETTE BITES PIZZA 70gr \"MARETTI\" ',38000,17,'PCS',10,28),
(207,'BRUSCHETTE BITES PESTO BASIL 70gr \"MARETTI\" ',38000,23,'PCS',10,28),
(208,'WHITE COFFE 3IN1 AUTENTIC & STRONG 40gr ',8000,39,'PCS',0,28),
(209,'WHITE COFFE 3IN1 HAZELNUT 40gr \"SHAKE CLUB HOUSE \"',8000,13,'PCS',10,28),
(210,'WHITE COFFE 2IN1 NO SUGAR 25gr  ',8000,18,'PCS',10,0),
(211,'CHOCO DRINK 3IN1 40gr \"SHAKE CLUB HOUSE \"',8000,19,'PCS',10,28),
(212,'TOAST ORIGINAL 100gr ',38000,0,'PCS',0,26),
(213,'TOAST WHOLE-WHEAT 100gr \"MELBA\"',38000,0,'PCS',10,26),
(214,'BOX MINI BUTTER',1280000,1,'BOX',1,0),
(215,'MILK CHOCOLATE 43gr \"DOVE\"',16000,1,'PCS',10,0),
(216,'DARK CHOCOLATE 43gr \"DOVE\"',18000,3,'PCS',10,21),
(217,'MULTIGRAIN PUFFED CRACKERS',48000,18,'PCS',0,0),
(218,'HAND MADE RAVIOLI RICOTTA SPINACH \"VIA EMILIA\"',62000,9,'PCS',7,8),
(219,'HAND MADE RAVIOLI PUMPKIN \"VIA EMILIA\"',54000,14,'PCS',7,8),
(220,'HAND MADE RAVIOLI FISH \"VIA EMILIA\"',68000,4,'PCS',7,8),
(221,'HAND MADE PORK TORTELLINI \"VIA EMILIA\"',64000,9,'PCS',7,8),
(222,'LASAGNA BOLOGNESE \"VIA EMILIA\"',62000,14,'PCS',7,8),
(223,'CANNELLONI \"VIA EMILIA\"',52000,16,'PCS',7,8),
(224,'VEGETABLES SOUP \"VIA EMILIA\"',44000,6,'PCS',7,8),
(225,'FETTUCCINE NATURAL 250gr \"VIA EMILIA\"',38000,6,'PCS',7,8),
(226,'FETTUCCINE SPINACH 250gr \"VIA EMILIA\"',40000,7,'PCS',7,8),
(227,'FETTUCCINE BEETROOT 250gr \"VIA EMILIA\"',40000,1,'PCS',7,8),
(228,'FETTUCCINE SQUID INK 250gr \"VIA EMILIA\"',40000,6,'PCS',7,8),
(229,'FETTUCCINE GLUTEN FREE 200gr \"VIA EMILIA\"',50000,1,'PCS',7,8),
(230,'PAPPARDELLE NATURAL 250gr \"VIA EMILIA\"',38000,0,'PCS',7,8),
(231,'PAPPARDELLE SPINACH 250gr \"VIA EMILIA\"',40000,0,'PCS',7,8),
(232,'SPAGHETTI \"DE CECCO\"',44000,45,'PCS',7,6),
(233,'PENNE \"DE CECCO\"',44000,58,'PCS',7,6),
(234,'RIGATONI \"DE CECCO\"',44000,18,'PCS',7,6),
(235,'SPAGHETTI \"DIVELLA\"',34000,34000,'40',7,0),
(236,'PENNE \"DIVELLA\"',34000,18,'PCS',7,0),
(237,'PENNE GLUTEN FREE \"GAROFALO\"',64000,57,'PCS',0,6),
(238,'SPAGHETTI GLUTEN FREE \"GAROFALO\"',64000,34,'PCS',7,6),
(239,'BOLOGNESE SAUCE BEEF AND PORK 150grX2 \"VIA EMILIA\"',68000,3,'PCS',7,8),
(240,'PEELED TOMATO 2,55kg \"BEL POMO\"',74000,120,'PCS',7,6),
(241,'PASSATA DI POMODORO RUSTICA 700gr \"DE CECCO\"',55000,14000,'PCS',7,6),
(242,'POLPA DI POMODORO 700gr \"DE CECCO\"',55000,30,'PCS',7,6),
(243,'DISPOSABLE WOODEN FORK',1500,139,'PCS',8,0),
(244,'DISPOSABLE WOODEN KNIFE',1500,101,'PCS',8,29),
(245,'DISPOSABLE WOODEN SPOON',1500,79,'PCS',8,29),
(246,'BAMBOO STRAW',5000,143,'PCS',8,29),
(247,'GLASS STRAW',25000,92,'PCS',8,29),
(248,'STAINLESS STEEL STRAW',18000,8,'PCS',8,29),
(249,'MACHINE COFFEE ',1980000,1,'PCS',8,14),
(250,'MILK FROTHER',860000,1,'PCS',8,14),
(251,'GLASS CUP CUPPUCCINO \"THESPRESSO\"',120000,6,'PCS',8,14),
(252,'GLASS CUP ESPRESSO \"THESPRESSO\"',90000,0,'PCS',8,14);

/*Table structure for table `tb_deposit` */

DROP TABLE IF EXISTS `tb_deposit`;

CREATE TABLE `tb_deposit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice` varchar(20) NOT NULL,
  `deposit` float NOT NULL,
  `payment` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_deposit` */

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tb_employee` */

insert  into `tb_employee`(`id`,`nama`,`address`,`sallary`,`tlp`,`username`,`password`,`level`,`status`,`online_status`) values 
(4,'casier','Bali',0,'0','casier','77cf34f016313318086c77361bf90784',0,1,1),
(5,'admin','Deli',0,'0','admin','202cb962ac59075b964b07152d234b70',1,1,1),
(6,'Afli','wae kelambu',1000000,'081111','tes@gmail.com','77cf34f016313318086c77361bf90784',0,0,0),
(7,'EMILIA','KAPER',1000000,'082144796606','EMILIA','7f51403cbbee278265d6581f9f24d6e2',1,0,0),
(8,'DANA','GOLO KOE',5000000,'081239175546','DANA','2f4d86a811155b0eca70efa4eb135e77',1,0,0);

/*Table structure for table `tb_expenses` */

DROP TABLE IF EXISTS `tb_expenses`;

CREATE TABLE `tb_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_insert` datetime NOT NULL,
  `category` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `qty` double NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_expenses` */

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_insert` datetime NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id`,`date_insert`,`nm_kategori`,`description`) values 
(1,'2019-01-18 04:06:33','DAIRY PRODUCT',''),
(2,'2019-01-18 04:07:24','COFFEE,TEA & WATER',''),
(3,'2019-01-18 04:07:39','COLD CUTS',''),
(4,'2019-01-18 04:07:59','FISH',''),
(5,'2019-01-18 04:08:35','GROCERY',''),
(6,'2019-01-18 04:08:48','MEAT',''),
(7,'2019-01-18 04:09:36','PASTA & SAUCE',''),
(8,'2019-01-18 04:09:54','NO FOOD',''),
(9,'2019-01-18 04:10:26','SERVICE',''),
(10,'2019-01-18 04:11:25','SNACK',''),
(11,'2019-01-18 04:11:41','SPICES & SEEDS',''),
(12,'2019-01-18 04:11:57','VEGETABLES',''),
(13,'2019-01-19 10:45:27','',''),
(14,'2019-01-19 10:45:28','',''),
(15,'2019-01-19 10:58:11','',''),
(16,'2019-01-19 10:58:12','','');

/*Table structure for table `tb_supplier` */

DROP TABLE IF EXISTS `tb_supplier`;

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tb_supplier` */

insert  into `tb_supplier`(`id_supplier`,`nm_supplier`,`address`,`no_hp`) values 
(1,'ALAMBOGA','BALI','081236305515'),
(2,'PRAMBANAN KENCANA','BALI','08155119291'),
(3,'EVI OEI','BALI','082146268168'),
(5,'OZ BRITZ','BALI','081536336127'),
(6,'INDOGUNA','BALI','085738738938'),
(7,'CENTRAL BALI','BALI','123'),
(8,'VIA EMILIA','BALI','082147066506'),
(9,'GUIDO','BALI','08155759703'),
(10,'GIOIA CHEESE','BALI','087860611137'),
(11,'INTI SARI','BALI','123'),
(13,'MEGAH FOOD','BALI','085792836277'),
(14,'ALBERTO','BALI','081933061351'),
(15,'EAST CHASEW BALI','BALI','083114982507'),
(16,'EUGENIA','BALI','081239182638'),
(17,'BOGA RICE CREACKERS','BALI','085935345088'),
(18,'SPS','BALI','08563701688'),
(19,'MAMAS','BALI','081246899229'),
(20,'LOTUS','BALI','081337525347'),
(21,'SUKANDA DJAYA','BALI','081236006306'),
(22,'PANEN PERTIWI','BALI','087861670901'),
(23,'BAMBOO STRAW BALI','BALI','087861596824'),
(25,'MASUYA','BALI','085858103969'),
(26,'SUNSHINE','BALI','087880079379'),
(27,'BAHANA GOURMET','BALI','081936645408'),
(28,'INTERBUANA','BALI','08174144686'),
(29,'SHANKARA BALI','BALI','08113888628');

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
  `discount` float NOT NULL,
  `total_price` float unsigned NOT NULL,
  `deposit` float unsigned NOT NULL,
  `rest_total` float unsigned NOT NULL,
  `description` text NOT NULL,
  `method` varchar(50) NOT NULL,
  `statuss` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_employee` (`id_employee`),
  KEY `id_item` (`id_item`),
  CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `tb_employee` (`id`),
  CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `tb_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tb_transaksi` */

insert  into `tb_transaksi`(`id`,`invoice`,`nm_transaksi`,`tnggl`,`id_employee`,`id_item`,`qty`,`discount`,`total_price`,`deposit`,`rest_total`,`description`,`method`,`statuss`) values 
(15,'2019-01-20 04:47:444','','2019-01-20 04:47:44',4,1,1,10,50400,0,0,'','cash',1),
(16,'2019-01-20 04:48:284','','2019-01-20 04:48:28',4,1,1,15,47600,0,0,'','cash',1),
(17,'2019-01-20 04:48:284','','2019-01-20 04:48:28',4,2,2,20,224000,0,0,'','cash',1);

/* Trigger structure for table `tb_transaksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `stock` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `stock` AFTER INSERT ON `tb_transaksi` FOR EACH ROW BEGIN
	UPDATE tb_barang SET stock = stock - NEW.qty WHERE tb_barang.id = NEW.id_item;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
