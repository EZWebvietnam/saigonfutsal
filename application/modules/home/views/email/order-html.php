<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Chào mừng đến với <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Xin chào <?php echo $name; ?>!</h2>
Cảm ơn bạn đã tin tưởng đặt hàng dịch vụ từ <a href="<?php echo base_url();?>">Việt Mông Cổ</a><br />Dưới đây là thông tin đơn hàng của bạn:
<br />
<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Tên sản phẩm</td>
		<td>Số lượng</td>
		<td>Đơn giá</td>
                <td>Thành tiền</td>
                <td>Chi tiết SP</td>
	</tr>
        <?php 
       
        foreach($order_detail as $order)
        {
            $detail_product = $this->productmodel->product_detail($order['id_product']);
        ?>
	<tr>
		<td><?php echo $detail_product[0]['title']?></td>
		<td><?php echo $order['quantity']?></td>
		<td><?php echo $order['price']?></td>
                <td><?php echo $order['quantity']*$order['price']?></td>
                <td>
                    <?php 
                    if($detail_product[0]['position']!=0)
                    {
                    ?>
                    <a href="<?php echo base_url();?>san-pham/<?php echo $order['id_product']?>-<?php echo mb_strtolower(url_title(removesign($detail_product[0]['title'])))?>">Chi tiết Sản phẩm</a>
                    <?php } else { ?>
                    <a href="<?php echo base_url();?>">Chi tiết Sản phẩm</a>
                    <?php } ?>
                </td>
	</tr>
        <?php } ?>
</table>
<br/>
Chúng tôi sẽ liên hệ và phục vụ bạn trong vòng 24h.<br/>
<b style="font-size:20px">Hotline: 0918.870.781</b>
Bắt đầu từ giờ phút này bạn được tham gia vào nhóm Khách Hàng của Việt Mông Cổ  trên Facebook để được thảo luận:<br/>
Bạn hãy xin tham gia nhóm tại link sau: <a target="__blank" href='https://www.facebook.com/groups/khachhangvietmongco/'>https://www.facebook.com/groups/khachhangvietmongco/</a>
<br />
<span style="font-size:20px"><b>Dưới đây là các tài khoản của Việt Mông Cổ để bạn lựa chọn thanh toán (Nếu có)</b></span><br/>
Khi thanh toán chuyển khoản bạn nhớ ghi Họ Tên và điện thoại<br />
của mình vào ô nội dung chuyển tiền để chúng tôi tiện theo dõi<br />
Chuyển tiền xong thì bạn hãy thông báo về cho chúng tôi để xác nhận:<br />
<b>Hotline:  0918.870.781</b><br />
--------------------------------------------------<br />
<b><font color="red">Số tài khoản : 20001010917643</font><br />
<font color="blue">Tên tài khoản: NGUYỄN ĐÌNH HÁN<br />
Ngân hàng TMCP Hàng Hải  - Chi nhánh Hải Dương<br /></font>
----------------<br /></b>
<b><font color="red">Số tài khoản : 0591000200817<br /></font>
<font color="blue">Tên tài khoản: NGUYỄN THỊ HUỆ<br />
Ngân hàng Vietcombank - chi nhánh Hưng Yên<br /></b>
Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của Việt Mông Cổ!<br /></font>
The <?php echo $site_name; ?> Team
</td>
</tr>
</table>
</div>
</body>
</html>
