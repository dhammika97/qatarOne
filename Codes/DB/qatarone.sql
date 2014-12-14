-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2014 at 12:51 PM
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
-- Table structure for table `advertisement_images`
--

CREATE TABLE IF NOT EXISTS `advertisement_images` (
`advertisement_imageId` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `advertisement_image` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `advertisement_images`
--

INSERT INTO `advertisement_images` (`advertisement_imageId`, `advertisement_id`, `advertisement_image`) VALUES
(7, 28, 'C23EB700608877BB1EB2C004FF938D9C230405b.jpeg'),
(8, 28, 'F004CC91A8AD43C06C81B269C77A907BFuel-efficient-Quick-Sale-Cars.jpg'),
(9, 29, 'C85AC1D7DD6FD73C6AA5954DF4D72531MBP2488.jpg'),
(10, 30, 'AC45B512E42214DF2D5DAD80A58A65C4MBP2488.jpg'),
(11, 31, 'EA334E1EA6C5B5E094C42675DB9F7EC0MBP2488.jpg'),
(12, 33, '6CFB5257981BA321035E573CEE579E7BMBP2488.jpg'),
(13, 34, '7C7A840FE2727B88C7A07EBDE6598EDAInterior-Bar-Nashville-Set.jpg'),
(14, 34, '87564CB8AF83515B4A4C85528567F24BMBP2488.jpg'),
(15, 35, 'D1D93CCE31EFD8052B04B3E26F9F9CB0Interior-Bar-Nashville-Set.jpg'),
(16, 35, '5843C4B1899D5B6C68A5FEE4BE879850MBP2488.jpg'),
(17, 36, '661B81AD99A35D5559FE456436C523DAInterior-Bar-Nashville-Set.jpg'),
(18, 37, '939101EEFF0449E2729F20855CAC74BBMBP2488.jpg'),
(19, 38, '33EEF74E0D8A39C4A6C7B90BFE92AF07MBP2488.jpg'),
(24, 42, 'BF436C74945D218DBFB3078DA0103F0FIMG_3710.JPG'),
(25, 42, '5A29B70E6EFC6F7612B68842C6431C42IMG_3711.JPG'),
(26, 43, '9BA96D40C21CDA308E144928BF20E1D9IMG_3709 - Copy.JPG'),
(27, 43, 'C6B2DC01AE22DD91EBA65E916FD54388IMG_3709.JPG'),
(28, 45, 'DCEFA23C591F9B679542F1E63174954AMBP2488.jpg'),
(29, 46, '3B11C393FAABC94BD3F199FAA904612CSmartphone.jpg'),
(30, 46, '3CB2ECCF4B3CE5410AD8256AB41ED26DSmartphone.jpg');

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
  `advertisement_expire` datetime NOT NULL,
  `advertisement_addedBy` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `advertisment`
--

INSERT INTO `advertisment` (`advertisment_id`, `advertisement_categoryId`, `advertisement_subCategoryId`, `advertisement_attributes`, `advertisement_title`, `advertisement_description`, `advertisement_price`, `advertisement_contactName`, `advertisement_contactNo`, `advertisement_contactEmail`, `advertisement_location`, `advertisement_suburb`, `advertisement_googleCodes`, `advertisement_date`, `advertisement_status`, `advertisement_expire`, `advertisement_addedBy`) VALUES
(39, 3, 23, '""', 'asdasd', 'sdfsdf', '123', 'sdasda asd asd', '234234234', 'sdsdf@sdfsd', 1, 1, '6.934023, 79.845219', '2014-12-11 17:13:03', 1, '2015-03-11 00:00:00', 1),
(40, 15, 26, '""', 'asdasd', 'sdsdfsdf', '234', 'sdasdas', '23434', 'ssd@sdfsd', 1, 1, '6.934023, 79.845219', '2014-12-11 17:13:09', 1, '2015-03-11 00:00:00', 1),
(41, 17, 28, '""', 'asdasd asd asd', 'asda sdasd asd asd asd', '123', 'asdasd', '123456', 'asdas@sdfsdf', 2, 3, '6.934023, 79.845219', '2014-12-11 17:13:14', 1, '2015-03-11 00:00:00', 1),
(42, 23, 29, '{"brand":"apple","touchscreen":true}', 'asdasd asdasd', 'asdasd asd ad', '234', 'asdas asdasd', '412563', 'asdas@sdfsdf', 2, 6, '6.934023, 79.845219', '2014-12-11 17:13:18', 1, '2015-03-11 00:00:00', 1),
(43, 17, 28, '""', 'asd asd asd asd', 'asdasd asd asd', '1452', 'asdas asd', '123456', 'asd@sdf', 2, 4, '6.934023, 79.845219', '2014-12-11 17:13:22', 1, '2015-03-11 00:00:00', 1),
(44, 17, 27, '""', 'cable ad', 'sdfsdf d asd', '123', 'sdfsd fsdfs', '234234', 'sdas@sdfsd', 1, 1, '6.934023, 79.845219', '2014-12-12 05:07:28', 1, '2015-03-12 00:00:00', 31),
(45, 3, 23, '""', 'asdasd', 'sdfsdf', '234', 'ssdf sf sdf', '234234234', 'ssdf@sdfsdf', 1, 7, '6.934023, 79.845219', '2014-12-13 04:48:56', 1, '2015-03-13 00:00:00', 31),
(46, 23, 29, '{"brand":"apple","touchscreen":true}', 'Apple iPhone 5s', 'iPhone 5s for sale. \nPrice negotiable', '100000', 'Dhammika Gunaratne', '123456789', 'dhammika97@gmail.com', 2, 6, '6.934023, 79.845219', '2014-12-13 04:48:59', 1, '2015-03-13 00:00:00', 31);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(5) NOT NULL,
  `category_parentId` int(5) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_alias` varchar(255) NOT NULL,
  `category_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_enteredBy` int(11) NOT NULL,
  `category_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_parentId`, `category_name`, `category_alias`, `category_enteredDate`, `category_enteredBy`, `category_status`) VALUES
(1, 0, 'Classifides', '', '2014-11-21 06:01:14', 1, 1),
(2, 0, 'Jobs', '', '2014-11-21 06:02:44', 1, 1),
(3, 1, 'Antiques', 'antiques', '2014-11-21 09:29:09', 1, 1),
(6, 1, 'Books', 'books', '2014-11-21 09:29:50', 1, 1),
(12, 1, 'Art', 'art', '2014-12-11 09:21:53', 1, 1),
(13, 1, 'Baby', 'baby', '2014-12-11 09:21:57', 1, 1),
(14, 1, 'Business & Industrial', 'business-industrial', '2014-12-11 09:22:00', 1, 1),
(15, 1, 'Cameras & Photos', 'cameras-photos', '2014-12-11 09:22:26', 1, 1),
(16, 1, 'Clothing, Footware & Accessories', 'clothing-footware-accessories', '2014-12-11 09:22:30', 1, 1),
(17, 1, 'Computer & Tablets', 'computer-tablets', '2014-12-11 09:22:35', 1, 1),
(18, 1, 'Consumer Electronics', 'consumer-electronics', '2014-12-11 09:22:37', 1, 1),
(19, 1, 'Crafts', 'crafts', '2014-12-11 09:22:41', 1, 1),
(20, 1, 'Health & Beauty', 'health-beauty', '2014-12-11 09:22:46', 1, 1),
(21, 1, 'Home & Garden', 'home-garden', '2014-12-11 09:22:50', 1, 1),
(22, 1, 'Jewellery & Watches', 'jewellery-watches', '2014-12-11 09:22:52', 1, 1),
(23, 1, 'Mobile phone & Accessories', 'mobile-phone-accessories', '2014-12-11 09:22:55', 1, 1),
(24, 1, 'Musical Instruments', 'musical-instruments', '2014-12-11 09:22:57', 1, 1),
(25, 1, 'Real Estate', 'real-estate', '2014-12-11 09:23:01', 1, 1),
(26, 1, 'Sporting Goods', 'sporting-goods', '2014-12-11 09:23:04', 1, 1),
(27, 1, 'Toys & Hobbies', 'toys-hobbies', '2014-12-11 09:23:06', 1, 1),
(28, 1, 'Vehicle Part & Accessories', 'vehicle-part-accessories', '2014-12-11 09:23:09', 1, 1),
(29, 2, 'Accounting & Finance', 'accounting-finance', '2014-12-11 09:23:11', 1, 1),
(30, 2, 'Admin/ Human Resource', 'admin-human-resource', '2014-12-11 09:23:13', 1, 1),
(31, 2, 'Arts/ Media/ Communications', 'arts-media-communications', '2014-12-11 09:23:16', 1, 1),
(32, 2, 'Building Construction', 'building-construction', '2014-12-11 09:23:19', 1, 1),
(33, 2, 'Computer/ Information Technology', 'computer-information-technology', '2014-12-11 09:23:22', 1, 1),
(34, 2, 'Education/ Training', 'education-training', '2014-12-11 09:23:24', 1, 1),
(35, 2, 'Engineering', 'engineering', '2014-12-11 09:23:27', 1, 1),
(36, 2, 'Hotel/ Restaurent', 'hotel-restaurent', '2014-12-11 09:23:30', 1, 1),
(37, 2, 'Manufacturing', 'manufacturing', '2014-12-11 09:23:38', 1, 1),
(38, 2, 'Sales & Marketting', 'sales-marketting', '2014-12-11 09:23:40', 1, 1),
(39, 2, 'Science', 'science', '2014-12-11 09:23:43', 1, 1),
(40, 2, 'Services', 'services', '2014-12-11 09:23:45', 1, 1),
(41, 2, 'Other', 'other', '2014-12-11 09:23:47', 1, 1);

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
  `category_sub_alias` varchar(255) NOT NULL,
  `category_sub_tplType` varchar(50) NOT NULL,
  `category_sub_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_sub_enteredBy` int(5) NOT NULL,
  `category_sub_status` int(1) NOT NULL,
  `category_sub_parentId` int(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `category_sub`
--

INSERT INTO `category_sub` (`category_sub_id`, `category_sub_name`, `category_sub_alias`, `category_sub_tplType`, `category_sub_enteredDate`, `category_sub_enteredBy`, `category_sub_status`, `category_sub_parentId`) VALUES
(23, 'Antiquities', 'antiquites', 'General', '2014-12-11 09:27:48', 1, 0, 3),
(24, 'Antique Books & Manuscripts', 'antique-books-manuscripts', 'General', '2014-12-11 09:28:31', 1, 0, 3),
(25, 'Camcorders', 'camcorders', 'General', '2014-12-11 09:29:47', 1, 0, 15),
(26, 'Camera & photo Accessories', 'camera-photo-accessories', 'General', '2014-12-11 09:30:39', 1, 0, 15),
(27, 'Cables & Connectors', 'cables-connectors', 'General', '2014-12-11 12:12:41', 1, 0, 17),
(28, 'Desktops', 'desktops', 'General', '2014-12-11 12:13:41', 1, 0, 17),
(29, 'Mobile Phones', '', 'Mobile', '2014-12-11 12:15:17', 1, 0, 23),
(30, 'Mobile Phone Accessories', '', 'General', '2014-12-11 12:15:47', 1, 0, 23);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`evenet_id`, `event_title`, `event_date`, `event_shortDescription`, `event_description`, `event_image`, `event_status`) VALUES
(10, 'Test Title', '2014-12-10', 'Test Tile one', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', '366CDA5C04240EFB509B90B13FF094ADIMG_3709 - Copy.JPG', 1),
(11, 'second event', '2014-07-21', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', '7D808022F03163B376DDE1727983163FIMG_3709.JPG', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `fixedads`
--

INSERT INTO `fixedads` (`fixedads_id`, `fixedads_type`, `fixedads_image`, `fixedads_enetredDate`, `fixedads_url`, `fixedads_status`, `fixedads_title`) VALUES
(12, 4, 'FDD2B152BF31CD4FF1FC8F47D4D6F002728-x-90 - Copy.jpg', '2014-12-05 13:39:22', 'http://www.dialog.lk', 1, 'Dialog top add'),
(13, 5, '5E6045B8FAA2D56E1F99420BB40A1D0B728-x-90.gif', '2014-12-05 13:38:55', 'http://www.dialog.lk/', 1, 'dialog bottom add'),
(14, 2, '370BD900C5B3241F25F2E5780BD946706591726479222682286.gif', '2014-12-05 13:48:37', 'www.shuboothi.com', 1, 'leftadd'),
(15, 3, '4DDDCEA17574A6DE92A0D29A88E431DC7483126944720115748.png', '2014-12-05 13:49:21', 'www.google.com', 1, 'right'),
(16, 2, 'AECE2071AE28FEB5E17CE3B88AD8276815441498865313608811.gif', '2014-12-05 13:56:35', 'www.google.com', 1, 'left'),
(17, 1, '99A10816C85217D40013C052535F8B38TalkFloor_CRIBanner5.jpg', '2014-12-05 14:07:48', 'www.dialog.lk', 1, 'top'),
(18, 3, '29E272A9B35816BCD853E3A47BFFF9E77483126944720115748.png', '2014-12-05 15:11:50', 'dfgsdfgsd', 1, 'dagd'),
(19, 1, '02A1BA8443B8E1DE6C8B1DBCE658ACD9728-x-90.gif', '2014-12-05 15:51:29', 'sfagsdf', 1, 'top');

-- --------------------------------------------------------

--
-- Table structure for table `item_comments`
--

CREATE TABLE IF NOT EXISTS `item_comments` (
`comment_Id` int(11) NOT NULL,
  `advertisment_Id` int(11) NOT NULL,
  `comment_Date` date NOT NULL,
  `comment_Time` time NOT NULL,
  `comment_status` int(11) NOT NULL,
  `comment_addedBy` int(11) NOT NULL,
  `Comment` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `item_comments`
--

INSERT INTO `item_comments` (`comment_Id`, `advertisment_Id`, `comment_Date`, `comment_Time`, `comment_status`, `comment_addedBy`, `Comment`) VALUES
(1, 46, '2014-12-13', '05:58:13', 1, 33, 'woww....'),
(2, 46, '2014-12-13', '05:58:28', 1, 33, 'woww....');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
`location_id` int(5) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `location_alias` varchar(255) NOT NULL,
  `location_cordinates` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_alias`, `location_cordinates`) VALUES
(1, 'Anuradhapura', 'anuradhapura', '48.124587,59.215478'),
(2, 'Wadduwa', 'wadduwa', '48.124587,59.215478'),
(4, 'Hambanthota', 'hambanthota', '5646546546'),
(6, 'Colombo', 'colombo', '40.124578, 82.256894'),
(7, 'Galle', 'galle', '5.124587, 10.25698');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_shortDescription`, `news_Description`, `news_image`, `news_date`, `news_status`) VALUES
(16, 'News Title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type kjh hashd ausd asd asd asd asd asd asd asd asd asd asd a', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type', '03BB9153F7971D6E7F8FD3A9D76821ABIMG_3711.JPG', '2014-12-04 00:00:00', 1),
(17, 'sdcsa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500', 'sDASD', 'C99E2B231C92E6AB22C055DA757FAFB1IMG_3713.JPG', '2014-12-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packagetypes`
--

CREATE TABLE IF NOT EXISTS `packagetypes` (
`package_id` int(2) NOT NULL,
  `packageType` int(2) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_Description` longtext NOT NULL,
  `package_price` decimal(10,0) NOT NULL,
  `package_adLimit` int(5) NOT NULL,
  `package_addedBy` int(3) NOT NULL,
  `package_status` int(1) NOT NULL
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
`page_id` int(2) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_content` longtext NOT NULL,
  `page_status` int(1) NOT NULL,
  `page_addedBy` int(2) NOT NULL
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
`slider_id` int(10) NOT NULL,
  `slider_title` varchar(100) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_url` varchar(255) NOT NULL,
  `slider_status` int(1) NOT NULL
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
`suburb_id` int(5) NOT NULL,
  `suburb_location_id` int(5) NOT NULL,
  `suburb_name` varchar(100) NOT NULL,
  `suburb_alias` varchar(255) NOT NULL,
  `suburb_cordinates` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `suburbs`
--

INSERT INTO `suburbs` (`suburb_id`, `suburb_location_id`, `suburb_name`, `suburb_alias`, `suburb_cordinates`) VALUES
(1, 6, 'Battaramulla', 'battaramulla', '89.124575,102.457832'),
(3, 6, 'Nugegoda', 'nugegoda', '45.78451,68.124578'),
(4, 6, 'Maharagama', 'maharagama', '41.25487, 20.148752'),
(5, 6, 'Rajagiriya', 'rajagiriya', '12.457895, 10.254786'),
(6, 6, 'Colombo 6', 'colombo-6', '10.25478, 82.21547'),
(7, 6, 'Dehiwala', 'dehiwala', '21.36589, 12.5487965');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_firstname`, `user_lastname`, `user_address1`, `user_address2`, `user_city`, `user_contactNo`, `user_registeredDate`, `user_type`, `user_status`, `user_accessToken`) VALUES
(1, 'dhammika97', '202cb962ac59075b964b07152d234b70', 'dhammika97@gmail.com', 'dhammika', 'gunaratne', '176/4, walatenna', 'gallellagama', 'kandy', '777339803', '2014-11-20 00:00:00', 0, 1, 'kjsjjdfshdfhsdbfjhsbdfsdfsf'),
(31, '', '202cb962ac59075b964b07152d234b70', 'dhammika9@gmail.com', 'test', '', '', '', '', '', '2014-12-06 00:00:00', 3, 1, '1C078C9F93582F9D780C55507BB274B6'),
(32, '', '202cb962ac59075b964b07152d234b70', 'damn@123.com', '123', '123', '', '', '', '', '2014-12-09 00:00:00', 3, 1, 'BD9EC52A01EF7DD33EFE5AB92EC7D99F'),
(33, '', 'c4ca4238a0b923820dcc509a6f75849b', 'usama@gmail.com', 'usama', 'cool', '', '', '', '', '2014-12-14 00:00:00', 3, 1, '4BD9F28A87B2E911BD287EF2242F82D2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
(8, 32, 9, 123, '0000-00-00', 1),
(9, 33, 1, 3, '0000-00-00', 1),
(10, 33, 3, 300, '0000-00-00', 1),
(11, 33, 7, 15, '0000-00-00', 1),
(12, 33, 9, 123, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usersubscription`
--

CREATE TABLE IF NOT EXISTS `usersubscription` (
`subscription_id` int(11) NOT NULL,
  `subscription_email` varchar(50) NOT NULL,
  `subscription_status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usersubscription`
--

INSERT INTO `usersubscription` (`subscription_id`, `subscription_email`, `subscription_status`) VALUES
(1, 'dhammika97@gmail.com', 1),
(2, 'usamafassy@gmail.com', 1),
(3, 'usamafassy@gmail.com', 1),
(4, 'usamafassy@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
`video_id` int(11) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_filename` varchar(200) NOT NULL,
  `video_status` int(1) NOT NULL,
  `video_url` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `video_title`, `video_filename`, `video_status`, `video_url`) VALUES
(17, 'test', '../../../api/uploads/video/FB5020E67FF2F228B00832C32FBA7AD2.mp4', 1, '');

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
-- Indexes for table `item_comments`
--
ALTER TABLE `item_comments`
 ADD PRIMARY KEY (`comment_Id`);

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
-- Indexes for table `usersubscription`
--
ALTER TABLE `usersubscription`
 ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
 ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement_images`
--
ALTER TABLE `advertisement_images`
MODIFY `advertisement_imageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `advertisment`
--
ALTER TABLE `advertisment`
MODIFY `advertisment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `categoryattributes`
--
ALTER TABLE `categoryattributes`
MODIFY `attribute_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category_sub`
--
ALTER TABLE `category_sub`
MODIFY `category_sub_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `evenet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `fixedads`
--
ALTER TABLE `fixedads`
MODIFY `fixedads_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `item_comments`
--
ALTER TABLE `item_comments`
MODIFY `comment_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `location_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `news_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `packagetypes`
--
ALTER TABLE `packagetypes`
MODIFY `package_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `page_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
MODIFY `slider_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `suburbs`
--
ALTER TABLE `suburbs`
MODIFY `suburb_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `userpackge`
--
ALTER TABLE `userpackge`
MODIFY `userpkg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `usersubscription`
--
ALTER TABLE `usersubscription`
MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
