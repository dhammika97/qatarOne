-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2014 at 06:27 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qatarone001`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_images`
--

CREATE TABLE IF NOT EXISTS `advertisement_images` (
`advertisement_imageId` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `advertisement_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `advertisment`
--

CREATE TABLE IF NOT EXISTS `advertisment` (
`advertisment_id` int(11) NOT NULL,
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
  `advertisement_expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(5) NOT NULL,
  `category_parentId` int(5) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_enteredBy` int(11) NOT NULL,
  `category_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_parentId`, `category_name`, `category_enteredDate`, `category_enteredBy`, `category_status`) VALUES
(1, 0, 'Classifides', '2014-11-21 06:01:14', 1, 1),
(2, 0, 'Job Seeker', '2014-11-21 06:02:44', 1, 1),
(3, 1, 'Antiques', '2014-11-21 09:29:09', 1, 1),
(4, 1, 'Art', '2014-11-21 09:29:09', 1, 1),
(5, 1, 'Baby', '2014-11-21 09:29:50', 1, 1),
(6, 1, 'Books', '2014-11-21 09:29:50', 1, 1),
(7, 2, 'Accounting/ Finance', '2014-11-21 09:31:54', 1, 1),
(8, 2, 'Admin/ Human Resources', '2014-11-21 09:31:54', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categoryattributes`
--

CREATE TABLE IF NOT EXISTS `categoryattributes` (
`attribute_id` int(4) NOT NULL,
  `attribute_categoryId` int(4) NOT NULL,
  `attributes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_sub`
--

CREATE TABLE IF NOT EXISTS `category_sub` (
`category_sub_id` int(4) NOT NULL,
  `category_sub_name` varchar(250) NOT NULL,
  `category_sub_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_sub_enteredBy` int(5) NOT NULL,
  `category_sub_status` int(1) NOT NULL,
  `category_sub_parentId` int(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category_sub`
--

INSERT INTO `category_sub` (`category_sub_id`, `category_sub_name`, `category_sub_enteredDate`, `category_sub_enteredBy`, `category_sub_status`, `category_sub_parentId`) VALUES
(1, 'Audit & Taxation', '2014-11-21 09:33:40', 1, 1, 7),
(2, 'Banking & Financial', '2014-11-21 09:33:40', 1, 1, 7),
(3, 'Antiquities', '2014-11-21 09:35:25', 1, 1, 3),
(4, 'Antique Books & Manuscripts', '2014-11-21 09:35:25', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`evenet_id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_shortDescription` varchar(255) NOT NULL,
  `event_description` longtext NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `event_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fixedads`
--

CREATE TABLE IF NOT EXISTS `fixedads` (
`fixedads_id` int(11) NOT NULL,
  `fixedads_type` int(2) NOT NULL,
  `fixedads_image` varchar(255) NOT NULL,
  `fixedads_enetredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fixedads_url` varchar(255) NOT NULL,
  `fixedads_status` int(1) NOT NULL,
  `fixedads_title` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fixedads`
--

INSERT INTO `fixedads` (`fixedads_id`, `fixedads_type`, `fixedads_image`, `fixedads_enetredDate`, `fixedads_url`, `fixedads_status`, `fixedads_title`) VALUES
(2, 0, 'ff', '2014-11-28 18:30:00', 'ff', 0, 'ff');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
`location_id` int(5) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `location_cordinates` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_cordinates`) VALUES
(1, 'Anuradhapura', '48.124587,59.215478'),
(2, 'Wadduwa', '48.124587,59.215478');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`news_id` int(10) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_shortDescription` varchar(255) NOT NULL,
  `news_Description` longtext NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_date` datetime NOT NULL,
  `news_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_shortDescription`, `news_Description`, `news_image`, `news_date`, `news_status`) VALUES
(1, 'test news', 'test news short description', 'test description', '', '2014-11-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packagetypes`
--

CREATE TABLE IF NOT EXISTS `packagetypes` (
`package_id` int(2) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_Description` longtext NOT NULL,
  `package_price` decimal(10,0) NOT NULL,
  `package_adLimit` int(2) NOT NULL,
  `package_addedBy` int(3) NOT NULL,
  `package_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `packagetypes`
--

INSERT INTO `packagetypes` (`package_id`, `package_name`, `package_Description`, `package_price`, `package_adLimit`, `package_addedBy`, `package_status`) VALUES
(1, 'test package', 'test description', '2500', 3, 1, 0),
(3, 'test package 3', 'test description 2', '2500', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pagecontent`
--

CREATE TABLE IF NOT EXISTS `pagecontent` (
`pageContent_id` int(1) NOT NULL,
  `pageContent_pageId` int(1) NOT NULL,
  `pageContent_pageTitle` varchar(100) NOT NULL,
  `pageContent_Description` longtext NOT NULL,
  `pageContent_lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`page_id` int(2) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_status` int(1) NOT NULL,
  `page_addedBy` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
`slider_id` int(10) NOT NULL,
  `slider_title` varchar(100) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_url` int(255) NOT NULL,
  `slider_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slider_id`, `slider_title`, `slider_image`, `slider_url`, `slider_status`) VALUES
(1, 'test title', '12254454', 854545, 1),
(3, 'test title 3', '12254454', 854545, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suburbs`
--

CREATE TABLE IF NOT EXISTS `suburbs` (
`suburb_id` int(5) NOT NULL,
  `suburb_location_id` int(5) NOT NULL,
  `suburb_name` varchar(100) NOT NULL,
  `suburb_cordinates` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `suburbs`
--

INSERT INTO `suburbs` (`suburb_id`, `suburb_location_id`, `suburb_name`, `suburb_cordinates`) VALUES
(1, 1, 'test', '89.124575,102.457832'),
(3, 1, 'kolkata', '45.78451,68.124578');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
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
  `user_accessToken` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_firstname`, `user_lastname`, `user_address1`, `user_address2`, `user_city`, `user_contactNo`, `user_registeredDate`, `user_type`, `user_status`, `user_accessToken`) VALUES
(1, 'dhammika97', '$2a$10$473928c6b93fb4742c3abuBJjEH.TVTADD75q0j9UnkIiOox9JeKu', 'dhammika97@gmail.com', 'dhammika', 'gunaratne', '176/4, walatenna', 'gallellagama', 'kandy', '777339803', '2014-11-20 00:00:00', 0, 1, 'kjsjjdfshdfhsdbfjhsbdfsdfsf'),
(26, 'sdfsdf', '27d779cba60f2b5d48debdd970c8e732', 'sdsd@sdfsd', 'sdfsd', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sddf', 'sdfsdf', '2014-11-27 00:00:00', 0, 1, '40D08248FD796D6C8FC34141D46A35AB'),
(28, 'asdasd', '0aa1ea9a5a04b78d4581dd6d17742627', 'ssdsf@dfsdf', 'dfsdf', 'sdfsdf', 'dsfsdf', 'dfsdf', 'sdfsdf', 'dsfsf', '2014-11-27 00:00:00', 0, 1, '61D78F2173F82567EE27BCB121267011'),
(29, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test', 'test', 'test', 'test', 'test', 'test', 'test', '2014-11-27 00:00:00', 0, 1, 'ADBC4ABAD086391B217F1C8DDECBBAC5'),
(30, 'test test', '202cb962ac59075b964b07152d234b70', 'test@test', 'sdf', 'sdf', 'sdf', '', '', '', '2014-11-27 00:00:00', 0, 1, '6893F05404F0DEBCF41325624039B85B');

-- --------------------------------------------------------

--
-- Table structure for table `userpackge`
--

CREATE TABLE IF NOT EXISTS `userpackge` (
`userpkg_id` int(11) NOT NULL,
  `userpkg_userId` int(11) NOT NULL,
  `userpkg_pkgId` int(11) NOT NULL,
  `userpkg_remainAds` int(4) NOT NULL,
  `userpkg_expirey` date NOT NULL,
  `userpkg_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement_images`
--
ALTER TABLE `advertisement_images`
 ADD PRIMARY KEY (`advertisement_imageId`);

--
-- Indexes for table `advertisment`
--
ALTER TABLE `advertisment`
 ADD PRIMARY KEY (`advertisment_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `categoryattributes`
--
ALTER TABLE `categoryattributes`
 ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `category_sub`
--
ALTER TABLE `category_sub`
 ADD PRIMARY KEY (`category_sub_id`), ADD KEY `category_sub_id` (`category_sub_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`evenet_id`);

--
-- Indexes for table `fixedads`
--
ALTER TABLE `fixedads`
 ADD PRIMARY KEY (`fixedads_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `packagetypes`
--
ALTER TABLE `packagetypes`
 ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `pagecontent`
--
ALTER TABLE `pagecontent`
 ADD PRIMARY KEY (`pageContent_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
 ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `suburbs`
--
ALTER TABLE `suburbs`
 ADD PRIMARY KEY (`suburb_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `userpackge`
--
ALTER TABLE `userpackge`
 ADD PRIMARY KEY (`userpkg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement_images`
--
ALTER TABLE `advertisement_images`
MODIFY `advertisement_imageId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `advertisment`
--
ALTER TABLE `advertisment`
MODIFY `advertisment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `categoryattributes`
--
ALTER TABLE `categoryattributes`
MODIFY `attribute_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category_sub`
--
ALTER TABLE `category_sub`
MODIFY `category_sub_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `evenet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fixedads`
--
ALTER TABLE `fixedads`
MODIFY `fixedads_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `location_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `news_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `packagetypes`
--
ALTER TABLE `packagetypes`
MODIFY `package_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pagecontent`
--
ALTER TABLE `pagecontent`
MODIFY `pageContent_id` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `page_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
MODIFY `slider_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `suburbs`
--
ALTER TABLE `suburbs`
MODIFY `suburb_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `userpackge`
--
ALTER TABLE `userpackge`
MODIFY `userpkg_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
