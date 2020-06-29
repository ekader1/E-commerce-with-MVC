-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2018 at 10:19 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reversetrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followingdata`
--

CREATE TABLE `followingdata` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `isFollowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followingdata`
--

INSERT INTO `followingdata` (`id`, `follower`, `isFollowing`) VALUES
(2, 4, 2),
(7, 4, 3),
(11, 2, 2),
(14, 2, 4),
(15, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `userid`, `item_type`, `price`) VALUES
(1, 'DELL inspiron', 1, 'laptop', 600),
(2, 'nokia 3310', 5, 'mobile phone', 5),
(3, 'dodge viper', 1, 'car', 70000),
(4, 'iphone X', 6, 'mobile phone', 1200),
(5, 'Cenk Tosun Everton Home Jersey', 6, 'jersey', 14),
(6, 'World Cup Trophy', 7, 'Trophy', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` text NOT NULL,
  `userid` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post`, `userid`, `datetime`) VALUES
(1, 'WTB iphone', 3, '2017-01-05 00:56:59'),
(2, 'its 12:56 rn', 2, '2017-01-05 00:55:59'),
(3, 'testing another tweet', 4, '2017-01-06 22:26:54'),
(4, 'Testing this post system', 4, '2017-01-08 23:12:33'),
(5, 'Testing our new alert boxes!', 4, '2017-01-08 23:38:50'),
(6, 'I need BTC!', 4, '2017-01-08 23:40:25'),
(7, 'fixed an error', 4, '2017-01-08 23:42:44'),
(8, 'LOLOLOLOLOLOLLOLOLOLOL', 3, '2017-01-10 22:16:32'),
(9, 'testing our new reload functionality', 2, '2017-01-10 22:20:44'),
(10, 'Im looking for a Galaxy S9, anyone?', 2, '2017-01-10 22:21:00'),
(11, 'New tweet for github!', 4, '2017-01-19 12:19:05'),
(13, 'laptop satÄ±yorum acil!!\n', 6, '2018-05-16 03:26:56'),
(14, 'baya iyi', 6, '2018-05-16 03:27:07'),
(15, 'WTS +9 raptor', 7, '2018-05-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `item_id` int(11) NOT NULL,
  `shipping_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `company` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`item_id`, `shipping_date`, `arrival_date`, `company`) VALUES
(2, '2018-04-09', '2018-04-16', 'yurtici kargo'),
(4, '2018-05-02', '2018-05-08', 'UPS kargo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `trustworthy_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `trustworthy_point`) VALUES
(1, 'asd@asd.com', '42b886de9eff22197b4ca714066ab21c', 40),
(2, 'asd@sad.com', '95f8d188993fbee2e202b595a7b4aec1', 0),
(3, 'dovah@gmail.com', '842cbdb5c0fbe55e3172de49f4fdc5ab', 0),
(4, 'pranav@pranav.com', '400e1c2241b6f8218fab5e2fe4067f17', 77),
(5, 'test@test.com', '90492ae01d0f229fb0db95608b50ae9d', 50),
(6, 'erdemkader@gmail.com', '666666', 100),
(7, 'yusufokutan_61@windowslive.com', 'yokutan', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`user_id`,`item_id`),
  ADD KEY `dsf` (`item_id`);

--
-- Indexes for table `followingdata`
--
ALTER TABLE `followingdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followingtouserid` (`isFollowing`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followingdata`
--
ALTER TABLE `followingdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `asd` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dsf` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `followingdata`
--
ALTER TABLE `followingdata`
  ADD CONSTRAINT `followingtouserid` FOREIGN KEY (`isFollowing`) REFERENCES `users` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fdg` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
