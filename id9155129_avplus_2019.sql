-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-04-2019 a las 17:26:50
-- Versión del servidor: 10.3.13-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id9155129_avplus_2019`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `estado`, `id_usuario`) VALUES
(4, 'Metrocentro', '1', 5),
(5, 'empresarial metrocentro', '1', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `cedula_cliente` varchar(100) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `apellido_cliente` varchar(100) NOT NULL,
  `telefono_cliente` varchar(100) NOT NULL,
  `correo_cliente` varchar(100) NOT NULL,
  `direccion_cliente` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cedula_cliente`, `nombre_cliente`, `apellido_cliente`, `telefono_cliente`, `correo_cliente`, `direccion_cliente`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(5, '159966666', 'Jorge', 'Rodriguez', '459966666', 'jorge@gmail.com', 'california', '2018-02-05', '1', 1),
(6, '45', 'karla', 'rodriguez', '789', 'karla@gmail.com', 'chicago', '2018-02-13', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compras` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `numero_compra` varchar(100) NOT NULL,
  `comprador` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compras`, `fecha_compra`, `numero_compra`, `comprador`, `id_usuario`) VALUES
(1, '2018-01-31', 'F000001', 'eyter', 1),
(2, '2018-02-06', 'F000002', 'eyter', 1),
(3, '2018-02-07', 'F000003', 'eyter', 1),
(4, '2018-02-07', 'F000004', 'eyter', 1),
(5, '2018-09-04', 'F000005', 'eyter', 1),
(6, '2018-09-05', 'F000006', 'eyter', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id_detalle_compras` int(11) NOT NULL,
  `numero_compra` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `cantidad_compra` varchar(100) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `sucursal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id_detalle_compras`, `numero_compra`, `id_producto`, `modelo`, `cantidad_compra`, `fecha_compra`, `id_usuario`, `sucursal`) VALUES
(1, 'I000001', 1, 'avplus', '8', '2019-04-02 22:28:56', 5, 'Metrocentro'),
(2, 'I00000002', 3, 'l1', '10', '2019-04-02 22:32:30', 5, 'empresarial metrocentro'),
(3, 'I00000003', 3, 'l1', '4', '2019-04-02 22:33:14', 5, 'Metrocentro'),
(4, 'I00000004', 2, 'abcd', '4', '2019-04-03 04:45:04', 4, 'Metrocentro'),
(5, 'I00000005', 4, 'MMJ 590', '1', '2019-04-03 21:54:33', 4, 'Metrocentro'),
(6, 'I00000006', 5, 'MOD.3260', '1', '2019-04-03 22:01:21', 4, 'Metrocentro'),
(7, 'I00000007', 6, 'S17502 ', '1', '2019-04-03 22:11:40', 4, 'Metrocentro'),
(8, 'I00000008', 7, 'HD132', '1', '2019-04-03 22:13:45', 4, 'Metrocentro'),
(9, 'I00000009', 8, 'RB 5805', '1', '2019-04-03 22:16:04', 4, 'Metrocentro'),
(10, 'I00000010', 9, 'RB 5265', '1', '2019-04-03 22:21:00', 4, 'Metrocentro'),
(11, 'I00000011', 10, 'RB5803', '1', '2019-04-03 22:23:22', 4, 'Metrocentro'),
(12, 'I00000012', 11, 'RB 5266', '1', '2019-04-03 22:28:14', 4, 'Metrocentro'),
(13, 'I00000013', 12, 'ENVISION', '1', '2019-04-03 22:35:06', 4, 'Metrocentro'),
(14, 'I00000014', 13, 'RB 5801', '1', '2019-04-03 22:37:21', 4, 'Metrocentro'),
(15, 'I00000015', 14, 'A3017', '1', '2019-04-03 22:39:40', 4, 'Metrocentro'),
(16, 'I00000016', 15, 'Q019', '1', '2019-04-03 22:42:27', 4, 'Metrocentro'),
(17, 'I00000017', 16, 'CK5861', '1', '2019-04-03 22:45:31', 4, 'Metrocentro'),
(18, 'I00000018', 17, 'HD106', '1', '2019-04-03 22:49:50', 4, 'Metrocentro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle_ventas` int(11) NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `cedula_cliente` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `precio_venta` varchar(100) NOT NULL,
  `cantidad_venta` varchar(100) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `fecha_venta` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_detalle_ventas`, `numero_venta`, `cedula_cliente`, `id_producto`, `producto`, `moneda`, `precio_venta`, `cantidad_venta`, `descuento`, `importe`, `fecha_venta`, `id_usuario`, `id_cliente`, `estado`) VALUES
(2, 'F000001', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(3, 'F000002', '159966666', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(4, 'F000002', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(5, 'F000002', '159966666', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2018-02-07', 1, 5, '1'),
(6, 'F000003', '159966666', 11, 'Computadora de escritorio', 'USD$', '525', '1', '0', '525', '2018-09-15', 1, 5, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `cedula_empresa` varchar(100) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion_empresa` varchar(100) NOT NULL,
  `correo_empresa` varchar(100) NOT NULL,
  `telefono_empresa` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `cedula_empresa`, `nombre_empresa`, `direccion_empresa`, `correo_empresa`, `telefono_empresa`, `id_usuario`) VALUES
(1, '1223459988', 'Oscar', 'San Salvador', 'oscargonzalez@gmail.com', '12899665588', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `edad` varchar(100) DEFAULT NULL,
  `ocupacion` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `codigo`, `nombres`, `telefono`, `edad`, `ocupacion`, `empresa`, `correo`, `fecha_reg`, `id_usuario`) VALUES
(8, 'PA000001', 'Oscar Antonio Gonzalez', '79745345', '29', 'informatico', 'Google', 'oscarito@gmail.com', '2019-04-02 00:36:59', 5),
(9, 'PA000002', 'Arely Flores', '79745345', '29', 'Ventas', 'AVPlus', 'arely@gamil.com', '2019-04-02 00:39:37', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre`) VALUES
(1, 'Categoria'),
(2, 'Productos'),
(3, 'Proveedores'),
(4, 'Ingresos'),
(5, 'Pacientes'),
(6, 'Ventas'),
(7, 'Reporte de Compras'),
(8, 'Reporte de Ventas'),
(9, 'Usuarios'),
(10, 'Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `precio_venta` varchar(45) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `medidas` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `modelo`, `marca`, `color`, `precio_venta`, `stock`, `id_usuario`, `medidas`) VALUES
(1, 'avplus', 'ray ban', 'c3', '200', '13', 5, '54-17-145'),
(2, 'abcd', 'converse', 'c', '1000', '7', 4, '53\'17\'19'),
(3, 'l1', 'lacoste', 'c4', '200', '0', 4, '41\'23\'134'),
(4, 'MMJ 590', 'MARC BY MARC JACOBS', '1SX', '225.00', '1', 4, '52-18-140'),
(5, 'MOD.3260', 'VERSACE', '5239', '315.00', '1', 4, '50-18-140'),
(6, 'S17502 ', 'And Vas', 'C4', '65.00', '1', 4, '53-17-140'),
(7, 'HD132', 'And Vas', 'COL.05', '65.00', '1', 4, '53-18-140'),
(8, 'RB 5805', 'Ray Ban', 'C2', '250.00', '1', 4, '51-16-140'),
(9, 'RB 5265', 'Ray Ban', '2004', '250.00', '1', 4, '50-16-138'),
(10, 'RB5803', 'Ray Ban', 'C10', '250.00', '1', 4, '53-17-140'),
(11, 'RB 5266', 'Ray Ban', '2009', '250.00', '1', 4, '52-16-145'),
(12, 'ENVISION', 'CONVERSE', 'BLACK', '170.00', '1', 4, '53-18-135'),
(13, 'RB 5801', 'Ray Ban', 'C4', '250.00', '1', 4, '52-16-140'),
(14, 'A3017', 'And Vas', 'C3', '65.00', '1', 4, '53-16-142'),
(15, 'Q019', 'CONVERSE', 'BLACK', '170.00', '1', 4, '53-15-140'),
(16, 'CK5861', 'Calvin Klein', '611', '225.00', '1', 4, '53-17-135'),
(17, 'HD106', 'And Vas', 'C2', '65.00', '1', 4, '53-16-140'),
(20, 'BO 0072 ', 'BOSS ORANGE', 'CS4', '285.00', '', 4, '53-17-140');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `cedula`, `razon_social`, `telefono`, `correo`, `direccion`, `fecha`, `estado`, `id_usuario`) VALUES
(3, '14789', 'luis lopez', '12399888', 'luis@gmail.com', 'california', '2018-01-29', '1', 1),
(4, '45965', 'roberto perez', '48859', 'roberto@gmail.com', 'texas', '2018-02-13', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cargo` enum('0','1') NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password2` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `cedula`, `telefono`, `correo`, `direccion`, `cargo`, `usuario`, `password`, `password2`, `fecha_ingreso`, `estado`) VALUES
(4, '038109-4', 'Carlos Andres Choto', 'OP002', '7888888', 'andres01@gmail.com', 'SS', '1', 'andres ', '12345', '12345', '2019-03-28', '1'),
(5, '454324', 'Oscar Antonio Gonzalez', 'V001', '7912384', 'oscar@gmail.com', 'Caserio La Vuelta', '0', 'oscar', '12345', '12345', '2019-03-31', '1'),
(6, 'Miguel', 'Miguel', '00000000000', '78888', 'miguel@gmail.com', 'SS', '1', 'mflores', '54321', '54321', '2019-04-02', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `id_usuario_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`id_usuario_permiso`, `id_usuario`, `id_permiso`) VALUES
(32, 2, 1),
(33, 2, 2),
(110, 3, 1),
(111, 3, 2),
(112, 3, 3),
(113, 3, 4),
(114, 3, 5),
(115, 3, 6),
(116, 3, 7),
(117, 3, 8),
(118, 3, 9),
(119, 3, 10),
(140, 1, 1),
(141, 1, 2),
(142, 1, 3),
(143, 1, 4),
(144, 1, 5),
(145, 1, 6),
(146, 1, 7),
(147, 1, 8),
(148, 1, 9),
(149, 1, 10),
(160, 4, 1),
(161, 4, 2),
(162, 4, 3),
(163, 4, 4),
(164, 4, 5),
(165, 4, 6),
(166, 4, 7),
(167, 4, 8),
(168, 4, 9),
(169, 4, 10),
(170, 5, 1),
(171, 5, 2),
(172, 5, 3),
(173, 5, 4),
(174, 5, 5),
(175, 5, 6),
(176, 5, 7),
(177, 5, 8),
(178, 5, 9),
(179, 5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `cedula_cliente` varchar(100) NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `total_iva` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha_venta`, `numero_venta`, `cliente`, `cedula_cliente`, `vendedor`, `moneda`, `subtotal`, `total_iva`, `total`, `tipo_pago`, `estado`, `id_usuario`, `id_cliente`) VALUES
(2, '2018-02-07', 'F000001', 'Jorge', '159966666', 'eyter', 'USD$', '200', '40', '240', 'EFECTIVO', '1', 1, 5),
(3, '2018-02-07', 'F000002', 'Jorge', '159966666', 'eyter', 'USD$', '490', '98', '588', 'EFECTIVO', '1', 1, 5),
(4, '2018-09-15', 'F000003', 'Jorge', '159966666', 'eyter', 'USD$', '525', '105', '630', 'EFECTIVO', '1', 1, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_clientes_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `fk_compras_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id_detalle_compras`),
  ADD KEY `fk_detalle_compras_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_compras_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle_ventas`),
  ADD KEY `fk_detalle_ventas_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_ventas_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_ventas_clientes_idx` (`id_cliente`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `fk_empresa_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `fk_proveedor_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id_usuario_permiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`id_usuario`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`id_permiso`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `fk_ventas_usuario_idx` (`id_usuario`),
  ADD KEY `fk_ventas_cliente_idx` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id_detalle_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `fk_detalle_compras_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compras_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_detalle_ventas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ventas_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ventas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_proveedor_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
