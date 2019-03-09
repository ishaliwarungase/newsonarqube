-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2018 at 10:54 AM
-- Server version: 5.7.22
-- PHP Version: 5.6.36-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nmba_mms`
--

-- --------------------------------------------------------

--
-- Table structure for table `nmba_activity`
--

CREATE TABLE `nmba_activity` (
  `id` smallint(6) NOT NULL,
  `date_time` varchar(15) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `admin_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nmba_activity`
--

INSERT INTO `nmba_activity` (`id`, `date_time`, `activity`, `admin_id`) VALUES
(1, '1532068690', 'Updated membership Details', 1),
(2, '1532068723', 'Updated membership Details', 1),
(3, '1532068776', 'Updated membership Details', 1),
(4, '1532068857', 'Updated membership Details', 1),
(5, '1532068905', 'Updated membership Details', 1),
(6, '1532068965', 'Updated membership Details', 1),
(7, '1532069046', 'Updated membership Details', 1),
(8, '1532072925', 'Updated membership Details', 9),
(9, '1532153974', 'Updated membership Details', 14),
(10, '1532154059', 'Updated membership Details', 14),
(11, '1532154190', 'Updated Address Details', 14),
(12, '1532154429', 'Updated Address Details', 14),
(13, '1532160820', 'Updated membership Details', 14),
(14, '1532171823', 'Created new payment', 14),
(15, '1532172476', 'Created new payment', 14),
(16, '1532177289', 'Created new payment', 14),
(17, '1532177711', 'Created new payment', 14),
(18, '1532179391', 'Created new event: fghfgh', 14),
(19, '1532329419', 'Updated Address Details', 14),
(20, '1532331074', 'Created new payment', 14),
(21, '1532331148', 'Created new payment', 14),
(22, '1532331156', 'deleted existing payment', 14),
(23, '1532343642', 'Created new notice: Test Notice', 14),
(24, '1532344728', 'Updated Address Details', 14),
(25, '1532414309', 'Updated Address Details', 14),
(26, '1532417638', 'deleted existing payment', 14),
(27, '1532417641', 'deleted existing payment', 14),
(28, '1532417671', 'Created new payment', 14),
(29, '1532434710', 'Updated Address Details', 14),
(30, '1532499852', 'Updated Address Details', 14),
(31, '1532499910', 'Updated Address Details', 14),
(32, '1532503788', 'Updated Address Details', 14),
(33, '1532517204', 'Updated Address Details', 14),
(34, '1532517930', 'Updated membership Details', 16),
(35, '1532517956', 'Updated membership Details', 16),
(36, '1532518877', 'Updated Address Details', 14),
(37, '1532518894', 'Updated Address Details', 14),
(38, '1532519329', 'Updated Address Details', 14),
(39, '1532521951', 'Updated Address Details', 14),
(40, '1532522543', 'Updated Address Details', 14),
(41, '1532601155', 'deleted existing payment', 14),
(42, '1532601197', 'Created new payment', 14),
(43, '1532601326', 'Created new payment', 14),
(44, '1532601344', 'Created new payment', 14),
(45, '1532601386', 'Created new payment', 14),
(46, '1532601425', 'deleted existing payment', 14),
(47, '1532601426', 'deleted existing payment', 14),
(48, '1532601429', 'deleted existing payment', 14),
(49, '1532601449', 'Created new payment', 14),
(50, '1533215558', 'updated notice: Test Notice 2', 14),
(51, '1533215582', 'Created new notice: fxdghbfgh', 14),
(52, '1533273620', 'Created new event: qqqqqqqqq', 14),
(53, '1533273640', 'updated event: Qqqqqqqqq', 14),
(54, '1533273825', 'Created new payment', 14),
(55, '1533273972', 'Created new notice: r3rrrrrr', 14),
(56, '1533273995', 'updated notice: ffffffff', 14),
(57, '1533277972', 'Updated Address Details', 14),
(58, '1533278276', 'Updated membership Details', 14),
(59, '1533278617', 'Created new event: Durga Puja', 14),
(60, '1533278704', 'updated event: Durga Puja 2018', 14),
(61, '1533279705', 'Created new notice: meeting ', 14),
(62, '1533279758', 'updated notice: Meeting for durga puja', 14),
(63, '1533293635', 'Created new notice: test', 14),
(64, '1533293672', 'Created new notice: test', 14),
(65, '1533293717', 'Created new notice: test', 14),
(66, '1533293729', 'updated notice: Ffffffff', 14),
(67, '1533294630', 'updated notice: Test', 14);

-- --------------------------------------------------------

--
-- Table structure for table `nmba_event`
--

CREATE TABLE `nmba_event` (
  `id` smallint(6) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(5000) NOT NULL,
  `location` varchar(100) NOT NULL,
  `from_date_time` varchar(20) NOT NULL,
  `to_date_time` varchar(20) NOT NULL,
  `event_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nmba_event`
--

INSERT INTO `nmba_event` (`id`, `title`, `description`, `image`, `location`, `from_date_time`, `to_date_time`, `event_type`) VALUES
(1, 'fghfgh', ' fhgdfhgfghfgh', 'qkxyi7tctug456h.jpeg', 'dfhgfgh', '1532111400', '1532111400', 'cultural_event'),
(2, 'Qqqqqqqqq', '  Qqqqqqqq', '8nbwvablz5b5suq.jpg', 'Qqqqq', '1533234600', '1534185000', 'cultural_event'),
(3, 'Durga Puja 2018', '  Hello ', 'y5k76n4o0aj0ozt.jpg', 'Nmba Vashi', '1533234600', '1533839400', 'puja');

-- --------------------------------------------------------

--
-- Table structure for table `nmba_festivals`
--

CREATE TABLE `nmba_festivals` (
  `id` smallint(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `from_date` varchar(20) NOT NULL,
  `to_date` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nmba_notice`
--

CREATE TABLE `nmba_notice` (
  `id` smallint(6) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `from_date` varchar(20) NOT NULL,
  `to_date` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nmba_notice`
--

INSERT INTO `nmba_notice` (`id`, `title`, `description`, `from_date`, `to_date`, `type`) VALUES
(7, 'Test', 'Wwwww', '1533234600', '10:00 AM', 'notice1');

-- --------------------------------------------------------

--
-- Table structure for table `nmba_payment`
--

CREATE TABLE `nmba_payment` (
  `id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `payment_date_time` varchar(15) NOT NULL,
  `paid_year` varchar(15) DEFAULT NULL,
  `receipt_no` varchar(15) NOT NULL,
  `payment_type` varchar(30) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `payment_method` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nmba_payment`
--

INSERT INTO `nmba_payment` (`id`, `user_id`, `amount`, `payment_date_time`, `paid_year`, `receipt_no`, `payment_type`, `comment`, `payment_method`) VALUES
(5, 15, '4,444', '1532284200', '2020-2021', 'r4567', 'membership_payment', '', 'Paytm'),
(6, 15, '4,444', '1532284200', '2020-2021', 'r4567', 'membership_payment', '', 'Paytm'),
(7, 14, '1,111', '1532370600', '2018-2019', '1111', 'membership-payment', '', 'cash'),
(9, 14, '100,000', '1532543400', '', '12345', 'donation', 'Thank You', 'cash'),
(12, 16, '222,222', '1532543400', '', '354345', 'charity', 'werf', 'Paytm'),
(13, 14, '2,222', '1533234600', '2018-2019', '2222', 'Membership Payment', '22222', 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `nmba_user`
--

CREATE TABLE `nmba_user` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `membership_id` varchar(10) DEFAULT '10000',
  `password` varchar(30) DEFAULT NULL,
  `initial` varchar(10) DEFAULT NULL,
  `introduce_by` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `senior_citizen` varchar(10) DEFAULT NULL,
  `id_issued` varchar(10) DEFAULT 'no',
  `membership_status` varchar(30) DEFAULT 'active',
  `profession` varchar(30) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `area_of_interest` varchar(300) DEFAULT NULL,
  `membership_category` varchar(20) DEFAULT 'non-member',
  `date_of_expiry` varchar(20) DEFAULT NULL,
  `voting_right` varchar(10) DEFAULT 'no',
  `account_created_date_time` varchar(20) DEFAULT NULL,
  `last_logged_in_date_time` varchar(20) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `user_account_type` varchar(20) NOT NULL DEFAULT 'non-member',
  `token` varchar(200) DEFAULT NULL,
  `flat_house_no` varchar(30) DEFAULT NULL,
  `society_building` varchar(100) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `sector` varchar(30) DEFAULT NULL,
  `sub_sector` varchar(20) DEFAULT NULL,
  `city_node` varchar(30) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `date_of_addmission` varchar(20) DEFAULT NULL,
  `organization` varchar(30) DEFAULT NULL,
  `yearly_paid_membership_year` varchar(20) DEFAULT NULL,
  `account_status` varchar(10) DEFAULT NULL,
  `notif_email` varchar(5) NOT NULL DEFAULT 'on',
  `notif_mobile` varchar(5) NOT NULL DEFAULT 'on',
  `admin_type` varchar(30) DEFAULT NULL,
  `join_reason` varchar(500) DEFAULT NULL,
  `document_image` varchar(100) DEFAULT NULL,
  `nri` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nmba_user`
--

INSERT INTO `nmba_user` (`id`, `name`, `mobile`, `email`, `membership_id`, `password`, `initial`, `introduce_by`, `gender`, `dob`, `blood_group`, `senior_citizen`, `id_issued`, `membership_status`, `profession`, `designation`, `area_of_interest`, `membership_category`, `date_of_expiry`, `voting_right`, `account_created_date_time`, `last_logged_in_date_time`, `image`, `user_account_type`, `token`, `flat_house_no`, `society_building`, `area`, `sector`, `sub_sector`, `city_node`, `pincode`, `date_of_addmission`, `organization`, `yearly_paid_membership_year`, `account_status`, `notif_email`, `notif_mobile`, `admin_type`, `join_reason`, `document_image`, `nri`) VALUES
(1, 'life', NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'inactive', NULL, NULL, NULL, 'Life', NULL, 'no', NULL, NULL, NULL, 'non-member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 'yes', NULL, NULL, NULL, NULL),
(2, 'honorary', NULL, NULL, '8000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'inactive', NULL, NULL, NULL, 'Honorary', NULL, 'no', NULL, NULL, NULL, 'non-member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 'yes', NULL, NULL, NULL, NULL),
(3, 'associate', NULL, NULL, '9000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'inactive', NULL, NULL, NULL, 'Associate', NULL, 'no', NULL, NULL, NULL, 'non-member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 'yes', NULL, NULL, NULL, NULL),
(4, 'non-member', NULL, NULL, '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'inactive', NULL, NULL, NULL, 'non-member', NULL, 'no', NULL, NULL, NULL, 'non-member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 'yes', NULL, NULL, NULL, NULL),
(14, 'Ravi Kumar', '9156789240', 'ravikumar.thakur@os3infotech.com', '1001', 'admin', 'Mr.', '', 'male', '755289000', 'O+', 'no', 'yes', 'Active', 'professional', 'Engineer', 'Durga Pooja,Library & Educational', 'Life', NULL, 'yes', '1532150756', '1533359140', '5cil1ut1jfa043z.jpg', 'super-admin', NULL, 'B/15', 'ganesh society', 'Sakinaka', 'sector7', 'B', 'Mumbai', '400072', '1533061800', 'OS3 Infotech Pvt. Ltd.', NULL, NULL, 'on', 'on', NULL, 'Volunteer', '5imtt0wqqnlu0jq.jpg', ''),
(18, 'sumansengupta', '9892064190', 'sumansengupta11@gmail.com', '10001', 'admin', 'Mr.', '', 'male', '32553000', 'O+', NULL, 'no', 'Active', NULL, NULL, NULL, 'non-member', NULL, 'no', '1533209878', NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-19800', NULL, NULL, NULL, 'on', 'on', NULL, NULL, NULL, NULL),
(19, 'Gaurav Gawhane', '9657576928', 'gaurav.gawhane@os3infotech.com', '10002', '11111', 'Mr.', NULL, 'male', '744316200', 'B-', NULL, 'no', 'active', '', '', 'Kali Mandir', 'non-member', NULL, 'no', '1533281230', NULL, 'lx28fzzlpxhgm69.jpeg', 'non-member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Os3 Info', NULL, NULL, 'on', 'on', NULL, 'Volunteer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nmba_user_family`
--

CREATE TABLE `nmba_user_family` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `spouse_member_id` varchar(20) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `dependency` varchar(20) NOT NULL,
  `occupation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nmba_user_family`
--

INSERT INTO `nmba_user_family` (`id`, `name`, `spouse_member_id`, `relation`, `gender`, `dob`, `blood_group`, `dependency`, `occupation`) VALUES
(1, 'Lilik', '9', 'wife', 'female', '774210600', 'o+', 'no', 'professional'),
(2, 'ravi', '7', 'son', 'male', '1216492200', 'o-', 'yes', 'student'),
(3, 'wife', '14', 'wife', 'male', '775161000', 'O+', 'no', 'service'),
(4, 'ddddd', '14', 'daughter', 'male', '1438540200', 'B+', 'yes', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nmba_activity`
--
ALTER TABLE `nmba_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nmba_event`
--
ALTER TABLE `nmba_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nmba_festivals`
--
ALTER TABLE `nmba_festivals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nmba_notice`
--
ALTER TABLE `nmba_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nmba_payment`
--
ALTER TABLE `nmba_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nmba_user`
--
ALTER TABLE `nmba_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nmba_user_family`
--
ALTER TABLE `nmba_user_family`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nmba_activity`
--
ALTER TABLE `nmba_activity`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `nmba_event`
--
ALTER TABLE `nmba_event`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nmba_festivals`
--
ALTER TABLE `nmba_festivals`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nmba_notice`
--
ALTER TABLE `nmba_notice`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `nmba_payment`
--
ALTER TABLE `nmba_payment`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `nmba_user`
--
ALTER TABLE `nmba_user`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `nmba_user_family`
--
ALTER TABLE `nmba_user_family`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
