-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2018 a las 19:51:48
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `febeca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `elemento` varchar(100) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `accion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` bigint(20) NOT NULL,
  `id_video` int(11) NOT NULL,
  `valoracion` int(1) NOT NULL DEFAULT '0',
  `comentario` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha` varchar(50) NOT NULL,
  `id_usuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(130) DEFAULT NULL,
  `archivo` varchar(255) NOT NULL,
  `archivo_mostrar` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etiqueta` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_caducidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario_creacion` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `nombre`, `descripcion`, `archivo`, `archivo_mostrar`, `fecha`, `etiqueta`, `fecha_caducidad`, `id_usuario_creacion`) VALUES
(1, 'Dr Movil', 'metodologia de desarrollo soft', 'docs/5ba1a0837ed0020180918090403.pdf', 'Dialnet-MetodologiaParaElDesarrolloDeAplicacionesMoviles-4778503.pdf', '2018-09-17 19:12:22', 'Si', '12/25/2018 9:49 AM', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_asignados`
--

CREATE TABLE `documentos_asignados` (
  `id_asignado` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_documentos`
--

CREATE TABLE `logs_documentos` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(10) CHARACTER SET latin1 NOT NULL,
  `id_documento` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(130) CHARACTER SET utf8 NOT NULL,
  `vistas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_login`
--

CREATE TABLE `logs_login` (
  `id_usuario` varchar(10) CHARACTER SET latin1 NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id` int(10) NOT NULL,
  `preview_date` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `last_date` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cont_logs` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_videos`
--

CREATE TABLE `logs_videos` (
  `id_usuario` varchar(10) CHARACTER SET latin1 NOT NULL,
  `id_video` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(130) COLLATE utf8_spanish_ci NOT NULL,
  `vistas` int(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` varchar(20) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `descripcion`) VALUES
('admin', 'Administrador'),
('analista', 'Analista de Inteligencia de Negocio'),
('usuario', 'Usuario regular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_sucursal` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` text,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `estatus` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_sucursal`, `nombre`, `direccion`, `telefono`, `correo`, `logo`, `estatus`) VALUES
(1, 'Febeca', 'Av. Fundo La Union, Parcela L13, L19. Zona Industrial Castillito, Municipio San Diego, Edo. Carabobo', '8567205', 'admin@febeca.com', '591b6e5aa14e020170516042546.jpg', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` varchar(10) NOT NULL,
  `id_sucursal` int(11) NOT NULL DEFAULT '0',
  `clave` varchar(100) NOT NULL,
  `id_rol` varchar(20) DEFAULT 'analista admin',
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id` int(10) NOT NULL,
  `taller` bit(1) DEFAULT b'0' COMMENT 'Puede ingresar al taller?',
  `active_directory` bit(1) NOT NULL DEFAULT b'0',
  `base_datos` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_sucursal`, `clave`, `id_rol`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `id`, `taller`, `active_directory`, `base_datos`) VALUES
('admin', 0, '7fb6a6c6283812f68b6f01da613baf91', 'admin', 'Administrador', 'General', '0', '04161456940', '', 1, b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id_video` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(130) CHARACTER SET latin1 DEFAULT NULL,
  `archivo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `archivo_mostrar` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etiqueta` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_caducidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario_creacion` varchar(10) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id_video`, `nombre`, `descripcion`, `archivo`, `archivo_mostrar`, `fecha`, `etiqueta`, `fecha_caducidad`, `id_usuario_creacion`) VALUES
(1, 'To the claims of duty', 'that they cannot foresee', 'videos/5b9ae528b073020180913063104.webm', '14629e2a-8164-42ee-y80f-d9d154680d14 (1).webm', '2018-09-13 22:31:04', 'Si', '12/28/2018 2:42 PM', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos_asignados`
--

CREATE TABLE `videos_asignados` (
  `id_asignado` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_video` (`id_video`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_usuario_creacion` (`id_usuario_creacion`);

--
-- Indices de la tabla `documentos_asignados`
--
ALTER TABLE `documentos_asignados`
  ADD PRIMARY KEY (`id_asignado`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_documento` (`id_documento`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `logs_documentos`
--
ALTER TABLE `logs_documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_documento` (`id_documento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `logs_login`
--
ALTER TABLE `logs_login`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id` (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `logs_videos`
--
ALTER TABLE `logs_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_video` (`id_video`),
  ADD KEY `id_usuario_2` (`id_usuario`),
  ADD KEY `id_usuario_3` (`id_usuario`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id` (`id`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `id_usuario_creacion` (`id_usuario_creacion`);

--
-- Indices de la tabla `videos_asignados`
--
ALTER TABLE `videos_asignados`
  ADD PRIMARY KEY (`id_asignado`),
  ADD KEY `id_video` (`id_video`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documentos_asignados`
--
ALTER TABLE `documentos_asignados`
  MODIFY `id_asignado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs_documentos`
--
ALTER TABLE `logs_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs_login`
--
ALTER TABLE `logs_login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs_videos`
--
ALTER TABLE `logs_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `videos_asignados`
--
ALTER TABLE `videos_asignados`
  MODIFY `id_asignado` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id_video`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_usuario_creacion`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos_asignados`
--
ALTER TABLE `documentos_asignados`
  ADD CONSTRAINT `documentos_asignados_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documentos_asignados_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documentos_asignados_ibfk_3` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `logs_documentos`
--
ALTER TABLE `logs_documentos`
  ADD CONSTRAINT `logs_documentos_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `logs_documentos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logs_login`
--
ALTER TABLE `logs_login`
  ADD CONSTRAINT `logs_login_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `logs_login_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logs_videos`
--
ALTER TABLE `logs_videos`
  ADD CONSTRAINT `logs_videos_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id_video`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `logs_videos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`id_usuario_creacion`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `videos_asignados`
--
ALTER TABLE `videos_asignados`
  ADD CONSTRAINT `videos_asignados_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id_video`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `videos_asignados_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `videos_asignados_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
