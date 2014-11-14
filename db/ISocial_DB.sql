-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.38-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных isocial_db
CREATE DATABASE IF NOT EXISTS `isocial_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `isocial_db`;


-- Дамп структуры для таблица isocial_db.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.city: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.country
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.country: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `mini_photo` varchar(50) DEFAULT NULL,
  `date_start` int(11) DEFAULT NULL,
  `date_end` int(11) DEFAULT NULL,
  `time_start` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.event: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `creator_id`, `title`, `description`, `photo`, `mini_photo`, `date_start`, `date_end`, `time_start`) VALUES
	(20, 1, 'Test1', 'test1', '0', '0', 1415131200, 1415131200, 1415111400),
	(21, 1, 'Cool event', 'Fun', '0', '0', 1415131200, 1415649600, 1415068200),
	(22, 1, 'Cool event2', 'Fun2', '0', '0', 1415131200, 1415217600, 1415068200),
	(23, 1, 'Cool event2', 'sdas', '0', '0', 1415736000, 1415822400, 1415056500),
	(24, 1, 'test2', '2', '0', '0', 1415131200, 1415131200, 1415068200),
	(25, 1, 'Cool event2', 'Fun2', 'img/events/resized/1415059194.jpg', 'img/events/mini/1415059194.jpg', 1415131200, 1415908800, 1415056500),
	(26, 1, 'fsdfs', 'dfsdd', '0', '0', 1415131200, 1415131200, 1415048700),
	(27, 1, 'fdddd', 'ddddd', '0', '0', 1415131200, 1415217600, 1415052600),
	(28, 1, 'fddddddds', 'sssssssssss', '0', '0', 1415044800, 1415131200, 1415068200),
	(29, 1, 'Cool event2', 'neew', '0', '0', 1415217600, 1414958400, 1415091900);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.events_users
CREATE TABLE IF NOT EXISTS `events_users` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.events_users: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `events_users` DISABLE KEYS */;
INSERT INTO `events_users` (`event_id`, `user_id`) VALUES
	(20, 1),
	(21, 1),
	(22, 1),
	(24, 1),
	(26, 1),
	(27, 1);
/*!40000 ALTER TABLE `events_users` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.friends
CREATE TABLE IF NOT EXISTS `friends` (
  `userid` int(11) unsigned NOT NULL,
  `friendid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`userid`,`friendid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.friends: ~18 rows (приблизительно)
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` (`userid`, `friendid`) VALUES
	(1, 2),
	(1, 4),
	(1, 8),
	(1, 9),
	(1, 10),
	(2, 1),
	(2, 3),
	(2, 11),
	(3, 2),
	(3, 11),
	(4, 1),
	(6, 10),
	(8, 1),
	(9, 1),
	(10, 1),
	(10, 6),
	(11, 2),
	(11, 3);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.guests_users
CREATE TABLE IF NOT EXISTS `guests_users` (
  `guest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `review_qty` int(11) DEFAULT '0',
  PRIMARY KEY (`guest_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.guests_users: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `guests_users` DISABLE KEYS */;
INSERT INTO `guests_users` (`guest_id`, `user_id`, `date`, `review_qty`) VALUES
	(1, 2, '30', 1),
	(1, 4, '30', 1),
	(1, 5, '30', 3),
	(2, 1, '30', 0),
	(2, 4, '30', 1),
	(2, 6, '30', 1),
	(2, 7, '30', 1),
	(2, 8, '30', 2),
	(3, 6, '30', 1),
	(4, 1, '30', 0),
	(4, 6, '30', 0),
	(5, 1, '30', 1),
	(7, 1, '30', 0),
	(10, 6, '30', 1);
/*!40000 ALTER TABLE `guests_users` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид сообщения',
  `from_user` int(11) NOT NULL DEFAULT '0' COMMENT 'от кого',
  `to_user` int(11) NOT NULL DEFAULT '0' COMMENT 'кому',
  `message` varchar(1000) NOT NULL DEFAULT '0' COMMENT 'сообщение 1000 символов',
  `send_date` int(11) NOT NULL DEFAULT '0' COMMENT 'дата отправки',
  `read` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'сообщение прочитано?',
  `read_date` int(11) NOT NULL DEFAULT '0' COMMENT 'дата чтения сообщения',
  PRIMARY KEY (`id`),
  KEY `from_user` (`from_user`),
  KEY `to_user` (`to_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.messages: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `from_user`, `to_user`, `message`, `send_date`, `read`, `read_date`) VALUES
	(1, 11, 1, 'Hello mr. Test', 1414257704, 0, 0),
	(2, 11, 2, 'ÐÑƒ ÑˆÐ¾ Ñ‚Ñ‹ ÑÐµ Ð·Ð° Ð°Ð²Ñƒ Ð¿Ð¾ÑÑ‚Ð°Ð²Ð¸Ð»???', 1414257751, 0, 0),
	(3, 11, 9, 'ÐžÐ³Ð¾Ð½ÑŒ Ð±Ð°Ð±Ð° )', 1414257778, 0, 0),
	(4, 1, 8, 'Very nice, baby )', 1414257852, 0, 0),
	(5, 2, 3, 'Duuuudeeee )))', 1414257934, 0, 0),
	(6, 2, 1, 'ÐŸÐ¾Ñ‡ÐµÐ¼Ñƒ Ð²Ñ‹ Ð²ÑÐµ Ñ Ð¸Ð¼ÐµÐ½ÐµÐ¼ test, Ñƒ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ñ ÑÐ¾Ð²ÑÐµÐ¼ Ð½ÐµÑ‚ Ñ„Ð°Ð½Ñ‚Ð°Ð·Ð¸Ð¸?', 1414257978, 1, 0),
	(7, 1, 2, 'Ð§Ñ‚Ð¾ Ð±Ñ‹ Ð½Ðµ Ð¿Ð°Ñ€Ð¸Ñ‚ÑŒÑÑ Ñ Ð¿Ð°Ñ€Ð¾Ð»ÑÐ¼Ð¸! ÐšÐ°ÐºÐ¾Ð¹ Ð½Ð¸Ðº Ñ‚Ð°ÐºÐ¾Ð¹ Ð¸ Ð¿Ð°Ñ€Ð¾Ð»ÑŒ!!!', 1414258039, 0, 0),
	(8, 1, 5, 'Hello', 1415042855, 1, 0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.requests
CREATE TABLE IF NOT EXISTS `requests` (
  `user1` int(11) unsigned NOT NULL,
  `user2` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user1`,`user2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.requests: ~42 rows (приблизительно)
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` (`user1`, `user2`) VALUES
	(1, 5),
	(3, 1),
	(4, 3),
	(4, 10),
	(5, 2),
	(5, 4),
	(6, 2),
	(6, 3),
	(6, 4),
	(6, 5),
	(7, 1),
	(7, 2),
	(7, 3),
	(7, 4),
	(7, 5),
	(7, 6),
	(8, 2),
	(8, 4),
	(8, 5),
	(8, 6),
	(8, 7),
	(9, 2),
	(9, 3),
	(9, 4),
	(9, 5),
	(9, 6),
	(9, 7),
	(9, 8),
	(10, 2),
	(10, 3),
	(10, 4),
	(10, 5),
	(10, 7),
	(10, 8),
	(10, 9),
	(11, 4),
	(11, 5),
	(11, 6),
	(11, 7),
	(11, 8),
	(11, 9),
	(11, 10);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.sex
CREATE TABLE IF NOT EXISTS `sex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.sex: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `sex` DISABLE KEYS */;
/*!40000 ALTER TABLE `sex` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `subscriber` int(10) unsigned NOT NULL,
  `the_followed` int(10) unsigned NOT NULL,
  PRIMARY KEY (`subscriber`,`the_followed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.subscriptions: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` (`subscriber`, `the_followed`) VALUES
	(4, 2),
	(5, 1),
	(5, 3),
	(6, 1),
	(11, 1);
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;


-- Дамп структуры для таблица isocial_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sex` varchar(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `country` int(11) DEFAULT '0',
  `city` int(11) DEFAULT '0',
  `address` varchar(200) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `mini_photo` varchar(255) DEFAULT NULL,
  `about` text,
  `birthdate` int(11) DEFAULT '0',
  `regdate` int(11) DEFAULT '0',
  `lastvisit` int(20) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isocial_db.user: ~11 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `firstname`, `lastname`, `nickname`, `email`, `password`, `sex`, `country`, `city`, `address`, `photo`, `mini_photo`, `about`, `birthdate`, `regdate`, `lastvisit`) VALUES
	(1, '0', '0', 'test', 'test@test.test', 'test', '0', 0, 0, '0', '0', NULL, '0', 315529200, 1414256721, 0),
	(2, '0', '0', 'test1', 'test1@test1.test1', 'test1', '0', 0, 0, '0', 'img/resized/2.jpg', 'img/resized/mini/2.jpg', '0', 315615600, 1414257183, 0),
	(3, '0', '0', 'test2', 'test2@test2.test2', 'test2', '0', 0, 222, '0', 'img/resized/3.jpg', 'img/resized/mini/3.jpg', 'About me', 315702000, 1414257283, 0),
	(4, '0', '0', 'test3', 'test3@test3.test3', 'test3', '0', 0, 0, '0', 'img/resized/4.jpg', 'img/resized/mini/4.jpg', '0', 315788400, 1414257323, 0),
	(5, '0', '0', 'test4', 'test4@test4.test4', 'test4', '0', 0, 0, '0', 'img/resized/5.jpg', 'img/resized/mini/5.jpg', '0', 315874800, 1414257361, 0),
	(6, '0', '0', 'test5', 'test5@test5.test5', 'test5', '0', 0, 0, '0', 'img/resized/6.jpg', 'img/resized/mini/6.jpg', '0', 315961200, 1414257397, 0),
	(7, '0', '0', 'test6', 'test6@test6.test6', 'test6', '0', 0, 0, '0', 'img/resized/7.jpg', 'img/resized/mini/7.jpg', '0', 316047600, 1414257438, 0),
	(8, '0', '0', 'test7', 'test7@test7.test7', 'test7', '0', 0, 0, '0', 'img/resized/8.jpg', 'img/resized/mini/8.jpg', '0', 316134000, 1414257500, 0),
	(9, '0', '0', 'test8', 'test8@test8.test8', 'test8', '0', 0, 0, '0', 'img/resized/9.jpg', 'img/resized/mini/9.jpg', '0', 316220400, 1414257537, 0),
	(10, '0', '0', 'test9', 'test9@test9.test9', 'test9', '0', 0, 0, '0', 'img/resized/10.jpg', 'img/resized/mini/10.jpg', '0', 316306800, 1414257583, 0),
	(11, '0', '0', 'test10', 'test10@test10.test10', 'test10', '0', 0, 0, '0', 'img/resized/11.jpg', 'img/resized/mini/11.jpg', '0', 316393200, 1414257630, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
