-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 06:21 AM
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
-- Database: `project123`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(4) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_description` tinytext DEFAULT NULL,
  `category_image_path` varchar(255) DEFAULT NULL,
  `parent_category_id` int(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `category_image_path`, `parent_category_id`, `status`) VALUES
(2, 'sssssss', '                                    ssjjss                        ', 'images/wachesh.jpg', 115, 1),
(4, 'Historical Fiction', 'A book is&nbsp;a medium for recording information in the form of writing or images, typically composed of many pages (made of papyrus, parchment, vellum, or paper) bound together and protected by a cover.', 'images/book.jpg', 63, 1),
(20, 'Laptop', '&nbsp;A laptop can be easily transported and used in temporary spaces such as on airplanes, in libraries, temporary offices and at meetings.', 'images/laptop.jpg', 95, 1),
(59, 'Tshit', 'A T-shirt is&nbsp;a cotton shirt with no collar or buttons. T-shirts usually have short sleeves.', 'images/tshit.jpg', 96, 1),
(60, 'Phone', 'A device that uses either a system of wires along which electrical signals are sent or a system of radio signals to make it possible for you to speak to someone in another place who has a similar device: Just then, his phone rang.', 'images/phone.jpg', 95, 1),
(63, 'Books', 'Historical fiction is a literary genre in which a fictional plot takes place in the setting of particular real historical events', 'images/books.jpg', 4, 0),
(95, 'Electronics', 'Electronics products', '/images/electronics.jpg', 109, 0),
(96, 'Clothing', 'Clothing and Apparel', '/images/clothing.jpg', NULL, 0),
(97, 'Phones', 'Mobile Phones', '/images/phones.jpg', NULL, 0),
(98, 'Laptops', 'Laptop Computers', '/images/laptops.jpg', NULL, 0),
(108, 'Home & Furniture', 'Furniture and Home Decor', '/images/home_furniture.jpg', NULL, 0),
(109, 'Appliances', '            Kitchen and Home Appliances    ', 'images/hospitality-3793946_1280.jpg', 112, 1),
(110, 'Bedroom', 'Clothing (also known as clothes, garments, dress, apparel, or attire) is&nbsp;any item worn on the body. Typically, clothing is made of fabrics or textiles, but over time it has included garments made from animal skin and other thin sheet', 'images/beautiful-second-hand-market.jpg', 96, 0),
(111, 'Living Room', 'Living Room Furniture', '/images/living_room.jpg', NULL, 0),
(112, 'Refrigerators', 'Refrigerators and Coolers', '/images/refrigerators.jpg', NULL, 0),
(113, 'Ovens', 'Ovens and Stoves', '/images/ovens.jpg', NULL, 0),
(114, 'Dresses', 'Women\'s Dresses', '/images/dresses.jpg', NULL, 0),
(115, 'Shirts', 'Men\'s Shirts', '/images/shirts.jpg', NULL, 0),
(160, 'sourabgh', 'ss', 'images/Electronic-Devices-1.jpg', 2, 0),
(161, 'ss', 'ss', 'images/book.jpg', 2, 0),
(163, 'ssss', 'ss', 'images/Ecommerce Admin-Product Management (1) (6).jpg', 2, 1),
(165, 'ffdasffsa', 'dasasdad', 'images/71KjTSO8M9L._SX569_.jpg', 2, 0),
(166, 'fasasdsss', 'dfdassa', 'images/61VVef0Y5OL._SX569_.jpg', 2, 0),
(168, 'dsaasdas', 'dasdas', 'images/Ecommerce Admin-Product Management (1) (6).jpg', 110, 0),
(169, 'dsadasdas', 'dsds', 'images/Ecommerce Admin-User Management.jpg', 166, 0),
(170, 'dsdasdas', 'dsdas', 'images/Ecommerce Admin-Product Management (1) (6).jpg', 166, 0),
(171, 'dsasdads', 'dsdas', 'images/Ecommerce Admin-Product Management (1) (6).jpg', 166, 0),
(172, 'sdsdsdsadasdas', 'dasdasdas', 'images/Ecommerce Admin-User Management (1).jpg', 170, 0),
(173, 'dsdasdasdas', 'dsds', 'images/Ecommerce Admin-User Management (1).jpg', 161, 0),
(174, 'daskls', 'dasas', 'images/Ecommerce Admin-Product Management (1) (6).jpg', 20, 0),
(175, 'dsasddadas', 'ds', 'images/Ecommerce Admin-User Management (1).jpg', 2, 0),
(176, 'sddsdas', 'ss', 'images/Ecommerce Admin-User Management (1).jpg', 2, 0),
(177, 'dsasa', 'dfdf', 'images/Ecommerce Admin-User Management (1).jpg', 173, 0),
(179, 'dsds', 'ds', 'images/Ecommerce Admin-User Management (1).jpg', 173, 0),
(180, 'sdssadas', 'dsds', 'images/Ecommerce Admin-User Management (1).jpg', 171, 0),
(181, 'dssdsa', 'dsds', 'images/Ecommerce Admin-User Management (1).jpg', 171, 0),
(182, 'dssdaa', 'ss', 'images/Ecommerce Admin-User Management (1).jpg', 170, 0),
(185, 'watches123', 'sss', 'images/Ecommerce Admin-User Management (1).jpg', 2, 0),
(186, 's', '', 'images/Ecommerce Admin-Order Management (3).jpg', 2, 0),
(187, 'ds', 'dss', 'images/Ecommerce Admin-Product Management (1) (7).jpg', 2, 0),
(189, 'dsaassaas', 'dsd', 'images/Ecommerce Admin-User Management (1).jpg', 2, 0),
(192, 'sourabh', 'sds', 'images/Ecommerce Admin-Product Management (1) (7).jpg', 172, 0),
(195, 'sourabh223443', 'ddsds', 'images/Ecommerce Admin-Product Management (1) (7).jpg', 110, 0),
(197, 'mobiles ', '             sss                           ', 'images/Ecommerce Admin-Product Management (1) (7).jpg', 20, 0),
(199, 'dsdssd', 'ds', 'images/Ecommerce Admin-Product Management (1) (7).jpg', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(4) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `customer_mobile` varchar(11) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customerbilling_address1` varchar(255) NOT NULL,
  `customerbilling_address2` varchar(255) NOT NULL,
  `customerbilling_city` varchar(50) NOT NULL,
  `customerbilling_state` varchar(20) NOT NULL,
  `customerbilling_country` varchar(20) NOT NULL,
  `customerbilling_zip` int(6) NOT NULL,
  `shipping_address1` varchar(255) NOT NULL,
  `shipping_address2` varchar(255) NOT NULL,
  `shipping_city` varchar(40) NOT NULL,
  `shipping_state` varchar(30) NOT NULL,
  `shipping_country` varchar(20) NOT NULL,
  `shipping_zip` int(6) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `customer_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_mobile`, `customer_email`, `customerbilling_address1`, `customerbilling_address2`, `customerbilling_city`, `customerbilling_state`, `customerbilling_country`, `customerbilling_zip`, `shipping_address1`, `shipping_address2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip`, `status`, `customer_date`) VALUES
(1, 'sourabh', '8770065415', 'kumawatsourabh1323@gmail.com', '43 awantipura ujjain&quot;', '43 awantipura ujjain&quot;', 'india.', 'M.P..', 'india.', 456005, 'indore gate ujjain', 'indore date Ujjain s', 'Indias ', 'M.P.s ', 'india', 456004, 0, '2023-10-11 12:31:40'),
(4, 'sss', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, '2023-10-13 20:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(4) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_address` varchar(250) NOT NULL,
  `shiping_address` varchar(255) NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip` int(6) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `shiping_city` varchar(20) NOT NULL,
  `shiping_state` varchar(20) NOT NULL,
  `shiping_country` varchar(50) NOT NULL,
  `shiping_zip` int(6) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(4) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`id`, `order_id`, `product_id`, `product_name`, `product_image`, `category`, `customer_name`, `customer_address`, `shiping_address`, `city`, `state`, `country`, `zip`, `order_date`, `shiping_city`, `shiping_state`, `shiping_country`, `shiping_zip`, `price`, `quantity`, `status`) VALUES
(1, 0, 0, 'laptop hp 7th gen  ', 'image1.png', 'Electronic', 'sourabh kumawat', '43 awantipira ', 'Rajiv Gandhi indore  ', 'ujjain', 'mp', 'india', 456006, '2023-10-14', 'indore', 'indore', 'india', 456006, 10.00, 2, 2),
(2, 2, 0, '', '', '', '', '', '', '', '', '', 0, '2023-10-14', '', '', '', 0, 0.00, 0, 2),
(3, 0, 0, 'kkk', '', '', '', '', '', '', '', '', 0, '2023-09-12', '', '', '', 0, 0.00, 0, 1),
(4, 0, 0, 'sourabh', '', '', '', '', '', '', '', '', 0, '2022-10-16', '', '', '', 0, 0.00, 0, 0),
(5, 0, 0, '', '', '', '', '', '', '', '', '', 0, '2023-10-03', '', '', '', 0, 0.00, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `media_master`
--

CREATE TABLE `media_master` (
  `product_image` int(4) NOT NULL,
  `product_id` int(4) NOT NULL,
  `image_path` varchar(225) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `main` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_master`
--

INSERT INTO `media_master` (`product_image`, `product_id`, `image_path`, `image_name`, `status`, `main`) VALUES
(246, 0, 'images/phone.jpg', '', 0, 0),
(247, 0, 'images/shirt.jpg', '', 0, 0),
(248, 0, 'images/shirt.jpg', '', 0, 0),
(249, 0, 'images/tshit.jpg', '', 0, 0),
(250, 216, 'images/phone.jpg', '', 0, 0),
(251, 216, 'images/shirt.jpg', '', 0, 0),
(252, 216, 'images/shirt.jpg', '', 0, 0),
(253, 216, 'images/tshit.jpg', '', 0, 0),
(298, 219, 'images/Electronic-Devices-1.jpg', '', 0, 0),
(299, 219, 'images/phone.jpg', '', 0, 0),
(313, 204, 'images/shirt.jpg', '', 0, 0),
(314, 217, 'images/phone.jpg', '', 0, 0),
(327, 208, 'images/71KjTSO8M9L._SX569_.jpg', '', 0, 0),
(330, 221, 'images/71KjTSO8M9L._SX569_.jpg', '71KjTSO8M9L._SX569_.jpg', 0, 0),
(331, 222, 'images/71KjTSO8M9L._SX569_.jpg', '71KjTSO8M9L._SX569_.jpg', 0, 0),
(332, 223, 'images/71KjTSO8M9L._SX569_.jpg', '71KjTSO8M9L._SX569_.jpg', 0, 0),
(333, 234, 'images/71KjTSO8M9L._SX569_.jpg', '71KjTSO8M9L._SX569_.jpg', 0, 0),
(334, 235, 'images/61VVef0Y5OL._SX569_.jpg', '61VVef0Y5OL._SX569_.jpg', 0, 0),
(336, 241, 'images/71KjTSO8M9L._SX569_.jpg', '71KjTSO8M9L._SX569_.jpg', 0, 0),
(337, 246, 'images/61VVef0Y5OL._SX569_.jpg', '61VVef0Y5OL._SX569_.jpg', 0, 0),
(338, 246, 'images/71KjTSO8M9L._SX569_.jpg', '71KjTSO8M9L._SX569_.jpg', 0, 0),
(339, 247, 'images/Ecommerce Admin-Order Management (3).jpg', 'Ecommerce Admin-Order Management (3).jpg', 0, 0),
(340, 247, 'images/Ecommerce Admin-User Management (1).jpg', 'Ecommerce Admin-User Management (1).jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(4) NOT NULL,
  `order_id` int(4) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `delivary_address` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_id`, `product_name`, `delivary_address`, `order_date`, `price`, `status`) VALUES
(1, 0, 'mobiles', 'sourabh', '2023-10-24', 25.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(4) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `product_description` tinytext NOT NULL,
  `category_id` int(4) NOT NULL,
  `subcategory_id` int(4) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_discount` float(10,2) NOT NULL,
  `product_quantity` int(2) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `launch_date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `category_id`, `subcategory_id`, `product_image`, `product_price`, `product_discount`, `product_quantity`, `sku`, `launch_date`, `status`) VALUES
(204, 'Noise Halo Plus Elite Edition Smartwatch with 1.46\" Super AMOLED Display, Stainless Steel Finish Metallic Straps, 4-Stage Sleep Tracker, Smart Watch for Men and Women (Elite Silver)', 'sssssssddddff', 0, 2, 'phone.jpg', 50000.00, 0.00, 12, 'saskjaskl', '2023-10-04', 0),
(206, 'Noise Halo Plus Elite Edition Smartwatch ', '<ul>\r\n	<li>1.46 inches (3.7cms) AMOLED display, 466*466px, Always on display - Yes - Enjoy clear and immersive visuals on its round AMOLED display.</li>\r\n	<li>Up to 7-day battery life - Get up to 7 days of battery life &amp; up to 2 days of power with cal', 4, 2, 'Ecommerce Admin-Product Management (1) (7).jpg', 50.00, 20.00, 1, 'skassal', '2023-10-08', 0),
(207, 'ssourabh', 'eee', 110, 160, '61VVef0Y5OL._SX569_.jpg', 4000.00, 0.00, 1, 'eee', '2023-10-10', 0),
(208, 's', 'www', 60, 2, '61VVef0Y5OL._SX569_.jpg', 2333.00, 0.00, 333, 'ewew', '2023-10-10', 1),
(210, 'sss', '', 2, 63, 'phone.jpg', 500.00, 120.00, 0, '', '1970-01-01', 0),
(211, '', '', 2, 2, 'shirt.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(212, '', 'sss', 2, 2, 'Electronic-Devices-1.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(213, '', '', 2, 2, 'Electronic-Devices-1.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(214, '', '', 2, 2, 'Electronic-Devices-1.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(217, '', '', 0, 2, 'Electronic-Devices-1.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(219, 'sss', 'sss', 2, 2, 'Ecommerce Admin-Product Management (1) (4).jpg', 50000.00, 0.00, 55, 'dskjdskj', '2023-10-17', 0),
(220, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(221, '', '', 2, 95, 'images/61VVef0Y5OL._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(222, '', '', 2, 95, 'images/61VVef0Y5OL._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(223, '', '', 2, 95, 'images/61VVef0Y5OL._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(224, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(225, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(226, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(227, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(228, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(229, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(230, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(231, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(232, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(233, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '1970-01-01', 0),
(234, 'sss', '', 2, 95, 'images/61VVef0Y5OL._SX569_.jpg', 1000.00, 0.00, 0, '', '2023-10-23', 0),
(235, 'sss', 'sss', 2, 95, 'images/human_feeding_the_little_squirrel (Original) (1).mp4', 100.00, 0.00, 1, 'sss', '2023-10-23', 1),
(236, 'sss', 'www', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 10000.00, 0.00, 0, '', '2023-10-15', 0),
(237, 'sourabh', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 500.00, 12.00, 0, '', '2023-10-18', 0),
(238, '', '', 2, 95, 'images/71KjTSO8M9L._SX569_.jpg', 0.00, 0.00, 0, '', '2023-10-02', 0),
(239, 'eee', 'ee', 2, 95, 'images/011e05f4-6bcb-45f8-8212-441a7d28c3f7._CR0,458,1920,1005_SX430_QL70_.jpg', 500.00, 0.00, 0, '', '2023-10-15', 0),
(240, '3333', '333', 2, 95, 'images/61VVef0Y5OL._SX569_.jpg', 10.00, 500.00, 0, '', '2023-10-04', 0),
(241, 'sss', '', 2, 95, 'images/61VVef0Y5OL._SX569_.jpg', 66.00, 0.00, 0, '', '2023-10-24', 1),
(242, 'ss', '', 2, 95, 'images/Ecommerce Admin-Product Management (1) (6).jpg', 3.00, 0.00, 0, '', '2023-10-08', 0),
(243, 'sss', '', 2, 95, 'images/Ecommerce Admin-Product Management (1) (6).jpg', 12.00, 1.00, 0, '', '2023-10-15', 0),
(244, 'sss', '', 2, 63, 'images/Ecommerce Admin-Product Management (1) (6).jpg', 10.00, 1.00, 0, '', '2023-10-02', 0),
(245, 'sourabh', 'eee', 2, 95, 'images/Ecommerce Admin-User Management (1).jpg', 5000.00, 100.00, 3, '3ewew', '2023-10-08', 0),
(246, 'sourabh', '33', 163, 168, 'images/Ecommerce Admin-Product Management (1) (5).jpg', 33.00, 3.00, 333, '33', '1970-01-01', 0),
(247, 'computer ', 'sss', 2, 95, 'images/Ecommerce Admin-Product Management (1) (7).jpg', 100.00, 100.00, 5, '211', '1970-01-01', 0),
(248, 'ss', '5554', 2, 95, 'images/Ecommerce Admin-Category management (4).jpg', 100.00, 10.00, 2, 'ded', '1970-01-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(120) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `username`, `email`, `password`) VALUES
(25, '', '', 'sourabh134423@gmail.com', '90v0Dxxd7LfseR2L9ut9Qg=='),
(26, '', '', 'test@gmail.com', '1tv1cAnAzAOmBL33/7yRkg=='),
(27, '', '', 'test@gmail.com', 'HiVi82Om2bICjipYPedJIQ=='),
(28, '', '', 'test1@gmail.com', 'uJCVNqm5ybrLSIivGOC20g=='),
(29, '', '', 'test1@gmail.com', 'B1cWx3aJiDjb8gOmn5tguA=='),
(30, '', '', 'test3@gmail.com', 'B1cWx3aJiDjb8gOmn5tguA=='),
(31, '', '', 'test4@gmail.com', 'A4N9MrAWbxqK31QG6w/iBQ=='),
(32, '', '', 'test5@gmail.com', 'TfSOFd6baXFvpPzceohYIQ=='),
(33, '', '', 'sd@gmail.com', 'L3H34WVFC2iPGzzk0k3udQ=='),
(34, '', '', 'sd@gmail.com', 'jmk82x3OF3X50T1DG7baew=='),
(35, '', '', 'df@gmail.com', 'JfUO9C/5XtxYtsDJYXa+3A=='),
(36, '', '', 'sourabh123@gmail.com', 'F27WNOy0hxG9G6+0VvSY7g==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`),
  ADD KEY `parent_category_id` (`parent_category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_master`
--
ALTER TABLE `media_master`
  ADD PRIMARY KEY (`product_image`),
  ADD KEY `product` (`product_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media_master`
--
ALTER TABLE `media_master`
  MODIFY `product_image` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
