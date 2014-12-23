-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2014 at 08:04 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

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
(30, 46, '3CB2ECCF4B3CE5410AD8256AB41ED26DSmartphone.jpg'),
(31, 47, 'BA763F86481CE1590A3321F6B0C32D0D233828365.jpg'),
(32, 48, '29F753458C1D70B28724631513599E07images.jpg'),
(33, 49, '4275E9BE2DA6A8198A8B136354FC8A1ASamsung-laptop.jpg'),
(34, 51, '9CFCAF0E29EC7672218C84C28432ED97images.jpg'),
(35, 52, '74BDFF02FFD4CA0D1BF991CE52BEB2B2Smartphone.jpg'),
(36, 53, '845FDED06DE86EBEA22FE9E85AC0275CSamsung-laptop.jpg'),
(37, 54, 'A6A03FDF30F2B30B37479E32EDE26661Smartphone.jpg'),
(38, 55, '75D3B268197CBB031AF0FE68F6329288images.jpg'),
(39, 56, 'D1C67E602F19698DAC217A1DF1D80748Nikon-D3200-Sigma-17-70-f2.8-4-side-view.JPG'),
(40, 57, '7C99C0DF36F5EFE6356D42C67A83DB69Smartphone.jpg'),
(41, 58, 'C2F08636BF4C9BA8C0556BB05270988ASmartphone.jpg'),
(42, 59, 'A7C8CFB93ACE9D1393E7ED79950620DESmartphone.jpg'),
(43, 60, 'AF0D2E862B3D1568F7945988F57D299A2008_Suzuki_Wagon_R_Stingray_02.JPG'),
(44, 61, '233250782B88FD2F1F8EDE3880D6F75BSmartphone.jpg'),
(45, 62, '5080A3B6D77B968AE59836E0F89AE023230405b.jpeg'),
(46, 63, '55303EE502FA493339BFF5AC4544BD28Fuel-efficient-Quick-Sale-Cars.jpg'),
(47, 65, '908F8BE6605943927D8B9A4205588552IMG_3734.JPG');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `advertisment`
--

INSERT INTO `advertisment` (`advertisment_id`, `advertisement_categoryId`, `advertisement_subCategoryId`, `advertisement_attributes`, `advertisement_title`, `advertisement_description`, `advertisement_price`, `advertisement_contactName`, `advertisement_contactNo`, `advertisement_contactEmail`, `advertisement_location`, `advertisement_suburb`, `advertisement_googleCodes`, `advertisement_date`, `advertisement_status`, `advertisement_expire`, `advertisement_addedBy`) VALUES
(39, 3, 23, '""', 'asdasd', 'sdfsdf', '123', 'sdasda asd asd', '234234234', 'sdsdf@sdfsd', 1, 1, '6.934023, 79.845219', '2014-12-11 17:13:03', 1, '2015-03-11 00:00:00', 1),
(40, 15, 26, '""', 'asdasd', 'sdsdfsdf', '234', 'sdasdas', '23434', 'ssd@sdfsd', 1, 1, '6.934023, 79.845219', '2014-12-11 17:13:09', 1, '2015-03-11 00:00:00', 1),
(41, 17, 28, '""', 'asdasd asd asd', 'asda sdasd asd asd asd', '123', 'asdasd', '123456', 'asdas@sdfsdf', 2, 3, '6.934023, 79.845219', '2014-12-11 17:13:14', 1, '2015-03-11 00:00:00', 1),
(42, 23, 29, '{"brand":"apple","touchscreen":"Touchscreen"}', 'Apple 1', 'asdasd asd ad', '234', 'asdas asdasd', '412563', 'asdas@sdfsdf', 2, 6, '6.934023, 79.845219', '2014-12-23 05:43:52', 1, '2015-03-11 00:00:00', 1),
(43, 17, 28, '""', 'asd asd asd asd', 'asdasd asd asd', '1452', 'asdas asd', '123456', 'asd@sdf', 2, 4, '6.934023, 79.845219', '2014-12-11 17:13:22', 1, '2015-03-11 00:00:00', 1),
(44, 17, 27, '""', 'cable ad', 'sdfsdf d asd', '123', 'sdfsd fsdfs', '234234', 'sdas@sdfsd', 1, 1, '6.934023, 79.845219', '2014-12-12 05:07:28', 1, '2015-03-12 00:00:00', 31),
(45, 3, 23, '""', 'asdasd', 'sdfsdf', '234', 'ssdf sf sdf', '234234234', 'ssdf@sdfsdf', 1, 7, '6.934023, 79.845219', '2014-12-13 04:48:56', 1, '2015-03-13 00:00:00', 31),
(46, 23, 29, '{"brand":"apple","touchscreen":"Touchscreen"}', 'Apple iPhone 5s', 'iPhone 5s for sale. \nPrice negotiable', '100000', 'Dhammika Gunaratne', '123456789', 'dhammika97@gmail.com', 2, 6, '6.934023, 79.845219', '2014-12-17 06:42:25', 1, '2015-03-13 00:00:00', 31),
(47, 17, 28, '""', 'test ad', 'mkasdj alsdl adlajsdlajsldaj dia djad asj d ajsd jasd jjlaj sdljalsd jlkasjdjajsd lkaj sdlajsdl ajjd laks dasdj aljs dad laks jdlajsldj lask dja sd asd', '54100', 'Dhammika', '789456123', 'test@test.test', 6, 5, '6.934023, 79.845219', '2014-12-13 18:00:50', 1, '2015-03-13 00:00:00', 1),
(48, 17, 28, '""', 'asdasd asd asdas d', 'sdfs fsdf sldf sf   jsfjsdf lsf jsldfj sdf sdhfsdfh s fshdf sod foshfo s oishf oshdfh sodfhos dfoh sohdfoh sf', '123456', 'test name', '874512369', 'test@sdfsdf', 6, 1, '6.934023, 79.845219', '2014-12-13 18:00:47', 1, '2015-03-13 00:00:00', 1),
(49, 17, 28, '""', 'asdasdd asd asd asd asd', 'sdfs dfsdfn lsdf sf s df s sld fls fs fso f', '8745', 'test ssdf', '987654', 'test@sdfsdf', 6, 6, '6.934023, 79.845219', '2014-12-13 18:00:45', 1, '2015-03-13 00:00:00', 1),
(50, 15, 26, '""', 'Nikon d3200', 'sfsd sdf slf lsd jsf sdj fo sdof osof osd hfi isd fj jps pjf spjd f', '12333', 'test', '123456', 'test@123', 6, 6, '6.934023, 79.845219', '2014-12-14 17:43:11', 1, '2015-03-14 00:00:00', 31),
(51, 3, 24, '""', 'test testte', 'test test test test etst set set set', '123', 'test test', '234234', 'test@test.test', 6, 3, '6.934023, 79.845219', '2014-12-14 17:50:17', 1, '2015-03-14 00:00:00', 31),
(52, 15, 25, '""', 'asd asd', 'sdfsdf sdf sdf', '123', 'wewer', '123', 'sdf@sdf', 6, 1, '6.934023, 79.845219', '2014-12-15 09:19:43', 1, '2015-03-15 00:00:00', 31),
(53, 17, 28, '""', 'asdasd asd asd', 'dsdfsdfsdf', '234', 'asdasddasd', '12312', 'sdfsd@sdfsd', 6, 5, '6.934023, 79.845219', '2014-12-15 09:19:46', 1, '2015-03-15 00:00:00', 31),
(54, 23, 29, '{"brand":"apple","touchscreen":"Touchscreen"}', 'Apple 2', 'sdsd sd ad asd asd', '23', 'asdasdasd', '344234', 'sdsdfs@sdfsdf', 6, 1, '6.934023, 79.845219', '2014-12-23 05:44:03', 1, '2015-03-15 00:00:00', 31),
(55, 17, 28, '""', 'test test', 'test description test description test description test description', '12500', 'test name', '987654321', 'test@test', 6, 4, '6.934023, 79.845219', '2014-12-15 16:25:08', 1, '2015-03-15 00:00:00', 31),
(56, 17, 28, '""', 'ssfdfsdf', 'sdfsdfsdfsdf sdfsdf', '123', 'sfsdfsdf', '123123123', 'sdf@sdf', 6, 4, '6.934023, 79.845219', '2014-12-16 15:49:35', 1, '2015-03-15 00:00:00', 31),
(57, 23, 29, '{"brand":"samsung","touchscreen":"Touchscreen"}', 'Samsung 1', 'awesome phone, test test', '1234', 'test name', '987654321', 'test@test.com', 6, 1, '6.934023, 79.845219', '2014-12-23 05:44:13', 1, '2015-03-16 00:00:00', 31),
(58, 23, 29, '{"brand":"sony","touchscreen":"Touchscreen"}', 'Sony', 'sdfsdf sdf sdf sdf sdf', '123', 'estset setset', '23423', 'tesst@sdfsdf', 6, 4, '6.934023, 79.845219', '2014-12-23 05:44:21', 1, '2015-03-16 00:00:00', 31),
(59, 23, 29, '{"brand":"lg","touchscreen":"Touchscreen"}', 'LG', 'asdasdasd asdasdasd', '456123', 'asdasd asd asd', 'ssdcsdf sdf', 'tesd@sdfsdf', 6, 5, '6.934023, 79.845219', '2014-12-23 05:44:32', 1, '2015-03-16 00:00:00', 31),
(60, 28, 33, '{"brand":"suzuki","model":"Wagon R","year":"2004","bodyType":"SUV","condition":"Recondition","transmission":"Manual","fuelType":"Patrol"}', 'test car advertisement', 'A/C, Power steering, Power shutters, Rivers Camera, TV/ DVD Mint Condition', '120000', 'Dhammika Gunaratne', '777339803', 'dhammika9@gmail.com', 6, 1, '6.934023, 79.845219', '2014-12-17 06:48:46', 1, '2015-03-17 00:00:00', 31),
(61, 29, 34, '{"applyEmail":"dhammika97@gmail.com","companyName":"company name","jobType":"Full time","salary":"20000"}', 'test advertisement', 'test description', '123456', 'test name', '789456', 'test@test.test', 6, 1, '6.934023, 79.845219', '2014-12-17 19:15:46', 1, '2015-03-17 00:00:00', 31),
(62, 28, 33, '{"brand":"tata","model":"Corolla","year":"2000","bodyType":"Station wagon","condition":"Recondition","transmission":"Manual","fuelType":"Patrol"}', 'AE 110', 'this is test description', '150000', 'test nm', '987654', 'test@test', 6, 5, '6.934023, 79.845219', '2014-12-17 19:15:41', 1, '2015-03-17 00:00:00', 31),
(63, 28, 33, '{"brand":"toyota","model":"test","year":"1234","bodyType":"Station wagon","condition":"Recondition","transmission":"Automatic","fuelType":"Diesel"}', 'test test tteste', 'ssdf sdf sdf sdfs f\ns dfsdf \ns dfsf\ns dfs df\n sf sdf\n sdf', '123456', '123', '123', 'sdfsd@sdf', 6, 3, '6.934023, 79.845219', '2014-12-17 20:19:43', 1, '2015-03-17 00:00:00', 31),
(64, 29, 34, '{"jobType":"Full time","companyName":"test test test","applyEmail":"dsdf@sdfsdf","salary":"123456"}', 'test', 'test description, test description 2<div>test new line</div><div><br></div><div>est new line after new line</div><div><br></div><div><br></div><div>test test test</div>', '123', 'ssdfsd sdfsdf', '234234', 'sdfsd@ssfsdf', 6, 3, '6.934023, 79.845219', '2014-12-17 20:19:47', 1, '2015-03-17 00:00:00', 31),
(65, 23, 30, '""', 'test accessory item', 'Test Accessory Item will be going here', '123', 'test contact', '123456', 'test@test.test', 6, 5, '6.934023, 79.845219', '2014-12-21 14:20:57', 1, '2015-03-21 00:00:00', 31);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(5) NOT NULL AUTO_INCREMENT,
  `category_parentId` int(5) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_alias` varchar(255) NOT NULL,
  `category_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_enteredBy` int(11) NOT NULL,
  `category_status` int(1) NOT NULL,
  PRIMARY KEY (`category_id`)
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
  `category_sub_alias` varchar(255) NOT NULL,
  `category_sub_tplType` varchar(50) NOT NULL,
  `category_sub_enteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_sub_enteredBy` int(5) NOT NULL,
  `category_sub_status` int(1) NOT NULL,
  `category_sub_parentId` int(4) NOT NULL,
  PRIMARY KEY (`category_sub_id`),
  KEY `category_sub_id` (`category_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

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
(29, 'Mobile Phones', 'mobile-phones', 'Mobile', '2014-12-11 12:15:17', 1, 0, 23),
(30, 'Mobile Phone Accessories', 'mobile-phone-accessories', 'General', '2014-12-11 12:15:47', 1, 0, 23),
(31, 'Test Category', 'test-category', 'General', '2014-12-14 10:40:15', 1, 0, 17),
(32, 'Test2 Category', 'test2-category', 'General', '2014-12-14 10:40:49', 1, 0, 17),
(33, 'Cars', 'cars', 'Car', '2014-12-17 06:43:53', 1, 0, 28),
(34, 'Audit & Taxation Jobs', 'audit-taxation-jobs', 'Job', '2014-12-17 15:57:31', 1, 0, 29),
(35, 'Banking/ Financial Jobs', 'banking-financial-jobs', 'Job', '2014-12-17 15:58:13', 1, 0, 29);

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
(10, 'Test Title', '2014-12-10', 'Test Tile one', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', '366CDA5C04240EFB509B90B13FF094ADIMG_3709 - Copy.JPG', 1),
(11, 'second event', '2014-07-21', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of typ', '7D808022F03163B376DDE1727983163FIMG_3709.JPG', 1);

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
  `comment_Id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisment_Id` int(11) NOT NULL,
  `comment_Date` date NOT NULL,
  `comment_Time` time NOT NULL,
  `comment_status` int(11) NOT NULL,
  `comment_addedBy` int(11) NOT NULL,
  `Comment` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `item_comments`
--

INSERT INTO `item_comments` (`comment_Id`, `advertisment_Id`, `comment_Date`, `comment_Time`, `comment_status`, `comment_addedBy`, `Comment`) VALUES
(1, 46, '2014-12-13', '05:58:13', 1, 33, 'woww....'),
(2, 46, '2014-12-13', '05:58:28', 1, 33, 'woww....'),
(3, 60, '2014-12-17', '21:25:08', 1, 33, 'jjshfks dfskdhfs df sd fh sdf'),
(4, 46, '2014-12-17', '21:27:41', 1, 33, 'sksj dfhsoh fo sho sodhf osdf'),
(5, 60, '2014-12-17', '21:32:28', 1, 33, ''),
(6, 48, '2014-12-23', '19:01:14', 1, 33, 'wow. ilove this ad');

-- --------------------------------------------------------

--
-- Table structure for table `jobapplydetails`
--

CREATE TABLE IF NOT EXISTS `jobapplydetails` (
  `jobapplydetails_id` int(11) NOT NULL AUTO_INCREMENT,
  `jobapplydetails_ad_id` int(11) NOT NULL,
  `jobapplydetails_employee_email` varchar(100) NOT NULL DEFAULT '',
  `jobapplydetails_employee_phoneno` varchar(20) NOT NULL DEFAULT '',
  `jobapplydetails_employee_massage` longtext NOT NULL,
  `jobapplydetails_employee_userid` int(11) NOT NULL,
  `jobapplydetails_employer_userid` int(11) NOT NULL,
  `jobapplydetails_appliedon` datetime NOT NULL,
  `jobapplydetails_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`jobapplydetails_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jobapplydetails`
--

INSERT INTO `jobapplydetails` (`jobapplydetails_id`, `jobapplydetails_ad_id`, `jobapplydetails_employee_email`, `jobapplydetails_employee_phoneno`, `jobapplydetails_employee_massage`, `jobapplydetails_employee_userid`, `jobapplydetails_employer_userid`, `jobapplydetails_appliedon`, `jobapplydetails_status`) VALUES
(1, 61, 'test@test.test', 'sdfdf', 'sdddfb', 31, 31, '2014-12-21 00:00:00', 0),
(2, 61, 'test@test.test', 'sdfdf', 'sdddfb', 31, 31, '2014-12-21 00:00:00', 0),
(3, 61, 'test@test.test', 'sdfsdf', 'sdfsdf', 31, 31, '2014-12-21 00:00:00', 0),
(4, 61, 'test@test.test', 'dfgdf', 'sfsdfsdf', 31, 31, '2014-12-21 00:00:00', 0),
(5, 64, 'test@test.test', 'sdfsdf', 'sdfsdf', 31, 31, '2014-12-21 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(5) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) NOT NULL,
  `location_alias` varchar(255) NOT NULL,
  `location_cordinates` varchar(20) NOT NULL,
  PRIMARY KEY (`location_id`)
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
(16, 'News Title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type kjh hashd ausd asd asd asd asd asd asd asd asd asd asd a', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type', '03BB9153F7971D6E7F8FD3A9D76821ABIMG_3711.JPG', '2014-12-04 00:00:00', 1),
(17, 'sdcsa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500', 'sDASD', 'C99E2B231C92E6AB22C055DA757FAFB1IMG_3713.JPG', '2014-12-05 00:00:00', 1);

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
  `package_mode` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `packagetypes`
--

INSERT INTO `packagetypes` (`package_id`, `packageType`, `package_name`, `package_Description`, `package_price`, `package_adLimit`, `package_addedBy`, `package_status`, `package_mode`) VALUES
(1, 0, 'test package', 'test description', '2500', 3, 1, 0, 3),
(3, 0, 'test package 3', 'test', '2500', 300, 1, 0, 1),
(7, 0, 'test first', 'test description', '21540', 15, 1, 1, 2),
(9, 1, 'ssdf', 'sdfsf asdasdas dasdas', '123', 123, 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_content`, `page_status`, `page_addedBy`) VALUES
(1, 'About Us', '<p><b>Qatar One is the fast and easy way to buy and sell your</b> &nbsp;in more than 30 different categories. It can be your car, job vacancy, real estate, and everything else. Also find what you''re looking for or create your own <b>Itâ€™s free</b>.</p><ul><li>Within seconds you can list an item for sale.</li><li>Within minutes your item will appear on Qatar One</li><li>Within hours youâ€™ll hear from interested buyers</li><li>Within days youâ€™ll meet up with buyers and trade your stuff for cash</li><li>Within weeks you will have simplified and improved your life</li></ul><div><br></div><div><br></div><p>Sell your used phone sitting in your drawer.<br></p><p>Sell the guitar you never really play.<br></p><p>Sell your sisterâ€™s baby stroller thatâ€™s hiding in her closet.<br></p><p>Sell your motorcycle and upgrade to a newer one.<br></p><p>Sell those shoes that donâ€™t quite fit.<br></p><p><br></p><p>On Qatar One, there are buyers for almost anything you have to sell.</p><p>Millions have already sold their stuff Qatar One. You can too.</p><p>Donâ€™t just let it sit there. START SELLING YOUR STUFF that you don''t need</p><p><br></p><p>We invest a great deal of time and effort in monitoring and filtering the content posted to the website, so you can be confident that you''ll find only quality, relevant listings. We also carefully review all ads that are being published, to make sure the quality is up to our standards.<br></p>', 0, 1),
(2, 'Site Map', '<ul type=''disc''>\n    <li><a href=''/qatarone/web/site/''>Home</a></li>\n    <li><a href=''/qatarone/web/site/app/#/login''>Login</a></li>\n <li><a href=''/qatarone/web/site/app/#/settings''>User Profile</a></li>\n    <li><a href=''/qatarone/web/site/app/#/portal/classified''>Classified</a></li>\n    <li><a href=''/qatarone/web/site/app/#/portal/jobs''>Jobs</a></li>\n    <li><a href=''/qatarone/web/site/app/#/packages-view''>Packages</a></li>    \n    <li><a href=''/qatarone/web/site/app/#/post-ad''>Post Advertisment</a></li>\n    <li><a href=''/qatarone/web/site/app/#/pages/AboutUs''>About Us</a></li>\n    <li><a href=''/qatarone/web/site/app/#/pages/SiteMap''>Sitemap</a></li>        <li><a href=''/qatarone/web/site/app/#/pages/TermsOfUse''>Terms Of Use</a></li>\n    <li><a href=''/qatarone/web/site/app/#/pages/PrivacyPolicy''>Privacy Policy</a></li>\n<li><a href=''/qatarone/web/site/app/#/pages/FAQ''>FAQ</a></li>\n<li><a href=''/qatarone/web/site/app/#/contact-us''>Contact Us</a></li>\n</ul>', 0, 1),
(3, 'Terms of Use', '<p>Qatar One is a service provided by Black Shadow Group (subject to your compliance with the Terms and Conditions set forth below). Please read these Terms and Conditions before using this Web Site.<br></p><p>General: Advertisers and users are responsible for ensuring that advertising content, text, images, graphics, video (''Content'') uploaded for inclusion on Qatar One complies with all applicable laws. Qatar One assumes no responsibility for any illegality or any inaccuracy of the Content.<br></p><p>The advertisers and user guarantees that his or her Content do not violate any copyright, intellectual property rights or other rights of any person or entity, and agrees to release Qatar One and Black Shadow Group from all obligations, liabilities and claims arising in connection with the use of (or the inability to use) the service.<br></p><p>Advertisers agree that their Content can may be presented through Qatar Oneâ€™s partner sites under the same terms and conditions as on Qatar One.&nbsp;<br></p><p>Copyright: Advertisers grant Qatar One and Black Shadow Group a perpetual, royalty-free, irrevocable, non-exclusive right and license to use, reproduce, modify, adapt, publish, translate, create derivative works from and distribute such Content or incorporate such Content into any form, medium, or technology now known or later developed.<br></p><p>The material (including the Content, and any other content, software or services) contained on Qatar One are the property of Black Shadow Group, its subsidiaries, affiliates and/or third party licensors. Any intellectual property rights, such as copyright, trademarks, service marks, trade names and other distinguishing brands on the Web Site are the property of Black Shadow Group. To be clear: No material on this site may be copied, reproduced, republished, installed, posted, transmitted, stored or distributed without written permission from Black Shadow Group.<br></p><p>Watermarks: All images on Qatar One are watermarked, which prevents the images to be used for other purposes, without the consent of the advertiser.<br></p><p>Safety and images: Qatar One and Black Shadow Group reserves the right to change the title of the Content, for editorial purposes. Qatar One and Black Shadow Group reserves the right not to publish images that are irrelevant or images that violate Qatar One''s rules.<br></p><p>Personal: Qatar One and Black Shadow Group has the right to cooperate with authorities in the case any Content violates the law. The identity of advertisers, users or buyers may be determined, for example by an ISP. IP addresses may also be registered in order to ensure compliance with the terms and conditions.<br></p><p>Privacy: Qatar One and Black Shadow Group will collect information from Users and Advertisers. It is a condition of use of the Qatar One that each User and advertiser consents and authorises Qatar One and Black Shadow Group to collect and use this information. Qatar One and Black Shadow Group also reserves the right to disclose it to Company Affiliates and any other person for the purposes of administering, supporting and maintaining Qatar One, as well as for improving Qatar One, for example by using the information for research, marketing, product development and planning.<br></p><p>Cookies: This site uses cookies, which means that you must have cookies enabled on your computer in order for all functionality on this site to work properly. A cookie is a small data file that is written to your hard drive when you visit certain Web sites. Cookie files contain certain information, such as a random number user ID that the site assigns to a visitor to track the pages visited. A cookie cannot read data off your hard disk or read cookie files created by other sites. Cookies, by themselves, cannot be used to find out the identity of any user.<br></p><p>Email Address of Users: Users are required to submit a valid email address, before they are allowed to post advertisements. The email address of the User shall not be publicly displayed and other users are permitted to send email to the User through Qatar One.<br></p><p>Site availability: Qatar One and Black Shadow Group does not guarantee continuous or secure access to the Web Site. The Web Site is provided ''as is'' and as and when available.<br></p><p>Links to third party websites: Qatar One may contain links or references to other websites (''Third Party Websites''). Qatar One or Black Shadow Group shall not be responsible for the contents in Third Party Websites. Third Party Websites are not investigated or monitored. In the event the user decides to leave Qatar One and access Third Party Sites, the user does so at his/her own risk.<br></p><p>Paid content: Advertisers and Users wishing to post content on Qatar One that requires payment (''Paid Content''), may be required to transmit information through a third-party service provider, which may be governed by its own terms of use. Linking to any third party service providers is at the Users'' and Advertisers'' own risk and Qatar One disclaims all liability related thereto. Under no circumstances shall Qatar One be obliged to refund any payments made in respect of Paid Content.<br></p><p>In the event that Paid Content violates any aspect of these Terms &amp; Conditions, Qatar One may, in its sole discretion and without refund, remove the Paid Content from Qatar One. Users and Advertisers may delete any Paid Content prior to the end of the paid-for period, and Qatar One shall have no further responsibility to display the deleted content. Qatar One is neither responsible nor liable for the perceived success or failure of any Paid Content posted on Qatar One.<br></p><p>Disclaimer: Qatar One and Black Shadow Group assume no responsibility what so ever for the use of Qatar One and disclaims all responsibility for any injury, claim, liability, or damage of any kind resulting from or arising out of or any way related to (a) any errors on Qatar One or the Content, including but not limited to technical errors and typographical errors, (b) any third party web sites or content directly or indirectly accessed through links in Qatar One, (c) the unavailability of Qatar One, (d) your use of Qatar One or the Content, or (e) your use of any equipment (or software) in connection with Qatar One<br></p><p>Indemnification: Advertisers and users agree to indemnify Qatar One &amp; Black Shadow Group as well as its officers, directors, employees, agents, from and against all losses, expenses, damages and costs, including attorneyâ€™s fees, resulting from any violation of this Terms and Conditions (including negligent or wrongful conduct).<br></p><p>Modifications: Qatar One &amp; Black Shadow Group reserves the right to modify these Terms and Conditions. Such modifications shall be effective immediately upon posting on Qatar One. You are responsible for the reviewing of such modifications. Your continued access or use of Qatar One shall be deemed your acceptance of the modified terms and conditions.<br></p><p>Governing Law: Qatar One is operated under the laws and regulations of Sweden. Advertisers and users agree that Swedish courts, with the district court of Gothenburg as the court of first instance, will have jurisdiction over any dispute or claim relating to the use of Qatar One.<br></p><p><br></p>', 0, 1),
(4, 'Privacy Policy', '<p>This policy details how data about you is collected/used/disclosed when you visit our websites and services (together, ''Qatar One'') or otherwise interact with us. If we update it, we will revise the date, place notices on Qatar One if a change is material, and/or obtain your consent as required by law.<br></p><p></p><ol><li>Protecting your privacy<br></li></ol><ul><li>We take precautions to prevent unauthorized access to or misuse of data about you.<br></li><li>We do not run ads, other than classified ads posted by our users.<br></li><li>We do not share your data with third parties for marketing purposes.<br></li><li>We do not engage in cross-marketing or link-referral programs with other sites.<br></li><li>We do not employ tracking devices for marketing purposes.<br></li><li>We do not send you unsolicited communications for marketing purposes.<br></li><li>We do not engage in affiliate marketing (and prohibit it on Qatar One).<br></li><li>We do provide email proxy &amp; relay to reduce unwanted mail.<br></li><li>Qatar One links to third party sites - please review their privacy policies.</li></ul><p></p>', 0, 31),
(5, 'FAQ', 'FAQs will be going here...', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating_ad_id` int(11) NOT NULL,
  `rating_user_id` int(11) NOT NULL,
  `rating_rate` int(2) NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rating_ad_id`, `rating_user_id`, `rating_rate`) VALUES
(1, 43, 31, 2),
(2, 43, 31, 4),
(3, 42, 31, 3),
(4, 48, 31, 5),
(5, 48, 31, 2),
(6, 48, 31, 1),
(7, 46, 31, 2),
(8, 46, 31, 3),
(9, 54, 31, 2),
(10, 45, 31, 3);

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
  `suburb_alias` varchar(255) NOT NULL,
  `suburb_cordinates` varchar(20) NOT NULL,
  PRIMARY KEY (`suburb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `suburbs`
--

INSERT INTO `suburbs` (`suburb_id`, `suburb_location_id`, `suburb_name`, `suburb_alias`, `suburb_cordinates`) VALUES
(1, 6, 'Battaramulla', 'battaramulla', '6.902156, 79.919463'),
(3, 6, 'Nugegoda', 'nugegoda', '6.869861, 79.888392'),
(4, 6, 'Maharagama', 'maharagama', '6.848130, 79.927617'),
(5, 6, 'Rajagiriya', 'rajagiriya', '6.908973, 79.897919'),
(6, 6, 'Colombo 6', 'colombo-6', '6.873781, 79.863329'),
(7, 6, 'Dehiwala', 'dehiwala', '6.851284, 79.865904');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_firstname`, `user_lastname`, `user_address1`, `user_address2`, `user_city`, `user_contactNo`, `user_registeredDate`, `user_type`, `user_status`, `user_accessToken`) VALUES
(1, 'dhammika97', '202cb962ac59075b964b07152d234b70', 'dhammika97@gmail.com', 'dhammika', 'gunaratne', '176/4, walatenna', 'gallellagama', 'kandy', '777339803', '2014-11-20 00:00:00', 0, 1, 'kjsjjdfshdfhsdbfjhsbdfsdfsf'),
(31, '', '202cb962ac59075b964b07152d234b70', 'dhammika9@gmail.com', 'Dumi', 'gunaratne', '', '', '', '', '2014-12-06 00:00:00', 3, 1, '1C078C9F93582F9D780C55507BB274B6'),
(32, '', '202cb962ac59075b964b07152d234b70', 'damn@123.com', '123', '123', '', '', '', '', '2014-12-09 00:00:00', 3, 1, 'BD9EC52A01EF7DD33EFE5AB92EC7D99F'),
(33, '', '202cb962ac59075b964b07152d234b70', 'dumi@gmail.com', 'dumi', 'lastname', '', '', '', '', '2014-12-14 00:00:00', 3, 1, 'B64060E5C17D421C572B92A4E3B9CFB0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `userpackge`
--

INSERT INTO `userpackge` (`userpkg_id`, `userpkg_userId`, `userpkg_pkgId`, `userpkg_remainAds`, `userpkg_expirey`, `userpkg_status`) VALUES
(1, 31, 1, 1, '0000-00-00', 1),
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
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_email` varchar(50) NOT NULL,
  `subscription_status` int(11) NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usersubscription`
--

INSERT INTO `usersubscription` (`subscription_id`, `subscription_email`, `subscription_status`) VALUES
(1, 'dhammika97@gmail.com', 1),
(2, 'dfgdfg', 1),
(3, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_title` varchar(255) NOT NULL,
  `video_filename` varchar(200) NOT NULL,
  `video_status` int(1) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
