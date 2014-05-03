<style>
#login_board ul
{
    height: auto !important;
}
</style>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
    'id'=>'UserName'
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
    'id'=>'Password'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div id="login_board" class="margin_bottom box_bold_border">
            <div class="left">
                <div class="headline_9">
                    <h2>ĐĂNG NHẬP</h2>
                </div>
                <div class="body">
                    <h3>Bạn chưa có tài khoản DCBLand. <a href="/dang-ky">Đăng ký tại đây?</a>
                    </h3>
                    <form  id="FormMain" method="post" class="form_style_3">
                    <div class="validation-summary-errors"><ul>
                    <li><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
                    <?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
                    </li>
                    </ul></div>
                    <fieldset>
                        <ul>
                            <li><label for="UserName">Tên đăng nhập</label><?php echo form_input($login); ?></li>
                            <li><label for="Password">Mật khẩu</label><?php echo form_password($password); ?></li>
                            <li class="btn">
                                <div class="remember">
                                    <?php echo form_checkbox($remember); ?> <label for="RememberMe">Nhớ cho lần đăng nhập sau</label></div>
                                <button type="submit" id="Submit" class="btn_2">
                                    <span>ĐĂNG NHẬP</span></button></li>
                            <li class="forget"><a href="/quen-mat-khau">Quên mật khẩu?</a></li>
                        </ul>
                    </fieldset>
                    </form>
                </div>
            </div>

<div id="position_54" class="right"><div class="bannerShow"><a href="http://www.diaoconline.vn/quangcao/30/54" target="_blank"><img src="http://image1.diaoconline.vn/banner-dool/2012/10/31/1D5-DoolTeam_538x238.jpg" width="538px" height="238px"></a></div><div class="bannerHide"><a href="http://www.diaoconline.vn/quangcao/30/54" target="_blank"><img src="http://image1.diaoconline.vn/banner-dool/2012/10/31/1D5-DoolTeam_538x238.jpg" width="538px" height="238px"></a></div></div><script type="text/javascript">var Banner54=1;function Random_Banner54(){    var _Arr=document.getElementById("position_54").getElementsByTagName("div");    for (i=0; i<=_Arr.length-1; i++)    {        _Arr[i].className='bannerHide';    }    _Arr[Banner54 - 1].className='bannerShow';    var tempBanner = $(_Arr[Banner54 - 1]).html(); $(_Arr[Banner54 - 1]).html(''); $(_Arr[Banner54 - 1]).html(tempBanner);    window.setTimeout("Random_Banner54()" ,25000);    Banner54 = Banner54 + 1;    if(Banner54 > _Arr.length)        Banner54 = 1;}Random_Banner54();</script>
            <script type="text/javascript">
                $('#UserName').focus();
                $('#FormMain').submit(function () {
                    if ($('#UserName').val().length < 2) {
                        $('#UserName').focus();
                        return false;
                    }
                    if ($('#Password').val().length < 2) {
                        $('#Password').focus();
                        return false;
                    }
                    return;
                });
            </script>
        </div>