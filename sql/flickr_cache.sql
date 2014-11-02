-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Počítač: wm56.wedos.net:3306
-- Vygenerováno: Pon 03. lis 2014, 00:25
-- Verze serveru: 5.6.15
-- Verze PHP: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `d65260_flickr`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `flickr_cache`
--

CREATE TABLE IF NOT EXISTS `flickr_cache` (
  `request` char(35) COLLATE utf8_czech_ci NOT NULL,
  `response` mediumtext COLLATE utf8_czech_ci NOT NULL,
  `expiration` datetime NOT NULL,
  KEY `request` (`request`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
