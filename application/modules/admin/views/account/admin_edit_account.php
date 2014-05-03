
<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
    });
</script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Chi tiết Tài khoản</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/accountadmin/edit/<?php echo $detail_ctv[0]['id'] ?>" method="post" accept-charset="utf-8" id="adminform"><input type="hidden" name="id" value="74">
        <table class="form" style="width: 550px;">
            <tr>
                <td class="label">Họ tên</td>
                <td colspan="3">
                    <input  type="text" value="<?php echo $detail_ctv[0]['full_name'] ?>" name="full_name"/>
                </td>
            </tr>
            <tr>
                <td class="label">Password</td>
                <td colspan="3">
                    <input type="password" value="" name="password"/>
                </td>
            </tr>
            <tr>
                <td class="label">Quyền hạn</td>
                <td colspan="3">
                    <select name="role">
                        <?php 
                        foreach($list_role as $role)
                        {
                            if($detail_ctv[0]['role']==$role['id'])
                            {
                        ?>
                        <option selected="" value="<?php echo $role['id']?>"><?php echo $role['name']?></option>
                        <?php } else { ?> 
                            <option value="<?php echo $role['id']?>"><?php echo $role['name']?></option>
                            <?php  } } ?>
                    </select>
                </td>
            </tr>
             <tr>
                <td class="label">SĐT</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['phone'] ?>" name="phone"/>
                </td>
            </tr>
            <tr>
                <td class="label">Địa chỉ</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['address'] ?>" name="address"/>
                </td>
            </tr>
            <tr>
                <td class="label">IP Last Login</td>
                <td colspan="3">
                    <?php echo $detail_ctv[0]['last_ip'] ?>
                </td>
            </tr>
            <tr>
                <td class="label">Last Login</td>
                <td colspan="3">
                    <?php echo date('d/m/Y h:i:s',strtotime($detail_ctv[0]['last_login'])); ?>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td colspan="3">
                    <input type="submit" class="bt100" value="Cập nhập"/>
                </td>
            </tr>
            <td></td>
            
            </tr>

        </table>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#adminform").validate({
            rules: {
                full_name: "required",
                phone: "required",
                address: "required",
                
            },
            messages: {
                full_name: "Vui lòng nhập tên",
                phone: "Vui lòng nhập SĐT",
                address: "Vui lòng nhập địa chỉ"
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
                    cache: false,
                    success: function(data) {
                        $.fancybox.close();
                        reload_callback("<?php echo base_url(); ?>admin/accountadmin/list_account", page, 'result');
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