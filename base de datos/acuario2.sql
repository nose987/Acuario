-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 02:33:54
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
-- Base de datos: `acuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aislamiento_especie`
--

CREATE TABLE `aislamiento_especie` (
  `pk_aislamiento_especie` smallint(6) NOT NULL,
  `fk_especie_individual` smallint(6) NOT NULL,
  `fk_tanque` smallint(6) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `motivos` text NOT NULL,
  `alarma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentacion`
--

CREATE TABLE `alimentacion` (
  `pk_alimentacion` smallint(6) NOT NULL,
  `fk_especie` smallint(6) NOT NULL,
  `veces` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `pk_inventario(alimento)` smallint(6) NOT NULL,
  `horas` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentacion_individual`
--

CREATE TABLE `alimentacion_individual` (
  `pk_alimentacion_individual` smallint(6) NOT NULL,
  `fk_especie_individual` smallint(6) NOT NULL,
  `veces` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `fk_inventario_alimento` smallint(6) NOT NULL,
  `horas` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `pk_area` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `zona` varchar(45) NOT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `piso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calidad_agua`
--

CREATE TABLE `calidad_agua` (
  `pk_calidad_agua` smallint(6) NOT NULL,
  `ph` varchar(45) NOT NULL,
  `amoniaco` varchar(45) NOT NULL,
  `nitratos` varchar(45) NOT NULL,
  `nitritos` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `fk_tanque` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `pk_categoria` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`pk_categoria`, `nombre`, `estatus`) VALUES
(1, 'Alimento', 1),
(2, 'Medicamento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `educacion`
--

CREATE TABLE `educacion` (
  `pk_educacion` smallint(6) NOT NULL,
  `fk_usuario` smallint(6) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `area_estudio` varchar(100) NOT NULL,
  `institucion` varchar(100) NOT NULL,
  `finalizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `pk_equipo` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fk_tipo_equipo` smallint(6) NOT NULL,
  `fk_tanque` smallint(6) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `pk_especie` smallint(6) NOT NULL,
  `nombre_cientifico` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fk_tipo_especie` smallint(6) NOT NULL,
  `descripcion` text NOT NULL,
  `fk_inventario_alimento` smallint(6) NOT NULL,
  `fk_habitat` smallint(6) NOT NULL,
  `temperatura_ideal` varchar(10) NOT NULL,
  `ph_ideal` varchar(45) NOT NULL,
  `tamaño_promedio` float NOT NULL,
  `esperanza_vida` int(11) NOT NULL,
  `region_origen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie_individual`
--

CREATE TABLE `especie_individual` (
  `pk_especie_individual` smallint(6) NOT NULL,
  `fk_especie` smallint(6) NOT NULL,
  `nombre_unico` varchar(45) DEFAULT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `ingreso` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `caracteristicas_especiales` text DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia`
--

CREATE TABLE `experiencia` (
  `pk_experiencia` smallint(6) NOT NULL,
  `fk_usuario` smallint(6) NOT NULL,
  `empresa_anterior` varchar(100) NOT NULL,
  `puesto_anterior` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `responsabilidades` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitat`
--

CREATE TABLE `habitat` (
  `pk_habitat` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_mantenimiento`
--

CREATE TABLE `historial_mantenimiento` (
  `pk_historial_mantenimiento` smallint(6) NOT NULL,
  `fk_equipo` smallint(6) NOT NULL,
  `descripcion` text NOT NULL,
  `realizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_laboral`
--

CREATE TABLE `informacion_laboral` (
  `pk_informacion_laboral` smallint(6) NOT NULL,
  `fk_usuario` smallint(6) NOT NULL,
  `fk_rol` smallint(6) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `contrato` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  `numero_empleado` varchar(45) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `pk_inventario` smallint(6) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estutus` int(11) NOT NULL,
  `alarma` tinyint(4) NOT NULL,
  `fk_categoria` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_equipo`
--

CREATE TABLE `mantenimiento_equipo` (
  `pk_matenimiento_equipo` smallint(6) NOT NULL,
  `fk_equipo` smallint(6) NOT NULL,
  `fecha_mantenimiento` date DEFAULT NULL,
  `realizacion` datetime DEFAULT NULL,
  `descripcion` text NOT NULL,
  `tipo_mantenimiento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_alimento`
--

CREATE TABLE `notificacion_alimento` (
  `pk_notificacion_alimento` smallint(6) NOT NULL,
  `fk_especie` smallint(6) DEFAULT NULL,
  `fk_especie_individual` smallint(6) DEFAULT NULL,
  `hora` time NOT NULL,
  `hora_alimentado` datetime DEFAULT NULL,
  `estatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_mantenimiento`
--

CREATE TABLE `notificacion_mantenimiento` (
  `pk_notificacion_mantenimiento` smallint(6) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `fk_equipo` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `pk_rol` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud_especie`
--

CREATE TABLE `salud_especie` (
  `pk_salud_especie` smallint(6) NOT NULL,
  `fk_especie_individual` smallint(6) NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text NOT NULL,
  `estado` varchar(45) NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tanque`
--

CREATE TABLE `tanque` (
  `pk_tanque` smallint(6) NOT NULL,
  `identificador` varchar(45) NOT NULL,
  `capacidad` varchar(10) NOT NULL,
  `temperatura` varchar(10) NOT NULL,
  `iluminacion` varchar(10) NOT NULL,
  `filtracion` varchar(45) NOT NULL,
  `fk_area` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tanque_especie`
--

CREATE TABLE `tanque_especie` (
  `pk_tanque` smallint(6) NOT NULL,
  `fk_especie` smallint(6) NOT NULL,
  `fk_tanque` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_equipo`
--

CREATE TABLE `tipo_equipo` (
  `pk_tipo_equipo` smallint(6) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_especie`
--

CREATE TABLE `tipo_especie` (
  `pk_tipo_especie` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento_especie`
--

CREATE TABLE `tratamiento_especie` (
  `pk_tratamiento_especie` smallint(6) NOT NULL,
  `fk_salud_especie` smallint(6) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `pk_usuario` smallint(6) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apaterno` varchar(45) NOT NULL,
  `amaterno` varchar(45) DEFAULT NULL,
  `fk_area` smallint(6) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  `correo` text NOT NULL,
  `num_telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aislamiento_especie`
--
ALTER TABLE `aislamiento_especie`
  ADD PRIMARY KEY (`pk_aislamiento_especie`),
  ADD KEY `fk_especie_individual` (`fk_especie_individual`),
  ADD KEY `fk_tanque` (`fk_tanque`);

--
-- Indices de la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD PRIMARY KEY (`pk_alimentacion`),
  ADD KEY `fk_especie` (`fk_especie`);

--
-- Indices de la tabla `alimentacion_individual`
--
ALTER TABLE `alimentacion_individual`
  ADD PRIMARY KEY (`pk_alimentacion_individual`),
  ADD KEY `fk_especie_individual` (`fk_especie_individual`),
  ADD KEY `fk_inventario_alimento` (`fk_inventario_alimento`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`pk_area`);

--
-- Indices de la tabla `calidad_agua`
--
ALTER TABLE `calidad_agua`
  ADD PRIMARY KEY (`pk_calidad_agua`),
  ADD KEY `fk_tanque` (`fk_tanque`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`pk_categoria`);

--
-- Indices de la tabla `educacion`
--
ALTER TABLE `educacion`
  ADD PRIMARY KEY (`pk_educacion`),
  ADD KEY `fk_usuario` (`fk_usuario`);

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
  ADD KEY `fk_tipo_especie` (`fk_tipo_especie`),
  ADD KEY `fk_inventario_alimento` (`fk_inventario_alimento`),
  ADD KEY `fk_habitat` (`fk_habitat`);

--
-- Indices de la tabla `especie_individual`
--
ALTER TABLE `especie_individual`
  ADD PRIMARY KEY (`pk_especie_individual`),
  ADD KEY `fk_especie` (`fk_especie`);

--
-- Indices de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  ADD PRIMARY KEY (`pk_experiencia`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Indices de la tabla `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`pk_habitat`);

--
-- Indices de la tabla `historial_mantenimiento`
--
ALTER TABLE `historial_mantenimiento`
  ADD PRIMARY KEY (`pk_historial_mantenimiento`),
  ADD KEY `fk_equipo` (`fk_equipo`);

--
-- Indices de la tabla `informacion_laboral`
--
ALTER TABLE `informacion_laboral`
  ADD PRIMARY KEY (`pk_informacion_laboral`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_rol` (`fk_rol`);

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
  ADD PRIMARY KEY (`pk_matenimiento_equipo`),
  ADD KEY `fk_equipo` (`fk_equipo`);

--
-- Indices de la tabla `notificacion_alimento`
--
ALTER TABLE `notificacion_alimento`
  ADD PRIMARY KEY (`pk_notificacion_alimento`),
  ADD KEY `fk_especie` (`fk_especie`),
  ADD KEY `fk_especie_individual` (`fk_especie_individual`);

--
-- Indices de la tabla `notificacion_mantenimiento`
--
ALTER TABLE `notificacion_mantenimiento`
  ADD PRIMARY KEY (`pk_notificacion_mantenimiento`),
  ADD KEY `fk_equipo` (`fk_equipo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`pk_rol`);

--
-- Indices de la tabla `salud_especie`
--
ALTER TABLE `salud_especie`
  ADD PRIMARY KEY (`pk_salud_especie`),
  ADD KEY `fk_especie_individual` (`fk_especie_individual`);

--
-- Indices de la tabla `tanque`
--
ALTER TABLE `tanque`
  ADD PRIMARY KEY (`pk_tanque`),
  ADD KEY `fk_area` (`fk_area`);

--
-- Indices de la tabla `tanque_especie`
--
ALTER TABLE `tanque_especie`
  ADD PRIMARY KEY (`pk_tanque`),
  ADD KEY `fk_especie` (`fk_especie`),
  ADD KEY `fk_tanque` (`fk_tanque`);

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
-- Indices de la tabla `tratamiento_especie`
--
ALTER TABLE `tratamiento_especie`
  ADD PRIMARY KEY (`pk_tratamiento_especie`),
  ADD KEY `fk_salud_especie` (`fk_salud_especie`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`pk_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aislamiento_especie`
--
ALTER TABLE `aislamiento_especie`
  MODIFY `pk_aislamiento_especie` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  MODIFY `pk_alimentacion` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alimentacion_individual`
--
ALTER TABLE `alimentacion_individual`
  MODIFY `pk_alimentacion_individual` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `pk_area` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calidad_agua`
--
ALTER TABLE `calidad_agua`
  MODIFY `pk_calidad_agua` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `pk_categoria` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `educacion`
--
ALTER TABLE `educacion`
  MODIFY `pk_educacion` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `pk_equipo` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `pk_especie` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especie_individual`
--
ALTER TABLE `especie_individual`
  MODIFY `pk_especie_individual` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  MODIFY `pk_experiencia` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitat`
--
ALTER TABLE `habitat`
  MODIFY `pk_habitat` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_mantenimiento`
--
ALTER TABLE `historial_mantenimiento`
  MODIFY `pk_historial_mantenimiento` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informacion_laboral`
--
ALTER TABLE `informacion_laboral`
  MODIFY `pk_informacion_laboral` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `pk_inventario` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_equipo`
--
ALTER TABLE `mantenimiento_equipo`
  MODIFY `pk_matenimiento_equipo` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificacion_alimento`
--
ALTER TABLE `notificacion_alimento`
  MODIFY `pk_notificacion_alimento` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificacion_mantenimiento`
--
ALTER TABLE `notificacion_mantenimiento`
  MODIFY `pk_notificacion_mantenimiento` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `pk_rol` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salud_especie`
--
ALTER TABLE `salud_especie`
  MODIFY `pk_salud_especie` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tanque`
--
ALTER TABLE `tanque`
  MODIFY `pk_tanque` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tanque_especie`
--
ALTER TABLE `tanque_especie`
  MODIFY `pk_tanque` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `pk_tipo_equipo` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_especie`
--
ALTER TABLE `tipo_especie`
  MODIFY `pk_tipo_especie` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tratamiento_especie`
--
ALTER TABLE `tratamiento_especie`
  MODIFY `pk_tratamiento_especie` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `pk_usuario` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aislamiento_especie`
--
ALTER TABLE `aislamiento_especie`
  ADD CONSTRAINT `aislamiento_especie_ibfk_1` FOREIGN KEY (`fk_especie_individual`) REFERENCES `especie_individual` (`pk_especie_individual`),
  ADD CONSTRAINT `aislamiento_especie_ibfk_2` FOREIGN KEY (`fk_tanque`) REFERENCES `tanque` (`pk_tanque`);

--
-- Filtros para la tabla `alimentacion`
--
ALTER TABLE `alimentacion`
  ADD CONSTRAINT `alimentacion_ibfk_1` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`pk_especie`);

--
-- Filtros para la tabla `alimentacion_individual`
--
ALTER TABLE `alimentacion_individual`
  ADD CONSTRAINT `alimentacion_individual_ibfk_1` FOREIGN KEY (`fk_especie_individual`) REFERENCES `especie_individual` (`pk_especie_individual`),
  ADD CONSTRAINT `alimentacion_individual_ibfk_2` FOREIGN KEY (`fk_inventario_alimento`) REFERENCES `inventario` (`pk_inventario`);

--
-- Filtros para la tabla `calidad_agua`
--
ALTER TABLE `calidad_agua`
  ADD CONSTRAINT `calidad_agua_ibfk_1` FOREIGN KEY (`fk_tanque`) REFERENCES `tanque` (`pk_tanque`);

--
-- Filtros para la tabla `educacion`
--
ALTER TABLE `educacion`
  ADD CONSTRAINT `educacion_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`pk_usuario`);

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
  ADD CONSTRAINT `especie_ibfk_1` FOREIGN KEY (`fk_tipo_especie`) REFERENCES `tipo_especie` (`pk_tipo_especie`),
  ADD CONSTRAINT `especie_ibfk_2` FOREIGN KEY (`fk_inventario_alimento`) REFERENCES `inventario` (`pk_inventario`),
  ADD CONSTRAINT `especie_ibfk_3` FOREIGN KEY (`fk_habitat`) REFERENCES `habitat` (`pk_habitat`);

--
-- Filtros para la tabla `especie_individual`
--
ALTER TABLE `especie_individual`
  ADD CONSTRAINT `especie_individual_ibfk_1` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`pk_especie`);

--
-- Filtros para la tabla `experiencia`
--
ALTER TABLE `experiencia`
  ADD CONSTRAINT `experiencia_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`pk_usuario`);

--
-- Filtros para la tabla `historial_mantenimiento`
--
ALTER TABLE `historial_mantenimiento`
  ADD CONSTRAINT `historial_mantenimiento_ibfk_1` FOREIGN KEY (`fk_equipo`) REFERENCES `equipo` (`pk_equipo`);

--
-- Filtros para la tabla `informacion_laboral`
--
ALTER TABLE `informacion_laboral`
  ADD CONSTRAINT `informacion_laboral_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`pk_usuario`),
  ADD CONSTRAINT `informacion_laboral_ibfk_2` FOREIGN KEY (`fk_rol`) REFERENCES `rol` (`pk_rol`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria` (`pk_categoria`);

--
-- Filtros para la tabla `mantenimiento_equipo`
--
ALTER TABLE `mantenimiento_equipo`
  ADD CONSTRAINT `mantenimiento_equipo_ibfk_1` FOREIGN KEY (`fk_equipo`) REFERENCES `equipo` (`pk_equipo`);

--
-- Filtros para la tabla `notificacion_alimento`
--
ALTER TABLE `notificacion_alimento`
  ADD CONSTRAINT `notificacion_alimento_ibfk_1` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`pk_especie`),
  ADD CONSTRAINT `notificacion_alimento_ibfk_2` FOREIGN KEY (`fk_especie_individual`) REFERENCES `especie_individual` (`pk_especie_individual`);

--
-- Filtros para la tabla `notificacion_mantenimiento`
--
ALTER TABLE `notificacion_mantenimiento`
  ADD CONSTRAINT `notificacion_mantenimiento_ibfk_1` FOREIGN KEY (`fk_equipo`) REFERENCES `equipo` (`pk_equipo`);

--
-- Filtros para la tabla `salud_especie`
--
ALTER TABLE `salud_especie`
  ADD CONSTRAINT `salud_especie_ibfk_1` FOREIGN KEY (`fk_especie_individual`) REFERENCES `especie_individual` (`pk_especie_individual`);

--
-- Filtros para la tabla `tanque`
--
ALTER TABLE `tanque`
  ADD CONSTRAINT `tanque_ibfk_1` FOREIGN KEY (`fk_area`) REFERENCES `area` (`pk_area`);

--
-- Filtros para la tabla `tanque_especie`
--
ALTER TABLE `tanque_especie`
  ADD CONSTRAINT `tanque_especie_ibfk_1` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`pk_especie`),
  ADD CONSTRAINT `tanque_especie_ibfk_2` FOREIGN KEY (`fk_tanque`) REFERENCES `tanque` (`pk_tanque`);

--
-- Filtros para la tabla `tratamiento_especie`
--
ALTER TABLE `tratamiento_especie`
  ADD CONSTRAINT `tratamiento_especie_ibfk_1` FOREIGN KEY (`fk_salud_especie`) REFERENCES `salud_especie` (`pk_salud_especie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
