<style>
#login_board ul
{
    height: auto !important;
}
</style>
<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
);
?>
<div id="login_board" class="margin_bottom box_bold_border">
        <div class="left">
            <div class="headline_9">	
                <h2>QUÊN MẬT KHẨU</h2>
            </div>
            <div class="body">
                <h3>
                    Bạn chưa có tài khoản DiaOcOnline. <a href="/dang-ky">Đăng ký tại đây?</a>
                </h3>
                <form  id="FormMain" method="post" class="form_style_3">
                    <div class="validation-summary-errors"><ul>
                    <li><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
                    <?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
                    </li>
                    </ul></div>
                    <fieldset>	
                        <ul>
                            <li><label for="NewPass">Mật khẩu mới:</label><?php echo form_password($new_password); ?></li>
                            <li><label for="NewPassConfirm">Nhập lại</label><?php echo form_password($confirm_new_password); ?></li>
                            <li class="btn"><button type="submit" id="Submit" class="btn_2"><span>GỬI MẬT KHẨU</span></button></li>
                        </ul>
                    </fieldset>
                </form>
            </div>
        </div>

<div id="position_54" class="right"><div class="bannerHide"><a href="http://www.diaoconline.vn/quangcao/30/54" target="_blank"><img src="http://image1.diaoconline.vn/banner-dool/2012/10/31/1D5-DoolTeam_538x238.jpg" width="538px" height="238px"></a></div><div class="bannerShow"><a href="http://www.diaoconline.vn/quangcao/30/54" target="_blank"><img src="http://image1.diaoconline.vn/banner-dool/2012/10/31/1D5-DoolTeam_538x238.jpg" width="538px" height="238px"></a></div></div><script type="text/javascript">var Banner54=1;function Random_Banner54(){    var _Arr=document.getElementById("position_54").getElementsByTagName("div");    for (i=0; i<=_Arr.length-1; i++)    {        _Arr[i].className='bannerHide';    }    _Arr[Banner54 - 1].className='bannerShow';    var tempBanner = $(_Arr[Banner54 - 1]).html(); $(_Arr[Banner54 - 1]).html(''); $(_Arr[Banner54 - 1]).html(tempBanner);    window.setTimeout("Random_Banner54()" ,25000);    Banner54 = Banner54 + 1;    if(Banner54 > _Arr.length)        Banner54 = 1;}Random_Banner54();</script>
        <script type="text/javascript">
            $('#FormMain').submit(function () {
                if ($('#Email').val().length < 2) {
                    $('#Email').focus();
                    return false;
                }
                return;
            });
        </script>
    </div>