-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 11 2025 г., 09:48
-- Версия сервера: 5.6.51
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `college`
--

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `name_image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id_image`, `name_image`, `id_student`) VALUES
(1, 'uploads_images/32-394.jpg', 32),
(2, 'uploads_images/32-335.jpg', 32),
(3, 'uploads_images/32-139.jpg', 32),
(4, 'uploads_images/33-255.jpg', 33),
(5, 'uploads_images/33-347.jpg', 33),
(6, 'uploads_images/33-208.jpg', 33),
(7, 'uploads_images/38-106.jpg', 38),
(8, '../uploads_images/39-374.jpg', 39),
(9, '../uploads_images/40-453.jpg', 40),
(10, '../uploads_images/41-183.jpg', 41),
(11, '../uploads_images/42-442.jpg', 42);

-- --------------------------------------------------------

--
-- Структура таблицы `old_student`
--

CREATE TABLE `old_student` (
  `operation_id` int(11) NOT NULL,
  `operation_name` varchar(127) DEFAULT NULL,
  `operation_date` date DEFAULT NULL,
  `s_id` int(5) NOT NULL,
  `s_pr` varchar(30) NOT NULL,
  `s_im` varchar(20) NOT NULL,
  `s_bat` varchar(20) NOT NULL,
  `s_stat` varchar(7) NOT NULL,
  `s_galuz` varchar(50) NOT NULL,
  `s_spec` varchar(60) NOT NULL,
  `s_specz` varchar(90) NOT NULL,
  `s_group` varchar(8) NOT NULL,
  `s_form_navch` varchar(10) NOT NULL,
  `s_vip` varchar(4) NOT NULL DEFAULT 'Ні',
  `s_cours` int(1) NOT NULL,
  `s_contract` varchar(3) NOT NULL,
  `s_dnar` date NOT NULL,
  `s_vik` varchar(2) NOT NULL,
  `s_adresa` varchar(80) NOT NULL,
  `s_tels` varchar(16) NOT NULL,
  `s_telb` varchar(16) NOT NULL,
  `s_telm` varchar(16) NOT NULL,
  `s_osvita_type` varchar(40) NOT NULL,
  `s_rik_zaver` int(4) NOT NULL,
  `s_region_type` varchar(20) NOT NULL,
  `s_region` varchar(20) NOT NULL,
  `s_sirota` varchar(3) DEFAULT 'Ні',
  `s_peresel` varchar(3) DEFAULT 'Ні',
  `s_chernob` varchar(3) DEFAULT 'Ні',
  `s_inval` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_malozab` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_ato` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_war_act` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_ditzag` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_rada` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_shahter` varchar(3) NOT NULL DEFAULT 'Ні',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `old_student`
--


-- Структура таблицы `old_st_group`
--

CREATE TABLE `old_st_group` (
  `operation_id` int(11) NOT NULL,
  `operation_name` varchar(63) NOT NULL,
  `operation_date` date NOT NULL,
  `g_vipusc` varchar(3) NOT NULL,
  `g_im` varchar(7) NOT NULL,
  `g_galuz` varchar(50) NOT NULL,
  `g_spec` varchar(80) NOT NULL,
  `g_specz` varchar(80) NOT NULL,
  `g_course` varchar(1) NOT NULL,
  `g_count_stud` int(2) NOT NULL,
  `g_count_derg` int(2) NOT NULL,
  `g_count_comerc` int(2) NOT NULL,
  `g_nastav` varchar(20) NOT NULL,
  `g_formnavch` varchar(10) NOT NULL DEFAULT 'Денна',
  `g_id_sp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `old_st_group`
--
-- --------------------------------------------------------

--
-- Структура таблицы `spec`
--

CREATE TABLE `spec` (
  `id_sp` varchar(3) NOT NULL,
  `id_galuz` varchar(10) NOT NULL,
  `im_galuz` varchar(50) NOT NULL,
  `id_spec` varchar(10) NOT NULL,
  `im_spec` varchar(50) NOT NULL,
  `im_specializ` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `spec`
--

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `s_id` int(5) NOT NULL,
  `s_pr` varchar(30) NOT NULL,
  `s_im` varchar(20) NOT NULL,
  `s_bat` varchar(20) NOT NULL,
  `s_stat` varchar(7) NOT NULL,
  `s_galuz` varchar(50) NOT NULL,
  `s_spec` varchar(60) NOT NULL,
  `s_specz` varchar(90) NOT NULL,
  `s_group` varchar(8) NOT NULL,
  `s_form_navch` varchar(10) NOT NULL,
  `s_vip` varchar(4) NOT NULL DEFAULT 'Ні',
  `s_cours` int(1) NOT NULL,
  `s_contract` varchar(3) NOT NULL,
  `s_dnar` date NOT NULL,
  `s_vik` varchar(2) NOT NULL,
  `s_adresa` varchar(80) NOT NULL,
  `s_tels` varchar(16) NOT NULL,
  `s_telb` varchar(16) NOT NULL,
  `s_telm` varchar(16) NOT NULL,
  `s_osvita_type` varchar(40) NOT NULL,
  `s_rik_zaver` int(4) NOT NULL,
  `s_region_type` varchar(20) NOT NULL,
  `s_region` varchar(20) NOT NULL,
  `s_sirota` varchar(3) DEFAULT 'Ні',
  `s_peresel` varchar(3) DEFAULT 'Ні',
  `s_chernob` varchar(3) DEFAULT 'Ні',
  `s_inval` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_malozab` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_ato` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_war_act` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_ditzag` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_rada` varchar(3) NOT NULL DEFAULT 'Ні',
  `s_shahter` varchar(3) NOT NULL DEFAULT 'Ні',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `student`
--
-- --------------------------------------------------------

--
-- Структура таблицы `st_group`
--

CREATE TABLE `st_group` (
  `g_vipusc` varchar(3) NOT NULL,
  `g_im` varchar(8) NOT NULL,
  `g_galuz` varchar(50) NOT NULL,
  `g_spec` varchar(80) NOT NULL,
  `g_specz` varchar(80) NOT NULL,
  `g_course` varchar(1) NOT NULL,
  `g_count_stud` int(2) NOT NULL,
  `g_count_derg` int(2) NOT NULL,
  `g_count_comerc` int(2) NOT NULL,
  `g_nastav` varchar(20) NOT NULL,
  `g_formnavch` varchar(10) NOT NULL DEFAULT 'Денна',
  `g_id_sp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `st_group`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
