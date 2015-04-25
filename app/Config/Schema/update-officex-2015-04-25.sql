-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2015 at 08:39 AM
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
  `message_id` int(8) NOT NULL DEFAULT '0',
  `name` text CHARACTER SET utf8 NOT NULL,
  `filename` varchar(64) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `modified` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `message_id`, `name`, `filename`, `title`, `status`, `modified`, `created`) VALUES
(1, 40, '11136235_795111837246572_2492016457494034586_o.jpg', 'c1417788bfffa7d0ef983388eae46ca4554cf162.jpg', '11136235_795111837246572_2492016457494034586_o.jpg', 1, 1429929635, 1429929635),
(2, 40, '11074307_795106563913766_1974788765776105981_o.jpg', 'de2429892c5bda975a72d597e849c23cfa63deb6.jpg', '11074307_795106563913766_1974788765776105981_o.jpg', 1, 1429929635, 1429929635),
(3, 40, '11072337_794230964001326_3406627774466798488_o.jpg', '7b1a20f4bc8d0c69ac5240b3fdca6991510f8acb.jpg', '11072337_794230964001326_3406627774466798488_o.jpg', 1, 1429929635, 1429929635),
(4, 40, '11015656_852202671493313_1996546185_n.jpg', '5e5ef4c8b31c975a3d19d4d8f58dbb99ec0110be.jpg', '11015656_852202671493313_1996546185_n.jpg', 1, 1429929635, 1429929635),
(5, 41, '11149608_896856683691584_4352970284522865110_o.jpg', 'ec9fae5ee1abaf9770017621c9634d3f7ab9ab39.jpg', '11149608_896856683691584_4352970284522865110_o.jpg', 1, 1429929745, 1429929745),
(6, 41, '11146346_896853550358564_7753765832477494150_o.jpg', '082bc5c430e2e054e72013d3d2203aead57e6c7c.jpg', '11146346_896853550358564_7753765832477494150_o.jpg', 1, 1429929745, 1429929745),
(7, 41, '11041883_896853517025234_372666254274391957_o.jpg', '84224cb76e7022e77121d9aabab606c46600716d.jpg', '11041883_896853517025234_372666254274391957_o.jpg', 1, 1429929745, 1429929745),
(8, 41, '11155126_896849173692335_7722998124013803128_o.jpg', 'f9ec6de58ada1cb0df54269b04bc5a240cb7af05.jpg', '11155126_896849173692335_7722998124013803128_o.jpg', 1, 1429929745, 1429929745);

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
(24, 'Received', 1, 2, 0),
(25, 'Sent', 1, 2, 0),
(26, 'Uploaded by Scan', 1, 2, 1),
(27, 'Shared', 1, 2, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `user2id`, `message`, `folder_id`, `status`, `document_id`, `modified`, `created`) VALUES
(41, 1, 0, 'Draftsss', 0, 0, 0, 1429929745, 1429929745),
(40, 1, 3, 'Document, Check!', 26, 0, 0, 1429929635, 1429929635);

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
