-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2014 at 12:43 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `advertisement_images`
--

INSERT INTO `advertisement_images` (`advertisement_imageId`, `advertisement_id`, `advertisement_image`) VALUES
(7, 28, 'C23EB700608877BB1EB2C004FF938D9C230405b.jpeg'),
(8, 28, 'F004CC91A8AD43C06C81B269C77A907BFuel-efficient-Quick-Sale-Cars.jpg');

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
  `advertisement_addedBy` int(11) NOT NULL,
  PRIMARY KEY (`advertisment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `advertisment`
--

INSERT INTO `advertisment` (`advertisment_id`, `advertisement_categoryId`, `advertisement_subCategoryId`, `advertisement_attributes`, `advertisement_title`, `advertisement_description`, `advertisement_price`, `advertisement_contactName`, `advertisement_contactNo`, `advertisement_contactEmail`, `advertisement_location`, `advertisement_suburb`, `advertisement_googleCodes`, `advertisement_date`, `advertisement_status`, `advertisement_expire`, `advertisement_addedBy`) VALUES
(27, 5, 13, '{"test":"sdfsdf"}', 'asasd', 'sdfsdf', '123', 'asasd', '234', 'ass@sdfsdf', 1, 1, '6.934023, 79.845219', '2014-12-08 19:19:27', 0, '2015-03-08 00:00:00', 31),
(28, 5, 12, '{"make":"tata","model":"Corolla 110","year":"2000","bodyType":"MVP","condition":"Recondition","transmission":"Manual","fuelType":"Diesel"}', 'Toyota Corolla', 'Mint Condition', '1400000', 'Dhammika', '777339803', 'dhammika97@gmail.com', 1, 1, '6.934023, 79.845219', '2014-12-08 19:35:05', 0, '2015-03-08 00:00:00', 31);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(5) NOT NULL AUTO_INCREMENT,
  `category_parentId` int(5) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_enteredBy` int(11) NOT NULL,
  `category_status` int(1) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_parentId`, `category_name`, `category_enteredDate`, `category_enteredBy`, `category_status`) VALUES
(1, 0, 'Classifides', '2014-11-21 06:01:14', 1, 1),
(2, 0, 'Job Seeker', '2014-11-21 06:02:44', 1, 1),
(3, 1, 'Antiques', '2014-11-21 09:29:09', 1, 1),
(4, 1, 'Electronics', '2014-12-06 04:47:51', 1, 1),
(5, 1, 'Automobile', '2014-12-06 04:49:38', 1, 1),
(6, 1, 'Books', '2014-11-21 09:29:50', 1, 1),
(7, 2, 'Accounting/ Finance', '2014-11-21 09:31:54', 1, 1),
(8, 2, 'Admin/ Human Resources', '2014-11-21 09:31:54', 1, 1),
(9, 2, 'IT/ Software', '2014-12-08 14:32:43', 1, 1),
(10, 2, 'IT/ Harware', '2014-12-08 14:32:46', 1, 1),
(11, 2, 'test Category', '2014-12-08 14:32:50', 31, 1);

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
  `category_sub_tplType` varchar(50) NOT NULL,
  `category_sub_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_sub_enteredBy` int(5) NOT NULL,
  `category_sub_status` int(1) NOT NULL,
  `category_sub_parentId` int(4) NOT NULL,
  PRIMARY KEY (`category_sub_id`),
  KEY `category_sub_id` (`category_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `category_sub`
--

INSERT INTO `category_sub` (`category_sub_id`, `category_sub_name`, `category_sub_tplType`, `category_sub_enteredDate`, `category_sub_enteredBy`, `category_sub_status`, `category_sub_parentId`) VALUES
(9, 'Mobile Phones', 'Mobile', '2014-12-07 12:43:59', 4, 0, 4),
(10, 'Mobile Phone Assessories', 'General', '2014-12-07 12:44:29', 4, 0, 4),
(11, 'Kids Collection', 'General', '2014-12-07 12:45:08', 6, 0, 6),
(12, 'Cars', 'Car', '2014-12-07 12:45:56', 5, 0, 5),
(13, 'Lorries Vans & Busses', 'Auto', '2014-12-07 12:46:24', 5, 0, 5),
(14, 'Motor Cycle', 'Auto', '2014-12-07 12:46:42', 5, 0, 5),
(15, 'TV/ Radio', 'General', '2014-12-07 12:54:48', 1, 0, 4),
(16, 'Yet Another Sub Category', 'General', '2014-12-08 09:48:08', 31, 0, 6),
(17, 'Web/ UI', 'General', '2014-12-08 14:35:42', 31, 0, 9),
(18, 'Network Engineering', 'General', '2014-12-08 14:36:38', 31, 0, 10),
(19, 'test', 'General', '2014-12-08 14:36:55', 31, 0, 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`evenet_id`, `event_title`, `event_date`, `event_shortDescription`, `event_description`, `event_image`, `event_status`) VALUES
(10, 'Test Title', '2014-12-10', 'Test Tile one', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', '6880B31C8FD43AC55D2E47DE3FA1E5AEScreenshot (1).png', 1),
(11, 'second event', '2014-07-21', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', '13F9F5384610FDAB7BEA89DB3BD79DDC728-x-90.gif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fixedads`
--

CREATE TABLE IF NOT EXISTS `fixedads` (
  `fixedads_id` int(11) NOT NULL AUTO_INCREMENT,
  `fixedads_type` int(2) NOT NULL,
  `fixedads_image` varchar(255) NOT NULL,
  `fixedads_enetredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fixedads_url` varchar(255) NOT NULL,
  `fixedads_status` int(1) NOT NULL,
  `fixedads_title` varchar(100) NOT NULL,
  PRIMARY KEY (`fixedads_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `fixedads`
--

INSERT INTO `fixedads` (`fixedads_id`, `fixedads_type`, `fixedads_image`, `fixedads_enetredDate`, `fixedads_url`, `fixedads_status`, `fixedads_title`) VALUES
(12, 4, '57F9DECE5D89E787703820CDA3E99E0D728-x-90.gif', '2014-12-05 13:39:22', 'http://www.dialog.lk', 1, 'Dialog top add'),
(13, 5, '863DB708EE07D69EAA38BF72E62A5F5E728-x-90 - Copy.jpg', '2014-12-05 13:38:55', 'http://www.dialog.lk/', 1, 'dialog bottom add'),
(14, 2, '752108EC3F897B72A7B65CFD9566E14B6591726479222682286.gif', '2014-12-05 13:48:37', 'www.shuboothi.com', 1, 'leftadd'),
(15, 3, 'B7B9376F9ECB64CF05DF8EFB3419F0B47483126944720115748.png', '2014-12-05 13:49:21', 'www.google.com', 1, 'right'),
(16, 2, '40ABAFF4265EE3DB7DACB5D10266B2AB15441498865313608811.gif', '2014-12-05 13:56:35', 'www.google.com', 1, 'left'),
(17, 1, 'E536AD0E9B9B76D1C8BA50E53D0E0D7B728-x-90 - Copy.jpg', '2014-12-05 14:07:48', 'www.dialog.lk', 1, 'top'),
(18, 3, 'F7CB8713A5AB0E994C8EB1FAD803DA936591726479222682286.gif', '2014-12-05 15:11:50', 'dfgsdfgsd', 1, 'dagd'),
(19, 1, '02A1BA8443B8E1DE6C8B1DBCE658ACD9728-x-90.gif', '2014-12-05 15:51:29', 'sfagsdf', 1, 'top');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(5) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) NOT NULL,
  `location_cordinates` varchar(20) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_cordinates`) VALUES
(1, 'Anuradhapura', '48.124587,59.215478'),
(2, 'Wadduwa', '48.124587,59.215478'),
(4, 'Hambanthota', '5646546546'),
(6, 'asdasdasd asdasd', 'asdasdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(10) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_shortDescription` varchar(255) NOT NULL,
  `news_Description` longtext NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_date` datetime NOT NULL,
  `news_status` int(1) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_shortDescription`, `news_Description`, `news_image`, `news_date`, `news_status`) VALUES
(16, 'News Title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type', 'B497E8C9C8A19CBD20ADA04F4319613CMBP2488.jpg', '2014-12-04 00:00:00', 1),
(17, 'sdcsa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500', 'sDASD', 'BE9C5F766BB753554774C1EBE2CAC2BCMBP2488.jpg', '2014-12-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packagetypes`
--

CREATE TABLE IF NOT EXISTS `packagetypes` (
  `package_id` int(2) NOT NULL AUTO_INCREMENT,
  `packageType` int(2) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_Description` longtext NOT NULL,
  `package_price` decimal(10,0) NOT NULL,
  `package_adLimit` int(5) NOT NULL,
  `package_addedBy` int(3) NOT NULL,
  `package_status` int(1) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `packagetypes`
--

INSERT INTO `packagetypes` (`package_id`, `packageType`, `package_name`, `package_Description`, `package_price`, `package_adLimit`, `package_addedBy`, `package_status`) VALUES
(1, 0, 'test package', 'test description', '2500', 3, 1, 0),
(3, 0, 'test package 3', 'test', '2500', 300, 1, 0),
(7, 0, 'test first', 'test description', '21540', 15, 1, 1),
(9, 0, 'ssdf', 'sdfsf asdasdas dasdas', '123', 123, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(2) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) NOT NULL,
  `page_content` longtext NOT NULL,
  `page_status` int(1) NOT NULL,
  `page_addedBy` int(2) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_content`, `page_status`, `page_addedBy`) VALUES
(1, 'Terms & Coditions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac dolor sit amet mi laoreet finibus at et nisl. Phasellus sodales ex et bibendum accumsan. Sed hendrerit mauris non vehicula consectetur. Nullam pulvinar sit amet turpis venenatis euismod. Curabitur lobortis fermentum maximus. Sed commodo orci nec malesuada euismod. Maecenas posuere dictum felis. Integer justo velit, feugiat maximus ligula id, cursus pharetra nisi. Mauris porttitor malesuada purus, et auctor nulla ultricies ut.\n\nNulla a quam iaculis, iaculis turpis vitae, dignissim purus. Pellentesque sodales pellentesque magna sit amet maximus. Etiam in leo at arcu eleifend gravida. Phasellus consequat porttitor lectus, eu vestibulum ipsum ultrices sed. In ornare vehicula justo, nec semper ipsum aliquet et. Quisque sagittis diam eget ex maximus, et pharetra arcu pulvinar. Pellentesque ornare risus quis imperdiet hendrerit. Vivamus lorem quam, pulvinar at tortor vitae, vehicula pretium augue. Donec ornare elementum nunc non efficitur. Cras euismod tellus venenatis mauris aliquam gravida. Nullam in fermentum quam. Praesent condimentum fermentum pharetra. Proin gravida erat vitae porttitor faucibus. Morbi nec sem lectus. Sed in leo tristique, rutrum justo et, laoreet velit.\n\nSuspendisse potenti. Nam lectus purus, pretium in tellus ac, venenatis fermentum nunc. Curabitur eget viverra dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent sit amet venenatis leo. Aenean est dui, cursus nec efficitur ac, tristique ac eros. Duis at consectetur nisl. Suspendisse iaculis, tortor sit amet faucibus semper, tortor mi pulvinar lorem, in cursus urna metus eu velit. Duis pretium ultrices metus, eu dapibus erat malesuada sit amet. Etiam quis vulputate augue. Vestibulum diam nisl, porttitor ullamcorper dui quis, varius tristique arcu. Nulla sit amet euismod neque, sed cursus arcu.\n\nPhasellus faucibus nulla et massa imperdiet ornare. Cras at velit quis dolor volutpat condimentum. In vel libero vestibulum, sagittis tellus vel, porttitor arcu. In nec leo euismod, pulvinar leo vel, aliquam purus. Quisque dictum tincidunt nulla ut egestas. Sed non dictum eros. Sed sollicitudin pulvinar dui, ac efficitur sapien dapibus sit amet. Integer dictum et libero at suscipit. Mauris at diam vitae nunc accumsan commodo. Sed ut sapien vitae nulla iaculis aliquam. Nam lobortis sem nec dui accumsan accumsan. Sed scelerisque massa id justo imperdiet fringilla. Vestibulum ante augue, dictum ut rutrum eleifend, iaculis a mi. Phasellus rutrum egestas elit malesuada convallis. Vivamus iaculis scelerisque mollis. Vestibulum sodales ultricies dictum.\n\nNam faucibus v', 0, 1),
(2, 'About Us', '<script>alert(''ayyoo salli'')</script>', 0, 1),
(3, 'Yet Another Page', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac dolor sit amet mi laoreet finibus at et nisl. Phasellus sodales ex et bibendum accumsan. Sed hendrerit mauris non vehicula consectetur. Nullam pulvinar sit amet turpis venenatis euismod. Curabitur lobortis fermentum maximus. Sed commodo orci nec malesuada euismod. Maecenas posuere dictum felis. Integer justo velit, feugiat maximus ligula id, cursus pharetra nisi. Mauris porttitor malesuada purus, et auctor nulla ultricies ut.\n\nNulla a quam iaculis, iaculis turpis vitae, dignissim purus. Pellentesque sodales pellentesque magna sit amet maximus. Etiam in leo at arcu eleifend gravida. Phasellus consequat porttitor lectus, eu vestibulum ipsum ultrices sed. In ornare vehicula justo, nec semper ipsum aliquet et. Quisque sagittis diam eget ex maximus, et pharetra arcu pulvinar. Pellentesque ornare risus quis imperdiet hendrerit. Vivamus lorem quam, pulvinar at tortor vitae, vehicula pretium augue. Donec ornare elementum nunc non efficitur. Cras euismod tellus venenatis mauris aliquam gravida. Nullam in fermentum quam. Praesent condimentum fermentum pharetra. Proin gravida erat vitae porttitor faucibus. Morbi nec sem lectus. Sed in leo tristique, rutrum justo et, laoreet velit.\n\nSuspendisse potenti. Nam lectus purus, pretium in tellus ac, venenatis fermentum nunc. Curabitur eget viverra dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent sit amet venenatis leo. Aenean est dui, cursus nec efficitur ac, tristique ac eros. Duis at consectetur nisl. Suspendisse iaculis, tortor sit amet faucibus semper, tortor mi pulvinar lorem, in cursus urna metus eu velit. Duis pretium ultrices metus, eu dapibus erat malesuada sit amet. Etiam quis vulputate augue. Vestibulum diam nisl, porttitor ullamcorper dui quis, varius tristique arcu. Nulla sit amet euismod neque, sed cursus arcu.\n\nPhasellus faucibus nulla et massa imperdiet ornare. Cras at velit quis dolor volutpat condimentum. In vel libero vestibulum, sagittis tellus vel, porttitor arcu. In nec leo euismod, pulvinar leo vel, aliquam purus. Quisque dictum tincidunt nulla ut egestas. Sed non dictum eros. Sed sollicitudin pulvinar dui, ac efficitur sapien dapibus sit amet. Integer dictum et libero at suscipit. Mauris at diam vitae nunc accumsan commodo. Sed ut sapien vitae nulla iaculis aliquam. Nam lobortis sem nec dui accumsan accumsan. Sed scelerisque massa id justo imperdiet fringilla. Vestibulum ante augue, dictum ut rutrum eleifend, iaculis a mi. Phasellus rutrum egestas elit malesuada convallis. Vivamus iaculis scelerisque mollis. Vestibulum sodales ultricies dictum.\n\nNam faucibus v', 0, 1),
(4, 'Sample Page', 'Sample Content', 0, 31);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `slider_id` int(10) NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(100) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_url` varchar(255) NOT NULL,
  `slider_status` int(1) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slider_id`, `slider_title`, `slider_image`, `slider_url`, `slider_status`) VALUES
(11, 'asdasd', 'E662DAF13311D35CEEAE424890D9B55AMBP2488.jpg', 'sdfsdf', 1),
(12, 'sdfsfd', '9BD82BE1C118532D9B0F4E822528732CInterior-Bar-Nashville-Set.jpg', 'sdfsdf', 1),
(13, 'dsDgds', '', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `suburbs`
--

INSERT INTO `suburbs` (`suburb_id`, `suburb_location_id`, `suburb_name`, `suburb_cordinates`) VALUES
(1, 1, 'test', '89.124575,102.457832'),
(3, 2, 'kolkata', '45.78451,68.124578'),
(4, 2, 'asdasd', 'asdasd'),
(5, 1, 'Talawa', '12254544'),
(6, 2, 'location val 6', 'aASD');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_firstname`, `user_lastname`, `user_address1`, `user_address2`, `user_city`, `user_contactNo`, `user_registeredDate`, `user_type`, `user_status`, `user_accessToken`) VALUES
(1, 'dhammika97', '202cb962ac59075b964b07152d234b70', 'dhammika97@gmail.com', 'dhammika', 'gunaratne', '176/4, walatenna', 'gallellagama', 'kandy', '777339803', '2014-11-20 00:00:00', 0, 1, 'kjsjjdfshdfhsdbfjhsbdfsdfsf'),
(31, '', '202cb962ac59075b964b07152d234b70', 'dhammika9@gmail.com', 'test', '', '', '', '', '', '2014-12-06 00:00:00', 3, 1, '1C078C9F93582F9D780C55507BB274B6'),
(32, '', '202cb962ac59075b964b07152d234b70', 'damn@123.com', '123', '123', '', '', '', '', '2014-12-09 00:00:00', 3, 1, 'BD9EC52A01EF7DD33EFE5AB92EC7D99F');

-- --------------------------------------------------------

--
-- Table structure for table `userpackge`
--

CREATE TABLE IF NOT EXISTS `userpackge` (
  `userpkg_id` int(11) NOT NULL AUTO_INCREMENT,
  `userpkg_userId` int(11) NOT NULL,
  `userpkg_pkgId` int(11) NOT NULL,
  `userpkg_remainAds` int(4) NOT NULL,
  `userpkg_expirey` date NOT NULL,
  `userpkg_status` int(1) NOT NULL,
  PRIMARY KEY (`userpkg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `userpackge`
--

INSERT INTO `userpackge` (`userpkg_id`, `userpkg_userId`, `userpkg_pkgId`, `userpkg_remainAds`, `userpkg_expirey`, `userpkg_status`) VALUES
(1, 31, 1, 3, '0000-00-00', 1),
(2, 31, 3, 300, '0000-00-00', 1),
(3, 31, 7, 15, '0000-00-00', 1),
(4, 31, 9, 123, '0000-00-00', 1),
(5, 32, 1, 3, '0000-00-00', 1),
(6, 32, 3, 300, '0000-00-00', 1),
(7, 32, 7, 15, '0000-00-00', 1),
(8, 32, 9, 123, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usersubscription`
--

CREATE TABLE IF NOT EXISTS `usersubscription` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_email` varchar(50) NOT NULL,
  `subscription_status` int(11) NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usersubscription`
--

INSERT INTO `usersubscription` (`subscription_id`, `subscription_email`, `subscription_status`) VALUES
(1, 'dhammika97@gmail.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
