-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 05:51 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profpic` varchar(250) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `username`, `password`, `email`, `profpic`) VALUES
(1, 'tugas pweb', 'pweb', '$2y$10$HTjRGtBrUIUj7y7vvT4.HupznNL5AbBfDktGM.MoAwPwdOFx1aZwy', 'pweb@g.com', 'default'),
(2, 'atikah', 'atikah', '$2y$10$urwjNgBAopwmojTFxkxTD.qL3LeJHYFVaTIuMTZS./22xL4EwQ2Hu', 'atikahehe@gmail.com', 'default'),
(3, 'p', 'test', '$2y$10$TY7.2.cLcfZD0I2NIIrjm.xMay4cWMJwDi9FbBWDnyQqkD7qb3Vcy', 'p@gm.cm', 'p'),
(4, 'zz', 'z', '$2y$10$/R8GhdEac9SFQUdaRUq8I.ApMPylqbPGyn5zk4LqRoSWHMg.DxJwK', 'z@g.cm', 'z'),
(5, 'x', 'x', '$2y$10$N9QFEv.MbBHO0fn96ik4Ie0lMqTrMY0BJ6gX/wWHtu978Xc3z35HK', 'x@gm.cm', 'default');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
