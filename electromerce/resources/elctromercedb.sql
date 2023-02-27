-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 07:32 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elctromercedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'elgountariayoub22@gmail.com', '$2y$10$Ze94I6WWhivU9U2nubaDTey7Y5t9A6L1iQA1sz5MFpoB0zLHpDuLi');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `idAdmin` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `pId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `idAdmin`, `name`, `description`, `pId`) VALUES
(4, 1, 'Computer', 'Computer Category Description', NULL),
(5, 1, 'Phones', 'Phones Category Description', NULL),
(6, 1, 'Smartphones', 'These are handheld devices that can make calls, send messages, and run various apps. They typically ', NULL),
(7, 1, 'Laptops', 'These are portable computers that feature a screen, keyboard, and trackpad or mouse. They can be use', NULL),
(8, 1, 'TVs', 'These are large screens that display video content. They come in a range of sizes and resolutions, f', NULL),
(9, 1, 'Cameras', 'These are devices used to capture photos and videos. They range from basic point-and-shoot models to', NULL),
(10, 1, 'Gaming consoles', 'These are dedicated devices designed for playing video games. They include popular consoles such as ', NULL),
(11, 1, 'Smartwatches', 'These are wearable devices that can display notifications, track fitness data, and run various apps.', NULL),
(12, 1, 'Headphones', 'These are devices used to listen to audio content. They range from basic earbuds to high-end over-ea', NULL),
(13, 1, 'Tablets', 'These are portable devices that feature a touchscreen and can be used for web browsing, email, and r', NULL),
(14, 1, 'Speakers', 'These are devices used to play audio content. They range from small portable models to large home th', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(100) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `fullName`, `phoneNumber`, `adress`, `city`, `email`, `password`) VALUES
(9, 'AYOUB ELGOUNTARI', '0713244063', 'Safi', 'Safi', 'elgountariayoub2002@gmail.com', '$2y$10$9h9Y8Sveu081/4QdL..pHewpQdtOknoMEOEALDrDyc588bW3jtmgW'),
(10, 'pm', '12345678', 'morocco', 'pms', 'pm@gmail.com', '$2y$10$ruXIIUOBqHKIdsonFjvLteeW4HaNEVCIJHuNh4hiJsBKpHrE3Ueo.'),
(11, 'Ayooo', '12345678', '2345678567u4', 'sdfasd', '8@m.p', '$2y$10$/OxYZZETEumHojlLSHBG1.m1p8wVapXUl7EtBtyeqVp/3/g4Zz9cK'),
(12, 'Hanane', '0123456789', 'MyHart', 'MyHart', 'hanane@gmail.com', '$2y$10$FzBfYUsDPZtZcg3bgvZ66elZU18K1BsyzyCabjONi.0NnKjjm1OGy');

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `idProd` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `unitPrice` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `prodTotalPrice` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`idProd`, `idOrder`, `unitPrice`, `quantity`, `prodTotalPrice`) VALUES
(53, 1, 12000, 3, '12000'),
(54, 1, 22000, 5, '22000'),
(55, 1, 5200, 2, '5200');

-- --------------------------------------------------------

--
-- Table structure for table `prodcat`
--

CREATE TABLE `prodcat` (
  `idPrd` int(11) NOT NULL,
  `idCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `idAdmin` int(11) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `idCat` int(11) DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `barCode` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `purchasePrice` decimal(10,0) DEFAULT NULL,
  `finalPrice` decimal(10,0) DEFAULT NULL,
  `offerPrice` decimal(10,0) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `idAdmin`, `title`, `idCat`, `reference`, `description`, `barCode`, `photo`, `purchasePrice`, `finalPrice`, `offerPrice`, `visibility`) VALUES
(53, 1, 'Samsung 17', 5, '1234', 'A great Phone', '1234', 'productsImgs/Samsung-17.jpg', '10000', '12000', '11000', 1),
(54, 1, 'Camera 180k', 9, '1243', 'A great Camera', '1243', 'productsImgs/camera.jpg', '20000', '22000', '21000', 1),
(55, 1, 'Portable wirless', 14, '2134', 'A great speaker', '2134', 'productsImgs/Speaker wirless.webp', '500', '5200', '5100', 1),
(56, 1, 'Smart Speaker', 14, '1423', 'A great Speaker', '1423', 'productsImgs/smart apeaker.jpg', '600', '6200', '6100', 1),
(57, 1, 'Bugatti', 11, '1432', 'A great watch', '1432', 'productsImgs/watch.jpg', '9000', '9200', '9100', 1),
(58, 1, 'airpods 91k', 12, '1928', 'A great Airpods', '1928', 'productsImgs/airpods.jpg', '700', '7200', '7100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `_order`
--

CREATE TABLE `_order` (
  `id` int(11) NOT NULL,
  `idAdmin` int(11) DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `orderTotalPrice` decimal(10,0) DEFAULT NULL,
  `creationDate` date DEFAULT NULL,
  `dispatchDate` date DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_order`
--

INSERT INTO `_order` (`id`, `idAdmin`, `idClient`, `reference`, `orderTotalPrice`, `creationDate`, `dispatchDate`, `deliveryDate`, `status`) VALUES
(1, 1, 12, 'syrfa', NULL, NULL, NULL, NULL, 'notValid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAdmin` (`idAdmin`),
  ADD KEY `fk_p_id` (`pId`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`idProd`,`idOrder`),
  ADD KEY `idOrder` (`idOrder`);

--
-- Indexes for table `prodcat`
--
ALTER TABLE `prodcat`
  ADD PRIMARY KEY (`idPrd`,`idCat`),
  ADD KEY `idCat` (`idCat`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD UNIQUE KEY `barCode` (`barCode`),
  ADD KEY `idAdmin` (`idAdmin`),
  ADD KEY `idCat` (`idCat`);

--
-- Indexes for table `_order`
--
ALTER TABLE `_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `idClient` (`idClient`),
  ADD KEY `idAdmin` (`idAdmin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `_order`
--
ALTER TABLE `_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`pId`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`idProd`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`idOrder`) REFERENCES `_order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prodcat`
--
ALTER TABLE `prodcat`
  ADD CONSTRAINT `prodcat_ibfk_1` FOREIGN KEY (`idPrd`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `prodcat_ibfk_2` FOREIGN KEY (`idCat`) REFERENCES `category` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`idCat`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `_order`
--
ALTER TABLE `_order`
  ADD CONSTRAINT `_order_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `_order_ibfk_2` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
