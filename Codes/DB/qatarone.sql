-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2014 at 07:48 PM
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
-- Table structure for table `advertisment`
--

CREATE TABLE IF NOT EXISTS `advertisment` (
  `advertisment_id` int(11) NOT NULL,
  PRIMARY KEY (`advertisment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `fixedads`
--

CREATE TABLE IF NOT EXISTS `fixedads` (
  `fixedads_id` int(11) NOT NULL AUTO_INCREMENT,
  `fixedads_type` int(2) NOT NULL,
  `fixedads_imageurl` varchar(100) NOT NULL,
  `fixedads_enetredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fixedads_enteredBy` int(10) NOT NULL,
  `fixedads_status` int(1) NOT NULL,
  PRIMARY KEY (`fixedads_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fixedads`
--

INSERT INTO `fixedads` (`fixedads_id`, `fixedads_type`, `fixedads_imageurl`, `fixedads_enetredDate`, `fixedads_enteredBy`, `fixedads_status`) VALUES
(1, 0, '', '2014-11-16 18:30:00', 0, 0),
(2, 0, '', '0000-00-00 00:00:00', 0, 0),
(3, 0, '', '0000-00-00 00:00:00', 0, 0),
(4, 0, '', '0000-00-00 00:00:00', 0, 0),
(5, 0, '', '0000-00-00 00:00:00', 0, 0),
(6, 0, '', '2014-11-16 18:30:00', 0, 0),
(7, 0, '', '2014-11-16 18:30:00', 0, 0),
(8, 0, '', '2014-11-16 18:30:00', 0, 0),
(9, 0, '', '2014-11-16 18:30:00', 0, 0),
(10, 0, '', '2014-11-16 18:30:00', 0, 0),
(11, 0, '', '2014-11-16 18:30:00', 0, 0),
(12, 0, '', '2014-11-16 18:30:00', 0, 0),
(13, 0, '', '2014-11-16 18:30:00', 0, 0),
(14, 0, '', '2014-11-16 18:30:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `job_id` int(11) NOT NULL,
  `job_phoneno1` varchar(20) NOT NULL,
  `job_phoneno2` varchar(20) NOT NULL,
  `job_phoneno_display` varchar(1) NOT NULL,
  `job_locationid` int(11) NOT NULL,
  `job_cityid` int(11) NOT NULL,
  `job_imageurl` varchar(100) NOT NULL,
  `job_jobtype` varchar(10) NOT NULL,
  `job_jobcompanywebsite` varchar(50) NOT NULL,
  `job_jobapplyvia` varchar(20) NOT NULL,
  `job_salary` decimal(10,0) NOT NULL,
  `job_salarytype` varchar(20) NOT NULL,
  `job_salarynegotiable` varchar(20) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` varchar(1000) NOT NULL,
  `job_rating_like` int(11) NOT NULL,
  `job_rating_dislike` int(11) NOT NULL,
  `rating_commentid` int(11) NOT NULL,
  `job_entereddate` datetime NOT NULL,
  `job_eneteredby` varchar(10) NOT NULL,
  `job_approvedstatus` varchar(10) NOT NULL,
  `job_status` varchar(10) NOT NULL,
  `job_categorysubid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `user_password` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_fullname` varchar(200) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_country` varchar(50) NOT NULL,
  `user_address1` varchar(100) NOT NULL,
  `user_address2` varchar(100) NOT NULL,
  `user_telephoneno1` varchar(20) NOT NULL,
  `user_telephoneno2` varchar(20) NOT NULL,
  `user_imageurl` varchar(50) NOT NULL,
  `user_entereddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_type` varchar(3) NOT NULL,
  `user_status` varchar(1) NOT NULL,
  `user_paymentstatus` varchar(1) NOT NULL,
  `user_category` varchar(20) NOT NULL,
  `user_profiletype` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_fullname`, `user_city`, `user_country`, `user_address1`, `user_address2`, `user_telephoneno1`, `user_telephoneno2`, `user_imageurl`, `user_entereddate`, `user_type`, `user_status`, `user_paymentstatus`, `user_category`, `user_profiletype`) VALUES
(1, 'sdf', 'sdf', 'sdf', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '', '', '', ''),
(2, 'xcc', 'xcvxcv', 'xcvxcv', '', '', '', '', '', '', '', '', '2014-11-18 18:05:08', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
