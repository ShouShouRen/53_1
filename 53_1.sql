-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2023 年 03 月 11 日 06:56
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `53_1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `login_log`
--

CREATE TABLE `login_log` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `time` datetime NOT NULL,
  `status` varchar(5) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `login_log`
--

INSERT INTO `login_log` (`id`, `user`, `time`, `status`, `message`) VALUES
(1, 'admin', '2023-03-10 02:37:08', '登入成功', '使用者 admin 登入成功，時間為 2023-03-10 02:37:08'),
(2, 'admin', '2023-03-10 02:47:50', '登入成功', '使用者 admin 登入成功，時間為 2023-03-10 02:47:50'),
(3, 'admin', '2023-03-10 04:23:51', '登入成功', '使用者 admin 登入成功，時間為 2023-03-10 04:23:51');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `user`, `pw`, `user_name`, `user_id`, `role`) VALUES
(1, 'admin', '1234', '超級管理員', '0000', 0),
(2, 'coffee', '12345', 'CoffeeUser', '0001', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `login_log`
--
ALTER TABLE `login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
