-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2016 at 09:26 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

drop database queroumiphone_sys_db;
create database queroumiphone_sys_db;
use queroumiphone_sys_db;

--
-- Database: `queroumiphone_sys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(200) NOT NULL,
  `client_cpf` varchar(11) NOT NULL,
  `client_birthday` datetime NOT NULL,
  `client_created_at` datetime NOT NULL,
  `client_updated_at` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_email_UNIQUE` (`client_email`),
  UNIQUE KEY `client_cpf_UNIQUE` (`client_cpf`),
  KEY `fk_client_user_idx` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_client_user` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
