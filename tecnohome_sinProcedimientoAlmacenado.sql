-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-08-2019 a las 00:36:13
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnohome`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admmenu`
--

CREATE TABLE `admmenu` (
  `idMenu` int(11) NOT NULL,
  `idDiv` varchar(100) DEFAULT NULL,
  `paginaHref` varchar(100) DEFAULT NULL,
  `tituloMenu` varchar(100) DEFAULT NULL,
  `descripcionDelMenu` varchar(100) DEFAULT NULL,
  `iconoDelMenu` varchar(100) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admmenu`
--

INSERT INTO `admmenu` (`idMenu`, `idDiv`, `paginaHref`, `tituloMenu`, `descripcionDelMenu`, `iconoDelMenu`, `orden`) VALUES
(1, 'u_admUsuarios', 'admUsuarios.php', 'Usuarios', '', 'fa fa-user-circle', 90),
(3, 'a_ftoSolicitudServicio', 'th_agregar.php', 'Agregar', '', 'fa fa-plus', 1),
(5, 'a_listaDeSolicitudes', 'th_registro.php', 'Registro', NULL, 'fas fa-list', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admusuariomenu`
--

CREATE TABLE `admusuariomenu` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admusuariomenu`
--

INSERT INTO `admusuariomenu` (`id`, `idUsuario`, `idMenu`) VALUES
(13, 2, 1),
(5, 2, 3),
(3, 1, 3),
(14, 1, 5),
(15, 2, 5),
(16, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admusuarios`
--

CREATE TABLE `admusuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(100) DEFAULT NULL,
  `clave` varchar(20) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admusuarios`
--

INSERT INTO `admusuarios` (`idUsuario`, `nombreUsuario`, `clave`, `pwd`) VALUES
(1, 'Lic. Joel Clemente Serrano', 'jclemente', '906de634c48fb7d34136160b4c353ae4'),
(2, 'Aldo de Jesús Gerónimo Cobos', 'ajeronimo', '78877d33b0280c78488991d47c285dab');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `porcentajeDeIva` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`porcentajeDeIva`) VALUES
(16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordendeservicio`
--

CREATE TABLE `ordendeservicio` (
  `idOrden` int(10) UNSIGNED NOT NULL,
  `numeroDeOrden` int(11) NOT NULL,
  `fechaOrden` date NOT NULL,
  `fechaVisita` date NOT NULL,
  `nombreDelCliente` varchar(250) NOT NULL,
  `direccionDelCliente` varchar(250) NOT NULL,
  `telefonoDelCliente` varchar(50) NOT NULL,
  `celularDelCliente` varchar(45) NOT NULL,
  `correoElectronicoDelCliente` varchar(100) NOT NULL,
  `descripcionDelProducto` varchar(150) NOT NULL,
  `marcaDelProducto` varchar(150) NOT NULL,
  `modeloDelProducto` varchar(150) NOT NULL,
  `serieDelProducto` varchar(150) NOT NULL,
  `diagnostico` text NOT NULL,
  `trabajoRealizado` text NOT NULL,
  `fallaProducto` text,
  `ivaUtilizado` int(11) NOT NULL COMMENT 'Para que, cuando en el tiempo cambie el pocentaje, los presupuestos se vean o se impriman con el que se crearon',
  `estado` varchar(15) NOT NULL DEFAULT 'Pendiente' COMMENT 'Pendiente/Cerrado/Cancelado'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordendeservicio`
--

INSERT INTO `ordendeservicio` (`idOrden`, `numeroDeOrden`, `fechaOrden`, `fechaVisita`, `nombreDelCliente`, `direccionDelCliente`, `telefonoDelCliente`, `celularDelCliente`, `correoElectronicoDelCliente`, `descripcionDelProducto`, `marcaDelProducto`, `modeloDelProducto`, `serieDelProducto`, `diagnostico`, `trabajoRealizado`, `fallaProducto`, `ivaUtilizado`, `estado`) VALUES
(1, 1, '2019-07-30', '2019-07-31', 'Alberto Contreras Sánchez', 'Dir david', 'Tel david', '12312', 'correo@electon.ico', 'Desc 0', 'Mca 0', 'Mod 0', 'Ser 0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis ipsum vitae feugiat luctus. Phasellus feugiat congue sodales.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis ipsum vitae feugiat luctus. Phasellus feugiat congue sodales.', 'Lorem ipsum dolor sit amet', 16, 'Pendiente'),
(2, 2, '2019-07-31', '2019-08-06', 'Joel Clemente Serrano', 'Rio Niagara 106 Dos Ríos, Emiliano Zapata, Ver,', '2282430913', '2282430913', 'joelcs73@gmail.com', 'Laptop', 'Dell', 'Inspiron 14 5000 series', '123212312', 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc sagittis eu metus commodo elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum et mi volutpat, fermentum justo vel, bibendum magna. Sed justo urna, venenatis ut porta bibendum, sodales sit amet leo. Vestibulum sodales posuere diam id consectetur. Suspendisse mollis placerat nisl, eu vehicula nisl. Nunc urna urna, auctor ac lacus et, accumsan porta risus. Vivamus vel nibh vel nibh interdum interdum at vitae quam. Aenean nec nisl quis turpis ullamcorper suscipit. Aliquam pulvinar, lectus sed tempor porta, ligula tortor interdum velit, eu laoreet orci nulla nec ante. Mauris tristique lectus in tellus efficitur, a ornare tortor venenatis. Vivamus aliquet sed risus nec imperdiet. Curabitur ex mi, accumsan id odio ac, euismod condimentum eros.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 16, 'Pendiente'),
(3, 3, '2019-08-01', '2019-08-01', 'Leticia Sedas Vargas', 'Dom Conocido', '', '2282123456', 'lsedas@gmail.com', 'Lavadora', 'Mabe', 'Acua', '123456', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 16, 'Pendiente'),
(6, 4, '2019-08-02', '2019-08-02', 'Juan perez', 'asdflj sdlk l', '123123123', '123123123', '3216546@asdfgsf.000', 'desc1', 'mca1', 'mod1', 'ser1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus lectus vitae tempor convallis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus lectus vitae tempor convallis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus lectus vitae tempor convallis.', 16, 'Pendiente'),
(7, 5, '2019-08-02', '2019-08-02', 'Sergio', 'Dir', '456', '456', '456', 'Desc 2', 'Mca 2', 'Mod 2', 'Ser 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat, massa nec imperdiet pellentesque, ipsum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat, massa nec imperdiet pellentesque, ipsum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat, massa nec imperdiet pellentesque, ipsum.', 16, 'Pendiente'),
(8, 6, '2019-08-02', '2019-08-02', 'Saúl', 'Dir saúl', '987987', '987987', '987987', 'Desc 3', 'Mca 3', 'Mod 3 ', 'Ser 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae varius mi. Vivamus ac dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae varius mi. Vivamus ac dui.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae varius mi. Vivamus ac dui.', 16, 'Pendiente'),
(9, 7, '2019-08-02', '2019-08-02', 'Jj', 'Shsh', 'Djdj', 'Djdhd', 'Ddjeu', 'Djdhd', 'Dhdhd', 'Dhdjd', 'Dhdhd', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 16, 'Pendiente'),
(43, 8, '2019-08-02', '2019-08-02', 'Prueba sin ppto', '123', '123', '123', '123', 'Lavadora', 'Whirpool', '321', '123', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac.', 16, 'Pendiente'),
(50, 9, '2019-08-03', '2019-08-03', 'Victor Carranza Benitez', 'Dom conocido', '8461237', '2281326548', 'vcarranza@gmail.com', 'Smart Tv', 'Samsung', 'XR-4654', '3216485454', 'Tarjeta de video dañada', 'Reemplazar', 'No se ve imagen, pero se escucha el canal', 16, 'Terminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `id` int(10) UNSIGNED NOT NULL,
  `numeroDeOrden` int(10) UNSIGNED NOT NULL,
  `numeroDeParte` varchar(45) NOT NULL,
  `concepto` varchar(200) NOT NULL,
  `unidades` int(10) UNSIGNED NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `presupuesto`
--

INSERT INTO `presupuesto` (`id`, `numeroDeOrden`, `numeroDeParte`, `concepto`, `unidades`, `precio`, `subtotal`) VALUES
(16, 2, '1', 'Servicio', 1, '200.00', '200.00'),
(11, 1, '1', 'Mtto', 1, '172.41', '172.41'),
(18, 3, '1', 'Conectar', 2, '75.12', '150.24'),
(20, 4, '1', '2', 3, '4.50', '13.50'),
(21, 4, '6', '7', 8, '9.10', '72.80'),
(22, 5, '2', '3', 4, '5.60', '22.40'),
(23, 5, '7', '8', 9, '10.11', '90.99'),
(24, 6, '7', '8', 9, '10.11', '90.99'),
(25, 6, '12', '16', 14, '15.16', '212.24'),
(26, 7, '1248', 'Concepto desde cel', 2, '456.21', '912.42'),
(28, 9, '1231', 'Tarjeta de video SmartTv Samsumg XR-4654', 2, '954.75', '1909.50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `marca` varchar(150) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `serie` varchar(150) NOT NULL,
  `color` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admmenu`
--
ALTER TABLE `admmenu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indices de la tabla `admusuariomenu`
--
ALTER TABLE `admusuariomenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admusuariomenu_admusuarios1` (`idUsuario`),
  ADD KEY `fk_admusuariomenu_admmenu1` (`idMenu`);

--
-- Indices de la tabla `admusuarios`
--
ALTER TABLE `admusuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `ordendeservicio`
--
ALTER TABLE `ordendeservicio`
  ADD PRIMARY KEY (`idOrden`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admmenu`
--
ALTER TABLE `admmenu`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `admusuariomenu`
--
ALTER TABLE `admusuariomenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `admusuarios`
--
ALTER TABLE `admusuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ordendeservicio`
--
ALTER TABLE `ordendeservicio`
  MODIFY `idOrden` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
