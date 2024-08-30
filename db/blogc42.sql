-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 02:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogc42`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `body`, `user_id`, `created_at`) VALUES
(1, 'laravel', '1.png', 'Laravel is a popular open-source PHP framework known for its elegant syntax and simplicity, designed for web application development following the MVC (Model-View-Controller) architectural pattern. Here are some key aspects of Laravel:', 1, '2024-07-03 01:44:32'),
(4, 'django', '6685fbf82a130.png', 'Django is a high-level, open-source web framework written in Python. It encourages rapid development and clean, pragmatic design. It follows the &quot;Don&#039;t Repeat Yourself&quot; (DRY) principle, meaning it emphasizes reusability and reducing redundancy.', 1, '2024-07-04 04:33:44'),
(5, 'nodejs', '668ab9dd97f43.png', 'Node.js® is a free, open-source, cross-platform JavaScript runtime environment that lets developers create servers, web apps, command line tools and scripts.', 1, '2024-07-07 18:53:01'),
(6, 'ruby on rails', '669d986a6ac43.png', 'Ruby on Rails (simplified as Rails) is a server-side web application framework written in Ruby under the MIT License. Rails is a model–view–controller (MVC) framework, providing default structures for a database, a web service, and web pages. It encourages and facilitates the use of web standards such as JSON or XML for data transfer and HTML, CSS and JavaScript for user interfacing. In addition to MVC, Rails emphasizes the use of other well-known software engineering patterns and paradigms, including convention over configuration (CoC), don&#039;t repeat yourself (DRY), and the active record pattern.', 11, '2024-07-22 02:23:22'),
(7, 'spring boot', '669da7e04f3cf.png', 'Spring Boot is an open-source Java framework used for programming standalone, production-grade Spring-based applications with minimal effort.[3] Spring Boot is a convention-over-configuration extension for the Spring Java platform intended to help minimize configuration concerns while creating Spring-based applications.[4][5] Most of the application can be preconfigured using Spring team&#039;s &quot;opinionated view of the best configuration and use of the Spring platform and third-party libraries.', 11, '2024-07-22 03:29:20'),
(8, 'dot net', '669dabaa15a3f.png', 'The .NET Framework (pronounced as &quot;dot net&quot;) is a proprietary software framework developed by Microsoft that runs primarily on Microsoft Windows. It was the predominant implementation of the Common Language Infrastructure (CLI) until being superseded by the cross-platform .NET project. It includes a large class library called Framework Class Library (FCL) and provides language interoperability (each language can use code written in other languages) across several programming languages. Programs written for .NET Framework execute in a software environment (in contrast to a hardware environment) named the Common Language Runtime (CLR). The CLR is an application virtual machine that provides services such as security, memory management, and exception handling. As such, computer code written using .NET Framework is called &quot;managed code&quot;. FCL and CLR together constitute the .NET Framework.', 10, '2024-07-22 03:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'test user', 'test@user.com', '$2y$10$Etzw3W594D27kuNjGRkXruHxB8gA3f3IapbXRCvVrqXhbL8UIeC0q', '01025874685', '2024-07-03 01:44:32'),
(10, 'ahmed3', 'A@a1a.co', '$2y$10$m7903S4yTsl.v6VXpb8XTejvCgfsw4IiwqRp1gaFinTrXb3idKb6q', '0102200303', '2024-07-19 21:51:42'),
(11, 'mostafa', 'mo@mo.co', '$2y$10$wrON36aMgfUe5X9r0W7QVukKnhUZ/xWUyxeVIaGlV/yKXE.9p8XBm', '01022003030', '2024-07-21 00:39:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
