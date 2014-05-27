<section class="my-account-section edit-form">
            <h3 class="blue-header">Sửa thông tin thành viên</h3>            
            <ul>
			 <input type="hidden" name="edit" value="2"/>
                <div class="login-row clearfix"><label for="login-contact" class="optional">Email</label>
                                    <input type="text" name="email" id="login-contact" value="<?php echo $this->session->userdata('email');?>">
                                 </div>
                <div class="login-row clearfix">
				<label for="login-contact" class="optional">Password</label>
                                    <input type="text" name="password" id="login-contact" value="">
                                 </div>
				<div class="login-row clearfix"><label for="login-contact" class="optional">Số điện thoại</label>
                                    <input type="text" name="phone" id="login-contact" value="<?php echo $this->session->userdata('phone');?>">
                                 </div>
				<div class="login-row clearfix"><label for="login-contact" class="optional">Họ tên</label>
                                    <input type="text" name="full_name" id="login-contact" value="<?php echo $this->session->userdata('full_name');?>">
                                 </div>
            </ul>
			<script>
			   	$('#save_profile').click(function(){
					document.forms.edit_profile.submit();
				});
			   </script>
        </section>
		<section class="my-account-buttons" style="">
            <a href="#" id="cancel-btn" class="grey-btn">Hủy</a>
            <input class="red-btn-submit" id="save_profile" type="submit" value="Thay đổi">
        </section>