-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2019 at 11:11 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fedimcore_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `fc_menulocations`
--

DROP TABLE IF EXISTS `fc_menulocations`;
CREATE TABLE IF NOT EXISTS `fc_menulocations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fc_menulocations`
--

INSERT INTO `fc_menulocations` (`id`, `name`, `uri`) VALUES
(1, 'Header Menu', 'header_menu');

-- --------------------------------------------------------

--
-- Table structure for table `fc_menus`
--

DROP TABLE IF EXISTS `fc_menus`;
CREATE TABLE IF NOT EXISTS `fc_menus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(255) NOT NULL,
  `itemurl` varchar(500) NOT NULL,
  `itemtarget` varchar(255) NOT NULL,
  `itemclass` varchar(255) NOT NULL,
  `itemorder` int(10) NOT NULL,
  `multiID` int(10) NOT NULL,
  `itemtype` varchar(255) NOT NULL,
  `locationID` int(10) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fc_menus`
--

INSERT INTO `fc_menus` (`id`, `itemname`, `itemurl`, `itemtarget`, `itemclass`, `itemorder`, `multiID`, `itemtype`, `locationID`, `status`) VALUES
(1, 'Test', 'test', '_self', 'fas fa-info-circle', 1, 0, 'inside', 1, 'active'),
(2, 'Demo Content', '', '', 'fas fa-info-circle', 2, 0, 'multi', 1, 'active'),
(3, '[header]', 'Load From File', '', 'fas fa-info-circle', 1, 2, 'inside-multi', 1, 'active'),
(4, 'Load Page From File', 'pageloadfromfile', '_self', 'fas fa-info-circle', 2, 2, 'inside-multi', 1, 'active'),
(5, 'Load Page From File #2', 'testfolder1/pageloadfromfile2', '_self', 'fas fa-info-circle', 3, 2, 'inside-multi', 1, 'active'),
(6, 'Load Page From File #3', 'testfolder1/testfolder2/pageloadfromfile3', '_self', 'fas fa-info-circle', 4, 2, 'inside-multi', 1, 'active'),
(7, 'Load Page From File #4', 'testfolder1/testfolder2/testfolder3/pageloadfromfile4', '_self', 'fas fa-info-circle', 5, 2, 'inside-multi', 1, 'active'),
(8, '[header]', 'Load from DB', '_self', 'fas fa-info-circle', 6, 2, 'inside-multi', 1, 'active'),
(9, 'Load Page From DB', 'pageloadfromdb', '_self', 'fas fa-info-circle', 7, 2, 'inside-multi', 1, 'active'),
(10, 'Load Page From DB #2', 'dbtestfolder1/pageloadfromdb2', '_self', 'fas fa-info-circle', 8, 2, 'inside-multi', 1, 'active'),
(11, 'Load Page From DB #3', 'dbtestfolder1/dbtestfolder2/pageloadfromdb3', '_self', 'fas fa-info-circle', 9, 2, 'inside-multi', 1, 'active'),
(12, 'Load Page From DB #4', 'dbtestfolder1/dbtestfolder2/dbtestfolder3/pageloadfromdb4', '_self', 'fas fa-info-circle', 10, 2, 'inside-multi', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `fc_pages`
--

DROP TABLE IF EXISTS `fc_pages`;
CREATE TABLE IF NOT EXISTS `fc_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `PageName` varchar(255) NOT NULL,
  `PageDesc` varchar(500) NOT NULL,
  `parent` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `Use_Header` enum('yes','no') NOT NULL,
  `Header_Image` varchar(255) NOT NULL,
  `Use_Parallax` enum('yes','no') NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fc_pages`
--

INSERT INTO `fc_pages` (`id`, `title`, `PageName`, `PageDesc`, `parent`, `content`, `Use_Header`, `Header_Image`, `Use_Parallax`, `status`) VALUES
(1, 'Test Page', 'test', 'A test page from the database', '', '<?php\r\n/*\r\nPage Template : Basic boxed layout\r\nDescription: This template is provided to be used as a basic template\r\nVersion: 1.0.0\r\n*/\r\n?>\r\n\r\n[[sectiondark]]\r\n  [h1][white][textcenter]H1 Title Here[/textcenter][/white][/h1]\r\n    [row]\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n    [/row]\r\n[[/section]]\r\n\r\n[blockcomment]\r\n[[section]]\r\n  [h1][black]Another section[/black][/h1]\r\n  [content]\r\n      [p][black]A paragraph of some sort[/black][/p]\r\n      [p][black]This front page utilizes NCode[]&comma; a parser for PHP.[/black][/p]\r\n  [/content]\r\n[[/section]]\r\n[/blockcomment]\r\n', 'no', 'bruno-abatti.jpg', 'no', 'active'),
(3, 'DB Page Load #1', 'pageloadfromdb', 'Page loaded from DB first level', '', '<?php\r\n/*\r\nPage Template : Basic boxed layout\r\nDescription: This template is provided to be used as a basic template\r\nVersion: 1.0.0\r\n*/\r\n?>\r\n\r\n[[sectiondark]]\r\n  [h1][white][textcenter]H1 Title Here[/textcenter][/white][/h1]\r\n    [row]\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n    [/row]\r\n[[/section]]\r\n\r\n[blockcomment]\r\n[[section]]\r\n  [h1][black]Another section[/black][/h1]\r\n  [content]\r\n      [p][black]A paragraph of some sort[/black][/p]\r\n      [p][black]This front page utilizes NCode[]&comma; a parser for PHP.[/black][/p]\r\n  [/content]\r\n[[/section]]\r\n[/blockcomment]\r\n', 'yes', 'daniel-olahs.jpg', 'no', 'active'),
(4, 'DB Page Load #2', 'pageloadfromdb2', 'Page loaded from DB second level', 'dbtestfolder1/', '<?php\r\n/*\r\nPage Template : Basic boxed layout\r\nDescription: This template is provided to be used as a basic template\r\nVersion: 1.0.0\r\n*/\r\n?>\r\n\r\n[[sectiondark]]\r\n  [h1][white][textcenter]H1 Title Here[/textcenter][/white][/h1]\r\n    [row]\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n    [/row]\r\n[[/section]]\r\n\r\n[blockcomment]\r\n[[section]]\r\n  [h1][black]Another section[/black][/h1]\r\n  [content]\r\n      [p][black]A paragraph of some sort[/black][/p]\r\n      [p][black]This front page utilizes NCode[]&comma; a parser for PHP.[/black][/p]\r\n  [/content]\r\n[[/section]]\r\n[/blockcomment]\r\n', 'yes', 'daniel-olahs.jpg', 'no', 'active'),
(5, 'DB Page Load #3', 'pageloadfromdb3', 'Page loaded from DB third level', 'dbtestfolder1/dbtestfolder2/', '<?php\r\n/*\r\nPage Template : Basic boxed layout\r\nDescription: This template is provided to be used as a basic template\r\nVersion: 1.0.0\r\n*/\r\n?>\r\n\r\n[[sectiondark]]\r\n  [h1][white][textcenter]H1 Title Here[/textcenter][/white][/h1]\r\n    [row]\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n    [/row]\r\n[[/section]]\r\n\r\n[blockcomment]\r\n[[section]]\r\n  [h1][black]Another section[/black][/h1]\r\n  [content]\r\n      [p][black]A paragraph of some sort[/black][/p]\r\n      [p][black]This front page utilizes NCode[]&comma; a parser for PHP.[/black][/p]\r\n  [/content]\r\n[[/section]]\r\n[/blockcomment]\r\n', 'yes', 'daniel-olahs.jpg', 'no', 'active'),
(6, 'DB Page Load #4', 'pageloadfromdb4', 'Page loaded from DB fourth level', 'dbtestfolder1/dbtestfolder2/dbtestfolder3/', '<?php\r\n/*\r\nPage Template : Basic boxed layout\r\nDescription: This template is provided to be used as a basic template\r\nVersion: 1.0.0\r\n*/\r\n?>\r\n\r\n[[sectiondark]]\r\n  [h1][white][textcenter]H1 Title Here[/textcenter][/white][/h1]\r\n    [row]\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n    [/row]\r\n[[/section]]\r\n\r\n[blockcomment]\r\n[[section]]\r\n  [h1][black]Another section[/black][/h1]\r\n  [content]\r\n      [p][black]A paragraph of some sort[/black][/p]\r\n      [p][black]This front page utilizes NCode[]&comma; a parser for PHP.[/black][/p]\r\n  [/content]\r\n[[/section]]\r\n[/blockcomment]\r\n', 'yes', 'daniel-olahs.jpg', 'no', 'active'),
(7, 'FEDIM Core', 'FrontPage', 'The frontpage being loaded from the DB', '', '<?php\r\n/*\r\nPage Template : Basic boxed layout\r\nDescription: This template is provided to be used as a basic template\r\nVersion: 1.0.0\r\n*/\r\n?>\r\n\r\n[[sectiondark]]\r\n  [h1][white][textcenter]H1 Title Here[/textcenter][/white][/h1]\r\n    [row]\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n        [col33]\r\n          [h3][textcenter]H3 Title[/textcenter][/h3]\r\n          [p][white]\r\n              [textjustify]\r\n              Lorem ipsum dolor sit amet&comma; consectetur adipiscing elit. Curabitur pellentesque in lectus ac rhoncus. Mauris faucibus&comma; ante quis porta rhoncus&comma; ipsum dolor pulvinar lectus&comma; nec pharetra odio diam nec ligula. Fusce rutrum sapien orci&comma; a hendrerit elit efficitur sit amet. Curabitur malesuada velit leo&comma; id malesuada magna varius non. Nunc in nisi et lorem viverra porttitor. Mauris laoreet et nibh et venenatis. Vestibulum imperdiet pulvinar metus sed rhoncus.\r\n              [/textjustify]\r\n          [/white][/p]\r\n        [/col]\r\n\r\n    [/row]\r\n[[/section]]\r\n\r\n[blockcomment]\r\n[[section]]\r\n  [h1][black]Another section[/black][/h1]\r\n  [content]\r\n      [p][black]A paragraph of some sort[/black][/p]\r\n      [p][black]This front page utilizes NCode[]&comma; a parser for PHP.[/black][/p]\r\n  [/content]\r\n[[/section]]\r\n[/blockcomment]\r\n', 'yes', 'bruno-abatti.jpg', 'no', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `fc_settings`
--

DROP TABLE IF EXISTS `fc_settings`;
CREATE TABLE IF NOT EXISTS `fc_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fc_settings`
--

INSERT INTO `fc_settings` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'FEDIM Core'),
(2, 'site_slogan', 'A content management system (CMS) designed to be one-of-a-kind. Stands for Fantastic Engine Designed In Magic'),
(4, 'theme_name', 'Fenix2019');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
