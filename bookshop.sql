-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 24 2017 г., 23:43
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bookshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Julia Donaldson'),
(2, 'Kathy Reichs'),
(3, 'Ken Follett'),
(4, 'Lee Child'),
(5, 'Lemony Snicket'),
(6, 'Lewis Carroll');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `price`, `discount`, `status`) VALUES
(1, 'Harry Potter and the Prisoner of Azkaban', 'Celebrate 20 years of Harry Potter magic! An extraordinary creative achievement by an extraordinary talent, Jim Kay''s inspired reimagining of J.K. Rowling''s classic series has captured a devoted following worldwide. ', 20.25, 5, 1),
(2, 'Ready Player One', 'SOON TO BE A MAJOR MOTION PICTURE DIRECTED BY STEVEN SPIELBERG It''s the year 2044, and the real world has become an ugly place. We''re out of oil. We''ve wrecked the climate. Famine, poverty, and disease are widespread. ', 12.65, 20, 1),
(3, 'Never Let Me Go', 'The top ten bestseller from the Nobel Prize-winning author of The Remains of the DayShortlisted for the Man Booker PrizeIn one of the most acclaimed novels of recent years, Kazuo Ishiguro imagines the lives of a group of students growing up in a darkly skewed version of contemporary England. ', 55.25, 0, 1),
(4, 'The Betrayed Fiancee', 'Join New York Times bestselling author Wanda E. Brunstetter along with Jean Brunstetter in Holmes County for a dramatic new 6-part serial novel. In Part 3, The Betrayed Fiancee, Kristi Palmer thought Joel Byler was the man she would marry, until she suddenly learns he has been hiding a lot from her. ', 22.44, 22, 1),
(5, 'The Missing Will', 'Join New York Times bestselling author Wanda E. Brunstetter along with Jean Brunstetter in Holmes County for a dramatic new 6-part serial novel. In Part 4, The Missing Will, the Byler family is on a hunt for the father''s will while relations continue to deteriorate among the siblings and between Joel and his fiancee. ', 45, 15, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `books_backup`
--

CREATE TABLE IF NOT EXISTS `books_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `change_date` datetime NOT NULL,
  `id_book` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_author`
--

INSERT INTO `book_author` (`id_book`, `id_author`) VALUES
(1, 2),
(1, 3),
(2, 5),
(2, 6),
(3, 1),
(3, 4),
(4, 4),
(4, 5),
(5, 4),
(5, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `book_genre`
--

CREATE TABLE IF NOT EXISTS `book_genre` (
  `id_book` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_genre`
--

INSERT INTO `book_genre` (`id_book`, `id_genre`) VALUES
(1, 5),
(1, 6),
(2, 5),
(2, 6),
(3, 1),
(3, 4),
(4, 3),
(4, 4),
(4, 5),
(5, 1),
(5, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Romance'),
(2, 'Fiction'),
(3, 'Horror'),
(4, 'Fantasy'),
(5, 'Detective'),
(6, 'Scientic');

-- --------------------------------------------------------

--
-- Структура таблицы `orderinfo`
--

CREATE TABLE IF NOT EXISTS `orderinfo` (
  `id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` float NOT NULL,
  `disc_book` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderinfo`
--

INSERT INTO `orderinfo` (`id`, `id_book`, `count`, `price`, `disc_book`) VALUES
(1, 1, 4, 20.25, 5),
(1, 2, 4, 12.65, 20),
(1, 3, 4, 55.25, 0),
(1, 4, 2, 22.44, 22),
(2, 2, 4, 12.65, 20),
(2, 3, 2, 55.25, 0),
(3, 3, 2, 55.25, 0),
(3, 4, 2, 22.44, 22),
(3, 1, 2, 20.25, 5),
(4, 1, 4, 20.25, 5),
(4, 3, 2, 55.25, 0),
(5, 4, 4, 22.44, 22),
(5, 1, 2, 20.25, 5),
(6, 1, 2, 20.25, 5),
(6, 2, 4, 12.65, 20),
(6, 4, 4, 22.44, 22),
(7, 2, 3, 12.65, 20),
(7, 4, 3, 22.44, 22),
(8, 3, 4, 55.25, 0),
(8, 4, 4, 22.44, 22),
(9, 1, 3, 20.25, 5),
(9, 4, 5, 22.44, 22),
(10, 4, 4, 22.44, 22),
(10, 1, 2, 20.25, 5),
(10, 3, 2, 55.25, 0),
(11, 3, 4, 55.25, 0),
(11, 1, 5, 20.25, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `disc_user` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `id_payment`, `id_status`, `date`, `disc_user`) VALUES
(1, 30, 3, 4, '2017-10-24 23:08:49', 0),
(2, 30, 1, 3, '2017-10-24 23:09:42', 0),
(3, 30, 2, 1, '2017-10-24 23:10:08', 0),
(4, 31, 2, 4, '2017-10-24 23:14:33', 0),
(5, 31, 3, 1, '2017-10-24 23:14:46', 0),
(6, 31, 1, 1, '2017-10-24 23:15:06', 0),
(7, 32, 3, 2, '2017-10-24 23:15:34', 0),
(8, 27, 2, 1, '2017-10-24 23:20:31', 30),
(9, 27, 2, 1, '2017-10-24 23:20:46', 30),
(10, 32, 2, 4, '2017-10-24 23:21:49', 15),
(11, 32, 1, 1, '2017-10-24 23:22:13', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `name`) VALUES
(1, 'Pay Pal'),
(2, 'Web Money'),
(3, 'Cash');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'processed'),
(2, 'sent'),
(3, 'delivered'),
(4, 'done');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `discount` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `role` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `pass`, `discount`, `status`, `role`, `hash`) VALUES
(27, 'Iluha Admin', 'admin@mail.ru', '95d53bf24b4c267e64fa593e5d543780', 30, 1, 'admin', 'hixQNwY5zA'),
(30, 'valera', 'valera@mail.ru', '95d53bf24b4c267e64fa593e5d543780', 5, 1, 'user', 'ZMkGDPrViX'),
(31, 'sasha', 'sasha@mail.ru', '95d53bf24b4c267e64fa593e5d543780', 0, 1, 'user', 'K34vyAO5g4'),
(32, 'dima', 'dima@mail.ru', '95d53bf24b4c267e64fa593e5d543780', 15, 1, 'user', 'ChaTKzyqJT');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
