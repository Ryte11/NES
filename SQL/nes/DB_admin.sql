-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2025 a las 02:00:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`id`, `nombre`, `codigo`, `ubicacion`, `tipo`, `fecha`, `direccion`, `email`) VALUES
(1, 'Manuel_Rivera', '1234567891', 'Santo_Domingo_Este', 'Ruidos_Parlantes', '2024-02-13', 'La_caleta_boca_chica_ITLA', 'manuelr@gmail.com'),
(2, 'Ana_Perez', '9876543210', 'Santo_Domingo_Norte', 'Ruidos_Parlantes', '2024-02-14', 'Av_Principal_45', 'anap@email.com'),
(3, 'Juan_Gomez', '1112223333', 'Santiago', 'Fallo_Equipo', '2024-02-15', 'Calle_Principal_123', 'juang@email.com'),
(4, 'Maria_Lopez', '4445556666', 'La_Romana', 'Error_Sistema', '2024-02-16', 'Calle_Segunda_78', 'marial@email.com'),
(5, 'Pedro_Santos', '6667778888', 'Puerto_Plata', 'Ruidos_Parlantes', '2024-02-17', 'Avenida_Independencia_90', 'pedros@email.com'),
(6, 'Sofia_Castro', '8889990000', 'Santo_Domingo_Oeste', 'Fallo_Equipo', '2024-02-18', 'Calle_Primera_56', 'sofiac@email.com'),
(7, 'Luis_Pena', '0001112222', 'Santo_Domingo_Norte', 'Error_Sistema', '2024-02-19', 'Avenida_27_Febrero_34', 'luisp@email.com'),
(8, 'Ana_Torres', '2223334444', 'Santiago', 'Ruidos_Parlantes', '2024-02-20', 'Calle_Principal_90', 'anat@email.com'),
(9, 'Carlos_Diaz', '3334445555', 'La_Romana', 'Fallo_Equipo', '2024-02-21', 'Calle_Segunda_12', 'carlosd@email.com'),
(10, 'Maria_Ruiz', '4445556666', 'Puerto_Plata', 'Error_Sistema', '2024-02-22', 'Avenida_Independencia_45', 'mariar@email.com'),
(11, 'Pedro_Lopez', '5556667777', 'Santo_Domingo_Este', 'Ruidos_Parlantes', '2024-02-23', 'La_caleta_boca_chica_ITLA', 'pedrol@email.com'),
(12, 'Sofia_Luna', '6667778888', 'Santo_Domingo_Norte', 'Fallo_Equipo', '2024-02-24', 'Avenida_27_Febrero_56', 'sofial@email.com'),
(13, 'Luis_Garcia', '7778889999', 'Santiago', 'Error_Sistema', '2024-02-25', 'Calle_Principal_123', 'luisg@email.com'),
(14, 'Ana_Diaz', '8889990000', 'La_Romana', 'Ruidos_Parlantes', '2024-02-26', 'Calle_Segunda_78', 'anad@email.com'),
(15, 'Carlos_Cruz', '9990001111', 'Puerto_Plata', 'Fallo_Equipo', '2024-02-27', 'Avenida_Independencia_90', 'carlosc@email.com'),
(16, 'Maria_Reyes', '0001112222', 'Santo_Domingo_Oeste', 'Error_Sistema', '2024-02-28', 'Calle_Primera_45', 'mariarr@email.com'),
(17, 'Pedro_Silva', '1112223333', 'Santo_Domingo_Norte', 'Ruidos_Parlantes', '2024-03-01', 'Avenida_27_Febrero_34', 'pedros@email.com'),
(18, 'Sofia_Mora', '2223334444', 'Santiago', 'Fallo_Equipo', '2024-03-02', 'Calle_Principal_90', 'sofiam@email.com'),
(19, 'Luis_Diaz', '3334445555', 'La_Romana', 'Error_Sistema', '2024-03-03', 'Calle_Segunda_12', 'luisd@email.com'),
(20, 'Ana_Castro', '4445556666', 'Puerto_Plata', 'Ruidos_Parlantes', '2024-03-04', 'Avenida_Independencia_45', 'anac@email.com'),
(21, 'Carlos_Rojas', '5556667777', 'Santo_Domingo_Este', 'Fallo_Equipo', '2024-03-05', 'La_caleta_boca_chica_ITLA', 'carlosr@email.com'),
(22, 'Maria_Pena', '6667778888', 'Santo_Domingo_Norte', 'Error_Sistema', '2024-03-06', 'Avenida_27_Febrero_56', 'mariap@email.com'),
(23, 'Pedro_Mora', '7778889999', 'Santiago', 'Ruidos_Parlantes', '2024-03-07', 'Calle_Principal_123', 'pedrom@email.com'),
(24, 'Sofia_Cruz', '8889990000', 'La_Romana', 'Fallo_Equipo', '2024-03-08', 'Calle_Segunda_78', 'sofiac@email.com'),
(25, 'Luis_Rojas', '9990001111', 'Puerto_Plata', 'Error_Sistema', '2024-03-09', 'Avenida_Independencia_90', 'luisr@email.com'),
(26, 'Ana_Silva', '0001112222', 'Santo_Domingo_Oeste', 'Ruidos_Parlantes', '2024-03-10', 'Calle_Primera_45', 'anas@email.com'),
(27, 'Carlos_Mora', '1112223333', 'Santo_Domingo_Norte', 'Fallo_Equipo', '2024-03-11', 'Avenida_27_Febrero_34', 'carlosm@email.com'),
(28, 'Maria_Cruz', '2223334444', 'Santiago', 'Error_Sistema', '2024-03-12', 'Calle_Principal_90', 'mariac@email.com'),
(29, 'Pedro_Rojas', '3334445555', 'La_Romana', 'Ruidos_Parlantes', '2024-03-13', 'Calle_Segunda_12', 'pedror@email.com'),
(30, 'Sofia_Pena', '4445556666', 'Puerto_Plata', 'Fallo_Equipo', '2024-03-14', 'Avenida_Independencia_45', 'sofiap@email.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias_users`
--

CREATE TABLE `denuncias_users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `denuncias_users`
--

INSERT INTO `denuncias_users` (`id`, `nombre`, `cedula`, `ubicacion`, `tipo`, `descripcion`, `fecha`) VALUES
(17, 'Luisangel', '232132321312', 'sadasdasdasdsadsadwadwadwadwadwadwa', 'construccion', 'ijdiajd9iasdiasjidjasdjasdjasdjassa', '2025-01-23 15:04:49'),
(18, 'Luisangel ', '12345678901', 'caleta rd', 'ruido', 'jkldhjashdjkashdsjkahdjkashdjkashdjkash soy frayyyyyyyyyy', '2025-04-25 19:58:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `id_tecnico` int(11) NOT NULL,
  `id_dispositivo` varchar(50) NOT NULL,
  `fecha_instalacion` date NOT NULL,
  `ubicacion_geografica` varchar(100) NOT NULL,
  `zona_referencia` varchar(100) DEFAULT NULL,
  `estado_dispositivo` varchar(50) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','normal') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(23, 'Luisangel ', 'luisangelgamer20@gmail.com', '$2y$10$ZPCCdPld3f3BUIdZMqEpB.QT1YDaD8C0CROgZ68QjvWDHJqNNJRbK', 'admin'),
(24, 'njkadnasdsdasd', 'marinneuif@gmail.cokm', 'sf5HNyDmh8GmktH', 'normal'),
(25, 'Luisangel123', 'luisramirezsanchez2450@gmail.com', '$2y$10$WXTqewHj/WIx2YlyOHiHceynFsHAr55XlKJeWEHLkm0KDC0UG0oQW', 'admin'),
(27, 'Victoria flores', 'luisangelgamer2000@gmail.com', 'Luisange11', 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_users`
--

CREATE TABLE `usuarios_users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  `cedula` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_users`
--

INSERT INTO `usuarios_users` (`id`, `nombre`, `email`, `contraseña`, `fecha_registro`, `estado`, `cedula`) VALUES
(30, 'Luisangel', 'luisangelgamer20@gmail.com', '$2y$10$lZHXawpnVt2kYt1rfQiZG.xa7YIG1Mocs2Il5tab/tvOcHOgg/9b2', '2025-01-16 09:04:20', 'activo', '12345678901'),
(31, 'Luisangel', 'luisangelgamer20@gmail.com', '$2y$10$mLNO.0Hfk1t9hC9vlPpY6OXnW/5kTQzOp5eOn8AY5.UiEVOvHJzFm', '2025-01-16 11:48:39', 'activo', '09876543212'),
(32, 'Abel', 'luisangelgamer20@gmail.com', '$2y$10$KYp9PA9ncl4lu0UW1TeNQ.qeVd.JrZpbuWsITzQZZg2Oa9uYwMpxG', '2025-01-16 11:57:02', 'activo', '1234567880'),
(33, 'Luisangel ramirez', 'luisramirezsanchez2450@gmail.com', '$2y$10$2Aibkh8udg98wmh82Wwz/OA1h9XGeeJAyGvogoUF4mNYK7/IYtKMS', '2025-01-20 00:15:11', 'activo', '09876543211'),
(34, 'Luisangel123', 'luisangelgamer0@gmail.com', '$2y$10$hCfqxwwFX1EX1MeKJToUpesk70g0Gd7a5hQFR.Te4axFBzCG1.x7e', '2025-01-23 15:02:14', 'activo', '1234567789'),
(35, 'nuevo usuario', 'luisangelgamer2220@gmail.com', '$2y$10$KnEv56oR4uiGnq4jj47ddeNdl0QnVfzyvtXykclqhSIXBVgmLPy/.', '2025-04-25 19:57:26', 'activo', '23213232131222');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `denuncias_users`
--
ALTER TABLE `denuncias_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tecnico` (`id_tecnico`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios_users`
--
ALTER TABLE `usuarios_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `denuncias_users`
--
ALTER TABLE `denuncias_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios_users`
--
ALTER TABLE `usuarios_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD CONSTRAINT `dispositivos_ibfk_1` FOREIGN KEY (`id_tecnico`) REFERENCES `tecnicos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
