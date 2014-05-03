<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$fullname = array(
	'name'	=> 'fullname',
	'id'	=> 'fullname',
	'value'	=> set_value('fullname'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$phone = array(
	'name'	=> 'phone',
	'id'	=> 'phone',
	'value'	=> set_value('phone'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div id="register" class="margin_bottom box_bold_border">
        <div class="headline_9">	
            <h2>ĐĂNG KÝ TÀI KHOẢN |</h2><strong> Bạn sẽ trở thành 1 trong những thành viên của Cổng thông tin &amp; giao dịch Địa ốc sôi động nhất Việt Nam </strong>
        </div>
        <div class="body">
            <div class="left">
                <form  method="post" class="form_style_3">
                <?php 
                
                if($this->form_validation->run() == FALSE)
                {
               ?>
                <div class="validation-summary-errors">
                    <ul>
                        
                            <?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
                        
                       
                            <?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
                        
                        <?php echo form_error($password['name']); ?>
                        <?php echo form_error($confirm_password['name']); ?>
                        <?php echo form_error($captcha['name']); ?>
                        <?php echo form_error($fullname['name']); ?>
                         <?php echo form_error($phone['name']); ?>
                    </ul>
                 </div>
                 <?php }  ?>   
                    <div class="rounded_style_2 rounded_box margin_bottom"><div class="TL"></div><div class="TR"></div><div class="BL"></div><div class="BR"></div>
                        <div class="headline_10">
	                        <h2>THÔNG TIN ĐĂNG KÝ TÀI KHOẢN</h2>
   					    </div>
                        <div class="body">
                            <fieldset>	
                                <ul>
                                <li><label for="UserName">Tên đăng nhập</label> <span class="hightlight">*</span>
                                    <?php echo form_input($username); ?><br /><br />
                                    
                                    </li>
                                <li><label for="Password">Mật khẩu</label> <span class="hightlight">*</span>
                                    <?php echo form_password($password); ?></li>
                                <li><label for="ConfirmPassword">Xác nhận mật khẩu</label> <span class="hightlight">*</span>
                                    <?php echo form_password($confirm_password); ?></li>
                                <li><label for="Email">Email</label> <span class="hightlight">*</span>
                                    <?php echo form_input($email); ?></li>
                                      
                                </ul>
                               
                            </fieldset>
                        </div>
                    </div>
                    <div class="rounded_style_2 rounded_box margin_bottom"><div class="TL"></div><div class="TR"></div><div class="BL"></div><div class="BR"></div>
                    <div class="headline_10">
	                    <h2>THÔNG TIN CÁ NHÂN</h2>
    				</div>
                    <div class="body">
                        <fieldset>	
                            <ul>
                            <li><label for="FullName">Họ và Tên</label> <span class="hightlight">*</span>
                                <?php echo form_input($fullname); ?></li>
                            <li><label for="BirthDay">Ngày sinh</label>
                                <div class="dob">
                                    <select id="AllDay" name="AllDay"><option selected="selected" value="0">Chọn ngày</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
                                    <select id="AllMonth" name="AllMonth"><option selected="selected" value="0">Chọn tháng</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
                                    <select id="AllYear" name="AllYear"><option selected="selected" value="0">Chọn năm</option>
<option value="2014">2014</option>
<option value="2013">2013</option>
<option value="2012">2012</option>
<option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option>
<option value="1934">1934</option>
<option value="1933">1933</option>
<option value="1932">1932</option>
<option value="1931">1931</option>
<option value="1930">1930</option>
<option value="1929">1929</option>
<option value="1928">1928</option>
<option value="1927">1927</option>
<option value="1926">1926</option>
<option value="1925">1925</option>
<option value="1924">1924</option>
<option value="1923">1923</option>
<option value="1922">1922</option>
<option value="1921">1921</option>
<option value="1920">1920</option>
<option value="1919">1919</option>
<option value="1918">1918</option>
<option value="1917">1917</option>
<option value="1916">1916</option>
<option value="1915">1915</option>
<option value="1914">1914</option>
</select>
                                </div>
                            </li>
                            <li><label for="Gender">Giới tính</label>
                                <div class="gender">
                                    <input checked="checked" id="MenGender" name="Gender" type="radio" value="True"><label for="MenGender">Nam</label>
                                    <input id="WomenGender" name="Gender" type="radio" value="False"><label for="WomenGender">Nữ</label></div>
                            </li>
                            <li><label>Địa chỉ</label>
	                                <input id="Address" maxlength="200" name="Address" type="text" value="">
                            </li>
                            <li><label for="Mobile1">Điện thoại</label>
                                <div class="tel"><input id="Mobile1" maxlength="10" name="Mobile1" placeholder="Điện thoại bàn" type="text" value="">
                                    <?php echo form_input($phone); ?> <span class="hightlight">*</span></div>
                            </li>
                            <li><label for="CompanyName">Tên công ty</label>
                                <input id="CompanyName" maxlength="200" name="CompanyName" type="text" value=""></li>
                            <li><label for="Website">Website</label>
                                <input id="Website" maxlength="200" name="Website" type="text" value=""></li>
                        </ul>
                        </fieldset>
                    </div>
                </div>
                    <div class="rounded_style_2 rounded_box"><div class="TL"></div><div class="TR"></div><div class="BL"></div><div class="BR"></div>
                        <div class="body">
                            <fieldset>	
                                <ul>
                                <li class="disclaimer"><input type="checkbox" name="rule" id="rule"><label for="rule">Tôi hoàn toàn đồng ý với <a href="http://www.diaoconline.vn/dieu-khoan-thoa-thuan" target="_blank"><strong>các điều khoản thỏa thuận</strong></a></label></li>
                                <li class="btn">
                                <button type="submit" name="Submit" id="Submit" class="btn_2"><span>ĐĂNG KÝ</span></button>
                                <button type="reset" class="btn_2"><span>HỦY BỎ</span></button></li>
                                </ul>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="right">
                
                <div id="benefit" class="rounded_style_2 rounded_box"><div class="TL"></div><div class="TR"></div><div class="BL"></div><div class="BR"></div>
                    <div class="body">
                        <h4>Là thành viên chuyên trang DCBLand.COM, bạn sẽ có cơ hội trải nghiệm các tiện ích khác biệt</h4>
                        <ul>
                        <li><span class="img_email"></span>Cập nhật thông tin địa ốc hàng tuần qua hệ thống e-newsletter.</li>
                        <li><span class="img_post"></span>Các bài viết, thông tin tài sản quan tâm để dễ dàng truy cập lại khi cần thiết.</li>
                        <li><span class="img_search"></span>Sử dụng các tiện ích tìm kiếm tài sản qua email, điện thoại di động.</li>
                        <li><span class="img_app"></span>Có cơ hội được thử nghiệm các tính năng mới của DCBLand.Com.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>