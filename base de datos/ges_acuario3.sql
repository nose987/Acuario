-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2024 a las 02:15:58
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
-- Base de datos: `ges_acuario3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agua`
--

CREATE TABLE `agua` (
  `pk_agua` smallint(6) NOT NULL,
  `ph` text NOT NULL,
  `amoniaco` text NOT NULL,
  `nitrato` text NOT NULL,
  `nitritos` text NOT NULL,
  `fk_tanque` smallint(6) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agua`
--

INSERT INTO `agua` (`pk_agua`, `ph`, `amoniaco`, `nitrato`, `nitritos`, `fk_tanque`, `fecha`) VALUES
(1, '23', '23', '32', '23', 14, '2024-11-21 00:00:00'),
(2, '12', '123', '123', '123', 10, '2024-11-04 20:17:00'),
(3, '23', '23', '23', '23', 11, '2024-11-18 22:53:00'),
(4, '1', '1', '1', '1', 8, '2024-11-29 15:51:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentacion`
--

CREATE TABLE `alimentacion` (
  `pk_alimentacion` smallint(6) NOT NULL,
  `fk_especie` smallint(6) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fk_inventario` smallint(6) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `fk_area` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alimentacion`
--

INSERT INTO `alimentacion` (`pk_alimentacion`, `fk_especie`, `cantidad`, `descripcion`, `fk_inventario`, `fecha`, `hora`, `fk_area`) VALUES
(2, 1, 40, 'esparcir poco a poco ', 2, '2024-11-29', '09:06:00', 1),
(3, 1, 50, 'meter la bolsa a la pecera', 2, '2024-11-05', '10:22:00', 1),
(4, 1, 50, 'meter la bolsa a la pecera', 2, '2024-11-05', '10:22:00', 1),
(5, 1, 50, 'meter la bolsa a la pecera', 2, '2024-11-05', '10:22:00', 1),
(6, 1, 30, 'meter la bolsa a la pecera', 1, '2024-10-30', '12:28:00', 1),
(7, 1, 30, 'meter la bolsa a la pecera', 1, '2024-10-30', '12:28:00', 1),
(8, 1, 40, 'esparcir poco a poco ', 1, '2024-11-05', '20:34:00', 1),
(9, 1, 1, 'arrojar a la alberca', 2, '2024-11-04', '07:36:00', 1),
(10, 1, 34, 'asdsgfdb', 1, '2024-11-07', '22:55:00', 1),
(11, 1, 23, 'darles de comer de manera delicada', 1, '2024-11-19', '22:53:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `pk_area` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `zona` varchar(100) NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `piso` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`pk_area`, `nombre`, `zona`, `lugar`, `piso`) VALUES
(1, 'Recepción y Taquilla', 'fauna de agua dulce', 'Entrada principal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `pk_categoria` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estatus` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`pk_categoria`, `nombre`, `estatus`) VALUES
(1, 'alimento', 1),
(2, 'piezas', 1),
(3, 'medicamento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_tratamiento`
--

CREATE TABLE `detalle_tratamiento` (
  `pk_detalle_tratamiento` smallint(6) NOT NULL,
  `fk_tratamiento` smallint(6) NOT NULL,
  `fk_inventario` smallint(6) NOT NULL,
  `dosis` varchar(100) DEFAULT NULL,
  `frecuencia` varchar(100) DEFAULT NULL,
  `fecha_aplicacion` datetime NOT NULL,
  `notas` text DEFAULT NULL,
  `fk_persona` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `pk_diagnostico` smallint(6) NOT NULL,
  `fk_salud_especie` smallint(6) NOT NULL,
  `fecha_diagnostico` datetime NOT NULL,
  `descripcion` text NOT NULL,
  `gravedad` enum('Leve','Moderado','Grave','Crítico') NOT NULL,
  `fk_persona` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `diagnostico`
--

INSERT INTO `diagnostico` (`pk_diagnostico`, `fk_salud_especie`, `fecha_diagnostico`, `descripcion`, `gravedad`, `fk_persona`) VALUES
(1, 1, '2024-11-07 03:30:07', 'problemas en las branquias', 'Leve', 16),
(2, 1, '2024-11-07 03:30:42', 'problemas en las branquias', 'Leve', 16),
(3, 3, '2024-11-07 05:08:01', 'asdaskujndsivnksd', 'Leve', 16),
(4, 4, '2024-11-14 01:40:30', 'n b', 'Leve', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `pk_equipo` smallint(6) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fk_tipo_equipo` smallint(6) NOT NULL,
  `estado` text NOT NULL,
  `fk_tanque` smallint(6) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`pk_equipo`, `nombre`, `fk_tipo_equipo`, `estado`, `fk_tanque`, `fecha`) VALUES
(5, 'filtro', 1, 'bueno', 8, '2024-11-28 18:21:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `pk_especie` smallint(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `habitad` text NOT NULL,
  `temperatura` varchar(30) NOT NULL,
  `cuidados` text NOT NULL,
  `img_especie` text DEFAULT NULL,
  `fk_tipo_especie` smallint(6) NOT NULL,
  `fk_alimento` smallint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`pk_especie`, `nombre`, `descripcion`, `habitad`, `temperatura`, `cuidados`, `img_especie`, `fk_tipo_especie`, `fk_alimento`) VALUES
(1, 'mojarra', 'pez', 'ewrf', '30 grados', 'efc', NULL, 1, 0),
(2, 'asfadsv', 'asd', 'sdf', '34', 'asd', '', 1, 0),
(3, 'asd', 'asd', 'sdf', '2', 'sdf', '', 2, 0),
(4, 'pecesito', 'payaso', 'pos una pecera', '23', 'tratarlo bonito', '', 7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `pk_inventario` smallint(6) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `fk_categoria` smallint(6) NOT NULL,
  `estatus` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`pk_inventario`, `codigo`, `nombre`, `stock`, `descripcion`, `fecha`, `fk_categoria`, `estatus`) VALUES
(1, '2134124', 'alimento para peces', '424', 'alimento para peces', '2024-11-05 02:31:11', 1, 1),
(2, '87654', 'alimento para tortugas', '5', 'alimento para tortugas', '2024-11-05 02:31:12', 1, 1),
(3, '23r45', 'medicamento', '5', 'medicamento', '2024-11-14 20:24:01', 3, 1),
(4, '876', 'jarabe', '23', 'aonsda', '0000-00-00 00:00:00', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_equipo`
--

CREATE TABLE `mantenimiento_equipo` (
  `pk_mantenimiento_equipo` smallint(6) NOT NULL,
  `fk_equipo` smallint(6) NOT NULL,
  `fecha` datetime NOT NULL,
  `fk_tipo_mantenimiento` smallint(6) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `pk_persona` smallint(6) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apaterno` varchar(100) NOT NULL,
  `amaterno` varchar(100) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `genero` text NOT NULL,
  `direccion` text NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fk_roles` smallint(6) DEFAULT NULL,
  `fk_area` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`pk_persona`, `nombre`, `apaterno`, `amaterno`, `correo`, `edad`, `fecha_nac`, `telefono`, `genero`, `direccion`, `contrasena`, `fk_roles`, `fk_area`) VALUES
(15, 'cuidador', 'cuidador', 'cuidador', 'cuidador@gmail.com', 20, '2003-12-12', '3251146332', 'Masculino', 'Margarita #23', 'cuidador', 2, 1),
(16, 'veterinario', 'veterinario', 'veterinario', 'veterinario@gmail.com', 13, '2024-11-27', '1234567890', 'Masculino', 'una calle cualquiera', 'veterinario', 1, 1),
(17, 'administrador', 'administrador', 'administrador', 'administrador@gmail.com', 12, '2024-11-12', '1234567890', 'Masculino', 'callee', 'administrador', 3, 1),
(18, 'acuatico', 'acuatico', 'acuatico', 'acuatico@gmail.com', 13, '2024-11-06', '1234567890', 'Masculino', 'callee', 'acuatico', 4, 1),
(19, 'mantenimiento', 'mantenimiento', 'mantenimiento', 'mantenimiento@gmail.com', 23, '2024-11-06', '1234567890', 'Masculino', 'callee', 'mantenimiento', 5, 1),
(20, 'asda', 'asda', 'asd', 'nose@gmail.com', 23, '2024-11-05', '1234567890', 'Femenino', 'asdad', 'nsoe', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `pk_roles` smallint(6) NOT NULL,
  `roles` varchar(45) NOT NULL,
  `estatus` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`pk_roles`, `roles`, `estatus`) VALUES
(1, 'Veterinario', 1),
(2, 'Cuidador', 1),
(3, 'Administrador', 1),
(4, 'Técnico acuático', 1),
(5, 'Técnico en mantenimiento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud_especie`
--

CREATE TABLE `salud_especie` (
  `pk_salud_especie` smallint(6) NOT NULL,
  `fk_especie` smallint(6) NOT NULL,
  `fecha_revision` datetime NOT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `longitud` decimal(10,2) DEFAULT NULL,
  `temperatura` decimal(5,2) DEFAULT NULL,
  `estado_general` enum('Saludable','En tratamiento','Crítico','En observación') NOT NULL,
  `comportamiento` text DEFAULT NULL,
  `sintomas` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fk_persona` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `salud_especie`
--

INSERT INTO `salud_especie` (`pk_salud_especie`, `fk_especie`, `fecha_revision`, `peso`, `longitud`, `temperatura`, `estado_general`, `comportamiento`, `sintomas`, `observaciones`, `fk_persona`) VALUES
(1, 1, '2024-11-05 00:00:00', 12.22, 12.23, 23.00, 'Saludable', 'se comporta bien', 'nada fuera de lo normal', 'se mira en perfectas condiciones', 16),
(2, 1, '2024-11-06 22:51:00', 23.23, 23.23, 2.30, 'Saludable', 'sdf', 'sdf', 'sdf', 16),
(3, 1, '2024-11-08 21:08:00', 12.12, 12.12, 12.20, 'Crítico', 'asdasd', 'asdas', 'ewrte', 15),
(4, 1, '2024-11-20 20:42:00', 12.23, 23.23, 23.20, 'Crítico', 'anda comportandose mas o menos', 'asdsd', 'asdasd', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tanque`
--

CREATE TABLE `tanque` (
  `pk_tanque` smallint(6) NOT NULL,
  `capacidad` text NOT NULL,
  `temperatura` text NOT NULL,
  `iluminacion` text NOT NULL,
  `filtracion` text NOT NULL,
  `fk_area` smallint(6) NOT NULL,
  `fk_especie` smallint(6) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tanque`
--

INSERT INTO `tanque` (`pk_tanque`, `capacidad`, `temperatura`, `iluminacion`, `filtracion`, `fk_area`, `fk_especie`, `fecha`) VALUES
(8, '30 litros', '30 grados', '100 lumenes', 'si', 1, 1, '2024-10-30 00:00:00'),
(9, '80 litros', '30 grados', '100 lumenes', 'si', 1, 1, '2024-11-04 00:00:00'),
(10, '20 litros', '20 grados', '100 lumenes', 'si', 1, 1, '2024-11-04 00:00:00'),
(11, '300 litros', '10 grados', '100 lumenes', 'si', 1, 1, '2024-11-04 00:00:00'),
(12, '130 litros', '30 grados', '100 lumenes', 'no', 1, 1, '2024-11-04 00:00:00'),
(13, '20 litros', '10 grados', '300 lumenes', 'no', 1, 1, '2024-12-07 00:00:00'),
(14, '2', '2', '234', 'si', 1, 1, '2024-11-21 00:00:00'),
(15, '2', '2', '234', 'si', 1, 1, '2024-11-21 00:00:00'),
(16, 'asd', 'asd', 'asd', 'si', 1, 3, '2024-11-29 00:00:00'),
(17, '23', '234', '23', 'si', 1, 1, '2024-11-27 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_equipo`
--

CREATE TABLE `tipo_equipo` (
  `pk_tipo_equipo` smallint(6) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estatus` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_equipo`
--

INSERT INTO `tipo_equipo` (`pk_tipo_equipo`, `nombre`, `estatus`) VALUES
(1, 'filtro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_especie`
--

CREATE TABLE `tipo_especie` (
  `pk_tipo_especie` smallint(6) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `estatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_especie`
--

INSERT INTO `tipo_especie` (`pk_tipo_especie`, `tipo`, `estatus`) VALUES
(1, 'pez', 1),
(2, 'nose', NULL),
(3, 'pepe', NULL),
(4, 'pepe', NULL),
(5, 'pez payaso', NULL),
(6, 'pez payaso', NULL),
(7, 'pez payaso', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mantenimiento`
--

CREATE TABLE `tipo_mantenimiento` (
  `pk_tipo_mantenimiento` smallint(6) NOT NULL,
  `tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `pk_tratamiento` smallint(6) NOT NULL,
  `fk_diagnostico` smallint(6) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('En curso','Completado','Suspendido','Programado') NOT NULL,
  `instrucciones` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fk_persona` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`pk_tratamiento`, `fk_diagnostico`, `fecha_inicio`, `fecha_fin`, `descripcion`, `estado`, `instrucciones`, `observaciones`, `fk_persona`) VALUES
(1, 2, '2024-11-13 22:48:00', '2024-11-19 19:52:00', 'asdasd', 'En curso', 'asdasd', 'asdasd', 16),
(2, 3, '2024-11-08 12:09:00', '2024-11-15 21:12:00', 'asd', 'En curso', 'asd', NULL, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `pk_usuario` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fk_persona` smallint(6) NOT NULL,
  `fk_rol` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agua`
--
ALTER TABLE `agua`
  ADD PRIMARY KEY (`pk_agua`),
  ADD KEY `fk_tanque` (`fk_tanque`);

--
-- Indices de la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD PRIMARY KEY (`pk_alimentacion`),
  ADD KEY `fk_especie` (`fk_especie`),
  ADD KEY `fk_inventario` (`fk_inventario`),
  ADD KEY `fk_area` (`fk_area`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`pk_area`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`pk_categoria`);

--
-- Indices de la tabla `detalle_tratamiento`
--
ALTER TABLE `detalle_tratamiento`
  ADD PRIMARY KEY (`pk_detalle_tratamiento`),
  ADD KEY `fk_tratamiento` (`fk_tratamiento`),
  ADD KEY `fk_inventario` (`fk_inventario`),
  ADD KEY `fk_persona` (`fk_persona`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`pk_diagnostico`),
  ADD KEY `fk_salud_especie` (`fk_salud_especie`),
  ADD KEY `fk_persona` (`fk_persona`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`pk_equipo`),
  ADD KEY `fk_tipo_equipo` (`fk_tipo_equipo`),
  ADD KEY `fk_tanque` (`fk_tanque`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`pk_especie`),
  ADD KEY `fk_tipo_especie` (`fk_tipo_especie`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`pk_inventario`),
  ADD KEY `fk_categoria` (`fk_categoria`);

--
-- Indices de la tabla `mantenimiento_equipo`
--
ALTER TABLE `mantenimiento_equipo`
  ADD PRIMARY KEY (`pk_mantenimiento_equipo`),
  ADD KEY `fk_equipo` (`fk_equipo`),
  ADD KEY `fk_tipo_mantenimiento` (`fk_tipo_mantenimiento`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`pk_persona`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_area` (`fk_area`),
  ADD KEY `persona` (`fk_roles`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`pk_roles`);

--
-- Indices de la tabla `salud_especie`
--
ALTER TABLE `salud_especie`
  ADD PRIMARY KEY (`pk_salud_especie`),
  ADD KEY `fk_especie` (`fk_especie`),
  ADD KEY `fk_persona` (`fk_persona`);

--
-- Indices de la tabla `tanque`
--
ALTER TABLE `tanque`
  ADD PRIMARY KEY (`pk_tanque`),
  ADD KEY `fk_area` (`fk_area`),
  ADD KEY `fk_especie` (`fk_especie`);

--
-- Indices de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  ADD PRIMARY KEY (`pk_tipo_equipo`);

--
-- Indices de la tabla `tipo_especie`
--
ALTER TABLE `tipo_especie`
  ADD PRIMARY KEY (`pk_tipo_especie`);

--
-- Indices de la tabla `tipo_mantenimiento`
--
ALTER TABLE `tipo_mantenimiento`
  ADD PRIMARY KEY (`pk_tipo_mantenimiento`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`pk_tratamiento`),
  ADD KEY `fk_diagnostico` (`fk_diagnostico`),
  ADD KEY `fk_persona` (`fk_persona`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`pk_usuario`),
  ADD KEY `fk_persona` (`fk_persona`),
  ADD KEY `fk_rol` (`fk_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agua`
--
ALTER TABLE `agua`
  MODIFY `pk_agua` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  MODIFY `pk_alimentacion` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `pk_area` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `pk_categoria` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_tratamiento`
--
ALTER TABLE `detalle_tratamiento`
  MODIFY `pk_detalle_tratamiento` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `pk_diagnostico` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `pk_equipo` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `pk_especie` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `pk_inventario` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `pk_persona` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `pk_roles` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salud_especie`
--
ALTER TABLE `salud_especie`
  MODIFY `pk_salud_especie` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tanque`
--
ALTER TABLE `tanque`
  MODIFY `pk_tanque` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `pk_tipo_equipo` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_especie`
--
ALTER TABLE `tipo_especie`
  MODIFY `pk_tipo_especie` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `pk_tratamiento` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agua`
--
ALTER TABLE `agua`
  ADD CONSTRAINT `agua_ibfk_1` FOREIGN KEY (`fk_tanque`) REFERENCES `tanque` (`pk_tanque`);

--
-- Filtros para la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD CONSTRAINT `alimentacion_ibfk_1` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`pk_especie`),
  ADD CONSTRAINT `alimentacion_ibfk_2` FOREIGN KEY (`fk_inventario`) REFERENCES `inventario` (`pk_inventario`),
  ADD CONSTRAINT `alimentacion_ibfk_3` FOREIGN KEY (`fk_area`) REFERENCES `area` (`pk_area`);

--
-- Filtros para la tabla `detalle_tratamiento`
--
ALTER TABLE `detalle_tratamiento`
  ADD CONSTRAINT `detalle_tratamiento_ibfk_1` FOREIGN KEY (`fk_tratamiento`) REFERENCES `tratamiento` (`pk_tratamiento`),
  ADD CONSTRAINT `detalle_tratamiento_ibfk_2` FOREIGN KEY (`fk_inventario`) REFERENCES `inventario` (`pk_inventario`),
  ADD CONSTRAINT `detalle_tratamiento_ibfk_3` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`);

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `diagnostico_ibfk_1` FOREIGN KEY (`fk_salud_especie`) REFERENCES `salud_especie` (`pk_salud_especie`),
  ADD CONSTRAINT `diagnostico_ibfk_2` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`fk_tipo_equipo`) REFERENCES `tipo_equipo` (`pk_tipo_equipo`),
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`fk_tanque`) REFERENCES `tanque` (`pk_tanque`);

--
-- Filtros para la tabla `especie`
--
ALTER TABLE `especie`
  ADD CONSTRAINT `especie_ibfk_1` FOREIGN KEY (`fk_tipo_especie`) REFERENCES `tipo_especie` (`pk_tipo_especie`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria` (`pk_categoria`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona` FOREIGN KEY (`fk_roles`) REFERENCES `roles` (`pk_roles`) ON DELETE CASCADE,
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`fk_roles`) REFERENCES `roles` (`pk_roles`) ON DELETE CASCADE,
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`fk_area`) REFERENCES `area` (`pk_area`) ON DELETE CASCADE;

--
-- Filtros para la tabla `salud_especie`
--
ALTER TABLE `salud_especie`
  ADD CONSTRAINT `salud_especie_ibfk_1` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`pk_especie`),
  ADD CONSTRAINT `salud_especie_ibfk_2` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`);

--
-- Filtros para la tabla `tanque`
--
ALTER TABLE `tanque`
  ADD CONSTRAINT `tanque_ibfk_1` FOREIGN KEY (`fk_area`) REFERENCES `area` (`pk_area`),
  ADD CONSTRAINT `tanque_ibfk_2` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`pk_especie`);

--
-- Filtros para la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD CONSTRAINT `tratamiento_ibfk_1` FOREIGN KEY (`fk_diagnostico`) REFERENCES `diagnostico` (`pk_diagnostico`),
  ADD CONSTRAINT `tratamiento_ibfk_2` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
