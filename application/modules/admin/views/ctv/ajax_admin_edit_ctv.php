
<script type="text/javascript">
    $(document).ready(function() {
        $("input").each(function() {
            $("input.readonly").css('background-color', '#f2f2f2');
        });
        $( "#birth_day" ).datepicker({ dateFormat: 'yy/mm/dd' });
    });
</script>
<div class="h-pop">
    <div class="h-icon"></div>
    <h3>Chi tiết cộng tác viên</h3>
</div>
<div class="m-pop">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/ezwebvietnam/admin_cp/js/core/price_format.js"></script>
    <form action="<?php echo base_url(); ?>admin/ctvadmin/edit/<?php echo $detail_ctv[0]['id'] ?>" method="post" accept-charset="utf-8" id="adminform"><input type="hidden" name="id" value="74">
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
                <td class="label">SĐT</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['phone'] ?>" name="phone"/>
                </td>
            </tr>
            <tr>
                <td class="label">Giới tính</td>
                <td colspan="3">
                    <?php 
                    if($detail_ctv[0]['sex']==0)
                    {
                        ?>
                    <input checked="" type="radio" name="radio" value="0"/>Nam<input type="radio" name="radio" value="1"/>Nữ
                            <?php
                    }
                    else
                    {
                    ?>
                    <input type="radio" name="radio" value="0"/>Nam<input type="radio" name="radio" value="1" checked=""/>Nữ
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td class="label">Ngày sinh</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['birthday'] ?>" id="birth_day" name="birth_day"/>
                </td>
            </tr>
            <tr>
                <td class="label">Địa chỉ</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['address'] ?>" name="address"/>
                </td>
            </tr>
            <tr>
                <td class="label">Tỉnh / Thành phố</td>
                <td colspan="3">
                    <select name="province">
                        <?php 
                        foreach($list_province_admin as $k=>$v)
                        {
                            if($k == $detail_ctv[0]['province'])
                            {
                        ?>
                        <option selected="" value="<?php echo $k?>"> <?php echo $v?></option>
                        <?php } else {?>
                        <option value="<?php echo $k?>"> <?php echo $v?></option>
                        <?php } } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">Yahoo</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['yahoo'] ?>" name="yahoo"/>
                </td>
            </tr>
            <tr>
                <td class="label">Skype</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['skype'] ?>" name="skype"/>
                </td>
            </tr>
            <tr>
                <td class="label">Ngân hàng / Ví điện tử</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['bank'] ?>" name="bank"/>
                </td>
            </tr>
            <tr>
                <td class="label">STK/Email giao dịch</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $detail_ctv[0]['stk'] ?>" name="stk"/>
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
                        reload_callback("<?php echo base_url(); ?>admin/ctvadmin/list_ctv", page, 'result');
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