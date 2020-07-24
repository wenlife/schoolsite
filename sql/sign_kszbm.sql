-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-07-24 04:10:01
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
-- 表的结构 `sign_kszbm`
--

DROP TABLE IF EXISTS `sign_kszbm`;
CREATE TABLE `sign_kszbm` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `origin_place` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `minzu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_card` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hukou_place` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hukou_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `height` float NOT NULL,
  `health` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `if_pre_educate` tinyint(4) NOT NULL,
  `if_sigle` tinyint(4) NOT NULL,
  `if_alone` tinyint(4) NOT NULL,
  `if_ls` tinyint(4) NOT NULL,
  `zk_exam_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zk_score` float NOT NULL,
  `zk_school` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `party_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `speciality` text COLLATE utf8_unicode_ci NOT NULL,
  `if_live` int(11) NOT NULL,
  `if_cload` tinyint(4) NOT NULL,
  `if_en` tinyint(4) NOT NULL,
  `if_help` tinyint(4) NOT NULL,
  `dad_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dad_nation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dad_hukou` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dad_idcard` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dad_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dad_company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dad_duty` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mom_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mom_nation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mom_hukou` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mom_idcard` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mom_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mom_company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mom_duty` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `if_uniform` tinyint(4) NOT NULL,
  `create_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify` tinyint(4) DEFAULT NULL,
  `verify_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_admin` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_msg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `sign_kszbm`
--

INSERT INTO `sign_kszbm` (`id`, `name`, `gender`, `birth_place`, `birth_date`, `origin_place`, `minzu`, `id_card`, `hukou_place`, `hukou_type`, `height`, `health`, `address`, `if_pre_educate`, `if_sigle`, `if_alone`, `if_ls`, `zk_exam_id`, `zk_score`, `zk_school`, `party_type`, `speciality`, `if_live`, `if_cload`, `if_en`, `if_help`, `dad_name`, `dad_nation`, `dad_hukou`, `dad_idcard`, `dad_phone`, `dad_company`, `dad_duty`, `mom_name`, `mom_nation`, `mom_hukou`, `mom_idcard`, `mom_phone`, `mom_company`, `mom_duty`, `if_uniform`, `create_time`, `update_time`, `verify`, `verify_time`, `verify_admin`, `verify_msg`, `note`) VALUES
(1, '马文林', '男', '四川省广元市', '1988-10-22', '四川省广元市', '1', '510824198810228113', '四川省攀枝花市仁和区', '农业', 171, '健康或良好', 'panzhihua diqigaojizhongxue', 1, 1, 1, 1, '12511552211222323', 609, '四川省苍溪县白山中学', '团员', '111', 1, 1, 1, 1, '马文林', '汉族', '四川省广元市', '151230225555552000', '18782301909', '无', '无', '马文林', '汉族', '四川省广元市', '11522552225522211', '18782301909', '无', '无', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '马文林', '女', '四川省广元市', '1988-10-22', '四川省广元市', '10', '510824198810228113', '四川省攀枝花市仁和区', '农业', 111, '健康或良好', 'panzhihua diqigaojizhongxue', 1, 1, 1, 1, '12511552211222323', 609, '四川省苍溪县白山中学', '团员', '1111', 1, 1, 1, 1, '马文林', '汉族', '四川省广元市', '151230225555552000', '18782301909', '无', '无', '马文林', '汉族', '四川省广元市', '11522552225522211', '18782301909', '无', '无', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '马文林', '男', '四川省广元市', '1988-10-22', '四川省广元市', '1', '510824198810228113', '四川省攀枝花市仁和区', '农业', 171, '健康或良好', 'panzhihua diqigaojizhongxue', 1, 1, 1, 1, '12511552211222323', 609, '四川省苍溪县白山中学', '团员', '111', 1, 1, 1, 1, '马文林', '汉族', '四川省广元市', '151230225555552000', '18782301909', '无', '无', '马文林', '汉族', '四川省广元市', '11522552225522211', '18782301909', '无', '无', 1, NULL, '2020-07-19 08:52:08', NULL, NULL, NULL, NULL, NULL),
(4, '廖扬', '男', '四川省广元市', '2003-12-25', '四川省广元市', '1', '510411200312257516', '四川省攀枝花市仁和区', '农业', 171, '健康或良好', '仁和区南岭路151号2区11栋1单元9号', 1, 0, 0, 0, '530113607', 683, '攀枝花市二十五中小学校大渡口外语校', '团员', '122323', 1, 1, 0, 0, '马文林', '2', NULL, '15030319910226252X', '18782301909', '无', '无', '马文林', '1', NULL, '510824198810228113', '18782301909', '无', '无', 0, '2020-07-20 23:00:15', '2020-07-23 20:52:18', 3, '2020-07-23 20:52', 'wenlife207', '5200', NULL),
(5, '钱忠凯', '男', '四川省广元市', '2004-05-28', '四川省广元市', '11', '513425200405287811', 'panzhihua', '农业', 171, '一般或较弱', 'panzhihua diqigaojizhongxue', 1, 0, 1, 0, '530112403', 674.8, '攀枝花市二十五中小学校阳光外语校', '非团员', '1212', 1, 0, 1, 0, '马文林', '20', NULL, '510824198810228113', '18782301909', '无', '无', '马文林', '11', NULL, '510824198810228113', '18782301909', '无', '无', 1, '2020-07-23 21:03:46', '2020-07-23 21:09:00', 3, '2020-07-23 21:09', 'wenlife207', '3500', NULL),
(6, '李珍珍', '女', '四川省广元市', '2004-08-21', '四川省广元市', '20', '510403200408212128', 'panzhihua', '农业', 171, '健康或良好', 'panzhihua diqigaojizhongxue', 0, 0, 1, 0, '530110605', 672.5, '攀枝花市二十五中小学校花城外语校', '非团员', '5225', 0, 0, 1, 1, '马文林', '1', NULL, '15030319910226252X', '18782301909', '无', '无', '马文林', '10', NULL, '510824198810228113', '18782301909', '无', '无', 0, '2020-07-23 21:12:40', '2020-07-23 21:13:11', 3, '2020-07-23 21:13', 'wenlife207', '5200', NULL),
(7, '曾心', '男', '四川省攀枝花市盐边县', '2004-08-30', '四川省攀枝花市米易县', '1', '510402200408301415', '四川省攀枝花市盐边县', '农业', 165, '健康或良好', '攀枝花市东区炳草岗街道龙江明珠C栋1单元33', 1, 0, 0, 0, '530100314', 671.8, '攀枝花市实验学校', '团员', '头发特别长', 1, 1, 0, 1, '阿布拉多邓布利多', '22', NULL, '561231198812150221', '18756321562', '攀枝花盐边县邮政局', '局长', '阿米拉多法拉克斯', '14', NULL, '156231185610132551', '14523152360', '攀枝花大河中路街道办事处', '办事员', 1, '2020-07-24 09:27:41', '2020-07-24 09:27:41', 2, NULL, NULL, NULL, NULL),
(8, '曹冬睿', '男', 'panzhihua', '2003-12-25', '四川省广元市', '10', '510402200312250916', 'panzhihua', '农业', 171, '健康或良好', 'panzhihua diqigaojizhongxue', 1, 1, 1, 1, '530109703', 671.9, '攀枝花市二十五中小学校阳光外语校', '团员', '111', 1, 1, 1, 1, '马文林', '25', NULL, '510824198810228113', '18782301909', '无', '无', '马文林', '1', NULL, '156231185610132551', '18782301909', '攀枝花大河中路街道办事处', '无', 1, '2020-07-24 09:32:04', '2020-07-24 09:32:04', 2, NULL, NULL, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `sign_kszbm`
--
ALTER TABLE `sign_kszbm`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sign_kszbm`
--
ALTER TABLE `sign_kszbm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
