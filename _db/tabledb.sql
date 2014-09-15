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

