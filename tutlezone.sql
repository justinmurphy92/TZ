-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2014 at 08:14 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tutlezone`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE IF NOT EXISTS `credentials` (
  `CREDENTIALS_USERID` int(11) NOT NULL AUTO_INCREMENT,
  `CREDENTIALS_USERNAME` varchar(32) NOT NULL,
  `CREDENTIALS_PASSWORD` varchar(40) DEFAULT NULL,
  `TYPECODE_ID` int(11) NOT NULL,
  `CREDENTIALS_CREATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREDENTIALS_LAST_LOGIN` datetime NOT NULL,
  `CREDENTIALS_FAILED_ATTEMPTS` int(11) NOT NULL,
  `CREDENTIALS_LOCKED` tinyint(1) NOT NULL,
  `CREDENTIALS_DISABLED` tinyint(1) NOT NULL,
  PRIMARY KEY (`CREDENTIALS_USERID`),
  UNIQUE KEY `CREDENTIALS_USERNAME` (`CREDENTIALS_USERNAME`),
  KEY `CREDENTIALS_USERID` (`CREDENTIALS_USERID`),
  KEY `TYPECODE_ID` (`TYPECODE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expertise`
--

CREATE TABLE IF NOT EXISTS `expertise` (
  `tutor_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `expertise_desc` varchar(256) NOT NULL,
  PRIMARY KEY (`tutor_id`),
  KEY `tutor_id` (`tutor_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE IF NOT EXISTS `lesson` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `lesson_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lesson_time` time NOT NULL,
  `lesson_length` int(11) NOT NULL,
  `lesson_title` varchar(32) NOT NULL,
  `lesson_desc` varchar(256) NOT NULL,
  `lesson_location` varchar(32) NOT NULL,
  `statuscode_id` int(11) NOT NULL,
  `lesson_comments` varchar(512) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  PRIMARY KEY (`lesson_id`),
  KEY `match_id` (`match_id`),
  KEY `subject_id` (`subject_id`),
  KEY `statuscode_id` (`statuscode_id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_userid` int(11) NOT NULL,
  `tutor_userid` int(11) NOT NULL,
  `match_rop` double NOT NULL,
  PRIMARY KEY (`match_id`),
  KEY `student_userid` (`student_userid`),
  KEY `tutor_userid` (`tutor_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE IF NOT EXISTS `method` (
  `method_id` int(11) NOT NULL AUTO_INCREMENT,
  `method_desc` varchar(256) NOT NULL,
  `method_abbr` varchar(6) NOT NULL,
  `method_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `method` (`method_id`, `method_desc`, `method_abbr`, `method_active`) VALUES
(1, 'A cash payment received from the student', 'Cash', true),
(2, 'A cheque received from the student', 'Cheque', true),
(3, 'A refund applied to the students account', 'Refund', true);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `credentials_userid` int(11) NOT NULL,
  `notification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification_content` varchar(255) NOT NULL,
  `notification_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`),
  KEY `credentials_userid` (`credentials_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `statuscode`
--

CREATE TABLE IF NOT EXISTS `statuscode` (
  `statuscode_id` int(11) NOT NULL AUTO_INCREMENT,
  `statuscode_desc` varchar(256) NOT NULL,
  `statuscode_abbr` varchar(25) NOT NULL,
  `statuscode_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`statuscode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `statuscode` (`statuscode_id`, `statuscode_desc`, `statuscode_abbr`, `statuscode_active`) VALUES
(1, 'A lesson that was scheduled for a time in the future.  Therefore, the lesson is pending.', 'Pending', true),
(2, 'A lesson that was completed successfully.', 'Completed', true),
(3, 'A lesson that was rescheduled by the student', 'Rescheduled - Student', true),
(4, 'A lesson that was rescheduled by the tutor', 'Rescheduled - Tutor', true),
(5, 'A lesson that was cancelled by either person', 'Cancelled', true),
(6, 'A lesson where the student simply did not call or show up.', 'No Show - Student', true),
(7, 'A lesson where the tutor simply did not call or show up.', 'No Show - Tutor', true),
(8, 'A lesson where one party was sick', 'Sick', true);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `credentials_userid` int(11) NOT NULL,
  `student_fname` varchar(32) NOT NULL,
  `student_lname` varchar(32) NOT NULL,
  `student_address` varchar(256) NOT NULL,
  `student_city` varchar(64) NOT NULL,
  `student_postal` varchar(8) NOT NULL,
  `student_email` varchar(32) NOT NULL,
  `student_picture` blob NOT NULL,
  `student_about` text NOT NULL,
  PRIMARY KEY (`credentials_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(32) NOT NULL,
  `subject_desc` varchar(256) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(150) NOT NULL,
  `name` varchar(30) NOT NULL,
  `visitor_type` varchar(10) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `content`, `name`, `visitor_type`, `approved`) VALUES
(1, 'I used TutleZone once. <br /> It was okay.', 'Ravi G', 'Tutor', 1),
(2, '1) TutleZone ... <br> 2) Register ...<br> 3) ??? ... <br>4) Profit. ', 'Reginald P Murphy', 'Student', 1),
(3, 'As the old yiddish proverb goes, once you Tutle you''ll never go back.', 'Anonymous', 'Guest', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `transaction_amount` double NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_notes` varchar(256) NOT NULL,
  `method_id` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `match_id` (`match_id`),
  KEY `method_id` (`method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
  `credentials_userid` int(11) NOT NULL,
  `tutor_fname` varchar(32) NOT NULL,
  `tutor_lname` varchar(32) NOT NULL,
  `tutor_address` varchar(256) NOT NULL,
  `tutor_city` varchar(64) NOT NULL,
  `tutor_postal` varchar(8) NOT NULL,
  `tutor_email` varchar(32) NOT NULL,
  `tutor_picture` blob NOT NULL,
  `tutor_company` varchar(32) NOT NULL,
  `tutor_website` varchar(32) NOT NULL,
  `tutor_bio` text NOT NULL,
  PRIMARY KEY (`credentials_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `typecode`
--

CREATE TABLE IF NOT EXISTS `typecode` (
  `typecode_id` int(11) NOT NULL AUTO_INCREMENT,
  `typecode_desc` varchar(256) NOT NULL,
  `typecode_abbr` varchar(10) NOT NULL,
  `typecode_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`typecode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `typecode` (`typecode_id`, `typecode_desc`, `typecode_abbr`, `typecode_active`) VALUES
(1, 'A student account, no access to reporting or tutor functionality.', 'Student', true),
(2, 'A standard tutor account', 'Tutor', true),
(3, 'A webmaster account, access to reporting & admin functionality', 'Admin', true);
--
-- Constraints for dumped tables
--

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `credentials_ibfk_1` FOREIGN KEY (`TYPECODE_ID`) REFERENCES `typecode` (`typecode_id`);

--
-- Constraints for table `expertise`
--
ALTER TABLE `expertise`
  ADD CONSTRAINT `expertise_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`credentials_userid`),
  ADD CONSTRAINT `expertise_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_4` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`),
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `match` (`match_id`),
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`statuscode_id`) REFERENCES `statuscode` (`statuscode_id`);

--
-- Constraints for table `match`
--
ALTER TABLE `match`
  ADD CONSTRAINT `match_ibfk_2` FOREIGN KEY (`tutor_userid`) REFERENCES `tutor` (`credentials_userid`),
  ADD CONSTRAINT `match_ibfk_1` FOREIGN KEY (`student_userid`) REFERENCES `student` (`credentials_userid`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`credentials_userid`) REFERENCES `credentials` (`CREDENTIALS_USERID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`credentials_userid`) REFERENCES `credentials` (`CREDENTIALS_USERID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`method_id`) REFERENCES `method` (`method_id`),
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `match` (`match_id`);

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`credentials_userid`) REFERENCES `credentials` (`CREDENTIALS_USERID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
