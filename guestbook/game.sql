-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220404.3ab83d8201
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022-06-19 22:51:09
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `game`
--

-- --------------------------------------------------------

--
-- 資料表結構 `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_reply` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` int(4) NOT NULL,
  `img` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_email` tinyint(1) NOT NULL DEFAULT 1,
  `show_tel` tinyint(1) NOT NULL DEFAULT 1,
  `del` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `guestbook`
--

INSERT INTO `guestbook` (`id`, `name`, `email`, `tel`, `msg`, `admin_reply`, `serial`, `img`, `show_email`, `show_tel`, `del`, `top`, `created_time`, `updated_time`) VALUES
(3, 'mack', 'mack@gmail.com', '2132131213', 'fdsfasdfsdaf\r\ndsfafsaf', NULL, 123, 'img11.jpg', 1, 1, 0, 0, '2022-06-11 07:09:20', '2022-06-11 08:03:25'),
(12, 'john', 'mack@gmail.com', '11111111', '這是留言測試2', '管理者回覆', 1234, '', 1, 1, 0, 1, '2022-06-18 05:59:41', '2022-06-18 07:50:32'),
(16, 'fdsfsdfsad', 'sdfas@sdfasdf.com', '1232131', '111111111', NULL, 1234, '', 1, 1, 1, 0, '2022-06-19 13:48:38', '2022-06-19 13:49:17'),
(17, 'dsfasdf', 'dfas@dfsf.sfsdf', '12312313', 'gggggggggg', NULL, 1234, 'user10.jpg', 1, 1, 0, 0, '2022-06-19 14:30:57', '2022-06-19 14:41:39'),
(18, 'sasa', 'sasa@fsdafasd.com', '13123213', 'dsfasdfasdfsdfsdfsafd', NULL, 1234, '', 1, 1, 0, 0, '2022-06-19 14:45:04', '2022-06-19 14:45:04');

-- --------------------------------------------------------

--
-- 資料表結構 `match_player`
--

CREATE TABLE `match_player` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `player` int(11) NOT NULL DEFAULT 0,
  `group_tag` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `match_player`
--

INSERT INTO `match_player` (`id`, `name`, `email`, `tel`, `img`, `player`, `group_tag`) VALUES
(1, 'mack', 'mack@gmail.com', '13123', 'user6.jpg', 2, 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 'judy', 'judy@gmail.com', '13123', 'user11.jpg', 1, 'c4ca4238a0b923820dcc509a6f75849b'),
(3, 'aaaa', 'aaa@gmail.com', '3213', 'user12.jpg', 11, '6512bd43d9caa6e02c990b0a82652dca'),
(4, 'dfdsdaff', 'dsfasd@gmail.com', 'dfasdfsadf', 'user13.jpg', 10, 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 'ssss', 'sss@gmail.com', '123123123', 'user13.jpg', 7, '8f14e45fceea167a5a36dedd4bea2543'),
(6, 'gfgfdg', 'dfgasdfasf', '1231312', 'user9.jpg', 0, '0'),
(7, '123123123', 'dsfsaf', '3112312', 'user14.jpg', 5, '8f14e45fceea167a5a36dedd4bea2543'),
(8, '321313', '1231231', ' 123131', '', 9, 'c9f0f895fb98ab9159f51fd0297e236d'),
(9, 'dfsdasdf', '321312', '13213132', 'user10.jpg', 8, 'c9f0f895fb98ab9159f51fd0297e236d'),
(10, 'agdsdc', 'dfsdfc@gmail.com', '1231313', 'user7.jpg', 4, 'a87ff679a2f3e71d9181a67b7542122c'),
(11, 'Jonson', 'jonson@gmail.com', '1231313', 'user3.jpg', 3, '6512bd43d9caa6e02c990b0a82652dca');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `match_player`
--
ALTER TABLE `match_player`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `match_player`
--
ALTER TABLE `match_player`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
