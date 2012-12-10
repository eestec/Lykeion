-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2012 at 09:19 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lykeion`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `Login_email` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `admin`
--


-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `intro` text NOT NULL,
  `tekst` longtext NOT NULL,
  `image` text NOT NULL,
  `category` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  `editable` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  `gallery` int(11) NOT NULL,
  `metatags` int(11) NOT NULL,
  `jobtype` int(11) NOT NULL,
  `scolarship` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `articles`
--


-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `when` varchar(2000) NOT NULL,
  `input` varchar(1000) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bugs`
--


-- --------------------------------------------------------

--
-- Table structure for table `category_articles`
--

CREATE TABLE IF NOT EXISTS `category_articles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `creation` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tabela sa kategorijama za artikle' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category_articles`
--


-- --------------------------------------------------------

--
-- Table structure for table `companys`
--

CREATE TABLE IF NOT EXISTS `companys` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(300) NOT NULL,
  `Field_of_work` varchar(1000) NOT NULL,
  `Number_of_emplyees` varchar(300) NOT NULL,
  `Contact_person` varchar(300) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `City` varchar(300) NOT NULL,
  `Country` varchar(300) NOT NULL,
  `Phone_number` varchar(50) NOT NULL,
  `Fax_number` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Web` varchar(150) NOT NULL,
  `Facebook` varchar(150) NOT NULL,
  `Linkedin` varchar(150) NOT NULL,
  `Twitter` varchar(150) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Logo` varchar(200) NOT NULL,
  `Login_email` varchar(150) NOT NULL,
  `Date_of_expire` date NOT NULL,
  `date_of_creation` date NOT NULL,
  `Status` varchar(20) NOT NULL,
  `About_company` varchar(5000) NOT NULL,
  `visible` int(2) NOT NULL,
  `views` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `companys`
--


-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) NOT NULL,
  `TITLE` varchar(50) DEFAULT NULL,
  `SUBJECT` varchar(1000) DEFAULT NULL,
  `ORG_NAME` varchar(100) DEFAULT NULL,
  `ORG_TYPE` varchar(50) DEFAULT NULL,
  `ORG_ADDRESS` varchar(100) DEFAULT NULL,
  `ORG_MUNIC` varchar(50) DEFAULT NULL,
  `COUNTRY` varchar(50) DEFAULT NULL,
  `EDULEVEL` varchar(1024) DEFAULT NULL,
  `EDU_FIELD` varchar(1024) DEFAULT NULL,
  `DAY_FROM` varchar(2) DEFAULT NULL,
  `MONTH_FROM` varchar(2) DEFAULT NULL,
  `YEAR_FROM` varchar(4) DEFAULT NULL,
  `DAY_TO` varchar(2) DEFAULT NULL,
  `MONTH_TO` varchar(2) DEFAULT NULL,
  `YEAR_TO` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table to store the Education list items' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `education`
--


-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `favorites`
--


-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `satisfied` varchar(20) NOT NULL,
  `update` varchar(15) NOT NULL,
  `addchange` varchar(5000) NOT NULL,
  `like` varchar(5000) NOT NULL,
  `keep` varchar(5000) NOT NULL,
  `general` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `feedback`
--


-- --------------------------------------------------------

--
-- Table structure for table `jobs_intersips`
--

CREATE TABLE IF NOT EXISTS `jobs_intersips` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `Number_of_interns` bigint(20) NOT NULL,
  `Duration` varchar(500) NOT NULL,
  `Paid_intership` tinyint(1) NOT NULL,
  `Accomodation_costs` tinyint(1) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Position` varchar(600) NOT NULL,
  `Deadline` datetime NOT NULL,
  `Forgein_language` text NOT NULL,
  `Internduties` text NOT NULL,
  `Academic_level` text NOT NULL,
  `Driving_licence` tinyint(1) NOT NULL,
  `Type_of` tinyint(1) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jobs_intersips`
--


-- --------------------------------------------------------

--
-- Table structure for table `languagelist`
--

CREATE TABLE IF NOT EXISTS `languagelist` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) NOT NULL,
  `CODE_LANGUAGE` varchar(3) DEFAULT NULL,
  `OLANGUAGE` varchar(30) DEFAULT NULL,
  `LISTENING` varchar(2) DEFAULT NULL,
  `READING` varchar(2) DEFAULT NULL,
  `SPOKEN_INTERACTION` varchar(2) DEFAULT NULL,
  `SPOKEN_PRODUCTION` varchar(2) DEFAULT NULL,
  `WRITING` varchar(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table to store the Other Language list Items' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `languagelist`
--


-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `query` text NOT NULL,
  `error` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `log`
--


-- --------------------------------------------------------

--
-- Table structure for table `metatags`
--

CREATE TABLE IF NOT EXISTS `metatags` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `keywords` text CHARACTER SET latin1,
  `description` text CHARACTER SET latin1,
  `custom_metatags` text CHARACTER SET latin1,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_bin COMMENT='tabela koja sadrzi metatagove za article i galerije odnoso s' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `metatags`
--


-- --------------------------------------------------------

--
-- Table structure for table `mm_messages_clients`
--

CREATE TABLE IF NOT EXISTS `mm_messages_clients` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_conversation` bigint(20) NOT NULL,
  `User` int(11) NOT NULL,
  `Readed` tinyint(1) NOT NULL,
  `Deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mm_messages_clients`
--


-- --------------------------------------------------------

--
-- Table structure for table `mm_messages_conversation`
--

CREATE TABLE IF NOT EXISTS `mm_messages_conversation` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Subject` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mm_messages_conversation`
--


-- --------------------------------------------------------

--
-- Table structure for table `mm_messages_conv_users`
--

CREATE TABLE IF NOT EXISTS `mm_messages_conv_users` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `User_ID` int(10) unsigned NOT NULL,
  `User` varchar(100) NOT NULL,
  `ID_user` int(10) unsigned NOT NULL,
  `User_type` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ID_user je za poruke a User_ID je od usera( student, company' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mm_messages_conv_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `mm_messages_msg`
--

CREATE TABLE IF NOT EXISTS `mm_messages_msg` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_conversation` bigint(20) unsigned NOT NULL,
  `Headline` varchar(250) NOT NULL,
  `MSG` text NOT NULL,
  `User` int(11) NOT NULL,
  `Send` datetime NOT NULL,
  `IP` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mm_messages_msg`
--


-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `type_id` int(10) NOT NULL,
  `number` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `publish_articles`
--

CREATE TABLE IF NOT EXISTS `publish_articles` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `article` int(11) NOT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `reads` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `published` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tabela koja sadrzi vremena odnosno broj prikazivanja za clan' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `publish_articles`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `Date_of_birth` date NOT NULL,
  `Country` varchar(80) NOT NULL,
  `City` varchar(80) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phone_number` varchar(30) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Nationality` varchar(50) NOT NULL,
  `Fax` varchar(20) NOT NULL,
  `Gender` varchar(3) NOT NULL,
  `Desired_employment` varchar(100) NOT NULL,
  `job_dates` varchar(100) NOT NULL,
  `Occupation` varchar(200) NOT NULL,
  `responsibilities` varchar(200) NOT NULL,
  `name_address` varchar(300) NOT NULL,
  `type` varchar(100) NOT NULL,
  `education_date` varchar(30) NOT NULL,
  `title_awarded` varchar(100) NOT NULL,
  `Principal_subjects` varchar(1000) NOT NULL,
  `name_of_organisation` varchar(500) NOT NULL,
  `level` varchar(100) NOT NULL,
  `education_field` varchar(200) NOT NULL,
  `mother_tongue` varchar(100) NOT NULL,
  `other_languages` varchar(500) NOT NULL,
  `social_skills` varchar(1000) NOT NULL,
  `organisational_skills` varchar(1000) NOT NULL,
  `technical_skills` varchar(1000) NOT NULL,
  `computer_skills` varchar(1000) NOT NULL,
  `artistic_skills` varchar(1000) NOT NULL,
  `other_skills` varchar(1000) NOT NULL,
  `driving_licence` int(2) NOT NULL,
  `additional_information` varchar(1000) NOT NULL,
  `annexes` varchar(1000) NOT NULL,
  `Country_code` varchar(10) NOT NULL,
  `Postal_code` varchar(10) NOT NULL,
  `Desired_code` varchar(30) NOT NULL,
  `Motherlang_code` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `students`
--


-- --------------------------------------------------------

--
-- Table structure for table `universitys`
--

CREATE TABLE IF NOT EXISTS `universitys` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Logo` varchar(200) NOT NULL,
  `Name_of_University` varchar(200) NOT NULL,
  `Name_of_Faculty` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `ZIP_code` varchar(50) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `Contact_person` varchar(200) NOT NULL,
  `Phone_number` varchar(50) NOT NULL,
  `Fax` varchar(50) NOT NULL,
  `Web` varchar(200) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Facebook` varchar(300) NOT NULL,
  `Twitter` varchar(150) NOT NULL,
  `Other` varchar(150) NOT NULL,
  `Number_of_students` varchar(50) NOT NULL,
  `About_University` text NOT NULL,
  `About_Faculty` text NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Login_email` varchar(150) NOT NULL,
  `Date_of_expire` date NOT NULL,
  `date_of_creation` date NOT NULL,
  `Status` varchar(30) NOT NULL,
  `views` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `universitys`
--


-- --------------------------------------------------------

--
-- Table structure for table `university_study`
--

CREATE TABLE IF NOT EXISTS `university_study` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `Bachelor` tinyint(1) NOT NULL,
  `Master` tinyint(1) NOT NULL,
  `Research` tinyint(1) NOT NULL,
  `Taught` tinyint(1) NOT NULL,
  `PhD` tinyint(1) NOT NULL,
  `Academic_PhD` tinyint(1) NOT NULL,
  `Professional_doctorate` tinyint(1) NOT NULL,
  `Predefined_PhD_project` tinyint(1) NOT NULL,
  `Open_PhD_programme` tinyint(1) NOT NULL,
  `Both` tinyint(1) NOT NULL,
  `Number_of_places` varchar(500) NOT NULL,
  `Department` varchar(500) NOT NULL,
  `Maximum_duration` tinyint(1) NOT NULL,
  `Winter` tinyint(1) NOT NULL,
  `Summer` tinyint(1) NOT NULL,
  `Years` varchar(200) NOT NULL,
  `English` tinyint(1) NOT NULL,
  `German` tinyint(1) NOT NULL,
  `Franch` tinyint(1) NOT NULL,
  `Spanish` tinyint(1) NOT NULL,
  `Italian` tinyint(1) NOT NULL,
  `Other` varchar(150) NOT NULL,
  `Topic` varchar(500) NOT NULL,
  `Required_average_grade` varchar(200) NOT NULL,
  `Out_of` varchar(200) NOT NULL,
  `Scjolarship` tinyint(1) NOT NULL,
  `Full_funding_provided` tinyint(1) NOT NULL,
  `Partially_funding_provided` tinyint(1) NOT NULL,
  `Contact_person` tinyint(1) NOT NULL,
  `Name_and_surname` varchar(200) NOT NULL,
  `CDepartment` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Day` tinyint(4) NOT NULL,
  `Month` tinyint(4) NOT NULL,
  `Year` smallint(6) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `university_study`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `City` varchar(80) NOT NULL,
  `Country` varchar(80) NOT NULL,
  `Date_of_birth` date NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Eestec` tinyint(1) NOT NULL,
  `Photo` varchar(400) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `CV` bigint(20) NOT NULL,
  `Last_login` datetime NOT NULL,
  `activation` varchar(50) NOT NULL,
  `subscribe` int(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE IF NOT EXISTS `work_experience` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) NOT NULL,
  `DAY_FROM` varchar(2) DEFAULT NULL,
  `MONTH_FROM` varchar(2) DEFAULT NULL,
  `YEAR_FROM` varchar(4) DEFAULT NULL,
  `DAY_TO` varchar(2) DEFAULT NULL,
  `MONTH_TO` varchar(2) DEFAULT NULL,
  `YEAR_TO` varchar(4) DEFAULT NULL,
  `CODE_POSITION` varchar(6) DEFAULT NULL,
  `WPOSITION` varchar(1024) DEFAULT NULL,
  `ACTIVITIES` varchar(1000) DEFAULT NULL,
  `EMPLOYER_NAME` varchar(50) DEFAULT NULL,
  `EMPLOYER_ADDRESS` varchar(50) DEFAULT NULL,
  `EMPLOYER_MUNIC` varchar(50) DEFAULT NULL,
  `EMPLOYER_ZCODE` varchar(10) DEFAULT NULL,
  `CODE_COUNTRY` varchar(3) DEFAULT NULL,
  `COUNTRY` varchar(30) DEFAULT NULL,
  `CODE_SECTOR` varchar(3) DEFAULT NULL,
  `SECTOR` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table to store the Work Experience list items' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `work_experience`
--

