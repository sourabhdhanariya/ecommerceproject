-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 03:15 PM
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
(2, 'Electrong', 'Electronics category descriptiondd&nbsp;Electronics category descriptionddElectronics category descriptionddElectronics category descriptionddElectronics category descriptionddElectronics category descriptionddElectronics category descriptionddElectronics', 'images/WhatsApp Image 2023-06-29 at 11.12.13 AM.jpeg', 108, 0),
(4, 'Historical Fiction', 'Books category description', 'images/admin.png', 4, 0),
(20, 'laptop', 'aa', 'aa', 2, 0),
(59, 'tshit', 'good', 'images/icons8-no-camera-48.png', NULL, 0),
(60, 'men', 'hiii', 'images/pexels-tim-douglas-6567607.jpg', 59, 0),
(63, 'Books', 'Historical fiction is a literary genre in which a fictional plot takes place in the setting of particular real historical events', 'images/books.jpg', 4, 0),
(95, 'Electronics', 'Electronics products', '/images/electronics.jpg', NULL, 0),
(96, 'Clothing', 'Clothing and Apparel', '/images/clothing.jpg', NULL, 0),
(97, 'Phones', 'Mobile Phones', '/images/phones.jpg', NULL, 0),
(98, 'Laptops', 'Laptop Computers', '/images/laptops.jpg', NULL, 0),
(99, 'Men\'s Clothing', 'Men\'s Apparel', '/images/mens_clothing.jpg', NULL, 0),
(108, 'Home & Furniture', 'Furniture and Home Decor', '/images/home_furniture.jpg', NULL, 0),
(109, 'Appliances', '            Kitchen and Home Appliances    ', 'images/hospitality-3793946_1280.jpg', 112, 1),
(110, 'Bedroom', 'Clothing (also known as clothes, garments, dress, apparel, or attire) is&nbsp;<strong>any item worn on the body</strong>. Typically, clothing is made of fabrics or textiles, but over time it has included garments made from animal skin and other thin sheet', 'images/beautiful-second-hand-market.jpg', 96, 0),
(111, 'Living Room', 'Living Room Furniture', '/images/living_room.jpg', NULL, 0),
(112, 'Refrigerators', 'Refrigerators and Coolers', '/images/refrigerators.jpg', NULL, 0),
(113, 'Ovens', 'Ovens and Stoves', '/images/ovens.jpg', NULL, 0),
(114, 'Dresses', 'Women\'s Dresses', '/images/dresses.jpg', NULL, 0),
(115, 'Shirts', 'Men\'s Shirts', '/images/shirts.jpg', NULL, 0),
(124, 'test1', 'dsdss', 'images/beautiful-second-hand-market.jpg', 2, 0),
(125, 'sss', 'ddasdas', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(126, 'ss', 'sss', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(127, 'sassa', 'ddasdas', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(128, 'test3', 'sss', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(129, 'test4', 'dsdds', 'images/beautiful-second-hand-market.jpg', 20, 0),
(131, 'ddasdasdas', 'sss', 'images/icons8-notification (2).gif', 2, 0),
(132, 'testing1', 'dd', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(133, 'testing1234', 'sas', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(134, 'dsasddasas', 'dsds', 'images/istockphoto-1397850285-1024x1024.jpg', 114, 0),
(135, 'ddsdas', 'dsds', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(137, '123', 'dsdd', 'images/istockphoto-1397850285-1024x1024.jpg', 2, 0),
(138, 'dsdsds', 'dsssa', 'images/istockphoto-1397850285-1024x1024.jpg', 112, 0),
(140, 'ssasklskl', 'slekldkld', 'images/WhatsApp Image 2023-06-29 at 11.12.13 AM.jpeg', 2, 0),
(141, 'sourabh123', 'ss', 'images/pexels-essow-k-936722.jpg', 2, 0),
(142, 'skskj', 'ds', 'images/WhatsApp Image 2023-10-01 at 5.07.02 PM.jpeg', 2, 0),
(143, 'kumawat123', 'sjjskjskj', 'images/pexels-essow-k-936722.jpg', 2, 0),
(144, 'slsklkdkld', 'skkddkl', 'images/pexels-essow-k-936722.jpg', 2, 0),
(146, 'd', '', 'images/pexels-essow-k-936722.jpg', 2, 0),
(148, 'dldslksdkl', 'dklkdlkld', 'images/pexels-essow-k-936722.jpg', 2, 0),
(149, 'books123', 'ss', 'images/Ecommerce Admin-Product Management (1) (1).jpg', 111, 0),
(151, 'c++', 'ss', 'images/Ecommerce Admin-Product Management (1) (2).jpg', 149, 0),
(153, 'ddsasas', 'dsds', 'images/Ecommerce Admin-Product Management (1) (2).jpg', 2, 0),
(154, 'ssssss', 'ss', 'images/icons8-trash-60.png', 2, 0),
(155, 'dsdss', 'sss', 'images/Ecommerce Admin-Product Management (9).jpg', 2, 0),
(156, 'ssss', 'sss', 'images/icons8-delete-button-64.png', 2, 0),
(157, 'dfddasds', 'dsds', 'images/Ecommerce Admin-Product Management (1) (2).jpg', 2, 0),
(159, 'mobile', 'sss', 'images/Ecommerce Admin-Product Management (9).jpg', 2, 0);

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
(190, 202, 'images/pexels-christina-petsos-11568775 (1).jpg', 'pexels-christina-petsos-11568775 (1).jpg', 0, 0),
(191, 202, 'images/pexels-kei-photo-2741457 (1).jpg', 'pexels-kei-photo-2741457 (1).jpg', 0, 0),
(192, 202, 'images/pexels-kei-photo-2741457.jpg', 'pexels-kei-photo-2741457.jpg', 0, 0),
(193, 203, 'images/pexels-christina-petsos-11568775 (1).jpg', 'pexels-christina-petsos-11568775 (1).jpg', 0, 0),
(194, 203, 'images/pexels-kei-photo-2741457 (1).jpg', 'pexels-kei-photo-2741457 (1).jpg', 0, 0),
(195, 203, 'images/pexels-kei-photo-2741457.jpg', 'pexels-kei-photo-2741457.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(4) NOT NULL,
  `product_title` varchar(20) NOT NULL,
  `product_description` tinytext NOT NULL,
  `category_id` int(4) NOT NULL,
  `subcategory_id` int(4) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_quantity` int(2) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `launch_date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `category_id`, `subcategory_id`, `product_image`, `product_price`, `product_quantity`, `sku`, `launch_date`, `status`) VALUES
(204, 'sourabh kumawat ', 'sssssss', 99, 149, 'images/Ecommerce Admin-Category management (3).jpg', 50000.00, 12, 'saskjaskl', '2023-10-04', 1);

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
-- Indexes for table `media_master`
--
ALTER TABLE `media_master`
  ADD PRIMARY KEY (`product_image`),
  ADD KEY `product` (`product_id`);

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
  MODIFY `category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `media_master`
--
ALTER TABLE `media_master`
  MODIFY `product_image` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

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
