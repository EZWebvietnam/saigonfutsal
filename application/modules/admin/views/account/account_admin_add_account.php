
<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Thêm tài khoản</h3>
</div>
<?php 
$username = array(
        'name'    => 'username',
        'id'    => 'username',
        'value' => set_value('username'),
        'maxlength'    => $this->config->item('username_max_length', 'tank_auth'),
        'size'    => 30
    );
$email = array(
    'name'    => 'sEmail',
    'id'    => 'sEmail',
    'value'    => set_value('sEmail'),
    'maxlength'    => 80,
    'size'    => 30);
$password = array(
    'name'    => 'sPassWord1',
    'type'=>'password',
    'id'    => 'sPassWord1',
    'value' => set_value('sPassWord1'),
    'maxlength'    => $this->config->item('password_max_length', 'tank_auth'),
    'size'    => 30
    );
?>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/accountadmin/add" method="post" accept-charset="utf-8" id="adminform"><input type="hidden" name="id" value="74">
        <table class="form" style="width: 550px;">
            <tr>
                <td class="label">Họ tên</td>
                <td colspan="3">
                    <input  type="text" value="" name="full_name"/>
                </td>
            </tr>
            <tr>
                <td class="label">Username</td>
                <td colspan="3">
                    <?php echo form_input($username);?>
                    <div id="error_user"></div>
                </td>
            </tr>
            <tr>
                <td class="label">Password</td>
                <td colspan="3">
                     <?php echo form_input($password);?>
                </td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td colspan="3">
                     <?php echo form_input($email);?>
                    <div id="error_email"></div>
                </td>
            </tr>
            <tr>
                <td class="label">Quyền hạn</td>
                <td colspan="3">
                    <select name="role">
                        <?php 
                        foreach($list_role as $role)
                        {
                        ?>
                        <option value="<?php echo $role['id']?>"><?php echo $role['name']?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
             <tr>
                <td class="label">SĐT</td>
                <td colspan="3">
                    <input type="text" value="" name="phone"/>
                </td>
            </tr>
            <tr>
                <td class="label">Địa chỉ</td>
                <td colspan="3">
                    <input type="text" value="" name="address"/>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td colspan="3">
                    <input id="btn_submit" type="submit" class="bt100" value="Thêm"/>
                </td>
            </tr>
            <td></td>
            
            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_submit').attr('disabled','disabled');
        $('#username').change(function(){
        var username = $(this).val();
        $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>admin/ctvadmin/check_account_ajax",
                data: {username:username},
                dataType: "json",
                success: function(data) {
                    if(data.error!=0)
                    {
                       $('#error_user').html(data.msg);
                      $('#btn_submit').attr('disabled','disabled');
                    }
                    else
                    {
                       
                         $('#error_user').html(data.msg);
                         
                          $('#btn_submit').attr('disabled',false);
                    }
                }
            });
    });
    $('#sEmail').change(function(){
        var email = $(this).val();
        $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>admin/ctvadmin/check_email_ajax",
                data: {email:email},
                dataType: "json",
                cache: false,
                success: function(data) {
                    if(data.error!=0)
                    {
                       $('#error_email').html(data.msg);
                       $('#btn_submit').attr('disabled','disabled');
                       
                    }
                    else
                    {
                        $('#error_email').html(data.msg);
                        $('#btn_submit').attr('disabled',false);
                    }
                }
            });
    });
        $("#adminform").validate({
            rules: {
                full_name: "required",
                phone: "required",
                address: "required",
                password:"required"
                
            },
            messages: {
                full_name: "Vui lòng nhập tên",
                phone: "Vui lòng nhập SĐT",
                address: "Vui lòng nhập địa chỉ",
                password:"Vui lòng nhập mật khẩu"
            }
            , submitHandler: function(form) {
                var page = 1;
                dataString = $("#adminform").serialize();
                $.ajax({
                    type: "POST",
                    url: $("#adminform").attr('action'),
                    data: dataString,
                    mimeType: "multipart/form-data",
                    dataType: "json",
                    success: function(data) {
                        $.fancybox.close();
                        reload_callback("<?php echo base_url(); ?>admin/accountadmin/list_account", page, 'khachhang_content');
                        show_msg(data.msg);
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("a.grouped_elements").fancybox({
            'padding': 0,
            'titleShow': false,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'hideOnOverlayClick': false,
            'hideOnContentClick': false,
            'overlayShow': true,
            'type': 'ajax'
        });
    });
</script>