-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2025 a las 03:31:19
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
(24, 'Sofia_Cruz', '8889990000', 'La_Romana', 'Fallo_Equipo', '2024-03-08', 'Calle_Segunda_78', 'sofiac@email.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modo_oscuro` tinyint(1) NOT NULL DEFAULT 0,
  `idioma` varchar(10) NOT NULL DEFAULT 'es',
  `notificaciones_email` tinyint(1) NOT NULL DEFAULT 0,
  `notificaciones_push` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `usuario_id`, `modo_oscuro`, `idioma`, `notificaciones_email`, `notificaciones_push`, `fecha_actualizacion`) VALUES
(1, 1, 0, 'es', 0, 0, '2025-05-06 13:58:58'),
(2, 1, 0, 'es', 0, 0, '2025-05-06 13:59:00'),
(3, 1, 0, 'es', 0, 0, '2025-05-06 15:23:01'),
(4, 1, 0, 'es', 0, 0, '2025-05-06 15:23:02'),
(5, 1, 0, 'es', 0, 0, '2025-05-06 15:23:02'),
(6, 1, 0, 'es', 0, 0, '2025-05-06 15:23:02'),
(7, 1, 0, 'es', 0, 0, '2025-05-06 15:23:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','leido','respondido') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `email`, `usuario_id`, `mensaje`, `fecha_envio`, `estado`) VALUES
(1, 'sdasdasdsd', 'sasadasds@gmail.comw', NULL, 'dwadwdadwdwadwadawdwa', '2025-04-30 23:30:10', 'pendiente'),
(2, 'Luisangel ', 'luisangelgamer20@gmail.com', NULL, 'sdasdsadsadsadsad', '2025-04-30 23:32:53', ''),
(3, 'Luisangel ', 'luisramirezsanchez2450@gmail.com', NULL, 'hola soy luis hay mucho ruido\\r\\n', '2025-05-05 16:40:13', ''),
(4, 'Luisangel Ramirez', 'luisramirezsanchez2450@gmail.com', NULL, 'hay mucho ruido', '2025-05-05 16:43:55', ''),
(5, 'Luisangel ', 'luisramirezsanchez2450@gmail.com', NULL, 'bdfgfdgfgdfgfdgf', '2025-05-06 09:39:05', 'pendiente'),
(6, 'Luisangel ', 'luisangelgamer20@gmail.com', NULL, 'dwddsdssasasaasas', '2025-05-06 13:47:11', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `valor` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `valor`, `fecha`) VALUES
(1, 0, '2025-04-29 00:31:04'),
(2, 0, '2025-04-29 00:31:45'),
(3, 0, '2025-04-29 00:31:47'),
(4, 0, '2025-04-29 00:31:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias`
--

CREATE TABLE `denuncias` (
  `id` int(11) NOT NULL,
  `tipo` enum('bocinas','vehiculos','construcciones','parlantes','otros') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `nivel_db` float DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `nombre_denunciante` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `estado` enum('pendiente','en_proceso','resuelta','rechazada') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias_users`
--

CREATE TABLE `denuncias_users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` varchar(50) DEFAULT 'en proceso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `denuncias_users`
--

INSERT INTO `denuncias_users` (`id`, `nombre`, `cedula`, `provincia`, `ubicacion`, `tipo`, `descripcion`, `fecha`, `estado`) VALUES
(17, 'Luisangel', '232132321312', '', 'sadasdasdasdsadsadwadwadwadwadwadwa', 'construccion', 'ijdiajd9iasdiasjidjasdjasdjasdjassa', '2025-01-23 15:04:49', 'en proceso'),
(18, 'Luisangel ', '12345678901', '', 'caleta rd', 'ruido', 'jkldhjashdjkashdsjkahdjkashdjkashdjkash soy frayyyyyyyyyy', '2025-04-25 19:58:00', 'en proceso'),
(19, 'Luisangel ', '232132321312', '', 'caleta rd', 'ruido', 'Soy el goat\r\n', '2025-04-28 11:53:24', 'en proceso'),
(20, 'Luisangel felipe', '1234567789', '', 'caleta rd mi casa 05', 'Vehiculos', 'njandjasndandas hola soy luis\r\n', '2025-05-01 13:44:29', 'aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `id_tecnico` int(11) NOT NULL,
  `nombre_instalador` varchar(255) NOT NULL,
  `id_dispositivo` varchar(50) NOT NULL,
  `fecha_instalacion` date NOT NULL,
  `ubicacion_geografica` varchar(100) NOT NULL,
  `zona_referencia` varchar(255) NOT NULL,
  `estado_dispositivo` varchar(50) NOT NULL DEFAULT 'Desactivado',
  `comentario` text DEFAULT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id`, `id_tecnico`, `nombre_instalador`, `id_dispositivo`, `fecha_instalacion`, `ubicacion_geografica`, `zona_referencia`, `estado_dispositivo`, `comentario`, `latitud`, `longitud`) VALUES
(1, 1, '', 'DISP-680d82d7c168a', '2025-04-27', 'Capturada automáticamente', 'Desconocida', 'Instalado', NULL, 18.47278340, -69.82560420),
(2, 1, 'Lusiangel Ramirez', 'DISP-680d9733e2e79', '2025-04-27', 'Capturada automáticamente', '0', 'Instalado', NULL, 18.47282930, -69.82560030),
(9, 1, 'Lusiangel Ramirez', 'DISP-6819369f42ed6', '2025-05-06', 'Capturada automáticamente', 'Los corales', 'Instalado', NULL, 18.47282270, -69.82560230),
(10, 1, 'Lusiangel Ramirez', 'DISP-681936b081672', '2025-05-06', 'Capturada automáticamente', 'Los corales', 'Instalado', NULL, 18.47282270, -69.82560230),
(11, 1, 'Lusiangel Ramirez', 'DISP-681936b8579dc', '2025-05-06', 'Capturada automáticamente', 'Los corales', 'Instalado', NULL, 18.47282270, -69.82560230),
(12, 1, 'Lusiangel Ramirez', 'DISP-681938d8d4de2', '2025-05-06', 'Capturada automáticamente', 'los corales', 'Instalado', NULL, 18.47283680, -69.82560380),
(13, 1, 'Lusiangel Ramirez', 'DISP-681a15dfa85a6', '2025-05-06', 'Capturada automáticamente', 'Ogtic', 'Instalado', NULL, 18.44952330, -69.94460010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interacciones_chat`
--

CREATE TABLE `interacciones_chat` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT 0,
  `consulta` text NOT NULL,
  `respuesta` text NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones`
--

CREATE TABLE `mediciones` (
  `id` int(11) NOT NULL,
  `dispositivo_id` varchar(50) NOT NULL,
  `nivel_db` float NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `zona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `datos_adicionales` text DEFAULT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(1, 'Azua'),
(2, 'Bahoruco'),
(3, 'Barahona'),
(4, 'Dajabón'),
(5, 'Distrito Nacional'),
(6, 'Duarte'),
(7, 'Elías Piña'),
(8, 'El Seibo'),
(9, 'Espaillat'),
(10, 'Hato Mayor'),
(11, 'Hermanas Mirabal'),
(12, 'Independencia'),
(13, 'La Altagracia'),
(14, 'La Romana'),
(15, 'La Vega'),
(16, 'María Trinidad Sánchez'),
(17, 'Monseñor Nouel'),
(18, 'Monte Cristi'),
(19, 'Monte Plata'),
(20, 'Pedernales'),
(21, 'Peravia'),
(22, 'Puerto Plata'),
(23, 'Samaná'),
(24, 'San Cristóbal'),
(25, 'San José de Ocoa'),
(26, 'San Juan'),
(27, 'San Pedro de Macorís'),
(28, 'Sánchez Ramírez'),
(29, 'Santiago'),
(30, 'Santiago Rodríguez'),
(31, 'Santo Domingo'),
(32, 'Valverde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sound_data`
--

CREATE TABLE `sound_data` (
  `id` int(6) UNSIGNED NOT NULL,
  `db_value` int(3) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_dispositivo` varchar(50) DEFAULT 'DISP-680d82d7c168a',
  `zona` varchar(100) DEFAULT 'La Caleta, ITLA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sound_data`
--

INSERT INTO `sound_data` (`id`, `db_value`, `timestamp`, `id_dispositivo`, `zona`) VALUES
(1, 61, '2025-05-08 18:59:16', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(2, 84, '2025-05-08 19:01:57', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(3, 100, '2025-05-08 19:07:15', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(4, 100, '2025-05-08 19:08:46', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(5, 75, '2025-05-08 19:22:14', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(6, 67, '2025-05-08 19:22:37', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(7, 100, '2025-05-08 19:37:10', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(8, 73, '2025-05-08 19:37:52', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(9, 92, '2025-05-08 19:38:04', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(10, 89, '2025-05-08 19:38:22', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(11, 100, '2025-05-08 19:41:32', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(12, 100, '2025-05-08 19:43:23', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(13, 100, '2025-05-08 19:43:34', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(14, 79, '2025-05-08 19:47:44', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(15, 66, '2025-05-08 19:50:36', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(16, 100, '2025-05-08 19:50:44', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(17, 100, '2025-05-08 19:50:50', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(18, 60, '2025-05-08 19:50:57', 'DISP-680d82d7c168a', 'La Caleta, ITLA'),
(19, 88, '2025-05-08 19:51:30', 'DISP-680d82d7c168a', 'La Caleta, ITLA');

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

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`id`, `usuario`, `nombre_completo`, `cedula`, `contraseña`) VALUES
(1, 'Luis', 'Lusiangel Ramirez', '1234567890', '$2y$10$IubXcUPjWCIzxQSz1BZNJ.O1Es6HALx3aKU0qDzZX5gWFNGSnpqH2'),
(5, 'rai', 'Lusiangel Ramirez casilla', '423423232', '$2y$10$Iwxg3tOeDReyZIfI.BjVeOND.6IaNeKUZDYx163p1MDFkGz8s7pLW'),
(6, 'raieleven11', 'raieleven', '1234567890122222222', '$2y$10$SgzOmuPDIsC.fNqK2wrhMecqab7VETeZdN5yF0pvj0XhIoedZblX2'),
(7, 'manolo 38', 'manolo almanzar', '1234567890133', '$2y$10$GFDny8PrCYlv3PKF2HpKkOHXcojjF2lsIivtBw1teMI4dQtuYEz3G');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `imagen_perfil` varchar(255) DEFAULT 'default_profile.png',
  `rol` enum('admin','normal') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `imagen_perfil`, `rol`) VALUES
(23, 'Luisangel g', 'luisangelgamer20@gmail.com', '$2y$10$ZPCCdPld3f3BUIdZMqEpB.QT1YDaD8C0CROgZ68QjvWDHJqNNJRbK', 'default_profile.png', 'admin'),
(24, 'njkadnasdsdasd', 'marinneuif@gmail.cokm', 'sf5HNyDmh8GmktH', 'default_profile.png', 'normal'),
(25, 'Luisangel123', 'luisramirezsanchez2450@gmail.com', '$2y$10$WXTqewHj/WIx2YlyOHiHceynFsHAr55XlKJeWEHLkm0KDC0UG0oQW', 'default_profile.png', 'admin'),
(27, 'Victoria flores', 'luisangelgamer2000@gmail.com', 'Luisange11', 'default_profile.png', 'normal'),
(29, 'Luisangel ', 'luisangelgamer200@gmail.com', '$2y$10$e00r2TJ0.Kho9OWozKR5fuPs8qbLPPDl8WCWjjPrVKJJT7aGLkE8G', 'profile_681a341e85783.jpg', 'admin'),
(31, 'ryte29', 'luis@gmail.com', '$2y$10$AVDnm0baE3Kph/Z/ZGbife45vxL.VVPhOmlEo0Kq4ptSH/9PcbsnS', 'profile_68137fea2fbcf.png', 'admin'),
(32, 'Luisangel ', 'luisrc112716@gmail.com', '$2y$10$pI/yqaRvk6iynF/XkmWLDu7z/VPv0EgwJEc0l7coEAdYotw7hGL6K', 'profile_681a341e85783.jpg', 'admin'),
(34, 'raielevene', 'luisramirezsanchez245000@gmail.com', '$2y$10$CevKxu1ZSzSNS/q87viF9.ioQHzclnTIgXDQmXGmwChx0Tk8s1vZi', 'profile_681b597f88fa8.jpg', 'normal'),
(35, 'Luisangel ', 'luisangelgamer2@gmail.com', 'Luisange11', 'profile_681a341e85783.jpg', 'normal');

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
(30, 'Luisangel ramirez', 'luisangelgamer20@gmail.com', '$2y$10$Xz1ZO9Lf//3B/ggc7LBkK.opVO.KDtboCnMNMoKjYYexNk4/IeHr6', '2025-01-16 09:04:20', 'activo', '12345678901'),
(31, 'Luisangel', 'luisangelgamer20@gmail.com', '$2y$10$mLNO.0Hfk1t9hC9vlPpY6OXnW/5kTQzOp5eOn8AY5.UiEVOvHJzFm', '2025-01-16 11:48:39', 'activo', '09876543212'),
(32, 'Abel', 'luisangelgamer20@gmail.com', '$2y$10$KYp9PA9ncl4lu0UW1TeNQ.qeVd.JrZpbuWsITzQZZg2Oa9uYwMpxG', '2025-01-16 11:57:02', 'activo', '1234567880'),
(33, 'Luisangel ramirez', 'luisramirezsanchez2450@gmail.com', '$2y$10$2Aibkh8udg98wmh82Wwz/OA1h9XGeeJAyGvogoUF4mNYK7/IYtKMS', '2025-01-20 00:15:11', 'activo', '09876543211'),
(34, 'Luisangel123', 'luisangelgamer0@gmail.com', '$2y$10$hCfqxwwFX1EX1MeKJToUpesk70g0Gd7a5hQFR.Te4axFBzCG1.x7e', '2025-01-23 15:02:14', 'activo', '1234567789'),
(35, 'nuevo usuario', 'luisangelgamer2220@gmail.com', '$2y$10$KnEv56oR4uiGnq4jj47ddeNdl0QnVfzyvtXykclqhSIXBVgmLPy/.', '2025-04-25 19:57:26', 'activo', '23213232131222'),
(36, 'Luisangel ramirez ca', 'luisrc@gmail.com', '$2y$10$Nzx8QitcsWJHUkOwblC9Huued89VhuDNJStZgzvz1qKFMujwE1AkS', '2025-04-27 01:26:57', 'activo', '123456789012222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` enum('residencial','comercial','industrial') NOT NULL,
  `ciudad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`),
  ADD KEY `fecha_hora` (`fecha_hora`),
  ADD KEY `estado` (`estado`);

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
-- Indices de la tabla `interacciones_chat`
--
ALTER TABLE `interacciones_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dispositivo_id` (`dispositivo_id`),
  ADD KEY `fecha_hora` (`fecha_hora`),
  ADD KEY `zona_id` (`zona_id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sound_data`
--
ALTER TABLE `sound_data`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `denuncias_users`
--
ALTER TABLE `denuncias_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `interacciones_chat`
--
ALTER TABLE `interacciones_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `sound_data`
--
ALTER TABLE `sound_data`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios_users`
--
ALTER TABLE `usuarios_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
