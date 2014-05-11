-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2014 at 11:07 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saigonfutsal`
--
CREATE DATABASE IF NOT EXISTS `saigonfutsal` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `saigonfutsal`;

-- --------------------------------------------------------

--
-- Table structure for table `cate_new`
--

CREATE TABLE IF NOT EXISTS `cate_new` (
  `id_catenew` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id_catenew`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cate_new`
--

INSERT INTO `cate_new` (`id_catenew`, `title`, `parent`) VALUES
(1, 'Tin trong nước', 0),
(2, 'Tin quốc tế', 0),
(3, 'Bóng đá & Cuộc sống', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('c069eaa323f68bc91eb6335aa3cc263b', '::1', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36', 1399187516, '');

-- --------------------------------------------------------

--
-- Table structure for table `clips`
--

CREATE TABLE IF NOT EXISTS `clips` (
  `id_clip` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id_clip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clips`
--

INSERT INTO `clips` (`id_clip`, `title`, `code`, `create_date`) VALUES
(1, 'GIAO HỮU: FUST vs YEAH1TV (04.04.2014)', 'cEqNtqIilhg', 0),
(2, 'TẬP LUYỆN CHO TRẬN GIAO HỮU VỚI YEAH1TV', 'OeMi49fqJA8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_new` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_famous` int(11) NOT NULL,
  `id_cate` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id_new`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_new`, `title`, `content`, `image`, `is_famous`, `id_cate`, `id_user`, `view`, `create_date`) VALUES
(1, 'Futsal Viet Nam  10 - 4 Tajikistan', 'Futsal Viet Nam  10 - 4 Tajikistan', 'cdvsg.jpg', 1, 1, 0, 220, 0),
(2, 'HLV ĐT futsal Việt Nam tin các học trò sẽ đánh bại ĐT Kuwait', 'Một chiến thắng trước ĐT Kuwait vào chiều 4/5 sẽ giúp cho ĐT Việt Nam giành vé vào tứ kết. Trước trận đấu, HLV trưởng ĐT futsal Việt Nam - Bruno Garcia Formoso tin tưởng các học trò của ông đủ khả năng để đánh bại đối thủ.\r\n“Tôi hoàn toàn hài lòng về màn trình diễn của các học trò trong trận đại thắng ĐT Tajikistan. Họ đã chơi như mong đợi của BHL ĐT Việt Nam. Sức ép cũng đã được giải tỏa sau chiến thắng đó”, HLV Bruno Garcia Formoso cho biết trong cuộc trao đổi với phóng viên BONGDAPLUS.VN. Rõ ràng, sau chiến thắng trước ĐT Tajikistan, các cầu thủ ĐT Việt Nam tỏ ra rất hưng phấn và tự tin trước cuộc đối đầu với ĐT Kuwait.\r\n\r\nTheo điều lệ thì nếu 2 đội trở lên bằng điểm nhau, chỉ số được xét đến đầu tiên là kết quả đối đầu trực tiếp. Vì thế, chỉ cần đánh bại ĐT Kuwait với bất cứ tỷ số nào, ĐT Việt Nam sẽ giành quyền góp mặt ở tứ kết, bất chấp kết quả của trận còn lại giữa ĐT Tajikistan và ĐT Iraq. \r\n\r\nPhải thừa nhận rằng, ĐT Kuwait là đối thủ rất mạnh. Bằng chứng là đoàn quân của ông Fonseca đã giành cả 2 trận thắng sau 2 trận ra quân. HLV trưởng ĐT Việt Nam - Bruno Garcia Formoso cũng thừa nhận rằng ĐT Kuwait là đối thủ không dễ để đánh bại. Tuy nhiên, chiến lược gia người Tây  Ban Nha tin tưởng các học trò của ông có thể làm nên một cuộc lật đổ.\r\n\r\n\r\n... các học trò sẽ có được niềm vui chiến thắng trước ĐT Kuwait. Ảnh: Anh Tài \r\n\r\n“Kuwait là đối thủ mạnh, lực lượng đồng đều và chơi rất hiệu quả. Họ đặc biệt nguy hiểm ở các tình huống cố định. Có 4 bàn thắng trong trận thắng 5-3 trước ĐT Iraq đến từ những đá phạt góc hay đá phạt trực tiếp. Đây là điều mà các cầu thủ của chúng ta cần lưu ý”, HLV Bruno Garcia Formoso nhận định. Nhưng vị thuyền trưởng ĐT Việt Nam cũng cho rằng, sức ép tâm lý khi phải giành ngôi đầu và tiến sâu vào vòng trong sẽ là lực cản lớn đối với ĐT Kuwait.\r\n\r\n“Chúng ta chỉ có một con đường là thắng mới chắc suất ở tứ kết. Tôi hoàn toàn tin tưởng ở các học trò của mình”, HLV trưởng ĐT Việt Nam khép lại câu chuyện. ', 'dtvn.jpg', 0, 1, 0, 0, 0),
(3, 'Tuyển futsal Việt Nam lột xác trong trận thắng Tajikistan 10-4', 'Trong trận đấu thứ 2 tại vòng chung kết futsal châu Á 2014 vừa kết thúc tối nay, đội tuyển Việt Nam (VN) đã có chiến thắng đậm với tỷ số 10-4 trước Tajikistan.\r\nĐúng như lời hứa của HLV Bruno Formoso, đội tuyển VN đã chơi hay, nhanh, mạnh mẽ và dứt điểm hiệu quả hơn trong trận đấu với Tajikistan.\r\n\r\nBiết được khả năng chơi tấn công của đội tuyển VN, Tajikistan đã chủ động phòng ngự ngay từ đầu trận. Thế nhưng, những pha tấn công đa dạng của chủ nhà khiến cho thế phòng ngự của Tajikistan sớm bị phá sản.\r\n\r\nNgay phút thứ 10, từ pha tấn công nhanh, Văn Vũ đã xuất sắc ghi bàn mở tỷ số cho VN. Sau bàn thua, Tajikistan nhanh chóng có bàn gỡ hòa ở phút 11 do công Makhmudov.\r\n\r\nBàn thắng của Makhmudov không thể giúp nhiều cho Tajikistan, bởi ngay sau đó VN tấn công dồn dập để liên tiếp ghi bàn để giành chiến thắng chung cuộc với tỷ số 10-4.\r\n\r\n\r\nCác chàng trai Việt Nam (áo trắng) đã trút cơn mưa bàn thắng vào lưới Tajikistan - Ảnh: Độc Lập\r\n\r\nCác cầu thủ ghi bàn cho VN là Trọng Luân ( phút 12, 26), Ngọc Sơn (13, 27), Đức Nam (15), Đức Hòa (16), Bảo Quân (25, 33), Khánh Hưng (37).\r\n\r\nCác bàn thắng còn lại của Tajikistan do:  Madedbabaev, Jumaev, Mahmudov ghi.\r\n\r\nỞ trận đấu còn lại bảng A, Kuwait thắng Iraq 5-3. Như vậy, ở trận đấu cuối vòng bảng vào ngày 4.5, nếu Iraq thắng Tajikistan, đội tuyển VN cần phải thắng Kuwait mới giành quyền đi tiếp.\r\n\r\nPhát biểu sau trận đấu, HLV Bruno nói: “Kuwait đã có ưu thế sau hai trận thắng, cầu thủ của họ chơi rất tốt, nhưng chúng tôi sẽ nỗ lực để tự tìm cơ hội cho mình”.\r\n\r\nCác trận đấu bảng B diễn ra cùng ngày: Iran thắng Trung Quốc 12-0, Úc thắng Indonesia 5-0.\r\n\r\nNgày mai sẽ diễn ra các trận: Malaysia gặp Li-băng, Hàn Quốc gặp Kyrgyzstan, Đài Loan gặp Thái Lan và Uzbekistan gặp Nhật Bản.', 'DLA_9052.jpg', 0, 1, 0, 0, 0),
(4, 'Giải bóng đá Futsal vô địch châu Á 2014: Tuyển Việt Nam đã biết thắng', 'Chiều tối ngày 2.5, tại nhà thi đấu Phú Thọ-TPHCM lượt trận thứ 2 của bảng A tiếp tục giữa chủ nhà Việt Nam tiếp đối thủ đến từ vùng Trung Á là Tajikistan. Sau trận thua đầu tiên trước đối thủ Tây Á là Iraq, tuyển Việt Nam như tự đẩy mình vào thế khó khi trận thứ 2 buộc phải thắng nếu không muốn nói lời chia tay sớm ngay trên sân nhà. Chính tình thế này vô tình đã tạo áp lực không nhỏ cho thầy trò ông HLV Bruno trước sự cổ vũ cuồng nhiệt của khán giả nhà. \r\n\r\nNếu Iraq là đối thủ ngang tầm, thậm chí còn bị đánh giá là thấp nhất bảng và tuyển Việt Nam đã bất ngờ để thua ở những phút cuối cùng của trận đấu. Bước vào trận thứ 2, trận quyết định chuyện đi hay ở cho tuyển Việt Nam đang được kỳ vọng về sự tiến bộ trong chuyên môn trong thời gian qua, nhất là sau chuyến đi tập huấn tại Tây Ban Nha.\r\n\r\nGặp đối thủ bị liệt vào danh sách yếu nhất giải là Tajikistan và chỉ có cửa phải thắng nếu muốn vào từ kết nên trong cuộc đối đầu này tuyển Việt Nam đã như quên hẳn trận thua đầu tiên để tập trung cho trận quyết định thứ 2 và ông HLV Bruno đã tung ngay đội hình mạnh nhất để kiếm trận thắng đầu tiên.\r\n\r\nCác học trò của ông đã không làm phụ lòng thầy bằng một lối đá rất hiệu quả cả khi thủ, lúc lên công khá nhịp nhàng. Ngay trong hiệp 1, tuyển Việt Nam đã có tới 6 lần buộc thủ môn đối phương phải vào lưới nhặt bóng và tuyển Việt Nam cũng 2 lần để thủng lưới một cách đáng tiếc.\r\n\r\nHiệp 2 là hiệp đấu mà thế trận hoàn toàn thuộc về đội chủ nhà Việt Nam và hiệp này chủ nhà đã có thêm 4 bàn thắng, nhưng cũng để đối thủ chọc thủng lưới 2 lần đề cuối cùng. \r\n\r\nSau 40 phút, tuyển futsal Việt Nam cũng tìm được trận thắng đầu tiên với tỷ số chung cuộc là 10/4 và kết quả này giúp Việt Nam có cơ hội vào tứ kết trong lượt trận thứ 3 trước đối thủ nặng ký đến từ Tây Á là Kuwait.\r\n\r\nTrận này, tuyển Việt Nam cũng buộc phải thắng, một nhiệm vụ không dễ dàng gì cho thầy-trò ông HLV Bruno, nhưng không phải là không thể làm được. \r\n\r\nTrận đấu quyết định này diễn ra vào tối ngày 4.5 cũng tại nhà thi đấu Phú Thọ-TPHCM', 'Laodong_FutsalVietNam_YACB.jpg', 0, 1, 0, 0, 0),
(5, 'Futsal Viet Nam  10 - 4 Tajikistan', 'Futsal Viet Nam  10 - 4 Tajikistan', 'cdvsg.jpg', 1, 1, 0, 222, 0),
(6, 'Futsal Viet Nam  10 - 4 Tajikistan', 'Futsal Viet Nam  10 - 4 Tajikistan', 'cdvsg.jpg', 1, 1, 0, 0, 0),
(7, 'Futsal Viet Nam  10 - 4 Tajikistan', 'Futsal Viet Nam  10 - 4 Tajikistan', 'cdvsg.jpg', 1, 1, 0, 0, 0),
(8, 'Van Gaal triệu tập 20 cầu thủ chuẩn bị World Cup', 'HLV tuyển Hà Lan, Louis van Gaal bắt đầu chiến dịch World Cup 2014 bằng cách triệu tập 20 cầu thủ lên trại huấn luyện quốc gia.\r\nDo các giải VĐQG Hà Lan, Eredivisie đã kết thúc, sớm hơn các giải VĐQG hàng đầu ở châu Âu, nên Van Gaal tận dụng thời gian triệu tập và đánh giá các tài năng trong nước.\r\n\r\n\r\nVan Gaal bắt đầu tuyển chọn cầu thủ dự World Cup\r\nDanh sách 20 cầu thủ được triệu tập lần này đến phần lớn từ Ajax (đội vô địch) và các đội bóng tên tuổi khác của Hà Lan như Feyenoord, PSV và Twente.\r\n\r\nBên cạnh sự vắng mặt của các ngôi sao hàng đầu như Robben hay Van Persie, lần triệu tập này cũng không có sự góp mặt của các cầu thủ AZ, Heerenveen, Vitesse và Groningen, những đội đang phải đá play-off tranh vé dự Europa League.\r\n\r\nDự kiến, ngày 13/5 tới, Van Gaal sẽ công bố danh sách sơ bổ của tuyển Hà Lan dự World Cup 2014. Cơ hội góp mặt của các cầu thủ được triệu tập sớm phụ thuộc rất nhiều vào những gì họ sẽ thể hiện trong một tuần ăn tập cùng nhau sắp tới.\r\n\r\nDanh sách cụ thể\r\n\r\nThủ môn: Jasper Cillessen (Ajax), Kenneth Vermeer (Ajax), Jeroen Zoet (PSV)\r\n\r\nHậu vệ: Daley Blind (Ajax), Daryl Janmaat (Feyenoord), Terence Kongolo (Feyenoord), Bruno Martins Indi (Feyenoord), Karim Rekik (PSV), Joel Veltman (Ajax), Stefan de Vrij (Feyenoord).\r\n\r\nTiền vệ: Jean-Paul Boetius (Feyenoord), Jordy Clasie (Feyenoord), Davy Klaassen (Ajax), Tonny Vilhena (Feyenoord), Georginio Wijnaldum (PSV).\r\n\r\nTiền đạo: Luc Castaignos (Twente), Memphis Depay (PSV), Jurgen Locadia (PSV), Luciano Narsingh (PSV), Quincy Promes (Twente).', 'VanGaal.jpg', 0, 2, 0, 0, 0),
(9, 'Cách mạng tại Barca và M.U: Khi Fabregas là nhân vật chính', 'Trong mùa Hè năm nay, nhiều khả năng sẽ có bom tấn xảy ra, mà nhân vật chính sẽ là Cesc Fabregas.\r\nSau một mùa giải đáng thất vọng, với cả tinh thần lẫn phong độ, chắc chắn Barca sẽ cải tổ đội hình vào mùa Hè năm nay. M.U cũng vậy, cũng sẽ có những thay đổi toàn bộ, và có thể Fabregas sẽ là điểm nhấn trong hai cuộc cách mạng này. Rời Arsenal đến Barca, đội bóng mà tiền vệ người Tây Ban Nha dành tình cảm rất nhiều. Tuy nhiên, nhìn vào tình hình hiện tại, có rất nhiều lý do để Fabregas rời khỏi Nou Camp.\r\n\r\n\r\nFabregas sẽ đến M.U? Ảnh: Internet.\r\nVai trò của cựu tiền vệ Arsenal trong đội hình Barca hiện giờ như là một mảnh vá chiến thuật, anh không được dùng nhiều đúng với khả năng của mình. Thậm chí trong lần ra sân gặp Bilbao mới đây, các CĐV đã lo ó khi Fabregas vào sân thay Xavi.\r\n\r\nDù đã đứng ra bảo vệ cậu học trò, nhưng sau đó Tata Martino một lần nữa buộc Fabregas trên băng ghế dự bị trong trận làm khách ở El Madrigal. Và trong trận gặp Getafe, cảnh tượng tương tự lại diễn ra với anh, có thể thấy, Fabregas cũng không còn được cơ hội để thể hiện mình.\r\n\r\nTrong trận đấu này, tiền vệ người Tây Ban Nha chỉ được vào sân khi Barca gặp bế tắc. Và cũng chính anh đã làm được điều mà các CĐV mong đợi khi châm ngòi trong bàn thắng của Sanchez.\r\n\r\nĐang ở vào độ chín của sự nghiệp, rõ ràng Fabregas cần được thi đấu và thể hiện mình nhiều hơn. Nhưng tại Barca, anh khó có thể cạnh tranh được với những Xavi hay Iniesta. Tuy nhiên, nếu anh đến M.U, mọi chuyện ắt hẳn sẽ khác, bởi môi trường Premier League không phải là nơi xa lạ với anh, đồng thời viễn cảnh trở thành nhạc trưởng của Quỷ đỏ sẽ là một khởi đầu mới thật tươi sáng với Fabregas.', '1Fabregas.jpg', 0, 2, 0, 0, 0),
(10, 'Cận cảnh những hot girl trên sân futsal', 'Cổ vũ hết mình khi đội tuyển thi đấu, các cổ động viên xinh đẹp đã góp thêm sức mạnh giúp tuyển futsal Việt Nam làm nên lịch sử khi lần đầu giành quyền vào tứ kết giải vô địch châu Á.\r\nTrong những ngày qua, các khán đài nhà thi đấu Phú Thọ (TP.HCM) luôn được nhuộm đỏ bởi màu áo của CĐV mỗi khi đội tuyển futsal Việt Nam thi đấu. Sự cổ vũ không biết mệt mỏi của họ đã trở thành động lực giúp đội tuyển thi đấu thành công tại giải vô địch futsal châu Á.\r\n', '953677e62cd186.jpg', 0, 3, 0, 222, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id_team` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id_team`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id_team`, `name`, `about`, `logo`, `cover`, `create_date`) VALUES
(1, 'FUST-Futsal Saigon United', 'sss', 'fust_logo.png', '10256383_1418461401749374_2157980116406398285_n.jpg', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
