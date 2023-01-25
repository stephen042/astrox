-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 08:44 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astrofx`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(255) NOT NULL,
  `user_id` int(225) NOT NULL,
  `method` varchar(255) NOT NULL,
  `Amount` varchar(225) NOT NULL,
  `paymentSlip` varchar(225) NOT NULL,
  `status` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `user_id`, `method`, `Amount`, `paymentSlip`, `status`, `created_at`) VALUES
(12, 9, 'Bitcion', 'fwef', 'assets/order-images/63398f82e71b90a.png', 'declined', '2021-12-13 21:54:11'),
(17, 9, 'Bitcion', '343', 'assets/order-images/6f2d855455fbe85.png', 'declined', '2021-12-13 22:02:53'),
(20, 9, 'Bitcion', '3232', 'assets/order-images/67974a0e7dbab6c.png', 'declined', '2021-12-13 22:07:42'),
(26, 9, 'Bitcion', '45', 'assets/order-images/43e6e0405440563.jpeg', 'declined', '2021-12-14 16:42:26'),
(27, 9, 'Bitcion', '45', 'assets/order-images/a20d43d32e6c7dd.jpeg', '', '2021-12-14 22:42:35'),
(28, 9, 'Bitcion', '45', 'assets/order-images/494010fbec6e774.jpeg', '', '2021-12-14 22:44:38'),
(29, 9, 'Bitcion', '45', 'assets/order-images/db4633c698a2949.jpeg', '', '2021-12-14 22:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNum` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `radio_selection` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `auth` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `course`, `email`, `phoneNum`, `country`, `message`, `radio_selection`, `password`, `created_at`, `auth`) VALUES
(9, 'emmanuel', '', 'edeemmanuelchizurumoke@gmail.com', '19u98', '', 'ijdjdjoq', 'email', 'secret', '2021-12-14 22:44:25.457977', 'user'),
(18, 'eee', '', 'eewe', 'we', 're', 'ererr', '', '4A1C35F52E', '2021-12-13 23:07:12.040984', 'reer'),
(20, 'nuel', '', 'edeemmanuelchizurumoke@gmail.com', '08076626484', '', 'i would really like a discount', 'email', 'A3F5E9DC5F', '2021-12-14 22:46:12.862823', ''),
(21, 'nuel', '', 'edeemmanuelchizurumoke@gmail.com', '43443', '', 'dffdfd', 'telephone', '88A5AE538B', '2021-12-14 22:38:37.911323', ''),
(22, 'nuel', '', 'edeemmanuelchizurumoke@gmail.com', '08076626484', '', 'weweew', 'email', '9C5CCFF9E0', '2021-12-14 22:48:33.428187', ''),
(23, 'nuel', '', 'edeemmanuelchizurumoke@gmail.com', '08076626484', '', 'ygg', 'telephone', '', '2021-12-14 22:53:20.008355', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
