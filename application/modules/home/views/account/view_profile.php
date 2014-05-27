<section class="my-account-section">
               <h3 class="blue-header"></h3>
			   <?php 
			   if(isset($_SESSION['save_su']))
			   {
			   ?>
               <div class="success">
                  <span>Thay đổi thành công</span>
               </div>
			   <?php unset($_SESSION['save_su']);} ?>
               <ul>
			   <input type="hidden" name="edit" value="1"/>
                  <li>
                     <label>Email</label>
                     <input type="text" name="email_address" disabled="disabled" value="<?php echo $this->session->userdata('email');?>">
                  </li>
                  <li>
                     <label>Password</label>
                     <input type="password" name="password" disabled="disabled" value="********">
                  </li>
                  
				  <li>
                     <label>Số điện thoại</label>
                     <input type="text" name="phone" disabled="disabled" value="<?php echo $this->session->userdata('phone');?>">
                  </li>
				  <li>
                     <label>Họ tên</label>
                     <input type="text" name="full_name" disabled="disabled" value="<?php echo $this->session->userdata('full_name');?>">
                  </li>
               </ul>
			   <script>
			   	$('#edit-details-btn').click(function(){
					document.forms.edit_profile.submit();
				});
			   </script>
            </section>
            