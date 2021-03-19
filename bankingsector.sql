-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 06:17 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankingsector`
--

-- --------------------------------------------------------

--
-- Table structure for table `bs_accounts`
--

CREATE TABLE `bs_accounts` (
  `id` int(20) NOT NULL,
  `accountno` varchar(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `balance` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bs_accounts`
--

INSERT INTO `bs_accounts` (`id`, `accountno`, `branch`, `type`, `ifsc`, `balance`, `customer_id`) VALUES
(1, '6345676543', 'Mcity', 'Savings', 'ICICI12345', 99000, 1),
(2, '6785432543', 'Mcity', 'Savings', 'ICICI67899', 99000, 2),
(3, '6908989754', 'Mcity', 'Savings', 'ICIC123789', 102000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bs_users`
--

CREATE TABLE `bs_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bs_users`
--

INSERT INTO `bs_users` (`id`, `name`, `mobile`, `email`, `password`, `created_at`) VALUES
(1, 'Pugalendhi G', '+91-8122848310', 'pugal68@gmail.com', '$2y$10$IRyu3i/SR/ROdQt2cBZ5Tef.EGOSWo5pb3JAGFtRzHAEs1KrnRpiS', '2021-03-13 22:58:40'),
(2, 'Tamilarasi V.E', '+91-9843604837', 'tamilarasive@gmail.com', '$2y$10$omd7v9E/zEBqc9ES8ctfD.LIjTNijs9Me7y8SqzPJw.33TxySBga6', '2021-03-13 23:00:12'),
(3, 'Lithiksaa P.T', '+91-7904504609', 'lithiksaapt@gmail.com', '$2y$10$zYwfX.S2J.KRlCf00ig12uKYgR.Qm54onpinGojg9bgiMeBc2CBOW', '2021-03-17 19:01:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bs_accounts`
--
ALTER TABLE `bs_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `bs_users`
--
ALTER TABLE `bs_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bs_accounts`
--
ALTER TABLE `bs_accounts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bs_users`
--
ALTER TABLE `bs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bs_accounts`
--
ALTER TABLE `bs_accounts`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `bs_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
