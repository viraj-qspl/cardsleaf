-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2012 at 07:52 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `mp_area`
--

CREATE TABLE `mp_area` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `city_id` int(5) NOT NULL,
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `mp_area`
--

INSERT INTO `mp_area` (`id`, `name`, `city_id`, `status`) VALUES
(1, 'Miramar', 1, 'active'),
(2, 'Market', 1, 'active'),
(5, 'Bus-stand', 1, 'active'),
(4, 'Kala Academy', 1, 'active'),
(10, 'market', 35, 'active'),
(13, 'Bus stand', 35, 'active'),
(12, 'Bhailee peth', 35, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_buy_sell`
--

CREATE TABLE `mp_buy_sell` (
  `id` int(25) NOT NULL auto_increment,
  `category_id` int(5) NOT NULL,
  `sub_category_id` int(5) NOT NULL,
  `listing_type` enum('wanted','offer') collate latin1_general_ci NOT NULL,
  `urgent` enum('yes','no') collate latin1_general_ci NOT NULL,
  `title` varchar(100) collate latin1_general_ci NOT NULL,
  `details` text collate latin1_general_ci NOT NULL,
  `price_type` enum('fixed','negotiable','contact') collate latin1_general_ci NOT NULL,
  `price` float default NULL,
  `contact_name` varchar(100) collate latin1_general_ci default NULL,
  `phone` varchar(250) collate latin1_general_ci default NULL COMMENT 'multiple phone numbers separated by commas',
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `contact_type` enum('email','phone','both') collate latin1_general_ci NOT NULL COMMENT 'Customer can contact by email/phone/both',
  `show_contact_public` tinyint(1) NOT NULL,
  `address` varchar(255) collate latin1_general_ci default NULL,
  `landmark` varchar(200) collate latin1_general_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `area_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `pincode` int(6) NOT NULL,
  `owner_id` int(16) NOT NULL,
  `user_id` int(16) NOT NULL,
  `user_type` enum('owner','broker','other') collate latin1_general_ci NOT NULL,
  `listing_days` int(5) NOT NULL,
  `listing_start_date` timestamp NULL default NULL,
  `listing_end_date` timestamp NULL default '0000-00-00 00:00:00',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL default NULL,
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mp_buy_sell`
--

INSERT INTO `mp_buy_sell` (`id`, `category_id`, `sub_category_id`, `listing_type`, `urgent`, `title`, `details`, `price_type`, `price`, `contact_name`, `phone`, `email`, `contact_type`, `show_contact_public`, `address`, `landmark`, `country_id`, `state_id`, `area_id`, `city_id`, `pincode`, `owner_id`, `user_id`, `user_type`, `listing_days`, `listing_start_date`, `listing_end_date`, `created_date`, `updated_date`, `status`) VALUES
(1, 3, 7, 'wanted', 'yes', 'Need mercedes', 'looking for mercedes', 'contact', 100000, 'Sandeep raul', '90909090', 'sand@deep.com', 'phone', 1, 'villla god', 'near miramar beack', 0, 0, 4, 1, 0, 0, 6, 'other', 30, '2012-07-26 13:07:19', '0000-00-00 00:00:00', '2012-07-26 13:07:19', '0000-00-00 00:00:00', 'active'),
(3, 3, 7, 'wanted', 'yes', 'need mercerd', 'this is my descript', 'fixed', 1000, 'Ravi chopra', '8080', 's@somcom', 'both', 1, 'bilding', 'no landlamr', 0, 0, 2, 1, 0, 0, 6, 'owner', 30, '2012-07-08 14:07:45', '0000-00-00 00:00:00', '2012-07-08 14:07:45', '0000-00-00 00:00:00', 'active'),
(4, 3, 6, 'offer', 'yes', 'Want to sell bike', 'My bioke is 5yr old', 'fixed', 12000, 'savio', '98989898001', 'sa@asa,com', 'both', 1, '', '', 0, 0, 0, 0, 0, 0, 6, 'owner', 30, '2012-07-26 13:07:59', '0000-00-00 00:00:00', '2012-07-26 13:07:59', '0000-00-00 00:00:00', 'active'),
(5, 3, 6, 'offer', 'yes', 'want a phone', 'ooking for smartphone', 'fixed', 3000, 'san', '1234567', 'goa@goa', 'both', 1, 'goa', 'goa', 1, 1, 2, 1, 0, 0, 6, 'owner', 30, '2012-08-09 17:08:41', '0000-00-00 00:00:00', '2012-08-09 17:08:41', '0000-00-00 00:00:00', 'active'),
(6, 3, 7, 'offer', 'yes', 'Omni car of model 2005', 'best condition, single handed, all clear docs..', 'contact', 0, 'Tanaji Pal', '790342234, 23423432', 'sandeep.@gmai.com', 'email', 1, '', '', 1, 1, 0, 1, 123, 0, 6, 'owner', 30, '2012-08-12 12:08:52', '0000-00-00 00:00:00', '2012-08-12 12:08:52', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_buy_sell_image`
--

CREATE TABLE `mp_buy_sell_image` (
  `id` int(25) NOT NULL auto_increment,
  `entity_id` int(25) NOT NULL,
  `filename` varchar(255) collate latin1_general_ci NOT NULL,
  `is_main_image` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mp_buy_sell_image`
--


-- --------------------------------------------------------

--
-- Table structure for table `mp_category`
--

CREATE TABLE `mp_category` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `parent_id` int(5) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `mp_category`
--

INSERT INTO `mp_category` (`id`, `name`, `parent_id`, `created_date`, `updated_date`, `status`) VALUES
(1, 'Electronics', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 'Camera', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 'Automobiles', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(8, 'my-category', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(5, 'Home store', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(6, 'Two wheelers', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(7, 'Four Wheelers', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(10, 'cat-one-2', 0, '2012-08-12 17:12:01', '0000-00-00 00:00:00', 'active'),
(11, 'cat1-subcat1', 10, '2012-08-12 17:22:32', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_category_group`
--

CREATE TABLE `mp_category_group` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mp_category_group`
--

INSERT INTO `mp_category_group` (`id`, `name`, `created_date`, `updated_date`, `status`) VALUES
(9, 'Group42', '2012-08-12 17:22:08', '0000-00-00 00:00:00', 'active'),
(2, 'Buy and Sell', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 'Real Estates', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(4, 'Events', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(5, 'Jobs', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(6, 'Education', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(7, 'Public QA', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_city`
--

CREATE TABLE `mp_city` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `state_id` int(5) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `mp_city`
--

INSERT INTO `mp_city` (`id`, `name`, `state_id`, `created_date`, `updated_date`, `status`) VALUES
(35, 'Bicholim', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 'Margao', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 'Mapusa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(36, 'Vasco', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(1, 'Panjim', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(38, 'St Cruz', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(39, 'Ponda', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(40, 'Dona Paula', 1, '2012-08-12 16:58:28', '0000-00-00 00:00:00', 'active'),
(42, 'New york street', 10, '2012-08-05 20:38:13', '0000-00-00 00:00:00', 'active'),
(43, 'Dallas', 11, '2012-08-05 20:38:13', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_country`
--

CREATE TABLE `mp_country` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mp_country`
--

INSERT INTO `mp_country` (`id`, `name`, `created_date`, `updated_date`, `status`) VALUES
(1, 'India', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 'US', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 'Japan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(7, 'Britan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_event`
--

CREATE TABLE `mp_event` (
  `id` int(25) NOT NULL auto_increment,
  `category_id` int(5) NOT NULL,
  `sub_category_id` int(5) NOT NULL,
  `urgent` enum('yes','no') collate latin1_general_ci NOT NULL,
  `title` varchar(100) collate latin1_general_ci NOT NULL,
  `details` text collate latin1_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `entry_type` enum('free','paid') collate latin1_general_ci default NULL,
  `entry_fees` varchar(100) collate latin1_general_ci NOT NULL COMMENT 'enter multiple fees with comma separated',
  `contact_name` varchar(100) collate latin1_general_ci default NULL,
  `phone` varchar(250) collate latin1_general_ci default NULL COMMENT 'multiple phone numbers separated by commas',
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `contact_type` enum('email','phone','both') collate latin1_general_ci NOT NULL COMMENT 'Customer can contact by email/phone/both',
  `show_contact_public` tinyint(1) NOT NULL default '1',
  `address` varchar(255) collate latin1_general_ci default NULL,
  `landmark` varchar(200) collate latin1_general_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `area_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `pincode` int(6) NOT NULL,
  `owner_id` int(16) NOT NULL,
  `user_id` int(16) NOT NULL,
  `listing_days` int(5) NOT NULL,
  `listing_start_date` timestamp NULL default NULL,
  `listing_end_date` timestamp NULL default '0000-00-00 00:00:00',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL default NULL,
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mp_event`
--

INSERT INTO `mp_event` (`id`, `category_id`, `sub_category_id`, `urgent`, `title`, `details`, `start_date`, `end_date`, `start_time`, `end_time`, `entry_type`, `entry_fees`, `contact_name`, `phone`, `email`, `contact_type`, `show_contact_public`, `address`, `landmark`, `country_id`, `state_id`, `area_id`, `city_id`, `pincode`, `owner_id`, `user_id`, `listing_days`, `listing_start_date`, `listing_end_date`, `created_date`, `updated_date`, `status`) VALUES
(2, 1, 2, 'yes', 'Auto exhibition', 'all types of auto exhibition', '2012-08-15', '2012-08-17', '08:00:00', '10:00:00', 'paid', '5000', 'Sandeep', '90901212123', 'san@san.com', 'both', 1, 'devul vadapppp', 'temple--ppp', 0, 0, 8, 35, 0, 0, 6, 30, '2012-07-27 16:07:10', '0000-00-00 00:00:00', '2012-07-27 16:07:10', '0000-00-00 00:00:00', 'active'),
(5, 3, 6, 'no', 'Two wheeler exhibition', 'asdhs aldkladsh', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'paid', '100, 200, 500', 'ooooooo', '8321213123, 123123123', 'sdasdas', 'both', 1, '', '', 0, 0, 10, 35, 0, 0, 6, 30, '2012-07-28 16:07:27', '0000-00-00 00:00:00', '2012-07-28 16:07:27', '0000-00-00 00:00:00', 'active'),
(6, 3, 6, 'no', 'New event 1011', 'some details', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'free', '', 'Sandy', '12121212', 'san@sand.com', 'both', 1, 'baba', '', 2, 10, 0, 42, 234, 0, 6, 30, '2012-08-09 17:08:01', '0000-00-00 00:00:00', '2012-08-09 17:08:01', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_event_image`
--

CREATE TABLE `mp_event_image` (
  `id` int(25) NOT NULL auto_increment,
  `entity_id` int(25) NOT NULL,
  `filename` varchar(255) collate latin1_general_ci NOT NULL,
  `is_main_image` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mp_event_image`
--

INSERT INTO `mp_event_image` (`id`, `entity_id`, `filename`, `is_main_image`, `created_date`) VALUES
(1, 2, '1343410757.jpg', 0, '2012-07-27 23:09:18'),
(2, 2, '1343410912.jpg', 0, '2012-07-27 23:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `mp_job`
--

CREATE TABLE `mp_job` (
  `id` int(25) NOT NULL auto_increment,
  `category_id` int(5) NOT NULL,
  `sub_category_id` int(5) NOT NULL,
  `urgent` enum('yes','no') collate latin1_general_ci NOT NULL,
  `title` varchar(100) collate latin1_general_ci NOT NULL,
  `details` text collate latin1_general_ci NOT NULL,
  `listing_type` enum('offer','wanted') collate latin1_general_ci NOT NULL,
  `job_type` enum('full-time','part-time','contract','temporary','internship','other') collate latin1_general_ci NOT NULL,
  `post` enum('fresher','executive','sr.executive','manager','sr.manager','other') collate latin1_general_ci default NULL,
  `number_of_post` int(3) default NULL,
  `qualification` enum('advanced-degree','bachelors-degree','diploma-degree','higher-secondary','high-school','other') collate latin1_general_ci default NULL,
  `contact_name` varchar(100) collate latin1_general_ci default NULL,
  `phone` varchar(250) collate latin1_general_ci default NULL COMMENT 'multiple phone numbers separated by commas',
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `contact_type` enum('email','phone','both') collate latin1_general_ci NOT NULL COMMENT 'Customer can contact by email/phone/both',
  `show_contact_public` tinyint(1) NOT NULL,
  `address` varchar(255) collate latin1_general_ci default NULL,
  `landmark` varchar(200) collate latin1_general_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `area_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `pincode` int(6) NOT NULL,
  `owner_id` int(16) NOT NULL,
  `user_id` int(16) NOT NULL,
  `listing_days` int(5) NOT NULL,
  `listing_start_date` timestamp NULL default NULL,
  `listing_end_date` timestamp NULL default '0000-00-00 00:00:00',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL default NULL,
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mp_job`
--

INSERT INTO `mp_job` (`id`, `category_id`, `sub_category_id`, `urgent`, `title`, `details`, `listing_type`, `job_type`, `post`, `number_of_post`, `qualification`, `contact_name`, `phone`, `email`, `contact_type`, `show_contact_public`, `address`, `landmark`, `country_id`, `state_id`, `area_id`, `city_id`, `pincode`, `owner_id`, `user_id`, `listing_days`, `listing_start_date`, `listing_end_date`, `created_date`, `updated_date`, `status`) VALUES
(1, 3, 7, 'no', 'Motor mechanic part time job required', 'I am qualified person.. for motor mechanic', 'wanted', 'part-time', 'other', 1, 'high-school', 'Mr. Raju', '9090909', 'sandeep.raul@gmail.com', 'both', 1, 'bus stand ', 'near hotel krishna', 1, 1, 13, 35, 403101, 0, 6, 30, '2012-08-15 06:08:51', '0000-00-00 00:00:00', '2012-08-15 06:08:51', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_state`
--

CREATE TABLE `mp_state` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `country_id` int(5) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `mp_state`
--

INSERT INTO `mp_state` (`id`, `name`, `country_id`, `created_date`, `updated_date`, `status`) VALUES
(1, 'Goa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(8, 'Rajastan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 'Assam', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(7, 'Maharastra', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(5, 'west bengal', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(6, 'Kerala', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(10, 'New York', 2, '2012-08-05 20:37:23', '0000-00-00 00:00:00', 'active'),
(11, 'Texa', 2, '2012-08-05 20:37:23', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mp_user`
--

CREATE TABLE `mp_user` (
  `id` int(11) NOT NULL auto_increment,
  `user_type` enum('superadmin','admin','user') collate latin1_general_ci NOT NULL default 'user',
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `password` varchar(250) collate latin1_general_ci NOT NULL,
  `facebook_id` varchar(50) collate latin1_general_ci NOT NULL,
  `first_name` varchar(50) collate latin1_general_ci NOT NULL,
  `last_name` varchar(50) collate latin1_general_ci NOT NULL,
  `display_name` varchar(30) collate latin1_general_ci NOT NULL,
  `gender` enum('male','female') collate latin1_general_ci NOT NULL,
  `birth_date` date NOT NULL,
  `profile_image_filename` varchar(50) collate latin1_general_ci NOT NULL,
  `address` varchar(200) collate latin1_general_ci default NULL,
  `landmark` varchar(100) collate latin1_general_ci default NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) default NULL,
  `area_id` int(11) default NULL,
  `pincode` int(6) default NULL,
  `phone` varchar(50) collate latin1_general_ci default NULL,
  `created_date` timestamp NULL default CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `last_login_date` date NOT NULL,
  `status` enum('active','inactive','disabled','abused') collate latin1_general_ci NOT NULL default 'active',
  `log_details` text collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `mp_user`
--

INSERT INTO `mp_user` (`id`, `user_type`, `email`, `password`, `facebook_id`, `first_name`, `last_name`, `display_name`, `gender`, `birth_date`, `profile_image_filename`, `address`, `landmark`, `country_id`, `state_id`, `city_id`, `area_id`, `pincode`, `phone`, `created_date`, `updated_date`, `last_login_date`, `status`, `log_details`) VALUES
(5, 'user', 'san@san.com', '6627415e807ee33c7302917216e7da68', 'fb12345', 'Sandeep', 'Raul', 'Sandy', 'male', '1976-08-07', '0', 'bordem', 'near vad', 1, 1, 35, 6, 403105, '909090', '2012-08-09 17:08:03', '0000-00-00 00:00:00', '0000-00-00', 'active', NULL),
(6, 'superadmin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'adminn', 'admin', '', 'male', '0000-00-00', '0', '', '', 1, 1, 1, 0, 0, '', '2012-08-08 04:08:43', '0000-00-00 00:00:00', '0000-00-00', 'active', NULL),
(9, 'user', 'jdcosta@gmail.com', 'ppppp', '', 'Jhony', 'D''costa', '', 'male', '0000-00-00', '0', '', '', 2, 10, 42, 0, 0, '', '2012-08-09 16:08:32', '0000-00-00 00:00:00', '0000-00-00', 'active', NULL),
(12, 'user', 'aatreya', 'aaa', '', 'Aatreya', 'Raul', 'Meetu', 'male', '0000-00-00', '0', '', '', 2, 10, 42, 0, 0, '', '2012-08-09 17:08:58', '0000-00-00 00:00:00', '0000-00-00', 'active', NULL),
(11, 'user', 'varsha@gmail.com', 'varsha', '', 'varsha', 'raul', 'varsha', 'female', '0000-00-00', '0', 'bordem', 'near varcha wada', 1, 1, 35, 8, 0, '90900', '2012-08-05 10:08:56', '0000-00-00 00:00:00', '0000-00-00', 'active', NULL);
