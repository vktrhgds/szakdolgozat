-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2018. Máj 09. 09:16
-- Kiszolgáló verziója: 10.1.28-MariaDB
-- PHP verzió: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `jarmuadatbazis`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminuzenet`
--

CREATE TABLE `adminuzenet` (
  `id` int(10) NOT NULL,
  `felhasznalo_nev` varchar(50) NOT NULL,
  `targy` varchar(128) NOT NULL,
  `uzenet` varchar(10000) NOT NULL,
  `uzenetdatum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `auto`
--

CREATE TABLE `auto` (
  `id` int(10) NOT NULL,
  `fenykep` longtext,
  `kategoria` varchar(100) NOT NULL,
  `automarka_id` varchar(60) NOT NULL,
  `ar_1` int(10) NOT NULL,
  `ar_2` int(10) NOT NULL,
  `ar_3` int(10) NOT NULL,
  `marka_tipus` varchar(80) NOT NULL,
  `evjarat` int(4) NOT NULL,
  `allapot` varchar(50) NOT NULL,
  `km_ora_allasa` int(10) NOT NULL,
  `szallithato_szemelyek` int(10) NOT NULL,
  `uzemanyag` varchar(100) NOT NULL,
  `hengerurtartalom` int(10) NOT NULL,
  `teljesitmeny` int(100) NOT NULL,
  `autoszin` varchar(100) NOT NULL,
  `sajat_tomeg` int(100) NOT NULL,
  `maximalis_tomeg` int(100) NOT NULL,
  `tank_meret` int(5) NOT NULL,
  `atlagfogyasztas` float NOT NULL,
  `vegsebesseg` int(10) NOT NULL,
  `gyorsulas` float NOT NULL,
  `oktanszam` int(5) NOT NULL,
  `auto_id2` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `auto`
--

INSERT INTO `auto` (`id`, `fenykep`, `kategoria`, `automarka_id`, `ar_1`, `ar_2`, `ar_3`, `marka_tipus`, `evjarat`, `allapot`, `km_ora_allasa`, `szallithato_szemelyek`, `uzemanyag`, `hengerurtartalom`, `teljesitmeny`, `autoszin`, `sajat_tomeg`, `maximalis_tomeg`, `tank_meret`, `atlagfogyasztas`, `vegsebesseg`, `gyorsulas`, `oktanszam`, `auto_id2`) VALUES
(12, '../pictures/jarmuadatbazis_kepek/bmw_i8.jpg', 'Sportautó', 'BMW', 49900, 44990, 40290, 'i8', 2015, 'Újszerű', 8988, 2, 'Benzin/Elektromos', 6300, 309, 'Fehér', 1288, 1780, 50, 8.1, 301, 6.6, 95, 'u4ByjSCF4TDz8hOLQMpBt0a5k9yCg4DAx6Uf8nsYEEKjkdn0BS5sy9aS4OAEC28HBAhHOgC5IUvhSEr8rgY70oUaJafreB3Zl1du'),
(13, '../pictures/jarmuadatbazis_kepek/mercedes_cla220.jpg', 'Személyautó', 'Mercedes', 19990, 12990, 9990, 'CLA 220', 2013, 'Újszerű', 19920, 5, 'Benzin', 2189, 178, 'Fehér', 1560, 1987, 60, 8.1, 220, 7.9, 95, 'Xul4shWV1bmXFazoD1UOmZYDPBbZg7h8j2xwTowRB7enQVzCeiLQTEihaTXrKaEgi3zxA5VYjeUR8Q1fMEI8mw75TJo1AEbpWckZ'),
(14, '../pictures/jarmuadatbazis_kepek/skoda_superb.jpg', 'Személyautó', 'Skoda', 11990, 9990, 7690, 'Superb', 2011, 'Újszerű', 23870, 5, 'Benzin', 1980, 160, 'Szürke', 1790, 2390, 60, 8.8, 198, 8.8, 95, '2QoZucs7LOwSeZ9SexHDKopCJBllQx1u1P85o8wEx0xiWx0tqe6Ti44iJLKuIX0UiGwqLnT0zFIHSsmev7E6GuAyD4Poy4t1O6fT'),
(15, '../pictures/jarmuadatbazis_kepek/infiniti_g37cabrio.jpg', 'Cabrio', 'Infiniti', 29990, 26990, 21990, 'G37 Cabrio', 2010, 'Újszerű', 15678, 4, 'Benzin', 3700, 320, 'Fehér', 1800, 2400, 80, 9.8, 250, 5.2, 95, 'Kx8zhneaAZ0mlSFP9M3YqAkB6XVHdNvW6SXjzNzFW2HoCLywfcreWAkBeYBnH2CPgVM3BvAgsrvzdsiwiF5TlVgt9a3QFTI0IlxN'),
(16, '../pictures/jarmuadatbazis_kepek/ford_focus.jpg', 'Személyautó', 'Ford', 9890, 7890, 5890, 'Focus', 2015, 'Újszerű', 2980, 5, 'Benzin', 1600, 120, 'Fehér', 1490, 1990, 50, 6.8, 180, 10.1, 95, '1VxnO2XIv0Gd6hUfNO3ar6YfBDoah6J8mmV7gD4cuEdrn81amaVYcRWnU9oAvPMyiafNNVcP4GT957krKSwi9nxhIerIq5mXuwYs'),
(18, '../pictures/jarmuadatbazis_kepek/suzuki_vitara.jpg', 'SUV', 'Suzuki', 9490, 8290, 5790, 'Vitara', 2014, 'Újszerű', 10089, 5, 'Dízel', 1400, 109, 'Piros', 1591, 2178, 50, 6.9, 172, 11.9, 95, 'iekDdFPtXJPAkhQ7SAVymk4UdPqKKezkF36WaU9hXKP4d6Rk7nP0eUEGVic0Bc9vuGytyCPO10PTqK7MSQlWWfoRLGcvzaV6bG1y'),
(19, '../pictures/jarmuadatbazis_kepek/chevrolet_aveo.jpg', 'Személyautó', 'Chevrolet', 7890, 6490, 4390, 'Aveo', 2015, 'Újszerű', 12880, 4, 'Dízel', 1200, 89, 'Sárgásbarna', 1190, 1680, 50, 6.2, 162, 12.2, 98, 'bQWyjR5ICVsizMKDDZ3kOcSBQNYWBCJgJUXzGX8O7rU7pe3D3HKIhBqB5z4Fxa4Fv85oFKBekk0ax5LD4Mk8ML9O19MMDyWgnrhn'),
(21, '../pictures/jarmuadatbazis_kepek/audi_a7.jpg', 'Személyautó', 'Audi', 22990, 18990, 14990, 'A7', 2012, 'Újszerű', 13089, 5, 'Benzin', 3000, 250, 'Szürke', 1700, 2391, 70, 10.8, 240, 6.5, 95, 'h3SQX4qRYXx59byT46ds2FL4hbclREPqiiKHL5PSKG80Ajbm3TITo5M2b1hGmT7PYXesK4VxkDSxoLcKkRpxz8hIcDGzZeqOMkas'),
(22, '../pictures/jarmuadatbazis_kepek/alfa_romeo_guilia.jpg', 'Személyautó', 'Alfa Romeo', 21990, 16990, 12990, 'Guilia', 2015, 'Újszerű', 1088, 5, 'Dízel', 2200, 175, 'Piros', 1460, 1970, 60, 7.1, 216, 7.9, 98, 'L7LZ7O33matdoarqhplKU8bTgygeZvqjAPwg8lAM9HA9r3EIhfnyevrNmD7fKhj1PwGDlpwo3wc6anAdEc7n9NToqWUSRL2OajXK'),
(24, '../pictures/jarmuadatbazis_kepek/audi_a5cabrio.jpg', 'Cabrio', 'Audi', 19990, 16890, 13490, 'A5 ', 2013, 'Alig használt', 39910, 4, 'Dízel', 2000, 178, 'Bézs', 1398, 1877, 60, 6.8, 238, 6.9, 95, 'dHbT7rhMOaNfJzN44UFjiar5F1c8JWPCdeYRGci7xAGMnn2qqGKYXZBkhMgblOqJ941VMi6jxJNp6gQBSjtn7rey0ygMPaMgzyVM'),
(25, '../pictures/jarmuadatbazis_kepek/skoda_octavia.jpg', 'Személyautó', 'Skoda', 17890, 13990, 10690, 'Octavia', 2014, 'Alig használt', 29519, 5, 'Dízel', 1800, 140, 'Szürke', 1580, 2144, 60, 6.7, 202, 10.2, 95, 'LSj2nIMYEPqHVCMSKClLDz9NfO7gIiExKtrjR2nOppRWiZWVZeWPlDJYAy22McJRgFlCi21EtmvlIoR0HqeBL3lnozafppmaH7iw'),
(27, '../pictures/jarmuadatbazis_kepek/bmw_320.jpg', 'Személyautó', 'BMW', 16790, 13990, 11990, '320d', 2013, 'Jó állapotú', 18890, 5, 'Dízel', 2000, 188, 'Kék', 1309, 1799, 60, 6.2, 212, 8.8, 98, 'JhhK7mEnohMErHntgMOkvzajdMXtAQxBn64OPkMfrbU7vI2oxE3910WICGD22OGO1RlHjRKeh1JExKi93vqosSEjsj8EaCU6oFtV'),
(28, '../pictures/jarmuadatbazis_kepek/ford_mondeo.jpg', 'Személyautó', 'Ford', 9990, 8790, 6890, 'Mondeo', 2006, 'Jó állapotú', 59880, 5, 'Benzin', 1600, 115, 'Szürke', 1488, 2021, 50, 7.3, 178, 11.9, 95, 'EEuQxEyrPhSh1JpLPwyXkMlBK1X0G77x8P6bjuvFjt8QTq3d2464s59kosjlbxDaLIILLyCrCxOrcQ1WbeWtjk570xDb9VXlwAsR'),
(40, '../pictures/jarmuadatbazis_kepek/ferrari_laferrari.png', 'Sportautó', 'Ferrari', 129990, 105990, 90990, 'Laferrari', 2016, 'Újszerű', 3022, 2, 'Benzin', 6300, 960, 'Piros', 1100, 1570, 100, 30, 380, 2, 95, 'uxcUpQmjHMcRpZzdpPnpN3oyMCLkztw2Z3I3R4laqfRxIL2640ZrVu6HOfS6hHdotTIfHobRLldlSOmQqIFArwbj1FBJwZiTHq6f');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `autokolcsonzes`
--

CREATE TABLE `autokolcsonzes` (
  `id` int(10) NOT NULL,
  `felhasznalo_nev` varchar(30) NOT NULL,
  `auto_id` int(100) NOT NULL,
  `mettol` date NOT NULL,
  `meddig` date NOT NULL,
  `ar_naponta` int(10) NOT NULL,
  `ar_osszesen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `autokolcsonzes`
--

INSERT INTO `autokolcsonzes` (`id`, `felhasznalo_nev`, `auto_id`, `mettol`, `meddig`, `ar_naponta`, `ar_osszesen`) VALUES
(11, 'email_proba', 15, '2018-04-29', '2018-07-29', 21990, 2001090),
(12, 'email_proba', 28, '2018-04-29', '2018-06-29', 6890, 420290),
(13, 'email_proba', 16, '2018-05-09', '2018-05-12', 9890, 39560);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `automarka`
--

CREATE TABLE `automarka` (
  `id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `automarka`
--

INSERT INTO `automarka` (`id`) VALUES
('Alfa Romeo'),
('Audi'),
('BMW'),
('Chevrolet'),
('Ferrari'),
('Ford'),
('Infiniti'),
('Mercedes'),
('Skoda'),
('Suzuki');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `autosertekelesek`
--

CREATE TABLE `autosertekelesek` (
  `id` int(10) NOT NULL,
  `felhasznalo_nev` varchar(60) NOT NULL,
  `auto_id` int(10) NOT NULL,
  `ertekeles` int(10) NOT NULL,
  `hozzaszolas` longtext NOT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `belepes`
--

CREATE TABLE `belepes` (
  `felhasznalo_nev` varchar(50) NOT NULL,
  `jelszo` varchar(256) NOT NULL,
  `bejelentkezes_datum` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `biztonsagi_kerdesek`
--

CREATE TABLE `biztonsagi_kerdesek` (
  `id` int(10) NOT NULL,
  `biztonsagikerdes` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `biztonsagi_kerdesek`
--

INSERT INTO `biztonsagi_kerdesek` (`id`, `biztonsagikerdes`) VALUES
(1, 'Melyik a kedvenc autómárkája?'),
(2, 'Mi volt az első háziállatának a neve?'),
(3, 'Melyik a kedvenc számítógépes játéka?'),
(4, 'Melyik városban él a fiútestvére?'),
(5, 'Melyik a kedvenc beceneve?'),
(6, 'Hogy hívták az általános iskolai osztályfőnökét?'),
(7, 'Melyik városban született az édesapja?'),
(8, 'Melyik városban él a lánytestvére?'),
(9, 'Ki volt a gyerekkori példaképe?'),
(10, 'Mi az álommunkája?');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `felhasznalo_nev` varchar(50) NOT NULL,
  `jelszo` varchar(256) NOT NULL,
  `vezetek_nev` varchar(100) NOT NULL,
  `kereszt_nev` varchar(100) NOT NULL,
  `szemelyig_szam` varchar(8) NOT NULL,
  `anyja_vnev` varchar(100) NOT NULL,
  `anyja_knev` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telszam` varchar(20) DEFAULT NULL,
  `ir_szam` int(6) NOT NULL,
  `varos` varchar(100) NOT NULL,
  `utca` varchar(100) NOT NULL,
  `hazszam` int(10) NOT NULL,
  `szuletesi_hely` varchar(50) NOT NULL,
  `szuletesi_ido` date NOT NULL,
  `biztonsagikerdes_id` int(10) NOT NULL,
  `biztonsagivalasz` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`felhasznalo_nev`, `jelszo`, `vezetek_nev`, `kereszt_nev`, `szemelyig_szam`, `anyja_vnev`, `anyja_knev`, `email`, `telszam`, `ir_szam`, `varos`, `utca`, `hazszam`, `szuletesi_hely`, `szuletesi_ido`, `biztonsagikerdes_id`, `biztonsagivalasz`) VALUES
('CMRentadmin', '0A7D04779EE20F6718E59E983E4C5DF859DAC772CCE8AFE24298C1ABD3ECA7996949903CD877EB7A3878A10D811187016D52BC15D915F0C159731EE8C569A598', 'Admin', 'Admin', 'NO-DATA', 'NO-DATA', 'NO-DATA', 'admin@admin.admin', '+36305457843', 0, 'NO-DATA', 'NO-DATA', 0, 'NO-DATA', '2018-02-01', 1, 'NO-DATA'),
('email_proba', 'd823420baf40f00cb151bbd20a4b5438077e93767c46995ae731a24a12649d0add8aaefc10ff4aa894896ea2931e0173d67f5fe53b05958c8c836e7b1338b399', 'Lengyel', 'Anita', '21012139', 'Kis', 'Petra', 'emailproba123456@gmail.com', '+36201234567', 4545, 'Szeged', 'Körte utca', 103, 'Budapest', '1967-04-29', 1, 'Mercedes');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motor`
--

CREATE TABLE `motor` (
  `id` int(10) NOT NULL,
  `fenykep` longtext,
  `kategoria` varchar(100) NOT NULL,
  `motormarka_id` varchar(60) NOT NULL,
  `ar_1` int(10) NOT NULL,
  `ar_2` int(10) NOT NULL,
  `ar_3` int(10) NOT NULL,
  `marka_tipus` varchar(80) NOT NULL,
  `evjarat` int(4) NOT NULL,
  `allapot` varchar(50) NOT NULL,
  `km_ora_allasa` int(10) NOT NULL,
  `uzemanyag` varchar(100) NOT NULL,
  `hengerurtartalom` int(10) NOT NULL,
  `teljesitmeny` int(100) NOT NULL,
  `motorszin` varchar(100) NOT NULL,
  `sajat_tomeg` int(100) NOT NULL,
  `maximalis_tomeg` int(100) NOT NULL,
  `tank_meret` int(5) NOT NULL,
  `atlagfogyasztas` float NOT NULL,
  `vegsebesseg` int(10) NOT NULL,
  `gyorsulas` float DEFAULT NULL,
  `munkautem` int(10) NOT NULL,
  `motor_id2` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `motor`
--

INSERT INTO `motor` (`id`, `fenykep`, `kategoria`, `motormarka_id`, `ar_1`, `ar_2`, `ar_3`, `marka_tipus`, `evjarat`, `allapot`, `km_ora_allasa`, `uzemanyag`, `hengerurtartalom`, `teljesitmeny`, `motorszin`, `sajat_tomeg`, `maximalis_tomeg`, `tank_meret`, `atlagfogyasztas`, `vegsebesseg`, `gyorsulas`, `munkautem`, `motor_id2`) VALUES
(1, '../pictures/jarmuadatbazis_kepek/aprilia_sr_50.jpg', 'Robogó', 'Aprilia', 4990, 3990, 2990, 'SR 50', 2006, 'Újszerű', 22019, 'Benzin', 50, 4, 'Piros-fehér', 98, 210, 10, 3.5, 62, 0, 4, 'jX1s3FDYYQYWDDNN1ByeBZRprRQEAw5qhsxI9UkUZFa421EVhGzF2UQYeEyU09l7CQjbYnVmYuDzHcCuCqpgCzt9lJ2WXa54NBDN'),
(2, '../pictures/jarmuadatbazis_kepek/audi_50.jpg', 'Veterán', 'Audi', 37990, 33990, 26990, 'Z02', 1979, 'Jó állapotú', 56911, 'Benzin', 1100, 70, 'Barna', 270, 398, 20, 4.5, 180, 6.6, 4, 'LieNRtLB21kyayCew2XKLsS4rExSOOMLOiF82c0F6tw4ci6eTC9MiIgiQArlKImCdJlC5huYI5497yT5vBNeOtrPhOhQEBLkdggy'),
(3, '../pictures/jarmuadatbazis_kepek/gilera_runner.jpg', 'Robogó', 'Gilera', 8770, 6990, 5560, 'Runner', 2010, 'Jó állapotú', 1129, 'Benzin', 50, 8, 'Fehér', 102, 270, 10, 2, 66, 0, 4, 'W9xXQHplsmifX7jMTF9mFgMrkmHKXeou94KgtCav95kjxgbzakMWLbSzOaqMG5CQvOW1HwaddOvSNUxeONIOO5I4R7cF22utkQ3v'),
(4, '../pictures/jarmuadatbazis_kepek/aprilia_rs50.jpg', 'Sportmotor', 'Aprilia', 19990, 15990, 12990, 'RS 50', 2006, 'Újszerű', 2344, 'Benzin', 250, 59, 'Fehér', 230, 390, 30, 5.5, 189, 4.4, 4, 'qQAoCB1JMBMxI3LQxK347hNbVt7Wi1fBVWPKRroVQDhp16Khz78pSsnhEvrShNpFohNRVRaupqdV6ZZjMjLjspmVzCYxlppknvth'),
(5, '../pictures/jarmuadatbazis_kepek/yamaha_r6.jpg', 'Sportmotor', 'Yamaha', 29990, 27390, 22990, 'R6', 2018, 'Újszerű', 120, 'Benzin', 1000, 201, 'Kék', 401, 670, 30, 4.5, 309, 2.1, 4, 'AiA0AdGirJ7kLQeVnHD2qzmgMfKHaTewIzO4qCpCIKkR4jRuNY3vEGz0TEBsrauWI70UCMMbS5Hl9ylIvepwRExfxOr9DLeeeekV'),
(6, '../pictures/jarmuadatbazis_kepek/keeway_matrix50.jpg', 'Robogó', 'Keeway', 5990, 4190, 3090, 'Matrix 50', 2011, 'Alig használt', 1233, 'Benzin', 50, 5, 'Fehér', 106, 219, 10, 3.5, 58, 0, 4, 'LyBXwMZGfEX5jSU6V6BhFE6jkhw2NmhPe2PnfPVPq6PyzXKmV7T0YrmEVlugEDdDq7G9gXTrIs4NUMkAGDWgkTcvm6xgkFv5FWiI'),
(7, '../pictures/jarmuadatbazis_kepek/bmw_r1200.jpg', 'Sportmotor', 'BMW', 32990, 29990, 25790, 'R 1200', 2016, 'Alig használt', 23089, 'Benzin', 1200, 230, 'Fehér', 361, 601, 30, 4.5, 330, 2.5, 4, 'A1YOjL9eXcF13QkYPrJA77e13eocnjhUGQn7D7EJ4fP8BNpTdPcQ1faAEEjJ5pixIL62Tud8oyU50NOy3R39uk9uRtbhXGE7SETr');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motorkolcsonzes`
--

CREATE TABLE `motorkolcsonzes` (
  `id` int(10) NOT NULL,
  `felhasznalo_nev` varchar(30) NOT NULL,
  `motor_id` int(100) NOT NULL,
  `mettol` date NOT NULL,
  `meddig` date NOT NULL,
  `ar_naponta` int(10) NOT NULL,
  `ar_osszesen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `motorkolcsonzes`
--

INSERT INTO `motorkolcsonzes` (`id`, `felhasznalo_nev`, `motor_id`, `mettol`, `meddig`, `ar_naponta`, `ar_osszesen`) VALUES
(1, 'email_proba', 1, '2018-05-09', '2018-05-13', 4990, 24950);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motormarka`
--

CREATE TABLE `motormarka` (
  `id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `motormarka`
--

INSERT INTO `motormarka` (`id`) VALUES
('Aprilia'),
('Audi'),
('BMW'),
('Gilera'),
('Keeway'),
('Yamaha');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motorosertekelesek`
--

CREATE TABLE `motorosertekelesek` (
  `id` int(10) NOT NULL,
  `felhasznalo_nev` varchar(60) NOT NULL,
  `motor_id` int(10) NOT NULL,
  `ertekeles` int(10) NOT NULL,
  `hozzaszolas` longtext NOT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adminuzenet`
--
ALTER TABLE `adminuzenet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_nev` (`felhasznalo_nev`);

--
-- A tábla indexei `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `automarka_id` (`automarka_id`);

--
-- A tábla indexei `autokolcsonzes`
--
ALTER TABLE `autokolcsonzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_nev`),
  ADD KEY `auto_id` (`auto_id`);

--
-- A tábla indexei `automarka`
--
ALTER TABLE `automarka`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `autosertekelesek`
--
ALTER TABLE `autosertekelesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_nev` (`felhasznalo_nev`),
  ADD KEY `auto_id` (`auto_id`);

--
-- A tábla indexei `belepes`
--
ALTER TABLE `belepes`
  ADD PRIMARY KEY (`felhasznalo_nev`);

--
-- A tábla indexei `biztonsagi_kerdesek`
--
ALTER TABLE `biztonsagi_kerdesek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`felhasznalo_nev`),
  ADD KEY `biztonsagikerdes_id` (`biztonsagikerdes_id`);

--
-- A tábla indexei `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motormarka_id` (`motormarka_id`);

--
-- A tábla indexei `motorkolcsonzes`
--
ALTER TABLE `motorkolcsonzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_nev`),
  ADD KEY `motor_id` (`motor_id`);

--
-- A tábla indexei `motormarka`
--
ALTER TABLE `motormarka`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `motorosertekelesek`
--
ALTER TABLE `motorosertekelesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_nev` (`felhasznalo_nev`),
  ADD KEY `motor_id` (`motor_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `adminuzenet`
--
ALTER TABLE `adminuzenet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT a táblához `autokolcsonzes`
--
ALTER TABLE `autokolcsonzes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `autosertekelesek`
--
ALTER TABLE `autosertekelesek`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `biztonsagi_kerdesek`
--
ALTER TABLE `biztonsagi_kerdesek`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `motor`
--
ALTER TABLE `motor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `motorkolcsonzes`
--
ALTER TABLE `motorkolcsonzes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `motorosertekelesek`
--
ALTER TABLE `motorosertekelesek`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `adminuzenet`
--
ALTER TABLE `adminuzenet`
  ADD CONSTRAINT `adminuzenet_ibfk_1` FOREIGN KEY (`felhasznalo_nev`) REFERENCES `felhasznalo` (`felhasznalo_nev`);

--
-- Megkötések a táblához `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`automarka_id`) REFERENCES `automarka` (`id`);

--
-- Megkötések a táblához `autokolcsonzes`
--
ALTER TABLE `autokolcsonzes`
  ADD CONSTRAINT `autokolcsonzes_ibfk_1` FOREIGN KEY (`felhasznalo_nev`) REFERENCES `felhasznalo` (`felhasznalo_nev`),
  ADD CONSTRAINT `autokolcsonzes_ibfk_2` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`id`);

--
-- Megkötések a táblához `autosertekelesek`
--
ALTER TABLE `autosertekelesek`
  ADD CONSTRAINT `autosertekelesek_ibfk_1` FOREIGN KEY (`felhasznalo_nev`) REFERENCES `felhasznalo` (`felhasznalo_nev`),
  ADD CONSTRAINT `autosertekelesek_ibfk_2` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`id`);

--
-- Megkötések a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD CONSTRAINT `felhasznalo_ibfk_1` FOREIGN KEY (`biztonsagikerdes_id`) REFERENCES `biztonsagi_kerdesek` (`id`);

--
-- Megkötések a táblához `motor`
--
ALTER TABLE `motor`
  ADD CONSTRAINT `motor_ibfk_1` FOREIGN KEY (`motormarka_id`) REFERENCES `motormarka` (`id`);

--
-- Megkötések a táblához `motorkolcsonzes`
--
ALTER TABLE `motorkolcsonzes`
  ADD CONSTRAINT `motorkolcsonzes_ibfk_1` FOREIGN KEY (`felhasznalo_nev`) REFERENCES `felhasznalo` (`felhasznalo_nev`),
  ADD CONSTRAINT `motorkolcsonzes_ibfk_2` FOREIGN KEY (`motor_id`) REFERENCES `motor` (`id`);

--
-- Megkötések a táblához `motorosertekelesek`
--
ALTER TABLE `motorosertekelesek`
  ADD CONSTRAINT `motorosertekelesek_ibfk_1` FOREIGN KEY (`felhasznalo_nev`) REFERENCES `felhasznalo` (`felhasznalo_nev`),
  ADD CONSTRAINT `motorosertekelesek_ibfk_2` FOREIGN KEY (`motor_id`) REFERENCES `motor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
