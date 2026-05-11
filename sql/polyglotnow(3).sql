-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2026 a las 20:07:57
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
(1, 'Juan José', 'T1-E1-FR', 60, '2026-04-09 09:59:39'),
(2, 'Juan José', 'T1-E2-FR', 20, '2026-04-09 10:51:38'),
(3, 'Administrador', 'T1-E2-FR', 87, '2026-04-09 12:36:17'),
(4, 'Administrador', 'T1-E1-EN', 53, '2026-04-09 12:37:47'),
(5, 'Administrador', 'T1-E2-IT', 93, '2026-04-09 12:42:11'),
(6, 'Administrador', 'T1-E2-DE', 20, '2026-04-09 12:43:05'),
(7, 'Administrador', 'T1-E2-EN', 93, '2026-04-09 12:56:46'),
(8, 'Mike', 'T1-E1-ES', 0, '2026-04-09 13:26:58'),
(9, 'Mike', 'T1-E1-ES', 40, '2026-04-09 13:29:13'),
(10, 'Mike', 'T1-E1-FR', 60, '2026-04-09 14:10:32'),
(11, 'Mike', 'T1-E1-IT', 67, '2026-04-09 14:16:02'),
(12, 'Mike', 'T1-E1-DE', 67, '2026-04-09 16:53:11'),
(13, 'Mike', 'T1-E1-RO', 67, '2026-04-09 17:36:44'),
(14, 'Mike', 'T1-E2-FR', 47, '2026-04-09 18:36:52'),
(15, 'Mike', 'T1-E2-FR', 40, '2026-04-09 18:40:10'),
(16, 'Mike', 'T1-E2-IT', 67, '2026-04-09 18:52:15'),
(17, 'Mike', 'T1-E2-DE', 67, '2026-04-09 19:07:31'),
(18, 'Mike', 'T1-E1-RO', 80, '2026-04-09 19:28:40'),
(20, 'Mike', 'T1-E1-ES', 100, '2026-04-10 14:19:37'),
(21, 'Administrador', 'T1-E1-EN', 67, '2026-04-12 20:28:54'),
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
(35, 'Administrador', 'T1-E1-FR', 13, '2026-04-19 12:18:43'),
(36, 'Bartolo', 'T1-E2-EN', 50, '2026-04-26 14:33:10'),
(37, 'Bartolo', 'T1-E1-EN', 50, '2026-04-26 14:33:40'),
(38, 'Bartolo', 'T1-E3-EN', 50, '2026-04-26 14:33:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tests`
--

CREATE TABLE `tests` (
  `num_test` varchar(10) NOT NULL,
  `nom_test` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tests`
--

INSERT INTO `tests` (`num_test`, `nom_test`) VALUES
('T1-E1-DE', 'Hallo und auf Wiedersehen!'),
('T1-E1-EN', 'Hello and Goodbye!'),
('T1-E1-ES', '¡Hola y Adiós!'),
('T1-E1-FR', 'Bonjour et Au revoir!'),
('T1-E1-IT', 'Ciao e Arrivederci!'),
('T1-E1-RO', 'Salut și La revedere!'),
('T1-E2-DE', 'Einfache Worte'),
('T1-E2-EN', 'Simple Words'),
('T1-E2-ES', 'Palabras Simples'),
('T1-E2-FR', 'Mots Simples'),
('T1-E2-IT', 'Mondi Semplici'),
('T1-E2-RO', 'Cuvinte Simple'),
('T1-E3-DE', 'Adjektive und Adverbien'),
('T1-E3-EN', 'Adjectives & Adverbs'),
('T1-E3-ES', 'Adjetivos y Adverbios'),
('T1-E3-FR', 'Adjectifs et Adverbes'),
('T1-E3-IT', 'Aggettivi e Avverbi'),
('T1-E3-RO', 'Adjective și Adverbe'),
('T1-E4-DE', 'Prüfung'),
('T1-E4-EN', 'Exam'),
('T1-E4-ES', 'Examen'),
('T1-E4-FR', 'Examen'),
('T1-E4-IT', 'Esame'),
('T1-E4-RO', 'Examen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `contra` varchar(255) NOT NULL,
  `idioma` enum('Español','English') NOT NULL,
  `c_ing` tinyint(1) DEFAULT 0,
  `c_esp` tinyint(1) DEFAULT 0,
  `c_fra` tinyint(1) DEFAULT 0,
  `c_ita` tinyint(1) DEFAULT 0,
  `c_ale` tinyint(1) DEFAULT 0,
  `c_rum` tinyint(1) DEFAULT 0,
  `es_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `usuario`, `contra`, `idioma`, `c_ing`, `c_esp`, `c_fra`, `c_ita`, `c_ale`, `c_rum`, `es_admin`) VALUES
(1, 'Juan José', 'Password1', 'Español', 1, 0, 0, 0, 0, 1, 0),
(2, 'Miguel', 'Password3', 'Español', 0, 0, 0, 1, 0, 1, 0),
(3, 'Mike', 'Password3', 'English', 0, 1, 1, 1, 1, 1, 0),
(4, 'prueba1', 'Password1', 'Español', 1, 0, 1, 0, 0, 0, 0),
(5, 'prueba2', 'Password2', 'English', 0, 1, 0, 1, 0, 0, 0),
(6, 'todoen', 'Password2', 'English', 0, 1, 1, 1, 1, 1, 0),
(7, 'todoes', 'Password1', 'Español', 1, 0, 1, 1, 1, 1, 0),
(8, 'Administrador', 'Password1', 'Español', 1, 1, 1, 1, 1, 1, 1),
(9, 'Bartolo', 'Password1', 'Español', 1, 0, 0, 0, 0, 0, 0);

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
-- Indices de la tabla `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`num_test`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  MODIFY `ID_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
