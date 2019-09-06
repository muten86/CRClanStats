-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 03. Sep 2019 um 21:29
-- Server-Version: 10.3.16-MariaDB
-- PHP-Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `id5524218_croyale`
--
/*CREATE DATABASE IF NOT EXISTS `id5524218_croyale` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id5524218_croyale`;*/

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `members`
--

CREATE TABLE `members` (
  `DSetId` int(11) NOT NULL,
  `Rank` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Tag` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Donations` int(11) NOT NULL,
  `Trophies` int(11) NOT NULL,
  `Role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ExpLevel` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `war`
--

CREATE TABLE `war` (
  `WarId` int(11) NOT NULL,
  `Tag` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `CollPlayed` int(11) NOT NULL,
  `CollWin` int(11) NOT NULL,
  `WarDayPlayed` int(11) NOT NULL,
  `WarDayWin` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CollEndTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `WarEndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`DSetId`),
  ADD KEY `Tag` (`Tag`);

--
-- Indizes für die Tabelle `war`
--
ALTER TABLE `war`
  ADD PRIMARY KEY (`WarId`,`Tag`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `members`
--
ALTER TABLE `members`
  MODIFY `DSetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `war`
--
ALTER TABLE `war`
  MODIFY `WarId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
