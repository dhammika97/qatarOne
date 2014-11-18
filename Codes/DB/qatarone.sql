-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2014 at 06:23 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
  `advertisment_name` varchar(100) NOT NULL,
  `advertisment_mode` varchar(20) NOT NULL,
  `advertisment_phoneno1` varchar(20) NOT NULL,
  `advertisment_phoneno2` varchar(20) NOT NULL,
  `advertisment_phoneno_display` varchar(1) NOT NULL,
  `advertisment_telemarketmode` varchar(20) NOT NULL,
  `advertisment_locationid` int(11) NOT NULL,
  `advertisment_cityid` int(11) NOT NULL,
  `advertisment_title` varchar(200) NOT NULL,
  `advertisment_description` varchar(800) NOT NULL,
  `advertisment_price` decimal(10,0) NOT NULL,
  `advertisment_imageurl` varchar(100) NOT NULL,
  `advertisment_type` varchar(10) NOT NULL,
  `advertisment_for` varchar(10) NOT NULL,
  `advertisment_rating_like` int(11) NOT NULL,
  `advertisment_rating_dislike` int(11) NOT NULL,
  `advertisment_commentid` int(11) NOT NULL,
  `advertisment_entereddate` datetime NOT NULL,
  `advertisment_enteredby` varchar(10) NOT NULL,
  `advertisment_approvedstatus` varchar(10) NOT NULL,
  `advertisment_status` varchar(10) NOT NULL,
  `advertisment_categorysubid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_entereddate` datetime NOT NULL,
  `category_enteredby` varchar(100) NOT NULL,
  `category_status` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_entereddate`, `category_enteredby`, `category_status`) VALUES
(2, 'Van', '2014-11-14 00:00:00', 'usama', 'new'),
(1, 'Car', '2014-11-15 00:00:00', 'usama', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `category_sub`
--

CREATE TABLE IF NOT EXISTS `category_sub` (
  `category_sub_name` varchar(20) NOT NULL,
  `category_sub_entereddate` datetime NOT NULL,
  `category_sub_enteredby` varchar(10) NOT NULL,
  `category_sub_status` varchar(10) NOT NULL,
  `category_sub_categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comments_id` int(11) NOT NULL,
  `comments_description` varchar(100) NOT NULL,
  `comments_enteredtime` datetime NOT NULL,
  `comments_enteredby` varchar(10) NOT NULL,
  `comments_approvedstatus` varchar(10) NOT NULL,
  `comments_status` varchar(10) NOT NULL,
  `comments_advertismentid` int(11) NOT NULL,
  `comments_jobid` int(11) NOT NULL,
  `comments_vehicleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(11) NOT NULL,
  `event_type` varchar(10) NOT NULL,
  `event_description` varchar(100) NOT NULL,
  `event_note` varchar(100) NOT NULL,
  `event_imageurl` varchar(100) NOT NULL,
  `event_videourl` varchar(100) NOT NULL,
  `event_entereddate` datetime NOT NULL,
  `event_enteredby` varchar(10) NOT NULL,
  `event_approvedstatus` varchar(10) NOT NULL,
  `event_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fixedads`
--

CREATE TABLE IF NOT EXISTS `fixedads` (
`fixedads_id` int(11) NOT NULL,
  `fixedads_type` varchar(10) NOT NULL,
  `fixedads_description` varchar(100) NOT NULL,
  `fixedads_note` varchar(100) NOT NULL,
  `fixedads_imageurl` varchar(100) NOT NULL,
  `fixedads_videourl` varchar(100) NOT NULL,
  `fixedads_enetreddate` datetime NOT NULL,
  `fixedads_enteredby` varchar(10) NOT NULL,
  `fixedads_approvedstatus` varchar(10) NOT NULL,
  `fixedads_status` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fixedads`
--

INSERT INTO `fixedads` (`fixedads_id`, `fixedads_type`, `fixedads_description`, `fixedads_note`, `fixedads_imageurl`, `fixedads_videourl`, `fixedads_enetreddate`, `fixedads_enteredby`, `fixedads_approvedstatus`, `fixedads_status`) VALUES
(1, 'type one', 'All the fixed add would come here', 'fixed ad test note', '', '', '2014-11-17 00:00:00', 'test user', 'apprd    ', 'apprd'),
(2, 'TypeA', '', '', '', '', '0000-00-00 00:00:00', '', '', ''),
(3, 'TypeA', 'Test Description', '', '', '', '0000-00-00 00:00:00', '', '', ''),
(4, 'TypeA', 'Test Description', 'Test fixed Ad note', '', '', '0000-00-00 00:00:00', '', '', ''),
(5, 'TypeA', 'Test Description', 'Test fixed Ad note', '', '', '0000-00-00 00:00:00', '', '', ''),
(6, 'TypeA', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', '', ''),
(7, 'TypeA', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', ''),
(8, 'TypeA', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', 'Deleted'),
(9, 'TypeB', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', 'Deleted'),
(10, 'TypeC', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', 'Deleted'),
(11, 'TypeC', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', 'Deleted'),
(12, 'TypeC', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', 'Deleted'),
(13, 'TypeC', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', 'Deleted'),
(14, 'TypecxCcxs', 'Test Description', 'Test fixed Ad note', '', '', '2014-11-17 00:00:00', 'Clifford', 'Approved', 'Deleted');

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
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  `payment_description` varchar(50) NOT NULL,
  `payment_note` varchar(400) NOT NULL,
  `payment_userid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
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
  `user_entereddate` datetime NOT NULL,
  `user_type` varchar(3) NOT NULL,
  `user_status` varchar(1) NOT NULL,
  `user_paymentstatus` varchar(1) NOT NULL,
  `user_category` varchar(20) NOT NULL,
  `user_profiletype` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10004 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_fullname`, `user_city`, `user_country`, `user_address1`, `user_address2`, `user_telephoneno1`, `user_telephoneno2`, `user_imageurl`, `user_entereddate`, `user_type`, `user_status`, `user_paymentstatus`, `user_category`, `user_profiletype`) VALUES
(10001, 'Clifford', 'Clifford 45', 'Regis005', 'Tour Coordinator', 'Regis005', 'Regis005', 'Regis005', 'Regis005', 'Regis005', 'Regis005', 'Regis005', '0000-00-00 00:00:00', 'Reg', 'R', 'R', 'Regis005', 'jkjkj'),
(10002, 'Clifford', 'Clifford 44', 'Regis005', 'Tour Coordinator', 'Regis005', 'Autralia', 'Park view', 'Sydney', '0114555', '0125666', 'Regis005', '0000-00-00 00:00:00', 'Reg', 'R', 'R', 'Regis005', 'jkjkj'),
(10003, 'Steven', 'ste44', 'steve@gmail.com', 'Steven stanisylous', 'Perth', 'Australia', 'Park View', 'Perth', '011145522', '012255266', '', '2014-11-17 00:00:00', 'Typ', 'A', 'A', 'CategoryA', 'ProfOne');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fixedads`
--
ALTER TABLE `fixedads`
 ADD PRIMARY KEY (`fixedads_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fixedads`
--
ALTER TABLE `fixedads`
MODIFY `fixedads_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10004;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
