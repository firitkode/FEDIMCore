-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2019 at 08:42 PM
-- Server version: 10.1.37-MariaDB-3
-- PHP Version: 7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `fc_menulocations` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fc_menulocations`
--

INSERT INTO `fc_menulocations` (`id`, `name`, `uri`) VALUES
(1, 'Header Menu', 'header_menu');

-- --------------------------------------------------------

--
-- Table structure for table `fc_menus`
--

CREATE TABLE `fc_menus` (
  `id` int(10) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `itemurl` varchar(500) NOT NULL,
  `itemtarget` varchar(255) NOT NULL,
  `itemclass` varchar(255) NOT NULL,
  `itemorder` int(10) NOT NULL,
  `multiID` int(10) NOT NULL,
  `itemtype` varchar(255) NOT NULL,
  `locationID` int(10) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `fc_pages` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `PageName` varchar(255) NOT NULL,
  `PageDesc` varchar(500) NOT NULL,
  `parent` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `Use_Header` enum('yes','no') NOT NULL,
  `Header_Image` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fc_pages`
--

INSERT INTO `fc_pages` (`id`, `title`, `PageName`, `PageDesc`, `parent`, `content`, `Use_Header`, `Header_Image`, `status`) VALUES
(1, 'Test Page', 'test', 'A test page from the database', '', '<!--<div class=\"section text-center\">     <div class=\"container\">         <h2 class=\"title\">A Light Section</h2>         <div class=\"row\">             <div class=\"col-md-8 ml-auto mr-auto\">              </div>         </div>         <br/><br/>         <div class=\"row\">             <div class=\"col-md-3\">              </div>             <div class=\"col-md-3\">              </div>             <div class=\"col-md-3\">              </div>             <div class=\"col-md-3\">              </div>         </div>      </div> </div>-->  <div class=\"section section-dark text-center\">     <div class=\"container\">         <h2 class=\"title\">A Dark Section</h2>         <div class=\"row\">             <div class=\"col-md-12\">                 <p>I am a test page loaded from the database. Good stuff!</p>             </div>         </div>     </div> </div>  <!--<div class=\"section landing-section text-center\">     <div class=\"container\">         <h2 class=\"title\">A Light Section</h2>         <div class=\"row\">             <div class=\"col-md-8 ml-auto mr-auto\">              </div>         </div>     </div> </div>-->', 'yes', 'bruno-abatti.jpg', 'active'),
(3, 'DB Page Load #1', 'pageloadfromdb', 'Page loaded from DB first level', '', '<!--<div class=\"section text-center\">\n    <div class=\"container\">\n        <h2 class=\"title\">A Light Section</h2>\n        <div class=\"row\">\n            <div class=\"col-md-8 ml-auto mr-auto\">\n\n            </div>\n        </div>\n        <br/><br/>\n        <div class=\"row\">\n            <div class=\"col-md-3\">\n\n            </div>\n            <div class=\"col-md-3\">\n\n            </div>\n            <div class=\"col-md-3\">\n\n            </div>\n            <div class=\"col-md-3\">\n\n            </div>\n        </div>\n\n    </div>\n</div>-->\n\n<div class=\"section section-dark text-center\">\n    <div class=\"container\">\n        <h2 class=\"title\">A Dark Section</h2>\n        <div class=\"row\">\n            <div class=\"col-md-12\">\n                <p>I am a test page loaded from DB. Good stuff!</p>\n            </div>\n        </div>\n    </div>\n</div>\n\n<!--<div class=\"section landing-section text-center\">\n    <div class=\"container\">\n        <h2 class=\"title\">A Light Section</h2>\n        <div class=\"row\">\n            <div class=\"col-md-8 ml-auto mr-auto\">\n\n            </div>\n        </div>\n    </div>\n</div>-->\n', 'yes', 'daniel-olahs.jpg', 'active'),
(4, 'DB Page Load #2', 'pageloadfromdb2', 'Page loaded from DB second level', 'dbtestfolder1/', '<!--<div class=\"section text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Light Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-8 ml-auto mr-auto\">\r\n\r\n            </div>\r\n        </div>\r\n        <br/><br/>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n        </div>\r\n\r\n    </div>\r\n</div>-->\r\n\r\n<div class=\"section section-dark text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Dark Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <p>I am a test page loaded from DB on the 2nd level. Good stuff!</p>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<!--<div class=\"section landing-section text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Light Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-8 ml-auto mr-auto\">\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>-->\r\n', 'yes', 'daniel-olahs.jpg', 'active'),
(5, 'DB Page Load #3', 'pageloadfromdb3', 'Page loaded from DB third level', 'dbtestfolder1/dbtestfolder2/', '<!--<div class=\"section text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Light Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-8 ml-auto mr-auto\">\r\n\r\n            </div>\r\n        </div>\r\n        <br/><br/>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n        </div>\r\n\r\n    </div>\r\n</div>-->\r\n\r\n<div class=\"section section-dark text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Dark Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <p>I am a test page loaded from DB on the 3rd level. Good stuff!</p>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<!--<div class=\"section landing-section text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Light Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-8 ml-auto mr-auto\">\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>-->\r\n', 'yes', 'daniel-olahs.jpg', 'active'),
(6, 'DB Page Load #4', 'pageloadfromdb4', 'Page loaded from DB fourth level', 'dbtestfolder1/dbtestfolder2/dbtestfolder3/', '<!--<div class=\"section text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Light Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-8 ml-auto mr-auto\">\r\n\r\n            </div>\r\n        </div>\r\n        <br/><br/>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n            <div class=\"col-md-3\">\r\n\r\n            </div>\r\n        </div>\r\n\r\n    </div>\r\n</div>-->\r\n\r\n<div class=\"section section-dark text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Dark Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <p>I am a test page loaded from DB on the 4th level. Good stuff!</p>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<!--<div class=\"section landing-section text-center\">\r\n    <div class=\"container\">\r\n        <h2 class=\"title\">A Light Section</h2>\r\n        <div class=\"row\">\r\n            <div class=\"col-md-8 ml-auto mr-auto\">\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>-->\r\n', 'yes', 'daniel-olahs.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `fc_settings`
--

CREATE TABLE `fc_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fc_settings`
--

INSERT INTO `fc_settings` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'FEDIM Core'),
(2, 'site_slogan', 'A content management system (CMS) designed to be one-of-a-kind. Stands for Fantastic Engine Designed In Magic'),
(4, 'theme_name', 'Fenix2019');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fc_menulocations`
--
ALTER TABLE `fc_menulocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fc_menus`
--
ALTER TABLE `fc_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fc_pages`
--
ALTER TABLE `fc_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fc_settings`
--
ALTER TABLE `fc_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fc_menulocations`
--
ALTER TABLE `fc_menulocations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fc_menus`
--
ALTER TABLE `fc_menus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `fc_pages`
--
ALTER TABLE `fc_pages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fc_settings`
--
ALTER TABLE `fc_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
