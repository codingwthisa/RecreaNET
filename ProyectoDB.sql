-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-05-2024 a las 16:56:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ProyectoDB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividades`
--

CREATE TABLE `Actividades` (
  `Identificador` int(11) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Cliente_Numero_cliente` int(11) DEFAULT NULL,
  `Lider_CI` int(11) DEFAULT NULL,
  `Lider_Certificacion_Codigo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Actividades`:
--   `Cliente_Numero_cliente`
--       `Cliente` -> `Numero_cliente`
--   `Lider_CI`
--       `Lideres_de_grupo` -> `CI`
--   `Lider_Certificacion_Codigo`
--       `Certificacion` -> `Codigo`
--

--
-- Volcado de datos para la tabla `Actividades`
--

INSERT INTO `Actividades` (`Identificador`, `Descripcion`, `Cliente_Numero_cliente`, `Lider_CI`, `Lider_Certificacion_Codigo`) VALUES
(1, 'Excursión de Montaña', 100, 12345678, 'CERT001'),
(2, 'Retiro en el Bosque', 101, 87654321, 'CERT002'),
(3, 'Expedición de Descubrimiento', 102, 24681357, 'CERT001'),
(4, 'Campamento Nocturno', 103, 13579246, 'CERT004'),
(5, 'Festival de Aventura', 104, 24681357, 'CERT005'),
(6, 'Pijamada', 103, 24681357, 'CERT005');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asociacion`
--

CREATE TABLE `Asociacion` (
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Asociacion`:
--

--
-- Volcado de datos para la tabla `Asociacion`
--

INSERT INTO `Asociacion` (`Nombre`, `Direccion`, `Telefono`) VALUES
('Alianza Juvenil', '2021 Callejuela Este', '666555444'),
('Camino al Éxito', '1315 Carrera Este', '111222333'),
('Esperanza Joven', '1819 Camino Real', '777888999'),
('Estrellas en Crecimiento', '789 Boulevard Norte', '555555555'),
('Futuro Brillante', '2425 Avenida Central', '555444333'),
('Innovación y Desarrollo', '2223 Boulevard Sur', '888999000'),
('Juventud Activa', '123 Calle Principal', '123456789'),
('Progreso Juvenil', '1617 Avenida Oeste', '444555666'),
('Renacimiento Juvenil', '1011 Callejón Sur', '999888777'),
('Unidos por el Futuro', '456 Avenida Central', '987654321');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Campamentos`
--

CREATE TABLE `Campamentos` (
  `Identificador` int(11) NOT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `Duracion` varchar(50) DEFAULT NULL,
  `Actividades_idActividades` int(11) DEFAULT NULL,
  `Actividades_Cliente_Numero_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Campamentos`:
--   `Actividades_Cliente_Numero_cliente`
--       `Actividades` -> `Cliente_Numero_cliente`
--   `Actividades_idActividades`
--       `Actividades` -> `Identificador`
--

--
-- Volcado de datos para la tabla `Campamentos`
--

INSERT INTO `Campamentos` (`Identificador`, `Ubicacion`, `Duracion`, `Actividades_idActividades`, `Actividades_Cliente_Numero_cliente`) VALUES
(10, 'Campamento Aventura', '5 días', 1, 100),
(20, 'Campamento Naturaleza', '3 días', 2, 101),
(30, 'Campamento Exploradores', '4 días', 3, 102),
(40, 'Campamento Estrellas', '6 días', 4, 103),
(50, 'Campamento Alegria', '7 días', 5, 104);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Certificacion`
--

CREATE TABLE `Certificacion` (
  `Codigo` varchar(50) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Grado` varchar(50) DEFAULT NULL,
  `Asociacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Certificacion`:
--   `Asociacion`
--       `Asociacion` -> `Nombre`
--

--
-- Volcado de datos para la tabla `Certificacion`
--

INSERT INTO `Certificacion` (`Codigo`, `Fecha`, `Grado`, `Asociacion`) VALUES
('CERT001', '2023-05-15', 'Avanzado', 'Juventud Activa'),
('CERT002', '2023-06-20', 'Intermedio', 'Unidos por el Futuro'),
('CERT003', '2023-07-10', 'Básico', 'Estrellas en Crecimiento'),
('CERT004', '2023-08-05', 'Avanzado', 'Renacimiento Juvenil'),
('CERT005', '2023-09-12', 'Intermedio', 'Camino al Éxito'),
('CERT006', '2023-11-11', 'Intermedio', 'Innovación y Desarrollo'),
('CERT007', '2024-05-08', 'Avanzado', 'Esperanza Joven'),
('CERT010', '2024-05-10', 'Intermedio', 'Estrellas en Crecimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente`
--

CREATE TABLE `Cliente` (
  `Numero_cliente` int(11) NOT NULL,
  `CI` int(11) DEFAULT NULL,
  `Telefono` bigint(20) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Cliente`:
--

--
-- Volcado de datos para la tabla `Cliente`
--

INSERT INTO `Cliente` (`Numero_cliente`, `CI`, `Telefono`, `Edad`) VALUES
(100, 12345678, 111222333, 25),
(101, 87654321, 444555666, 30),
(102, 98765432, 777888999, 28),
(103, 13579246, 111222, 35),
(104, 24681357, 333444555, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Colonias`
--

CREATE TABLE `Colonias` (
  `Codigo` int(11) NOT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `Asociacion_Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Colonias`:
--   `Asociacion_Nombre`
--       `Asociacion` -> `Nombre`
--

--
-- Volcado de datos para la tabla `Colonias`
--

INSERT INTO `Colonias` (`Codigo`, `Ubicacion`, `Asociacion_Nombre`) VALUES
(1, 'Colonia del Bosque Encantado', 'Juventud Activa'),
(2, 'Colonia de la Pradera Serena', 'Unidos por el Futuro'),
(3, 'Colonia del Pueblo Tranquilo', 'Estrellas en Crecimiento'),
(4, 'Colonia del Lago Azul', 'Renacimiento Juvenil'),
(5, 'Colonia de la Montaña Dorada', 'Camino al Éxito'),
(6, 'Colonia del Valle Verde', 'Progreso Juvenil'),
(7, 'Colonia del Río Cristalino', 'Esperanza Joven'),
(8, 'Colonia de la Playa Dorada', 'Alianza Juvenil'),
(9, 'Colonia de la Ciudad Esmeralda', 'Innovación y Desarrollo'),
(10, 'Colonia del Lago Azul', 'Futuro Brillante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Colonia_has_Lider`
--

CREATE TABLE `Colonia_has_Lider` (
  `ID_Colonia` int(11) NOT NULL,
  `CI_Lider` int(11) NOT NULL,
  `Colonias_Asociacion_Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Colonia_has_Lider`:
--   `ID_Colonia`
--       `Colonias` -> `Codigo`
--   `CI_Lider`
--       `Lideres_de_grupo` -> `CI`
--   `Colonias_Asociacion_Nombre`
--       `Asociacion` -> `Nombre`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Deportes`
--

CREATE TABLE `Deportes` (
  `Identificador` int(11) NOT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `Accesorio` varchar(100) DEFAULT NULL,
  `Horas_semanales` decimal(5,2) DEFAULT NULL,
  `Actividades_idActividades` int(11) DEFAULT NULL,
  `Actividades_Cliente_Numero_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Deportes`:
--   `Actividades_Cliente_Numero_cliente`
--       `Actividades` -> `Cliente_Numero_cliente`
--   `Actividades_idActividades`
--       `Actividades` -> `Identificador`
--

--
-- Volcado de datos para la tabla `Deportes`
--

INSERT INTO `Deportes` (`Identificador`, `Tipo`, `Accesorio`, `Horas_semanales`, `Actividades_idActividades`, `Actividades_Cliente_Numero_cliente`) VALUES
(1, 'Fútbol', 'Balón', 5.00, 2, 100),
(2, 'Baloncesto', 'Balón', 4.00, 1, 101),
(3, 'Natación', 'Traje de baño', 3.00, 3, 102),
(4, 'Tenis', 'Raqueta', 6.00, 4, 103),
(5, 'Atletismo', 'Zapatillas', 7.00, 5, 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Juegos`
--

CREATE TABLE `Juegos` (
  `Identificador` int(11) NOT NULL,
  `Tipo_juego` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Cantidad_participantes` int(11) DEFAULT NULL,
  `Actividades_idActividades` int(11) DEFAULT NULL,
  `Actividades_Cliente_Numero_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Juegos`:
--   `Actividades_Cliente_Numero_cliente`
--       `Actividades` -> `Cliente_Numero_cliente`
--   `Actividades_idActividades`
--       `Actividades` -> `Identificador`
--

--
-- Volcado de datos para la tabla `Juegos`
--

INSERT INTO `Juegos` (`Identificador`, `Tipo_juego`, `Descripcion`, `Cantidad_participantes`, `Actividades_idActividades`, `Actividades_Cliente_Numero_cliente`) VALUES
(1, 'Ajedrez', 'Juego de estrategia', 2, 1, 100),
(2, 'Damas', 'Juego de mesa', 2, 3, 101),
(3, 'Twister', 'Juego de habilidad física', 4, 4, 102),
(4, 'Monopoly', 'Juego de negociación', 4, 5, 103),
(5, 'Serpientes y escaleras', 'Juego de mesa', 6, 1, 104);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lideres_de_grupo`
--

CREATE TABLE `Lideres_de_grupo` (
  `CI` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Telefono` varchar(50) DEFAULT NULL,
  `Certificacion_Codigo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `Lideres_de_grupo`:
--   `Certificacion_Codigo`
--       `Certificacion` -> `Codigo`
--

--
-- Volcado de datos para la tabla `Lideres_de_grupo`
--

INSERT INTO `Lideres_de_grupo` (`CI`, `Nombre`, `Telefono`, `Certificacion_Codigo`) VALUES
(12291, 'Isabella', '3136087338', 'CERT005'),
(989796, 'Andrés', '15473', 'CERT005'),
(1004432, 'Laura', '3147580561', 'CERT003'),
(12345678, 'Juan Pérez', '111222333', 'CERT001'),
(13579246, 'Ana Martínez', '111222', 'CERT003'),
(24681357, 'Luis Rodríguez', '333444555', 'CERT002'),
(87654321, 'María López', '444555666', 'CERT004');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Actividades`
--
ALTER TABLE `Actividades`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `FK_Cliente_Numero_cliente` (`Cliente_Numero_cliente`),
  ADD KEY `FK_Lider_CI` (`Lider_CI`),
  ADD KEY `FK_Lider_Certificacion_Codigo` (`Lider_Certificacion_Codigo`);

--
-- Indices de la tabla `Asociacion`
--
ALTER TABLE `Asociacion`
  ADD PRIMARY KEY (`Nombre`),
  ADD KEY `idx_Nombre` (`Nombre`);

--
-- Indices de la tabla `Campamentos`
--
ALTER TABLE `Campamentos`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `FK_Actividades_idActividades_Campamentos` (`Actividades_idActividades`),
  ADD KEY `FK_Actividades_Cliente_Numero_cliente_Campamentos` (`Actividades_Cliente_Numero_cliente`);

--
-- Indices de la tabla `Certificacion`
--
ALTER TABLE `Certificacion`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_asociacion` (`Asociacion`);

--
-- Indices de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`Numero_cliente`);

--
-- Indices de la tabla `Colonias`
--
ALTER TABLE `Colonias`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `FK_Asociacion_Nombre` (`Asociacion_Nombre`);

--
-- Indices de la tabla `Colonia_has_Lider`
--
ALTER TABLE `Colonia_has_Lider`
  ADD PRIMARY KEY (`ID_Colonia`,`CI_Lider`),
  ADD KEY `CI_Lider` (`CI_Lider`),
  ADD KEY `Colonias_Asociacion_Nombre` (`Colonias_Asociacion_Nombre`);

--
-- Indices de la tabla `Deportes`
--
ALTER TABLE `Deportes`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `FK_Actividades_idActividades_Deportes` (`Actividades_idActividades`),
  ADD KEY `FK_Actividades_Cliente_Numero_cliente_Deportes` (`Actividades_Cliente_Numero_cliente`);

--
-- Indices de la tabla `Juegos`
--
ALTER TABLE `Juegos`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `FK_Actividades_idActividades_Juegos` (`Actividades_idActividades`),
  ADD KEY `FK_Actividades_Cliente_Numero_cliente_Juegos` (`Actividades_Cliente_Numero_cliente`);

--
-- Indices de la tabla `Lideres_de_grupo`
--
ALTER TABLE `Lideres_de_grupo`
  ADD PRIMARY KEY (`CI`),
  ADD KEY `fk_certificacion` (`Certificacion_Codigo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Actividades`
--
ALTER TABLE `Actividades`
  ADD CONSTRAINT `FK_Cliente_Numero_cliente` FOREIGN KEY (`Cliente_Numero_cliente`) REFERENCES `Cliente` (`Numero_cliente`),
  ADD CONSTRAINT `FK_Lider_CI` FOREIGN KEY (`Lider_CI`) REFERENCES `Lideres_de_grupo` (`CI`),
  ADD CONSTRAINT `FK_Lider_Certificacion_Codigo` FOREIGN KEY (`Lider_Certificacion_Codigo`) REFERENCES `Certificacion` (`Codigo`);

--
-- Filtros para la tabla `Campamentos`
--
ALTER TABLE `Campamentos`
  ADD CONSTRAINT `FK_Actividades_Cliente_Numero_cliente_Campamentos` FOREIGN KEY (`Actividades_Cliente_Numero_cliente`) REFERENCES `Actividades` (`Cliente_Numero_cliente`),
  ADD CONSTRAINT `FK_Actividades_idActividades_Campamentos` FOREIGN KEY (`Actividades_idActividades`) REFERENCES `Actividades` (`Identificador`);

--
-- Filtros para la tabla `Certificacion`
--
ALTER TABLE `Certificacion`
  ADD CONSTRAINT `fk_asociacion` FOREIGN KEY (`Asociacion`) REFERENCES `Asociacion` (`Nombre`);

--
-- Filtros para la tabla `Colonias`
--
ALTER TABLE `Colonias`
  ADD CONSTRAINT `FK_Asociacion_Nombre` FOREIGN KEY (`Asociacion_Nombre`) REFERENCES `Asociacion` (`Nombre`);

--
-- Filtros para la tabla `Colonia_has_Lider`
--
ALTER TABLE `Colonia_has_Lider`
  ADD CONSTRAINT `colonia_has_lider_ibfk_1` FOREIGN KEY (`ID_Colonia`) REFERENCES `Colonias` (`Codigo`),
  ADD CONSTRAINT `colonia_has_lider_ibfk_2` FOREIGN KEY (`CI_Lider`) REFERENCES `Lideres_de_grupo` (`CI`),
  ADD CONSTRAINT `colonia_has_lider_ibfk_3` FOREIGN KEY (`Colonias_Asociacion_Nombre`) REFERENCES `Asociacion` (`Nombre`);

--
-- Filtros para la tabla `Deportes`
--
ALTER TABLE `Deportes`
  ADD CONSTRAINT `FK_Actividades_Cliente_Numero_cliente_Deportes` FOREIGN KEY (`Actividades_Cliente_Numero_cliente`) REFERENCES `Actividades` (`Cliente_Numero_cliente`),
  ADD CONSTRAINT `FK_Actividades_idActividades_Deportes` FOREIGN KEY (`Actividades_idActividades`) REFERENCES `Actividades` (`Identificador`);

--
-- Filtros para la tabla `Juegos`
--
ALTER TABLE `Juegos`
  ADD CONSTRAINT `FK_Actividades_Cliente_Numero_cliente_Juegos` FOREIGN KEY (`Actividades_Cliente_Numero_cliente`) REFERENCES `Actividades` (`Cliente_Numero_cliente`),
  ADD CONSTRAINT `FK_Actividades_idActividades_Juegos` FOREIGN KEY (`Actividades_idActividades`) REFERENCES `Actividades` (`Identificador`);

--
-- Filtros para la tabla `Lideres_de_grupo`
--
ALTER TABLE `Lideres_de_grupo`
  ADD CONSTRAINT `fk_certificacion` FOREIGN KEY (`Certificacion_Codigo`) REFERENCES `Certificacion` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
