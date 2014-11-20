-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2014 at 06:28 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qatarone`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_images`
--

CREATE TABLE IF NOT EXISTS `advertisement_images` (
  `advertisement_imageId` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_id` int(11) NOT NULL,
  `advertisement_image` varchar(255) NOT NULL,
  PRIMARY KEY (`advertisement_imageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `advertisment`
--

CREATE TABLE IF NOT EXISTS `advertisment` (
  `advertisment_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_categoryId` int(5) NOT NULL,
  `advertisement_subCategoryId` int(5) NOT NULL,
  `advertisement_attributes` longtext NOT NULL,
  `advertisement_title` varchar(255) NOT NULL,
  `advertisement_description` longtext NOT NULL,
  `advertisement_price` decimal(10,0) NOT NULL,
  `advertisement_contactName` varchar(255) NOT NULL,
  `advertisement_contactNo` varchar(20) NOT NULL,
  `advertisement_contactEmail` varchar(100) NOT NULL,
  `advertisement_location` int(5) NOT NULL,
  `advertisement_suburb` int(5) NOT NULL,
  `advertisement_googleCodes` varchar(20) NOT NULL,
  `advertisement_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `advertisement_status` int(1) NOT NULL,
  `advertisement_expire` datetime NOT NULL,
  PRIMARY KEY (`advertisment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(5) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) NOT NULL,
  `category_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_enteredBy` int(11) NOT NULL,
  `category_status` int(1) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categoryattributes`
--

CREATE TABLE IF NOT EXISTS `categoryattributes` (
  `attribute_id` int(4) NOT NULL AUTO_INCREMENT,
  `attribute_categoryId` int(4) NOT NULL,
  `attributes` longtext NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_sub`
--

CREATE TABLE IF NOT EXISTS `category_sub` (
  `category_sub_id` int(4) NOT NULL AUTO_INCREMENT,
  `category_sub_name` varchar(250) NOT NULL,
  `category_sub_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_sub_enteredBy` int(5) NOT NULL,
  `category_sub_status` int(1) NOT NULL,
  `category_sub_parentId` int(4) NOT NULL,
  PRIMARY KEY (`category_sub_id`),
  KEY `category_sub_id` (`category_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `evenet_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_shortDescription` varchar(255) NOT NULL,
  `event_description` longtext NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `event_status` int(1) NOT NULL,
  PRIMARY KEY (`evenet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fixedads`
--

CREATE TABLE IF NOT EXISTS `fixedads` (
  `fixedads_id` int(11) NOT NULL AUTO_INCREMENT,
  `fixedads_type` int(2) NOT NULL,
  `fixedads_image` varchar(255) NOT NULL,
  `fixedads_enetredDate` datetime NOT NULL,
  `fixedads_url` varchar(255) NOT NULL,
  `fixedads_status` int(1) NOT NULL,
  PRIMARY KEY (`fixedads_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(5) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) NOT NULL,
  `location_cordinates` varchar(20) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `packagetypes`
--

CREATE TABLE IF NOT EXISTS `packagetypes` (
  `package_id` int(2) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(100) NOT NULL,
  `package_Description` longtext NOT NULL,
  `package_price` decimal(10,0) NOT NULL,
  `package_adLimit` int(2) NOT NULL,
  `package_addedBy` int(3) NOT NULL,
  `package_status` int(1) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pagecontent`
--

CREATE TABLE IF NOT EXISTS `pagecontent` (
  `pageContent_id` int(1) NOT NULL AUTO_INCREMENT,
  `pageContent_pageId` int(1) NOT NULL,
  `pageContent_pageTitle` varchar(100) NOT NULL,
  `pageContent_Description` longtext NOT NULL,
  `pageContent_lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pageContent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(2) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) NOT NULL,
  `page_status` int(1) NOT NULL,
  `page_addedBy` int(2) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `slider_id` int(10) NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(100) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_url` int(255) NOT NULL,
  `slider_status` int(1) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suburbs`
--

CREATE TABLE IF NOT EXISTS `suburbs` (
  `suburb_id` int(5) NOT NULL AUTO_INCREMENT,
  `suburb_location_id` int(5) NOT NULL,
  `suburb_name` varchar(100) NOT NULL,
  `suburb_cordinates` varchar(20) NOT NULL,
  PRIMARY KEY (`suburb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_address1` varchar(255) NOT NULL,
  `user_address2` varchar(255) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_contactNo` varchar(15) NOT NULL,
  `user_registeredDate` datetime NOT NULL,
  `user_type` int(1) NOT NULL,
  `user_status` int(1) NOT NULL,
  `user_accessToken` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_firstname`, `user_lastname`, `user_address1`, `user_address2`, `user_city`, `user_contactNo`, `user_registeredDate`, `user_type`, `user_status`, `user_accessToken`) VALUES
(1, 'dhammika', 'test', 'dhammika97@gmail.com', 'dhammika', 'gunaratne', '176/4, walatenna', 'gallellagama', 'kandy', '777339803', '2014-11-20 00:00:00', 1, 0, 'teskjsjjdfshdfhsdbfjhsbdfsdfsf');

-- --------------------------------------------------------

--
-- Table structure for table `userpackge`
--

CREATE TABLE IF NOT EXISTS `userpackge` (
  `userpkg_id` int(11) NOT NULL AUTO_INCREMENT,
  `userpkg_userId` int(11) NOT NULL,
  `userpkg_pkgId` int(11) NOT NULL,
  `userpkg_expirey` date NOT NULL,
  `userpkg_status` int(1) NOT NULL,
  PRIMARY KEY (`userpkg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
