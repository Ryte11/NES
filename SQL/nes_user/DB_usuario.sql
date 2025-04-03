-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2025 a las 23:13:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

-- 
-- Base de datos: `nes_user`
--

-- --------------------------------------------------------

-- 
-- Eliminamos la tabla `denuncias` si ya existe
--
DROP TABLE IF EXISTS `denuncias`;

-- 
-- Estructura de tabla para la tabla `denuncias`
--

CREATE TABLE `denuncias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 
-- Volcado de datos para la tabla `denuncias`
--

INSERT INTO `denuncias` (`id`, `nombre`, `cedula`, `ubicacion`, `tipo`, `descripcion`, `fecha`) VALUES
(17, 'Luisangel', '232132321312', 'sadasdasdasdsadsadwadwadwadwadwadwa', 'construccion', 'ijdiajd9iasdiasjidjasdjasdjasdjassa', '2025-01-23 15:04:49');

-- --------------------------------------------------------

-- 
-- Eliminamos la tabla `usuarios` si ya existe
--
DROP TABLE IF EXISTS `usuarios`;

-- 
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  `cedula` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contraseña`, `fecha_registro`, `estado`, `cedula`) VALUES
(30, 'Luisangel', 'luisangelgamer20@gmail.com', '$2y$10$lZHXawpnVt2kYt1rfQiZG.xa7YIG1Mocs2Il5tab/tvOcHOgg/9b2', '2025-01-16 09:04:20', 'activo', '12345678901'),
(31, 'Luisangel', 'luisangelgamer20@gmail.com', '$2y$10$mLNO.0Hfk1t9hC9vlPpY6OXnW/5kTQzOp5eOn8AY5.UiEVOvHJzFm', '2025-01-16 11:48:39', 'activo', '09876543212'),
(32, 'Abel', 'luisangelgamer20@gmail.com', '$2y$10$KYp9PA9ncl4lu0UW1TeNQ.qeVd.JrZpbuWsITzQZZg2Oa9uYwMpxG', '2025-01-16 11:57:02', 'activo', '1234567880'),
(33, 'Luisangel ramirez', 'luisramirezsanchez2450@gmail.com', '$2y$10$2Aibkh8udg98wmh82Wwz/OA1h9XGeeJAyGvogoUF4mNYK7/IYtKMS', '2025-01-20 00:15:11', 'activo', '09876543211'),
(34, 'Luisangel123', 'luisangelgamer0@gmail.com', '$2y$10$hCfqxwwFX1EX1MeKJToUpesk70g0Gd7a5hQFR.Te4axFBzCG1.x7e', '2025-01-23 15:02:14', 'activo', '1234567789');

COMMIT;
