-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 05:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apu`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `tags` text DEFAULT NULL,
  `book_image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `book_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `category`, `tags`, `book_image`, `price`, `book_details`) VALUES
(1, 'PHP Programming', 'Programming', 'php, programming, learn, html, javascript', 'image1.jpg', 4.50, 'This is something ...'),
(2, 'Javascript Programming ', 'Programming', 'php, programming, learn, html, javascript', 'image1.jpg', 4.50, 'This is something ...');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `userid` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `order_status` enum('Pending','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `book_id`, `userid`, `order_date`, `quantity`, `total_price`, `shipping_address`, `order_status`) VALUES
(1, 1, '1244', '0000-00-00 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(2, 2, '1244', '0000-00-00 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(3, 2, '1244', '0000-00-00 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(4, 2, '1244', '0000-00-00 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(5, 1, '1244', '0000-00-00 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(6, 1, '1244', '0000-00-00 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(7, 1, '1244', '2023-10-25 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(8, 1, '1244', '2023-10-25 00:00:00', 1, 12.00, 'Anything', 'Pending'),
(9, 2, '1244', '2023-10-25 09:15:40', 1, 12.00, 'Anything', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `first_name`, `last_name`, `date_created`) VALUES
(1244, 'zareef', '9193ce3b31332b03f7d8af056c692b84', 'zareef@zareef.com', 'zareef', 'ahmed', '2023-10-24 08:43:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1246;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
