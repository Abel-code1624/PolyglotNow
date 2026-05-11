-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2026 a las 12:39:26
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`num_test`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
