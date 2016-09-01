-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2016 a las 09:37:43
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sepe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_formativa`
--

CREATE TABLE `accion_formativa` (
  `id` int(11) NOT NULL,
  `ORIGEN_ACCION` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CODIGO_ACCION` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SITUACION` char(2) CHARACTER SET latin1 DEFAULT NULL,
  `ORIGEN_ESPECIALIDAD` char(2) CHARACTER SET latin1 DEFAULT NULL,
  `AREA_PROFESIONAL` varchar(4) CHARACTER SET latin1 DEFAULT NULL,
  `CODIGO_ESPECIALIDAD` varchar(8) CHARACTER SET latin1 DEFAULT NULL,
  `DURACION` int(11) DEFAULT NULL,
  `FECHA_INICIO` varchar(10) DEFAULT NULL,
  `FECHA_FIN` varchar(10) DEFAULT NULL,
  `IND_ITINERARIO_COMPLETO` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `TIPO_FINANCIACION` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `NUMERO_ASISTENTES` tinyint(1) DEFAULT NULL,
  `DENOMINACION_ACCION` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `INFORMACION_GENERAL` longtext CHARACTER SET latin1,
  `HORARIOS` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `REQUISITOS` longtext CHARACTER SET latin1,
  `CONTACTO_ACCION` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ID_CENTRO` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_presencial`
--

CREATE TABLE `centro_presencial` (
  `ID_CENTRO` int(11) NOT NULL,
  `ORIGEN_CENTRO` varchar(2) NOT NULL,
  `CODIGO_CENTRO` char(10) NOT NULL,
  `REF_ESPECIALIDAD` int(11) NOT NULL,
  `REF_ACCION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `ID_ESPECIALIDAD` int(11) NOT NULL,
  `ORIGEN_ESPECIALIDAD` char(2) NOT NULL,
  `AREA_PROFESIONAL` varchar(4) NOT NULL,
  `CODIGO_ESPECIALIDAD` varchar(8) NOT NULL,
  `ORIGEN_CENTRO` char(2) NOT NULL,
  `CODIGO_CENTRO` char(10) NOT NULL,
  `FECHA_INICIO` varchar(10) NOT NULL,
  `FECHA_FIN` varchar(10) NOT NULL,
  `MODALIDAD_IMPARTICION` varchar(2) NOT NULL,
  `HORAS_PRESENCIAL` varchar(5) NOT NULL,
  `HORAS_TELEFORMACION` varchar(5) NOT NULL,
  `NUM_PARTICIPANTES_M` varchar(5) NOT NULL,
  `NUMERO_ACCESOS_M` varchar(5) NOT NULL,
  `DURACION_TOTAL_M` varchar(5) NOT NULL,
  `NUM_PARTICIPANTES_T` varchar(5) NOT NULL,
  `NUMERO_ACCESOS_T` varchar(5) NOT NULL,
  `DURACION_TOTAL_T` varchar(5) NOT NULL,
  `NUM_PARTICIPANTES_N` varchar(5) NOT NULL,
  `NUMERO_ACCESOS_N` varchar(5) NOT NULL,
  `DURACION_TOTAL_N` varchar(5) NOT NULL,
  `NUM_PARTICIPANTES_S` varchar(5) NOT NULL,
  `NUMERO_ACTIVIDADES_APRENDIZAJE_S` varchar(5) NOT NULL,
  `NUMERO_INTENTOS_S` varchar(5) NOT NULL,
  `NUMERO_ACTIVIDADES_EVALUACION_S` varchar(5) NOT NULL,
  `REF_ACCION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad_participante`
--

CREATE TABLE `especialidad_participante` (
  `ID_ESP_PART` int(11) NOT NULL,
  `ORIGEN_ESPECIALIDAD` char(2) NOT NULL,
  `AREA_PROFESIONAL` varchar(4) NOT NULL,
  `CODIGO_ESPECIALIDAD` varchar(8) NOT NULL,
  `FECHA_ALTA` varchar(10) NOT NULL,
  `FECHA_BAJA` varchar(10) NOT NULL,
  `ORIGEN_CENTRO_EX` varchar(2) NOT NULL,
  `CODIGO_CENTRO_EX` varchar(10) NOT NULL,
  `FECHA_INICIO_EX` varchar(10) NOT NULL,
  `FECHA_FIN_EX` varchar(10) NOT NULL,
  `RESULTADO_FINAL` varchar(1) NOT NULL,
  `CALIFICACION_FINAL` varchar(4) NOT NULL,
  `PUNTUACION_FINAL` varchar(4) NOT NULL,
  `ORIGEN_CENTRO` varchar(2) NOT NULL,
  `CODIGO_CENTRO` varchar(10) NOT NULL,
  `FECHA_INICIO_T` varchar(10) NOT NULL,
  `FECHA_FIN_T` varchar(10) NOT NULL,
  `REF_PARTICIPANTE` int(11) NOT NULL,
  `REF_ACCION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `ID_PARTICIPANTE` int(11) NOT NULL,
  `TIPO_DOCUMENTO` varchar(1) NOT NULL,
  `NUM_DOCUMENTO` varchar(10) NOT NULL,
  `LETRA_NIF` varchar(1) NOT NULL,
  `INDICADOR_COMPETENCIAS_CLAVE` varchar(2) NOT NULL,
  `ID_CONTRATO_CFA` varchar(14) NOT NULL,
  `CIF_EMPRESA` varchar(9) NOT NULL,
  `TIPO_DOCUMENTO_TE` varchar(1) NOT NULL,
  `NUM_DOCUMENTO_TE` varchar(10) NOT NULL,
  `LETRA_NIF_TE` varchar(1) NOT NULL,
  `TIPO_DOCUMENTO_TF` varchar(1) NOT NULL,
  `NUM_DOCUMENTO_TF` varchar(10) NOT NULL,
  `LETRA_NIF_TF` varchar(1) NOT NULL,
  `REF_ACCION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sepe_centro`
--

CREATE TABLE `sepe_centro` (
  `ID_CENTRO` int(11) NOT NULL,
  `ORIGEN_CENTRO` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CODIGO_CENTRO` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NOMBRE_CENTRO` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `URL_PLATAFORMA` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `URL_SEGUIMIENTO` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TELEFONO` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutorias_presenciales`
--

CREATE TABLE `tutorias_presenciales` (
  `ID_TUTORIA` int(11) NOT NULL,
  `ORIGEN_CENTRO` varchar(2) NOT NULL,
  `CODIGO_CENTRO` varchar(10) NOT NULL,
  `FECHA_INICIO` varchar(10) NOT NULL,
  `FECHA_FIN` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_formador`
--

CREATE TABLE `tutor_formador` (
  `ID_TUTOR` int(11) NOT NULL,
  `TIPO_DOCUMENTO` varchar(1) NOT NULL,
  `NUM_DOCUMENTO` varchar(10) NOT NULL,
  `LETRA_NIF` varchar(1) NOT NULL,
  `ACREDITACION_TUTOR` longtext NOT NULL,
  `EXPERIENCIA_PROFESIONAL` double NOT NULL,
  `COMPETENCIA_DOCENTE` varchar(2) NOT NULL,
  `EXPERIENCIA_MODALIDAD_TELEFORMACION` int(5) NOT NULL,
  `FORMACION_MODALIDAD_TELEFORMACION` varchar(2) NOT NULL,
  `REF_ESPECIALIDAD` int(11) DEFAULT NULL,
  `REF_ACCION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accion_formativa`
--
ALTER TABLE `accion_formativa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centro_presencial`
--
ALTER TABLE `centro_presencial`
  ADD PRIMARY KEY (`ID_CENTRO`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`ID_ESPECIALIDAD`),
  ADD KEY `REF_ACCION` (`REF_ACCION`);

--
-- Indices de la tabla `especialidad_participante`
--
ALTER TABLE `especialidad_participante`
  ADD PRIMARY KEY (`ID_ESP_PART`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`ID_PARTICIPANTE`);

--
-- Indices de la tabla `sepe_centro`
--
ALTER TABLE `sepe_centro`
  ADD PRIMARY KEY (`ID_CENTRO`);

--
-- Indices de la tabla `tutorias_presenciales`
--
ALTER TABLE `tutorias_presenciales`
  ADD PRIMARY KEY (`ID_TUTORIA`);

--
-- Indices de la tabla `tutor_formador`
--
ALTER TABLE `tutor_formador`
  ADD PRIMARY KEY (`ID_TUTOR`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accion_formativa`
--
ALTER TABLE `accion_formativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `centro_presencial`
--
ALTER TABLE `centro_presencial`
  MODIFY `ID_CENTRO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `ID_ESPECIALIDAD` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `especialidad_participante`
--
ALTER TABLE `especialidad_participante`
  MODIFY `ID_ESP_PART` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
  MODIFY `ID_PARTICIPANTE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sepe_centro`
--
ALTER TABLE `sepe_centro`
  MODIFY `ID_CENTRO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tutorias_presenciales`
--
ALTER TABLE `tutorias_presenciales`
  MODIFY `ID_TUTORIA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tutor_formador`
--
ALTER TABLE `tutor_formador`
  MODIFY `ID_TUTOR` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
