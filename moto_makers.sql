-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2020 a las 11:32:21
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
-- Estructura de tabla para la tabla `moto_makers`
--

CREATE TABLE `moto_makers` (
  `id` int(10) NOT NULL,
  `nombre` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `moto_makers`
--

INSERT INTO `moto_makers` (`id`, `nombre`, `is_active`) VALUES
(1, 'Honda', 1),
(2, 'Yamaha', 1),
(3, 'Kawasaki', 1),
(4, 'Ducati', 1),
(5, 'Triumph', 1),
(6, 'Suzuki', 1),
(14, 'Aprilia', 1),
(15, 'BMW', 1),
(16, 'MV Agusta', 1),
(17, 'Piaggio', 1),
(19, 'Harley-Davidson', 1),
(20, 'KTM', 1),
(21, 'Husaberg', 1),
(22, 'Can-Am', 1),
(23, 'Keeway', 1),
(24, 'Daelim', 1),
(25, 'Hyosung', 1),
(26, 'Beta', 1),
(27, 'Bultaco', 1),
(28, 'Derbi', 1),
(29, 'Gas Gas', 1),
(30, 'OSSA', 1),
(31, 'Rieju', 1),
(32, 'Sanglas', 1),
(33, 'Indian', 1),
(34, 'Victory', 1),
(35, 'Peugeot', 1),
(36, 'Norton', 1),
(37, 'Royal Enfield', 1),
(38, 'Benelli', 1),
(39, 'Gilera', 1),
(40, 'Lambretta', 1),
(41, 'Moto Guzzi', 1),
(42, 'Vespa', 1),
(43, 'Husqvarna', 1),
(44, 'Kymco', 1),
(45, 'SYM', 1),
(46, 'Montesa', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `moto_makers`
--
ALTER TABLE `moto_makers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `moto_makers`
--
ALTER TABLE `moto_makers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
