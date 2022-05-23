-- mysql --host=us-cdbr-east-05.cleardb.net --user=b04e4dafaf991b --password=394a13a6 --reconnect heroku_0da26506f5f16f5 < tables.sql

--
-- Estructura de tabla para la tabla `noticias`
--

drop table `noticias`;

CREATE TABLE `noticias` (
  `noticia_id` int(11) NOT NULL,
  `titulo` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitulo` varchar(300) COLLATE utf8mb4_unicode_ci ,
  `fecha` datetime NOT NULL,
  `boton` varchar(300) COLLATE utf8mb4_unicode_ci ,
  `url_imagen` varchar(4000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `noticias`
  ADD PRIMARY KEY (`noticia_id`);

ALTER TABLE `noticias`
  MODIFY `noticia_id` int(11) NOT NULL AUTO_INCREMENT;

alter table `noticias` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;