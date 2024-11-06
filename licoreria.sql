-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 06-11-2024 a las 09:25:29
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
-- Base de datos: `licoreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `venta_id`, `cliente`, `fecha`) VALUES
(7, 1, 'german', '2024-11-06 11:44:02'),
(8, 1, 'german', '2024-11-06 11:47:09'),
(29, 1, 'Cliente 1', '2024-11-06 08:07:47'),
(30, 2, 'Cliente 2', '2024-11-06 08:07:47'),
(31, 3, 'Cliente 3', '2024-11-06 08:07:47'),
(32, 24, 'Cliente 4', '2024-11-06 08:07:47'),
(33, 25, 'Cliente 5', '2024-11-06 08:07:47'),
(34, 26, 'Cliente 6', '2024-11-06 08:07:47'),
(35, 27, 'Cliente 7', '2024-11-06 08:07:47'),
(36, 28, 'Cliente 8', '2024-11-06 08:07:47'),
(37, 29, 'Cliente 9', '2024-11-06 08:07:47'),
(38, 30, 'Cliente 10', '2024-11-06 08:07:47'),
(39, 31, 'Cliente 11', '2024-11-06 08:07:47'),
(40, 32, 'Cliente 12', '2024-11-06 08:07:47'),
(41, 33, 'Cliente 13', '2024-11-06 08:07:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalles`
--

CREATE TABLE `factura_detalles` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `stock`) VALUES
(1, 'vodka', 90.00, 29),
(3, 'cocacola', 10.00, 1),
(4, 'Cerveza', 1.50, 100),
(5, 'Vino', 8.00, 50),
(6, 'Whisky', 20.00, 30),
(7, 'Tequila', 15.00, 40),
(8, 'Ron', 12.00, 20),
(9, 'Sidra', 5.00, 60),
(10, 'Gaseosa', 1.00, 150),
(11, 'Agua Mineral', 0.50, 200),
(12, 'Limonada', 2.00, 80),
(13, 'Sangría', 6.00, 45),
(14, 'foutloko', 40.00, 12),
(15, 'cigarros', 5.00, 100),
(16, 'vasos desechables', 10.00, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`) VALUES
(1, 'german', 'german@gmail.com', '$2y$10$WiI.OuZS/nQ7SrfJZEHM/ucHSPJ2dy8C5D7nqQ0ENAJWgQWPy3p3y'),
(2, 'marco', 'marco@gmail.com', '$2y$10$ApXLnZ62w8L2M/qK9BPij.DUxBcCpItJ39M69yX6WikYsr8OBkwP.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `producto_id`, `cantidad`, `total`, `fecha`) VALUES
(1, 1, 1, 90.00, '2024-11-06 06:23:12'),
(2, 1, 2, 180.00, '2024-11-06 06:28:00'),
(3, 3, 1, 10.00, '2024-11-06 06:41:44'),
(24, 1, 2, 3.00, '2024-11-06 08:05:23'),
(25, 3, 1, 20.00, '2024-11-06 08:05:23'),
(26, 4, 2, 30.00, '2024-11-06 08:05:23'),
(27, 5, 1, 12.00, '2024-11-06 08:05:23'),
(28, 6, 5, 25.00, '2024-11-06 08:05:23'),
(29, 7, 10, 10.00, '2024-11-06 08:05:23'),
(30, 8, 15, 7.50, '2024-11-06 08:05:23'),
(31, 9, 3, 6.00, '2024-11-06 08:05:23'),
(32, 10, 4, 24.00, '2024-11-06 08:05:23'),
(33, 11, 1, 8.00, '2024-11-06 08:05:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`);

--
-- Indices de la tabla `factura_detalles`
--
ALTER TABLE `factura_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `factura_detalles`
--
ALTER TABLE `factura_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `factura_detalles`
--
ALTER TABLE `factura_detalles`
  ADD CONSTRAINT `factura_detalles_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`),
  ADD CONSTRAINT `factura_detalles_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
