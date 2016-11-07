-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2016 at 03:18 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tbs`
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Concerts'),
(2, 'Culture'),
(16, 'dance'),
(4, 'Family'),
(15, 'music'),
(5, 'Other'),
(3, 'Sport');

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `location`, `category_id`, `date`) VALUES
(1, 'TOTO - Tribute ', 'TOTO\r\nTribute\r\n \r\nБУЛСТРАД АРЕНА\r\n10. Ноември 2016г., 19:30ч.\r\n \r\n \r\nСупергрупата, пяла на една сцена с фронтмена на Toto - Боби Кимбъл, представя първия по рода си трибют към една от най-емблематичните групи на всички времена.\r\n \r\nС участието на:\r\nСлавин Славчев - вокал\r\nПреслава Пейчева - вокал\r\nНора Караиванова - вокал\r\nЯсен Велчев - клавишни\r\nИвайло Звездомиров - бас\r\nДарин Василев - китара\r\nБисер Иванов - китара\r\nСтоян Янкулов (Стунджи) - ударни\r\n \r\nКаним ви да чуем и преживеем незабравимите хитове на Toto, в един нов и емоционален прочит!', 'Ruse, Bulgaria', 1, '2016-11-10 19:30:00'),
(2, 'Терминал 1 представя: P.I.F ', 'Терминал 1 представя: P.I.F ', 'Sofia, Bulgaria', 1, '2016-11-12 23:00:00'),
(3, 'Night of The Champions', 'Night of The Champions \r\n', 'Sofia, Bulgaria', 3, '2016-12-03 19:00:00'),
(14, '1 Event', '1 Description event', 'Sofia, Bulgaria', 15, '2016-11-12 23:00:00'),
(15, '2 Event', '1 Description event', 'Sofia, Bulgaria', 16, '2016-11-12 23:00:00'),
(16, '3 Event', '1 Description event', 'Sofia, Bulgaria', 16, '2016-11-12 23:00:00');

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`event_id`, `price`, `quantity`, `disscount`) VALUES
(0, 0, 0, 0),
(0, 30, 100, 30),
(1, 10, 500, 0),
(1, 15, 500, 0),
(1, 30, 500, 0),
(2, 7, 500, 0),
(3, 30, 100, 2),
(3, 34, 30, 0),
(3, 60, 100, 0),
(3, 90, 100, 0),
(3, 120, 100, 0),
(3, 140, 100, 0),
(3, 160, 100, 0),
(3, 191, 101, 2),
(14, 40, 100, 30),
(15, 20, 100, 20),
(16, 20, 100, 20);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `role`, `is_active`) VALUES
(1, 'admin', 'admin@admin.bg', 'fdffaba78657e45c1dadadcbb3922433', 'admin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
