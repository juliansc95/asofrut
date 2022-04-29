-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2022 at 08:10 PM
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
-- Table structure for table `abonos`
--

CREATE TABLE `abonos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `valorAbonado` decimal(11,2) NOT NULL,
  `saldo` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abonos`
--

INSERT INTO `abonos` (`id`, `productor_id`, `valorAbonado`, `saldo`, `created_at`, `updated_at`) VALUES
(1, 22, '0.00', '56000.00', '2022-02-18 13:19:20', '2022-02-18 13:19:20'),
(2, 22, '560.00', '55440.00', '2022-02-21 14:39:18', '2022-02-21 14:39:18'),
(5, 22, '560.00', '167440.00', '2022-02-21 15:06:27', '2022-02-21 15:06:27'),
(6, 13, '0.00', '4864.00', '2022-02-21 15:22:27', '2022-02-21 15:22:27'),
(7, 5, '0.00', '0.00', '2022-02-21 15:26:31', '2022-02-21 15:26:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abonos_productor_id_foreign` (`productor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abonos`
--
ALTER TABLE `abonos`
  ADD CONSTRAINT `abonos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
