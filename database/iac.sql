-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2022 a las 04:32:12
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_alumnos_del_curso`
--

CREATE TABLE `t_alumnos_del_curso` (
  `ID` int(11) NOT NULL,
  `NombreDelUsuario` varchar(30) DEFAULT NULL,
  `Mail` varchar(30) DEFAULT NULL,
  `Codigo_Curso` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_alumnos_del_curso`
--

INSERT INTO `t_alumnos_del_curso` (`ID`, `NombreDelUsuario`, `Mail`, `Codigo_Curso`) VALUES
(1, 'pepe', 'tumama@hotmail.com', 23),
(3, 'oo', 'oo@gmail.com', 19),
(4, 'ii', 'ii@gmail.com', 14);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_alumnos_del_curso`
--
ALTER TABLE `t_alumnos_del_curso`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_alumnos_del_curso`
--
ALTER TABLE `t_alumnos_del_curso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
