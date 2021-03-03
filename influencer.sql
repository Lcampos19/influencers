-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-03-2021 a las 21:01:07
-- Versión del servidor: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `influencer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `influencers`
--

CREATE TABLE `influencers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idioma` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publicidad` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacaciones` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacaciones_ini` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacaciones_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `if_check` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `if_package` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `if_promo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `iv_check` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `iv_package` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `iv_promo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_check` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_package` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_promo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(101) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` tinytext NOT NULL,
  `img` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL,
  `departament` varchar(191) NOT NULL,
  `created_at` varchar(191) NOT NULL,
  `updated_at` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `img`, `status`, `departament`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '/img', '1', 'influencers', '2020-02-28 00:00:00', '2020-02-28 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `influencers`
--
ALTER TABLE `influencers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `influencers`
--
ALTER TABLE `influencers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
