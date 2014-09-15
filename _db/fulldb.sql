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
(1, '1', '1', 'soil-moisture', 265, 10, '1410237165'),
(2, '1', '1', 'soil-moisture', 246, 54, '1410245806'),
(3, '1', '1', 'soil-moisture', 42, 73, '1410171811'),
(4, '1', '1', 'soil-moisture', 285, 15, '1410240492'),
(5, '1', '1', 'soil-moisture', 907, 55, '1410399859'),
(6, '1', '1', 'soil-moisture', 954, 34, '1410394744'),
(7, '1', '1', 'soil-moisture', 155, 3, '1410322574'),
(8, '1', '1', 'soil-moisture', 614, 41, '1410368993'),
(9, '1', '1', 'soil-moisture', 942, 10, '1410271320'),
(10, '1', '1', 'soil-moisture', 840, 53, '1410273328'),
(11, '1', '1', 'soil-moisture', 250, 21, '1410200515'),
(12, '1', '1', 'soil-moisture', 359, 73, '1410319606'),
(13, '1', '1', 'soil-moisture', 889, 85, '1410360162'),
(14, '1', '1', 'soil-moisture', 316, 77, '1410225011'),
(15, '1', '1', 'soil-moisture', 328, 21, '1410240811'),
(16, '1', '1', 'soil-moisture', 509, 43, '1410260011'),
(17, '1', '1', 'soil-moisture', 18, 49, '1410358340'),
(18, '1', '1', 'soil-moisture', 259, 90, '1410349264'),
(19, '1', '1', 'soil-moisture', 739, 98, '1410178295'),
(20, '1', '1', 'soil-moisture', 948, 65, '1410332723'),
(21, '1', '1', 'soil-moisture', 822, 95, '1410311826'),
(22, '1', '1', 'soil-moisture', 699, 22, '1410285145'),
(23, '1', '1', 'soil-moisture', 15, 2, '1410346839'),
(24, '1', '1', 'soil-moisture', 259, 39, '1410333360'),
(25, '1', '1', 'soil-moisture', 851, 54, '1410308154'),
(26, '1', '1', 'soil-moisture', 299, 39, '1410307517'),
(27, '1', '1', 'soil-moisture', 457, 53, '1410260157'),
(28, '1', '1', 'soil-moisture', 873, 60, '1410236848'),
(29, '1', '1', 'soil-moisture', 15, 38, '1410346927'),
(30, '1', '1', 'soil-moisture', 144, 45, '1410187364'),
(31, '1', '1', 'soil-moisture', 848, 29, '1410320975'),
(32, '1', '1', 'soil-moisture', 527, 13, '1410291957'),
(33, '1', '1', 'soil-moisture', 841, 35, '1410387253'),
(34, '1', '1', 'soil-moisture', 928, 32, '1410327209'),
(35, '1', '1', 'soil-moisture', 202, 80, '1410337511'),
(36, '1', '1', 'soil-moisture', 116, 45, '1410401769'),
(37, '1', '1', 'soil-moisture', 681, 32, '1410230208'),
(38, '1', '1', 'soil-moisture', 227, 7, '1410319318'),
(39, '1', '1', 'soil-moisture', 107, 71, '1410398749'),
(40, '1', '1', 'soil-moisture', 161, 51, '1410372646'),
(41, '1', '1', 'soil-moisture', 489, 34, '1410372606'),
(42, '1', '1', 'soil-moisture', 833, 18, '1410313240'),
(43, '1', '1', 'soil-moisture', 86, 65, '1410242679'),
(44, '1', '1', 'soil-moisture', 385, 47, '1410176332'),
(45, '1', '1', 'soil-moisture', 205, 87, '1410308421'),
(46, '1', '1', 'soil-moisture', 985, 1, '1410417655'),
(47, '1', '1', 'soil-moisture', 581, 45, '1410190668'),
(48, '1', '1', 'soil-moisture', 271, 1, '1410344364'),
(49, '1', '1', 'soil-moisture', 902, 74, '1410367701'),
(50, '1', '1', 'soil-moisture', 556, 32, '1410316674'),
(51, '1', '1', 'soil-moisture', 685, 19, '1410331900'),
(52, '1', '1', 'soil-moisture', 786, 71, '1410361222'),
(53, '1', '1', 'soil-moisture', 590, 93, '1410241003'),
(54, '1', '1', 'soil-moisture', 780, 57, '1410316607'),
(55, '1', '1', 'soil-moisture', 381, 38, '1410366649'),
(56, '1', '1', 'soil-moisture', 654, 13, '1410231218'),
(57, '1', '1', 'soil-moisture', 491, 91, '1410259452'),
(58, '1', '1', 'soil-moisture', 509, 23, '1410185715'),
(59, '1', '1', 'soil-moisture', 581, 10, '1410274752'),
(60, '1', '1', 'soil-moisture', 564, 35, '1410234327'),
(61, '1', '1', 'soil-moisture', 1007, 85, '1410414441'),
(62, '1', '1', 'soil-moisture', 785, 28, '1410275075'),
(63, '1', '1', 'soil-moisture', 617, 44, '1410211821'),
(64, '1', '1', 'soil-moisture', 777, 28, '1410407406'),
(65, '1', '1', 'soil-moisture', 520, 94, '1410252786'),
(66, '1', '1', 'soil-moisture', 729, 50, '1410339451'),
(67, '1', '1', 'soil-moisture', 611, 78, '1410338627'),
(68, '1', '1', 'soil-moisture', 13, 90, '1410167297'),
(69, '1', '1', 'soil-moisture', 377, 66, '1410287196'),
(70, '1', '1', 'soil-moisture', 485, 89, '1410326815'),
(71, '1', '1', 'soil-moisture', 486, 18, '1410326880'),
(72, '1', '1', 'soil-moisture', 191, 33, '1410363910'),
(73, '1', '1', 'soil-moisture', 741, 63, '1410374980'),
(74, '1', '1', 'soil-moisture', 834, 38, '1410174214'),
(75, '1', '1', 'soil-moisture', 144, 4, '1410235396'),
(76, '1', '1', 'soil-moisture', 844, 27, '1410364550'),
(77, '1', '1', 'soil-moisture', 966, 97, '1410240579'),
(78, '1', '1', 'soil-moisture', 805, 85, '1410163937'),
(79, '1', '1', 'soil-moisture', 47, 33, '1410168318'),
(80, '1', '1', 'soil-moisture', 408, 69, '1410205531'),
(81, '1', '1', 'soil-moisture', 84, 1, '1410274071'),
(82, '1', '1', 'soil-moisture', 186, 52, '1410175642'),
(83, '1', '1', 'soil-moisture', 75, 65, '1410179935'),
(84, '1', '1', 'soil-moisture', 81, 4, '1410346248'),
(85, '1', '1', 'soil-moisture', 123, 33, '1410195059'),
(86, '1', '1', 'soil-moisture', 49, 68, '1410181035'),
(87, '1', '1', 'soil-moisture', 936, 81, '1410229128'),
(88, '1', '1', 'soil-moisture', 528, 95, '1410218054'),
(89, '1', '1', 'soil-moisture', 706, 34, '1410271643'),
(90, '1', '1', 'soil-moisture', 558, 65, '1410376105'),
(91, '1', '1', 'soil-moisture', 606, 66, '1410297863'),
(92, '1', '1', 'soil-moisture', 586, 68, '1410334464'),
(93, '1', '1', 'soil-moisture', 63, 45, '1410276580'),
(94, '1', '1', 'soil-moisture', 233, 6, '1410270743'),
(95, '1', '1', 'soil-moisture', 798, 40, '1410277173'),
(96, '1', '1', 'soil-moisture', 856, 93, '1410289245'),
(97, '1', '1', 'soil-moisture', 446, 94, '1410281873'),
(98, '1', '1', 'soil-moisture', 52, 55, '1410298726'),
(99, '1', '1', 'soil-moisture', 296, 18, '1410400876'),
(100, '1', '1', 'soil-moisture', 960, 24, '1410271342');
