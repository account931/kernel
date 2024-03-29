-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 02 2020 г., 20:48
-- Версия сервера: 5.5.28-log
-- Версия PHP: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kernel_casers_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('adminX', '1', 1577374243),
('adminX', '2', 1577373920);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('adminX', 1, 'Админ', NULL, NULL, 1577373781, 1577373781);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `balance`
--

CREATE TABLE IF NOT EXISTS `balance` (
  `balance_id` int(11) NOT NULL AUTO_INCREMENT,
  `balance_productName_id` int(11) NOT NULL,
  `balance_user_id` int(11) NOT NULL,
  `balance_amount_kg` int(11) NOT NULL,
  `balance_last_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`balance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `balance`
--

INSERT INTO `balance` (`balance_id`, `balance_productName_id`, `balance_user_id`, `balance_amount_kg`, `balance_last_edit`) VALUES
(1, 1, 2, 1268, '2020-01-02 16:53:51'),
(2, 2, 2, 450, '2019-12-26 13:48:36'),
(3, 3, 2, 12, '2020-01-02 12:18:39');

-- --------------------------------------------------------

--
-- Структура таблицы `elevators`
--

CREATE TABLE IF NOT EXISTS `elevators` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_elevator` varchar(77) NOT NULL,
  `e_discription` text NOT NULL,
  `e_operated_by` varchar(77) NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `elevators`
--

INSERT INTO `elevators` (`e_id`, `e_elevator`, `e_discription`, `e_operated_by`) VALUES
(1, 'Елеватор 1', '9.00-18.00', ''),
(2, 'Елеватор 2', '9.00-18.00', ''),
(3, 'Елеватор 3', '9.00-18.00', ''),
(4, 'Елеватор 4', '9.00-18.00', ''),
(5, 'Елеватор 5', '9.00-18.00', '');

-- --------------------------------------------------------

--
-- Структура таблицы `invoice_load_in`
--

CREATE TABLE IF NOT EXISTS `invoice_load_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_kontagent_id` int(11) NOT NULL,
  `product_nomenklatura_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unix` int(11) NOT NULL,
  `invoice_id` varchar(77) NOT NULL,
  `elevator_id` int(11) NOT NULL,
  `carrier` varchar(77) NOT NULL,
  `driver` varchar(77) NOT NULL,
  `truck` varchar(77) NOT NULL,
  `truck_weight_netto` int(11) NOT NULL,
  `truck_weight_bruto` int(11) NOT NULL,
  `product_wight` int(11) NOT NULL,
  `trash_content` int(11) NOT NULL,
  `humidity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `invoice_load_in`
--

INSERT INTO `invoice_load_in` (`id`, `user_kontagent_id`, `product_nomenklatura_id`, `date`, `unix`, `invoice_id`, `elevator_id`, `carrier`, `driver`, `truck`, `truck_weight_netto`, `truck_weight_bruto`, `product_wight`, `trash_content`, `humidity`) VALUES
(1, 2, 2, '2019-12-30 16:10:43', 1577722210, '23425345435435', 2, 'Carrier', 'Nikolay', 'Volvo', 3000, 2000, 230, 23, 12),
(2, 2, 1, '2019-12-31 12:21:04', 1577794805, 'o3yoZ64IpLW4NBixqp', 4, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(3, 2, 1, '2020-01-01 14:57:39', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(4, 2, 1, '2020-01-01 14:59:24', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(5, 2, 1, '2020-01-01 15:02:22', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(6, 2, 1, '2020-01-01 15:04:09', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(7, 2, 1, '2020-01-01 15:05:02', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(11, 2, 3, '2020-01-02 12:18:39', 1577967503, '5Nz2S-66_ZS-Mva1uA', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 12, 23, 13),
(15, 2, 1, '2020-01-02 13:01:23', 1577970071, 'HIyTCRxyWiy6VEdwgJ', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 3, 23, 13),
(16, 2, 1, '2020-01-02 13:03:13', 1577970180, 'eB8B2j5E2qyNhC7P6j', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 5, 23, 13),
(17, 2, 1, '2020-01-02 13:06:27', 1577970376, 'wrSobo8CVVLO50S8C2', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(18, 2, 1, '2020-01-02 13:09:48', 1577970577, 'Db5ofz08KzRbDThH35', 4, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(19, 2, 1, '2020-01-02 13:12:26', 1577970733, '3Z5mxSyBxDp1Pc5RiR', 4, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13),
(20, 2, 1, '2020-01-02 14:53:51', 1577976817, 'iGfR_qwkz0RkOn7KpQ', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 3, 23, 13);

-- --------------------------------------------------------

--
-- Структура таблицы `invoice_load_out`
--

CREATE TABLE IF NOT EXISTS `invoice_load_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `invoice_unique_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_wieght` int(11) NOT NULL,
  `user_date_unix` int(11) NOT NULL,
  `confirmed_by_admin` enum('0','1') NOT NULL DEFAULT '0',
  `confirmed_date_unix` int(11) NOT NULL,
  `elevator_id` int(11) NOT NULL,
  `completed` enum('0','1') NOT NULL DEFAULT '0',
  `completed_date_unix` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_unix` int(11) NOT NULL,
  `m_sender_id` int(11) NOT NULL,
  `m_receiver_id` int(11) NOT NULL,
  `m_text` text NOT NULL,
  `m_status_read` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`m_id`, `m_time`, `m_unix`, `m_sender_id`, `m_receiver_id`, `m_text`, `m_status_read`) VALUES
(7, '2020-01-02 14:53:51', 1577976831, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>You received new amount of Пшениця 3кг </p>. <p> Invoice number is iGfR_qwkz0RkOn7KpQ.</p><p>Best regards, Admin team. </p>', '0'),
(8, '2020-01-02 14:53:51', 1577976831, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>bYou received new amount of Пшениця 3кг </p>. <p> Invoice number is iGfR_qwkz0RkOn7KpQ.</p><p>Best regards, Admin team. </p>', '0'),
(9, '2020-01-02 14:53:51', 1577976831, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>You received new amount of Пшениця 3кг. </p> <p> Invoice number is iGfR_qwkz0RkOn7KpQ.</p><p>Best regards, Admin team. </p>', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1577195156),
('m140506_102106_rbac_init', 1577373715),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1577373715),
('m191224_134405_create_user_table', 1577195161);

-- --------------------------------------------------------

--
-- Структура таблицы `product_name`
--

CREATE TABLE IF NOT EXISTS `product_name` (
  `pr_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_name_name` text NOT NULL,
  `pr_name_descr` varchar(155) NOT NULL,
  `pr_name_measure` varchar(12) NOT NULL,
  PRIMARY KEY (`pr_name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `product_name`
--

INSERT INTO `product_name` (`pr_name_id`, `pr_name_name`, `pr_name_descr`, `pr_name_measure`) VALUES
(1, 'Пшениця', 'Wheat crops', 'kg'),
(2, 'Кукурудза', 'Corn crops', 'kg'),
(3, 'Рис', 'Rice crops', 'kg'),
(4, 'Гречка', 'buckwheat', 'kg'),
(5, 'Овес', 'Oats', 'kg');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '9',
  `first_name` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(33) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(77) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `first_name`, `last_name`, `company_name`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'dP_dfIwbCsJI6uT81siaGhQlCtZL-qO8', '$2y$13$oMLFyRqmOIfiqUEZiCySbecfimjMixTXFUQDoyFy4mUanrhBM.B5O', NULL, 'admin@ukr.net', 10, 'Admin', 'Admin', 'Administration', '+380975431111', 'Kyiv, st. Perova, 14', 1577195541, 1577195541),
(2, 'dima', '_bICf_IGlSe_EbaNwQWqSkPnSxD6Otdz', '$2y$13$UAYnbtP85axqt6EpBHGOPescY3HoUhIWQa8Tg2Fdi9gIOWpTBF/N2', NULL, 'dima@ukr.net', 10, 'Dmitriy', 'F', '2F', '+380975436444', 'Kyiv, st. Prorizna, 44', 1577197958, 1577197958),
(13, 'Vasya', 'oQZKPTcYnsGj44i7xNppGnWnC2VTzqdO', '$2y$13$ZOMrnN04wXJgN8f5Fpk65OUxDNcKhnRrxD/KmGFmEdSiym7gBZGNm', NULL, 'vasya@ukr.net', 9, 'Vasyl', 'Ivanov', 'Sealand Ltd', '+380975456475', 'Kyiv, st. Darwina, 4', 1577200843, 1577461104),
(14, 'olya2', 'ItV8wT4dMV1crN9mYchD1Q_82DPGPS6N', '$2y$13$uGEZIOwp5hN11WAEfULEFuWy74vu.cc7zB1Z1vJQhnKyTUlGIUv8e', NULL, 'olya@ukr.net2', 9, 'Olga', 'Petrova', 'Brief Ltd', '+38097543654', 'Kyiv, st New', 1577203225, 1577459142),
(15, 'olyasadas', 'EaFiYu7EZMBSNFUnwXHq6E5Viw7BFIME', '$2y$13$6Ggjxeum9JcnO16.L/sNuO0w/W6VV36avq64UMCF9E9Xz62KyIGLy', NULL, 'vasyasdsadsda@ukr.net', 9, 'Dmitriy', 'Ss', 'Ceder', '+380976641344', 'Kyiv st', 1577552914, 1577552914);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
