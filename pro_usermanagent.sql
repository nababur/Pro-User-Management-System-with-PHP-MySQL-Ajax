-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2020 at 03:01 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_autho`
--

CREATE TABLE `tbl_app_autho` (
  `id_autho` int(11) NOT NULL,
  `allow_email` int(11) NOT NULL DEFAULT 0,
  `fb_autho` int(11) NOT NULL DEFAULT 0,
  `tw_autho` int(11) NOT NULL DEFAULT 0,
  `gle_autho` int(11) NOT NULL DEFAULT 0,
  `git_autho` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_app_autho`
--

INSERT INTO `tbl_app_autho` (`id_autho`, `allow_email`, `fb_autho`, `tw_autho`, `gle_autho`, `git_autho`, `status`) VALUES
(143, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_settings`
--

CREATE TABLE `tbl_app_settings` (
  `app_id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `front_name` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_app_settings`
--

INSERT INTO `tbl_app_settings` (`app_id`, `app_name`, `title`, `front_name`, `favicon`, `logo`) VALUES
(1, 'Benzi - Admin Panel', 'Benzi - Admin Panel', 'BENZI - Login/User Management', 'app/uploads/logo/c604f443587379d.png', 'app/uploads/logo/c604f443587379d7e057.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `perid` int(11) NOT NULL,
  `per_access` varchar(255) NOT NULL,
  `per_create` varchar(255) NOT NULL,
  `per_show` varchar(255) NOT NULL,
  `per_edit` varchar(255) NOT NULL,
  `per_delete` varchar(255) NOT NULL,
  `ban_activ_user` varchar(255) NOT NULL,
  `per_onlyUser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`perid`, `per_access`, `per_create`, `per_show`, `per_edit`, `per_delete`, `ban_activ_user`, `per_onlyUser`) VALUES
(1, 'Access', 'Create', 'Show', 'Edit', 'Delete', 'Ban/Active user', 'User only');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `roledname` varchar(255) NOT NULL,
  `permission_items` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleid`, `rolename`, `roledname`, `permission_items`, `status`) VALUES
(212, 'Author', 'Nababur', 'Access,Create,Show,Edit,Delete,Ban/Active user,User only', 0),
(213, 'Admin', 'Sabuj', 'Show,Edit', 0),
(215, 'Supper Admin', 'Nababur Rahaman', 'Create,Show,Edit,Delete,Ban/Active user,User only', 0),
(217, 'Contributor', 'Sujon ahmed', 'Create,Show,Edit,Delete,Ban/Active user', 0),
(219, 'Subscriber', 'Raju abir', 'Create,Show,Edit,Delete', 0),
(221, 'Only user', 'Sabuj', 'User only,Show', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilePhoto` varchar(255) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `gendar` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `lastactivity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userid`, `name`, `phone`, `address`, `information`, `email`, `city`, `country`, `password`, `profilePhoto`, `rolename`, `status`, `gendar`, `create_date`, `lastactivity`) VALUES
(96, 'Kabir khan', '01245786420', 'Thakurgaon, Baliadangi', 'This is Kabir khan', 'kabir@gmail.com', 'Thakurgaon', 'Bangladesh', '$2y$10$DlH1iFaVE1ib6itYvlIzbuIBJ/11NV5bmsf7iCW3U0jzSvLamilt2', 'app/uploads/userAvatar/c7e375639e.jpg', 'Only user', 0, 'male', '2020-01-13 09:53:30', 0),
(103, 'Md Nababur Rahaman', '01717090233', 'Thakurgaon, Baliadangi', 'This is Nababur Rahaman', 'nababurbd@gmail.com', 'Thakurgaon', 'Bangladesh', '$2y$10$3Z8ZD74Ok4TSSoyHAp/p6Ok7EdQMq3eJKYgg9JFQcLy1j990mRDGG', 'app/uploads/userAvatar/9f785a4605.jpg', 'Author', 0, 'male', '2015-01-13 09:51:15', 0),
(104, 'Rana ahmed', '01245786420', 'thakugfdf', 'diff', 'rasel@gmail.com', 'dfsdfsfddfdf', 'Barbados', '$2y$10$IkWzHpR.ponUxWLrj0il4uxIoON7mOhx3ShOuixpW02QMLQn2ZFYK', 'app/uploads/userAvatar/5b270dd3d9.png', 'Supper Admin', 0, 'male', '2018-12-11 01:20:29', 0),
(105, 'Sobuj ahmed', '01245786420', 'Ranisoinkol, horipur', '', 'sobujahmed@gmail.com', 'Ranisoinkol', 'Anguilla', '$2y$10$L58jypjrTRsuNpgrr71cAewBoPDmEThTFuB2uM1H6k4s58/zvUJk.', 'app/uploads/userAvatar/479e72eaca.jpg', 'Supper Admin', 0, 'male', '2020-01-09 03:06:26', 0),
(106, 'Humayun Kabir Munna', '01245786420', 'Pirgonj, Thakurgaon', 'This is Munna', 'munna@gmail.com', 'Pirgonj', 'Bangladesh', '$2y$10$Ao3SMm.2EXhvg0EofPU20uHVHmnd30Worq9BWoAxe1WoqVWHRqUXK', 'app/uploads/userAvatar/db5433f879.jpg', 'Supper Admin', 0, 'male', '2020-01-12 04:56:06', 0),
(107, 'Raihan Kabir', '019332154545', 'Mirpur, Dhaka', 'This is Raihan Kabir.', 'raihan@gmail.com', 'Mirpur', 'Belgium', '$2y$10$nmsSKVQM7ksgY2CxsmOfS.r1AB0sDx8wp2Se4y227fhggF9ONy.aW', 'app/uploads/userAvatar/ec6120cc76.png', 'Supper Admin', 0, 'male', '2020-01-12 04:57:48', 0),
(108, 'Saddam hossain', '01245786420', 'Ponchogor Boda', 'This is Saddam Hossain', 'saddam@gmail.com', 'Ponchogor', 'Bahamas', '$2y$10$5s4F9kzMgWc3S7YZLRf5H.BlF013LwLU60bt1B5Z7dGFG8/p8a8j6', 'app/uploads/userAvatar/c362c75f91.jpg', 'Admin', 0, 'male', '2020-01-12 08:08:41', 0),
(109, 'Shamim Rana', '', '', '', 'shamim@gmail.com', '', '', '$2y$10$t3.6b0lCUOb1ME9l2G1EKuLXg2m1lxKmghqUiePnChyM.rzqbmFDG', '', 'Admin	', 0, '', '2020-01-13 17:34:31', 0),
(110, 'Dalim Hossain', '', '', '', 'dalim@gmail.com', '', '', '$2y$10$fb4J4LEEUsinZF3RmutDkeyiNBECLA4MVpKgm24UiSGGPJFHHql0a', '', 'Admin	', 0, '', '2020-01-13 21:10:24', 0),
(111, 'Raju Abir', '', '', '', 'raju@gmail.com', '', '', '$2y$10$P2tOP3BgBWdIiKVCMsC5wO5fUBlcdK34etTHKSoOREltj3KCQBrbi', '', 'Admin	', 1, '', '2020-01-13 21:10:20', 0),
(113, 'Liton Dass', '01729793766', 'Mirpur, Dhaka', '', 'liton@gmail.com', 'Mirpur', 'Anguilla', '$2y$10$iQBuh00UcVB/2YIwDsNdj.Q3SL8SqH.av0NTYNLj5ChEFDtpE7TGu', 'app/uploads/userAvatar/72050401f6.jpg', 'Contributor', 0, 'male', '2020-01-13 17:34:28', 0),
(114, 'Harun Rashid', '01245786420', 'Thakurgaon,', 'This is Harun,', 'harun@gmail.com', 'Thakurgaon,', 'Angola', '$2y$10$7BPP9YhF8fPIywXGoNfc6.8688Rt.jlmzl0Y386wRj9wbilBrLO9S', 'app/uploads/userAvatar/edb274937c.png', 'Subscriber', 0, 'male', '2020-01-12 02:03:38', 0),
(115, 'Jasmin akhter', '01245786420', 'Thakurgaon, Baliadangi', '', 'jasmin@gmail.com', 'Thakurgaon', 'Antigua &amp; Barbuda', '$2y$10$fpmdreyUbOKB2B6adPgJjuarBrtLd/jPX3MKks0vexTfDYeCd6axG', 'app/uploads/userAvatar/25d37110db.png', 'Only user', 0, 'female', '2020-01-12 16:22:56', 0),
(116, 'Osman gony', '', '', '', 'osman@gmail.com', '', '', '$2y$10$5vGZpnQoJWkGotLtUEdxSOZLrFTFrfCf7u5MhHFwNebR6J0MNYLs2', '', 'Only user', 0, '', '2020-01-13 17:34:19', 0),
(118, 'Akhi akhter', '012458136', 'Thakurgaon, Balidadangi', 'This is Akhi akhter', 'akhi@gmail.com', 'Thakurgaon,Bangaldesh', 'Bangladesh', '$2y$10$duzCYAS32wBFSfr/J8BoN.OPQ52.hYAMcgygAIqGS1.nkJXdxQuvu', 'app/uploads/userAvatar/369187ff7a.png', 'Only user', 0, 'female', '2020-01-13 05:18:36', 0),
(120, 'Rony Ahmed', '', '', '', 'rony@gmail.com', '', '', '$2y$10$fVGdshQyyOTDk5yHRG5USueDUUq93f0Jj/EHPo0dffFnaWU.lpNDm', '', 'Only user', 1, '', '2020-01-13 21:10:51', 0),
(121, 'Moniruzzaman monir', '054542021', 'BEGUNGAO', '', 'connectionwifi33@gmail.com', 'Mojatibazar', 'Bangladesh', '$2y$10$vCnyqvxvLONi/4cDRti9Vua3HvAjLITARgXjvfokgE8icQ3SnfKNq', 'app/uploads/userAvatar/d656ca8a78.png', 'Subscriber', 0, 'male', '2020-02-04 12:14:06', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_app_autho`
--
ALTER TABLE `tbl_app_autho`
  ADD PRIMARY KEY (`id_autho`);

--
-- Indexes for table `tbl_app_settings`
--
ALTER TABLE `tbl_app_settings`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`perid`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_app_autho`
--
ALTER TABLE `tbl_app_autho`
  MODIFY `id_autho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `tbl_app_settings`
--
ALTER TABLE `tbl_app_settings`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `perid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
