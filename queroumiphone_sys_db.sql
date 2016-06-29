-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2016 at 10:14 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `queroumiphone_sys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_status` tinyint(4) NOT NULL,
  `announcement_created_at` datetime NOT NULL,
  `announcement_updated_at` datetime NOT NULL,
  `client` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  PRIMARY KEY (`announcement_id`),
  KEY `fk_announcement_client1_idx` (`client`),
  KEY `fk_announcement_product1_idx` (`product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_parent` int(11) DEFAULT NULL,
  `category_created_at` datetime NOT NULL,
  `category_updated_at` datetime NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_slug_UNIQUE` (`category_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_parent`, `category_created_at`, `category_updated_at`, `category_slug`) VALUES
(1, 'Ae Garotinho', 0, '2016-06-22 16:35:42', '2016-06-22 16:35:42', 'ae-garotinho'),
(2, 'Teste', 4, '2016-06-22 16:35:54', '2016-06-22 16:35:54', 'teste'),
(3, 'Ae Garotinho', 5, '2016-06-22 16:55:14', '2016-06-22 16:55:14', 'ae-garotinho-2'),
(4, 'teste', 1, '2016-06-22 16:56:17', '2016-06-22 16:56:17', 'teste-3'),
(5, 'teste', 2, '2016-06-22 16:56:34', '2016-06-22 16:56:34', 'teste-2');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(200) NOT NULL,
  `client_sexo` tinyint(4) NOT NULL,
  `client_birthday` datetime NOT NULL,
  `client_created_at` datetime NOT NULL,
  `client_updated_at` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `client_facebook` varchar(200) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_email_UNIQUE` (`client_email`),
  UNIQUE KEY `client_cpf_UNIQUE` (`client_sexo`),
  KEY `fk_client_user_idx` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_email`, `client_sexo`, `client_birthday`, `client_created_at`, `client_updated_at`, `user`, `client_facebook`) VALUES
(4, 'Vitor Monteiro de barros', 'vitormonteirodebarros@gmail.com', 0, '2016-06-04 00:00:00', '2016-06-16 17:17:35', '2016-06-16 17:17:35', 4, 'vitorm.barros@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) NOT NULL,
  `product_created_at` datetime NOT NULL,
  `product_updated_at` datetime NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `client` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_photo_1` varchar(255) NOT NULL,
  `product_photo_2` varchar(255) DEFAULT NULL,
  `product_photo_3` varchar(255) DEFAULT NULL,
  `product_photo_4` varchar(255) DEFAULT NULL,
  `product_photo_5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_product_client_idx` (`client`),
  KEY `fk_product_category1_idx` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(200) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_salt` varchar(255) NOT NULL,
  `user_created_at` datetime NOT NULL,
  `user_updated_at` datetime NOT NULL,
  `user_activation_key` varchar(255) NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username_UNIQUE` (`user_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_salt`, `user_created_at`, `user_updated_at`, `user_activation_key`, `user_status`) VALUES
(4, 'vitormonteirodebarros@gmail.com', 'YFrFsvMDRBuD0QR0O1vxqmBwimMmOA3H2O50XzdJSh/2fSARQNJ/2jkVG8dibzPVpl5Tx5XPJBDOr6gw4xtaO01bN62AkeFu66Mm0Zxph/Fa3nI8sfSN7ryheDtyBXq23P4/YFhn+WgkXiBWYf0V//XFMRSQ6u5W', 'ptrVolV/+3Q=', '2016-06-16 17:17:35', '2016-06-16 17:17:35', 'daf07802fafd56a9c826785b818e8bf0', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `fk_announcement_client1` FOREIGN KEY (`client`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_announcement_product1` FOREIGN KEY (`product`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_client_user` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`category`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_client` FOREIGN KEY (`client`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
