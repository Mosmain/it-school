-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 17 2020 г., 13:22
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
-- База данных: `it_school`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `img` varchar(30) NOT NULL,
  `title` varchar(16) NOT NULL,
  `price` varchar(10) NOT NULL,
  `descr` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cards`
--

INSERT INTO `cards` (`id`, `img`, `title`, `price`, `descr`) VALUES
(1, '', 'Mobile app', '14 790', 'Вы освоите разработку под самую популярную мобильную платформу, даже если до этого вы никогда не программировали.\r\n'),
(2, '', 'Java script', '6 990', 'Научим программировать на JavaScript — сможете создавать веб-приложения'),
(3, '', 'PHP', '8 790', 'Вы освоите популярный язык для создания сценариев веб-приложений, научитесь работать с базами данных и получите востребованную профессию.'),
(4, '', 'Java', '12 990', 'Изучите основы программирования, синтаксис Java, объектно-ориентированное программирование'),
(5, '', 'Unity', '7 490', 'Вы с нуля освоите игровую разработку: научитесь писать на С#, создавать игры на Unity и писать свои дополнения для движка. '),
(6, '', 'Python', '8 690', 'На практике научитесь писать программы и разрабатывать веб-приложения с индивидуальной помощью от наставника.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
