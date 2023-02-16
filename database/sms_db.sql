-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 05:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `sms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_list`
--

CREATE TABLE `inquiry_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `contact` text NOT NULL,
  `email` text DEFAULT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_list`
--

INSERT INTO `inquiry_list` (`id`, `fullname`, `contact`, `email`, `subject`, `message`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Mark Cooper', '09123456789', 'mcooper@mail.com', 'test', 'Sample Inquiry', 1, '2022-10-14 10:56:51', '2022-10-14 10:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `quote_list`
--

CREATE TABLE `quote_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `fullname` text NOT NULL,
  `email` text DEFAULT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `schedule` date NOT NULL,
  `remarks` text NOT NULL,
  `admin_remarks` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quote_list`
--

INSERT INTO `quote_list` (`id`, `code`, `fullname`, `email`, `contact`, `address`, `schedule`, `remarks`, `admin_remarks`, `status`, `date_created`, `date_updated`) VALUES
(1, '2022101400001', 'Samantha Lou', 'sam23@mail.com', '09123545689', 'Sample Address 101', '2022-10-20', 'Sample remarks only', '', 1, '2022-10-14 10:45:51', '2022-10-14 10:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `quote_services`
--

CREATE TABLE `quote_services` (
  `quote_id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quote_services`
--

INSERT INTO `quote_services` (`quote_id`, `service_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Home Cleaning and Sanita', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia gravida massa, non aliquet sapien scelerisque eget. Pellentesque neque eros, varius ac urna eget, maximus commodo ante. Donec aliquam quis risus at convallis. Suspendisse sed sagittis odio. Aenean ultrices sapien sit amet sollicitudin congue. Pellentesque dapibus lectus non purus consequat consectetur. Mauris dapibus ultrices suscipit. Nunc id mollis neque, quis convallis nibh. Curabitur quis efficitur lorem. Nullam egestas consectetur velit, eget sollicitudin sem hendrerit ac. Vestibulum vitae diam ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis aliquam erat quis hendrerit semper. In sed mauris lorem. Fusce elementum feugiat euismod. Vivamus posuere purus ac aliquam ullamcorper.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/services//house-sanitization.jpg?v=1665714533', 1, 0, '2022-10-14 10:28:53', '2022-10-14 10:28:53'),
(2, 'Car Sanitization', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Vivamus quis metus nec ligula luctus dapibus sed et tellus. Sed non dignissim magna. Fusce tempus eget elit id dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean dictum lacus eget metus vestibulum, sed auctor erat egestas. Pellentesque eget sapien ut dui porta molestie a id ipsum. Ut ultricies odio non orci cursus, in convallis libero suscipit. Suspendisse in tortor velit.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/services//car-sanitization.png?v=1665714563', 1, 0, '2022-10-14 10:29:23', '2022-10-14 10:29:23'),
(3, 'Office Sanitzation', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Sed varius velit vitae quam sollicitudin, ac fermentum ex accumsan. Donec quis faucibus purus. Donec venenatis ornare lobortis. Aenean vel elementum arcu, vitae fringilla lectus. Curabitur risus mauris, ullamcorper vel nulla vitae, aliquet sodales dolor. Aenean in consectetur ante. Phasellus varius aliquam ante, vel viverra urna rhoncus in. Vestibulum dignissim purus nunc, et cursus libero ornare sit amet. Donec viverra enim a sodales hendrerit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus et imperdiet tortor, nec pharetra nisl. Aenean eleifend justo eu commodo vestibulum. Pellentesque nec velit vel turpis iaculis venenatis id ut nibh. Nunc sed egestas ante, vitae rutrum justo. Maecenas dolor metus, fringilla a lectus suscipit, bibendum lacinia mauris.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/services//sanitize.jpeg?v=1665714611', 1, 0, '2022-10-14 10:30:11', '2022-10-14 10:30:11'),
(4, 'Hospital Sanitization', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Curabitur eget varius diam. Aliquam sodales nunc in sodales suscipit. Duis sed facilisis arcu, sit amet tincidunt lorem. Pellentesque eget scelerisque nisl, vel placerat lacus. Donec faucibus justo massa, ut laoreet arcu vulputate eu. Nam velit urna, condimentum non viverra vel, aliquet et augue. Etiam et eleifend elit, at tempus eros. Vivamus quam risus, posuere quis quam vitae, imperdiet finibus lorem. Nulla viverra nibh tincidunt ex tincidunt, sed laoreet metus eleifend. Morbi tincidunt gravida sem, vel cursus eros elementum sit amet.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/services//1_sanitize.jpeg?v=1665714658', 1, 0, '2022-10-14 10:30:58', '2022-10-14 10:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Sanitization Management System'),
(6, 'short_name', 'SMS - PHP'),
(11, 'logo', 'uploads/logo.png?v=1665714862'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1665714863'),
(17, 'phone', '456-987-1231'),
(18, 'mobile', '09123456987 / 094563212222 '),
(19, 'email', 'info@xyzsanitizationservices.com'),
(20, 'address', '7087 Henry St. Clifton Park, NY 12065');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', '', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-05-16 14:17:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_list`
--
ALTER TABLE `quote_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_services`
--
ALTER TABLE `quote_services`
  ADD KEY `quote_id` (`quote_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quote_list`
--
ALTER TABLE `quote_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quote_services`
--
ALTER TABLE `quote_services`
  ADD CONSTRAINT `quote_id_fk_qs` FOREIGN KEY (`quote_id`) REFERENCES `quote_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `service_id_fk_qs` FOREIGN KEY (`service_id`) REFERENCES `service_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;
