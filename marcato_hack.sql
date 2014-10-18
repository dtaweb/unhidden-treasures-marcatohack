-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 18, 2014 at 07:41 PM
-- Server version: 5.1.73
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marcato_hack`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_sessions`
--

CREATE TABLE IF NOT EXISTS `current_sessions` (
`current_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `last_access` varchar(20) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `current_sessions`
--

INSERT INTO `current_sessions` (`current_id`, `user_id`, `session_id`, `last_access`) VALUES
(7, 1, '1b6ecda6a29522a084b067036fbb3069', '1413671929');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`eventID` int(11) unsigned NOT NULL,
  `eventName` varchar(255) NOT NULL,
  `eventStartDate` varchar(20) NOT NULL,
  `eventEndDate` varchar(20) NOT NULL,
  `eventStartTime` varchar(20) NOT NULL,
  `eventEndTime` varchar(20) NOT NULL,
  `eventCategoryID` int(11) NOT NULL,
  `eventDescription` varchar(150) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` varchar(20) NOT NULL,
  `timeCreated` int(11) NOT NULL,
  `eventThemeID` int(11) NOT NULL,
  `eventLocation` varchar(255) NOT NULL,
  `eventLocationGPS` varchar(50) NOT NULL,
  `eventPicture` varchar(255) NOT NULL,
  `eventContactInformation` longtext NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventName`, `eventStartDate`, `eventEndDate`, `eventStartTime`, `eventEndTime`, `eventCategoryID`, `eventDescription`, `createdBy`, `dateCreated`, `timeCreated`, `eventThemeID`, `eventLocation`, `eventLocationGPS`, `eventPicture`, `eventContactInformation`) VALUES
(3, 'Marcato Hackathong', 'Oct 18', 'Oct 19', '10:00AM', '8:00PM', 2, 'cdcvas', 1, '2014-10-18', 1413670062, 2, '53 Prince', '123', '', 'dscv sv lsd');

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE IF NOT EXISTS `event_categories` (
`eCategoryID` int(10) unsigned NOT NULL,
  `eCategoryType` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`eCategoryID`, `eCategoryType`) VALUES
(1, 'Farmers Market'),
(2, 'Craft Show'),
(3, 'Yard Sale'),
(4, 'Estate Sale'),
(5, 'Flea Market'),
(6, 'Small Business');

-- --------------------------------------------------------

--
-- Table structure for table `event_items`
--

CREATE TABLE IF NOT EXISTS `event_items` (
`eItemID` int(10) unsigned NOT NULL,
  `eventID` int(11) NOT NULL,
  `eItemDescription` varchar(155) NOT NULL,
  `eItemPriceMin` varchar(10) NOT NULL,
  `eItemPriceMax` varchar(10) NOT NULL,
  `vendorName` varchar(255) NOT NULL,
  `vendorContact` varchar(255) NOT NULL,
  `tableNumber` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_themes`
--

CREATE TABLE IF NOT EXISTS `event_themes` (
`eThemeID` int(10) unsigned NOT NULL,
  `eTheme` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `event_themes`
--

INSERT INTO `event_themes` (`eThemeID`, `eTheme`) VALUES
(1, 'Recurring Event'),
(2, 'One Time Event'),
(3, 'Holiday Special');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE IF NOT EXISTS `item_categories` (
`iCategoryID` int(10) unsigned NOT NULL,
  `iCategory` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`iCategoryID`, `iCategory`) VALUES
(1, 'Craft'),
(2, 'Food'),
(3, 'Apparel'),
(4, 'Technology/Electronics'),
(5, 'Antiques'),
(6, 'Sport'),
(7, 'Entertainment'),
(8, 'Collectables');

-- --------------------------------------------------------

--
-- Table structure for table `item_interest`
--

CREATE TABLE IF NOT EXISTS `item_interest` (
`iInterestID` int(10) unsigned NOT NULL,
  `iInterest` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lookup_item_event_category`
--

CREATE TABLE IF NOT EXISTS `lookup_item_event_category` (
`itemCategoryID` int(11) unsigned NOT NULL,
  `eItemID` int(11) NOT NULL,
  `iCategoryID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lookup_item_event_interest`
--

CREATE TABLE IF NOT EXISTS `lookup_item_event_interest` (
`itemInterestID` int(11) unsigned NOT NULL,
  `eItemID` int(11) NOT NULL,
  `iInterestID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_category` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `user_category`, `password`, `active`, `rating`) VALUES
(1, 'darren.t.andrews@gmail.com', 2, '123', 0, 0),
(2, 'me@here.com', 2, '234', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE IF NOT EXISTS `user_categories` (
`uCategoryID` int(10) unsigned NOT NULL,
  `uCategoryName` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_categories`
--

INSERT INTO `user_categories` (`uCategoryID`, `uCategoryName`) VALUES
(1, 'Single Vendor Event'),
(2, 'Event Organizer (Multiple Vendors)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `current_sessions`
--
ALTER TABLE `current_sessions`
 ADD PRIMARY KEY (`current_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
 ADD PRIMARY KEY (`eCategoryID`);

--
-- Indexes for table `event_items`
--
ALTER TABLE `event_items`
 ADD PRIMARY KEY (`eItemID`);

--
-- Indexes for table `event_themes`
--
ALTER TABLE `event_themes`
 ADD PRIMARY KEY (`eThemeID`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
 ADD PRIMARY KEY (`iCategoryID`);

--
-- Indexes for table `item_interest`
--
ALTER TABLE `item_interest`
 ADD PRIMARY KEY (`iInterestID`);

--
-- Indexes for table `lookup_item_event_category`
--
ALTER TABLE `lookup_item_event_category`
 ADD PRIMARY KEY (`itemCategoryID`);

--
-- Indexes for table `lookup_item_event_interest`
--
ALTER TABLE `lookup_item_event_interest`
 ADD PRIMARY KEY (`itemInterestID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
 ADD PRIMARY KEY (`uCategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `current_sessions`
--
ALTER TABLE `current_sessions`
MODIFY `current_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `eventID` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
MODIFY `eCategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `event_items`
--
ALTER TABLE `event_items`
MODIFY `eItemID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_themes`
--
ALTER TABLE `event_themes`
MODIFY `eThemeID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
MODIFY `iCategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `item_interest`
--
ALTER TABLE `item_interest`
MODIFY `iInterestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lookup_item_event_category`
--
ALTER TABLE `lookup_item_event_category`
MODIFY `itemCategoryID` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lookup_item_event_interest`
--
ALTER TABLE `lookup_item_event_interest`
MODIFY `itemInterestID` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
MODIFY `uCategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
