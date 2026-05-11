-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2026 a las 12:38:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polyglotnow`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacion`
--

CREATE TABLE `puntuacion` (
  `ID_log` int(11) NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `num_test` varchar(10) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puntuacion`
--

INSERT INTO `puntuacion` (`ID_log`, `usuario`, `num_test`, `puntuacion`, `fecha_hora`) VALUES
(22, 'Administrador', 'T1-E3-FR', 7, '2026-04-15 18:28:47'),
(23, 'Administrador', 'T1-E3-IT', 93, '2026-04-15 18:30:35'),
(24, 'Administrador', 'T1-E3-DE', 27, '2026-04-16 12:38:03'),
(25, 'Administrador', 'T1-E2-DE', 27, '2026-04-16 12:44:07'),
(26, 'Administrador', 'T1-E2-RO', 80, '2026-04-16 12:48:43'),
(27, 'Administrador', 'T1-E3-RO', 0, '2026-04-16 12:49:48'),
(28, 'Administrador', 'T1-E1-EN', 27, '2026-04-17 14:15:20'),
(29, 'Administrador', 'T1-E1-EN', 93, '2026-04-17 14:18:43'),
(30, 'Administrador', 'T1-E1-EN', 40, '2026-04-17 16:35:44'),
(31, 'Juan José', 'T1-E1-EN', 13, '2026-04-17 17:33:37'),
(32, 'Administrador', 'T1-E2-EN', 47, '2026-04-18 01:41:17'),
(33, 'Miguel', 'T1-E1-EN', 93, '2026-04-18 02:00:55'),
(34, 'Administrador', 'T1-E1-FR', 93, '2026-04-18 02:36:28'),
(35, 'Administrador', 'T1-E1-FR', 13, '2026-04-19 12:18:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD PRIMARY KEY (`ID_log`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `num_test` (`num_test`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  MODIFY `ID_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD CONSTRAINT `puntuacion_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`),
  ADD CONSTRAINT `puntuacion_ibfk_2` FOREIGN KEY (`num_test`) REFERENCES `tests` (`num_test`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
