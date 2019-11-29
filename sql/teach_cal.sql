-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-11-29 02:31:13
-- 服务器版本： 10.4.6-MariaDB
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `project`
--

-- --------------------------------------------------------

--
-- 表的结构 `teach_cal`
--

CREATE TABLE `teach_cal` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `start` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `teach_cal`
--

INSERT INTO `teach_cal` (`id`, `title`, `grade`, `start`, `end`, `color`) VALUES
(1, '期末考试', '1', '2020-01-12 05:00', '2020-01-14 17:00', '#f0ad4e'),
(2, '高三语数外学考', '3', '2019-11-29 08:07', '2019-11-30 17:07', '#d9534f'),
(3, '高一第二次月考', '1', '2019-12-02 09:17', '2019-12-04 17:17', '#f0ad4e'),
(4, '高二第二次月考', '2', '2019-12-04 08:18', '2019-12-05 17:18', '#337ab7'),
(5, '高三第六次检测（二统模拟）', '3', '2019-12-20 09:22', '2019-12-21 17:22', '#d9534f'),
(6, '高三第六次检测', '3', '2019-12-06 09:25', '2019-12-07 17:25', '#d9534f'),
(7, '高二期末模拟考试', '2', '2019-12-25 09:25', '2019-12-27 17:25', '#337ab7'),
(8, '高一期末模拟考试', '1', '2019-12-25 09:26', '2019-12-07 17:26', '#f0ad4e'),
(9, '高三全市第二次统考', '3', '2020-01-05 09:26', '2020-01-06 17:26', '#d9534f'),
(10, '高二理化生史地学考', '2', '2020-01-07 09:27', '2020-01-08 17:27', '#337ab7'),
(11, '本学期结束', '4', '2020-01-17 01:27', '2020-01-17 23:27', '#d9534f'),
(12, '高一期末考试', '1', '2020-01-12 09:29', '2020-01-14 17:29', '#f0ad4e');

--
-- 转储表的索引
--

--
-- 表的索引 `teach_cal`
--
ALTER TABLE `teach_cal`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `teach_cal`
--
ALTER TABLE `teach_cal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
