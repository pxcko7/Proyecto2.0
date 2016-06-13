-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2016 a las 07:23:47
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_prince_one`
--
CREATE DATABASE IF NOT EXISTS `db_prince_one` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_prince_one`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combo`
--

CREATE TABLE IF NOT EXISTS `combo` (
  `id_combo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_combo` varchar(45) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` double(10,2) NOT NULL,
  PRIMARY KEY (`id_combo`),
  KEY `id_combo` (`id_combo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `combo`
--

INSERT INTO `combo` (`id_combo`, `nombre_combo`, `descripcion`, `precio`) VALUES
(1, 'matutino', '6 am a 12 pm', 7.00),
(2, 'vespertino', '12 pm a 6 pm', 7.00),
(3, 'nocturno', '6 pm a 6 am', 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `id_Empleado` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_e` varchar(45) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `dui` int(12) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int(9) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_Empleado`),
  UNIQUE KEY `id_Empleado` (`id_Empleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_Empleado`, `tipo_e`, `nombres`, `apellidos`, `dui`, `direccion`, `telefono`, `correo`, `estado`) VALUES
(1, 'Administrador', 'Manuel', 'Gamez', 2221312, 'San miguel', 2131, 'wwww@fd.com', 1),
(2, 'Cocinero', 'yo no se', '', 224, 'Santa Maria', 443, 'sds@outloock', 1),
(4, 'Mesero', 'angel', 'Romero', 213123, 'Union', 1231, 'qw@fdfdfd.com', 1),
(5, 'Mesero', 'zx', 'zxc', 0, 'zxc', 0, 'zxc', 0),
(6, 'Cocinero', 'wilson', 'asdasd', 231231, 'sdfsdfs', 2412414, 'sasda@hotmail.com', 0),
(7, 'Cocinero', 'Carlos', 'Romero', 231231, 'sdfsdfs', 2412414, 'sasda@hotmail.com', 0),
(8, 'Mesero', 'asd', 'asda', 12312, 'sdsada', 123213, 'wwww@fd.com', 1),
(9, 'Mantenimiento', 'Alexi', 'Romero', 12312, 'La union', 123213, 'wwww@fd.com', 1),
(10, 'Mantenimiento', 'a', 'v', 1, 'c', 2, 'd@s', 0),
(11, 'Administrador', 'probando', 'al', 1, 'empleado', 2, 'direccion@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plato`
--

CREATE TABLE IF NOT EXISTS `plato` (
  `id_plato` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` double(10,2) NOT NULL,
  PRIMARY KEY (`id_plato`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `plato`
--

INSERT INTO `plato` (`id_plato`, `descripcion`, `cantidad`, `precio_unitario`) VALUES
(1, 'Arroz con pollo', 5, 5.00),
(3, 'Carne de Res asada', 9, 2.00),
(4, 'frijoles sopa', 6, 4.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_alojamiento`
--

CREATE TABLE IF NOT EXISTS `tb_alojamiento` (
  `id_alojamiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_habitacion` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_combo` int(11) NOT NULL,
  `fecha_alojamiento` date NOT NULL,
  `estado_a` int(1) NOT NULL,
  PRIMARY KEY (`id_alojamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tb_cliente`
--

INSERT INTO `tb_cliente` (`id_cliente`, `nombre`, `apellido`, `dui`, `telefono`, `correo`, `estado`) VALUES
(1, 'jouse pinedo', 'este jejeejej', '55588823-6', '78552465', 'wwww@fd.com', 1),
(4, 'anfel', 'asda', '23131', '23231', 'w@f.k', 1),
(5, 'Ronaldo', 'Meregue', '2341229019', '23231232', 'd@s', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_factura`
--

CREATE TABLE IF NOT EXISTS `tb_detalle_factura` (
  `id_detalle_factura` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NOT NULL,
  `id_plato` int(11) DEFAULT NULL,
  `cantidad_o` int(11) NOT NULL,
  `total` double(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_factura`
--

CREATE TABLE IF NOT EXISTS `tb_factura` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_alojamiento` int(11) NOT NULL,
  `fecha_factura` date NOT NULL,
  `total_pagar` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_habitaciones`
--

CREATE TABLE IF NOT EXISTS `tb_habitaciones` (
  `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `estado_h` int(1) NOT NULL,
  `tipo_h` varchar(25) NOT NULL,
  `descripcion_h` varchar(100) NOT NULL,
  PRIMARY KEY (`id_habitacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tb_habitaciones`
--

INSERT INTO `tb_habitaciones` (`id_habitacion`, `estado_h`, `tipo_h`, `descripcion_h`) VALUES
(1, 1, 'recia', 'kabalona'),
(2, 1, 'pasa', 'dos que tres'),
(3, 1, 'ss', 'dd'),
(4, 1, 'Swit', 'barbara'),
(5, 1, 'emeratris', 'ads'),
(6, 1, 'este', 'asdas'),
(7, 1, 'genial', 'excelente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_manto`
--

CREATE TABLE IF NOT EXISTS `tb_manto` (
  `id_manto` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_manto` date NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_manto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_reservacion`
--

CREATE TABLE IF NOT EXISTS `tb_reservacion` (
  `id_reservacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_habitacion` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_reservacion` date NOT NULL,
  `fecha_reservada` date NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_reservacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `usuario`, `clave`, `id_empleado`, `tipo_usuario`, `estado`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1, 'Administrador', 1),
(6, 'a', 'c4ca4238a0b923820dcc509a6f75849b', 9, 'Administrador', 1),
(7, 'yo', '618050e16dae2ad4dd1782de7872bc8b', 2, 'Administrador', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
