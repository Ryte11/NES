-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 20:50:02
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
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `ID` int(11) NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Fecha` date NOT NULL,
  `Instalador` varchar(100) NOT NULL,
  `Estado_Dispositivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`ID`, `Ubicacion`, `Fecha`, `Instalador`, `Estado_Dispositivo`) VALUES
(2147483647, '123456789', '2021-04-12', 'Luisangel RAmirez', 'activo');

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
(25, 'Luisangel123', 'luisramirezsanchez2450@gmail.com', '$2y$10$WXTqewHj/WIx2YlyOHiHceynFsHAr55XlKJeWEHLkm0KDC0UG0oQW', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
