-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-06-08 04:13:54
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
-- 表的结构 `sys_nation`
--

DROP TABLE IF EXISTS `sys_nation`;
CREATE TABLE `sys_nation` (
  `id` varchar(32) NOT NULL,
  `nation` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_nation`
--

INSERT INTO `sys_nation` (`id`, `nation`) VALUES
('1', '汉族'),
('10', '朝鲜族'),
('11', '满族'),
('12', '侗族'),
('13', '瑶族'),
('14', '白族'),
('15', '土家族'),
('16', '哈尼族'),
('17', '哈萨克族'),
('18', '傣族'),
('19', '黎族'),
('2', '蒙古族'),
('20', '傈僳族'),
('21', '佤族'),
('22', '畲族'),
('23', '高山族'),
('24', '拉祜族'),
('25', '水族'),
('26', '东乡族'),
('27', '纳西族'),
('28', '景颇族'),
('29', '柯尔克孜族'),
('3', '回族'),
('30', '土族'),
('31', '达翰尔族'),
('32', '么佬族'),
('33', '羌族'),
('34', '布朗族'),
('35', '撒拉族'),
('36', '毛南族'),
('37', '仡佬族'),
('38', '锡伯族'),
('39', '阿昌族'),
('4', '藏族'),
('40', '普米族'),
('41', '塔吉克族'),
('42', '怒族'),
('43', '乌孜别克族'),
('44', '俄罗斯族'),
('45', '鄂温克族'),
('46', '德昂族'),
('47', '保安族'),
('48', '裕固族'),
('49', '京族'),
('5', '维吾尔族'),
('50', '塔塔尔族'),
('51', '独龙族'),
('52', '鄂伦春族'),
('53', '赫哲族'),
('54', '门巴族'),
('55', '珞巴族'),
('56', '基诺族'),
('6', '苗族'),
('7', '彝族'),
('8', '壮族'),
('9', '布依族');

--
-- 转储表的索引
--

--
-- 表的索引 `sys_nation`
--
ALTER TABLE `sys_nation`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
