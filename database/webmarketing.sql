-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2014 at 12:26 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webmarketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha_question`
--

CREATE TABLE IF NOT EXISTS `captcha_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reply` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `captcha_question`
--

INSERT INTO `captcha_question` (`id`, `question`, `reply`) VALUES
(1, '1+1 = ?', '2'),
(2, '2+2 = ?', '4');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `commissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_ref` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_product`, `quantity`, `price`, `commissions`, `ip_user`, `id_ref`, `create_date`) VALUES
(1, 0, 1, 1, 12000000, '0', '0', 0, 1394024751),
(5, 1, 1, 1, 12000000, '0', '127.0.0.1', 0, 1396338701);

-- --------------------------------------------------------

--
-- Table structure for table `cate_product`
--

CREATE TABLE IF NOT EXISTS `cate_product` (
  `id_cate` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_cate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cate_product`
--

INSERT INTO `cate_product` (`id_cate`, `name`) VALUES
(1, 'Đào tạo Marketing Online'),
(2, 'Website thông minh'),
(3, 'Tài liệu Marketing Online'),
(4, 'Triển khai Marketing Online');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('00dd7bbc2f32ac2ae53e1a80a53eab78', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1396432389, ''),
('0428cb88a7fa92c9d877f91e57142605', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1396433273, ''),
('30bb973765ecbf3ed5ef79b992f1f7ff', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1396433346, ''),
('35972068c22b6056d788ff5e4fee0d5e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1396433146, ''),
('8a922e25add0de19a13d9420156394de', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1396433316, ''),
('a6e8afe6fad34434294c627cf2b4b77e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1396432405, '');

-- --------------------------------------------------------

--
-- Table structure for table `clip_marketing`
--

CREATE TABLE IF NOT EXISTS `clip_marketing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_product` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clip_marketing`
--

INSERT INTO `clip_marketing` (`id`, `code`, `id_product`, `create_date`) VALUES
(1, 'UUW1kG6Bkzs', 1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `name`, `title`, `email`, `question`, `answer`, `status`, `create_date`) VALUES
(1, '1', 'test cái', '1', '1', '<p>Ch&uacute;ng t&ocirc;i đ&atilde; trả lời c&acirc;u hỏi n&agrave;y của c&aacute;c bạn</p>\n', 1, 123),
(2, 'abc abc', 'Tôi muốn hỏi', 'abc abc', '<p>abc abc abc abc</p>\r\n', '', 0, 1395481112);

-- --------------------------------------------------------

--
-- Table structure for table `info_company`
--

CREATE TABLE IF NOT EXISTS `info_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `info_company`
--

INSERT INTO `info_company` (`id`, `address`) VALUES
(1, 'ss');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '127.0.0.1', 'admin', '2014-04-02 03:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `mail_book`
--

CREATE TABLE IF NOT EXISTS `mail_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mail_book`
--

INSERT INTO `mail_book` (`id`, `content`) VALUES
(2, '<p>ssssssssss123</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `mail_book_customer`
--

CREATE TABLE IF NOT EXISTS `mail_book_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `title`, `content`, `type`, `create_date`) VALUES
(12, 'Gửi tin nhắn', '<p>Ch&agrave;o bạn !</p>\n\n<p>Ch&uacute;ng t&ocirc;i muốn gửi một tin nhắn đến bạn ! MOng bạn đọc kỹ tin nhắn !</p>\n', 0, 1395596098);

-- --------------------------------------------------------

--
-- Table structure for table `message_detail`
--

CREATE TABLE IF NOT EXISTS `message_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `img`, `create_date`) VALUES
(24, 'test', '<p>test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;</p>\n', 'C:\\fakepath\\ninhbinhcoop.PNG', 1395679821),
(25, 'test', '<p>test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;test&nbsp;</p>\n', '5fbc69ccf02975153cad5fbe48a4e046.PNG', 1395680459);

-- --------------------------------------------------------

--
-- Table structure for table `order_customer`
--

CREATE TABLE IF NOT EXISTS `order_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `yahoo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_ref` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `order_customer`
--

INSERT INTO `order_customer` (`id`, `full_name`, `address`, `phone`, `email`, `yahoo`, `id_ref`, `status`, `create_date`) VALUES
(6, '0', '0', '0', '0', '0', 1, 0, 1394040611),
(7, '0', '0', '0', '0', '0', 1, 1, 1394040624),
(8, '0', '0', '0', '0', '0', 1, 0, 1394040633),
(9, '0', '0', '0', '0', '0', 1, 1, 1394040639),
(10, '0', '0', '0', '0', '0', 1, 1, 1394040674),
(11, 'Nguyễn Trường Giang', 'HCM', '01667039939', 'nguyentruonggiang91@gmail.com', 'giangbeo_it', 0, 1, 1395389851),
(12, 'Giang', 'HCM', '0166', 'nguyentruonggiang91@gmail.com', '1111', 0, 1, 1395389972),
(13, 'Giang', 'HCM', '0166', 'nguyentruonggiang91@gmail.com', '1111', 1, 1, 1395390323),
(17, 'SS', 'SS', 'SS', 'SS', 'SS', 0, 0, 1395390524),
(18, 'ss', 'ss', 'ss', 'ss', '', 0, 0, 1396340870);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `commissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_ref` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_money` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_user`, `id_product`, `quantity`, `price`, `commissions`, `ip_user`, `id_ref`, `order_id`, `status_money`, `create_date`) VALUES
(6, 0, 1, 1, 12000000, '2400000', '::1', 1, 8, 1, 1394040633),
(7, 0, 1, 1, 12000000, '2400000', '::1', 1, 9, 0, 1394040639),
(8, 0, 1, 3, 12000000, '0', '::1', 0, 10, 0, 1394040674),
(9, 0, 1, 1, 12000000, '0', '127.0.0.1', 0, 11, 0, 1395389851),
(10, 0, 1, 1, 12000000, '2400000', '127.0.0.1', 1, 12, 1, 1395389972),
(11, 0, 1, 1, 12000000, '2400000', '127.0.0.1', 1, 13, 0, 1395390323),
(12, 1, 1, 1, 12000000, '0', '127.0.0.1', 0, 18, 0, 1396340870);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `exp_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comission` int(11) NOT NULL,
  `id_cate` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `title`, `description`, `content`, `exp_date`, `comission`, `id_cate`, `position`, `cost`, `img`) VALUES
(1, 'Bài học Marketing vô giá', '<p>&nbsp;</p>\n\n<p>1111</p>\n', '<p><img alt="" class="add_cart_button" id="btn_mua_content" src="http://localhost/webmarketing/template/ezwebvietnam/home/template/template_1/images/mua_1.png" /></p>\n\n<p>111</p>\n\n<p><img alt="" class="add_cart_button" id="btn_mua_content" src="http://localhost/webmarketing/template/ezwebvietnam/home/template/template_1/images/mua_1.png" style="opacity:0.9" /></p>\n', '14/2/2014', 20, 0, 0, '12000000', ''),
(5, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(6, 'ssss', '<p>sssssssssss</p>\n', '<p>ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;ssssssssssssss&nbsp;</p>\n', '28/03/2014', 10, 1, 1, '2000000', '36a04a55bc216d0ff784e2964946dfc1.jpg'),
(7, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(8, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(9, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(10, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(11, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(12, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(13, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(14, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(15, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(16, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(17, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(18, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(19, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(20, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(21, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(22, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(23, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(24, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(25, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(26, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(27, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(28, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(29, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(30, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(31, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(32, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(33, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(34, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(35, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', ''),
(36, 'ssss ', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '<p>&nbsp;sss tets ch&uacute;ng t&ocirc;i test</p>\r\n', '29/3/2014', 10, 2, 1, '1000000', '');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `provinceid` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`provinceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`provinceid`, `name`, `type`) VALUES
('01', 'Hà Nội', 'Thành Phố'),
('02', 'Hà Giang', 'Tỉnh'),
('04', 'Cao Bằng', 'Tỉnh'),
('06', 'Bắc Kạn', 'Tỉnh'),
('08', 'Tuyên Quang', 'Tỉnh'),
('10', 'Lào Cai', 'Tỉnh'),
('11', 'Điện Biên', 'Tỉnh'),
('12', 'Lai Châu', 'Tỉnh'),
('14', 'Sơn La', 'Tỉnh'),
('15', 'Yên Bái', 'Tỉnh'),
('17', 'Hòa Bình', 'Tỉnh'),
('19', 'Thái Nguyên', 'Tỉnh'),
('20', 'Lạng Sơn', 'Tỉnh'),
('22', 'Quảng Ninh', 'Tỉnh'),
('24', 'Bắc Giang', 'Tỉnh'),
('25', 'Phú Thọ', 'Tỉnh'),
('26', 'Vĩnh Phúc', 'Tỉnh'),
('27', 'Bắc Ninh', 'Tỉnh'),
('30', 'Hải Dương', 'Tỉnh'),
('31', 'Hải Phòng', 'Thành Phố'),
('33', 'Hưng Yên', 'Tỉnh'),
('34', 'Thái Bình', 'Tỉnh'),
('35', 'Hà Nam', 'Tỉnh'),
('36', 'Nam Định', 'Tỉnh'),
('37', 'Ninh Bình', 'Tỉnh'),
('38', 'Thanh Hóa', 'Tỉnh'),
('40', 'Nghệ An', 'Tỉnh'),
('42', 'Hà Tĩnh', 'Tỉnh'),
('44', 'Quảng Bình', 'Tỉnh'),
('45', 'Quảng Trị', 'Tỉnh'),
('46', 'Thừa Thiên Huế', 'Tỉnh'),
('48', 'Đà Nẵng', 'Thành Phố'),
('49', 'Quảng Nam', 'Tỉnh'),
('51', 'Quảng Ngãi', 'Tỉnh'),
('52', 'Bình Định', 'Tỉnh'),
('54', 'Phú Yên', 'Tỉnh'),
('56', 'Khánh Hòa', 'Tỉnh'),
('58', 'Ninh Thuận', 'Tỉnh'),
('60', 'Bình Thuận', 'Tỉnh'),
('62', 'Kon Tum', 'Tỉnh'),
('64', 'Gia Lai', 'Tỉnh'),
('66', 'Đắk Lắk', 'Tỉnh'),
('67', 'Đắk Nông', 'Tỉnh'),
('68', 'Lâm Đồng', 'Tỉnh'),
('70', 'Bình Phước', 'Tỉnh'),
('72', 'Tây Ninh', 'Tỉnh'),
('74', 'Bình Dương', 'Tỉnh'),
('75', 'Đồng Nai', 'Tỉnh'),
('77', 'Bà Rịa - Vũng Tàu', 'Tỉnh'),
('79', 'Hồ Chí Minh', 'Thành Phố'),
('80', 'Long An', 'Tỉnh'),
('82', 'Tiền Giang', 'Tỉnh'),
('83', 'Bến Tre', 'Tỉnh'),
('84', 'Trà Vinh', 'Tỉnh'),
('86', 'Vĩnh Long', 'Tỉnh'),
('87', 'Đồng Tháp', 'Tỉnh'),
('89', 'An Giang', 'Tỉnh'),
('91', 'Kiên Giang', 'Tỉnh'),
('92', 'Cần Thơ', 'Thành Phố'),
('93', 'Hậu Giang', 'Tỉnh'),
('94', 'Sóc Trăng', 'Tỉnh'),
('95', 'Bạc Liêu', 'Tỉnh'),
('96', 'Cà Mau', 'Tỉnh');

-- --------------------------------------------------------

--
-- Table structure for table `sale_off`
--

CREATE TABLE IF NOT EXISTS `sale_off` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exp_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sale_off`
--

INSERT INTO `sale_off` (`id`, `id_product`, `percent`, `img`, `exp_date`) VALUES
(1, 1, 10, '1111', '2014-03-29 00:00:00'),
(2, 5, 11, '122', '2014-03-29 00:00:00'),
(3, 1, 20, '', '2014-04-02 00:00:00'),
(4, 1, 10, '', '2014-04-03 00:00:00'),
(5, 5, 11, '', '2014-04-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `yahoo` varchar(255) COLLATE utf8_bin NOT NULL,
  `skype` varchar(255) COLLATE utf8_bin NOT NULL,
  `bank` varchar(255) COLLATE utf8_bin NOT NULL,
  `stk` varchar(255) COLLATE utf8_bin NOT NULL,
  `sex` int(11) NOT NULL,
  `province` int(11) NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `birthday` varchar(255) COLLATE utf8_bin NOT NULL,
  `img` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '3',
  `login_id` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total_like` int(11) NOT NULL,
  `account_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `phone`, `address`, `password`, `email`, `activated`, `yahoo`, `skype`, `bank`, `stk`, `sex`, `province`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `birthday`, `img`, `role`, `login_id`, `total_like`, `account_type`) VALUES
(1, 'giangbeo', 'Nguyễn Trường Giang', '01667039939', 'HCM', '$2a$08$av0xeUt7pYqEymtq0ENPN.65FaINVis/64LmuohuAdt8ND8exqVs2', 'nguyentruonggiang91@gmail.com', 1, '', '', '', '', 0, 79, 0, NULL, NULL, NULL, NULL, 'ad9147af77ea0a71cb1045eb8c144048', '127.0.0.1', '2014-04-02 05:52:29', '2014-03-21 08:25:47', '2014-04-02 03:52:29', '', '', 1, '', 0, 0),
(2, 'BeoBeBoi', 'Nguyên Trường Giang', '01667039939', 'HCM', '$2a$08$av0xeUt7pYqEymtq0ENPN.65FaINVis/64LmuohuAdt8ND8exqVs2', 'beobeboi91@gmail.com', 0, 's', 's', 'Vietcombank', '0341005245193', 0, 1, 0, NULL, NULL, NULL, NULL, 'ab37717509a2f5b5e6c4335e8e960710', '::1', '0000-00-00 00:00:00', '2014-03-27 16:59:43', '2014-03-28 04:13:34', '2014/03/05', '', 4, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE IF NOT EXISTS `user_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user_product`
--

INSERT INTO `user_product` (`id`, `id_user`, `id_product`, `create_date`) VALUES
(13, 1, 1, 1395600943),
(14, 1, 6, 1395770910),
(15, 1, 5, 1395770917);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_staff` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`, `is_staff`) VALUES
(1, 'Administrator', 1),
(2, 'Staff', 1),
(3, 'Member', 0),
(4, 'Volunteer', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
