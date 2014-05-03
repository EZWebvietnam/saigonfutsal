<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Chào mừng đến với <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Welcome to <?php echo $site_name; ?>!</h2>
Chào mừng bạn đã gia nhập <?php echo $site_name; ?>. Cảm ơn bạn đã đăng ký trở thành cộng tác viên của chúng tôi !.<br />
Để xác thực tài khoản của bạn ! Vui lòng click vào link dưới:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/active-user/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">Kích hoạt tài khoản...</a></b></big><br />
<br />
Nếu không click được, vui lòng coppy link dưới dây và chạy trên trình duyệt của bạn:<br />
<nobr><a href="<?php echo site_url('/active-user/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/active-user/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
Vui lòng kích hoạt email trong vòng <?php echo $activation_period; ?> tiếng kể từ khi bạn nhận được email này.<br />
<br />
<br />
<?php if (strlen($username) > 0) { ?>Username của bạn: <?php echo $username; ?><br /><?php } ?>
Địa chỉ email của bạn: <?php echo $email; ?><br />
<?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
<br />
<br />
Cảm ơn!<br />
The <?php echo $site_name; ?> Team
</td>
</tr>
</table>
</div>
</body>
</html>
