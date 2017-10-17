-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 17 2017 г., 17:00
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Pushkin'),
(2, 'Tolstoy'),
(3, 'Shevchenko'),
(4, 'Lermontov'),
(5, 'avtor');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `price`, `discount`) VALUES
(1, 'Kniga1', 'Opisanie knigi bla bla bla. asdsdadadd ad asdsdsdsda dsa dasd ad a.dasddasd ad asd asd asd ads \r\n', 120.3, 5),
(2, 'Kniga Dva', 'Opisanie knigi bla bla bla. asdsdadadd ad asdsdsdsda dsa dasd ad a.dasddasd ad asd asd asd ads Opisanie knigi bla bla bla. asdsdadadd ad asdsdsdsda dsa dasd ad a.dasddasd ad asd asd asd ads Opisanie knigi bla bla bla. asdsdadadd ad asdsdsdsda dsa dasd ad a.dasddasd ad asd asd asd ads ', 152.1, 0),
(3, 'Book Three', 'Opisanie knigi bla bla bla. asdsdadadd ad asdsdsdsda dsa dasd ad a.dasddasd ad asd  fsdfdsfsdfsd.fdsffsdf.dsfdsfsdfdsf.sdfsdfsdfsdfsdfs.dfsdf', 99.99, 0),
(4, 'Book CHETIRE', 'zZZZZZZZZZZZa dasd ad a.dasddasd ad asd  fsdfdsfsdfsd.fdsffsdf.dsfdsfsdfdsf.sdfsdfsdfsdfsdfs.dfsdf', 121.2, 15),
(5, 'Kniga Five', 'zZZsZZZZZZZZZa dasd ad a.dasddasd ad asd  fsdfdsfsdfsd.fdsffsdf.dsfdsfsdfdsf.sdfsdfsdfsdfsdfs.dfsdfzZZsZZZZZZZZZa dasd ad a.dasddasd ad asd  fsdfdsfsdfsd.fdsffsdf.dsfdsfsdfdsf.sdfsdfsdfsdfsdfs.dfsdfzZZsZZZZZZZZZa dasd ad a.dasddasd ad asd  fsdfdsfsdfsd.fdsffsdf.dsfdsfsdfdsf.sdfsdfsdfsdfsdfs.dfsdf', 112.2, 0);

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
(2, 3),
(3, 3),
(4, 2),
(5, 1),
(1, 2),
(2, 5),
(3, 1),
(3, 2);

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
(1, 1),
(1, 2),
(2, 3),
(3, 3),
(4, 2),
(4, 4),
(5, 2),
(5, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id_user`, `id_book`, `count`) VALUES
(14, 4, 3);

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
(1, 'Fantastika'),
(2, 'Nauchnaya'),
(3, 'Detektiv'),
(4, 'Horror');

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
(4, 1, 3, 120.3, 5),
(4, 2, 12, 152.1, 0),
(4, 4, 5, 121.2, 15),
(5, 1, 3, 120.3, 5),
(5, 2, 12, 152.1, 0),
(5, 4, 5, 121.2, 15),
(5, 5, 5, 112.2, 0),
(6, 1, 3, 120.3, 5),
(6, 2, 12, 152.1, 0),
(6, 4, 5, 121.2, 15),
(6, 5, 5, 112.2, 0),
(7, 3, 3, 99.99, 0),
(8, 2, 3, 152.1, 0),
(9, 1, 3, 120.3, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `id_payment`, `id_status`, `date`, `disc_user`) VALUES
(4, 14, 1, 1, '2017-10-16 11:46:49', 0),
(5, 14, 2, 1, '2017-10-16 12:06:52', 0),
(6, 14, 2, 1, '2017-10-16 12:07:04', 0),
(7, 14, 2, 1, '2017-10-16 12:07:40', 0),
(8, 14, 3, 1, '2017-10-16 12:08:32', 0),
(9, 14, 3, 1, '2017-10-16 12:10:26', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `pass`, `discount`, `status`, `role`, `hash`) VALUES
(11, 'aa', 'aa@aa.aa', '4124bc0a9335c27f086f24ba207a4912', 0, 1, 'user', 'BIgujN1bJx'),
(14, 'ss', 'ss@ss.ss', '3691308f2a4c2f6983f2880d32e29c84', 0, 1, 'user', 'zt9O9VzSdY'),
(15, 'ADMIN', 'zz@zz.zz', '25ed1bcb423b0b7200f485fc5ff71c8e', 0, 1, 'admin', 'ReHXuQTQib');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
