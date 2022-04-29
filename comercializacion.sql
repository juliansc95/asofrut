-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2021 at 06:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asofrutj`
--

-- --------------------------------------------------------

--
-- Table structure for table `comercializacionproductos`
--

CREATE TABLE `comercializacionproductos` (
  `id` int(10) UNSIGNED NOT NULL,
  `comercializacion_id` int(10) UNSIGNED NOT NULL,
  `productosComers_id` int(10) UNSIGNED NOT NULL,
  `cantidad` decimal(11,2) NOT NULL,
  `valorUnitario` decimal(11,2) NOT NULL,
  `otro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comercializacionproductos`
--

INSERT INTO `comercializacionproductos` (`id`, `comercializacion_id`, `productosComers_id`, `cantidad`, `valorUnitario`, `otro`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '5.00', '14000.00', '', '2021-12-21 03:58:03', '2021-12-21 03:58:03'),
(2, 3, 2, '3.00', '2432.00', '', '2021-12-21 03:58:03', '2021-12-21 03:58:03'),
(3, 4, 2, '4.00', '2432.00', '', '2021-12-21 04:07:51', '2021-12-21 04:07:51'),
(4, 4, 1, '2.00', '14000.00', '', '2021-12-21 04:07:51', '2021-12-21 04:07:51'),
(5, 5, 2, '2.00', '2432.00', '', '2021-12-21 05:13:23', '2021-12-21 05:13:23'),
(6, 5, 1, '4.00', '14000.00', '', '2021-12-21 05:13:23', '2021-12-21 05:13:23'),
(7, 6, 2, '5.00', '2432.00', '', '2021-12-21 05:16:14', '2021-12-21 05:16:14'),
(8, 6, 1, '6.00', '14000.00', '', '2021-12-21 05:16:14', '2021-12-21 05:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `comercializacions`
--

CREATE TABLE `comercializacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `otro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaVenta` date NOT NULL,
  `totalVenta` decimal(11,2) NOT NULL,
  `totalUnidades` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comercializacions`
--

INSERT INTO `comercializacions` (`id`, `productor_id`, `otro`, `fechaVenta`, `totalVenta`, `totalUnidades`, `created_at`, `updated_at`) VALUES
(3, 22, 'da', '2021-12-20', '77296.00', '8.00', '2021-12-21 03:58:03', '2021-12-21 03:58:03'),
(4, 13, NULL, '2021-12-20', '37728.00', '6.00', '2021-12-21 04:07:51', '2021-12-21 04:07:51'),
(5, 22, NULL, '2021-12-21', '60864.00', '6.00', '2021-12-21 05:13:23', '2021-12-21 05:13:23'),
(6, 22, NULL, '2021-12-21', '96160.00', '11.00', '2021-12-21 05:16:14', '2021-12-21 05:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `productoscomers`
--

CREATE TABLE `productoscomers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorUnitario` decimal(11,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productoscomers`
--

INSERT INTO `productoscomers` (`id`, `nombre`, `valorUnitario`, `created_at`, `updated_at`) VALUES
(1, 'Producto', '14000', '2021-12-21 02:25:02', '2021-12-21 02:25:02'),
(2, 'Fertilizante pa', '2432', '2021-12-21 02:39:46', '2021-12-21 02:41:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comercializacionproductos`
--
ALTER TABLE `comercializacionproductos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comercializacionproductos_comercializacion_id_foreign` (`comercializacion_id`),
  ADD KEY `comercializacionproductos_productoscomers_id_foreign` (`productosComers_id`);

--
-- Indexes for table `comercializacions`
--
ALTER TABLE `comercializacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comercializacions_productor_id_foreign` (`productor_id`);

--
-- Indexes for table `productoscomers`
--
ALTER TABLE `productoscomers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productoscomers_nombre_unique` (`nombre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comercializacionproductos`
--
ALTER TABLE `comercializacionproductos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comercializacions`
--
ALTER TABLE `comercializacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productoscomers`
--
ALTER TABLE `productoscomers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comercializacionproductos`
--
ALTER TABLE `comercializacionproductos`
  ADD CONSTRAINT `comercializacionproductos_comercializacion_id_foreign` FOREIGN KEY (`comercializacion_id`) REFERENCES `comercializacions` (`id`),
  ADD CONSTRAINT `comercializacionproductos_productoscomers_id_foreign` FOREIGN KEY (`productosComers_id`) REFERENCES `productoscomers` (`id`);

--
-- Constraints for table `comercializacions`
--
ALTER TABLE `comercializacions`
  ADD CONSTRAINT `comercializacions_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
