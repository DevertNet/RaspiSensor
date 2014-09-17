-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 12. Sep 2014 um 14:52
-- Server Version: 5.5.34
-- PHP-Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `rpi`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sensorData`
--

CREATE TABLE `sensorData` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `plantID` text,
  `sensorID` text,
  `sensorType` text,
  `dataRaw` mediumint(9) DEFAULT NULL,
  `dataRefined` mediumint(9) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Daten für Tabelle `sensorData`
--

INSERT INTO `sensorData` (`id`, `plantID`, `sensorID`, `sensorType`, `dataRaw`, `dataRefined`, `date`) VALUES
(1, 'temp1', 'temp1', 'soil-moisture', 265, 10, '1410237165'),
(2, 'temp1', 'temp1', 'soil-moisture', 246, 54, '1410245806'),
(3, 'temp1', 'temp1', 'soil-moisture', 42, 73, '1410171811'),
(4, 'temp1', 'temp1', 'soil-moisture', 285, 15, '1410240492'),
(5, 'temp1', 'temp1', 'soil-moisture', 907, 55, '1410399859'),
(6, 'temp1', 'temp1', 'soil-moisture', 954, 34, '1410394744'),
(7, 'temp1', 'temp1', 'soil-moisture', 155, 3, '1410322574'),
(8, 'temp1', 'temp1', 'soil-moisture', 614, 41, '1410368993'),
(9, 'temp1', 'temp1', 'soil-moisture', 942, 10, '1410271320'),
(10, 'temp1', 'temp1', 'soil-moisture', 840, 53, '1410273328'),
(11, 'temp1', 'temp1', 'soil-moisture', 250, 21, '1410200515'),
(12, 'temp1', 'temp1', 'soil-moisture', 359, 73, '1410319606'),
(13, 'temp1', 'temp1', 'soil-moisture', 889, 85, '1410360162'),
(14, 'temp1', 'temp1', 'soil-moisture', 316, 77, '1410225011'),
(15, 'temp1', 'temp1', 'soil-moisture', 328, 21, '1410240811'),
(16, 'temp1', 'temp1', 'soil-moisture', 509, 43, '1410260011'),
(17, 'temp1', 'temp1', 'soil-moisture', 18, 49, '1410358340'),
(18, 'temp1', 'temp1', 'soil-moisture', 259, 90, '1410349264'),
(19, 'temp1', 'temp1', 'soil-moisture', 739, 98, '1410178295'),
(20, 'temp1', 'temp1', 'soil-moisture', 948, 65, '1410332723'),
(21, 'temp1', 'temp1', 'soil-moisture', 822, 95, '1410311826'),
(22, 'temp1', 'temp1', 'soil-moisture', 699, 22, '1410285145'),
(23, 'temp1', 'temp1', 'soil-moisture', 15, 2, '1410346839'),
(24, 'temp1', 'temp1', 'soil-moisture', 259, 39, '1410333360'),
(25, 'temp1', 'temp1', 'soil-moisture', 851, 54, '1410308154'),
(26, 'temp1', 'temp1', 'soil-moisture', 299, 39, '1410307517'),
(27, 'temp1', 'temp1', 'soil-moisture', 457, 53, '1410260157'),
(28, 'temp1', 'temp1', 'soil-moisture', 873, 60, '1410236848'),
(29, 'temp1', 'temp1', 'soil-moisture', 15, 38, '1410346927'),
(30, 'temp1', 'temp1', 'soil-moisture', 144, 45, '1410187364'),
(31, 'temp1', 'temp1', 'soil-moisture', 848, 29, '1410320975'),
(32, 'temp1', 'temp1', 'soil-moisture', 527, 13, '1410291957'),
(33, 'temp1', 'temp1', 'soil-moisture', 841, 35, '1410387253'),
(34, 'temp1', 'temp1', 'soil-moisture', 928, 32, '1410327209'),
(35, 'temp1', 'temp1', 'soil-moisture', 202, 80, '1410337511'),
(36, 'temp1', 'temp1', 'soil-moisture', 116, 45, '1410401769'),
(37, 'temp1', 'temp1', 'soil-moisture', 681, 32, '1410230208'),
(38, 'temp1', 'temp1', 'soil-moisture', 227, 7, '1410319318'),
(39, 'temp1', 'temp1', 'soil-moisture', 107, 71, '1410398749'),
(40, 'temp1', 'temp1', 'soil-moisture', 161, 51, '1410372646'),
(41, 'temp1', 'temp1', 'soil-moisture', 489, 34, '1410372606'),
(42, 'temp1', 'temp1', 'soil-moisture', 833, 18, '1410313240'),
(43, 'temp1', 'temp1', 'soil-moisture', 86, 65, '1410242679'),
(44, 'temp1', 'temp1', 'soil-moisture', 385, 47, '1410176332'),
(45, 'temp1', 'temp1', 'soil-moisture', 205, 87, '1410308421'),
(46, 'temp1', 'temp1', 'soil-moisture', 985, 1, '1410417655'),
(47, 'temp1', 'temp1', 'soil-moisture', 581, 45, '1410190668'),
(48, 'temp1', 'temp1', 'soil-moisture', 271, 1, '1410344364'),
(49, 'temp1', 'temp1', 'soil-moisture', 902, 74, '1410367701'),
(50, 'temp1', 'temp1', 'soil-moisture', 556, 32, '1410316674'),
(51, 'temp1', 'temp1', 'soil-moisture', 685, 19, '1410331900'),
(52, 'temp1', 'temp1', 'soil-moisture', 786, 71, '1410361222'),
(53, 'temp1', 'temp1', 'soil-moisture', 590, 93, '1410241003'),
(54, 'temp1', 'temp1', 'soil-moisture', 780, 57, '1410316607'),
(55, 'temp1', 'temp1', 'soil-moisture', 381, 38, '1410366649'),
(56, 'temp1', 'temp1', 'soil-moisture', 654, 13, '1410231218'),
(57, 'temp1', 'temp1', 'soil-moisture', 491, 91, '1410259452'),
(58, 'temp1', 'temp1', 'soil-moisture', 509, 23, '1410185715'),
(59, 'temp1', 'temp1', 'soil-moisture', 581, 10, '1410274752'),
(60, 'temp1', 'temp1', 'soil-moisture', 564, 35, '1410234327'),
(61, 'temp1', 'temp1', 'soil-moisture', 1007, 85, '1410414441'),
(62, 'temp1', 'temp1', 'soil-moisture', 785, 28, '1410275075'),
(63, 'temp1', 'temp1', 'soil-moisture', 617, 44, '1410211821'),
(64, 'temp1', 'temp1', 'soil-moisture', 777, 28, '1410407406'),
(65, 'temp1', 'temp1', 'soil-moisture', 520, 94, '1410252786'),
(66, 'temp1', 'temp1', 'soil-moisture', 729, 50, '1410339451'),
(67, 'temp1', 'temp1', 'soil-moisture', 611, 78, '1410338627'),
(68, 'temp1', 'temp1', 'soil-moisture', 13, 90, '1410167297'),
(69, 'temp1', 'temp1', 'soil-moisture', 377, 66, '1410287196'),
(70, 'temp1', 'temp1', 'soil-moisture', 485, 89, '1410326815'),
(71, 'temp1', 'temp1', 'soil-moisture', 486, 18, '1410326880'),
(72, 'temp1', 'temp1', 'soil-moisture', 191, 33, '1410363910'),
(73, 'temp1', 'temp1', 'soil-moisture', 741, 63, '1410374980'),
(74, 'temp1', 'temp1', 'soil-moisture', 834, 38, '1410174214'),
(75, 'temp1', 'temp1', 'soil-moisture', 144, 4, '1410235396'),
(76, 'temp1', 'temp1', 'soil-moisture', 844, 27, '1410364550'),
(77, 'temp1', 'temp1', 'soil-moisture', 966, 97, '1410240579'),
(78, 'temp1', 'temp1', 'soil-moisture', 805, 85, '1410163937'),
(79, 'temp1', 'temp1', 'soil-moisture', 47, 33, '1410168318'),
(80, 'temp1', 'temp1', 'soil-moisture', 408, 69, '1410205531'),
(81, 'temp1', 'temp1', 'soil-moisture', 84, 1, '1410274071'),
(82, 'temp1', 'temp1', 'soil-moisture', 186, 52, '1410175642'),
(83, 'temp1', 'temp1', 'soil-moisture', 75, 65, '1410179935'),
(84, 'temp1', 'temp1', 'soil-moisture', 81, 4, '1410346248'),
(85, 'temp1', 'temp1', 'soil-moisture', 123, 33, '1410195059'),
(86, 'temp1', 'temp1', 'soil-moisture', 49, 68, '1410181035'),
(87, 'temp1', 'temp1', 'soil-moisture', 936, 81, '1410229128'),
(88, 'temp1', 'temp1', 'soil-moisture', 528, 95, '1410218054'),
(89, 'temp1', 'temp1', 'soil-moisture', 706, 34, '1410271643'),
(90, 'temp1', 'temp1', 'soil-moisture', 558, 65, '1410376105'),
(91, 'temp1', 'temp1', 'soil-moisture', 606, 66, '1410297863'),
(92, 'temp1', 'temp1', 'soil-moisture', 586, 68, '1410334464'),
(93, 'temp1', 'temp1', 'soil-moisture', 63, 45, '1410276580'),
(94, 'temp1', 'temp1', 'soil-moisture', 233, 6, '1410270743'),
(95, 'temp1', 'temp1', 'soil-moisture', 798, 40, '1410277173'),
(96, 'temp1', 'temp1', 'soil-moisture', 856, 93, '1410289245'),
(97, 'temp1', 'temp1', 'soil-moisture', 446, 94, '1410281873'),
(98, 'temp1', 'temp1', 'soil-moisture', 52, 55, '1410298726'),
(99, 'temp1', 'temp1', 'soil-moisture', 296, 18, '1410400876'),
(100, 'temp1', 'temp1', 'soil-moisture', 960, 24, '1410271342');
