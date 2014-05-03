<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Mật khẩu xác nhận giao dịch !</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Xin chào <?php echo $user; ?>!</h2>
Bạn đã thực hiện giao dịch tại hệ thống BEST RESSELERS. Chúng tôi xin gửi bạn mật khẩu để xác nhận giao dịch:<br />
<br />
Mật khẩu: <?php echo $password?>
<br/>
Mã số giao dịch: <?php echo $transaction_code;?>
<br/>
Số tiền giao dịch: <?php echo $money;?>
<br/>
Nếu bạn không phải là người thực hiện giao dịch, xin vui lòng bỏ qua email này !<br/>
Xin cảm ơn !
</td>
</tr>
</table>
</div>
</body>
</html>
