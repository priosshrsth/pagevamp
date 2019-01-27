-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2019 at 03:06 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(2, 'Adidas'),
(1, 'Nike');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Jackets'),
(1, 'Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `gender`, `price`, `image`, `brand_id`, `category_id`) VALUES
(1, 'Nike Men Navy Blue Solid REVOLUTION 4 FLYEASE Running Shoes', 'M', '1500.00', '1.jpg', 1, 1),
(2, 'Nike Men Blue Legend React Running Shoes', 'M', '8795.00', '2.jpg', 1, 1),
(3, 'Chaussure Basket NIKE hommes AIR MAX 270 Sport Jogging Gym H', 'M', '100.00', '3.jpg', 1, 1),
(4, 'Nike Air Max 270 Femme Basket Sneackers Sport Respirant', 'M', '150.00', '4.jpg', 1, 1),
(5, 'Basket Nike Air VaporMax Flyknit Respirant Hommes de Chaussu', 'M', '200.00', '5.jpg', 1, 1),
(6, 'Nike Women White Solid Zoom Winflo 5 Running Shoes', 'F', '200.00', '6.jpg', 1, 1),
(7, 'Nike Unisex Black PORTMORE II ULTRALIGHT Skateboarding Shoes', 'F', '1550.00', '7.jpg', 1, 1),
(8, 'Nike Unisex Grey Skateboarding Shoes', 'F', '1500.00', '8.jpg', 1, 1),
(9, 'NIKE Unisex Grey SB CHARGE Skateboarding Shoes', 'F', '250.00', '9.jpg', 1, 1),
(10, 'Nike Unisex Green Solid SB CHECK SOLAR CNVS Skateboarding Sh', 'F', '250.00', '10.jpg', 1, 1),
(11, 'Nike Men Black Solid AS M NK FC TRK JKT K Standard Fit Footb', 'M', '550.00', '11.jpg', 1, 1),
(12, 'Nike Men Black Solid DWN FILL Padded Jacket', 'M', '250.00', '12.jpg', 1, 2),
(13, 'Nike Men Grey & Olive Green AS M NK THRMA HD FZ CMO Printed ', 'M', '1050.00', '13.jpg', 1, 2),
(14, 'Nike Men Maroon Standard Fit FCB M NK ANTHM Sporty Jacket', 'M', '250.00', '14.jpg', 1, 2),
(15, 'Nike Men Black & Grey Colourblocked NSW SYN FILL Standard Fi', 'M', '1500.00', '15.jpg', 1, 2),
(16, 'Nike Women Grey Solid Standard Fit AROLYR VEST Water Resista', 'F', '250.00', '16.jpg', 1, 2),
(17, 'Nike WoMen Black AS W NSW AV15 HOODIE FZ Solid Hooded Sporty', 'F', '1500.00', '17.jpg', 1, 2),
(18, 'Nike Women Mauve AS AIR N98 PK Solid Sporty Jacket', 'F', '1600.00', '10.jpg', 1, 2),
(19, 'Nike Women Charcoal Solid AS W NSW GYM VNTG Hooded Jacket', 'F', '1000.00', '18.jpg', 1, 2),
(20, 'Nike Women Blue Solid Standard Fit WM TOP LS HZ Dri-FIT Trai', 'F', '450.00', '19.jpg', 1, 2),
(21, 'Adidas Men Charcoal Grey DURAMO 8 Running Shoes', 'M', '1500.00', '21.jpg', 2, 1),
(22, 'Adidas Men Black Solar Boost Striped Running Shoes', 'M', '500.00', '22.jpg', 2, 1),
(23, 'Adidas Men Blue ADISTARK 3.0 Running Shoes', 'M', '250.00', '23.jpg', 2, 1),
(24, 'Adidas Men Black FluidCloud Neutral Running Shoes', 'M', '150.00', '24.jpg', 2, 1),
(25, 'Adidas Men Navy Blue Running Shoes', 'M', '1400.00', '25.jpg', 2, 1),
(26, 'Adidas Originals Women Pink Superstar 80S Leather Sneakers', 'F', '1500.00', '26.jpg', 2, 1),
(27, 'Adidas Women Green YKING 2.0 Running Shoes', 'F', '220.00', '27.jpg', 2, 1),
(28, 'Adidas Originals Women White DEERUPT Casual Shoes', 'F', '1500.00', '28.jpg', 2, 1),
(29, 'Adidas Originals Women Lavender Gazelle Snakeskin Texture Le', 'F', '330.00', '29.jpg', 2, 1),
(30, 'Adidas Women Pink & Burgundy Edge Lux 2 Colourblocked Runnin', 'F', '260.00', '30.jpg', 2, 1),
(31, 'Adidas Originals Men Navy SST Track Jacket', 'M', '2000.00', '31.jpg', 2, 2),
(32, 'Adidas Originals Men Black SST Solid Sleeveless Puffer Jacke', 'M', '2500.00', '32.jpg', 2, 2),
(33, 'Adidas Originals Green Casual Jacket', 'M', '4000.00', '33.jpg', 2, 2),
(34, 'Adidas Men Blue Solid Tango Windbreaker Football Jacket', 'M', '4500.00', '34.jpg', 2, 2),
(35, 'Adidas Men Blue Solid VARILITE VEST Training Lightweight Pad', 'M', '5000.00', '35.jpg', 2, 2),
(36, 'Adidas Stella McCartney by Women Orange Training Puffer Jack', 'F', '5200.00', '36.jpg', 2, 2),
(37, 'Adidas Women Beige Helionic Vest Solid Padded Outdoor Jacket', 'F', '5500.00', '37.jpg', 2, 2),
(38, 'Adidas Stella McCartney by Blue & Grey Ombre Print Hooded Tr', 'F', '6000.00', '38.jpg', 2, 2),
(39, 'Adidas Women Grey Solid Sporty Jacket', 'F', '9999.99', '39.jpg', 2, 2),
(40, 'Adidas Originals Women Blue & Off-White SST Printed Track Ja', 'F', '9999.99', '30.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `address`, `contact`) VALUES
(3, 'Anit Shrestha', 'priosshrsth', '$2y$10$CIhbmozH2rIvAfRJAquOjODC4XtGoljqsHQpOw7QuMGR0Z.yE2bWm', 'shrsthprios@gmail.com', 'Dhulikhel', '9813702239');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
