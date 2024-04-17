-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 11:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chis_food_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cook_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `location`, `image_path`, `created_at`, `cook_id`) VALUES
(8, 'egusi', 'how to cook egusi soup', 'lagos', 'uploads/egusi.jpg', '2024-04-13 10:57:33', 15),
(9, 'ogbono', 'how to make ogbono soup', 'aberdeen', 'uploads/Ogbono-soup-Draw-Soup-blog-2.jpg', '2024-04-13 11:00:42', 16),
(10, 'oha', 'how  to make oha', 'onitsha', 'uploads/Oha soup.jpg', '2024-04-13 12:47:13', 16),
(11, 'egusi', 'how to make egusi', 'Enugu', 'uploads/istockphoto-1469524004-1024x1024.jpg', '2024-04-13 12:57:45', 17),
(12, 'oha soup', 'how to make oha soup', 'enugu', 'uploads/istockphoto-2022839269-1024x1024.jpg', '2024-04-14 18:20:58', 21),
(13, 'steak', 'how to make steak', 'Aberdeen', 'uploads/well-done-steak-homemade-potatoes.jpg', '2024-04-16 17:19:09', 25),
(14, 'steak', 'how to make steak easily', 'stonehaven', 'uploads/well-done-steak-homemade-potatoes.jpg', '2024-04-16 17:23:36', 26),
(15, 'pasta', 'how to make pasta', 'ediburgh', 'uploads/delicious-asian-noodles-concept_23-2148773773.jpg', '2024-04-17 06:02:07', 25),
(16, 'pasta', 'how to make pasta easily', 'stonegaven', 'uploads/delicious-chinese-food-asian-cuisine_841229-24577.jpg', '2024-04-17 06:59:02', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(15, 'eme', 'jon', 'em@em', '$2y$10$.KwvGFQg1ZmkqWPsM1Bz/un/HU7AxgjtwPRxcVImI4vGbT7vhF3si', 'cook'),
(16, 'jo', 'jon', 'em@e', '$2y$10$OJdP.hXNh8MzYikPdhd7z.ARgC8i9/89atymkrADxRjfkHlOus.q6', 'cook'),
(17, 'gift', 'ejovi', 'admin@admin.com', '$2y$10$ur.DvAtmpGs9ImViSrCWseSWxT78J.BgkuU0bgfloverlSM2focaK', 'admin'),
(18, 'fem', 'fem', 'j@j', '$2y$10$SgQPEXzKnqZnPg2CPeT0KesZuBKQ/gwEPrsgDRx86KfyDK0mA5q/S', 'recipe_seeker'),
(19, 'ebu', 'ka', 'ebu@ka', '$2y$10$d49dRLV82jQzEgI5MeUG3esXX3sBt2LNAUaAvIYO2D.Gt7z/A2UZ.', 'cook'),
(20, 'jon', 'cli', 'jon@cli', '$2y$10$YVgV0FMtuJmotf89yM9d9ukktIApNDQVklz2O.Sf6B1Vs/tO7qkjW', 'cook'),
(21, 'king', 'king', 'king@king', '$2y$10$eOKbZpBqZlC2.oQovcIu3OWT/heqqqXIylAXjlm/sglT97M5NcC8e', 'cook'),
(22, 'femi', 'bayo', 'femi@gmail.com', '$2y$10$PWuTMVst7n7Ola6VwPDKyOjLTvWPAqK6vEtfHAa7i.f/riNHvk5du', 'cook'),
(23, 'femi', 'bayo', 'femi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'cook'),
(24, 'chi', 'chi', 'chi@chi', '$2y$10$/EDdXdNXkkp4wWKslwzHBuIxBINfvJWDfV84r.ncUmnxCJb.wUL6a', 'recipe_seeker'),
(25, 'cli', 'cli', 'cli@cli', '$2y$10$cBOv9OXrBjyeL9btlXdP0Otob/AssOewPUfKDXDztbIJbWIjyfB2m', 'cook'),
(26, 'fem', 'ebu', 'ebu@eme', '$2y$10$GA7W37nA648n4qeBotG2Jum7wnZc5U40ZBmu3klD4bGsiOI9MJttS', 'cook'),
(27, 'gift', 'gift', 'gift@gift', '$2y$10$3qqzezR9JjPKt.sdTSqfA.PbnPyIzBamlybPK3ozl8oQZJ0OAYZjm', 'recipe_seeker'),
(28, 'chidi', 'chidi', 'chi@abc', '$2y$10$uLqgw0pN75nsbxjnkIB5Buk7dplFSJDWJR6BddFst8Cgv4sVQUoYW', 'recipe_seeker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cook_id` (`cook_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipes_users` FOREIGN KEY (`cook_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
