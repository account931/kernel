-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 23 2020 г., 20:40
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `balance`
--

INSERT INTO `balance` (`balance_id`, `balance_productName_id`, `balance_user_id`, `balance_amount_kg`, `balance_last_edit`) VALUES
(1, 1, 2, 1598, '2020-01-21 17:04:36'),
(3, 1, 14, 23, '2020-01-22 17:34:52'),
(4, 2, 14, 2, '2020-01-22 15:22:35'),
(5, 2, 17, 230, '2020-01-22 17:01:02'),
(6, 1, 17, 260, '2020-01-22 17:26:58'),
(7, 5, 2, 147, '2020-01-23 15:25:45'),
(9, 5, 14, 11, '2020-01-23 16:08:27');

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
  `final_balance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `invoice_load_in`
--

INSERT INTO `invoice_load_in` (`id`, `user_kontagent_id`, `product_nomenklatura_id`, `date`, `unix`, `invoice_id`, `elevator_id`, `carrier`, `driver`, `truck`, `truck_weight_netto`, `truck_weight_bruto`, `product_wight`, `trash_content`, `humidity`, `final_balance`) VALUES
(1, 2, 2, '2019-12-30 16:10:43', 1577722210, '23425345435435', 2, 'Carrier', 'Nikolay', 'Volvo', 3000, 2000, 230, 23, 12, 0),
(2, 2, 1, '2019-12-31 12:21:04', 1577794805, 'o3yoZ64IpLW4NBixqp', 4, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(3, 2, 1, '2020-01-01 14:57:39', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(4, 2, 1, '2020-01-01 14:59:24', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(5, 2, 1, '2020-01-01 15:02:22', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(6, 2, 1, '2020-01-01 15:04:09', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(7, 2, 1, '2020-01-01 15:05:02', 1577890639, 'Jb8Ym-STMhNr_yC1by', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(11, 2, 3, '2020-01-02 12:18:39', 1577967503, '5Nz2S-66_ZS-Mva1uA', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 12, 23, 13, 0),
(15, 2, 1, '2020-01-02 13:01:23', 1577970071, 'HIyTCRxyWiy6VEdwgJ', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 3, 23, 13, 0),
(16, 2, 1, '2020-01-02 13:03:13', 1577970180, 'eB8B2j5E2qyNhC7P6j', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 5, 23, 13, 0),
(17, 2, 1, '2020-01-02 13:06:27', 1577970376, 'wrSobo8CVVLO50S8C2', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(18, 2, 1, '2020-01-02 13:09:48', 1577970577, 'Db5ofz08KzRbDThH35', 4, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(19, 2, 1, '2020-01-02 13:12:26', 1577970733, '3Z5mxSyBxDp1Pc5RiR', 4, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(20, 2, 1, '2020-01-02 14:53:51', 1577976817, 'iGfR_qwkz0RkOn7KpQ', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 3, 23, 13, 0),
(21, 2, 2, '2020-01-14 15:48:26', 1579016873, 'DGjtQ-1579016873', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 15, 23, 13, 0),
(22, 2, 1, '2020-01-21 14:48:21', 1579617975, 'UHqmV-1579617975', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(23, 2, 1, '2020-01-21 14:59:18', 1579618731, 'cijXm-1579618731', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 15, 23, 12, 0),
(24, 2, 1, '2020-01-21 15:04:36', 1579619053, 'JLAZQ-1579619053', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 250, 23, 13, 0),
(25, 17, 2, '2020-01-22 17:01:02', 1579712435, '6siwI-1579712434', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 230, 23, 13, 0),
(26, 17, 1, '2020-01-22 17:10:14', 1579712991, 'qGJel-1579712991', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 15, 23, 13, 0),
(27, 17, 1, '2020-01-22 17:23:00', 1579713757, 'wObXu-1579713757', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 15, 23, 13, 0),
(28, 17, 1, '2020-01-22 17:26:58', 1579713997, 'Ot0Rx-1579713997', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 230, 23, 13, 0),
(29, 2, 5, '2020-01-23 15:24:20', 1579793031, 'XJKN8-1579793031', 5, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 150, 23, 13, 0),
(30, 2, 5, '2020-01-23 15:25:45', 1579793061, 'yWyPW-1579793061', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 3, 23, 12, 153),
(31, 2, 2, '2020-01-23 15:34:18', 1579793639, '9Lm60-1579793639', 2, 'Carrier1', 'Nikolay', 'Volvo', 3000, 4000, 1, 23, 13, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `invoice_load_out`
--

CREATE TABLE IF NOT EXISTS `invoice_load_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `invoice_unique_id` varchar(77) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_wieght` int(11) NOT NULL,
  `user_date_unix` int(11) NOT NULL,
  `confirmed_by_admin` enum('0','1') NOT NULL DEFAULT '0',
  `confirmed_date_unix` int(11) NOT NULL,
  `date_to_load_out` int(77) NOT NULL,
  `b_intervals` int(3) NOT NULL,
  `b_quarters` int(3) NOT NULL,
  `elevator_id` int(11) NOT NULL,
  `completed` enum('0','1') NOT NULL DEFAULT '0',
  `completed_date_unix` int(11) NOT NULL,
  `final_balance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Дамп данных таблицы `invoice_load_out`
--

INSERT INTO `invoice_load_out` (`id`, `user_id`, `invoice_unique_id`, `product_id`, `product_wieght`, `user_date_unix`, `confirmed_by_admin`, `confirmed_date_unix`, `date_to_load_out`, `b_intervals`, `b_quarters`, `elevator_id`, `completed`, `completed_date_unix`, `final_balance`) VALUES
(13, 2, 'deLj5OK7NvehBjFGsb0', 2, 11, 1578321591, '1', 1578674068, 1578614400, 19, 3, 4, '0', 0, 0),
(14, 2, 'deLj5OK7NvhehBjFGsb0', 2, 11, 1578321591, '1', 1578672540, 1578614400, 16, 0, 3, '0', 0, 0),
(15, 2, 'deLj5OKt7NvhehBjFGsb0', 2, 11, 1578321591, '1', 1578672301, 1578614400, 13, 3, 4, '0', 0, 0),
(16, 2, 'deLj5OKt67NvhehBjFGsb0', 2, 11, 1578321591, '1', 1578674703, 1578700800, 19, 0, 5, '0', 0, 0),
(17, 2, 'jbpDaJwTcQKAAk6MV_', 2, 1, 1578321986, '1', 1578739533, 1578700800, 8, 0, 5, '0', 0, 0),
(18, 2, 'rzlc6Yu5-Vy83UYOPr', 2, 1, 1578322212, '1', 1578738263, 1578700800, 8, 0, 5, '0', 0, 0),
(19, 2, 'S0wS_8-tTq060v-Uzc', 2, 1, 1578322376, '1', 1578740836, 1578700800, 13, 3, 5, '0', 0, 0),
(20, 2, 'kOtmsvdSP945VyUkQx', 2, 1, 1578322502, '1', 1578741154, 1578700800, 14, 3, 5, '0', 0, 0),
(21, 2, 'kOtmsvdSP7945VyUkQx', 2, 1, 1578322502, '1', 1578741178, 1578700800, 13, 3, 5, '0', 0, 0),
(22, 2, 'kOtmsvdSP77945VyUkQx', 2, 1, 1578322502, '1', 1578759163, 1578873600, 8, 0, 5, '0', 0, 0),
(23, 2, '7ugrI-1578322825', 2, 1, 1578322825, '1', 1578759196, 1578873600, 16, 0, 5, '0', 0, 0),
(24, 2, 'Qwri9-1578759368', 1, 1, 1578759368, '1', 1578759415, 1578873600, 8, 3, 5, '0', 0, 0),
(25, 2, 'rfXvc-1578759381', 1, 2, 1578759381, '1', 1579010221, 1579046400, 19, 3, 5, '0', 0, 0),
(26, 2, '0xfc0-1578759400', 1, 1, 1578759400, '1', 1579532472, 1579651200, 8, 3, 5, '0', 0, 0),
(27, 2, '02ZP6-1579016947', 2, 1, 1579016947, '1', 0, 0, 0, 0, 0, '0', 0, 0),
(28, 2, 'gmUe2-1579530578', 1, 10, 1579530473, '0', 0, 0, 0, 0, 0, '0', 0, 0),
(29, 2, '8YWPS-1579532686', 1, 10, 1579532686, '1', 1579789735, 1579824000, 9, 0, 5, '0', 0, 0),
(30, 2, 'Jcz9X-1579532787', 1, 10, 1579532787, '0', 0, 0, 0, 0, 0, '0', 0, 0),
(31, 2, 'lAQKo-1579532980', 1, 20, 1579532980, '0', 0, 0, 0, 0, 0, '0', 0, 0),
(32, 2, 'R9FHE-1579712292', 1, 100, 1579712282, '1', 1579712322, 1579824000, 8, 3, 5, '0', 0, 0),
(33, 2, '-fMuj-1579712875', 1, 10, 1579712867, '1', 1579712903, 1579824000, 9, 3, 5, '0', 0, 0),
(34, 2, 'NMHCO-1579713645', 2, 10, 1579713637, '1', 1579713671, 1579737600, 8, 3, 5, '0', 0, 0),
(35, 2, 'plQ1y-1579713886', 2, 1, 1579713867, '1', 1579713910, 1580083200, 8, 3, 5, '0', 0, 0),
(36, 2, '29n5K-1579793384', 5, 1, 1579793384, '0', 0, 0, 0, 0, 0, '0', 0, 152),
(37, 2, '0lyyb-1579793394', 2, 1, 1579793394, '0', 0, 0, 0, 0, 0, '0', 0, 0),
(38, 2, '2cxsw-1579793700', 2, 1, 1579793670, '0', 0, 0, 0, 0, 0, '0', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`m_id`, `m_time`, `m_unix`, `m_sender_id`, `m_receiver_id`, `m_text`, `m_status_read`) VALUES
(7, '2020-01-02 14:53:51', 1577976831, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>You received new amount of Пшениця 3кг </p>. <p> Invoice number is iGfR_qwkz0RkOn7KpQ.</p><p>Best regards, Admin team. </p>', '0'),
(8, '2020-01-02 14:53:51', 1577976831, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>bYou received new amount of Пшениця 3кг </p>. <p> Invoice number is iGfR_qwkz0RkOn7KpQ.</p><p>Best regards, Admin team. </p>', '0'),
(9, '2020-01-02 14:53:51', 1577976831, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>You received new amount of Пшениця 3кг. </p> <p> Invoice number is iGfR_qwkz0RkOn7KpQ.</p><p>Best regards, Admin team. </p>', '0'),
(10, '2020-01-06 14:44:36', 1578321876, 2, 1, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  11кг.</p><p> Номер накладної  deLj5OKt67NvhehBjFGsb0.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(11, '2020-01-06 14:46:34', 1578321994, 2, 1, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  jbpDaJwTcQKAAk6MV_.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(12, '2020-01-06 14:50:21', 1578322221, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  rzlc6Yu5-Vy83UYOPr.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(13, '2020-01-06 14:53:06', 1578322386, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  S0wS_8-tTq060v-Uzc.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(14, '2020-01-06 14:55:31', 1578322531, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  kOtmsvdSP945VyUkQx.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(15, '2020-01-06 14:56:35', 1578322595, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  kOtmsvdSP7945VyUkQx.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(16, '2020-01-06 14:59:02', 1578322742, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  kOtmsvdSP77945VyUkQx.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(17, '2020-01-06 15:00:37', 1578322837, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  7ugrI-1578322825.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(18, '2020-01-06 15:01:35', 1578322895, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  388кг.</p><p> Номер накладної  fWk63-1578322837.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(19, '2020-01-10 16:23:11', 1578673391, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  11кг.</p><p> Номер накладної  deLj5OK7NvhehBjFGsb0.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(20, '2020-01-10 16:38:02', 1578674282, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ваш запит на вiдвантаження Кукурудза у кількості  11кг.</p><p> Номер накладної  deLj5OK7NvehBjFGsb0 було свалено адміністратором. Ваша дата та час Jan 10, 2020 19.30. Елеватор номер 4</p><p>Best regards, Admin team. </p>', '0'),
(21, '2020-01-10 16:46:04', 1578674764, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>11</b> кг.</p><p> Номер накладної <b> deLj5OKt67NvhehBjFGsb0</b></p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 11, 2020 19.00 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(22, '2020-01-11 10:31:36', 1578738696, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> rzlc6Yu5-Vy83UYOPr</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 11, 2020 8.00 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(23, '2020-01-11 10:46:14', 1578739574, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> jbpDaJwTcQKAAk6MV_</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 11, 2020 8.00 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(24, '2020-01-11 11:12:33', 1578741153, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> S0wS_8-tTq060v-Uzc</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 11, 2020 13.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(25, '2020-01-11 11:12:58', 1578741178, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> kOtmsvdSP945VyUkQx</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 11, 2020 14.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(26, '2020-01-11 11:13:31', 1578741211, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> kOtmsvdSP7945VyUkQx</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 11, 2020 13.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(27, '2020-01-11 16:13:16', 1578759196, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> kOtmsvdSP77945VyUkQx</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 13, 2020 8.00 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(28, '2020-01-11 16:15:52', 1578759352, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> 7ugrI-1578322825</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 13, 2020 16.00 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(29, '2020-01-11 16:16:21', 1578759381, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  1кг.</p><p> Номер накладної  Qwri9-1578759368.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(30, '2020-01-11 16:16:39', 1578759399, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  2кг.</p><p> Номер накладної  rfXvc-1578759381.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(31, '2020-01-11 16:16:47', 1578759407, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  1кг.</p><p> Номер накладної  0xfc0-1578759400.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(32, '2020-01-11 16:17:21', 1578759441, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Пшениця</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> Qwri9-1578759368</b>.</p><p>Ваша заявка була свалено адміністратором. Ваша дата та час для відвантаження продукції <b>Jan 13, 2020 8.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(33, '2020-01-14 13:57:25', 1579010244, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Пшениця</b> у кількості  <b>2</b> кг.</p><p> Номер накладної <b> rfXvc-1578759381</b>.</p><p>Вашу заявку було свалено адміністратором. Ваша дата та час для відвантаження продукції <b>15-01-2020 4:00 19.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(34, '2020-01-14 15:48:26', 1579016906, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>You received new amount of Кукурудза 15кг.</p><p> Invoice number is DGjtQ-1579016873.</p><p>Best regards, Admin team. </p>', '0'),
(35, '2020-01-14 15:49:35', 1579016975, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  02ZP6-1579016947.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(36, '2020-01-20 14:31:35', 1579530695, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  10кг.</p><p> Номер накладної  gmUe2-1579530578.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(37, '2020-01-20 15:02:12', 1579532532, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Пшениця</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> 0xfc0-1578759400</b>.</p><p>Вашу заявку було схвалено адміністратором. Ваша дата та час для відвантаження продукції <b>22-01-2020 4:00 8.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(38, '2020-01-20 15:04:59', 1579532699, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  10кг.</p><p> Номер накладної  8YWPS-1579532686.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(39, '2020-01-20 15:06:37', 1579532797, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  10кг.</p><p> Номер накладної  Jcz9X-1579532787.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(40, '2020-01-20 15:09:54', 1579532994, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  20кг.</p><p> Номер накладної  lAQKo-1579532980.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(41, '2020-01-21 13:52:03', 1579614723, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> 02ZP6-1579016947</b>.</p><p>Вашу заявку було схвалено адміністратором. Ваша дата та час для відвантаження продукції <b>22-01-2020 4:00 8.00 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(42, '2020-01-21 14:48:21', 1579618101, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>You received new amount of Пшениця 250кг.</p><p> Invoice number is UHqmV-1579617975.</p><p>Best regards, Admin team. </p>', '0'),
(43, '2020-01-21 14:59:18', 1579618758, 2, 2, '<p>Dear user <b>Dmitriy</b></p><p>You received new amount of Пшениця 15кг.</p><p> Invoice number is cijXm-1579618731.</p><p>Best regards, Admin team. </p>', '0'),
(44, '2020-01-21 15:04:36', 1579619076, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Пшениця 250кг.</b></p><p> Номер накладної <b>JLAZQ-1579619053.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(45, '2020-01-22 15:12:11', 1579705931, 2, 2, '<p>Шановний <b>Olga</b></p><p>Ви переоформили  Пшениця 2кг.</p><p> Invoice number is Trans-OxAVO-1579705486.</p><p>Best regards, Admin team. </p>', '0'),
(46, '2020-01-22 15:19:30', 1579706370, 2, 2, '<p>Шановний <b>Olga</b></p><p>Ви переоформили  Пшениця 2кг.</p><p> Invoice number is Trans-OxAVO-1579705486.</p><p>Best regards, Admin team. </p>', '0'),
(47, '2020-01-22 15:20:49', 1579706449, 2, 2, '<p>Шановний <b>Olga</b></p><p>Ви переоформили  Пшениця 2кг.</p><p> Invoice number is Trans-OxAVO-1579705486.</p><p>Best regards, Admin team. </p>', '0'),
(48, '2020-01-22 15:20:49', 1579706449, 2, 14, '<p>Шановний <b></b></p><p>Користувач <b>2</b>переоформив на ВасПшениця 2кг.</p><p> Invoice number is Trans-OxAVO-1579705486.</p><p>Best regards, Admin team. </p>', '0'),
(49, '2020-01-22 15:22:35', 1579706555, 2, 2, '<p>Шановний <b>Olga</b></p><p>Ви переоформили  Кукурудза 2кг.</p><p> Invoice number is Trans-6DJ3V-1579706538.</p><p>Best regards, Admin team. </p>', '0'),
(50, '2020-01-22 15:22:35', 1579706555, 2, 14, '<p>Шановний <b></b></p><p>Користувач <b>2</b>переоформив на ВасКукурудза 2кг.</p><p> Invoice number is Trans-6DJ3V-1579706538.</p><p>Best regards, Admin team. </p>', '0'),
(51, '2020-01-22 15:24:03', 1579706643, 2, 2, '<p>Шановний <b>Olga</b></p><p>Ви переоформили  Пшениця 3кг.</p><p> Invoice number is Trans-j0Bms-1579706618.</p><p>Best regards, Admin team. </p>', '0'),
(52, '2020-01-22 15:24:03', 1579706643, 2, 14, '<p>Шановний <b></b></p><p>Користувач <b>2</b>переоформив на ВасПшениця 3кг.</p><p> Invoice number is Trans-j0Bms-1579706618.</p><p>Best regards, Admin team. </p>', '0'),
(53, '2020-01-22 15:29:33', 1579706973, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>Ви переоформили  Пшениця 2кг.</p><p> Invoice number is Trans-ZWwKW-1579706943.</p><p>Best regards, Admin team. </p>', '0'),
(54, '2020-01-22 15:29:33', 1579706973, 2, 14, '<p>Шановний <b>Olga</b></p><p>Користувач <b>Dmitriy</b>переоформив на ВасПшениця 2кг.</p><p> Invoice number is Trans-ZWwKW-1579706943.</p><p>Best regards, Admin team. </p>', '0'),
(55, '2020-01-22 15:32:17', 1579707137, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>Ви переоформили  на користувача Dmitriy Пшениця 2кг.</p><p> Invoice number is Trans-4Sj44-1579707101.</p><p>Best regards, Admin team. </p>', '0'),
(56, '2020-01-22 15:32:17', 1579707137, 2, 14, '<p>Шановний <b>Olga</b></p><p>Користувач <b>Dmitriy</b>переоформив на ВасПшениця 2кг.</p><p> Invoice number is Trans-4Sj44-1579707101.</p><p>Best regards, Admin team. </p>', '0'),
(57, '2020-01-22 15:34:52', 1579707292, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>Ви переоформили  на користувача Olga Пшениця 2кг.</p><p> Invoice number is Trans-u8Pfh-1579707274.</p><p>Best regards, Admin team. </p>', '0'),
(58, '2020-01-22 15:34:52', 1579707292, 2, 14, '<p>Шановний <b>Olga</b></p><p>Користувач <b>Dmitriy</b>переоформив на ВасПшениця 2кг.</p><p> Invoice number is Trans-u8Pfh-1579707274.</p><p>Best regards, Admin team. </p>', '0'),
(59, '2020-01-22 16:58:26', 1579712306, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  100кг.</p><p> Номер накладної  R9FHE-1579712292.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(60, '2020-01-22 16:59:10', 1579712350, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Пшениця</b> у кількості  <b>100</b> кг.</p><p> Номер накладної <b> R9FHE-1579712292</b>.</p><p>Вашу заявку було схвалено адміністратором. Ваша дата та час для відвантаження продукції <b>24-01-2020 2:00 8.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(61, '2020-01-22 17:01:02', 1579712462, 1, 17, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Кукурудза 230кг.</b></p><p> Номер накладної <b>6siwI-1579712434.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(62, '2020-01-22 17:08:06', 1579712886, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Пшениця у кількості  10кг.</p><p> Номер накладної  -fMuj-1579712875.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(63, '2020-01-22 17:08:47', 1579712927, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Пшениця</b> у кількості  <b>10</b> кг.</p><p> Номер накладної <b> -fMuj-1579712875</b>.</p><p>Вашу заявку було схвалено адміністратором. Ваша дата та час для відвантаження продукції <b>24-01-2020 2:00 9.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(64, '2020-01-22 17:10:14', 1579713014, 1, 17, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Пшениця 15кг.</b></p><p> Номер накладної <b>qGJel-1579712991.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(65, '2020-01-22 17:20:55', 1579713655, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  10кг.</p><p> Номер накладної  NMHCO-1579713645.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(66, '2020-01-22 17:21:37', 1579713697, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>10</b> кг.</p><p> Номер накладної <b> NMHCO-1579713645</b>.</p><p>Вашу заявку було схвалено адміністратором. Ваша дата та час для відвантаження продукції <b>23-01-2020 2:00 8.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(67, '2020-01-22 17:23:00', 1579713780, 1, 17, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Пшениця 15кг.</b></p><p> Номер накладної <b>wObXu-1579713757.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(68, '2020-01-22 17:24:56', 1579713896, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  plQ1y-1579713886.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(69, '2020-01-22 17:25:34', 1579713934, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Кукурудза</b> у кількості  <b>1</b> кг.</p><p> Номер накладної <b> plQ1y-1579713886</b>.</p><p>Вашу заявку було схвалено адміністратором. Ваша дата та час для відвантаження продукції <b>27-01-2020 2:00 8.30 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(70, '2020-01-22 17:26:58', 1579714018, 1, 17, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Пшениця 230кг.</b></p><p> Номер накладної <b>Ot0Rx-1579713997.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(71, '2020-01-23 14:29:43', 1579789783, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ми отримали Ваш запит на вiдвантаження <b>Пшениця</b> у кількості  <b>10</b> кг.</p><p> Номер накладної <b> 8YWPS-1579532686</b>.</p><p>Вашу заявку було схвалено адміністратором. Ваша дата та час для відвантаження продукції <b>24-01-2020 2:00 9.00 </b>. Елеватор номер <b>5</b>.</p><p>Best regards, Admin team. </p>', '0'),
(72, '2020-01-23 15:24:21', 1579793060, 1, 2, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Овес 150кг.</b></p><p> Номер накладної <b>XJKN8-1579793031.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(73, '2020-01-23 15:25:45', 1579793145, 1, 2, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Овес 3кг.</b></p><p> Номер накладної <b>yWyPW-1579793061.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(74, '2020-01-23 15:29:54', 1579793394, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Овес у кількості  1кг.</p><p> Номер накладної  29n5K-1579793384.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(75, '2020-01-23 15:34:18', 1579793658, 1, 2, '<p>Шановний <b>Dmitriy</b></p><p>На Ваш баланс зараховано надходження продукту <b>Кукурудза 1кг.</b></p><p> Номер накладної <b>9Lm60-1579793639.</b></p><p>Деталі можна подивитися у розділі <b>''Історія''</b></p><p>Best regards, Admin team. </p>', '0'),
(76, '2020-01-23 15:35:07', 1579793707, 1, 2, '<p>Dear user <b>Dmitriy</b></p><p>Ви надiслали запит на вiдвантаження Кукурудза у кількості  1кг.</p><p> Номер накладної  2cxsw-1579793700.</p><p> Очікуйте на повідомлення з підтвердженням адміністратора та датою і часом</p><p>Best regards, Admin team. </p>', '0'),
(77, '2020-01-23 15:49:10', 1579794550, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>Ви переоформили  на користувача Olga Овес 2кг.</p><p> Номер накладної Trans-aX1xh-1579794361.</p><p>Best regards, Admin team. </p>', '0'),
(78, '2020-01-23 15:49:10', 1579794550, 2, 14, '<p>Шановний <b>Olga</b></p><p>Користувач <b>Dmitriy</b> переоформив на Вас Овес 2кг.</p><p> Номер накладної  Trans-aX1xh-1579794361.</p><p>Best regards, Admin team. </p>', '0'),
(79, '2020-01-23 15:51:42', 1579794702, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>Ви переоформили  на користувача Olga Овес 1кг.</p><p> Номер накладної Trans-LpvAJ-1579794686.</p><p>Best regards, Admin team. </p>', '0'),
(80, '2020-01-23 15:51:42', 1579794702, 2, 14, '<p>Шановний <b>Olga</b></p><p>Користувач <b>Dmitriy</b> переоформив на Вас Овес 1кг.</p><p> Номер накладної  Trans-LpvAJ-1579794686.</p><p>Best regards, Admin team. </p>', '0'),
(81, '2020-01-23 15:56:40', 1579795000, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>Ви переоформили  на користувача Olga Овес 1кг.</p><p> Номер накладної Trans-lDfqA-1579794702.</p><p>Best regards, Admin team. </p>', '0'),
(82, '2020-01-23 15:56:40', 1579795000, 2, 14, '<p>Шановний <b>Olga</b></p><p>Користувач <b>Dmitriy</b> переоформив на Вас Овес 1кг.</p><p> Номер накладної  Trans-lDfqA-1579794702.</p><p>Best regards, Admin team. </p>', '0'),
(83, '2020-01-23 16:08:27', 1579795707, 2, 2, '<p>Шановний <b>Dmitriy</b></p><p>Ви переоформили  на користувача Olga Овес 1кг.</p><p> Номер накладної Trans-G1h_1-1579795695.</p><p>Best regards, Admin team. </p>', '0'),
(84, '2020-01-23 16:08:27', 1579795707, 2, 14, '<p>Шановний <b>Olga</b></p><p>Користувач <b>Dmitriy</b> переоформив на Вас Овес 1кг.</p><p> Номер накладної  Trans-G1h_1-1579795695.</p><p>Best regards, Admin team. </p>', '0');

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
-- Структура таблицы `transfer_rights`
--

CREATE TABLE IF NOT EXISTS `transfer_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(3) NOT NULL,
  `invoice_id` varchar(77) NOT NULL,
  `from_user_id` int(6) NOT NULL,
  `to_user_id` int(6) NOT NULL,
  `product_weight` int(12) NOT NULL,
  `unix_time` int(77) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `final_balance_sender` int(11) NOT NULL,
  `final_balance_receiver` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `transfer_rights`
--

INSERT INTO `transfer_rights` (`id`, `product_id`, `invoice_id`, `from_user_id`, `to_user_id`, `product_weight`, `unix_time`, `date`, `final_balance_sender`, `final_balance_receiver`) VALUES
(1, 1, 'Trans-So9-1579185191', 2, 14, 1, 1579185191, '2020-01-16 14:33:50', 0, 0),
(2, 1, 'Trans-mnU-1579185533', 2, 13, 1, 1579185533, '2020-01-16 14:39:52', 0, 0),
(3, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:05:05', 0, 0),
(4, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:07:30', 0, 0),
(5, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:08:32', 0, 0),
(6, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:09:15', 0, 0),
(7, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:11:18', 0, 0),
(8, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:12:11', 0, 0),
(9, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:19:30', 0, 0),
(10, 1, 'Trans-OxAVO-1579705486', 2, 14, 2, 1579705486, '2020-01-22 15:20:49', 0, 0),
(11, 2, 'Trans-6DJ3V-1579706538', 2, 14, 2, 1579706538, '2020-01-22 15:22:35', 0, 0),
(12, 1, 'Trans-j0Bms-1579706618', 2, 14, 3, 1579706619, '2020-01-22 15:24:03', 0, 0),
(13, 1, 'Trans-ZWwKW-1579706943', 2, 14, 2, 1579706943, '2020-01-22 15:29:33', 0, 0),
(14, 1, 'Trans-4Sj44-1579707101', 2, 14, 2, 1579707101, '2020-01-22 15:32:16', 0, 0),
(15, 1, 'Trans-u8Pfh-1579707274', 2, 14, 2, 1579707274, '2020-01-22 15:34:52', 0, 0),
(16, 5, 'Trans-aX1xh-1579794361', 2, 14, 2, 1579794361, '2020-01-23 15:46:20', 0, 0),
(17, 5, 'Trans-aX1xh-1579794361', 2, 14, 2, 1579794361, '2020-01-23 15:47:28', 0, 0),
(18, 5, 'Trans-aX1xh-1579794361', 2, 14, 2, 1579794361, '2020-01-23 15:48:41', 0, 0),
(19, 5, 'Trans-aX1xh-1579794361', 2, 14, 2, 1579794361, '2020-01-23 15:49:10', 0, 0),
(20, 5, 'Trans-LpvAJ-1579794686', 2, 14, 1, 1579794686, '2020-01-23 15:51:42', 0, 0),
(21, 5, 'Trans-lDfqA-1579794702', 2, 14, 1, 1579794702, '2020-01-23 15:56:40', 0, 0),
(22, 5, 'Trans-G1h_1-1579795695', 2, 14, 1, 1579795696, '2020-01-23 16:08:27', 147, 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `first_name`, `last_name`, `company_name`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'dP_dfIwbCsJI6uT81siaGhQlCtZL-qO8', '$2y$13$oMLFyRqmOIfiqUEZiCySbecfimjMixTXFUQDoyFy4mUanrhBM.B5O', NULL, 'admin@ukr.net', 10, 'Admin', 'Admin', 'Administration', '+380975431111', 'Kyiv, st. Perova, 14', 1577195541, 1577195541),
(2, 'dima', '_bICf_IGlSe_EbaNwQWqSkPnSxD6Otdz', '$2y$13$UAYnbtP85axqt6EpBHGOPescY3HoUhIWQa8Tg2Fdi9gIOWpTBF/N2', NULL, 'dima@ukr.net', 10, 'Dmitriy', 'F', '2F', '+380975436444', 'Kyiv, st. Prorizna, 44', 1577197958, 1577197958),
(13, 'Vasya', 'oQZKPTcYnsGj44i7xNppGnWnC2VTzqdO', '$2y$13$ZOMrnN04wXJgN8f5Fpk65OUxDNcKhnRrxD/KmGFmEdSiym7gBZGNm', NULL, 'vasya@ukr.net', 9, 'Vasyl', 'Ivanov', 'Sealand Ltd', '+380975456475', 'Kyiv, st. Darwina, 4', 1577200843, 1577461104),
(14, 'olya2', 'ItV8wT4dMV1crN9mYchD1Q_82DPGPS6N', '$2y$13$uGEZIOwp5hN11WAEfULEFuWy74vu.cc7zB1Z1vJQhnKyTUlGIUv8e', NULL, 'olya@ukr.net2', 10, 'Olga', 'Petrova', 'Brief Ltd', '+38097543654', 'Kyiv, st New', 1577203225, 1579707439),
(15, 'olyasadas', 'EaFiYu7EZMBSNFUnwXHq6E5Viw7BFIME', '$2y$13$6Ggjxeum9JcnO16.L/sNuO0w/W6VV36avq64UMCF9E9Xz62KyIGLy', NULL, 'vasyasdsadsda@ukr.net', 9, 'Dmitriy', 'Ss', 'Ceder', '+380976641344', 'Kyiv st', 1577552914, 1577552914),
(16, 'Dmitriy', 'ttyYL9Q3xHVyBZOYS-SmWvVz9h30Ax3X', '$2y$13$B9KxVLP8deCxKJhs72DLFe8l978aCAVRUPTrCu6FjKuvEe.tpEeVG', NULL, 'dmitriy_a@ukr.net', 9, 'Dmitriy', 'Petrov', 'Company Name', '+380976641344', 'Kyiv st', 1579447502, 1579447502),
(17, 'dima77', 'bjX8FDXv_rP7cd964x4-hqHOBwahPXRJ', '$2y$13$wgpRicQVBTjqoHo66AaGwOsomU6qMDm2VpVIYOpuicNmKU/jRzu9u', NULL, 'dmitriy@ukr.net', 10, 'Dmitriy', 'Ivanov', 'New Company', '+380976641344', 'Kyiv st. Darwina', 1579450689, 1579451487);

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
