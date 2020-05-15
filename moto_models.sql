-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2020 a las 11:32:46
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guevaramotorsport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moto_models`
--

CREATE TABLE `moto_models` (
  `id` int(10) NOT NULL,
  `nombre` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `fabricante` int(10) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `moto_models`
--

INSERT INTO `moto_models` (`id`, `nombre`, `fabricante`, `is_active`) VALUES
(1, 'CBF 600 S', 1, 1),
(2, 'Tracer 900', 2, 1),
(3, 'Pan European', 1, 0),
(5, 'K 1600 GT', 15, 1),
(6, 'RS 125', 14, 1),
(7, 'Tuono 125', 14, 1),
(8, 'RSV4', 14, 1),
(9, 'BN600', 38, 1),
(10, 'BN 600 GT', 38, 1),
(11, 'BN 302', 38, 1),
(12, 'Evo 300 Factory 2T', 26, 1),
(13, 'RR 450 Factory', 26, 1),
(14, 'R 1250 GS', 15, 1),
(15, 'R 1250 RT', 15, 1),
(16, ' F 850 GS', 15, 1),
(17, 'S 1000 RR', 15, 1),
(18, 'S3 Fi 125', 24, 1),
(19, 'Daystar 125 Fi', 24, 1),
(20, 'Multistrada 1260', 4, 1),
(21, 'Multistrada 1260 S', 4, 1),
(22, 'Monster 821', 4, 1),
(23, 'Monster 696', 4, 1),
(24, 'Panigale V2', 4, 1),
(25, 'Panigale V4', 4, 1),
(26, 'EC300', 29, 1),
(27, 'EC450 4T', 29, 1),
(28, 'Fuocco 500ie', 39, 1),
(29, 'Fuocco 500 LT', 39, 1),
(30, 'Sportster 883 Iron', 19, 1),
(31, 'Street 750', 19, 1),
(32, 'Dyna Fat Bob', 19, 1),
(33, 'Fat Boy', 19, 1),
(34, 'Forza', 1, 1),
(35, 'GoldWing', 1, 1),
(36, 'PCX 125', 1, 1),
(37, 'CBR 1000 RR', 1, 1),
(38, 'WR 125', 43, 1),
(39, 'WR 250', 43, 1),
(40, 'GV Aquila 125', 25, 1),
(41, 'GN 250 N-EXIV', 25, 1),
(42, 'Chieftain', 33, 1),
(43, 'Scout', 33, 1),
(44, 'Springfield', 33, 1),
(45, 'Z750', 3, 1),
(46, 'Z 800', 3, 1),
(47, 'Z 900', 3, 1),
(48, 'H2', 3, 1),
(49, 'RKV 125', 23, 1),
(50, 'Superlight 125', 23, 1),
(51, '1290 Superadventure', 20, 1),
(52, '1090 Adventure', 20, 1),
(53, '390 Duke', 20, 1),
(54, '1290 Super Duke R', 20, 1),
(55, 'Grand Dink 125', 44, 1),
(56, 'AK 550', 44, 1),
(57, 'LN 125', 40, 1),
(58, 'Cota 4RT', 46, 1),
(59, 'Cota 300 RR', 46, 1),
(60, 'V9', 41, 1),
(61, 'V7', 41, 1),
(62, 'Brutale 800', 16, 1),
(63, 'Dragster 800', 16, 1),
(64, 'F4 1000', 16, 1),
(65, 'Commando 961 Sport', 36, 1),
(66, 'Citystar 125', 35, 1),
(67, 'Metropolis 400i', 35, 1),
(68, 'Tweet 125', 35, 1),
(69, 'Liberty 125', 17, 1),
(70, 'Medley 125', 17, 1),
(71, 'Beverly 125ie', 17, 1),
(72, 'MRT 125', 31, 1),
(73, 'MRX 125', 31, 1),
(74, 'Tango 125', 31, 1),
(75, 'Himalayan', 37, 1),
(76, '350', 32, 1),
(77, '400', 32, 1),
(78, '100 Sport', 32, 1),
(79, 'Burgman', 6, 1),
(80, 'V-Strom', 6, 1),
(81, 'Katana', 6, 1),
(82, 'GSX 650', 6, 1),
(83, 'Joymax 125', 45, 1),
(84, 'Maxsym 600 Sport', 45, 1),
(85, 'Symphony 125 DD', 45, 1),
(86, 'Boneville', 5, 1),
(87, 'Street Triple', 5, 1),
(88, 'Speed Triple', 5, 1),
(89, 'Tiger', 5, 1),
(90, 'Daytona 675', 5, 1),
(91, 'GTS 125', 42, 1),
(92, 'GTS 300', 42, 1),
(93, 'Primavera', 42, 1),
(94, 'Cross country tour', 34, 1),
(95, 'Vision tour', 34, 1),
(96, 'Vegas 8 ball', 34, 1),
(97, 'MT-07', 2, 1),
(98, 'MT-09', 2, 1),
(99, 'T-Max', 2, 1),
(100, 'R1', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `moto_models`
--
ALTER TABLE `moto_models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modelo` (`nombre`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `moto_models`
--
ALTER TABLE `moto_models`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
