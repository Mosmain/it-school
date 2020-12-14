-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 14 2020 г., 11:54
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mosmain`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `img` varchar(30) NOT NULL,
  `title` varchar(16) NOT NULL,
  `price` varchar(10) NOT NULL,
  `descr` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buy`
--

INSERT INTO `buy` (`id`, `img`, `title`, `price`, `descr`) VALUES
(1, '', 'Mobile app', '14 790', 'Вы освоите разработку под самую популярную мобильную платформу, даже если до этого вы никогда не программировали.\r\n'),
(2, '', 'Java script', '6 990', 'Научим программировать на JavaScript — сможете создавать веб-приложения'),
(3, '', 'PHP', '8 790', 'Вы освоите популярный язык для создания сценариев веб-приложений, научитесь работать с базами данных и получите востребованную профессию.'),
(4, '', 'Java', '12 990', 'Изучите основы программирования, синтаксис Java, объектно-ориентированное программирование');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'alex', 'alex@mail.ru', '$2y$10$oq.xcJTUllOtWRVKQh9ziOxOxWwxFi/cXYzQ4KZJm5U1ZLviJewxy'),
(2, 'alex1', 'alex1@mail.ru', '$2y$10$aIJc49RfEM/tReCz.VylNewKPjr4elWCgK7QQhhcBO0u0OJK/q4XW'),
(3, 'test', 'test@gmail.com', '$2y$10$2cPoOr1f7MuRWpdYHcvx8.YI/EEbrgXX/xfMBbGp9.Zp5lLYkiYCK'),
(4, 'test1', 'test44@gmail.com', '$2y$10$jFh2HbLf1b4Z.C0R4mLTJ.PepVjKbehEadjNE5/xXZmjHsuXWsQ2m'),
(5, 'olga', 'olga@test.ru', '$2y$10$PJ3i9ms2mExVTakeOm5lj./FjfO5ctu9cU7VCMeKMwLI8SjA6VWr2');

-- --------------------------------------------------------

--
-- Структура таблицы `users1`
--

CREATE TABLE `users1` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `token_expire` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(4) DEFAULT 0,
  `deleted` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users1`
--

INSERT INTO `users1` (`id`, `name`, `email`, `password`, `phone`, `gender`, `dob`, `photo`, `token`, `token_expire`, `created_at`, `verified`, `deleted`) VALUES
(1, 'adsa', 'as@asd.com', '$2y$10$sEXbas0sRSenbNfF5FXwMueRGxjyepMmECllnl1Mv91izKV2fbgfm', NULL, NULL, NULL, NULL, NULL, '2020-09-30 09:13:11', '2020-09-30 09:13:11', 0, 1),
(2, 'asds', 'sd@asd.com', '$2y$10$hKoFDrMMcoa76Q9UwEB41.1ULgglbvRWCeNOMyiCtekGRd5HqYQrO', NULL, NULL, NULL, NULL, NULL, '2020-09-30 09:16:47', '2020-09-30 09:16:47', 0, 1),
(3, 'asdsad', 'asd@sd.com', '$2y$10$mL/g/vaIZABhCLqzUvwW2OyeC/AQ8n/glfls5Aikb3eJsIZFkXjoW', NULL, NULL, NULL, NULL, NULL, '2020-09-30 09:17:30', '2020-09-30 09:17:30', 0, 1),
(4, 'Mosmain', 'mos@mos.mos', '$2y$10$8yBgnpmRQWHGK3f320nrAu7cx6eXZAIhOrZPtRFVaDIKCOoostg9K', NULL, NULL, NULL, NULL, NULL, '2020-10-06 09:23:35', '2020-10-06 09:23:35', 0, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users1`
--
ALTER TABLE `users1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
