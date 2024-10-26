-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 04:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expire_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `drug_name`, `drug_id`, `quantity`, `expire_date`, `price`, `created_at`) VALUES
(1, 'Panadol', 1, 10, '2025-12-31', 1200.00, '2024-09-30 17:13:27'),
(2, 'Panadol', 1, 5, '2025-12-31', 600.00, '2024-09-30 17:13:36'),
(3, 'Cetirizine', 2, 5, '2025-12-31', 1000.00, '2024-09-30 18:19:13'),
(4, 'Bupivacaine 0.5%', 21, 5, '2025-12-31', 7000.00, '2024-10-18 16:30:24'),
(5, 'Bupivacaine 0.25%', 22, 5, '2025-12-31', 7000.00, '2024-10-18 16:34:57'),
(6, 'Bupivacaine 0.5%', 21, 5, '2025-12-31', 7000.00, '2024-10-18 16:38:26'),
(7, 'Aspirin', 3, 5, '2025-12-31', 500.00, '2024-10-18 16:40:49'),
(8, 'Bupivacaine 0.5%', 21, 5, '0000-00-00', 7000.00, '2024-10-18 16:45:40'),
(9, 'Ecosprin', 18, 5, '0000-00-00', 600.00, '2024-10-18 16:46:01'),
(10, 'Dianabol', 17, 5, '0000-00-00', 3500.00, '2024-10-18 16:46:58'),
(11, 'Evoin', 19, 5, '0000-00-00', 350.00, '2024-10-18 16:56:10'),
(12, 'Ibuprofen', 4, 5, '0000-00-00', 7500.00, '2024-10-18 17:00:11'),
(13, 'Paracetamol', 5, 5, '0000-00-00', 400.00, '2024-10-18 17:00:44'),
(14, 'Stanozolol', 16, 5, '0000-00-00', 7000.00, '2024-10-18 17:01:39'),
(15, 'Panadol', 1, 10, '0000-00-00', 1200.00, '2024-10-19 03:20:18'),
(16, 'Cetirizine', 2, 5, '0000-00-00', 1000.00, '2024-10-19 03:46:51'),
(17, 'Panadol', 1, 75, '0000-00-00', 9000.00, '2024-10-19 03:50:23'),
(18, 'Evoin', 19, 95, '0000-00-00', 6650.00, '2024-10-19 04:39:47'),
(19, 'Panadol', 1, 30, '0000-00-00', 3600.00, '2024-10-19 04:52:18'),
(20, 'Paracetamol', 5, 10, '0000-00-00', 800.00, '2024-10-19 04:52:18'),
(21, 'Panadol', 1, 30, '0000-00-00', 3600.00, '2024-10-19 04:55:23'),
(22, 'Panadol', 1, 40, '0000-00-00', 4800.00, '2024-10-19 04:58:40'),
(23, 'Panadol', 1, 10, '0000-00-00', 1200.00, '2024-10-19 10:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `bill_temp`
--

CREATE TABLE `bill_temp` (
  `id` int(11) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expire_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `photo`, `name`, `price`, `quantity`, `date`) VALUES
(1, 'panadol.jpeg', 'Panadol', 120, 90, '2025-12-31'),
(2, 'cetazine.jpeg', 'Cetirizine', 200, 90, '2025-12-31'),
(3, 'aspirin.jpeg', 'Aspirin', 100, 95, '2025-12-31'),
(4, 'ibuprofen.jpg', 'Ibuprofen', 1500, 95, '2025-12-31'),
(5, 'parcetomol.jpeg', 'Paracetamol', 80, 85, '2025-12-31'),
(6, 'metformin.jpeg', 'Metformin', 900, 100, '2025-12-31'),
(7, 'Losartan.jpeg', 'Losartan', 200, 100, '2025-12-31'),
(8, 'Atorvastatin.jpeg', 'Atorvastatin', 800, 100, '2025-12-31'),
(9, 'Omeprazole.webp', 'Omeprazole', 700, 100, '2025-12-31'),
(10, 'Simvastatin.png', 'Simvastatin', 100, 100, '2025-12-31'),
(11, 'doxycycline.jpeg', 'Doxycycline', 700, 100, '2025-12-31'),
(12, 'Lyrica.jpeg', 'Lyrica', 400, 100, '2025-12-31'),
(13, 'Humira.jpeg', 'Humira', 600, 100, '2025-12-31'),
(14, 'Tepezza.jpeg', 'Tepezza', 700, 100, '2025-12-31'),
(15, 'Farxiga.jpeg', 'Farxiga', 800, 100, '2025-12-31'),
(16, 'stenazol.jpg', 'Stanozolol', 1400, 95, '2025-12-31'),
(17, 'dianabol.jpeg', 'Dianabol', 700, 90, '2025-12-31'),
(18, 'ecosprin.jpeg', 'Ecosprin', 120, 90, '2025-12-31'),
(19, 'evoin.jpeg', 'Evoin', 70, 100, '2025-12-31'),
(20, 'zincovit.webp', 'Zincovit', 250, 100, '2025-12-31'),
(21, 'bupivacaine5.jpeg', 'Bupivacaine 0.5%', 1400, 80, '2025-12-31'),
(22, 'bupivacaine25.jpeg', 'Bupivacaine 0.25%', 1400, 95, '2025-12-31'),
(34, 'event-pass (4).png', 'Panadol', 120, 100, '2025-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_temp`
--
ALTER TABLE `bill_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bill_temp`
--
ALTER TABLE `bill_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
