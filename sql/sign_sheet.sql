-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-06-05 10:05:17
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
-- 表的结构 `sign_sheet`
--

DROP TABLE IF EXISTS `sign_sheet`;
CREATE TABLE `sign_sheet` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '性别',
  `minzu` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '民族',
  `old` tinyint(4) NOT NULL COMMENT '年龄',
  `idcard` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '身份证号',
  `birth` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '出生日期',
  `graduate` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '毕业学校',
  `cat1` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '专业类别1',
  `cat2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '专业类别2',
  `cat3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '专业类别3',
  `height` float NOT NULL COMMENT '身高',
  `weight` float NOT NULL COMMENT '体重',
  `photo` text COLLATE utf8_unicode_ci NOT NULL COMMENT '照片',
  `graduate_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '会考考号',
  `prizedetail` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '获奖情况',
  `score` float NOT NULL COMMENT '最近一次文化成绩总分11科',
  `yw` float NOT NULL COMMENT '语文',
  `sx` float NOT NULL COMMENT '数学',
  `yy` float NOT NULL COMMENT '英语',
  `wl` float NOT NULL COMMENT '物理',
  `hx` float NOT NULL COMMENT '化学',
  `sw` float NOT NULL COMMENT '生物',
  `zz` float NOT NULL COMMENT '政治',
  `dl` float NOT NULL COMMENT '地理',
  `ls` float NOT NULL COMMENT '历史',
  `sy` float NOT NULL COMMENT '实验',
  `ty` float NOT NULL COMMENT '体育',
  `parentname` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '父母姓名',
  `parentrelation` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '关系',
  `parentphone` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '联系电话',
  `payacount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paytime` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'beizhu',
  `signtime` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否审核通过',
  `verifyadmin` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verifytime` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verifymsg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '审核信息'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `sign_sheet`
--

INSERT INTO `sign_sheet` (`id`, `name`, `gender`, `minzu`, `old`, `idcard`, `birth`, `graduate`, `cat1`, `cat2`, `cat3`, `height`, `weight`, `photo`, `graduate_id`, `prizedetail`, `score`, `yw`, `sx`, `yy`, `wl`, `hx`, `sw`, `zz`, `dl`, `ls`, `sy`, `ty`, `parentname`, `parentrelation`, `parentphone`, `payacount`, `paytime`, `note`, `signtime`, `verify`, `verifyadmin`, `verifytime`, `verifymsg`) VALUES
(30, '孔智彬', '男', '1', 32, '370321198706212119', '1987-06-21', '攀枝花市实验学校', 'yy', '声乐-民族', '', 179, 60, 'upload/files/5ed0c37834e52.png', '123456789000', 'asd飞', 560, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '孔', 'dady', '135', NULL, NULL, NULL, NULL, 1, NULL, NULL, ''),
(33, '杨菲菲', '女', '13', 29, '15130319910226252X', '1991-02-26', '重庆师范大学', 'yy', '器乐', '唢呐', 161, 51, 'upload/files/5ed5a665ae88e.jpg', '123456654123', '获奖经历\r\n\r\n获得2015-2016国家励志奖学金。综合成绩排名年纪前20%，多项学业成绩排名年纪第一。\r\n\r\n湖南大学“校史校情知识竞赛”中，通过定向越野和知识竞赛的比赛形式，击败卫冕冠军，带领团队获得团队一等奖，并获得个人最佳风采奖。\r\n\r\n将《论语》学习和个人成长相结合，获得“感谢有你--岳麓书院导师制征文”一等奖，被收入《书院的教育传统与现代教育》，已出版。\r\n', 562, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '曾国英', 'mom', '18782301909', NULL, NULL, NULL, NULL, 1, NULL, NULL, ''),
(34, '江映蓉', '女', '', 22, '511234199802135462', '1998-02-13', '四川卫视跨年晚会', 'ms', NULL, '', 265, 854, 'upload/files/5ed5b684a0ab5.jpg', '15754679979', '', 9764, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '关羽模糊', 'dady', '187949499', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(35, '江映蓉', '女', '', 22, '511234199802135461', '1998-02-13', '四川卫视跨年晚会', 'ms', NULL, '', 265, 854, 'upload/files/5ed5b787b0969.jpg', '15754679979', '', 9764, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '关羽模糊', 'dady', '187949499', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(36, '渔民捕获', '男', '10', 7, '321123201212111234', '2012-12-11', '湖北武汉大学', 'ms', NULL, '', 45, 876, 'upload/files/5ed5b89017f87.jpg', '649187979', '', 46799, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '四川省', 'mom', '78794994664', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(37, '凤凰传奇', '女', '13', 31, '510824198810228225', '1988-10-22', '攀枝花第七高级中学校', 'ty', NULL, '', 171, 60, 'upload/files/5ed99a0d75483.png', '51345687245', '', 121, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '马文林', 'dady', '18782301909', '11', '2011-11-11 11:11', NULL, NULL, 0, NULL, NULL, NULL),
(38, '马文林', '女', '11', 31, '510824198810228224', '1988-10-22', '攀枝花第七高级中学校', 'ty', '女子排球', '', 171, 60, 'upload/files/5ed9f21d95e46.png', '51345687245', '', 755, 120, 120, 120, 100, 100, 100, 100, 100, 100, 30, 80, '马文林', 'dady', '18782301909', '1111', '1111-11-11 11:11', NULL, NULL, 0, NULL, NULL, NULL),
(39, '马文林1', '男', '11', 31, '510824198810228212', '1988-10-22', '攀枝花第七高级中学校', 'ty', NULL, '', 171, 60, 'upload/files/5ed9f2f44cfb2.png', '51345687245', '', 835, 120, 120, 120, 100, 200, 100, 100, 100, 100, 30, 80, '马文林', 'dady', '18782301909', '1111', '1111-11-11 11:11', NULL, '2020-06-05 15:23', 1, 'wenlife207', '2020-06-05 15:26', '未查询到缴费信息'),
(40, '测试1', '女', '20', 31, '510824198810228221', '1988-10-22', '攀枝花第七高级中学校', 'ty', '女子排球', '', 123, 21, 'upload/files/5ed9f9e0c46a6.png', '121212121212121', '', 755, 120, 120, 120, 100, 100, 100, 100, 100, 100, 30, 80, '马文林', 'dady', '18782301909', '12334', '1221-22-22 22:22', NULL, '2020-06-05 15:53', 0, NULL, NULL, NULL),
(41, '马文林', '男', '10', 31, '510824198810228119', '1988-10-22', '攀枝花第七高级中学校', 'ty', '男子排球', '', 170, 21, 'upload/files/5ed9fc94ca925.png', '123456654123', '12122121111111111111111111111111111111', 423.7, 120, 110, 0, 20, 20, 20, 122, 30, 20, 10, 90, '马文林', 'mom', '18782301909', '12334', '1212-33-22 32:32', NULL, '2020-06-05 16:04', 0, NULL, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `sign_sheet`
--
ALTER TABLE `sign_sheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sign_sheet`
--
ALTER TABLE `sign_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
