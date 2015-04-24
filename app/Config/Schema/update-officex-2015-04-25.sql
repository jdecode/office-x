-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2015 at 04:35 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `officex`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Marketing', 1, '2015-01-25 09:29:36', '2015-04-25 03:56:43'),
(2, 'Sales', 0, '2015-01-25 09:29:47', '2015-01-25 12:20:13'),
(3, 'Documents Collection', 1, '2015-01-25 09:30:22', '2015-01-25 09:30:22'),
(5, 'Test', 0, '2015-04-25 04:05:39', '2015-04-25 04:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `filename` varchar(64) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `modified` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE IF NOT EXISTS `folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(4) NOT NULL DEFAULT '0' COMMENT '1 => All, 2 => Staff, 3 => Client',
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '1=> active 0=> inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `user_id`, `type`, `status`) VALUES
(1, 'Inbox', 1, 1, 1),
(2, 'Sent', 1, 1, 1),
(3, 'Drafts', 1, 1, 1),
(19, 'Invoices', 1, 3, 1),
(20, 'Quotation', 1, 3, 1),
(21, 'HSE Update', 1, 3, 1),
(22, 'Project Picture and Progress', 1, 3, 1),
(23, 'Others', 1, 3, 1),
(24, 'Received', 1, 2, 1),
(25, 'Sent', 1, 2, 1),
(26, 'Uploaded by Scan', 1, 2, 1),
(27, 'Shared', 1, 2, 1),
(28, 'Self(Personal)', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'admin', NULL, NULL),
(2, 'staff', NULL, NULL),
(3, 'client', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL DEFAULT '0',
  `user2id` int(8) NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8 NOT NULL,
  `folder_id` int(8) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '0' COMMENT '0 => Normal, 1=> deleted by sender, 2 => deleted by received, 3 => deleted by both, 4 => draft',
  `document_id` int(8) NOT NULL DEFAULT '0',
  `modified` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `group_id` int(11) NOT NULL,
  `department_id` int(8) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `group_id`, `department_id`, `created`, `modified`, `status`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 'Admin', 1, 0, '2012-04-08 15:26:09', '2015-03-04 06:01:01', 1),
(2, 'client', 'd2a04d71301a8915217dd5faf81d12cffd6cd958', 'client@client.com', 'Client', 3, 0, '2015-04-08 03:09:17', '2015-04-08 03:09:17', 1),
(3, 'staff', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff@staff.com', 'Staff', 2, 1, '2015-04-08 03:09:43', '2015-04-08 03:09:43', 1),
(6, 'staff1', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff@staff.co1m', 'staff1', 2, 2, '2015-04-25 03:17:24', '2015-04-25 03:17:24', 1),
(7, 'client1', 'd2a04d71301a8915217dd5faf81d12cffd6cd958', 'client1@client.com', 'client1', 3, 0, '2015-04-25 03:23:21', '2015-04-25 03:23:21', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
