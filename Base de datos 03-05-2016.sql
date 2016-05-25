-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-05-2016 a las 13:17:20
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `digitalgames`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `Id_Comentario` int(11) NOT NULL,
  `Id_Juego` int(11) NOT NULL,
  `Comentario` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`Id_Comentario`, `Id_Juego`, `Comentario`) VALUES
(1, 1, 'No lo compreís,por su culpa ahora tengo pesadillas por la novhe y el día.Mi hermano lo jugó y entonces quemó su polystation'),
(2, 1, 'Es basura,deberían quitarle el título a sus programadores'),
(3, 2, 'Alabado sea Alá por permitirme jugar a este juego'),
(4, 2, 'Bendito juego,espero el remake para ps4 con ansias'),
(5, 3, 'Me gustan las sillas,ahora las puedo controlar'),
(6, 4, 'Mesaaaaaaaaaaaaaaaaaaaaaaaaas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegossteam`
--

CREATE TABLE `juegossteam` (
  `Id_Juego` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Precio` float DEFAULT '0',
  `Valoracion` int(11) NOT NULL DEFAULT '0',
  `Likes` int(11) NOT NULL DEFAULT '0',
  `Imagen` varchar(150) COLLATE utf8_spanish_ci DEFAULT '0',
  `Fecha` date DEFAULT NULL,
  `Url_Compra` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `juegossteam`
--

INSERT INTO `juegossteam` (`Id_Juego`, `Nombre`, `Precio`, `Valoracion`, `Likes`, `Imagen`, `Fecha`, `Url_Compra`) VALUES
(1, 'The legend of the legend:A legendary legend', 2.5, 1, 120, 'http://www.legendari.com', '2014-07-19', 'htttp://buythelegend.com'),
(2, 'Jesus Christ RPG', 5.95, 4, 5894, 'http://jesusrpg.com', '2016-01-08', 'http://becatholic.com'),
(3, 'Pokemon Silla', 39.95, 5, 789542, 'http://pokemonsilla.com', '2016-12-27', 'http://buyyoursilla.com'),
(4, 'Pokemon Mesa', 39.95, 4, 716584, 'http://pokemonsilla.com', '2016-12-27', 'http://buyyourmesa.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `Id_Tienda` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Logotipo` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Url` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`Id_Tienda`, `Nombre`, `Logotipo`, `Url`) VALUES
(1, 'Steam', 'imagendesteam', 'http de steam'),
(2, 'Star Bust Stream', 'imagenregular', 'http de star'),
(3, 'Origin', 'imagendesteam', 'httpdeorigin'),
(4, 'Origenes', 'imagendeorigenes', 'http de origenes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombre_Usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Contrasenya` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Email` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Id_Steam` varchar(150) COLLATE utf8_spanish_ci DEFAULT '0',
  `Foto` varchar(150) COLLATE utf8_spanish_ci DEFAULT '0',
  `Privacidad` varchar(150) COLLATE utf8_spanish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Nombre_Usuario`, `Contrasenya`, `Email`, `Id_Steam`, `Foto`, `Privacidad`) VALUES
(1, 'Gusanito', 'contraseña', 'transylv@gmail.com', 'GusGus', 'gusgusphoto', 'Si'),
(2, 'Corifeus', 'darkspawn', 'cori@gmail.com', 'Corifeus_Darkspawn', 'http://copyright.com', 'No'),
(3, 'Vegetta777', '123456', 'vegetta777@willyrex.com', 'Vegetta777', 'error,se va a proceder a borrar la base de datos', 'No'),
(4, 'Mamace02', 'phinedfjuhujh1', 'ampa_margalef@hotmail.com', '', 'Penguins.jpg', 'Si'),
(9, 'Gatete_83', 'adfdasf', 'gatitosmonos@getete.com', '', '', 'Si'),
(11, 'AliciaMamasita', 'yatusabe', 'alisimamisi@gmail.com', 'Mamasitalicia', 'Hydrangeas.jpg', 'No'),
(15, 'Deadpool', 'spiderman', 'deady@hotmail.com', 'Deadpool', 'Jellyfish.jpg', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `Id_Video` int(11) NOT NULL,
  `Url` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Juego` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`Id_Video`, `Url`, `Id_Juego`) VALUES
(1, 'http://youtubexyf4654.com', 1),
(2, 'http://youtube6454.com', 2),
(3, 'http://youtube6546.com', 2),
(4, 'http://youtube45156.com', 3),
(5, 'http://youtube1654.com', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`Id_Comentario`),
  ADD KEY `Comentarios-Juego` (`Id_Juego`);

--
-- Indices de la tabla `juegossteam`
--
ALTER TABLE `juegossteam`
  ADD PRIMARY KEY (`Id_Juego`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`Id_Tienda`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD UNIQUE KEY `Nombre_Usuario` (`Nombre_Usuario`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`Id_Video`),
  ADD KEY `Video-Juego` (`Id_Juego`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `Id_Comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `juegossteam`
--
ALTER TABLE `juegossteam`
  MODIFY `Id_Juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `Id_Tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `Id_Video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `Comentarios-Juego` FOREIGN KEY (`Id_Juego`) REFERENCES `juegossteam` (`Id_Juego`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `Video-Juego` FOREIGN KEY (`Id_Juego`) REFERENCES `juegossteam` (`Id_Juego`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
