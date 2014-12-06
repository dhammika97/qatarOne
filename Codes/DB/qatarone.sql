-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2014 at 03:29 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `advertisement_images`
--

INSERT INTO `advertisement_images` (`advertisement_imageId`, `advertisement_id`, `advertisement_image`) VALUES
(1, 5, 'phone.jpeg'),
(2, 1, 'htcm8'),
(3, 2, 'nexus');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `advertisment`
--

INSERT INTO `advertisment` (`advertisment_id`, `advertisement_categoryId`, `advertisement_subCategoryId`, `advertisement_attributes`, `advertisement_title`, `advertisement_description`, `advertisement_price`, `advertisement_contactName`, `advertisement_contactNo`, `advertisement_contactEmail`, `advertisement_location`, `advertisement_suburb`, `advertisement_googleCodes`, `advertisement_date`, `advertisement_status`, `advertisement_expire`) VALUES
(1, 4, 1, 'sdfsdf', 'htc m8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s wit', '125', 'Marsh', '0711129349', 'marsh@gmail.com', 1, 1, '', '2014-12-06 10:23:16', 1, '0000-00-00 00:00:00'),
(2, 4, 1, 'sdfsdfe', 'Nexus5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s wit', '125', 'dhammika', '0711129349', 'dhammika@gmail.com', 2, 3, '', '2014-12-06 10:33:53', 0, '2014-12-31 00:00:00'),
(3, 7, 2, 'sdfsdfsdf', 'sdfsf', 'sdfsdf', '0', '', '', '', 0, 0, '', '2014-12-05 10:33:28', 0, '0000-00-00 00:00:00'),
(4, 8, 2, 'sfsdfsdq', 'sdsdf', 'sdfsdf', '0', '', '', '', 0, 0, '', '2014-12-05 10:33:35', 0, '0000-00-00 00:00:00'),
(5, 4, 1, '[{0:''4.7 Inch Retina HD Display'',1:''A8 Chip With 64-Bit Architecture'',4:''8MP ISight Camera'',5:''1.2MP Front Facing Camera'',6:\n''LTE Support''}]', 'HTC x8', 'Let''s not mince words: When the Huawei Ascend D1 Quad XL starts shipping globally, it will face some steep competition. Thanks to months of delays, what once was billed as the "world''s fastest smartphone" is now just another entry on the growing list of quad-core powerhouses available. That''s not to say it isn''t powerful or fast -- on the contrary, it performs exactly the way you''d expect a phone with four CPU cores to, and it''s Huawei''s best phone to date -- but we unfortunately aren''t seeing many features that will help it stand out. The saving grace for the XL will be its price; with a tentative MSRP of about 2,699 yuan ($450), its cost will be the only thing preventing it from getting lost in the crowd.', '18', 'jhone', '09711129349', 'jone@gmail.com', 1, 1, '', '2014-12-06 09:40:07', 1, '2014-12-31 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(9, 2, 'test test test test test', '2014-12-02 01:25:34', 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category_sub`
--

INSERT INTO `category_sub` (`category_sub_id`, `category_sub_name`, `category_sub_enteredDate`, `category_sub_enteredBy`, `category_sub_status`, `category_sub_parentId`) VALUES
(1, 'Mobile Phones', '2014-12-06 04:51:05', 1, 1, 4),
(2, 'Banking & Financial', '2014-11-21 09:33:40', 1, 1, 7),
(3, 'Antiquities', '2014-11-21 09:35:25', 1, 1, 3),
(5, 'test update', '2014-12-02 00:48:57', 0, 0, 1),
(6, 'test 2 update', '2014-12-02 00:51:04', 5, 0, 1),
(7, 'Wonderful Book', '2014-12-02 01:06:26', 6, 0, 1);

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
(10, 'asdasd', '2014-12-10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', '3A5FD88B3861F2DEAD03BF8A78F4AB98Tulips.jpg', 1),
(11, 'second event', '2014-07-21', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', 'CA28D86147D2C20D3F4553AB2CF49F25Desert.jpg', 1);

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
(12, 4, 'BE2B2F10E58994C73FCD81528E395C39728-x-90.gif', '2014-12-05 13:39:22', 'http://www.dialog.lk', 1, 'Dialog top add'),
(13, 5, '466FDEE5C3D80BFFC89F7E7188FA8469728-x-90 - Copy.jpg', '2014-12-05 13:38:55', 'http://www.dialog.lk/', 1, 'dialog bottom add'),
(14, 2, '6F226270BBB98E2C343729EC3FB388C315441498865313608811.gif', '2014-12-05 13:48:37', 'www.shuboothi.com', 1, 'leftadd'),
(15, 3, '5648712D26DE70810EE897A879E11F4D7483126944720115748.png', '2014-12-05 13:49:21', 'www.google.com', 1, 'right'),
(16, 2, '16ED8807517D21A3F63827B0EAB082256591726479222682286.gif', '2014-12-05 13:56:35', 'www.google.com', 1, 'left'),
(17, 1, 'F45FD36C977B4BCA0F69B9F9B04792E1728-x-90 - Copy.jpg', '2014-12-05 14:07:48', 'www.dialog.lk', 1, 'top'),
(18, 2, '0F65DE6A893C97D585B8B8E4BC83B2FE7483126944720115748.png', '2014-12-05 15:11:50', 'dfgsdfgsd', 1, 'dagd'),
(19, 1, 'A137BFCA5C153BFDEBF4EFFFBA0374BD728-x-90.gif', '2014-12-05 15:51:29', 'sfagsdf', 1, 'top');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(5) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) NOT NULL,
  `location_cordinates` varchar(20) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_cordinates`) VALUES
(1, 'Anuradhapura', '48.124587,59.215478'),
(2, 'Wadduwa', '48.124587,59.215478'),
(4, 'Hambanthota', '5646546546');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_shortDescription`, `news_Description`, `news_image`, `news_date`, `news_status`) VALUES
(16, 'asdasd', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.f', '8AC25C5BD9D7E2D5D10FBBBD4EAA8D50Lighthouse.jpg', '2014-12-04 00:00:00', 1),
(17, 'sdcsa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500', 'sDASD', 'F9BB613F70E8EE9E3D2DBCAABDBA3B88Hydrangeas.jpg', '2014-12-05 00:00:00', 1),
(18, 'title', '"description"', '"sdafsdfsdfds"', '0C94299F4E9A99C1AB0CF541E1FBAA5ALighthouse.jpg', '2014-12-05 00:00:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_content`, `page_status`, `page_addedBy`) VALUES
(1, 'Terms & Coditions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac dolor sit amet mi laoreet finibus at et nisl. Phasellus sodales ex et bibendum accumsan. Sed hendrerit mauris non vehicula consectetur. Nullam pulvinar sit amet turpis venenatis euismod. Curabitur lobortis fermentum maximus. Sed commodo orci nec malesuada euismod. Maecenas posuere dictum felis. Integer justo velit, feugiat maximus ligula id, cursus pharetra nisi. Mauris porttitor malesuada purus, et auctor nulla ultricies ut.\n\nNulla a quam iaculis, iaculis turpis vitae, dignissim purus. Pellentesque sodales pellentesque magna sit amet maximus. Etiam in leo at arcu eleifend gravida. Phasellus consequat porttitor lectus, eu vestibulum ipsum ultrices sed. In ornare vehicula justo, nec semper ipsum aliquet et. Quisque sagittis diam eget ex maximus, et pharetra arcu pulvinar. Pellentesque ornare risus quis imperdiet hendrerit. Vivamus lorem quam, pulvinar at tortor vitae, vehicula pretium augue. Donec ornare elementum nunc non efficitur. Cras euismod tellus venenatis mauris aliquam gravida. Nullam in fermentum quam. Praesent condimentum fermentum pharetra. Proin gravida erat vitae porttitor faucibus. Morbi nec sem lectus. Sed in leo tristique, rutrum justo et, laoreet velit.\n\nSuspendisse potenti. Nam lectus purus, pretium in tellus ac, venenatis fermentum nunc. Curabitur eget viverra dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent sit amet venenatis leo. Aenean est dui, cursus nec efficitur ac, tristique ac eros. Duis at consectetur nisl. Suspendisse iaculis, tortor sit amet faucibus semper, tortor mi pulvinar lorem, in cursus urna metus eu velit. Duis pretium ultrices metus, eu dapibus erat malesuada sit amet. Etiam quis vulputate augue. Vestibulum diam nisl, porttitor ullamcorper dui quis, varius tristique arcu. Nulla sit amet euismod neque, sed cursus arcu.\n\nPhasellus faucibus nulla et massa imperdiet ornare. Cras at velit quis dolor volutpat condimentum. In vel libero vestibulum, sagittis tellus vel, porttitor arcu. In nec leo euismod, pulvinar leo vel, aliquam purus. Quisque dictum tincidunt nulla ut egestas. Sed non dictum eros. Sed sollicitudin pulvinar dui, ac efficitur sapien dapibus sit amet. Integer dictum et libero at suscipit. Mauris at diam vitae nunc accumsan commodo. Sed ut sapien vitae nulla iaculis aliquam. Nam lobortis sem nec dui accumsan accumsan. Sed scelerisque massa id justo imperdiet fringilla. Vestibulum ante augue, dictum ut rutrum eleifend, iaculis a mi. Phasellus rutrum egestas elit malesuada convallis. Vivamus iaculis scelerisque mollis. Vestibulum sodales ultricies dictum.\n\nNam faucibus v', 0, 1),
(2, 'About Us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac dolor sit amet mi laoreet finibus at et nisl. Phasellus sodales ex et bibendum accumsan. Sed hendrerit mauris non vehicula consectetur. Nullam pulvinar sit amet turpis venenatis euismod. Curabitur lobortis fermentum maximus. Sed commodo orci nec malesuada euismod. Maecenas posuere dictum felis. Integer justo velit, feugiat maximus ligula id, cursus pharetra nisi. Mauris porttitor malesuada purus, et auctor nulla ultricies ut.\n\nNulla a quam iaculis, iaculis turpis vitae, dignissim purus. Pellentesque sodales pellentesque magna sit amet maximus. Etiam in leo at arcu eleifend gravida. Phasellus consequat porttitor lectus, eu vestibulum ipsum ultrices sed. In ornare vehicula justo, nec semper ipsum aliquet et. Quisque sagittis diam eget ex maximus, et pharetra arcu pulvinar. Pellentesque ornare risus quis imperdiet hendrerit. Vivamus lorem quam, pulvinar at tortor vitae, vehicula pretium augue. Donec ornare elementum nunc non efficitur. Cras euismod tellus venenatis mauris aliquam gravida. Nullam in fermentum quam. Praesent condimentum fermentum pharetra. Proin gravida erat vitae porttitor faucibus. Morbi nec sem lectus. Sed in leo tristique, rutrum justo et, laoreet velit.\n\nSuspendisse potenti. Nam lectus purus, pretium in tellus ac, venenatis fermentum nunc. Curabitur eget viverra dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent sit amet venenatis leo. Aenean est dui, cursus nec efficitur ac, tristique ac eros. Duis at consectetur nisl. Suspendisse iaculis, tortor sit amet faucibus semper, tortor mi pulvinar lorem, in cursus urna metus eu velit. Duis pretium ultrices metus, eu dapibus erat malesuada sit amet. Etiam quis vulputate augue. Vestibulum diam nisl, porttitor ullamcorper dui quis, varius tristique arcu. Nulla sit amet euismod neque, sed cursus arcu.\n\nPhasellus faucibus nulla et massa imperdiet ornare. Cras at velit quis dolor volutpat condimentum. In vel libero vestibulum, sagittis tellus vel, porttitor arcu. In nec leo euismod, pulvinar leo vel, aliquam purus. Quisque dictum tincidunt nulla ut egestas. Sed non dictum eros. Sed sollicitudin pulvinar dui, ac efficitur sapien dapibus sit amet. Integer dictum et libero at suscipit. Mauris at diam vitae nunc accumsan commodo. Sed ut sapien vitae nulla iaculis aliquam. Nam lobortis sem nec dui accumsan accumsan. Sed scelerisque massa id justo imperdiet fringilla. Vestibulum ante augue, dictum ut rutrum eleifend, iaculis a mi. Phasellus rutrum egestas elit malesuada convallis. Vivamus iaculis scelerisque mollis. Vestibulum sodales ultricies dictum.', 0, 1),
(3, 'Yet Another Page', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac dolor sit amet mi laoreet finibus at et nisl. Phasellus sodales ex et bibendum accumsan. Sed hendrerit mauris non vehicula consectetur. Nullam pulvinar sit amet turpis venenatis euismod. Curabitur lobortis fermentum maximus. Sed commodo orci nec malesuada euismod. Maecenas posuere dictum felis. Integer justo velit, feugiat maximus ligula id, cursus pharetra nisi. Mauris porttitor malesuada purus, et auctor nulla ultricies ut.\n\nNulla a quam iaculis, iaculis turpis vitae, dignissim purus. Pellentesque sodales pellentesque magna sit amet maximus. Etiam in leo at arcu eleifend gravida. Phasellus consequat porttitor lectus, eu vestibulum ipsum ultrices sed. In ornare vehicula justo, nec semper ipsum aliquet et. Quisque sagittis diam eget ex maximus, et pharetra arcu pulvinar. Pellentesque ornare risus quis imperdiet hendrerit. Vivamus lorem quam, pulvinar at tortor vitae, vehicula pretium augue. Donec ornare elementum nunc non efficitur. Cras euismod tellus venenatis mauris aliquam gravida. Nullam in fermentum quam. Praesent condimentum fermentum pharetra. Proin gravida erat vitae porttitor faucibus. Morbi nec sem lectus. Sed in leo tristique, rutrum justo et, laoreet velit.\n\nSuspendisse potenti. Nam lectus purus, pretium in tellus ac, venenatis fermentum nunc. Curabitur eget viverra dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent sit amet venenatis leo. Aenean est dui, cursus nec efficitur ac, tristique ac eros. Duis at consectetur nisl. Suspendisse iaculis, tortor sit amet faucibus semper, tortor mi pulvinar lorem, in cursus urna metus eu velit. Duis pretium ultrices metus, eu dapibus erat malesuada sit amet. Etiam quis vulputate augue. Vestibulum diam nisl, porttitor ullamcorper dui quis, varius tristique arcu. Nulla sit amet euismod neque, sed cursus arcu.\n\nPhasellus faucibus nulla et massa imperdiet ornare. Cras at velit quis dolor volutpat condimentum. In vel libero vestibulum, sagittis tellus vel, porttitor arcu. In nec leo euismod, pulvinar leo vel, aliquam purus. Quisque dictum tincidunt nulla ut egestas. Sed non dictum eros. Sed sollicitudin pulvinar dui, ac efficitur sapien dapibus sit amet. Integer dictum et libero at suscipit. Mauris at diam vitae nunc accumsan commodo. Sed ut sapien vitae nulla iaculis aliquam. Nam lobortis sem nec dui accumsan accumsan. Sed scelerisque massa id justo imperdiet fringilla. Vestibulum ante augue, dictum ut rutrum eleifend, iaculis a mi. Phasellus rutrum egestas elit malesuada convallis. Vivamus iaculis scelerisque mollis. Vestibulum sodales ultricies dictum.\n\nNam faucibus v', 0, 1);

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
(11, 'asdasd', '1AEB35BCF9475C876DBDE694BB1CFE5CDesert.jpg', 'sdfsdf', 1),
(12, 'sdfsfd', 'BAA548B6C44347E3212732348A905D88Jellyfish.jpg', 'sdfsdf', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `suburbs`
--

INSERT INTO `suburbs` (`suburb_id`, `suburb_location_id`, `suburb_name`, `suburb_cordinates`) VALUES
(1, 1, 'test', '89.124575,102.457832'),
(3, 2, 'kolkata', '45.78451,68.124578'),
(4, 2, 'asdasd', 'asdasd'),
(5, 1, 'Talawa', '12254544');

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
  `userpkg_id` int(11) NOT NULL AUTO_INCREMENT,
  `userpkg_userId` int(11) NOT NULL,
  `userpkg_pkgId` int(11) NOT NULL,
  `userpkg_remainAds` int(4) NOT NULL,
  `userpkg_expirey` date NOT NULL,
  `userpkg_status` int(1) NOT NULL,
  PRIMARY KEY (`userpkg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usersubscription`
--

CREATE TABLE IF NOT EXISTS `usersubscription` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_email` varchar(50) NOT NULL,
  `subscription_status` int(11) NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
