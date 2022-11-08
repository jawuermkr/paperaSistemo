-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-04-2018 a las 22:34:12
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u638878326_ps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cod_c` varchar(10) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cod_c`, `tipo`) VALUES
('01', 'Papeleria'),
('02', 'Aseo'),
('03', 'Detalles'),
('04', 'Dulces'),
('05', 'Celulares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_facturas`
--

CREATE TABLE `detalle_facturas` (
  `cod_d` int(10) NOT NULL,
  `cod_f` varchar(10) NOT NULL,
  `cod_p` varchar(10) NOT NULL,
  `cantidad` varchar(10) NOT NULL,
  `precio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_facturas`
--

INSERT INTO `detalle_facturas` (`cod_d`, `cod_f`, `cod_p`, `cantidad`, `precio`) VALUES
(8, '001', '0001', '2', '1600'),
(9, '001', '0007', '4', '2000'),
(10, '001', '0002', '2', '1000'),
(11, '002', '0004', '2', '1200'),
(12, '002', '0008', '6', '600'),
(13, '003', '0001', '2', '1600'),
(14, '003', '0005', '1', '15000'),
(15, '004', '0003', '2', '1600'),
(16, '004', '0001', '1', '800'),
(17, '005', '0001', '1', '800'),
(18, '005', '0002', '2', '1000'),
(19, '005', '0007', '1', '500'),
(20, '005', '0008', '3', '300'),
(21, '006', '0001', '2', '1600'),
(22, '006', '0005', '1', '15000'),
(23, '006', '0007', '4', '2000'),
(24, '007', '0001', '2', '1600'),
(25, '007', '0002', '5', '2500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `cod_f` varchar(10) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `total` int(20) NOT NULL,
  `estado_f` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`cod_f`, `fecha`, `hora`, `total`, `estado_f`) VALUES
('001', '2017-10-19', '09:58', 4600, 'Ok'),
('002', '2017-10-24', '11:34', 1800, 'Ok'),
('003', '2017-11-09', '18:44', 16600, 'Ok'),
('004', '2017-11-16', '12:09', 2400, 'Ok'),
('005', '2017-11-24', '09:25', 2600, 'Ok'),
('006', '2017-11-15', '08:45', 18600, 'Ok'),
('007', '2017-11-15', '08:45', 4100, 'Ok');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `cod_c` varchar(10) NOT NULL,
  `cod_p` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tamanio` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `costo_u` varchar(30) NOT NULL,
  `existencias` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`cod_c`, `cod_p`, `nombre`, `tamanio`, `color`, `costo_u`, `existencias`) VALUES
('01', '0001', 'Tijeras', 'Mediano', 'Varios', '800', '20'),
('02', '0002', 'Gel', 'Pequeño', 'Rojo', '500', '31'),
('04', '0003', 'Festival', 'Mediano', 'Chocolate', '800', '6'),
('04', '0004', 'Festival', 'Pequeño', 'Chocolate', '600', '23'),
('03', '0005', 'Peluche', 'Mediano', 'Blanco', '15000', '10'),
('03', '0006', 'Cubo Rubik', 'Neutro', 'No Aplica', '12000', '1'),
('02', '0007', 'Shampoo Sav', 'Sobre', 'Neutro', '500', '21'),
('04', '0008', 'Gomitas', 'PequeÃ±o', 'Varios', '100', '91'),
('04', '0009', 'Gomas X', 'XL', 'Varios', '600', '30'),
('04', '0010', 'Pan Dulce ', 'Mediano', 'Varios', '300', '25'),
('01', '0011', 'Cartón', 'Mediano', 'Mate', '400', '35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `identificacion` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`identificacion`, `nombre`, `cargo`, `telefono`, `correo`, `clave`) VALUES
('777', 'Administrator', 'Admin', '3223855944', 'ventas@verdaluno.com', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cod_c`);

--
-- Indices de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD PRIMARY KEY (`cod_d`),
  ADD KEY `cod_f` (`cod_f`),
  ADD KEY `cod_p` (`cod_p`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`cod_f`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`cod_p`),
  ADD KEY `cod_c` (`cod_c`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`identificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  MODIFY `cod_d` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD CONSTRAINT `detalle_facturas_ibfk_1` FOREIGN KEY (`cod_f`) REFERENCES `facturas` (`cod_f`),
  ADD CONSTRAINT `detalle_facturas_ibfk_2` FOREIGN KEY (`cod_p`) REFERENCES `productos` (`cod_p`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`cod_c`) REFERENCES `categorias` (`cod_c`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
