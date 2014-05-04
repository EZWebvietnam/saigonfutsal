-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2014 at 08:34 AM
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
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id_new`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_new`, `title`, `content`, `image`, `is_famous`, `create_date`) VALUES
(1, 'Futsal Viet Nam  10 - 4 Tajikistan', 'Futsal Viet Nam  10 - 4 Tajikistan', 'cdvsg.jpg', 1, 0),
(2, 'HLV ĐT futsal Việt Nam tin các học trò sẽ đánh bại ĐT Kuwait', 'Một chiến thắng trước ĐT Kuwait vào chiều 4/5 sẽ giúp cho ĐT Việt Nam giành vé vào tứ kết. Trước trận đấu, HLV trưởng ĐT futsal Việt Nam - Bruno Garcia Formoso tin tưởng các học trò của ông đủ khả năng để đánh bại đối thủ.\r\n“Tôi hoàn toàn hài lòng về màn trình diễn của các học trò trong trận đại thắng ĐT Tajikistan. Họ đã chơi như mong đợi của BHL ĐT Việt Nam. Sức ép cũng đã được giải tỏa sau chiến thắng đó”, HLV Bruno Garcia Formoso cho biết trong cuộc trao đổi với phóng viên BONGDAPLUS.VN. Rõ ràng, sau chiến thắng trước ĐT Tajikistan, các cầu thủ ĐT Việt Nam tỏ ra rất hưng phấn và tự tin trước cuộc đối đầu với ĐT Kuwait.\r\n\r\nTheo điều lệ thì nếu 2 đội trở lên bằng điểm nhau, chỉ số được xét đến đầu tiên là kết quả đối đầu trực tiếp. Vì thế, chỉ cần đánh bại ĐT Kuwait với bất cứ tỷ số nào, ĐT Việt Nam sẽ giành quyền góp mặt ở tứ kết, bất chấp kết quả của trận còn lại giữa ĐT Tajikistan và ĐT Iraq. \r\n\r\nPhải thừa nhận rằng, ĐT Kuwait là đối thủ rất mạnh. Bằng chứng là đoàn quân của ông Fonseca đã giành cả 2 trận thắng sau 2 trận ra quân. HLV trưởng ĐT Việt Nam - Bruno Garcia Formoso cũng thừa nhận rằng ĐT Kuwait là đối thủ không dễ để đánh bại. Tuy nhiên, chiến lược gia người Tây  Ban Nha tin tưởng các học trò của ông có thể làm nên một cuộc lật đổ.\r\n\r\n\r\n... các học trò sẽ có được niềm vui chiến thắng trước ĐT Kuwait. Ảnh: Anh Tài \r\n\r\n“Kuwait là đối thủ mạnh, lực lượng đồng đều và chơi rất hiệu quả. Họ đặc biệt nguy hiểm ở các tình huống cố định. Có 4 bàn thắng trong trận thắng 5-3 trước ĐT Iraq đến từ những đá phạt góc hay đá phạt trực tiếp. Đây là điều mà các cầu thủ của chúng ta cần lưu ý”, HLV Bruno Garcia Formoso nhận định. Nhưng vị thuyền trưởng ĐT Việt Nam cũng cho rằng, sức ép tâm lý khi phải giành ngôi đầu và tiến sâu vào vòng trong sẽ là lực cản lớn đối với ĐT Kuwait.\r\n\r\n“Chúng ta chỉ có một con đường là thắng mới chắc suất ở tứ kết. Tôi hoàn toàn tin tưởng ở các học trò của mình”, HLV trưởng ĐT Việt Nam khép lại câu chuyện. ', 'dtvn.jpg', 0, 0),
(3, 'Tuyển futsal Việt Nam lột xác trong trận thắng Tajikistan 10-4', 'Trong trận đấu thứ 2 tại vòng chung kết futsal châu Á 2014 vừa kết thúc tối nay, đội tuyển Việt Nam (VN) đã có chiến thắng đậm với tỷ số 10-4 trước Tajikistan.\r\nĐúng như lời hứa của HLV Bruno Formoso, đội tuyển VN đã chơi hay, nhanh, mạnh mẽ và dứt điểm hiệu quả hơn trong trận đấu với Tajikistan.\r\n\r\nBiết được khả năng chơi tấn công của đội tuyển VN, Tajikistan đã chủ động phòng ngự ngay từ đầu trận. Thế nhưng, những pha tấn công đa dạng của chủ nhà khiến cho thế phòng ngự của Tajikistan sớm bị phá sản.\r\n\r\nNgay phút thứ 10, từ pha tấn công nhanh, Văn Vũ đã xuất sắc ghi bàn mở tỷ số cho VN. Sau bàn thua, Tajikistan nhanh chóng có bàn gỡ hòa ở phút 11 do công Makhmudov.\r\n\r\nBàn thắng của Makhmudov không thể giúp nhiều cho Tajikistan, bởi ngay sau đó VN tấn công dồn dập để liên tiếp ghi bàn để giành chiến thắng chung cuộc với tỷ số 10-4.\r\n\r\n\r\nCác chàng trai Việt Nam (áo trắng) đã trút cơn mưa bàn thắng vào lưới Tajikistan - Ảnh: Độc Lập\r\n\r\nCác cầu thủ ghi bàn cho VN là Trọng Luân ( phút 12, 26), Ngọc Sơn (13, 27), Đức Nam (15), Đức Hòa (16), Bảo Quân (25, 33), Khánh Hưng (37).\r\n\r\nCác bàn thắng còn lại của Tajikistan do:  Madedbabaev, Jumaev, Mahmudov ghi.\r\n\r\nỞ trận đấu còn lại bảng A, Kuwait thắng Iraq 5-3. Như vậy, ở trận đấu cuối vòng bảng vào ngày 4.5, nếu Iraq thắng Tajikistan, đội tuyển VN cần phải thắng Kuwait mới giành quyền đi tiếp.\r\n\r\nPhát biểu sau trận đấu, HLV Bruno nói: “Kuwait đã có ưu thế sau hai trận thắng, cầu thủ của họ chơi rất tốt, nhưng chúng tôi sẽ nỗ lực để tự tìm cơ hội cho mình”.\r\n\r\nCác trận đấu bảng B diễn ra cùng ngày: Iran thắng Trung Quốc 12-0, Úc thắng Indonesia 5-0.\r\n\r\nNgày mai sẽ diễn ra các trận: Malaysia gặp Li-băng, Hàn Quốc gặp Kyrgyzstan, Đài Loan gặp Thái Lan và Uzbekistan gặp Nhật Bản.', 'DLA_9052.jpg', 0, 0),
(4, 'Giải bóng đá Futsal vô địch châu Á 2014: Tuyển Việt Nam đã biết thắng', 'Chiều tối ngày 2.5, tại nhà thi đấu Phú Thọ-TPHCM lượt trận thứ 2 của bảng A tiếp tục giữa chủ nhà Việt Nam tiếp đối thủ đến từ vùng Trung Á là Tajikistan. Sau trận thua đầu tiên trước đối thủ Tây Á là Iraq, tuyển Việt Nam như tự đẩy mình vào thế khó khi trận thứ 2 buộc phải thắng nếu không muốn nói lời chia tay sớm ngay trên sân nhà. Chính tình thế này vô tình đã tạo áp lực không nhỏ cho thầy trò ông HLV Bruno trước sự cổ vũ cuồng nhiệt của khán giả nhà. \r\n\r\nNếu Iraq là đối thủ ngang tầm, thậm chí còn bị đánh giá là thấp nhất bảng và tuyển Việt Nam đã bất ngờ để thua ở những phút cuối cùng của trận đấu. Bước vào trận thứ 2, trận quyết định chuyện đi hay ở cho tuyển Việt Nam đang được kỳ vọng về sự tiến bộ trong chuyên môn trong thời gian qua, nhất là sau chuyến đi tập huấn tại Tây Ban Nha.\r\n\r\nGặp đối thủ bị liệt vào danh sách yếu nhất giải là Tajikistan và chỉ có cửa phải thắng nếu muốn vào từ kết nên trong cuộc đối đầu này tuyển Việt Nam đã như quên hẳn trận thua đầu tiên để tập trung cho trận quyết định thứ 2 và ông HLV Bruno đã tung ngay đội hình mạnh nhất để kiếm trận thắng đầu tiên.\r\n\r\nCác học trò của ông đã không làm phụ lòng thầy bằng một lối đá rất hiệu quả cả khi thủ, lúc lên công khá nhịp nhàng. Ngay trong hiệp 1, tuyển Việt Nam đã có tới 6 lần buộc thủ môn đối phương phải vào lưới nhặt bóng và tuyển Việt Nam cũng 2 lần để thủng lưới một cách đáng tiếc.\r\n\r\nHiệp 2 là hiệp đấu mà thế trận hoàn toàn thuộc về đội chủ nhà Việt Nam và hiệp này chủ nhà đã có thêm 4 bàn thắng, nhưng cũng để đối thủ chọc thủng lưới 2 lần đề cuối cùng. \r\n\r\nSau 40 phút, tuyển futsal Việt Nam cũng tìm được trận thắng đầu tiên với tỷ số chung cuộc là 10/4 và kết quả này giúp Việt Nam có cơ hội vào tứ kết trong lượt trận thứ 3 trước đối thủ nặng ký đến từ Tây Á là Kuwait.\r\n\r\nTrận này, tuyển Việt Nam cũng buộc phải thắng, một nhiệm vụ không dễ dàng gì cho thầy-trò ông HLV Bruno, nhưng không phải là không thể làm được. \r\n\r\nTrận đấu quyết định này diễn ra vào tối ngày 4.5 cũng tại nhà thi đấu Phú Thọ-TPHCM', 'Laodong_FutsalVietNam_YACB', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
