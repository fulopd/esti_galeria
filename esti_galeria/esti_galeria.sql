-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Jan 15. 19:34
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `esti_galeria`
--
CREATE DATABASE IF NOT EXISTS `esti_galeria` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `esti_galeria`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

DROP TABLE IF EXISTS `felhasznalo`;
CREATE TABLE IF NOT EXISTS `felhasznalo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `email`, `jelszo`) VALUES
(1, 'galeria@g.hu', 'galeria');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kepek`
--

DROP TABLE IF EXISTS `kepek`;
CREATE TABLE IF NOT EXISTS `kepek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `cim` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `fajlnev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `utvonal` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` varchar(1000) COLLATE utf8_hungarian_ci NOT NULL,
  `keszult` datetime NOT NULL,
  `feltoltes` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kepek`
--

INSERT INTO `kepek` (`id`, `fid`, `cim`, `fajlnev`, `utvonal`, `leiras`, `keszult`, `feltoltes`) VALUES
(1, 1, 'k1', 'clay-banks-_wkd7XBRfU4-unsplash.jpg', 'images/', 'Egy remek kép', '2019-12-16 08:16:00', '2019-12-16'),
(2, 1, 'kép 2', 'nathan-dumlao-N3btvQ51dL0-unsplash.jpg', 'images/', 'Ez egy másik kép', '2019-12-15 00:00:00', '2019-12-15'),
(3, 1, 'Kep3', 'nathan-dumlao-zUNs99PGDg0-unsplash.jpg', 'images/', 'kep3 leirasa', '2020-01-15 00:00:00', '2020-01-15');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kepek`
--
ALTER TABLE `kepek`
  ADD CONSTRAINT `kepek_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `felhasznalo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
