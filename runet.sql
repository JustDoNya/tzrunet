-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 28 2017 г., 21:56
-- Версия сервера: 5.7.13
-- Версия PHP: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `runet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`city_id`, `name`) VALUES
(1, 'Москва'),
(2, 'Санкт-Петербург'),
(3, 'Воронеж'),
(4, 'Ростов-на-Дону'),
(5, 'Екатеринбург'),
(6, 'Уфа');

-- --------------------------------------------------------

--
-- Структура таблицы `qualification`
--

CREATE TABLE `qualification` (
  `qualification_id` int(10) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qualification`
--

INSERT INTO `qualification` (`qualification_id`, `name`) VALUES
(1, 'высшее-бакалавр'),
(2, 'среднее общее'),
(3, 'начальное'),
(4, 'среднее профессиональное'),
(5, 'высшее-магистр'),
(6, 'высшее-специалист'),
(7, 'аспирант');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qualification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `name`, `qualification_id`) VALUES
(1, 'Иванов Иван Иванович', 1),
(2, 'Петров Петр Петрович', 3),
(3, 'Андреев Андрей Андреевич', 5),
(4, 'Борисов Борис Борисович', 6),
(5, 'Кириллов Кирилл Кириллович', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `user_citys`
--

CREATE TABLE `user_citys` (
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_citys`
--

INSERT INTO `user_citys` (`user_id`, `city_id`) VALUES
(1, 1),
(1, 6),
(2, 4),
(2, 2),
(2, 5),
(3, 6),
(4, 4),
(4, 1),
(5, 1),
(5, 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Индексы таблицы `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`qualification_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `qualification_id` (`qualification_id`);

--
-- Индексы таблицы `user_citys`
--
ALTER TABLE `user_citys`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `qualification`
--
ALTER TABLE `qualification`
  MODIFY `qualification_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`qualification_id`) REFERENCES `qualification` (`qualification_id`);

--
-- Ограничения внешнего ключа таблицы `user_citys`
--
ALTER TABLE `user_citys`
  ADD CONSTRAINT `user_citys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_citys_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
