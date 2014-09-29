-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2012 at 02:37 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `decision_tree`
--

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `parent_id` smallint(6) NOT NULL DEFAULT '0',
  `decision_id` smallint(6) NOT NULL DEFAULT '0',
  `level_id` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(1000) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`parent_id`,`decision_id`,`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`parent_id`, `decision_id`, `level_id`, `name`, `description`) VALUES
(0, 1, 0, 'Security Breach', 'You are the CIO for the campus.  You are new to the job and want to be preceived as being competent.  Several of the older employees feel you should not have gotten the job based on your experience.  You have been alerted that three laptop computers were stolen.'),
(0, 17, 0, 'Mac or PC', 'The purpose of this decision tree is to determine if you are more of a Mac or PC person.  Pick what you would rather do below.'),
(0, 20, 0, '1 Tree', '1 Tree Example for Testing'),
(1, 2, 1, 'You immediately report the stolen laptops to the campus police', 'Officer Jones storms into your office demanding to know what data was stolen on the laptops and why this information was not protected through encryption.'),
(1, 3, 1, 'You gather more information about the data on the laptop', 'After talking with Kathy Smith you find out the data stolen was students, staff and faculty names, social security and medical history from the campus health center.'),
(2, 14, 2, 'Blame your employees', 'Morale is low among your employees after rumors spreading that their boss is placing the blame of the laptop incident on them.'),
(3, 4, 2, 'You are not sure what to do, so you cover up the situation by telling everyone in the office to keep this confidential until you determine the next step', 'One of your staff members leaks information about the stolen laptops to the Presidents office.  The President is on the phone demanding to know why he is hearing about this information from the rumor mill and not from the CIO and what you are going to about this problem.'),
(3, 5, 2, 'Call President Zhang of the campus to report the stolen laptops', 'After speaking with President Zhang, you have been told of the correct procedures to follow.  You need to ensure everyone knows the severity of the situation.'),
(4, 6, 3, 'Pull in your staff and demand to know who leaked the information', 'After a series of investigations, you determine that Larry Stone is the individual responsible for leaking the information about the stolen laptops.'),
(4, 7, 3, 'Call Dr. Joyce Ford to publicize the stolen laptops in the media', 'You ask Dr. Ford to publicize the stolen laptops in the media in order for those people affected to take the necessary precautions as soon as possible.  The next day you receive a call from President Zhang, extremely upset demanding to know who was responsible for publicizing the stolen laptops without prior authorization.'),
(5, 10, 3, 'Inform all of your staff about the laptop and bring them up to speed on the correct procedures to follow', 'Informed your staff of what is going on.  What could you have done differently?  What resources could have helped you?  What would be the next step from here?'),
(5, 11, 3, 'Consult with a senior person', 'Consulted with a senior analyst.  What could you have done differently?  What resources could have helped you?  What would be the next step from here?'),
(6, 8, 4, 'You decide to fire Larry Stone for creating a public relations nightmare', 'Your final outcome is that Larry Stone has been fired.  What could you have done differently?  What resources could have helped you?  What would be the next step from here?'),
(6, 9, 4, 'You hold a meeting with Larry to determine if what you heard is true and to hear his side of the story', 'Consulted with a senior analyst.  What could you have done differently?  What resources could have helped you?  What would be the next step from here?'),
(7, 12, 4, 'You told her that you publicized the list because the authorities advised you to do so', 'You publicized the list.  What could you have done differently?  What resources could have helped you?  What would be the next step from here?'),
(7, 13, 4, 'You state to President Zhang that you felt you were empowered to make time sensitive decisions', 'You explained yourself to Dr. Zhang.  What could you have done differently?  What resources could have helped you?  What would be the next step from here?'),
(14, 15, 3, 'Hold a meeting with your staff', 'You arrange a meeting with your staff to try and defuse the situation.  What could you have done differently?  What resources could you have used?'),
(14, 16, 3, 'Take a day off', 'After several of your staff members challenge your authority, you decide to take a day off to think everything through.  What could you have done differently?  What resources could have helped you?'),
(17, 18, 1, 'Play video games', 'You like to stay on top of the latest gaming and therefore need a system that is customizable and will take the latest and greatest graphics cards - you are a PC.'),
(17, 19, 1, 'Get involved with art', 'You have an eye for design and have a creative streak.  You like the subtleties of a well designed interface to work in and have a keen interest in some of the commercially available Mac applications for graphic design.  You are a Mac.'),
(20, 21, 1, '1.1 Decision', '1.1 Outcome'),
(20, 22, 1, '1.2 Decision', '1.2 Outcome'),
(21, 23, 2, '1.1.1 Decision', '1.1.1 Outcome'),
(21, 24, 2, '1.1.2 Decision', '1.1.2 Outcome'),
(21, 25, 2, '1.1.3 Decision', '1.1.3 Outcome'),
(22, 26, 2, '1.2.1 Decision', '1.2.1 Outcome'),
(22, 27, 2, '1.2.2 Decision', '1.2.2 Outcome'),
(22, 28, 2, '1.2.3 Decision', '1.2.3 Outcome');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
