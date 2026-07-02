-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2025 at 06:01 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'admin', 'admin321');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(31, 3, 2, 1),
(29, 1, 4, 1),
(28, 2, 39, 1),
(32, 3, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `submitted_at`) VALUES
(1, 'asif', 's@gmail.com', 'for security', 'security is very important.', '2025-04-06 16:49:00'),
(2, 'asif samji', 'minhaz@gamil.com', 'security', 'its very secure', '2025-04-06 16:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `P_NAME` varchar(100) NOT NULL,
  `P_PRICE` varchar(100) NOT NULL,
  `P_QUENTITY` int NOT NULL,
  `P_COMPANY` varchar(200) NOT NULL,
  `P_IMAGE` varchar(200) NOT NULL,
  `P_DISCOUNT` float DEFAULT '0',
  `P_DISCOUNTED_PRICE` decimal(10,2) NOT NULL,
  `P_RAM` varchar(50) NOT NULL,
  `P_ROM` varchar(50) NOT NULL,
  `P_COLOR` varchar(50) NOT NULL,
  `P_DISPLAY` varchar(100) NOT NULL,
  `P_BATTERY` varchar(100) NOT NULL,
  `P_PROCESSOR` varchar(100) NOT NULL,
  `P_CAMERA` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `P_NAME`, `P_PRICE`, `P_QUENTITY`, `P_COMPANY`, `P_IMAGE`, `P_DISCOUNT`, `P_DISCOUNTED_PRICE`, `P_RAM`, `P_ROM`, `P_COLOR`, `P_DISPLAY`, `P_BATTERY`, `P_PROCESSOR`, `P_CAMERA`) VALUES
(2, 'vivo v40', '24000', 9, 'vivo', 'upload_img/v_v40new.png', 0, '24000.00', '8 ', ' 128', 'Ganges Blue', '17.22 cm (6.78-inch) *Measured diagonally, the screen size is 17.22 cm (6.78-inch) in the full recta', '5500 mAh (TYP)', 'Qualcomm Snapdragon® 7 Gen 3 Mobile Platform', 'Front 50 MP (ZEISS) AF 92±3° Field-of-view Rear 50 MP AF+OIS (ZEISS) main + 50 MP AF (ZEISS) wide-an'),
(3, 'vivo vx 200', '50000', 13, 'vivo', 'upload_img/vvvvv.png', 3, '48500.00', '12', '256', 'Red', 'Display, 6.67\", 1260 x 2800 Resolution', 'Dimensity 9400 & 5800mAh', '3.6 MHz octa-core MediaTek Dimensity 9400 processor', ' 50MP Sony IMX921 main sensor'),
(4, 'samsung s24 fe', '62000', 10, 'samsung', 'upload_img/s24-fe.jpeg', 6, '58280.00', '8', '128', 'black', 'Large 6.7\" FHD+ Dynamic AMOLED 2X display for an immersive viewing experience', '4700 mAh battery', 'Exynos 2400e (4nm)', '	Triple: 50MP (wide), 8MP (telephoto, 3x optical zoom), 12MP (ultrawide)'),
(5, 'Samsung A34', '19000', 1, 'samsung', 'upload_img/s_a34.jpg', 4.2, '18202.00', '6', '128', 'white', '6.6 inches, 106.9 cm2 (~84.9% screen-to-body ratio) 	1080 x 2340 pixels, 19.5:9 ratio (~39', 'Li-Ion 5000 mAh', 'Samsung Exynos 1380 Processor', '48 MP, f/1.8, 26mm (wide), 1/2.0\", 0.8µm, PDAF, OIS 8 MP, f/2.2, 123˚, (ultrawide), 1/4.0\", 1.12µm 5'),
(6, 'samsung s25', '120000', 10, 'samsung', 'upload_img/S25.png', 3.5, '115800.00', '12', '256', 'grey', '.2 inches, 94.4 cm2 (~91.1% screen-to-body ratio)  1080 x 2340 pixels, 19.5:9 ratio (~416 ppi densit', 'Li-Ion 4000 mAh', 'Snapdragon 8 Elite SoC ', '50 MP, f/1.8, 24mm (wide), 1/1.56\", 1.0µm, dual pixel PDAF, OIS 10 MP, f/2.4, 67mm (telephoto), 1/3.'),
(7, 'iphone 13 Pro Max', '89000', 5, 'apple', 'upload_img/a_16 pronew.png', 0, '89000.00', '6', '128', 'black', '6.1 inches, 90.2 cm2 (~86.0% screen-to-body ratio) 	1170 x 2532 pixels, 19.5:9 ratio (~460', 'Li-Ion 3240 mAh (12.41 Wh)', 'Apple A15 Bionic', '12 MP, f/1.6, 26mm (wide), 1/1.9'),
(8, 'Iphone 14 pro max ', '65900', 19, 'apple', 'upload_img/sa14new.png', 2.5, '64252.50', '6', '256', 'black', '6.7 inches, 110.2 cm2 (~88.3% screen-to-body ratio) 	1290 x 2796 pixels, 19.5:9 ratio (~460 ppi dens', 'Li-Ion 4323 mAh (16.68 Wh)', 'A16 Bionic', '48 MP, f/1.8, 24mm (wide), 1/1.28\", 1.22µm, dual pixel PDAF, sensor-shift OIS 12 MP, f/2.8, 77mm (te'),
(9, 'samsung s25 ultra', '145000', 2, 'samsung', 'upload_img/S25 ultra.png', 5, '137750.00', '12', '256', 'black', '6.9 inches, 116.9 cm2 (~92.5% screen-to-body ratio) 	1440 x 3120 pixels, 19.5:9 ratio (~49', 'Li-Ion 5000 mAh', 'Qualcomm Snapdragon 8 Gen 3', '200 MP, f/1.7, 24mm (wide), 1/1.3\", 0.6µm, multi-directional PDAF, OIS 10 MP, f/2.4, 67mm (telephoto'),
(10, 'samsung fold f6', '165000', 9, 'samsung', 'upload_img/f6.png', 8, '151800.00', '12', '512', 'grey', '7.6 inches, 185.2 cm2 (~91.0% screen-to-body ratio) 1856 x 2160 pixels (~374 ppi density)', 'Li-Po 4400 mAh', 'Qualcomm Snapdragon 855', '50 MP, f/1.8, 23mm (wide), 1/1.57\", 1.0µm, dual pixel PDAF, OIS 10 MP, f/2.4, 66mm (telephoto), 1/3.'),
(11, 'samsung a55', '42000', 8, 'samsung', 'upload_img/a55.jpeg', 0, '42000.00', '6', '128', 'black', '6.6 inches, 106.9 cm2 (~85.8% screen-to-body ratio)  1080 x 2340 pixels, 19.5:9 ratio (~390 ppi dens', 'Li-Ion 5000 mAh', 'Samsung Exynos 1480', '50 MP, f/1.8, (wide), 1/1.56\", 1.0µm, PDAF, OIS 12 MP, f/2.2, 123˚ (ultrawide), 1/3.06\", 1.12µm 5 MP'),
(12, 'samsung f55', '26000', 10, 'samsung', 'upload_img/f55.png', 0, '26000.00', '8', '128', 'Apricot', '6.7 inches, 108.4 cm2 (~86.4% screen-to-body ratio) 1080 x 2400 pixels, 20:9 ratio (~393 ppi density', '5000 mAh', 'Snapdragon 7 Gen 1', '50 MP, f/1.8, (wide), 1/1.56\", 1.0µm, PDAF, OIS 8 MP, f/2.2, 123˚ (ultrawide) 2 MP, f/2.4, (macro)'),
(13, 'Apple iPhone 16 pro max', '136999', 6, 'apple', 'upload_img/Iphone-16 pro max.png', 7, '127409.07', '8', '256', 'Black Titanium', '6.9 inches, 115.6 cm2 (~91.4% screen-to-body ratio) 1320 x 2868 pixels, 19.5:9 ratio (~46', 'Li-Ion 4685 mAh', 'A18 Pro chip', '48 MP, f/1.8, 24mm (wide), 1/1.28\", 1.22µm, dual pixel PDAF, sensor-shift OIS 12 MP, f/2.8, 120mm (p'),
(14, 'Apple iPhone 16 ', '75599', 5, 'apple', 'upload_img/Iphone-16.png', 9, '68795.09', '8', '256', 'Ultramarine', '6.1 inches, 91.7 cm2 (~86.8% screen-to-body ratio) 1179 x 2556 pixels, 19.5:9 ratio (~460 ppi densit', 'Li-Ion 3561 mAh', 'A18 chip', '48 MP, f/1.6, 26mm (wide), 1/1.56\", 1.0µm, dual pixel PDAF, sensor-shift OIS 12 MP, f/2.2, 13mm, 120'),
(15, 'iPhone 11', '45000', 7, 'apple', 'upload_img/Iphone-11.png', 0, '45000.00', '4', '64', 'White', '6.1 inches, 90.3 cm2 (~79.0% screen-to-body ratio) 828 x 1792 pixels, 19.5:9 ratio (~326 ppi density', 'Li-Ion 3110 mAh, non-removable (11.91 Wh)', 'A13 Bionic', '12 MP, f/1.8, 26mm (wide), 1/2.55\", 1.4µm, dual pixel PDAF, OIS 12 MP, f/2.4, 120˚, 13mm (ultrawide)'),
(16, 'iPhone 16e', '60000', 10, 'apple', 'upload_img/Iphone-16e.png', 5, '57000.00', '8', '128', 'white', '6.1 in (150 mm) 2532 × 1170 resolution', '15.55 Wh (4005 mAh) Li-ion @ 3.88 V', 'iPhone SE (3rd generation)', '48 MP, f/1.6, 26 mm (wide)'),
(17, 'iPhone 15', '75999', 15, 'apple', 'upload_img/Iphone-15.png', 5, '72199.05', '6', '128', 'blue', '6.1 in (150 mm) 2556 × 1179 resolution, 19.5:9 aspect ratio (~460 ppi density) Super Retina XDR OLED', '2.98 Wh (3349 mAh) Li-ion', 'A17 Bionic', '48 MP, f/1.6, 26 mm (wide) 12 MP, f/2.4, 13 mm, (ultrawide)'),
(18, 'Iphone 14 pro ', '58000', 10, 'apple', 'upload_img/iphone-14-pro.jpg', 0, '58000.00', '6', '128', 'gold', '6.1 in (155 mm) 2556 × 1179 resolution, 19.5:9 ratio (~460 ppi density) Super Retina XDR OLED, HDR10', '12.38 Wh (3200 mAh) Li-ion @ 3.87 V', 'A16 Bionic', '48 MP, f/1.78, 24 mm (main), 1/1.28\",[4] 1.22 μm – 2.44 μm binned, dual pixel PDAF, Second generatio'),
(19, 'vivo v50', '45000', 10, 'vivo', 'upload_img/v50.jpg', 7.5, '41625.00', '8', '128', 'Satin Black (Titanium Grey)', '6.77 inches, 110.9 cm2 (~88.5% screen-to-body ratio) 1080 x 2392 pixels (~388 ppi density)', 'Si/C 6000 mAh', 'Snapdragon® 7 Gen 3', '50 MP, f/1.9, 23mm (wide), 1/1.55\", 1.0µm, PDAF, OIS 50 MP, f/2.0, 15mm, 119˚ (ultrawide), 1/2.76\", '),
(20, 'vivo t3', '20000', 8, 'vivo', 'upload_img/Vivo-T3-5G.png', 0, '20000.00', '8', '256', 'Cosmic Blue', '6.67 inches, 107.4 cm2 (~86.8% screen-to-body ratio) 1080 x 2400 pixels, 20:9 ratio (~395 ppi densit', '5000 mAh', 'Dimensity 7200', '50 MP, f/1.8, (wide), 1/1.95\", 0.8µm, PDAF, OIS 2 MP, f/2.4, (depth)'),
(21, 'vivo v29', '16000', 10, 'vivo', 'upload_img/y29.png', 2.5, '15600.00', '8', '128', 'Space Black', '6.78 inches, 111.0 cm2 (~90.8% screen-to-body ratio) 1260 x 2800 pixels, 20:9 ratio (~453 ppi densit', '4600 mAh', 'octa-core Qualcomm Snapdragon 778G', '50 MP, f/1.9, (wide), 1/1.56\", 1.0µm, PDAF, OIS 8 MP, f/2.2, (ultrawide), 1/4.0\", 1.12µm 2 MP, f/2.4'),
(22, 'vivo x fold 3', '210999', 16, 'vivo', 'upload_img/x f3.png', 10, '189899.10', '16', '256', 'Black', '8.03 inches, 206.5 cm2 (~90.5% screen-to-body ratio) 2200 x 2480 pixels (~413 ppi density)  	Cover d', 'Si/C Li-Ion 5500 mAh', 'Snapdragon 8 Gen 2', '50 MP, f/1.8, (wide), 1/1.49\", PDAF, OIS 50 MP, f/1.9, (telephoto), 1/2.93\", PDAF, 2x optical zoom 5'),
(23, 'vivo v29 pro', '41999', 13, 'vivo', 'upload_img/vivo-v29-pro.jpg', 2.5, '40949.03', '8', '256', 'Himalayan Blue', '6.78 inches, 111.0 cm2 (~90.8% screen-to-body ratio) 1260 x 2800 pixels, 20:9 ratio (~453 ppi densit', '4600 mAh', 'MediaTek Dimensity 8200', '50 MP, f/1.9, (wide), 1/1.56\", 1.0µm, PDAF, OIS 12 MP, f/2.0, (telephoto), 1/2.93\", 1.22µm, PDAF, 2x'),
(24, 'vivo x100', '135999', 10, 'vivo', 'upload_img/x100.jpg', 5, '129199.05', '16', '1TB', 'Startrail Blue', '6.78 inches, 111.5 cm2 (~90.3% screen-to-body ratio) 1260 x 2800 pixels, 20:9 ratio (~452 ppi densit', 'Li-Ion 5000 mAh', ' Mediatek Dimensity 9300', '50 MP, f/1.6, (wide), 1/1.49\", PDAF, OIS 64 MP, f/2.6, 70mm (periscope telephoto), 1/2.0\", PDAF, OIS'),
(25, 'oppo Reno 12 Pro 5G', '36999', 14, 'oppo', 'upload_img/oppo Reno 12 Pro 5G1.png', 0, '36999.00', '12', '256', 'Sunset Gold', '6.7 inches, 108.0 cm2 (~89.4% screen-to-body ratio) 1080 x 2412 pixels, 20:9 ratio (~394 ppi density', '5000 mAh', 'MediaTek Dimensity 7300-Energy', '50 MP, f/1.8, 26mm (wide), 1/1.95\", 0.8µm, multi-directional PDAF, OIS 50 MP, f/2.0, 47mm (telephoto'),
(26, 'Realme 12 Pro 5g', '30000', 21, 'realme', 'upload_img/Realme 12 Pro 5g1.png', 4, '28800.00', '8', '128', 'Submarine Blue', '6.7 inches, 108.0 cm2 (~90.4% screen-to-body ratio) 1080 x 2412 pixels, 20:9 ratio (~394 ppi density', '5000 mAh', 'Snapdragon 6 Gen 1 5G Processor', '50 MP, f/1.8, 26mm (wide), 1/2.0\", PDAF, OIS 32 MP, f/2.0, 47mm (telephoto), 1/2.75\", PDAF, OIS, 2x '),
(27, 'Motorola Edge 50 Pro 5G', '41999', 12, 'motorola', 'upload_img/Motorola Edge 50 Ultra 5G2.png', 17, '34859.17', '8', '128', 'Black Beauty', '6.7 inches, 107.4 cm2 (~92.0% screen-to-body ratio) Resolution	1220 x 2712 pixels, 20:9 ratio (~446 ', 'Li-Po 4500 mAh', 'Qualcomm Snapdragon 7 Gen 3 (4 nm)', '50 MP, f/1.4, 25mm (wide), 1/1.55\", 1.0µm, multi-directional PDAF, OIS 10 MP, f/2.0, 67mm (telephoto'),
(28, 'Huawei P50', '47159.38', 10, 'huawei', 'upload_img/p501.png', 0, '47159.38', '8', '128', 'Black', '6.5 inches, 101.6 cm2 (~88.0% screen-to-body ratio) 1224 x 2700 pixels (~458 ppi density)', 'Li-Po 4100 mAh0', 'octa-core Qualcomm Snapdragon 888 processor', '50 MP, f/1.8, 23mm (wide), PDAF, OIS 12 MP, f/3.4, 125mm (periscope telephoto), PDAF, OIS, 5x optica'),
(29, 'Xiaomi 14', '75000', 9, 'xiaomi', 'upload_img/xiaomi 141.png', 7, '69750.00', '16', '1TB', 'White', '6.36 inches, 97.6 cm2 (~89.3% screen-to-body ratio) 1200 x 2670 pixels, 20:9 ratio (~460 ppi density', 'Li-Po 4610 mAh', 'MediaTek Dimensity 7025-Ultra', '50 MP, f/1.6, 23mm (wide), 1/1.31\", 1.2µm, dual pixel PDAF, OIS 50 MP, f/2.0, 75mm (telephoto), PDAF'),
(30, 'Motorola G34 5G', '14500', 6, 'motorola', 'upload_img/m1.png', 0, '14500.00', '8GB', '128GB', 'Blue', '16.51 cm (6.5 inch)', '5000 mAh', 'Snapdragon 695 5G', '50MP + 2MP'),
(31, 'motorola razr 50', '55000', 20, 'motorola', 'upload_img/m2.png', 2, '53900.00', '8GB', '256GB', 'Beach Sand', 'Main display: FHD+ (2640 x 1080) | 413ppi', '4200mAh', ' Mediatek Dimensity 7300X (4 nm), Octa-core (4x2.5 GHz Cortex-A78 & 4x2.0 GHz Cortex-A55), Mali-G615', '13MP (f/2.2, 1.12µm) | Ultra wide/ macro | FOV 120°'),
(32, 'Xiaomi 15 Ultra', '109999', 21, 'xiaomi', 'upload_img/x1.png', 2, '107799.02', '16GB', '512GB', 'silver', '17.09 cm (6.72 inch) 120Hz AMOLED Display', '5410mAh', 'Snapdragon 8 Elite Processor', '200MP + 50MP + 50MP + 50MP Quad Rear Camera'),
(33, ' Xiaomi 13 Ultra', '100999', 12, 'xiaomi', 'upload_img/x2.png', 2.6, '131519.04', '16GB', '1TB', 'Olive Green', '6.73 inches, 108.9 cm2 (~89.5% screen-to-body ratio)', 'Li-Po 5000 mAh, non-removable', 'Qualcomm SM8550-AB Snapdragon 8 Gen 2 (4 nm)', '50 MP, f/1.9 or f/4.0, 23mm (wide)'),
(34, 'Realme GT 7 Pro 5G', '74999', 10, 'realme', 'upload_img/r.png', 5, '71249.05', '16GB', '512GB', 'Galaxy Grey', '162.45 mmx76.89 mmx8.55 mm', '5800 mAh battery', 'Snapdragon 8 Elite Processor ', '50 MP + 50 MP + 8 MP'),
(35, 'Realme 12X 5G', '14999', 3, 'realme', 'upload_img/r3.png', 0, '14999.00', '8GB', '128GB', 'Red', '17.07 cm (6.72 inch) Full HD+ Display || 12.07 cm (6.72) 120 Hz FHD+ Display', '5000 mAh Battery', 'Dimensity 6100+ Processor ', '50MP + 2MP | 8MP Front Camera '),
(36, 'Oppo F27 Pro Plus 5G ', '25999', 14, 'oppo', 'upload_img/o1.png', 0, '25999.00', '8GB', '128GB', 'Black', '17.01 cm - 6.7 inch AMOLED 3D 120 H', '5000 mAh Battery', 'Dimensity 7050 Processor', '8MP Front Camera'),
(37, 'OPPO RENO 8T 5G ', '38999', 21, 'oppo', 'upload_img/o2.png', 6, '36659.06', '8GB', '128GB', 'Black', 'Full HD+ 3D Flexible OLED Display', '4800 mAh', 'Qualcomm Snapdragon 695', '108MP Portrait Camera.'),
(38, 'OnePlus 13', '92999', 10, 'oneplus', 'upload_img/one1.png', 17, '77189.17', '16GB', '512GB', '‎Black Eclipse', ' 6.82 inches (17.32 cm), ProXDR Display with LTPO 4.1, 120 Hz Refresh Rate', ' 6000 mAh ', 'Qualcomm Snapdragon 8 Elite, Octa Core, 4.32 GHz', '50 MP + 50 MP + 50 MP Triple Rear & 32 MP Front Camera'),
(39, 'OnePlus 12R', '45999', 12, 'oneplus', 'upload_img/one2.png', 0, '45999.00', '16GB', '256GB', 'Blue', ' 6.78 inches (17.22 cm)', '5500 mAh ', 'Qualcomm Snapdragon 8 Gen 2', '50 MP + 8 MP + 2 MP Triple Rear & 16 MP Front Camera'),
(40, 'Refurbished OnePlus 10 Pro 5G', '53999', 4, 'oneplus', 'upload_img/one3.png', 5.5, '51029.06', '12GB', '512GB', 'Black', ' Display LTPO2 Fluid AMOLED, 1B colours, 120Hz, HDR10+', '5000 mAh', 'Qualcomm SM8450 Snapdragon 8 Gen 1 (4 nm)', '48 MP, 8 MP (telephoto), 50 MP (ultrawide)');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  `address` varchar(200) NOT NULL,
  `purchase_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` enum('Pending Payment','Processing','Shipped','Out for Delivery','Delivered') DEFAULT 'Processing',
  `payment_method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `product_id`, `quantity`, `price`, `address`, `purchase_date`, `order_status`, `payment_method`) VALUES
(17, 4, 9, 2, 275500, 'parci bag ', '2025-11-19 11:10:08', 'Shipped', 'Cash on Delivery'),
(16, 1, 3, 1, 48500, 'malekpor surat', '2025-04-07 05:53:07', 'Shipped', 'Cash on Delivery'),
(14, 2, 3, 2, 97000, 'Gandevi Navsari', '2025-04-02 04:04:55', 'Shipped', 'Cash on Delivery'),
(15, 2, 29, 2, 139500, 'gandevi navsari', '2025-04-02 04:06:19', 'Processing', 'Cash on Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contactno` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fname`, `lname`, `address`, `email`, `contactno`, `password`) VALUES
(1, 'hamza', 'mulla', 'malekpor surat', 'hamza02@gmail.com', '8469665747', 'Hamza@02'),
(2, 'adnan', 'vaidya', 'gandevi navsari', 'adnan01@gmail.com', '9601792121', 'Adnan@01'),
(3, 'asif', 'samji', 'charpool navsari', 'asif03@gmail.com', '9054070029', 'Asifsamji@03'),
(4, 'urvax', 'rajvada', 'parci bag', 'ur@gmail.com', '9988998899', 'ur@321');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`) VALUES
(7, 2, 21),
(6, 2, 6),
(4, 1, 22),
(5, 1, 10),
(8, 3, 2),
(9, 3, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
